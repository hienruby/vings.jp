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
class Version201611150000 extends AbstractMigration
{

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // do nothing.
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // データ保護の観点から、追加ページのみ削除する。
        $this->connection->executeUpdate("DELETE FROM dtb_page_layout WHERE url = 'plg_postcarrier_mailmaga_subscribe' OR url = 'plg_postcarrier_mailmaga_unsubscribe';");
    }

    public function postUp(Schema $schema)
    {
        // do nothing.
    }
}
