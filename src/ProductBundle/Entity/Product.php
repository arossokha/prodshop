<?php

namespace ProductBundle\Entity;

/**
 * Product
 */
class Product
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $price;

    /**
     * @var integer
     */
    private $quantity;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $orders;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orders = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Product
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
     * Add order
     *
     * @param \CustomerBundle\Entity\Order $order
     *
     * @return Product
     */
    public function addOrder(\CustomerBundle\Entity\Order $order)
    {
        $this->orders[] = $order;

        return $this;
    }

    /**
     * Remove order
     *
     * @param \CustomerBundle\Entity\Order $order
     */
    public function removeOrder(\CustomerBundle\Entity\Order $order)
    {
        $this->orders->removeElement($order);
    }

    /**
     * Get orders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrders()
    {
        return $this->orders;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $orderProducts;


    /**
     * Add orderProduct
     *
     * @param \ProductBundle\Entity\OrderProduct $orderProduct
     *
     * @return Product
     */
    public function addOrderProduct(\ProductBundle\Entity\OrderProduct $orderProduct)
    {
        $this->orderProducts[] = $orderProduct;

        return $this;
    }

    /**
     * Remove orderProduct
     *
     * @param \ProductBundle\Entity\OrderProduct $orderProduct
     */
    public function removeOrderProduct(\ProductBundle\Entity\OrderProduct $orderProduct)
    {
        $this->orderProducts->removeElement($orderProduct);
    }

    /**
     * Get orderProducts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrderProducts()
    {
        return $this->orderProducts;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $productOrders;


    /**
     * Add productOrder
     *
     * @param \ProductBundle\Entity\OrderProduct $productOrder
     *
     * @return Product
     */
    public function addProductOrder(\ProductBundle\Entity\OrderProduct $productOrder)
    {
        $this->productOrders[] = $productOrder;

        return $this;
    }

    /**
     * Remove productOrder
     *
     * @param \ProductBundle\Entity\OrderProduct $productOrder
     */
    public function removeProductOrder(\ProductBundle\Entity\OrderProduct $productOrder)
    {
        $this->productOrders->removeElement($productOrder);
    }

    /**
     * Get productOrders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductOrders()
    {
        return $this->productOrders;
    }
}
