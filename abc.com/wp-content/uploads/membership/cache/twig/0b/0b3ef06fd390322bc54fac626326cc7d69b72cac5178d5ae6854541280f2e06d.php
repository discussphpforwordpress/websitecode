<?php

/* @users/profile.twig */
class __TwigTemplate_afdd73300edba337d2f991ca9b5ea384f94890d8174f1bc736fe684c30896bb2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div id=\"membership-profile\" class=\"sc-membership\">
    <div class=\"mp-cover-container\">
        <div class=\"ui inverted dimmer cover-loader\">
            <div class=\"ui loader\"></div>
        </div>

        <div class=\"mp-cover\">
            <img width=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "profile", array()), "cover-size", array(), "array"), "width", array()), "html", null, true);
        echo "\"
                 height=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "profile", array()), "cover-size", array(), "array"), "height", array()), "html", null, true);
        echo "\"
                 class=\"ui fluid image cover-image\"
                 src=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->userCover(($context["requestedUser"] ?? null), "default"), "html", null, true);
        echo "\">
        </div>

        ";
        // line 14
        if (($this->env->getExtension('Membership_Users_Twig')->isCurrentUser(($context["requestedUser"] ?? null)) && ($context["unreadNotifications"] ?? null))) {
            // line 15
            echo "            <div class=\"mp-unread-notifications\">
                <a href=\"";
            // line 16
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->profileUrl(($context["requestedUser"] ?? null), array("action" => "notifications")), "html", null, true);
            echo "\"><i class=\"alarm icon\"></i></a>
            </div>
        ";
        }
        // line 19
        echo "
        ";
        // line 20
        if (($this->env->getExtension('Membership_Users_Twig')->isCurrentUser(($context["requestedUser"] ?? null)) && ($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "profile", array(), "array"), "use-cover", array(), "array") == "yes"))) {
            // line 21
            echo "            <div class=\"mp-update-cover ";
            if ($this->env->getExtension('Membership_Users_Twig')->isDefaultCover(($context["requestedUser"] ?? null))) {
                echo "default";
            }
            echo "\">
                <div class=\"ui top right pointing dropdown item\">
                    <i class=\"photo icon\"></i>
                    <div class=\"menu\">
                        <a class=\"item\" data-action=\"upload-photo\">";
            // line 25
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Upload photo")), "html", null, true);
            echo "</a>
                        <a class=\"item\" data-action=\"remove-photo\">";
            // line 26
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Remove")), "html", null, true);
            echo "</a>
                    </div>
                </div>
            </div>

            <div class=\"mp-crop-cover-action\">
                <button class=\"ui mini primary button\" data-action=\"save-photo\">";
            // line 32
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Save")), "html", null, true);
            echo "</button>
                <button class=\"ui mini secondary button\" data-action=\"cancel\">";
            // line 33
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Cancel")), "html", null, true);
            echo "</button>
            </div>
        ";
        }
        // line 36
        echo "        <div class=\"mp-user-display-name\">";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["requestedUser"] ?? null), "displayName", array()), "html", null, true);
        echo "
        ";
        // line 37
        if (($this->getAttribute(($context["requestedUser"] ?? null), "badge_src", array()) && ($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "base", array()), "main", array()), "badges", array()) == "true"))) {
            // line 38
            echo "\t        <img class=\"mp-single-badge\" src=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["requestedUser"] ?? null), "badge_src", array()), "html", null, true);
            echo "\" />
        ";
        }
        // line 40
        echo "        </div>

        <div class=\"mp-avatar-container\">
            <div class=\"mp-avatar ";
        // line 43
        if ($this->env->getExtension('Membership_Users_Twig')->isDefaultAvatar(($context["requestedUser"] ?? null))) {
            echo "default";
        }
        echo " update-avatar-menu\">
                <img width=\"";
        // line 44
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "profile", array()), "avatar-size", array(), "array"), "width", array()), "html", null, true);
        echo "\"
                     height=\"";
        // line 45
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "profile", array()), "avatar-size", array(), "array"), "height", array()), "html", null, true);
        echo "\"
                     src=\"";
        // line 46
        echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->userAvatar(($context["requestedUser"] ?? null), "default"), "html", null, true);
        echo "\"
                     class=\"avatar-image\">
                ";
        // line 48
        if ($this->env->getExtension('Membership_Users_Twig')->isCurrentUser(($context["requestedUser"] ?? null))) {
            // line 49
            echo "                    <div class=\"mp-update-avatar-overlay\">
                        <span>";
            // line 50
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Change profile image")), "html", null, true);
            echo "</span>
                    </div>
                    <div class=\"ui inverted dimmer avatar-loader\">
                        <div class=\"ui loader\"></div>
                    </div>
                    <div class=\"ui top left pointing dropdown item\">
                        <div class=\"menu\">
                            <a class=\"item\" data-action=\"upload-photo\">";
            // line 57
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Upload photo")), "html", null, true);
            echo "</a>
                            <a class=\"item\" data-action=\"remove-photo\">";
            // line 58
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Remove")), "html", null, true);
            echo "</a>
                        </div>
                    </div>
                ";
        }
        // line 62
        echo "            </div>
        </div>
    </div>
    <div class=\"mp-container\">
        <div class=\"mp-profile-social-stats social-stats ";
        // line 66
        if ( !($context["userLoggedIn"] ?? null)) {
            echo "not-logged-in";
        }
        echo "\">
