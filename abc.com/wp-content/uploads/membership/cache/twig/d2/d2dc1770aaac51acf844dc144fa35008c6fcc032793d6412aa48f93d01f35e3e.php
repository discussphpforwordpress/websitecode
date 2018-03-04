<?php

/* @reports/backend/partials/user-report-details.twig */
class __TwigTemplate_6c87745906609634c7158c4ba38353834318af6892f25e523c9849736ab8990a extends Twig_Template
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
    <div class=\"row\">
        <div class=\"col-md-3\">
            ";
        // line 8
        echo twig_escape_filter($this->env, $this->getAttribute(($context["options"] ?? null), "label", array(0 => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Report date"))), "method"), "html", null, true);
        echo "
        </div>
        <div class=\"col-md-9\">
            <div class=\"mp-option\">
                <span class=\"report-date\"></span>
            </div>
        </div>
    </div>
</div>

<div class=\"mp-option report-reporter\">
    <div class=\"row\">
        <div class=\"col-md-3\">
            ";
        // line 21
        echo twig_escape_filter($this->env, $this->getAttribute(($context["options"] ?? null), "label", array(0 => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Reporter"))), "method"), "html", null, true);
        echo "
        </div>
        <div class=\"col-md-3\">
            <div class=\"mp-option\">
                <span class=\"report-reporter-link\"></span>
            </div>
        </div>
        <div class=\"col-md-6\">
            <button class=\"sc-button primary send-message\"><i class=\"fa fa-send\"></i> ";
        // line 29
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Send message")), "html", null, true);
        echo "</button>
            <button class=\"sc-button primary block-user\"><i class=\"fa fa-lock\"></i> ";
        // line 30
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Block user")), "html", null, true);
        echo "</button>
            <button class=\"sc-button primary unblock-user\"><i class=\"fa fa-unlock\"></i> ";
        // line 31
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Unblock user")), "html", null, true);
        echo "</button>
        </div>
    </div>
</div>

<div class=\"mp-option report-reported\">
    <div class=\"row\">
        <div class=\"col-md-3\">
            ";
        // line 39
        echo twig_escape_filter($this->env, $this->getAttribute(($context["options"] ?? null), "label", array(0 => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Reported"))), "method"), "html", null, true);
        echo "
        </div>
        <div class=\"col-md-3\">
            <div class=\"mp-value\">
                <span class=\"report-reported-link\"></span>
            </div>
        </div>
        <div class=\"col-md-6\">
            <button class=\"sc-button primary send-message\"><i class=\"fa fa-send\"></i> ";
        // line 47
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Send message")), "html", null, true);
        echo "</button>
            <button class=\"sc-button primary block-user\"><i class=\"fa fa-lock\"></i> ";
        // line 48
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Block user")), "html", null, true);
        echo "</button>
            <button class=\"sc-button primary unblock-user\"><i class=\"fa fa-unlock\"></i> ";
        // line 49
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Unblock user")), "html", null, true);
        echo "</button>
        </div>
    </div>
</div>

<div class=\"mp-option\">
    <div class=\"row\">
        <div class=\"col-md-3\">
            ";
        // line 57
        echo twig_escape_filter($this->env, $this->getAttribute(($context["options"] ?? null), "label", array(0 => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Report comment"))), "method"), "html", null, true);
        echo "
        </div>
        <div class=\"col-md-9\">
            <div class=\"mp-option\">
                <span class=\"report-comment\"></span>
            </div>
        </div>
    </div>
</div>

<div class=\"mp-option\">
    <div class=\"row\">
        <div class=\"col-md-3\">
            ";
        // line 70
        echo twig_escape_filter($this->env, $this->getAttribute(($context["options"] ?? null), "label", array(0 => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Report Status"))), "method"), "html", null, true);
        echo "
        </div>
        <div class=\"col-md-9\">
            <div class=\"mp-option\">
                <span class=\"report-status\"></span>
            </div>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "@reports/backend/partials/user-report-details.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  122 => 70,  106 => 57,  95 => 49,  91 => 48,  87 => 47,  76 => 39,  65 => 31,  61 => 30,  57 => 29,  46 => 21,  30 => 8,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@reports/backend/partials/user-report-details.twig", "F:\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Reports\\views\\backend\\partials\\user-report-details.twig");
    }
}
