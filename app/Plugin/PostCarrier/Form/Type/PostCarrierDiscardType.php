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
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class PostCarrierDiscardType extends AbstractType
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
            ->add('email', 'email', array(
                'label' => '配信除外アドレス',
                'required' => false,
                /*
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
                */
            ))
            ->add('import_file', 'file', array(
                'label' => false,
                'mapped' => false,
                'required' => false,
                /*
                'constraints' => array(
                    new Assert\NotBlank(array('message' => 'ファイルを選択してください。')),
                    new Assert\File(array(
                        'maxSize' => $app['config']['csv_size'] . 'M',
                        'maxSizeMessage' => 'CSVファイルは' . $app['config']['csv_size'] . 'M以下でアップロードしてください。',
                    )),
                ),
                */
            ))
            ->addEventSubscriber(new \Eccube\Event\FormEventSubscriber());
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'postcarrier_discard';
    }
}
