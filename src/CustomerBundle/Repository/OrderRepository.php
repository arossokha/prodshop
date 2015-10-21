<?php

namespace CustomerBundle\Repository;

use Doctrine\ORM\EntityRepository;


class OrderRepository extends EntityRepository
{
    public function getOrderList($max = null,$offset = null){
        $qb = $this->createQueryBuilder('o')
            ->orderBy('o.id', 'DESC');
        if($max) {
            $qb->setMaxResults($max);
        }
        if($offset) {
            $qb->setFirstResult($offset);
        }
        $query = $qb->getQuery();
        return $query->getResult();
    }

}

