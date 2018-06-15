<?php

/* Block/smartphone_button1.twig */
class __TwigTemplate_4b262f8067b95c2f32e2d618696e058a7a3638fd0d67a74343e0e208f57acac5 extends Twig_Template
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
#cart .inner {
padding:0;
}
#cart_area p {
border: none;
}

.sp-nav {display: none;}
.sp-nav:after {
clear: both;
content: '';
display: block;
height: 0;
overflow: hidden;
}
.sp-nav li {
background: rgba(170, 149, 109, 0.46);
border-color: #333;
border-radius: 4px;
border-style: solid;
border-width: 2px;
box-sizing: border-box;
box-shadow: 1px 1px 1px 1px rgba(74, 15, 41, 0.52);
float: left;
height: 30px;
padding: 0;
width: 33%;
}
.sp-nav li:not(:first-child) {
margin-left: 0.5%;
}
.sp-nav li a {
color: #000 !important;
display: block;
font-weight: bold;
height: 100%;
line-height: 28px;
letter-spacing: 1px;
text-align: center;
}

.sp-nav #cart_area {
display: none;
background: none;
border: none;
box-shadow: none;
border-radius: 0;
position: static;
}

.sp-nav #cart_area a {
margin: auto;
width: auto;
}

.sp-nav #cart_area p.cart-trigger {
position: static;
right: auto;
}


.sp-nav p.cart-trigger .cb-close {
opacity: 0;
left: auto;
right: 80px;
top: 6px;
}

.sp-nav p.cart-trigger.cart-is-visible .cb-close {
opacity: 1;
}
.spnav-btn img {
position: relative;
bottom: 3px;
}
@media screen and (max-width: 767px) {
#cart_area {display: none;}
.sp-nav,
.sp-nav #cart_area {
display: block;
}
}
</style>
<script>
(function(\$){
\$(window).on('load',function(){
\$('.spnav-btn #cart_area .bottom-scroll').on('click', function(){
\$(\"html,body\").animate({
scrollTop : 0
});

});
});
})(jQuery);
</script>
<ul class=\"sp-nav\">
<li class=\"spnav-btn home\">
<a href=\"/\">
<img src=\"/user_data/images/home.png\">
ホーム
</a>
</li>
<li class=\"spnav-btn\">
<div id=\"cart_area\">
<p class=\"clearfix cart-trigger bottom-scroll\">
<a href=\"#cart\">
<img src=\"/user_data/images/shopping-cart-black-shape.png\">
カート
<svg class=\"cb cb-close\"><use xmlns:xlink=\"http://www.w3.org/1999/xlink\" xlink:href=\"#cb-close\"></use></svg>
</a>
<span class=\"cart_price pc\">合計 <span class=\"price\">";
        // line 112
        echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute((isset($context["Cart"]) ? $context["Cart"] : null), "total_price", array())), "html", null, true);
        echo "</span></span></p>
