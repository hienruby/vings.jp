<?php

/* Form/form_layout.twig */
class __TwigTemplate_edf85f2fc514312bb2778f34b98cf06a23b57c0130c905e51af482f76c6da443 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 22
        $this->parent = $this->loadTemplate("form_table_layout.html.twig", "Form/form_layout.twig", 22);
        $this->blocks = array(
            'form_widget_compound' => array($this, 'block_form_widget_compound'),
            'form_row' => array($this, 'block_form_row'),
            'form_errors' => array($this, 'block_form_errors'),
            'form_widget' => array($this, 'block_form_widget'),
            'form_widget_simple' => array($this, 'block_form_widget_simple'),
            'widget_attributes' => array($this, 'block_widget_attributes'),
            'hidden_row' => array($this, 'block_hidden_row'),
            'textarea_widget' => array($this, 'block_textarea_widget'),
            'choice_widget_collapsed' => array($this, 'block_choice_widget_collapsed'),
            'choice_widget_expanded' => array($this, 'block_choice_widget_expanded'),
            'checkbox_widget' => array($this, 'block_checkbox_widget'),
            'radio_widget' => array($this, 'block_radio_widget'),
            'password_widget' => array($this, 'block_password_widget'),
            'name_widget' => array($this, 'block_name_widget'),
            'tel_widget' => array($this, 'block_tel_widget'),
            'fax_widget' => array($this, 'block_fax_widget'),
            'zip_widget' => array($this, 'block_zip_widget'),
            'address_widget' => array($this, 'block_address_widget'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "form_table_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 24
    public function block_form_widget_compound($context, array $blocks = array())
    {
        // line 25
        if ($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "freeze_display_text", array())) {
            // line 26
            echo "<table ";
            $this->displayBlock("widget_container_attributes", $context, $blocks);
            echo ">";
            // line 27
            if ((twig_test_empty($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "parent", array())) && (twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : null)) > 0))) {
                // line 28
                echo "<tr>
                <td colspan=\"2\">";
                // line 30
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'errors');
                // line 31
                echo "</td>
            </tr>";
            }
            // line 34
            $this->displayBlock("form_rows", $context, $blocks);
            // line 35
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'rest');
            // line 36
            echo "</table>";
        } else {
            // line 38
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'errors');
            // line 39
            $this->displayBlock("form_rows", $context, $blocks);
            // line 40
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'rest');
        }
    }

    // line 44
    public function block_form_row($context, array $blocks = array())
    {
        // line 45
        if ($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "freeze_display_text", array())) {
            // line 46
            echo "<tr>
            <th>";
            // line 48
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'label');
            // line 49
            if ($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "required", array())) {
                echo "<span class=\"attention\">※</span>";
            }
            // line 50
            echo "            </th>
            <td>";
            // line 52
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'errors');
            // line 53
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'widget');
            // line 54
            echo "</td>
        </tr>";
        } else {
            // line 57
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'errors');
            // line 58
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'widget');
        }
    }

    // line 62
    public function block_form_errors($context, array $blocks = array())
    {
        // line 63
        if ((twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : null)) > 0)) {
            // line 64
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["errors"]) ? $context["errors"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 65
                echo "<span class=\"attention\">※ ";
                echo twig_escape_filter($this->env, twig_replace_filter($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans($this->getAttribute($context["error"], "messageTemplate", array()), $this->getAttribute($context["error"], "messageParameters", array()), "validators"), array("{{ field }}" => (isset($context["label"]) ? $context["label"] : null))), "html", null, true);
                echo "<br /></span>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
    }

    // line 72
    public function block_form_widget($context, array $blocks = array())
    {
        // line 73
        $this->displayParentBlock("form_widget", $context, $blocks);
        // line 74
        if (((isset($context["freeze"]) ? $context["freeze"] : null) == false)) {
            // line 75
            if ((array_key_exists("help", $context) &&  !twig_test_empty((isset($context["help"]) ? $context["help"] : null)))) {
                // line 76
                echo "<p class=\"mini\"><span class=\"attention\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans((isset($context["help"]) ? $context["help"] : null), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : null)), "html", null, true);
                echo "</span></p>";
            }
        }
    }

    // line 81
    public function block_form_widget_simple($context, array $blocks = array())
    {
        // line 82
        if ((isset($context["freeze"]) ? $context["freeze"] : null)) {
            // line 83
            $context["type"] = "hidden";
            // line 84
            if ((isset($context["freeze_display_text"]) ? $context["freeze_display_text"] : null)) {
                // line 85
                echo nl2br(twig_escape_filter($this->env, ((array_key_exists("value", $context)) ? (_twig_default_filter((isset($context["value"]) ? $context["value"] : null), "")) : ("")), "html", null, true));
            }
        }
        // line 88
        $this->displayParentBlock("form_widget_simple", $context, $blocks);
    }

    // line 91
    public function block_widget_attributes($context, array $blocks = array())
    {
        // line 92
        if ((twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : null)) > 0)) {
            // line 93
            $context["style"] = "background-color:#ffe8e8;";
            // line 94
            if ((isset($context["attr"]) ? $context["attr"] : null)) {
                // line 95
                if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "style", array(), "array", true, true) && (twig_length_filter($this->env, $this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "style", array(), "array")) > 0))) {
                    // line 96
                    $context["style"] = (((isset($context["style"]) ? $context["style"] : null) . " ") . $this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "style", array(), "array"));
                }
                // line 98
                $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : null), array("style" => (isset($context["style"]) ? $context["style"] : null)));
            } else {
                // line 100
                $context["attr"] = array("style" => (isset($context["style"]) ? $context["style"] : null));
            }
        }
        // line 103
        echo "id=\"";
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
        echo "\" name=\"";
        echo twig_escape_filter($this->env, (isset($context["full_name"]) ? $context["full_name"] : null), "html", null, true);
        echo "\"";
        if ((isset($context["read_only"]) ? $context["read_only"] : null)) {
            echo "disabled=\"disabled\"";
        }
        if ((isset($context["required"]) ? $context["required"] : null)) {
            echo " required=\"required\"";
        }
        if ((isset($context["pattern"]) ? $context["pattern"] : null)) {
            echo " pattern=\"";
            echo twig_escape_filter($this->env, (isset($context["pattern"]) ? $context["pattern"] : null), "html", null, true);
            echo "\"";
        }
        // line 104
        if (((isset($context["freeze"]) ? $context["freeze"] : null) == false)) {
            // line 105
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["attr"]) ? $context["attr"] : null));
            foreach ($context['_seq'] as $context["attrname"] => $context["attrvalue"]) {
                echo " ";
                echo twig_escape_filter($this->env, $context["attrname"], "html", null, true);
                echo "=\"";
                echo twig_escape_filter($this->env, $context["attrvalue"], "html", null, true);
                echo "\" ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['attrname'], $context['attrvalue'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
    }

    // line 109
    public function block_hidden_row($context, array $blocks = array())
    {
        // line 110
        if ((isset($context["freeze_display_text"]) ? $context["freeze_display_text"] : null)) {
            // line 111
            echo "<tr style=\"display: none\">
            <td colspan=\"2\">";
            // line 113
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'widget');
            // line 114
            echo "</td>
        </tr>";
        } else {
            // line 117
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'widget');
        }
    }

    // line 121
    public function block_textarea_widget($context, array $blocks = array())
    {
        // line 122
        if ((isset($context["freeze"]) ? $context["freeze"] : null)) {
            // line 123
            $this->displayBlock("form_widget_simple", $context, $blocks);
        } else {
            // line 125
            $this->displayParentBlock("textarea_widget", $context, $blocks);
            // line 126
            if ((array_key_exists("help", $context) &&  !twig_test_empty((isset($context["help"]) ? $context["help"] : null)))) {
                // line 127
                echo "<p class=\"mini\"><span class=\"attention\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans((isset($context["help"]) ? $context["help"] : null), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : null)), "html", null, true);
                echo "</span></p>";
            }
        }
    }

    // line 132
    public function block_choice_widget_collapsed($context, array $blocks = array())
    {
        // line 133
        if ((isset($context["freeze"]) ? $context["freeze"] : null)) {
            // line 134
            echo "        ";
            $context["flag"] = false;
            // line 135
            echo "        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["choices"]) ? $context["choices"] : null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["choice"]) {
                // line 136
                echo "            ";
                if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->isSelectedChoice($context["choice"], (isset($context["value"]) ? $context["value"] : null))) {
                    // line 137
                    if ((isset($context["freeze_display_text"]) ? $context["freeze_display_text"] : null)) {
                        // line 138
                        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans($this->getAttribute($context["choice"], "label", array()), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : null)), "html", null, true);
                        echo "
                ";
                    }
                    // line 140
                    echo "                <input type=\"hidden\" value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["choice"], "value", array()), "html", null, true);
                    echo "\" ";
                    $this->displayBlock("widget_attributes", $context, $blocks);
                    echo " />
                ";
                    // line 141
                    $context["flag"] = true;
                    // line 142
                    echo "            ";
                }
                // line 143
                echo "        ";
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['choice'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 144
            echo "        ";
            if (((isset($context["flag"]) ? $context["flag"] : null) == false)) {
                echo "<input type=\"hidden\" value=\"\" ";
                $this->displayBlock("widget_attributes", $context, $blocks);
                echo " />";
            }
        } else {
            // line 146
            $this->displayParentBlock("choice_widget_collapsed", $context, $blocks);
        }
    }

    // line 151
    public function block_choice_widget_expanded($context, array $blocks = array())
    {
        // line 152
        if ((isset($context["freeze"]) ? $context["freeze"] : null)) {
            // line 153
            if ((isset($context["freeze_display_text"]) ? $context["freeze_display_text"] : null)) {
                // line 154
                echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array(), "any", false, true), "data", array(), "any", false, true), "name", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array(), "any", false, true), "data", array(), "any", false, true), "name", array()), $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "data", array()))) : ($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "data", array()))), "html", null, true);
            }
            // line 156
            echo "<input type=\"hidden\" value=\"";
            echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array(), "any", false, true), "data", array(), "any", false, true), "id", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array(), "any", false, true), "data", array(), "any", false, true), "id", array()), $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "data", array()))) : ($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "data", array()))), "html", null, true);
            echo "\" ";
            $this->displayBlock("widget_attributes", $context, $blocks);
            echo " />";
        } else {
            // line 158
            $this->displayParentBlock("choice_widget_expanded", $context, $blocks);
        }
    }

    // line 163
    public function block_checkbox_widget($context, array $blocks = array())
    {
        // line 164
        if ((isset($context["freeze"]) ? $context["freeze"] : null)) {
            // line 165
            if ((isset($context["checked"]) ? $context["checked"] : null)) {
                // line 166
                if ((isset($context["freeze_display_text"]) ? $context["freeze_display_text"] : null)) {
                    // line 167
                    $this->displayBlock("form_label", $context, $blocks);
                }
                // line 169
                echo "<input type=\"hidden\" ";
                $this->displayBlock("widget_attributes", $context, $blocks);
                if (array_key_exists("value", $context)) {
                    echo " value=\"";
                    echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : null), "html", null, true);
                    echo "\"";
                }
                echo " />";
            }
        } else {
            // line 172
            $this->displayParentBlock("checkbox_widget", $context, $blocks);
        }
    }

    // line 176
    public function block_radio_widget($context, array $blocks = array())
    {
        // line 177
        if ((isset($context["freeze"]) ? $context["freeze"] : null)) {
            // line 178
            if ((isset($context["checked"]) ? $context["checked"] : null)) {
                // line 179
                if ((isset($context["freeze_display_text"]) ? $context["freeze_display_text"] : null)) {
                    // line 180
                    $this->displayBlock("form_label", $context, $blocks);
                }
                // line 182
                echo "<input type=\"hidden\" ";
                $this->displayBlock("widget_attributes", $context, $blocks);
                if (array_key_exists("value", $context)) {
                    echo " value=\"";
                    echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : null), "html", null, true);
                    echo "\"";
                }
                echo " />";
            }
        } else {
            // line 185
            $this->displayParentBlock("radio_widget", $context, $blocks);
        }
    }

    // line 190
    public function block_password_widget($context, array $blocks = array())
    {
        // line 191
        if ((isset($context["freeze"]) ? $context["freeze"] : null)) {
            // line 192
            echo "<input type=\"hidden\" ";
            $this->displayBlock("widget_attributes", $context, $blocks);
            echo " value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "data", array()), "html", null, true);
            echo "\" />";
        } else {
            // line 194
            $this->displayParentBlock("password_widget", $context, $blocks);
        }
    }

    // line 201
    public function block_name_widget($context, array $blocks = array())
    {
        // line 202
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["form"]) ? $context["form"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
            // line 203
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["child"], 'errors');
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 205
        if ((isset($context["freeze"]) ? $context["freeze"] : null)) {
            // line 206
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "name01", array()), array(), "array"), 'widget');
            // line 207
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "name02", array()), array(), "array"), 'widget');
        } else {
            // line 209
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "name01", array()), array(), "array"), 'widget');
            // line 210
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "name02", array()), array(), "array"), 'widget');
        }
        // line 213
        if (($this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "last", array()) == false)) {
            echo "　";
        }
    }

    // line 216
    public function block_tel_widget($context, array $blocks = array())
    {
        // line 217
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["form"]) ? $context["form"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
            // line 218
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["child"], 'errors');
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 220
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["form"]) ? $context["form"] : null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
            // line 221
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["child"], 'widget', array("attr" => array("style" => "ime-mode: disabled;")));
            // line 222
            if (($this->getAttribute($context["loop"], "last", array()) == false)) {
                echo "&nbsp;-&nbsp;";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    // line 226
    public function block_fax_widget($context, array $blocks = array())
    {
        // line 227
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["form"]) ? $context["form"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
            // line 228
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["child"], 'errors');
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 230
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["form"]) ? $context["form"] : null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
            // line 231
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["child"], 'widget', array("attr" => array("style" => "ime-mode: disabled;")));
            // line 232
            if (($this->getAttribute($context["loop"], "last", array()) == false)) {
                echo "&nbsp;-&nbsp;";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    // line 236
    public function block_zip_widget($context, array $blocks = array())
    {
        // line 237
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["form"]) ? $context["form"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
            // line 238
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["child"], 'errors');
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 240
        if ((isset($context["freeze"]) ? $context["freeze"] : null)) {
            // line 241
            echo "〒&nbsp;";
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "zip01_name", array()), array(), "array"), 'widget');
            echo "&nbsp;-&nbsp;";
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "zip02_name", array()), array(), "array"), 'widget');
        } else {
            // line 243
            echo "〒&nbsp;";
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "zip01_name", array()), array(), "array"), 'widget', array("attr" => array("style" => "ime-mode: disabled;")));
            echo "&nbsp;-&nbsp;";
            // line 244
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "zip02_name", array()), array(), "array"), 'widget', array("attr" => array("style" => "ime-mode: disabled;")));
            echo "
        <a class=\"btn-normal\" href=\"javascript:;\" name=\"address_input\" onclick=\"eccube.getAddress('";
            // line 245
            echo $this->env->getExtension('Eccube\Twig\Extension\EccubeExtension')->getPath("input_zip");
            echo "', 'zip01', 'zip02', 'pref', 'addr01'); return false;\">住所入力</a>";
        }
    }

    // line 249
    public function block_address_widget($context, array $blocks = array())
    {
        // line 250
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["form"]) ? $context["form"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
            // line 251
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["child"], 'errors');
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 253
        if ((isset($context["freeze"]) ? $context["freeze"] : null)) {
            // line 254
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "pref_name", array()), array(), "array"), 'widget');
            // line 255
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "addr01_name", array()), array(), "array"), 'widget');
            // line 256
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "addr02_name", array()), array(), "array"), 'widget');
        } else {
            // line 258
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "pref_name", array()), array(), "array"), 'widget');
            echo "<br />";
            // line 259
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "addr01_name", array()), array(), "array"), 'widget', array("attr" => array("style" => "ime-mode: active;")));
            echo "<br />";
            // line 260
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "addr02_name", array()), array(), "array"), 'widget', array("attr" => array("style" => "ime-mode: active;")));
            echo "<br />";
            // line 261
            if ((array_key_exists("help", $context) &&  !twig_test_empty((isset($context["help"]) ? $context["help"] : null)))) {
                // line 262
                echo "<span class=\"attention\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans((isset($context["help"]) ? $context["help"] : null), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : null)), "html", null, true);
                echo "</span>";
            }
        }
    }

    public function getTemplateName()
    {
        return "Form/form_layout.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  631 => 262,  629 => 261,  626 => 260,  623 => 259,  620 => 258,  617 => 256,  615 => 255,  613 => 254,  611 => 253,  605 => 251,  601 => 250,  598 => 249,  592 => 245,  588 => 244,  584 => 243,  578 => 241,  576 => 240,  570 => 238,  566 => 237,  563 => 236,  545 => 232,  543 => 231,  526 => 230,  520 => 228,  516 => 227,  513 => 226,  495 => 222,  493 => 221,  476 => 220,  470 => 218,  466 => 217,  463 => 216,  457 => 213,  454 => 210,  452 => 209,  449 => 207,  447 => 206,  445 => 205,  439 => 203,  435 => 202,  432 => 201,  427 => 194,  420 => 192,  418 => 191,  415 => 190,  410 => 185,  399 => 182,  396 => 180,  394 => 179,  392 => 178,  390 => 177,  387 => 176,  382 => 172,  371 => 169,  368 => 167,  366 => 166,  364 => 165,  362 => 164,  359 => 163,  354 => 158,  347 => 156,  344 => 154,  342 => 153,  340 => 152,  337 => 151,  332 => 146,  324 => 144,  310 => 143,  307 => 142,  305 => 141,  298 => 140,  293 => 138,  291 => 137,  288 => 136,  270 => 135,  267 => 134,  265 => 133,  262 => 132,  254 => 127,  252 => 126,  250 => 125,  247 => 123,  245 => 122,  242 => 121,  237 => 117,  233 => 114,  231 => 113,  228 => 111,  226 => 110,  223 => 109,  207 => 105,  205 => 104,  188 => 103,  184 => 100,  181 => 98,  178 => 96,  176 => 95,  174 => 94,  172 => 93,  170 => 92,  167 => 91,  163 => 88,  159 => 85,  157 => 84,  155 => 83,  153 => 82,  150 => 81,  142 => 76,  140 => 75,  138 => 74,  136 => 73,  133 => 72,  122 => 65,  118 => 64,  116 => 63,  113 => 62,  108 => 58,  106 => 57,  102 => 54,  100 => 53,  98 => 52,  95 => 50,  91 => 49,  89 => 48,  86 => 46,  84 => 45,  81 => 44,  76 => 40,  74 => 39,  72 => 38,  69 => 36,  67 => 35,  65 => 34,  61 => 31,  59 => 30,  56 => 28,  54 => 27,  50 => 26,  48 => 25,  45 => 24,  11 => 22,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "Form/form_layout.twig", "/home/kir021669/public_html/vings.jp/src/Eccube/Resource/template/admin/Form/form_layout.twig");
    }
}
