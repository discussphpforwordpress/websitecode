<?php

/* @users/settings.twig */
class __TwigTemplate_ef90738a5c421b2985d19cfcc04422bb798bbdf95c87ea256144f07f7b65cf6a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@users/profile.twig", "@users/settings.twig", 1);
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
        echo "
\t";
        // line 5
        $context["privacyOptions"] = array("all-users" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("All users")), "friends" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Friends")), "friends-of-friends" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Friends of friends")), "only-me" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Only Me")));
        // line 11
        echo "\t
\t<div class=\"ui basic vertical segment\">
\t\t<div class=\"ui secondary pointing menu settings-nav-menu settings-tabs\">
\t\t\t<a class=\"item active\" data-tab=\"account\">";
        // line 14
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Account")), "html", null, true);
        echo "</a>
\t\t\t";
        // line 15
        if (call_user_func_array($this->env->getFunction('currentUserCan')->getCallable(), array("change-privacy-settings"))) {
            // line 16
            echo "\t\t\t\t<a class=\"item\" data-tab=\"privacy\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Privacy")), "html", null, true);
            echo "</a>
\t\t\t";
        }
        // line 18
        echo "\t\t\t<a class=\"item\" data-tab=\"blocked-users\">";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Blocked users")), "html", null, true);
        echo "</a>
\t\t\t<a class=\"item\" data-tab=\"notifications\">";
        // line 19
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Notifications ")), "html", null, true);
        echo "</a>

\t\t\t";
        // line 21
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "profileSettingsMenu"), "method"), "html", null, true);
        echo "

\t\t\t<div class=\"ui dropdown item\" style=\"display:none;\">
\t\t\t\t<i class=\"ellipsis horizontal icon\"></i>
\t\t\t\t<div class=\"menu\"></div>
\t\t\t</div>
\t\t</div>
\t</div>
\t
\t<div class=\"ui tab active\" data-tab=\"account\">
\t\t<div class=\"ui vertical segment account-settings\">
\t\t\t<h3 class=\"ui header\">";
        // line 32
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Account E-mail")), "html", null, true);
        echo "</h3>
\t\t\t<div class=\"ui form\">
\t\t\t\t<div class=\"field\">
\t\t\t\t\t<label>";
        // line 35
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Email")), "html", null, true);
        echo "</label>
\t\t\t\t\t<input type=\"email\" name=\"email\" value=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->getAttribute(($context["currentUser"] ?? null), "user_email", array()), "html", null, true);
        echo "\">
\t\t\t\t</div>
\t\t\t\t<button class=\"ui button primary mini change-email\">";
        // line 38
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Change email")), "html", null, true);
        echo "</button>
\t\t\t</div>
\t\t\t
\t\t\t<h3 class=\"ui header\">";
        // line 41
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Password change")), "html", null, true);
        echo "</h3>
\t\t\t<div class=\"ui form\">
\t\t\t\t<div class=\"field\">
\t\t\t\t\t<label>";
        // line 44
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("New Password")), "html", null, true);
        echo "</label>
\t\t\t\t\t<input type=\"password\" name=\"password\">
\t\t\t\t</div>
\t\t\t\t<div class=\"field\">
\t\t\t\t\t<label>";
        // line 48
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("New Password Confirmation")), "html", null, true);
        echo "</label>
\t\t\t\t\t<input type=\"password\" name=\"password-confirmation\">
\t\t\t\t</div>
\t\t\t\t<button class=\"ui button primary mini change-password\">";
        // line 51
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Change password")), "html", null, true);
        echo "</button>
\t\t\t</div>

\t\t\t";
        // line 54
        if (call_user_func_array($this->env->getFunction('currentUserCan')->getCallable(), array("can-delete-their-account"))) {
            // line 55
            echo "\t\t\t\t<h3 class=\"ui header\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Account Deletion")), "html", null, true);
            echo "</h3>
