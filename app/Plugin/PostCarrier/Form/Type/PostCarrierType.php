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
use \Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\EntityRepository;

class PostCarrierType extends AbstractType
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
        $app = $this->app;
        $config = $this->app['config'];

        $itemData = \Plugin\PostCarrier\Service\LC_MDL_ECQUBELEY_CONSTANTS::getInsetList();
        $eventList = \Plugin\PostCarrier\Service\LC_MDL_ECQUBELEY_CONSTANTS::getStepMailNameArray();
        $eventListMail = \Plugin\PostCarrier\Service\LC_MDL_ECQUBELEY_CONSTANTS::getStepMailNameArray(1);

        // テンプレートを取得
        $templates = array();
        $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getTemplateList($isError, $total, 50);
        if (!$isError) {
            foreach ($result['templates'] as $tpl) {
                $templates[$tpl['template_id']] = "【" . $tpl['type'] . "】" . $tpl['subject'];
            }
        }

        $arrPeriodicDay = range(0, 31); unset($arrPeriodicDay[0]);

        $builder
            ->add('mail_type_web', 'checkbox', array(
                'label' => '本会員を検索する',
                'required' => false,
            ))
            ->add('mail_type_c', 'checkbox', array(
                'label' => 'メルマガ会員を検索する',
                'required' => false,
            ))
            ->add('mail_type', 'hidden', array(
                'data' => 5, // 全メールアドレス
            ))
            ->add('htmlmail', 'hidden', array(
            ))
            ->add('re_edit', 'hidden', array(
            ))
            ->add('status', 'order_status', array(
                'label' => '対応状況',
                'empty_value' => '指定なし',
            ))
            ->add('customer_id', 'text', array(
                'required' => false,
                'constraints' => array(
                    new Assert\Length(array('max' => 5000)),
                ),
            ))
            ->add('name', 'text', array(
                'required' => false,
                'constraints' => array(
                    new Assert\Length(array('max' => 5000)),
                ),
            ))
            ->add('kana', 'text', array(
                'required' => false,
                'constraints' => array(
                    new Assert\Regex(array(
                        'pattern' => "/^[ァ-ヶｦ-ﾟー]+(,[ァ-ヶｦ-ﾟー]+)*$/u",
                        'message' => 'form.type.admin.notkanastyle',
                    )),
                    new Assert\Length(array('max' => 5000)),
                ),
            ))
            ->add('email', 'email', array(
                'required' => false,
                'constraints' => array(
                    new Assert\Length(array('max' => 5000)),
                ),
            ))
            ->add('not_emailinc', 'checkbox', array(
                'label' => '指定メールアドレスを除外条件とする',
                'required' => false,
            ))
            ->add('tel', 'text', array(
                'required' => false,
                'constraints' => array(
                    new Assert\Regex(array(
                        'pattern' => "/^[\d-]+(,[\d-]+)*$/u",
                        'message' => 'form.type.admin.nottelstyle',
                    )),
                    new Assert\Length(array('max' => 5000)),
                ),
            ))
            ->add('order_id_start', 'integer', array(
                'required' => false,
                'constraints' => array(
                    new Assert\Length(array('max' => $config['int_len'])),
                ),
            ))
           ->add('order_id_end', 'integer', array(
                'required' => false,
                'constraints' => array(
                    new Assert\Length(array('max' => $config['int_len'])),
                ),
            ))
            ->add('order_date_start', 'date', array(
                'label' => '受注日(FROM)',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'empty_value' => array('year' => '----', 'month' => '--', 'day' => '--'),
            ))
            ->add('order_date_end', 'date', array(
                'label' => '受注日(TO)',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'empty_value' => array('year' => '----', 'month' => '--', 'day' => '--'),
            ))
            ->add('payment_date_start', 'date', array(
                'label' => '入金日(FROM)',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'empty_value' => array('year' => '----', 'month' => '--', 'day' => '--'),
            ))
            ->add('payment_date_end', 'date', array(
                'label' => '入金日(TO)',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'empty_value' => array('year' => '----', 'month' => '--', 'day' => '--'),
            ))
            ->add('commit_date_start', 'date', array(
                'label' => '発送日(FROM)',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'empty_value' => array('year' => '----', 'month' => '--', 'day' => '--'),
            ))
            ->add('commit_date_end', 'date', array(
                'label' => '発送日(TO)',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'empty_value' => array('year' => '----', 'month' => '--', 'day' => '--'),
            ))
            ->add('pref', 'pref', array(
                'label' => '都道府県',
                'required' => false,
            ))
            ->add('sex', 'sex', array(
                'label' => '性別',
                'required' => false,
                'expanded' => true,
                'multiple' => true,
            ))
            ->add('birth_month', 'choice', array(
                'label' => '誕生月',
                'required' => false,
                'choices' => array_merge(array(0=>'今月'), range(1,12)),
                'empty_value' => '指定なし',
            ))
            ->add('birth_date_start', 'date', array(
                'label' => '誕生日',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'empty_value' => array('year' => '----', 'month' => '--', 'day' => '--'),
            ))
            ->add('birth_date_end', 'date', array(
                'label' => '誕生日',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'empty_value' => array('year' => '----', 'month' => '--', 'day' => '--'),
            ))
            ->add('buy_total_from', 'integer', array(
                'label' => '購入金額',
                'required' => false,
                'constraints' => array(
                    new Assert\Length(array('max' => $config['price_len'])),
                ),
            ))
            ->add('buy_total_to', 'integer', array(
                'label' => '購入金額',
                'required' => false,
                'constraints' => array(
                    new Assert\Length(array('max' => $config['price_len'])),
                ),
            ))
            ->add('buy_times_from', 'integer', array(
                'label' => '購入回数',
                'required' => false,
                'constraints' => array(
                    new Assert\Length(array('max' => $config['int_len'])),
                ),
            ))
            ->add('buy_times_to', 'integer', array(
                'label' => '購入回数',
                'required' => false,
                'constraints' => array(
                    new Assert\Length(array('max' => $config['int_len'])),
                ),
            ))
            ->add('create_date_start', 'date', array(
                'label' => '登録日',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'empty_value' => array('year' => '----', 'month' => '--', 'day' => '--'),
            ))
            ->add('create_date_end', 'date', array(
                'label' => '登録日',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'empty_value' => array('year' => '----', 'month' => '--', 'day' => '--'),
            ))
            ->add('first_buy_start', 'date', array(
                'label' => '初回購入日',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'empty_value' => array('year' => '----', 'month' => '--', 'day' => '--'),
            ))
            ->add('first_buy_end', 'date', array(
                'label' => '初回購入日',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'empty_value' => array('year' => '----', 'month' => '--', 'day' => '--'),
            ))
            ->add('last_buy_start', 'date', array(
                'label' => '最終購入日',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'empty_value' => array('year' => '----', 'month' => '--', 'day' => '--'),
            ))
            ->add('last_buy_end', 'date', array(
                'label' => '最終購入日',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'empty_value' => array('year' => '----', 'month' => '--', 'day' => '--'),
            ))
            ->add('buy_product_id', 'text', array(
                'label' => '購入商品ID',
                'required' => false,
                'constraints' => array(
                    new Assert\Length(array('max' => $config['stext_len'])),
                    new Assert\Regex(array(
                        'pattern' => "/^\d+(,\d+)*$/u",
                        //'message' => 'form.type.admin.nottelstyle',
                    )),
                ),
            ))
            ->add('buy_product_id_conjunction', 'choice', array(
                'required' => false,
                'expanded' => true,
                'choices' => array(
                    'or' => 'いずれかの条件に一致（OR）', 'and' => '全ての条件に一致（AND）',
                ),
                'empty_value' => false,
            ))
            ->add('buy_product_id_negation', 'checkbox', array(
                'label' => '除外条件とする',
                'required' => false,
            ))
            ->add('buy_product_code', 'text', array(
                'label' => '購入商品コード',
                'required' => false,
                'constraints' => array(
                    new Assert\Length(array('max' => 5000)),
                ),
            ))
            ->add('buy_product_code_conjunction', 'choice', array(
                'required' => false,
                'expanded' => true,
                'choices' => array(
                    'or' => 'いずれかの条件に一致（OR）', 'and' => '全ての条件に一致（AND）',
                ),
                'empty_value' => false,
            ))
            ->add('buy_product_code_negation', 'checkbox', array(
                'label' => '除外条件とする',
                'required' => false,
            ))
            ->add('buy_product_code2', 'text', array(
                'label' => '購入商品コード',
                'required' => false,
                'constraints' => array(
                    new Assert\Length(array('max' => 5000)),
                ),
            ))
            ->add('buy_product_code_conjunction2', 'choice', array(
                'required' => false,
                'expanded' => true,
                'choices' => array(
                    'or' => 'いずれかの条件に一致（OR）', 'and' => '全ての条件に一致（AND）',
                ),
                'empty_value' => false,
            ))
            ->add('buy_product_code_negation2', 'checkbox', array(
                'label' => '除外条件とする',
                'required' => false,
            ))
            ->add('buy_product_name', 'text', array(
                'label' => '購入商品名',
                'required' => false,
                'constraints' => array(
                    new Assert\Length(array('max' => 5000)),
                ),
            ))
            ->add('buy_product_name_conjunction', 'choice', array(
                'required' => false,
                'expanded' => true,
                'choices' => array(
                    'or' => 'いずれかの条件に一致（OR）', 'and' => '全ての条件に一致（AND）',
                ),
                'empty_value' => false,
            ))
            ->add('buy_product_name_negation', 'checkbox', array(
                'label' => '除外条件とする',
                'required' => false,
            ))
            ->add('buy_category', 'category', array(
                'label' => '商品カテゴリ',
                'required' => false,
                'empty_value' => '指定なし',
            ))
            ->add('payment', 'payment', array(
                'label' => '支払方法',
                'required' => false,
                'expanded' => true,
                'multiple' => true,
            ))
            ->add('customer_status', 'checkbox', array(
                'label' => 'メルマガ希望でない本会員を含める(全ての本会員に配信)',
                'required' => false,
            ))

            // メルマガ会員
            ->add('group', 'postcarrier_group', array(
                    'label' => 'メルマガグループ',
                    'required' => false,
                    'expanded' => true,
                    'multiple' => true,
            ))
            ->add('email_c', 'text', array(
                'label' => 'メールアドレス',
                'required' => false,
                'constraints' => array(
                    new Assert\Length(array('max' => 5000)),
                ),
            ))
            ->add('not_emailinc_c', 'checkbox', array(
                'label' => '指定メールアドレスを除外条件とする',
                'required' => false,
            ))
            ->add('g_create_date_start', 'date', array(
                'label' => '登録日',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'empty_value' => array('year' => '----', 'month' => '--', 'day' => '--'),
            ))
            ->add('g_create_date_end', 'date', array(
                'label' => '登録日',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'empty_value' => array('year' => '----', 'month' => '--', 'day' => '--'),
            ))
            ->add('repeat_address_c', 'checkbox', array(
                'label' => '本会員との重複アドレスは除く',
                'required' => false,
            ))

            // 以降テンプレート選択で使用する項目
            ->add('template', 'choice', array(
                'label' => 'メールテンプレート選択',
                'choices' => $templates,
                'empty_value' => '選択してください',
                'required' => false,
            ))
            ->add('trigger', 'choice', array(
                'choices' => array(
                    'immediate' => '即時配信',
                    'schedule' => 'スケジュール配信',
                    'event' => 'ステップメール',
                    'periodic' => '定期配信',
                ),
                'required' => false,
                'empty_value' => false,
            ))
            // スケジュール配信
            ->add('schedule_date', 'datetime', array(
                'label' => '配信日時',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd HH:mm',
            ))
            // ステップメール配信
            ->add('event', 'choice', array(
                'choices' => $eventList,
            ))
            ->add('eventDay', 'number', array(
                'constraints' => array(
                    new Assert\Length(array(
                        'max' => 3,
                    )),
                    new Assert\Regex(array(
                        'pattern' => "/^\d+$/u",
                        'message' => 'form.type.numeric.invalid'
                    )),
                    new Assert\Range(array('min' => 0, 'max' => 365)),
                ),
            ))
            ->add('eventDaySelect', 'choice', array(
                'choices' => array(
                    'back' => '後',
                ),
                'empty_value' => false,
            ))
            ->add('stepmail_time', 'time', array(
                'label' => '配信時刻',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'choice',
            ))
            ->add('OrderDetails', 'collection', array(
                'type' => new PostCarrierOrderDetailType($app),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
            ))
            ->add('StopOrderDetails', 'collection', array(
                'type' => new PostCarrierOrderDetailType($app),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
            ))
            ->add('event_buy_product_id_conjunction', 'choice', array(
                'required' => false,
                'expanded' => true,
                'choices' => array(
                    'or' => 'いずれかの条件に一致（OR）', 'and' => '全ての条件に一致（AND）',
                ),
                'empty_value' => false,
            ))
            ->add('event_buy_product_count_only', 'number', array(
                'required' => false,
            ))
            // 定期配信
            ->add('periodic_day', 'choice', array(
                'choices' => $arrPeriodicDay,
            ))
            ->add('periodic_time', 'time', array(
                'label' => '配信時刻',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'choice',
            ))

            // テストアドレス
            ->add('testAddress', 'email', array(
                'label' => 'テスト配信アドレス',
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

            // テンプレート 
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
                'required' => true, // 選択肢Noneを無くす
                'expanded' => true,
                'choices' => array(1 => 'HTML', 2 => 'テキスト'),
            ))

            ->add('sendFor', 'choice', array(
                'label' => 'メール種別',
                'required' => true, // 選択肢Noneを無くす
                'expanded' => true,
                'choices' => array('PC' => 'パソコン向け', 'MOBILE' => '携帯電話向け'),
                'empty_data' => 'PC',
            ))

            ->add('fromAddr', 'email', array(
                'label' => '送信者アドレス',
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
                'required' => false,
                /*
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array('max' => 100)),
                )
                */
            ))
            ->add('body', 'textarea', array(
                'label' => '本文',
                'required' => false,
                'attr' => array('cols' => '90', 'rows' => '30'),
                /*
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array('max' => 100000)),
                )
                */
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
            ->add('text_mail_flg', 'choice', array(
                'label' => 'テキストメール希望の会員宛には、この代替本文をテキストメールとして送信する',
                'required' => false,
                'expanded' => true,
                'choices' => array(
                    1 => '送信する', 2 => '送信しない',
                ),
                'empty_value' => false,
            ))
            // 再編集
            ->add('deliveryId', 'hidden')
            // hidden
            ->add('customerCount', 'hidden')
            ->addEventSubscriber(new \Eccube\Event\FormEventSubscriber());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    }

    /**
    * {@inheritdoc}
    */
    public function getName()
    {
        return 'postcarrier';
    }
}
