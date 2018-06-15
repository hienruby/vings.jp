<?php
/*
* Plugin Name : GSFeed
*
* Copyright (C) BraTech Co., Ltd. All Rights Reserved.
* http://www.bratech.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20151212 extends AbstractMigration
{

    public function up(Schema $schema)
    {
        $this->createPlgGSFeedConfig($schema);
    }

    public function postUp(Schema $schema)
    {

        $app = new \Eccube\Application();
        $app->boot();

        $this->connection->insert("plg_gsfeed_dtb_config", array('id' => 1, 'brand' => '', 'gcategory' => ''));
    }

    public function down(Schema $schema)
    {
        $this->dropPlgGSFeedConfig($schema);
    }

    protected function createPlgGSFeedConfig(Schema $schema)
    {
        if ($schema->hasTable("plg_gsfeed_dtb_config")) {
            return true;
        }
        $table = $schema->createTable("plg_gsfeed_dtb_config");

        $table->addColumn('id', 'integer', array(
            'notnull' => true,
        ));

        $table->addColumn('brand', 'text', array(
            'notnull' => false,
        ));

        $table->addColumn('gcategory', 'text', array(
            'notnull' => false,
        ));
    }

    protected function dropPlgGSFeedConfig(Schema $schema)
    {
        if (!$schema->hasTable("plg_gsfeed_dtb_config")) {
            return true;
        }
        $schema->dropTable('plg_gsfeed_dtb_config');
    }
}