\t\t\t\t<div class=\"ui form\">
\t\t\t\t\t<div class=\"field\">
\t\t\t\t\t\t<div class=\"ui checkbox\">
\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"delete-confirmation\" class=\"hidden confirm-deletion\">
\t\t\t\t\t\t\t<label for=\"delete-confirmation\">";
            // line 60
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Confirm deletion (All user data will be deleted and cannot be restored)")), "html", null, true);
            echo "</label>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<button class=\"ui button negative mini confirm-deletion-button\" style=\"display: none\">";
            // line 63
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Delete account")), "html", null, true);
            echo "</button>
\t\t\t\t</div>
\t\t\t";
        }
        // line 66
        echo "\t\t</div>
\t</div>
\t<div class=\"ui tab\" data-tab=\"privacy\">
\t\t<div class=\"ui basic vertical segment privacy-settings\">
\t\t\t<div class=\"ui form\">
\t\t\t\t<h3 class=\"ui header\">";
        // line 71
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Privacy")), "html", null, true);
        echo "</h3>
\t\t\t\t
\t\t\t\t<div class=\"field\">
\t\t\t\t\t<label>";
        // line 74
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Who can view my profile.")), "html", null, true);
        echo "</label>
\t\t\t\t\t<select class=\"ui dropdown\" name=\"view-profile\">
\t\t\t\t\t\t";
        // line 76
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["privacyOptions"] ?? null));
        foreach ($context['_seq'] as $context["value"] => $context["title"]) {
            // line 77
            echo "\t\t\t\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, $context["value"], "html", null, true);
            echo "\" ";
            if (($this->getAttribute($this->getAttribute(($context["currentUser"] ?? null), "privacy", array()), "view-profile", array(), "array") == $context["value"])) {
                echo "selected";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["title"], "html", null, true);
            echo "</option>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['value'], $context['title'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 79
        echo "\t\t\t\t\t</select>
\t\t\t\t</div>
\t\t\t\t
\t\t\t\t<div class=\"field\">
\t\t\t\t\t<label>";
        // line 83
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Who can view my profile activity page.")), "html", null, true);
        echo "</label>
\t\t\t\t\t<select class=\"ui dropdown\" name=\"view-activity\">
\t\t\t\t\t\t";
        // line 85
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["privacyOptions"] ?? null));
        foreach ($context['_seq'] as $context["value"] => $context["title"]) {
            // line 86
            echo "\t\t\t\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, $context["value"], "html", null, true);
            echo "\" ";
            if (($this->getAttribute($this->getAttribute(($context["currentUser"] ?? null), "privacy", array()), "view-activity", array(), "array") == $context["value"])) {
                echo "selected";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["title"], "html", null, true);
            echo "</option>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['value'], $context['title'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 88
        echo "\t\t\t\t\t</select>
\t\t\t\t</div>
\t\t\t\t<div class=\"field\">
\t\t\t\t\t<label>";
        // line 91
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Who can post to my profile activity.")), "html", null, true);
        echo "</label>
\t\t\t\t\t<select class=\"ui dropdown\" name=\"post-activity\">
\t\t\t\t\t\t";
        // line 93
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["privacyOptions"] ?? null));
        foreach ($context['_seq'] as $context["value"] => $context["title"]) {
            // line 94
            echo "\t\t\t\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, $context["value"], "html", null, true);
            echo "\" ";
            if (($this->getAttribute($this->getAttribute(($context["currentUser"] ?? null), "privacy", array()), "post-activity", array(), "array") == $context["value"])) {
                echo "selected";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["title"], "html", null, true);
            echo "</option>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['value'], $context['title'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 96
        echo "\t\t\t\t\t</select>
\t\t\t\t</div>
\t\t\t\t";
        // line 98
        if (($this->getAttribute(($context["bConfig"] ?? null), "showFriendPostOpt", array()) == 1)) {
            // line 99
            echo "\t\t\t\t\t<div class=\"field\">
\t\t\t\t\t\t<input type=\"checkbox\" class=\"ui checkbox mbsFrontendCheckbox\" id=\"mbsUserPrivacyHideFriendPost\" name=\"friendPost\" value=\"1\" ";
            // line 100
            if (($this->getAttribute($this->getAttribute(($context["currentUser"] ?? null), "privacy", array()), "hideFriendPost", array(), "array") == 1)) {
                echo "checked=\"checked\"";
            }
            echo "/>
\t\t\t\t\t\t<label for=\"mbsUserPrivacyHideFriendPost\" class=\"mbsFrontendLbl\">";
            // line 101
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Don't add friend's posts to my activity.")), "html", null, true);
            echo "</label>
\t\t\t\t\t</div>
\t\t\t\t";
        }
        // line 104
        echo "\t\t\t\t<div class=\"field\">
\t\t\t\t\t<label>";
        // line 105
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Who can comment my activity posts.")), "html", null, true);
        echo "</label>
\t\t\t\t\t<select class=\"ui dropdown\" name=\"post-comments\">
\t\t\t\t\t\t";
        // line 107
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["privacyOptions"] ?? null));
        foreach ($context['_seq'] as $context["value"] => $context["title"]) {
            // line 108
            echo "\t\t\t\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, $context["value"], "html", null, true);
            echo "\" ";
            if (($this->getAttribute($this->getAttribute(($context["currentUser"] ?? null), "privacy", array()), "post-comments", array(), "array") == $context["value"])) {
                echo "selected";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["title"], "html", null, true);
            echo "</option>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['value'], $context['title'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 110
        echo "\t\t\t\t\t</select>
\t\t\t\t</div>
\t\t\t\t<div class=\"field\">
\t\t\t\t\t<label>";
        // line 113
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Who can view comments on my activity posts.")), "html", null, true);
        echo "</label>
\t\t\t\t\t<select class=\"ui dropdown\" name=\"view-comments\">
\t\t\t\t\t\t";
        // line 115
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["privacyOptions"] ?? null));
        foreach ($context['_seq'] as $context["value"] => $context["title"]) {
            // line 116
            echo "\t\t\t\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, $context["value"], "html", null, true);
            echo "\" ";
            if (($this->getAttribute($this->getAttribute(($context["currentUser"] ?? null), "privacy", array()), "view-comments", array(), "array") == $context["value"])) {
                echo "selected";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["title"], "html", null, true);
            echo "</option>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['value'], $context['title'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 118
        echo "\t\t\t\t\t</select>
\t\t\t\t</div>
\t\t\t\t<div class=\"field\">
\t\t\t\t\t<label>";
        // line 121
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Who can view about information on my profile.")), "html", null, true);
        echo "</label>
\t\t\t\t\t<select class=\"ui dropdown\" name=\"view-about\">
\t\t\t\t\t\t";
        // line 123
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["privacyOptions"] ?? null));
        foreach ($context['_seq'] as $context["value"] => $context["title"]) {
            // line 124
            echo "\t\t\t\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, $context["value"], "html", null, true);
            echo "\" ";
            if (($this->getAttribute($this->getAttribute(($context["currentUser"] ?? null), "privacy", array()), "view-about", array(), "array") == $context["value"])) {
                echo "selected";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["title"], "html", null, true);
            echo "</option>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['value'], $context['title'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 126
        echo "\t\t\t\t\t</select>
\t\t\t\t</div>
\t\t\t\t<div class=\"field\">
\t\t\t\t\t<label>";
        // line 129
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Who can view my friends.")), "html", null, true);
        echo "</label>
\t\t\t\t\t<select class=\"ui dropdown\" name=\"view-friends\">
\t\t\t\t\t\t";
        // line 131
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["privacyOptions"] ?? null));
        foreach ($context['_seq'] as $context["value"] => $context["title"]) {
            // line 132
            echo "\t\t\t\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, $context["value"], "html", null, true);
            echo "\" ";
            if (($this->getAttribute($this->getAttribute(($context["currentUser"] ?? null), "privacy", array()), "view-friends", array(), "array") == $context["value"])) {
                echo "selected";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["title"], "html", null, true);
            echo "</option>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['value'], $context['title'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 134
        echo "\t\t\t\t\t</select>
\t\t\t\t</div>
\t\t\t\t<div class=\"field\">
\t\t\t\t\t<label>";
        // line 137
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Who can view my follows.")), "html", null, true);
        echo "</label>
\t\t\t\t\t<select class=\"ui dropdown\" name=\"view-follows\">
\t\t\t\t\t\t";
        // line 139
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["privacyOptions"] ?? null));
        foreach ($context['_seq'] as $context["value"] => $context["title"]) {
            // line 140
            echo "\t\t\t\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, $context["value"], "html", null, true);
            echo "\" ";
            if (($this->getAttribute($this->getAttribute(($context["currentUser"] ?? null), "privacy", array()), "view-follows", array(), "array") == $context["value"])) {
                echo "selected";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["title"], "html", null, true);
            echo "</option>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['value'], $context['title'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 142
        echo "\t\t\t\t\t</select>
\t\t\t\t</div>
\t\t\t\t<div class=\"field\">
\t\t\t\t\t<label>";
        // line 145
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Who can view my followers.")), "html", null, true);
        echo "</label>
\t\t\t\t\t<select class=\"ui dropdown\" name=\"view-followers\">
\t\t\t\t\t\t";
        // line 147
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["privacyOptions"] ?? null));
        foreach ($context['_seq'] as $context["value"] => $context["title"]) {
            // line 148
            echo "\t\t\t\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, $context["value"], "html", null, true);
            echo "\" ";
            if (($this->getAttribute($this->getAttribute(($context["currentUser"] ?? null), "privacy", array()), "view-followers", array(), "array") == $context["value"])) {
                echo "selected";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["title"], "html", null, true);
            echo "</option>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['value'], $context['title'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 150
        echo "\t\t\t\t\t</select>
\t\t\t\t</div>
\t\t\t\t<div class=\"field\">
\t\t\t\t\t<label>";
        // line 153
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Who can view my groups.")), "html", null, true);
        echo "</label>
\t\t\t\t\t<select class=\"ui dropdown\" name=\"view-groups\">
\t\t\t\t\t\t";
        // line 155
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["privacyOptions"] ?? null));
        foreach ($context['_seq'] as $context["value"] => $context["title"]) {
            // line 156
            echo "\t\t\t\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, $context["value"], "html", null, true);
            echo "\" ";
            if (($this->getAttribute($this->getAttribute(($context["currentUser"] ?? null), "privacy", array()), "view-groups", array(), "array") == $context["value"])) {
                echo "selected";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["title"], "html", null, true);
            echo "</option>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['value'], $context['title'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 158
        echo "\t\t\t\t\t</select>
\t\t\t\t</div>
\t\t\t\t<div class=\"field\">
\t\t\t\t\t<label>";
        // line 161
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Who can view my posts.")), "html", null, true);
        echo "</label>
\t\t\t\t\t<select class=\"ui dropdown\" name=\"view-posts\">
\t\t\t\t\t\t";
        // line 163
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["privacyOptions"] ?? null));
        foreach ($context['_seq'] as $context["value"] => $context["title"]) {
            // line 164
            echo "\t\t\t\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, $context["value"], "html", null, true);
            echo "\" ";
            if (($this->getAttribute($this->getAttribute(($context["currentUser"] ?? null), "privacy", array()), "view-posts", array(), "array") == $context["value"])) {
                echo "selected";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["title"], "html", null, true);
            echo "</option>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['value'], $context['title'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 166
        echo "\t\t\t\t\t</select>
\t\t\t\t</div>
\t\t\t\t<div class=\"field\">
\t\t\t\t\t<label>";
        // line 169
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Who can send me private messages.")), "html", null, true);
        echo "</label>
\t\t\t\t\t<select class=\"ui dropdown\" name=\"send-messages\">
\t\t\t\t\t\t";
        // line 171
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["privacyOptions"] ?? null));
        foreach ($context['_seq'] as $context["value"] => $context["title"]) {
            // line 172
            echo "\t\t\t\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, $context["value"], "html", null, true);
            echo "\" ";
            if (($this->getAttribute($this->getAttribute(($context["currentUser"] ?? null), "privacy", array()), "send-messages", array(), "array") == $context["value"])) {
                echo "selected";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["title"], "html", null, true);
            echo "</option>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['value'], $context['title'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 174
        echo "\t\t\t\t\t</select>
\t\t\t\t</div>
\t\t\t\t";
        // line 185
        echo "\t\t\t</div>
\t\t</div>
\t</div>
\t<div class=\"ui tab\" data-tab=\"blocked-users\">
\t\t<div class=\"ui basic vertical segment blocked-users\">
\t\t\t<div class=\"column\">
\t\t\t\t<div class=\"ui divided items\">
\t\t\t\t\t";
        // line 192
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["blockedUsers"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 193
            echo "\t\t\t\t\t\t<div class=\"item blocked-user\" data-id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "id", array()), "html", null, true);
            echo "\">
\t\t\t\t\t\t\t<a href=\"";
            // line 194
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->profileUrl($context["user"]), "html", null, true);
            echo "\" class=\"ui tiny image\">
\t\t\t\t\t\t\t\t<img src=\"";
            // line 195
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->userAvatar($context["user"], "default"), "html", null, true);
            echo "\">
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t<div class=\"content\">
\t\t\t\t\t\t\t\t<a href=\"";
            // line 198
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->profileUrl($context["user"]), "html", null, true);
            echo "\" class=\"header\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "displayName", array()), "html", null, true);
            echo "</a>
