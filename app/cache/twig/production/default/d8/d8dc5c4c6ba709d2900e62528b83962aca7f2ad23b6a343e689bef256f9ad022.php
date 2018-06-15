<?php

/* __string_template__0470f33e4fb2c639df63e0c7d3f4f71fdb7afa1c980a613b7fe34ebf9bafdccd */
class __TwigTemplate_a8b74f3599f4ae2310fab9d6e60e939bb68615f768b7b2d938d712be08a4179f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("default_frame.twig", "__string_template__0470f33e4fb2c639df63e0c7d3f4f71fdb7afa1c980a613b7fe34ebf9bafdccd", 1);
        $this->blocks = array(
            'javascript' => array($this, 'block_javascript'),
            'main' => array($this, 'block_main'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "default_frame.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["body_class"] = "front_page";
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_javascript($context, array $blocks = array())
    {
        // line 6
        echo "<script>
\$(function(){
    \$('.main_visual').slick({
        dots: true,
        arrows: false,
        autoplay: true,
        speed: 300
    });
});
</script>
";
    }

    // line 18
    public function block_main($context, array $blocks = array())
    {
        // line 19
        echo "<script src=\"/user_data/js/java_top\"></script>
<style>
.jssorb01{position:absolute}.jssorb01 div,.jssorb01 div:hover,.jssorb01 .av{position:absolute;width:12px;height:12px;filter:alpha(opacity=70);opacity:.7;overflow:hidden;cursor:pointer;border:#000 1px solid}.jssorb01 div{background-color:gray}.jssorb01 div:hover,.jssorb01 .av:hover{background-color:#d3d3d3}.jssorb01 .av{background-color:#fff}.jssorb01 .dn,.jssorb01 .dn:hover{background-color:#555}.jssora05l,.jssora05r{display:block;position:absolute;width:40px;height:40px;cursor:pointer;overflow:hidden}.jssora05l{background-position:-10px -40px}.jssora05r{background-position:-70px -40px}.jssora05l:hover{background-position:-130px -40px}.jssora05r:hover{background-position:-190px -40px}.jssora05l.jssora05ldn{background-position:-250px -40px}.jssora05r.jssora05rdn{background-position:-310px -40px}.jssora05l.jssora05lds{background-position:-10px -40px;opacity:.3;pointer-events:none}.jssora05r.jssora05rds{background-position:-70px -40px;opacity:.3;pointer-events:none}
/* #jssor_1{height: 300px !important;} */
</style>

<div id=\"jssor_1\" style=\"position:relative;margin:0 auto;top:0px;left:0px;width:600px;height:230px;overflow:hidden;visibility:hidden;\">
<!-- Loading Screen -->
<div data-u=\"loading\" style=\"position:absolute;top:0px;left:0px;background-color:rgba(0,0,0,0.7);\">
<div style=\"filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;\"></div>
<div style=\"position:absolute;display:block;background:url('/user_data/images/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;\"></div>
</div>
<div data-u=\"slides\" style=\"cursor:default;position:relative;top:0px;left:0px;width:600px;height:230px;overflow:hidden;\">
<div>
<a href=\"http://vings.jp/products/detail/61\"><img data-u=\"image\" src=\"/user_data/groupnew/vings-170622yql-01s.jpg\"  alt=\"\"/></a>
</div>
<div>
<a href=\"http://vings.jp/products/detail/66\"><img data-u=\"image\" src=\"/user_data/groupnew/vings-170623yql-02s.jpg\" alt=\"\" /></a>
</div>
<div>
<a href=\"http://vings.jp/products/detail/43\"><img data-u=\"image\" src=\"/user_data/groupnew/vings-170623yql-03s.jpg\" alt=\"\" /></a>
</div>
<div>
<a href=\"http://vings.jp/products/detail/62\"><img data-u=\"image\" src=\"/user_data/groupnew/vings-170623yql-04s.jpg\" alt=\"\" /></a>
</div>
<div>
<a href=\"http://vings.jp/products/detail/44\"><img data-u=\"image\" src=\"/user_data/groupnew/vings-170623yql-05s.jpg\" alt=\"\" /></a>
</div>
</div>
<!-- Bullet Navigator -->
<div data-u=\"navigator\" class=\"jssorb01\" style=\"bottom:16px;right:16px;\">
<div data-u=\"prototype\" style=\"width:12px;height:12px;\"></div>
</div>
<!-- Arrow Navigator -->
<span data-u=\"arrowleft\" class=\"jssora05l\" style=\"top:0px;left:8px;width:40px;height:40px;\" data-autocenter=\"2\"></span>
<span data-u=\"arrowright\" class=\"jssora05r\" style=\"top:0px;right:8px;width:40px;height:40px;\" data-autocenter=\"2\"></span>
</div>
<script type=\"text/javascript\">jssor_1_slider_init();</script>
<!-- #endregion Jssor Slider End -->

";
    }

    public function getTemplateName()
    {
        return "__string_template__0470f33e4fb2c639df63e0c7d3f4f71fdb7afa1c980a613b7fe34ebf9bafdccd";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 19,  49 => 18,  35 => 6,  32 => 5,  28 => 1,  26 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__0470f33e4fb2c639df63e0c7d3f4f71fdb7afa1c980a613b7fe34ebf9bafdccd", "");
    }
}
