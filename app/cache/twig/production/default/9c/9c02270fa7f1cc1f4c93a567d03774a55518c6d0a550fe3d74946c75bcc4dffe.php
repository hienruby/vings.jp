<?php

/* __string_template__f8dd0ede14c4bd0cf0e174329daeeb2dc3d7a1f3a4f2cc39034bf01aa9301f5e */
class __TwigTemplate_b7088e881e181eb89259ddc928a82a24c6e8230a7b94eb6fc4e3b41d2e5c260c extends Twig_Template
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
.item_name_2 {
    color: #525263;
    margin: 0 0 8px;
    text-align: center;
    overflow: hidden;
    width: 100%;
    text-overflow: ellipsis;
    white-space: normal; 
    padding: 0 10px;
    font-weight: bold;
}
.btn_area .btn {
    height: 35px;
    line-height: 35px;
    vertical-align: middle;
    padding-top: 0;
    padding-bottom: 0;
border-radius:10px;
}
.btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .open > .dropdown-toggle.btn-info {
    color: #fff;
    background-color: #ec986c;
    border-color: #ed9b6e;
}
.cart .btn_area .btn-sm {
  height: 35px;
    line-height: 35px;
    font-size: 14px;
    font-size: 1.4rem;
    line-height: 1.4;
    padding: 10px 8px;
}
.cart-trigger, .nav-trigger , p.cart-trigger a, #header #cart_area .cart_price {  
    height: 35px;
line-height: 35px;
}
#cart_area {
    background: rgba(170, 149, 109, 0.46);
    border-radius: 5px;
box-shadow: 1px 1px 1px 1px rgba(74, 15, 41, 0.52);
}

#cart .inner {
padding:0;
}
#cart_area p {
     border: none;
}
</style>
<div id=\"cart_area\">
    <p class=\"clearfix cart-trigger\"><a href=\"#cart\">
            <svg class=\"cb cb-shopping-cart\">
                <use xlink:href=\"#cb-shopping-cart\"/>
            </svg>
            <span class=\"badge\">";
        // line 56
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Cart"]) ? $context["Cart"] : null), "total_quantity", array()), "html", null, true);
        echo "</span>
            <svg class=\"cb cb-close\">
                <use xlink:href=\"#cb-close\"/>
            </svg>
        </a>
        <span class=\"cart_price pc\">合計 <span class=\"price\">";
        // line 61
        echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute((isset($context["Cart"]) ? $context["Cart"] : null), "total_price", array())), "html", null, true);
        echo "</span></span></p>
    <div id=\"cart\" class=\"cart\">
        <div class=\"inner\">
            ";
        // line 64
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array()), "flashbag", array()), "get", array(0 => "eccube.front.cart.error"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
            // line 65
            echo "                <div class=\"message\">
                    <p class=\"errormsg bg-danger\">
                        <svg class=\"cb cb-warning\"><use xlink:href=\"#cb-warning\" /></svg>";
            // line 67
            echo nl2br(twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans($context["error"]), "html", null, true));
            echo "
                    </p>
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 71
        echo "            ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["Cart"]) ? $context["Cart"] : null), "CartItems", array()));
        foreach ($context['_seq'] as $context["key"] => $context["CartItem"]) {
            // line 72
            echo "                ";
            $context["ProductClass"] = $this->getAttribute($context["CartItem"], "Object", array());
            // line 73
            echo "                ";
            $context["Product"] = $this->getAttribute((isset($context["ProductClass"]) ? $context["ProductClass"] : null), "Product", array());
            // line 74
            echo "                <div class=\"item_box clearfix\">
                    <div class=\"item_photo\"><img
                                src=\"";
            // line 76
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "image_save_urlpath", array()), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getNoImageProduct($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "MainListImage", array())), "html", null, true);
            echo "\"
                                alt=\"";
            // line 77
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "name", array()), "html", null, true);
            echo "\"></div>
                    <dl class=\"item_detail\">
                        <dt class=\"item_name_2\">";
            // line 79
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "name", array()), "html", null, true);
            echo "</dt>
                        <dd class=\"item_pattern small\">";
            // line 81
            if ($this->getAttribute((isset($context["ProductClass"]) ? $context["ProductClass"] : null), "ClassCategory1", array())) {
                // line 82
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["ProductClass"]) ? $context["ProductClass"] : null), "ClassCategory1", array()), "ClassName", array()), "html", null, true);
                echo "：";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ProductClass"]) ? $context["ProductClass"] : null), "ClassCategory1", array()), "html", null, true);
                // line 83
                if ($this->getAttribute((isset($context["ProductClass"]) ? $context["ProductClass"] : null), "ClassCategory2", array())) {
                    // line 84
                    echo "<br>";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["ProductClass"]) ? $context["ProductClass"] : null), "ClassCategory2", array()), "ClassName", array()), "html", null, true);
                    echo "：";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ProductClass"]) ? $context["ProductClass"] : null), "ClassCategory2", array()), "html", null, true);
                }
            }
            // line 87
            echo "</dd>
                        ";
            // line 97
            echo "
