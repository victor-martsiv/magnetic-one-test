<?php


namespace Application\Controller;


use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class ProductController extends AbstractActionController
{

    public function indexAction(): ViewModel
    {
        return new ViewModel([
            'products' => null,
        ]);
    }
}
