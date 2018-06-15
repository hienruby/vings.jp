<?php

/* __string_template__5a9af7197aff176e2890e8ad8a98ba9b33a1dd9962f7a0ebc4428a57fdfa9504 */
class __TwigTemplate_a3a0064ee8a9feac34663b3f8f6a5be313a230dbc950ca39b70ca531bb3ba00f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("default_frame.twig", "__string_template__5a9af7197aff176e2890e8ad8a98ba9b33a1dd9962f7a0ebc4428a57fdfa9504", 1);
        $this->blocks = array(
            'stylesheet' => array($this, 'block_stylesheet'),
            'javascript' => array($this, 'block_javascript'),
            'main' => array($this, 'block_main'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "default_frame.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["body_class"] = "product_page";
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_stylesheet($context, array $blocks = array())
    {
        // line 6
        echo "<link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "user_data_urlpath", array()), "html", null, true);
        echo "/css/product_detail.css?v=";
        echo twig_escape_filter($this->env, twig_constant("Eccube\\Common\\Constant::VERSION"), "html", null, true);
        echo "\">
";
    }

    // line 9
    public function block_javascript($context, array $blocks = array())
    {
        // line 10
        echo "<script src=\"/plugin/ImgExpansion/js/zoomsl-3.0.min.js\"></script>
<script>
    var size = \$(window).width();
    \$(window).resize(function() {
        size = \$(window).width();
    });

    \$(window).bind('load', function() {
        zoomer();
    });

    \$(window).resize(function() {
        zoomer();
    });

    function zoomer() {
        setTimeout(function () {
            \$('.magnifier').remove();
            \$('.cursorshade').remove();
            \$('.statusdiv').remove();
            \$('.tracker').remove();

            if (768 > size) {
                return false;
            }

            \$(\"[id^=detail_image_box__item] img\").imagezoomsl({
                zoomrange: [3, 10],
                zoomstart: 3,
                magnifiereffectanimate: 'fadeIn',
                magnifierborder: '0'
            });

        }, 30);
    }
</script>

<style>
<!-- bodyCSS -->
h1{
\tfont-size:18px;
\tline-height:21px;
}
h2{
\tfont-size:12px;
\tfont-weight: normal;
}
body{
}
td, th{
\tpadding: 5px;
}
.accordion{
\tpadding-top:10px;
}
.affiliate_urls{
\tdisplay:none;
}
.item_comment {
\tcolor: rgba(107, 29, 34, 0.83);
\ttext-align: center;
}
.h-name {
\tcolor: #8D553A;
\tline-height: 18px;
}
.cart_area .classcategory_list li select {
\twidth: 100%;
\tfont-size: 12px;
}
#item_detail table br{display:bock;}
.item_comment img{
\twidth:100%;
\theight:100%;
}
.product_tag_list {
\tfont-size: 100%;
\tcolor: #fff;
\tborder: solid 1px #fd7436;
\tbackground-color: #ff7434;
\tfont-size: 14px;
}
.relative_cat li a {
\tpadding: 0 0.5em;
\tdisplay: inline-block;
\tcolor: #563924;
}
.btn-success:hover {
\tcolor: #fff;
\tbackground-color: #ec9a6e;
\tborder-color: initial;
}
.gui{
\tpadding: 5px 0px;
\tline-height: 18px;
}
#item_detail_area .item_detail p {
\tmargin: 5px 0;
}
.item_name1 {
    padding: 0;
    margin: 0;
    margin-bottom: 8px;
    font-size: 20px;
}
.product_tag_list {
\tmargin-bottom: 8px;
}
.btn-info {
\tborder-color: #fff;
\tcolor: #fff;
\tbackground-color: #e26e38;
}
#favorite{
\tbackground: #661800;
\tborder: none;
\tborder-radius: 5px;
}
#add-cart{
\tbackground: #ff7434;
\tborder-radius: 5px;
\tborder: none;
}
.relative_cat li:first-child a {
\tpadding-left: 0;
\tfont-size: 12px;
\tcolor: #563924;
\tfont-weight: bold;
\tline-height: 18px;
}
fieldset[disabled] .btn-info.active {
\tbackground-color: #f0ad4e;
\tborder-color: #f0ad4e;
}
#related_product_area .item_price + .item_comment {
\tmargin-top: 0;
}
#related_product_area .slick-next, #related_product_area .slick-prev {
\tfont-size: 20px;
\ttop: -35px;
}
#related_product_area .slick-prev .cb, #related_product_area .slick-next .cb {
\tfont-size: 20px;
\ttop: -6px;
}
#related_product_area .angle-circle {
\twidth: 28px;
\theight: 28px;
\tmargin-top: 0;
}
#related_product_area .heading03 {
\tpadding-top: 5px;
\tfont-size: 16px;
}
#detail_wrap{padding-bottom:0;}
.freearea img {
\tmax-width: 100%;
\theight: 100%;
}
dl.quantity dt {
\tmin-height: 35px;
\tline-height: 30px;
}
.btn-info, .btn-primary {
\tfont-size: 12px;
}
.btn-success, btn-success:active {
\tbackground: none;
\tcolor: black;
\tborder: none;
\tfont-weight:normal;
\tfont-size:11px;
\tmargin-bottom:2px;
\tborder:1px solid #CACACA;
\tborder-radius:5px;
}
.slick-slider {
\tmargin-bottom: 0px;
}

.cart_area {
\tpadding-top: 0px;
}
#item_detail_area .item_detail .item_code {
\tpadding: 5px 0;
\tborder-top: 1px dotted #ccc;
}
#item_detail_area .item_detail .relative_cat {
\tpadding: 5px 0;
\tborder-top: 1px dotted #ccc;
\tborder-bottom: 1px dotted #ccc;
}
#item_detail_area .item_detail .sale_price {
\tfont-size: 18px;
}

.flickity-enabled {
\tposition: relative;
}

.flickity-enabled:focus { outline: none; }

.flickity-viewport {
\toverflow: hidden;
\tposition: relative;
\theight: 100%;
}

.flickity-slider {
\tposition: absolute;
\twidth: 100%;
\theight: 100%;
}

/* draggable */

.flickity-enabled.is-draggable {
\t-webkit-tap-highlight-color: transparent;
\ttap-highlight-color: transparent;
\t-webkit-user-select: none;
\t-moz-user-select: none;
\t-ms-user-select: none;
\tuser-select: none;
}
.flickity-enabled.is-draggable .flickity-viewport {
\tcursor: move;
\tcursor: -webkit-grab;
\tcursor: grab;
}
.flickity-enabled.is-draggable .flickity-viewport.is-pointer-down {
\tcursor: -webkit-grabbing;
\tcursor: grabbing;
}

/* ---- previous/next buttons ---- */

.flickity-prev-next-button {
\tposition: absolute;
\ttop: 50%;
\twidth: 30px;
\theight: 30px;
\tborder: none;
\tborder-radius: 50%;
\tbackground: white;
\tbackground: hsla(0, 0%, 100%, 0.75);
\tcursor: pointer;
\t/* vertically center */
\t-webkit-transform: translateY(-50%);
\ttransform: translateY(-50%);
}

.flickity-prev-next-button:hover { background: white; }

.flickity-prev-next-button:focus {
\toutline: none;
\tbox-shadow: 0 0 0 5px #09F;
}

.flickity-prev-next-button:active {
\topacity: 0.6;
}

.flickity-prev-next-button.previous { left: 0; }
.flickity-prev-next-button.next { right: 0; }
/* right to left */
.flickity-rtl .flickity-prev-next-button.previous {
\tleft: auto;
\tright: 0;
}
.flickity-rtl .flickity-prev-next-button.next {
\tright: auto;
\tleft: 0;
}

.flickity-prev-next-button:disabled {
\topacity: 0.3;
\tcursor: auto;
}

