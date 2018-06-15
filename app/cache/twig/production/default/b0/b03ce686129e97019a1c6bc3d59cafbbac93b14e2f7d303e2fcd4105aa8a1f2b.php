<?php

/* __string_template__38c32c95fd2f1afe4c8603ca4547f542acb213842075181d611cb4429c887599 */
class __TwigTemplate_2e885d82d3e1d044589ad70e0c94396b44c8699673f44990c1d0295f27b53c7e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("default_frame.twig", "__string_template__38c32c95fd2f1afe4c8603ca4547f542acb213842075181d611cb4429c887599", 1);
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
        // line 3
        $context["body_class"] = "product_page";
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_javascript($context, array $blocks = array())
    {
        // line 6
        echo "    <script>
        // 並び順を変更
        function fnChangeOrderBy(orderby) {
            eccube.setValue('orderby', orderby);
            eccube.setValue('pageno', 1);
            eccube.submitForm();
        }

        // 表示件数を変更
        function fnChangeDispNumber(dispNumber) {
            eccube.setValue('disp_number', dispNumber);
            eccube.setValue('pageno', 1);
            eccube.submitForm();
        }
        // 商品表示BOXの高さを揃える
        \$(window).load(function() {
            \$('.product_item').matchHeight();
        });
    </script>
";
    }

    // line 27
    public function block_main($context, array $blocks = array())
    {
        // line 28
        echo "    <form name=\"form1\" id=\"form1\" method=\"get\" action=\"?\">
        ";
        // line 29
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock((isset($context["search_form"]) ? $context["search_form"] : null), 'widget');
        echo "
    </form>
    <!-- ▼topicpath▼ -->
<style>
.product_lf{
display:none;
}
#topicpath li a {
    color: #593c28;
}
#h-list{
padding-bottom:0;
}
.pagination ul li.active a:hover, .pagination ul li.active a:focus {
opacity:0.8;
background-color: #6c402c;
}
.pagination {
    width: 100%;
    margin: 0;
    height: 43px;
    border-bottom: 1px solid #afadad;
    padding-bottom: 5px;
    margin-bottom: 5px;
}
.pagination ul {
    padding: 5px 0;
    float: right;
}
.pagination ul li a {
    padding: 4px 1em;
  border: 1px solid #888b90;
} 
.pagination ul li.active a {
    cursor: default;
    text-decoration: none;
color: #fff;
   background-color: #6c402c;
}
#topicpath {
    padding: 0px 16px;
    border: 0 none;
}
.product_page .product_item {
    padding-bottom: 5px;
}
.form-control {
    height: 25px;
    padding: 0 8px;
font-size:13px;
}
.product_page .product_item a {
    padding-bottom: 0;
}
.item_gallery {
    clear: both;
}
 .product_item {
/* box-shadow */
box-shadow:0px 0px 6px 3px #5bd7c8;
-moz-box-shadow:0px 0px 6px 3px #5bd7c8;
 -webkit-box-shadow: 1px 1px 6px 2px rgb(195, 183, 183);
margin-bottom:20px;
padding-bottom:0px;
height:auto;

/* border-radius */
border-radius:6px;
-moz-border-radius:6px;
-webkit-border-radius:6px;
/* border */
}
.item_photo {
    padding: 0 10px;
}
.item_name {
    color: #525263;
    margin: 0 0 8px;
    text-align: center;
    overflow: hidden;
    width: 100%;
    text-overflow: ellipsis;
    white-space: nowrap;
padding: 0 10px;
font-weight: bold;
}
.item_price {
    color: #525263;
    font-weight: bold;
    text-align: center;
    color: #e60d0d;
}

.intro {
    margin: 0;
    padding-top: 0.5em;
    padding-bottom: 10px;
}
</style>

<div id=\"h-list\" class=\"row\"> 
    <div id=\"topicpath\" class=\"\">
        <ol id=\"list_header_menu\">
            <li><a href=\"";
        // line 132
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("product_list");
        echo "\">全商品</a></li>
            ";
        // line 133
        if ( !(null === (isset($context["Category"]) ? $context["Category"] : null))) {
            // line 134
            echo "                ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["Category"]) ? $context["Category"] : null), "path", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["Path"]) {
                // line 135
                echo "                    <li><a href=\"";
                echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("product_list");
                echo "?category_id=";
                echo twig_escape_filter($this->env, $this->getAttribute($context["Path"], "id", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["Path"], "name", array()), "html", null, true);
                echo "</a></li>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Path'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 137
            echo "            ";
        }
        // line 138
        echo "            ";
        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["search_form"]) ? $context["search_form"] : null), "vars", array()), "value", array()), "name", array())) {
            // line 139
            echo "            <li>「";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["search_form"]) ? $context["search_form"] : null), "vars", array()), "value", array()), "name", array()), "html", null, true);
            echo "」の検索結果</li>
            ";
        }
        // line 141
        echo "        </ol>
    </div>
    <!-- ▲topicpath▲ -->
    ";
        // line 154
        echo "<div class=\"row no-margin\">
    ";
        // line 155
        echo $this->getAttribute((isset($context["PluginCategoryContent"]) ? $context["PluginCategoryContent"] : null), "content", array());
        echo "
