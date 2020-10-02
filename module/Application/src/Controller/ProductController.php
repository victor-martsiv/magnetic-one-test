<?php


namespace Application\Controller;


use Application\Model\Table\ProductTable;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class ProductController extends AbstractActionController
{
    private ProductTable $table;

    public function __construct(ProductTable $table)
    {
        $this->table = $table;
    }

    public function indexAction(): ViewModel
    {
        return new ViewModel([
            'products' => $this->table->fetchAll(),
        ]);
    }
}
