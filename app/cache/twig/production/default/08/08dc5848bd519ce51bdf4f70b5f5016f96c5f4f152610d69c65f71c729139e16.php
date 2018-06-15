<?php

/* Block/freeship.twig */
class __TwigTemplate_8be6d5365c31cf5b962b04c60057ebfafebbb3fc64654ec459ef7626b30faec9 extends Twig_Template
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
        echo "<div class=\"tag\">
<img src=\"/user_data/images/Freesyusei.png\">
</div>
<style>
@media only screen and (max-width: 767px){
.tag{display:none;}
}
</style>";
    }

    public function getTemplateName()
    {
        return "Block/freeship.twig";
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
        return new Twig_Source("", "Block/freeship.twig", "/home/kir021669/public_html/vings.jp/app/template/default/Block/freeship.twig");
    }
}
