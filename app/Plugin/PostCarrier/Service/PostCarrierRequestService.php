<?php

/*
* PostCarrier for EC-CUBE3
* Copyright(c) 2016 IPLOGIC CO.,LTD. All Rights Reserved.
*
* http://www.iplogic.co.jp/
*
* This program is not free software.
* It applies to terms of service.
*
*/

namespace Plugin\PostCarrier\Service;

use Eccube\Application;
use Eccube\Common\Constant;

require_once(__DIR__."/../vendor/phphtmlparser/htmlparser.inc");

define('POSTCARRIER_TMP_PATH', __DIR__."/../tmp/");
define('POSTCARRIER_EFFECTIVEADDRESSCOUNT_KEY',	'hj0H_MpRt3z0ezZkAC3CDqYtBHf2sKww');

class PostCarrierRequestService
{

    private $app;

    private $settings;

    private $shopName;
    private $apikey;
    private $apiUrl;

    public function __construct(Application $app)
    {
        $this->app = $app;

        $this->settings = $app['eccube.plugin.postcarrier.repository.postcarrier_plugin']->getSubData('PostCarrier');
        $this->settings = unserialize($this->settings);
        $this->shopName = $this->settings['shop_id'];
        $this->apikey = $this->settings['shop_pass'];
        $this->apiUrl = $this->settings['apiUrl'];

        $this->arrSearchColumn = LC_MDL_ECQUBELEY_CONSTANTS::getSearchColumns();

        // ステップメール登録時に取り込むパラメータ
        $this->arrEventColumn = array(
                'event',
                'eventDay',
                'eventDaySelect',
                'stepmail_time',
                'OrderDetails',
                'StopOrderDetails',
                'event_buy_product_id_conjunction',
                'event_buy_product_count_only',
        );

        // スケジュール登録時に取り込むパラメータ
        $this->arrScheduleColumn = array('schedule_date');

        $this->arrPeriodicEveryMonthColumn = array(
                'periodic_day',
                'periodic_time');
    }

    public function setApplication($app)
    {
        $this->app = $app;
    }

    private function doApiRequest(&$isError, $apiUrl, $method, $params, $not_json = false) {

        $options = array(CURLOPT_RETURNTRANSFER => true,);

        switch ($method) {
        case 'GET':
            $options[CURLOPT_HTTPGET] = true;
            $apiUrl .= '?'.http_build_query($params);
            break;
        case 'DELETE':
            $options[CURLOPT_CUSTOMREQUEST] = "DELETE";
            $apiUrl .= '?'.http_build_query($params);
            break;
        case 'POST':
            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = $params;
            break;
        case 'PUT':
            $options[CURLOPT_CUSTOMREQUEST] = "PUT";
            $options[CURLOPT_POSTFIELDS] = $params;
            break;
        }

        $ch = curl_init($apiUrl);
        curl_setopt_array($ch, $options);
        $res = curl_exec($ch);
        $info = curl_getinfo($ch);
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if (CURLE_OK !== $errno) {
            $isError = 1;
            return array('message' => $error);
        } else {
            if ($not_json) {
                $result = $res;
            } else {
                $result = json_decode($res);
            }

            $code = $info['http_code'];
            if (floor($code/100) != 2) {
                if ($not_json) {
                    $result = json_decode($res);
                }
                $isError = 2;
                $message = $result->error;
                return array('message' => $message, 'code' => $code, 'detail' => $result);
            }

            $isError = 0;
            return $result;
        }
    }

    private function createRequestParam() {
        return array(
            'shopName' => $this->shopName,
            'apikey' => $this->apikey
        );
    }

    function setPagerParam(&$params, $max, $offset) {
        if ($max >= 0) {
            $params['max'] = $max;
        }
        if ($offset >= 0) {
            $params['offset'] = $offset;
        }
        return $params;
    }

    function createRequestPagerParam($max, $offset) {
        $params = $this->createRequestParam();
        $this->setPagerParam($params, $max, $offset);
        return $params;
    }

    function convertObjectToArray($targetArray){

        if(count($targetArray)==0) return null;
        foreach($targetArray as $key => $val){
            if(is_object($val)){
                $val = get_object_vars($val);
            }
            if(is_array($val)){
                $returnArray[$key] = $this->convertObjectToArray($val);
            }else{
                $returnArray[$key] = $val;
            }
        }
        return $returnArray;
    }


    function configure(&$isError, $configUrl, $shopName, $apikey, $proxyUrl, $sslProxyUrl, $requestDataUrl,
                       $moduleDataUrl, $email04, $disable_check, $BaseInfo, $version)
    {
        $params = array(
            'shopName' => $shopName,
            'apikey' => $apikey,
            'proxyUrl' => $proxyUrl,
            'sslProxyUrl' => $sslProxyUrl,
            'requestDataUrl' => $requestDataUrl,
            'moduleDataUrl' => $moduleDataUrl,
            'protocolVersion' => $version,
            'checkEccube' => $disable_check ? 0 : 1,
            'eccubeVersion' => Constant::VERSION,
            'eccubeShopName' => $BaseInfo->getShopName(),
            'eccubeEmail04' => $BaseInfo->getEmail04(),
        );

        $result = $this->doApiRequest($isError, $configUrl, 'POST', $params);
        return $result;
    }

    public function getTemplateList(&$isError, &$total, $max = -1, $offset = -1) {
        $params = $this->createRequestPagerParam($max, $offset);
        $result = $this->doApiRequest($isError, $this->apiUrl . 'template', 'GET', $params);
        if (!$isError) {
            $total = $result->total;
            $arr = $this->convertObjectToArray($result);
            if ($total == 0) $arr['templates'] = array();
            return $arr;
        } else {
            $total = -1;
            return $result;
        }
    }

