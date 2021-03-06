<?php


namespace Application\Controller;


use Application\Model\Collection;
use Application\Model\Product;
use Doctrine\ORM\EntityManager;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class ProductController extends AbstractActionController
{
    protected EntityManager $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function viewAction()
    {
        $productId = $this->params()->fromRoute('id');
        $product   = $this->em->getRepository(Product::class)->findOneBy(['id' => $productId]);
        if ($product === null) {
            return $this->getResponse()->setStatusCode(404);
        }
        $collections = $this->em->getRepository(Collection::class)->findAll();

        return new ViewModel([
            'product'     => $product,
            'collections' => $collections,
        ]);
    }

}
