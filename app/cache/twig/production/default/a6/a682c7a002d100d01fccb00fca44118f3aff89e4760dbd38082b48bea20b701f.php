<?php

/* Point/Resource/template/default/Event/Cart/point_box_no_customer.twig */
class __TwigTemplate_9b20d9bf51a8bae41ff75231645eb3da1dd44d04cef28509bd9f0bbab2270457 extends Twig_Template
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
        echo "<p id=\"cart_item__point_info\" class=\"message\">
    ポイント制度をご利用になられる場合は、会員登録後ログインしてくださいますようお願い致します。<br/>
    ポイントは商品購入時に1pt＝<strong class=\"text-primary\">";
        // line 3
        echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute((isset($context["point"]) ? $context["point"] : null), "rate", array())), "html", null, true);
        echo "</strong>として利用することができます。
</p>

";
    }

    public function getTemplateName()
    {
        return "Point/Resource/template/default/Event/Cart/point_box_no_customer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "Point/Resource/template/default/Event/Cart/point_box_no_customer.twig", "/home/kir021669/public_html/vings.jp/app/Plugin/Point/Resource/template/default/Event/Cart/point_box_no_customer.twig");
    }
}
