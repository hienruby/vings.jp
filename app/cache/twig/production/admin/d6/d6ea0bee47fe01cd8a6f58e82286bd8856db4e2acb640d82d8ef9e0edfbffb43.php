<?php

/* __string_template__505a2378fd7f919fdf7f59bd046d4523c40b2bde3a73ae9298b29033cdc819f6 */
class __TwigTemplate_0646bbc3aa4b72609df80add2943375db4d3634bb47ac3834170024c606e3ca3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("default_frame.twig", "__string_template__505a2378fd7f919fdf7f59bd046d4523c40b2bde3a73ae9298b29033cdc819f6", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'sub_title' => array($this, 'block_sub_title'),
            'javascript' => array($this, 'block_javascript'),
            'stylesheet' => array($this, 'block_stylesheet'),
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
        $context["menus"] = array(0 => "product", 1 => "plugin_CategorySort_admin_sort");
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "カテゴリー並び替え";
    }

    // line 6
    public function block_sub_title($context, array $blocks = array())
    {
    }

    // line 10
    public function block_javascript($context, array $blocks = array())
    {
        // line 11
        echo "    <script src=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "front_urlpath", array()), "html", null, true);
        echo "/../../plugin/CategorySort/jquery.nestable.js\"></script>
    <script>
        \$(document).ready(function()
        {
            \$('.dd').nestable({

            });

            \$('#common_button_box__edit_button button').click(function () {
                var json = \$('.dd').nestable('serialize');
                console.log(json);
                \$(\"body\").append(\$('<div class=\"modal-backdrop in\"></div>'));
                \$.ajax({
                    url: '";
        // line 24
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("plugin_CategorySort_admin_save");
        echo "',
                    type: 'POST',
                    data: {'categories' : JSON.stringify(json)},
                    timeout: 10000
                }).done(function(data) {
                    console.log(data);
                    \$(\".modal-backdrop\").remove();
                }).fail(function() {
                    alert('設定に失敗しました');
                    \$(\".modal-backdrop\").remove();
                });
            });
        });

    </script>
";
    }

    // line 41
    public function block_stylesheet($context, array $blocks = array())
    {
        // line 42
        echo "<style>
    /**
 * Nestable
 */
    .dd { position: relative; display: block; margin: 0; padding: 0; max-width: 600px; list-style: none; font-size: 13px; line-height: 20px; }
    .dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }
    .dd-list .dd-list { padding-left: 30px; }
    .dd-collapsed .dd-list { display: none; }
    .dd-item,
    .dd-empty,
    .dd-placeholder { display: block; position: relative; margin: 0; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }
    .dd-handle { display: block; height: 30px; margin: 5px 0; padding: 5px 10px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
        background: #fafafa;
        background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
        background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
        background:         linear-gradient(top, #fafafa 0%, #eee 100%);
        -webkit-border-radius: 3px;
        border-radius: 3px;
        box-sizing: border-box; -moz-box-sizing: border-box;
    }
    .dd-handle:hover { color: #2ea8e5; background: #fff; }
    .dd-item > button { display: block; position: relative; cursor: pointer; float: left; width: 25px; height: 20px; margin: 5px 0; padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; font-size: 12px; line-height: 1; text-align: center; font-weight: bold; }
    .dd-item > button:before { content: '+'; display: block; position: absolute; width: 100%; text-align: center; text-indent: 0; }
    .dd-item > button[data-action=\"collapse\"]:before { content: '-'; }
    .dd-placeholder,
    .dd-empty { margin: 5px 0; padding: 0; min-height: 30px; background: #f2fbff; border: 1px dashed #b6bcbf; box-sizing: border-box; -moz-box-sizing: border-box; }
    .dd-empty { border: 1px dashed #bbb; min-height: 100px; background-color: #e5e5e5;
        background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
        -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
        background-image:    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
        -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
        background-image:         linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
        linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
        background-size: 60px 60px;
        background-position: 0 0, 30px 30px;
    }
    .dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }
    .dd-dragel > .dd-item .dd-handle { margin-top: 0; }
    .dd-dragel .dd-handle {
        -webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
        box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
    }
</style>
";
    }

    // line 99
    public function block_main($context, array $blocks = array())
    {
        // line 100
        echo "    <form class=\"form-horizontal\" method=\"post\" action=\"";
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("plugin_CategorySort_config");
        echo "\">
        ";
        // line 102
        echo "        <div class=\"row\" id=\"aside_wrap\">
            <div  class=\"col-md-9\">
                <div class=\"box\">
                    <div class=\"box-header\">
                        <h3 class=\"box-title\">カテゴリー並び替え</h3>
                    </div><!-- /.box-header -->
                    <div class=\"box-body form-horizontal\">
                        <p>※設定ボタンを押すと下記の階層に従ってランク、レベル、親子関係を設定し直します。</p>
                        <div class=\"dd\">
                            ";
        // line 111
        echo $this->getAttribute($this, "tree", array(0 => (isset($context["RootCategories"]) ? $context["RootCategories"] : null)), "method");
        echo "
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
            <div class=\"col-md-3\" id=\"aside_column\">
                <div id=\"common_box\" class=\"col_inner\">
                    <div id=\"common_button_box\" class=\"box no-header\">
                        <div id=\"common_button_box__body\" class=\"box-body\">
                            <div id=\"common_button_box__edit_button\" class=\"row text-center\">
                                <div class=\"col-sm-6 col-sm-offset-3 col-md-12 col-md-offset-0\">
                                    <button class=\"btn btn-primary btn-block btn-lg\" type=\"button\">設定</button>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div><!-- /.col -->
        </div>
    </form>
";
    }

    // line 86
    public function gettree($__Categories__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "Categories" => $__Categories__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 87
            echo "    ";
            if (( !(null === (isset($context["Categories"]) ? $context["Categories"] : null)) && twig_length_filter($this->env, (isset($context["Categories"]) ? $context["Categories"] : null)))) {
                // line 88
                echo "        <ol class=\"dd-list\">
            ";
                // line 89
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["Categories"]) ? $context["Categories"] : null));
                foreach ($context['_seq'] as $context["_key"] => $context["Category"]) {
                    // line 90
                    echo "                <li class=\"dd-item\" data-id=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["Category"], "id", array()), "html", null, true);
                    echo "\">
                    <div class=\"dd-handle\">";
                    // line 91
                    echo twig_escape_filter($this->env, $this->getAttribute($context["Category"], "name", array()), "html", null, true);
                    echo "</div>
                    ";
                    // line 92
                    echo $this->getAttribute($this, "tree", array(0 => $this->getAttribute($context["Category"], "Children", array())), "method");
                    echo "
                </li>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Category'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 95
                echo "        </ol>
    ";
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "__string_template__505a2378fd7f919fdf7f59bd046d4523c40b2bde3a73ae9298b29033cdc819f6";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  220 => 95,  211 => 92,  207 => 91,  202 => 90,  198 => 89,  195 => 88,  192 => 87,  180 => 86,  155 => 111,  144 => 102,  139 => 100,  136 => 99,  89 => 42,  86 => 41,  66 => 24,  49 => 11,  46 => 10,  41 => 6,  35 => 5,  31 => 1,  29 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__505a2378fd7f919fdf7f59bd046d4523c40b2bde3a73ae9298b29033cdc819f6", "");
    }
}
