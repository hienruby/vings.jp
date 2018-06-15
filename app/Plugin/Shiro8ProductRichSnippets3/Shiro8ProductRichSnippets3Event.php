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

namespace Plugin\Shiro8ProductRichSnippets3;

use Eccube\Application;
use Eccube\Common\Constant;
use Eccube\Entity\Category;
use Eccube\Event\EventArgs;
use Eccube\Event\TemplateEvent;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\DomCrawler\Crawler;

class Shiro8ProductRichSnippets3Event
{
    /**
     * @var \Eccube\Application
     */
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

	public function onRenderProductDetail(FilterResponseEvent $event)
	{
		$app = $this->app;
        $request = $event->getRequest();
        $response = $event->getResponse();
		
		$id = $request->get('id');
		
		$Product = null;
		
		if ($id) {
			$Product = $app['eccube.repository.product']->find($id);
		}
		
		if (!$Product) {
			return;
		}
		
		//画像情報をセット
		$imageString = "";
if (count($Product->getProductImage()) > 0) {
    foreach ($Product->getProductImage() as $ProductImage) {
        if ($ProductImage) {
        	$imageString =  '"image": "' . $request->getSchemeAndHttpHost() . $app["config"]["image_save_urlpath"] . '/'. $ProductImage . '",';
    	}
    	break;
    }
} else {
	if ($ProductImage) {
		$imageString =  '"image": "' . $request->getSchemeAndHttpHost() . $app["config"]["image_save_urlpath"] . '/'. $ProductImage . '",';
	}
}
		
		//価格情報をセット
		$priceString = "";
if ($Product->hasProductClass()) {
    if ( $Product->getPrice02IncTaxMin() == $Product->getPrice02IncTaxMax()) {
    	$priceString = '"@type": "Offer",';
    	$priceString .= '"price": "' . $Product->getPrice02IncTaxMin() . '",';
    } else {
    
    	$priceString = '"@type": "AggregateOffer",';
    	$priceString .= '"highPrice": "' . $Product->getPrice02IncTaxMax() . '",';
    	$priceString .= '"lowPrice": "' . $Product->getPrice02IncTaxMin() . '",';
    }
} else {
	$priceString = '"price": "' . $Product->getPrice02IncTaxMin() . '",';
}
		
		// twigコードにカテゴリコンテンツを挿入
$replace = <<<EOF
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "Product",
    "description": "{$Product->getDescriptionDetail()}",
    "name": "{$Product->getName()}",
    {$imageString}
    "offers": {
      {$priceString}
      "priceCurrency": "JPY"
    }
}
</script>
</head>
EOF;

		// DomCrawlerにHTMLを食わせる
        $html = $response->getContent();
        $crawler = new Crawler($html);
        
        // DomCrawlerからHTMLを吐き出す
        //ヘッダータグが消えるので注意
        $html = $crawler->html();
        
$htmlTag = <<< EOM
<!doctype html>
<html lang="ja">

EOM;

$html = $htmlTag . $html;

$htmlTag = <<< EOM
</html>
EOM;

$html = $html . $htmlTag;

        $search = '/<\/head>/i';
        
		$html = preg_replace($search, $replace, $html);

        $response->setContent($html);
        $event->setResponse($response);

	}

}
