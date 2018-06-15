<?php
/*
 * Copyright(c) 2016 SYSTEM_KD
 */

namespace Plugin\ClassNameDetail\Service;

use Symfony\Component\HttpFoundation\Response;
use Eccube\Event\TemplateEvent;

class TwigRenderService {

    public $app;
    private $sourceBase;
    private $arrSource;

    public function __construct(\Eccube\Application $app) {
        $this->app = $app;
    }

    public function initTwigRenderControl(TemplateEvent $event) {

        $this->sourceBase = $event->getSource();

        $this->arrSource = explode(PHP_EOL, $this->convertEOL($this->sourceBase));
    }

    public function initHtmlRenderControl($source) {

        $this->sourceBase = $source;

        $this->arrSource = explode(PHP_EOL, $this->convertEOL($this->sourceBase));
    }

    public function twigReplace($searchBase, $replace, $offset = 0) {

        $src = $this->sourceBase;

        $source = "";

        $search = "";
        $range = 0;
        $searchIndex = 0;
        if(is_array($searchBase)) {

            // 配列の場合
            $count = count($searchBase);

            switch ($count) {
                case 1:
                    $searchBase[1] = 0;
                    $searchBase[2] = 0;
                    break;
                case 2:
                    $searchBase[2] = 0;
                    break;
            }

            $search = $searchBase[0];
            $range = $searchBase[1];
            $searchIndex = $searchBase[2];

        } else {
            $search = $searchBase;
        }

        $replace = $this->convertEOL($replace);

        if($offset == 0 && $range == 0 && $searchIndex == 0) {
            $source = str_replace($search, $replace, $this->sourceBase);
            $this->sourceBase = $source;

        } else if ($range > 0 || $searchIndex > 0) {

            // range指定
            $index = $this->getRowIndex($search, $searchIndex);
            $this->arrSource[$index] = $replace;

            for($i=$index+1;$i<$index+$range;$i++) {
                unset($this->arrSource[$i]);
            }

            $this->sourceBase = implode(PHP_EOL, $this->arrSource);

        } else {

            // offset指定
            $index = $this->getRowIndex($search);
            if($index < 0) {
                // TODO:err
                return;
            }

            $index += $offset;
            $this->arrSource[$index] = $replace;

            $this->sourceBase = implode(PHP_EOL, $this->arrSource);
        }

        $this->arrSource = explode(PHP_EOL, $this->convertEOL($this->sourceBase));
    }

    public function twigInsert($searchBase, $insert, $offset = 1) {

        $src = $this->sourceBase;

        $source = "";
        $arrSearch = $searchBase;
        $searchIndex = 0;

        if(is_array($searchBase)) {
            $arrSearch = $searchBase[0];
            $searchIndex = $searchBase[1];
        } else {
            $arrSearch = $searchBase;
            $searchIndex = 0;
        }


        $index = $this->getRowIndex($arrSearch, $searchIndex);

        if($index < 0) {
            // TODO:Err
            return;
        }

        // 追加
        $insertIndex = $index + $offset;

        // 配列移動
        $max = count($this->arrSource);
        for($i = $max; $i > $insertIndex; $i--) {
            $this->arrSource[$i] = $this->arrSource[$i-1];
        }

        $this->arrSource[$insertIndex] = $insert;
        $this->sourceBase = implode(PHP_EOL, $this->arrSource);

        $this->arrSource = explode(PHP_EOL, $this->convertEOL($this->sourceBase));
    }

    public function readTwigFile($view) {
        $twigFile = $this->app['twig']->getLoader()->getSource($view);
        return $twigFile;
    }

    public function getContent() {
        return $this->sourceBase;
    }

    public function getRowContents($search, $searchIndex = 0) {

        $index = $this->getRowIndex($search, $searchIndex);

        if($index < 0) {
            return "";
        }

        return $this->arrSource[$index];
    }

    public function isJSBlock() {

        $check = '{% block javascript %}';

        if($this->getRowContents($check) == '') {
            // js block なし
            return false;
        } else {
            // js block あり
            return true;
        }
    }

    public function addJavaScript($source, $insertKey = '{% endblock stylesheet %}') {

        if($this->isJSBlock()) {

            // 最後に追加
            $search = '{% endblock javascript %}';
            $replace = $source;

            $this->twigReplace($search, $replace.PHP_EOL.$search);

        } else {

            // block ごと追加
            $search = $insertKey;

            $insert = '{% block javascript %}' . PHP_EOL;
            $insert .= $source . PHP_EOL;
            $insert .= '{% endblock javascript %}' . PHP_EOL;

            $this->twigInsert($search, $insert);
        }
    }

    private function getRowIndex($search, $searchIndex = 0) {

        $count = 0;
        foreach ($this->arrSource as $key=>$val) {
            if(strpos($val, $search) !== false) {
                if($count == $searchIndex) {
                    return $key;
                } else {
                    $count++;
                }
            }
        }

        return -1;
    }

    function convertEOL($string, $to = PHP_EOL)
    {
        return preg_replace("/\r\n|\r|\n/", $to, $string);
    }

}