\t         ";
        // line 67
        if (($context["friendsActive"] ?? null)) {
            // line 68
            echo "\t             <a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->profileUrl(($context["requestedUser"] ?? null), array("action" => "friends")), "html", null, true);
            echo "\" class=\"ui statistic tiny\">
\t                 <div class=\"value mp-social-stats-friends\">";
            // line 69
            echo twig_escape_filter($this->env, $this->getAttribute(($context["requestedUser"] ?? null), "friends", array()), "html", null, true);
            echo "</div>
\t                 <div class=\"label\">";
            // line 70
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Friends")), "html", null, true);
            echo "</div>
\t             </a>
\t         ";
        }
        // line 73
        echo "\t         ";
        if (($context["followersActive"] ?? null)) {
            // line 74
            echo "\t             <a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->profileUrl(($context["requestedUser"] ?? null), array("action" => "followers")), "html", null, true);
            echo "\" class=\"ui statistic tiny\">
\t                 <div class=\"value mp-social-stats-follows\">";
            // line 75
            echo twig_escape_filter($this->env, $this->getAttribute(($context["requestedUser"] ?? null), "follows", array()), "html", null, true);
            echo "</div>
\t                 <div class=\"label\">";
            // line 76
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Follows")), "html", null, true);
            echo "</div>
\t             </a>
\t         ";
        }
        // line 79
        echo "\t         ";
        if (($context["followersActive"] ?? null)) {
            // line 80
            echo "\t             <a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->profileUrl(($context["requestedUser"] ?? null), array("action" => "followers")), "html", null, true);
            echo "\" class=\"ui statistic tiny\">
\t                 <div class=\"value mp-social-stats-followers\">";
            // line 81
            echo twig_escape_filter($this->env, $this->getAttribute(($context["requestedUser"] ?? null), "followers", array()), "html", null, true);
            echo "</div>
\t                 <div class=\"label\">";
            // line 82
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Followers")), "html", null, true);
            echo "</div>
\t             </a>
\t         ";
        }
        // line 85
        echo "        </div>
