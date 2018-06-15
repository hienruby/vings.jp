<?php

/*
 * This file is part of the CategorySort
 *
 * Copyright (C) 2017 CategorySort
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CategorySort;

use Eccube\Application;
use Eccube\Plugin\AbstractPluginManager;
use Symfony\Component\Filesystem\Filesystem;

class PluginManager extends AbstractPluginManager
{

    /**
     * プラグインインストール時の処理
     *
     * @param $config
     * @param Application $app
     * @throws \Exception
     */
    public function install($config, Application $app)
    {
        $file = new Filesystem();
        try {
            $file->copy($app['config']['plugin_realdir']. '/CategorySort/html/js/jquery.nestable.js', $app['config']['template_html_realdir']. '/../../plugin/CategorySort/jquery.nestable.js', true);

            $mode = fileperms($app['config']['template_html_realdir'] . '/js');
            if($mode != false){
                chmod($app['config']['template_html_realdir']. '/../../plugin/CategorySort', $mode);
            }
            $mode = fileperms($app['config']['template_html_realdir'] . '/js/eccube.js');
            if($mode != false){
                chmod($app['config']['template_html_realdir']. '/../../plugin/CategorySort/jquery.nestable.js', $mode);
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * プラグイン削除時の処理
     *
     * @param $config
     * @param Application $app
     */
    public function uninstall($config, Application $app)
    {
        unlink($app['config']['template_html_realdir']. '/../../plugin/CategorySort/jquery.nestable.js');
    }

    /**
     * プラグイン有効時の処理
     *
     * @param $config
     * @param Application $app
     * @throws \Exception
     */
    public function enable($config, Application $app)
    {
    }

    /**
     * プラグイン無効時の処理
     *
     * @param $config
     * @param Application $app
     * @throws \Exception
     */
    public function disable($config, Application $app)
    {
    }

    /**
     * プラグイン更新時の処理
     *
     * @param $config
     * @param Application $app
     * @throws \Exception
     */
    public function update($config, Application $app)
    {
    }

}
