<?php

/* Block/recommendify3_product_block.twig */
class __TwigTemplate_2ed8b49a3e4328c0f22e2075ebe157b9245418eb6be108f7cc1dc4a5fe2864aa extends Twig_Template
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
        // line 14
        echo "<script src=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "user_data_urlpath", array()), "html", null, true);
        echo "/js/owl.carousel.min.js\"></script>
<link rel=\"stylesheet\" href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "user_data_urlpath", array()), "html", null, true);
        echo "/css/owl.carousel.min.css?v=";
        echo twig_escape_filter($this->env, twig_constant("Eccube\\Common\\Constant::VERSION"), "html", null, true);
        echo "\">
<link rel=\"stylesheet\" href=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "user_data_urlpath", array()), "html", null, true);
        echo "/css/owl.theme.min.css?v=";
        echo twig_escape_filter($this->env, twig_constant("Eccube\\Common\\Constant::VERSION"), "html", null, true);
        echo "\">
<script>
    \$(function(){
        \$('.owl-carousel').owlCarousel({
            responsive: true,
            items : 6,
        });
    });
</script>

<h4 class=\"recommendify\">";
        // line 26
        if ( !twig_test_empty((isset($context["Recommendify3Products"]) ? $context["Recommendify3Products"] : null))) {
            echo "この商品を買った人はこんな商品も買っています";
        }
        echo "</h4>
<div class=\"owl-carousel\">
    ";
        // line 28
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["Recommendify3Products"]) ? $context["Recommendify3Products"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["Product"]) {
            // line 29
            echo "    <div class=\"item\">
        <a href=\"";
            // line 30
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("product_detail", array("id" => $this->getAttribute($context["Product"], "id", array()))), "html", null, true);
            echo "\">
            <div class=\"item_photo\">
                <img src=\"";
            // line 32
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "image_save_urlpath", array()), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getNoImageProduct($this->getAttribute($context["Product"], "main_list_image", array())), "html", null, true);
            echo "\">
            </div>
            <dl>
                <dt class=\"item_name\">";
            // line 35
            echo twig_escape_filter($this->env, $this->getAttribute($context["Product"], "name", array()), "html", null, true);
            echo "</dt>
                ";
            // line 36
            if ($this->getAttribute($context["Product"], "description_list", array())) {
                // line 37
                echo "                <dd class=\"item_comment\">";
                echo nl2br($this->getAttribute($context["Product"], "description_list", array()));
                echo "</dd>
                ";
            }
            // line 39
            echo "                ";
            if ($this->getAttribute($context["Product"], "hasProductClass", array())) {
                // line 40
                echo "                ";
                if (($this->getAttribute($context["Product"], "getPrice02Min", array()) == $this->getAttribute($context["Product"], "getPrice02Max", array()))) {
                    // line 41
                    echo "                <dd class=\"item_price\">
                    ";
                    // line 42
                    echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($context["Product"], "getPrice02IncTaxMin", array())), "html", null, true);
                    echo "
                </dd>
                ";
                } else {
                    // line 45
                    echo "                <dd class=\"item_price\">
                    ";
                    // line 46
                    echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($context["Product"], "getPrice02IncTaxMin", array())), "html", null, true);
                    echo " ～ ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($context["Product"], "getPrice02IncTaxMax", array())), "html", null, true);
                    echo "
                </dd>
                ";
                }
                // line 49
                echo "                ";
            } else {
                // line 50
                echo "                <dd class=\"item_price\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($context["Product"], "getPrice02IncTaxMin", array())), "html", null, true);
                echo "</dd>
                ";
            }
            // line 52
            echo "            </dl>
        </a>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Product'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 56
        echo "
</div>";
    }

    public function getTemplateName()
    {
        return "Block/recommendify3_product_block.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  128 => 56,  119 => 52,  113 => 50,  110 => 49,  102 => 46,  99 => 45,  93 => 42,  90 => 41,  87 => 40,  84 => 39,  78 => 37,  76 => 36,  72 => 35,  64 => 32,  59 => 30,  56 => 29,  52 => 28,  45 => 26,  30 => 16,  24 => 15,  19 => 14,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "Block/recommendify3_product_block.twig", "/home/kir021669/public_html/vings.jp/app/template/default/Block/recommendify3_product_block.twig");
    }
}
