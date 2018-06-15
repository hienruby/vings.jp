<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20160505173100 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->createPluginTable($schema);
    }

    public function down(Schema $schema)
    {
        $schema->dropTable('plg_cart_analytics');
    }

    protected function createPluginTable(Schema $schema)
    {
        $table = $schema->createTable("plg_cart_analytics");
        $table->addColumn('cart_analytics_id', 'string', array('notnull' => true, 'length' => 32));
        $table->addColumn('product_id', 'integer', array('notnull' => true, 'unsigned' => true));
        $table->addColumn('product_class_id', 'integer', array('notnull' => true, 'unsigned' => true));
        $table->addColumn('quantity', 'decimal', array('notnull' => true, 'precision' => 10, 'scale' => 0));
        $table->addColumn('price', 'decimal', array('notnull' => true, 'precision' => 10, 'scale' => 0));
        $table->addColumn('buy_flg', 'smallint', array('notnull' => true, 'unsigned' => true, 'default' => 0));
        $table->addColumn('add_date', 'date', array('notnull' => true));
        $table->addColumn('create_date', 'datetime', array('notnull' => true));
        $table->addColumn('update_date', 'datetime', array('notnull' => true));
        $table->setPrimaryKey(array('cart_analytics_id', 'product_class_id'));
    }
}