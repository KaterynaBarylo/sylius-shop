<?php

namespace App\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{
    public function addAdminMenuItems(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        $menu
            ->getChild('catalog')
            ->addChild('product_stock', ['route' => 'app_admin_product_stock_index'])
            ->setLabel('app.ui.product_stock')
            ->setLabelAttribute('icon', 'list layout')
        ;
    }
}
