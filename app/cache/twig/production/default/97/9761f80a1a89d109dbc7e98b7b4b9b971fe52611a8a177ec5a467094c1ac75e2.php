<?php

/* __string_template__c3ddcee7e2a9f30d316c11e9d34377177b1daa286d2c0b42dfc7e0e8d4cdd3ee */
class __TwigTemplate_7b81d352bbbc8ea2790195e6c42e89bca2d4d310500cc9c2649be1c9997803e1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("default_frame.twig", "__string_template__c3ddcee7e2a9f30d316c11e9d34377177b1daa286d2c0b42dfc7e0e8d4cdd3ee", 1);
        $this->blocks = array(
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
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_javascript($context, array $blocks = array())
    {
        // line 4
        echo "<script>
\$(function() {

    \$('.delivery').on('change', function() {
        \$('#shopping-form').attr('action', '";
        // line 8
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("shopping_delivery");
        echo "').submit();
        return false;
    });
    \$('.payment').on('change', function() {
        \$('#shopping-form').attr('action', '";
        // line 12
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("shopping_payment");
        echo "').submit();
        return false;
    });

    \$('.btn-shipping').click(function() {
        \$('#shopping-form').attr('action', \$(this).attr('href')).submit();
        \$('#shopping-form').attr('action', '";
        // line 18
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("shopping_confirm");
        echo "');
        return false;
    });

    \$('.btn-shipping-edit').click(function() {
        \$('#shopping-form').attr('action', \$(this).attr('href')).submit();
        \$('#shopping-form').attr('action', '";
        // line 24
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("shopping_confirm");
        echo "');
        return false;
    });

    \$('.btn-shipping-multiple').click(function() {
        \$('#shopping-form').attr('action', \$(this).attr('href')).submit();
        \$('#shopping-form').attr('action', '";
        // line 30
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("shopping_confirm");
        echo "');
        return false;
    });

    ";
        // line 34
        if (($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_USER") == false)) {
            // line 35
            echo "        var ref = [];
        var name = [];
        var input = [];
        var customerin = [];

        \$('#customer').click(function() {
            // ref = \$('.customer-name01');
            var edit = \$('.customer-edit');
            var hidden = \$('.customer-in');

            \$(edit).each(function(index) {
                ref[index] = \$(this);
            });
            \$(hidden).each(function(index) {
                customerin[index] = \$(this);
            });
            \$(ref).each(function(index) {
                name[index] = \$(this).text();
            });
            \$(name).each(function(index) {
                input[index] = \$('<input id=\"edit' + index + '\" type=\"text\" />').val(name[index]);
            });
            \$(input).each(function(index) {
                ref[index].empty().append(input[index]);
            });

            \$('#customer').prop(\"disabled\", true);
            \$('.mod-button').show();
        });

        \$('#customer-ok').click(function() {
            \$(ref).each(function(index) {
                var nameAfter = input[index].val();
                ref[index].empty().text(nameAfter);
                customerin[index].val(nameAfter);
                input[index].remove();
            });

            var postData = {};
            \$('.customer-in').each(function() {
                postData[\$(this).attr('name')] = \$(this).val();
            });
            \$.ajax({
                url: \"";
            // line 78
            echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("shopping_customer");
            echo "\",
                type: 'POST',
                data: postData,
                dataType: 'json',
            }).done(function(){
            }).fail(function(){
                alert('更新に失敗しました。入力内容を確認してください。');
                \$(ref).each(function(index) {
                    ref[index].empty().text(name[index]);
                    input[index].remove();
                });
            });

            \$('#customer').prop(\"disabled\", false);
            \$('.mod-button').hide();
        });

        \$('#customer-cancel').click(function() {
            \$(ref).each(function(index) {
                ref[index].empty().text(name[index]);
                input[index].remove();
            });

            \$('#customer').prop(\"disabled\", false);
            \$('.mod-button').hide();
        });
    ";
        }
        // line 105
        echo "});
</script>
";
    }

    // line 109
    public function block_main($context, array $blocks = array())
    {
        // line 110
        echo "<style>

.product_lf{
display:none;
}

.pt_name {
    color: rgb(86, 57, 36);
line-height:18px;
}
.column p {
    margin:  0;
    line-height: 20px;
padding-bottom:5px;
}
#shopping_confirm .column {
    position: relative;
    font-size: 14px;
}
.column.is-edit > p {
    margin-right: 4em;
    min-height: 40px;
    font-size: 14px;
line-height: 20px;
}
#shopping_confirm .heading02, #shopping_confirm .total_box {
    background: none;
    font-size: 16px;

}
#shopping_confirm  .heading02{margin:0;
padding:0;
}
.page-heading{
margin-bottom:0;
}
#shopping_confirm .heading02, #shopping_confirm .total_box {
    background: none;
    padding: 5px;
    border-top: 1px dotted #ccc;
      margin-bottom: 5px;
}
.pt_name{
    margin: 0 0 8px;
    text-align: left;
    overflow: hidden;
    width: 100%;
    text-overflow: ellipsis;
    white-space: normal;
    padding: 0 10px;
    font-weight: bold;}

</style>
    <h1 class=\"page-heading\">ご注文内容のご確認</h1>
    <div id=\"confirm_wrap\" class=\"container-fluid\">
        <div id=\"confirm_flow_box\" class=\"row\">
            <div id=\"confirm_flow_box__body\" class=\"col-md-12\">
                ";
        // line 167
        if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_USER")) {
            // line 168
            echo "                <div id=\"confirm_flow_box__flow_state\" class=\"flowline step3\">
                ";
        } else {
            // line 170
            echo "                <div id=\"confirm_flow_box__flow_state\" class=\"flowline step4\">
                ";
        }
        // line 172
        echo "                    <ul id=\"confirm_flow_box__flow_state_list\" class=\"clearfix\">
                    <li><span class=\"flow_number\">1</span><br>カートの商品</li>
                    ";
        // line 174
        if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_USER")) {
            // line 175
            echo "                        <li class=\"active\"><span class=\"flow_number\">2</span><br>ご注文内容確認</li>
                        <li><span class=\"flow_number\">3</span><br>完了</li>
                    ";
        } else {
            // line 178
            echo "                        <li><span class=\"flow_number\">2</span><br>お客様情報</li>
                        <li class=\"active\"><span class=\"flow_number\">3</span><br>ご注文内容確認</li>
                        <li><span class=\"flow_number\">4</span><br>完了</li>
                    ";
        }
        // line 182
        echo "                    </ul>
                </div>
                ";
        // line 184
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array()), "flashbag", array()), "get", array(0 => "eccube.front.request.error"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
            // line 185
            echo "                    <div id=\"confirm_flow_box__message\" class=\"message\">
                        <p class=\"errormsg bg-danger\">
                            <svg class=\"cb cb-warning\"><use xlink:href=\"#cb-warning\" /></svg>";
            // line 187
            echo nl2br(twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans($context["error"]), "html", null, true));
            echo "
                        </p>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 191
        echo "            </div><!-- /.col -->
        </div><!-- /.row -->
        <form id=\"shopping-form\" method=\"post\" action=\"";
        // line 193
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("shopping_confirm");
        echo "\">
            ";
        // line 194
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "_token", array()), 'widget');
        echo "
            <div id=\"shopping_confirm\" class=\"row\">
                <div id=\"confirm_main\" class=\"col-sm-8\">
                    <div id=\"cart_box\" class=\"cart_item table\">
                        <div id=\"cart_box_list\" class=\"tbody\">
                        <div style=\"font-size: 16px; font-style: bold; line-height: 30px\"><b>ご注文概要</b>　 <a id=\"confirm_box__quantity_edit_button\" href=\"";
        // line 199
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("cart");
        echo "\" class=\"btn btn-default btn-sm\" style=\"float: right; margin-top: 5px;\">変更</a></div>
                            ";
        // line 200
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "orderDetails", array()));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["orderDetail"]) {
            // line 201
            echo "                            

                            <div id=\"cart_box_list__item_box--";
            // line 203
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "\" class=\"item_box tr\">
                                <div id=\"cart_box_list__item--";
            // line 204
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "\" class=\"td table\">
                                    <div id=\"cart_box_list__photo--";
            // line 205
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "\" class=\"item_photo\"><img src=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "image_save_urlpath", array()), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getNoImageProduct($this->getAttribute($this->getAttribute($context["orderDetail"], "product", array()), "MainListImage", array())), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderDetail"], "productName", array()), "html", null, true);
            echo "\" /></div>
                                    <dl id=\"cart_box_list__detail--";
            // line 206
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "\" class=\"item_detail\">
                                        <dt id=\"cart_box_list__name--";
            // line 207
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "\" class=\"item_name1 pt_name text-default\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["orderDetail"], "productName", array()), "html", null, true);
            echo "</dt>
                                        <dd id=\"cart_box_list__class_category--";
            // line 208
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "\" class=\"item_pattern small\">
                                            ";
            // line 209
            if ($this->getAttribute($this->getAttribute($context["orderDetail"], "productClass", array()), "classCategory1", array())) {
                // line 210
                echo "                                                ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["orderDetail"], "productClass", array()), "classCategory1", array()), "className", array()), "html", null, true);
                echo "：";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["orderDetail"], "productClass", array()), "classCategory1", array()), "html", null, true);
                echo "
                                            ";
            }
            // line 212
            echo "                                            ";
            if ($this->getAttribute($this->getAttribute($context["orderDetail"], "productClass", array()), "classCategory2", array())) {
                // line 213
                echo "                                                <br>";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["orderDetail"], "productClass", array()), "classCategory2", array()), "className", array()), "html", null, true);
                echo "：";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["orderDetail"], "productClass", array()), "classCategory2", array()), "html", null, true);
                echo "
                                            ";
            }
            // line 215
            echo "                                        </dd>
                                        ";
            // line 225
            echo "
