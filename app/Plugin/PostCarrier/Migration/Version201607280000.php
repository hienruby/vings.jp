<?php
/*
* This file is part of the PostCarrier
*
* Copyright(c) 2016 IPLOGIC CO.,LTD. All Rights Reserved.
* http://www.iplogic.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version201607280000 extends AbstractMigration
{

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        if (!$this->tableExist("plg_postcarrier_plugin")) {
            $this->createPlgMailMagazinePlugin($schema);
        }

        if (!$this->tableExist("plg_postcarrier_customer")) {
            $this->createPlgMailmagaCustomer($schema);
        }

        if (!$this->tableExist("plg_postcarrier_csv_customer_group")) {
            $this->createPlgPostCarrierCsvCustomerGroup($schema);
        }

        if (!$this->tableExist("plg_postcarrier_csv_customer")) {
            $this->createPlgPostCarrierCsvCustomer($schema);
        }
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // データ保護の観点から、削除はしない。

        /*
        $schema->dropTable('plg_postcarrier_plugin');

        $schema->dropTable('plg_postcarrier_customer');
        $schema->dropSequence('plg_postcarrier_customer_id_seq');

        $schema->dropTable('plg_postcarrier_csv_customer_group');
        $schema->dropTable('plg_postcarrier_csv_customer');
        $schema->dropSequence('plg_postcarrier_csv_customer_group_group_id_seq');
        $schema->dropSequence('plg_postcarrier_csv_customer_customer_id_seq');

        $this->connection->executeUpdate("DROP INDEX index_postcarrier__dtb_customer__email ON dtb_customer;");
        $this->connection->executeUpdate("DROP INDEX index_postcarrier__plg_postcarrier_csv_customer__email ON plg_postcarrier_csv_customer;");

        $this->connection->executeUpdate("DELETE FROM dtb_page_layout WHERE url = 'plg_postcarrier_mailmaga_subscribe' OR url = 'plg_postcarrier_mailmaga_unsubscribe';");
        */
    }

    public function postUp(Schema $schema)
    {
        $insert_from = '';
        $index_sql1 = "CREATE INDEX index_postcarrier__dtb_customer__email ON dtb_customer(email);";
        $index_sql2 = "CREATE INDEX index_postcarrier__plg_postcarrier_csv_customer__email ON plg_postcarrier_csv_customer(email);";
        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $insert_from = 'FROM dual';
            $index_sql1 = "CREATE INDEX index_postcarrier__dtb_customer__email ON dtb_customer(email(255));";
            $index_sql2 = "CREATE INDEX index_postcarrier__plg_postcarrier_csv_customer__email ON plg_postcarrier_csv_customer(email(255));";
        }

        // postgresでは、group_id=1を指定するとシーケンスが更新されないので、明示的には指定しない。
        $insert = "INSERT INTO plg_postcarrier_csv_customer_group (group_name, del_flg, create_date, update_date) SELECT 'メールアドレスのみ会員グループ', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP $insert_from WHERE NOT EXISTS (SELECT * FROM plg_postcarrier_csv_customer_group WHERE group_id = 1);";
        $this->connection->executeUpdate($insert);

        if (!$this->indeNameExist('dtb_customer', 'index_postcarrier__dtb_customer__email')) {
            $this->connection->executeUpdate($index_sql1);
        }
        if (!$this->indeNameExist('plg_postcarrier_csv_customer', 'index_postcarrier__plg_postcarrier_csv_customer__email')) {
            $this->connection->executeUpdate($index_sql2);
        }

        $id = $this->connection->fetchColumn("SELECT MAX(page_id) max_page_id FROM dtb_page_layout");

        $id++;
        $page1 = "INSERT INTO dtb_page_layout (device_type_id, page_id, page_name, url, file_name, edit_flg, author, description, keyword, update_url, create_date, update_date, meta_robots) SELECT 10, $id, 'メルマガ会員登録完了ページ', 'plg_postcarrier_mailmaga_subscribe', 'plg_postcarrier_mailmaga_subscribe', 0, NULL, NULL, NULL, NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL $insert_from WHERE NOT EXISTS (SELECT * FROM dtb_page_layout WHERE url = 'plg_postcarrier_mailmaga_subscribe');";
        $this->connection->executeUpdate($page1);

        $id++;
        $page2 = "INSERT INTO dtb_page_layout (device_type_id, page_id, page_name, url, file_name, edit_flg, author, description, keyword, update_url, create_date, update_date, meta_robots) SELECT 10, $id, 'メルマガ会員解除完了ページ', 'plg_postcarrier_mailmaga_unsubscribe', 'plg_postcarrier_mailmaga_unsubscribe', 0, NULL, NULL, NULL, NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL $insert_from WHERE NOT EXISTS (SELECT * FROM dtb_page_layout WHERE url = 'plg_postcarrier_mailmaga_unsubscribe');";
        $this->connection->executeUpdate($page2);
    }

    protected function createPlgMailMagazinePlugin(Schema $schema)
    {
        $table = $schema->createTable("plg_postcarrier_plugin");
        $table->addColumn('plugin_id', 'integer', array(
            'autoincrement' => true,
        ));

        $table->addColumn('plugin_code', 'text', array(
            'notnull' => true,
        ));

        $table->addColumn('plugin_name', 'text', array(
            'notnull' => true,
        ));

        $table->addColumn('sub_data', 'text', array(
            'notnull' => false,
        ));

        $table->addColumn('auto_update_flg', 'smallint', array(
            'notnull' => true,
            'unsigned' => false,
            'default' => 0,
        ));

        $table->addColumn('del_flg', 'smallint', array(
            'notnull' => true,
            'unsigned' => false,
            'default' => 0,
        ));

        $table->addColumn('create_date', 'datetime', array(
            'notnull' => true,
            'unsigned' => false,
        ));

        $table->addColumn('update_date', 'datetime', array(
            'notnull' => true,
            'unsigned' => false,
        ));

        $table->setPrimaryKey(array('plugin_id'));
    }

    /***
     * plg_postcarrier_customerテーブルの作成
     *
     * CREATE SEQUENCE plg_postcarrier_customer_id_seq;
     * CREATE TABLE plg_postcarrier_customer (
     *   id integer DEFAULT nextval('plg_postcarrier_customer_id_seq'::regclass) NOT NULL PRIMARY KEY,
     *   customer_id integer NOT NULL,
     *   mailmag_flg smallint DEFAULT 0 NOT NULL,
     *   del_flg smallint DEFAULT 0 NOT NULL,
     *   create_date timestamp(0) without time zone NOT NULL,
     *   update_date timestamp(0) without time zone NOT NULL
     *);
     *
     * @param Schema $schema
     */
    protected function createPlgMailmagaCustomer(Schema $schema)
    {
        $table = $schema->createTable("plg_postcarrier_customer");
        $table->addColumn('id', 'integer', array(
            'autoincrement' => true,
        ));

        $table->addColumn('customer_id', 'integer', array(
            'notnull' => true,
        ));

        $table->addColumn('mailmaga_flg', 'smallint', array(
            'notnull' => true,
            'unsigned' => false,
            'default' => 0,
        ));

        $table->addColumn('del_flg', 'smallint', array(
            'notnull' => true,
            'unsigned' => false,
            'default' => 0,
        ));

        $table->addColumn('create_date', 'datetime', array(
            'notnull' => true,
            'unsigned' => false,
        ));

        $table->addColumn('update_date', 'datetime', array(
            'notnull' => true,
            'unsigned' => false,
        ));

        $table->setPrimaryKey(array('id'));
    }

    protected function createPlgPostCarrierCsvCustomerGroup(Schema $schema)
    {
        $table = $schema->createTable("plg_postcarrier_csv_customer_group");
        $table->addColumn('group_id', 'integer', array(
            'autoincrement' => true,
        ));

        $table->addColumn('group_name', 'text', array(
            'notnull' => true,
        ));

        $table->addColumn('del_flg', 'smallint', array(
            'notnull' => true,
            'unsigned' => false,
            'default' => 0,
        ));

        $table->addColumn('create_date', 'datetime', array(
            'notnull' => true,
            'unsigned' => false,
        ));

        $table->addColumn('update_date', 'datetime', array(
            'notnull' => true,
            'unsigned' => false,
        ));

        $table->setPrimaryKey(array('group_id'));
    }

    /**
     * plg_send_customerテーブルの作成
     * @param Schema $schema
     */
    protected function createPlgPostCarrierCsvCustomer(Schema $schema) {
        $table = $schema->createTable("plg_postcarrier_csv_customer");
        $table->addColumn('customer_id', 'integer', array(
            'autoincrement' => true,
        ));
        $table->addColumn('group_id', 'integer', array(
            'notnull' => true,
        ));
        $table->addColumn('email', 'text', array(
            'notnull' => true,
        ));
        $table->addColumn('memo01', 'text', array(
        ));
        $table->addColumn('memo02', 'text', array(
        ));
        $table->addColumn('memo03', 'text', array(
        ));
        $table->addColumn('memo04', 'text', array(
        ));
        $table->addColumn('memo05', 'text', array(
        ));
        $table->addColumn('memo06', 'text', array(
        ));
        $table->addColumn('memo07', 'text', array(
        ));
        $table->addColumn('memo08', 'text', array(
        ));
        $table->addColumn('memo09', 'text', array(
        ));
        $table->addColumn('memo10', 'text', array(
        ));
        $table->addColumn('status', 'smallint', array(
            'notnull' => true,
            'default' => 2,
        ));
        $table->addColumn('secret_key', 'text', array(
            'notnull' => false,
        ));
        $table->addColumn('create_date', 'datetime', array(
            'notnull' => true,
            'unsigned' => false,
        ));
        $table->addColumn('update_date', 'datetime', array(
            'notnull' => true,
            'unsigned' => false,
        ));
        $table->setPrimaryKey(array('customer_id'));

        $table->addIndex(
            array('group_id')
        );
    }

    private function tableExist($tableName) {
        return $this->connection->getSchemaManager()->tablesExist(array($tableName));
    }

    private function indexExist($tableName, $columns) {
        $indexes = $this->connection->getSchemaManager()->listTableIndexes($tableName);
        foreach ($indexes as $index) {
            $i = 0;
            foreach ($columns as $column) {
                if (!$index->hasColumnAtPosition($column, $i++)) {
                    return false;
                }
            }
        }
        return true;
    }

    private function indeNameExist($tableName, $indexName) {
        $indexes = $this->connection->getSchemaManager()->listTableIndexes($tableName);
        foreach ($indexes as $index) {
            if ($index->getName() == $indexName) {
                return true;
            }
        }
        return false;
    }
}