    public function getTemplate(&$isError, $template_id) {
        $params = $this->createRequestParam();
        $params['template_id'] = $template_id;
        $result = $this->doApiRequest($isError, $this->apiUrl . 'template', 'GET', $params);
        if (!$isError) {
            $arr = $this->convertObjectToArray($result);
            // XXX 画面とどうマッピングするか。extractTemplate
            $arr['mail_method'] = $arr['message'][0]['type'] == 'text' ? 2 : 1;
            $arr['body'] = $arr['message'][0]['body'];
            if (array_key_exists(1, $arr['message'])) $arr['sub_body'] = $arr['message'][1]['body'];
            return $arr;
        } else {
            return $result;
        }
    }

    public function saveTemplate(&$isError, $formObj) {
        if($formObj['mail_method']==1){
            $type='html';
        }else{
            $type='text';
        }

        $linkArray = array();
        if (array_key_exists('link_count', $linkArray)) {
            for($i=1; $i< $formObj['link_count'] + 1; $i++){
                $linkArray[$i] = array('url' => $formObj['linkUrl'.$i], 'name' => $formObj['linkValue'.$i]);
            }
        }

        $msg = array(
           array(
             'type' => $type, // text or html
             'body' => $formObj['body'],
             'link' => $linkArray
           )
        );

        if ($type == 'html' && $formObj['sub_body'] != '') {
        	$msg[] = array('type' => 'text', 'body' => $formObj['sub_body']);
        }

        $attrh = LC_MDL_ECQUBELEY_CONSTANTS::getInsetList();

        $params = array(
            'shopName' => $this->shopName,
            'apikey' => $this->apikey,
            'sendFor' => $formObj['sendFor'],
            'fromAddr' => $formObj['fromAddr'],
            'fromDisp' => array_key_exists('fromDisp', $formObj) ? $formObj['fromDisp'] : '',
            'subject' => $formObj['subject'],
            'replytoAddr' => array_key_exists('replytoAddr', $formObj) ? $formObj['replytoAddr'] : '',
            'replytoDisp' => array_key_exists('replytoDisp', $formObj) ? $formObj['replytoDisp'] : '',
            'message' => json_encode($msg),
            'attrh' => json_encode($attrh),
            'name' => array_key_exists('adm_name', $formObj) ? $formObj['adm_name'] : '',
            'note' => array_key_exists('adm_note', $formObj) ? $formObj['adm_note'] : '',
        );

        if(array_key_exists('id', $formObj) && $formObj['id']!=""){
            $params['template_id'] = $formObj['id'];
        }

        $result = $this->doApiRequest($isError, $this->apiUrl . 'template', 'POST', $params);
        return $result;
    }

    public function deleteTemplate(&$isError, $template_id){
        $this->printLog("LC_MDL_ECQUBELEY::deleteTemplate");
        $params = array(
            'shopName' => $this->shopName,
            'apikey' => $this->apikey,
            'template_id' => $template_id
        );

        $result = $this->doApiRequest($isError, $this->apiUrl . 'template', 'DELETE', $params);
        return $result;
    }

    public function getMailLogList(&$isError, &$total, $max = -1, $offset = -1) {
        $params = $this->createRequestPagerParam($max, $offset);
        $result = $this->doApiRequest($isError, $this->apiUrl . 'maillog', 'GET', $params);

        if (!$isError) {
            $objArray = $result->logs;
            $total = $result->total;
            return $total == 0 ? array() : $this->convertObjectToArray($objArray);
        } else {
            $total = -1;
            return $result;
        }
    }

    function getMailLog($isError, $deliveryId, &$total, $max = -1, $offset = -1){
        $this->printLog("LC_MDL_ECQUBELEY::getMailLog:".$deliveryId);

        $params = $this->createRequestPagerParam($max, $offset);
        $params['deliveryId'] = $deliveryId;

        $result = $this->doApiRequest($isError, $this->apiUrl . 'maillog', 'GET', $params);
        if (!$isError) {
            $total = $result->total;
            return $this->convertObjectToArray($result);
        } else {
            $total = -1;
            return $result;
        }
    }

    function downloadMaillog(&$isError, $deliveryId){
        $this->printLog("LC_MDL_ECQUBELEY::downloadMaillog:".$deliveryId);

        $params = $this->createRequestParam();
        $params['deliveryId'] = $deliveryId;

        $result = $this->doApiRequest($isError, $this->apiUrl . 'maillog/download', 'GET', $params, true);
        return $result;
    }

    public function getDelivery($deliveryId) {
        $params = array(
            'shopName' => $this->shopName,
            'apikey' => $this->apikey,
            'deliveryId' => $deliveryId
        );
        $result = $this->doApiRequest($isError, $this->apiUrl . 'delivery', 'GET', $params);
        if (!$isError) {
            $arr = $this->convertObjectToArray($result);
            return $arr;
        } else {
            return $result;
        }
    }

    private function printLog($msg) {
        $this->app['monolog.PostCarrier']->info($msg);
    }

