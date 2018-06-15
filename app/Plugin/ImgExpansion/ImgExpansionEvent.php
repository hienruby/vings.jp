<?php
/**
 * This file is part of the ImgExpansion
 *
 * Copyright (C) 2016 IDS Corporation
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\ImgExpansion;

use Eccube\Event\TemplateEvent;
use Plugin\ImgExpansion\PluginManager;

class ImgExpansionEvent
{

    /**
     * @var \Eccube\Application
     */
    private $app;

    /**
     * ImgExpansion constructor.
     *
     * @param $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    public function onRenderProductDetail(TemplateEvent $event)
    {
        $params = $event->getParameters();

        // 画像登録が無ければ何もしない
        if (!count($params['Product']['ProductImage'])) {
            return;
        }

        $plgCode = PluginManager::PLUGIN_CODE;

        // ソースを取得
        $source = $event->getSource();

        $twigFilePath = __DIR__ . '/Resource/template/detail_js.twig';
        if (!file_exists($twigFilePath) || !$source) {
            return;
        }

        $match = array();
        preg_match_all('/\.slides(.+?)(speed:[[:blank:][:digit:]]{1,}\,)/is', $source, $match, PREG_SET_ORDER);
        if ($match) {
            $item = current($match);
            $replace = str_replace($item[2], 'speed: 0,', $item[0]);
            $source = str_replace($item[0], $replace, $source);
        }


        $twigFile = file_get_contents($twigFilePath);
        $plgFrontDir = $this->app['config']['plugin_urlpath'] . "/{$plgCode}/";
        $addSource = "{% block javascript %}\n"
                . "<script src=\"{$plgFrontDir}js/zoomsl-3.0.min.js\"></script>\n"
                . $twigFile
        ;
        $chgSource = str_replace('{% block javascript %}', $addSource, $source);
        $event->setSource($chgSource);
    }
}
