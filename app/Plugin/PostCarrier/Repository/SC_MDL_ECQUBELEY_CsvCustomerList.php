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

/*  [名称] SC_MDL_ECQUBELEY_CsvCustomerList
 *  [概要] メルマガCSV会員検索用クラス
 */

namespace Plugin\PostCarrier\Repository;

use Plugin\PostCarrier\Util\PostCarrierUtil;

class SC_MDL_ECQUBELEY_CsvCustomerList extends SC_SelectSql {

    function __construct($array, $eventWhereKbn=0, $eventCondition = "", $customerSql="", $customerVal=array()) {
        parent::__construct($array);

        $searchData = $array;
        $this->arrVal = array();

        //イベント区分に応じて各種条件を付与する。
        if($eventWhereKbn==1){
            $this->setWhere($eventCondition);
        }

        // ステータス
        $this->setWhere("cc1.status=2");

        //メルマガCSVグループ
        $arrGroupVal = $this->setItemTerm( $this->arrSql['group'] ,"group_id" );

        $arrGroupId = array();
        foreach ($arrGroupVal as $data) {
            $arrGroupId[] = is_object($data) ? $data->getId() : $data;
        }
        $this->arrVal = array_merge($this->arrVal, $arrGroupId);

        // グループ間で重複するアドレスを除く。
        if (count($arrGroupVal) > 1) {
            // グループ間で重複している場合、最大のcustomer_idを持つレコードを選択する。
            // 有効なグループ会員(status)のみ除外対象とする。
            $placeholder = $this->getSqlPlaceholder(count($arrGroupVal));
            $where = "NOT EXISTS (SELECT * FROM plg_postcarrier_csv_customer cc2 WHERE cc1.email = cc2.email AND cc2.group_id IN ($placeholder) AND cc1.customer_id < cc2.customer_id AND cc1.status = 2)";

            $this->setWhere($where);
            $this->arrVal = array_merge($this->arrVal, $arrGroupId);
        }

        //　E-MAIL
        if (!isset($this->arrSql['email_c'])) $this->arrSql['email_c'] = "";
        if (strlen($this->arrSql['email_c']) > 0 ) {

            //除外条件の場合は否定系のANDとする。
            if($this->arrSql['not_emailinc_c']=='1'){
                $column='cc1.email NOT LIKE ?';
                $andflag = true;
            }else{
                $column='cc1.email LIKE ?';
                $andflag = false;
            }

            $tmpWhere = $this->setPluralParam($this->arrVal, $this->arrSql['email_c'], $column, $andflag, true);
            if ($tmpWhere) $this->setWhere($tmpWhere);
        }

        // 本会員重複アドレスは除く。
        // 本会員と同時検索であれば、[重複アドレス除外]のチェックに関係なく重複アドレスを除く。
        if($this->arrSql['repeat_address_c']=='1' || $array['mail_type_web']=="1"){
            /*
             * 本会員のemail,email_mobile検索順位については、SC_MDL_ECQUBELEY_CustomerList::getMailMagazineColumn()のCASE式を参照。
             *
             * インデックスが効くように複数のNOT EXISTSサブクエリに分割している。
             * cc1.email = (CASE ... END)ではインデックスは使用されない。
             */

            // 本会員の検索結果を除外対象にする。
            // 条件指定がなければ、会員ステータスと削除フラグから有効な会員を対象とする。
            $customer_sql_fragment = $customerSql ? "AND $customerSql" : 'AND c.status = 2 AND c.del_flg = 0';

            if ($this->arrSql['mail_type'] == "1" || $this->arrSql['mail_type'] == "3") {
                // LEFT JOINかどうかを反映する必要があるか?
                //$where = "NOT EXISTS (SELECT * FROM dtb_customer c WHERE c.email = cc1.email $customer_sql_fragment)";
                $where = "NOT EXISTS (SELECT * FROM dtb_customer c JOIN plg_postcarrier_customer m ON c.customer_id = m.customer_id WHERE c.email = cc1.email $customer_sql_fragment)";
                $this->setWhere($where);
                if ($customerSql && $customerVal) $this->arrVal = array_merge($this->arrVal, $customerVal);
            } else {
                // 本会員のemail,email_mobileいずれかにマッチすればメール会員は除外する。
                // 

                // LEFT JOINかどうかを反映する必要があるか?
                //$where = "NOT EXISTS (SELECT * FROM dtb_customer c WHERE c.email = cc1.email $customer_sql_fragment)";
                $where = "NOT EXISTS (SELECT * FROM dtb_customer c JOIN plg_postcarrier_customer m ON c.customer_id = m.customer_id WHERE c.email = cc1.email $customer_sql_fragment)";
                $this->setWhere($where);
                if ($customerSql && $customerVal) $this->arrVal = array_merge($this->arrVal, $customerVal);
            }
        }

        // 登録期間指定

        if (!empty($searchData['g_create_date_start']) && $searchData['g_create_date_start']) {
            $date = $searchData['g_create_date_start']
                ->format('Y-m-d H:i:s');
            $this->setWhere('cc1.create_date >= ?');
            $this->arrVal[] = $date;
        }
        if (!empty($searchData['g_create_date_end']) && $searchData['g_create_date_end']) {
            $date = $searchData['g_create_date_end']
                ->modify('+1 days')
                ->format('Y-m-d H:i:s');
            $this->setWhere('cc1.create_date < ?');
            $this->arrVal[] = $date;
        }
    }