\t    
        ";
        // line 87
        if (($context["userLoggedIn"] ?? null)) {
            // line 88
            echo "\t        <div class=\"ui secondary mini menu right floated mp-user-action-menu\">
\t            <div class=\"right menu\" style=\"display: none\">
\t                ";
            // line 90
            if ( !$this->env->getExtension('Membership_Users_Twig')->isCurrentUser(($context["requestedUser"] ?? null))) {
                // line 91
                echo "\t                    ";
                if ((($context["friendsActive"] ?? null) && call_user_func_array($this->env->getFunction('currentUserCan')->getCallable(), array("add-friends")))) {
                    // line 92
                    echo "\t                        ";
                    if (( !$this->env->getExtension('Membership_Users_Twig')->isFriendOfCurrentUser(($context["requestedUser"] ?? null)) &&  !$this->env->getExtension('Membership_Users_Twig')->currentUserIsFriendOf(($context["requestedUser"] ?? null)))) {
                        // line 93
                        echo "\t                            <div class=\"horizontally fitted item\">
\t                                <button class=\"ui mini primary button\" data-action=\"add-friend\">";
                        // line 94
                        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Add Friend")), "html", null, true);
                        echo "</button>
\t                            </div>
\t                        ";
                    }
                    // line 97
                    echo "\t                        ";
                    if (($this->env->getExtension('Membership_Users_Twig')->currentUserIsFriendOf(($context["requestedUser"] ?? null)) && $this->env->getExtension('Membership_Users_Twig')->isFriendOfCurrentUser(($context["requestedUser"] ?? null)))) {
                        // line 98
                        echo "\t                            <div class=\"horizontally fitted item\">
\t                                <button class=\"ui mini primary button\" data-action=\"remove-friend\">";
                        // line 99
                        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Unfriend")), "html", null, true);
                        echo "</button>
\t                            </div>
\t                        ";
                    }
                    // line 102
                    echo "\t                        ";
                    if (($this->env->getExtension('Membership_Users_Twig')->currentUserIsFriendOf(($context["requestedUser"] ?? null)) &&  !$this->env->getExtension('Membership_Users_Twig')->isFriendOfCurrentUser(($context["requestedUser"] ?? null)))) {
                        // line 103
                        echo "\t                            <div class=\"horizontally fitted item\">
\t                                <button class=\"ui mini primary button\" data-action=\"add-friend\">";
                        // line 104
                        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Accept Friend Request")), "html", null, true);
                        echo "</button>
\t                            </div>
\t                            <div class=\"horizontally fitted item\">
\t                                <button class=\"ui mini primary button\" data-action=\"remove-friend\">";
                        // line 107
                        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Decline Friend Request")), "html", null, true);
                        echo "</button>
\t                            </div>
\t                        ";
                    }
                    // line 110
                    echo "\t                        ";
                    if (( !$this->env->getExtension('Membership_Users_Twig')->currentUserIsFriendOf(($context["requestedUser"] ?? null)) && $this->env->getExtension('Membership_Users_Twig')->isFriendOfCurrentUser(($context["requestedUser"] ?? null)))) {
                        // line 111
                        echo "\t                            <div class=\"horizontally fitted item\">
\t                                <button class=\"ui mini primary button\" data-action=\"cancel-friend-request\">";
                        // line 112
                        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Cancel Friend Request")), "html", null, true);
                        echo "</button>
\t                            </div>
\t                        ";
                    }
                    // line 115
                    echo "\t                    ";
                }
                // line 116
                echo "\t                    ";
                if ((($context["messagesActive"] ?? null) && call_user_func_array($this->env->getFunction('currentUserHasPermission')->getCallable(), array("send-messages", ($context["requestedUser"] ?? null))))) {
                    // line 117
                    echo "\t                        <div class=\"horizontally fitted item\">
\t                            <button class=\"ui mini primary button\" data-action=\"message\">";
                    // line 118
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Message")), "html", null, true);
                    echo "</button>
\t                        </div>
\t                    ";
                }
                // line 121
                echo "\t                    ";
                if ((($context["followersActive"] ?? null) && call_user_func_array($this->env->getFunction('currentUserCan')->getCallable(), array("follow")))) {
                    // line 122
                    echo "\t                        ";
                    if ( !$this->env->getExtension('Membership_Users_Twig')->isCurrentUserFollow(($context["requestedUser"] ?? null))) {
                        // line 123
                        echo "\t                            <div class=\"horizontally fitted item\">
\t                                <button class=\"ui mini primary button\" data-action=\"follow\">";
                        // line 124
                        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Follow")), "html", null, true);
                        echo "</button>
\t                            </div>
\t                        ";
                    } else {
                        // line 127
                        echo "\t                            <div class=\"horizontally fitted item\">
\t                                <button class=\"ui mini primary button\" data-action=\"unfollow\">";
                        // line 128
                        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Unfollow")), "html", null, true);
                        echo "</button>
\t                            </div>
\t                        ";
                    }
                    // line 131
                    echo "\t                    ";
                }
                // line 132
                echo "\t                    <div class=\"horizontally fitted item\">
\t                        <button class=\"ui mini primary button\" data-action=\"report\">";
                // line 133
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Report")), "html", null, true);
                echo "</button>
\t                    </div>
\t                    <div class=\"ui dropdown item\">
\t                        <i class=\"ellipsis vertical icon\"></i>
\t                        <div class=\"menu\"></div>
\t                    </div>
\t                ";
            } else {
                // line 140
                echo "\t                    <a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->profileUrl(($context["requestedUser"] ?? null), array("action" => "settings")), "html", null, true);
                echo "\" class=\"horizontally fitted item\">
\t                        <button class=\"ui primary button\">";
                // line 141
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Settings")), "html", null, true);
                echo "</button>
\t                    </a>
\t                    <a href=\"";
                // line 143
                echo ($context["logoutUrl"] ?? null);
                echo "\" class=\"horizontally fitted item\">
\t                        <button class=\"ui primary button\">";
                // line 144
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Logout")), "html", null, true);
                echo "</button>
\t                    </a>
\t                ";
            }
            // line 147
            echo "\t            </div>
\t        </div>
        ";
        } else {
            // line 150
            echo "\t        <div class=\"ui secondary mini menu right floated mp-user-action-menu\">
\t            <div class=\"right menu\" style=\"display: none\">
\t                <div class=\"horizontally fitted item\">
\t                    <button class=\"ui mini primary button\" data-action=\"login\">";
            // line 153
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Add Friend")), "html", null, true);
            echo "</button>
\t                </div>
\t                <div class=\"horizontally fitted item\">
\t                    <button class=\"ui mini primary button\" data-action=\"login\">";
            // line 156
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Follow")), "html", null, true);
            echo "</button>
\t                </div>
\t                <div class=\"horizontally fitted item\">
\t                    <button class=\"ui mini primary button\" data-action=\"login\">";
            // line 159
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Message")), "html", null, true);
            echo "</button>
\t                </div>
\t                <div class=\"horizontally fitted item\">
\t                    <button class=\"ui mini primary button\" data-action=\"login\">";
            // line 162
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Report")), "html", null, true);
            echo "</button>
\t                </div>
\t                <div class=\"ui dropdown item\">
\t                    <i class=\"ellipsis vertical icon\"></i>
\t                    <div class=\"menu\"></div>
\t                </div>
\t            </div>
\t        </div>
        ";
        }
        // line 171
        echo "    </div>