";
            // line 98
            if ($this->getAttribute((isset($context["CartOptions"]) ? $context["CartOptions"] : null), $context["key"], array(), "array", true, true)) {
                // line 99
                echo "<dd class=\"item_pattern small\">
    ";
                // line 100
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["CartOptions"]) ? $context["CartOptions"] : null), $context["key"], array(), "array"), "label", array()));
                $context['loop'] = array(
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                );
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["_key"] => $context["label"]) {
                    // line 101
                    echo "        ";
                    if (($this->getAttribute($context["loop"], "index0", array()) != 0)) {
                        echo "<br />";
                    }
                    echo twig_escape_filter($this->env, $context["label"], "html", null, true);
                    echo "
    ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['label'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 103
                echo "</dd>
";
            }
            // line 104
            echo "<dd class=\"item_price\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($context["CartItem"], "price", array())), "html", null, true);
            echo "<span class=\"small\">税込</span></dd>
                        <dd class=\"item_quantity form-group form-inline\">数量：";
            // line 105
            echo twig_escape_filter($this->env, $this->getAttribute($context["CartItem"], "quantity", array()), "html", null, true);
            echo "</dd>
                    </dl>
                </div><!--/item_box-->
                <p class=\"cart_price sp\">合計 <span class=\"price\">";
            // line 108
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute((isset($context["Cart"]) ? $context["Cart"] : null), "total_price", array())), "html", null, true);
            echo "</span></p>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['CartItem'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 110
        echo "            ";
        if ((twig_length_filter($this->env, $this->getAttribute((isset($context["Cart"]) ? $context["Cart"] : null), "CartItems", array())) > 0)) {
            // line 111
            echo "
                <div class=\"btn_area\">
                    <ul>
                        <li>
                            <a href=\"";
            // line 115
            echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("cart");
            echo "\" class=\"btn btn-primary\">カートへ進む</a>
                        </li>
                        <li>
                            <button type=\"button\" class=\"btn btn-default btn-sm cart-trigger\">キャンセル</button>
                        </li>
                    </ul>
                </div>
            ";
        } else {
            // line 123
            echo "                <div class=\"btn_area\">
                    <div class=\"message\">
                        <p class=\"errormsg bg-danger\" style=\"margin-bottom: 20px;\">
                            現在カート内に<br>商品はございません。
                        </p>
                    </div>
                </div>
            ";
        }
        // line 131
        echo "        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "__string_template__f8dd0ede14c4bd0cf0e174329daeeb2dc3d7a1f3a4f2cc39034bf01aa9301f5e";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  254 => 131,  244 => 123,  233 => 115,  227 => 111,  224 => 110,  216 => 108,  210 => 105,  205 => 104,  201 => 103,  181 => 101,  164 => 100,  161 => 99,  159 => 98,  156 => 97,  153 => 87,  146 => 84,  144 => 83,  140 => 82,  138 => 81,  134 => 79,  129 => 77,  123 => 76,  119 => 74,  116 => 73,  113 => 72,  108 => 71,  98 => 67,  94 => 65,  90 => 64,  84 => 61,  76 => 56,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__f8dd0ede14c4bd0cf0e174329daeeb2dc3d7a1f3a4f2cc39034bf01aa9301f5e", "");
    }
}
