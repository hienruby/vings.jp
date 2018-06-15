<?php

/* __string_template__6a2a90f50a2d5356e352a3f286338a006a4f4aefa022867fa3e2406d59878708 */
class __TwigTemplate_b3f919fa0fa48d5e978eaf8c099f44b19a87c14d760416e7fee36b3fd3ffe5d7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 22
        $this->parent = $this->loadTemplate("default_frame.twig", "__string_template__6a2a90f50a2d5356e352a3f286338a006a4f4aefa022867fa3e2406d59878708", 22);
        $this->blocks = array(
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

    // line 24
    public function block_main($context, array $blocks = array())
    {
        // line 25
        echo "<style>
.page-heading {
margin:0;
}

.product_lf{
display:none;
}

</style>
    <div id=\"contents\" class=\"main_only\">
        <div id=\"agreement_wrap\" class=\"container-fluid1 inner no-padding\">
            <div id=\"main1\">
                <h1 class=\"page-heading\">利用規約</h1>
                <div id=\"agreement_box__body\" class=\"container-fluid\">
                    <div id=\"agreement_box__customer_agreement\" class=\"row\">
                        <div class=\"col-md-10 col-md-offset-1\">
                            ";
        // line 42
        if ( !(null === (isset($context["help"]) ? $context["help"] : null))) {
            // line 43
            echo "                            ";
            echo nl2br($this->getAttribute((isset($context["help"]) ? $context["help"] : null), "customerAgreement", array()));
            echo "
                            ";
        }
        // line 45
        echo "                        </div><!-- /.col -->
                    </div><!-- /.row -->

                </div>
            </div>
        </div>
    </div>

";
    }

    public function getTemplateName()
    {
        return "__string_template__6a2a90f50a2d5356e352a3f286338a006a4f4aefa022867fa3e2406d59878708";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 45,  52 => 43,  50 => 42,  31 => 25,  28 => 24,  11 => 22,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "__string_template__6a2a90f50a2d5356e352a3f286338a006a4f4aefa022867fa3e2406d59878708", "");
    }
}