<div id=\"cart\" class=\"cart\">
<div class=\"inner\">
";
        // line 115
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array()), "flashbag", array()), "get", array(0 => "eccube.front.cart.error"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
            // line 116
            echo "    <div class=\"message\">
        <p class=\"errormsg bg-danger\">
            <svg class=\"cb cb-warning\"><use xlink:href=\"#cb-warning\" /></svg>";
            // line 118
            echo nl2br(twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans($context["error"]), "html", null, true));
            echo "
        </p>
    </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 122
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["Cart"]) ? $context["Cart"] : null), "CartItems", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["CartItem"]) {
            // line 123
            echo "    ";
            $context["ProductClass"] = $this->getAttribute($context["CartItem"], "Object", array());
            // line 124
            echo "    ";
            $context["Product"] = $this->getAttribute((isset($context["ProductClass"]) ? $context["ProductClass"] : null), "Product", array());
            // line 125
            echo "    <div class=\"item_box clearfix\">
        <div class=\"item_photo\"><img
                    src=\"";
            // line 127
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "image_save_urlpath", array()), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getNoImageProduct($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "MainListImage", array())), "html", null, true);
            echo "\"
                    alt=\"";
            // line 128
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "name", array()), "html", null, true);
            echo "\"></div>
        <dl class=\"item_detail\">
            <dt class=\"item_name\">";
            // line 130
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "name", array()), "html", null, true);
            echo "</dt>
            <dd class=\"item_pattern small\">";
            // line 132
            if ($this->getAttribute((isset($context["ProductClass"]) ? $context["ProductClass"] : null), "ClassCategory1", array())) {
                // line 133
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["ProductClass"]) ? $context["ProductClass"] : null), "ClassCategory1", array()), "ClassName", array()), "html", null, true);
                echo "：";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ProductClass"]) ? $context["ProductClass"] : null), "ClassCategory1", array()), "html", null, true);
                // line 134
                if ($this->getAttribute((isset($context["ProductClass"]) ? $context["ProductClass"] : null), "ClassCategory2", array())) {
                    // line 135
                    echo "<br>";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["ProductClass"]) ? $context["ProductClass"] : null), "ClassCategory2", array()), "ClassName", array()), "html", null, true);
                    echo "：";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ProductClass"]) ? $context["ProductClass"] : null), "ClassCategory2", array()), "html", null, true);
                }
            }
            // line 138
            echo "</dd>
            <dd class=\"item_price\">";
            // line 139
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($context["CartItem"], "price", array())), "html", null, true);
            echo "<span class=\"small\">税込</span></dd>
            <dd class=\"item_quantity form-group form-inline\">数量：";
            // line 140
            echo twig_escape_filter($this->env, $this->getAttribute($context["CartItem"], "quantity", array()), "html", null, true);
            echo "</dd>
        </dl>
    </div>
    <p class=\"cart_price sp\">合計 <span class=\"price\">";
            // line 143
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute((isset($context["Cart"]) ? $context["Cart"] : null), "total_price", array())), "html", null, true);
            echo "</span></p>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['CartItem'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 145
        if ((twig_length_filter($this->env, $this->getAttribute((isset($context["Cart"]) ? $context["Cart"] : null), "CartItems", array())) > 0)) {
            // line 146
            echo "
    <div class=\"btn_area\">
        <ul>
            <li>
                <a href=\"";
            // line 150
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
            // line 158
            echo "    <div class=\"btn_area\">
        <div class=\"message\">
            <p class=\"errormsg bg-danger\" style=\"margin-bottom: 20px;\">
                現在カート内に<br>商品はございません。
            </p>
        </div>
    </div>
";
        }
        // line 166
        echo "</div>
</div>
</div>
</li>
<li class=\"spnav-btn\">
";
        // line 171
        if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_USER")) {
            // line 172
            echo "<a href=\"";
            echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("logout");
            echo "\">
<img src=\"/user_data/images/key.png\">
ログアウト
</a>
";
        } else {
            // line 177
            echo "<a href=\"";
            echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("mypage_login");
            echo "\">
<img src=\"/user_data/images/key.png\">
ログイン
</a>
";
        }
        // line 182
        echo "</li>

</ul><!-- /.sp-nav -->";
    }

    public function getTemplateName()
    {
        return "Block/smartphone_button1.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  277 => 182,  268 => 177,  259 => 172,  257 => 171,  250 => 166,  240 => 158,  229 => 150,  223 => 146,  221 => 145,  213 => 143,  207 => 140,  203 => 139,  200 => 138,  193 => 135,  191 => 134,  187 => 133,  185 => 132,  181 => 130,  176 => 128,  170 => 127,  166 => 125,  163 => 124,  160 => 123,  156 => 122,  146 => 118,  142 => 116,  138 => 115,  132 => 112,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "Block/smartphone_button1.twig", "/home/kir021669/public_html/vings.jp/app/template/default/Block/smartphone_button1.twig");
    }
}
