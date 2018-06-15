<?php

/* __string_template__6997c02a81d0276e152db777de449f3dffb03fe9933abb156a5b4595f5ab59f1 */
class __TwigTemplate_79ba9e770e1f3feb32023bd85a6d5219e4812c15c5635378cf84f31045800807 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 22
        $this->parent = $this->loadTemplate("default_frame.twig", "__string_template__6997c02a81d0276e152db777de449f3dffb03fe9933abb156a5b4595f5ab59f1", 22);
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
        // line 24
        $context["body_class"] = "registration_page";
        // line 22
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 26
    public function block_javascript($context, array $blocks = array())
    {
        // line 27
        echo "<script src=\"//ajaxzip3.github.io/ajaxzip3.js\" charset=\"UTF-8\"></script>
<script>
    \$(function() {
        \$('#zip-search').click(function() {
            AjaxZip3.zip2addr('entry[zip][zip01]', 'entry[zip][zip02]', 'entry[address][pref]', 'entry[address][addr01]');
        });
    });
</script>
";
    }

    // line 37
    public function block_main($context, array $blocks = array())
    {
        // line 38
        echo "<style>
.page-heading {margin:0;}

.product_lf{
display:none;
}

</style>
<h1 class=\"page-heading\">新規会員登録</h1>
<div id=\"top_wrap\" class=\"container-fluid1\">
    <div id=\"top_box\" class=\"row\">
        <div id=\"top_box__body\" class=\"col-md-10 col-md-offset-1\">
            <form method=\"post\" action=\"";
        // line 50
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("entry");
        echo "\">
                ";
        // line 51
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "_token", array()), 'widget');
        echo "
                <div id=\"top_box__body_inner\" class=\"dl_table\">
                    <dl id=\"top_box__name\">
                        <dt>";
        // line 54
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "name", array()), 'label');
        echo "</dt>
                        <dd class=\"form-group input_name\">
                            ";
        // line 56
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "name", array()), "name01", array()), 'widget');
        echo "
                            ";
        // line 57
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "name", array()), "name02", array()), 'widget');
        echo "
                            ";
        // line 58
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "name", array()), "name01", array()), 'errors');
        echo "
                            ";
        // line 59
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "name", array()), "name02", array()), 'errors');
        echo "
                        </dd>
                    </dl>
                    <dl id=\"top_box__kana\">
                        <dt>";
        // line 63
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "kana", array()), 'label');
        echo "</dt>
                        <dd class=\"form-group input_name\">
                            ";
        // line 65
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "kana", array()), "kana01", array()), 'widget');
        echo "
                            ";
        // line 66
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "kana", array()), "kana02", array()), 'widget');
        echo "
                            ";
        // line 67
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "kana", array()), "kana01", array()), 'errors');
        echo "
                            ";
        // line 68
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "kana", array()), "kana02", array()), 'errors');
        echo "
                        </dd>
                    </dl>
                    <dl id=\"top_box__company_name\">
                        <dt>";
        // line 72
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "company_name", array()), 'label');
        echo "</dt>
                        <dd class=\"form-group input_name\">
                            ";
        // line 74
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "company_name", array()), 'widget');
        echo "
                            ";
        // line 75
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "company_name", array()), 'errors');
        echo "
                        </dd>
                    </dl>
                    <dl id=\"top_box__address_detail\">
                        <dt>";
        // line 79
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "address", array()), 'label');
        echo "</dt>
                        <dd>
                            <div id=\"top_box__zip\" class=\"form-group form-inline input_zip ";
        // line 81
        if (( !twig_test_empty($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "zip", array()), "zip01", array()), "vars", array()), "errors", array())) ||  !twig_test_empty($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "zip", array()), "zip02", array()), "vars", array()), "errors", array())))) {
            echo "has-error";
        }
        echo "\">";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "zip", array()), 'widget');
        echo "</div>
                            <div id=\"top_box__address\" class=\"";
        // line 82
        if ((( !twig_test_empty($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "address", array()), "pref", array()), "vars", array()), "errors", array())) ||  !twig_test_empty($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "address", array()), "addr01", array()), "vars", array()), "errors", array()))) ||  !twig_test_empty($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "address", array()), "addr02", array()), "vars", array()), "errors", array())))) {
            echo "has-error";
        }
        echo "\">
                                ";
        // line 83
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "address", array()), 'widget');
        echo "
                                ";
        // line 84
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "address", array()), 'errors');
        echo "
                            </div>
                        </dd>
                    </dl>
                    <dl id=\"top_box__tel\">
                        <dt>";
        // line 89
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "tel", array()), 'label');
        echo "</dt>
                        <dd>
                            <div class=\"form-inline form-group input_tel\">
                                ";
        // line 92
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "tel", array()), 'widget', array("attr" => array("class" => "short")));
        echo "
                                ";
        // line 93
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "tel", array()), 'errors');
        echo "
                            </div>
                        </dd>
                    </dl>
                    <dl id=\"top_box__fax\">
                        <dt>";
        // line 98
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "fax", array()), 'label');
        echo "</dt>
                        <dd>
                            <div class=\"form-inline form-group input_tel\">
                                ";
        // line 101
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "fax", array()), 'widget', array("attr" => array("class" => "short")));
        echo "
                                ";
        // line 102
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "fax", array()), 'errors');
        echo "
                            </div>
                        </dd>
                    </dl>
                    <dl id=\"top_box__email\">
                        <dt>";
        // line 107
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "email", array()), 'label');
        echo "</dt>
                        <dd>
                            ";
        // line 109
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "email", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["emailField"]) {
            // line 110
            echo "                            <div class=\"form-group ";
            if ( !twig_test_empty($this->getAttribute($this->getAttribute($context["emailField"], "vars", array()), "errors", array()))) {
                echo "has-error";
            }
            echo "\">
                                ";
            // line 111
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["emailField"], 'widget');
            echo "
                                ";
            // line 112
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["emailField"], 'errors');
            echo "
                            </div>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['emailField'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 115
        echo "                        </dd>
                    </dl>
                    <dl id=\"top_box__password\">
                        <dt>";
        // line 118
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "password", array()), 'label');
        echo "</dt>
                        <dd>
                            ";
        // line 120
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "password", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["passwordField"]) {
            // line 121
            echo "                            <div class=\"form-group ";
            if ( !twig_test_empty($this->getAttribute($this->getAttribute($context["passwordField"], "vars", array()), "errors", array()))) {
                echo "has-error";
            }
            echo "\">
                                ";
            // line 122
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["passwordField"], 'widget', array("type" => "password"));
            echo "
                                ";
            // line 123
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["passwordField"], 'errors');
            echo "
                            </div>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['passwordField'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 126
        echo "                        </dd>
                    </dl>
                </div>
                <div id=\"top_box__birth\" class=\"dl_table not_required\">
                    <dl>
                        <dt>";
        // line 131
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "birth", array()), 'label');
        echo "</dt>
                        <dd>
                            <div class=\"form-group form-inline\">
                                ";
        // line 134
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "birth", array()), 'widget');
        echo "
                                ";
        // line 135
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "birth", array()), 'errors');
        echo "
                            </div>
                        </dd>
                    </dl>
                    <dl>
                        <dt id=\"top_box__sex\">";
        // line 140
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "sex", array()), 'label');
        echo "</dt>
                        <dd>
                            <div class=\"form-group form-inline\">
                                ";
        // line 143
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "sex", array()), 'widget');
        echo "
                                ";
        // line 144
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "sex", array()), 'errors');
        echo "
                            </div>
                        </dd>
                    </dl>
                    <dl id=\"top_box__job\">
                        <dt>";
        // line 149
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "job", array()), 'label');
        echo "</dt>
                        <dd>
                            <div class=\"form-group form-inline\">
                                ";
        // line 152
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "job", array()), 'widget');
        echo "
                                ";
        // line 153
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "job", array()), 'errors');
        echo "
                            </div>
                        </dd>
                    </dl>";
        // line 177
        echo "<dl>
