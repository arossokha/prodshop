<?php
namespace ProductBundle\DataFixtures\ORM;
 
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use ProductBundle\Entity\Product;
 
class LoadProductData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        for($i = 0; $i <= $this->getOrder(); $i++)
        {
            $product = new Product();
            $product->setName("product-".rand(1000000,9999999).'-'.time());
            $product->setQuantity($i+1);
            $product->setPrice(rand(10000,99999)/100);
            $em->persist($product);
        }
        
        $em->flush();
    }

    public function getOrder()
    {
        return 100;
    }

}