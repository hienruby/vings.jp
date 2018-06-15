<?php
/*
* Plugin Name : SiteMap
*
* Copyright (C) BraTech Co., Ltd. All Rights Reserved.
* http://www.bratech.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\SiteMap\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConfigType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('changefreq', 'choice', array(
                'label' => '更新頻度',
                'required' => false,
                'choices' => array(
                    '' => '',
                    'always'  => 'always',
                    'hourly'  => 'hourly',
                    'daily'   => 'daily',
                    'weekly'  => 'weekly',
                    'monthly' => 'monthly',
                    'yearly'  => 'yearly',
                    'never'   => 'never',
                ),
            ))
            ->add('priority', 'choice', array(
                'label' => '重要度',
                'required' => false,
                'choices' => array(
                    '0.0' => '0.0',
                    '0.1' => '0.1',
                    '0.2' => '0.2',
                    '0.3' => '0.3',
                    '0.4' => '0.4',
                    '0.5' => '0.5',
                    '0.6' => '0.6',
                    '0.7' => '0.7',
                    '0.8' => '0.8',
                    '0.9' => '0.9',
                    '1.0' => '1.0',
                ),
            ))
            ->addEventListener(FormEvents::POST_SUBMIT, function ($event) {
                $form = $event->getForm();
                $data = $form->getData();
            })
        ;

    }

    public function getName()
    {
        return 'sitemap_setting';
    }
}
