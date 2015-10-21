<?php
namespace CustomerBundle\DataFixtures\ORM;
 
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use CustomerBundle\Entity\Customer;
 
class LoadCustomerData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $pass = md5('test123');
        for($i = 0; $i <= $this->getOrder(); $i++)
        {
            $customer = new Customer();
            $customer->setFirstname("John Doe - ".rand(100,999).'-'.time());
            $customer->setLogin('test'.($i+1).'@mailinator.com');
            $customer->setPassword($pass);
            $em->persist($customer);
            if($i%3 == 0) {
                sleep(1);
            }
        }
        
        $em->flush();
    }

    public function getOrder()
    {
        return 20;
    }

}