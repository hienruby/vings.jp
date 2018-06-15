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

namespace Plugin\PostCarrier;

use Eccube\Common\Constant;
use Eccube\Entity\Master\CustomerStatus;
use Eccube\Event\TemplateEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\CssSelector\CssSelector;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Id\SequenceGenerator;
use Eccube\Event\EventArgs;

class PostCarrierEvent
{

    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function onCustomerEditBefore(EventArgs $event)
    {
        $builder = $event->getArgument('builder');
        $Customer = $event->getArgument('Customer');

        $MailmagaCustomer = $this->app['eccube.plugin.postcarrier.repository.postcarrier_mailmaga_customer']
            ->findOneBy(array('customer_id' => $Customer->getId()));
        $data = is_null($MailmagaCustomer) ? 1 : $MailmagaCustomer->getMailmagaFlg();

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
                'data' => $data,
            ));
    }

    public function onCustomerEditAfter(EventArgs $event)
    {
        $this->customerEdit($event);
    }

    public function onFrontCustomerEditAfter(EventArgs $event)
    {
        list($email, $mailmagaFlg) = $this->customerEdit($event);

        $this->app['monolog.PostCarrier']->info("mailmagaFlg=$mailmagaFlg");
        if ($mailmagaFlg != 3) {
            $this->app['eccube.plugin.postcarrier.service.postcarrier_request']->saveUserAgent($email, $_SERVER['HTTP_USER_AGENT']);
        }
    }

    protected function customerEdit(EventArgs $event)
    {
        $form = $event->getArgument('form');
        $Customer = $event->getArgument('Customer');

        $customerId = $Customer->getId();
        $mailmagaFlg = $form->get('plg_postcarrier_mailmaga_flg')->getData();
        $email = $form->get('email')->getData();
        $this->app['monolog.PostCarrier']->info("after customerId=$customerId mailmagaFlg=$mailmagaFlg");
        $this->saveMailmagaCustomer($customerId, $mailmagaFlg);

        return array($email, $mailmagaFlg);
    }


    protected function saveMailmagaCustomer($customerId, $mailmagaFlg)
    {
        $MailmagaCustomerRepository = $this->app['eccube.plugin.postcarrier.repository.postcarrier_mailmaga_customer'];
        $MailmagaCustomer = $MailmagaCustomerRepository->findOneBy(array('customer_id' => $customerId));

        if (is_null($MailmagaCustomer)) {
            $MailmagaCustomer = new \Plugin\PostCarrier\Entity\PostCarrierMailmagaCustomer();
            $MailmagaCustomer->setCustomerId($customerId);
            $MailmagaCustomer->setDelFlg(Constant::DISABLED);
            $MailmagaCustomer->setCreateDate(new \DateTime());
        }
        $MailmagaCustomer->setMailmagaFlg($mailmagaFlg);
        $MailmagaCustomer->setUpdateDate(new \DateTime());

        $this->app['orm.em']->persist($MailmagaCustomer);
        $this->app['orm.em']->flush();
    }

    public function onRenderAdminOrderSearchProductBefore(FilterResponseEvent $event) {
        $request = $event->getRequest();
        $response = $event->getResponse();
        $html = $response->getContent();

        // ポストキャリアの商品検索時のみ、カスタマイズする。template_select.twig参照
        $uri = $request->getRequestUri();
        if (strpos($uri, 'postcarrier=product_search')) {
            // fnAddOrderDetail()を上書きする。
            //$this->app['monolog.PostCarrier']->info("html=$html");
            $html = str_replace('</script>', '</script> <script src="'.$request->getBasePath().$this->app['config']['plugin_html_urlpath'].'postcarrier/assets/js/postcarrier.js"></script>', $html);
            //$this->app['monolog.PostCarrier']->info("new_html=$html");
        }

        $response->setContent($html);
        $event->setResponse($response);
    }

    public function onRenderShoppingComplete(TemplateEvent $event) {
        $app = $this->app;
        $params = $event->getParameters();

        $orderId = $params['orderId'];
        if (!$orderId) return;
        $Order = $app['orm.em']->getRepository('Eccube\Entity\Order')->find($orderId);
        if (!$Order) return;
        $amount = $Order->getSubtotal();

        if (!$_SESSION['JSESSIONID']) {
            // セッションが存在しない
            return;
        }

        $snipet = '<img width="0" height="0" alt="" src="{{ url("postcarrier_click") }}?p=v&amp;o={{ orderId }}&amp;t={{ plg_postcarrier_subtotal }}">';
        $search = 'トップページへ</a>'; // XXX
        $replace = $snipet.$search;
        $source = str_replace($search, $replace, $event->getSource());
        //$app['monolog.PostCarrier']->info("onRenderShoppingComplete: $source");

        $params['plg_postcarrier_subtotal'] = $amount ? $amount : '00';

        $event->setParameters($params);
        $event->setSource($source);
    }

    public function onRenderEntryBefore(FilterResponseEvent $event)
    {
        // 確認画面に項目「メールマガジンの送付」を追加する。

        $request = $event->getRequest();
        $response = $event->getResponse();

        if ('POST' !== $request->getMethod() || $request->get('mode') !== 'confirm') {
            return;
        }

        $html = $this->getNewEntryHtml($event, $request, $response);
        if ($html) {
            $response->setContent($html);
            $event->setResponse($response);
        }
    }

    protected function getNewEntryHtml($event, $request, $response)
    {
        $app = $this->app;

        $crawler = new Crawler($response->getContent());

        // 入力エラーで確認画面に遷移できなかった場合を検出する。
        if ($crawler->filter("#entry_plg_postcarrier_mailmaga_flg")->count() !== 0) {
            return false;
        }

        $html = $this->getHtml($crawler);
        $mode = $request->get('mode');

        try {
            // Formの取得
            $builder = $app['form.factory']->createBuilder('entry');
            $builder->add('plg_postcarrier_mailmaga_flg', 'choice', array(
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
            ));

            $builder->setAttribute('freeze', true);
            $form = $builder->getForm();
            $form->handleRequest($request);

            // 追加先のノードを取得
            $nodeHtml = $crawler->filter('.dl_table.not_required')->last()->html();

            // 追加する情報のHTMLを取得する.
            $parts = $this->app['twig']->render(
                'PostCarrier/Resource/template/entry_confirm_add_mailmaga.twig',
                array('form' => $form->createView())
            );
            $newNodeHtml = $nodeHtml.$parts;

            $html = str_replace($nodeHtml, $newNodeHtml, $html);
        } catch (\InvalidArgumentException $e) {
            // no-op
        }
        return $html;
    }

    private function getHtml(Crawler $crawler)
    {
        $html = '';
        foreach ($crawler as $domElement) {
            $domElement->ownerDocument->formatOutput = true;
            $html .= $domElement->ownerDocument->saveHTML();
        }
        return html_entity_decode($html, ENT_NOQUOTES, 'UTF-8');
    }
}
