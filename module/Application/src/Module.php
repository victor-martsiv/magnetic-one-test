<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Application;

use Doctrine\ORM\EntityManager;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig(): array
    {
        return include __DIR__.'/../config/module.config.php';
    }

    public function getControllerConfig(): array
    {
        return [
            'factories' => [
                Controller\IndexController::class      => function ($container) {
                    return new Controller\IndexController($container->get(EntityManager::class));
                },
                Controller\ProductController::class    => function ($container) {
                    return new Controller\ProductController($container->get(EntityManager::class));
                },
                Controller\CollectionController::class => function ($container) {
                    return new Controller\CollectionController($container->get(EntityManager::class));
                },
            ],
        ];
    }
}
