<?php

/*
 * This file is part of the PostCarrier
 *
 * Copyright(c) 2016 IPLOGIC CO.,LTD. All Rights Reserved.
 * http://www.iplogic.co.jp
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\PostCarrier;

use Eccube\Plugin\AbstractPluginManager;
use Eccube\Common\Constant;
use Eccube\Entity\BlockPosition;
use Eccube\Entity\Master\DeviceType;
use Eccube\Entity\PageLayout;
use Eccube\Util\Cache;
use Symfony\Component\Filesystem\Filesystem;

class PluginManager extends AbstractPluginManager
{
    /**
     * @var string コピー元リソースディレクトリ
     */
    private $origin;

    /**
     * @var string コピー先リソースディレクトリ
     */
    private $target;

    public function __construct()
    {
        // コピー元のディレクトリ
        $this->origin = __DIR__.'/Resource/assets';
        // コピー先のディレクトリ
        $this->target = '/postcarrier';
    }

    /**
     * プラグインインストール時の処理
     *
     * @param $config
     * @param $app
     * @throws \Exception
     */
    public function install($config, $app)
    {
        $this->migrationSchema($app, __DIR__ . '/Migration', $config['code']);

        // リソースファイルのコピー
        $this->copyAssets($app);
    }

    /**
     * プラグイン削除時の処理
     *
     * @param $config
     * @param $app
     */
    public function uninstall($config, $app)
    {
        $this->migrationSchema($app, __DIR__ . '/Migration', $config['code'], 0);
        // リソースファイルの削除
        $this->removeAssets($app);

        $this->removeBlock($app);
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
        $this->copyBlock($app);
    }

    /**
     * プラグイン無効時の処理
     *
     * @param $config
     * @param $app
     */
    public function disable($config, $app)
    {
        $this->removeBlock($app);
    }

    public function update($config, $app)
    {
        $this->migrationSchema($app, __DIR__ . '/Migration', $config['code']);
    }

    /**
     * リソースファイル等をコピー
     *
     * @param $app
     */
    private function copyAssets($app)
    {
        $file = new Filesystem();
        $file->mirror($this->origin, $app['config']['plugin_html_realdir'].$this->target.'/assets');
    }

    /**
     * コピーしたリソースファイルなどを削除
     *
     * @param $app
     */
    private function removeAssets($app)
    {
        $file = new Filesystem();
        $file->remove($app['config']['plugin_html_realdir'].$this->target);
    }

   /**
     * ブロックファイルをブロックディレクトリにコピーしてDBに登録
     *
     * @param $app
     * @throws \Exception
     */
    private function copyBlock($app)
    {
        $base = __DIR__ . '/Resource/template/block';
        $block = $app['config']['block_realdir'];
        $user_data = $app['config']['user_data_realdir'];

        $file = new Filesystem();
        $file->copy("$base/plg_postcarrier_mailmaga_form.twig", "$block/plg_postcarrier_mailmaga_form.twig");
        $file->copy("$base/plg_postcarrier_mailmaga_subscribe.twig", "$user_data/plg_postcarrier_mailmaga_subscribe.twig");
        $file->copy("$base/plg_postcarrier_mailmaga_unsubscribe.twig", "$user_data/plg_postcarrier_mailmaga_unsubscribe.twig");

        $app['orm.em']->getConnection()->beginTransaction();
        try {
            $Block = $this->registerBlock($app);

            $app['orm.em']->getConnection()->commit();
        } catch (\Exception $e) {
            $app['orm.em']->getConnection()->rollback();
            throw $e;
        }
    }

    /**
     * ブロックを削除
     *
     * @param $app
     * @throws \Exception
     */
    private function removeBlock($app)
    {
        $block = $app['config']['block_realdir'];
        $user_data = $app['config']['user_data_realdir'];

        // ブロックファイルを削除
        $file = new Filesystem();
        $file->remove("$block/plg_postcarrier_mailmaga_form.twig");
        $file->remove("$user_data/plg_postcarrier_mailmaga_subscribe.twig");
        $file->remove("$user_data/plg_postcarrier_mailmaga_unsubscribe.twig");

        // Blockの取得(file_nameはアプリケーションの仕組み上必ずユニーク)
        /** @var \Eccube\Entity\Block $Block */
        $Block = $app['eccube.repository.block']->findOneBy(array('file_name' => 'plg_postcarrier_mailmaga_form'));
        if ($Block)
        {
            $em = $app['orm.em'];
            $em->getConnection()->beginTransaction();
            try {
                // BlockPositionの削除
                $blockPositions = $Block->getBlockPositions();
                /** @var \Eccube\Entity\BlockPosition $BlockPosition */
                foreach ($blockPositions as $BlockPosition)
                {
                    $Block->removeBlockPosition($BlockPosition);
                    $em->remove($BlockPosition);
                }
                // Blockの削除
                $em->remove($Block);
                $em->flush();
                $em->getConnection()->commit();
            } catch (\Exception $e) {
                $em->getConnection()->rollback();
                throw $e;
            }
        }
        Cache::clear($app, false);
    }

    /**
     * ブロックの登録
     *
     * @return \Eccube\Entity\Block
     */
    private function registerBlock($app)
    {
        $DeviceType = $app['eccube.repository.master.device_type']->find(DeviceType::DEVICE_TYPE_PC);
        /** @var \Eccube\Entity\Block $Block */
        $Block = $app['eccube.repository.block']->findOrCreate(null, $DeviceType);

        $Block->setName('メルマガ会員登録解除');
        $Block->setFileName('plg_postcarrier_mailmaga_form');
        $Block->setDeletableFlg(Constant::DISABLED);
        $Block->setLogicFlg(1);
        $app['orm.em']->persist($Block);
        $app['orm.em']->flush($Block);

        return $Block;
    }
}
