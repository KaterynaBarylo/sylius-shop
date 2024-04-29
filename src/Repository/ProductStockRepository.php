<?php

namespace App\Repository;

use App\Entity\Product\ProductStock;
use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

/**
 * @method ProductStock|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductStock|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductStock[]    findAll()
 * @method ProductStock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductStockRepository extends EntityRepository
{
    public function createListQueryBuilder(?array $criteria): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('s')
            ->join('s.product', 'p')
        ;

        return $queryBuilder;
    }
}
