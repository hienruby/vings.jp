<?php

/* SiteMap/Resource/template/sitemap.twig */
class __TwigTemplate_dec83482b1d9b595c682e23558e1910d7625c79173f4288f376969d13f6fb4cb extends Twig_Template
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
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>

<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">
";
        // line 13
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["Items"]) ? $context["Items"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["Item"]) {
            // line 14
            echo "    <url>
        <loc>";
            // line 15
            echo twig_escape_filter($this->env, $this->getAttribute($context["Item"], "loc", array()), "html", null, true);
            echo "</loc>
        <lastmod>";
            // line 16
            echo twig_escape_filter($this->env, $this->getAttribute($context["Item"], "lastmod", array()), "html", null, true);
            echo "</lastmod>
        <changefreq>";
            // line 17
            echo twig_escape_filter($this->env, (isset($context["changefreq"]) ? $context["changefreq"] : null), "html", null, true);
            echo "</changefreq>
        <priority>";
            // line 18
            echo twig_escape_filter($this->env, (isset($context["priority"]) ? $context["priority"] : null), "html", null, true);
            echo "</priority>
    </url>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 21
        echo "</urlset>";
    }

    public function getTemplateName()
    {
        return "SiteMap/Resource/template/sitemap.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 21,  43 => 18,  39 => 17,  35 => 16,  31 => 15,  28 => 14,  24 => 13,  19 => 10,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "SiteMap/Resource/template/sitemap.twig", "/home/kir021669/public_html/vings.jp/app/Plugin/SiteMap/Resource/template/sitemap.twig");
    }
}
