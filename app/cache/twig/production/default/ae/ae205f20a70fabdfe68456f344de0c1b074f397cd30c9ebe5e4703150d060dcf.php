<?php

/* Block/plg_shiro8_new_product_block.twig */
class __TwigTemplate_07708998de456687fd545954a58ef7387a21fff7398aa6ff632456f72c3a5d13 extends Twig_Template
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
        echo "<!-- ▼shiro8_new_product▼ -->
<style>
.pickup_item {
margin-top:5px;
padding:5px;
}
.container-fluid1{
    padding-left: 16px;
    padding-right: 16px;
}
.inner {
    max-width: 980px;
}
.container-fluid1 {
    margin-left: auto;
    margin-right: auto;
    padding-left: 8px;
    padding-right: 8px;
}
.item_gallery {
    clear: both;
}
.pickup_item{
   box-shadow: 0px 0px 6px 3px #bbbcbb;
-moz-box-shadow:0px 0px 6px 3px #5bd7c8;
 -webkit-box-shadow: 1px 1px 6px 2px rgb(195, 183, 183);

/* border-radius */
border-radius:6px;
-moz-border-radius:6px;
-webkit-border-radius:6px;
/* border */
}
.item_photo {
    padding:10px 10px  0px 10px;
}
.item_name {
    color: #525263;
    margin: 0 0 8px;
    text-align: center;
    overflow: hidden;
    width: 100%;
    padding: 0 10px;
    height: 55px;
    text-overflow: ellipsis;
}
.item_price {
    color: #525263;
    font-weight: bold;
    text-align: center;
    color: #e60d0d;
}
.row1{
padding-bottom:10px;
}
#contents_top{
    clear: both;
}
.heading01 {
    background: transparent;
    float: left;
    font-size: 100%;
    text-align: left;
    padding: 0;
    margin: 0;
    line-height: 39px;
    color: white;
}
.heading {
    padding: 0px;
    height: 40px;
    line-height: 40px;
    padding-left: 15px;
    background: url(/user_data/bak/bak8.png);
    border-radius: 10px 10px 0 0;
    box-shadow: 1px 1px 1px 1px rgba(107, 29, 34, 0.83);
    margin: 0;
}
</style>
<div class=\"row\">
<div id=\"contents_top\" class=\"col-md-12\">
 <div class=\"heading\">
      <p class=\"heading01\"> <img src=\"/user_data/icon/check1.png\"> 新しい商品</p>
      </p>
    </div>
    <div id=\"item_list\">
        <div class=\"row\">
            ";
        // line 109
        if ((twig_length_filter($this->env, (isset($context["Products"]) ? $context["Products"] : null)) > 0)) {
            // line 110
            echo "                ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["Products"]) ? $context["Products"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["Product"]) {
                // line 111
                echo "                    <div class=\"col-sm-2 col-xs-6\">
                        <div class=\"pickup_item\">
                            <a href=\"";
                // line 113
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("product_detail", array("id" => $this->getAttribute($context["Product"], "id", array()))), "html", null, true);
                echo "\">
                                <div class=\"item_photo\">
                                    <img src=\"";
                // line 115
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "image_save_urlpath", array()), "html", null, true);
                echo "/";
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getNoImageProduct($this->getAttribute($context["Product"], "main_list_image", array())), "html", null, true);
                echo "\" alt=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["Product"], "name", array()), "html", null, true);
                echo "\">
                                </div>
                                ";
                // line 117
                if ($this->getAttribute($context["Product"], "description_list", array())) {
                    // line 118
                    echo "                                    <p class=\"item_comment text-warning\">";
                    echo nl2br($this->getAttribute($context["Product"], "description_list", array()));
                    echo "</p>
                                ";
                }
                // line 120
                echo "                                <dl>
                                    <!--<dt class=\"item_name\">";
                // line 121
                echo twig_escape_filter($this->env, $this->getAttribute($context["Product"], "name", array()), "html", null, true);
                echo "</dt>-->
                                     <h4 class=\"h-name\">
                                    <script>
                                    <!--
                                    var x = \"";
                // line 125
                echo twig_escape_filter($this->env, $this->getAttribute($context["Product"], "name", array()), "html", null, true);
                echo "\";
                                    document.write(x.slice(0,18)); //-->
                                    </script>
                                    </h4>
                                    
                                    ";
                // line 130
                if ($this->getAttribute($context["Product"], "hasProductClass", array())) {
                    // line 131
                    echo "                                        ";
                    if (($this->getAttribute($context["Product"], "getPrice02Min", array()) == $this->getAttribute($context["Product"], "getPrice02Max", array()))) {
                        // line 132
                        echo "                                            <dd class=\"item_price\">";
                        echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($context["Product"], "getPrice02IncTaxMin", array())), "html", null, true);
                        echo "</dd>
                                        ";
                    } else {
                        // line 134
                        echo "                                            <dd class=\"item_price\">";
                        echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($context["Product"], "getPrice02IncTaxMin", array())), "html", null, true);
                        echo " ～ ";
                        echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($context["Product"], "getPrice02IncTaxMax", array())), "html", null, true);
                        echo "</dd>
                                        ";
                    }
                    // line 136
                    echo "                                    ";
                } else {
                    // line 137
                    echo "                                        <dd class=\"item_price\">";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($context["Product"], "getPrice02IncTaxMin", array())), "html", null, true);
                    echo "</dd>
                                    ";
                }
                // line 139
                echo "                                    
                                </dl>
                            </a>
                        </div>
                    </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Product'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 145
            echo "            ";
        }
        // line 146
        echo "        </div>
    </div>
</div>
</div>
<!-- ▲shiro8_new_product▲ -->";
    }

    public function getTemplateName()
    {
        return "Block/plg_shiro8_new_product_block.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  201 => 146,  198 => 145,  187 => 139,  181 => 137,  178 => 136,  170 => 134,  164 => 132,  161 => 131,  159 => 130,  151 => 125,  144 => 121,  141 => 120,  135 => 118,  133 => 117,  124 => 115,  119 => 113,  115 => 111,  110 => 110,  108 => 109,  19 => 22,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "Block/plg_shiro8_new_product_block.twig", "/home/kir021669/public_html/vings.jp/app/template/default/Block/plg_shiro8_new_product_block.twig");
    }
}
