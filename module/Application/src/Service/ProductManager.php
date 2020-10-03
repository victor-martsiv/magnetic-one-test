<?php


namespace Application\Service;


use Application\Model\Collection;
use Application\Model\Product;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Laminas\Filter\StaticFilter;

class ProductManager
{
    private EntityManager $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function createOrUpdate(array $data): void
    {
        $product = $this->em->getRepository(Product::class)->findOneBy(['shopifyProductId' => $data['id']]);
        if ($product === null) {
            $product = new Product();
        }

        $product->setShopifyProductId($data['id']);
        $product->setTitle($data['title'] ?? '');
        $product->setDescription(StaticFilter::execute($data['body_html'] ?? '', 'HtmlEntities'));
        $product->setPhoto($data['image']['src'] ?? '');
        $product->setPrise($data['variants'][0]['price'] ?? '');
        $product->setQuantity($data['variants'][0]['inventory_quantity'] ?? '');
        $product->setSku($data['variants'][0]['sku'] ?? '');

        try {
            $this->em->persist($product);
            $this->addProductCollections($data['collections'] ?? [], $product);
            $this->em->flush();
        } catch (ORMException $e) {
            throw new \RuntimeException($e->getMessage(), $e->getCode());
        }

    }

    private function addProductCollections(array $collections, Product $product): void
    {
        $collectionsProduct = $product->getCollections();
        foreach ($collectionsProduct as $item) {
            $product->removeCollectionAssociation($item);
        }

        foreach ($collections as $item) {

            $title = StaticFilter::execute($item['title'], 'StringTrim');
            if (empty($title)) {
                continue;
            }

            $collection = $this->em->getRepository(Collection::class)->findOneBy(['title' => $title]);
            if ($collection === null) {
                $collection = new Collection();
            }
            $collection->setTitle($title);
            $collection->setPhoto($item['image']['src']);
            $collection->addProduct($product);

            try {
                $this->em->persist($collection);
                $product->addCollection($collection);
            } catch (ORMException $e) {
                throw new \RuntimeException($e->getMessage());
            }
        }
    }
}
