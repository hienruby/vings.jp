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

namespace Plugin\PostCarrier\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\EntityRepository;

class EntryPostCarrierTypeExtension extends AbstractTypeExtension
{
    private $app;

    public function __construct(\Eccube\Application $app)
    {
        $this->app = $app;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*
        $builder
            ->add('plg_postcarrier_mailmaga_flg', 'choice', array(
                'label' => 'メールマガジン送付について',
                'choices'   => array(
                    '1' => 'HTMLメールを希望',
                    '2' => 'テキストメールを希望',
                    '3' => '希望しない',
                ),
                'expanded' => true,
                'multiple' => false,
                'required' => true,
                'constraints' => array(
                    new Assert\NotBlank(),
                ),
                'mapped' => false,
            ))
            ;
        */
    }

    /*
     * {@inheritdoc}
     */
    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $freeze = $form->getConfig()->getAttribute('freeze');

        if ($freeze) {
            $value = $view->vars['form']->children['plg_postcarrier_mailmaga_flg']->vars['data'];
            $choices = $view->vars['form']->children['plg_postcarrier_mailmaga_flg']->vars['choices'];
            foreach ($choices as $choice) {
                if ($choice->value == $value) {
                    $view->vars['form']->children['plg_postcarrier_mailmaga_flg']->vars['data'] = array('name' => $choice->label, 'id' => $value);
                    break;
                }
            }
        }
    }

    public function getExtendedType()
    {
        return 'entry';
    }
}