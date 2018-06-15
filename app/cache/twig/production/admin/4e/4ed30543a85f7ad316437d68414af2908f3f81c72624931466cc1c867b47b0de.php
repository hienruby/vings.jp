<?php

/* __string_template__e400028a20c0b85289132a9f733afda6517fb9cb52852128f3b7bab75a4bd4f5 */
class __TwigTemplate_3ec8713962728bb432f23468942dd074a4b55ea98f0ef9d537479a33986e1bfe extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 22
        $this->parent = $this->loadTemplate("default_frame.twig", "__string_template__e400028a20c0b85289132a9f733afda6517fb9cb52852128f3b7bab75a4bd4f5", 22);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'sub_title' => array($this, 'block_sub_title'),
            'stylesheet' => array($this, 'block_stylesheet'),
            'javascript' => array($this, 'block_javascript'),
            'main' => array($this, 'block_main'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "default_frame.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 24
        $context["menus"] = array(0 => "order", 1 => "order_master");
        // line 29
        $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->setTheme((isset($context["searchForm"]) ? $context["searchForm"] : null), array(0 => "Form/bootstrap_3_horizontal_layout.html.twig"));
        // line 22
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 26
    public function block_title($context, array $blocks = array())
    {
        echo "受注管理";
    }

    // line 27
    public function block_sub_title($context, array $blocks = array())
    {
        echo "受注マスター";
    }

    // line 31
    public function block_stylesheet($context, array $blocks = array())
    {
        // line 32
        echo "<link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "admin_urlpath", array()), "html", null, true);
        echo "/assets/css/bootstrap-datetimepicker.min.css\">
";
    }

    // line 35
    public function block_javascript($context, array $blocks = array())
    {
        // line 36
        echo "<script src=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "admin_urlpath", array()), "html", null, true);
        echo "/assets/js/vendor/moment.min.js\"></script>
<script src=\"";
        // line 37
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "admin_urlpath", array()), "html", null, true);
        echo "/assets/js/vendor/moment-ja.js\"></script>
<script src=\"";
        // line 38
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "admin_urlpath", array()), "html", null, true);
        echo "/assets/js/vendor/bootstrap-datetimepicker.min.js\"></script>