.flickity-prev-next-button svg {
position: absolute;
\tleft: 20%;
\ttop: 20%;
\twidth: 60%;
\theight: 60%;
}

.flickity-prev-next-button .arrow {
\tfill: #333;
}

/* ---- page dots ---- */

.flickity-page-dots {
\tposition: absolute;
\twidth: 100%;
\tbottom: -25px;
\tpadding: 0;
\tmargin: 0;
\tlist-style: none;
\ttext-align: center;
\tline-height: 1;
}

.flickity-rtl .flickity-page-dots { direction: rtl; }

.flickity-page-dots .dot {
\tdisplay: inline-block;
\twidth: 10px;
\theight: 10px;
\tmargin: 0 8px;
\tbackground: #333;
\tborder-radius: 50%;
\topacity: 0.25;
\tcursor: pointer;
}

.flickity-page-dots .dot.is-selected {
\topacity: 1;
}
@media screen and (max-width: 767px){
.flickity-enabled {position: absolute;bottom: 5px;}
.slick-dots {position: absolute;bottom: 5px;}
.flickity-slider {transform: none !important;}
.flickity-prev-next-button{display: none !important;}
.flickity-enabled .flickity-slider > li {
\tleft: auto !important;
\tposition: relative !important;
}
}

#item_photo_area .slick-dots.flickity-enabled {
\tmargin: auto;
}
.kato{
\tfont-size:13px;
}
<!-- レビューボタンCSS -->
#product_review_area dl dt .cb {
\ttop: 16px;
}
#product_review_area dl dt {
\tpadding: 10px;
\tfont-size: 14px;
\tmargin: 2px 0;
}
#product_review_area .review_btn {
\tpadding: 2px 0 0;
\ttext-align: center;
}
#product_review_area .review_btn a {
\tmargin: 0 auto;
\tpadding: 8px;
\twidth: 40%;
}
@media only screen and (min-width: 768px) {
\t#product_review_area .review_btn a {
\t\tmin-width: 100%;
\t}
}
</style>

<script>
eccube.classCategories = ";
        // line 373
        echo twig_jsonencode_filter($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "class_categories", array()));
        echo ";
// 規格2に選択肢を割り当てる。
\tfunction fnSetClassCategories(form, classcat_id2_selected) {
\tvar \$form = \$(form);
\tvar product_id = \$form.find('input[name=product_id]').val();
\tvar \$sele1 = \$form.find('select[name=classcategory_id1]');
\tvar \$sele2 = \$form.find('select[name=classcategory_id2]');
\teccube.setClassCategories(\$form, product_id, \$sele1, \$sele2, classcat_id2_selected);
}
";
        // line 382
        if ($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "classcategory_id2", array(), "any", true, true)) {
            // line 383
            echo "fnSetClassCategories(
document.form1, ";
            // line 384
            echo twig_jsonencode_filter($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "classcategory_id2", array()), "vars", array()), "value", array()));
            echo "
);
";
        }
        // line 387
        echo "</script>
<script>
\$(function(){
\$('.carousel').slick({
infinite: false,
speed: 300,
prevArrow:'<button type=\"button\" class=\"slick-prev\"><span class=\"angle-circle\"><svg class=\"cb cb-angle-right\"><use xlink:href=\"#cb-angle-right\" /></svg></span></button>',
nextArrow:'<button type=\"button\" class=\"slick-next\"><span class=\"angle-circle\"><svg class=\"cb cb-angle-right\"><use xlink:href=\"#cb-angle-right\" /></svg></span></button>',
slidesToShow: 4,
slidesToScroll: 4,
responsive: [
{
breakpoint: 768,
settings: {
slidesToShow: 3,
slidesToScroll: 3
}
}
]
});

\$('.slides').slick({
dots: true,
arrows: false,
speed: 0,
customPaging: function(slider, i) {
return '<button class=\"thumbnail\">' + \$(slider.\$slides[i]).find('img').prop('outerHTML') + '</button>';
}
});

\$('#favorite').click(function() {
\$('#mode').val('add_favorite');
});

\$('#add-cart').click(function() {
\$('#mode').val('add_cart');
});

// bfcache無効化
\$(window).bind('pageshow', function(event) {
if (event.originalEvent.persisted) {
location.reload(true);
}
});
});
</script>
<!-- js追記 ここから -->
<script src=\"/user_data/flickity/flickity.pkgd.min.js\"></script>
<script>
(function(\$){
\$(window).on('load', function(){
var num = \$('.slick-dots').find('li').length;
if( num > 3 ){
\$('.slick-dots').flickity({
pageDots: false,
cellAlign: 'left'
});
}
});
})(jQuery);
</script>
<!-- ここまで -->
<!-- Google 構造化データ JSON-LD マークアップ -->
<script type=\"application/ld+json\">
{
  \"@context\": \"http://schema.org/\",
  \"@type\": \"Product\",
  \"name\": \"";
        // line 454
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "name", array()), "html", null, true);
        echo "\",
  \"image\": [";
        // line 455
        if ((twig_length_filter($this->env, $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "ProductImage", array())) > 0)) {
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "ProductImage", array()));
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
            foreach ($context['_seq'] as $context["_key"] => $context["ProductImage"]) {
                if (($this->getAttribute($context["loop"], "index", array()) > 1)) {
                    echo ",";
                }
                echo "\"";
                echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("homepage");
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "image_save_urlpath", array()), "html", null, true);
                echo "/";
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getNoImageProduct($context["ProductImage"]), "html", null, true);
                echo "\"";
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ProductImage'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            echo "\"";
            echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("homepage");
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "image_save_urlpath", array()), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getNoImageProduct(""), "html", null, true);
            echo "\"";
        }
        echo "],
  \"description\": \"";
        // line 456
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "free_area", array()), "html", null, true);
        echo "\",
  \"sku\": \"";
        // line 457
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "code_min", array()), "html", null, true);
        echo "\",
  \"category\":[
    ";
        // line 459
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "ProductCategories", array()));
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
        foreach ($context['_seq'] as $context["_key"] => $context["ProductCategory"]) {
            if (($this->getAttribute($context["loop"], "index", array()) > 1)) {
                echo ",";
            }
            echo "\"";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($context["ProductCategory"], "Category", array()), "path", array()));
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
            foreach ($context['_seq'] as $context["_key"] => $context["Category"]) {
                if (($this->getAttribute($context["loop"], "index", array()) > 1)) {
                    echo " / ";
                }
                echo twig_escape_filter($this->env, $this->getAttribute($context["Category"], "name", array()), "html", null, true);
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Category'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo "\"";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ProductCategory'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 460
        echo "  ],
  \"brand\": {
    \"@type\": \"Thing\",
    \"name\": \"Vings\"
  },
  \"offers\": {
    \"@type\": \"Offer\",
    \"priceCurrency\": \"JPY\",
    \"price\": \"";
        // line 468
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "getPrice02IncTaxMin", array()), "html", null, true);
        echo "\",
    \"itemCondition\": \"http://schema.org/NewCondition\",
    \"availability\": \"http://schema.org/InStock\",
    \"seller\": {
      \"@type\": \"Organization\",
      \"name\": \"Vings, Inc.\"
    }
  }
}
</script>
";
        // line 487
        echo "
";
        // line 488
        if ((twig_length_filter($this->env, (isset($context["ProductOptions"]) ? $context["ProductOptions"] : null)) > 0)) {
            // line 489
            echo "<script src=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "front_urlpath", array()), "html", null, true);
            echo "/../../plugin/ProductOption/jquery.plainmodal.min.js\"></script>
";
        }
        // line 491
        echo "<script>
