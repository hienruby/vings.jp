<?php

/* __string_template__429744979300b1e1bac4a9cec828eac8939fccf10299a38b600c75ce0f9d6cf3 */
class __TwigTemplate_9fe0393acfff2419f721487dd2bd06e2110f100ae896bc736e4db005d82ea5ef extends Twig_Template
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
@media only screen and (min-width: 767px){
.category-nav3{display:none;}
}
@media only screen and (max-width: 767px){
.category-nav3 li ul{display:none;}
.category-nav3 {width:100%;
height:auto;}
.category-nav3 li{
display:inline-block;
background: rgba(24, 166, 137, 0.77);
}
.category-nav3 li:nth-child(n+7) {
display: none!important;
}
.category-nav3 li:nth-child(1){
background:url(/user_data/images/iconall300b.png);
background-size:80px 80px;
background-repeat:no-repeat;
height:100%;
background-position:center top;
}
.category-nav3 li:nth-child(2){
background:url(/user_data/images/anime1.png);
background-size:80px 80px;
background-repeat:no-repeat;
height:100%;
background-position:center top;
}
.category-nav3 li:nth-child(3){
background:url(/user_data/images/bocaloid1.png);
background-size:80px 80px;
background-repeat:no-repeat;
height:100%;
background-position:center top;
}
.category-nav3 li:nth-child(4){
background:url(/user_data/images/disney1.png);
background-size:80px 80px;
background-repeat:no-repeat;
height:100%;
background-position:center top;
}
.category-nav3 li:nth-child(5){
background:url(/user_data/images/queen1.png);
background-size:80px 80px;
background-repeat:no-repeat;
height:100%;
background-position:center top;
}
.category-nav3 li:nth-child(6){
background:url(/user_data/images/whig1.png);
background-size:80px 80px;
background-repeat:no-repeat;
height:100%;
background-position:center top;
}

.category-nav3 li a {
    line-height: 20px;
    color: black;
    font-size: 12px;
    display: block;
    text-align: bottom;
    height: auto;
text-align:center;
padding-top:80px;
}
.category-nav3 li:nth-child(1) a{
     color: #cc0985;
}
.category-nav3 li:nth-child(2) a{
    color: #ff006c;
}
.category-nav3 li:nth-child(3) a{
     color: #066f23;
}
.category-nav3 li:nth-child(4) a{
           color: #8e761a;
}
.category-nav3 li:nth-child(5) a{
     color: #136968;
}
.category-nav3 li:nth-child(6) a{
   color: #7200ff;
}

.category-nav3 li a:hover {text-decoration: underline;}}
.category-nav3 a{
display:block;
}
</style>

";
        // line 111
        echo "            <ul class=\"category-nav3\">
            <li class=\"col-sm-3 col-xs-4\"><a href=\"http://vings.jp/products/list?category_id=&name=\">全ての商品</a></li>
              ";
        // line 113
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["Categories"]) ? $context["Categories"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["Category"]) {
            // line 114
            echo "              ";
            echo $this->getAttribute($this, "tree", array(0 => $context["Category"]), "method");
            echo "
              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 116
        echo "
            </ul>";
    }

    // line 94
    public function gettree($__Category__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "Category" => $__Category__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 95
            if (($this->getAttribute((isset($context["Category"]) ? $context["Category"] : null), "id", array()) != 199)) {
                // line 96
                echo "            <li class=\"col-sm-3 col-xs-4\">
                <a href=\"";
                // line 97
                echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("product_list");
                echo "?category_id=";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Category"]) ? $context["Category"] : null), "id", array()), "html", null, true);
                echo "\">
                    ";
                // line 98
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Category"]) ? $context["Category"] : null), "name", array()), "html", null, true);
                echo "
                </a>
                <span class=\"trigger\"></span>
              ";
                // line 101
                if ((twig_length_filter($this->env, $this->getAttribute((isset($context["Category"]) ? $context["Category"] : null), "children", array())) > 0)) {
                    // line 102
                    echo "                <ul>
                  ";
                    // line 103
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["Category"]) ? $context["Category"] : null), "children", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["ChildCategory"]) {
                        // line 104
                        echo "                    ";
                        echo $this->getAttribute($this, "tree", array(0 => $context["ChildCategory"]), "method");
                        echo "
                  ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ChildCategory'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 106
                    echo "                </ul>
              ";
                }
                // line 108
                echo "            </li>
\t\t\t";
            }
            // line 110
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
        return "__string_template__429744979300b1e1bac4a9cec828eac8939fccf10299a38b600c75ce0f9d6cf3";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  191 => 110,  187 => 108,  183 => 106,  174 => 104,  170 => 103,  167 => 102,  165 => 101,  159 => 98,  153 => 97,  150 => 96,  148 => 95,  136 => 94,  131 => 116,  122 => 114,  118 => 113,  114 => 111,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__429744979300b1e1bac4a9cec828eac8939fccf10299a38b600c75ce0f9d6cf3", "");
    }
}
