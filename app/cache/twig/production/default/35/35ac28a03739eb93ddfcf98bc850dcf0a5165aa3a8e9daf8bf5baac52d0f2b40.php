<?php

/* default_frame.twig */
class __TwigTemplate_2b89fe86300690de5a4d260e59197798f6790e3fce8208a6d14b0d7aa81fad2e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'stylesheet' => array($this, 'block_stylesheet'),
            'main' => array($this, 'block_main'),
            'javascript' => array($this, 'block_javascript'),
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
        if ((array_key_exists("subtitle", $context) &&  !twig_test_empty((isset($context["subtitle"]) ? $context["subtitle"] : null)))) {
            echo twig_escape_filter($this->env, (isset($context["subtitle"]) ? $context["subtitle"] : null), "html", null, true);
            echo " | ";
        } elseif ((array_key_exists("title", $context) &&  !twig_test_empty((isset($context["title"]) ? $context["title"] : null)))) {
            echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
            echo " | ";
        }
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "shop_name", array()), "html", null, true);
        echo "</title>
";
        // line 28
        if ( !twig_test_empty($this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "author", array()))) {
            // line 29
            echo "    <meta name=\"author\" content=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "author", array()), "html", null, true);
            echo "\">
";
        }
        // line 31
        if ( !twig_test_empty($this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "description", array()))) {
            // line 32
            echo "    <meta name=\"description\" content=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "description", array()), "html", null, true);
            echo "\">
";
        }
        // line 34
        if ( !twig_test_empty($this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "keyword", array()))) {
            // line 35
            echo "    <meta name=\"keywords\" content=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "keyword", array()), "html", null, true);
            echo "\">
";
        }
        // line 37
        if ( !twig_test_empty($this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "meta_robots", array()))) {
            // line 38
            echo "    <meta name=\"robots\" content=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "meta_robots", array()), "html", null, true);
            echo "\">
";
        }
        // line 40
        echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
<link rel=\"icon\" href=\"";
        // line 41
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "front_urlpath", array()), "html", null, true);
        echo "/img/common/favicon.ico\">
<link rel=\"stylesheet\" href=\"";
        // line 42
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "front_urlpath", array()), "html", null, true);
        echo "/css/style.css?v=";
        echo twig_escape_filter($this->env, twig_constant("Eccube\\Common\\Constant::VERSION"), "html", null, true);
        echo "\">
<link rel=\"stylesheet\" href=\"";
        // line 43
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "front_urlpath", array()), "html", null, true);
        echo "/css/slick.css?v=";
        echo twig_escape_filter($this->env, twig_constant("Eccube\\Common\\Constant::VERSION"), "html", null, true);
        echo "\">
<link rel=\"stylesheet\" href=\"";
        // line 44
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "front_urlpath", array()), "html", null, true);
        echo "/css/default.css?v=";
        echo twig_escape_filter($this->env, twig_constant("Eccube\\Common\\Constant::VERSION"), "html", null, true);
        echo "\">
<link rel=\"stylesheet\" href=\"";
        // line 45
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "user_data_urlpath", array()), "html", null, true);
        echo "/css/mystyle.css?v=";
        echo twig_escape_filter($this->env, twig_constant("Eccube\\Common\\Constant::VERSION"), "html", null, true);
        echo "\">
";
        // line 47
        echo "<link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "user_data_urlpath", array()), "html", null, true);
        echo "/css/slick.css?v=";
        echo twig_escape_filter($this->env, twig_constant("Eccube\\Common\\Constant::VERSION"), "html", null, true);
        echo "\">
";
        // line 49
        echo "<!-- for original theme CSS -->
";
        // line 50
        $this->displayBlock('stylesheet', $context, $blocks);
        // line 51
        echo "<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src=\"https://www.googletagmanager.com/gtag/js?id=UA-99760934-1\"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-99760934-1');
</script>
<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js\"></script>
<script>window.jQuery || document.write('<script src=\"";
        // line 61
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "front_urlpath", array()), "html", null, true);
        echo "/js/vendor/jquery-1.11.3.min.js?v=";
        echo twig_escape_filter($this->env, twig_constant("Eccube\\Common\\Constant::VERSION"), "html", null, true);
        echo "\"><\\/script>')</script>
