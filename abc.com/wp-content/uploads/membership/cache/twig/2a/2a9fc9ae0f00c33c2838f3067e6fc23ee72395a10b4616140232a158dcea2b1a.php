<?php

/* @users/partials/users-list.twig */
class __TwigTemplate_036b1f3ea6d5b0a24917f2b1ed7f5978da89c0a58c7d8f7184b4b5e94830f105 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'actionButtonsBefore' => array($this, 'block_actionButtonsBefore'),
            'actionButtons' => array($this, 'block_actionButtons'),
            'actionButtonsAfter' => array($this, 'block_actionButtonsAfter'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["users"] ?? null));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 2
            echo "    <div class=\"ui card mp-user-card\" data-id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "id", array()), "html", null, true);
            echo "\">
        <div class=\"image\">
            <a href=\"";
            // line 4
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->profileUrl($context["user"]), "html", null, true);
            echo "\" class=\"header\">
                <img src=\"";
            // line 5
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->userCover($context["user"], "medium"), "html", null, true);
            echo "\" alt=\"\">
            </a>
        </div>

        <div class=\"content\">
            <div class=\"mp-user-avatar-container\">
                <div class=\"mp-user-avatar\">
                    <a href=\"";
            // line 12
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->profileUrl($context["user"]), "html", null, true);
            echo "\" class=\"header\">
                        <img src=\"";
            // line 13
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->userAvatar($context["user"], "large"), "html", null, true);
            echo "\">
                    </a>
                </div>
            </div>

            <a href=\"";
            // line 18
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->profileUrl($context["user"]), "html", null, true);
            echo "\" style=\"position: relative\" class=\"header\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "displayName", array()), "html", null, true);
            echo "
\t            ";
            // line 19
            if (($this->getAttribute($context["user"], "badge_src", array()) && ($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "base", array()), "main", array()), "badges", array()) == "true"))) {
                // line 20
                echo "\t                <img class=\"mp-user-badge\" src=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "badge_src", array()), "html", null, true);
                echo "\" />
\t            ";
            }
            // line 22
            echo "            </a>

\t\t\t";
            // line 24
            if (($this->getAttribute($context["user"], "groupInfo", array()) && ($this->getAttribute($this->getAttribute($context["user"], "groupInfo", array()), "group_role", array()) == "administrator"))) {
                // line 25
                echo "\t\t\t\t<div class=\"mbsGroupUserRole\">
\t\t\t\t\t";
                // line 26
                if (($this->getAttribute($this->getAttribute($context["user"], "groupInfo", array()), "is_creator", array()) == 1)) {
                    // line 27
                    echo "\t\t\t\t\t\t";
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("(Group Creator)")), "html", null, true);
                    echo "
\t\t\t\t\t";
                } else {
                    // line 29
                    echo "\t\t\t\t\t\t";
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("(Group Administrator)")), "html", null, true);
                    echo "
\t\t\t\t\t";
                }
                // line 31
                echo "\t\t\t\t</div>
\t\t\t";
            }
            // line 33
            echo "
            <div class=\"ui center aligned container mp-social-stats social-stats\">
                ";
            // line 35
            if (($context["friendsActive"] ?? null)) {
                // line 36
                echo "                    <a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->profileUrl($context["user"], array("action" => "friends")), "html", null, true);
                echo "\" class=\"ui statistic tiny\">
                        <div class=\"value mp-social-stats-friends\">
                            ";
                // line 38
                echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "friends", array()), "html", null, true);
                echo "
                        </div>
                        <div class=\"label\">
                           ";
                // line 41
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Friends")), "html", null, true);
                echo "
                        </div>
                    </a>
                ";
            }
            // line 45
            echo "                ";
            if (($context["followersActive"] ?? null)) {
                // line 46
                echo "                    <a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->profileUrl($context["user"], array("action" => "followers")), "html", null, true);
                echo "\" class=\"ui statistic tiny\">
                        <div class=\"value mp-social-stats-follows\">
                            ";
                // line 48
                echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "follows", array()), "html", null, true);
                echo "
                        </div>
                        <div class=\"label\">
                            ";
                // line 51
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Follows")), "html", null, true);
                echo "
                        </div>
                    </a>
                    <a href=\"";
                // line 54
                echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->profileUrl($context["user"], array("action" => "followers")), "html", null, true);
                echo "\" class=\"ui statistic tiny\">
                        <div class=\"value mp-social-stats-followers\">
                            ";
                // line 56
                echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "followers", array()), "html", null, true);
                echo "
                        </div>
                        <div class=\"label\">
                            ";
                // line 59
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Followers")), "html", null, true);
                echo "
                        </div>
                    </a>
                ";
            }
            // line 63
            echo "            </div>
            ";
            // line 64
            if (($this->getAttribute($context["user"], "view", array()) && $this->getAttribute($this->getAttribute($context["user"], "view", array()), "userInfoContent", array()))) {
                echo "<div>";
                echo $this->getAttribute($this->getAttribute($context["user"], "view", array()), "userInfoContent", array());
                echo "</div>";
            }
            echo " <!--TODO-->
        </div>

        ";
            // line 67
            if ( !$this->env->getExtension('Membership_Users_Twig')->isCurrentUser($context["user"])) {
                // line 68
                echo "            <div class=\"extra content\">
                <div class=\"ui center aligned container user-action-buttons\">
                    ";
                // line 70
                $this->displayBlock('actionButtonsBefore', $context, $blocks);
                // line 71
                echo "                    ";
                $this->displayBlock('actionButtons', $context, $blocks);
                // line 101
                echo "                    ";
                $this->displayBlock('actionButtonsAfter', $context, $blocks);
                // line 102
                echo "                </div>
            </div>
        ";
            }
            // line 105
            echo "    </div>
