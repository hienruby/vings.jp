<?php
/*
 * This file is part of PostCarrier for EC-CUBE
 *
 * Copyright(c) IPLOGIC CO.,LTD. All Rights Reserved.
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

namespace Plugin\PostCarrier\Service;

use Eccube\Application;

final class LC_MDL_ECQUBELEY_CONSTANTS {

    //配信先検索項目
    static function getSearchColumns()
    {
        $other = array(
                       array("column" => "mail_method"),
                       array("column" => "mail_type"),
                       array("column" => "htmlmail"),
                       array("column" => "re_edit"),
                       array("column" => "text_mail_flg"),

                       array("column" => "trigger"),
                       array("column" => "schedule_date"),
                       array("column" => "event"),
                       array("column" => "eventDay"),
                       array("column" => "eventDaySelect"),
                       array("column" => "OrderDetails"),
                       array("column" => "StopOrderDetails"),
                       array("column" => "event_buy_product_id_conjunction"),
                       array("column" => "event_buy_product_count_only"),
                       array("column" => "stepmail_time"),
                       array("column" => "periodic_day"),
                       array("column" => "periodic_time"),
                     );

        $tmp = array_merge(LC_MDL_ECQUBELEY_CONSTANTS::getSearchColumnsWeb(),
                           LC_MDL_ECQUBELEY_CONSTANTS::getSearchColumnsCSV());
                           

        return array_merge($other, $tmp);
    }

    static function getSearchColumnsWeb()
    {
        return array(
                     array("column" => "mail_type_web"),
                     array("column" => "customer_id"),
                     array("column" => "name"),
                     array("column" => "kana"),
                     array("column" => "email"),
                     array("column" => "not_emailinc"),
                     array("column" => "tel"),
                     array("column" => "pref"),
                     array("column" => "sex"),
                     array("column" => "birth_month"),
                     array("column" => "birth_date_start"),
                     array("column" => "birth_date_end"),
                     array("column" => "buy_total_from"),
                     array("column" => "buy_total_to"),
                     array("column" => "buy_times_from"),
                     array("column" => "buy_times_to"),
                     array("column" => "create_date_start"),
                     array("column" => "create_date_end"),
                     array("column" => "order_id_start"),
                     array("column" => "order_id_end"),
                     array("column" => "order_date_start"),
                     array("column" => "order_date_end"),
                     array("column" => "payment_date_start"),
                     array("column" => "payment_date_end"),
                     array("column" => "commit_date_start"),
                     array("column" => "commit_date_end"),
                     array("column" => "first_buy_start"),
                     array("column" => "first_buy_end"),
                     array("column" => "last_buy_start"),
                     array("column" => "last_buy_end"),
                     array("column" => "buy_product_id"),
                     array("column" => "buy_product_id_conjunction"),
                     array("column" => "buy_product_id_negation"),
                     array("column" => "buy_product_code"),
                     array("column" => "buy_product_code_conjunction"),
                     array("column" => "buy_product_code_negation"),
                     array("column" => "buy_product_code2"),
                     array("column" => "buy_product_code_conjunction2"),
                     array("column" => "buy_product_code_negation2"),
                     array("column" => "buy_product_name"),
                     array("column" => "buy_product_name_conjunction"),
                     array("column" => "buy_product_name_negation"),
                     array("column" => "buy_category"),
                     array("column" => "payment"),
                     array("column" => "customer_status"),
                     array("column" => "status"),
                     );
    }

    static function getSearchColumnsCsv()
    {
        return array(
                     array("column" => "mail_type_c"),
                     array("column" => "group"),
                     array("column" => "email_c"),
                     array("column" => "not_emailinc_c"),
                     array("column" => "g_create_date_start"),
                     array("column" => "g_create_date_end"),
                     array("column" => "repeat_address_c"),
                     );

    }

    /**
     * 携帯電話判別用ドメインを返す
     *
     * @return array 携帯電話判別用ドメインのリスト
     */
    static function getMobileDomains()
    {
        return array(
             "docomo.ne.jp", "disneymobile.ne.jp", "ezweb.ne.jp", ".biz.ezweb.ne.jp",
             "softbank.ne.jp", "disney.ne.jp", ".vodafone.ne.jp",
             "jp-d.ne.jp", "jp-h.ne.jp", "jp-t.ne.jp", "jp-c.ne.jp", "jp-r.ne.jp",
             "jp-k.ne.jp", "jp-n.ne.jp", "jp-s.ne.jp", "jp-q.ne.jp", "emnet.ne.jp",
             "pdx.ne.jp", ".pdx.ne.jp", "willcom.com"
        );
    }

    /**
     * 本会員用のステップメールの定義情報
     * 表示名、SQLの対応カラム、where句設定フラグ
     *
     * where句設定フラグ
     * 1：dtb_customerのWhereに付けるタイプ
     * 2：dtb_orderのWhereに付けるタイプ
     * 3：dtb_orderのWhereに付けるイベントタイプ。
     *    商品購入日イベントはdtb_order_detailにも条件必要。
     *    (現在機能を無効化中)
     * 4：dtb_orderのcustomer_idでgroupbyした後のHavingに付けるイプ
     *
     * @return array ステップメール定義情報
     */
    static function getStepMailInfo()
    {
        return array(
                "memberRegistrationDate" => array("会員登録日", "c.create_date", 1),
                "birthday" => array("誕生日", "c.birth", 1),
                "paymentDate" => array("入金日", "o.payment_date", 2),
                "orderDate" => array("受注日", "o.create_date", 2),
                "latestOrderDate" => array("最終受注日", "MAX(o.create_date)", 4),
                "commitDate" => array("発送日", "o.commit_date", 2),
                "latestCommitDate" => array("最終発送日", "MAX(o.commit_date)", 4),
        );
    }

    /**
     * メルマガ専用会員用ステップメールの定義情報
     * 表示名、SQLの対応カラム、where句設定フラグ
     *
     * where句設定フラグ（現状1のみ対応）
     * 1：plg_postcarrier_csv_customerのWhereに付けるタイプ
     *
     * @return void
     *
     */
    static function getMailCustomerStepMailInfo()
    {
        return array(
            "memberRegistrationDate" => array("会員登録日", "cc1.create_date", 1),
        );
    }

    /**
     * dtb_customerの検索対象カラム
     *
     * 使用禁止カラム名
     * _id
     * _address
     * _customer_kind
     * birth
     * sex
     * mailmaga_flg
     * create_date
     *
     * @return array カラム名、差し込み項目名の対応辞書
     */
    static function getCustomerSearchColumn()
    {
        return array(
            "name01" => "本会員:顧客名(姓)",
            "name02" => "本会員:顧客名(名)",
            "kana01" => "本会員:顧客名(カナ姓)",
            "kana02" => "本会員:顧客名(カナ名)",
            //"point" => "本会員:所持ポイント",
            "customer_id" => "本会員:会員ID",
        );
    }

    /**
     * plg_postcarrier_csv_customerの検索対象カラム
     *
     * 使用禁止カラム名
     * _id
     * _address
     * _customer_kind
     * birth
     * sex
     * mailmaga_flg
     * create_date
     *
     * @return array カラム名、差し込み項目名の対応辞書
     */
    static function getCsvCustomerSearchColumn()
    {
        return array(
            "email" => "メルマガ会員:メールアドレス",
            "memo01" => "メルマガ会員:自由項目1",
            "memo02" => "メルマガ会員:自由項目2",
            "memo03" => "メルマガ会員:自由項目3",
            "memo04" => "メルマガ会員:自由項目4",
            "memo05" => "メルマガ会員:自由項目5",
            "memo06" => "メルマガ会員:自由項目6",
            "memo07" => "メルマガ会員:自由項目7",
            "memo08" => "メルマガ会員:自由項目8",
            "memo09" => "メルマガ会員:自由項目9",
            "memo10" => "メルマガ会員:自由項目10",
        );
    }

    //差込項目一覧取得。編集不可。
    static function getInsetList($mail_type_web="1", $mail_type_c="1"){

        $tempArray = array();
        if($mail_type_web=='1'){
            $tempArray2 = LC_MDL_ECQUBELEY_CONSTANTS::getCustomerSearchColumn();
            $tempArray2 = array_values($tempArray2);
            $tempArray = array_merge($tempArray, $tempArray2);
        }

        if($mail_type_c=='1'){
            $tempArray2 = LC_MDL_ECQUBELEY_CONSTANTS::getCsvCustomerSearchColumn();
            $tempArray2 = array_values($tempArray2);
            $tempArray = array_merge($tempArray, $tempArray2);
        }

        foreach($tempArray as $temp){
            $newArray[$temp] = $temp;
        }

        return $newArray;
    }

    /**
     *  システムで必須の検索対象カラム。編集不可。
     *
     */
    static function getCustomerSearchSystemColumn(){
        return array(
            array('会員ID','会員区分','誕生日','性別','配信区分','登録日','メールアドレス'), //CSVダウンロードヘッダー
            array('_id','_customer_kind','birth','sex','mailmaga_flg','create_date','_address'), //サーバー送信用CSVヘッダー
            array('c.customer_id AS _id','\'web\' AS _customer_kind','c.birth','c.sex','m.mailmaga_flg','c.create_date'),  //本会員用
            array('customer_id AS _id','\'mail\' AS _customer_kind','null as birth','null as sex','null as mailmaga_flg','create_date'),  //CSV会員用
        );
    }

    static function getStepMailNameArray($mail_flg=""){
        return LC_MDL_ECQUBELEY_CONSTANTS::getStepMailArray(0, $mail_flg);
    }

    static function getStepMailColumnArray($mail_flg=""){
        return LC_MDL_ECQUBELEY_CONSTANTS::getStepMailArray(1, $mail_flg);
    }

    static function getStepMailKbnArray($mail_flg=""){
        return LC_MDL_ECQUBELEY_CONSTANTS::getStepMailArray(2, $mail_flg);
    }

    static function getStepMailArray($columnCount, $mail_flg=""){
        if($mail_flg==""){
            $tmpArray = LC_MDL_ECQUBELEY_CONSTANTS::getStepMailInfo();
        }else{
            $tmpArray = LC_MDL_ECQUBELEY_CONSTANTS::getMailCustomerStepMailInfo();
        }
        $reArray = array();
        foreach($tmpArray as $key => $value){
            $reArray[$key]=$value[$columnCount];
        }
        return $reArray;
    }

    static function getSampleMailTemplate(){
        $baseDir = __DIR__ . "/../Resource/sample_template/";

        $arrFile = array();
        $arrFile[] = array('path'        => $baseDir . 'text/pc_order.tpl',
                           'sendFor'     => 'PC',
                           'subject'     => '【Sample】ステップメール（受注日）PC_TEXT',
                           'mail_method' => 2);
        $arrFile[] = array('path'        => $baseDir . 'text/mobile_order.tpl',
                           'sendFor'     => 'MOBILE',
                           'subject'     => '【Sample】ステップメール（受注日）MOBILE_TEXT',
                           'mail_method' => 2);
        $arrFile[] = array('path'        => $baseDir . 'text/pc_shipping.tpl',
                           'sendFor'     => 'PC',
                           'subject'     => '【Sample】ステップメール（商品発送日）PC_TEXT',
                           'mail_method' => 2);
        $arrFile[] = array('path'        => $baseDir . 'text/mobile_shipping.tpl',
                           'sendFor'     => 'MOBILE',
                           'subject'     => '【Sample】ステップメール（商品発送日）MOBILE_TEXT',
                           'mail_method' => 2);
        $arrFile[] = array('path'        => $baseDir . 'text/pc_lastbuy.tpl',
                           'sendFor'     => 'PC',
                           'subject'     => '【Sample】ステップメール（最終購入日）PC_TEXT',
                           'mail_method' => 2);
        $arrFile[] = array('path'        => $baseDir . 'text/mobile_lastbuy.tpl',
                           'sendFor'     => 'MOBILE',
                           'subject'     => '【Sample】ステップメール（最終購入日）MOBILE_TEXT',
                           'mail_method' => 2);
        $arrFile[] = array('path'        => $baseDir . 'text/pc_firstbuy.tpl',
                           'sendFor'     => 'PC',
                           'subject'     => '【Sample】ステップメール（初回購入日）PC_TEXT',
                           'mail_method' => 2);
        $arrFile[] = array('path'        => $baseDir . 'text/mobile_firstbuy.tpl',
                           'sendFor'     => 'MOBILE',
                           'subject'     => '【Sample】ステップメール（初回購入日）MOBILE_TEXT',
                           'mail_method' => 2);
        $arrFile[] = array('path'        => $baseDir . 'text/pc_member.tpl',
                           'sendFor'     => 'PC',
                           'subject'     => '【Sample】ステップメール（会員登録日）PC_TEXT',
                           'mail_method' => 2);
        $arrFile[] = array('path'        => $baseDir . 'text/mobile_member.tpl',
                           'sendFor'     => 'MOBILE',
                           'subject'     => '【Sample】ステップメール（会員登録日）MOBILE_TEXT',
                           'mail_method' => 2);
        $arrFile[] = array('path'        => $baseDir . 'text/pc_birthday.tpl',
                           'sendFor'     => 'PC',
                           'subject'     => '【Sample】ステップメール（誕生日）PC_TEXT',
                           'mail_method' => 2);
        $arrFile[] = array('path'        => $baseDir . 'text/mobile_birthday.tpl',
                           'sendFor'     => 'MOBILE',
                           'subject'     => '【Sample】ステップメール（誕生日）MOBILE_TEXT',
                           'mail_method' => 2);
        $arrFile[] = array('path'        => $baseDir . 'html/pc_birthday.tpl',
                           'sendFor'     => 'PC',
                           'subject'     => '【Sample】ステップメール（誕生日）PC_HTML',
                           'mail_method' => 1);
        $arrFile[] = array('path'        => $baseDir . 'html/mobile_normal.tpl',
                           'sendFor'     => 'MOBILE',
                           'subject'     => '【Sample】販促メールMOBILE_HTML',
                           'mail_method' => 1);
        $arrFile[] = array('path'        => $baseDir . 'html/pc_normal.tpl',
                           'sendFor'     => 'PC',
                           'subject'     => '【Sample】販促メールPC_HTML',
                           'mail_method' => 1);

        return $arrFile;
    }
}
