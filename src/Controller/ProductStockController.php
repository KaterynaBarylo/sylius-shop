<?php

namespace App\Controller;

use App\Entity\Product\ProductStock;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Component\Resource\Exception\UpdateHandlingException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductStockController extends ResourceController
{
    public function toExpectedAction(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        /** @var ProductStock $productStock */
        $productStock = $this->findOr404($configuration);

        $productStock->setStockStatus(ProductStock::STATUS_EXPECTED);
        $productStock->setRestockDate(new \DateTime('+2 weeks'));
        try {
            $this->resourceUpdateHandler->handle($productStock, $configuration, $this->manager);
        } catch (UpdateHandlingException $exception) {
            $this->flashHelper->addErrorFlash($configuration, $exception->getFlash());

            return $this->redirectHandler->redirectToReferer($configuration);
        }

        return $this->redirectHandler->redirectToReferer($configuration);
    }
}