\t
    <div class=\"mp-profile-nav-menu\">
        <div class=\"ui secondary pointing menu profile-nav-menu\" style=\"display: none\">
\t        
            ";
        // line 176
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->env->getExtension('Membership_Users_Twig')->profileMenuItems());
        foreach ($context['_seq'] as $context["id"] => $context["title"]) {
            // line 177
            echo "                <a class=\"item";
            if ((($context["action"] ?? null) == $context["id"])) {
                echo " active";
            }
            echo "\"
                   href=\"";
            // line 178
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->profileUrl(($context["requestedUser"] ?? null), array("action" => $context["id"])), "html", null, true);
            echo "\"
                >";
            // line 179
            echo twig_escape_filter($this->env, $context["title"], "html", null, true);
            echo " ";
            if (twig_in_filter($context["id"], twig_get_array_keys_filter(($context["unreadNotifications"] ?? null)))) {
                echo "<div class=\"ui mini label red\">";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["unreadNotifications"] ?? null), $context["id"], array(), "array"), "html", null, true);
                echo "</div>";
            }
            echo "</a>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['id'], $context['title'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 181
        echo "
            ";
        // line 182
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "profileMenuItems"), "method"), "html", null, true);
        echo "
\t        
            <div class=\"ui dropdown item\" style=\"display:none;\">
                <i class=\"ellipsis horizontal icon\"></i>
                <div class=\"menu\"></div>
            </div>
        </div>
    </div>

    <div class=\"ui modal sc-membership\" id=\"avatar-modal\">
        <i class=\"close icon\"></i>
        <div class=\"header\">
            ";
        // line 194
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Profile picture")), "html", null, true);
        echo "
        </div>
        <div class=\"content\">
            <div class=\"ui basic segment blurring avatar-image-container\">
                <div class=\"ui inverted dimmer\">
                    <div class=\"ui loader\"></div>
                </div>
                <div class=\"mp-avatar-modal-image\">
                    <img class=\"avatar-modal-image\">
                </div>
            </div>
        </div>
        <div class=\"actions\">
            <button class=\"ui mini secondary button cancel\" data-action=\"cancel\">";
        // line 207
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Cancel")), "html", null, true);
        echo "</button>
            <button class=\"ui mini primary button primary\" data-action=\"save-photo\">";
        // line 208
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Save")), "html", null, true);
        echo "</button>
        </div>
    </div>
