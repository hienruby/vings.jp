<?php
/*
* This file is part of the Recommendify3-plugin package.
*
* (c) Nobuhiko Kimoto All Rights Reserved.
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
 */

namespace Plugin\Recommendify3;

use Eccube\Common\Constant;
use Eccube\Entity\BlockPosition;
use Eccube\Entity\Master\DeviceType;
use Eccube\Entity\PageLayout;
use Eccube\Plugin\AbstractPluginManager;
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

    /**
     * @var string コピー元ブロックファイル
     */
    private $originBlock;

    /**
     * @var string ブロック名
     */
    private $blockName = 'この商品を買った人はこんな商品も買っていますプラグイン';

    /**
     * @var string ブロックファイル名
     */
    private $blockFileName = 'recommendify3_product_block';

    public function __construct()
    {
        // コピー元ブロックファイル
        $this->originBlock = __DIR__ . '/Resource/template/Block/' . $this->blockFileName . '.twig';
    }

    public function install($config, $app)
    {
    }

    public function uninstall($config, $app)
    {
        // ブロックの削除
        $this->removeBlock($app);
    }

    public function enable($config, $app)
    {
        // ブロックへ登録
        $this->copyBlock($app);
    }

    public function disable($config, $app)
    {
        // ブロックの削除
        $this->removeBlock($app);
    }

    public function update($config, $app)
    {

    }

    /**
     * ブロックを登録
     *
     * @param $app
     * @throws \Exception
     */
    private function copyBlock($app)
    {

        // ファイルコピー
        $file = new Filesystem();
        // ブロックファイルをコピー
        $file->copy($this->originBlock, $app['config']['block_realdir'] . '/' . $this->blockFileName . '.twig');

        $em = $app['orm.em'];
        $em->getConnection()->beginTransaction();
        try {
            $DeviceType = $app['eccube.repository.master.device_type']->find(DeviceType::DEVICE_TYPE_PC);

            /** @var \Eccube\Entity\Block $Block */
            $Block = $app['eccube.repository.block']->findOrCreate(null, $DeviceType);

            // Blockの登録
            $Block->setName($this->blockName);
            $Block->setFileName($this->blockFileName);
            $Block->setDeletableFlg(Constant::DISABLED);
            $Block->setLogicFlg(1);
            $em->persist($Block);
            $em->flush($Block);

            // BlockPositionの登録
            $blockPos = $em->getRepository('Eccube\Entity\BlockPosition')->findOneBy(
                array('page_id' => 3, 'target_id' => PageLayout::TARGET_ID_MAIN_BOTTOM),
                array('block_row' => 'DESC'));

            $BlockPosition = new BlockPosition();

            // ブロックの順序を変更
            if ($blockPos) {
                $blockRow = $blockPos->getBlockRow() + 1;
                $BlockPosition->setBlockRow($blockRow);
            } else {
                // 1番目にセット
                $BlockPosition->setBlockRow(1);
            }

            $PageLayout = $app['eccube.repository.page_layout']->find(3);

            $BlockPosition->setPageLayout($PageLayout);
            $BlockPosition->setPageId($PageLayout->getId());
            $BlockPosition->setTargetId(PageLayout::TARGET_ID_MAIN_BOTTOM);
            $BlockPosition->setBlock($Block);
            $BlockPosition->setBlockId($Block->getId());
            $BlockPosition->setAnywhere(Constant::DISABLED);

            $em->persist($BlockPosition);
            $em->flush($BlockPosition);

            $em->getConnection()->commit();

        } catch (\Exception $e) {
            $em->getConnection()->rollback();
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
        $file = new Filesystem();
        $file->remove($app['config']['block_realdir'] . '/' . $this->blockFileName . '.twig');

        // Blockの取得(file_nameはアプリケーションの仕組み上必ずユニーク)
        /** @var \Eccube\Entity\Block $Block */
        $Block = $app['eccube.repository.block']->findOneBy(array('file_name' => $this->blockFileName));

        if ($Block) {
            $em = $app['orm.em'];
            $em->getConnection()->beginTransaction();

            try {
                // BlockPositionの削除
                $blockPositions = $Block->getBlockPositions();
                /** @var \Eccube\Entity\BlockPosition $BlockPosition */
                foreach ($blockPositions as $BlockPosition) {
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
}