</div>
<div id=\"result_info_box\" class=\"\">
        <form name=\"page_navi_top\" id=\"page_navi_top\" action=\"?\">
            <p id=\"result_info_box__item_count\" class=\"intro col-sm-6\"><strong><span id=\"productscount\">";
        // line 159
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "totalItemCount", array()), "html", null, true);
        echo "</span>件</strong>の商品がみつかりました。
            </p>

            <div id=\"result_info_box__menu_box\" class=\"col-sm-6 no-padding\">
                <ul id=\"result_info_box__menu\" class=\"pagenumberarea clearfix\">
                    <li id=\"result_info_box__disp_menu\">
                        ";
        // line 165
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock((isset($context["disp_number_form"]) ? $context["disp_number_form"] : null), 'widget', array("id" => "", "attr" => array("onchange" => "javascript:fnChangeDispNumber(this.value);")));
        echo "
                    </li>
                    <li id=\"result_info_box__order_menu\">
                        ";
        // line 168
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock((isset($context["order_by_form"]) ? $context["order_by_form"] : null), 'widget', array("id" => "", "attr" => array("onchange" => "javascript:fnChangeOrderBy(this.value);")));
        echo "
                    </li>
                </ul>
            </div>

            ";
        // line 173
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["disp_number_form"]) ? $context["disp_number_form"] : null), "getIterator", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
            // line 174
            echo "                ";
            if (preg_match("[^plg*]", $this->getAttribute($this->getAttribute($context["f"], "vars", array()), "name", array()))) {
                // line 175
                echo "                    ";
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'label');
                echo "
                    ";
                // line 176
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'widget');
                echo "
                    ";
                // line 177
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'errors');
                echo "
                ";
            }
            // line 179
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['f'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 180
        echo "
            ";
        // line 181
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["order_by_form"]) ? $context["order_by_form"] : null), "getIterator", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
            // line 182
            echo "                ";
            if (preg_match("[^plg*]", $this->getAttribute($this->getAttribute($context["f"], "vars", array()), "name", array()))) {
                // line 183
                echo "                    ";
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'label');
                echo "
                    ";
                // line 184
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'widget');
                echo "
                    ";
                // line 185
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'errors');
                echo "
                ";
            }
            // line 187
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['f'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 188
        echo "        </form>
    </div>
    <!-- ▼item_list▼ -->
    <div id=\"item_list\">
        <div class=\"col-sm-12 no-padding\">
            ";
        // line 193
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["pagination"]) ? $context["pagination"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["Product"]) {
            // line 194
            echo "                <div id=\"result_list_box--";
            echo twig_escape_filter($this->env, $this->getAttribute($context["Product"], "id", array()), "html", null, true);
            echo "\" class=\"col-sm-3 col-xs-6\">
                    <div id=\"result_list__item--";
            // line 195
            echo twig_escape_filter($this->env, $this->getAttribute($context["Product"], "id", array()), "html", null, true);
            echo "\" class=\"product_item\">
                        <a href=\"";
            // line 196
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("product_detail", array("id" => $this->getAttribute($context["Product"], "id", array()))), "html", null, true);
            echo "\">
                            <div id=\"result_list__image--";
            // line 197
            echo twig_escape_filter($this->env, $this->getAttribute($context["Product"], "id", array()), "html", null, true);
            echo "\" class=\"item_photo\">
                                <img src=\"";
            // line 198
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "image_save_urlpath", array()), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getNoImageProduct($this->getAttribute($context["Product"], "main_list_image", array())), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["Product"], "name", array()), "html", null, true);
            echo "\">
                            </div>
                            <dl id=\"result_list__detail--";
            // line 200
            echo twig_escape_filter($this->env, $this->getAttribute($context["Product"], "id", array()), "html", null, true);
            echo "\">
                               <!-- <dt id=\"result_list__name--";
            // line 201
            echo twig_escape_filter($this->env, $this->getAttribute($context["Product"], "id", array()), "html", null, true);
            echo "\" class=\"item_name\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["Product"], "name", array()), "html", null, true);
            echo "</dt>-->
                              <h4 class=\"h-name\">
                              <script>
                              <!--
                              var x = \"";
            // line 205
            echo twig_escape_filter($this->env, $this->getAttribute($context["Product"], "name", array()), "html", null, true);
            echo "\";
                              document.write(x.slice(0,18)); //-->
                              </script>
                              </h4>
                                ";
            // line 209
            if ($this->getAttribute($context["Product"], "description_list", array())) {
                // line 210
                echo "                                    <dd id=\"result_list__description_list--";
                echo twig_escape_filter($this->env, $this->getAttribute($context["Product"], "id", array()), "html", null, true);
                echo "\" class=\"item_comment\">";
                echo nl2br($this->getAttribute($context["Product"], "description_list", array()));
                echo "</dd>
                                ";
            }
            // line 212
            echo "                                ";
            if ($this->getAttribute($context["Product"], "hasProductClass", array())) {
                // line 213
                echo "                                    ";
                if (($this->getAttribute($context["Product"], "getPrice02Min", array()) == $this->getAttribute($context["Product"], "getPrice02Max", array()))) {
                    // line 214
                    echo "                                    <dd id=\"result_list__price02_inc_tax--";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["Product"], "id", array()), "html", null, true);
                    echo "\" class=\"item_price\">
                                      ";
                    // line 215
                    echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($context["Product"], "getPrice02IncTaxMin", array())), "html", null, true);
                    echo "
                                    </dd>
                                    ";
                } else {
                    // line 218
                    echo "                                    <dd id=\"result_list__price02_inc_tax--";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["Product"], "id", array()), "html", null, true);
                    echo "\" class=\"item_price\">
                                            ";
                    // line 219
                    echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($context["Product"], "getPrice02IncTaxMin", array())), "html", null, true);
                    echo " ～ ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($context["Product"], "getPrice02IncTaxMax", array())), "html", null, true);
                    echo "
                                    </dd>
                                    ";
                }
                // line 222
                echo "                                ";
            } else {
                // line 223
                echo "                                    <dd id=\"result_list__price02_inc_tax--";
                echo twig_escape_filter($this->env, $this->getAttribute($context["Product"], "id", array()), "html", null, true);
                echo "\" class=\"item_price\">
 ";
                // line 224
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($context["Product"], "getPrice02IncTaxMin", array())), "html", null, true);
                echo "</dd>
                                ";
            }
            // line 226
            echo "                            </dl>
                        </a>
                    </div>
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Product'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 231
        echo "        </div>
