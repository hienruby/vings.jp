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

namespace Plugin\Shiro8Welcome3\ServiceProvider;

use Eccube\Application;
use Silex\Application as BaseApplication;
use Silex\ServiceProviderInterface;

class Shiro8Welcome3ServiceProvider implements ServiceProviderInterface
{
    public function register(BaseApplication $app)
    {
        
        // ブロック
        $app->match('/block/plg_shiro8_welcome_block', '\Plugin\Shiro8Welcome3\Controller\Block\Shiro8WelcomeController::index')
            ->bind('block_plg_shiro8_welcome_block');
    
    }
    
    public function boot(BaseApplication $app)
    {
    }
}
