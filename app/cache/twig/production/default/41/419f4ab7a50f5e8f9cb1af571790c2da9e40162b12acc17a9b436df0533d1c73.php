<?php

/* SocialButton/Resource/template/buttons.twig */
class __TwigTemplate_5e74c8b2653931ce47272c9320121d319ddaf73485adba215e32d2b9fd866af8 extends Twig_Template
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
        echo "<style>.sns{text-align:left;}.sns > li{display: inline-block;vertical-align:top;margin:0 7px;}.sns > li:first-child {margin-left: 0;}.sns > li:last-child {margin-right: 0;}.sns iframe {margin: 0 !important;}@media screen and (max-width: 200px){.sns > li{width: 70px !important;margin: 0 7px 10px 0;}}</style>
<ul class=\"sns\"><li
class=\"fb\"><div class=\"fb-like\" data-layout=\"button_count\" data-action=\"like\" data-show-faces=\"true\" data-share=\"true\"></div></li><li
class=\"twitter\"><a href=\"https://twitter.com/share\" class=\"twitter-share-button\">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
</li><li
><script type=\"text/javascript\" src=\"//media.line.me/js/line-button.js?v=20140411\" ></script><script type=\"text/javascript\">new media_line_me.LineButton({\"pc\":true,\"lang\":\"ja\",\"type\":\"a\"});</script></li><li
><a href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getUri", array(), "method"), "html", null, true);
        echo "\" class=\"hatena-bookmark-button\" data-hatena-bookmark-layout=\"simple-balloon\" title=\"このエントリーをはてなブックマークに追加\"><img src=\"https://b.st-hatena.com/images/entry-button/button-only@2x.png\" alt=\"このエントリーをはてなブックマークに追加\" width=\"20\" height=\"20\" style=\"border: none;\" /></a><script type=\"text/javascript\" src=\"https://b.st-hatena.com/js/bookmark_button.js\" charset=\"utf-8\" async=\"async\"></script></li><li
class=\"gplus\"><div style=\"vertical-align: bottom; line-height: 0; overflow-x: hidden; display:inline;\"><div class=\"g-plusone\" data-size=\"medium\" style=\"\"></div></div></li></ul><div id=\"fb-root\"></div><script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id;js.src = \"//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.6\";fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>
<script src=\"https://apis.google.com/js/platform.js\" async defer>{lang: 'ja'}</script>";
    }

    public function getTemplateName()
    {
        return "SocialButton/Resource/template/buttons.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  27 => 7,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "SocialButton/Resource/template/buttons.twig", "/home/kir021669/public_html/vings.jp/app/Plugin/SocialButton/Resource/template/buttons.twig");
    }
}
