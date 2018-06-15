<?php
/*
* Plugin Name : SiteMap
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

class Version20151207 extends AbstractMigration
{

    public function up(Schema $schema)
    {
        $this->createPlgSiteMapConfig($schema);
    }

    public function postUp(Schema $schema)
    {

        $app = new \Eccube\Application();
        $app->boot();

        $this->connection->insert("plg_sitemap_dtb_config",  array("id" => 1, "changefreq" => "weekly", "priority" => "0.5"));
    }

    public function down(Schema $schema)
    {
        $this->dropPlgSiteMapConfig($schema);
    }

    protected function createPlgSiteMapConfig(Schema $schema)
    {
        if ($schema->hasTable("plg_sitemap_dtb_config")) {
            return true;
        }
        $table = $schema->createTable("plg_sitemap_dtb_config");

        $table->addColumn('id', 'integer', array(
            'notnull' => true,
        ));

        $table->addColumn('changefreq', 'text', array(
            'notnull' => false,
        ));

        $table->addColumn('priority', 'text', array(
            'notnull' => false,
        ));
    }

    protected function dropPlgSiteMapConfig(Schema $schema)
    {
        if (!$schema->hasTable("plg_sitemap_dtb_config")) {
            return true;
        }
        $schema->dropTable('plg_sitemap_dtb_config');
    }
}
