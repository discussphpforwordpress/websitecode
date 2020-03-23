<?php

/* @activity/partials/activity-comment-form.twig */
class __TwigTemplate_7301644baaadadd23d1bbb2c16b77ba56a2ac5c886ce5a6438d69cbb674799fa extends Twig_Template
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
        if (call_user_func_array($this->env->getFunction('isPostComment')->getCallable(), array($this->getAttribute(($context["activity"] ?? null), "group", array())))) {
            // line 2
            echo "<div class=\"mp-activity-comment-form\" data-context=\"";
            echo twig_escape_filter($this->env, ($context["context"] ?? null), "html", null, true);
            echo "\">
\t<div>
\t\t";
            // line 4
            if (((($context["context"] ?? null) == "group") && $this->env->getExtension('Membership_Groups_Twig')->canEditGroup(($context["requestedGroup"] ?? null)))) {
                // line 5
                echo "\t\t\t<div class=\"mp-comment-form-author comment-as\" data-group-id=\"";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["requestedGroup"] ?? null), "id", array()), "html", null, true);
                echo "\">
\t\t\t\t<div class=\"ui pointing left top dropdown\">
\t\t\t\t\t<div class=\"author\">
\t\t\t\t\t\t<img src=\"";
                // line 8
                echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Groups_Twig')->groupsLogo(($context["requestedGroup"] ?? null), "small"), "html", null, true);
                echo "\" class=\"activity-author-group\" alt=\"\">
\t\t\t\t\t\t<img src=\"";
                // line 9
                echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->userAvatar(($context["currentUser"] ?? null), "small"), "html", null, true);
                echo "\" class=\"activity-author-user\" style=\"display:none;\" alt=\"\">
\t\t\t\t\t</div>
\t\t\t\t\t<i class=\"dropdown icon\"></i>
\t\t\t\t\t<div class=\"menu\">
\t\t\t\t\t\t<div class=\"header\">";
                // line 13
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Comment as")), "html", null, true);
                echo "</div>
\t\t\t\t\t\t<div class=\"divider\"></div>
\t\t\t\t\t\t<div class=\"item\" data-value=\"group\">
\t\t\t\t\t\t\t<img class=\"ui avatar image\" src=\"";
                // line 16
                echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Groups_Twig')->groupsLogo(($context["requestedGroup"] ?? null), "small"), "html", null, true);
                echo "\" alt=\"\">
\t\t\t\t\t\t\t";
                // line 17
                echo twig_escape_filter($this->env, $this->getAttribute(($context["requestedGroup"] ?? null), "name", array()), "html", null, true);
                echo "
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"item\" data-value=\"user\">
\t\t\t\t\t\t\t<img class=\"ui avatar image\" src=\"";
                // line 20
                echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->userAvatar(($context["currentUser"] ?? null), "small"), "html", null, true);
                echo "\" alt=\"\">
\t\t\t\t\t\t\t";
                // line 21
                echo twig_escape_filter($this->env, $this->getAttribute(($context["currentUser"] ?? null), "displayName", array()), "html", null, true);
                echo "
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t";
            } else {
                // line 27
                echo "\t\t\t<div class=\"mp-comment-form-author\">
\t\t\t\t<img class=\"ui mini image\" src=\"";
                // line 28
                echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->userAvatar(($context["currentUser"] ?? null), "small"), "html", null, true);
                echo "\" alt=\"\">
\t\t\t</div>
\t\t";
            }
            // line 31
            echo "
\t\t<div class=\"ui form mp-comment-form\">
\t\t\t<textarea class=\"mp-comment-textarea\" rows=\"1\" placeholder=\"";
            // line 33
            echo twig_escape_filter($this->env, ((array_key_exists("placeholder", $context)) ? (_twig_default_filter(($context["placeholder"] ?? null), call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Write a comment...")))) : (call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Write a comment...")))), "html", null, true);
            echo "\"></textarea>
\t\t\t<div class=\"mp-comment-form-action post-form-buttons\">
\t\t\t\t<i class=\"icon attach mbsActivityCommentAttachBtn\" data-action=\"mbs-add-attachment\"><span class=\"icon attach\"></span></i>
\t\t\t\t<i class=\"send icon\" data-action=\"send-comment\"></i>
\t\t\t\t<i class=\"notched circle loading icon\" style=\"display: none\"></i>
\t\t\t</div>
\t\t\t<div class=\"mp-comment-form-edit-action\" style=\"display: none\">
\t\t\t\t<button class=\"ui floating icon button mini right floated primary\" data-action=\"save\">";
            // line 40
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Save")), "html", null, true);
            echo "</button>
\t\t\t\t<button class=\"ui floating icon button mini right floated secondary\" data-action=\"cancel\">";
            // line 41
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Cancel")), "html", null, true);
            echo "</button>
\t\t\t</div>
\t\t</div>
\t</div>
\t
\t<div class=\"ui segment mp-attachment-images\" style=\"display:none;\"></div>
\t
\t<div class=\"ui segment mp-attachment-link\" style=\"display:none;\">
\t\t<div class=\"ui active centered inline loader\" style=\"display:none;\"></div>
\t</div>
</div>
";
        }
    }

    public function getTemplateName()
    {
        return "@activity/partials/activity-comment-form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  103 => 41,  99 => 40,  89 => 33,  85 => 31,  79 => 28,  76 => 27,  67 => 21,  63 => 20,  57 => 17,  53 => 16,  47 => 13,  40 => 9,  36 => 8,  29 => 5,  27 => 4,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@activity/partials/activity-comment-form.twig", "F:\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Activity\\views\\partials\\activity-comment-form.twig");
    }
}