<dd>
    ";
            // line 227
            if ($this->getAttribute((isset($context["plgOrderDetails"]) ? $context["plgOrderDetails"] : null), $this->getAttribute($context["orderDetail"], "id", array()), array(), "array", true, true)) {
                // line 228
                echo "        ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["plgOrderDetails"]) ? $context["plgOrderDetails"] : null), $this->getAttribute($context["orderDetail"], "id", array()), array(), "array"));
                $context['loop'] = array(
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                );
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["_key"] => $context["label"]) {
                    // line 229
                    echo "            ";
                    if (($this->getAttribute($context["loop"], "index0", array()) != 0)) {
                        echo "<br />";
                    }
                    echo twig_escape_filter($this->env, $context["label"], "html", null, true);
                    echo "
        ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['label'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 231
                echo "    ";
            }
            // line 232
            echo "</dd><dd id=\"cart_box_list__price--";
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "\" class=\"item_price\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($context["orderDetail"], "priceIncTax", array())), "html", null, true);
            echo " × ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["orderDetail"], "quantity", array())), "html", null, true);
            echo "</dd>

                                        <dd id=\"cart_box_list__subtotal--";
            // line 234
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "\" class=\"item_subtotal\">小計：";
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($context["orderDetail"], "totalPrice", array())), "html", null, true);
            echo "</dd>
                                    </dl>

                                </div>
                            </div><!--/item_box-->

                            ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['orderDetail'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 241
        echo "                        </div>
                    </div><!--/cart_item-->
                   
                    <!--<h2 class=\"heading02\">お客様情報</h2>-->
                     ";
        // line 245
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "shippings", array()));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["shipping"]) {
            // line 246
            echo "                        ";
            $context["idx"] = $this->getAttribute($context["loop"], "index0", array());
            // line 247
            echo "                     <h3>お届け先";
            if ($this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "multiple", array())) {
                echo "(";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                echo ")";
            }
            // line 248
            echo "                             ";
            if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_USER")) {
                // line 249
                echo "                            <div id=\"shopping_confirm_box__edit_button--";
                echo twig_escape_filter($this->env, (isset($context["idx"]) ? $context["idx"] : null), "html", null, true);
                echo "\" class=\"btn_edit\" style=\"float: right;margin-top: -8px;\"><a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("shopping_shipping_change", array("id" => $this->getAttribute($context["shipping"], "id", array()))), "html", null, true);
                echo "\" class=\"btn btn-default btn-sm btn-shipping\" style=\"float: right;\">変更</a></div>
                            ";
            } else {
                // line 251
                echo "                            <p id=\"shopping_confirm_box__edit_button--";
                echo twig_escape_filter($this->env, (isset($context["idx"]) ? $context["idx"] : null), "html", null, true);
                echo "\" class=\"btn_edit\"><a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("shopping_shipping_edit_change", array("id" => $this->getAttribute($context["shipping"], "id", array()))), "html", null, true);
                echo "\" class=\"btn btn-default btn-sm btn-shipping-edit\">変更</a></p>
                            ";
            }
            // line 253
            echo "                            </h3>
                              ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['shipping'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 255
        echo "                    <div id=\"customer_detail_box\" class=\"column is-edit\">
                        <p id=\"customer_detail_box__customer_address\" class=\"address\"><span class=\"customer-edit customer-name01\">";
        // line 256
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "name01", array()), "html", null, true);
        echo "</span> <span class=\"customer-edit customer-name02\">";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "name02", array()), "html", null, true);
        echo "</span> 様<br>
                        〒<span class=\"customer-edit customer-zip01\">";
        // line 257
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "zip01", array()), "html", null, true);
        echo "</span>-<span class=\"customer-edit customer-zip02\">";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "zip02", array()), "html", null, true);
        echo "</span> <span class=\"customer-edit customer-pref\">";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "pref", array()), "html", null, true);
        echo "</span><span class=\"customer-edit customer-addr01\">";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "addr01", array()), "html", null, true);
        echo "</span><span class=\"customer-edit customer-addr02\">";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "addr02", array()), "html", null, true);
        echo "</span><br>
                        <span class=\"customer-edit customer-tel01\">";
        // line 258
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "tel01", array()), "html", null, true);
        echo "</span>-<span class=\"customer-edit customer-tel02\">";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "tel02", array()), "html", null, true);
        echo "</span>-<span class=\"customer-edit customer-tel03\">";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "tel03", array()), "html", null, true);
        echo "</span></p>
                        ";
        // line 259
        if (($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_USER") == false)) {
            // line 260
            echo "                            <div class=\"customer-edit customer-email\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "email", array()), "html", null, true);
            echo "</div>
                            <div class=\"customer-edit customer-company_name\">";
            // line 261
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "companyName", array()), "html", null, true);
            echo "</div>
                            <div class=\"mod-button\" style=\"display:none;\">
                                <span id=\"customer-ok\"><button type=\"button\" class=\"btn btn-default btn-sm\">OK</button></span>
                                <span id=\"customer-cancel\"><button type=\"button\" class=\"btn btn-default btn-sm\">キャンセル</button></span>
                            </div>
                            <p class=\"btn_edit\"><button type=\"button\" id=\"customer\" class=\"btn btn-default btn-sm\">変更</button></p>
                            <input type=\"hidden\" id=\"customer-name01\" class=\"customer-in\" name=\"customer_name01\" value=\"";
            // line 267
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "name01", array()), "html", null, true);
            echo "\">
                            <input type=\"hidden\" id=\"customer-name02\" class=\"customer-in\" name=\"customer_name02\" value=\"";
            // line 268
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "name02", array()), "html", null, true);
            echo "\">
                            <input type=\"hidden\" id=\"customer-zip01\" class=\"customer-in\" name=\"customer_zip01\" value=\"";
            // line 269
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "zip01", array()), "html", null, true);
            echo "\">
                            <input type=\"hidden\" id=\"customer-zip02\" class=\"customer-in\" name=\"customer_zip02\" value=\"";
            // line 270
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "zip02", array()), "html", null, true);
            echo "\">
                            <input type=\"hidden\" id=\"customer-pref\" class=\"customer-in\" name=\"customer_pref\" value=\"";
            // line 271
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "pref", array()), "html", null, true);
            echo "\">
                            <input type=\"hidden\" id=\"customer-addr01\" class=\"customer-in\" name=\"customer_addr01\" value=\"";
            // line 272
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "addr01", array()), "html", null, true);
            echo "\">
                            <input type=\"hidden\" id=\"customer-addr02\" class=\"customer-in\" name=\"customer_addr02\" value=\"";
            // line 273
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "addr02", array()), "html", null, true);
            echo "\">
                            <input type=\"hidden\" id=\"customer-tel01\" class=\"customer-in\" name=\"customer_tel01\" value=\"";
            // line 274
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "tel01", array()), "html", null, true);
            echo "\">
                            <input type=\"hidden\" id=\"customer-tel02\" class=\"customer-in\" name=\"customer_tel02\" value=\"";
            // line 275
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "tel02", array()), "html", null, true);
            echo "\">
                            <input type=\"hidden\" id=\"customer-tel03\" class=\"customer-in\" name=\"customer_tel03\" value=\"";
            // line 276
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "tel03", array()), "html", null, true);
            echo "\">
                            <input type=\"hidden\" id=\"customer-email\" class=\"customer-in\" name=\"customer_email\" value=\"";
            // line 277
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "email", array()), "html", null, true);
            echo "\">
                            <input type=\"hidden\" id=\"customer-company-name\" class=\"customer-in\" name=\"customer_company_name\" value=\"";
            // line 278
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "companyName", array()), "html", null, true);
            echo "\">
                        ";
        }
        // line 280
        echo "                    </div>

                    <!--<h2 class=\"heading02\">配送情報</h2>-->
                    ";
        // line 283
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "shippings", array()));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["shipping"]) {
            // line 284
            echo "                        ";
            $context["idx"] = $this->getAttribute($context["loop"], "index0", array());
            // line 285
            echo "                        <div id=\"shipping_confirm_box--";
            echo twig_escape_filter($this->env, (isset($context["idx"]) ? $context["idx"] : null), "html", null, true);
            echo "\" class=\"column is-edit\">

                            <div id=\"shipping_confirm_box__body--";
            // line 287
            echo twig_escape_filter($this->env, (isset($context["idx"]) ? $context["idx"] : null), "html", null, true);
            echo "\" class=\"cart_item table\">
                               
                            </div>

                            <div id=\"shopping_confirm_box__shipping_delivery--";
            // line 291
            echo twig_escape_filter($this->env, (isset($context["idx"]) ? $context["idx"] : null), "html", null, true);
            echo "\" class=\"form-inline form-group\">
                                <label>配送方法</label>
                                ";
            // line 293
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "shippings", array()), (isset($context["idx"]) ? $context["idx"] : null), array(), "array"), "delivery", array()), 'widget', array("attr" => array("class" => "delivery")));
            echo "
                                ";
            // line 294
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "shippings", array()), (isset($context["idx"]) ? $context["idx"] : null), array(), "array"), "delivery", array()), 'errors');
            echo "
                            </div>

                            <!--<div id=\"shopping_confirm_box__shipping_delivery_date_time--";
            // line 297
            echo twig_escape_filter($this->env, (isset($context["idx"]) ? $context["idx"] : null), "html", null, true);
            echo "\" class=\"form-inline form-group\">
                                <label>お届け日</label>
                                ";
            // line 299
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "shippings", array()), (isset($context["idx"]) ? $context["idx"] : null), array(), "array"), "shippingDeliveryDate", array()), 'widget');
            echo "<br class=\"sp\">
                                <label>お届け時間</label>
                                ";
            // line 301
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "shippings", array()), (isset($context["idx"]) ? $context["idx"] : null), array(), "array"), "deliveryTime", array()), 'widget');
            echo "
                            </div>-->
                           
                        </div>
                        ";
            // line 305
            if (($this->getAttribute($context["loop"], "last", array()) == false)) {
                echo "<hr>";
            }
            // line 306
            echo "                    ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['shipping'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 307
        echo "                    ";
        if ($this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "optionMultipleShipping", array())) {
            // line 308
            echo "                        <hr>
                        <div><a id=\"shopping_confirm_box__button_edit_multiple\"  href=\"";
            // line 309
            echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("shopping_shipping_multiple_change");
            echo "\" class=\"btn btn-default btn-sm btn-shipping-multiple\">お届け先を追加する</a></div>
                    ";
        }
        // line 311
        echo "               
                    <h2 class=\"heading02\">お支払方法</h2>
                    <div id=\"payment_list\" class=\"column\">
                        <div id=\"payment_list__body\" class=\"form-group\">
                            <ul id=\"payment_list__list\" class=\"payment_list\">
                            ";
        // line 316
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "payment", array()));
        foreach ($context['_seq'] as $context["key"] => $context["child"]) {
            // line 317
            echo "                            <li>
                                ";
            // line 318
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["child"], 'widget', array("attr" => array("class" => "payment")));
            echo "
                                ";
            // line 319
            if ( !(null === $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "payment", array()), "vars", array()), "choices", array()), $context["key"], array(), "array"), "data", array()), "payment_image", array()))) {
                // line 320
                echo "                                <img src=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "image_save_urlpath", array()), "html", null, true);
                echo "/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "payment", array()), "vars", array()), "choices", array()), $context["key"], array(), "array"), "data", array()), "payment_image", array()), "html", null, true);
                echo "\">
                                ";
            }
            // line 322
            echo "                            </li>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 324
        echo "                            ";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "payment", array()), 'errors');
        echo "
                            </ul>
                        </div>
                    </div>
                    <h2 class=\"heading02\">お問い合わせ欄</h2>
                    <!--<h2>備考欄</h2>-->
                    <span style=\"line-height: 16px;\">ご注意：サイズ指定をご注意下場合は、[性別：][身長：][肩幅：][バスト：][ウエスト：][ヒップ]のヌードサイズ下記の備考欄にご記入してください</span>
                    <div id=\"contact_message\" class=\"column\">
                        ";
        // line 332
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "message", array()), 'widget', array("attr" => array("placeholder" => "お問い合わせ事項がございましたら、こちらにご入力ください。(3000文字まで)", "rows" => "6")));
        echo "
                        ";
        // line 333
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "message", array()), 'errors');
        echo "
                    </div>
                    <div class=\"extra-form column\">
                        ";
        // line 336
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "getIterator", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
            // line 337
            echo "                            ";
            if (preg_match("[^plg*]", $this->getAttribute($this->getAttribute($context["f"], "vars", array()), "name", array()))) {
                // line 338
                echo "                                ";
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'row');
                echo "
                            ";
            }
            // line 340
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['f'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 341
        echo "                    </div>
                </div><!-- /.col -->

                <div id=\"confirm_side\" class=\"col-sm-4\">
                    <div id=\"summary_box__total_box\" class=\"total_box\">
                        <dl id=\"summary_box__subtotal\">
                            <dt>小計</dt>
                            <dd class=\"text-primary\">";
        // line 348
        echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "subtotal", array())), "html", null, true);
        echo "</dd>
                        </dl>
                        <dl id=\"summary_box__quantity_price\">
                            <dt>手数料</dt>
                            <dd>";
        // line 352
        echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "charge", array())), "html", null, true);
        echo "</dd>
                        </dl>
                        <dl id=\"summary_box__shipping_price\">

                            <dt>送料</dt>

                            <dd>￥<span id=\"tiengui\">";
        // line 358
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "deliveryFeeTotal", array()), "html", null, true);
        echo "</span></dd>
                        </dl>
                        ";
        // line 360
        if (($this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "discount", array()) > 0)) {
            // line 361
            echo "                        <dl id=\"summary_box__discount_price\">
                            <dt>値引き</dt>
                            <dd>";
            // line 363
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter((0 - $this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "discount", array()))), "html", null, true);
            echo "</dd>
                        </dl>
                        ";
        }
        // line 366
        echo "                        <div id=\"summary_box__result\" class=\"total_amount\">
                            <p id=\"summary_box__total_amount\" class=\"total_price\">合計 <strong class=\"text-primary\">";
        // line 367
        echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute((isset($context["Order"]) ? $context["Order"] : null), "total", array())), "html", null, true);
        echo "<span class=\"small\">税込</span></strong></p>
                            <p id=\"summary_box__confirm_button\"><button id=\"order-button\" type=\"submit\" class=\"btn btn-primary btn-block prevention-btn prevention-mask\">注文する</button></p>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </form>
    </div>