";
        // line 492
        if ((twig_length_filter($this->env, (isset($context["ProductOptions"]) ? $context["ProductOptions"] : null)) > 0)) {
            // line 493
            echo "\$(function() {
    ";
            // line 494
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["ProductOptions"]) ? $context["ProductOptions"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["ProductOption"]) {
                // line 495
                echo "    ";
                $context["Option"] = $this->getAttribute($context["ProductOption"], "Option", array());
                // line 496
                echo "        ";
                if (($this->getAttribute((isset($context["Option"]) ? $context["Option"] : null), "description_flg", array()) == 1)) {
                    // line 497
                    echo "            modal";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Option"]) ? $context["Option"] : null), "id", array()), "html", null, true);
                    echo " = \$('#option_description_";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Option"]) ? $context["Option"] : null), "id", array()), "html", null, true);
                    echo "').plainModal();
            \$('#option_description_link_";
                    // line 498
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Option"]) ? $context["Option"] : null), "id", array()), "html", null, true);
                    echo "').click(function() { modal";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Option"]) ? $context["Option"] : null), "id", array()), "html", null, true);
                    echo ".plainModal('open'); return false;});
        ";
                }
                // line 500
                echo "    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ProductOption'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo "      
});

\$(function() {
    \$(\"[id^=desc_btn_]\").click(function(){
        var id = \$(this).attr('id').replace(/^desc_btn_/ig, '');
        var ids = id.split('_');
        
        func_submit(ids[0],ids[1]);
    });
});

function func_submit(optionId, setValue) {
    var \$sele_option = \$(\"[name=productoption\" + optionId + \"]\");
    if(\$sele_option && \$sele_option.length){
        var kind = \$sele_option.attr(\"type\");
        if(kind == 'radio'){
            \$sele_option.val([setValue]);
        }else{
            \$sele_option.val(setValue);
        }\t\t\t
    }
    ";
            // line 522
            if ((isset($context["isActive"]) ? $context["isActive"] : null)) {
                // line 523
                echo "    onOptionChange();
    ";
            }
            // line 525
            echo "    \$('#option_description_' + optionId).plainModal('close');
}
";
        }
        // line 528
        echo "
";
        // line 529
        if ((isset($context["isActive"]) ? $context["isActive"] : null)) {
            // line 530
            echo "var optionPrice = ";
            echo twig_jsonencode_filter((isset($context["optionPrice"]) ? $context["optionPrice"] : null));
            echo ";
var optionPoint = ";
            // line 531
            echo twig_jsonencode_filter((isset($context["optionPoint"]) ? $context["optionPoint"] : null));
            echo ";
var taxRules = ";
            // line 532
            echo twig_jsonencode_filter((isset($context["taxRules"]) ? $context["taxRules"] : null));
            echo ";
var default_class_id = ";
            // line 533
            echo twig_escape_filter($this->env, (isset($context["default_class_id"]) ? $context["default_class_id"] : null), "html", null, true);
            echo ";

function onOptionChange(){
    var optionPriceTotal = 0;
    var optionPointTotal = 0;
    var tax_rate = null;
    var tax_rule = null;
    \$(\"[id^=productoption]\").each(function(){
        var id = \$(this).prop(\"id\");
        if(id.match(/^productoption\\d+\$/)){
            var kind = \$(this).prop(\"tagName\");
            var value = null;
            switch(kind){
                case 'SELECT':
                    value = \$(this).val();
                    break;
                case 'TEXTAREA':
                case 'INPUT':
                    break;
                default:
                    var id = \$(this).prop('id');
                    value = (\$(\"input[name='\" + id + \"']:checked\").val());
                    break;
            }
            if(value != null){
                optionPriceTotal += optionPrice[value];
                optionPointTotal += optionPoint[value];
            }
        }
    });
    var \$sele1 = \$('form select[name=classcategory_id1]');
    var \$sele2 = \$('form select[name=classcategory_id2]');

    var classcat_id1 = \$sele1.val() ? \$sele1.val() : '__unselected';
    var classcat_id2 = \$sele2.val() ? \$sele2.val() : '';
    classcat2 = eccube.classCategories[classcat_id1]['#' + classcat_id2];
    if(classcat2){
        var product_class_id = classcat2.product_class_id;        
    }else{
        var product_class_id = default_class_id;
    }

    var tax_rate = taxRules[product_class_id]['tax_rate'];
    var tax_rule = taxRules[product_class_id]['tax_rule'];    

    \$('#option_price_default').text(number_format(optionPriceTotal));
    \$('#option_price_inctax_default').text(number_format(optionPriceTotal + sfTax(optionPriceTotal, tax_rate, tax_rule)));
    \$('#option_point_default').text(number_format(optionPointTotal));
}

function number_format(num) {
    return num.toString().replace(/([0-9]+?)(?=(?:[0-9]{3})+\$)/g , '\$1,');
}

function sfTax(price, tax_rate, tax_rule) {
    real_tax = tax_rate / 100;
    ret = price * real_tax;
    tax_rule = parseInt(tax_rule);
    switch (tax_rule) {
        // 四捨五入
        case 1:
            \$ret = Math.round(ret);
            break;
        // 切り捨て
        case 2:
            \$ret = Math.floor(ret);
            break;
        // 切り上げ
        case 3:
            \$ret = Math.ceil(ret);
            break;
        // デフォルト:切り上げ
        default:
            \$ret = Math.round(ret);
            break;
    }
    return \$ret;
}

onOptionChange();
";
        }
        // line 614
        echo "</script>";
    }

    // line 616
    public function block_main($context, array $blocks = array())
    {
        // line 630
        echo "<!-- ▼関連カテゴリ▼ -->
<div id=\"relative_category_box\" class=\"relative_cat\">
";
        // line 632
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "ProductCategories", array()));
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
        foreach ($context['_seq'] as $context["_key"] => $context["ProductCategory"]) {
            // line 633
            echo "<ol id=\"relative_category_box__relative_category--";
            echo twig_escape_filter($this->env, $this->getAttribute($context["ProductCategory"], "product_id", array()), "html", null, true);
            echo "_";
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "\">
";
            // line 634
            $context["CategoryLevel"] = 0;
            // line 635
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($context["ProductCategory"], "Category", array()), "path", array()));
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
            foreach ($context['_seq'] as $context["_key"] => $context["Category"]) {
                // line 636
                echo "  ";
                if (($this->getAttribute($this->getAttribute($context["ProductCategory"], "Category", array()), "level", array()) > 1)) {
                    // line 637
                    echo "  ";
                    if (($this->getAttribute($this->getAttribute($context["ProductCategory"], "Category", array()), "level", array()) == 3)) {
                        // line 638
                        echo "  ";
                        $context["CategoryLevel"] = 1;
                        // line 639
                        echo "  <!-- ★ここに追加★ -->
<li><a id=\"relative_category_box__relative_category--";
                        // line 640
                        echo twig_escape_filter($this->env, $this->getAttribute($context["ProductCategory"], "product_id", array()), "html", null, true);
                        echo "_";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["loop"], "parent", array()), "loop", array()), "index", array()), "html", null, true);
                        echo "_";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["Category"], "id", array()), "html", null, true);
                        echo "\" href=\"";
                        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("product_list");
                        echo "?category_id=";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["Category"], "id", array()), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["Category"], "name", array()), "html", null, true);
                        echo "</a></li>
  <!-- ★ここに追加★ -->
  ";
                    } elseif ((($this->getAttribute($this->getAttribute(                    // line 642
$context["ProductCategory"], "Category", array()), "level", array()) == 2) && ((isset($context["CategoryLevel"]) ? $context["CategoryLevel"] : null) == 0))) {
                        // line 643
                        echo "  <!-- ★ここに追加★ -->
<li><a id=\"relative_category_box__relative_category--";
                        // line 644
                        echo twig_escape_filter($this->env, $this->getAttribute($context["ProductCategory"], "product_id", array()), "html", null, true);
                        echo "_";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["loop"], "parent", array()), "loop", array()), "index", array()), "html", null, true);
                        echo "_";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["Category"], "id", array()), "html", null, true);
                        echo "\" href=\"";
                        echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("product_list");
                        echo "?category_id=";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["Category"], "id", array()), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["Category"], "name", array()), "html", null, true);
                        echo "</a></li>
  <!-- ★ここに追加★ -->
  ";
                    }
                    // line 647
                    echo "  ";
                }
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Category'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 649
            echo "</ol>
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ProductCategory'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 651
        echo "</div>
