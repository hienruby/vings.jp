<?php

/*
 * This file is part of the PostCarrier
 *
 * Copyright (C) 2016 アイピーロジック株式会社
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\PostCarrier\Util;

use Eccube\Application;
use Eccube\Common\Constant;
use Symfony\Component\Form\FormBuilderInterface;

class PostCarrierUtil
{
    public function buildFormTemplate(FormBuilderInterface $builder, array $options) {

        $builder
            ->add('name', 'text', array(
                'label' => '管理用名称',
                'required' => false,
            ))
            ->add('note', 'textarea', array(
                'label' => '備考',
                'required' => false,
            ))
            // テンプレート編集
            ->add('mail_method', 'choice', array(
                'label' => 'メール形式',
                'required' => true,
                'expanded' => true,
                'choices' => array(1 => 'HTML', 2 => 'テキスト'),
                'empty_data' => 2,
            ))
            ->add('sendFor', 'choice', array(
                'label' => 'メール種別',
                'required' => true,
                'expanded' => true,
                'choices' => array('PC' => 'パソコン向け', 'MOBILE' => '携帯電話向け'),
                'empty_data' => 'PC',
            ))
            ->add('fromAddr', 'text', array(
                'label' => '送信者アドレス',
                'required' => true,
                'constraints' => array(
                    new Assert\NotBlank()
                )
            ))
            ->add('fromDisp', 'text', array(
                'label' => '送信者名',
                'required' => false,
            ))
            ->add('replytoAddr', 'text', array(
                'label' => '返信先アドレス',
                'required' => false,
            ))
            ->add('replytoDisp', 'text', array(
                'label' => '返信先名',
                'required' => false,
            ))
            ->add('subject_item', 'choice', array(
                'label' => '件名への差し込み項目',
                'required' => false,
                'choices' => $itemData,
                'placeholder' => '差し込む位置にカーソルを置いて選択してください',
            ))
            ->add('subject', 'text', array(
                'label' => '件名',
                'required' => true,
                'constraints' => array(
                    new Assert\NotBlank()
                )
            ))
            ->add('body_item', 'choice', array(
                'label' => '本文への差し込み項目',
                'required' => false,
                'choices' => $itemData,
                'placeholder' => '差し込む位置にカーソルを置いて選択してください',
            ))
            ->add('body', 'textarea', array(
                'label' => '本文',
                'required' => true,
                'constraints' => array(
                    new Assert\NotBlank()
                )
            ))
            ->add('sub_body_item', 'choice', array(
                'label' => '代替本文への差し込み項目',
                'required' => false,
                'choices' => $itemData,
                'placeholder' => '差し込む位置にカーソルを置いて選択してください',
            ))
            ->add('sub_body', 'textarea', array(
                'label' => '代替本文',
                'required' => false,
            ));

        return $builder;
    }

    static function escapeCsvData($str) {
        // 文字列へ変換
        $str = strval($str);

        // ダブルクォートは二重にする。
        $str = preg_replace('/(")/u', '"$1', $str);

        // データ中にカンマ、ダブルクォートまたは改行が存在する ->
        // 両端にダブルクォートを追加する。
        if (preg_match('/[,"\n\r]/u', $str)) {
            $str = '"'.$str.'"';
        }

        return $str;
    }

    static function find_binary_path($binary_name) {
        if (PostCarrierUtil::isWindowsPlatform()) {
            $search_paths = array("c:/php5", "c:/php", "c:/xampp/php", "c:/progra~1/php", "d:/php5", "d:/php", "d:/xampp/php", "d:/progra~1/php", "c:/usr/bin", "c:/cacti", "c:/rrdtool", "c:/spine", "c:/net-snmp/bin", "c:/progra~1/net-snmp/bin", "d:/usr/bin", "d:/net-snmp/bin", "d:/progra~1/net-snmp/bin", "d:/cacti", "d:/rrdtool", "d:/spine");
        }else{
            $search_paths = array("/bin", "/sbin", "/usr/bin", "/usr/sbin", "/usr/local/bin", "/usr/local/sbin");
        }

        for ($i = 0; $i < count($search_paths); $i++) {
            $php_path = $search_paths[$i] . "/" . $binary_name;
            if (file_exists($php_path) && is_executable($php_path) && !is_dir($php_path)) {
                if (PostCarrierUtil::php_is_cli($php_path)) {
                    return $php_path;
                }
            }
        }

        return false;
    }

    static function isWindowsPlatform() {
        return substr(php_uname(), 0, 7) === "Windows";
    }

    static function php_is_cli($php_path) {

        // CGIモードで固まる現象を回避する。
        $stdin_redirect = PostCarrierUtil::isWindowsPlatform() ? '' : '</dev/null'; 

        $phpinfo = shell_exec("$php_path -i $stdin_redirect");

        if (preg_match("/Server API.*CGI/i", $phpinfo)) {
            return true;
        }
        if (preg_match("/Server API.*Apache/i", $phpinfo)) {
            return false;
        }
        if (preg_match("/Server API.*Command Line Interface/i", $phpinfo)) {
            return true;
        }
        return false;
    }

    static function trimzen($str) {
        // 半角・全角スペース
        $str = preg_replace("/^[ 　\t]+/u","",$str);
        $str = preg_replace("/[ 　\t]+$/u","",$str);
        return $str;
    }

    static function toutencomma($str) {
        return preg_replace("/、/u",",",$str);
    }

    static function checkNotConfigured($app) {
        $conf = $app['eccube.plugin.postcarrier.repository.postcarrier_plugin']->getSubData('PostCarrier');
        $conf = unserialize($conf);
        return $conf === false || !$conf['apiUrl'];
    }
}
