<?php

/* __string_template__069f48699fa85e8933d652cf3f2bf1dd6a762e9902a231f375340bcae6ced784 */
class __TwigTemplate_8fea272449c2d170da685459ea26ab8fb83093419cd9fb4e75ae4fa965960ef7 extends Twig_Template
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
@media only screen and (max-width: 767px){
.category-nav4{display:none;}
}
@media only screen and (min-width: 767px){
.category-nav4 li ul {display:none;}
.category-nav4 {width:100%;
height:auto;
padding: 0;
}
.category-nav4 li:nth-child(n+7) {
display: none!important;
}
.category-nav4 li{
display:inline-block;
background: rgba(24, 166, 137, 0.77);
}
.category-nav4 li:nth-child(1){
background:url(/user_data/images/iconall300b.png);
background-size: 60px 60px;
background-repeat:no-repeat;
background-position:center top;
}
.category-nav4 li:nth-child(2){
background:url(/user_data/images/anime1.png);
background-size: 60px 60px;
background-repeat:no-repeat;
background-position:center top;
}
.category-nav4 li:nth-child(3){
background:url(/user_data/images/bocaloid1.png);
background-size: 60px 60px;
background-repeat:no-repeat;
background-position:center top;
}
.category-nav4 li:nth-child(4){
background:url(/user_data/images/disney1.png);
background-size: 60px 60px;
background-repeat:no-repeat;
background-position:center top;
}
.category-nav4 li:nth-child(5){
background:url(/user_data/images/queen1.png);
background-size: 60px 60px;
background-repeat:no-repeat;
background-position:center top;
}
.category-nav4 li:nth-child(6){
background:url(/user_data/images/whig1.png);
background-size: 60px 60px;
background-repeat:no-repeat;
background-position:center top;
}

.category-nav4 li a {
    line-height: 20px;
    color: black;
 font-size: 8px;
    display: block;
    text-align: bottom;
    height: auto;
text-align:center;
padding-top: 60px;
}
.category-nav4 li:nth-child(1) a{
     color: #cc0985;
}
.category-nav4 li:nth-child(2) a{
    color: #ff006c;
}
.category-nav4 li:nth-child(3) a{
     color: #066f23;
}
.category-nav4 li:nth-child(4) a{
           color: #8e761a;
}
.category-nav4 li:nth-child(5) a{
     color: #136968;
}
.category-nav4 li:nth-child(6) a{
   color: #7200ff;
}

.category-nav4 li a:hover {text-decoration: underline;}
.st_category{
padding:0;
}
</style>
<div class=\"col-sm-8 st_category\">

";
        // line 109
        echo "            <ul class=\"category-nav4\">
            <li class=\"col-sm-2 col-xs-4\"><a href=\"http://vings.jp/products/list?category_id=&name=\">全ての商品</a></li>
              ";
        // line 111
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["Categories"]) ? $context["Categories"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["Category"]) {
            // line 112
            echo "              ";
            echo $this->getAttribute($this, "tree", array(0 => $context["Category"]), "method");
            echo "
              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 114
        echo "
            </ul>
</div>";
    }

    // line 91
    public function gettree($__Category__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "Category" => $__Category__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 92
            if (($this->getAttribute((isset($context["Category"]) ? $context["Category"] : null), "id", array()) != 199)) {
                // line 93
                echo "            <li class=\"col-sm-2 col-xs-4 \" style=\"height=auto;\">
                <a href=\"";
                // line 94
                echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("product_list");
                echo "?category_id=";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Category"]) ? $context["Category"] : null), "id", array()), "html", null, true);
                echo "\">
                    ";
                // line 95
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Category"]) ? $context["Category"] : null), "name", array()), "html", null, true);
                echo "
                </a>
                <span class=\"trigger\"></span>
              ";
                // line 98
                if ((twig_length_filter($this->env, $this->getAttribute((isset($context["Category"]) ? $context["Category"] : null), "children", array())) > 0)) {
                    // line 99
                    echo "                <ul>

                  ";
                    // line 101
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["Category"]) ? $context["Category"] : null), "children", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["ChildCategory"]) {
                        // line 102
                        echo "                    ";
                        echo $this->getAttribute($this, "tree", array(0 => $context["ChildCategory"]), "method");
                        echo "
                  ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ChildCategory'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 104
                    echo "                </ul>
              ";
                }
                // line 106
                echo "            </li>
\t\t\t";
            }
            // line 108
            echo "            ";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "__string_template__069f48699fa85e8933d652cf3f2bf1dd6a762e9902a231f375340bcae6ced784";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  190 => 108,  186 => 106,  182 => 104,  173 => 102,  169 => 101,  165 => 99,  163 => 98,  157 => 95,  151 => 94,  148 => 93,  146 => 92,  134 => 91,  128 => 114,  119 => 112,  115 => 111,  111 => 109,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__069f48699fa85e8933d652cf3f2bf1dd6a762e9902a231f375340bcae6ced784", "");
    }
}
