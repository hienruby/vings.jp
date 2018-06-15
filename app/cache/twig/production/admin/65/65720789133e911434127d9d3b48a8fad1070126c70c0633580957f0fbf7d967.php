<?php

/* ProductOption/Resource/template/admin/Product/product_option.twig */
class __TwigTemplate_247ae675ac2f43b1a958e49fe261ad3328b17f5953d3f8ba0a99d839a338a01d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 11
        $this->parent = $this->loadTemplate("default_frame.twig", "ProductOption/Resource/template/admin/Product/product_option.twig", 11);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'sub_title' => array($this, 'block_sub_title'),
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
        // line 13
        $context["menus"] = array(0 => "product", 1 => "product_master");
        // line 18
        $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->setTheme((isset($context["optionForm"]) ? $context["optionForm"] : null), array(0 => "Form/bootstrap_3_horizontal_layout.html.twig"));
        // line 11
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 15
    public function block_title($context, array $blocks = array())
    {
        echo "商品管理";
    }

    // line 16
    public function block_sub_title($context, array $blocks = array())
    {
        echo "商品登録(オプション)";
    }

    // line 20
    public function block_javascript($context, array $blocks = array())
    {
        // line 21
        echo "    <script>
        \$(function () {
            // 登録チェックボックス
            \$('#add-all').click(function () {
                var addall = \$('#add-all').prop('checked');
                if (addall) {
                    \$('input[id\$=_add]').prop('checked', true);
                } else {
                    \$('input[id\$=_add]').prop('checked', false);
                }
            });
        });
    </script>
";
    }

    // line 37
    public function block_main($context, array $blocks = array())
    {
        // line 38
        echo "    <div class=\"row\">
        <div class=\"col-md-12\">
            <div class=\"box\">
                <div class=\"box-header\">
                    商品名 : <h3 class=\"box-title\">";
        // line 42
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "name", array()), "html", null, true);
        echo "</h3>
                </div><!-- /.box-header -->
                <div class=\"box-body\" style=\"padding-bottom: 30px;\">
                    <div>

                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->
    </div>


    ";
        // line 55
        if ( !(null === (isset($context["Options"]) ? $context["Options"] : null))) {
            // line 56
            echo "        <form id=\"product-class-form\" class=\"form-inline\" method=\"post\" action=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("admin_product_product_option_edit", array("id" => $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "id", array()))), "html", null, true);
            echo "\">
            ";
            // line 57
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["optionForm"]) ? $context["optionForm"] : null), "_token", array()), 'widget');
            echo "
            <div class=\"row\">
                <div class=\"col-md-12\">
                    <div class=\"box\">
                        ";
            // line 61
            if ((twig_length_filter($this->env, (isset($context["Options"]) ? $context["Options"] : null)) > 0)) {
                // line 62
                echo "                            <div class=\"box-header\">

                            </div><!-- /.box-header -->
                            <div class=\"box-body no-padding\">
                                <div class=\"table_list\">
                                    <div class=\"table-responsive with-border table-menu\">
                                        <table class=\"table table-striped\">
                                            <thead>
                                                <tr>
                                                    <th class=\"text-center\">登録<input id=\"add-all\" type=\"checkbox\" value=\"0\"></th>
                                                    <th>オプション管理名</th>
                                                    <th>オプション表示名</th>
                                                    <th>タイプ</th>
                                                    <th>説明画面</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                ";
                // line 79
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["optionForm"]) ? $context["optionForm"] : null), "product_options", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["productOption"]) {
                    // line 80
                    echo "                                                    ";
                    echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($context["productOption"], "option_id", array()), 'widget');
                    echo "
                                                    <tr>
                                                        <td class=\"text-center\">
                                                            ";
                    // line 83
                    echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($context["productOption"], "add", array()), 'widget');
                    echo "
                                                        </td>
                                                        <td>
                                                            ";
                    // line 86
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["productOption"], "vars", array()), "value", array()), "Option", array()), "manage_name", array()), "html", null, true);
                    echo "
                                                        </td>
                                                        <td>
                                                            ";
                    // line 89
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["productOption"], "vars", array()), "value", array()), "Option", array()), "name", array()), "html", null, true);
                    echo "
                                                        </td>
                                                        <td>
                                                            ";
                    // line 92
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["productOption"], "vars", array()), "value", array()), "Option", array()), "type", array()), "html", null, true);
                    echo "
                                                        </td>
                                                        <td>
                                                            ";
                    // line 95
                    if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["productOption"], "vars", array()), "value", array()), "Option", array()), "description_flg", array()) == 1)) {
                        echo "○";
                    }
                    // line 96
                    echo "                                                        </td>
                                                    </tr>
                                                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['productOption'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 99
                echo "                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- /.box-body --> 
                        ";
            } else {
                // line 105
                echo "                            <div class=\"box-header\">
                                <h3 class=\"box-title\">検索条件に該当するデータがありませんでした。</h3>
                            </div><!-- /.box-header -->
                        ";
            }
            // line 109
            echo "                    </div><!-- /.box --> 
                </div><!-- /.col --> 
            </div>

            ";
            // line 113
            if ((twig_length_filter($this->env, (isset($context["Options"]) ? $context["Options"] : null)) > 0)) {
                // line 114
                echo "                <div class=\"row\">
                    <div class=\"col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 text-center btn_area\">

                        <button type=\"submit\" class=\"btn btn-primary btn-lg btn-block\" name=\"mode\" value=\"edit\">登録</button>
                        <p style=\"margin-top: 10px;\">
                            <a href=\"";
                // line 119
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("admin_product_product_option_rank", array("id" => $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "id", array()))), "html", null, true);
                echo "\" class=\"btn btn-info btn-block btn-lg\">並び替え</a><br />
                            <a href=\"";
                // line 120
                echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("admin_product");
                echo "\">商品マスターページに戻る</a>
                        </p>
                    </div>
                </div>
            </form>
        ";
            }
            // line 126
            echo "
    ";
        }
        // line 128
        echo "
";
    }

    public function getTemplateName()
    {
        return "ProductOption/Resource/template/admin/Product/product_option.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  221 => 128,  217 => 126,  208 => 120,  204 => 119,  197 => 114,  195 => 113,  189 => 109,  183 => 105,  175 => 99,  167 => 96,  163 => 95,  157 => 92,  151 => 89,  145 => 86,  139 => 83,  132 => 80,  128 => 79,  109 => 62,  107 => 61,  100 => 57,  95 => 56,  93 => 55,  77 => 42,  71 => 38,  68 => 37,  51 => 21,  48 => 20,  42 => 16,  36 => 15,  32 => 11,  30 => 18,  28 => 13,  11 => 11,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "ProductOption/Resource/template/admin/Product/product_option.twig", "/home/kir021669/public_html/vings.jp/app/Plugin/ProductOption/Resource/template/admin/Product/product_option.twig");
    }
}
