<?php

/* __string_template__e5d624eccc1750b8654d269d9cd5947522711faf28349371a48d016a8a3d6198 */
class __TwigTemplate_12b8b8ba69d608801a673691863bf70a5b11f1491b673dba057eb8d140da3e26 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 22
        echo "<style>
 .member_link a {
height: 30px;
    line-height: 30px;
font-size:12px;
}
.shinnin a{
color:#563924;
    
}
.shinnin a:hover {
    color: #fefeff;
    background: rgba(197, 159, 20, 0.52);
}
.love a {
    color: #563924;
}
.love a:hover {
    color: #fefeff;
    background:rgba(197, 159, 20, 0.52);
}
.login a {
    color: #563924;
}
.login a:hover {
    color: #fefeff;
    background:rgba(197, 159, 20, 0.52);
}
</style>
";
        // line 51
        if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_USER")) {
            // line 52
            echo "    <div id=\"member\" class=\"member drawer_block pc\">
        <ul class=\"member_link\">
         <li class=\"login\">
                <a href=\"";
            // line 55
            echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("logout");
            echo "\">
                    <svg class=\"cb cb-lock-circle\"><use xlink:href=\"#cb-lock-circle\" /></svg>ログアウト
                </a>
            </li>
            <li class=\"shinnin\">
                <a href=\"";
            // line 60
            echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("mypage");
            echo "\">
                    <svg class=\"cb cb-user-circle\"><use xlink:href=\"#cb-user-circle\" /></svg>マイページ
                </a>
            </li>
            ";
            // line 64
            if (($this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "option_favorite_product", array()) == 1)) {
                // line 65
                echo "                <li class=\"love\"><a href=\"";
                echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("mypage_favorite");
                echo "\"><svg class=\"cb cb-heart-circle\"><use xlink:href=\"#cb-heart-circle\"></use></svg>お気に入り</a></li>
            ";
            }
            // line 67
            echo "           
        </ul>
    </div>
";
        } else {
            // line 71
            echo "    <div id=\"member\" class=\"member drawer_block pc\">
        <ul class=\"member_link\">
         <li class=\"login\">
                <a href=\"";
            // line 74
            echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("mypage_login");
            echo "\">
                    <svg class=\"cb cb-lock-circle\"><use xlink:href=\"#cb-lock-circle\" /></svg>ログイン
                </a>
            </li>
            <li class=\"shinnin\">
                <a href=\"";
            // line 79
            echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("entry");
            echo "\" >
                    <svg class=\"cb cb-user-circle\"><use xlink:href=\"#cb-user-circle\" /></svg>新規会員登録
                </a>
            </li>
            ";
            // line 83
            if (($this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "option_favorite_product", array()) == 1)) {
                // line 84
                echo "                <li class=\"love\"><a href=\"";
                echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("mypage_favorite");
                echo "\"><svg class=\"cb cb-heart-circle\"><use xlink:href=\"#cb-heart-circle\"></use></svg>お気に入り</a></li>
            ";
            }
            // line 86
            echo "           
        </ul>
    </div>
";
        }
    }

    public function getTemplateName()
    {
        return "__string_template__e5d624eccc1750b8654d269d9cd5947522711faf28349371a48d016a8a3d6198";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  114 => 86,  108 => 84,  106 => 83,  99 => 79,  91 => 74,  86 => 71,  80 => 67,  74 => 65,  72 => 64,  65 => 60,  57 => 55,  52 => 52,  50 => 51,  19 => 22,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__e5d624eccc1750b8654d269d9cd5947522711faf28349371a48d016a8a3d6198", "");
    }
}
