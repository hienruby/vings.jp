<?php

/*
 * This file is part of the CategoryCheckbox
 *
 * Copyright (C) 2017 CategoryCheckbox
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CategoryCheckbox\Controller;

use Eccube\Application;
use Symfony\Component\HttpFoundation\Request;

class ConfigController
{

    /**
     * CategoryCheckbox用設定画面
     *
     * @param Application $app
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Application $app, Request $request)
    {

        $form = $app['form.factory']->createBuilder('categorycheckbox_config')->getForm();

            $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();

                // add code...
            }

        return $app->render('CategoryCheckbox/Resource/template/admin/config.twig', array(
            'form' => $form->createView(),
        ));
    }

}
