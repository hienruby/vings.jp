<?php

/* __string_template__504647339bd808ea66455bc24c16f98e82beb78ad3dc08841f2544944ccd8e7f */
class __TwigTemplate_bf065d6f8396d2ae884ad907581b83ecb806e66cc8143f67e813cee8ea31e657 extends Twig_Template
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
        echo "<style>
@media only screen and (max-width: 767px){
.search input[type=\"search\"] {
    height: 38px;
}
.search {
    position: relative;
    height: 38px;
    padding: 0 62px 0 14px;
    margin-bottom: 15px;
    background: #fff;
    overflow: hidden;
}
 #search {
        padding: 0;
        margin: 10px 0 2px 0;
border: 1px solid rgb(255, 109, 3);
        background: rgba(255, 255, 255, 0);

    }
.extra-form {
    margin: 0;
}
.bt_search {
height: 40px;
    background: rgb(255, 109, 3);
    margin: 0;
}
.bt_search .cb-search {
     fill: #ffffff;
    font-size: 25px;
    font-size: 2.5rem;
    line-height: 30px;
    padding-right: 0px;
}
#search select {
     width: 400px;
    max-width: 250px;
}
.search select {
    height: 30px;
    font-size:12px;
}
.search .input_search {
    height: 30px;
    padding: 0 50px 0 1em;
    border-bottom: 1px solid #ccc;
    position: relative;
    margin-left: 1%;
}
.search input[type=\"search\"] {
    display: block;
    width: 100%;
    padding: 12px 0;
    border: 0;
    outline: none;
    border-radius: 0;
    font-size: 14px;
}
    .newslist dt .cb {
        font-size: 15px;
        top: 1px;
        left: 3px;
    }
    .search select {
        height: 30px;
    }
    .search .bt_search {
        margin-top: 0;
    }
    .search .input_search {
        border-bottom:none;
    }
   
     #category_id{display:none;}
    .calendar_title, #s8_wellcome, #sales_ranking, .calendar1, .ninki{
        display:none;
    }
    .theme_side_left #main {
        padding-top: 0px;
    }
    .text-success small, .text-info small{
        float:right;
        width:100%;
        padding-right:0;
        margin-right: 100px;
    }
    .category-nav {
        clear: both;
        display:none;
    }
    .banner{display:none;}
    .blockmenu {
        display:none;
        padding-bottom: -30px;
        clear: both;
        position: relative;
        width: 340px;
    }
    .slide{
        display:none;
    }
}
@media only screen and (min-width: 767px){
#search select {
    width: 300px;
    max-width: 230px;
}
#header #searchform select, #header #searchform input {
    float: left;
    font-size: 12px;
    padding-left: 1%;
}
.search select {
    height: 30px;
padding:0;
width: 300px;
    max-width: 300px;
  }
.search input[type=\"search\"] {
    height: 30px;}
.search .input_search {
    height: 30px;
    padding: 0 30px 0 1em;}
.bt_search {
    width: 30px;
    height: 30px;
}
.bt_search .cb-search {
    fill: #636378;
    font-size: 20px;
}
}

</style>
<script>
(function(\$){
  \$(window).on('load',function(){
    \$('.header_bottom_area #category_id option').each(function(){
      var text = \$(this).text();
      var result = text.substr( 0, 1 );
  
      if ( result.match(/　/) ){
        \$(this).remove();
      }
    });
  });
})(jQuery);
</script>
<div class=\"drawer_block1 pc1 header_bottom_area\">
    <div id=\"search\" class=\"search\">
        <form method=\"get\" id=\"searchform\" action=\"";
        // line 152
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPath("product_list");
        echo "\">
            <div class=\"search_inner\">
                ";
        // line 154
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "category_id", array()), 'widget');
        echo "
                <div class=\"input_search clearfix\">
                    ";
        // line 156
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "name", array()), 'widget', array("attr" => array("placeholder" => "キーワードを入力")));
        echo "
                    <button type=\"submit\" class=\"bt_search\"><svg class=\"cb cb-search\"><use xlink:href=\"#cb-search\" /></svg></button>
                </div>
            </div>
            <div class=\"extra-form\">
                ";
        // line 161
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "getIterator", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
            // line 162
            echo "                    ";
            if (preg_match("[^plg*]", $this->getAttribute($this->getAttribute($context["f"], "vars", array()), "name", array()))) {
                // line 163
                echo "                        ";
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'label');
                echo "
                        ";
                // line 164
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'widget');
                echo "
                        ";
                // line 165
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'errors');
                echo "
                    ";
            }
            // line 167
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['f'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 168
        echo "            </div>
        </form>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "__string_template__504647339bd808ea66455bc24c16f98e82beb78ad3dc08841f2544944ccd8e7f";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  217 => 168,  211 => 167,  206 => 165,  202 => 164,  197 => 163,  194 => 162,  190 => 161,  182 => 156,  177 => 154,  172 => 152,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__504647339bd808ea66455bc24c16f98e82beb78ad3dc08841f2544944ccd8e7f", "");
    }
}
