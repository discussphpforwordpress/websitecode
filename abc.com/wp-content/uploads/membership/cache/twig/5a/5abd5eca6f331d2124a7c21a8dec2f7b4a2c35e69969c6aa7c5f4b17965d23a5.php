<?php

/* @messages/messages.twig */
class __TwigTemplate_4406398c5f7966dd8fa84091768b3695f11a79eff3f71bd53e6dba32cae05789 extends Twig_Template
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
        // line 2
        echo "
<div id=\"conversations\" class=\"sc-membership\">
\t<div class=\"ui basic vertical segment\">
\t\t<div class=\"conversations-list-container\">
\t\t\t<div class=\"ui grid\">
\t\t\t\t<div class=\"two column row\">
\t\t\t\t\t<div class=\"left floated column\">
\t\t\t\t\t\t<span class=\"no-conversations-message\" ";
        // line 9
        if (($context["conversations"] ?? null)) {
            echo "style=\"display: none\"";
        }
        echo ">";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("You don't have any conversations started.")), "html", null, true);
        echo "</span>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"right floated column\">
\t\t\t\t\t\t<button class=\"ui button right floated mini primary new-conversation\">";
        // line 12
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("New conversation")), "html", null, true);
        echo "</button>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t
\t\t\t<div class=\"conversations-list ui relaxed selection divided list\">
\t\t\t\t";
        // line 18
        $this->loadTemplate("@messages/partials/conversations-list.twig", "@messages/messages.twig", 18)->display(array_merge($context, array("conversations" => ($context["conversations"] ?? null))));
        // line 19
        echo "\t\t\t</div>
\t\t</div>
\t\t
\t\t<div class=\"conversations-messages-container\" style=\"display: none\">
\t\t\t";
        // line 23
        $this->loadTemplate("@messages/partials/conversations.twig", "@messages/messages.twig", 23)->display(array_merge($context, array("converstaions" => ($context["conversations"] ?? null))));
        // line 24
        echo "\t\t</div>
\t\t
\t\t<div class=\"new-conversation-container\" style=\"display: none\">
\t\t\t<button class=\"ui primary mini button show-all-conversations\">
\t\t\t\t<i class=\"angle left icon\"></i>
\t\t\t\t";
        // line 29
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("All conversations")), "html", null, true);
        echo "
\t\t\t</button>
\t\t\t<div class=\"ui basic vertical segment\">
\t\t\t\t<div class=\"ui form conversation-create-form\">
\t\t\t\t\t<div class=\"field\">
\t\t\t\t\t\t<div class=\"ui fluid multiple search selection dropdown\">
\t\t\t\t\t\t\t<input type=\"hidden\" name=\"recepients\">
\t\t\t\t\t\t\t<i class=\"dropdown icon\"></i>
\t\t\t\t\t\t\t<div class=\"default text\">";
        // line 37
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("To:")), "html", null, true);
        echo "</div>
\t\t\t\t\t\t\t<div class=\"ui active small inline loader\" style=\"display: none; margin: 0.2em 0;\"></div>
\t\t\t\t\t\t\t<div class=\"menu ui relaxed list\">
\t\t\t\t\t\t\t\t";
        // line 40
        $this->loadTemplate("@base/partials/search-dropdown-user.twig", "@messages/messages.twig", 40)->display(array_merge($context, array("users" => ($context["currentUserFriends"] ?? null))));
        // line 41
        echo "\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"field\">
\t\t\t\t\t\t<textarea placeholder=\"";
        // line 45
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Write a message")), "html", null, true);
        echo "\" rows=\"2\"></textarea>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"ui right label characters-count\" style=\"display:none;\"></div>
\t\t\t\t\t<button class=\"ui submit mini primary right floated button\">";
        // line 48
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Send")), "html", null, true);
        echo "</button>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>

\t<div id=\"delete-messages-modal\" class=\"ui modal small\">
\t\t<i class=\"close icon cancel\"></i>
\t\t<div class=\"header\">";
        // line 56
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Delete this messages?")), "html", null, true);
        echo "</div>
\t\t<div class=\"content\">
\t\t\t<div class=\"description\">";
        // line 58
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Once you delete your copy of this messages, it cannot be undone.")), "html", null, true);
        echo "</div>
\t\t</div>
\t\t<div class=\"actions\">
\t\t\t<button class=\"ui mini button ok primary\">";
        // line 61
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Delete messages")), "html", null, true);
        echo "</button>
\t\t\t<button class=\"ui mini button secondary cancel\">";
        // line 62
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Cancel")), "html", null, true);
        echo "</button>
\t\t</div>
\t</div>

\t<div id=\"delete-conversation-modal\" class=\"ui modal small\">
\t\t<i class=\"close icon cancel\"></i>
\t\t<div class=\"header\">";
        // line 68
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Delete this conversation?")), "html", null, true);
        echo "</div>
\t\t<div class=\"content\">
\t\t\t<div class=\"description\">";
        // line 70
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Once you delete your copy of this conversation, it cannot be undone.")), "html", null, true);
        echo "</div>
\t\t</div>
\t\t<div class=\"actions\">
\t\t\t<button class=\"ui mini button ok primary\">";
        // line 73
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Delete conversation")), "html", null, true);
        echo "</button>
\t\t\t<button class=\"ui mini button secondary cancel\">";
        // line 74
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Cancel")), "html", null, true);
        echo "</button>
\t\t</div>
\t</div>

\t<div id=\"mbsImagePopupModalWnd\" class=\"ui modal\">
\t\t<div class=\"content\">
\t\t\t<img class=\"ui image\" src=\"\"/>
\t\t</div>
\t</div>
</div>

";
    }

    public function getTemplateName()
    {
        return "@messages/messages.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  145 => 74,  141 => 73,  135 => 70,  130 => 68,  121 => 62,  117 => 61,  111 => 58,  106 => 56,  95 => 48,  89 => 45,  83 => 41,  81 => 40,  75 => 37,  64 => 29,  57 => 24,  55 => 23,  49 => 19,  47 => 18,  38 => 12,  28 => 9,  19 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@messages/messages.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Messages\\views\\messages.twig");
    }
}
