<?php return array (
  'CartAnalytics' => 
  array (
    'config' => 
    array (
      'name' => 'CartAnalytics',
      'event' => 'CartAnalyticsEvent',
      'code' => 'CartAnalytics',
      'version' => '0.0.2',
      'service' => 
      array (
        0 => 'CartAnalyticsServiceProvider',
      ),
      'orm.path' => 
      array (
        0 => '/Resource/doctrine',
      ),
    ),
    'event' => 
    array (
      'front.cart.index.initialize' => 
      array (
        0 => 
        array (
          0 => 'calcCartAnalytics',
          1 => 'NORMAL',
        ),
      ),
      'front.shopping.complete.initialize' => 
      array (
        0 => 
        array (
          0 => 'buyCartAnalytics',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'CategoryCheckbox' => 
  array (
    'config' => 
    array (
      'name' => 'チェックボックスでカテゴリー複数指定が簡単になるプラグイン',
      'code' => 'CategoryCheckbox',
      'version' => '1.0.0',
      'service' => 
      array (
        0 => 'CategoryCheckboxServiceProvider',
      ),
      'event' => 'Event',
    ),
    'event' => 
    array (
      'admin.product.edit.initialize' => 
      array (
        0 => 
        array (
          0 => 'onAdminProductEditInitialize',
          1 => 'NORMAL',
        ),
      ),
      'Admin/Product/product.twig' => 
      array (
        0 => 
        array (
          0 => 'onAdminProductEditRendered',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'CategoryContent' => 
  array (
    'config' => 
    array (
      'name' => 'CategoryContent',
      'code' => 'CategoryContent',
      'version' => '1.0.0',
      'service' => 
      array (
        0 => 'CategoryContentServiceProvider',
      ),
      'orm.path' => 
      array (
        0 => '/Resource/doctrine',
      ),
      'event' => 'Event',
    ),
    'event' => 
    array (
      'Product/list.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderProductList',
          1 => 'NORMAL',
        ),
      ),
      'admin.product.category.index.initialize' => 
      array (
        0 => 
        array (
          0 => 'onAdminProductCategoryFormInitialize',
          1 => 'NORMAL',
        ),
      ),
      'admin.product.category.index.complete' => 
      array (
        0 => 
        array (
          0 => 'onAdminProductCategoryEditComplete',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.product_list.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderProductListBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.admin_product_category_edit.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminProductCategoryEditBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.controller.admin_product_category_edit.after' => 
      array (
        0 => 
        array (
          0 => 'onAdminProductCategoryEditAfter',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'CategorySort' => 
  array (
    'config' => 
    array (
      'name' => 'カテゴリー並び替えプラグイン(rank・レベル・階層)',
      'code' => 'CategorySort',
      'version' => '1.0.0',
      'service' => 
      array (
        0 => 'CategorySortServiceProvider',
      ),
    ),
    'event' => NULL,
  ),
  'CheckedItem' => 
  array (
    'config' => 
    array (
      'name' => '最近チェックした商品',
      'code' => 'CheckedItem',
      'version' => '1.1.1',
      'event' => 'CheckedItemEvent',
      'service' => 
      array (
        0 => 'CheckedItemServiceProvider',
      ),
      'orm.path' => 
      array (
        0 => '/Resource/doctrine',
      ),
    ),
    'event' => 
    array (
      'eccube.event.controller.product_detail.before' => 
      array (
        0 => 
        array (
          0 => 'onControllerProductDetailBefore',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'ClassNameDetail' => 
  array (
    'config' => 
    array (
      'name' => '規格詳細表示',
      'code' => 'ClassNameDetail',
      'event' => 'ClassNameDetail',
      'version' => '1.0.0',
      'service' => 
      array (
        0 => 'ClassNameDetailServiceProvider',
      ),
      'const' => 
      array (
        'division' => '／',
      ),
    ),
    'event' => 
    array (
      'Admin/Product/class_name.twig' => 
      array (
        0 => 
        array (
          0 => 'onAdminProductClassNameTwig',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'ContactList' => 
  array (
    'config' => 
    array (
      'name' => 'お問い合わせ管理',
      'code' => 'ContactList',
      'version' => '1.0.0',
      'event' => 'ContactListEvent',
      'service' => 
      array (
        0 => 'ContactListServiceProvider',
      ),
      'orm.path' => 
      array (
        0 => '/Resource/doctrine',
      ),
    ),
    'event' => 
    array (
      'front.contact.index.initialize' => 
      array (
        0 => 
        array (
          0 => 'onContactInitialize',
          1 => 'NORMAL',
        ),
      ),
      'front.contact.index.complete' => 
      array (
        0 => 
        array (
          0 => 'onContactComplete',
          1 => 'NORMAL',
        ),
      ),
      'mail.contact' => 
      array (
        0 => 
        array (
          0 => 'onMailContact',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'ContactProduct' => 
  array (
    'config' => 
    array (
      'name' => '商品お問い合わせ',
      'code' => 'ContactProduct',
      'event' => 'Event',
      'version' => '1.0.1',
    ),
    'event' => 
    array (
      'eccube.event.render.product_detail.before' => 
      array (
        0 => 
        array (
          0 => 'insertContactButton',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.contact.before' => 
      array (
        0 => 
        array (
          0 => 'setContents',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'GSFeed' => 
  array (
    'config' => 
    array (
      'name' => 'Googleショッピングフィード生成',
      'code' => 'GSFeed',
      'version' => '1.0.3',
      'service' => 
      array (
        0 => 'GSFeedServiceProvider',
      ),
      'orm.path' => 
      array (
        0 => '/Resource/doctrine',
      ),
    ),
    'event' => NULL,
  ),
  'GmoPaymentGateway' => 
  array (
    'config' => 
    array (
      'name' => 'GmoPaymentGateway',
      'event' => 'GmoPaymentGateway',
      'code' => 'GmoPaymentGateway',
      'version' => '1.1.43',
      'service' => 
      array (
        0 => 'PaymentServiceProvider',
      ),
      'const' => 
      array (
        'PaymentUtil' => true,
        'PG_MULPAY_CODE' => 'GmoPaymentGateway',
        'PG_MULPAY_SERVICE_NAME' => 'PGマルチペイメントサービス',
        'PG_MULPAY_MODULE_NAME' => 'PGマルチペイメントサービス決済モジュール',
        'PG_MULPAY_COMPANY_NAME' => 'Gmoペイメントゲートウェイ株式会社',
        'PG_MULPAY_SERVER_URL_PROD' => 'https://p01.mul-pay.jp/payment/',
        'PG_MULPAY_KANRI_URL_PROD' => 'https://k01.mul-pay.jp/payment/',
        'PG_MULPAY_SERVER_URL_TEST' => 'https://pt01.mul-pay.jp/payment/',
        'PG_MULPAY_KANRI_URL_TEST' => 'https://kt01.mul-pay.jp/kanri/',
        'PG_MULPAY_ERROR_CODE_MSG_FILE' => 'pg_mulpay_errors.txt',
        'PG_MULPAY_ORDER_COL_PAYID' => 'memo03',
        'PG_MULPAY_ORDER_COL_PAYSTATUS' => 'memo04',
        'PG_MULPAY_ORDER_COL_TRANSID' => 'memo08',
        'PG_MULPAY_PAYMENT_COL_PAYID' => 'memo03',
        'PG_MULPAY_PAYID_CREDIT' => 10,
        'PG_MULPAY_PAYID_REGIST_CREDIT' => 11,
        'PG_MULPAY_PAYID_CREDIT_CHECK' => 12,
        'PG_MULPAY_PAYID_CREDIT_SAUTH' => 12,
        'PG_MULPAY_PAYID_CVS' => 20,
        'PG_MULPAY_PAYID_PAYEASY' => 30,
        'PG_MULPAY_PAYID_ATM' => 31,
        'PG_MULPAY_PAYID_MOBILEEDY' => 40,
        'PG_MULPAY_PAYID_MOBILESUICA' => 50,
        'PG_MULPAY_PAYID_PAYPAL' => 60,
        'PG_MULPAY_PAYID_IDNET' => 70,
        'PG_MULPAY_PAYID_WEBMONEY' => 80,
        'PG_MULPAY_PAYID_AU' => 90,
        'PG_MULPAY_PAYID_AUCONTINUANCE' => 91,
        'PG_MULPAY_PAYID_DOCOMO' => 92,
        'PG_MULPAY_PAYID_DOCOMOCONTINUANCE' => 93,
        'PG_MULPAY_PAYID_SB' => 95,
        'PG_MULPAY_PAYID_COLLECT' => 900,
        'PG_MULPAY_PAYID_RAKUTEN_ID' => 99,
        'PG_MULPAY_PAYID_TOKEN' => 98,
        'PG_MULPAY_PAYCODE_CREDIT' => 'Credit',
        'PG_MULPAY_PAYCODE_REGIST_CREDIT' => 'RegistCredit',
        'PG_MULPAY_PAYCODE_CREDIT_CHECK' => 'CreditCheck',
        'PG_MULPAY_PAYCODE_CREDIT_SAUTH' => 'CreditSAUTH',
        'PG_MULPAY_PAYCODE_CVS' => 'CVS',
        'PG_MULPAY_PAYCODE_PAYEASY' => 'PayEasy',
        'PG_MULPAY_PAYCODE_ATM' => 'ATM',
        'PG_MULPAY_PAYCODE_MOBILEEDY' => 'MobileEdy',
        'PG_MULPAY_PAYCODE_MOBILESUICA' => 'MobileSuica',
        'PG_MULPAY_PAYCODE_PAYPAL' => 'PayPal',
        'PG_MULPAY_PAYCODE_IDNET' => 'IDnet',
        'PG_MULPAY_PAYCODE_WEBMONEY' => 'WebMoney',
        'PG_MULPAY_PAYCODE_AU' => 'Au',
        'PG_MULPAY_PAYCODE_DOCOMO' => 'Docomo',
        'PG_MULPAY_PAYCODE_SB' => 'Sb',
        'PG_MULPAY_PAYCODE_COLLECT' => 'Collect',
        'PG_MULPAY_PAYCODE_RAKUTEN_ID' => 'RakutenId',
        'PG_MULPAY_PAYCODE_TOKEN' => 'Token',
        'MULPAY_PAYTYPE_CREDIT' => 0,
        'MULPAY_PAYTYPE_MOBILESUICA' => 1,
        'MULPAY_PAYTYPE_MOBILEEDY' => 2,
        'MULPAY_PAYTYPE_CVS' => 3,
        'MULPAY_PAYTYPE_PAYEASY' => 4,
        'MULPAY_PAYTYPE_PAYPAL' => 5,
        'MULPAY_PAYTYPE_IDNET' => 6,
        'MULPAY_PAYTYPE_WEBMONEY' => 7,
        'MULPAY_PAYTYPE_AU' => 8,
        'MULPAY_PAYTYPE_DOCOMO' => 9,
        'MULPAY_PAYTYPE_SB' => 11,
        'MULPAY_PAYTYPE_RAKUTEN_ID' => 18,
        'PG_MULPAY_PAYNAME_CREDIT' => 'クレジットカード決済',
        'PG_MULPAY_PAYNAME_REGIST_CREDIT' => '登録済みクレジットカード決済',
        'PG_MULPAY_PAYNAME_CREDIT_CHECK' => 'クレジットカード有効性確認',
        'PG_MULPAY_PAYNAME_CREDIT_SAUTH' => 'クレジットカード与信確認',
        'PG_MULPAY_PAYNAME_CVS' => 'コンビニ決済',
        'PG_MULPAY_PAYNAME_PAYEASY' => 'Pay-easy決済(ネットバンク)',
        'PG_MULPAY_PAYNAME_ATM' => 'Pay-easy決済(銀行ATM)',
        'PG_MULPAY_PAYNAME_MOBILEEDY' => '楽天Edy決済',
        'PG_MULPAY_PAYNAME_MOBILESUICA' => 'モバイルSuica決済',
        'PG_MULPAY_PAYNAME_PAYPAL' => 'PayPal決済',
        'PG_MULPAY_PAYNAME_IDNET' => 'iD決済',
        'PG_MULPAY_PAYNAME_WEBMONEY' => 'WebMoney決済',
        'PG_MULPAY_PAYNAME_AU' => 'auかんたん決済',
        'PG_MULPAY_PAYNAME_DOCOMO' => 'ドコモケータイ払い',
        'PG_MULPAY_PAYNAME_SB' => 'ソフトバンクまとめて支払い',
        'PG_MULPAY_PAYNAME_COLLECT' => '代引決済',
        'PG_MULPAY_PAYNAME_RAKUTEN_ID' => '楽天ペイ',
        'PG_MULPAY_PAYNAME_TOKEN' => 'クレジットカード決済',
        'PG_MULPAY_ACTION_STATUS_ENTRY_REQUEST' => 1,
        'PG_MULPAY_ACTION_STATUS_EXEC_REQUEST' => 3,
        'PG_MULPAY_ACTION_STATUS_EXEC_SUCCESS' => 6,
        'PG_MULPAY_ACTION_STATUS_RECV_NOTICE' => 5,
        'PG_MULPAY_PAY_STATUS_UNSETTLED' => 0,
        'PG_MULPAY_PAY_STATUS_UNPROCESSED' => 0,
        'PG_MULPAY_PAY_STATUS_AUTHENTICATED' => 0,
        'PG_MULPAY_PAY_STATUS_AUTHPROCESS' => 0,
        'PG_MULPAY_PAY_STATUS_REQUEST_SUCCESS' => 1,
        'PG_MULPAY_PAY_STATUS_PAY_SUCCESS' => 2,
        'PG_MULPAY_PAY_STATUS_EXPIRE' => 3,
        'PG_MULPAY_PAY_STATUS_CANCEL' => 4,
        'PG_MULPAY_PAY_STATUS_FAIL' => 99,
        'PG_MULPAY_PAY_STATUS_AUTH' => 11,
        'PG_MULPAY_PAY_STATUS_COMMIT' => 12,
        'PG_MULPAY_PAY_STATUS_SALES' => 12,
        'PG_MULPAY_PAY_STATUS_CAPTURE' => 13,
        'PG_MULPAY_PAY_STATUS_VOID' => 14,
        'PG_MULPAY_PAY_STATUS_RETURN' => 15,
        'PG_MULPAY_PAY_STATUS_RETURNX' => 16,
        'PG_MULPAY_PAY_STATUS_SAUTH' => 17,
        'PG_MULPAY_PAY_STATUS_CHECK' => 18,
        'PG_MULPAY_PAY_STATUS_EXCEPT' => 19,
        'PG_MULPAY_PAY_STATUS_PAYFAIL' => 99,
        'PG_MULPAY_PAY_STATUS_PAYSTART' => 21,
        'PG_MULPAY_PAY_STATUS_REQSALES' => 22,
        'PG_MULPAY_PAY_STATUS_REQCANCEL' => 23,
        'PG_MULPAY_PAY_STATUS_REQCHANGE' => 24,
        'CONVENI_LOSON' => '00001',
        'CONVENI_LOSON_NEW' => '10001',
        'CONVENI_FAMILYMART' => '00002',
        'CONVENI_FAMILYMART_NEW' => '10002',
        'CONVENI_SUNKUS' => '00003',
        'CONVENI_SUNKUS_NEW' => '10003',
        'CONVENI_CIRCLEK' => '00004',
        'CONVENI_CIRCLEK_NEW' => '10004',
        'CONVENI_MINISTOP' => '00005',
        'CONVENI_MINISTOP_NEW' => '10005',
        'CONVENI_DAILYYAMAZAKI' => '00006',
        'CONVENI_SEVENELEVEN' => '00007',
        'SUICA_ITEM_NAME_LEN' => 40,
        'CONVENI_RULE_MAX' => 299999,
        'SUICA_RULE_MAX' => 20000,
        'EDY_RULE_MAX' => 50000,
        'CREDIT_RULE_MAX' => '',
        'PAYEASY_RULE_MAX' => 999999,
        'PAYPAL_RULE_MAX' => 999999,
        'WEBMONEY_RULE_MAX' => 999999,
        'NETID_RULE_MAX' => 999999,
        'AU_RULE_MAX' => 9999999,
        'DOCOMO_RULE_MAX' => 30000,
        'SB_RULE_MAX' => 100000,
        'RAKUTEN_ID_RULE_MAX' => 99999999,
        'TOKEN_RULE_MAX' => '',
        'PG_MULPAY_REGIST_CARD_NUM' => 5,
        'GMO_URL_IMG' => 'plugin/gmo_pg/',
        'GMO_RECEIVE_WAIT_TIME' => 5,
        'GMO_REGIST_FLG_ON' => 1,
        'GMO_ENABLE_PAYMENT_VALUE' => 0,
        'GMO_DISABLE_PAYMENT_VALUE' => 1,
        'GMO_MEMBER_ID_ENCRYPTION' => 'adler32',
        'CSV_GMO_MEMBER_TYPE' => 'GMOメンバーCSV',
        'GMO_MEMBER_MAX_PROCESS' => 5000,
      ),
      'orm.path' => 
      array (
        0 => '/Resource/doctrine',
      ),
    ),
    'event' => 
    array (
      'eccube.event.render.shopping.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderShoppingBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.shopping_complete.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderShoppingCompleteBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.admin_setting_shop_payment_edit.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminSettingShopPaymentEditBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.controller.admin_setting_shop_payment_edit.after' => 
      array (
        0 => 
        array (
          0 => 'onControllerAdminSettingShopPaymentEditAfter',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.admin_order_edit.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminOrderEditBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.admin_order_new.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminOrderNewBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.controller.admin_order_edit.after' => 
      array (
        0 => 
        array (
          0 => 'onControllerAdminOrderEditControllerAfter',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.controller.shopping_confirm.before' => 
      array (
        0 => 
        array (
          0 => 'onControllerShoppingConfirmBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.admin_customer_edit.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminCustomerEditBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.controller.admin_setting_shop_payment_delete.before' => 
      array (
        0 => 
        array (
          0 => 'onControllerAdminPaymentDeleteControllerBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.mypage.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderMypageBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.mypage_change.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderMypageBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.mypage_change_complete.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderMypageBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.mypage_delivery.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderMypageBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.mypage_delivery_new.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderMypageBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.mypage_delivery_edit.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderMypageBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.mypage_favorite.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderMypageBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.mypage_history.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderMypageBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.mypage_mail_view.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderMypageBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.mypage_order.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderMypageBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.mypage_withdraw.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderMypageBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.gmo_mypage_subscription_orders.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderMypageBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.gmo_mypage_change_card.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderMypageBefore',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'Holiday' => 
  array (
    'config' => 
    array (
      'name' => '定休日管理プラグイン',
      'event' => 'Holiday',
      'code' => 'Holiday',
      'version' => '1.0.5',
      'service' => 
      array (
        0 => 'HolidayServiceProvider',
      ),
      'orm.path' => 
      array (
        0 => '/Resource/doctrine',
      ),
    ),
    'event' => 
    array (
      'eccube.event.app.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderHoliday',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'ImgExpansion' => 
  array (
    'config' => 
    array (
      'name' => '商品画像拡大(FREE版)',
      'code' => 'ImgExpansion',
      'version' => '1.0.0',
      'event' => 'ImgExpansionEvent',
      'service' => 
      array (
        0 => 'ImgExpansionServiceProvider',
      ),
    ),
    'event' => 
    array (
      'Product/detail.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderProductDetail',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'IntroduceDiscount' => 
  array (
    'config' => 
    array (
      'name' => 'IntroduceDiscount',
      'event' => 'IntroduceDiscountEvent',
      'code' => 'IntroduceDiscount',
      'version' => '1.0.0',
      'service' => 
      array (
        0 => 'IntroduceDiscountServiceProvider',
      ),
      'orm.path' => 
      array (
        0 => '/Resource/doctrine',
      ),
    ),
    'event' => 
    array (
      'eccube.event.render.shopping.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderShoppingBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.product_detail.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderProductDetailBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.controller.shopping_confirm.before' => 
      array (
        0 => 
        array (
          0 => 'onControllerShoppingConfirmBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.mypage_history.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderMyPageHistoryBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.controller.product_detail.after' => 
      array (
        0 => 
        array (
          0 => 'onControllerProductDetailAfter',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'MailMagazine' => 
  array (
    'config' => 
    array (
      'name' => 'MailMagazine',
      'event' => 'MailMagazine',
      'code' => 'MailMagazine',
      'version' => '1.0.0',
      'service' => 
      array (
        0 => 'MailMagazineServiceProvider',
      ),
      'orm.path' => 
      array (
        0 => '/Resource/doctrine',
      ),
      'const' => 
      array (
        'mail_magazine_dir' => '${ROOT_DIR}/app/mail_magazine',
      ),
    ),
    'event' => 
    array (
      'Entry/index.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderEntryIndex',
          1 => 'NORMAL',
        ),
      ),
      'Entry/confirm.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderEntryConfirm',
          1 => 'NORMAL',
        ),
      ),
      'front.entry.index.complete' => 
      array (
        0 => 
        array (
          0 => 'onFrontEntryIndexComplete',
          1 => 'NORMAL',
        ),
      ),
      'Mypage/change.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderMypageChange',
          1 => 'NORMAL',
        ),
      ),
      'front.mypage.change.index.complete' => 
      array (
        0 => 
        array (
          0 => 'onFrontMypageChangeIndexComplete',
          1 => 'NORMAL',
        ),
      ),
      'Admin/Customer/edit.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminCustomerEdit',
          1 => 'NORMAL',
        ),
      ),
      'admin.customer.edit.index.complete' => 
      array (
        0 => 
        array (
          0 => 'onAdminCustomerEditIndexComplete',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.entry.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderEntryBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.controller.entry.after' => 
      array (
        0 => 
        array (
          0 => 'onControllerEntryAfter',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.mypage_change.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderMypageChangeBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.controller.mypage_change.after' => 
      array (
        0 => 
        array (
          0 => 'onControllMypageChangeAfter',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.admin_customer_new.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminCustomerBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.admin_customer_edit.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminCustomerBefore',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'MailTemplateEdit' => 
  array (
    'config' => 
    array (
      'name' => 'メールテンプレート機能拡張プラグイン',
      'event' => 'MailTemplateEdit',
      'code' => 'MailTemplateEdit',
      'version' => '1.0.0',
      'service' => 
      array (
        0 => 'MailTemplateEditServiceProvider',
      ),
      'orm.path' => 
      array (
        0 => '/Resource/doctrine',
      ),
    ),
    'event' => 
    array (
      'eccube.event.app.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderMailTemplate',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'Maker' => 
  array (
    'config' => 
    array (
      'name' => 'Maker',
      'event' => 'MakerEvent',
      'code' => 'Maker',
      'version' => '1.0.0',
      'service' => 
      array (
        0 => 'MakerServiceProvider',
      ),
      'orm.path' => 
      array (
        0 => '/Resource/doctrine',
      ),
    ),
    'event' => 
    array (
      'admin.product.edit.initialize' => 
      array (
        0 => 
        array (
          0 => 'onAdminProductEditInitialize',
          1 => 'NORMAL',
        ),
      ),
      'admin.product.edit.complete' => 
      array (
        0 => 
        array (
          0 => 'onAdminProductEditComplete',
          1 => 'NORMAL',
        ),
      ),
      'Product/detail.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderProductDetail',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.admin_product_product_new.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminProduct',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.admin_product_product_edit.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminProduct',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.product_detail.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderProductDetailBefore',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'NewItem1' => 
  array (
    'config' => 
    array (
      'name' => '新着商品',
      'code' => 'NewItem',
      'version' => '1.0.1',
      'service' => 
      array (
        0 => 'NewItemServiceProvider',
      ),
    ),
    'event' => NULL,
  ),
  'OrderPdf' => 
  array (
    'config' => 
    array (
      'name' => 'OrderPdf',
      'event' => 'OrderPdfEvent',
      'code' => 'OrderPdf',
      'version' => '1.0.0',
      'service' => 
      array (
        0 => 'OrderPdfServiceProvider',
      ),
      'orm.path' => 
      array (
        0 => '/Resource/doctrine',
      ),
      'const' => 
      array (
        'logo_file' => 'logo.png',
        'pdf_file' => 'nouhinsyo1.pdf',
        'order_pdf_message_len' => 30,
      ),
    ),
    'event' => 
    array (
      'Admin/Order/index.twig' => 
      array (
        0 => 
        array (
          0 => 'onAdminOrderIndexRender',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.admin_order.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminOrderPdfBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.admin_order_page.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminOrderPdfBefore',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'OrderStatusColor' => 
  array (
    'config' => 
    array (
      'name' => '受注ステータス色分けプラグイン',
      'event' => 'Event',
      'code' => 'OrderStatusColor',
      'version' => '0.0.1',
      'service' => 
      array (
        0 => 'ServiceProvider',
      ),
    ),
    'event' => 
    array (
      'Admin/Order/index.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderOrderList',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'PlgSwitchProductDispFlg' => 
  array (
    'config' => 
    array (
      'name' => '商品公開非公開プラグイン',
      'code' => 'PlgSwitchProductDispFlg',
      'version' => '1.0.0',
      'event' => 'PlgSwitchProductDispFlgEvent',
      'service' => 
      array (
        0 => 'PlgSwitchProductDispFlgServiceProvider',
      ),
    ),
    'event' => 
    array (
      'Admin/Product/index.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderProductInitialize',
          1 => 'NORMAL',
        ),
      ),
      'admin.product.index.initialize' => 
      array (
        0 => 
        array (
          0 => 'onRenderProductIndex',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'Point' => 
  array (
    'config' => 
    array (
      'name' => 'Pointプラグイン',
      'code' => 'Point',
      'version' => '1.0.0',
      'event' => 'PointEvent',
      'service' => 
      array (
        0 => 'PointServiceProvider',
      ),
      'orm.path' => 
      array (
        0 => '/Resource/doctrine',
      ),
    ),
    'event' => 
    array (
      'admin.product.edit.initialize' => 
      array (
        0 => 
        array (
          0 => 'onAdminProductEditInitialize',
          1 => 'NORMAL',
        ),
      ),
      'admin.product.edit.complete' => 
      array (
        0 => 
        array (
          0 => 'onAdminProductEditComplete',
          1 => 'NORMAL',
        ),
      ),
      'admin.customer.edit.index.initialize' => 
      array (
        0 => 
        array (
          0 => 'onAdminCustomerEditIndexInitialize',
          1 => 'NORMAL',
        ),
      ),
      'admin.customer.edit.index.complete' => 
      array (
        0 => 
        array (
          0 => 'onAdminCustomerEditIndexComplete',
          1 => 'NORMAL',
        ),
      ),
      'admin.order.edit.index.initialize' => 
      array (
        0 => 
        array (
          0 => 'onAdminOrderEditIndexInitialize',
          1 => 'NORMAL',
        ),
      ),
      'admin.order.edit.index.complete' => 
      array (
        0 => 
        array (
          0 => 'onAdminOrderEditIndexComplete',
          1 => 'NORMAL',
        ),
      ),
      'admin.order.delete.complete' => 
      array (
        0 => 
        array (
          0 => 'onAdminOrderDeleteComplete',
          1 => 'NORMAL',
        ),
      ),
      'admin.order.mail.index.complete' => 
      array (
        0 => 
        array (
          0 => 'onAdminOrderMailIndexComplete',
          1 => 'NORMAL',
        ),
      ),
      'admin.order.mail.mail.all.complete' => 
      array (
        0 => 
        array (
          0 => 'onAdminOrderMailIndexComplete',
          1 => 'NORMAL',
        ),
      ),
      'front.shopping.confirm.processing' => 
      array (
        0 => 
        array (
          0 => 'onFrontShoppingConfirmProcessing',
          1 => 'NORMAL',
        ),
      ),
      'service.shopping.notify.complete' => 
      array (
        0 => 
        array (
          0 => 'onServiceShoppingNotifyComplete',
          1 => 'NORMAL',
        ),
      ),
      'Shopping/complete.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderShoppingComplete',
          1 => 'NORMAL',
        ),
      ),
      'front.shopping.delivery.complete' => 
      array (
        0 => 
        array (
          0 => 'onFrontChangeTotal',
          1 => 'NORMAL',
        ),
      ),
      'front.shopping.payment.complete' => 
      array (
        0 => 
        array (
          0 => 'onFrontChangeTotal',
          1 => 'NORMAL',
        ),
      ),
      'front.shopping.shipping.complete' => 
      array (
        0 => 
        array (
          0 => 'onFrontChangeTotal',
          1 => 'NORMAL',
        ),
      ),
      'front.shopping.shipping.edit.complete' => 
      array (
        0 => 
        array (
          0 => 'onFrontChangeTotal',
          1 => 'NORMAL',
        ),
      ),
      'Admin/Order/edit.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminOrderEdit',
          1 => 'NORMAL',
        ),
      ),
      'Admin/Order/mail_confirm.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminOrderMailConfirm',
          1 => 'NORMAL',
        ),
      ),
      'Admin/Order/mail_all_confirm.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminOrderMailConfirm',
          1 => 'NORMAL',
        ),
      ),
      'Mypage/index.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderMyPageIndex',
          1 => 'NORMAL',
        ),
      ),
      'Shopping/index.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderShoppingIndex',
          1 => 'NORMAL',
        ),
      ),
      'Product/detail.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderProductDetail',
          1 => 'NORMAL',
        ),
      ),
      'Cart/index.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderCart',
          1 => 'NORMAL',
        ),
      ),
      'Mypage/history.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderHistory',
          1 => 'NORMAL',
        ),
      ),
      'mail.order' => 
      array (
        0 => 
        array (
          0 => 'onMailOrderComplete',
          1 => 'NORMAL',
        ),
      ),
      'mail.admin.order' => 
      array (
        0 => 
        array (
          0 => 'onMailOrderComplete',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'PostCarrier' => 
  array (
    'config' => 
    array (
      'name' => 'ポストキャリア',
      'code' => 'PostCarrier',
      'version' => '1.1.4',
      'event' => 'PostCarrierEvent',
      'service' => 
      array (
        0 => 'PostCarrierServiceProvider',
      ),
      'orm.path' => 
      array (
        0 => '/Resource/doctrine',
      ),
    ),
    'event' => 
    array (
      'front.entry.index.initialize' => 
      array (
        0 => 
        array (
          0 => 'onCustomerEditBefore',
          1 => 'NORMAL',
        ),
      ),
      'front.entry.index.complete' => 
      array (
        0 => 
        array (
          0 => 'onFrontCustomerEditAfter',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.entry.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderEntryBefore',
          1 => 'NORMAL',
        ),
      ),
      'front.mypage.change.index.initialize' => 
      array (
        0 => 
        array (
          0 => 'onCustomerEditBefore',
          1 => 'NORMAL',
        ),
      ),
      'front.mypage.change.index.complete' => 
      array (
        0 => 
        array (
          0 => 'onFrontCustomerEditAfter',
          1 => 'NORMAL',
        ),
      ),
      'admin.customer.edit.index.initialize' => 
      array (
        0 => 
        array (
          0 => 'onCustomerEditBefore',
          1 => 'NORMAL',
        ),
      ),
      'admin.customer.edit.index.complete' => 
      array (
        0 => 
        array (
          0 => 'onCustomerEditAfter',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.admin_order_search_product.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminOrderSearchProductBefore',
          1 => 'NORMAL',
        ),
      ),
      'Shopping/complete.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderShoppingComplete',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'ProductMeta' => 
  array (
    'config' => 
    array (
      'name' => '商品別meta設定',
      'code' => 'ProductMeta',
      'version' => '1.0.0',
      'event' => 'ProductMetaEvent',
      'service' => 
      array (
        0 => 'ProductMetaServiceProvider',
      ),
      'orm.path' => 
      array (
        0 => '/Resource/doctrine',
      ),
      'const' => 
      array (
        'stext_len' => 150,
      ),
    ),
    'event' => 
    array (
      'admin.product.edit.complete' => 
      array (
        0 => 
        array (
          0 => 'onAdminProductEditComplete',
          1 => 'NORMAL',
        ),
      ),
      'admin.product.copy.complete' => 
      array (
        0 => 
        array (
          0 => 'onAdminProductCopyComplete',
          1 => 'NORMAL',
        ),
      ),
      'admin.product.delete.complete' => 
      array (
        0 => 
        array (
          0 => 'onAdminProductDeleteComplete',
          1 => 'NORMAL',
        ),
      ),
      'Admin/Product/product.twig' => 
      array (
        0 => 
        array (
          0 => 'onAdminProductProductRender',
          1 => 'NORMAL',
        ),
      ),
      'front.product.detail.initialize' => 
      array (
        0 => 
        array (
          0 => 'onFrontProductDetailInitialize',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'ProductOption' => 
  array (
    'config' => 
    array (
      'name' => '商品オプションプラグイン',
      'event' => 'ProductOptionEvent',
      'code' => 'ProductOption',
      'version' => '1.3.12',
      'service' => 
      array (
        0 => 'ProductOptionServiceProvider',
      ),
      'orm.path' => 
      array (
        0 => '/Resource/doctrine',
      ),
    ),
    'event' => 
    array (
      'Admin/Product/index.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminProduct',
          1 => 'NORMAL',
        ),
      ),
      'Admin/Product/product.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminProductEdit',
          1 => 'NORMAL',
        ),
      ),
      'Admin/Order/edit.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminOrderEdit',
          1 => 'NORMAL',
        ),
      ),
      'Admin/Order/search_product.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminOrderSearchProduct',
          1 => 'NORMAL',
        ),
      ),
      'Admin/Order/mail_confirm.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminOrderMailConfirm',
          1 => 'NORMAL',
        ),
      ),
      'Admin/Order/mail_all_confirm.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminOrderMailAllConfirm',
          1 => 'NORMAL',
        ),
      ),
      'Product/detail.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderProductDetail',
          1 => 'NORMAL',
        ),
      ),
      'Cart/index.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderCart',
          1 => 'NORMAL',
        ),
        1 => 
        array (
          0 => 'onRenderCartPoint',
          1 => 'LAST',
        ),
      ),
      'Shopping/index.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderShopping',
          1 => 'NORMAL',
        ),
        1 => 
        array (
          0 => 'onRenderShoppingPoint',
          1 => 'LAST',
        ),
      ),
      'Shopping/shipping_multiple.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderShoppingMultiple',
          1 => 'NORMAL',
        ),
      ),
      'Mypage/index.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderMypage',
          1 => 'NORMAL',
        ),
      ),
      'Mypage/history.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderMypageHistory',
          1 => 'NORMAL',
        ),
      ),
      'Block/cart.twig' => 
      array (
        0 => 
        array (
          0 => 'onTemplateBlockCart',
          1 => 'NORMAL',
        ),
      ),
      'front.product.detail.initialize' => 
      array (
        0 => 
        array (
          0 => 'addCartInitialize',
          1 => 'NORMAL',
        ),
      ),
      'front.product.detail.complete' => 
      array (
        0 => 
        array (
          0 => 'addCartComplete',
          1 => 'NORMAL',
        ),
      ),
      'front.shopping.index.initialize' => 
      array (
        0 => 
        array (
          0 => 'customOrder',
          1 => 'NORMAL',
        ),
      ),
      'front.shopping.shipping.multiple.initialize' => 
      array (
        0 => 
        array (
          0 => 'multipleShippingEdit',
          1 => 'NORMAL',
        ),
      ),
      'front.shopping.confirm.processing' => 
      array (
        0 => 
        array (
          0 => 'completeShopping',
          1 => 'FIRST',
        ),
        1 => 
        array (
          0 => 'completeShoppingPoint',
          1 => 'LAST',
        ),
      ),
      'front.shopping.confirm.complete' => 
      array (
        0 => 
        array (
          0 => 'completeSendOrderMail',
          1 => 'NORMAL',
        ),
      ),
      'front.shopping.complete.initialize' => 
      array (
        0 => 
        array (
          0 => 'completeShopping',
          1 => 'NORMAL',
        ),
      ),
      'service.shopping.notify.complete' => 
      array (
        0 => 
        array (
          0 => 'onServiceShoppingNotifyComplete',
          1 => 'LAST',
        ),
      ),
      'front.mypage.mypage.order.initialize' => 
      array (
        0 => 
        array (
          0 => 'mypageOrderInitialize',
          1 => 'NORMAL',
        ),
      ),
      'front.mypage.mypage.order.complete' => 
      array (
        0 => 
        array (
          0 => 'mypageOrderComplete',
          1 => 'NORMAL',
        ),
      ),
      'admin.order.edit.index.complete' => 
      array (
        0 => 
        array (
          0 => 'registOrder',
          1 => 'NORMAL',
        ),
      ),
      'admin.order.mail.index.complete' => 
      array (
        0 => 
        array (
          0 => 'copmleteSendAdminOrderMail',
          1 => 'NORMAL',
        ),
      ),
      'admin.order.mail.mail.all.complete' => 
      array (
        0 => 
        array (
          0 => 'copmleteSendAdminOrderMailAll',
          1 => 'NORMAL',
        ),
      ),
      'admin.product.copy.complete' => 
      array (
        0 => 
        array (
          0 => 'hookAdminProductCopyComplete',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.route.admin_order_export_order.controller' => 
      array (
        0 => 
        array (
          0 => 'exportOrder',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.route.admin_order_export_shipping.controller' => 
      array (
        0 => 
        array (
          0 => 'exportShipping',
          1 => 'NORMAL',
        ),
      ),
      'mail.order' => 
      array (
        0 => 
        array (
          0 => 'onSendOrderMail',
          1 => 'FIRST',
        ),
      ),
      'mail.admin.order' => 
      array (
        0 => 
        array (
          0 => 'onSendAdminOrderMail',
          1 => 'FIRST',
        ),
      ),
      'admin.order.csv.export.order' => 
      array (
        0 => 
        array (
          0 => 'hookAdminOrderCsvExportOrder',
          1 => 'NORMAL',
        ),
      ),
      'admin.order.csv.export.shipping' => 
      array (
        0 => 
        array (
          0 => 'hookAdminOrderCsvExportShipping',
          1 => 'NORMAL',
        ),
      ),
      'admin.product.csv.export' => 
      array (
        0 => 
        array (
          0 => 'hookAdminProductCsvExport',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.admin_order_new.before' => 
      array (
        0 => 
        array (
          0 => 'changePrice',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.admin_order_edit.before' => 
      array (
        0 => 
        array (
          0 => 'changePrice',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.controller.login_check.after' => 
      array (
        0 => 
        array (
          0 => 'setCartPrice',
          1 => 'NORMAL',
        ),
      ),
      'Admin/Order/shipping_mail_confirm.twig' => 
      array (
        0 => 
        array (
          0 => 'onTemplateExpressLinkMailConfirm',
          1 => 'NORMAL',
        ),
      ),
      'Admin/Order/shipping_mail_all_confirm.twig' => 
      array (
        0 => 
        array (
          0 => 'onTemplateExpressLinkMailConfirm',
          1 => 'NORMAL',
        ),
      ),
      'admin.expresslink.mail.shipping.index.initialize' => 
      array (
        0 => 
        array (
          0 => 'hookExpressLinkShippingMailInitialize',
          1 => 'NORMAL',
        ),
      ),
      'admin.expresslink.mail.shipping.mailall.initialize' => 
      array (
        0 => 
        array (
          0 => 'hookExpressLinkShippingMailInitialize',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'ProductPriority' => 
  array (
    'config' => 
    array (
      'name' => '商品おすすめ順プラグイン',
      'code' => 'ProductPriority',
      'version' => '1.0.0',
      'event' => 'ProductPriorityEvent',
      'service' => 
      array (
        0 => 'ProductPriorityServiceProvider',
      ),
      'orm.path' => 
      array (
        0 => '/Resource/doctrine',
      ),
      'const' => 
      array (
        'readme' => 'カテゴリ毎に商品の並び順を設定できる、おすすめ順ソートを追加するプラグインです。',
      ),
    ),
    'event' => 
    array (
      'front.product.index.search' => 
      array (
        0 => 
        array (
          0 => 'onProductIndexSearch',
          1 => 'NORMAL',
        ),
      ),
      'admin.product.edit.complete' => 
      array (
        0 => 
        array (
          0 => 'onAdminProductEditComplete',
          1 => 'NORMAL',
        ),
      ),
      'admin.product.delete.complete' => 
      array (
        0 => 
        array (
          0 => 'onAdminProductDeleteComplete',
          1 => 'NORMAL',
        ),
      ),
      'admin.product.category.delete.complete' => 
      array (
        0 => 
        array (
          0 => 'onAdminProductCategoryDeleteComplete',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'ProductReview' => 
  array (
    'config' => 
    array (
      'name' => '商品レビュープラグイン',
      'code' => 'ProductReview',
      'version' => '1.0.0',
      'service' => 
      array (
        0 => 'ProductReviewServiceProvider',
      ),
      'orm.path' => 
      array (
        0 => '/Resource/doctrine',
      ),
      'event' => 'Event',
      'const' => 
      array (
        'review_regist_min' => 1,
        'review_regist_max' => 30,
      ),
    ),
    'event' => 
    array (
      'Product/detail.twig' => 
      array (
        0 => 
        array (
          0 => 'onProductDetailRender',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.product_detail.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderProductsDetailBefore',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'Recommend' => 
  array (
    'config' => 
    array (
      'name' => 'おすすめ商品管理プラグイン',
      'code' => 'Recommend',
      'version' => '2.0.1',
      'service' => 
      array (
        0 => 'RecommendServiceProvider',
      ),
      'orm.path' => 
      array (
        0 => '/Resource/doctrine',
      ),
    ),
    'event' => NULL,
  ),
  'Recommendify3' => 
  array (
    'config' => 
    array (
      'name' => 'この商品を買った人はこんな商品も買っていますプラグイン for EC-CUBE3',
      'code' => 'Recommendify3',
      'version' => '1.0.1',
      'service' => 
      array (
        0 => 'Recommendify3ServiceProvider',
      ),
    ),
    'event' => NULL,
  ),
  'RelatedProduct' => 
  array (
    'config' => 
    array (
      'name' => '関連商品プラグイン',
      'code' => 'RelatedProduct',
      'version' => '1.0.0',
      'service' => 
      array (
        0 => 'RelatedProductServiceProvider',
      ),
      'orm.path' => 
      array (
        0 => '/Resource/doctrine',
      ),
      'event' => 'Event',
    ),
    'event' => 
    array (
      'Product/detail.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderProductDetail',
          1 => 'NORMAL',
        ),
      ),
      'admin.product.edit.initialize' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminProductInit',
          1 => 'NORMAL',
        ),
      ),
      'admin.product.edit.complete' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminProductComplete',
          1 => 'NORMAL',
        ),
      ),
      'Admin/Product/product.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminProduct',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.admin_product_product_new.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminProductEditBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.admin_product_product_edit.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderAdminProductEditBefore',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.render.product_detail.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderProductDetailBefore',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'SalesRanking' => 
  array (
    'config' => 
    array (
      'name' => '売上ランキング',
      'code' => 'SalesRanking',
      'version' => '1.0.2',
      'service' => 
      array (
        0 => 'SalesRankingServiceProvider',
      ),
      'orm.path' => 
      array (
        0 => '/Resource/doctrine',
      ),
    ),
    'event' => NULL,
  ),
  'SalesReport' => 
  array (
    'config' => 
    array (
      'name' => '売上集計プラグイン',
      'code' => 'SalesReport',
      'version' => '1.0.0',
      'service' => 
      array (
        0 => 'SalesReportServiceProvider',
      ),
      'const' => 
      array (
        'product_maximum_display' => 20,
      ),
    ),
    'event' => NULL,
  ),
  'Shiro8FreeShippingDisplay3' => 
  array (
    'config' => 
    array (
      'name' => '送料無料条件表示プラグイン',
      'code' => 'Shiro8FreeShippingDisplay3',
      'version' => 1,
      'event' => 'Shiro8FreeShippingDisplay3Event',
    ),
    'event' => 
    array (
      'eccube.event.render.shopping.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderShoppingBefore',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'Shiro8GallaryBlock3' => 
  array (
    'config' => 
    array (
      'name' => 'ギャラリーブロックプラグイン',
      'version' => 1,
      'event' => 'Shiro8GallaryBlock3Event',
      'service' => 
      array (
        0 => 'Shiro8GallaryBlock3ServiceProvider',
      ),
      'code' => 'Shiro8GallaryBlock3',
      'orm.path' => 
      array (
        0 => '/Resource/doctrine',
      ),
    ),
    'event' => 
    array (
      'admin.product.edit.initialize' => 
      array (
        0 => 
        array (
          0 => 'onAdminProductFormInitialize',
          1 => 'NORMAL',
        ),
      ),
      'admin.product.edit.complete' => 
      array (
        0 => 
        array (
          0 => 'onAdminProductEditComplete',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'Shiro8NewProductBlock3' => 
  array (
    'config' => 
    array (
      'name' => '新着商品ブロックプラグイン',
      'version' => 1,
      'service' => 
      array (
        0 => 'Shiro8NewProductBlock3ServiceProvider',
      ),
      'code' => 'Shiro8NewProductBlock3',
    ),
    'event' => NULL,
  ),
  'Shiro8PriceDownRate3' => 
  array (
    'config' => 
    array (
      'name' => '値引き率表示！！',
      'version' => 1.100000000000000088817841970012523233890533447265625,
      'code' => 'Shiro8PriceDownRate3',
      'event' => 'Shiro8PriceDownRate3Event',
    ),
    'event' => 
    array (
      'Product/list.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderProductList',
          1 => 'NORMAL',
        ),
      ),
      'Product/detail.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderProductDetail',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'Shiro8ProductRichSnippets3' => 
  array (
    'config' => 
    array (
      'name' => '商品リッチスニペットプラグイン',
      'version' => 1,
      'code' => 'Shiro8ProductRichSnippets3',
      'event' => 'Shiro8ProductRichSnippets3Event',
    ),
    'event' => 
    array (
      'eccube.event.route.product_detail.response' => 
      array (
        0 => 
        array (
          0 => 'onRenderProductDetail',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'Shiro8Welcome3' => 
  array (
    'config' => 
    array (
      'name' => 'ようこそプラグイン',
      'version' => 1,
      'code' => 'Shiro8Welcome3',
      'service' => 
      array (
        0 => 'Shiro8Welcome3ServiceProvider',
      ),
      'orm.path' => 
      array (
        0 => '/Resource/doctrine',
      ),
    ),
    'event' => 
    array (
      'eccube.event.front.request' => 
      array (
        0 => 
        array (
          0 => 'onRequestFront',
          1 => 'NORMAL',
        ),
      ),
      'eccube.event.front.response' => 
      array (
        0 => 
        array (
          0 => 'onResponseFront',
          1 => 'NORMAL',
        ),
      ),
      'default_frame.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'error.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'index.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'pagination.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Block/search_product.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Block/news.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Block/new_product.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Block/logo.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Block/login.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Block/garally.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Block/free.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Block/footer.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Block/category.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Block/cart.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Block/index.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Cart/index.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Contact/complete.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Contact/confirm.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Contact/index.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Entry/activate.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Entry/complete.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Entry/confirm.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Entry/index.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Forgot/complete.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Forgot/index.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Forgot/reset.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Form/form_layout.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Help/about.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Help/agreement.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Help/guide.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Help/privacy.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Help/tradelaw.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Mail/contact_mail.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Mail/customer_withdraw_mail.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Mail/entry_complete.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Mail/entry_confirm.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Mail/forgot_mail.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Mail/order.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Mail/reset_complete_mail.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Mypage/change.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Mypage/change_complete.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Mypage/delivery.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Mypage/delivery_edit.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Mypage/favorite.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Mypage/history.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Mypage/index.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Mypage/login.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Mypage/navi.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Mypage/withdraw.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Mypage/withdraw_complete.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Mypage/withdraw_confirm.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Product/detail.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Product/list.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Shopping/complete.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Shopping/index.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Shopping/login.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Shopping/nonmember.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Shopping/shipping.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Shopping/shipping_edit.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Shopping/shipping_multiple.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Shopping/shipping_multiple_edit.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
      'Shopping/shopping_error.twig' => 
      array (
        0 => 
        array (
          0 => 'onReplace',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'SiteMap' => 
  array (
    'config' => 
    array (
      'name' => 'サイトマップ',
      'code' => 'SiteMap',
      'version' => '1.1.0',
      'service' => 
      array (
        0 => 'SiteMapServiceProvider',
      ),
      'orm.path' => 
      array (
        0 => '/Resource/doctrine',
      ),
    ),
    'event' => NULL,
  ),
  'SocialButton' => 
  array (
    'config' => 
    array (
      'name' => 'ソーシャルボタン',
      'code' => 'SocialButton',
      'version' => '1.0.2',
      'event' => 'SocialButtonEvent',
      'service' => 
      array (
        0 => 'SocialButtonServiceProvider',
      ),
    ),
    'event' => 
    array (
      'eccube.event.render.product_detail.before' => 
      array (
        0 => 
        array (
          0 => 'onRenderProductDetailBefore',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'SortProduct' => 
  array (
    'config' => 
    array (
      'name' => '商品並び替えプラグイン',
      'code' => 'SortProduct',
      'version' => '1.2.1',
      'event' => 'Event',
      'service' => 
      array (
        0 => 'SortProductServiceProvider',
      ),
      'orm.path' => 
      array (
        0 => '/Resource/doctrine',
      ),
    ),
    'event' => 
    array (
      'Product/list.twig' => 
      array (
        0 => 
        array (
          0 => 'sortProduct',
          1 => 'NORMAL',
        ),
      ),
      'front.product.index.search' => 
      array (
        0 => 
        array (
          0 => 'setDQL',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'ToTop' => 
  array (
    'config' => 
    array (
      'name' => 'PAGE TOP プラグイン',
      'code' => 'ToTop',
      'version' => '1.0.0',
      'event' => 'ToTopEvent',
    ),
    'event' => 
    array (
      'eccube.event.front.response' => 
      array (
        0 => 
        array (
          0 => 'onRenderToTop',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
);