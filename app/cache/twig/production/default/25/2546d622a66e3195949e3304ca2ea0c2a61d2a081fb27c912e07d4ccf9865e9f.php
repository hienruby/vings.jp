<?php

/* Block/plg_shiro8_gallary_block.twig */
class __TwigTemplate_8df078062f7f45bca4a257000208bbc487d13093ccae3c8d29db8ff782ba6faf extends Twig_Template
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
        echo "<!-- ▼shiro8_gallary▼ -->
<style>
@media only screen and (max-width: 770px){
.product_lf{
display:none;
}
}
</style>
<div class=product_lf>
<div class=\"item_gallary\" style=\"clear:both;\">
    <ul class=\"row\">
    ";
        // line 33
        if ((twig_length_filter($this->env, (isset($context["Products"]) ? $context["Products"] : null)) > 0)) {
            // line 34
            echo "      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["Products"]) ? $context["Products"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["Product"]) {
                // line 35
                echo "        <li class=\"col-sm-12 col-xs-12\">
          <a href=\"";
                // line 36
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("product_detail", array("id" => $this->getAttribute($context["Product"], "id", array()))), "html", null, true);
                echo "\" class=\"item_photo\">
            <img src=\"";
                // line 37
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "image_save_urlpath", array()), "html", null, true);
                echo "/";
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getNoImageProduct($this->getAttribute($context["Product"], "main_list_image", array())), "html", null, true);
                echo "\" alt=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["Product"], "name", array()), "html", null, true);
                echo "\"></a>
  <!-- <dt class=\"item_name\">";
                // line 38
                echo twig_escape_filter($this->env, $this->getAttribute($context["Product"], "name", array()), "html", null, true);
                echo "</dt>-->
 <dt class=\"item_name\" style=\"color: rgba(107, 29, 34, 0.83);\"><h4><script>
                                    <!--
                var x = \"";
                // line 41
                echo twig_escape_filter($this->env, $this->getAttribute($context["Product"], "name", array()), "html", null, true);
                echo "\";
            document.write(x.slice(0,45)); //-->
            </script></h4></dt>
        </li>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Product'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 46
            echo "    ";
        }
        // line 47
        echo "    </ul>
</div>
</div>
<!-- ▲shiro8_gallary▲ -->";
    }

    public function getTemplateName()
    {
        return "Block/plg_shiro8_gallary_block.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  74 => 47,  71 => 46,  60 => 41,  54 => 38,  46 => 37,  42 => 36,  39 => 35,  34 => 34,  32 => 33,  19 => 22,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "Block/plg_shiro8_gallary_block.twig", "/home/kir021669/public_html/vings.jp/app/template/default/Block/plg_shiro8_gallary_block.twig");
    }
}
