<?php

/* Block/footer.twig */
class __TwigTemplate_25c5ebe59603786f64fbd0ad3da5321e34c8ae5b5ac85a7084e9660d54aa1507 extends Twig_Template
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
.payment{
text-align:center;
}
.ft-footer{
padding-top:20px;
}
.footer_logo_area {
margin-top:0px;
}
#footer {
margin:0;
padding:0;
font-size:13px;
border-top:none;
background: linear-gradient(to bottom,#f9f0e5 , #FCF8EF);
}
#footer ul li {
margin: 0;
padding: 5px;
text-align:left;
}
#footer a:hover{
color:red;
}
#footer a {
  color: #593c28;
    font-weight: bold;
}
.ft-last {
text-align:center;
}
.ft-last li {
    clear: both;
    display: inline-block;
    margin: 0 10px;
}
.copyright{
clear:both;
display:block;
text-align:center;
padding-top:30px;
}
@media only screen and (max-width: 767px){
.ft-last{width:100%;
 border: 1px solid #dcdada;
border-radius:5px;
margin-top:5px;
text-align:left;
}
.ft-last li{
display:block;
border-bottom: 1px solid #dcdada;
line-height:30px;
}
.ft-last li:last-child {
border-bottom:none;
}
.ft-last li a{
color:black;
padding-left:8px;
display:block;
}
#footer a {
    color: #5b5c5f;
}
.ft-last li a:after{
content:\"►\";
float:right;
padding-right: 16px;
}
}
</style>
<div class=\"container-fluid inner\">
<div class=\"row\">
<div class=\"col-sm-12 ft-footer\">
<div class=\"ft-last\">
<li><a href=\"";
        // line 78
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("help_about");
        echo "\"><img src=\"/user_data/images/external-browser.png\">  当サイトについて</a></li>
<li ><a href=\"";
        // line 79
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("help_privacy");
        echo "\"><img src=\"/user_data/images/documents-security.png\">   プライバシーポリシー</a></li>
<li><a href=\"";
        // line 80
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("help_tradelaw");
        echo "\"> <img src=\"/user_data/images/layers.png\">   特定商取引法に基づく表記</a></li>
<li><a href=\"http://vings.jp/user_data/faq\"> <img src=\"/user_data/icon/question.png\">  よくあるご質問</a></li>
<li><a href=\"";
        // line 82
        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("contact");
        echo "\"> <img src=\"/user_data/images/speech-bubble.png\">   お問い合わせ</a></li>
</div>
</div>
</div>
<div class=\"payment\">
<img src=\"/user_data/images/payment.png\">
</div>
<p class=\"copyright\">
<span>copyright (c) ";
        // line 90
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "shop_name", array()), "html", null, true);
        echo " all rights reserved.</span>
</p>
</div>";
    }

    public function getTemplateName()
    {
        return "Block/footer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  122 => 90,  111 => 82,  106 => 80,  102 => 79,  98 => 78,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "Block/footer.twig", "/home/kir021669/public_html/vings.jp/app/template/default/Block/footer.twig");
    }
}
