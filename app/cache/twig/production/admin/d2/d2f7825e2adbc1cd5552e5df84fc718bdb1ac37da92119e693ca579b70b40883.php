<?php

/* CategoryCheckbox/Resource/template/admin/Form/form_layout.twig */
class __TwigTemplate_7cb610ff93a71c9b903c40c5c8578f86e2f8d6e86c6ff2e3015d60a0416d596c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("bootstrap_3_horizontal_layout.html.twig", "CategoryCheckbox/Resource/template/admin/Form/form_layout.twig", 2);
        $this->blocks = array(
            'choice_widget_expanded' => array($this, 'block_choice_widget_expanded'),
            'checkbox_widget' => array($this, 'block_checkbox_widget'),
            'checkbox_radio_label' => array($this, 'block_checkbox_radio_label'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "bootstrap_3_horizontal_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_choice_widget_expanded($context, array $blocks = array())
    {
        // line 4
        echo "<div>
    ";
        // line 5
        if (twig_in_filter("-inline", (($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array()), "")) : ("")))) {
            // line 6
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["form"]) ? $context["form"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                // line 7
                echo "            ";
                $context["index"] = $this->getAttribute($this->getAttribute($context["child"], "vars", array()), "value", array());
                // line 8
                echo "            ";
                $context["entity"] = $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "choices", array()), (isset($context["index"]) ? $context["index"] : null), array(), "array"), "data", array());
                // line 9
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["child"], 'widget', array("parent_label_class" => (($this->getAttribute(                // line 10
(isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array()), "")) : ("")), "translation_domain" =>                 // line 11
(isset($context["choice_translation_domain"]) ? $context["choice_translation_domain"] : null), "Category" =>                 // line 12
(isset($context["entity"]) ? $context["entity"] : null)));
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 16
            echo "<div ";
            $this->displayBlock("widget_container_attributes", $context, $blocks);
            echo ">";
            // line 17
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["form"]) ? $context["form"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                // line 18
                echo "                ";
                $context["index"] = $this->getAttribute($this->getAttribute($context["child"], "vars", array()), "value", array());
                // line 19
                echo "                ";
                $context["entity"] = $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "choices", array()), (isset($context["index"]) ? $context["index"] : null), array(), "array"), "data", array());
                // line 20
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["child"], 'widget', array("parent_label_class" => (($this->getAttribute(                // line 21
(isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array()), "")) : ("")), "translation_domain" =>                 // line 22
(isset($context["choice_translation_domain"]) ? $context["choice_translation_domain"] : null), "Category" =>                 // line 23
(isset($context["entity"]) ? $context["entity"] : null)));
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 26
            echo "</div>";
        }
        // line 28
        echo "    </div>";
    }

    // line 30
    public function block_checkbox_widget($context, array $blocks = array())
    {
        // line 31
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'label', array("Category" => (isset($context["Category"]) ? $context["Category"] : null)));
    }

    // line 33
    public function block_checkbox_radio_label($context, array $blocks = array())
    {
        // line 34
        echo "    ";
        // line 35
        echo "        ";
        if ((isset($context["required"]) ? $context["required"] : null)) {
            // line 36
            echo "            ";
            $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : null), array("class" => trim(((($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array()), "")) : ("")) . " required"))));
            // line 37
            echo "        ";
        }
        // line 38
        echo "        ";
        if (array_key_exists("parent_label_class", $context)) {
            // line 39
            echo "            ";
            $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : null), array("class" => trim((((($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array()), "")) : ("")) . " ") . (isset($context["parent_label_class"]) ? $context["parent_label_class"] : null)))));
            // line 40
            echo "        ";
        }
        // line 41
        echo "        ";
        if (array_key_exists("Category", $context)) {
            // line 42
            echo "            ";
            $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : null), array("style" => trim((("display:block;margin-left: " . ($this->getAttribute((isset($context["Category"]) ? $context["Category"] : null), "level", array()) * 20)) . "px;"))));
            // line 43
            echo "        ";
        }
        // line 44
        echo "        ";
        if (( !((isset($context["label"]) ? $context["label"] : null) === false) && twig_test_empty((isset($context["label"]) ? $context["label"] : null)))) {
            // line 45
            if ( !twig_test_empty((isset($context["label_format"]) ? $context["label_format"] : null))) {
                // line 46
                $context["label"] = twig_replace_filter((isset($context["label_format"]) ? $context["label_format"] : null), array("%name%" =>                 // line 47
(isset($context["name"]) ? $context["name"] : null), "%id%" =>                 // line 48
(isset($context["id"]) ? $context["id"] : null)));
            } else {
                // line 51
                $context["label"] = $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->humanize((isset($context["name"]) ? $context["name"] : null));
            }
        }
        // line 54
        echo "        <label";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["label_attr"]) ? $context["label_attr"] : null));
        foreach ($context['_seq'] as $context["attrname"] => $context["attrvalue"]) {
            echo " ";
            echo twig_escape_filter($this->env, $context["attrname"], "html", null, true);
            echo "=\"";
            echo twig_escape_filter($this->env, $context["attrvalue"], "html", null, true);
            echo "\"";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['attrname'], $context['attrvalue'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo ">
            <input type=\"checkbox\" ";
        // line 55
        $this->displayBlock("widget_attributes", $context, $blocks);
        if (array_key_exists("value", $context)) {
            echo " value=\"";
            echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : null), "html", null, true);
            echo "\"";
        }
        if ((isset($context["checked"]) ? $context["checked"] : null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo twig_escape_filter($this->env, (( !((isset($context["label"]) ? $context["label"] : null) === false)) ? (((((isset($context["translation_domain"]) ? $context["translation_domain"] : null) === false)) ? ((isset($context["label"]) ? $context["label"] : null)) : ($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans((isset($context["label"]) ? $context["label"] : null), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : null))))) : ("")), "html", null, true);
        // line 56
        echo "</label>
";
    }

    public function getTemplateName()
    {
        return "CategoryCheckbox/Resource/template/admin/Form/form_layout.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  169 => 56,  157 => 55,  141 => 54,  137 => 51,  134 => 48,  133 => 47,  132 => 46,  130 => 45,  127 => 44,  124 => 43,  121 => 42,  118 => 41,  115 => 40,  112 => 39,  109 => 38,  106 => 37,  103 => 36,  100 => 35,  98 => 34,  95 => 33,  91 => 31,  88 => 30,  84 => 28,  81 => 26,  75 => 23,  74 => 22,  73 => 21,  72 => 20,  69 => 19,  66 => 18,  62 => 17,  58 => 16,  51 => 12,  50 => 11,  49 => 10,  48 => 9,  45 => 8,  42 => 7,  38 => 6,  36 => 5,  33 => 4,  30 => 3,  11 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "CategoryCheckbox/Resource/template/admin/Form/form_layout.twig", "/home/kir021669/public_html/vings.jp/app/Plugin/CategoryCheckbox/Resource/template/admin/Form/form_layout.twig");
    }
}
