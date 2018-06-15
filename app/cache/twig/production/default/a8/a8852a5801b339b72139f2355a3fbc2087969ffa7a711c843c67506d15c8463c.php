<?php

/* __string_template__ae4296eb640a83e40ae6c9c8da5a16a13868fee7f886d23a43e229420a634d76 */
class __TwigTemplate_69fda1f50982f6b2fecb63a4b0dc45cefbdac4955b68865971647a549f2a873b extends Twig_Template
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
        // line 9
        echo "
<!-- ▼item_list▼ -->
<div id=\"item_list\">
    <div class=\"row\">
        ";
        // line 13
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["recommend_products"]) ? $context["recommend_products"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["RecommendProduct"]) {
            // line 14
            echo "            <div class=\"col-sm-3 col-xs-6\">
                <div class=\"pickup_item\">
                    <a href=\"";
            // line 16
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("product_detail", array("id" => $this->getAttribute($this->getAttribute($context["RecommendProduct"], "Product", array()), "id", array()))), "html", null, true);
            echo "\">
                        <div class=\"item_photo\"><img src=\"";
            // line 17
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "image_save_urlpath", array()), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getNoImageProduct($this->getAttribute($this->getAttribute($context["RecommendProduct"], "Product", array()), "mainFileName", array())), "html", null, true);
            echo "\"></div>
                        <p class=\"item_comment\" style=\"font-size:12px;padding:0 5px;overflow:hidden;height:57px;\">";
            // line 18
            echo nl2br($this->getAttribute($context["RecommendProduct"], "comment", array()));
            echo "</p>
                        <dl>
                            <!-- <dt class=\"item_name\" style=\"font-weight:bold;margin:0 0 10px;overflow:hidden;\">";
            // line 20
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["RecommendProduct"], "Product", array()), "name", array()), "html", null, true);
            echo "</dt> -->
                            <dd class=\"item_price\">
                                ";
            // line 22
            if ($this->getAttribute($this->getAttribute($context["RecommendProduct"], "Product", array()), "hasProductClass", array())) {
                // line 23
                echo "                                    ";
                if (($this->getAttribute($this->getAttribute($context["RecommendProduct"], "Product", array()), "getPrice02Min", array()) == $this->getAttribute($this->getAttribute($context["RecommendProduct"], "Product", array()), "getPrice02Max", array()))) {
                    // line 24
                    echo "                                        ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($this->getAttribute($context["RecommendProduct"], "Product", array()), "getPrice02IncTaxMin", array())), "html", null, true);
                    echo "
                                    ";
                } else {
                    // line 26
                    echo "                                        ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($this->getAttribute($context["RecommendProduct"], "Product", array()), "getPrice02IncTaxMin", array())), "html", null, true);
                    echo " ～ ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($this->getAttribute($context["RecommendProduct"], "Product", array()), "getPrice02IncTaxMax", array())), "html", null, true);
                    echo "
                                    ";
                }
                // line 28
                echo "                                ";
            } else {
                // line 29
                echo "                                    ";
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($this->getAttribute($context["RecommendProduct"], "Product", array()), "getPrice02IncTaxMin", array())), "html", null, true);
                echo "
                                ";
            }
            // line 31
            echo "                            </dd>
                        </dl>
                    </a>
                </div>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['RecommendProduct'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 37
        echo "    </div>
</div>
<!-- ▲item_list▲ -->";
    }

    public function getTemplateName()
    {
        return "__string_template__ae4296eb640a83e40ae6c9c8da5a16a13868fee7f886d23a43e229420a634d76";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  92 => 37,  81 => 31,  75 => 29,  72 => 28,  64 => 26,  58 => 24,  55 => 23,  53 => 22,  48 => 20,  43 => 18,  37 => 17,  33 => 16,  29 => 14,  25 => 13,  19 => 9,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__ae4296eb640a83e40ae6c9c8da5a16a13868fee7f886d23a43e229420a634d76", "");
    }
}
