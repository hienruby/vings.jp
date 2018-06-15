<?php

/* __string_template__456ab00b1cb37b9e93256abed3c0c4844e5fb36c1b592ebda526a70e31e6b551 */
class __TwigTemplate_acb95fa11a15ae0220e5d34602f9e511e4883366fa10a62136e597970ad48e60 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 22
        $this->parent = $this->loadTemplate("default_frame.twig", "__string_template__456ab00b1cb37b9e93256abed3c0c4844e5fb36c1b592ebda526a70e31e6b551", 22);
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
.product_lf{
display:none;
}
.page-heading {
padding-bottom:0;
margin-bottom: 0;
}
</style>
    <div id=\"contents\" class=\"main_only\">
        <div id=\"privacy_wrap\" class=\"container-fluid1 inner no-padding\">
            <div id=\"main1\">
                <h1 class=\"page-heading\">プライバシーポリシー</h1>
                <div id=\"privacy_box\" class=\"container-fluid\">
                    <div id=\"privacy_box__body\" class=\"row\">
                        <div id=\"privacy_box__body_inner\" class=\"col-md-12 \">
                            <p id=\"privacy_box__declaration\">
                                ";
        // line 42
        if ( !(null === $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "company_name", array()))) {
            // line 43
            echo "                                    ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["BaseInfo"]) ? $context["BaseInfo"] : null), "company_name", array()), "html", null, true);
            echo "は、
                                ";
        }
        // line 45
        echo "                                個人情報保護の重要性に鑑み、「個人情報の保護に関する法律」及び本プライバシーポリシーを遵守し、お客さまのプライバシー保護に努めます。
                            </p>
                            <br />
                            <h3 id=\"privacy_box__lead_header\">個人情報の定義</h3>
                            <p id=\"privacy_box__lead\">お客さま個人に関する情報(以下「個人情報」といいます)であって、お客さまのお名前、住所、電話番号など当該お客さま個人を識別することができる情報をさします。他の情報と組み合わせて照合することにより個人を識別することができる情報も含まれます。</p>
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
        return "__string_template__456ab00b1cb37b9e93256abed3c0c4844e5fb36c1b592ebda526a70e31e6b551";
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
        return new Twig_Source("", "__string_template__456ab00b1cb37b9e93256abed3c0c4844e5fb36c1b592ebda526a70e31e6b551", "");
    }
}
