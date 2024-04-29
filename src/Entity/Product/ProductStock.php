<?php

declare(strict_types=1);

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_product_stock")
 */
class ProductStock implements ResourceInterface
{
    public const STATUS_IN_STOCK = 'in_stock';

    public const STATUS_OUT_OF_STOCK = 'out_of_stock';

    public const STATUS_EXPECTED = 'expected';

    public const STATUSES = [self::STATUS_IN_STOCK, self::STATUS_OUT_OF_STOCK, self::STATUS_EXPECTED];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected int $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Product\Product", inversedBy="productStock")
     */
    protected ?Product $product = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $stockStatus;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTime $restockDate = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): void
    {
        $this->product = $product;
    }

    public function getStockStatus(): string
    {
        return $this->stockStatus;
    }

    public function setStockStatus(string $stockStatus): void
    {
        $this->stockStatus = $stockStatus;
    }

    public function getRestockDate(): ?\DateTime
    {
        return $this->restockDate;
    }

    public function setRestockDate(?\DateTime $restockDate): void
    {
        $this->restockDate = $restockDate;
    }
}
