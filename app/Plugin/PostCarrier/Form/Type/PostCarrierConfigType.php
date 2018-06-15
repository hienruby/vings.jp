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

namespace Plugin\PostCarrier\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class PostCarrierConfigType extends AbstractType
{
    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('server_url', 'text', array(
                'constraints' => array(
                    new Assert\NotBlank(),
                ),
            ))
            ->add('shop_id', 'text', array(
                'constraints' => array(
                    new Assert\NotBlank(),
                ),
            ))
            ->add('shop_pass', 'text', array(
                'constraints' => array(
                    new Assert\NotBlank(),
                ),
            ))
            ->add('php_binary_path', 'text', array(
                /*
                'constraints' => array(
                    new Assert\NotBlank(),
                ),
                */
            ))
            ->add('email04', 'email', array(
                'constraints' => array(
                    // configでこの辺りは変えられる方が良さそう
                    new Assert\Email(array('strict' => true)),
                    new Assert\Regex(array(
                        'pattern' => '/^[[:graph:][:space:]]+$/i',
                        'message' => 'form.type.graph.invalid',
                    )),
                ),
            ))
            ->add('sample_insert_flg', 'hidden', array(
            ))
            /*
            ->add('sample_insert_flg', 'choice', array(
                'label' => 'サンプルメールテンプレートのインストール',
                'required' => true,
                'multiple' => true,
                'choices' => array(0 => 'インストールする', 1 => 'インストールしない'),
            ))
            */
            ->add('disable_check', 'choice', array(
                'label' => '動作モード',
                'required' => true,
                'expanded' => true,
                'choices' => array(0 => '本番モード', 1 => 'テストモード'),
            ))
            ->add('ssl_check', 'checkbox', array(
                'label' => '導入済',
                'required' => true,
            ))
            ->addEventSubscriber(new \Eccube\Event\FormEventSubscriber());
    }

    public function getName()
    {
        return 'postcarrier_config';
    }
}
