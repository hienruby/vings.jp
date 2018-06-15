<?php


namespace Plugin\ToTop;

use Eccube\Application;
use Eccube\Common\Constant;
use Eccube\Entity\Category;
use Eccube\Event\EventArgs;
use Eccube\Event\TemplateEvent;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\DomCrawler\Crawler;

class ToTopEvent
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }


    public function onRenderToTop(FilterResponseEvent $event)
    {

        // 設定
        $colorIcon   = '#909090';      // [トップへ戻る]アイコン上にマウスがない場合の色
        $colorString = '#f0f0f0';      // [トップへ戻る]アイコンの文字の色
        $iconString  = '▲トップへ戻る';  // アイコンの文字


        // イベントからHTML取得
        $response = $event->getResponse();
        $html = $response->getContent();

        // [トップへ戻る]の追加
        //
        // 追加先
        $search = '</body>';
        // 追加内容
        $replace = '<script>
                        $(function() {
                            var toTopIcon = $("#ToTopIcon");
                            toTopIcon.hide();
                            $(window).scroll(function () {
                                if ($(this).scrollTop() > 10) {
                                    toTopIcon.fadeIn("fast");
                                } else {
                                    toTopIcon.fadeOut("fast");
                                }
                            });
                            toTopIcon.click(function () {
                                $("body,html").animate({ scrollTop: 0 }, "fast");
                                return false;
                            });
                        });
                    </script>
                    <style type="text/css">
                        #ToTopIcon{
                            background: '.$colorIcon.';
                            width: 100px;
                            padding-top: 10px;
                            padding-right: 0;
                            padding-left: 0;
                            padding-bottom: 10px;
                            border-radius: 5px;
                            text-decoration: none;
                            text-align: center;
                            font-size: 70%;
                            color: '.$colorString.';
                            right:10px;
                            bottom:50px;
                            z-index: 2;
                            position:fixed;
                            display: block;
                        }
                    </style>
                    <div id="ToTopIcon">'.$iconString.'</div>
                    </body>';


        // ボタン挿入
        $html = str_replace($search, $replace, $html);

        // イベントへHTML返却
        $response->setContent($html);
        $event->setResponse($response);


    }
}