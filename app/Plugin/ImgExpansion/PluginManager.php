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

use Eccube\Plugin\AbstractPluginManager;
use Symfony\Component\Filesystem\Filesystem;

class PluginManager extends AbstractPluginManager
{
    const PLUGIN_CODE = 'ImgExpansion';

    /**
     * プラグインインストール時の処理
     *
     * @param $config
     * @param $app
     * @throws \Exception
     */
    public function install($config, $app)
    {
    }

    /**
     * プラグイン削除時の処理
     *
     * @param $config
     * @param $app
     */
    public function uninstall($config, $app)
    {
        $appConfig = $app['config'];
        $cd = $config['code'];
        $plgFrontDir = $appConfig['plugin_html_realdir'];
        $frontFile = "{$plgFrontDir}/{$cd}/js/zoomsl-3.0.min.js";

        $fs = new Filesystem();
        if ($fs->exists($frontFile)) {
            $fs->remove("{$plgFrontDir}/{$cd}");
        }
    }

    /**
     * プラグイン有効時の処理
     *
     * @param $config
     * @param $app
     * @throws \Exception
     */
    public function enable($config, $app)
    {
        $appConfig = $app['config'];
        $cd = $config['code'];
        $plgDir = $appConfig['plugin_realdir'];
        $plgFrontDir = $appConfig['plugin_html_realdir'];

        $frontFile = "{$plgFrontDir}/{$cd}/js/zoomsl-3.0.min.js";
        $plgFile = "{$plgDir}/{$cd}/html/js/zoomsl-3.0.min.js";

        $fs = new Filesystem();
        if (!$fs->exists($frontFile)) {
            $fs->copy($plgFile, $frontFile);
        }
    }

    /**
     * プラグイン無効時の処理
     *
     * @param $config
     * @param $app
     */
    public function disable($config, $app)
    {
    }

    public function update($config, $app)
    {
    }
}