";
    }

    public function getTemplateName()
    {
        return "__string_template__c3ddcee7e2a9f30d316c11e9d34377177b1daa286d2c0b42dfc7e0e8d4cdd3ee";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  831 => 367,  828 => 366,  822 => 363,  818 => 361,  816 => 360,  811 => 358,  802 => 352,  795 => 348,  786 => 341,  780 => 340,  774 => 338,  771 => 337,  767 => 336,  761 => 333,  757 => 332,  745 => 324,  738 => 322,  730 => 320,  728 => 319,  724 => 318,  721 => 317,  717 => 316,  710 => 311,  705 => 309,  702 => 308,  699 => 307,  685 => 306,  681 => 305,  674 => 301,  669 => 299,  664 => 297,  658 => 294,  654 => 293,  649 => 291,  642 => 287,  636 => 285,  633 => 284,  616 => 283,  611 => 280,  606 => 278,  602 => 277,  598 => 276,  594 => 275,  590 => 274,  586 => 273,  582 => 272,  578 => 271,  574 => 270,  570 => 269,  566 => 268,  562 => 267,  553 => 261,  548 => 260,  546 => 259,  538 => 258,  526 => 257,  520 => 256,  517 => 255,  502 => 253,  494 => 251,  486 => 249,  483 => 248,  476 => 247,  473 => 246,  456 => 245,  450 => 241,  427 => 234,  417 => 232,  414 => 231,  394 => 229,  376 => 228,  374 => 227,  370 => 225,  367 => 215,  359 => 213,  356 => 212,  348 => 210,  346 => 209,  342 => 208,  336 => 207,  332 => 206,  322 => 205,  318 => 204,  314 => 203,  310 => 201,  293 => 200,  289 => 199,  281 => 194,  277 => 193,  273 => 191,  263 => 187,  259 => 185,  255 => 184,  251 => 182,  245 => 178,  240 => 175,  238 => 174,  234 => 172,  230 => 170,  226 => 168,  224 => 167,  165 => 110,  162 => 109,  156 => 105,  126 => 78,  81 => 35,  79 => 34,  72 => 30,  63 => 24,  54 => 18,  45 => 12,  38 => 8,  32 => 4,  29 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__c3ddcee7e2a9f30d316c11e9d34377177b1daa286d2c0b42dfc7e0e8d4cdd3ee", "");
    }
}