\t\t\t\t\t\t\t\t<div class=\"extra\">
\t\t\t\t\t\t\t\t\t<button class=\"ui button mini primary\">";
            // line 200
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Unblock")), "html", null, true);
            echo "</button>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 205
        echo "\t\t\t\t\t<div class=\"ui basic vertical segment\" ";
        if (($context["followers"] ?? null)) {
            echo "style=\"display: none\"";
        }
        echo ">
\t\t\t\t\t\t<div class=\"ui message\">
\t\t\t\t\t\t\t<p>";
        // line 207
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No blocked users to show.")), "html", null, true);
        echo "</p>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
\t<div class=\"ui tab\" data-tab=\"notifications\">
\t\t<div class=\"ui basic vertical segment notifications-settings\">
\t\t\t<div class=\"column\">
\t\t\t\t<div class=\"ui divided items\">
\t\t\t\t\t<div class=\"ui form\">
\t\t\t\t\t\t<h5 class=\"ui header\">Notify me when someone</h5>
\t\t\t\t\t\t<div class=\"field\">
\t\t\t\t\t\t\t<div class=\"ui checkbox\">
\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"notifications-messages\" class=\"hidden\"
\t\t\t\t\t\t\t\t       ";
        // line 223
        if (($this->getAttribute($this->getAttribute(($context["currentUser"] ?? null), "notifications", array()), "messages", array(), "array") == "on")) {
            echo "checked=\"checked\"";
        }
        // line 224
        echo "\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t<label for=\"notifications-messages\">";
        // line 225
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Send private message")), "html", null, true);
        echo "</label>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"field\">
