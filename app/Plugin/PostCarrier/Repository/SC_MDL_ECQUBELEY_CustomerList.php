<?php
/*
 * This file is part of the PostCarrier
 *
 * Copyright(c) 2010-2013 IPLOGIC CO.,LTD. All Rights Reserved.
 *
 * http://www.iplogic.co.jp/
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

namespace Plugin\PostCarrier\Repository;

use Eccube\Util\Str;
use Plugin\PostCarrier\Util\PostCarrierUtil;

/*  [名称] SC_MDL_ECQUBELEY_CustomerList
 *  [概要] 会員検索用クラス
 */
class SC_MDL_ECQUBELEY_CustomerList extends SC_SelectSql {

    private $app;

    function __construct($array, $eventWhereKbn=0, $eventCondition="", $app=null) {
        parent::__construct($array);

        $this->app = $app;
        $searchData = $array;

        //$app['monolog.PostCarrier']->info("searchData=".print_r($searchData,true));

        $arrMobileDomain = \Plugin\PostCarrier\Service\LC_MDL_ECQUBELEY_CONSTANTS::getMobileDomains();

        $db_type = str_replace('pdo_', '', $app['config']['database']['driver']);

        //SQL各条件
        $dtb_order_where = array();
        $dtb_order_val = array();
        $dtb_order_having = array();
        $dtb_order_having_val = array();
        $dtb_order_having_buy = array();
        $dtb_order_having_buy_val = array();
        $join_dtb_order_detail_flag = false;
        $join_dtb_product_categories_flag = false;
        $where_order_status_flag = false;
        $dtb_order_event_where_predicate = "";
        $dtb_order_event_having_predicate = "";
        $dtb_order_event_where = array();
        $dtb_order_event_where_val = array();

        //イベント区分に応じて各種条件を付与する。
        if ($eventWhereKbn == 1) {
            $this->setWhere($eventCondition);
        } else if ($eventWhereKbn == 2 || $eventWhereKbn == 3) {
            if ($db_type === 'pgsql') {
                $eventCondition = "BOOL_OR($eventCondition)";
            } else if ($db_type === 'mysql') {
                $eventCondition = "SUM(CASE WHEN $eventCondition THEN 1 ELSE 0 END) > 0";
            }
            $dtb_order_event_having_predicate = $eventCondition;
        } else if ($eventWhereKbn == 4) {
            $dtb_order_event_having_predicate = $eventCondition;
        }

        $this->setWhere("c.del_flg = 0");
        $this->setWhere("c.status = 2"); // 本会員のみ

        // 配信メールアドレス種別
        $mb_domain_sql = $this->getMobileDomainSQL($arrMobileDomain);
        $mb_domain_sql_mb = $this->getMobileDomainSQL($arrMobileDomain, 'c.email_mobile');
        if (isset($this->arrSql['mail_type'])) {
            switch ($this->arrSql['mail_type']) {
            // PCメールアドレス
            case 1:
                // 携帯ドメインでない または スマートフォン
                //$this->setWhere("(NOT ($mb_domain_sql) OR EXISTS (SELECT * FROM plg_postcarrier_smartphone sp WHERE sp.email = c.email))");
                break;
            // 携帯メールアドレス
            case 2:
                // 携帯ドメイン かつ スマートフォンでない
                //$this->setWhere("($mb_domain_sql)");
                //$this->setWhere("(NOT EXISTS (SELECT * FROM plg_postcarrier_smartphone sp WHERE sp.email = c.email))");
                break;
            // 全メールアドレス
            case 5:
                // 宛先ドメインは無条件に抽出する。
                break;
            }
        }

        //[顧客情報項目]

        // status
        if (!empty($searchData['customer_status']) && $searchData['customer_status']) {
            // メルマガ希望でない全ての本会員に送信する
            $this->setJoin(" LEFT JOIN plg_postcarrier_customer m ON c.customer_id = m.customer_id ");

            // 配信形式
            if (isset($searchData['htmlmail']) && Str::isNotBlank($searchData['htmlmail'])) {
                if ($searchData['htmlmail'] == 1) {
                    // HTML希望に、メルマガ希望の情報がない・希望しない人含める
                    $this->setWhere("(m.mailmaga_flg = 1 OR m.mailmaga_flg IS NULL OR m.mailmaga_flg = 3)");
                } else if ($searchData['htmlmail'] == 2) {
                    // テキスト希望は厳密に希望者に送信する
                    $this->setWhere("m.mailmaga_flg = 2");
                }
            } else {
                // 無条件に全員に送信なので、デフォルトではmailmaga_flgを検査しない。
            }
        } else {
            $this->setJoin(" JOIN plg_postcarrier_customer m ON c.customer_id = m.customer_id ");

            // 配信形式
            if (isset($searchData['htmlmail']) && Str::isNotBlank($searchData['htmlmail'])) {
                if ($searchData['htmlmail'] == 1) {
                    $this->setWhere("m.mailmaga_flg = 1");
                } else if ($searchData['htmlmail'] == 2) {
                    $this->setWhere("m.mailmaga_flg = 2");
                }
            } else {
                $this->setWhere("(m.mailmaga_flg = 1 OR m.mailmaga_flg = 2)");
            }
        }

        // 顧客ID
        if (!empty($searchData['customer_id']) && $searchData['customer_id']) {
            $tmpWhere = $this->setPluralParam($this->arrVal, $searchData['customer_id'], "c.customer_id");
            if ($tmpWhere) $this->setWhere($tmpWhere);
        }

        //　都道府県
        if (!empty($this->arrSql['pref']) && $this->arrSql['pref']) {
            $this->setWhere("c.pref = ?");
            $this->arrVal[] = is_object($this->arrSql['pref']) ? $this->arrSql['pref']->getId() : $this->arrSql['pref'];
        }

        // 顧客名
        if (isset($searchData['name']) && Str::isNotBlank($searchData['name'])) {
            if ($db_type == "pgsql") {
                $column = "(c.name01 || c.name02) LIKE ?";
            } elseif ($db_type == "mysql") {
                $column = "concat(c.name01,c.name02) LIKE ?";
            }

            $tmpWhere = $this->setPluralParam($this->arrVal, $searchData['name'], $column, false, true);
            if ($tmpWhere) $this->setWhere($tmpWhere);
        }

        //　名前（カナ）
        if (isset($searchData['kana']) && Str::isNotBlank($searchData['kana'])) {
            if ($db_type == "pgsql") {
                $column = "(c.kana01 || c.kana02 LIKE ?)";
            } elseif ($db_type == "mysql") {
                $column = "concat(c.kana01,c.kana02) LIKE ?";
            }

            $tmpWhere = $this->setPluralParam($this->arrVal, $searchData['kana'], $column, false, true);
            if ($tmpWhere) $this->setWhere($tmpWhere);
        }

        //性別
        if (!empty($searchData['sex']) && count($searchData['sex']) > 0) {
            $this->setItemTerm($this->arrSql['sex'], "c.sex");
            foreach ($searchData['sex'] as $val) {
                $this->arrVal[] = is_object($val) ? $val->getId() : $val;
            }
        }

        // 誕生月の検索
        if (!isset($this->arrSql['birth_month'])) $this->arrSql['birth_month'] = "";
        if (is_numeric($this->arrSql["birth_month"])) {
            if ($this->arrSql["birth_month"] == 0) {
                // 今月
                $this->setWhere(" EXTRACT(month from c.birth) = EXTRACT(month from CURRENT_TIMESTAMP)");
            } else {
                $this->setWhere(" EXTRACT(month from c.birth) = ?");
                $this->arrVal[] = $this->arrSql["birth_month"];
            }
        }

        // 誕生日期間指定
        if (!empty($searchData['birth_date_start']) && $searchData['birth_date_start']) {
            $date = $searchData['birth_date_start']
                ->format('Y-m-d H:i:s');
            $this->setWhere('c.birth >= ?');
            $this->arrVal[] = $date;
        }
        if (!empty($searchData['birth_date_end']) && $searchData['birth_date_end']) {
            $date = $searchData['birth_date_end']
                ->modify('+1 days')
                ->format('Y-m-d H:i:s');
            $this->setWhere('c.birth < ?');
            $this->arrVal[] = $date;
        }

        //　E-MAIL
        if (isset($searchData['email']) && Str::isNotBlank($searchData['email'])) {
            //除外条件の場合は否定系のANDとする。
            if ($searchData['not_emailinc']) {
                $column = "c.email NOT LIKE ?";
                $andflag = true;
            } else {
                $column = "c.email LIKE ?";
                $andflag = false;
            }

            $tmpWhere = $this->setPluralParam($this->arrVal, $searchData['email'], $column, $andflag, true);
            if ($tmpWhere) $this->setWhere($tmpWhere);
        }

        //　電話番号
        if (!empty($searchData['tel']) && $searchData['tel']) {
            switch ($this->app['config']['database']['driver']) {
            case 'pdo_pgsql':
                $column = "(c.tel01 || c.tel02 || c.tel03 LIKE ?)";
                break;
            case 'pdo_mysql':
                $column = "concat(c.tel01,c.tel02,c.tel03) LIKE ?";
                break;
            default:

            }

            $tmpWhere = $this->setPluralParam($this->arrVal, $searchData['tel'], $column, false, true);
            if ($tmpWhere) $this->setWhere($tmpWhere);
        }

        // 初回購入日
        if (!empty($searchData['first_buy_start']) && $searchData['first_buy_start']) {
            $date = $searchData['first_buy_start']
                ->format('Y-m-d H:i:s');

            $dtb_order_having[] = '? <= MIN(o.create_date)';
            $dtb_order_having_val[] = $date;
        }
        if (!empty($searchData['first_buy_end']) && $searchData['first_buy_end']) {
            $date = $searchData['first_buy_end']
                ->modify('+1 days')
                ->format('Y-m-d H:i:s');

            $dtb_order_having[] = 'MIN(o.create_date) < ?';
            $dtb_order_having_val[] = $date;
        }

        // 最終購入日
        if (!empty($searchData['last_buy_start']) && $searchData['last_buy_start']) {
            $date = $searchData['last_buy_start']
                ->format('Y-m-d H:i:s');

            $dtb_order_having[] = '? <= MAX(o.create_date)';
            $dtb_order_having_val[] = $date;
        }
        if (!empty($searchData['last_buy_end']) && $searchData['last_buy_end']) {
            $date = $searchData['last_buy_end']
                ->modify('+1 days')
                ->format('Y-m-d H:i:s');

            $dtb_order_having[] = 'MAX(o.create_date) < ?';
            $dtb_order_having_val[] = $date;
        }

        // 会員登録期間
        if (!empty($searchData['create_date_start']) && $searchData['create_date_start']) {
            $date = $searchData['create_date_start']
                ->format('Y-m-d H:i:s');
            $this->setWhere('c.create_date >= ?');
            $this->arrVal[] = $date;
        }
        if (!empty($searchData['create_date_end']) && $searchData['create_date_end']) {
            $date = $searchData['create_date_end']
                ->modify('+1 days')
                ->format('Y-m-d H:i:s');
            $this->setWhere('c.create_date < ?');
            $this->arrVal[] = $date;
        }

        //[受注情報項目]

        //注文番号1
        if (!empty($searchData['order_id_start']) && $searchData['order_id_start']) {
            $dtb_order_where[] = "? <= o.order_id";
            $dtb_order_val[] = $searchData['order_id_start'];
        }

        //注文番号2
        if (!empty($searchData['order_id_end']) && $searchData['order_id_end']) {
            $dtb_order_where[] = "o.order_id <= ?";
            $dtb_order_val[] = $searchData['order_id_end'];
        }

        //対応状況
        if (!empty($searchData['status']) && $searchData['status']) {
            $dtb_order_where[] = "o.status = ?";
            $dtb_order_val[] = is_object($searchData['status']) ? $searchData['status']->getId() : $searchData['status'];
            $where_order_status_flag = true;
        }

        //購入商品ID
        if (!empty($searchData['buy_product_id']) && $searchData['buy_product_id']) {
            $data = PostCarrierUtil::toutencomma($searchData['buy_product_id']);
            $tmpArray = explode(",", $data);

            $join_dtb_order_detail_flag = true;

            $tmp_when = '';
            $tmp_when_val = 0;
            $tmp_arrval = array();
            $tmp_where = array();
            foreach ($tmpArray as $val) {
                $tmp = PostCarrierUtil::trimzen($val);
                if ($tmp == "") continue;
                $tmp_when .= " WHEN ? THEN ".$tmp_when_val++;
                $tmp_arrval[] = $tmp;
                $tmp_where[] = "d.product_id = ?";
            }

            if ($tmp_arrval) {
                if ($searchData['buy_product_id_conjunction'] == 'and' && $searchData['buy_product_id_negation'] == 1) {
                    $dtb_order_having_buy[] = "COUNT(DISTINCT CASE d.product_id $tmp_when ELSE NULL END) <> ".count($tmp_arrval);
                    $dtb_order_having_buy_val = array_merge($dtb_order_having_buy_val, $tmp_arrval);
                } else if ($searchData['buy_product_id_conjunction'] == 'and') {
                    $dtb_order_having_buy[] = "COUNT(DISTINCT CASE d.product_id $tmp_when ELSE NULL END) = ".count($tmp_arrval);
                    $dtb_order_having_buy_val = array_merge($dtb_order_having_buy_val, $tmp_arrval);
                } else if ($searchData['buy_product_id_negation'] == 1) {
                    $dtb_order_having_buy[] = "COUNT(DISTINCT CASE d.product_id $tmp_when ELSE NULL END) = 0";
                    $dtb_order_having_buy_val = array_merge($dtb_order_having_buy_val, $tmp_arrval);
                } else {
                    $dtb_order_having_buy[] = "COUNT(DISTINCT CASE d.product_id $tmp_when ELSE NULL END) <> 0";
                    $dtb_order_having_buy_val = array_merge($dtb_order_having_buy_val, $tmp_arrval);
                }
            }
        }

        //購入商品コード
        if (!empty($searchData['buy_product_code']) && $searchData['buy_product_code']) {
            $data = PostCarrierUtil::toutencomma($searchData['buy_product_code']);
            $tmpArray = explode(",", $data);

            $join_dtb_order_detail_flag = true;

            $tmp_when = '';
            $tmp_when_val = 0;
            $tmp_arrval = array();
            $tmp_where = array();
            foreach ($tmpArray as $val) {
                $tmp = PostCarrierUtil::trimzen($val);
                if ($tmp == "") continue;
                $tmp_when .= " WHEN d.product_code LIKE ? THEN ".$tmp_when_val++;
                $tmp_arrval[] = $this->addSearchStr($tmp);
                $tmp_where[] = "d.product_code LIKE ?";
            }

            if ($tmp_arrval) {
                if ($searchData['buy_product_code_conjunction'] == 'and' && $searchData['buy_product_code_negation'] == 1) {
                    $dtb_order_having_buy[] = "COUNT(DISTINCT CASE $tmp_when ELSE NULL END) <> ".count($tmp_arrval);
                    $dtb_order_having_buy_val = array_merge($dtb_order_having_buy_val, $tmp_arrval);
                } else if ($searchData['buy_product_code_conjunction'] == 'and') {
                    $dtb_order_having_buy[] = "COUNT(DISTINCT CASE $tmp_when ELSE NULL END) = ".count($tmp_arrval);
                    $dtb_order_having_buy_val = array_merge($dtb_order_having_buy_val, $tmp_arrval);
                } else if ($searchData['buy_product_code_negation'] == 1) {
                    $dtb_order_having_buy[] = "COUNT(DISTINCT CASE $tmp_when ELSE NULL END) = 0";
                    $dtb_order_having_buy_val = array_merge($dtb_order_having_buy_val, $tmp_arrval);
                } else {
                    $dtb_order_having_buy[] = "COUNT(DISTINCT CASE $tmp_when ELSE NULL END) <> 0";
                    $dtb_order_having_buy_val = array_merge($dtb_order_having_buy_val, $tmp_arrval);
                }
            }
        }

        //購入商品コード2
        if (!empty($searchData['buy_product_code2']) && $searchData['buy_product_code2']) {
            $data = PostCarrierUtil::toutencomma($searchData['buy_product_code2']);
            $tmpArray = explode(",", $data);

            $join_dtb_order_detail_flag = true;

            $tmp_when = '';
            $tmp_when_val = 0;
            $tmp_arrval = array();
            $tmp_where = array();
            foreach ($tmpArray as $val) {
                $tmp = PostCarrierUtil::trimzen($val);
                if ($tmp == "") continue;
                $tmp_when .= " WHEN d.product_code LIKE ? THEN ".$tmp_when_val++;
                $tmp_arrval[] = $this->addSearchStr($tmp);
                $tmp_where[] = "d.product_code LIKE ?";
            }

            if ($tmp_arrval) {
                if ($searchData['buy_product_code_conjunction2'] == 'and' && $searchData['buy_product_code_negation2'] == 1) {
                    $dtb_order_having_buy[] = "COUNT(DISTINCT CASE $tmp_when ELSE NULL END) <> ".count($tmp_arrval);
                    $dtb_order_having_buy_val = array_merge($dtb_order_having_buy_val, $tmp_arrval);
                } else if ($searchData['buy_product_code_conjunction2'] == 'and') {
                    $dtb_order_having_buy[] = "COUNT(DISTINCT CASE $tmp_when ELSE NULL END) = ".count($tmp_arrval);
                    $dtb_order_having_buy_val = array_merge($dtb_order_having_buy_val, $tmp_arrval);
                } else if ($searchData['buy_product_code_negation2'] == 1) {
                    $dtb_order_having_buy[] = "COUNT(DISTINCT CASE $tmp_when ELSE NULL END) = 0";
                    $dtb_order_having_buy_val = array_merge($dtb_order_having_buy_val, $tmp_arrval);
                } else {
                    $dtb_order_having_buy[] = "COUNT(DISTINCT CASE $tmp_when ELSE NULL END) <> 0";
                    $dtb_order_having_buy_val = array_merge($dtb_order_having_buy_val, $tmp_arrval);
                }
            }
        }

        //購入商品名称
        if (!empty($searchData['buy_product_name']) && $searchData['buy_product_name']) {
            $data = PostCarrierUtil::toutencomma($searchData['buy_product_name']);
            $tmpArray = explode(",", $data);

            $join_dtb_order_detail_flag = true;

            $tmp_when = '';
            $tmp_when_val = 0;
            $tmp_arrval = array();
            $tmp_where = array();
            foreach ($tmpArray as $val) {
                $tmp = PostCarrierUtil::trimzen($val);
                if ($tmp == "") continue;
                $tmp_when .= " WHEN d.product_name LIKE ? THEN ".$tmp_when_val++;
                $tmp_arrval[] = $this->addSearchStr($tmp);
                $tmp_where[] = "d.product_name LIKE ?";
            }

            if ($tmp_arrval) {
                if ($searchData['buy_product_name_conjunction'] == 'and' && $searchData['buy_product_name_negation'] == 1) {
                    $dtb_order_having_buy[] = "COUNT(DISTINCT CASE $tmp_when ELSE NULL END) <> ".count($tmp_arrval);
                    $dtb_order_having_buy_val = array_merge($dtb_order_having_buy_val, $tmp_arrval);
                } else if ($searchData['buy_product_name_conjunction'] == 'and') {
                    $dtb_order_having_buy[] = "COUNT(DISTINCT CASE $tmp_when ELSE NULL END) = ".count($tmp_arrval);
                    $dtb_order_having_buy_val = array_merge($dtb_order_having_buy_val, $tmp_arrval);
                } else if ($searchData['buy_product_name_negation'] == 1) {
                    $dtb_order_having_buy[] = "COUNT(DISTINCT CASE $tmp_when ELSE NULL END) = 0";
                    $dtb_order_having_buy_val = array_merge($dtb_order_having_buy_val, $tmp_arrval);
                } else {
                    $dtb_order_having_buy[] = "COUNT(DISTINCT CASE $tmp_when ELSE NULL END) <> 0";
                    $dtb_order_having_buy_val = array_merge($dtb_order_having_buy_val, $tmp_arrval);
                }
            }
        }

        // 総購入回数指定
        if (isset($searchData['buy_times_from']) || isset($searchData['buy_times_to'])) {
            $buy_times = "COUNT(DISTINCT o.order_id)";
            $arrBuyTimes = $this->selectRange2($searchData["buy_times_from"], $searchData["buy_times_to"], $buy_times);
            $dtb_order_having_buy[] = $arrBuyTimes[0];
            if (is_array($arrBuyTimes[1])) {
                foreach ($arrBuyTimes[1] as $tmp) {
                    $dtb_order_having_buy_val[] = $tmp;
                }
            }
        }

        //カテゴリーを選択している場合のみ絞込検索を行う
        if (!empty($searchData['buy_category']) && $searchData['buy_category']) {
            //検索条件を復元
            if (!is_object($searchData['buy_category'])) {
                $searchData['buy_category'] = $app['eccube.repository.category']->find($searchData['buy_category']);
            }

            //カテゴリーで絞込検索を行うSQL文生成
            $Categories = $searchData['buy_category']->getSelfAndDescendants();
            $tmp_where = "cat.category_id IN (" . implode(',', array_fill(0, count($Categories), '?')) . ")";
            $tmp_arrval = array_map(function ($e) { return $e->getId(); }, $Categories);
            if ($tmp_arrval) {
                $join_dtb_product_categories_flag = true;
                $dtb_order_where[] = $tmp_where;
                $dtb_order_val = array_merge($dtb_order_val, $tmp_arrval);
            }
        }

        //支払方法
        if (!empty($searchData['payment']) && 0 < count($searchData['payment'])) {
            $arrReturn = $this->setItemTerm2($this->arrSql['payment'] ,"o.payment_id");

            $dtb_order_where[] = $arrReturn[0];
            if (is_array($arrReturn[1])) {
                foreach ($arrReturn[1] as $data) {
                    $dtb_order_val[] = is_object($data) ? $data->getId() : $data;
                }
            }
        }

        // 受注日
        if (!empty($searchData['order_date_start']) && $searchData['order_date_start']) {
            $date = $searchData['order_date_start']
                ->format('Y-m-d H:i:s');
            $dtb_order_where[] = 'o.create_date >= ?';
            $dtb_order_val[] = $date; 
        }
        if (!empty($searchData['order_date_end']) && $searchData['order_date_end']) {
            $date = $searchData['order_date_end']
                ->modify('+1 days')
                ->format('Y-m-d H:i:s');
            $dtb_order_where[] = 'o.create_date < ?';
            $dtb_order_val[] = $date; 
        }

        // 入金日
        if (!empty($searchData['payment_date_start']) && $searchData['payment_date_start']) {
            $date = $searchData['payment_date_start']
                ->format('Y-m-d H:i:s');
            $dtb_order_where[] = 'o.payment_date >= ?';
            $dtb_order_val[] = $date; 
        }
        if (!empty($searchData['payment_date_end']) && $searchData['payment_date_end']) {
            $date = $searchData['payment_date_end']
                ->modify('+1 days')
                ->format('Y-m-d H:i:s');
            $dtb_order_where[] = 'o.payment_date < ?';
            $dtb_order_val[] = $date; 
        }

        // 発送日
        if (!empty($searchData['commit_date_start']) && $searchData['commit_date_start']) {
            $date = $searchData['commit_date_start']
                ->format('Y-m-d H:i:s');
            $dtb_order_where[] = 'o.commit_date >= ?';
            $dtb_order_val[] = $date; 
        }
        if (!empty($searchData['commit_date_end']) && $searchData['commit_date_end']) {
            $date = $searchData['commit_date_end']
                ->modify('+1 days')
                ->format('Y-m-d H:i:s');
            $dtb_order_where[] = 'o.commit_date < ?';
            $dtb_order_val[] = $date; 
        }

        $this->setOrder("c.customer_id DESC");

        // 総購入金額指定
        // テーブルJOINが発生するかどうかでSUM(o.total)を変更する必要がある。従って、最後に条件設定を行う。
        if (isset($searchData['buy_total_from']) || isset($searchData['buy_total_to'])) {
            if ($join_dtb_order_detail_flag || $join_dtb_product_categories_flag) {
                $buy_total = "COALESCE(SUM(CASE WHEN d.order_detail_id = (SELECT MIN(d2.order_detail_id) FROM dtb_order_detail d2 WHERE d2.order_id = o.order_id) THEN o.total ELSE 0 END), 0)";
            } else {
                $buy_total = "COALESCE(SUM(o.total), 0)";
            }

            $arrBuyTotal = $this->selectRange2($searchData["buy_total_from"], $searchData["buy_total_to"], $buy_total);
            $dtb_order_having_buy[] = $arrBuyTotal[0];
            if (is_array($arrBuyTotal[1])) {
                foreach ($arrBuyTotal[1] as $tmp) {
                    $dtb_order_having_buy_val[] = $tmp;
                }
            }
        }

        if ($dtb_order_where || $dtb_order_having || $dtb_order_having_buy) {
            $dtb_order_having = array_merge($dtb_order_having, $dtb_order_having_buy);
            $dtb_order_having_val = array_merge($dtb_order_having_val, $dtb_order_having_buy_val);

            $this->setOrderSubquery($dtb_order_where, $dtb_order_val,
                                    $dtb_order_having, $dtb_order_having_val,
                                    $join_dtb_order_detail_flag,
                                    $join_dtb_product_categories_flag,
                                    $where_order_status_flag);
        }

        // 開始条件
        if (0 < $searchData['event_buy_product_count_only']) {
            $event_buy_product_id = array(null);
            $event_buy_product_count = array($searchData['event_buy_product_count_only']);
        } else {
            $event_buy_product_id = array_map(function ($e) { return $e['product_id']; }, $searchData['OrderDetails']);
            $event_buy_product_count = array_map(function ($e) { return $e['quantity']; }, $searchData['OrderDetails']);
        }
        if (!is_array($event_buy_product_id)) $event_buy_product_id = array();
        if (!is_array($event_buy_product_count)) $event_buy_product_count = array();

        if ($dtb_order_event_where_predicate || $dtb_order_event_having_predicate) {
            // 条件は引き継がない
            $dtb_order_where = array();
            $dtb_order_where_val = array();
            $dtb_order_having = array();
            $dtb_order_having_val = array();

            $dtb_order_product_id_fragment = '';
            if (0 < count($event_buy_product_id) && (count($event_buy_product_id) != 1 || $event_buy_product_id[0] != null)) {
                $dtb_order_product_id_fragment = "AND (".implode(" OR ", array_fill(0, count($event_buy_product_id), 'd.product_id = ?')).")";
                $dtb_order_where_val = array_merge($dtb_order_where_val, $event_buy_product_id);
            }

            if (0 < count($event_buy_product_count)) {
                $tmpCond = array();
                foreach ($event_buy_product_count as $i => $cnt) {
                    if (!(0 < $cnt)) {
                        // "回数指定なし"は1回以上購入
                        $tmpCond[] = "COUNT(DISTINCT (CASE WHEN d.product_id = ? THEN o.order_id ELSE NULL END)) > 0";
                        $dtb_order_having_val[] = $event_buy_product_id[$i];
                    } else if ($event_buy_product_id[$i] === null) {
                        $tmpCond[] = "COUNT(DISTINCT o.order_id) = ?";
                        $dtb_order_having_val[] = $cnt;
                    } else {
                        $tmpCond[] = "COUNT(DISTINCT (CASE WHEN d.product_id = ? THEN o.order_id ELSE NULL END)) = ?";
                        $dtb_order_having_val[] = $event_buy_product_id[$i];
                        $dtb_order_having_val[] = $cnt;
                    }
                }

                if (0 < count($tmpCond)) {
                    if ($this->arrSql['event_buy_product_id_conjunction'] == 'and') {
                        $dtb_order_having = array_merge($dtb_order_having, $tmpCond);
                    } else {
                        $dtb_order_having[] = "(".implode(" OR ", $tmpCond).")";
                    }
                }
            }

            if ($dtb_order_event_where_predicate)
                $dtb_order_where[] = $dtb_order_event_where_predicate;
            if ($dtb_order_event_having_predicate)
                $dtb_order_having[] = $dtb_order_event_having_predicate;

            if ($dtb_order_where_fragment = implode("\nAND ", $dtb_order_where)) {
                $dtb_order_where_fragment = "AND $dtb_order_where_fragment";
            }
            if ($dtb_order_having_fragment = implode("\nAND ", $dtb_order_having)) {
                $dtb_order_having_fragment = "HAVING $dtb_order_having_fragment";
            }

            $stop_subquery = <<<START_SUBQUERY_TEMPLATE
EXISTS(
    SELECT 1
      FROM dtb_order o
      JOIN dtb_order_detail d ON d.order_id = o.order_id
     WHERE o.customer_id = c.customer_id
       AND o.del_flg = 0
       AND o.status <> ? AND o.status <> ? AND o.status <> ?
       $dtb_order_product_id_fragment
       $dtb_order_where_fragment
    $dtb_order_having_fragment
)
START_SUBQUERY_TEMPLATE;
            $this->setWhere($stop_subquery);
            $this->arrVal[] = $this->app['config']['order_cancel'];
            $this->arrVal[] = $this->app['config']['order_processing'];
            $this->arrVal[] = $this->app['config']['order_pending'];
            $this->arrVal = array_merge((array)$this->arrVal, $dtb_order_where_val);
            $this->arrVal = array_merge((array)$this->arrVal, $dtb_order_having_val);
        }

        // 終了条件
        $stop_event_buy_product_id = array_map(function ($e) { return $e['product_id']; }, $searchData['StopOrderDetails']);
        if (is_array($stop_event_buy_product_id) && 0 < count($stop_event_buy_product_id)) {
            $stop_dtb_order_where_val = array();

            $stop_dtb_order_product_id_fragment = '';
            if (count($stop_event_buy_product_id) > 0) {
                $stop_dtb_order_product_id_fragment = implode(" OR ", array_fill(0, count($stop_event_buy_product_id), 'd.product_id = ?'));
                $stop_dtb_order_product_id_fragment = "AND ($stop_dtb_order_product_id_fragment)";
                $stop_dtb_order_where_val = $stop_event_buy_product_id;
            }

            $stop_subquery = <<<STOP_SUBQUERY_TEMPLATE
NOT EXISTS(
    SELECT 1
      FROM dtb_order o
      JOIN dtb_order_detail d ON d.order_id = o.order_id
     WHERE o.customer_id = c.customer_id
       AND o.del_flg = 0
       AND o.status <> ? AND o.status <> ? AND o.status <> ?
       $stop_dtb_order_product_id_fragment
)
STOP_SUBQUERY_TEMPLATE;
            $this->setWhere($stop_subquery);
            $this->arrVal[] = $this->app['config']['order_cancel'];
            $this->arrVal[] = $this->app['config']['order_processing'];
            $this->arrVal[] = $this->app['config']['order_pending'];
            $this->arrVal = array_merge((array)$this->arrVal, $stop_dtb_order_where_val);
        }
    }