<!-- ▲関連カテゴリ▲ -->
<!-- ▼item_detail▼ -->
<div id=\"item_detail\">
<div id=\"detail_wrap\" class=\"row\">
<!--★画像★-->
<div id=\"item_photo_area\" class=\"col-sm-6\">
<div id=\"detail_image_box__slides\" class=\"slides\">
";
        // line 659
        if ((twig_length_filter($this->env, $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "ProductImage", array())) > 0)) {
            // line 660
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "ProductImage", array()));
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
            foreach ($context['_seq'] as $context["_key"] => $context["ProductImage"]) {
                // line 661
                echo "<div id=\"detail_image_box__item--";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                echo "\"><img src=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "image_save_urlpath", array()), "html", null, true);
                echo "/";
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getNoImageProduct($context["ProductImage"]), "html", null, true);
                echo "\"/></div>
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ProductImage'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 664
            echo "<div id=\"detail_image_box__item\"><img src=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "image_save_urlpath", array()), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getNoImageProduct(""), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "image_save_urlpath", array()), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getNoImageProduct(""), "html", null, true);
            echo "\" />
</div>
";
        }
        // line 667
        echo "</div>
</div>

<section id=\"item_detail_area\" class=\"col-sm-6\">

<!--★商品名★-->
<!-- <h3 id=\"detail_description_box__name\" class=\"item_name1\">";
        // line 673
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "name", array()), "html", null, true);
        echo "</h3>-->
<div id=\"detail_description_box__body\" class=\"item_detail\">

";
        // line 676
        if ( !twig_test_empty($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "ProductTag", array()))) {
            // line 677
            echo "<!--▼商品タグ-->
<div id=\"product_tag_box\" class=\"product_tag\">
";
            // line 679
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "ProductTag", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["ProductTag"]) {
                // line 680
                echo "<span id=\"product_tag_box__product_tag--";
                echo twig_escape_filter($this->env, $this->getAttribute($context["ProductTag"], "id", array()), "html", null, true);
                echo "\" class=\"product_tag_list\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["ProductTag"], "Tag", array()), "html", null, true);
                echo "</span>
";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ProductTag'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 682
            echo "</div>
<!--▲商品タグ-->
";
        }
        // line 685
        echo "<h1 id=\"detail_description_box__name\" class=\"item_name1\">";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "name", array()), "html", null, true);
        echo "</h1>

<!--▼フリーエリア-->
";
        // line 688
        if ($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "freearea", array())) {
            // line 689
            echo "<div id=\"sub_area\" class=\"row\">
<div class=\"col-sm-11\">
<div id=\"detail_free_box__freearea\" class=\"freearea\"><h2>";
            // line 691
            echo twig_include($this->env, $context, twig_template_from_string($this->env, $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "freearea", array())));
            echo "</h2></div>
</div>
</div>
";
        }
        // line 695
        echo "<!--▲フリーエリア-->

<!--★通常価格★-->
";
        // line 698
        if ($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "hasProductClass", array())) {
            // line 699
            if (( !(null === $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "getPrice01Min", array())) && ($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "getPrice01IncTaxMin", array()) == $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "getPrice01IncTaxMax", array())))) {
                // line 700
                echo "<p id=\"detail_description_box__class_normal_price\" class=\"normal_price\"> 通常価格：<span class=\"price01_default\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "getPrice01IncTaxMin", array())), "html", null, true);
                echo "</span> <span class=\"small\">税込</span></p>
";
            } elseif (( !(null === $this->getAttribute(            // line 701
(isset($context["Product"]) ? $context["Product"] : null), "getPrice01Min", array())) &&  !(null === $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "getPrice01Max", array())))) {
                // line 702
                echo "<p id=\"detail_description_box__class_normal_range_price\" class=\"normal_price\"> 通常価格：<span class=\"price01_default\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "getPrice01IncTaxMin", array())), "html", null, true);
                echo " ～ ";
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "getPrice01IncTaxMax", array())), "html", null, true);
                echo "</span> <span class=\"small\">税込</span></p>
";
            }
        } else {
            // line 705
            if ( !(null === $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "getPrice01Max", array()))) {
                // line 706
                echo "<p id=\"detail_description_box__normal_price\" class=\"normal_price\"> 通常価格：<span class=\"price01_default\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "getPrice01IncTaxMin", array())), "html", null, true);
                echo "</span> <span class=\"small\">税込</span></p>
";
            }
        }
        // line 710
        echo "<!--★販売価格★-->
";
        // line 711
        if ($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "hasProductClass", array())) {
            // line 712
            if (($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "getPrice02IncTaxMin", array()) == $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "getPrice02IncTaxMax", array()))) {
                // line 713
                echo "<p id=\"detail_description_box__class_sale_price\" class=\"sale_price text-primary\"> <span class=\"price02_default\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "getPrice02IncTaxMin", array())), "html", null, true);
                echo "</span> <span class=\"small\">税込</span></p>
";
            } else {
                // line 715
                echo "<p id=\"detail_description_box__class_range_sale_price\" class=\"sale_price text-primary\"> <span class=\"price02_default\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "getPrice02IncTaxMin", array())), "html", null, true);
                echo " ～ ";
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "getPrice02IncTaxMax", array())), "html", null, true);
                echo "</span> <span class=\"small\">税込</span></p>
";
            }
        } else {
            // line 718
            echo "<p id=\"detail_description_box__sale_price\" class=\"sale_price text-primary\"> <span class=\"price02_default\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "getPrice02IncTaxMin", array())), "html", null, true);
            echo "</span> <span class=\"small\">税込</span></p>
";
        }
        // line 720
        echo "<!--<span>税金</span><span id=\"h-price\"></span>-->
<script>

</script>
<!--▼送料-->
<div class=\"gui\">
<p>東京都は 送料 1点<span id=\"gui\"></span>円,　追加＋500円 </p>
このストアで20,000円以上購入で<span style=\" background: #ff7434;padding: 5px;color: #fff;\">送料無料</span>
</div>
<!--▲送料-->
<script>
<!--
\$gui=950;
document.getElementById(\"gui\").innerHTML=\$gui;
//-->
</script>

<!--▼商品コード-->
<p id=\"detail_description_box__sale_point\" class=\"text-primary\">
            加算ポイント：<span>137</span><span class=\"small\">pt</span> ～
        <span>162</span><span class=\"small\">pt</span>
    </p>

<p id=\"detail_description_box__item_range_code\" class=\"item_code\">商品コード： <span id=\"item_code_default\">
";
        // line 744
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "code_min", array()), "html", null, true);
        echo "
";
        // line 745
        if (($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "code_min", array()) != $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "code_max", array()))) {
            echo " ～ ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "code_max", array()), "html", null, true);
        }
        // line 746
        echo "</span> </p>
<!--▲商品コード-->

<form action=\"?\" method=\"post\" id=\"form1\" name=\"form1\">
<!--▼買い物かご-->
<div id=\"detail_cart_box\" class=\"cart_area\">
";
        // line 752
        if ($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "stock_find", array())) {
            // line 754
            if ($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "classcategory_id1", array(), "any", true, true)) {
                // line 755
                echo "<ul id=\"detail_cart_box__cart_class_category_id\" class=\"classcategory_list\">
";
                // line 757
                echo "<li> 
<p>";
                // line 758
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["class_name"]) ? $context["class_name"] : null), "class_name1", array()), "name", array()), "html", null, true);
                echo "</p>