\t\t\t\t\t\t\t<div class=\"ui checkbox\">
\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"notifications-friend-requests\" class=\"hidden\"
\t\t\t\t\t\t\t\t       ";
        // line 231
        if (($this->getAttribute($this->getAttribute(($context["currentUser"] ?? null), "notifications", array()), "friend-requests", array(), "array") == "on")) {
            echo "checked=\"checked\"";
        }
        // line 232
        echo "\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t<label for=\"notifications-friend-requests\">";
        // line 233
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Send friend request")), "html", null, true);
        echo "</label>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"field\">
\t\t\t\t\t\t\t<div class=\"ui checkbox\">
\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"notifications-follows\" class=\"hidden\"
\t\t\t\t\t\t\t\t       ";
        // line 239
        if (($this->getAttribute($this->getAttribute(($context["currentUser"] ?? null), "notifications", array()), "follows", array(), "array") == "on")) {
            echo "checked=\"checked\"";
        }
        // line 240
        echo "\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t<label for=\"notifications-follows\">";
        // line 241
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Follows me")), "html", null, true);
        echo "</label>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
\t";
        // line 249
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "profileSettingsTabs"), "method"), "html", null, true);
        echo "
\t\t
\t<div class=\"ui small modal mp-confirm-password\">
\t\t<i class=\"close icon\"></i>
\t\t<div class=\"header\">
\t\t\t";
        // line 254
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Confirm your current password to continue")), "html", null, true);
        echo "
