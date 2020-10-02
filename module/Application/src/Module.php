<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Application;

use Application\Model\Entry\Product;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\ServiceManager\ServiceManager;

class Module implements ConfigProviderInterface
{
    public function getConfig(): array
    {
        return include __DIR__.'/../config/module.config.php';
    }

    public function getServiceConfig(): array
    {
        return [
            'factories' => [
                Model\Table\ProductTable::class        => function (ServiceManager $container) {
                    $tableGateway = $container->get(Model\Table\ProductTableGateway::class);

                    return new Model\Table\ProductTable($tableGateway);
                },
                Model\Table\ProductTableGateway::class => function ($container) {
                    $dbAdapter          = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Product());

                    return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
                },

            ],
        ];
    }

    public function getControllerConfig(): array
    {
        return [
            'factories' => [
                Controller\ProductController::class => function ($container) {
                    return new Controller\ProductController($container->get(Model\Table\ProductTable::class));
                },
            ],
        ];
    }
}
