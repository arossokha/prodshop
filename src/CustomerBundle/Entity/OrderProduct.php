<?php

namespace CustomerBundle\Entity;

/**
 * OrderProduct
 */
class OrderProduct
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $order_id;

    /**
     * @var integer
     */
    private $product_id;

    /**
     * @var integer
     */
    private $quantity;

    /**
     * @var \CustomerBundle\Entity\Order
     */
    private $order;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set orderId
     *
     * @param integer $orderId
     *
     * @return OrderProduct
     */
    public function setOrderId($orderId)
    {
        $this->order_id = $orderId;

        return $this;
    }

    /**
     * Get orderId
     *
     * @return integer
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * Set productId
     *
     * @param integer $productId
     *
     * @return OrderProduct
     */
    public function setProductId($productId)
    {
        $this->product_id = $productId;

        return $this;
    }

    /**
     * Get productId
     *
     * @return integer
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return OrderProduct
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set order
     *
     * @param \CustomerBundle\Entity\Order $order
     *
     * @return OrderProduct
     */
    public function setOrder(\CustomerBundle\Entity\Order $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \CustomerBundle\Entity\Order
     */
    public function getOrder()
    {
        return $this->order;
    }
    /**
     * @var \ProductBundle\Entity\Product
     */
    private $product;


    /**
     * Set product
     *
     * @param \ProductBundle\Entity\Product $product
     *
     * @return OrderProduct
     */
    public function setProduct(\ProductBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \ProductBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

}
