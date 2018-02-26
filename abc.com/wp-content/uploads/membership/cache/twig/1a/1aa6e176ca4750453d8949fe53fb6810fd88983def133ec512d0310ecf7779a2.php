<?php

/* @users/followers.twig */
class __TwigTemplate_8beccf9c0d8307577cc35cc4bd1c4ad8aa7cc60c130228012eb74a3a21dfda33 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@users/profile.twig", "@users/followers.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@users/profile.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "<div class=\"ui basic vertical segment\">
\t
\t";
        // line 6
        if ((call_user_func_array($this->env->getFunction('currentUserHasPermission')->getCallable(), array("view-follows", ($context["requestedUser"] ?? null))) || call_user_func_array($this->env->getFunction('currentUserHasPermission')->getCallable(), array("view-followers", ($context["requestedUser"] ?? null))))) {
            // line 7
            echo "\t\t<div class=\"ui pointing secondary menu users-tab-items\">
\t\t\t";
            // line 8
            if (call_user_func_array($this->env->getFunction('currentUserHasPermission')->getCallable(), array("view-followers", ($context["requestedUser"] ?? null)))) {
                // line 9
                echo "\t\t\t\t<a class=\"item active\" data-tab=\"followers\">";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Followers")), "html", null, true);
                echo " <div class=\"ui mini label\">";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["requestedUser"] ?? null), "followers", array()), "html", null, true);
                echo "</div></a>
\t\t\t";
            }
            // line 11
            echo "\t\t\t";
            if (call_user_func_array($this->env->getFunction('currentUserHasPermission')->getCallable(), array("view-follows", ($context["requestedUser"] ?? null)))) {
                // line 12
                echo "\t\t\t\t<a class=\"item\" data-tab=\"following\">";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Following")), "html", null, true);
                echo " <div class=\"ui mini label\">";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["requestedUser"] ?? null), "follows", array()), "html", null, true);
                echo "</div></a>
\t\t\t";
            }
            // line 14
            echo "\t\t</div>
\t";
        }
        // line 16
        echo "\t
\t<div class=\"users-tabs\">
\t\t<div class=\"ui tab basic vertical segment active\" data-tab=\"followers\">
\t\t\t<div class=\"ui basic vertical segment form user-search-input\">
\t\t\t\t<div class=\"ui fluid icon input\">
\t\t\t\t\t<input type=\"text\" placeholder=\"";
        // line 21
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Find user...")), "html", null, true);
        echo "\">
\t\t\t\t\t<i class=\"search icon\"></i>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"ui two cards stackable users-list\">
\t\t\t\t";
        // line 26
        $this->loadTemplate("@users/partials/users-list.twig", "@users/followers.twig", 26)->display(array("users" => ($context["followers"] ?? null)));
        // line 27
        echo "\t\t\t</div>
\t\t\t<div class=\"ui basic vertical segment no-users\" ";
        // line 28
        if (($context["followers"] ?? null)) {
            echo "style=\"display: none\"";
        }
        echo ">
\t\t\t\t<div class=\"ui message\">
\t\t\t\t\t<p>";
        // line 30
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No followers to show.")), "html", null, true);
        echo "</p>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"ui basic segment very padded list-loader\" style=\"display:none;\">
\t\t\t\t<div class=\"ui active loader\"></div>
\t\t\t</div>
\t\t</div>
\t\t
\t\t<div class=\"ui tab basic vertical segment\" data-tab=\"following\">
\t\t\t<div class=\"ui basic vertical segment form user-search-input\">
\t\t\t\t<div class=\"ui fluid icon input\">
\t\t\t\t\t<input type=\"text\" placeholder=\"";
        // line 41
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Find user...")), "html", null, true);
        echo "\">
\t\t\t\t\t<i class=\"search icon\"></i>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"ui two cards stackable users-list\">
\t\t\t\t";
        // line 46
        $this->loadTemplate("@users/partials/users-list.twig", "@users/followers.twig", 46)->display(array("users" => ($context["follows"] ?? null)));
        // line 47
        echo "\t\t\t</div>
\t\t\t<div class=\"ui basic vertical segment no-users\" ";
        // line 48
        if (($context["follows"] ?? null)) {
            echo "style=\"display: none\"";
        }
        echo ">
\t\t\t\t<div class=\"ui message\">
\t\t\t\t\t<p>";
        // line 50
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No following to show.")), "html", null, true);
        echo "</p>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"ui basic segment very padded list-loader\" style=\"display:none;\">
\t\t\t\t<div class=\"ui active loader\"></div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>

";
        // line 60
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "users.send.message.modal.wnd"), "method"), "html", null, true);
        echo "
";
    }

    public function getTemplateName()
    {
        return "@users/followers.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  139 => 60,  126 => 50,  119 => 48,  116 => 47,  114 => 46,  106 => 41,  92 => 30,  85 => 28,  82 => 27,  80 => 26,  72 => 21,  65 => 16,  61 => 14,  53 => 12,  50 => 11,  42 => 9,  40 => 8,  37 => 7,  35 => 6,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@users/followers.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Users\\views\\followers.twig");
    }
}
