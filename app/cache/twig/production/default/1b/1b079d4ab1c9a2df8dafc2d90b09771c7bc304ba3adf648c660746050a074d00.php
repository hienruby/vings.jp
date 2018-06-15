<?php

/* __string_template__ea12c2212b114cf3f0cd39f91cba635558a591177c7ac2967e75bee5e9b3547a */
class __TwigTemplate_562a1012009c8b8fd7b5d579ede284012d5d7301a9bb7050dcd3f67c7b6f75ae extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 11
        $this->parent = $this->loadTemplate("default_frame.twig", "__string_template__ea12c2212b114cf3f0cd39f91cba635558a591177c7ac2967e75bee5e9b3547a", 11);
        $this->blocks = array(
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
        // line 13
        $context["body_class"] = "product_review_page";
        // line 11
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 15
    public function block_stylesheet($context, array $blocks = array())
    {
        // line 16
        echo "<style>
    .product_review_page .dl_table {
        margin: 0 0 16px;
    }
    .product_review_page .dl_table dt {
        margin-bottom: 5px;
    }
    .product_review_page .dl_table dt label {
        font-weight: bold;
    }
    .product_review_page textarea {
        vertical-align: top;
    }
    .product_review_page #product_review_sex .radio {
        display: inline-block;
        margin-right: 10px;
    }
    .product_review_page #product_review_sex .radio input[type=\"radio\"] {
        margin-right: 10px;
    }
</style>
";
    }

    // line 39
    public function block_main($context, array $blocks = array())
    {
        // line 40
        echo "<h1 class=\"page-heading\">レビューを書く</h1>
<div class=\"container-fluid\">
    <div class=\"row\">
        <div class=\"col-md-10 col-md-offset-1\">
            <p>商品について、お客様のご感想をお待ちしております。</p>
            <form method=\"post\" action=\"";
        // line 45
        echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("plugin_products_detail_review", array("id" => $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "id", array()))), "html", null, true);
        echo "\">
                <input type=\"hidden\" name=\"mode\" value=\"confirm\">
                ";
        // line 47
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "_token", array()), 'widget');
        echo "
                <div class=\"dl_table\">
                    <dl>
                        <dt><label>商品名</label></dt>
                        <dd class=\"form-group\">
                            ";
        // line 52
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "name", array()), "html", null, true);
        echo "
                        </dd>
                    </dl>
                    <dl>
                        <dt>";
        // line 56
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "reviewer_name", array()), 'label');
        echo "</dt>
                        <dd class=\"form-group\">
                            ";
        // line 58
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "reviewer_name", array()), 'widget');
        echo "
                            ";
        // line 59
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "reviewer_name", array()), 'errors');
        echo "
                        </dd>
                    </dl>
                    <dl>
                        <dt>";
        // line 63
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "reviewer_url", array()), 'label');
        echo "</dt>
                        <dd class=\"form-group\">
                            ";
        // line 65
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "reviewer_url", array()), 'widget');
        echo "
                            ";
        // line 66
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "reviewer_url", array()), 'errors');
        echo "
                        </dd>
                    </dl>
                    <dl id=\"product_review_sex\">
                        <dt>";
        // line 70
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "sex", array()), 'label');
        echo "</dt>
                        <dd>
                            <div class=\"form-group form-inline\">
                                ";
        // line 73
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "sex", array()), 'widget');
        echo "
                                ";
        // line 74
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "sex", array()), 'errors');
        echo "
                            </div>
                        </dd>
                    </dl>
                    <dl>
                        <dt>";
        // line 79
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "recommend_level", array()), 'label');
        echo "</dt>
                        <dd class=\"form-group\">
                            ";
        // line 81
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "recommend_level", array()), 'widget');
        echo "
                            ";
        // line 82
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "recommend_level", array()), 'errors');
        echo "
                        </dd>
                    </dl>
                    <dl>
                        <dt>";
        // line 86
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "title", array()), 'label');
        echo "</dt>
                        <dd class=\"form-group\">
                            ";
        // line 88
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "title", array()), 'widget');
        echo "
                            ";
        // line 89
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "title", array()), 'errors');
        echo "
                        </dd>
                    </dl>
                    <dl>
                        <dt>";
        // line 93
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "comment", array()), 'label');
        echo "</dt>
                        <dd class=\"form-group\">
                            <div class=\"column\">
                            ";
        // line 96
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "comment", array()), 'widget', array("attr" => array("rows" => "6")));
        echo "
                            ";
        // line 97
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "comment", array()), 'errors');
        echo "
                            </div>
                        </dd>
                    </dl>
                </div>

                <div class=\"row no-padding\">
                    <div class=\"btn_group col-sm-offset-4 col-sm-4\">
                        <p>
                            <button type=\"submit\" class=\"btn btn-primary btn-block\">確認ページヘ</button>
                        </p>
                        <p>
                            <a href=\"";
        // line 109
        echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("product_detail", array("id" => $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "id", array()))), "html", null, true);
        echo "\" class=\"btn btn-info btn-block\">戻る</a>
                        </p>
                    </div>
                </div>
            </form>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>
";
    }

    public function getTemplateName()
    {
        return "__string_template__ea12c2212b114cf3f0cd39f91cba635558a591177c7ac2967e75bee5e9b3547a";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  197 => 109,  182 => 97,  178 => 96,  172 => 93,  165 => 89,  161 => 88,  156 => 86,  149 => 82,  145 => 81,  140 => 79,  132 => 74,  128 => 73,  122 => 70,  115 => 66,  111 => 65,  106 => 63,  99 => 59,  95 => 58,  90 => 56,  83 => 52,  75 => 47,  70 => 45,  63 => 40,  60 => 39,  35 => 16,  32 => 15,  28 => 11,  26 => 13,  11 => 11,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__ea12c2212b114cf3f0cd39f91cba635558a591177c7ac2967e75bee5e9b3547a", "");
    }
}
