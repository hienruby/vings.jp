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
use Symfony\Component\Yaml\Yaml;

use Plugin\PostCarrier\Entity\PostCarrierPlugin;
use Plugin\PostCarrier\Util\PostCarrierUtil;

class ConfigController
{

    /**
     * PostCarrier用設定画面
     *
     * @param Application $app
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Application $app, Request $request)
    {
        $form = $app['form.factory']->createBuilder('postcarrier_config')->getForm();

        $sub_data = array('apiUrl' => null, 'clickUrl' => null, 'address_count' => null, 'address_count_update_date' => null,
                          'php_binary_path' => null, 'sample_insert_flg' => 0);

        $BaseInfo = $app['eccube.repository.base_info']->get();

        // Get module code from dtb_plugin
        $self = Yaml::parse(__DIR__ . '/../config.yml');
        $pluginCode = $self['code'];
        $pluginName = $self['name'];
        $pluginVersion = $self['version'];
        $Plugin = $app['eccube.repository.plugin']->findOneBy(array('code' => $self['code']));

        if (is_null($Plugin)) {
            $error = "例外エラー<br />プラグインが存在しません。";
            $error_title = 'エラー';
            return $app['view']->render('error.twig', compact('error', 'error_title'));
        }

        $PostCarrierPlugin = $app['eccube.plugin.postcarrier.repository.postcarrier_plugin']->findOneBy(array('code' => $pluginCode));
        if (!is_null($PostCarrierPlugin)) {
            $data = unserialize($PostCarrierPlugin->getSubData());
            $sub_data = array_merge($sub_data, $data);
        } else {
            $now = new \DateTime();
            $PostCarrierPlugin = new PostCarrierPlugin();
            $PostCarrierPlugin->setCode($pluginCode);
            $PostCarrierPlugin->setName($pluginName);
            $PostCarrierPlugin->setAutoUpdateFlg(0);
            $PostCarrierPlugin->setDelFlg(0);
            $PostCarrierPlugin->setCreateDate($now);
            $PostCarrierPlugin->setUpdateDate($now);

            $sub_data = array_merge($sub_data,array('email04' => $BaseInfo->getEmail04(), 'disable_check' => 0));
        }

        if ('POST' === $request->getMethod()) {
            $form->handleRequest($request);

            $action = $request->get('action');
            if ($action == 'address_count') {
                $count = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getEffectiveAddressCount('hj0H_MpRt3z0ezZkAC3CDqYtBHf2sKww');
                if (preg_match('/\d+/', $count)) {
                    $sub_data['address_count'] = $count;
                    $sub_data['address_count_update_date'] = new \DateTime();
                    $this->updateSubData($app, $PostCarrierPlugin, $sub_data);
                } else {
                    //$sub_data['address_count'] = '更新失敗';
                }
            } else if ($form->isValid()) {
                $data = $form->getData();

                $hostport = $request->getHost();
                if ($request->getPort()) {
                    $hostport = $hostport . ":" . $request->getPort();
                }

                $data['click_url'] = $app->url('postcarrier_click');
                if ($data['ssl_check']) {
                    $data['click_ssl_url'] = str_replace('http:', 'https:', $data['click_url']);
                    $scheme = 'https';
                } else {
                    $data['click_ssl_url'] = $data['click_url'];
                    $scheme = 'http';
                }
                $data['request_data_url'] = $app->url('postcarrier_receive');
                $data['module_data_url'] = "$scheme://$hostport/" . $request->getBasePath() . $app['config']['plugin_html_urlpath'] . 'postcarrier/assets/';
                $disable_check = $data['disable_check'] == 1;
                $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->configure($isError,
                    $data['server_url'], $data['shop_id'], $data['shop_pass'],
                    $data['click_url'], $data['click_ssl_url'], $data['request_data_url'],
                    $data['module_data_url'], $data['email04'], $disable_check, $BaseInfo, $pluginVersion);

                if (!$isError) {
                    $data['apiUrl'] = $result->apiUrl;
                    $data['clickUrl'] = $result->clickUrl;

                    if ($data['sample_insert_flg'] == 0) {
                        $this->installSampleTemplate($app);
                    }
                    $data['sample_insert_flg'] = 1;

                    $sub_data = array_merge($sub_data, $data);
                    $this->updateSubData($app, $PostCarrierPlugin, $sub_data);
                } else {
                    $app->addError('設定に失敗しました。', 'admin');

                    if ($isError == 1) {
                        $form->get('server_url')->addError(new FormError($result['message']));
                    } else if ($isError == 2 && strpos($result['message'], "指定されたショップは登録されていません") !== false) {
                        $form->get('shop_id')->addError(new FormError($result['message']));
                        $form->get('shop_pass')->addError(new FormError($result['message']));
                    } else {
                        $app['monolog.PostCarrier']->info("config error: ".$result['message']);
                    }

                    if (is_object($result) && property_exists($result, 'detail')) {
                        $errorDetails = get_object_vars($result['detail']->detail);
                        foreach ($errorDetails as $key => $val) {
                            $app['monolog.PostCarrier']->info("config error: $key=".$errorDetails[$key]);
                        }
                    }
                }
            }
        } else {
            if (empty($sub_data['php_binary_path'])) {
                $php_name = PostCarrierUtil::isWindowsPlatform() ? 'php.exe' : 'php';
                $which_php = PostCarrierUtil::find_binary_path($php_name);
                if (!$which_php) $which_php = '';
                $sub_data['php_binary_path'] = $which_php;
            }

            $form->setData($sub_data);
        }

        return $app->render('PostCarrier/Resource/template/admin/config.twig', array(
            'form' => $form->createView(),
            'pluginVersion' => $pluginVersion,
            'sub_data' => $sub_data,
        ));
    }

    private function updateSubData($app, $PostCarrierPlugin, $sub_data) {
        $subDataSer = serialize($sub_data);
        $PostCarrierPlugin->setSubData($subDataSer);
        $app['orm.em']->persist($PostCarrierPlugin);
        $app['orm.em']->flush();
    }

    private function installSampleTemplate($app) {
        $shop_name = $app['config']['shop_name'];
        $BaseInfo = $app['eccube.repository.base_info']->get();        
        $email02 = $BaseInfo->getEmail02();
        $http_url = $app->url('homepage');
        $https_url = str_replace('http:', 'https:', $http_url);
        $base_url = preg_replace('/index(_dev)?\.php\/?$/', '', $http_url);

        //$app['monolog.PostCarrier']->info("app config: ".print_r($app['config'],true));
        //$app['monolog.PostCarrier']->info("shop_name=$shop_name, $user_dir, $email02, $http_url, $https_url");

        $arrFile = \Plugin\PostCarrier\Service\LC_MDL_ECQUBELEY_CONSTANTS::getSampleMailTemplate();
        foreach($arrFile as $item){
            $temp = file_get_contents($item['path']);
            $temp = str_replace('localhost/user_data/mdl_postcarrier/', "$base_url/plugin/postcarrier/assets/sample/", $temp);
            $temp = str_replace('http://www.sample.com/', $http_url, $temp);
            $temp = str_replace('https://www.sample.com/', $https_url, $temp);
            $temp = str_replace('contact@sample.com', $email02, $temp);
            $temp = str_replace('○○オンラインストア', $shop_name, $temp);
            $body = str_replace('○○ブランドサイト', $shop_name.'ブランドサイト', $temp);

            $arrParam = array();
            $arrParam['body']        = $body;
            $arrParam['sendFor']     = $item['sendFor'];
            $arrParam['subject']     = $item['subject'];
            $arrParam['fromAddr']    = 'takashi@iplogic.co.jp';//$postCarrier->fromAddr;
            $arrParam['link_count']  = 0;
            $arrParam['mail_method'] = $item['mail_method'];
            $arrParam['sub_body']  = '';

            $app['eccube.plugin.postcarrier.service.postcarrier_request']->saveTemplate($isError, $arrParam);
        }
    }
}
