<?php
/*
 * This file is part of the SocialButton
 *
 * Copyright (C) 2016 Nekyo
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Plugin\SocialButton;
use Eccube\Event\EventArgs;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\DomCrawler\Crawler;

class SocialButtonEvent
{
	/** @var  \Eccube\Application $app */
	private $app;

	public function __construct($app)
	{
		$this->app = $app;
	}

	public function onRenderProductDetailBefore(FilterResponseEvent $event)
	{
		$id = $this->app['request']->attributes->get('id');
		$Product = $this->app['eccube.repository.product']->find($id);

		$response = $event->getResponse();
		$html = $response->getContent();
		$source  = "<p id=\"detail_not_stock_box__description_detail\" class=\"item_comment\">";
		$replace = $this->app->renderView(
			'SocialButton/Resource/template/buttons.twig',
			array('Product' => $Product,)
		) . $source;
		$response->setContent(
			str_replace($source, $replace, $html)
		);
		$event->setResponse($response);
	}
}
