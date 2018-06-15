<?php

/* ProductOption/Resource/template/admin/Product/product_option_rank.twig */
class __TwigTemplate_bba52d35a89e1783ee241c43646f76daf5fd9289c011070aa7e91154d77421ac extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 11
        $this->parent = $this->loadTemplate("default_frame.twig", "ProductOption/Resource/template/admin/Product/product_option_rank.twig", 11);
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
        $context["menus"] = array(0 => "product", 1 => "product_option_rank");
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
        echo "オプション並び替え";
    }

    // line 18
    public function block_javascript($context, array $blocks = array())
    {
        // line 19
        echo "    <script src=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "admin_urlpath", array()), "html", null, true);
        echo "/assets/js/vendor/jquery.ui/jquery.ui.core.min.js\"></script>
    <script src=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "admin_urlpath", array()), "html", null, true);
        echo "/assets/js/vendor/jquery.ui/jquery.ui.widget.min.js\"></script>
    <script src=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "admin_urlpath", array()), "html", null, true);
        echo "/assets/js/vendor/jquery.ui/jquery.ui.mouse.min.js\"></script>
    <script src=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "admin_urlpath", array()), "html", null, true);
        echo "/assets/js/vendor/jquery.ui/jquery.ui.sortable.min.js\"></script>
    <script>

        \$(function () {
            var oldRanks = [];
            // 画面の中のrank一覧を保持
            \$(\"div.tableish > .item_box\").each(function () {
                oldRanks.push(this.dataset.rank);
            });

            \$(\"div.tableish\").sortable({
                items: '> .item_box',
                cursor: 'move',
                update: function (e, ui) {
                    \$(\"body\").append(\$('<div class=\"modal-backdrop in\"></div>'));
                    updateRank();
                }
            });

            var updateRank = function () {
                // 並び替え後にrankを更新
                var newRanks = {};
                var i = 0;
                \$(\"div.tableish > .item_box\").each(function () {
                    newRanks[this.dataset.optionId] = oldRanks[i];
                    i++;
                });

                \$.ajax({
                url: '";
        // line 51
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("admin_product_product_option_rank_move");
        echo "',
                    type: 'POST',
                    data: newRanks,
                }).done(function (data) {
                    console.log(data);
                    \$(\".modal-backdrop\").remove();
                }).fail(function () {
                    console.log('fail');
                    \$(\".modal-backdrop\").remove();
                });
            };
        });

    </script>
";
    }

    // line 67
    public function block_main($context, array $blocks = array())
    {
        // line 68
        echo "<form role=\"form\" name=\"form1\" id=\"form1\" method=\"post\" action=\"\" novalidate>

    <div class=\"row\" id=\"aside_wrap\">
        <div class=\"col-md-9\">
            <div class=\"box form-horizontal\">
                <div class=\"box-header\">
                    <h3 class=\"box-title\">商品名：";
        // line 74
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "name", array()), "html", null, true);
        echo "</h3>
                </div>
            </div>
            <div class=\"box accordion\">
                <div class=\"box-header toggle active\">
                    <h3 class=\"box-title\">割り当て済オプション<svg class=\"cb cb-angle-down icon_down\"> <use xlink:href=\"#cb-angle-down\" /></svg></h3>
                </div>

                <div class=\"accpanel\" style=\"display: block;\">
                        <div class=\"sortable_list\">
                            <div class=\"tableish\">
                            ";
        // line 85
        if ((twig_length_filter($this->env, (isset($context["ProductOptions"]) ? $context["ProductOptions"] : null)) > 0)) {
            // line 86
            echo "                                ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["ProductOptions"]) ? $context["ProductOptions"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["ProductOption"]) {
                // line 87
                echo "                                    <div class=\"item_box tr\" data-option-id=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["ProductOption"], "id", array()), "html", null, true);
                echo "\" data-rank=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["ProductOption"], "rank", array()), "html", null, true);
                echo "\">
                                        <div class=\"icon_sortable td\">
                                            <svg class=\"cb cb-ellipsis-v\"><use xlink:href=\"#cb-ellipsis-v\" /></svg>
                                        </div>

                                        <div class=\"item_pattern td\">
                                                ";
                // line 93
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["ProductOption"], "Option", array()), "manage_name", array()), "html", null, true);
                echo "
                                        </div>
                                    </div><!-- /.item_box -->
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ProductOption'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 97
            echo "
                            ";
        } else {
            // line 99
            echo "                                <div class=\"box-body no-padding\">
                                    <div class=\"data-empty\">
                                        <svg class=\"cb cb-inbox\"><use xlink:href=\"#cb-inbox\" /></svg>
                                        <p>データはありません</p>
                                    </div>
                                </div><!-- /.box-body -->
                            ";
        }
        // line 106
        echo "
                        </div><!-- /.tableish -->
                    </div><!-- /.sortable_list -->
                </div><!-- /.accpanel -->
            </div><!-- /.box -->
        </div><!-- /.col-md-9 -->
        
        <div id=\"aside_column\" class=\"col-md-3\">
            <div class=\"col_inner\">
                <div class=\"box no-header\">
                    <div class=\"box-body\">
                        <div class=\"row text-center\">
                            <div class=\"col-sm-6 col-sm-offset-3 col-md-12 col-md-offset-0\">
                                <a class=\"btn btn-default btn-block btn-lg\" href=\"";
        // line 119
        echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("admin_product_product_option", array("id" => $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "id", array()))), "html", null, true);
        echo "\">オプション割当</a>
                            </div>
                        </div>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col_inner -->
        </div><!-- /#aside_column -->    

    </div><!-- /#aside_wrap -->

</form>

";
    }

    public function getTemplateName()
    {
        return "ProductOption/Resource/template/admin/Product/product_option_rank.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  195 => 119,  180 => 106,  171 => 99,  167 => 97,  157 => 93,  145 => 87,  140 => 86,  138 => 85,  124 => 74,  116 => 68,  113 => 67,  94 => 51,  62 => 22,  58 => 21,  54 => 20,  49 => 19,  46 => 18,  40 => 16,  34 => 15,  30 => 11,  28 => 13,  11 => 11,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "ProductOption/Resource/template/admin/Product/product_option_rank.twig", "/home/kir021669/public_html/vings.jp/app/Plugin/ProductOption/Resource/template/admin/Product/product_option_rank.twig");
    }
}
