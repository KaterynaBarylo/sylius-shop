<?php

declare(strict_types=1);

namespace App\Form\Extension;

use App\Entity\Product\Product;
use App\Entity\Product\ProductStock;
use App\Repository\ProductRepository;
use Sylius\Bundle\ResourceBundle\Form\Type\DefaultResourceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class ProductStockTypeExtension extends AbstractTypeExtension
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            /** @var ProductStock $productStock */
            $productStock = $event->getData();
            $event->getForm()->remove('product');
            if ($productStock->getProduct()) {
                $event->getForm()->add('product', TextType::class, [
                        'data' => $productStock->getProduct()->getName(),
                        'disabled' => true,
                    ]
                );
            } else {
                $event->getForm()->add('product', EntityType::class, [
                        'class' => Product::class,
                        'query_builder' => $this->productRepository->createNotUsedProductsQueryBuilder(),
                    ]
                );
            }


            $statuses = [];
            foreach (ProductStock::STATUSES as $status) {
                $statuses['app.ui.' . $status] = $status;
            }
            $event->getForm()->remove('stockStatus');
            $event->getForm()->add('stockStatus', ChoiceType::class, [
                'choices'  => $statuses,
                'required' => true,
            ]);

            $event->getForm()->remove('restockDate');
            $event->getForm()->add('restockDate', DateTimeType::class, [
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
                'required' => false,
            ]);

        });
    }

    public static function getExtendedTypes(): iterable
    {
        return [DefaultResourceType::class];
    }
}