    function testMail(&$isError, $formObj, $customerData, $testAddress){
        $this->printLog("LC_MDL_ECQUBELEY::testMail:".$testAddress);

        $message = $this->createMessageParam($formObj);
        $attrh = $this->getSendCustomerAttribute($formObj['mail_type_web'],$formObj['mail_type_c']);
        $csvData = $this->createSendCsvData($customerData, $formObj);

        $params = array(
            'shopName' => $this->shopName,
            'apikey' => $this->apikey,

            'addresses' => json_encode(array($testAddress)),
            'sendFor' => $this->mailType2sendFor($formObj['mail_type']),
            'fromAddr' => $formObj['fromAddr'],
            'fromDisp' => $formObj['fromDisp'],
            'replytoAddr' => $formObj['replytoAddr'],
            'replytoDisp' => $formObj['replytoDisp'],
            'subject' => $formObj['subject'],
            'attrh' => json_encode($attrh),
            'csvData' => $csvData,
            'message' => json_encode($message)
        );

        $result = $this->doApiRequest($isError, $this->apiUrl . 'testmail', 'POST', $params);
        return $result;
    }

    function delivery(&$isError, $formObj, $customerCount, $demoAddress = ''){
        $this->printLog("LC_MDL_ECQUBELEY::delivery START");

        //メールbodyメッセージ作成
        $message = $this->createMessageParam($formObj);

        //CSVヘッダー取得
        $attrh = $this->getSendCustomerAttribute($formObj['mail_type_web'], $formObj['mail_type_c']);

        //responseCondition作成 サポートしない
        $responseCondition = null;

        $trigger='immediate';
        if($formObj['trigger']=='schedule'){
            $trigger = $formObj['schedule_date']->format('YmdHi');
        }else if($formObj['trigger']=='event'){
            $trigger= 'EVENT:'.$formObj['stepmail_time']->format('Hi');
        } else if($formObj['trigger']=='periodic'){
            $trigger= sprintf('EVENT:%s %02d',
                              $formObj['periodic_time']->format('i H'),
                              $formObj['periodic_day']
                              );
        }
        
        $params = array(
            'shopName' => $this->shopName,
            'apikey' => $this->apikey,
            'sendFor' => $this->mailType2sendFor($formObj['mail_type']),
            'templSendFor' => $formObj['sendFor'],
            'fromAddr' => $formObj['fromAddr'],
            'fromDisp' => $formObj['fromDisp'],
            'subject' => $formObj['subject'],
            'attrh' => json_encode($attrh),
            'message' => json_encode($message),
            'trigger' => $trigger,
            'addrColumn' => '_address',
            'keyColumn' => json_encode(array('_id','_customer_kind')),
            'memo' => serialize($this->createMemoArray($formObj, $formObj['trigger'])),
            'replytoAddr' => $formObj['replytoAddr'],
            'replytoDisp' => $formObj['replytoDisp'],
            'customerCount' => $customerCount,
            'responseCondition' => json_encode($responseCondition),
            'name' => $formObj['adm_name'],
            'note' => $formObj['adm_note'],
        );

        if(array_key_exists('deliveryId', $formObj) && $formObj['deliveryId']){
            $params['deliveryId'] = $formObj['deliveryId'];
        }

        if($demoAddress!=''){
            $params['testAddress'] = $demoAddress;
        }

        $features = array();
        // スケジュール配信: 配信時にリスト取得
        $features['gettingListOnScheduleDelivery'] = $formObj['trigger'] === 'schedule' ? 'true' : 'false';
        $params['features'] = json_encode($features);

        $result = $this->doApiRequest($isError, $this->apiUrl . 'delivery', 'POST', $params);
        if (!$isError) {
            // 即時配信のみ、ここでリスト送信プロセスを起動する
            // 他は、r.php経由で配信実行時にリストを取得する
            if ($formObj['trigger'] === 'immediate') {
                $deliveryId = $result->deliveryId;
                $this->printLog("execute background upload process: ${deliveryId}");

                $this->execUploadProcess($deliveryId);
            }
        }

        return $result;
    }

    function createMessageParam($formObj){

        if($formObj['mail_method']==1){
            $type='html';
        }else{
            $type='text';
        }

        $message = array(
                array('type' => $type,
                      'body' => $formObj['body']
                     )
                );

        // htmlメールのテキストパートを指定する。
        if ($type == 'html') {
            $textpart = $formObj['sub_body'];
            if ($textpart != '') {
                $message[] = array('type' => 'text', 'body' => $textpart);
            }
        }

        $linkArray = array();
        if (array_key_exists('link_count', $formObj)) {
            $linkCount = $formObj['link_count'];

            if($linkCount > 0 ){
                for($i=1; $i < $linkCount + 1; $i++ ){
                    if($formObj['linkUrl'.$i]!=""){
                        $linkArray[$i] = array('url' => $formObj['linkUrl'.$i], 'name' => $formObj['linkValue'.$i]);
                    }
                }
                $message[0]['link'] = $linkArray;
            }
        }

        $imageArrays = $this->getMobileImageArrays($formObj,$formObj['body']);
        if(count($imageArrays) > 0 ){
            $message[0]['image'] = $imageArrays;
        }
        $message[0]['body'] = $formObj['body'];

        return $message;
    }

