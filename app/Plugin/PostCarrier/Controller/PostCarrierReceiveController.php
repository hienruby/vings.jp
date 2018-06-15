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

namespace Plugin\PostCarrier\Controller;

use Eccube\Application;
use Eccube\Common\Constant;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception as HttpException;
use Symfony\Component\Form\FormError;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PostCarrierReceiveController
{

    /**
     * PostCarrier画面
     *
     * @param Application $app
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function click(Application $app, Request $request)
    {
        if ($request->getMethod() !== 'GET') {
            exit;
        }

        if ($request->get('cmd') === 'check') {
            header("Content-Type: text/plain");
            print "I'm fine.";
            exit;
        }

        $p = $request->get('p');
        if (!$p) {
            exit;
        }

        $t = $p[0];
        if ($t === 'c' || $t === 'p') {
            $token = substr($p, 1);
            $click_param = "$t/$token";
        } else if ($t === 'o') {
            $token = substr($p, 1);
            $click_param = "$t/$token.jpeg";
        } else if ($t === 'v') {
            $order_id = $request->get('o');
            $total = $request->get('t');
            $click_param = "$t/t.jpeg";
            if ($order_id && $total) {
                $click_param = $click_param . "?o=${order_id}&t=${total}";
            }
        } else {
            //$postCarrier->printLog(session_id() . ": bad request, redirect to top page. _GET=".print_r($_GET,true));
            //postcarrier_redirectTopPage();
        }

        $curl_opts = array(
                             CURLOPT_RETURNTRANSFER => true,
                             CURLOPT_HEADER => true,
                             );

        if (array_key_exists('JSESSIONID', $_SESSION)) {
            $curl_opts[CURLOPT_COOKIE] = "JSESSIONID=".$_SESSION['JSESSIONID'];
        } else {
            $app['monolog.PostCarrier']->info("JSESSIONID NOT FOUND:" . session_id());
        }

        $curl_opts[CURLOPT_USERAGENT] = "User-Agent: ".$_SERVER['HTTP_USER_AGENT'];

        $settings = $app['eccube.plugin.postcarrier.repository.postcarrier_plugin']->getSubData('PostCarrier');
        $settings = unserialize($settings);
        $clickUrl = $settings['clickUrl'] . $click_param;

        $ch = curl_init($clickUrl);
        curl_setopt_array($ch, $curl_opts);
        $ret = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        //$app['monolog.PostCarrier']->info("info: ".print_r($info,true));

        switch ($info['http_code']) {
        case 200:
        case 301: // Moved Permanently
        case 302: // Moved Temporarily, Found
            break;
        default:
            $app['monolog.PostCarrier']->info(session_id() . ": response error code:$code, redirect to top page. ");
            return $app->redirect($app->url('homepage'));
        }

        $redirect_url = $info['redirect_url'];
        /*
        if (!$redirect_url) {
            $app['monolog.PostCarrier']->info(session_id() . ": can't get a location, redirect to top page.");
            return $app->redirect($app->url('homepage'));
        }
        */

        $http_response_header = preg_split('/\r\n/', $ret);
        unset($http_response_header[0]); // ステータス行を削除 HTTP/1.1 302 Moved Temporarily
        $app['monolog.PostCarrier']->info("header: ".print_r($http_response_header,true));
        $cookies = array();
        $resHeader = array();
        foreach ($http_response_header as $hdr) {
            if ($hdr == '') break; // 空行はヘッダの終り
            list($name,$value) = explode(':', $hdr, 2);
            $hdrname = strtolower($name);
            $hdrvalue = ltrim($value);
            if ('set-cookie' === $hdrname) {
                if (preg_match_all('/([^\s]+?)=([^;]+)/', $hdrvalue, $matches, PREG_SET_ORDER)) {
                    foreach ($matches as $m) {
                        switch (strtolower($m[1])) {
                        case 'path':
                        case 'domain':
                        case 'secure':
                        case 'expires':
                            break;
                        default:
                            $cookies[] = array('name' => $m[1], 'value' => $m[2]);
                            break;
                        }
                    }
                }
            } else {
                $resHeader[$hdrname] = $hdrvalue;
            }
        }

        foreach ($cookies as $cookie) {
            if ($cookie['name'] == 'JSESSIONID') {
                $app['monolog.PostCarrier']->info("JSESSIONID SAVE:" . session_id() . " " . $cookie['value']);
                $_SESSION['JSESSIONID'] = $cookie['value'];
                break;
            }
        }

        // コンバージョン・開封通知の画像を出力する。
        if ($t === 'v' || $t === 'o') {
            //$app['monolog.PostCarrier']->info("conversion:$click_param time=$time_req " . session_id() . " " . $_SESSION['JSESSIONID']);
            $app['monolog.PostCarrier']->info("conversion:$click_param " . session_id() . " " . $_SESSION['JSESSIONID']);
            header("Content-Type: image/gif");
            echo file_get_contents(__DIR__."/../Resource/assets/v.gif");
            exit;
        }

        return $app->redirect($redirect_url);
    }

    public function receive(Application $app, Request $request)
    {
        if ($request->get('cmd') === 'check') {
            header("Content-Type: text/plain");
            print "I'm fine.";
            exit;
        }

        if ($request->get('cmd') === 'count') {
            header("Content-Type: text/plain; charset=utf-8");
            $count = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getEffectiveAddressCount($request->get('key'));
            echo "count=$count";
            exit;
        }

        $deliveryId = $request->get('deliveryId');
        if (is_numeric($deliveryId)) {
            // アップロードプロセスを起動する。
            $app['monolog.PostCarrier']->info("r.php POST: " . print_r($_POST, true));

            $app['eccube.plugin.postcarrier.service.postcarrier_request']->setApplication($app);
            $exit_code = $app['eccube.plugin.postcarrier.service.postcarrier_request']->execUploadProcess($deliveryId);

            // 受付完了したことを返す。
            $r = array('status' => $exit_code, 'deliveryId' => $deliveryId);
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode($r);
            exit;
        }

        exit;
    }
}
