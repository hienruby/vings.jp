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
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

class PostCarrierTemplateEditType extends AbstractType
{
    public $app;

    public function __construct(\Silex\Application $app)
    {
        $this->app = $app;
    }

    /**
    * {@inheritdoc}
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $app = $this->app;

        $itemData = \Plugin\PostCarrier\Service\LC_MDL_ECQUBELEY_CONSTANTS::getInsetList();

        $builder
            // 管理情報
            ->add('adm_name', 'text', array(
                'label' => '管理用名称',
                'required' => false,
                'constraints' => array(
                    new Assert\Length(array('max' => 255)),
                ),
            ))
            ->add('adm_note', 'textarea', array(
                'label' => '備考',
                'required' => false,
                'constraints' => array(
                    new Assert\Length(array('max' => 5000)),
                ),
            ))
            // テンプレート編集
            ->add('mail_method', 'choice', array(
                'label' => 'メール形式',
                'required' => true,
                'expanded' => true,
                'choices' => array(1 => 'HTML', 2 => 'テキスト'),
                'empty_data' => '2',
            ))
            ->add('sendFor', 'choice', array(
                'label' => 'メール種別',
                'required' => true,
                'expanded' => true,
                'choices' => array('PC' => 'パソコン向け', 'MOBILE' => '携帯電話向け'),
                'empty_data' => 'PC',
            ))
            ->add('fromAddr', 'email', array(
                'label' => '送信者アドレス',
                'required' => true,
                'constraints' => array(
                    new Assert\NotBlank(),
                    // configでこの辺りは変えられる方が良さそう
                    new Assert\Email(array('strict' => true)),
                    new Assert\Regex(array(
                        'pattern' => '/^[[:graph:][:space:]]+$/i',
                        'message' => 'form.type.graph.invalid',
                    )),
                    new Assert\Length(array('max' => 128)),
                ),
            ))
            ->add('fromDisp', 'text', array(
                'label' => '送信者名',
                'required' => false,
                'constraints' => array(
                    new Assert\Length(array('max' => 50)),
                ),
            ))
            ->add('replytoAddr', 'email', array(
                'label' => '返信先アドレス',
                'required' => false,
                'constraints' => array(
                    // configでこの辺りは変えられる方が良さそう
                    new Assert\Email(array('strict' => true)),
                    new Assert\Regex(array(
                        'pattern' => '/^[[:graph:][:space:]]+$/i',
                        'message' => 'form.type.graph.invalid',
                    )),
                    new Assert\Length(array('max' => 128)),
                ),
            ))
            ->add('replytoDisp', 'text', array(
                'label' => '返信先名',
                'required' => false,
                'constraints' => array(
                    new Assert\Length(array('max' => 50)),
                ),
            ))
            ->add('subject_item', 'choice', array(
                'label' => '差し込み項目',
                'required' => false,
                'choices' => $itemData,
                'empty_value' => null,
            ))
            ->add('subject', 'text', array(
                'label' => '件名',
                'required' => true,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array('max' => 100)),
                )
            ))
            ->add('body', 'textarea', array(
                'label' => '本文',
                'required' => true,
                'attr' => array('cols' => '90', 'rows' => '30'),
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array('max' => 100000)),
                )
            ))
            ->add('sub_body_item', 'choice', array(
                'label' => '代替本文の差し込み項目',
                'required' => false,
                'choices' => $itemData,
                'empty_value' => null,
            ))
            ->add('sub_body', 'textarea', array(
                'label' => '代替本文',
                'required' => false,
                'attr' => array('cols' => '90', 'rows' => '15'),
                'constraints' => array(
                    new Assert\Length(array('max' => 50000)),
                ),
            ))
            ->add('id', 'hidden')
            ->addEventSubscriber(new \Eccube\Event\FormEventSubscriber());
    }

    /**
    * {@inheritdoc}
    */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        /*
        $resolver->setDefaults(array(
            'data_class' => 'Plugin\PostCarrier\Entity\PostCarrierTemplate',
        ));
        */
    }

    /**
    * {@inheritdoc}
    */
    public function getName()
    {
        return 'postcarrier_template_edit';
    }
}
