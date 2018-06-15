<?php
/*
* Plugin Name : ProductOption
*
* Copyright (C) 2015 BraTech Co., Ltd. All Rights Reserved.
* http://www.bratech.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\CategoryCheckbox;

use Eccube\Application;
use Eccube\Event\EventArgs;
use Eccube\Event\TemplateEvent;
use Plugin\Monetrack\Service\TwigService;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class Event
{
    public function onAdminProductEditInitialize(EventArgs $event){
        $app = Application::getInstance();

        $qb = $app['eccube.repository.category']->createQueryBuilder('c1')
            ->select('c1, c2, c3, c4, c5')
            ->leftJoin('c1.Children', 'c2')
            ->leftJoin('c2.Children', 'c3')
            ->leftJoin('c3.Children', 'c4')
            ->leftJoin('c4.Children', 'c5')
            ->orderBy('c1.rank', 'DESC')
            ->addOrderBy('c2.rank', 'DESC')
            ->addOrderBy('c3.rank', 'DESC')
            ->addOrderBy('c4.rank', 'DESC')
            ->addOrderBy('c5.rank', 'DESC');

        $qb->where('c1.Parent IS NULL');
        $result = $qb->getQuery()
            ->useResultCache(true, 1200)
            ->getResult();

        $Categories = array();
        foreach ($result as $Category) {
            $Categories = array_merge($Categories, $Category->getSelfAndDescendants());
        }

        /* @var $builder FormBuilder */
        $builder = $event->getArgument('builder');
        $builder
            ->remove('Category')
            ->add('Category', 'entity', array(
                'class' => 'Eccube\Entity\Category',
                'property' => 'name',
                'label' => '商品カテゴリ',
                'multiple' => true,
                'mapped' => false,
                'expanded' => true,
                'choices' => $Categories,
            ));
    }

    public function onAdminProductEditRendered(TemplateEvent $event){
        $app = Application::getInstance();
        $service = $app['plugin.category_checkbox.service.twig'];
        $service->initWithTemplateEvent($event);
        $insert = <<< INSERT
{% if form.Category is defined %}
	{% form_theme form.Category 'CategoryCheckbox/Resource/template/admin/Form/form_layout.twig' %}
{% endif %}
INSERT;

        $service->prependToBlock('main', $insert);
        $event->setSource($service->getSource());
    }
}