<script>
  \$(function() {

    var inputDate = document.createElement('input');
    inputDate.setAttribute('type', 'date');
    if (inputDate.type !== 'date') {
      \$('input[id\$=_date_start]').datetimepicker({
        locale: 'ja',
        format: 'YYYY-MM-DD',
        useCurrent: false,
        showTodayButton: true
      });

      \$('input[id\$=_date_end]').datetimepicker({
        locale: 'ja',
        format: 'YYYY-MM-DD',
        useCurrent: false,
        showTodayButton: true
      });
    }


    // 登録チェックボックス
    \$('#check-all').click(function() {
      var checkall = \$('#check-all').prop('checked');
      if (checkall) {
        \$('input[id^=check-]').prop('checked', true);
        } else {
        \$('input[id^=check-]').prop('checked', false);
      }
    });

    \$('#dropmenu ul a').click(function(event) {
      event.preventDefault();
      var href = \$(this).attr('href');
      var isChecked = false;
      \$('input[id^=check-]').each(function() {
        var check = \$(this).prop('checked');
        if (check) {
          isChecked = true;
        }
      });
      if (!isChecked) {
        alert(\"チェックボックスが選択されていません\");
        return false;
      }
      \$('#dropdown-form').attr('action', href).submit();
        return false;
    });

    // フォーム値を確認し、アコーディオンを制御
    // 値あり : 開く / 値なし : 閉じる
    (function(\$, f) {
        //フォームがないページは処理キャンセル
        var \$ac = \$(\".accpanel\");
        if (!\$ac) {
            return false
        }

        //フォーム内全項目取得
        var c = f();
        if (c.formState()) {
            if (\$ac.css(\"display\") == \"none\") {
                \$ac.siblings('.toggle').addClass(\"active\");
                \$ac.slideDown(0);
            }
        } else {
            \$ac.siblings('.toggle').removeClass(\"active\");
            \$ac.slideUp(0);
        }
    })(\$, formPropStateSubscriber);
});
</script>
";
    }

    // line 114
    public function block_main($context, array $blocks = array())
    {
        // line 115
        echo "<!--検索条件設定テーブルここから-->
<div id=\"search_wrap\" class=\"search-box\">
  <form name=\"search_form\" id=\"search_form\" method=\"post\" action=\"";
        // line 117
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("admin_order");
        echo "\">
    ";
        // line 118
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "_token", array()), 'widget');
        echo "
    <div id=\"search_box_main\" class=\"row\">
      <div id=\"search_box_main__body\" class=\"col-md-12 accordion\">
        ";
        // line 121
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "multi", array()), 'widget', array("attr" => array("placeholder" => "受注ID・注文者名・注文者会社名", "class" => "input_search")));
        echo "

        <a href=\"#\" class=\"toggle";
        // line 123
        if ((isset($context["active"]) ? $context["active"] : null)) {
            echo " active";
        }
        echo "\">
          <svg class=\"cb cb-minus\"> <use xlink:href=\"#cb-minus\"/></svg> <svg class=\"cb cb-minus\"> <use xlink:href=\"#cb-minus\"/></svg>
        </a>
        <div id=\"search_box_main__body_toggle\" class=\"search-box-inner accpanel\" ";
        // line 126
        if ((isset($context["active"]) ? $context["active"] : null)) {
            echo " style=\"display: block;\"";
        }
        echo ">
          <div class=\"row\">
            <div id=\"search_box_main__body_inner\" class=\"col-sm-12 col-lg-10 col-lg-offset-1 search\">

              <div class=\"row\">
                <div class=\"col-sm-12\">
                  <div id=\"search_box_main__multi_status\" class=\"form-group\">
                    <label>対応状況</label>
                    <div>
                      ";
        // line 135
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "multi_status", array()), 'widget');
        echo "
                    </div>
                  </div>
                </div>
              </div><!-- /.row -->
              <div class=\"row\">
                <div class=\"col-md-6\">
                  <div id=\"search_box_main__name\" class=\"form-group\">
                    <label>お名前</label>
                    ";
        // line 144
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "name", array()), 'widget');
        echo "
                  </div>
                </div>
                <div class=\"col-md-6\">
                  <div id=\"search_box_main__kana\" class=\"form-group\">
                    <label>お名前(フリガナ)</label>
                    ";
        // line 150
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "kana", array()), 'widget');
        echo "
                    ";
        // line 151
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "kana", array()), 'errors');
        echo "
                  </div>
                </div>
              </div><!-- /.row -->
              <div class=\"row\">
                <div class=\"col-sm-6\">
                  <div id=\"search_box_main__tel\" class=\"form-group\">
                    <label>電話番号</label>
                    ";
        // line 159
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "tel", array()), 'widget');
        echo "
                    ";
        // line 160
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "tel", array()), 'errors');
        echo "
                  </div>
                </div>
                <div id=\"search_box_main__email\" class=\"col-sm-6\">
                  <label>メールアドレス</label>
                  <div class=\"form-group\">
                    ";
        // line 166
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "email", array()), 'widget');
        echo "
                    ";
        // line 167
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "email", array()), 'errors');
        echo "
                  </div>
                </div>
              </div><!-- /.row -->

              <div class=\"row\">
                <div class=\"col-xs-12\">
                  <div id=\"search_box_main__sex\" class=\"form-group\">
                    <label>性別</label>
                    ";
        // line 176
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "sex", array()), 'widget');
        echo "
                  </div>
                </div>
              </div><!-- /.row -->

              <div class=\"row\">
                <div class=\"col-sm-12\">
                  <div id=\"search_box_main__payment\" class=\"form-group\">
                    <label>支払方法</label>
                    <div>
                      ";
        // line 186
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "payment", array()), 'widget');
        echo "
                    </div>
                  </div>
                </div>
              </div><!-- /.row -->

              <div class=\"row\">
                <div id=\"search_box_main__order_date\" class=\"col-sm-6\">
                  <label>受注日</label>
                  <div class=\"form-group range\">
                    ";
        // line 196
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "order_date_start", array()), 'widget', array("attr" => array("class" => "input_cal")));
        echo " ～ ";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "order_date_end", array()), 'widget', array("attr" => array("class" => "input_cal")));
        echo "
                  </div>
                </div>
                <div id=\"search_box_main__payment_date\" class=\"col-sm-6\">
                  <label>入金日</label>
                  <div class=\"form-group range\">
                    ";
        // line 202
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "payment_date_start", array()), 'widget', array("attr" => array("class" => "input_cal")));
        echo " ～ ";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "payment_date_end", array()), 'widget', array("attr" => array("class" => "input_cal")));
        echo "
                  </div>
                </div>
              </div><!-- /.row -->

              <div class=\"row\">
                <div id=\"search_box_main__commit_date\" class=\"col-sm-6\">
                  <label>発送日</label>
                  <div class=\"form-group range\">
                    ";
        // line 211
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "commit_date_start", array()), 'widget', array("attr" => array("class" => "input_cal")));
        echo " ～ ";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "commit_date_end", array()), 'widget', array("attr" => array("class" => "input_cal")));
        echo "
                  </div>
                </div>
                <div id=\"search_box_main__update_date\" class=\"col-sm-6\">
                  <label>更新日</label>
                  <div class=\"form-group range\">
                    ";
        // line 217
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "update_date_start", array()), 'widget', array("attr" => array("class" => "input_cal")));
        echo " ～ ";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "update_date_end", array()), 'widget', array("attr" => array("class" => "input_cal")));
        echo "
                  </div>
                </div>
              </div><!-- /.row -->

              <div class=\"row\">
                <div class=\"col-sm-6\">
                  <div id=\"search_box_main__payment_total\" class=\"form-group range\">
                    <label>購入金額</label>
                    ";
        // line 226
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "payment_total_start", array()), 'widget');
        echo " ～ ";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "payment_total_end", array()), 'widget');
        echo "
                  </div>
                </div>
                <div class=\"col-md-6\">
                  <div id=\"search_box_main__buy_product_name\" class=\"form-group\">
                    <label>購入商品名</label>
                    ";
        // line 232
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "buy_product_name", array()), 'widget');
        echo "
                  </div>
                </div>
                  <div class=\"extra-form col-md-12\">
                      ";
        // line 236
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["searchForm"]) ? $context["searchForm"] : null), "getIterator", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
            // line 237
            echo "                          ";
            if (preg_match("[^plg*]", $this->getAttribute($this->getAttribute($context["f"], "vars", array()), "name", array()))) {
                // line 238
                echo "                            <div class=\"form-group\">
                              ";
                // line 239
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'label');
                echo "
                              ";
                // line 240
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'widget');
                echo "
                              ";
                // line 241
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'errors');
                echo "
                            </div>
                          ";
            }
            // line 244
            echo "                      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['f'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 245
        echo "                  </div>

              </div><!-- /.row -->
              <div id=\"search_box_main__clear\" class=\"row\">
                <div class=\"col-sm-12\">
                  <p class=\"text-center\"><a href=\"#\" class=\"search-clear\">検索条件をクリア</a></p>
                </div>
              </div><!-- /.row -->
            </div>
          </div>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <div id=\"search_box_footer\" class=\"row btn_area\">
      <div id=\"search_box_footer__button_area\" class=\"col-xs-8 col-xs-offset-2 col-sm-4 col-sm-offset-4 text-center\">
        <button type=\"submit\" class=\"btn btn-primary btn-block btn-lg\">
          検索する <svg class=\"cb cb-angle-right\"> <use xlink:href=\"#cb-angle-right\" /></svg>
        </button>
      </div>
      <!-- /.col -->
    </div>
  </form>
