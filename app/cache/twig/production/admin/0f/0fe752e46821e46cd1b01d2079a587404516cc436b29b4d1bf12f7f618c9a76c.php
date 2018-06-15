<?php

/* Store/unregisterd_plugin_table.twig */
class __TwigTemplate_2040da0ef6181626f0697d448580b98865dc26bd67395d0d05d0c45a4cb45498 extends Twig_Template
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
        // line 17
        echo "<div class=\"table_list plugin-table\">
    <div class=\"table-responsive with-border\">
        <table class=\"table table-hover table-condensed\">
            <thead>
            <tr>
                <th>プラグイン</th>
                <th>バージョン</th>
                <th>コード</th>
                <th>アップデート</th>
                <th>設定</th>
            </tr>
            </thead>
            <tbody>
            ";
        // line 30
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["Plugins"]) ? $context["Plugins"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["Plugin"]) {
            // line 31
            echo "                <form id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["Plugin"], "name", array()), "html", null, true);
            echo "\" name=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["Plugin"], "name", array()), "html", null, true);
            echo "\" method=\"post\" action=\"\">
                    <tr class=\"";
            // line 32
            if (($this->getAttribute($context["Plugin"], "enable", array()) == 0)) {
                echo "active";
            }
            echo "\">
                        ";
            // line 33
            if ($this->getAttribute($context["Plugin"], "name", array(), "any", true, true)) {
                // line 34
                echo "                            <td class=\"tp\">
                                <strong>";
                // line 35
                echo twig_escape_filter($this->env, $this->getAttribute($context["Plugin"], "name", array()), "html", null, true);
                echo "</strong>
                            </td>
                        ";
            } else {
                // line 38
                echo "                            <td class=\"tp\">
                                <strong>不明</strong>
                            </td>
                        ";
            }
            // line 42
            echo "                        ";
            if ($this->getAttribute($context["Plugin"], "version", array(), "any", true, true)) {
                // line 43
                echo "                            <td class=\"tv text-center\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["Plugin"], "version", array()), "html", null, true);
                echo "</td>
                        ";
            } else {
                // line 45
                echo "                            <td class=\"tv text-center\">不明</td>
                        ";
            }
            // line 47
            echo "                        ";
            if ($this->getAttribute($context["Plugin"], "code", array(), "any", true, true)) {
                // line 48
                echo "                            <td class=\"tc\"><p>";
                echo twig_escape_filter($this->env, $this->getAttribute($context["Plugin"], "code", array()), "html", null, true);
                echo "</p>
                                ";
                // line 49
                if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array(), "any", false, true), $this->getAttribute($context["Plugin"], "code", array()), array(), "array", false, true), "const", array(), "any", false, true), "readme", array(), "any", true, true)) {
                    // line 50
                    echo "                                    <a href=\"#\" class=\"view_readme\" data-toggle=\"modal\" data-target=\"#readmeModal\" data-name=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["Plugin"], "name", array()), "html", null, true);
                    echo "\" data-readme=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), $this->getAttribute($context["Plugin"], "code", array()), array(), "array"), "const", array()), "readme"), "html", null, true);
                    echo "\">詳細を表示</a>
                                ";
                }
                // line 52
                echo "                            </td>
                        ";
            } else {
                // line 54
                echo "                            <td class=\"tc\">不明</td>
                        ";
            }
            // line 56
            echo "                        <td class=\"tu\">
                            &nbsp;-&nbsp;
                        </td>
                        <td class=\"ta text-center\">
                            ";
            // line 60
            if ($this->getAttribute((isset($context["unregisterdPluginsConfigPages"]) ? $context["unregisterdPluginsConfigPages"] : null), $this->getAttribute($context["Plugin"], "code", array()), array(), "array", true, true)) {
                // line 61
                echo "                                <a href='";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["unregisterdPluginsConfigPages"]) ? $context["unregisterdPluginsConfigPages"] : null), $this->getAttribute($context["Plugin"], "code", array()), array(), "array"), "html", null, true);
                echo "'>設定</a>
                            ";
            } else {
                // line 63
                echo "                                &nbsp;-&nbsp;
                            ";
            }
            // line 65
            echo "                        </td>
                    </tr>
                </form>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Plugin'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 69
        echo "            </tbody>
        </table>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "Store/unregisterd_plugin_table.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  134 => 69,  125 => 65,  121 => 63,  115 => 61,  113 => 60,  107 => 56,  103 => 54,  99 => 52,  91 => 50,  89 => 49,  84 => 48,  81 => 47,  77 => 45,  71 => 43,  68 => 42,  62 => 38,  56 => 35,  53 => 34,  51 => 33,  45 => 32,  38 => 31,  34 => 30,  19 => 17,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "Store/unregisterd_plugin_table.twig", "/home/kir021669/public_html/vings.jp/src/Eccube/Resource/template/admin/Store/unregisterd_plugin_table.twig");
    }
}
