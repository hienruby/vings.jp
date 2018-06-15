<?php

/* __string_template__b73fb33a2f06bb6ed459c4f0527c4b5f2d2eeb1367221f19b2f158ebbe1fb4f4 */
class __TwigTemplate_166f0470a90e1b3f4f8ab77c1ed64f1dc03eda353c1be1988f5aca264d1576ea extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 22
        $this->parent = $this->loadTemplate("default_frame.twig", "__string_template__b73fb33a2f06bb6ed459c4f0527c4b5f2d2eeb1367221f19b2f158ebbe1fb4f4", 22);
        $this->blocks = array(
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

    // line 24
    public function block_main($context, array $blocks = array())
    {
        // line 25
        echo "<style>

.product_lf{
display:none;
}

.page-heading {
padding-bottom:0;
margin-bottom: 0;
}
</style>
<div id=\"contents\" class=\"main_only\">
    <div class=\"container-fluid1 inner no-padding\">
        <div id=\"main1\">
            <h1 class=\"page-heading\">特定商取引法に基づく表記</h1>
            <div id=\"tradelaw_wrap\" class=\"container-fluid\">
                <div class=\"row\">
                    <div id=\"tradelaw_box\" class=\"col-md-10 col-md-offset-1\">
                        <div id=\"tradelaw__body\" class=\"dl_table\">

                            ";
        // line 45
        if ($this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_company", array(), "any", true, true)) {
            // line 46
            echo "                            <dl id=\"tradelaw__law_company\">
                                <dt>販売業者</dt>
                                <dd>";
            // line 48
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_company", array()), "html", null, true);
            echo "</dd>
                            </dl>
                            ";
        }
        // line 51
        echo "
                            ";
        // line 52
        if ($this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_manager", array(), "any", true, true)) {
            // line 53
            echo "                            <dl id=\"tradelaw__law_manager\">
                                <dt>運営責任者</dt>
                                <dd>";
            // line 55
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_manager", array()), "html", null, true);
            echo "</dd>
                            </dl>
                            ";
        }
        // line 58
        echo "
                            ";
        // line 59
        if ($this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_zip01", array(), "any", true, true)) {
            // line 60
            echo "                            <dl id=\"tradelaw__zip\">
                                <dt>住所</dt>
                                <dd>〒";
            // line 62
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_zip01", array()), "html", null, true);
            echo "-";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_zip02", array()), "html", null, true);
            echo "<br />
                                    ";
            // line 63
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_pref", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_pref", array()), "")) : ("")), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_addr01", array()), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_addr02", array()), "html", null, true);
            echo "
                                </dd>
                            </dl>
                            ";
        }
        // line 67
        echo "
                            ";
        // line 68
        if ($this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_tel01", array(), "any", true, true)) {
            // line 69
            echo "                            <dl id=\"tradelaw__tel\">
                                <dt>電話番号</dt>
                                <dd>";
            // line 71
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_tel01", array()), "html", null, true);
            echo "-";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_tel02", array()), "html", null, true);
            echo "-";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_tel03", array()), "html", null, true);
            echo "</dd>
                            </dl>
                            ";
        }
        // line 74
        echo "
                            ";
        // line 75
        if (($this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_fax01", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_fax01", array())))) {
            // line 76
            echo "                            <dl id=\"tradelaw__fax\">
                                <dt>FAX番号</dt>
                                <dd>";
            // line 78
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_fax01", array()), "html", null, true);
            echo "-";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_fax02", array()), "html", null, true);
            echo "-";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_fax03", array()), "html", null, true);
            echo "</dd>
                            </dl>
                            ";
        }
        // line 81
        echo "
                            ";
        // line 82
        if ($this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_email", array(), "any", true, true)) {
            // line 83
            echo "                            <dl id=\"tradelaw__email\">
                                <dt>メールアドレス</dt>
                                <dd><a href=\"mailto:";
            // line 85
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_email", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_email", array()), "html", null, true);
            echo "</a></dd>
                            </dl>
                            ";
        }
        // line 88
        echo "
                            ";
        // line 89
        if ($this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_url", array(), "any", true, true)) {
            // line 90
            echo "                            <dl id=\"tradelaw__law_url\">
                                <dt>URL</dt>
                                <dd><a href=\"";
            // line 92
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_url", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_url", array()), "html", null, true);
            echo "</a></dd>
                            </dl>
                            ";
        }
        // line 95
        echo "
                            ";
        // line 96
        if ($this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_term01", array(), "any", true, true)) {
            // line 97
            echo "                            <dl id=\"tradelaw__law_term01\">
                                <dt>商品以外の必要代金</dt>
                                <dd>";
            // line 99
            echo nl2br(twig_escape_filter($this->env, $this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_term01", array()), "html", null, true));
            echo "</dd>
                            </dl>
                            ";
        }
        // line 102
        echo "
                            ";
        // line 103
        if ($this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_term02", array(), "any", true, true)) {
            // line 104
            echo "                            <dl id=\"tradelaw__law_term02\">
                                <dt>注文方法</dt>
                                <dd>";
            // line 106
            echo nl2br(twig_escape_filter($this->env, $this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_term02", array()), "html", null, true));
            echo "</dd>
                            </dl>
                            ";
        }
        // line 109
        echo "
                            ";
        // line 110
        if ($this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_term03", array(), "any", true, true)) {
            // line 111
            echo "                            <dl id=\"tradelaw__law_term03\">
                                <dt>支払方法</dt>
                                <dd>";
            // line 113
            echo nl2br(twig_escape_filter($this->env, $this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_term03", array()), "html", null, true));
            echo "</dd>
                            </dl>
                            ";
        }
        // line 116
        echo "
                            ";
        // line 117
        if ($this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_term04", array(), "any", true, true)) {
            // line 118
            echo "                            <dl id=\"tradelaw__law_term04\">
                                <dt>支払期限</dt>
                                <dd>";
            // line 120
            echo nl2br(twig_escape_filter($this->env, $this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_term04", array()), "html", null, true));
            echo "</dd>
                            </dl>
                            ";
        }
        // line 123
        echo "
                            ";
        // line 124
        if ($this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_term05", array(), "any", true, true)) {
            // line 125
            echo "                            <dl id=\"tradelaw__law_term05\">
                                <dt>引渡し時期</dt>
                                <dd>";
            // line 127
            echo nl2br(twig_escape_filter($this->env, $this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_term05", array()), "html", null, true));
            echo "</dd>
                            </dl>
                            ";
        }
        // line 130
        echo "
                            ";
        // line 131
        if ($this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_term06", array(), "any", true, true)) {
            // line 132
            echo "                            <dl id=\"tradelaw__law_term06\">
                                <dt>返品・交換について</dt>
                                <dd>";
            // line 134
            echo nl2br(twig_escape_filter($this->env, $this->getAttribute((isset($context["help"]) ? $context["help"] : null), "law_term06", array()), "html", null, true));
            echo "</dd>
                            </dl>
                            ";
        }
        // line 137
        echo "                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->

            </div>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "__string_template__b73fb33a2f06bb6ed459c4f0527c4b5f2d2eeb1367221f19b2f158ebbe1fb4f4";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  266 => 137,  260 => 134,  256 => 132,  254 => 131,  251 => 130,  245 => 127,  241 => 125,  239 => 124,  236 => 123,  230 => 120,  226 => 118,  224 => 117,  221 => 116,  215 => 113,  211 => 111,  209 => 110,  206 => 109,  200 => 106,  196 => 104,  194 => 103,  191 => 102,  185 => 99,  181 => 97,  179 => 96,  176 => 95,  168 => 92,  164 => 90,  162 => 89,  159 => 88,  151 => 85,  147 => 83,  145 => 82,  142 => 81,  132 => 78,  128 => 76,  126 => 75,  123 => 74,  113 => 71,  109 => 69,  107 => 68,  104 => 67,  95 => 63,  89 => 62,  85 => 60,  83 => 59,  80 => 58,  74 => 55,  70 => 53,  68 => 52,  65 => 51,  59 => 48,  55 => 46,  53 => 45,  31 => 25,  28 => 24,  11 => 22,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__b73fb33a2f06bb6ed459c4f0527c4b5f2d2eeb1367221f19b2f158ebbe1fb4f4", "");
    }
}
