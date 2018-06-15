<?php

/*
 * This file is part of the ProductBanner
 *
 * Copyright (C) 2017 ONE HAND RED
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
class Version20170719223429 extends AbstractMigration
{

    const NAME = 'plg_product_meta';

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        if ($schema->hasTable(self::NAME)) {
            return true;
        }
        $this->createPluginTable($schema);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needsa
        if (!$schema->hasTable(self::NAME)) {
            return true;
        }
        $schema->dropTable(self::NAME);
    }

    protected function createPluginTable(Schema $schema)
    {
        $table = $schema->createTable(self::NAME);
        $table->addColumn('product_id', 'integer');
        $table->addColumn('author', 'text', array('notnull' => false));
        $table->addColumn('description', 'text', array('notnull' => false));
        $table->addColumn('keyword', 'text', array('notnull' => false));
        $table->addColumn('meta_robots', 'text', array('notnull' => false));
        $table->addColumn('meta_tags', 'text', array('notnull' => false));
        $table->setPrimaryKey(array('product_id'));
    }
}