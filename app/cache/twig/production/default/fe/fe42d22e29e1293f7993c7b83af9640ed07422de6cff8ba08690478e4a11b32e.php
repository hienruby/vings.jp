<?php

/* Block/logo.twig */
class __TwigTemplate_6cab3bdf3766a69ebc4d1aa4ceae5746e9bbe5b5e25902f139d068f515dfa998 extends Twig_Template
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
        echo "<div class=\"header_logo_area\">
               <a href=\"";
        // line 2
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("homepage");
        echo "\"><img src=\"/user_data/images/logo1.png\"></a>
            </div>
<style>

h4{
color: #8D553A;
margin:0;
}
.form-control {
    width: 100%;
    height: 35px;
    padding: 0 8px;
}
.btn-info {
    color: #fff;
    background-color: #ff6d03;
    border-color: #ff6d03;
}
body{
font: 14px \"Arial\",\"MS Gothic\";
}
#contents {
    min-height: 0;
}
#header .inner {
    position: relative;
background:url(\"/user_data/bak/bak4.png\");
}
#header{
    background-image: linear-gradient(to bottom, #ff7333 , #ea8d5c);
}
#contents{
background: linear-gradient(to bottom, #ea8d5c , #FCF8EF);
}
.inner {
  background:#fff;
}
.btn {
    font-size: 14px;
    padding: 5px 10px;
    font-weight: bold;
}
.complete_message .heading01 {
    font-size: 18px;
}
.page-heading {
    font-size: 16px;
    border-bottom-style: solid;
    border-top: 0 none;
    padding: 16px 0 12px;
    margin: 0 16px 48px;
}
.heading02 {
    font-size: 16px;
    font-weight: bold;
    background: #EFEFEF;
    padding: 8px 12px;
}
#side_left {
    padding-right: 10px;
}
.header_logo_area {
    position: relative;
     z-index: 0; 
    min-height: 54px;
}
#header {
height: auto;
padding-top: 0px; 
}
#contents {
    padding-top: 0;
}
.header_logo_area a img{
width:50%;
}
body,#header, #contents{
font-size:14px;
color:#563924;
}
#header .header_bottom_area {
padding:0;
}
.btn-info {
    border-radius: 5px;
}
  .btn-primary {
    border-radius: 5px;
}
</style>";
    }

    public function getTemplateName()
    {
        return "Block/logo.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "Block/logo.twig", "/home/kir021669/public_html/vings.jp/app/template/default/Block/logo.twig");
    }
}
