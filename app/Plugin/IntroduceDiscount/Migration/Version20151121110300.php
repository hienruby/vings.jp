<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20151121110300 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $table1 = $schema->createTable("plg_affiliate_settings");
        $table1->addColumn('id',                                    'integer',  array('autoincrement' => true));
        $table1->addColumn('introduce_conversion_discount_rate',    'integer',  array('notnull' => false, 'default' => 20));
        $table1->addColumn('meet_conversion_discount_rate',         'integer',  array('notnull' => false, 'default' => 20));
        $table1->setPrimaryKey(array('id'));

        $table2 = $schema->createTable("plg_affiliate_histories");
        $table2->addColumn('id',                                'integer',  array('autoincrement' => true));
        $table2->addColumn('introduce_customer_id',             'integer');
        $table2->addColumn('meet_customer_id',                  'integer',  array('notnull' => false));
        $table2->addColumn('order_id',                          'integer');
        $table2->addColumn('create_date',                       'datetime');
        $table2->addColumn('conversion_date',                   'datetime', array('notnull' => false));
        $table2->setPrimaryKey(array('id'));
        $table2->addIndex(array('introduce_customer_id'));
        $table2->addIndex(array('meet_customer_id'));
        $table2->addIndex(array('order_id'));

        $table3 = $schema->createTable("plg_affiliate_discount_tickets");
        $table3->addColumn('id',                                'integer',  array('autoincrement' => true));
        $table3->addColumn('customer_id',                       'integer');
        $table3->addColumn('used_order_id',                     'integer',  array('notnull' => false, 'default' => null));
        $table3->addColumn('del_flg',                           'smallint', array('notnull' => true, 'unsigned' => false, 'default' => 0));
        $table3->addColumn('create_date',                       'datetime');
        $table3->addColumn('used_date',                         'datetime',  array('notnull' => false, 'default' => null));
        $table3->setPrimaryKey(array('id'));
        $table3->addIndex(array('customer_id'));
        $table3->addIndex(array('used_order_id'));

    }

    public function down(Schema $schema)
    {
        $schema->dropTable('plg_affiliate_settings');
        $schema->dropTable('plg_affiliate_histories');
        $schema->dropTable('plg_affiliate_discount_tickets');


        $schema->dropSequence('plg_affiliate_settings_id_seq');
        $schema->dropSequence('plg_affiliate_histories_id_seq');
        $schema->dropSequence('plg_affiliate_discount_tickets_id_seq');
    }

}