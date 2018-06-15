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

namespace Plugin\ProductOption\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContext;

class OrderDetailOptionExtention extends AbstractTypeExtension
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

        $builder
                ->add('serial', 'hidden', array(
                    'required' => false,
                    'mapped' => false,
                ));
        $builder
            ->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) use($app) {
                /** @var \Eccube\Entity\Product $data */
                $OrderDetail = $event->getData();
                /** @var \Symfony\Component\Form\Form $form */
                $form = $event->getForm();
                if (is_null($OrderDetail)) {
                    return;
                }
                $setData = $app['eccube.productoption.repository.order_detail']->findOneBy(array('order_detail_id' => $OrderDetail->getId()));
                if($setData){
                    $serial = $app['serializer']->serialize($setData->getOrderOption()->getSerial(), 'json');
                    $form['serial']->setData($serial);
                }
            });
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return 'order_detail';
    }

}