    function setOrderSubquery($dtb_order_where, $dtb_order_val,
                              $dtb_order_having, $dtb_order_having_val,
                              $join_dtb_order_detail_flag,
                              $join_dtb_product_categories_flag,
                              $where_order_status_flag)
    {
        if (!$where_order_status_flag) {
            // 対応状況が指定されていない場合、キャンセル・購入処理中・決済処理中の受注を除外する。
            $dtb_order_where[] = "o.status <> ? AND o.status <> ? AND o.status <> ?";
            $dtb_order_val[] = $this->app['config']['order_cancel'];
            $dtb_order_val[] = $this->app['config']['order_processing'];
            $dtb_order_val[] = $this->app['config']['order_pending'];
        }

        $dtb_order_join = array();
        if ($join_dtb_order_detail_flag || $join_dtb_product_categories_flag) {
            $dtb_order_join[] = 'JOIN dtb_order_detail d ON d.order_id = o.order_id';
        }
        if ($join_dtb_product_categories_flag) {
            $dtb_order_join[] = 'JOIN dtb_product_category cat ON cat.product_id = d.product_id';
        }

        $dtb_order_join_fragment = implode("\n", $dtb_order_join);
        if ($dtb_order_where_fragment = implode("\nAND ", $dtb_order_where)) {
            $dtb_order_where_fragment = "AND $dtb_order_where_fragment";
        }
        if ($dtb_order_having_fragment = implode("\nAND ", $dtb_order_having)) {
            $dtb_order_having_fragment = "HAVING $dtb_order_having_fragment";
        }

        $order_subquery = <<<ORDER_SUBQUERY_TEMPLATE
EXISTS(
    SELECT 1
      FROM dtb_order o
      $dtb_order_join_fragment
     WHERE o.customer_id = c.customer_id
       AND o.del_flg = 0
       $dtb_order_where_fragment
    $dtb_order_having_fragment
)
ORDER_SUBQUERY_TEMPLATE;

        $this->setWhere($order_subquery);
        $this->arrVal = array_merge((array)$this->arrVal, $dtb_order_val);
        $this->arrVal = array_merge((array)$this->arrVal, $dtb_order_having_val);
    }