<dt>メールマガジン送付について<span class=\"required\">必須</span></dt>
<dd>
    <div class=\"form-group form-inline\">
        ";
        // line 181
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "mailmaga_flg", array()), 'widget');
        echo "
        ";
        // line 182
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "mailmaga_flg", array()), 'errors');
        echo "
    </div>
</dd>
</dl>

                </div>
                ";
        // line 188
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["form"]) ? $context["form"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
            // line 189
            echo "                    ";
            if (preg_match("[^plg*]", $this->getAttribute($this->getAttribute($context["f"], "vars", array()), "name", array()))) {
                // line 190
                echo "                        <div class=\"extra-form dl_table\">
                            ";
                // line 191
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'row');
                echo "
                        </div>
                    ";
            }
            // line 194
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['f'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 195
        echo "                <input id=\"top_box__hidden_mode\" type=\"hidden\" name=\"mode\" value=\"confirm\">
                <p id=\"top_box__agreement\" class=\"form_terms_link\"><a href=\"";
        // line 196
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("help_agreement");
        echo "\" target=\"_blank\">利用規約</a>に同意してお進みください
                </p>

                <div id=\"top_box__footer\" class=\"row no-padding\">
                    <div id=\"top_box__button_menu\" class=\"btn_group col-sm-offset-4 col-sm-4\">
                        <p>
                            <button type=\"submit\" class=\"btn btn-primary btn-block\">同意する</button>
                        </p>
                        <p><a href=\"";
        // line 204
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("index");
        echo "\" class=\"btn btn-info btn-block\">同意しない</a></p>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
";
    }

    public function getTemplateName()
    {
        return "__string_template__6997c02a81d0276e152db777de449f3dffb03fe9933abb156a5b4595f5ab59f1";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  382 => 204,  371 => 196,  368 => 195,  362 => 194,  356 => 191,  353 => 190,  350 => 189,  346 => 188,  337 => 182,  333 => 181,  327 => 177,  321 => 153,  317 => 152,  311 => 149,  303 => 144,  299 => 143,  293 => 140,  285 => 135,  281 => 134,  275 => 131,  268 => 126,  259 => 123,  255 => 122,  248 => 121,  244 => 120,  239 => 118,  234 => 115,  225 => 112,  221 => 111,  214 => 110,  210 => 109,  205 => 107,  197 => 102,  193 => 101,  187 => 98,  179 => 93,  175 => 92,  169 => 89,  161 => 84,  157 => 83,  151 => 82,  143 => 81,  138 => 79,  131 => 75,  127 => 74,  122 => 72,  115 => 68,  111 => 67,  107 => 66,  103 => 65,  98 => 63,  91 => 59,  87 => 58,  83 => 57,  79 => 56,  74 => 54,  68 => 51,  64 => 50,  50 => 38,  47 => 37,  35 => 27,  32 => 26,  28 => 22,  26 => 24,  11 => 22,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__6997c02a81d0276e152db777de449f3dffb03fe9933abb156a5b4595f5ab59f1", "");
    }
}