</div>
<!--検索条件設定テーブルここまで-->

";
        // line 271
        if ((isset($context["pagination"]) ? $context["pagination"] : null)) {
            // line 272
            echo "    <div id=\"result_list\" class=\"row\">
        <div class=\"col-md-12\">
            <div id=\"result_list_main\" class=\"box\">
                ";
            // line 275
            if (($this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "totalItemCount", array()) > 0)) {
                // line 276
                echo "                <div id=\"result_list_main__header\" class=\"box-header with-arrow\">
                    <h3 class=\"box-title\">検索結果 <span class=\"normal\"><strong>";
                // line 277
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "totalItemCount", array()), "html", null, true);
                echo " 件</strong> が該当しました</span></h3>
                </div><!-- /.box-header -->
                <div id=\"result_list_main__body\" class=\"box-body\">
                    <div id=\"result_list_main__menu\" class=\"row\">
                        <div class=\"col-md-12\">
                            <ul class=\"sort-dd\">
                                <li id=\"result_list_main__pagemax_menu\" class=\"dropdown\">
                                    ";
                // line 284
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["pageMaxis"]) ? $context["pageMaxis"] : null));
                foreach ($context['_seq'] as $context["_key"] => $context["pageMax"]) {
                    if (($this->getAttribute($context["pageMax"], "name", array()) == (isset($context["page_count"]) ? $context["page_count"] : null))) {
                        // line 285
                        echo "                                        <a id=\"result_list_main__pagemax_menu_toggle\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["pageMax"], "name", array()));
                        echo "件<svg class=\"cb cb-angle-down icon_down\"> <use xlink:href=\"#cb-angle-down\" /></svg></a>
                                        <ul class=\"dropdown-menu\">
                                    ";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pageMax'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 288
                echo "                                    ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["pageMaxis"]) ? $context["pageMaxis"] : null));
                foreach ($context['_seq'] as $context["_key"] => $context["pageMax"]) {
                    if (($this->getAttribute($context["pageMax"], "name", array()) != (isset($context["page_count"]) ? $context["page_count"] : null))) {
                        // line 289
                        echo "                                            <li><a href=\"";
                        echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPath("admin_order_page", array("page_no" => 1, "page_count" => $this->getAttribute($context["pageMax"], "name", array()))), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["pageMax"], "name", array()));
                        echo "件</a></li>
                                    ";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pageMax'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 291
                echo "                                        </ul>
                                </li>
                                <li id=\"result_list_main__csv_menu\" class=\"dropdown\">
                                    <a id=\"result_list_main__csv_menu_toggle\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">CSVダウンロード<svg class=\"cb cb-angle-down icon_down\"> <use xlink:href=\"#cb-angle-down\" /></svg></a>
                                    <ul class=\"dropdown-menu\">
                                        <li><a href=\"";
                // line 296
                echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("admin_order_export_order");
                echo "\">受注CSVダウンロード</a></li>
                                        <li><a href=\"";
                // line 297
                echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("admin_order_export_shipping");
                echo "\">配送CSVダウンロード</a></li>
                                        <li><a href=\"";
                // line 298
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("admin_setting_shop_csv", array("id" => twig_constant("\\Eccube\\Entity\\Master\\CsvType::CSV_TYPE_ORDER"))), "html", null, true);
                echo "\">受注CSV出力項目設定</a></li>
                                        <li><a href=\"";
                // line 299
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("admin_setting_shop_csv", array("id" => twig_constant("\\Eccube\\Entity\\Master\\CsvType::CSV_TYPE_SHIPPING"))), "html", null, true);
                echo "\">配送CSV出力項目設定</a></li>
                                    </ul>
                                </li>
                                <li id=\"dropmenu\" class=\"dropdown\">
                                    <a id=\"result_list_main__other_menu_toggle\"class=\"dropdown-toggle\" data-toggle=\"dropdown\">その他<svg class=\"cb cb-angle-down icon_down\"> <use xlink:href=\"#cb-angle-down\" /></svg></a>
                                    <ul class=\"dropdown-menu\">
                                        <li><a href=\"";
                // line 305
                echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("admin_order_mail_all");
                echo "\">メール一括通知</a></li>
                                    ";
                // line 316
                echo "<li><a href=\"";
                echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("plugin_admin_order_pdf");
                echo "\" >帳票出力</a></li>
</ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <form id=\"dropdown-form\">
                    <div id=\"result_list_main__list\" class=\"table_list\">
                        <div id=\"result_list_main__list_body\" class=\"table-responsive with-border\">
                            <table class=\"table table-striped\">
                                <thead>
                                    <tr id=\"result_list_main__header\">
                                        <th class=\"text-center\"><input type=\"checkbox\" id=\"check-all\"></th>
                                        <th id=\"result_list_main__header_order_date\">受注日</th>
                                        <th id=\"result_list_main__header_id\">注文番号</th>
                                        <th id=\"result_list_main__header_name\">お名前</th>
                                        <th id=\"result_list_main__header_payment_method\">支払方法</th>
                                        <th id=\"result_list_main__header_payment_total\">購入金額(円)</th>
                                        <th id=\"result_list_main__header_commit_date\">発送日</th>
                                        <th id=\"result_list_main__header_order_status\">対応状況</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                            ";
                // line 340
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["pagination"]) ? $context["pagination"] : null));
                foreach ($context['_seq'] as $context["_key"] => $context["Order"]) {
                    // line 341
                    echo "                                    <tr id=\"result_list_main__item--";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["Order"], "id", array()), "html", null, true);
                    echo "\">
                                        <td id=\"result_list_main__id_check--";
                    // line 342
                    echo twig_escape_filter($this->env, $this->getAttribute($context["Order"], "id", array()), "html", null, true);
                    echo "\" class=\"text-center\"><input type=\"checkbox\" id=\"check-";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["Order"], "id", array()), "html", null, true);
                    echo "\" data-id=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["Order"], "id", array()), "html", null, true);
                    echo "\" name=\"ids";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["Order"], "id", array()), "html", null, true);
                    echo "\"></td>
                                        <td id=\"result_list_main__order_date--";
                    // line 343
                    echo twig_escape_filter($this->env, $this->getAttribute($context["Order"], "id", array()), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getDateFormatFilter($this->getAttribute($context["Order"], "order_date", array())), "html", null, true);
                    echo "</td>
                                        <td id=\"result_list_main__id--";
                    // line 344
                    echo twig_escape_filter($this->env, $this->getAttribute($context["Order"], "id", array()), "html", null, true);
                    echo "\"><a href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("admin_order_edit", array("id" => $this->getAttribute($context["Order"], "id", array()))), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["Order"], "id", array()), "html", null, true);
                    echo "</a></td>
                                        <td id=\"result_list_main__name--";
                    // line 345
                    echo twig_escape_filter($this->env, $this->getAttribute($context["Order"], "id", array()), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["Order"], "name01", array()), "html", null, true);
                    echo " ";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["Order"], "name02", array()), "html", null, true);
                    echo "</td>
                                        <td id=\"result_list_main__payment_method--";
                    // line 346
                    echo twig_escape_filter($this->env, $this->getAttribute($context["Order"], "id", array()), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["Order"], "payment_method", array()), "html", null, true);
                    echo "</td>
                                        <td id=\"result_list_main__payment_total--";
                    // line 347
                    echo twig_escape_filter($this->env, $this->getAttribute($context["Order"], "id", array()), "html", null, true);
                    echo "\" class=\"text-right\">";
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["Order"], "payment_total", array())), "html", null, true);
                    echo "</td>
                                        <td id=\"result_list_main__commit_date--";
                    // line 348
                    echo twig_escape_filter($this->env, $this->getAttribute($context["Order"], "id", array()), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getDateFormatFilter($this->getAttribute($context["Order"], "commit_date", array())), "html", null, true);
                    echo "</td>
                                        <td id=\"result_list_main__order_status--";
                    // line 349
                    echo twig_escape_filter($this->env, $this->getAttribute($context["Order"], "id", array()), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["Order"], "OrderStatus", array()), "html", null, true);
                    echo "</td>
                                        <td id=\"result_list_main__item_menu_box--";
                    // line 350
                    echo twig_escape_filter($this->env, $this->getAttribute($context["Order"], "id", array()), "html", null, true);
                    echo "\" class=\"icon_edit\">
                                            <div id=\"result_list_main__item_menu--";
                    // line 351
                    echo twig_escape_filter($this->env, $this->getAttribute($context["Order"], "id", array()), "html", null, true);
                    echo "\" class=\"dropdown\">
                                                <a id=\"result_list_main__item_menu_toggle--";
                    // line 352
                    echo twig_escape_filter($this->env, $this->getAttribute($context["Order"], "id", array()), "html", null, true);
                    echo "\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><svg class=\"cb cb-ellipsis-h\"> <use xlink:href=\"#cb-ellipsis-h\" /></svg></a>
                                                <ul id=\"result_list_main_item_menu--";
                    // line 353
                    echo twig_escape_filter($this->env, $this->getAttribute($context["Order"], "id", array()), "html", null, true);
                    echo "\" class=\"dropdown-menu dropdown-menu-right\">
                                                <li><a href=\"";
                    // line 354
                    echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("admin_order_edit", array("id" => $this->getAttribute($context["Order"], "id", array()))), "html", null, true);
                    echo "\">編集</a></li>
                                                <li><a href=\"";
                    // line 355
                    echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("admin_order_delete", array("id" => $this->getAttribute($context["Order"], "id", array()))), "html", null, true);
                    echo "\" ";
                    echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getCsrfTokenForAnchor();
                    echo " data-method=\"delete\" data-message=\"この受注情報を削除してもよろしいですか？\">削除</a></li>
                                                <li><a href=\"";
                    // line 356
                    echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("admin_order_mail", array("id" => $this->getAttribute($context["Order"], "id", array()))), "html", null, true);
                    echo "\">メール通知</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Order'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 362
                echo "                                </tbody>
                            </table>
                        </div>
                    </div>
                    </form>
                </div><!-- /.box-body -->
                ";
                // line 368
                if (($this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "totalItemCount", array()) > 0)) {
                    // line 369
                    echo "                    ";
                    $this->loadTemplate("pager.twig", "__string_template__e400028a20c0b85289132a9f733afda6517fb9cb52852128f3b7bab75a4bd4f5", 369)->display(array_merge($context, array("pages" => $this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "paginationData", array()), "routes" => "admin_order_page")));
                    // line 370
                    echo "                ";
                }
                // line 371
                echo "                ";
            } else {
                // line 372
                echo "                <div class=\"box-header with-arrow\">
                    <h3 class=\"box-title\">検索条件に該当するデータがありませんでした。</h3>
                </div><!-- /.box-header -->
                ";
            }
            // line 376
            echo "            </div><!-- /.box -->
        </div><!-- /.col -->
    </div>

