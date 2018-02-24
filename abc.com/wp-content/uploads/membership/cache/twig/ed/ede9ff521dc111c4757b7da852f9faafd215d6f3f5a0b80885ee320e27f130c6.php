<?php

/* @users/partials/users-send-message-modal.twig */
class __TwigTemplate_0b3f25d4bd5958065978e1eee8ed200ccb8bf1a7dc64b03c010dc60536bc438e extends Twig_Template
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
        echo "<div class=\"ui small modal\" id=\"send-message-modal\">
    <i class=\"close icon\"></i>
    <div class=\"header\">
        ";
        // line 4
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Send message to")), "html", null, true);
        echo " <span class=\"recipient-name\"></span>
    </div>
    <div class=\"content\">
        <div class=\"ui form\">
            <div class=\"field\">
                <label>";
        // line 9
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Message")), "html", null, true);
        echo "</label>
                <textarea rows=\"5\"></textarea>
            </div>
        </div>
\t\t";
        // line 13
        if ((($context["useAttachment"] ?? null) == 1)) {
            // line 14
            echo "\t\t\t<div class=\"mbs-all-attachment-list\"></div>
\t\t";
        }
        // line 16
        echo "\t</div>
    <div class=\"actions\">
\t\t";
        // line 18
        if ((($context["useAttachment"] ?? null) == 1)) {
            // line 19
            echo "\t\t\t<button class=\"mbs-add-attachment ui button mini\"><span class=\"mbs-invisible\">_</span><i class=\"icon attach\"></i></button>
\t\t";
        }
        // line 21
        echo "        <button class=\"ui button mini secondary cancel\">";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Cancel")), "html", null, true);
        echo "</button>
        <button class=\"ui positive mini primary button mbsAttMessSendBtn\">";
        // line 22
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Send")), "html", null, true);
        echo "</button>
    </div>
</div>
";
        // line 25
        if ((($context["useAttachment"] ?? null) == 1)) {
            // line 26
            echo "\t";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "users.send.message.attachment.template"), "method"), "html", null, true);
            echo "
";
        }
    }

    public function getTemplateName()
    {
        return "@users/partials/users-send-message-modal.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  68 => 26,  66 => 25,  60 => 22,  55 => 21,  51 => 19,  49 => 18,  45 => 16,  41 => 14,  39 => 13,  32 => 9,  24 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@users/partials/users-send-message-modal.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Users\\views\\partials\\users-send-message-modal.twig");
    }
}
