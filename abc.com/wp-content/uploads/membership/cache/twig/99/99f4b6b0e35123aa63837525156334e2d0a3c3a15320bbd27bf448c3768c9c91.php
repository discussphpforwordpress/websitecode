<?php

/* @users/friends.twig */
class __TwigTemplate_4477ec450b3547d23f4b844782cd149537825af39b1be3e196887aeafd5d91e1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@users/profile.twig", "@users/friends.twig", 1);
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

    <div class=\"ui pointing secondary menu users-tab-items\" ";
        // line 6
        if ((twig_test_empty(($context["friendRequests"] ?? null)) ||  !$this->env->getExtension('Membership_Users_Twig')->isCurrentUser(($context["requestedUser"] ?? null)))) {
            echo "style=\"display:none\"";
        }
        echo ">
        <a class=\"item active\" data-tab=\"friends\">";
        // line 7
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("All Friends")), "html", null, true);
        echo " <div class=\"ui mini label\">";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["requestedUser"] ?? null), "friends", array()), "html", null, true);
        echo "</div></a>
        <a class=\"item\" data-tab=\"friend-requests\">";
        // line 8
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Friend Requests")), "html", null, true);
        echo " <div class=\"ui mini red label\">";
        echo twig_escape_filter($this->env, ($context["friendRequestsCount"] ?? null), "html", null, true);
        echo "</div></a>
    </div>
\t
\t<div class=\"users-tabs\">
\t    <div class=\"ui tab basic vertical segment active\" data-tab=\"friends\">
\t        <div class=\"ui basic vertical segment form user-search-input\">
\t            <div class=\"ui fluid icon input\">
\t\t            <input type=\"text\" placeholder=\"";
        // line 15
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Find user...")), "html", null, true);
        echo "\">
\t\t            <i class=\"search icon\"></i>
\t            </div>
\t        </div>
\t\t    <div class=\"ui two cards stackable users-list\">
\t\t\t    ";
        // line 20
        $this->loadTemplate("@users/partials/users-list.twig", "@users/friends.twig", 20)->display(array("users" => ($context["friends"] ?? null)));
        // line 21
        echo "\t\t    </div>
\t\t    <div class=\"ui basic vertical segment no-users\" ";
        // line 22
        if (($context["friends"] ?? null)) {
            echo "style=\"display: none\"";
        }
        echo ">
\t\t\t    <div class=\"ui message\">
\t\t\t\t    <p>";
        // line 24
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No friends to show.")), "html", null, true);
        echo "</p>
\t\t\t    </div>
\t\t    </div>
\t        <div class=\"ui basic segment very padded list-loader\" style=\"display:none;\">
\t            <div class=\"ui active loader\"></div>
\t        </div>
\t    </div>
\t
\t    ";
        // line 32
        if (( !twig_test_empty(($context["friendRequests"] ?? null)) && $this->env->getExtension('Membership_Users_Twig')->isCurrentUser(($context["requestedUser"] ?? null)))) {
            // line 33
            echo "\t        <div class=\"ui tab basic vertical segment\" data-tab=\"friend-requests\">
\t            <div class=\"ui basic vertical segment form user-search-input\">
\t                <div class=\"ui fluid icon input\">
\t\t                <input type=\"text\" placeholder=\"";
            // line 36
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Find user...")), "html", null, true);
            echo "\">
\t\t                <i class=\"search icon\"></i>
\t                </div>
\t            </div>
\t            <div class=\"ui two cards stackable users-list\">
\t                ";
            // line 41
            $this->loadTemplate("@users/partials/users-list-friend-requests.twig", "@users/friends.twig", 41)->display(array("users" => ($context["friendRequests"] ?? null)));
            // line 42
            echo "\t            </div>
\t\t        <div class=\"ui basic vertical segment no-users\" ";
            // line 43
            if (($context["friends"] ?? null)) {
                echo "style=\"display: none\"";
            }
            echo ">
\t\t\t        <div class=\"ui message\">
\t\t\t\t        <p>";
            // line 45
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No friend requests to show.")), "html", null, true);
            echo "</p>
\t\t\t        </div>
\t\t        </div>
\t            <div class=\"ui basic segment very padded list-loader\" style=\"display:none;\">
\t                <div class=\"ui active loader\"></div>
\t            </div>
\t        </div>
\t    ";
        }
        // line 53
        echo "\t</div>
</div>

";
        // line 56
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "users.send.message.modal.wnd"), "method"), "html", null, true);
        echo "
";
    }

    public function getTemplateName()
    {
        return "@users/friends.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  133 => 56,  128 => 53,  117 => 45,  110 => 43,  107 => 42,  105 => 41,  97 => 36,  92 => 33,  90 => 32,  79 => 24,  72 => 22,  69 => 21,  67 => 20,  59 => 15,  47 => 8,  41 => 7,  35 => 6,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@users/friends.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Users\\views\\friends.twig");
    }
}
