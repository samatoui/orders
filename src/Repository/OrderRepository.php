<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;


/**
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OrderRepository extends EntityRepository
{
    /**
     * @param string|null $criteria
     * @return array
     */
    public function getOrdersByCriteria(string $criteria = null)
    {
        $qb = $this->createQueryBuilder('orders');

        if ($criteria) {
            $qb->where(
                $qb->expr()->orX(
                    $qb->expr()->like("orders.marketPlace", ":search"),
                    $qb->expr()->like("orders.orderId", ":search"),
                    $qb->expr()->like("orders.fluxId", ":search"),
                    $qb->expr()->like("orders.mrId", ":search"),
                    $qb->expr()->like("orders.refId", ":search")
                )
            )->setParameter(":search", '%' . $criteria . '%');
        }

        return $qb->getQuery()->getResult();
    }
}