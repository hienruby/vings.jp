<?php
/*
* Plugin Name : GSFeed
*
* Copyright (C) BraTech Co., Ltd. All Rights Reserved.
* http://www.bratech.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\GSFeed\Form\Type;

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
            ->add('brand', 'text', array(
                'label' => 'ブランド名',
                'required' => false
            ))
            ->add('gcategory', 'text', array(
                'label' => 'googleカテゴリー',
                'required' => false
            ))
        ;

    }

    public function getName()
    {
        return 'gsfeed_setting';
    }
}