    function getMobileImageArrays($formObj, &$tmpBody){
        $imageArrays = array();
        if($formObj['mail_method']==1 && $this->mailType2sendFor($formObj['mail_type'])!='PC'){

            $tmpCount = 1;
            $parser = new \HtmlParser($tmpBody);
            while ($parser->parse()){
                if($parser->iNodeType == NODE_TYPE_ELEMENT
                && ($parser->iNodeName === "img" || $parser->iNodeName === "IMG")){

                    $src = $parser->iNodeAttributes["src"];

                    $width = "";
                    $height = "";
                    if (array_key_exists("style", $parser->iNodeAttributes)) {
                        //style="width: 170px; height: 126px;"という形が前提
                        $style = $parser->iNodeAttributes["style"];
                        $styleList = explode(";",$style);

                        foreach($styleList as $style){
                            $style = str_replace(" ", "", $style);
                            $tmp = strpos(strtolower($style), 'width:',0);
                            if($tmp===0){
                                $width = substr(str_replace(" ", "", strtolower($style)), strlen('width:'));
                            }else {
                                $tmp = strpos(strtolower($style), 'height:',0);
                                if($tmp===0){
                                    $height = substr(str_replace(" ", "", strtolower($style)), strlen('height:'));
                                }
                            }
                        }
                    }

                    $pattern = "{s?https?://[-_.!~*'()a-zA-Z0-9;/?:@&=+$,%#]+}";

                    if(preg_match($pattern, $src)){
                        $imageArrays[$tmpCount] = array('url' => $src, 'width' => $width, 'height' => $height);
                        $tmpCount++;
                    }
                }
            }

            $tmpCount2 = 1;
            foreach($imageArrays as $imageArray){
                $replacement = '${画像#'.$tmpCount2.'}';
                $tmpBody  = str_replace($imageArray["url"], $replacement, $tmpBody);
                $tmpCount2++;
            }
        }
        return $imageArrays;
    }

    //サーバーアップロード用CSVヘッダー作成
    function getSendCustomerAttribute($mail_type_web, $mail_type_c){
        //システム上の必須カラムをセット
        $tempArray = LC_MDL_ECQUBELEY_CONSTANTS::getCustomerSearchSystemColumn();
        $tempArray = $tempArray[1];

        if($mail_type_web=='1'){
            $tempArray2 = LC_MDL_ECQUBELEY_CONSTANTS::getCustomerSearchColumn();
            $tempArray2 = array_values($tempArray2);
            $tempArray = array_merge($tempArray, $tempArray2);
        }

        if($mail_type_c=='1'){
            $tempArray2 = LC_MDL_ECQUBELEY_CONSTANTS::getCsvCustomerSearchColumn();
            $tempArray2 = array_values($tempArray2);
            $tempArray = array_merge($tempArray, $tempArray2);
        }

        return $tempArray;
    }

    function mailType2sendFor($mail_type) {
        switch ($mail_type) {
        case '1':
        case '3':
            return "PC";
            break;
        case '2':
        case '4':
            return "MOBILE";
            break;
        case '5':
            return "PCSP";
            break;
        default:
            return false;
            break;
        }
    }


    function createMemoArray($formObj, $trigger){
        $memoArray = array();
        foreach ($this->arrSearchColumn as $searchColumn) {
            $val = $formObj[$searchColumn['column']];
            //$this->printLog("column=".$searchColumn['column']." ".$val->gettype());
            if ($val instanceof \Doctrine\Common\Collections\ArrayCollection) {
                $val = $val->toArray();
                $r = array();
                foreach ($val as $e) {
                    $this->printLog("Xcolumn=".$searchColumn['column']." ".print_r(get_class($e),true));
                    if ($e instanceof \Plugin\PostCarrier\Entity\PostCarrierOrderDetail) {
                        $r[] = array('product_name' => $e->getProductName(),
                                     'product_code' => $e->getProductCode(),
                                     'product_id' => $e->getProduct()->getId(),
                                     'product_class_id' => $e->getProductClass()->getId(),
                                     'quantity' => $e->getQuantity(),
                                     );
                    } else if (method_exists($e, 'getId')) {
                        $r[] = $e->getId();
                    }
                }
                $memoArray[$searchColumn['column']] = $r;
            } else if (is_array($val)) {
                $r = array();
                foreach ($val as $e) {
                    if ($e instanceof \Plugin\PostCarrier\Entity\PostCarrierOrderDetail) {
                        $this->printLog("BBB column=".$searchColumn['column']." ".print_r(get_class($e),true));
                        $r[] = array('product_name' => $e->getProductName(),
                                     'product_code' => $e->getProductCode(),
                                     'product_id' => $e->getProduct()->getId(),
                                     'product_class_id' => $e->getProductClass()->getId(),
                                     'quantity' => $e->getQuantity(),
                                     );
                    } else if (method_exists($e, 'getId')) {
                        $r[] = $e->getId();
                    } else if (!is_object($e)) {
                        $r[] = $e;
                    } else {
                    }
                }
                $memoArray[$searchColumn['column']] = $r;
            } else if (!is_object($val) || $val instanceof \DateTime) {
                $memoArray[$searchColumn['column']] = $val;
            } else if (is_object($val) || method_exists($e, 'getId')) {
                $memoArray[$searchColumn['column']] = $val->getId();
            } else {
                $memoArray[$searchColumn['column']] = null;
            }
        }

        if (array_key_exists('triggerDisp2', $formObj)) {
            $memoArray['triggerDisp2'] = $formObj['triggerDisp2'];
        }

        // 旧モジュールで投入したかの判定用フラグ
        $memoArray['_mail_type_new_'] = 1;

        // PCSP対応: sendFor == PCSPになるので、テンプレートの種別を保存しておく。
        $memoArray['templSendFor'] = $formObj['sendFor'];

        return $memoArray;
    }


