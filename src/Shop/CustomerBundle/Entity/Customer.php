<?php

namespace Shop\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Customer
 */
class Customer
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $firtname;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $password;

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
     * Set firtname
     *
     * @param string $firtname
     *
     * @return Customer
     */
    public function setFirtname($firtname)
    {
        $this->firtname = $firtname;

        return $this;
    }

    /**
     * Get firtname
     *
     * @return string
     */
    public function getFirtname()
    {
        return $this->firtname;
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return Customer
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Customer
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Add order
     *
     * @param \Shop\CustomerBundle\Entity\Order $order
     *
     * @return Customer
     */
    public function addOrder(\Shop\CustomerBundle\Entity\Order $order)
    {
        $this->orders[] = $order;

        return $this;
    }

    /**
     * Remove order
     *
     * @param \Shop\CustomerBundle\Entity\Order $order
     */
    public function removeOrder(\Shop\CustomerBundle\Entity\Order $order)
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
     * @todo  create correct password saving
     * // @ORM\PrePersist
     */
    public function setPasswordValue()
    {
        if($this->password) {
            $this->password = md5($this->password)
        }
    }
}