";
                // line 759
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "classcategory_id1", array()), 'label');
                echo "
";
                // line 760
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "classcategory_id1", array()), 'widget');
                echo "
";
                // line 761
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "classcategory_id1", array()), 'errors');
                echo "
</li>
";
                // line 764
                if ($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "classcategory_id2", array(), "any", true, true)) {
                    // line 765
                    echo "<li> 
";
                    // line 766
                    echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "classcategory_id2", array()), 'label');
                    echo "
";
                    // line 767
                    echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "classcategory_id2", array()), 'widget');
                    echo "
";
                    // line 768
                    echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "classcategory_id2", array()), 'errors');
                    echo "
</li>
";
                }
                // line 771
                echo "</ul>
";
            }
            // line 773
            echo "

";
            // line 785
            echo "
<style>
.form-control {
  width: 100%;
}

textarea.form-control {
  height: 7em;
}

@media only screen and (min-width: 768px) {
  .form-control {
    width: 350px;
  }
}
</style>

";
            // line 802
            if (array_key_exists("ProductOptions", $context)) {
                // line 803
                echo "    ";
                if ((isset($context["ProductOptions"]) ? $context["ProductOptions"] : null)) {
                    // line 804
                    echo "        <ul class=\"classcategory_list\">
            ";
                    // line 805
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable((isset($context["ProductOptions"]) ? $context["ProductOptions"] : null));
                    foreach ($context['_seq'] as $context["_key"] => $context["ProductOption"]) {
                        // line 806
                        echo "                ";
                        $context["value"] = ("productoption" . $this->getAttribute($this->getAttribute($context["ProductOption"], "Option", array()), "id", array()));
                        // line 807
                        echo "                <li>";
                        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), (isset($context["value"]) ? $context["value"] : null), array(), "array"), 'label');
                        echo "
                    ";
                        // line 808
                        if (($this->getAttribute($this->getAttribute($context["ProductOption"], "Option", array()), "description_flg", array()) == 1)) {
                            // line 809
                            echo "                        &nbsp;<a href=\"?\" id=\"option_description_link_";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["ProductOption"], "Option", array()), "id", array()), "html", null, true);
                            echo "\">詳細説明</a>
                    ";
                        }
                        // line 811
                        echo "                </li>
                <li ";
                        // line 812
                        if ( !twig_test_empty($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), (isset($context["value"]) ? $context["value"] : null), array(), "array"), "vars", array()), "errors", array()))) {
                            echo "class=\"has-error\"";
                        }
                        echo ">
                    ";
                        // line 813
                        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), (isset($context["value"]) ? $context["value"] : null), array(), "array"), 'widget', array("attr" => array("onChange" => "onOptionChange()")));
                        echo "
                    ";
                        // line 814
                        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), (isset($context["value"]) ? $context["value"] : null), array(), "array"), 'errors');
                        echo "
                </li>
            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ProductOption'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 817
                    echo "        </ul>
    ";
                }
            }
            // line 819
            echo "<dl id=\"detail_cart_box__cart_quantity\" class=\"quantity\">
<dt>数量</dt>
<dd>
";
            // line 822
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "quantity", array()), 'widget');
            echo "
";
            // line 823
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "quantity", array()), 'errors');
            echo "
<div class=\"pl-mi-btn\">
<label for=\"num-plus\" class=\"pm-btn plus\"></label>
<label for=\"num-minus\" class=\"pm-btn minus\"></label>
</div>
<style>
.pl-mi-btn {
box-sizing: border-box;
display: inline-block;
padding: 2px;
height: 30px;
vertical-align: bottom;
}
.pl-mi-btn .pm-btn {
background: #fcfcfc;
border-radius: 50%;
cursor: pointer;
display: inline-block;
font-weight: bold;
height: 24px;
margin: 0 5px;
position: relative;
text-align: center;
vertical-align: middle;
width: 24px;
}
.pl-mi-btn .pm-btn:before,
.pl-mi-btn .pm-btn.plus:after {
background: #666;
border-radius: 2px;
bottom: 0;
content: '';
display: block;
height: 2px;
left: 0;
margin: auto;
position: absolute;
right: 0;
top: 0;
width: 16px;
}
.pl-mi-btn .pm-btn.plus:after {
height: 16px;
width: 2px;
}
</style>

<script>
<!--
\$('.pm-btn.plus').on('click', function(){
var \$inquantity = \$('#quantity');
var num = \$inquantity.val();
num++;
\$inquantity.val(num);
\$inquantity.text(num);
});

\$('.pm-btn.minus').on('click', function(){
var \$inquantity = \$('#quantity');
var num = \$inquantity.val();
if(num > 1){
num--;
\$inquantity.val(num);
\$inquantity.text(num);
}
});
//-->
</script>
</dd>
</dl>

<div class=\"extra-form\">
";
            // line 895
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "getIterator", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
                // line 896
                if (preg_match("[^plg*]", $this->getAttribute($this->getAttribute($context["f"], "vars", array()), "name", array()))) {
                    // line 897
                    echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["f"], 'row');
                    echo "
";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['f'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 900
            echo "</div>

";
            // line 903
            echo "<div id=\"detail_cart_box__button_area\" class=\"btn_area\">
<ul id=\"detail_cart_box__insert_button\" class=\"row\">
<li class=\"col-xs-12 col-sm-12 kato\"><button type=\"submit\" id=\"add-cart\" class=\"btn btn-primary btn-block prevention-btn prevention-mask\"> カートに入れる</button></li>
</ul>
";
            // line 907
            if (($this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "option_favorite_product", array()) == 1)) {
                // line 908
                echo "<ul id=\"detail_cart_box__favorite_button\" class=\"row\">
";
                // line 909
                if (((isset($context["is_favorite"]) ? $context["is_favorite"] : null) == false)) {
                    // line 910
                    echo "<li class=\"col-xs-12 col-sm-12 kato\"><button type=\"submit\" id=\"favorite\" class=\"btn btn-info btn-block prevention-btn prevention-mask\">お気に入りに追加</button></li>
";
                } else {
                    // line 912
                    echo "<li class=\"col-xs-12 col-sm-12 kato\"><button type=\"submit\" id=\"favorite\" class=\"btn btn-info btn-block\" disabled=\"disabled\">お気に入りに追加済みです</button></li>
";
                }
                // line 914
                echo "</ul>
";
            }
            // line 916
            echo "</div>
";
        } else {
            // line 919
            echo "<div id=\"detail_cart_box__button_area\" class=\"btn_area\">
<ul class=\"row\">
<li class=\"col-xs-12 col-sm-8\"><button type=\"button\" class=\"btn btn-default btn-block\" disabled=\"disabled\">ただいま品切れ中です</button></li>
</ul>
</div>
";
        }
        // line 925
        echo "</div>
<!--▲買い物かご-->
";
        // line 927
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'rest');
        echo "
</form>
<!-- ▼商品レビュー▼ -->
<!--# product-review-plugin-tag #-->";
        // line 940
        echo "
";
        // line 947
        echo "
