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

namespace Plugin\PostCarrier\Controller;

use Eccube\Application;
use Eccube\Common\Constant;
use Eccube\Controller\AbstractController;
use Eccube\Event\EccubeEvents;
use Eccube\Event\EventArgs;
use Eccube\Exception\CartException;
use Symfony\Component\HttpFoundation\Request;

class PostCarrierBlockController extends AbstractController
{
    public function block(Application $app, Request $request)
    {
        $form = $app['form.factory']
            ->createBuilder('postcarrier_mailmaga_form_block')
            ->getForm();

        if ('POST' !== $request->getMethod()) {
            return $app->render('Block/plg_postcarrier_mailmaga_form.twig', array(
                'form' => $form->createView(),
            ));
        }

        $action = $request->get('action');
        $return_page = '';
        if ($action == 'subscribe') {
            $return_page = 'plg_postcarrier_mailmaga_subscribe';
        } else if ($action == 'unsubscribe') {
            $return_page = 'plg_postcarrier_mailmaga_unsubscribe';
        } else {
            return $app->redirect($app->url('homepage'));
        }

        $form->handleRequest($request);
        $formData = $form->getData();
        if ($form->isValid()) {
            $GroupCustomer = $app['eccube.plugin.postcarrier.repository.postcarrier_group_customer']->findOneBy(array('group_id' => 1, 'email' => $formData['email']));
            if ($action == 'subscribe') {
                if (is_null($GroupCustomer)) {
                    $GroupCustomer = new \Plugin\PostCarrier\Entity\PostCarrierGroupCustomer();
                    $GroupCustomer->setGroupId(1);
                    $GroupCustomer->setEmail($formData['email']);
                    $app['eccube.plugin.postcarrier.repository.postcarrier_group_customer']->save($GroupCustomer);
                }
            } else if ($action == 'unsubscribe'){
                if (!is_null($GroupCustomer)) {
                    $app['eccube.plugin.postcarrier.repository.postcarrier_group_customer']->delete($GroupCustomer);
                }
            }

            return $app->redirect($app->url('user_data', array('route' => $return_page, 'status' => 'success')));
        } else {
            return $app->redirect($app->url('user_data', array('route' => $return_page, 'status' => 'failure')));
        }
    }
}
