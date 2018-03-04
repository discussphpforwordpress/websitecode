<?php

/* @reports/backend/partials/activity-report-details.twig */
class __TwigTemplate_4fe38ce112b9cfad3f59eb82dcb818c52470f7e7d97cfff248858689165cf437 extends Twig_Template
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
        echo "<h2>";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Report details")), "html", null, true);
        echo "</h2>

<input type=\"hidden\" class=\"report-id\" name=\"report-id\" value=\"\">

<div class=\"mp-option\">
\t<div class=\"row\">
\t\t<div class=\"col-md-3\">
\t\t\t";
        // line 8
        echo twig_escape_filter($this->env, $this->getAttribute(($context["options"] ?? null), "label", array(0 => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Report date"))), "method"), "html", null, true);
        echo "
\t\t</div>
\t\t<div class=\"col-md-9\">
\t\t\t<div class=\"mp-option\">
\t\t\t\t<span class=\"report-date\"></span>
\t\t\t</div>
\t\t</div>
\t</div>
</div>

<div class=\"mp-option report-reporter\">
\t<div class=\"row\">
\t\t<div class=\"col-md-3\">
\t\t\t";
        // line 21
        echo twig_escape_filter($this->env, $this->getAttribute(($context["options"] ?? null), "label", array(0 => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Reporter"))), "method"), "html", null, true);
        echo "
\t\t</div>
\t\t<div class=\"col-md-3\">
\t\t\t<div class=\"mp-option\">
\t\t\t\t<span class=\"report-reporter-link\"></span>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-md-6\">
\t\t\t<button class=\"sc-button primary send-message\"><i class=\"fa fa-send\"></i> ";
        // line 29
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Send message")), "html", null, true);
        echo "</button>
\t\t\t<button class=\"sc-button primary block-user\"><i class=\"fa fa-lock\"></i> ";
        // line 30
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Block user")), "html", null, true);
        echo "</button>
\t\t\t<button class=\"sc-button primary unblock-user\"><i class=\"fa fa-unlock\"></i> ";
        // line 31
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Unblock user")), "html", null, true);
        echo "</button>
\t\t</div>
\t</div>
</div>

<div class=\"mp-option report-reported\">
\t<div class=\"row\">
\t\t<div class=\"col-md-3\">
\t\t\t";
        // line 39
        echo twig_escape_filter($this->env, $this->getAttribute(($context["options"] ?? null), "label", array(0 => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Reported Activity Author"))), "method"), "html", null, true);
        echo "
\t\t</div>
\t\t<div class=\"col-md-3\">
\t\t\t<div class=\"mp-value\">
\t\t\t\t<span class=\"report-reported-link\"></span>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-md-6\">
\t\t\t<button class=\"sc-button primary send-message\"><i class=\"fa fa-send\"></i> ";
        // line 47
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Send message")), "html", null, true);
        echo "</button>
\t\t\t<button class=\"sc-button primary block-user\"><i class=\"fa fa-lock\"></i> ";
        // line 48
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Block user")), "html", null, true);
        echo "</button>
\t\t\t<button class=\"sc-button primary unblock-user\"><i class=\"fa fa-unlock\"></i> ";
        // line 49
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Unblock user")), "html", null, true);
        echo "</button>
\t\t</div>
\t</div>
</div>

<div class=\"mp-option\">
\t<div class=\"row\">
\t\t<div class=\"col-md-3\">
\t\t\t";
        // line 57
        echo twig_escape_filter($this->env, $this->getAttribute(($context["options"] ?? null), "label", array(0 => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Report comment"))), "method"), "html", null, true);
        echo "
\t\t</div>
\t\t<div class=\"col-md-9\">
\t\t\t<div class=\"mp-option\">
\t\t\t\t<span class=\"report-comment\"></span>
\t\t\t</div>
\t\t</div>
\t</div>
</div>

<div class=\"mp-option report-reported-activity\">
\t<div class=\"row\">
\t\t<div class=\"col-md-3\">
\t\t\t";
        // line 70
        echo twig_escape_filter($this->env, $this->getAttribute(($context["options"] ?? null), "label", array(0 => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Reported Activity"))), "method"), "html", null, true);
        echo "
\t\t</div>
\t\t<div class=\"col-md-3\">
\t\t\t<div class=\"mp-value\">
\t\t\t\t<span class=\"reported-activity-link\"></span>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-md-6\">
\t\t\t<button class=\"sc-button primary block-activity\"><i class=\"fa fa-lock\"></i> ";
        // line 78
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Block activity")), "html", null, true);
        echo "</button>
\t\t\t<button class=\"sc-button primary unblock-activity\"><i class=\"fa fa-unlock\"></i> ";
        // line 79
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Unblock actvity")), "html", null, true);
        echo "</button>
\t\t</div>
\t</div>
</div>


<div class=\"mp-option report-content\">
\t<div class=\"row\">
\t\t<div class=\"col-md-3\">
\t\t\t";
        // line 88
        echo twig_escape_filter($this->env, $this->getAttribute(($context["options"] ?? null), "label", array(0 => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Activity content"))), "method"), "html", null, true);
        echo "
\t\t</div>
\t\t<div class=\"col-md-9\">
\t\t\t<div class=\"mp-option\">
\t\t\t\t<div class=\"content-data\"></div>
\t\t\t\t<div class=\"content-link\"></div>
\t\t\t\t<div class=\"content-images\"></div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>

<div class=\"mp-option\">
\t<div class=\"row\">
\t\t<div class=\"col-md-3\">
\t\t\t";
        // line 103
        echo twig_escape_filter($this->env, $this->getAttribute(($context["options"] ?? null), "label", array(0 => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Report Status"))), "method"), "html", null, true);
        echo "
\t\t</div>
\t\t<div class=\"col-md-9\">
\t\t\t<div class=\"mp-option\">
\t\t\t\t<span class=\"report-status\"></span>
\t\t\t</div>
\t\t</div>
\t</div>
</div>";
    }

    public function getTemplateName()
    {
        return "@reports/backend/partials/activity-report-details.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  167 => 103,  149 => 88,  137 => 79,  133 => 78,  122 => 70,  106 => 57,  95 => 49,  91 => 48,  87 => 47,  76 => 39,  65 => 31,  61 => 30,  57 => 29,  46 => 21,  30 => 8,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@reports/backend/partials/activity-report-details.twig", "F:\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Reports\\views\\backend\\partials\\activity-report-details.twig");
    }
}