    function getSelectSQL($mail_type, $mail_type_c) {
        $colomn = $this->getMailMagazineColumn($mail_type, $mail_type_c);
        $sql = "SELECT ". $colomn. " FROM dtb_customer c ".$this->join.$this->where;

        return array($sql, $this->arrVal);
    }

    function getMailMagazineColumn($mail_type = 1, $mail_type_c) {
        // 旧バージョンとの互換性を確保
        if (is_bool($mail_type)) {
            $mail_type = $mail_type == false ? 1 : 2;
        }

        //メールアドレスカラムを取得。システム利用カラムであるため _address という名称にリネームする。
        $email_column = "c.email AS _address";

        //システム必須カラムを取得
        $columnArray = \Plugin\PostCarrier\Service\LC_MDL_ECQUBELEY_CONSTANTS::getCustomerSearchSystemColumn();
        $columnArray = $columnArray[2];

        $column = implode(",", $columnArray). "," .$email_column;

        //dtb_customerの検索対象カラムを取得
        $columnArray = \Plugin\PostCarrier\Service\LC_MDL_ECQUBELEY_CONSTANTS::getCustomerSearchColumn();
        $columnArray = array_keys($columnArray);
        foreach ($columnArray as $tmp) {
            $column.=",c.".$tmp." as dtb_customer_".$tmp;
        }

        //「CSV会員を検索する」フラグがある場合、検索カラム数分空の列を追加。unionするために列数を合わせる。
        if ($mail_type_c == "1") {
            $columnArray = \Plugin\PostCarrier\Service\LC_MDL_ECQUBELEY_CONSTANTS::getCsvCustomerSearchColumn();
            $columnArray = array_keys($columnArray);
            foreach ($columnArray as $tmp) {
                $column.=",null as plg_postcarrier_csv_customer_".$tmp;
            }
        }

        return $column;
    }

