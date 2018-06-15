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

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostCarrierGroupType extends AbstractType
{
    /**
     * {@inheritdoc}
     */

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'class' => 'Plugin\PostCarrier\Entity\PostCarrierGroup',
            'multiple'=> true,
            'expanded' => true,
            'query_builder' => function (EntityRepository $er) {
                $qb = $er->createQueryBuilder('g');
                return $qb
                    ->andWhere($qb->expr()->exists('SELECT c.id FROM Plugin\PostCarrier\Entity\PostCarrierGroupCustomer c WHERE g.id = c.group_id AND c.status = 2'))
                    ->orderBy('g.id', 'ASC');
            },
        ));
    }

    public function getParent()
    {
        return 'entity';
    }

    public function getName()
    {
        return 'postcarrier_group';
    }
}