";
        // line 63
        echo "<script src=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "user_data_urlpath", array()), "html", null, true);
        echo "/js/slick.min.js?v=";
        echo twig_escape_filter($this->env, twig_constant("Eccube\\Common\\Constant::VERSION"), "html", null, true);
        echo "\"></script>
";
        // line 65
        echo "
";
        // line 67
        if ($this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "Head", array())) {
            // line 68
            echo "    ";
            // line 69
            echo "    ";
            echo twig_include($this->env, $context, "block.twig", array("Blocks" => $this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "Head", array())));
            echo "
    ";
        }
        // line 73
        echo "
</head>
<body id=\"page_";
        // line 75
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "get", array(0 => "_route"), "method"), "html", null, true);
        echo "\" class=\"";
        echo twig_escape_filter($this->env, ((array_key_exists("body_class", $context)) ? (_twig_default_filter((isset($context["body_class"]) ? $context["body_class"] : null), "other_page")) : ("other_page")), "html", null, true);
        echo "\">
<div id=\"wrapper\">
    <header id=\"header\">
        <div class=\"container-fluid inner\">
            ";
        // line 80
        echo "            ";
        if ($this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "Header", array())) {
            // line 81
            echo "                ";
            // line 82
            echo "                ";
            echo twig_include($this->env, $context, "block.twig", array("Blocks" => $this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "Header", array())));
            echo "
                ";
            // line 84
            echo "            ";
        }
        // line 85
        echo "            ";
        // line 86
        echo "            <p id=\"btn_menu\"><a class=\"nav-trigger\" href=\"#nav\">Menu<span></span></a></p>
        </div>
    </header>

    <div id=\"contents\" class=\"";
        // line 90
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "theme", array()), "html", null, true);
        echo "\">

        <div id=\"contents_top\">
            ";
        // line 94
        echo "            ";
        if ($this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "ContentsTop", array())) {
            // line 95
            echo "                ";
            // line 96
            echo "                ";
            echo twig_include($this->env, $context, "block.twig", array("Blocks" => $this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "ContentsTop", array())));
            echo "
                ";
            // line 98
            echo "            ";
        }
        // line 99
        echo "            ";
        // line 100
        echo "        </div>

        <div class=\"container-fluid inner\">
            ";
        // line 104
        echo "            ";
        if ($this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "SideLeft", array())) {
            // line 105
            echo "                <div id=\"side_left\" class=\"side\">
                    ";
            // line 107
            echo "                    ";
            echo twig_include($this->env, $context, "block.twig", array("Blocks" => $this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "SideLeft", array())));
            echo "
                    ";
            // line 109
            echo "                </div>
            ";
        }
        // line 111
        echo "            ";
        // line 112
        echo "
            <div id=\"main\">
                ";
        // line 115
        echo "                ";
        if ($this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "MainTop", array())) {
            // line 116
            echo "                    <div id=\"main_top\">
                        ";
            // line 117
            echo twig_include($this->env, $context, "block.twig", array("Blocks" => $this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "MainTop", array())));
            echo "
                    </div>
                ";
        }
        // line 120
        echo "                ";
        // line 121
        echo "
                <div id=\"main_middle\">
                    ";
        // line 123
        $this->displayBlock('main', $context, $blocks);
        // line 124
        echo "                </div>

                ";
        // line 127
        echo "                ";
        if ($this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "MainBottom", array())) {
            // line 128
            echo "                    <div id=\"main_bottom\">
                        ";
            // line 129
            echo twig_include($this->env, $context, "block.twig", array("Blocks" => $this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "MainBottom", array())));
            echo "
                    </div>
                ";
        }
        // line 132
        echo "                ";
        // line 133
        echo "            </div>

            ";
        // line 136
        echo "            ";
        if ($this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "SideRight", array())) {
            // line 137
            echo "                <div id=\"side_right\" class=\"side\">
                    ";
            // line 139
            echo "                    ";
            echo twig_include($this->env, $context, "block.twig", array("Blocks" => $this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "SideRight", array())));
            echo "
                    ";
            // line 141
            echo "                </div>
            ";
        }
        // line 143
        echo "            ";
        // line 144
        echo "
            ";
        // line 146
        echo "            ";
        if ($this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "ContentsBottom", array())) {
            // line 147
            echo "                <div id=\"contents_bottom\">
                    ";
            // line 149
            echo "                    ";
            echo twig_include($this->env, $context, "block.twig", array("Blocks" => $this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "ContentsBottom", array())));
            echo "
                    ";
            // line 151
            echo "                </div>
            ";
        }
        // line 153
        echo "            ";
        // line 154
        echo "
        </div>

        <footer id=\"footer\">
            ";
        // line 159
        echo "            ";
        if ($this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "Footer", array())) {
            // line 160
            echo "                ";
            // line 161
            echo "                ";
            echo twig_include($this->env, $context, "block.twig", array("Blocks" => $this->getAttribute((isset($context["PageLayout"]) ? $context["PageLayout"] : null), "Footer", array())));
            echo "
                ";
            // line 163
            echo "            ";
        }
        // line 164
        echo "            ";
        // line 165
        echo "
        </footer>

    </div>

    <div id=\"drawer\" class=\"drawer sp\">
    </div>