    // バックグラウンドで子プロセスを起動する
    function execUploadProcess($deliveryId) {
        $this->printLog("execUploadProcess: ${deliveryId}");

        // バッチ処理未実装
        //$require_php_path = HTML_REALDIR . 'require.php';
        //$upload_log_path = POSTCARRIER_TMP_PATH."upload-${deliveryId}.log";

        if (1 || !php_is_cli($this->php_binary_path)) {
            $this->printLog("no fork:".$deliveryId);
            $exit_code = $this->uploadInBackground($deliveryId);
        } else {
//            if ($this->isWindowsPlatform()) {
//                exec("start /B cmd /c \"".$this->php_binary_path." -f ".POSTCARRIER_UPLOAD_SCRIPT_PATH." ${deliveryId} ${require_php_path} >${upload_log_path} \"", $cmd_out, $exit_code);
//            } else {
//                exec($this->php_binary_path." -f ".POSTCARRIER_UPLOAD_SCRIPT_PATH." ${deliveryId} ${require_php_path} >${upload_log_path} 2>&1 &", $cmd_out, $exit_code);
//            }
//            $this->printLog("execUploadProcess: ${deliveryId} exit_code=${exit_code} cmd_out=".print_r($cmd_out,true));
        }

        return $exit_code;
    }

    function uploadInBackground($deliveryId) {
        $this->printLog("LC_MDL_ECQUBELEY::uploadInBackground START:".$deliveryId);
        if ($deliveryId == 0) {
            // テストモードなので何もしない。
            return 0;
        }

        $result = $this->getDelivery($deliveryId);
        if ($result === false) {
            // 配信条件の取得に失敗したので処理を打ち切る
            $this->printLog("LC_MDL_ECQUBELEY::uploadInBackground 配信条件取得に失敗:".$deliveryId);
            return 50;
        }

        $list_data = unserialize($result['memo']);

        $this->printLog("uploadInBackground: " . print_r($list_data, true));

        // 旧モジュールで投入した配信予約かどうか確認する。
        //
        // 配信メールアドレス種別の変更(スマホ削除)により、旧モジュールで
        // 投入したスケジュール・ステップは新モジュールで誤動作するので、
        // ここで処理を打ち切る。
        if (!isset($list_data['_mail_type_new_']) && $list_data['mail_type'] > 2) {
            $this->printLog("LC_MDL_ECQUBELEY::uploadInBackground 旧モジュールで投入した予約:$deliveryId triggerType:{$result['triggerType']} mail_type:{$list_data['mail_type']}");
            return 51;
        }

        //顧客情報検索
        list($sql, $sqlval) = $this->getCustomerData($list_data, $result['triggerType'], false, true);
        $this->printLog("LC_MDL_ECQUBELEY::uploadInBackground SQL:".$sql);
        $this->printLog("LC_MDL_ECQUBELEY::uploadInBackground VAL:".print_r($sqlval,true));

        $this->uploadCsv($deliveryId, $sql, $sqlval, $list_data);

        $this->printLog("LC_MDL_ECQUBELEY::uploadInBackground END:".$deliveryId);
    }

    //会員情報検索
    function getCustomerData($arrData, $triggerType=null, $count_flg=false, $getsql_flg=false){

        if($arrData['mail_type_c']=="1"){
            $eventColumnMap = LC_MDL_ECQUBELEY_CONSTANTS::getStepMailColumnArray(1);
            $eventKbnMap = LC_MDL_ECQUBELEY_CONSTANTS::getStepMailKbnArray(1);
        }else{
            $eventColumnMap = LC_MDL_ECQUBELEY_CONSTANTS::getStepMailColumnArray();
            $eventKbnMap = LC_MDL_ECQUBELEY_CONSTANTS::getStepMailKbnArray();
        }


        //イベント日付設定
        $eventCondition = null;
        $eventWhereKbn = 0;
        if ($triggerType === 'EVENT') {
            $eventColumn = $eventColumnMap[$arrData['event']];
            $offsetSign = $arrData['eventDaySelect'] === 'front' ? '-' : '+';
            $offsetDays = $arrData['eventDay'];

            // 定期配信では有効な$eventWhereKbnでなくなるので、結果期待通り動く
            $eventWhereKbn = $eventKbnMap[$arrData['event']];

            switch ($this->app['config']['database']['driver']) {
            case 'pdo_pgsql':
                $strYmd = $arrData['event'] === 'birthday' ? 'MMDD' : 'YYMMDD';
                $eventCondition = "(TO_CHAR(CURRENT_DATE, '${strYmd}') = TO_CHAR(${eventColumn} ${offsetSign} INTERVAL '${offsetDays} DAYS', '${strYmd}'))";
                break;
            case 'pdo_mysql':
                $strYmd = $arrData['event'] === 'birthday' ? '%m%d' : '%y%m%d';
                $eventCondition = "(DATE_FORMAT(CURDATE(), '${strYmd}') = DATE_FORMAT(${eventColumn} ${offsetSign} INTERVAL ${offsetDays} DAY, '${strYmd}'))";
                break;
            }
        }
        //会員情報検索
        $this->app['eccube.plugin.postcarrier.repository.postcarrier_customer']->setApplication($this->app);
        $customerData = $this->app['eccube.plugin.postcarrier.repository.postcarrier_customer']->searchMixCustomerData($arrData, $eventCondition, $eventWhereKbn, $count_flg, null, null, $getsql_flg);

        $this->printLog("LC_MDL_ECQUBELEY::getCustomerData count=".count($customerData));
        $this->printLog("LC_MDL_ECQUBELEY::getCustomerData ".print_r($customerData,true));

        return $customerData;
    }