</div>
    </div>
    <!-- ▲item_list▲ -->
    ";
        // line 235
        if (($this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "totalItemCount", array()) > 0)) {
            // line 236
            echo "
        ";
            // line 237
            $this->loadTemplate("pagination.twig", "__string_template__38c32c95fd2f1afe4c8603ca4547f542acb213842075181d611cb4429c887599", 237)->display(array_merge($context, array("pages" => $this->getAttribute((isset($context["pagination"]) ? $context["pagination"] : null), "paginationData", array()))));
            // line 238
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "__string_template__38c32c95fd2f1afe4c8603ca4547f542acb213842075181d611cb4429c887599";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  434 => 238,  432 => 237,  429 => 236,  427 => 235,  421 => 231,  411 => 226,  406 => 224,  401 => 223,  398 => 222,  390 => 219,  385 => 218,  379 => 215,  374 => 214,  371 => 213,  368 => 212,  360 => 210,  358 => 209,  351 => 205,  342 => 201,  338 => 200,  329 => 198,  325 => 197,  321 => 196,  317 => 195,  312 => 194,  308 => 193,  301 => 188,  295 => 187,  290 => 185,  286 => 184,  281 => 183,  278 => 182,  274 => 181,  271 => 180,  265 => 179,  260 => 177,  256 => 176,  251 => 175,  248 => 174,  244 => 173,  236 => 168,  230 => 165,  221 => 159,  214 => 155,  211 => 154,  206 => 141,  200 => 139,  197 => 138,  194 => 137,  181 => 135,  176 => 134,  174 => 133,  170 => 132,  64 => 29,  61 => 28,  58 => 27,  35 => 6,  32 => 5,  28 => 1,  26 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__38c32c95fd2f1afe4c8603ca4547f542acb213842075181d611cb4429c887599", "");
    }
}