";
        }
        // line 381
        echo "
";
    }

    public function getTemplateName()
    {
        return "__string_template__e400028a20c0b85289132a9f733afda6517fb9cb52852128f3b7bab75a4bd4f5";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  662 => 381,  655 => 376,  649 => 372,  646 => 371,  643 => 370,  640 => 369,  638 => 368,  630 => 362,  618 => 356,  612 => 355,  608 => 354,  604 => 353,  600 => 352,  596 => 351,  592 => 350,  586 => 349,  580 => 348,  574 => 347,  568 => 346,  560 => 345,  552 => 344,  546 => 343,  536 => 342,  531 => 341,  527 => 340,  499 => 316,  495 => 305,  486 => 299,  482 => 298,  478 => 297,  474 => 296,  467 => 291,  455 => 289,  449 => 288,  438 => 285,  433 => 284,  423 => 277,  420 => 276,  418 => 275,  413 => 272,  411 => 271,  383 => 245,  377 => 244,  371 => 241,  367 => 240,  363 => 239,  360 => 238,  357 => 237,  353 => 236,  346 => 232,  335 => 226,  321 => 217,  310 => 211,  296 => 202,  285 => 196,  272 => 186,  259 => 176,  247 => 167,  243 => 166,  234 => 160,  230 => 159,  219 => 151,  215 => 150,  206 => 144,  194 => 135,  180 => 126,  172 => 123,  167 => 121,  161 => 118,  157 => 117,  153 => 115,  150 => 114,  71 => 38,  67 => 37,  62 => 36,  59 => 35,  52 => 32,  49 => 31,  43 => 27,  37 => 26,  33 => 22,  31 => 29,  29 => 24,  11 => 22,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__e400028a20c0b85289132a9f733afda6517fb9cb52852128f3b7bab75a4bd4f5", "");
    }
}