    function uploadCsv($deliveryId, $sql, $sqlval, $list_data){
        $this->printLog("LC_MDL_ECQUBELEY::uploadCsv-${deliveryId} START");

        // タイムアウトを防ぐ
        set_time_limit(0);

        // csvファイル作成
        $csvFileName = "csvData".$deliveryId.".csv";
        $csvFilePath = POSTCARRIER_TMP_PATH.$csvFileName;
        $this->printLog("csvFilePath=$csvFilePath");

        if (!($this->fpOutput = fopen($csvFilePath, "w"))) {
            $this->printLog("LC_MDL_ECQUBELEY::uploadCsv-${deliveryId}: fopen failed: ".$csvFilePath);
            exit(1);
        }

        $this->list_data = $list_data;

        $conn = $this->app['orm.em']->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sqlval);
        while ($data = $stmt->fetch()) {
            //$this->printLog("data=".print_r($data,true));
            $csvData = $this->createSendCsvData($data, $this->list_data);
            //$this->printLog("csvData=$csvData");
            if (($size = fwrite( $this->fpOutput, $csvData )) === false) {
                $this->printLog("LC_MDL_ECQUBELEY::uploadCsv-${deliveryId}: fwrite failed: ".$csvFilePath);
            }
        }
        fclose($this->fpOutput);

        // アップロード
        $isError = 0;
        $ch = curl_init();

        $uploadurl = $this->apiUrl . "deliveryData/" . $deliveryId;
        $postfields = array(
            'shopName' => $this->shopName,
            'apikey' => $this->apikey,
        );