\t\t</div>
\t\t<div class=\"content\">
\t\t\t<div class=\"ui form\">
\t\t\t\t<div class=\"field\">
\t\t\t\t\t<label>";
        // line 259
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Password")), "html", null, true);
        echo "</label>
\t\t\t\t\t<input type=\"password\">
\t\t\t\t</div>
\t\t\t\t<div class=\"ui message error\"></div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"actions\">
\t\t\t<button class=\"ui mini button secondary cancel\">";
        // line 266
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Cancel")), "html", null, true);
        echo "</button>
\t\t\t<button class=\"ui mini primary positive button\">";
        // line 267
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Confirm password")), "html", null, true);
        echo "</button>
\t\t</div>
\t</div>
\t
";
    }

    public function getTemplateName()
    {
        return "@users/settings.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  679 => 267,  675 => 266,  665 => 259,  657 => 254,  649 => 249,  638 => 241,  635 => 240,  631 => 239,  622 => 233,  619 => 232,  615 => 231,  606 => 225,  603 => 224,  599 => 223,  580 => 207,  572 => 205,  561 => 200,  554 => 198,  548 => 195,  544 => 194,  539 => 193,  535 => 192,  526 => 185,  522 => 174,  507 => 172,  503 => 171,  498 => 169,  493 => 166,  478 => 164,  474 => 163,  469 => 161,  464 => 158,  449 => 156,  445 => 155,  440 => 153,  435 => 150,  420 => 148,  416 => 147,  411 => 145,  406 => 142,  391 => 140,  387 => 139,  382 => 137,  377 => 134,  362 => 132,  358 => 131,  353 => 129,  348 => 126,  333 => 124,  329 => 123,  324 => 121,  319 => 118,  304 => 116,  300 => 115,  295 => 113,  290 => 110,  275 => 108,  271 => 107,  266 => 105,  263 => 104,  257 => 101,  251 => 100,  248 => 99,  246 => 98,  242 => 96,  227 => 94,  223 => 93,  218 => 91,  213 => 88,  198 => 86,  194 => 85,  189 => 83,  183 => 79,  168 => 77,  164 => 76,  159 => 74,  153 => 71,  146 => 66,  140 => 63,  134 => 60,  125 => 55,  123 => 54,  117 => 51,  111 => 48,  104 => 44,  98 => 41,  92 => 38,  87 => 36,  83 => 35,  77 => 32,  63 => 21,  58 => 19,  53 => 18,  47 => 16,  45 => 15,  41 => 14,  36 => 11,  34 => 5,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@users/settings.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Users\\views\\settings.twig");
    }
}
