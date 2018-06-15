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

use Eccube\Form\DataTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

class PostCarrierOrderDetailType extends AbstractType
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $config = $this->app['config'];

        $builder
            ->add('new', 'hidden', array(
                'required' => false,
                'mapped' => false,
                'data' => 1
            ))
            ->add('quantity', 'text', array(
                'constraints' => array(
                    new Assert\Length(array(
                        'max' => 3,
                    )),
                    new Assert\Regex(array(
                        'pattern' => "/^\d+$/u",
                        'message' => 'form.type.numeric.invalid'
                    )),
                ),
                'attr' => array('size' => '3'),
            ));

        $builder
            ->add($builder->create('Product', 'hidden')
                ->addModelTransformer(new DataTransformer\EntityToIdTransformer(
                    $this->app['orm.em'],
                    '\Eccube\Entity\Product'
                )))
            ->add($builder->create('ProductClass', 'hidden')
                ->addModelTransformer(new DataTransformer\EntityToIdTransformer(
                    $this->app['orm.em'],
                    '\Eccube\Entity\ProductClass'
                )));

        $app = $this->app;
        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) use ($app) {
            // モーダルからのPOST時に、金額等をセットする.
            if ('modal' === $app['request']->get('modal')) {
                $data = $event->getData();
                // 新規明細行の場合にセット.
                if (isset($data['new'])) {
                    /*
                    $ProductClass = $app['eccube.repository.product_class']
                        ->find($data['ProductClass']);
                    $Product = $ProductClass->getProduct();
                    $TaxRule = $app['eccube.repository.tax_rule']->getByRule($Product, $ProductClass);
                    */

                    //$data['price'] = $ProductClass->getPrice02();
                    $data['quantity'] = empty($data['quantity']) ? 1 : $data['quantity'];
                    //$data['tax_rate'] = $TaxRule->getTaxRate();
                    $event->setData($data);
                }
            }
        });

        $builder->addEventSubscriber(new \Eccube\Event\FormEventSubscriber());
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Plugin\PostCarrier\Entity\PostCarrierOrderDetail',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'postcarrier_order_detail';
    }
}
