<?php
/*
* This file is part of EC-CUBE
*
* Copyright(c) 2000-2015 LOCKON CO.,LTD. All Rights Reserved.
* http://www.lockon.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\IntroduceDiscount;

use Eccube\Plugin\AbstractPluginManager;

class PluginManager extends AbstractPluginManager
{

    public function install($config, $app)
    {
        $this->migrationSchema($app, __DIR__.'/Migration', $config['code']);
    }

    public function uninstall($config, $app)
    {
        $this->disable($config, $app);
        $this->migrationSchema($app, __DIR__.'/Migration', $config['code'], 0);
    }

    public function enable($config, $app)
    {
        $app['orm.em']->getRepository('Plugin\IntroduceDiscount\Entity\AffiliateSettings')->save();

        $MailTemplate = $app['eccube.repository.mail_template']->find(1);
        $MailTemplate->setFileName("IntroduceDiscount/View/shop/mail/order.twig");
        $app['orm.em']->persist($MailTemplate);
        $app['orm.em']->flush($MailTemplate);
    }

    public function disable($config, $app)
    {
        $MailTemplate = $app['eccube.repository.mail_template']->find(1);
        $MailTemplate->setFileName("Mail/order.twig");
        $app['orm.em']->persist($MailTemplate);
        $app['orm.em']->flush($MailTemplate);
    }

    public function update($config, $app)
    {

    }
}