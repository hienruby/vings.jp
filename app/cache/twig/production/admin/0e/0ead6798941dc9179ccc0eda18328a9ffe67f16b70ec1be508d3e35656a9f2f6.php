<?php

/* __string_template__0a89708faf00a331eb6a4b28e0b26afc3dc7c277ffd0deeda997ad302abc502a */
class __TwigTemplate_df7f76b230783d67a35dcdd8f0ff88842aab79397d2720eb4a6b758b93b448d7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("default_frame.twig", "__string_template__0a89708faf00a331eb6a4b28e0b26afc3dc7c277ffd0deeda997ad302abc502a", 12);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'sub_title' => array($this, 'block_sub_title'),
            'main' => array($this, 'block_main'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "default_frame.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 14
        $context["menus"] = array(0 => "setting", 1 => "shop", 2 => "shop_index");
        // line 19
        $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->setTheme((isset($context["form"]) ? $context["form"] : null), array(0 => "Form/bootstrap_3_horizontal_layout.html.twig"));
        // line 12
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 16
    public function block_title($context, array $blocks = array())
    {
        echo "基本情報設定";
    }

    // line 17
    public function block_sub_title($context, array $blocks = array())
    {
        echo "ポイント設定";
    }

    // line 21
    public function block_main($context, array $blocks = array())
    {
        // line 22
        echo "
    <div class=\"row\" id=\"aside_wrap\">
        <form name=\"form1\" role=\"form\" class=\"form-horizontal\" id=\"point_form\" method=\"post\"
              action=\"";
        // line 25
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("point_info");
        echo "\">
            ";
        // line 26
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "_token", array()), 'widget');
        echo "
            <div class=\"col-md-9\">
                <div class=\"box\">
                    <div class=\"box-header\">
                        <h3 class=\"box-title\">ポイント確定タイミング</h3>
                    </div><!-- /.box-header -->
                    <div class=\"box-body\">
                        <div class=\"form-group\">
                            <div class=\"col-sm-3 col-lg-3\">ポイント確定タイミング</div>
                            <div class=\"col-sm-9 col-lg-9\">
                                ";
        // line 36
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "plg_add_point_status", array()), 'widget');
        echo "
                                ";
        // line 37
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "plg_add_point_status", array()), 'errors');
        echo "
                            </div>
                        </div>
                    </div>
                </div>
                <div class=\"box\">
                    <div class=\"box-header\">
                        <h3 class=\"box-title\">ポイント基本設定</h3>
                    </div><!-- /.box-header -->
                    <div class=\"box-body\">
                        <div class=\"form-group\">
                            <div class=\"col-sm-3 col-lg-3\">基本ポイント付与率</div>
                            <div class=\"col-sm-9 col-lg-9\">
                                ";
        // line 50
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "plg_basic_point_rate", array()), 'widget');
        echo "
                                ";
        // line 51
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "plg_basic_point_rate", array()), 'errors');
        echo "
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <div class=\"col-sm-3 col-lg-3\">ポイント換算レート</div>
                            <div class=\"col-sm-9 col-lg-9\">
                                ";
        // line 57
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "plg_point_conversion_rate", array()), 'widget');
        echo "
                                ";
        // line 58
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "plg_point_conversion_rate", array()), 'errors');
        echo "
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <div class=\"col-sm-3 col-lg-3\">ポイント端数計算方法</div>
                            <div class=\"col-sm-9 col-lg-9\">
                                ";
        // line 64
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "plg_round_type", array()), 'widget');
        echo "
                                ";
        // line 65
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "plg_round_type", array()), 'errors');
        echo "
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <div class=\"col-sm-3 col-lg-3\">ポイント減算方式</div>
                            <div class=\"col-sm-9 col-lg-9\">
                                ";
        // line 71
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "plg_calculation_type", array()), 'widget');
        echo "
                                ";
        // line 72
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "plg_calculation_type", array()), 'errors');
        echo "
                            </div>
                        </div>
                    </div>
                </div><!-- /.box -->
                <div id=\"point_info_box\" class=\"box accordion\">
                    <div id=\"point_info_box__toggle\" class=\"box-header toggle\">
                        <h3 class=\"box-title\">ポイント機能利用時のご注意
                            <svg class=\"cb cb-angle-down icon_down\">
                                <use xmlns:xlink=\"http://www.w3.org/1999/xlink\" xlink:href=\"#cb-angle-down\"></use>
                            </svg>
                        </h3>
                    </div><!-- /.box-header -->
                    <div id=\"point_info_box__body\" class=\"box-body accpanel\" style=\"display: block;\">
                        <div class=\"form-group\">
                            <div class=\"col-sm-12 col-lg-12\">
                                <p>ポイント機能を利用するにあたっては、お客様との間でトラブルを避けるために、「特定商取引法に基づく表記」などに、利用規約を定めることをおすすめします。経済産業省「企業ポイントに関する消費者保護のあり方（ガイドライン）」等を参考にしてください。</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.col -->
            <div class=\"col-md-3\" id=\"aside_column\">
                <div class=\"col_inner\">
                    <div class=\"box no-header\">
                        <div class=\"box-body\">
                            <div class=\"row text-center\">
                                <div class=\"col-sm-6 col-sm-offset-3 col-md-12 col-md-offset-0\">
                                    <button class=\"btn btn-primary btn-block btn-lg\" type=\"submit\">
                                        登録
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

";
    }

    public function getTemplateName()
    {
        return "__string_template__0a89708faf00a331eb6a4b28e0b26afc3dc7c277ffd0deeda997ad302abc502a";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  135 => 72,  131 => 71,  122 => 65,  118 => 64,  109 => 58,  105 => 57,  96 => 51,  92 => 50,  76 => 37,  72 => 36,  59 => 26,  55 => 25,  50 => 22,  47 => 21,  41 => 17,  35 => 16,  31 => 12,  29 => 19,  27 => 14,  11 => 12,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__0a89708faf00a331eb6a4b28e0b26afc3dc7c277ffd0deeda997ad302abc502a", "");
    }
}
