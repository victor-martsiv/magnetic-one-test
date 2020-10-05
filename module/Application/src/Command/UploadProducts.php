<?php

namespace Application\Command;

use Application\Service\ProductManager;
use Laminas\Config\Exception\InvalidArgumentException;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\LaminasConfigProvider;
use PHPShopify\ShopifySDK;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class UploadProducts extends Command
{
    public ProductManager $productManager;

    private ShopifySDK $shopifySDK;

    public function __construct(ProductManager $productManager)
    {
        parent::__construct();

        $aggregator  = new ConfigAggregator([
            new LaminasConfigProvider('config/autoload/development.local.php'),
        ]);
        $localConfig = $aggregator->getMergedConfig();
        foreach ($localConfig['shopify_api'] as $key => $value) {
            if (empty($localConfig['shopify_api'][$key])
                && in_array($key, ['ShopUrl', 'ApiKey', 'Password'])
            ) {
                throw new  InvalidArgumentException('Invalid shopify API config. Set field: '.$key);
            }
        }

        $this->shopifySDK     = ShopifySDK::config($localConfig['shopify_api']);
        $this->productManager = $productManager;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $shopifyProducts = $this->shopifySDK->Product->get();
        $progressBar     = new ProgressBar($output);
        $progressBar->start(count($shopifyProducts));
        foreach ($shopifyProducts as $item) {
            $item['collections'] = $this->shopifySDK->CustomCollection->get([
                'product_id' => $item['id'],
            ]);
            $this->productManager->createOrUpdate($item);
            $progressBar->advance();
        }
        $progressBar->finish();

        return Command::SUCCESS;
    }

}
