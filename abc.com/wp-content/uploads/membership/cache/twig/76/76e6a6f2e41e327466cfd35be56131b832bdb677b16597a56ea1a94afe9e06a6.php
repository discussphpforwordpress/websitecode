<?php

/* @promo/pluginDeactivation.twig */
class __TwigTemplate_eb591e8731e2310a433cc80f84240e32223f6aa7f0d69bcd5542c0b1c732c74e extends Twig_Template
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
        echo "<style type=\"text/css\">
\t.mbsDeactivateDescShell {
\t\tdisplay: none;
\t\tmargin-left: 25px;
\t\tmargin-top: 5px;
\t}
\t.mbsDeactivateReasonShell {
\t\tdisplay: block;
\t\tmargin-bottom: 10px;
\t}
\t#mbsDeactivateWnd input[type=\"text\"],
\t#mbsDeactivateWnd textarea {
\t\twidth: 100%;
\t}
\t#mbsDeactivateWnd h4 {
\t\tline-height: 1.53em;
\t}
\t#mbsDeactivateWnd + .ui-dialog-buttonpane .ui-dialog-buttonset {
\t\tfloat: none;
\t}
\t.mbsDeactivateSkipDataBtn {
\t\tfloat: right;
\t\tmargin-top: 15px;
\t\ttext-decoration: none;
\t\tcolor: #777 !important;
\t}
</style>
<div id=\"mbsDeactivateWnd\" style=\"display: none;\" title=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->getAttribute(($context["environment"] ?? null), "translate", array(0 => "Your Feedback"), "method"), "html", null, true);
        echo "\">
\t<h4>";
        // line 29
        echo twig_escape_filter($this->env, $this->getAttribute(($context["environment"] ?? null), "translate", array(0 => "If you have a moment, please share why you are deactivating Membership by Supsystic"), "method"), "html", null, true);
        echo "</h4>
\t<form id=\"mbsDeactivateForm\">
\t\t<label class=\"mbsDeactivateReasonShell\">
\t\t\t<input type=\"radio\" name=\"deactivate_reason\" value=\"not_working\" />
\t\t\t";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute(($context["environment"] ?? null), "translate", array(0 => "Couldn't get the plugin to work"), "method"), "html", null, true);
        echo "
\t\t\t<div class=\"mbsDeactivateDescShell\">
\t\t\t\t";
        // line 35
        echo sprintf($this->getAttribute(($context["environment"] ?? null), "translate", array(0 => "If you have a question, <a href=\"%s\" target=\"_blank\">contact us</a> and will do our best to help you"), "method"), "https://supsystic.com/contact-us/?utm_source=plugin&utm_medium=deactivated_contact&utm_campaign=membership");
        echo "
\t\t\t</div>
\t\t</label>
\t\t<label class=\"mbsDeactivateReasonShell\">
\t\t\t<input type=\"radio\" name=\"deactivate_reason\" value=\"found_better\" />
\t\t\t";
        // line 40
        echo twig_escape_filter($this->env, $this->getAttribute(($context["environment"] ?? null), "translate", array(0 => "I found a better plugin"), "method"), "html", null, true);
        echo "
\t\t\t<div class=\"mbsDeactivateDescShell\">
\t\t\t\t<input type=\"text\" name=\"better_plugin\" placeholder=\"";
        // line 42
        echo twig_escape_filter($this->env, $this->getAttribute(($context["environment"] ?? null), "translate", array(0 => "If it's possible, specify plugin name"), "method"), "html", null, true);
        echo "\" />
\t\t\t</div>
\t\t</label>
\t\t<label class=\"mbsDeactivateReasonShell\">
\t\t\t<input type=\"radio\" name=\"deactivate_reason\" value=\"not_need\" />
\t\t\t";
        // line 47
        echo twig_escape_filter($this->env, $this->getAttribute(($context["environment"] ?? null), "translate", array(0 => "I no longer need the plugin"), "method"), "html", null, true);
        echo "
\t\t</label>
\t\t<label class=\"mbsDeactivateReasonShell\">
\t\t\t<input type=\"radio\" name=\"deactivate_reason\" value=\"temporary\" />
\t\t\t";
        // line 51
        echo twig_escape_filter($this->env, $this->getAttribute(($context["environment"] ?? null), "translate", array(0 => "It's a temporary deactivation"), "method"), "html", null, true);
        echo "
\t\t</label>
\t\t<label class=\"mbsDeactivateReasonShell\">
\t\t\t<input type=\"radio\" name=\"deactivate_reason\" value=\"other\" />
\t\t\t";
        // line 55
        echo twig_escape_filter($this->env, $this->getAttribute(($context["environment"] ?? null), "translate", array(0 => "Other"), "method"), "html", null, true);
        echo "
\t\t\t<div class=\"mbsDeactivateDescShell\">
\t\t\t\t<input type=\"text\" name=\"other\" placeholder=\"";
        // line 57
        echo twig_escape_filter($this->env, $this->getAttribute(($context["environment"] ?? null), "translate", array(0 => "What is the reason?"), "method"), "html", null, true);
        echo "\" />
\t\t\t</div>
\t\t</label>
\t</form>
\t<a href=\"\" class=\"mbsDeactivateSkipDataBtn\">";
        // line 61
        echo twig_escape_filter($this->env, $this->getAttribute(($context["environment"] ?? null), "translate", array(0 => "Skip & Deactivate"), "method"), "html", null, true);
        echo "</a>
</div>";
    }

    public function getTemplateName()
    {
        return "@promo/pluginDeactivation.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  111 => 61,  104 => 57,  99 => 55,  92 => 51,  85 => 47,  77 => 42,  72 => 40,  64 => 35,  59 => 33,  52 => 29,  48 => 28,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@promo/pluginDeactivation.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Promo\\views\\pluginDeactivation.twig");
    }
}
