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

namespace Plugin\IntroduceDiscount\ServiceProvider;

use Eccube\Application;
use Silex\Application as BaseApplication;
use Silex\ServiceProviderInterface;
use Plugin\IntroduceDiscount\Form\Type;
use Plugin\IntroduceDiscount\Service\AffiliateSettingsService;

class IntroduceDiscountServiceProvider implements ServiceProviderInterface
{
    const CODE_NAME = '\\Plugin\\IntroduceDiscount';
    public function register(BaseApplication $app)
    {
        // ============================================================
        // リポジトリの登録
        // ============================================================

        // 設定情報テーブルリポジトリ
        $app['eccube.plugin.introduce_discount.repository.affiliate_settings'] = $app->share(function () use ($app) {
            return $app['orm.em']->getRepository($this::CODE_NAME.'\Entity\AffiliateSettings');
        });

        // 履歴情報テーブルリポジトリ
        $app['eccube.plugin.introduce_discount.repository.affiliate_histories'] = $app->share(function () use ($app) {
            return $app['orm.em']->getRepository($this::CODE_NAME.'\Entity\AffiliateHistories');
        });

        // 割引券テーブルリポジトリ
        $app['eccube.plugin.introduce_discount.repository.affiliate_discount_tickets'] = $app->share(function () use ($app) {
            return $app['orm.em']->getRepository($this::CODE_NAME.'\Entity\AffiliateDiscountTickets');
        });

        // ============================================================
        // コントローラの登録
        // ============================================================
        // 編集
        $app->match('/' . $app["config"]["admin_route"] . '/affiliate/edit/{id}', $this::CODE_NAME.'\\Controller\AffiliateSettingsController::edit')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_affiliate_edit');

        // 編集確定
        $app->match('/' . $app["config"]["admin_route"] . '/affiliate/commit', $this::CODE_NAME.'\\Controller\AffiliateSettingsController::commit')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_affiliate_commit');



        // ============================================================
        // Formの登録
        // ============================================================
        // 型登録
        $app['form.types'] = $app->share($app->extend('form.types', function ($types) use ($app) {
            $types[] = new Type\AffiliateSettingsType($app);

            return $types;
        }));

        // -----------------------------
        // サービスの登録
        // -----------------------------
        $app['eccube.plugin.introduce_discount.service.affiliate_settings'] = $app->share(function () use ($app) {
            return new AffiliateSettingsService($app);
        });

        // ============================================================
        // メッセージ登録
        // ============================================================
        $app['translator'] = $app->share($app->extend('translator', function ($translator, \Silex\Application $app) {
            $translator->addLoader('yaml', new \Symfony\Component\Translation\Loader\YamlFileLoader());

            $file = __DIR__ . '/../Resource/locale/message.' . $app['locale'] . '.yml';
            if (file_exists($file)) {
                $translator->addResource('yaml', $file, $app['locale']);
            }

            return $translator;
        }));

        // ============================================================
        // メニュー登録
        // ============================================================
        $app['config'] = $app->share($app->extend('config', function ($config) {

            {
                foreach ($config['nav'] as &$val) {
                    if ("order" === $val["id"]) {
                        $val["child"][] = array(
                            'id' => "admin_affiliate",
                            'name' => "紹介割引管理",
                            'url' => "admin_affiliate_edit",
                        );
                        break;
                    }
                }
            }
            return $config;
        }));

    }

    public function boot(BaseApplication $app)
    {
    }
}