\t
\t";
        // line 212
        if ( !($context["userLoggedIn"] ?? null)) {
            // line 213
            echo "\t\t";
            $this->loadTemplate("@auth/partials/login-modal.twig", "@users/profile.twig", 213)->display($context);
            // line 214
            echo "\t";
        }
        // line 215
        echo "\t
    ";
        // line 216
        $this->displayBlock('content', $context, $blocks);
        // line 217
        echo "</div>

";
        // line 219
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "users.send.message.modal.wnd"), "method"), "html", null, true);
        echo "
";
        // line 220
        $this->loadTemplate("@users/partials/users-report-modal.twig", "@users/profile.twig", 220)->display($context);
    }

    // line 216
    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "@users/profile.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  511 => 216,  507 => 220,  503 => 219,  499 => 217,  497 => 216,  494 => 215,  491 => 214,  488 => 213,  486 => 212,  479 => 208,  475 => 207,  459 => 194,  444 => 182,  441 => 181,  427 => 179,  423 => 178,  416 => 177,  412 => 176,  405 => 171,  393 => 162,  387 => 159,  381 => 156,  375 => 153,  370 => 150,  365 => 147,  359 => 144,  355 => 143,  350 => 141,  345 => 140,  335 => 133,  332 => 132,  329 => 131,  323 => 128,  320 => 127,  314 => 124,  311 => 123,  308 => 122,  305 => 121,  299 => 118,  296 => 117,  293 => 116,  290 => 115,  284 => 112,  281 => 111,  278 => 110,  272 => 107,  266 => 104,  263 => 103,  260 => 102,  254 => 99,  251 => 98,  248 => 97,  242 => 94,  239 => 93,  236 => 92,  233 => 91,  231 => 90,  227 => 88,  225 => 87,  221 => 85,  215 => 82,  211 => 81,  206 => 80,  203 => 79,  197 => 76,  193 => 75,  188 => 74,  185 => 73,  179 => 70,  175 => 69,  170 => 68,  168 => 67,  162 => 66,  156 => 62,  149 => 58,  145 => 57,  135 => 50,  132 => 49,  130 => 48,  125 => 46,  121 => 45,  117 => 44,  111 => 43,  106 => 40,  100 => 38,  98 => 37,  93 => 36,  87 => 33,  83 => 32,  74 => 26,  70 => 25,  60 => 21,  58 => 20,  55 => 19,  49 => 16,  46 => 15,  44 => 14,  38 => 11,  33 => 9,  29 => 8,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@users/profile.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Users\\views\\profile.twig");
    }
}
