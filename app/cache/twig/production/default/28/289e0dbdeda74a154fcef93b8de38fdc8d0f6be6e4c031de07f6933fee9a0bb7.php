<?php

/* __string_template__8805d65294d6d8df020b22f723ce50a7dffa5e746deacc32df998d71e9302373 */
class __TwigTemplate_971fd72eabb486787b3d7e20d92621f9401e22eee978c0158989287c08c0108f extends Twig_Template
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
.category-nav1 span {
width: 100%;
color: #333;
background: rgb(255, 192, 203);
padding-top: 4px;
border-radius: 5px 5px 0px 0;
border-bottom: 1px sol;
box-shadow: 1px 1px 1px 1px #9b7c88;
text-align: center;
display: block;
line-height: 30px;
}
.category-nav1 {
border:none;
text-align: left;
border-right: rgba(167, 127, 127, 0.59) 1px solid;
}
#category1 {
line-height: 20px;
padding: 0px;
margin-bottom:10px;
}
.category-nav1 li ul {
padding-left:10px;
width: 100%;
}
.category-nav1 li {
background-image:url(\"/user_data/images/bak1.png\") top no-repeat;
position: relative;
display: block;
border-bottom: rgba(167, 127, 127, 0.59) 1px solid;
border-top:none;
}
 .category-nav1 li ul, .category-nav1 li ul li ul{
display:none;
}
.category-nav1 > li:hover > a {}
    .category-nav1 > li:hover li:hover > a { background: rgba(192, 156, 87, 0.44);}
 .category-nav1 > li:hover li:hover > ul {  display:block;}
 .category-nav1 > li:hover>ul{display:block;}
    .category-nav1 > li:hover > ul > li {
      display:block
        height: 50px;
    }
.category-nav1 li > a {
padding-left: 10px;
font-size:13px;
line-height:30px;
color:black;
display:block;
font-size: 12px;
    }
.category-nav1 li > a:hover{ background: rgba(192, 156, 87, 0.44);}
.category-nav1 li {
background-image: url(/user_data/images/bar.png);
background-repeat:no-repeat;
 background-size: 5px 35px;
}
.category-nav1 li a:after {
        position: absolute;
        content: \"+\";
        top: 0;
        width: 0;
        height: 0;
right:15px;
    }

.category-nav1 li ul li  a:after { content: \" \";}

.sp-cat {display: none;}

.sp-cat .category-nav1 li,
.sp-cat .category-nav1 li a {
  line-height: 35px;
    font-size: 15px;
}

.sp-cat .category-nav1 li a {
    display: inline-block;
    margin: 0 0 0 10px;
    padding: 0;
    position: relative;
    z-index: 2;
}
.sp-cat .category-nav1 li a:hover,
.sp-cat .category-nav1 li:hover a {
    background: none;
}

.sp-cat .category-nav1 li a:after {
    display: none;
}

.sp-catBox .category-nav1 span {
    background: none;
    border: none;
    box-shadow: none;
    height: 24px;
    position: absolute;
    right: 0;
    top: 0;
    width: 100%;
}

.sp-catBox .category-nav1 .trigger:before {
    background: #b8bec4;
    border-radius: 4px;
    content: '';
    display: block;
    height: 18px;
    right: 18px;
    position: absolute;
    top: 3px;
    width: 2px;
}
.sp-catBox .category-nav1 .trigger.open:before {
    opacity: 0;
}
.sp-catBox .category-nav1 .trigger:after {
    background: #b8bec4;
    border-radius: 4px;
    content: '';
    display: block;
    height: 2px;
    right: 10px;
    position: absolute;
    top: 11px;
    width: 18px;
}

.sp-catBox .category-nav1 > li:hover li:hover > a,
.sp-catBox .category-nav1 li > a:hover{ background: none;}

.sp-catBox .category-nav1 li ul,
.sp-catBox .category-nav1 li li {
    border-top: rgba(167, 127, 127, 0.59) 1px solid;
    border-bottom: none;
}
.sp-catBox .category-nav1 li ul li:first-child {
    border-top: none;
}

.sp-catBox .category-nav1 > li:hover>ul {
    display: none;
}

@media screen and (max-width: 767px) {
.item_gallery3 h4{
background: url(/user_data/bak/bak8.png);
 height: 35px;
    line-height: 35px;
    padding-left: 15px;
    border-radius: 5px 5px 0 0;
box-shadow: 1px 1px 1px 1px rgba(107, 29, 34, 0.83);
margin:2px 0;
font-size: 15px;
color: #fff;
}
    .sp-cat {
        display: block;
    }
}
</style>

<div class=\"sp-cat\">
  <div class=\"row\">
    <div class=\"col-sm-12\">

      <div class=\"item_gallery3\">
        <h4><img src=\"/user_data/icon/tags-1.png\">  カテゴリ一覧</h4>
        <div class=\"border\">
          <div class=\"sp-catBox\">


            ";
        // line 193
        echo "
            <ul class=\"category-nav1\">
              ";
        // line 195
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["Categories"]) ? $context["Categories"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["Category"]) {
            // line 196
            echo "              ";
            echo $this->getAttribute($this, "tree", array(0 => $context["Category"]), "method");
            echo "
              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 198
        echo "            </ul>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
(function(\$){
    \$('.sp-catBox .category-nav1 .trigger').on('click',function(){
        if(\$(this).hasClass('open')){
            \$(this).removeClass('open');
            \$(this).next().slideUp();
        }
        else{
            \$(this).addClass('open');
            \$(this).next().slideDown();
        }
    });
})(jQuery);
</script>";
    }

    // line 176
    public function gettree($__Category__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "Category" => $__Category__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 177
            echo "\t\t\t";
            if (($this->getAttribute((isset($context["Category"]) ? $context["Category"] : null), "id", array()) != 199)) {
                // line 178
                echo "            <li>
                <a href=\"";
                // line 179
                echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("product_list");
                echo "?category_id=";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Category"]) ? $context["Category"] : null), "id", array()), "html", null, true);
                echo "\">
                    ";
                // line 180
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Category"]) ? $context["Category"] : null), "name", array()), "html", null, true);
                echo "
                </a>
              ";
                // line 182
                if ((twig_length_filter($this->env, $this->getAttribute((isset($context["Category"]) ? $context["Category"] : null), "children", array())) > 0)) {
                    // line 183
                    echo "                <span class=\"trigger\"></span>
                <ul>
                  ";
                    // line 185
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["Category"]) ? $context["Category"] : null), "children", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["ChildCategory"]) {
                        // line 186
                        echo "                    ";
                        echo $this->getAttribute($this, "tree", array(0 => $context["ChildCategory"]), "method");
                        echo "
                  ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ChildCategory'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 188
                    echo "                </ul>
              ";
                }
                // line 190
                echo "            </li>
\t\t\t";
            }
            // line 192
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
        return "__string_template__8805d65294d6d8df020b22f723ce50a7dffa5e746deacc32df998d71e9302373";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  295 => 192,  291 => 190,  287 => 188,  278 => 186,  274 => 185,  270 => 183,  268 => 182,  263 => 180,  257 => 179,  254 => 178,  251 => 177,  239 => 176,  213 => 198,  204 => 196,  200 => 195,  196 => 193,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__8805d65294d6d8df020b22f723ce50a7dffa5e746deacc32df998d71e9302373", "");
    }
}
