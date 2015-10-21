jQuery(document).ready(function () {
    $productSelect = $("#productsList");
    $productSelect.on("select2:select", function (e) {
        $productsList = $('ul.products');
        var index = $productsList.data('index');
        $productsList = $productsList.data('index', index + 1);

        var formTemplate = "<div><label class=\"required\">Name</label><div id=\"customerbundle_order_products_" +
            index +
            "_\"><div><label for=\"customerbundle_order_products_" +
            index +
            "_name\">Name: </label>"+e.params.data.name+" ("+e.params.data.price+")"+" <input type=\"hidden\" id=\"customerbundle_order_products[" +
            index +
            "_id\" name=\"customerbundle_order[products][" +
            index +
            "][id]\" required=\"required\" value=\""+e.params.data.id+"\"/>"+
            "<input type=\"hidden\" id=\"customerbundle_order_products[" +
            index +
            "]price\" name=\"customerbundle_order[products][" +
            index +
            "][price]\" required=\"required\" value=\""+e.params.data.price+"\"/></div><div>" +
            "<div><label for=\"customerbundle_order_products_" + index + "_quantity\" class=\"required\">Quantity: </label>" +
            "<input type=\"number\" class='calculateSum' id=\"customerbundle_order_products_" + index + "_quantity\" name=\"customerbundle_order[products][" +
            index +
            "][quantity]\" required=\"required\" maxlength=\"2\" value=\"1\" data-price='"+e.params.data.price+"'/></div></div></div>"

        var $newFormLi = $('<li></li>').append(formTemplate);
        $productsList.append($newFormLi);
        recalculateSum();
    });
    $productSelect.select2({
        ajax: {
            url: "/app_dev.php/product/search",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
                };
            },
            processResults: function (data, page) {
                return {
                    results: data
                };
            },
            //cache: true
        },
        escapeMarkup: function (markup) {
            return markup;
        }, // let our custom formatter work
        minimumInputLength: 3,
        templateResult: formatData,
        templateSelection: formatDataSelection
    });

    $('ul.products').on('change','li',recalculateSum);
});

function recalculateSum(){
    var sum = 0;
    $('.calculateSum').each(function(index,item) {
        sum += item.value * $(item).data('price');
    });

    $('.orderSum').val(sum.toFixed(2));
}

function formatData(data) {
    if (data.loading) return data.name;

    markup = "<h1>" + data.name + "(" + data.quantity + ")</h1>";

    return markup;
}

function formatDataSelection(data) {
    return data.name;
}