    function getMailMagazineColumnSql($mail_type) {
        // 旧バージョンとの互換性を確保
        if (is_bool($mail_type)) {
            $mail_type = $mail_type == false ? 1 : 2;
        }

        if ($mail_type == 2 || $mail_type == 4) {
            $email_column = "(CASE WHEN c.email_mobile IS NOT NULL AND c.email_mobile <> '' THEN c.email_mobile".
                            "      ELSE c.email END)";
        } else {
            if (0 && $this->arrSql['sphone_classify_flg'] == '0') {
                // スマホを優先
                $email_column = "(CASE WHEN c.email_mobile IS NOT NULL AND c.email_mobile <> '' AND c.email_sphone IS NOT NULL AND c.email_sphone <> '' AND c.email_mobile = c.email_sphone THEN c.email_mobile".
                                "      ELSE c.email END)";
            } else {
                $email_column = "c.email";
            }
        }

        return $email_column;
    }

    //dtb_customer以外で条件を指定する場合の同名メソッド
    function selectTermRange2($from_day, $to_day, $column) {
        $return_val = array();
        $return_where = '';

        // 開始期間の構築
        $date1 = $from_year->format('Y-m-d H:i:s');

        // 終了期間の構築
        $date2 = clone $to_day;
        $date2->modify('+1 days')->format('Y-m-d H:i:s');

        // 開始期間だけ指定の場合
        if (($from_year != "") && ($from_month != "") && ($from_day != "") && ($to_year == "") && ($to_month == "") && ($to_day == "")) {
            $return_where = "? <= $column";
            $return_val[] = $date1;
        }

        //　開始～終了
        if (($from_year != "") && ($from_month != "") && ($from_day != "") &&
        ($to_year != "") && ($to_month != "") && ($to_day != "")) {
            $return_where .= "? <= $column AND $column < ?";
            $return_val[] = $date1;
            $return_val[] = $date2;
        }

        // 終了期間だけ指定の場合
        if (($from_year == "") && ($from_month == "") && ($from_day == "") && ($to_year != "") && ($to_month != "") && ($to_day != "")) {
            $return_where .= "$column < ?";
            $return_val[] = $date2;
        }

        return array($return_where, $return_val);
    }

