<?php

/* __string_template__bf3b5835ac8eb603a23e0b6877d1ee4587f25f90da1cfe456a5a16384ea833d0 */
class __TwigTemplate_148fd84d8411af4c70d3f0552bb097df16a945b870a8a54c45e5f606a5d7120f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 22
        $this->parent = $this->loadTemplate("default_frame.twig", "__string_template__bf3b5835ac8eb603a23e0b6877d1ee4587f25f90da1cfe456a5a16384ea833d0", 22);
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
        // line 24
        $context["body_class"] = "cart_page";
        // line 22
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 26
    public function block_main($context, array $blocks = array())
    {
        // line 27
        echo "<style>
#login_box .column {
background:none;
}
.page-heading {
margin:0;
}
</style>
    <h1 class=\"page-heading\">ログイン</h1>
    <div id=\"login_wrap\" class=\"container-fluid1\">
        <form method=\"post\" action=\"";
        // line 37
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("login_check");
        echo "\">
            <input type=\"hidden\" name=\"_target_path\" value=\"shopping\" />
            <input type=\"hidden\" name=\"_failure_path\" value=\"shopping_login\" />
            <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 40
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderCsrfToken("authenticate"), "html", null, true);
        echo "\">

            <div id=\"login_box\" class=\"login_cart row\">
                ";
        // line 43
        if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
            // line 44
            echo "                <div id=\"customer_box\" class=\"col-sm-8 col-sm-offset-2\" style=\"height: 330px;\">
                ";
        } else {
            // line 46
            echo "                <div id=\"customer_box\" class=\"col-sm-8\" style=\"height: 330px;\">
                ";
        }
        // line 48
        echo "                    <div id=\"customer_box__body\" class=\"column\">
                        <div id=\"customer_box__body_inner\" class=\"column_inner clearfix\">
                            <div class=\"icon\"><!--<svg class=\"cb cb-user-circle\"><use xlink:href=\"#cb-user-circle\"></use></svg>--><img src=\"/user_data/images/user.png\"></div>
                            <div id=\"customer_box__login_email\" class=\"form-group\">
                                ";
        // line 52
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "login_email", array()), 'widget', array("attr" => array("style" => "ime-mode: disabled;", "placeholder" => "メールアドレス", "autofocus" => true)));
        echo " <br class=\"sp\">
                            </div>
                            <div id=\"customer_box__login_pass\" class=\"form-group\">
                                ";
        // line 55
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "login_pass", array()), 'widget', array("attr" => array("placeholder" => "パスワード")));
        echo "
                                ";
        // line 56
        if ($this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "option_remember_me", array())) {
            // line 57
            echo "                                    ";
            if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
                // line 58
                echo "                                        <input type=\"hidden\" name=\"login_memory\" value=\"1\">
                                    ";
            } else {
                // line 60
                echo "                                        ";
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "login_memory", array()), 'widget');
                echo "
                                    ";
            }
            // line 62
            echo "                                ";
        }
        // line 63
        echo "                            </div>
                            <div class=\"extra-form form-group\">
                                ";
        // line 65
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "getIterator", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
            // line 66
            echo "                                    ";
            if (preg_match("[^plg*]", $this->getAttribute($this->getAttribute($context["f"], "vars", array()), "name", array()))) {
                // line 67
                echo "                                        ";
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'row');
                echo "
                                        ";
                // line 68
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'widget');
                echo "
                                        ";
                // line 69
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'errors');
                echo "
                                    ";
            }
            // line 71
            echo "                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['f'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 72
        echo "                            </div>
                            ";
        // line 73
        if ((isset($context["error"]) ? $context["error"] : null)) {
            // line 74
            echo "                                <div id=\"customer_box__error_message\" class=\"form-group\">
                                    <span class=\"text-danger\">";
            // line 75
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans((isset($context["error"]) ? $context["error"] : null));
            echo "</span>
                                </div>
                            ";
        }
        // line 78
        echo "                            <div id=\"customer_box__login_button\" class=\"btn_area\">
                                <p><button type=\"submit\" class=\"btn btn-info btn-block btn-lg\">ログイン</button></p>
                                <ul id=\"customer_box__login_menu\">
                                <li><a href=\"";
        // line 81
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("forgot");
        echo "\">ログイン情報をお忘れですか？</a></li>
                                <li><a href=\"";
        // line 82
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("entry");
        echo "\">新規会員登録</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><!-- /.col -->

                ";
        // line 89
        if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
            // line 90
            echo "                ";
        } else {
            // line 91
            echo "                <div id=\"guest_box\" class=\"col-sm-4\" style=\"height: 330px;\">
                    <div id=\"guest_box__body\" class=\"column\">
                        <div id=\"guest_box__body_inner\" class=\"column_inner\">
                            <p id=\"guest_box__message\" class=\"message\">会員登録をせずに購入手続きをされたい方は、下記よりお進みください。
                            <p id=\"guest_box__confirm_button\" class=\"btn_area\">
                                <a href=\"";
            // line 96
            echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("shopping_nonmember");
            echo "\" class=\"btn btn-info btn-block btn-lg\">ゲスト購入</a></p>
                        </div>
                    </div>
                </div><!-- /.col -->
                ";
        }
        // line 101
        echo "            </div><!-- /.row -->
        </form>
    </div>
";
    }

    public function getTemplateName()
    {
        return "__string_template__bf3b5835ac8eb603a23e0b6877d1ee4587f25f90da1cfe456a5a16384ea833d0";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  186 => 101,  178 => 96,  171 => 91,  168 => 90,  166 => 89,  156 => 82,  152 => 81,  147 => 78,  141 => 75,  138 => 74,  136 => 73,  133 => 72,  127 => 71,  122 => 69,  118 => 68,  113 => 67,  110 => 66,  106 => 65,  102 => 63,  99 => 62,  93 => 60,  89 => 58,  86 => 57,  84 => 56,  80 => 55,  74 => 52,  68 => 48,  64 => 46,  60 => 44,  58 => 43,  52 => 40,  46 => 37,  34 => 27,  31 => 26,  27 => 22,  25 => 24,  11 => 22,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__bf3b5835ac8eb603a23e0b6877d1ee4587f25f90da1cfe456a5a16384ea833d0", "");
    }
}