<style type=\"text/css\">
    #product_review_area {
        border-top: 1px solid #E8E8E8;
        padding-bottom: 0;
    }
    #product_review_area dl dt {
        padding: 16px 0;
        cursor: pointer;
    }
    #product_review_area dl dt:hover {
        color: #9797A0;
    }
    #product_review_area dl dt.active .cb {
        transform: rotate(180deg);
    }
    #product_review_area dl dt .cb {
        position: absolute;
        right: 16px;
        top: 17px;
    }
    #product_review_area dl dd {
        display: none;
        padding-bottom: 0;
    }
    #product_review_area .review_btn a {
        margin: 0 auto;
        padding: 16px;
        width: 100%;
    }
    #product_review_area .review_list {
        padding: 8px 0;
    }
    #product_review_area .review_list li {
        padding: 8px 0;
    }
    #product_review_area .review_list p {
        margin: 0px 0;
    }
    #product_review_area .review_list .review_date {
        font-weight: bold;
    }
    #product_review_area .recommend_average {
        margin-left: 16px;
        color: #DE5D50;
    }
    #product_review_area .review_list .recommend_level {
        margin-left: 16px;
        color: #DE5D50;
    }
    #product_review_area .review_list .recommend_name {
        margin-left: 16px;
    }
    
    @media only screen and (min-width: 768px) {
        #product_review_area {
            border-top: none;
            padding-bottom: 1px;
        }
        #product_review_area dl dt {
            padding: 16px;
        }
        #product_review_area dl dt .cb {
            position: absolute;
            right: 32px;
            top: 24px;
            font-size: 16px;
            font-size: 1.6rem;
        }
        #product_review_area dl dd {
            display: block;
            padding: 0 ;
        }
        #product_review_area .review_btn {
            padding: 16px 0 0;
            text-align: center;
        }
        #product_review_area .review_btn a {
            width: auto;
            min-width: 350px;
        }
        #product_review_area .review_list li {
            padding: 8px;
            border: 1px solid #dfdbdb;
            margin-bottom: 5px;
            background: #fbf6ec;
        }
        #product_review_area .review_list p {
            margin: 0px 0;
        }
    }
</style>

<!--▼レビューエリア-->
<div id=\"product_review_area\" class=\"row\">
    <div class=\"col-sm-12 \">
        <div class=\"accordion\">
            <dl>
                ";
        // line 1045
        $context["positive_avg_star"] = (isset($context["avg"]) ? $context["avg"] : null);
        // line 1046
        echo "                ";
        $context["nagative_avg_star"] = (5 - (isset($context["positive_avg_star"]) ? $context["positive_avg_star"] : null));
        // line 1047
        echo "                <dt class=\"heading02 sp\">
                    この商品のレビュー
                    
                    <!--平均の星の数-->
                    <span class=\"recommend_average\">
                        ";
        // line 1052
        echo $this->getAttribute($this, "stars", array(0 => (isset($context["positive_avg_star"]) ? $context["positive_avg_star"] : null), 1 => (isset($context["nagative_avg_star"]) ? $context["nagative_avg_star"] : null)), "method");
        echo "
                    </span>
                    
                    <!--レビュー数-->
                    <span>
                        (";
        // line 1057
        echo twig_escape_filter($this->env, (isset($context["number"]) ? $context["number"] : null), "html", null, true);
        echo ")
                    </span>
                    <svg class=\"cb cb-angle-down\"><use xlink:href=\"#cb-angle-down\" /></svg>
                </dt>
                <dt class=\"heading02 pc active\">
                    この商品のレビュー
                    
                    <!--平均の星の数-->
                    <span class=\"recommend_average\">
                        ";
        // line 1066
        echo $this->getAttribute($this, "stars", array(0 => (isset($context["positive_avg_star"]) ? $context["positive_avg_star"] : null), 1 => (isset($context["nagative_avg_star"]) ? $context["nagative_avg_star"] : null)), "method");
        echo "
                    </span>
                    
                    <svg class=\"cb cb-angle-down\"><use xlink:href=\"#cb-angle-down\" /></svg>
                </dt>
                <dd>
                    ";
        // line 1072
        if ((isset($context["ProductReviews"]) ? $context["ProductReviews"] : null)) {
            // line 1073
            echo "                        <ul class=\"review_list\">
                            ";
            // line 1074
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["ProductReviews"]) ? $context["ProductReviews"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["ProductReview"]) {
                // line 1075
                echo "                                <li>
                                    <p class=\"review_date\">
                                        <!--投稿日-->
                                        ";
                // line 1078
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getDateFormatFilter($this->getAttribute($context["ProductReview"], "create_date", array())), "html", null, true);
                echo "
                                        
                                        <!--投稿者-->
                                        <span class=\"recommend_name\">
                                            ";
                // line 1082
                if ($this->getAttribute($context["ProductReview"], "reviewer_url", array())) {
                    // line 1083
                    echo "                                                <a href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["ProductReview"], "reviewer_url", array()), "html", null, true);
                    echo "\" target=\"_blank\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["ProductReview"], "reviewer_name", array()), "html", null, true);
                    echo "さん</a>
                                            ";
                } else {
                    // line 1085
                    echo "                                                ";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["ProductReview"], "reviewer_name", array()), "html", null, true);
                    echo "さん
                                            ";
                }
                // line 1087
                echo "                                        </span>
                                        
                                        <!--星の数-->
                                        ";
                // line 1090
                $context["positive_star"] = $this->getAttribute($context["ProductReview"], "recommend_level", array());
                // line 1091
                echo "                                        ";
                $context["nagative_star"] = (5 - (isset($context["positive_star"]) ? $context["positive_star"] : null));
                // line 1092
                echo "                                        <span class=\"recommend_level\">
                                            ";
                // line 1093
                echo $this->getAttribute($this, "stars", array(0 => (isset($context["positive_star"]) ? $context["positive_star"] : null), 1 => (isset($context["nagative_star"]) ? $context["nagative_star"] : null)), "method");
                echo "
                                        </span>
                                    </p>
                                    
                                    <!--タイトル-->
                                    <strong>";
                // line 1098
                echo twig_escape_filter($this->env, $this->getAttribute($context["ProductReview"], "title", array()), "html", null, true);
                echo "</strong>
                                    
                                    <!--レビューコメント-->
                                    <p>";
                // line 1101
                echo nl2br(twig_escape_filter($this->env, $this->getAttribute($context["ProductReview"], "comment", array()), "html", null, true));
                echo "</p>
                                </li>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ProductReview'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 1104
            echo "                        </ul>
                    ";
        }
        // line 1106
        echo "                </dd>
            </dl>
        </div>
        <div class=\"review_btn\">
            <a href=\"";
        // line 1110
        echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("plugin_products_detail_review", array("id" => (isset($context["id"]) ? $context["id"] : null))), "html", null, true);
        echo "\" class=\"btn btn-info\">レビューを書く</a>
        </div>
    </div>
</div>
<!-- ▲レビューエリア -->


<!-- ▲商品レビュー▲ -->
</div>
<!-- /.item_detail -->

</section>
<!--詳細ここまで-->
</div>
";
        // line 1125
        echo "<p id=\"detail_not_stock_box__description_detail\" class=\"item_comment\"><div  class=\"h-button\" style=\"margin:5px 0;\"><button>商品の詳細</button></div></p>
<script>
\$(document).ready(function(){
\$(\"button\").click(function(){
\$(\"#h-dt-image\").slideToggle(\"slow\");
});
});
</script>
<style>
.h-button {
border-bottom: 0.5px dotted #cac6c6;
}
.h-button button {
background: #ff7434;
color: #fff;
padding: 2px 5px;
}
.h-image{
text-align: center;
margin: 10px;
}
</style>
<div id=\"h-dt-image\" class=\"col-sm-12\">
<div id=\"detail_image_box__slides1\" class=\"slides1\">
";
        // line 1149
        if ((twig_length_filter($this->env, $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "ProductImage", array())) > 0)) {
            // line 1150
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "ProductImage", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["ProductImage"]) {
                // line 1151
                echo "<div class=\"h-image\"><img src=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "image_save_urlpath", array()), "html", null, true);
                echo "/";
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getNoImageProduct($context["ProductImage"]), "html", null, true);
                echo "\" alt=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "name", array()), "html", null, true);
                echo "\"/>
</div>
";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ProductImage'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 1155
            echo "<div class=\"h-image\"><img src=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "image_save_urlpath", array()), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getNoImageProduct(""), "html", null, true);
            echo "\"/>
</div>
";
        }
        // line 1158
        echo "</div>
