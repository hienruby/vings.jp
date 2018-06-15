<?php

/*
 * This file is part of the ProductMeta
 *
 * Copyright (C) 2017 ONE HAND RED
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\ProductMeta;

use Eccube\Plugin\AbstractPluginManager;

class PluginManager extends AbstractPluginManager
{

    public function __construct()
    {
    }

    public function install($config, $app)
    {
    }

    public function uninstall($config, $app)
    {
        // Migration
        $this->migrationSchema($app, __DIR__ . '/Resource/doctrine/migration', $config['code'], 0);
    }

    public function enable($config, $app)
    {
        // Migration
        $this->migrationSchema($app, __DIR__ . '/Resource/doctrine/migration', $config['code']);
    }

    public function disable($config, $app)
    {
    }

    public function update($config, $app)
    {
    }
}