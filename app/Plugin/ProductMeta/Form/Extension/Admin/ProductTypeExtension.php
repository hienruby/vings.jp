<?php

/*
 * This file is part of the ProductMeta
 *
 * Copyright (C) 2017 ONE HAND RED
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\ProductMeta\Form\Extension\Admin;

use Eccube\Application;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Validator\Constraints as Assert;

class ProductTypeExtension extends AbstractTypeExtension
{

    public $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('author', 'text', array(
                'label' => 'author',
                'required' => false,
                'mapped' => false,
                'constraints' => array(
                    new Assert\Length(array(
                        'max' => $this->app['config']['stext_len'],
                    ))
                )
            ))
            ->add('description', 'text', array(
                'label' => 'description',
                'required' => false,
                'mapped' => false,
                'constraints' => array(
                    new Assert\Length(array(
                        'max' => $this->app['config']['ProductMeta']['const']['stext_len'],
                    ))
                )
            ))
            ->add('keyword', 'text', array(
                'label' => 'keyword',
                'required' => false,
                'mapped' => false,
                'constraints' => array(
                    new Assert\Length(array(
                        'max' => $this->app['config']['ProductMeta']['const']['stext_len'],
                    ))
                )
            ))
            ->add('meta_robots', 'text', array(
                'label' => 'robots',
                'required' => false,
                'mapped' => false,
                'constraints' => array(
                    new Assert\Length(array(
                        'max' => $this->app['config']['stext_len'],
                    ))
                )
            ))->add('meta_tags', 'textarea', array(
                'label' => '追加metaタグ',
                'required' => false,
                'mapped' => false,
                'constraints' => array(
                    new Assert\Length(array(
                        'max' => $this->app['config']['lltext_len'],
                    ))
                )
            ))
            ->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) use ($app) {
                $form = $event->getForm();
                $Product = $event->getData();
                if (is_null($Product->getId())) {
                    // Do nothing
                } else {
                    $ProductMeta = $this->app['productmeta.repository.productmeta']->find($Product->getId());
                    if (is_null($ProductMeta)) {
                        // Do nothing
                    } else {
                        $form->get('author')->setData($ProductMeta->getAuthor());
                        $form->get('description')->setData($ProductMeta->getDescription());
                        $form->get('keyword')->setData($ProductMeta->getKeyword());
                        $form->get('meta_robots')->setData($ProductMeta->getMetaRobots());
                        $form->get('meta_tags')->setData($ProductMeta->getMetaTags());
                    }
                }
            })
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
    }

    public function getExtendedType()
    {
        return 'admin_product';
    }
}