<p>";
        // line 1159
        echo $this->getAttribute((isset($context["Product"]) ? $context["Product"] : null), "description_detail", array());
        echo "</p>
</div>

<!-- ▼関連商品▼ -->
<!--# related-product-plugin-tag #-->";
        // line 1172
        echo "<style type=\"text/css\">
    .product_page .product_item a {
        padding-bottom: 0;
    }
    #sub_area, #related_product_area{padding-bottom: 0;}
</style>
<div id=\"related_product_area\" class=\"row\">
    <div class=\"col-sm-12\">
        <h2 class=\"heading03\">関連商品</h2>
        <div class=\"related_product_carousel\">
            ";
        // line 1182
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["RelatedProducts"]) ? $context["RelatedProducts"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["RelatedProduct"]) {
            // line 1183
            echo "                <div class=\"product_item\">
                    <a href=\"";
            // line 1184
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getUrl("product_detail", array("id" => $this->getAttribute($this->getAttribute($context["RelatedProduct"], "ChildProduct", array()), "id", array()))), "html", null, true);
            echo "\">
                        <div class=\"item_photo\">
                            <img src=\"";
            // line 1186
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "image_save_urlpath", array()), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getNoImageProduct($this->getAttribute($this->getAttribute($context["RelatedProduct"], "ChildProduct", array()), "main_list_image", array())), "html", null, true);
            echo "\">
                        </div>
                        <dl>
                            <!--<dt class=\"h-name\">";
            // line 1189
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["RelatedProduct"], "ChildProduct", array()), "name", array()), "html", null, true);
            echo "</dt>-->
                            <dd class=\"item_price\">
                                ";
            // line 1191
            if ($this->getAttribute($this->getAttribute($context["RelatedProduct"], "ChildProduct", array()), "hasProductClass", array())) {
                // line 1192
                echo "                                    ";
                if (($this->getAttribute($this->getAttribute($context["RelatedProduct"], "ChildProduct", array()), "getPrice02Min", array()) == $this->getAttribute($this->getAttribute($context["RelatedProduct"], "ChildProduct", array()), "getPrice02Max", array()))) {
                    // line 1193
                    echo "                                        ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($this->getAttribute($context["RelatedProduct"], "ChildProduct", array()), "getPrice02IncTaxMin", array())), "html", null, true);
                    echo "
                                    ";
                } else {
                    // line 1195
                    echo "                                        ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($this->getAttribute($context["RelatedProduct"], "ChildProduct", array()), "getPrice02IncTaxMin", array())), "html", null, true);
                    echo " ～ ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($this->getAttribute($context["RelatedProduct"], "ChildProduct", array()), "getPrice02IncTaxMax", array())), "html", null, true);
                    echo "
                                    ";
                }
                // line 1197
                echo "                                ";
            } else {
                // line 1198
                echo "                                    ";
                echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($this->getAttribute($context["RelatedProduct"], "ChildProduct", array()), "getPrice02IncTaxMin", array())), "html", null, true);
                echo "
                                ";
            }
            // line 1200
            echo "                            </dd>
                            <dd class=\"item_comment\">";
            // line 1201
            echo $this->getAttribute($context["RelatedProduct"], "content", array());
            echo "</dd>
                        </dl>
                    </a>
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['RelatedProduct'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1206
        echo "        </div>
    </div>
</div>

";
        // line 1211
        echo "<script src=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "front_urlpath", array()), "html", null, true);
        echo "/../../plugin/relatedproduct/assets/js/related_product_plugin.js\"></script>
<link rel=\"stylesheet\" href=\"";
        // line 1212
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "front_urlpath", array()), "html", null, true);
        echo "/../../plugin/relatedproduct/assets/css/related_product_plugin.css\">

<!-- ▲関連商品▲ -->

</div>

";
        // line 1227
        echo "
<style>
.option_description {
  -moz-box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
  -webkit-box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
  -moz-border-radius: 6px;
  -webkit-border-radius: 6px;
  border-radius: 6px;
  display: none;
  min-width: 50%;
  max-width: 80%;
  max-height: 80%;
  background-color: #fff;
  border: 1px solid rgba(0, 0, 0, 0.2);
  overflow:auto;
}
.option_description .modal-header {
  padding: 15px;
  border-bottom: 1px solid #e5e5e5;
}
.option_description .modal-header .plainmodal-close {
  margin-top: -2px;
  float: right;
  font-size: 2.1rem;
  font-weight: 700;
  color: #000;
  text-shadow: 0 1px 0 #fff;
  opacity: 0.2;
}
.option_description .modal-header .plainmodal-close:hover {
  opacity: 0.5;
}

.option_description .modal-header > p {
  margin: 1% 0 0 0;
  font-size: 1.4rem;
  line-height: 1.42857143;    
}

.option_description .modal-title {
  color: #333333;
  font-size: 1.8rem;
  font-weight: 500;
  font-family: inherit;
  margin: 0;
}
.option_description .modal-body {
  padding: 3%;
  font-size: 1.4rem;
  line-height: 1.42857143;
  color: #333;
}
.option_description .modal-body > p {
    margin: 0 0 3%;
}
.option_description .modal-body > div {
    margin-bottom: 2%;
    overflow: hidden;
    padding-bottom: 2%;
}
.option_description .modal-body > div > p {
    margin: 2% 0 0;
}
.option_description img {
    float: none;
    margin: 1% auto 0;
    width: 40%;
    height: auto;
    display: block;
}
.option_description h3 {
    margin: 0;
    background: #efefef;
    padding: 1%;
}
.option_description .minus {
    color: #2980b9;
}
@media screen and (min-width: 768px) {
    .option_description img {
        float: left;
        margin: 1% 4% 0 0;
        width: 15%;
    }
}

.option_description span.small {
    font-size: 1.2rem;
}

.option_description .btn-info {
    width: 74px;
    float: none;
    margin: 15px auto 10px;
    border: 0;
    padding: 4px 0;
    display: block;
}

.option_description .btn-info:hover {
    background: #474757;
}

@media only screen and (min-width: 768px) {
    .option_description .btn-info {
    \tfloat: right;
        margin: 0 10px 0 0;
    }

}

</style>

