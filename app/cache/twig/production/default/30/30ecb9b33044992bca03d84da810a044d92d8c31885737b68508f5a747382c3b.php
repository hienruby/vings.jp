<?php

/* Block/banner.twig */
class __TwigTemplate_c2f3790fa649442428d488e67474e0b0b15c9dc2eab06f2f21ef715d28c7c20c extends Twig_Template
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
        echo "<div class=\"line-block\"></div>
<style>
.line-block{
height:5px;
background: #6a3e29;
background-size:5px;
}
</style>
<link rel=\"stylesheet\" type=\"text/css\" href=\"/user_data/css/custom.css\">";
    }

    public function getTemplateName()
    {
        return "Block/banner.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "Block/banner.twig", "/home/kir021669/public_html/vings.jp/app/template/default/Block/banner.twig");
    }
}
