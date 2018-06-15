<?php

/* __string_template__ebb8480a6a8d0bae3cd561ab9753cc176460209d686464b82f917f43182c0fe3 */
class __TwigTemplate_c3e18742b2c0b8429fa495ce75f60575cb397ccd1827f121832975d839bc0e47 extends Twig_Template
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
        echo "
<!--売上ランキング-->
";
        // line 12
        if ((isset($context["ItemList"]) ? $context["ItemList"] : null)) {
            // line 13
            echo "<style>
.normal_price {
    padding: 0px;
    margin: 0px;
}
.front_page #contents .row > div {
     padding-bottom: 3px;
}
#sales_ranking .heading03 {
  background: url(\"/user_data/bak/ranking.png\");
color: #fff;
margin-top:0px;
    height: 35px;
    line-height: 35px;
    padding-left: 40px;
font-size: 13px;
border-radius: 5px 5px 0 0;
    box-shadow: 1px 1px 1px 1px rgba(107, 29, 34, 0.83);
text-align:left;
}
#sales_ranking .heading03 img {opacity: .7;}
#sales_ranking .item_name span {
  color: #fff;
  padding: 0.2em 0.7em;
  margin-right: 1em;
}
#checkeditem .heading {
    padding: 0px;
    height: 40px;
    line-height: 40px;
    padding-left: 15px;
    background-color: pink;
    border-radius: 10px 10px 0 0;
    box-shadow: 1px 1px 1px 1px rgba(107, 29, 34, 0.83);
}
item_gallery h4 {
    background: transparent;
    float: left;
    font-size: 100%;
    text-align: left;
    padding: 0;
    margin: 0;
    line-height: 39px;
}
.ec-ur img {
    width: 70%;
}
.ec-ur{margin:0;
padding:0;
margin-bottom: 5px;
}
#sales_ranking .item_photo{
padding:0;
}
#sales_ranking {
    margin:0;
   box-shadow: 0 0 5px rgba(0,0,0,.2);
    border-radius: 0px;
    border: solid 1px #dcdada;
    border-top: none;
background: url(\"/user_data/bak/bak4.png\");
}
.rank{
padding:0;
margin:0;
}
#sales_ranking .item_name {
 color: #8D553A;
    margin: 0 0 8px;
    text-align: center;
    overflow: hidden;
    width: 100%;
    text-overflow: normal;
    white-space: normal;
    padding: 0 20px;
    font-weight: bold;
line-height: 20px;
    margin: 0;
}
.ichi .rank:first-child li{
background:url(\"/user_data/bak/1s.png\");
background-size: 40px 30px;
    background-repeat: no-repeat;
    height: 30px;
    display: block;
      background-position: top center;
    margin-bottom: 3px;
}
.ichi .rank:nth-child(2) li{
background:url(\"/user_data/bak/2s.png\");
background-size: 40px 30px;
    background-repeat: no-repeat;
    height: 30px;
    display: block;
      background-position:  top center;
    margin-bottom: 3px;
}
.ichi .rank:nth-child(3) li{
background:url(\"/user_data/bak/3s1.png\");
    background-size: 70px 50px;
    background-repeat: no-repeat;
    height: 40px;
    display: block;
      background-position: top center;
    margin-bottom: 3px;
}
.ichi .rank:first-child li a, .ichi .rank:nth-child(2) li a, .ichi .rank:nth-child(3) li a{
display:none;
}
</style>

<div id=\"sales_ranking\" class=\"item_gallery\">
    <h3 class=\"heading03\"> 売上ランキング</h3>
    <div class=\"row ichi\">
      ";
            // line 127
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["ItemList"]) ? $context["ItemList"] : null));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            foreach ($context['_seq'] as $context["_key"] => $context["Item"]) {
                if ($this->getAttribute($context["Item"], "belongsToCategory", array(0 => 10), "method")) {
                    // line 128
                    echo "\t  ";
                    if (($this->getAttribute($context["loop"], "index0", array()) < 3)) {
                        // line 129
                        echo "        <div class=\"col-sm-12 col-xs-4 rank\">
            <div class=\"pickup_item1\">
           <li> <a>";
                        // line 131
                        echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                        echo "位</a></li>
                <a href=\"";
                        // line 132
                        echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("product_detail", array("id" => $this->getAttribute($context["Item"], "id", array()))), "html", null, true);
                        echo "\">
                    <div class=\"item_photo ec-ur\"><img src=\"";
                        // line 133
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "image_save_urlpath", array()), "html", null, true);
                        echo "/";
                        echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getNoImageProduct($this->getAttribute($context["Item"], "main_list_image", array())), "html", null, true);
                        echo "\" alt=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["Item"], "name", array()), "html", null, true);
                        echo "\"></div>
                    <dl>
                      <dt class=\"item_name\"><h4>";
                        // line 135
                        echo twig_escape_filter($this->env, $this->getAttribute($context["Item"], "name", array()), "html", null, true);
                        echo "</h4></dt>
                      <dd class=\"item_price\">
                      ";
                        // line 137
                        if ($this->getAttribute($context["Item"], "hasProductClass", array())) {
                            // line 138
                            if (($this->getAttribute($context["Item"], "getPrice02Min", array()) == $this->getAttribute($context["Item"], "getPrice02Max", array()))) {
                                // line 139
                                echo "                          <p class=\"normal_price\"><span class=\"price01_default\">";
                                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($context["Item"], "getPrice02IncTaxMin", array())), "html", null, true);
                                echo "</span></p>
                          ";
                            } elseif (( !(null === $this->getAttribute(                            // line 140
$context["Item"], "getPrice02Min", array())) &&  !(null === $this->getAttribute($context["Item"], "getPrice02Max", array())))) {
                                // line 141
                                echo "                          <p class=\"normal_price\"><span class=\"price01_default\"> ";
                                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($context["Item"], "getPrice02IncTaxMin", array())), "html", null, true);
                                echo "</span> ～ <span class=\"price01_default\"> ";
                                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($context["Item"], "getPrice02IncTaxMax", array())), "html", null, true);
                                echo "</span></p>
                          ";
                            }
                            // line 143
                            echo "                      ";
                        } else {
                            // line 144
                            if ( !(null === $this->getAttribute($context["Item"], "getPrice02Max", array()))) {
                                // line 145
                                echo "                          <p class=\"normal_price\"><span class=\"price01_default\">";
                                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($context["Item"], "getPrice02IncTaxMin", array())), "html", null, true);
                                echo "</span></p>
                          ";
                            }
                            // line 147
                            echo "                      ";
                        }
                        // line 148
                        echo "</dl>
                </a>
            </div>
          </div>
\t\t  ";
                    }
                    // line 153
                    echo "      ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 154
            echo "    </div>
</div>
";
        }
    }

    public function getTemplateName()
    {
        return "__string_template__ebb8480a6a8d0bae3cd561ab9753cc176460209d686464b82f917f43182c0fe3";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  231 => 154,  221 => 153,  214 => 148,  211 => 147,  205 => 145,  203 => 144,  200 => 143,  192 => 141,  190 => 140,  185 => 139,  183 => 138,  181 => 137,  176 => 135,  167 => 133,  163 => 132,  159 => 131,  155 => 129,  152 => 128,  141 => 127,  25 => 13,  23 => 12,  19 => 10,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__ebb8480a6a8d0bae3cd561ab9753cc176460209d686464b82f917f43182c0fe3", "");
    }
}
