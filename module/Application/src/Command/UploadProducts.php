<?php


namespace Application\Command;

use Application\Service\ProductManager;
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

        $this->shopifySDK     = ShopifySDK::config([
            'ShopUrl'  => 'api2cartvictor.myshopify.com',
            'ApiKey'   => 'cae8384e7562704ae379c32fdb6bed68',
            'Password' => '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',
        ]);
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
