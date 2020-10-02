<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201002211323 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adds indexes and foreign key constraints';
    }

    public function up(Schema $schema): void
    {
        $product_collection = $schema->getTable('product_collection');
        $product_collection->addIndex(['product_id'], 'product_id_index');
        $product_collection->addIndex(['collection_id'], 'collection_id_index');
        $product_collection->addForeignKeyConstraint('products', ['product_id'], ['id'], [],
            'product_collection_product_id_fk');
        $product_collection->addForeignKeyConstraint('collections', ['collection_id'], ['id'], [],
            'product_collection_collection_id_fk');

    }

    public function down(Schema $schema): void
    {
        $product_collection = $schema->getTable('product_collection');
        $product_collection->removeForeignKey('product_collection_product_id_fk');
        $product_collection->removeForeignKey('product_collection_collection_id_fk');
        $product_collection->dropIndex('product_id_index');
        $product_collection->dropIndex('collection_id_index');
    }
}