";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    // line 70
    public function block_actionButtonsBefore($context, array $blocks = array())
    {
    }

    // line 71
    public function block_actionButtons($context, array $blocks = array())
    {
        // line 72
        echo "                        ";
        if (($context["userLoggedIn"] ?? null)) {
            // line 73
            echo "                            ";
            if (((call_user_func_array($this->env->getFunction('currentUserCan')->getCallable(), array("add-friends")) && ($context["friendsActive"] ?? null)) &&  !$this->env->getExtension('Membership_Users_Twig')->isFriendOfCurrentUser(($context["user"] ?? null)))) {
                // line 74
                echo "\t                            <button class=\"ui mini primary button\" data-action=\"add-friend\">";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Add Friend")), "html", null, true);
                echo "</button>
                            ";
            }
            // line 76
            echo "
                            ";
            // line 77
            if ((((call_user_func_array($this->env->getFunction('currentUserCan')->getCallable(), array("add-friends")) && ($context["friendsActive"] ?? null)) && $this->env->getExtension('Membership_Users_Twig')->isFriendOfCurrentUser(($context["user"] ?? null))) && $this->env->getExtension('Membership_Users_Twig')->currentUserIsFriendOf(($context["user"] ?? null)))) {
                // line 78
                echo "\t                            <button class=\"ui mini primary button\" data-action=\"remove-friend\">";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Unfriend")), "html", null, true);
                echo "</button>
                            ";
            }
            // line 80
            echo "\t                        
                            ";
            // line 81
            if ((((call_user_func_array($this->env->getFunction('currentUserCan')->getCallable(), array("add-friends")) && ($context["friendsActive"] ?? null)) && $this->env->getExtension('Membership_Users_Twig')->isFriendOfCurrentUser(($context["user"] ?? null))) &&  !$this->env->getExtension('Membership_Users_Twig')->currentUserIsFriendOf(($context["user"] ?? null)))) {
                // line 82
                echo "\t                            <button class=\"ui mini primary button\" data-action=\"cancel-friend-request\">";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Cancel a friend request")), "html", null, true);
                echo "</button>
                            ";
            }
            // line 84
            echo "
                            ";
            // line 85
            if (((call_user_func_array($this->env->getFunction('currentUserCan')->getCallable(), array("follow")) && ($context["followersActive"] ?? null)) &&  !$this->env->getExtension('Membership_Users_Twig')->isCurrentUserFollow(($context["user"] ?? null)))) {
                // line 86
                echo "\t                            <button class=\"ui mini primary button\" data-action=\"follow\">";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Follow")), "html", null, true);
                echo "</button>
                            ";
            }
            // line 88
            echo "
                            ";
            // line 89
            if (((call_user_func_array($this->env->getFunction('currentUserCan')->getCallable(), array("follow")) && ($context["followersActive"] ?? null)) && $this->env->getExtension('Membership_Users_Twig')->isCurrentUserFollow(($context["user"] ?? null)))) {
                // line 90
                echo "\t                            <button class=\"ui mini primary button\" data-action=\"unfollow\">";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Unfollow")), "html", null, true);
                echo "</button>
                            ";
            }
            // line 92
            echo "                            ";
            if (((call_user_func_array($this->env->getFunction('currentUserCan')->getCallable(), array("send-and-receive-messages")) && ($context["messagesActive"] ?? null)) && call_user_func_array($this->env->getFunction('currentUserHasPermission')->getCallable(), array("send-messages", ($context["user"] ?? null))))) {
                // line 93
                echo "\t                            <button class=\"ui mini primary button\" data-action=\"message\">";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Message")), "html", null, true);
                echo "</button>
                            ";
            }
            // line 95
            echo "                        ";
        } else {
            // line 96
            echo "                            <button class=\"ui mini primary button\" data-action=\"login\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Add Friend")), "html", null, true);
            echo "</button>
                            <button class=\"ui mini primary button\" data-action=\"login\">";
            // line 97
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Message")), "html", null, true);
            echo "</button>
                            <button class=\"ui mini primary button\" data-action=\"login\">";
            // line 98
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Follow")), "html", null, true);
            echo "</button>
                        ";
        }
        // line 100
        echo "                    ";
    }

    // line 101
    public function block_actionButtonsAfter($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "@users/partials/users-list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  319 => 101,  315 => 100,  310 => 98,  306 => 97,  301 => 96,  298 => 95,  292 => 93,  289 => 92,  283 => 90,  281 => 89,  278 => 88,  272 => 86,  270 => 85,  267 => 84,  261 => 82,  259 => 81,  256 => 80,  250 => 78,  248 => 77,  245 => 76,  239 => 74,  236 => 73,  233 => 72,  230 => 71,  225 => 70,  208 => 105,  203 => 102,  200 => 101,  197 => 71,  195 => 70,  191 => 68,  189 => 67,  179 => 64,  176 => 63,  169 => 59,  163 => 56,  158 => 54,  152 => 51,  146 => 48,  140 => 46,  137 => 45,  130 => 41,  124 => 38,  118 => 36,  116 => 35,  112 => 33,  108 => 31,  102 => 29,  96 => 27,  94 => 26,  91 => 25,  89 => 24,  85 => 22,  79 => 20,  77 => 19,  71 => 18,  63 => 13,  59 => 12,  49 => 5,  45 => 4,  39 => 2,  22 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@users/partials/users-list.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Users\\views\\partials\\users-list.twig");
    }
}
