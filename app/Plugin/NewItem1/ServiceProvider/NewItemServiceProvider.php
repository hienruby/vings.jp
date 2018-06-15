<?php
/*
* This file is part of EC-CUBE
*
* Copyright(c) 2000-2015 LOCKON CO.,LTD. All Rights Reserved.
* http://www.lockon.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\NewItem\ServiceProvider;

use Eccube\Application;
use Silex\Application as BaseApplication;
use Silex\ServiceProviderInterface;

class NewItemServiceProvider implements ServiceProviderInterface
{
    public function register(BaseApplication $app)
    {

    $app->match('/block/newitem', '\\Plugin\\NewItem\\Controller\\NewItemController::index')->bind('block_newitem');

    }

    public function boot(BaseApplication $app)
    {
    }
}
