function recalculateSum(){
    var sum = 0;
    $('.productQuantity').each(function(index,item) {
        sum += parseInt(item.value) * $(item).data('price');
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

function initSelect($collectionHolder,$select)
{
    var $itemsList = $collectionHolder.children('ul');
    $select.on("select2:select", function (e) {
        var item = e.params.data;
        if(!item) {
            return false;
        }
        // Get the data-prototype explained earlier
        var prototype = $collectionHolder.data('prototype');
        // get the new index
        var index = $collectionHolder.data('index');
        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        var newForm = prototype.replace(/__name__/g, index);
        newForm = newForm.replace(/label__/g,item.name)
        // increase the index with one for the next item
        $collectionHolder.data('index', index + 1);

        // Display the form in the page in an li, before the "Add a tag" link li
        var $newFormLi = $('<li></li>').append(newForm);
        $newFormLi.find('.productPrice').eq(0).val(item.price);
        $newFormLi.find('.productId').eq(0).val(item.id);
        $newFormLi.find('.productQuantity').eq(0).val(1).data('price',item.price);
        $itemsList.append($newFormLi);
        recalculateSum();
    });
    $select.select2({
        ajax: {
            // @todo : find correct way to get url
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
}

// correct code
var $collectionHolder;
// setup an "add a sub entity" link
var $addSubEntityLink = $('<a href="#" class="add_tag_link">Add a product</a>');

var $newLinkLi = $('<li></li>').append($addSubEntityLink);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of sub entities
    $collectionHolder = $('div.products');
    // add ul for correct html structure
    $collectionHolder.append('<ul></ul>');
    // add select for choose products from list
    $collectionHolder.before('<br><select id="productsList"></select>');
    $select = $("#productsList");
    initSelect($collectionHolder,$select);
    // add the "add a product" anchor and li to the tags ul
    //$collectionHolder.children('ul').append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    //$addSubEntityLink.on('click', function(e) {
    //    // prevent the link from creating a "#" on the URL
    //    e.preventDefault();
    //
    //    // add a new tag form (see next code block)
    //    addSubEntityForm($collectionHolder, $newLinkLi);
    //});
    $('div.products ul').on('change','.productQuantity',recalculateSum);
});

function addSubEntityForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');
    // get the new index
    var index = $collectionHolder.data('index');
    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);
    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);
}