    function getSelectSQL($mail_type, $mail_type_w) {

        $colomn = $this->getMailMagazineColumn($mail_type, $mail_type_w);
        $sql = "SELECT ". $colomn. " FROM plg_postcarrier_csv_customer cc1 ".$this->where;
        return array($sql, $this->arrVal);
    }

    function getMailMagazineColumn($mail_type, $mail_type_w) {
        $email_column = 'cc1.email AS _address';

        //システム必須カラムを取得
        $columnArray = \Plugin\PostCarrier\Service\LC_MDL_ECQUBELEY_CONSTANTS::getCustomerSearchSystemColumn();
        $columnArray = $columnArray[3];
        $column = implode(",", $columnArray). "," .$email_column;

        //「本会員を検索する」フラグがある場合、検索カラム数分空の列を追加。unionするために列数を合わせる。
        if($mail_type_w=="1"){
            $columnArray = \Plugin\PostCarrier\Service\LC_MDL_ECQUBELEY_CONSTANTS::getCustomerSearchColumn();
            $columnArray = array_keys($columnArray);

            foreach($columnArray as $tmp){
                $column.=",null as dtb_customer_".$tmp;
            }
        }

        //plg_postcarrier_csv_customerの検索対象カラムを取得
        $columnArray = \Plugin\PostCarrier\Service\LC_MDL_ECQUBELEY_CONSTANTS::getCsvCustomerSearchColumn();
        $columnArray = array_keys($columnArray);
        foreach($columnArray as $tmp){
            $column.=",".$tmp." as plg_postcarrier_csv_customer_".$tmp;
        }

        return $column;
    }

    function getWhere($with_where = false) {
        return array($this->where, $this->arrVal);
    }

    function setPluralParam(&$arrVal, $data, $column, $andflg=false, $searchStr=false){
        $op = $andflg == FALSE ? "OR" : "AND";
        $tmpWhere = array();
        $columnExp = $searchStr ? $column : $column."=?";
        $placeholderCount = substr_count($columnExp, "?");
        $data = PostCarrierUtil::toutencomma($data);
        $tmpArray = explode(",", $data);
        foreach($tmpArray as $tmp){
            $tmp = PostCarrierUtil::trimzen($tmp);
            if($tmp=="") continue;
            $tmpWhere[] = $columnExp;
            $val = $searchStr ? $this->addSearchStr($tmp) : $tmp;
            for ($i = 0; $i < $placeholderCount; $i++)
                $arrVal[] = $val;
        }
        return $tmpWhere ? '('.implode(" $op ", $tmpWhere).')' : '';
    }

    function getSqlPlaceholder($n) {
        return implode(',', array_fill(0, $n, '?'));
    }
}
?>
