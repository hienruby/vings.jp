<?php

/* __string_template__53e0162bed5b7f55f0996f1a18beca679dd3b7cfe0e05429583eece9ab72ffe9 */
class __TwigTemplate_803b98570ca98ec366f7701ca63ca5202167ac852ad35ddb45ca543e28c67ceb extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 22
        $this->parent = $this->loadTemplate("default_frame.twig", "__string_template__53e0162bed5b7f55f0996f1a18beca679dd3b7cfe0e05429583eece9ab72ffe9", 22);
        $this->blocks = array(
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
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 25
    public function block_javascript($context, array $blocks = array())
    {
        // line 26
        if (( !(null === $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "latitude", array())) &&  !(null === $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "longitude", array())))) {
            // line 27
            echo "<script src=\"//maps.googleapis.com/maps/api/js?sensor=false\"></script>
<script>
\$(function() {
    \$(\"#maps\").css({
        'margin-top': '15px',
        'margin-left': 'auto',
        'margin-right': 'auto',
        'width': '98%',
        'height': '300px'
    });
    var lat = ";
            // line 37
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "latitude", array()), "js"), "html", null, true);
            echo ";
    var lng = ";
            // line 38
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "longitude", array()), "js"), "html", null, true);
            echo ";
    if (lat && lng) {
        var latlng = new google.maps.LatLng(lat, lng);
        var mapOptions = {
            zoom: 15,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(\$(\"#maps\").get(0), mapOptions);
        var marker = new google.maps.Marker({map: map, position: latlng});
    } else {
        \$(\"#maps\").remove();
    }
});
</script>
";
        }
    }

    // line 56
    public function block_main($context, array $blocks = array())
    {
        // line 57
        echo "
<style>
.product_lf{
display:none;
}

.page-heading {
padding-bottom:0;
margin-bottom: 0;
}
</style>
    <div id=\"contents\" class=\"main_only\">
        <div class=\"container-fluid1 inner no-padding\">
            <div id=\"main1\">
                <h1 class=\"page-heading\">当サイトについて</h1>
                <div id=\"help_about\" class=\"container-fluid\">
                    <div id=\"help_about_box\" class=\"row\">
                        <div id=\"help_about_box__body\" class=\"col-md-10 col-md-offset-1\">
                            <div id=\"help_about_box__body_innner\" class=\"dl_table\">
                                ";
        // line 76
        if ($this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "shop_name", array(), "any", true, true)) {
            // line 77
            echo "                                    <dl id=\"help_about_box__shop_name\">
                                        <dt>店名</dt>
                                        <dd>";
            // line 79
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "shop_name", array()), "html", null, true);
            echo "</dd>
                                    </dl>
                                ";
        }
        // line 82
        echo "
                                ";
        // line 83
        if ($this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "company_name", array(), "any", true, true)) {
            // line 84
            echo "                                <dl id=\"help_about_box__company_name\">
                                    <dt>会社名</dt>
                                    <dd>";
            // line 86
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "company_name", array()), "html", null, true);
            echo "</dd>
                                </dl>
                                ";
        }
        // line 89
        echo "
                                ";
        // line 90
        if ($this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "zip01", array(), "any", true, true)) {
            // line 91
            echo "                                <dl id=\"help_about_box__zip\">
                                    <dt>所在地</dt>
                                    <dd>〒";
            // line 93
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "zip01", array()), "html", null, true);
            echo "-";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "zip02", array()), "html", null, true);
            echo "<br />
                                        ";
            // line 94
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "pref", array()), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "addr01", array()), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "addr02", array()), "html", null, true);
            echo "
                                    </dd>
                                </dl>
                                ";
        }
        // line 98
        echo "
                                ";
        // line 99
        if ($this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "tel01", array(), "any", true, true)) {
            // line 100
            echo "                                    <dl id=\"help_about_box__tel\">
                                        <dt>電話番号</dt>
                                        <dd>";
            // line 102
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "tel01", array()), "html", null, true);
            echo "-";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "tel02", array()), "html", null, true);
            echo "-";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "tel03", array()), "html", null, true);
            echo "</dd>
                                    </dl>
                                ";
        }
        // line 105
        echo "
                                ";
        // line 106
        if ($this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "fax01", array(), "any", true, true)) {
            // line 107
            echo "                                    <dl id=\"help_about_box__fax\">
                                        <dt>FAX番号</dt>
                                        <dd>";
            // line 109
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "fax01", array()), "html", null, true);
            echo "-";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "fax02", array()), "html", null, true);
            echo "-";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "fax03", array()), "html", null, true);
            echo "</dd>
                                    </dl>
                                ";
        }
        // line 112
        echo "
                                ";
        // line 113
        if ($this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "business_hour", array(), "any", true, true)) {
            // line 114
            echo "                                    <dl id=\"help_about_box__business_hour\">
                                        <dt>営業時間</dt>
                                        <dd>";
            // line 116
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "business_hour", array()), "html", null, true);
            echo "</dd>
                                    </dl>
                                ";
        }
        // line 119
        echo "
                                ";
        // line 120
        if ($this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "good_traded", array(), "any", true, true)) {
            // line 121
            echo "                                    <dl id=\"help_about_box__good_traded\">
                                        <dt>取扱商品</dt>
                                        <dd>";
            // line 123
            echo nl2br(twig_escape_filter($this->env, $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "good_traded", array()), "html", null, true));
            echo "</dd>
                                    </dl>
                                ";
        }
        // line 126
        echo "
                                ";
        // line 127
        if ($this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "message", array(), "any", true, true)) {
            // line 128
            echo "                                    <dl id=\"help_about_box__message\">
                                        <dt>メッセージ</dt>
                                        <dd>";
            // line 130
            echo nl2br(twig_escape_filter($this->env, $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "message", array()), "html", null, true));
            echo "</dd>
                                    </dl>
                                ";
        }
        // line 133
        echo "                            </div>

                            <div id=\"maps\"></div>

                        </div><!-- /.col -->
                    </div><!-- /.row -->

                </div>
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "__string_template__53e0162bed5b7f55f0996f1a18beca679dd3b7cfe0e05429583eece9ab72ffe9";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  229 => 133,  223 => 130,  219 => 128,  217 => 127,  214 => 126,  208 => 123,  204 => 121,  202 => 120,  199 => 119,  193 => 116,  189 => 114,  187 => 113,  184 => 112,  174 => 109,  170 => 107,  168 => 106,  165 => 105,  155 => 102,  151 => 100,  149 => 99,  146 => 98,  137 => 94,  131 => 93,  127 => 91,  125 => 90,  122 => 89,  116 => 86,  112 => 84,  110 => 83,  107 => 82,  101 => 79,  97 => 77,  95 => 76,  74 => 57,  71 => 56,  50 => 38,  46 => 37,  34 => 27,  32 => 26,  29 => 25,  11 => 22,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__53e0162bed5b7f55f0996f1a18beca679dd3b7cfe0e05429583eece9ab72ffe9", "");
    }
}
