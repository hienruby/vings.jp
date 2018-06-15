<?php
/*
* Plugin Name : SiteMap
*
* Copyright (C) BraTech Co., Ltd. All Rights Reserved.
* http://www.bratech.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\SiteMap;

use Eccube\Plugin\AbstractPluginManager;
use Eccube\Entity\Master\DeviceType;

class PluginManager extends AbstractPluginManager
{

    public function install($config, $app)
    {
        $this->migrationSchema($app, __DIR__ . '/Migration', $config['code']);
    }

    public function uninstall($config, $app)
    {
        $this->migrationSchema($app, __DIR__ . '/Migration', $config['code'], 0);
    }

    public function enable($config, $app)
    {
    }

    public function disable($config, $app)
    {
    }

    public function update($config, $app)
    {
    }
}
