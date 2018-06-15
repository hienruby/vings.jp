<?php

/* __string_template__b9eac01528782f5fd70761d8cc4f27e75575219b1d7a990be42602cac961b0ee */
class __TwigTemplate_b3e404dd23d859bf4ee089aaaf6c3a8bbd5ffef820f5ffa9f34416f84d632171 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 23
        $this->parent = $this->loadTemplate("default_frame.twig", "__string_template__b9eac01528782f5fd70761d8cc4f27e75575219b1d7a990be42602cac961b0ee", 23);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'sub_title' => array($this, 'block_sub_title'),
            'main' => array($this, 'block_main'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "default_frame.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 25
        $context["menus"] = array(0 => "setting", 1 => "system", 2 => "system_index");
        // line 23
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 27
    public function block_title($context, array $blocks = array())
    {
        echo "システム設定";
    }

    // line 28
    public function block_sub_title($context, array $blocks = array())
    {
        echo "システム情報";
    }

    // line 30
    public function block_main($context, array $blocks = array())
    {
        // line 31
        echo "    <div id=\"server_wrap\" class=\"row\">
        <div id=\"server_info_box\" class=\"col-md-12\">
            <div id=\"server_info_box__body\" class=\"box\">
                <div id=\"server_info_box__header\" class=\"box-header\">
                    <h3 class=\"box-title\">システム情報</h3>
                </div><!-- /.box-header -->
                <div id=\"server_info_box__body_inner\" class=\"box-body\">
                    <dl class=\"dl-horizontal\">
                       ";
        // line 39
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["arrSystemInfo"]) ? $context["arrSystemInfo"] : null));
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
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 40
            echo "                            <dt id=\"server_info_box__title--";
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "\">
                               ";
            // line 41
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "title", array()), "html", null, true);
            echo "
                            </dt>
                            <dd id=\"server_info_box__value--";
            // line 43
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "\">
                               ";
            // line 44
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "value", array()), "html", null, true);
            echo "
                            </dd>
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
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 47
        echo "                    </dl>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
    <div id=\"php_wrap\" class=\"row\">
        <div id=\"php_info_box\" class=\"col-md-12\">
            <div id=\"php_info_box__body\" class=\"box\">
                <div id=\"php_info_box__header\" class=\"box-header\">
                    <h3 class=\"box-title\">PHP情報</h3>
                </div><!-- /.box-header -->
                <div id=\"php_info_box__frame\" class=\"box-body no-padding\">
                    <iframe name=\"php_info\" src=\"?mode=info\" height=\"500\" frameborder=\"0\" style=\"width: 100%;\"></iframe>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

    </div>
";
    }

    public function getTemplateName()
    {
        return "__string_template__b9eac01528782f5fd70761d8cc4f27e75575219b1d7a990be42602cac961b0ee";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  106 => 47,  89 => 44,  85 => 43,  80 => 41,  75 => 40,  58 => 39,  48 => 31,  45 => 30,  39 => 28,  33 => 27,  29 => 23,  27 => 25,  11 => 23,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__b9eac01528782f5fd70761d8cc4f27e75575219b1d7a990be42602cac961b0ee", "");
    }
}