    //dtb_customer以外で条件を指定する場合の同名メソッド
    function setItemTerm2($arr, $ItemStr) {
        $return_val = array();
        $return_where = '';
        $item = '';

        foreach ($arr as $data) {

            if (count($arr) > 1) {
                if (!is_null($data)) $item .= $ItemStr . " = ? OR ";
            } else {
                if (!is_null($data)) $item = $ItemStr . " = ?";
            }
            $return_val[] = $data;
        }

        if (count($arr) > 1)  $item = "( " . rtrim($item, " OR ") . ")";
        $return_where = $item;
        return array($return_where, $return_val);
    }

    //dtb_customer以外で条件を指定する場合の同名メソッド
    function selectRange2($from, $to, $column) {
        $return_val = array();
        $return_where = '';

        // ある単位のみ検索($from = $to)
        // nullと0を比較する場合があるので、=== を使用する
        if ($from === $to) {
            $return_where.= $column ." = ?" ;
            $return_val = array($from);
            //　~$toまで検索
        } elseif (strlen($from) == 0 && strlen($to) > 0) {
            $return_where.=$column ." <= ? ";
            $return_val = array($to);
            //　~$from以上を検索
        } elseif (strlen($from) > 0 && strlen($to) == 0) {
            $return_where.= $column ." >= ? ";
            $return_val = array($from);
            //　$from~$toの検索
        } else {
            $return_where.= $column ." BETWEEN ? AND ?" ;
            $return_val = array($from, $to);
        }

        return array($return_where, $return_val);
    }

