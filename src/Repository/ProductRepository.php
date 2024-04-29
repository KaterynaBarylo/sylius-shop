<?php

namespace App\Repository;

use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\ProductRepository as BaseProductRepository;

class ProductRepository extends BaseProductRepository
{

    public function createNotUsedProductsQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.productStock', 'productStock')
            ->andWhere('productStock.product is null')
        ;
    }

    public function createProductStockListQueryBuilder(?array $criteria): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('o')
            ->addSelect('productStock')
            ->leftJoin('o.productStock', 'productStock')
        ;

//        if (is_array($criteria) && array_key_exists('stockStatus', $criteria)) {
//            $queryBuilder
//                ->andWhere('productStock.stockStatus = :stockStatus')
//                ->setParameter('stockStatus', $criteria['stockStatus'])
//            ;
//        }

        return $queryBuilder;
    }
}
