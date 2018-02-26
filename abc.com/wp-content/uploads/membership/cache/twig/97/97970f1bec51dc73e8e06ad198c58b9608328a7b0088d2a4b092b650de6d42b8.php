<?php

/* @messages/partials/conversations.twig */
class __TwigTemplate_e59aaeb78c22927142da171d37ced37f01a9ea1ebe1da7e5531993756b0ef048 extends Twig_Template
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
        ob_start();
        // line 2
        echo "\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["conversations"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["conversation"]) {
            // line 3
            echo "\t\t<div class=\"conversation\" data-id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["conversation"], "id", array()), "html", null, true);
            echo "\" style=\"display: none\">
\t\t\t<div class=\"ui equal width grid\">
\t\t\t\t<div class=\"left floated column\">
\t\t\t\t\t<button class=\"ui button primary mini show-all-conversations\">
\t\t\t\t\t\t<i class=\"angle left icon\"></i> ";
            // line 7
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("All conversations")), "html", null, true);
            echo "
\t\t\t\t\t</button>
\t\t\t\t</div>
\t\t\t\t<div class=\"right floated right aligned column\">
\t\t\t\t\t<div class=\"ui icon top right pointing dropdown button primary mini\">
\t\t\t\t\t\t<i class=\"ellipsis horizontal icon\"></i>
\t\t\t\t\t\t<div class=\"menu\">
\t\t\t\t\t\t\t<a class=\"item delete-messages\">";
            // line 14
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Delete messages")), "html", null, true);
            echo "</a>
\t\t\t\t\t\t\t<a class=\"item delete-conversation\">";
            // line 15
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Delete conversation")), "html", null, true);
            echo "</a>
\t\t\t\t\t\t\t";
            // line 16
            if (($this->getAttribute($context["conversation"], "type", array()) == "conversation")) {
                // line 17
                echo "\t\t\t\t\t\t\t\t<a class=\"item block-user\" ";
                if ($this->getAttribute($context["conversation"], "blocked", array())) {
                    echo "style=\"display: none\"";
                }
                echo ">";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Block user")), "html", null, true);
                echo "</a>
\t\t\t\t\t\t\t";
            }
            // line 19
            echo "\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t
\t\t\t<div class=\"conversation-messages ui comments\" style=\"display: none\">
\t\t\t\t<div class=\"ui basic vertical segment conversation-loader\" style=\"display:none;\">
\t\t\t\t\t<div class=\"ui active centered inline loader\"></div>
\t\t\t\t</div>

\t\t\t</div>

\t\t\t";
            // line 31
            ob_start();
            // line 32
            echo "\t\t\t\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["conversation"], "users", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
                // line 33
                echo "\t\t\t\t\t";
                if ( !$this->env->getExtension('Membership_Users_Twig')->isCurrentUser($context["user"])) {
                    echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "id", array()), "html", null, true);
                }
                // line 34
                echo "\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 35
            echo "\t\t\t";
            $context["blockedUserId"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 36
            echo "\t\t\t
\t\t\t<div class=\"ui basic secondary segment blocked-user\" data-user-id=\"";
            // line 37
            echo twig_escape_filter($this->env, twig_trim_filter(($context["blockedUserId"] ?? null)), "html", null, true);
            echo "\" ";
            if ( !$this->getAttribute($context["conversation"], "blocked", array())) {
                echo "style=\"display: none\"";
            }
            echo ">
\t\t\t\t<span>User is blocked.</span>
\t\t\t\t<button class=\"ui right floated button primary mini\">";
            // line 39
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Unblock")), "html", null, true);
            echo "</button>
\t\t\t</div>
\t\t\t
\t\t\t<div class=\"ui basic vertical segment send-message-reply-form\">
\t\t\t\t<div class=\"ui form\">
\t\t\t\t\t<div class=\"field\">
\t\t\t\t\t\t<textarea placeholder=\"";
            // line 45
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Write a message")), "html", null, true);
            echo "\" rows=\"2\"></textarea>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"ui right label characters-count mbsConversationCount\" style=\"display:none;\"></div>
\t\t\t\t\t<div class=\"mbsMessButtonsWrap\">
\t\t\t\t\t\t<button class=\"mbsAddAttachment2 ui button mini\"><span class=\"mbs-invisible\">_</span><i class=\"icon attach\"></i></button>
\t\t\t\t\t\t<button class=\"ui submit mini primary right floated button mbsAttMessSendBtn2\">";
            // line 50
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Send")), "html", null, true);
            echo "</button>
\t\t\t\t\t\t<div class=\"mbsAllAttachmentList2\"></div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t
\t\t\t<div class=\"ui basic clearing segment conversation-delete-messages-buttons\" style=\"display: none\">
\t\t\t\t<div class=\"ui center aligned basic container\">
\t\t\t\t\t<p>";
            // line 58
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Select messages to delete")), "html", null, true);
            echo "</p>
\t\t\t\t</div>
\t\t\t\t<div class=\"ui right aligned container\">
\t\t\t\t\t<button class=\"ui mini primary button delete-action\">";
            // line 61
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Delete")), "html", null, true);
            echo "</button>
\t\t\t\t\t<button class=\"ui mini button cancel-action\">";
            // line 62
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Cancel")), "html", null, true);
            echo "</button>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['conversation'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "@messages/partials/conversations.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  149 => 62,  145 => 61,  139 => 58,  128 => 50,  120 => 45,  111 => 39,  102 => 37,  99 => 36,  96 => 35,  90 => 34,  85 => 33,  80 => 32,  78 => 31,  64 => 19,  54 => 17,  52 => 16,  48 => 15,  44 => 14,  34 => 7,  26 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@messages/partials/conversations.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Messages\\views\\partials\\conversations.twig");
    }
}
