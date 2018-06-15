<?php

/* Block/smartphone_button.twig */
class __TwigTemplate_e23782160668fff895d9029cf20229dad8a0a16c6ea8ec04d5352eb9ca782bd2 extends Twig_Template
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
        // line 22
        echo "<style>
/*.cart-trigger, .nav-trigger , p.cart-trigger a, #header #cart_area .cart_price {  
    height: 35px;
line-height: 35px;
}*/


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
<div class=\"botan\">
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
                </p>
                </div>
    </li>
    <li class=\"spnav-btn\">
    ";
        // line 145
        if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_USER")) {
            // line 146
            echo "        <a href=\"";
            echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("logout");
            echo "\">
            <img src=\"/user_data/images/key.png\">
          ログアウト
        </a>
    ";
        } else {
            // line 151
            echo "        <a href=\"";
            echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("mypage_login");
            echo "\">
            <img src=\"/user_data/images/key.png\">
          ログイン
        </a>
    ";
        }
        // line 156
        echo "    </li>
</ul><!-- /.sp-nav -->
</div>";
    }

    public function getTemplateName()
    {
        return "Block/smartphone_button.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  164 => 156,  155 => 151,  146 => 146,  144 => 145,  19 => 22,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "Block/smartphone_button.twig", "/home/kir021669/public_html/vings.jp/app/template/default/Block/smartphone_button.twig");
    }
}
