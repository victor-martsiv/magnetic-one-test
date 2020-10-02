<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201002210041 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create a default tables';
    }

    public function up(Schema $schema): void
    {
        /**
         * Table products
         */
        $products = $schema->createTable('products');
        $products->addColumn('id', 'integer', [
            'autoincrement' => true,
        ]);
        $products->addColumn('name', 'string', [
            'notnull' => true,
            'length'  => 255,
        ]);
        $products->addColumn('description', 'text', [
            'notnull' => true,
        ]);
        $products->addColumn('prise', 'string', [
            'notnull' => true,
            'length'  => 255,
        ]);
        $products->addColumn('photo', 'string', [
            'notnull' => true,
            'default' => '',
            'length'  => 255,
        ]);
        $products->addColumn('sku', 'string', [
            'notnull' => true,
            'length'  => 255,
        ]);
        $products->addColumn('quantity', 'integer', [
            'notnull' => true,
        ]);
        $products->setPrimaryKey(['id']);
        $products->addOption('engine', 'InnoDB');

        /**
         * Table collections
         */
        $collections = $schema->createTable('collections');
        $collections->addColumn('id', 'integer', [
            'autoincrement' => true,
        ]);
        $collections->addColumn('name', 'string', [
            'notnull' => true,
            'length'  => 255,
        ]);
        $collections->setPrimaryKey(['id']);
        $collections->addOption('engine', 'InnoDB');

        /**
         * Table product_collection
         */
        $product_collection = $schema->createTable('product_collection');
        $product_collection->addColumn('id', 'integer', [
            'autoincrement' => true,
        ]);
        $product_collection->addColumn('product_id', 'integer', [
            'notnull' => true,
        ]);
        $product_collection->addColumn('collection_id', 'integer', [
            'notnull' => true,
        ]);
        $product_collection->setPrimaryKey(['id']);
        $product_collection->addOption('engine', 'InnoDB');

    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('products');
        $schema->dropTable('collections');
        $schema->dropTable('product_collection');

    }
}
