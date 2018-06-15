<?php

/* Block/tag.twig */
class __TwigTemplate_1289fde7cd9bc7a500308a427f06f571c7f4582b10b68e8ad409d0cac351921a extends Twig_Template
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
.tag{
padding:0;
}
.tag ul li{
display:inline-block;
}
.tag ul li a {
    padding: 4px 5px 0 7px !important;
    font-size: 8.7pt !important;
}
.tag ul li a {
    background: none repeat scroll 0 0 #d3d6d8;
    border-bottom-right-radius: 4px;
    border-top-right-radius: 4px;
    color:black;
    display: inline-block;
    font-size: 9pt !important;
    height: 24px;
   margin: 5px 5px;
    padding: 4px 10px 0 12px;
    position: relative;
    text-decoration: none;
}
.tag ul li a:before {
    border-color: transparent#d3d6d8 transparent transparent;
    border-style: solid;
    border-width: 12px 12px 12px 0;
    content: \"\";
    float: left;
    height: 0;
  left: -12px;
  position: absolute;
    top: 0;
    width: 0;
}
.tag ul li a:after {
    background: none repeat scroll 0 0 #fff;
    border-radius: 2px;
    box-shadow: -1px -1px 2px #004977;
    content: \"\";
    float: left;
    height: 4px;
    left: 0;
    position: absolute;
    top: 10px;
    width: 4px;
}
@media only screen and (max-width: 767px){
.tag{display:none;}
}
</style>
<div class=\"tag col-sm-4 col-xs-12\">
<b>商品のタグ：</b>
<ul>
<li><a href=\"http://vings.jp/products/list?category_id=25\">
            英雄伝説
        </a></li>\t
<li>
        <a href=\"http://vings.jp/products/list?category_id=31\">
            黒執事
        </a>
            </li>
<li><a href=\"http://vings.jp/products/list?category_id=24\">
            凪のあすから
        </a></li>
<li>
        <a href=\"http://vings.jp/products/list?category_id=29\">
            銀魂
        </a>
            </li>

<li>
        <a href=\"http://vings.jp/products/list?category_id=54\">
            妖怪ウォッチ
        </a>
            </li>
<li>
        <a href=\"http://vings.jp/products/list?category_id=53\">
            デビルメイクライ
        </a>
            </li>
<li>
        <a href=\"http://vings.jp/products/list?category_id=59\">
            白雪姫
        </a>
            </li>
</ul>
</div>";
    }

    public function getTemplateName()
    {
        return "Block/tag.twig";
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
        return new Twig_Source("", "Block/tag.twig", "/home/kir021669/public_html/vings.jp/app/template/default/Block/tag.twig");
    }
}