        curl_setopt($ch, CURLOPT_URL, $uploadurl);
        curl_setopt($ch, CURLOPT_POST, true);
        $postfields = $this->setupCurlUpload($ch, $postfields, array('csvData' => $csvFilePath));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);

        curl_exec($ch);

        /*
          $info = curl_getinfo($ch);
          $errno = curl_errno($ch);
          $error = curl_error($ch);
          $this->printLog("LC_MDL_ECQUBELEY::uploadCsv-${deliveryId} errno=$errno error=$error body=$body");
        */

        if(curl_errno($ch)) {
            $this->printLog("LC_MDL_ECQUBELEY::uploadCsv-${deliveryId} CURL_ERROR:".curl_error($ch));
        } else {
            // 後始末
            if(!unlink($csvFilePath)){
                $this->printLog("LC_MDL_ECQUBELEY::uploadCsv-${deliveryId} UNLINK_ERROR:".$csvFilePath);
            }
        }

        curl_close($ch);

        $this->printLog("LC_MDL_ECQUBELEY::uploadCsv-${deliveryId} isError:${isError} END");

        return $isError;
    }

    //サーバーアップロード用CSVデータ作成
    function createSendCsvData($data, $list_data){
        $csvData = '';

        //システム上の必須カラムをセット
        $tempArray = LC_MDL_ECQUBELEY_CONSTANTS::getCustomerSearchSystemColumn();
        $tempArray = $tempArray[1];
        foreach($tempArray as $key => $value){
            if($value=="birth"){
                $tmpBirth = explode(' ', $data[$value]); //1901-01-01 00:00:00 という前提
                $data[$value] = str_replace('-','',$tmpBirth[0]);
            }
            $csvData .= $this->escapeCsvData($data[$value]).",";
        }

        if($list_data['mail_type_web']=='1'){
            $tempArray = LC_MDL_ECQUBELEY_CONSTANTS::getCustomerSearchColumn();
            $tempArray = array_keys($tempArray);
            foreach($tempArray as $key => $value){
                $tmpValue = "dtb_customer_".$value;
                if($value=="point"){
                    $data[$tmpValue] = is_numeric($data[$tmpValue]) ? $data[$tmpValue] : '0';
                }
                $csvData .= $this->escapeCsvData($data[$tmpValue]).",";
            }
        }

        if($list_data['mail_type_c']=='1'){
            $tempArray = LC_MDL_ECQUBELEY_CONSTANTS::getCsvCustomerSearchColumn();
            $tempArray = array_keys($tempArray);
            foreach($tempArray as $key => $value){
                $tmpValue = "plg_postcarrier_csv_customer_".$value;
                $csvData .= $this->escapeCsvData($data[$tmpValue]).",";
            }
        }

        //最後のカンマを削る
        $csvData = mb_substr($csvData, 0, -1, "UTF-8");
        $csvData .= PHP_EOL;

        return $csvData;
    }

    function escapeCsvData($str) {
        // 文字列へ変換
        $str = strval($str);

        // ダブルクォートは二重にする。
        $str = preg_replace('/(")/u', '"$1', $str);

        // データ中にカンマ、ダブルクォートまたは改行が存在する ->
        // 両端にダブルクォートを追加する。
        if (preg_match('/[,"\n\r]/u', $str)) {
            $str = '"'.$str.'"';
        }

        return $str;
    }


    function getEffectiveAddressCount($key){
        if($key!=POSTCARRIER_EFFECTIVEADDRESSCOUNT_KEY) return;

        // 本会員アドレスリストを取得する。
        $customer_file1 = POSTCARRIER_TMP_PATH."count_customer.txt";
        $sql = "SELECT c.customer_id,email,'' as email_mobile,'' as email_sphone FROM dtb_customer c JOIN plg_postcarrier_customer m ON c.customer_id = m.customer_id WHERE c.del_flg=0 AND c.status=2 AND m.mailmaga_flg<>3";
        $customer_file1 = $this->createCustomerDataFile($customer_file1, $sql);

        // メルマガ会員アドレスリストを取得する。
        $customer_file2 = POSTCARRIER_TMP_PATH."count_csv_customer.txt";
        $sql = "SELECT customer_id,group_id,email,'' as email_sphone FROM plg_postcarrier_csv_customer WHERE status = 2";
        $customer_file2 = $this->createCustomerDataFile($customer_file2, $sql);

        // 本会員・メルマガ会員アドレスリストをサーバーにアップロードして件数を取得する。
        $uploadurl = $this->apiUrl . "address/calculate";
        $params = $this->createRequestParam();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $uploadurl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $params = $this->setupCurlUpload($ch, $params, array('customers' => $customer_file1, 'csv_customers' => $customer_file2));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        $res = curl_exec($ch);
        curl_close($ch);
        $cnt = $res;

        unlink($customer_file1);
        unlink($customer_file2);

        return $cnt;
    }

    function createCustomerDataFile($filename, $sql, $sqlval = array()) {
        if (extension_loaded('zlib')) {
            $filename .= ".gz";
            $this->customer_file = gzopen($filename, "wb");
            $conn = $this->app['orm.em']->getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sqlval);
            while ($data = $stmt->fetch()) {
                $line = implode("\t", $data);
                gzwrite($this->customer_file, "$line\n");
            }
            gzclose($this->customer_file);
        } else {
            $this->customer_file = fopen($filename, "wb");
            $conn = $this->app['orm.em']->getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sqlval);
            while ($data = $stmt->fetch()) {
                $line = implode("\t", $data);
                fwrite($this->customer_file, "$line\n");
            }
            fclose($this->customer_file);
        }

        return $filename;
    }

    function cbGzSaveAddress($data) {
        $line = implode("\t", $data);
        gzwrite($this->customer_file, "$line\n");
        $this->extendTimeOut();
    }

    function cbSaveAddress($data) {
        $line = implode("\t", $data);
        fwrite($this->customer_file, "$line\n");
        $this->extendTimeOut();
    }

    function getScheduler(&$isError, $triggerType, &$total, $max = -1, $offset = -1){
        $this->printLog("LC_MDL_ECQUBELEY::getScheduler:".$triggerType);

        $params = $this->createRequestPagerParam($max, $offset);
        $params['triggerType'] = $triggerType;
        $result = $this->doApiRequest($isError, $this->apiUrl . 'scheduler', 'GET', $params);
        if (!$isError) {
            $objArray = $result->jobList;
            $total = $result->total;
            return $total == 0 ? array() : $this->convertObjectToArray($objArray);
        } else {
            $total = -1;
            return $result;
        }
    }

    function schedulerExecute($deliveryId){
        $this->printLog("LC_MDL_ECQUBELEY::schedulerExecute");
        $params = array(
            'shopName' => $this->shopName,
            'apikey' => $this->apikey,
            'deliveryId' => $deliveryId
        );

        $result = $this->doApiRequest($isError, $this->apiUrl . 'scheduler', 'POST', $params);
        return $result;
    }

    function schedulerDelete($deliveryId){
        $this->printLog("LC_MDL_ECQUBELEY::schedulerDelete $deliveryId");
        $params = array(
            'shopName' => $this->shopName,
            'apikey' => $this->apikey,
            'deliveryId' => $deliveryId
        );

        $result = $this->doApiRequest($isError, $this->apiUrl . 'scheduler', 'DELETE', $params);
        return $result;
    }

    function schedulerPause($deliveryId){
        $this->printLog("LC_MDL_ECQUBELEY::schedulerPause $deliveryId");
        $params = array(
            'shopName' => $this->shopName,
            'apikey' => $this->apikey,
            'mode' => 'pause',
            'deliveryId' => $deliveryId
        );

        $result = $this->doApiRequest($isError, $this->apiUrl . 'scheduler/ctrl', 'POST', $params);
        return $result;
    }

    function schedulerResume($deliveryId){
        $this->printLog("LC_MDL_ECQUBELEY::schedulerResume $deliveryId");
        $params = array(
            'shopName' => $this->shopName,
            'apikey' => $this->apikey,
            'mode' => 'resume',
            'deliveryId' => $deliveryId
        );

        $result = $this->doApiRequest($isError, $this->apiUrl . 'scheduler/ctrl', 'POST', $params);
        return $result;
    }

    function schedulerCopy(&$isError, $deliveryId){
        $this->printLog("LC_MDL_ECQUBELEY::schedulerCopy $deliveryId");
        $params = array(
            'shopName' => $this->shopName,
            'apikey' => $this->apikey,
            'mode' => 'copy',
            'deliveryId' => $deliveryId
        );

        $result = $this->doApiRequest($isError, $this->apiUrl . 'scheduler/ctrl', 'POST', $params);
        return $result;
    }

    function getSendCounter(&$isError, &$total, $max = -1, $offset = -1){
        $params = $this->createRequestPagerParam($max, $offset);
        $result = $this->doApiRequest($isError, $this->apiUrl . 'sendCounter', 'GET', $params);
        if (!$isError) {
            $objArray = $result->counts;
            $total = $result->total;
            return $total == 0 ? array() : $this->convertObjectToArray($objArray);
        } else {
            $total = -1;
            return $result;
        }
    }


    function getDiscardList(&$isError, &$total, $max = -1, $offset = -1){
        $this->printLog("LC_MDL_ECQUBELEY::getDiscardList");

        $params = $this->createRequestPagerParam($max, $offset);
        $result = $this->doApiRequest($isError, $this->apiUrl . 'discard', 'GET', $params);
        if (!$isError) {
            $objArray = $result->discards;
            $total = $result->total;
            return $total == 0 ? array() : $this->convertObjectToArray($objArray);
        } else {
            $total = -1;
            return $result;
        }
    }

    function saveDiscard(&$isError, $address){
        $this->printLog("LC_MDL_ECQUBELEY::saveDiscard:".$address);
        $params = array(
            'shopName' => $this->shopName,
            'apikey' => $this->apikey,
            'address' => $address
        );

        $result = $this->doApiRequest($isError, $this->apiUrl . 'discard', 'POST', $params);
        return $result;
    }

    function saveDiscardFile($csvFilePath){
        // アップロード
        $uploadurl = $this->apiUrl . "discard";
        $postfields = array(
            'shopName' => $this->shopName,
            'apikey' => $this->apikey,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $uploadurl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $postfields = $this->setupCurlUpload($ch, $postfields, array('csvData' => $csvFilePath));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        curl_exec($ch);

        if(curl_errno($ch)) {
            $this->printLog("LC_MDL_ECQUBELEY::saveDiscardFile-${deliveryId} CURL_ERROR:".curl_error($ch));
        } else {
            // 後始末
            if(!unlink($csvFilePath)){
                $this->printLog("LC_MDL_ECQUBELEY::saveDiscardFile-${deliveryId} UNLINK_ERROR:".$csvFilePath);
            }
        }

        curl_close($ch);
    }

    function deleteDiscard(&$isError, $address){
        $this->printLog("LC_MDL_ECQUBELEY::deleteDiscard:".$address);
        $params = array(
            'shopName' => $this->shopName,
            'apikey' => $this->apikey,
            'address' => $address
        );

        $result = $this->doApiRequest($isError, $this->apiUrl . 'discard', 'DELETE', $params);
        return $result;
    }

    function searchDiscard(&$isError, $address){
        $this->printLog("LC_MDL_ECQUBELEY::searchDiscard:".$address);
        $params = array(
            'shopName' => $this->shopName,
            'apikey' => $this->apikey,
            'address' => $address
        );

        $result = $this->doApiRequest($isError, $this->apiUrl . 'discard', 'GET', $params);
        if (!$isError) {
            $this->printLog("discard ".print_r($result,true));
            $objArray = $result->discards;
            $total = $result->total;
            return $total == 0 ? array() : $this->convertObjectToArray($objArray);
        } else {
            $total = -1;
            return $result;
        }
    }

    function downloadDiscardList(&$isError){
        $params = array(
            'shopName' => $this->shopName,
            'apikey' => $this->apikey
        );

        $result = $this->doApiRequest($isError, $this->apiUrl . 'discard/download', 'GET', $params, true);
        return $result;
    }

    function preview(&$isError, $formObj, $customerData){
        $this->printLog("LC_MDL_ECQUBELEY::preview");

        $message = $this->createMessageParam($formObj);

        $params = array(
            'shopName' => $this->shopName,
            'apikey' => $this->apikey,
            'fromdisp' => $formObj['fromDisp'],
            'subject' => $formObj['subject'],
            'message' => json_encode($message),
            'attrh' => json_encode(array()),
            'csvData' => ''
        );

        // preview用の顧客データを追加する。
        if (is_array($customerData) && count($customerData) != 0) {

            $attrh = json_encode($this->getSendCustomerAttribute($formObj['mail_type_web'], $formObj['mail_type_c']));
            $params['attrh'] = $attrh;

            $csvData = $this->createSendCsvData($customerData[0], $formObj);
            $params['csvData'] = $csvData;
        }

        $result = $this->doApiRequest($isError, $this->apiUrl . 'preview', 'POST', $params);

        if (!$isError) {
            return $this->convertObjectToArray($result);
        } else {
            return $result;
        }
    }

    function previewTemplate(&$isError, $template_id){
        $this->printLog("LC_MDL_ECQUBELEY::previewTemplate");

        $params = array(
            'shopName' => $this->shopName,
            'apikey' => $this->apikey,
            'template_id' => $template_id
        );

        $result = $this->doApiRequest($isError, $this->apiUrl . 'preview', 'POST', $params);
        if (!$isError) {
            return $this->convertObjectToArray($result);
        } else {
            return $result;
        }
    }

    function previewDelivery(&$isError, $deliveryId){
        $this->printLog("LC_MDL_ECQUBELEY::previewDelivery");

        $params = array(
            'shopName' => $this->shopName,
            'apikey' => $this->apikey,
            'deliveryId' => $deliveryId
        );

        $result = $this->doApiRequest($isError, $this->apiUrl . 'preview', 'POST', $params);
        if (!$isError) {
            return $this->convertObjectToArray($result);
        } else {
            return $result;
        }
    }

    function getMarketing($deliveryId, $generationFlg){
        $params = array(
            'shopName' => $this->shopName,
            'apikey' => $this->apikey,
            'deliveryId' => $deliveryId
        );

        if($generationFlg){
            $params['domain'] = 'generation_gender';
        }

        $result = $this->doApiRequest($isError, $this->apiUrl . 'marketing', 'GET', $params);
        if (!$isError) {
            return $this->convertObjectToArray($result);
        } else {
            return $result;
        }
    }

    function saveUserAgent($email, $userAgent){
        $params = array(
            'shopName' => $this->shopName,
            'apikey' => $this->apikey,
            'email' => $email,
            'userAgent' => $userAgent,
        );

        try {
            $result = $this->doApiRequest($isError, $this->apiUrl . 'user_agent', 'POST', $params);
            if (!$isError) {
                return $this->convertObjectToArray($result);
            } else {
                return $result;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    static function setupCurlUpload($ch, $params, $files) {
        foreach ($files as $key => $file) {
            if (defined('CURLOPT_SAFE_UPLOAD')) {
                $params[$key] = new \CURLFile($file);
            } else {
                $params[$key] = "@".$file;
            }
        }

        if (defined('CURLOPT_SAFE_UPLOAD')) {
            curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
        }

        return $params;
    }
}
