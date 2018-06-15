<?php

/* __string_template__0e73cda1dec02d4b124edb6326c7e757f751fde2e9dce66607edf74ffc1a52ba */
class __TwigTemplate_8bd4253b32deccddc6b1675241db8032af0a23478160ae3e615e4fa7ac2b12dc extends Twig_Template
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
        // line 1
        echo "<!doctype html>
";
        // line 23
        echo "<html lang=\"ja\">
<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <title>";
        // line 27
        echo twig_escape_filter($this->env, (isset($context["error_title"]) ? $context["error_title"] : null), "html", null, true);
        echo " - EC-CUBE管理画面</title>
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <link rel=\"icon\" href=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "admin_urlpath", array()), "html", null, true);
        echo "/assets/img/favicon.ico\">
    <link rel=\"stylesheet\" href=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "admin_urlpath", array()), "html", null, true);
        echo "/assets/css/bootstrap.min.css?v=";
        echo twig_escape_filter($this->env, twig_constant("Eccube\\Common\\Constant::VERSION"), "html", null, true);
        echo "\">
    <link rel=\"stylesheet\" href=\"";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "admin_urlpath", array()), "html", null, true);
        echo "/assets/css/dashboard.css?v=";
        echo twig_escape_filter($this->env, twig_constant("Eccube\\Common\\Constant::VERSION"), "html", null, true);
        echo "\">
    <!--[if lt IE 9]>
    <script src=\"https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js\"></script>
    <script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>
    <![endif]-->

</head>
<body>

    <!-- ▼ #main ▼ -->
    <div id=\"main\">
        <div class=\"container-fluid\">
            <div class=\"message_box\">
                <div class=\"row no-padding\">
                    <div class=\"col-sm-6 col-sm-offset-3\">
                        <div class=\"icon\"><svg class=\"cb cb-warning\"><use xlink:href=\"#cb-warning\" /></svg></div>
                        <h1>";
        // line 49
        echo twig_escape_filter($this->env, (isset($context["error_title"]) ? $context["error_title"] : null), "html", null, true);
        echo "</h1>
                        <p>";
        // line 50
        echo twig_escape_filter($this->env, (isset($context["error_message"]) ? $context["error_message"] : null), "html", null, true);
        echo "</p>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"btn_group col-sm-offset-4 col-sm-4\">
                        <a href=\"";
        // line 55
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("admin_homepage");
        echo "\"><p><button type=\"button\" class=\"btn btn-info btn-block\">ログインページへ</button></p></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ▲ #main ▲ -->


<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js\"></script>
<script>window.jQuery || document.write('<script src=\"";
        // line 65
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "admin_urlpath", array()), "html", null, true);
        echo "/assets/js/vendor/jquery-1.11.3.min.js?v=";
        echo twig_escape_filter($this->env, twig_constant("Eccube\\Common\\Constant::VERSION"), "html", null, true);
        echo "\"><\\/script>')</script>
<script src=\"";
        // line 66
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "admin_urlpath", array()), "html", null, true);
        echo "/assets/js/function.js?v=";
        echo twig_escape_filter($this->env, twig_constant("Eccube\\Common\\Constant::VERSION"), "html", null, true);
        echo "\"></script>
<script>
    \$(function () {
        \$.ajax({
            url: '";
        // line 70
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "admin_urlpath", array()), "html", null, true);
        echo "/assets/img/svg.html',
            type: 'GET',
            dataType: 'html',
        }).done(function(data){
            \$('body').prepend(data);
        }).fail(function(data){
        });
    });
</script>

</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "__string_template__0e73cda1dec02d4b124edb6326c7e757f751fde2e9dce66607edf74ffc1a52ba";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  106 => 70,  97 => 66,  91 => 65,  78 => 55,  70 => 50,  66 => 49,  45 => 33,  39 => 32,  35 => 31,  28 => 27,  22 => 23,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__0e73cda1dec02d4b124edb6326c7e757f751fde2e9dce66607edf74ffc1a52ba", "");
    }
}