</div>

<div class=\"overlay\"></div>

<script src=\"";
        // line 177
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "front_urlpath", array()), "html", null, true);
        echo "/js/vendor/bootstrap.custom.min.js?v=";
        echo twig_escape_filter($this->env, twig_constant("Eccube\\Common\\Constant::VERSION"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 178
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "front_urlpath", array()), "html", null, true);
        echo "/js/vendor/slick.min.js?v=";
        echo twig_escape_filter($this->env, twig_constant("Eccube\\Common\\Constant::VERSION"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 179
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "front_urlpath", array()), "html", null, true);
        echo "/js/function.js?v=";
        echo twig_escape_filter($this->env, twig_constant("Eccube\\Common\\Constant::VERSION"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 180
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "front_urlpath", array()), "html", null, true);
        echo "/js/eccube.js?v=";
        echo twig_escape_filter($this->env, twig_constant("Eccube\\Common\\Constant::VERSION"), "html", null, true);
        echo "\"></script>
<script>
\$(function () {
    \$('#drawer').append(\$('.drawer_block').clone(true).children());
    \$.ajax({
        url: '";
        // line 185
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "front_urlpath", array()), "html", null, true);
        echo "/img/common/svg.html',
        type: 'GET',
        dataType: 'html',
    }).done(function(data){
        \$('body').prepend(data);
    }).fail(function(data){
    });
});
</script>
";
        // line 194
        $this->displayBlock('javascript', $context, $blocks);
        // line 195
        echo "</body>
</html>
";
    }

    // line 50
    public function block_stylesheet($context, array $blocks = array())
    {
    }

    // line 123
    public function block_main($context, array $blocks = array())
    {
    }

    // line 194
    public function block_javascript($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "default_frame.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  408 => 194,  403 => 123,  398 => 50,  392 => 195,  390 => 194,  378 => 185,  368 => 180,  362 => 179,  356 => 178,  350 => 177,  336 => 165,  334 => 164,  331 => 163,  326 => 161,  324 => 160,  321 => 159,  315 => 154,  313 => 153,  309 => 151,  304 => 149,  301 => 147,  298 => 146,  295 => 144,  293 => 143,  289 => 141,  284 => 139,  281 => 137,  278 => 136,  274 => 133,  272 => 132,  266 => 129,  263 => 128,  260 => 127,  256 => 124,  254 => 123,  250 => 121,  248 => 120,  242 => 117,  239 => 116,  236 => 115,  232 => 112,  230 => 111,  226 => 109,  221 => 107,  218 => 105,  215 => 104,  210 => 100,  208 => 99,  205 => 98,  200 => 96,  198 => 95,  195 => 94,  189 => 90,  183 => 86,  181 => 85,  178 => 84,  173 => 82,  171 => 81,  168 => 80,  159 => 75,  155 => 73,  149 => 69,  147 => 68,  145 => 67,  142 => 65,  135 => 63,  129 => 61,  117 => 51,  115 => 50,  112 => 49,  105 => 47,  99 => 45,  93 => 44,  87 => 43,  81 => 42,  77 => 41,  74 => 40,  68 => 38,  66 => 37,  60 => 35,  58 => 34,  52 => 32,  50 => 31,  44 => 29,  42 => 28,  31 => 27,  25 => 23,  22 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "default_frame.twig", "/home/kir021669/public_html/vings.jp/app/template/default/default_frame.twig");
    }
}
