<?php

/*
 * This file is part of the PostCarrier
 *
 * Copyright (C) 2016 アイピーロジック株式会社
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\PostCarrier\ServiceProvider;

use Eccube\Application;
use Monolog\Handler\FingersCrossed\ErrorLevelActivationStrategy;
use Monolog\Handler\FingersCrossedHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Plugin\PostCarrier\Form\Type\PostCarrierConfigType;
use Silex\Application as BaseApplication;
use Silex\ServiceProviderInterface;
use Symfony\Component\Yaml\Yaml;


class PostCarrierServiceProvider implements ServiceProviderInterface
{
    public function register(BaseApplication $app)
    {
        // ===========================================
        // 配信内容設定
        // ===========================================
        // 配信設定検索・一覧
        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier', '\\Plugin\\PostCarrier\\Controller\\PostCarrierController::index')
            //->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/page/{page_no}', '\\Plugin\\PostCarrier\\Controller\\PostCarrierController::index')
            ->value('page_no', null)->assert('page_no', '\d+|')
            ->bind('admin_postcarrier_page');

        // 配信内容設定(テンプレ選択)
        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/select/{id}', '\\Plugin\\PostCarrier\\Controller\\PostCarrierController::select')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_select');

        // 配信内容編集(テンプレ修正）
        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier', '\\Plugin\\PostCarrier\\Controller\\PostCarrierController::edit')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_edit');

        // 配信内容確認
        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/confirm/{id}', '\\Plugin\\PostCarrier\\Controller\\PostCarrierController::confirm')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_confirm');

        // 配信内容配信
        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/commit', '\\Plugin\\PostCarrier\\Controller\\PostCarrierController::commit')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_commit');

        // 配信履歴から
        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/research/history/{id}', '\\Plugin\\PostCarrier\\Controller\\PostCarrierController::researchHistory')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_research_history');

        // 配信履歴から
        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/edit/{id}', '\\Plugin\\PostCarrier\\Controller\\PostCarrierController::edit')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_edit');

        // プレビュー
        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/preview', '\\Plugin\\PostCarrier\\Controller\\PostCarrierController::preview')
            ->bind('admin_postcarrier_preview');

        // ===========================================
        // テンプレート設定
        // ===========================================
        // テンプレート一覧
        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/template', '\\Plugin\\PostCarrier\\Controller\\PostCarrierTemplateController::index')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_template');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/template/page/{page_no}', '\\Plugin\\PostCarrier\\Controller\\PostCarrierTemplateController::index')
            ->value('page_no', null)->assert('page_no', '\d+|')
            ->bind('admin_postcarrier_template_page');

        // テンプレ編集
        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/template/{id}/edit', '\\Plugin\\PostCarrier\\Controller\\PostCarrierTemplateController::edit')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_template_edit');

        // テンプレ登録
        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/template/regist', '\\Plugin\\PostCarrier\\Controller\\PostCarrierTemplateController::regist')
            ->bind('admin_postcarrier_template_regist');

        // テンプレ登録 配信履歴からコピー
        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/template/history/{id}', '\\Plugin\\PostCarrier\\Controller\\PostCarrierTemplateController::copyHistory')
            ->bind('admin_postcarrier_template_history');

        // テンプレ編集確定
        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/template/commit', '\\Plugin\\PostCarrier\\Controller\\PostCarrierTemplateController::commit')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_template_commit');

        // テンプレ削除
        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/template/{id}/delete', '\\Plugin\\PostCarrier\\Controller\\PostCarrierTemplateController::delete')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_template_delete');

        // テンプレプレビュー
        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/template/{id}/preview', '\\Plugin\\PostCarrier\\Controller\\PostCarrierTemplateController::preview')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_template_preview');

        // テンプレートコピー
        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/template/{id}/copy', '\\Plugin\\PostCarrier\\Controller\\PostCarrierTemplateController::copy')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_template_copy');

        // ===========================================
        // 配信履歴
        // ===========================================
        // 配信履歴一覧
        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/history', '\\Plugin\\PostCarrier\\Controller\\PostCarrierHistoryController::index')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_history');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/history/{page_no}', '\\Plugin\\PostCarrier\\Controller\\PostCarrierHistoryController::index')
            ->value('page_no', null)->assert('page_no', '\d+|')
            ->bind('admin_postcarrier_history_page');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/history/{id}/preview', '\\Plugin\\PostCarrier\\Controller\\PostCarrierHistoryController::preview')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_history_preview');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/history/{id}/result', '\\Plugin\\PostCarrier\\Controller\\PostCarrierHistoryController::result')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_history_result');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/history/{id}/result/customer', '\\Plugin\\PostCarrier\\Controller\\PostCarrierHistoryController::resultCustomer')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_history_result_customer');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/history/{id}/result/link', '\\Plugin\\PostCarrier\\Controller\\PostCarrierHistoryController::resultLink')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_history_result_link');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/history/{id}/condition', '\\Plugin\\PostCarrier\\Controller\\PostCarrierHistoryController::condition')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_history_condition');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/history/{id}/detail', '\\Plugin\\PostCarrier\\Controller\\PostCarrierHistoryController::detail')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_history_detail');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/history/{id}/detail/{page_no}', '\\Plugin\\PostCarrier\\Controller\\PostCarrierHistoryController::detail')
            ->value('id', null)->assert('id', '\d+|')
            ->value('page_no', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_history_detail_page');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/mailcust/{id}/detail/export', '\\Plugin\\PostCarrier\\Controller\\PostCarrierHistoryController::detailExport')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_history_detail_export');

        // ===========================================
        // スケジュール一覧
        // ===========================================
        // スケジュール一覧
        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/schedule', '\\Plugin\\PostCarrier\\Controller\\PostCarrierScheduleController::index')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_schedule');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/schedule/{page_no}', '\\Plugin\\PostCarrier\\Controller\\PostCarrierScheduleController::index')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_schedule_page');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/schedule/run/{id}', '\\Plugin\\PostCarrier\\Controller\\PostCarrierScheduleController::run')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_schedule_run');

        // ===========================================
        // ステップメール一覧
        // ===========================================
        // ステップメール一覧
        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/stepmail', '\\Plugin\\PostCarrier\\Controller\\PostCarrierStepmailController::index')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_stepmail');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/stepmail/{page_no}', '\\Plugin\\PostCarrier\\Controller\\PostCarrierStepmailController::index')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_stepmail_page');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/schedule/pause/{id}', '\\Plugin\\PostCarrier\\Controller\\PostCarrierScheduleController::pause')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_schedule_pause');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/schedule/resume/{id}', '\\Plugin\\PostCarrier\\Controller\\PostCarrierScheduleController::resume')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_schedule_resume');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/schedule/copy/{id}', '\\Plugin\\PostCarrier\\Controller\\PostCarrierScheduleController::copy')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_schedule_copy');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/schedule/delete/{id}', '\\Plugin\\PostCarrier\\Controller\\PostCarrierScheduleController::delete')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_schedule_delete');

        // ===========================================
        // メルマガ専用会員管理
        // ===========================================
        // メルマガ専用会員一覧
        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/mailcust', '\\Plugin\\PostCarrier\\Controller\\PostCarrierMailcustController::index')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_mailcust');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/mailcust/page/{page_no}', '\\Plugin\\PostCarrier\\Controller\\PostCarrierMailcustController::index')
            ->value('page_no', null)->assert('page_no', '\d+|')
            ->bind('admin_postcarrier_mailcust_page');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/mailcust_csv_import', '\\Plugin\\PostCarrier\\Controller\\PostCarrierMailcustController::csvImport')
            ->bind('admin_postcarrier_mailcust_csv_import');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/mailcust/edit/{id}', '\\Plugin\\PostCarrier\\Controller\\PostCarrierMailcustController::edit')
            ->bind('admin_postcarrier_mailcust_edit');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/mailcust/delete/{id}', '\\Plugin\\PostCarrier\\Controller\\PostCarrierMailcustController::delete')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_mailcust_delete');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/mailcust/export/{id}', '\\Plugin\\PostCarrier\\Controller\\PostCarrierMailcustController::csvExport')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_mailcust_export');

        // ===========================================
        // 配信除外アドレス
        // ===========================================
        // 配信除外アドレス
        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/discard', '\\Plugin\\PostCarrier\\Controller\\PostCarrierDiscardController::index')
            ->value('id', null)->assert('id', '\d+|')
            ->bind('admin_postcarrier_discard');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/discard/page/{page_no}', '\\Plugin\\PostCarrier\\Controller\\PostCarrierDiscardController::index')
            ->value('page_no', null)->assert('page_no', '\d+|')
            ->bind('admin_postcarrier_discard_page');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/discard/delete/{email}', '\\Plugin\\PostCarrier\\Controller\\PostCarrierDiscardController::delete')
            ->value('email', null)
            ->bind('admin_postcarrier_discard_delete');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/discard_csv_import', '\\Plugin\\PostCarrier\\Controller\\PostCarrierDiscardController::csvImport')
            ->bind('admin_postcarrier_discard_csv_import');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/discard/export', '\\Plugin\\PostCarrier\\Controller\\PostCarrierDiscardController::csvExport')
            ->bind('admin_postcarrier_discard_export');

        // ===========================================
        // 月次配信件数
        // ===========================================
        // 月次配信件数一覧
        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/counter', '\\Plugin\\PostCarrier\\Controller\\PostCarrierCounterController::index')
            ->bind('admin_postcarrier_counter');

        $app->match('/' . $app["config"]["admin_route"] . '/postcarrier/counter/page/{page_no}', '\\Plugin\\PostCarrier\\Controller\\PostCarrierCounterController::index')
            ->value('page_no', null)->assert('page_no', '\d+|')
            ->bind('admin_postcarrier_counter_page');

        // プラグイン用設定画面
        $app->match('/' . $app['config']['admin_route'] . '/plugin/PostCarrier/config', 'Plugin\PostCarrier\Controller\ConfigController::index')->bind('plugin_PostCarrier_config');

        // TODO: クリックは設定で変更できるようにする。
        $app->match('/m', '\\Plugin\\PostCarrier\\Controller\\PostCarrierReceiveController::click')->bind('postcarrier_click');
        $app->match('/plg_postcarrier/receive', '\\Plugin\\PostCarrier\\Controller\\PostCarrierReceiveController::receive')->bind('postcarrier_receive');

        // メルマガ登録ブロック
        $app->match('/block/plg_postcarrier_mailmaga_form', '\\Plugin\\PostCarrier\\Controller\\PostCarrierBlockController::block')->bind('block_plg_postcarrier_mailmaga_form');
        // Form
        $app['form.types'] = $app->share($app->extend('form.types', function ($types) use ($app) {
            $types[] = new PostCarrierConfigType($app);
            $types[] = new \Plugin\PostCarrier\Form\Type\PostCarrierType($app);
            $types[] = new \Plugin\PostCarrier\Form\Type\PostCarrierTemplateEditType($app);
            $types[] = new \Plugin\PostCarrier\Form\Type\PostCarrierCsvImportType($app);
            $types[] = new \Plugin\PostCarrier\Form\Type\PostCarrierGroupType($app);
            $types[] = new \Plugin\PostCarrier\Form\Type\PostCarrierOrderDetailType($app);
            $types[] = new \Plugin\PostCarrier\Form\Type\PostCarrierDiscardType($app);
            $types[] = new \Plugin\PostCarrier\Form\Type\PostCarrierMailmagaFormBlockType($app);
            return $types;
        }));

        // Form Extension
        $app['form.type.extensions'] = $app->share($app->extend('form.type.extensions', function ($extensions) use ($app) {
            $extensions[] = new \Plugin\PostCarrier\Form\Extension\EntryPostCarrierTypeExtension($app);
            //$extensions[] = new \Plugin\PostCarrier\Form\Extension\CustomerPostCarrierTypeExtension($app);
            return $extensions;
        }));

        // Repository
        // Customer用リポジトリ
        $app['eccube.plugin.postcarrier.repository.postcarrier_customer'] = $app->share(function () use ($app) {
            return $app['orm.em']->getRepository('Plugin\PostCarrier\Entity\PostCarrierCustomer');
        });

        // 新規会員登録/Myページ
        $app['eccube.plugin.postcarrier.repository.postcarrier_mailmaga_customer'] = $app->share(function () use ($app) {
            return $app['orm.em']->getRepository('Plugin\PostCarrier\Entity\PostCarrierMailmagaCustomer');
        });

        $app['eccube.plugin.postcarrier.repository.postcarrier_group'] = $app->share(function () use ($app) {
            return $app['orm.em']->getRepository('Plugin\PostCarrier\Entity\PostCarrierGroup');
        });

        $app['eccube.plugin.postcarrier.repository.postcarrier_group_customer'] = $app->share(function () use ($app) {
            return $app['orm.em']->getRepository('Plugin\PostCarrier\Entity\PostCarrierGroupCustomer');
        });

        $app['eccube.plugin.postcarrier.repository.postcarrier_plugin'] = $app->share(function () use ($app) {
            return $app['orm.em']->getRepository('Plugin\PostCarrier\Entity\PostCarrierPlugin');
        });

        // Service
        $app['eccube.plugin.postcarrier.service.postcarrier_request'] = $app->share(function () use ($app) {
            return new \Plugin\PostCarrier\Service\PostCarrierRequestService($app);
        });

        // メッセージ登録
        $app['translator'] = $app->share($app->extend('translator', function ($translator, \Silex\Application $app) {
            $translator->addLoader('yaml', new \Symfony\Component\Translation\Loader\YamlFileLoader());
            $file = __DIR__ . '/../Resource/locale/message.' . $app['locale'] . '.yml';
            if (file_exists($file)) {
                $translator->addResource('yaml', $file, $app['locale']);
            }
            return $translator;
        }));

        // load config
        // $conf = $app['config'];
        // $app['config'] = $app->share(function () use ($conf) {
        //     $confarray = array();
        //     $path_file = __DIR__ . '/../Resource/config/path.yml';
        //     if (file_exists($path_file)) {
        //         $config_yml = Yaml::parse(file_get_contents($path_file));
        //         if (isset($config_yml)) {
        //             $confarray = array_replace_recursive($confarray, $config_yml);
        //         }
        //     }

        //     $constant_file = __DIR__ . '/../Resource/config/constant.yml';
        //     if (file_exists($constant_file)) {
        //         $config_yml = Yaml::parse(file_get_contents($constant_file));
        //         if (isset($config_yml)) {
        //             $confarray = array_replace_recursive($confarray, $config_yml);
        //         }
        //     }

        //     return array_replace_recursive($conf, $confarray);
        // });

        // ログファイル設定
        $app['monolog.PostCarrier'] = $app->share(function ($app) {

            $logger = new $app['monolog.logger.class']('plugin.PostCarrier');

            $file = $app['config']['root_dir'] . '/app/log/PostCarrier.log';
            $RotateHandler = new RotatingFileHandler($file, $app['config']['log']['max_files'], Logger::INFO);
            $RotateHandler->setFilenameFormat(
                'PostCarrier_{date}',
                'Y-m-d'
            );

            $logger->pushHandler(
                new FingersCrossedHandler(
                    $RotateHandler,
                    new ErrorLevelActivationStrategy(Logger::INFO)
                )
            );

            return $logger;
        });

        // メニュー登録
        $app['config'] = $app->share($app->extend('config', function ($config) {
            $addNavi = array(
                'id' => 'postcarrier',
                'name' => "ポストキャリア管理",
                'has_child' => true,
                'icon' => 'cb-comment', // TODO: 何か変えたいな
                'child' => array(
                    array(
                        'id' => "postcarrier",
                        'name' => "配信内容設定",
                        'url' => "admin_postcarrier",
                    ),
                    array(
                        'id' => "postcarrier_template",
                        'name' => "テンプレート設定",
                        'url' => "admin_postcarrier_template",
                    ),
                    array(
                        'id' => "postcarrier_history",
                        'name' => "配信履歴",
                        'url' => "admin_postcarrier_history",
                    ),
                    array(
                        'id' => "postcarrier_schedule",
                        'name' => "スケジュール一覧",
                        'url' => "admin_postcarrier_schedule",
                    ),
                    array(
                        'id' => "postcarrier_stepmail",
                        'name' => "ステップメール一覧",
                        'url' => "admin_postcarrier_stepmail",
                    ),
                    array(
                        'id' => "postcarrier_mailcust",
                        'name' => "メルマガ専用会員管理",
                        'url' => "admin_postcarrier_mailcust",
                    ),
                    array(
                        'id' => "postcarrier_discard",
                        'name' => "配信除外アドレス",
                        'url' => "admin_postcarrier_discard",
                    ),
                    array(
                        'id' => "postcarrier_counter",
                        'name' => "月次配信件数",
                        'url' => "admin_postcarrier_counter",
                    ),
                ),
            );

            // XXX この部分の意味は?
            $nav = $config['nav'];
            foreach ($nav as $key => $val) {
                if ("setting" == $val['id']) {
                    array_splice($nav, $key, 0, array($addNavi));
                    break;
                }
            }
            $config['nav'] = $nav;

            return $config;
        }));
    }

    public function boot(BaseApplication $app)
    {
    }
}
