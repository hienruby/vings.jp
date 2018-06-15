<?php
/*
* This file is part of the Recommendify3-plugin package.
*
* (c) Nobuhiko Kimoto All Rights Reserved.
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
 */

namespace Plugin\Recommendify3\Controller\Block;

use Eccube\Application;

class Recommendify3Controller
{
    /**
     * @param Application $app
     */
    public function index(Application $app)
    {
        $id = $app['request']->get('id');

        // todo 存在する商品idかどうかのチェックが必要
        if (!$id) {
            return $app['view']->render('Block/recommendify3_product_block.twig', array(
                'Recommendify3Products' => array(),
            ));
        }

        try {
            $productIds =
                $app['db']->fetchAll(
                    '
                    SELECT
                        distinct dtb_order_detail.product_id as recommend_product_id
                    FROM
                        dtb_order_detail
                            JOIN dtb_order USING ( order_id )
                            JOIN dtb_product USING ( product_id )
                    WHERE
                        dtb_order_detail.product_id <> ?
                        AND dtb_product.del_flg = 0
                        AND dtb_product.status = 1
                        AND dtb_order.order_email
                    IN (
                        SELECT dtb_order.order_email
                        FROM dtb_order_detail
                        JOIN dtb_order USING ( order_id )
                        WHERE dtb_order_detail.product_id = ?
                        )
                    LIMIT 24
                    ',
            array($id, $id)
            );


            if ($productIds) {
                foreach($productIds as $productId) {
                    $ids[] = $productId['recommend_product_id'];
                }

                $qb = $app['eccube.repository.product']->getQueryBuilderBySearchData(array());
                $qb->andWhere('p.id IN (:string)');
                $qb->setParameter('string', $ids, \Doctrine\DBAL\Connection::PARAM_STR_ARRAY);

                $result = $qb->getQuery()->getResult();
            } else {
                $result = array();
                // ない場合の処理も考える？
            }

        } catch (NoResultException $e) {
        }

        return $app['view']->render('Block/recommendify3_product_block.twig', array(
            'Recommendify3Products' => $result,
        ));
    }
}
