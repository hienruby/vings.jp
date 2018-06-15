<?php

/* __string_template__a48ceb8ae907136845f75075434b8ff32f68a6b02d6346c87d75de8caae2e8a2 */
class __TwigTemplate_2335f8a59db7f5e607bb5587669b870dedfa81494865590538b47b286629a4e5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 22
        $this->parent = $this->loadTemplate("default_frame.twig", "__string_template__a48ceb8ae907136845f75075434b8ff32f68a6b02d6346c87d75de8caae2e8a2", 22);
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
        $context["body_class"] = "mypage";
        // line 22
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 26
    public function block_main($context, array $blocks = array())
    {
        // line 27
        echo "<style>

.product_lf{
display:none;
}

.page-heading {
margin:0;
}
#login_box .column {
background:none;
}
</style>
    <h1 class=\"page-heading\">ログイン</h1>
    <div class=\"container-fluid1\">
        <form name=\"login_mypage\" id=\"login_mypage\" method=\"post\" action=\"";
        // line 42
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("login_check");
        echo "\" onsubmit=\"return eccube.checkLoginFormInputted('login_mypage')\" ";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'enctype');
        echo ">
            ";
        // line 43
        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array()), "flashBag", array()), "has", array(0 => "eccube.login.target.path"), "method")) {
            // line 44
            echo "                ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array()), "flashBag", array()), "get", array(0 => "eccube.login.target.path"), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["targetPath"]) {
                // line 45
                echo "                    <input type=\"hidden\" name=\"_target_path\" value=\"";
                echo twig_escape_filter($this->env, $context["targetPath"], "html", null, true);
                echo "\" />
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['targetPath'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 47
            echo "            ";
        }
        // line 48
        echo "            <div id=\"login_box\" class=\"row\">
                <div id=\"mypage_login_wrap\" class=\"col-sm-8 col-sm-offset-2\">
                    <div id=\"mypage_login_box\" class=\"column\">

                        <div id=\"mypage_login_box__body\" class=\"column_inner clearfix\">
                            <div class=\"icon\"><!--<svg class=\"cb cb-user-circle\"><use xlink:href=\"#cb-user-circle\" /></svg>--><img src=\"/user_data/images/user.png\"></div>
                            <div id=\"mypage_login_box__login_email\" class=\"form-group\">
                                ";
        // line 55
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "login_email", array()), 'widget', array("attr" => array("style" => "ime-mode: disabled;", "placeholder" => "メールアドレス", "autofocus" => true)));
        echo "
                            </div>
                            <div id=\"mypage_login_box__login_pass\" class=\"form-group\">
                                ";
        // line 58
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "login_pass", array()), 'widget', array("attr" => array("placeholder" => "パスワード")));
        echo "
                                ";
        // line 59
        if ($this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "option_remember_me", array())) {
            // line 60
            echo "                                    ";
            if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
                // line 61
                echo "                                        <input id=\"mypage_login_box__login_memory\" type=\"hidden\" name=\"login_memory\" value=\"1\">
                                    ";
            } else {
                // line 63
                echo "                                        ";
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "login_memory", array()), 'widget');
                echo "
                                    ";
            }
            // line 65
            echo "                                ";
        }
        // line 66
        echo "                            </div>
                            <div class=\"extra-form form-group\">
                                ";
        // line 68
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "getIterator", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
            // line 69
            echo "                                    ";
            if (preg_match("[^plg*]", $this->getAttribute($this->getAttribute($context["f"], "vars", array()), "name", array()))) {
                // line 70
                echo "                                        ";
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'label');
                echo "
                                        ";
                // line 71
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'widget');
                echo "
                                        ";
                // line 72
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'errors');
                echo "
                                    ";
            }
            // line 74
            echo "                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['f'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 75
        echo "                            </div>
                            ";
        // line 76
        if ((isset($context["error"]) ? $context["error"] : null)) {
            // line 77
            echo "                            <div id=\"mypage_login_box__error_message\" class=\"form-group\">
                                <span class=\"text-danger\">";
            // line 78
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans((isset($context["error"]) ? $context["error"] : null));
            echo "</span>
                            </div>
                            ";
        }
        // line 81
        echo "                            <div id=\"mypage_login__login_button\" class=\"btn_area\">
                                <p><button type=\"submit\" class=\"btn btn-info btn-block btn-lg\">ログイン</button></p>
                                <ul id=\"mypage_login__login_menu\" >
                                    <li><a href=\"";
        // line 84
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("forgot");
        echo "\">ログイン情報をお忘れですか？</a></li>
                                    <li><a href=\"";
        // line 85
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("entry");
        echo "\">新規会員登録</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 92
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderCsrfToken("authenticate"), "html", null, true);
        echo "\">
        </form>
    </div>
";
    }

    public function getTemplateName()
    {
        return "__string_template__a48ceb8ae907136845f75075434b8ff32f68a6b02d6346c87d75de8caae2e8a2";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  177 => 92,  167 => 85,  163 => 84,  158 => 81,  152 => 78,  149 => 77,  147 => 76,  144 => 75,  138 => 74,  133 => 72,  129 => 71,  124 => 70,  121 => 69,  117 => 68,  113 => 66,  110 => 65,  104 => 63,  100 => 61,  97 => 60,  95 => 59,  91 => 58,  85 => 55,  76 => 48,  73 => 47,  64 => 45,  59 => 44,  57 => 43,  51 => 42,  34 => 27,  31 => 26,  27 => 22,  25 => 24,  11 => 22,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__a48ceb8ae907136845f75075434b8ff32f68a6b02d6346c87d75de8caae2e8a2", "");
    }
}
