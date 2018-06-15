<?php
/*
 * Copyright(c) 2016 SYSTEM_KD
 */

namespace Plugin\ClassNameDetail;

use Eccube\Event\TemplateEvent;

class ClassNameDetail
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
    * 商品規格編集 テンプレート
    *
    * @param TemplateEvent $event
    */
    public function onAdminProductClassNameTwig(TemplateEvent $event)
    {

        /* @var $TwigRenderService \Plugin\Custom\Service\TwigRenderService */
        $TwigRenderService = $this->app['classnamedetail.service.twigrenderservice'];
        $TwigRenderService->initTwigRenderControl($event);

        $division = $this->app['config']['ClassNameDetail']['const']['division'];

        $search = '<a href="{{ url(\'admin_product_class_category\', {class_name_id : ClassName.id }) }}">';
        $insert = '<div>';
        $insert .= '{% for ClassCategory in ClassName.ClassCategories %}';
        $insert .= '  {{ ClassCategory.name }}{% if loop.length != loop.index %} ' . $division . '{% endif %}';
        $insert .= '{% endfor %}';
        $insert .= '</div>';

        $TwigRenderService->twigInsert($search, $insert, 3);

        $event->setSource($TwigRenderService->getContent());
    }
}
