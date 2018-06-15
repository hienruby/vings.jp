<?php

/* Block/share.twig */
class __TwigTemplate_6f13bdf2ef2df162880ea85a7a08978a9fe8448767fc288a497bf513239a641d extends Twig_Template
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
        echo "<style type=\"text/css\">
.share-facebook:hover {
    background-position: 0 -40px;
}
.share-twitter:hover {
    background-position: -40px -40px;
}
.share-googleplus:hover {
    background-position: -120px -40px;
}
.share-linkedin:hover {
    background-position: -240px -40px;
}
.share-stumbleupon:hover {
    background-position: -360px -40px;
}
.share-pinterest:hover {
    background-position: -80px -40px;
}
.share-email:hover {
    background-position: -320px -40px;
}
.share-facebook {
background-position: 0 0;
}
.share-twitter {
    background-position: -40px 0;
}
.share-googleplus {
    background-position: -120px 0;
}
.share-linkedin {
    background-position: -240px 0;
}
.share-stumbleupon {
    background-position: -360px 0;
}
.share-pinterest {
    background-position: -80px 0;
}
.share-email {
    background-position: -320px 0;
}
.share-icon {
    display: inline-block;
    float: left;
    margin: 4px;
    width: 32px;
    height: 32px;
    cursor: pointer;
    vertical-align: middle;
    background-image: url(/user_data/icon/share-icons.png);
}
.share-icons-sidebar {
    position: fixed;
    display: block;
    top: 110px;
    left: 0;
    width: 40px;
    height: 240px;
}
@media only screen and (min-width: 768px){
.h-share{position: absolute;
    display: block;
    bottom: 30px;
    width: 280px;
    right: 40%;
    height: 40px;
}}
@media only screen and (max-width: 768px){
.h-share{
position: absolute;
    display: block;
    bottom: 30px;
    left: 1%;
}}
</style>
<div class=\"h-share\">
<a class=\"share-icon share-facebook\" target=\"_blank\" href=\"http://www.facebook.com/sharer.php?u=http://vings.jp/\" title=\"Share on Facebook\"></a>
        <a class=\"share-icon share-twitter\" target=\"_blank\" href=\"http://twitter.com/share?url=http://vings.jp/\" title=\"Share on Twitter\"></a>
        <a class=\"share-icon share-googleplus\" target=\"_blank\" href=\"https://plus.google.com/share?url=http://vings.jp/\" title=\"Share on Google Plus\"></a>
        <a class=\"share-icon share-linkedin\" target=\"_blank\" href=\"http://www.linkedin.com/shareArticle?mini=true&amp;url=http://vings.jp/\" title=\"Share on LinkedIn\"></a>
        <a class=\"share-icon share-stumbleupon\" target=\"_blank\" href=\"http://www.stumbleupon.com/submit?url=http://vings.jp/\" title=\"Share on StumbleUpon\"></a>
        <a class=\"share-icon share-pinterest\" target=\"_blank\" href=\"http://pinterest.com/pin/create/button/?url=http://vings.jp/\" title=\"Share on Pinterst\"></a>
        <a class=\"share-icon share-email\" target=\"_blank\" href=\"mailto:?Subject=Jssor%20Slider&amp;Body=Highly%20recommended%20JavaScript%20jQuery%20Image%20Slider/Slideshow/Carousel/Gallery/Banner%20html%20TOUCH%20SWIPE%20Responsive%20http://vings.jp/\" title=\"Share by Email\"></a>
            </div>";
    }

    public function getTemplateName()
    {
        return "Block/share.twig";
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
        return new Twig_Source("", "Block/share.twig", "/home/kir021669/public_html/vings.jp/app/template/default/Block/share.twig");
    }
}
