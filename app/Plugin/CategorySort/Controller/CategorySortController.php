<?php

/*
 * This file is part of the CategorySort
 *
 * Copyright (C) 2017 CategorySort
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CategorySort\Controller;

use Eccube\Application;
use Symfony\Component\HttpFoundation\Request;

class CategorySortController
{

    /**
     * CategorySort画面
     *
     * @param Application $app
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Application $app, Request $request)
    {
        $Categories = $app['eccube.repository.category']
            ->createQueryBuilder('u')
            ->where('u.Parent is null')
            ->orderBy('u.rank', 'DESC')
            ->getQuery()
            ->getResult();

        return $app->render('CategorySort/Resource/template/admin/sort.twig', array(
            'RootCategories' => $Categories,
        ));
    }

    /**
     * CategorySort画面
     *
     * @param Application $app
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function save(Application $app, Request $request)
    {
        if(!$request->isXmlHttpRequest()){
            return $app->json(array(), 400);
        }

        $json_txt = $request->get('categories');
        $categories = json_decode($json_txt, true);
        if(!$categories || !is_array($categories)){
            return $app->json(array(), 400);
        }

        $rank = 1;
        $AllCategories = array();
        $this->setCategoryRank($app, $AllCategories ,$categories, 1, $rank, null);

        $total = count($AllCategories);
        for ($i = 0; $i < $total; $i++){
            $AllCategories[$i]->setRank($total-$i);
        }
        $app['orm.em']->flush();

        return $app->json(array('status' => 200));
    }

    private function setCategoryRank($app, &$AllCategories, $categories, $level, &$rank, $Parent){
        foreach ($categories as $info){
            /* @var $Category \Eccube\Entity\Category */
            $Category = $app['eccube.repository.category']
                ->find($info['id']);
            $Category->setLevel($level);
            $Category->setRank($rank++);
            $Category->setParent($Parent);
            $app['orm.em']->persist($Category);
            $AllCategories[] = $Category;

            if(isset($info['children'])){
                $this->setCategoryRank($app, $AllCategories, $info['children'], $level+1, $rank, $Category);
            }
        }
    }

}
