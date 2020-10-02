<?php


namespace Application\Model\Table;


use Application\Model\Entry\Product;
use Laminas\Db\TableGateway\TableGatewayInterface;
use RuntimeException;

class ProductTable
{
    private TableGatewayInterface $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function saveProduct(Product $product): void
    {
        $data = [
            'name'        => $product->getId(),
            'description' => $product->getDescription(),
            'prise'       => $product->getPrise(),
            'photo'       => $product->getPhoto(),
            'sku'         => $product->getSku(),
            'quantity'    => $product->getQuantity(),
        ];

        if ($product->getId() === 0) {
            $this->tableGateway->insert($data);

            return;
        }

        try {
            $this->getAlbum($product->getId());
        } catch (RuntimeException $e) {
            throw new RuntimeException("Cannot update product with identifier {$product->getId()}; does not exist");
        }

        $this->tableGateway->update($data, ['id' => $product->getId()]);
    }

    public function getAlbum(int $id)
    {
        $result = $this->tableGateway->select(['id' => $id]);
        $row    = $result->current();
        if ( ! $row) {
            throw new RuntimeException(sprintf('Could not find row with identifier %d', $id));
        }

        return $row;
    }

    public function deleteProduct(int $id): void
    {
        $this->tableGateway->delete(['id' => $id]);
    }
}
