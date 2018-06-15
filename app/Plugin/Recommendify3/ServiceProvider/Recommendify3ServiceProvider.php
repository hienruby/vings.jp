<?php

namespace Plugin\Recommendify3\ServiceProvider;

use Silex\Application as BaseApplication;
use Silex\ServiceProviderInterface;
use Symfony\Component\Yaml\Yaml;

class Recommendify3ServiceProvider implements ServiceProviderInterface
{
    public function register(BaseApplication $app)
    {
        // ブロック
        $app->match('/block/recommendify3_product_block', '\Plugin\Recommendify3\Controller\Block\Recommendify3Controller::index')
            ->bind('block_recommendify3_product_block');
        // サービスの登録
        $app['eccube.plugin.recommend.service.recommendify3'] = $app->share(function () use ($app) {
            return new \Plugin\Recommendify3\Service\Recommendify3Service($app);
        });
    }

    public function boot(BaseApplication $app)
    {
    }
}
