<?php

declare(strict_types=1);

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Product as BaseProduct;
use Sylius\Component\Product\Model\ProductTranslationInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_product")
 */
#[ORM\Entity]
#[ORM\Table(name: 'sylius_product')]
class Product extends BaseProduct
{
    protected function createTranslation(): ProductTranslationInterface
    {
        return new ProductTranslation();
    }

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Product\ProductStock", mappedBy="product")
     */
    protected ?ProductStock $productStock = null;

    public function getProductStock(): ?ProductStock
    {
        return $this->productStock;
    }

    public function setProductStock(?ProductStock $productStock): void
    {
        $this->productStock = $productStock;
    }
}