";
        // line 1341
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["ProductOptions"]) ? $context["ProductOptions"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["ProductOption"]) {
            // line 1342
            echo "    ";
            $context["Option"] = $this->getAttribute($context["ProductOption"], "Option", array());
            // line 1343
            echo "    ";
            if (($this->getAttribute((isset($context["Option"]) ? $context["Option"] : null), "description_flg", array()) == 1)) {
                // line 1344
                echo "        <div id=\"option_description_";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Option"]) ? $context["Option"] : null), "id", array()), "html", null, true);
                echo "\" class=\"option_description\">
            <div class=\"modal-header\">
                <div class=\"plainmodal-close\">&#215;</div>
                <h4 class=\"modal-title\">";
                // line 1347
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Option"]) ? $context["Option"] : null), "name", array()), "html", null, true);
                echo "</h4>
                <p>";
                // line 1348
                echo nl2br($this->getAttribute((isset($context["Option"]) ? $context["Option"] : null), "description", array()));
                echo "</p>
            </div>

            ";
                // line 1351
                if ((twig_length_filter($this->env, $this->getAttribute((isset($context["Option"]) ? $context["Option"] : null), "OptionCategories", array())) > 0)) {
                    // line 1352
                    echo "            <div class=\"modal-body\">
                    ";
                    // line 1353
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["Option"]) ? $context["Option"] : null), "OptionCategories", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["optionCategory"]) {
                        // line 1354
                        echo "                        ";
                        if (($this->getAttribute($context["optionCategory"], "disable_flg", array()) != 1)) {
                            // line 1355
                            echo "                            <div>
                                <h3>";
                            // line 1356
                            echo twig_escape_filter($this->env, $this->getAttribute($context["optionCategory"], "name", array()), "html", null, true);
                            echo "</h3>
                                ";
                            // line 1357
                            if ($this->getAttribute($context["optionCategory"], "option_image", array())) {
                                // line 1358
                                echo "                                    <img src=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "image_save_urlpath", array()), "html", null, true);
                                echo "/";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["optionCategory"], "option_image", array()), "html", null, true);
                                echo "\"/>
                                ";
                            }
                            // line 1360
                            echo "                                <p>";
                            echo nl2br($this->getAttribute($context["optionCategory"], "description", array()));
                            echo "</p>
                                ";
                            // line 1361
                            if ((twig_length_filter($this->env, $this->getAttribute($context["optionCategory"], "value", array())) > 0)) {
                                // line 1362
                                echo "                                    ";
                                if (($this->getAttribute($context["optionCategory"], "value", array()) > 0)) {
                                    // line 1363
                                    echo "                                        <p class=\"plus\">価格：";
                                    echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($context["optionCategory"], "value", array())), "html", null, true);
                                    echo " <span class=\"small\">+ 税</span></p>
                                    ";
                                } elseif (($this->getAttribute(                                // line 1364
$context["optionCategory"], "value", array()) < 0)) {
                                    // line 1365
                                    echo "                                        <p class=\"minus\">価格：";
                                    echo twig_escape_filter($this->env, $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPriceFilter($this->getAttribute($context["optionCategory"], "value", array())), "html", null, true);
                                    echo " <span class=\"small\">+ 税</span></p>
                                    ";
                                }
                                // line 1367
                                echo "                                ";
                            }
                            // line 1368
                            echo "                                ";
                            if (($this->getAttribute($context["optionCategory"], "delivery_free_flg", array()) == 1)) {
                                // line 1369
                                echo "                                    <p>送料無料</p>
                                ";
                            }
                            // line 1371
                            echo "                                <button class=\"btn-info\" id=\"desc_btn_";
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["Option"]) ? $context["Option"] : null), "id", array()), "html", null, true);
                            echo "_";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["optionCategory"], "id", array()), "html", null, true);
                            echo "\" >選択する</button>
                            </div>
                        ";
                        }
                        // line 1374
                        echo "                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['optionCategory'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 1375
                    echo "                </div>
            ";
                }
                // line 1377
                echo "        </div>
    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ProductOption'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    // line 942
    public function getstars($__positive__ = null, $__negative__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "positive" => $__positive__,
            "negative" => $__negative__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 943
            echo "    ";
            $context["positive_stars"] = array(0 => "", 1 => "★", 2 => "★★", 3 => "★★★", 4 => "★★★★", 5 => "★★★★★");
            // line 944
            echo "    ";
            $context["negative_stars"] = array(0 => "", 1 => "☆", 2 => "☆☆", 3 => "☆☆☆", 4 => "☆☆☆☆", 5 => "☆☆☆☆☆");
            // line 945
            echo "    ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["positive_stars"]) ? $context["positive_stars"] : null), (isset($context["positive"]) ? $context["positive"] : null), array(), "array"), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["negative_stars"]) ? $context["negative_stars"] : null), (isset($context["negative"]) ? $context["negative"] : null), array(), "array"), "html", null, true);
            echo "
";
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
        return "__string_template__5a9af7197aff176e2890e8ad8a98ba9b33a1dd9962f7a0ebc4428a57fdfa9504";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  2142 => 945,  2139 => 944,  2136 => 943,  2123 => 942,  2113 => 1377,  2109 => 1375,  2103 => 1374,  2094 => 1371,  2090 => 1369,  2087 => 1368,  2084 => 1367,  2078 => 1365,  2076 => 1364,  2071 => 1363,  2068 => 1362,  2066 => 1361,  2061 => 1360,  2053 => 1358,  2051 => 1357,  2047 => 1356,  2044 => 1355,  2041 => 1354,  2037 => 1353,  2034 => 1352,  2032 => 1351,  2026 => 1348,  2022 => 1347,  2015 => 1344,  2012 => 1343,  2009 => 1342,  2005 => 1341,  1889 => 1227,  1880 => 1212,  1875 => 1211,  1869 => 1206,  1858 => 1201,  1855 => 1200,  1849 => 1198,  1846 => 1197,  1838 => 1195,  1832 => 1193,  1829 => 1192,  1827 => 1191,  1822 => 1189,  1814 => 1186,  1809 => 1184,  1806 => 1183,  1802 => 1182,  1790 => 1172,  1783 => 1159,  1780 => 1158,  1771 => 1155,  1756 => 1151,  1752 => 1150,  1750 => 1149,  1724 => 1125,  1707 => 1110,  1701 => 1106,  1697 => 1104,  1688 => 1101,  1682 => 1098,  1674 => 1093,  1671 => 1092,  1668 => 1091,  1666 => 1090,  1661 => 1087,  1655 => 1085,  1647 => 1083,  1645 => 1082,  1638 => 1078,  1633 => 1075,  1629 => 1074,  1626 => 1073,  1624 => 1072,  1615 => 1066,  1603 => 1057,  1595 => 1052,  1588 => 1047,  1585 => 1046,  1583 => 1045,  1483 => 947,  1480 => 940,  1474 => 927,  1470 => 925,  1462 => 919,  1458 => 916,  1454 => 914,  1450 => 912,  1446 => 910,  1444 => 909,  1441 => 908,  1439 => 907,  1433 => 903,  1429 => 900,  1420 => 897,  1418 => 896,  1414 => 895,  1339 => 823,  1335 => 822,  1330 => 819,  1325 => 817,  1316 => 814,  1312 => 813,  1306 => 812,  1303 => 811,  1297 => 809,  1295 => 808,  1290 => 807,  1287 => 806,  1283 => 805,  1280 => 804,  1277 => 803,  1275 => 802,  1256 => 785,  1252 => 773,  1248 => 771,  1242 => 768,  1238 => 767,  1234 => 766,  1231 => 765,  1229 => 764,  1224 => 761,  1220 => 760,  1216 => 759,  1212 => 758,  1209 => 757,  1206 => 755,  1204 => 754,  1202 => 752,  1194 => 746,  1189 => 745,  1185 => 744,  1159 => 720,  1153 => 718,  1144 => 715,  1138 => 713,  1136 => 712,  1134 => 711,  1131 => 710,  1124 => 706,  1122 => 705,  1113 => 702,  1111 => 701,  1106 => 700,  1104 => 699,  1102 => 698,  1097 => 695,  1090 => 691,  1086 => 689,  1084 => 688,  1077 => 685,  1072 => 682,  1061 => 680,  1057 => 679,  1053 => 677,  1051 => 676,  1045 => 673,  1037 => 667,  1024 => 664,  1002 => 661,  985 => 660,  983 => 659,  973 => 651,  958 => 649,  943 => 647,  927 => 644,  924 => 643,  922 => 642,  907 => 640,  904 => 639,  901 => 638,  898 => 637,  895 => 636,  878 => 635,  876 => 634,  869 => 633,  852 => 632,  848 => 630,  845 => 616,  841 => 614,  757 => 533,  753 => 532,  749 => 531,  744 => 530,  742 => 529,  739 => 528,  734 => 525,  730 => 523,  728 => 522,  699 => 500,  692 => 498,  685 => 497,  682 => 496,  679 => 495,  675 => 494,  672 => 493,  670 => 492,  667 => 491,  661 => 489,  659 => 488,  656 => 487,  643 => 468,  633 => 460,  567 => 459,  562 => 457,  558 => 456,  509 => 455,  505 => 454,  436 => 387,  430 => 384,  427 => 383,  425 => 382,  413 => 373,  48 => 10,  45 => 9,  36 => 6,  33 => 5,  29 => 1,  27 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__5a9af7197aff176e2890e8ad8a98ba9b33a1dd9962f7a0ebc4428a57fdfa9504", "");
    }
}
