<?php

/* Shiro8FreeShippingDisplay3/Resource/template/plg_shiro8_free_shipping.twig */
class __TwigTemplate_3052dfede84c813902ccba75390551087dcea1a7d48ffc195d40f34eba4e82d3 extends Twig_Template
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
        echo "<!-- ▼shiro8_free_shipping▼ -->
";
        // line 23
        if ((twig_length_filter($this->env, $this->getAttribute((isset($context["Cart"]) ? $context["Cart"] : null), "CartItems", array())) > 0)) {
            // line 24
            echo "<p id=\"cart_item__info\" class=\"message\">
    商品の合計金額は「<strong>";
            // line 25
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute((isset($context["Cart"]) ? $context["Cart"] : null), "total_price", array())), "html", null, true);
            echo "</strong>」です。
    ";
            // line 26
            if (($this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "delivery_free_amount", array()) && $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "delivery_free_quantity", array()))) {
                // line 27
                echo "        <br />
        ";
                // line 28
                if ((isset($context["is_delivery_free"]) ? $context["is_delivery_free"] : null)) {
                    // line 29
                    echo "            現在送料無料です。
        ";
                } else {
                    // line 31
                    echo "            あと「<strong>";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter((isset($context["least"]) ? $context["least"] : null)), "html", null, true);
                    echo "</strong>」または「<strong>";
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["quantity"]) ? $context["quantity"] : null)), "html", null, true);
                    echo "個</strong>」のお買い上げで<strong class=\"text-primary\">送料無料</strong>になります。
        ";
                }
                // line 33
                echo "    ";
            } elseif ($this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "delivery_free_amount", array())) {
                // line 34
                echo "        <br />
        ";
                // line 35
                if ((isset($context["is_delivery_free"]) ? $context["is_delivery_free"] : null)) {
                    // line 36
                    echo "            現在送料無料です。
        ";
                } else {
                    // line 38
                    echo "            あと「<strong>";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter((isset($context["least"]) ? $context["least"] : null)), "html", null, true);
                    echo "</strong>」のお買い上げで<strong class=\"text-primary\">送料無料</strong>になります。
        ";
                }
                // line 40
                echo "    ";
            } elseif ($this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "delivery_free_quantity", array())) {
                // line 41
                echo "        <br />
        ";
                // line 42
                if ((isset($context["is_delivery_free"]) ? $context["is_delivery_free"] : null)) {
                    // line 43
                    echo "            現在送料無料です。
        ";
                } else {
                    // line 45
                    echo "            あと「<strong>";
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["quantity"]) ? $context["quantity"] : null)), "html", null, true);
                    echo "個</strong>」のお買い上げで<strong class=\"text-primary\">送料無料</strong>になります。
        ";
                }
                // line 47
                echo "    ";
            }
            // line 48
            echo "</p>
";
        }
        // line 50
        echo "<!-- ▲shiro8_free_shipping▲ -->";
    }

    public function getTemplateName()
    {
        return "Shiro8FreeShippingDisplay3/Resource/template/plg_shiro8_free_shipping.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 50,  89 => 48,  86 => 47,  80 => 45,  76 => 43,  74 => 42,  71 => 41,  68 => 40,  62 => 38,  58 => 36,  56 => 35,  53 => 34,  50 => 33,  42 => 31,  38 => 29,  36 => 28,  33 => 27,  31 => 26,  27 => 25,  24 => 24,  22 => 23,  19 => 22,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "Shiro8FreeShippingDisplay3/Resource/template/plg_shiro8_free_shipping.twig", "/home/kir021669/public_html/vings.jp/app/Plugin/Shiro8FreeShippingDisplay3/Resource/template/plg_shiro8_free_shipping.twig");
    }
}
