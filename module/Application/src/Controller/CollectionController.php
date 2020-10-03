<?php


namespace Application\Controller;


use Application\Model\Collection;
use Doctrine\ORM\EntityManager;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class CollectionController extends AbstractActionController
{
    protected EntityManager $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function viewAction()
    {
        $collectionId = $this->params()->fromRoute('id');
        $collection   = $this->em->getRepository(Collection::class)->findOneBy(['id' => $collectionId]);
        if ($collection === null) {
            return $this->getResponse()->setStatusCode(404);
        }
        $collections = $this->em->getRepository(Collection::class)->findAll();

        return new ViewModel([
            'collection'  => $collection,
            'collections' => $collections,
        ]);
    }

}
