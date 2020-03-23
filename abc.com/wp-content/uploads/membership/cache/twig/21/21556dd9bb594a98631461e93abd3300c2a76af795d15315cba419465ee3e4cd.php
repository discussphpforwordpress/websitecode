<?php

/* @users/partials/activity-title.twig */
class __TwigTemplate_fcd1a4d75307ee956de4553d339b999d6fc123aad54fce810e28c75d2f9a573e extends Twig_Template
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
        if (($this->getAttribute(($context["activity"] ?? null), "type", array()) == "follow")) {
            // line 2
            echo "\t";
            if ($this->env->getExtension('Membership_Users_Twig')->isCurrentUser($this->getAttribute(($context["activity"] ?? null), "target", array()))) {
                // line 3
                echo "\t\t";
                echo sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("%s now following you")), (((("<a href=\"" . $this->env->getExtension('Membership_Users_Twig')->profileUrl($this->getAttribute(                // line 5
($context["activity"] ?? null), "author", array()))) . "\">") . $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "author", array()), "displayName", array())) . "</a>"));
                // line 6
                echo "
\t";
            } else {
                // line 8
                echo "\t\t";
                echo sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("%s now following %s")), (((("<a href=\"" . $this->env->getExtension('Membership_Users_Twig')->profileUrl($this->getAttribute(                // line 10
($context["activity"] ?? null), "author", array()))) . "\">") . $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "author", array()), "displayName", array())) . "</a>"), (((("<a href=\"" . $this->env->getExtension('Membership_Users_Twig')->profileUrl($this->getAttribute(                // line 11
($context["activity"] ?? null), "target", array()))) . "\">") . $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "target", array()), "displayName", array())) . "</a>"));
                // line 13
                echo "
\t";
            }
        }
        // line 16
        echo "
";
        // line 17
        if (($this->getAttribute(($context["activity"] ?? null), "type", array()) == "friendship")) {
            // line 18
            echo " 
\t";
            // line 19
            echo sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("%s and %s becomes friends")), (((("<a href=\"" . $this->env->getExtension('Membership_Users_Twig')->profileUrl($this->getAttribute(            // line 21
($context["activity"] ?? null), "author", array()))) . "\">") . $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "author", array()), "displayName", array())) . "</a>"), (((("<a href=\"" . $this->env->getExtension('Membership_Users_Twig')->profileUrl($this->getAttribute(            // line 22
($context["activity"] ?? null), "target", array()))) . "\">") . $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "target", array()), "displayName", array())) . "</a>"));
            // line 23
            echo "
\t
";
        }
    }

    public function getTemplateName()
    {
        return "@users/partials/activity-title.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 23,  52 => 22,  51 => 21,  50 => 19,  47 => 18,  45 => 17,  42 => 16,  37 => 13,  35 => 11,  34 => 10,  32 => 8,  28 => 6,  26 => 5,  24 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@users/partials/activity-title.twig", "F:\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Users\\views\\partials\\activity-title.twig");
    }
}
