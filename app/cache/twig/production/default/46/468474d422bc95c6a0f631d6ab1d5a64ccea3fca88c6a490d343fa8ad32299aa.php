<?php

/* __string_template__4b5ec831b784a85e856aa0d416c257cefe74d4c088963bf3a1879ff4440e176a */
class __TwigTemplate_5b20b7dff0e06d17e49f46e67badec235317b0e84d77ef20047905fec31ba64a extends Twig_Template
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
        // line 10
        echo "<style>
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
}
.item_price {
    color: #525263;
    font-weight: bold;
    text-align: center;
    color: #e60d0d;
}
.item_gallery .heading {
  background-color: pink;
    height: 40px;
    line-height: 40px;
    padding-left: 15px;
}
.row1{
padding-bottom:10px;
}
</style>
<!--最近チェックした商品-->
";
        // line 70
        if ((isset($context["checkedItems"]) ? $context["checkedItems"] : null)) {
            // line 71
            echo "<style>
#checkeditem .heading01 {
  background: transparent;
  float:left;
  font-size: 100%;
  text-align: left;
  padding: 0;
  margin: 0;
  line-height: 39px;
  color: white;
}
#checkeditem .heading02 {
  background: transparent;
  font-size: 60%;
  text-align: right;
  padding: 0;
  margin: 0;
}
.heading02 a{
border-radius:0 10px 0 0;
}
#checkeditem .heading {
    padding: 0px;; 
    height: 40px;
    line-height: 40px;
  padding-left:15px;
 background: url(/user_data/bak/bak8.png);
border-radius: 10px 10px 0 0;
    box-shadow: 1px 1px 1px 1px rgba(107, 29, 34, 0.83);
        margin: 0 -14px;
  }
    .heading02 a {
    border-radius: 0 10px 0 0;
    background: transparent;
    border: none;
}
   .h-name{
           color: #8D553A;
           line-height: 18px;
text-align: center;
    }

</style>
<div class=\"container-fluid inner\">
<div id=\"checkeditem\" class=\"item_gallery\">
  ";
            // line 116
            if (((isset($context["delete"]) ? $context["delete"] : null) == 0)) {
                // line 117
                echo "    <div class=\"heading\">
      <p class=\"heading01\"> <img src=\"/user_data/icon/check1.png\">  最近チェックした商品</p>

      <p class=\"heading02\">
        <a href=\"";
                // line 121
                echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("block_checkeditem_delete");
                echo "\" class=\"btn btn-info btn-sm\">履歴を削除</a>
      </p>
    </div>
  ";
            } else {
                // line 125
                echo "    <h4 class=\"heading\">最近チェックした商品</h4>
  ";
            }
            // line 127
            echo "    <div class=\"row\" style=\"clear: both;\">
      ";
            // line 128
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_slice($this->env, (isset($context["checkedItems"]) ? $context["checkedItems"] : null), 0, (isset($context["displayNum"]) ? $context["displayNum"] : null)));
            foreach ($context['_seq'] as $context["_key"] => $context["checkedItem"]) {
                // line 129
                echo "        <div class=\"col-sm-2 col-xs-6\">
            <div class=\"pickup_item\">
                <a href=\"";
                // line 131
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("product_detail", array("id" => $this->getAttribute($context["checkedItem"], "id", array()))), "html", null, true);
                echo "\">
                    <div class=\"item_photo\"><img src=\"";
                // line 132
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "image_save_urlpath", array()), "html", null, true);
                echo "/";
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getNoImageProduct($this->getAttribute($context["checkedItem"], "main_list_image", array())), "html", null, true);
                echo "\" alt=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["checkedItem"], "name", array()), "html", null, true);
                echo "\"></div>
                    <dl>
                      <!--<dt class=\"item_name\">";
                // line 134
                echo twig_escape_filter($this->env, $this->getAttribute($context["checkedItem"], "name", array()), "html", null, true);
                echo "</dt>-->
                        <h4 class=\"h-name\">
                                    <script>
                                    <!--
                                    var x = \"";
                // line 138
                echo twig_escape_filter($this->env, $this->getAttribute($context["checkedItem"], "name", array()), "html", null, true);
                echo "\";
                                    document.write(x.slice(0,18)); //-->
                                    </script>
                                    </h4>
                      <dd class=\"item_price\">
                      ";
                // line 143
                if ($this->getAttribute($context["checkedItem"], "hasProductClass", array())) {
                    // line 144
                    if (($this->getAttribute($context["checkedItem"], "getPrice02Min", array()) == $this->getAttribute($context["checkedItem"], "getPrice02Max", array()))) {
                        // line 145
                        echo "                          <p class=\"normal_price\"><span class=\"price01_default\">";
                        echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($context["checkedItem"], "getPrice02IncTaxMin", array())), "html", null, true);
                        echo "</span></p>
                          ";
                    } elseif (( !(null === $this->getAttribute(                    // line 146
$context["checkedItem"], "getPrice02Min", array())) &&  !(null === $this->getAttribute($context["checkedItem"], "getPrice02Max", array())))) {
                        // line 147
                        echo "                          <p class=\"normal_price\"><span class=\"price01_default\">";
                        echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($context["checkedItem"], "getPrice02IncTaxMin", array())), "html", null, true);
                        echo "</span> ～ <span class=\"price01_default\">";
                        echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($context["checkedItem"], "getPrice02IncTaxMax", array())), "html", null, true);
                        echo "</span></p>
                          ";
                    }
                    // line 149
                    echo "                      ";
                } else {
                    // line 150
                    if ( !(null === $this->getAttribute($context["checkedItem"], "getPrice02Max", array()))) {
                        // line 151
                        echo "                          <p class=\"normal_price\"><span class=\"price01_default\">";
                        echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($context["checkedItem"], "getPrice02IncTaxMin", array())), "html", null, true);
                        echo "</span></p>
                          ";
                    }
                    // line 153
                    echo "                      ";
                }
                // line 154
                echo "</dl>
                </a>
            </div>
</div>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['checkedItem'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 159
            echo "    </div>
    </div>
</div>
";
        }
    }

    public function getTemplateName()
    {
        return "__string_template__4b5ec831b784a85e856aa0d416c257cefe74d4c088963bf3a1879ff4440e176a";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  231 => 159,  221 => 154,  218 => 153,  212 => 151,  210 => 150,  207 => 149,  199 => 147,  197 => 146,  192 => 145,  190 => 144,  188 => 143,  180 => 138,  173 => 134,  164 => 132,  160 => 131,  156 => 129,  152 => 128,  149 => 127,  145 => 125,  138 => 121,  132 => 117,  130 => 116,  83 => 71,  81 => 70,  19 => 10,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__4b5ec831b784a85e856aa0d416c257cefe74d4c088963bf3a1879ff4440e176a", "");
    }
}