    function setPluralParam(&$arrVal, $data, $column, $andflg=false, $searchStr=false) {
        $op = $andflg == false ? "OR" : "AND";
        $tmpWhere = array();
        $columnExp = $searchStr ? $column : $column."=?";
        $placeholderCount = substr_count($columnExp, "?");
        $data = PostCarrierUtil::toutencomma($data);
        $tmpArray = explode(",", $data);
        foreach ($tmpArray as $tmp) {
            $tmp = PostCarrierUtil::trimzen($tmp);
            if ($tmp == "") continue;
            $tmpWhere[] = $columnExp;
            $val = $searchStr ? $this->addSearchStr($tmp) : $tmp;
            for ($i = 0; $i < $placeholderCount; $i++)
                $arrVal[] = $val;
        }
        return $tmpWhere ? '('.implode(" $op ", $tmpWhere).')' : '';
    }

    function getMobileDomainSQL($arrMobileDomain, $col = 'c.email') {
        $mbDomains = array();
        foreach ($arrMobileDomain as $mobile_domain) {
            // [dhtcrknsq].vodafone.ne.jpのようにサブドメインに集約できるものは'%.vodafone.ne.jp'
            // でマッチさせる。
            // docomo.ne.jpのようにサブドメインを持たないものは、'%@docomo.ne.jp'にマッチさせる。
            if (substr($mobile_domain, 0, 1) !== ".") {
                $mobile_domain = "@".$mobile_domain;
            }
            $mbDomains[] = "$col ILIKE '%$mobile_domain'";
        }
        return implode(' OR ', $mbDomains);
    }
}
