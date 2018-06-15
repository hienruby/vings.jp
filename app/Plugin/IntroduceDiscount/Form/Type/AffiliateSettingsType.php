<?php
/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) 2000-2015 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

namespace Plugin\IntroduceDiscount\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Plugin\Coupon\Form\Type;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

class AffiliateSettingsType extends AbstractType
{

    private $app;

    public function __construct(\Eccube\Application $app)
    {
        $this->app = $app;
    }

    /**
     * Build config type form
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return type
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $config = $this->app['config'];

        $builder
        ->add('id', 'text', array(
            'label' => 'ID',
            'required' => false,
            'attr' => array('readonly' => 'readonly'),
        ))
        ->add('introduce_conversion_discount_rate', 'integer', array(
            'label' => '紹介者への割引率(%)',
            'required' => true,
            'constraints' => array(
                new Assert\NotBlank(),
                new Assert\Range(array(
                    'min' => 0,
                    'max' => 100,
                ))
            ),
        ))
        ->add('meet_conversion_discount_rate', 'integer', array(
            'label' => '招待者への割引率(%)',
            'required' => true,
            'constraints' => array(
                new Assert\NotBlank(),
                new Assert\Range(array(
                    'min' => 0,
                    'max' => 100,
                ))
            ),
        ))
        ->addEventSubscriber(new \Eccube\Event\FormEventSubscriber());
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Plugin\IntroduceDiscount\Entity\AffiliateSettings',
        ));
    }


    /**
     *
     * @ERROR!!!
     *
     */
    public function getName()
    {
        return 'admin_affiliate';
    }
}
