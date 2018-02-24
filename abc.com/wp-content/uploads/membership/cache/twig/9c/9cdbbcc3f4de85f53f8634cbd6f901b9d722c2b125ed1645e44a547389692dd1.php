<?php

/* @activity/partials/activities.twig */
class __TwigTemplate_db12d64fb7eb42d6530e2934cfdb2ed5d3a3d86874774baa01e92faf467e9b89 extends Twig_Template
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
        $context["this"] = $this;
        // line 2
        echo "
";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["activities"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["activity"]) {
            // line 4
            echo "\t";
            if ($this->getAttribute($context["activity"], "relatedActivity", array())) {
                // line 5
                echo "\t\t";
                echo $context["this"]->getactivity($this->getAttribute($context["activity"], "relatedActivity", array()), "relatedActivity", $context["activity"], ($context["context"] ?? null), ($context["params"] ?? null), ($context["settings"] ?? null));
                echo "
\t";
            } else {
                // line 7
                echo "\t\t";
                echo $context["this"]->getactivity($context["activity"], null, null, ($context["context"] ?? null), ($context["params"] ?? null), ($context["settings"] ?? null));
                echo "
\t";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['activity'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 10
        echo "
";
    }

    // line 11
    public function getactivity($__activity__ = null, $__activityType__ = null, $__relatedActivity__ = null, $__activityContext__ = null, $__params__ = null, $__settings__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "activity" => $__activity__,
            "activityType" => $__activityType__,
            "relatedActivity" => $__relatedActivity__,
            "activityContext" => $__activityContext__,
            "params" => $__params__,
            "settings" => $__settings__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 12
            echo "    ";
            $context["this"] = $this;
            // line 13
            echo "    <div class=\"ui segments mp-activity\" data-activity-id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["activity"] ?? null), "id", array()), "html", null, true);
            echo "\">
\t    ";
            // line 14
            if (($context["relatedActivity"] ?? null)) {
                // line 15
                echo "\t\t    <div class=\"ui basic segment\">
\t\t\t    ";
                // line 16
                if (($this->getAttribute(($context["relatedActivity"] ?? null), "type", array()) == "activity_comment")) {
                    // line 17
                    echo "\t\t\t\t    ";
                    echo sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("%s commented post from %s on %s.")), (((("<a href=\"" . $this->env->getExtension('Membership_Users_Twig')->profileUrl($this->getAttribute(                    // line 19
($context["relatedActivity"] ?? null), "author", array()))) . "\">") . $this->getAttribute($this->getAttribute(($context["relatedActivity"] ?? null), "author", array()), "displayName", array())) . "</a>"), (((("<b><a href=\"" . $this->env->getExtension('Membership_Users_Twig')->profileUrl($this->getAttribute($this->getAttribute(                    // line 20
($context["relatedActivity"] ?? null), "relatedActivity", array()), "author", array()))) . "\">") . $this->getAttribute($this->getAttribute($this->getAttribute(($context["relatedActivity"] ?? null), "relatedActivity", array()), "author", array()), "display_name", array())) . "</a></b>"), twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute(                    // line 21
($context["relatedActivity"] ?? null), "relatedActivity", array()), "created_at", array()), "Y-m-d"));
                    // line 24
                    echo "
\t\t\t    ";
                }
                // line 26
                echo "\t\t\t    ";
                if (($this->getAttribute(($context["relatedActivity"] ?? null), "type", array()) == "like")) {
                    // line 27
                    echo "\t\t\t        ";
                    echo sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("%s liked post from %s on %s.")), (((("<a href=\"" . $this->env->getExtension('Membership_Users_Twig')->profileUrl($this->getAttribute(                    // line 29
($context["relatedActivity"] ?? null), "author", array()))) . "\">") . $this->getAttribute($this->getAttribute(($context["relatedActivity"] ?? null), "author", array()), "displayName", array())) . "</a>"), (((("<b><a href=\"" . $this->env->getExtension('Membership_Users_Twig')->profileUrl($this->getAttribute($this->getAttribute(                    // line 30
($context["relatedActivity"] ?? null), "relatedActivity", array()), "author", array()))) . "\">") . $this->getAttribute($this->getAttribute($this->getAttribute(($context["relatedActivity"] ?? null), "relatedActivity", array()), "author", array()), "display_name", array())) . "</a></b>"), twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute(                    // line 31
($context["relatedActivity"] ?? null), "relatedActivity", array()), "created_at", array()), "Y-m-d"));
                    // line 34
                    echo "
\t\t\t    ";
                }
                // line 36
                echo "
\t\t\t\t";
                // line 37
                if (($this->getAttribute(($context["relatedActivity"] ?? null), "type", array()) == "favorite")) {
                    // line 38
                    echo "\t\t\t\t\t";
                    echo sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("%s add to favorite post from %s on %s.")), (((("<a href=\"" . $this->env->getExtension('Membership_Users_Twig')->profileUrl($this->getAttribute(                    // line 40
($context["relatedActivity"] ?? null), "author", array()))) . "\">") . $this->getAttribute($this->getAttribute(($context["relatedActivity"] ?? null), "author", array()), "displayName", array())) . "</a>"), (((("<b><a href=\"" . $this->env->getExtension('Membership_Users_Twig')->profileUrl($this->getAttribute($this->getAttribute(                    // line 41
($context["relatedActivity"] ?? null), "relatedActivity", array()), "author", array()))) . "\">") . $this->getAttribute($this->getAttribute($this->getAttribute(($context["relatedActivity"] ?? null), "relatedActivity", array()), "author", array()), "display_name", array())) . "</a></b>"), twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute(                    // line 42
($context["relatedActivity"] ?? null), "relatedActivity", array()), "created_at", array()), "Y-m-d"));
                    // line 44
                    echo "
\t\t\t\t";
                }
                // line 46
                echo "\t\t    </div>
\t    ";
            }
            // line 48
            echo "\t    
        <div class=\"ui segment\"";
            // line 49
            if ((($context["activityType"] ?? null) == "sharedActivity")) {
                echo " class=\"shared\"";
            }
            echo ">
            <div class=\"mp-activity-header\">
                <div class=\"mp-activity-header-image\">

\t                ";
            // line 53
            if (($this->getAttribute(($context["activity"] ?? null), "type", array()) != "group_post")) {
                // line 54
                echo "\t\t                <a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->profileUrl($this->getAttribute(($context["activity"] ?? null), "author", array())), "html", null, true);
                echo "\">
\t\t\t\t\t\t\t";
                // line 55
                if ( !$this->getAttribute(($context["activity"] ?? null), "friendPost", array())) {
                    // line 56
                    echo "\t\t\t\t\t\t\t\t<img src=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->userAvatar($this->getAttribute(($context["activity"] ?? null), "author", array()), "small"), "html", null, true);
                    echo "\" alt=\"\">
\t\t\t\t\t\t\t";
                } elseif ( !$this->getAttribute(                // line 57
($context["activity"] ?? null), "sharedActivity", array())) {
                    // line 58
                    echo "\t\t\t\t                <img src=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->userAvatar($this->getAttribute(($context["activity"] ?? null), "author", array()), "medium"), "html", null, true);
                    echo "\" alt=\"\">
\t\t\t                ";
                } else {
                    // line 60
                    echo "\t\t\t\t                <img src=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->userAvatar($this->getAttribute(($context["activity"] ?? null), "author", array()), "small"), "html", null, true);
                    echo "\" alt=\"\">
\t\t\t                ";
                }
                // line 62
                echo "\t\t                </a>
\t                ";
            } else {
                // line 64
                echo "\t\t                <a href=\"";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('groupUrl')->getCallable(), array($this->getAttribute(($context["activity"] ?? null), "group", array()))), "html", null, true);
                echo "\">
\t\t\t                ";
                // line 65
                if ( !$this->getAttribute(($context["activity"] ?? null), "sharedActivity", array())) {
                    // line 66
                    echo "\t\t\t\t                <img src=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Groups_Twig')->groupsLogo($this->getAttribute(($context["activity"] ?? null), "group", array()), "medium"), "html", null, true);
                    echo "\" alt=\"\">
\t\t\t                ";
                } else {
                    // line 68
                    echo "\t\t\t\t                <img src=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Groups_Twig')->groupsLogo($this->getAttribute(($context["activity"] ?? null), "group", array()), "small"), "html", null, true);
                    echo "\" alt=\"\">
\t\t\t                ";
                }
                // line 70
                echo "\t\t                </a>
\t                ";
            }
            // line 72
            echo "
                </div>
                <div class=\"mp-activity-header-title\">
                    ";
            // line 75
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "activity.view.activityTitle", 1 => array(0 => ($context["activity"] ?? null))), "method"), "html", null, true);
            echo "
\t
\t                ";
            // line 77
            if (($this->getAttribute(($context["activity"] ?? null), "type", array()) == "post")) {
                // line 78
                echo "\t\t                <a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->profileUrl($this->getAttribute(($context["activity"] ?? null), "author", array())), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "author", array()), "displayName", array()), "html", null, true);
                echo "</a>
\t                ";
            }
            // line 80
            echo "\t                
\t                ";
            // line 81
            if (($this->getAttribute(($context["activity"] ?? null), "type", array()) == "user_registered")) {
                // line 82
                echo "\t\t                ";
                echo sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("%s is registered")), (((("<a href=\"" . $this->env->getExtension('Membership_Users_Twig')->profileUrl($this->getAttribute(                // line 83
($context["activity"] ?? null), "author", array()))) . "\">") . $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "author", array()), "displayName", array())) . "</a>"));
                // line 85
                echo "
\t                ";
            }
            // line 87
            echo "\t                
\t                ";
            // line 88
            if (($this->getAttribute(($context["activity"] ?? null), "type", array()) == "related_post")) {
                // line 89
                echo "\t\t                <a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->profileUrl($this->getAttribute(($context["activity"] ?? null), "author", array())), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "author", array()), "displayName", array()), "html", null, true);
                echo "</a> >
\t\t                <a href=\"";
                // line 90
                echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->profileUrl($this->getAttribute(($context["activity"] ?? null), "target", array())), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "target", array()), "displayName", array()), "html", null, true);
                echo "</a>
\t                ";
            }
            // line 92
            echo "\t                
\t                ";
            // line 93
            if (($this->getAttribute(($context["activity"] ?? null), "type", array()) == "group_post")) {
                // line 94
                echo "\t\t                <a href=\"";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('groupUrl')->getCallable(), array($this->getAttribute(($context["activity"] ?? null), "group", array()))), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "group", array()), "name", array()), "html", null, true);
                echo "</a>
\t                ";
            }
            // line 96
            echo "\t
\t                ";
            // line 97
            if (($this->getAttribute(($context["activity"] ?? null), "type", array()) == "group_user_post")) {
                // line 98
                echo "\t\t                <a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->profileUrl($this->getAttribute(($context["activity"] ?? null), "author", array())), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "author", array()), "displayName", array()), "html", null, true);
                echo "</a> >
\t\t                <a href=\"";
                // line 99
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('groupUrl')->getCallable(), array($this->getAttribute(($context["activity"] ?? null), "group", array()))), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "group", array()), "name", array()), "html", null, true);
                echo "</a>
\t                ";
            }
            // line 101
            echo "\t
\t                ";
            // line 102
            if (($this->getAttribute(($context["activity"] ?? null), "type", array()) == "group_created")) {
                // line 103
                echo "\t\t                ";
                echo sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("New group %s is created by %s.")), (((("<a href=\"" . call_user_func_array($this->env->getFunction('groupUrl')->getCallable(), array($this->getAttribute(                // line 105
($context["activity"] ?? null), "group", array())))) . "\">") . $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "group", array()), "name", array())) . "</a>"), (((("<a href=\"" . $this->env->getExtension('Membership_Users_Twig')->profileUrl($this->getAttribute(                // line 106
($context["activity"] ?? null), "author", array()))) . "\">") . $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "author", array()), "displayName", array())) . "</a>"));
                // line 109
                echo "
\t                ";
            }
            // line 111
            echo "


\t                ";
            // line 114
            if ($this->getAttribute(($context["activity"] ?? null), "sharedActivity", array())) {
                // line 115
                echo "\t\t                ";
                if (twig_in_filter($this->getAttribute(($context["activity"] ?? null), "type", array()), array(0 => "shared_group_post", 1 => "shared_group_user_post"))) {
                    // line 116
                    echo "\t\t\t                ";
                    echo sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("%s shared %s post.")), (((("<a href=\"" . $this->env->getExtension('Membership_Users_Twig')->profileUrl($this->getAttribute(                    // line 118
($context["activity"] ?? null), "author", array()))) . "\">") . $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "author", array()), "displayName", array())) . "</a>"), (((("<a href=\"" . call_user_func_array($this->env->getFunction('groupUrl')->getCallable(), array($this->getAttribute($this->getAttribute(                    // line 119
($context["activity"] ?? null), "sharedActivity", array()), "group", array())))) . "\">") . $this->getAttribute($this->getAttribute($this->getAttribute(($context["activity"] ?? null), "sharedActivity", array()), "group", array()), "name", array())) . "</a>"));
                    // line 122
                    echo "
\t\t                ";
                } else {
                    // line 124
                    echo "\t\t\t                ";
                    echo sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("%s shared %s post.")), (((("<a href=\"" . $this->env->getExtension('Membership_Users_Twig')->profileUrl($this->getAttribute(                    // line 126
($context["activity"] ?? null), "author", array()))) . "\">") . $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "author", array()), "displayName", array())) . "</a>"), (((("<a href=\"" . $this->env->getExtension('Membership_Users_Twig')->profileUrl($this->getAttribute($this->getAttribute(                    // line 127
($context["activity"] ?? null), "sharedActivity", array()), "author", array()))) . "\">") . $this->getAttribute($this->getAttribute($this->getAttribute(($context["activity"] ?? null), "sharedActivity", array()), "author", array()), "displayName", array())) . "</a>"));
                    // line 130
                    echo "
\t\t                ";
                }
                // line 132
                echo "\t                ";
            }
            // line 133
            echo "
\t\t\t\t\t";
            // line 134
            if ($this->getAttribute(($context["activity"] ?? null), "friendPost", array())) {
                // line 135
                echo "\t\t\t\t\t\t";
                if (($this->getAttribute(($context["activity"] ?? null), "type", array()) == "friend_post")) {
                    // line 136
                    echo "\t\t\t\t\t\t\t";
                    echo sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Posted from %s activity.")), (((("<a href=\"" . $this->env->getExtension('Membership_Users_Twig')->profileUrl($this->getAttribute($this->getAttribute(                    // line 138
($context["activity"] ?? null), "friendPost", array()), "author", array()))) . "\">") . $this->getAttribute($this->getAttribute($this->getAttribute(($context["activity"] ?? null), "friendPost", array()), "author", array()), "displayName", array())) . "</a>"));
                    // line 140
                    echo "
\t\t\t\t\t\t";
                }
                // line 142
                echo "\t\t\t\t\t";
            }
            // line 143
            echo "
                    <div class=\"date\">";
            // line 144
            echo twig_escape_filter($this->env, $this->getAttribute(($context["activity"] ?? null), "updated_at", array()), "html", null, true);
            echo "</div>
                </div>
            </div>

\t\t\t";
            // line 148
            if ((($this->getAttribute($this->getAttribute(($context["relatedActivity"] ?? null), "relatedActivity", array()), "status", array()) == "deleted") || ($this->getAttribute(($context["activity"] ?? null), "status", array()) == "deleted"))) {
                // line 149
                echo "\t\t\t\t";
                $context["postDeleted"] = 1;
                // line 150
                echo "\t\t\t";
            }
            // line 151
            echo "            <div class=\"mp-activity-content ";
            echo (((($context["postDeleted"] ?? null) == 1)) ? ("mp-activity-removed") : (""));
            echo "\" data-activity-data=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["activity"] ?? null), "data", array()));
            echo "\">
\t\t\t\t";
            // line 152
            if (($context["postDeleted"] ?? null)) {
                // line 153
                echo "\t\t\t\t\t";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Sorry, the original post was deleted by its author.")), "html", null, true);
                echo "
\t\t\t\t";
            } else {
                // line 155
                echo "\t\t\t\t\t";
                if (twig_length_filter($this->env, $this->getAttribute(($context["activity"] ?? null), "data", array()))) {
                    // line 156
                    echo "\t\t\t\t\t\t<div class=\"mp-activity-content-text\">";
                    echo $this->env->getExtension('Membership_Activity_Twig')->activityContent(($context["activity"] ?? null));
                    echo "</div>
\t\t\t\t\t";
                }
                // line 158
                echo "
\t\t\t\t\t";
                // line 159
                if ($this->getAttribute(($context["activity"] ?? null), "link", array())) {
                    // line 160
                    echo "\t\t\t\t\t\t";
                    $this->loadTemplate("@activity/partials/activity-attachment-link.twig", "@activity/partials/activities.twig", 160)->display(array_merge($context, array("link" => $this->getAttribute(($context["activity"] ?? null), "link", array()))));
                    // line 161
                    echo "\t\t\t\t\t";
                }
                // line 162
                echo "
\t\t\t\t\t";
                // line 163
                if ($this->getAttribute(($context["activity"] ?? null), "images", array())) {
                    // line 164
                    echo "\t\t\t\t\t\t<div class=\"mp-activity-gallery\" data-gallery-id=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["activity"] ?? null), "id", array()), "html", null, true);
                    echo "\" style=\"display: none\">
\t\t\t\t\t\t\t";
                    // line 165
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_slice($this->env, $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "images", array()), "thumbnails", array()), 0, 3, true));
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
                    foreach ($context['_seq'] as $context["id"] => $context["thumbnails"]) {
                        // line 166
                        echo "\t\t\t\t\t\t\t\t<div class=\"mp-activity-gallery-image\" data-image-id=\"";
                        echo twig_escape_filter($this->env, $context["id"], "html", null, true);
                        echo "\">
\t\t\t\t\t\t\t\t\t<img src=\"";
                        // line 167
                        echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Activity_Twig')->activityImage($context["thumbnails"], "large"), "html", null, true);
                        echo "\">
\t\t\t\t\t\t\t\t\t";
                        // line 168
                        if ((($this->getAttribute($context["loop"], "index0", array()) == 2) && ($this->getAttribute($this->getAttribute(($context["activity"] ?? null), "images", array()), "total", array()) > 3))) {
                            // line 169
                            echo "\t\t\t\t\t\t\t\t\t\t<div class=\"mp-activity-gallery-image-overlay\">
\t\t\t\t\t\t\t\t\t\t\t<div>+";
                            // line 170
                            echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute(($context["activity"] ?? null), "images", array()), "total", array()) - 3), "html", null, true);
                            echo "</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t";
                        }
                        // line 173
                        echo "\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
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
                    unset($context['_seq'], $context['_iterated'], $context['id'], $context['thumbnails'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 175
                    echo "\t\t\t\t\t\t</div>
\t\t\t\t\t";
                }
                // line 177
                echo "\t\t\t\t\t";
                if ($this->getAttribute(($context["activity"] ?? null), "attachmentFiles", array())) {
                    // line 178
                    echo "\t\t\t\t\t\t<div class=\"mbsActivAttachFilesWr\" data-activity-id=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["activity"] ?? null), "id", array()), "html", null, true);
                    echo "\">
\t\t\t\t\t\t\t";
                    // line 179
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["activity"] ?? null), "attachmentFiles", array()));
                    foreach ($context['_seq'] as $context["oneAttachId"] => $context["oneAttach"]) {
                        // line 180
                        echo "\t\t\t\t\t\t\t\t<a class=\"mbsOneAttachItem\" title=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["oneAttach"], "file_info", array(), "array"), "name", array(), "array"), "html", null, true);
                        echo "\" href=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["oneAttach"], "file_info", array(), "array"), "url", array(), "array"), "html", null, true);
                        echo "\" target=\"_blank\" data-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["oneAttach"], "attachment_all_id", array(), "array"), "html", null, true);
                        echo "\">
\t\t\t\t\t\t\t\t\t<i class=\"icon attach mbsOneAttachIcon\"></i>
\t\t\t\t\t\t\t\t\t<span class=\"mbsOneAttachCaption\">";
                        // line 182
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["oneAttach"], "file_info", array(), "array"), "name", array(), "array"), "html", null, true);
                        echo "</span>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['oneAttachId'], $context['oneAttach'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 185
                    echo "\t\t\t\t\t\t</div>
\t\t\t\t\t";
                }
                // line 187
                echo "
\t\t\t\t\t";
                // line 188
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "activity.view.activityContent", 1 => array(0 => ($context["activity"] ?? null))), "method"), "html", null, true);
                echo "

\t\t\t\t\t";
                // line 190
                if ((is_string($__internal_a10cae7356fbe30d16d3e65b0f8ccac50968914cd5cf11e1754392cab2255ae5 = $this->getAttribute(($context["activity"] ?? null), "type", array())) && is_string($__internal_c03e9d2b81518d095e4052473cb3882db7789f80ff3991ed9be8f1ce722f8ef2 = "shared_") && ('' === $__internal_c03e9d2b81518d095e4052473cb3882db7789f80ff3991ed9be8f1ce722f8ef2 || 0 === strpos($__internal_a10cae7356fbe30d16d3e65b0f8ccac50968914cd5cf11e1754392cab2255ae5, $__internal_c03e9d2b81518d095e4052473cb3882db7789f80ff3991ed9be8f1ce722f8ef2)))) {
                    // line 191
                    echo "\t\t\t\t\t\t<div class=\"mp-shared-activity\">
\t\t\t\t\t\t\t";
                    // line 192
                    echo $context["this"]->getactivity($this->getAttribute(($context["activity"] ?? null), "sharedActivity", array()), "sharedActivity");
                    echo "
\t\t\t\t\t\t</div>
\t\t\t\t\t";
                }
                // line 195
                echo "
\t\t\t\t\t";
                // line 196
                if (($this->getAttribute(($context["activity"] ?? null), "type", array()) == "friend_post")) {
                    // line 197
                    echo "\t\t\t\t\t\t<div class=\"mp-shared-activity\">
\t\t\t\t\t\t\t";
                    // line 198
                    echo $context["this"]->getactivity($this->getAttribute(($context["activity"] ?? null), "friendPost", array()), "friendPost");
                    echo "
\t\t\t\t\t\t</div>
\t\t\t\t\t";
                }
                // line 201
                echo "\t\t\t\t";
            }
            // line 202
            echo "            </div>
        </div>

\t\t";
            // line 205
            if (($this->getAttribute($this->getAttribute(($context["relatedActivity"] ?? null), "relatedActivity", array()), "status", array()) != "deleted")) {
                // line 206
                echo "
\t\t\t";
                // line 207
                if (((((($context["activityType"] ?? null) != "sharedActivity") && (($context["activityType"] ?? null) != "friendPost")) && ($context["userLoggedIn"] ?? null)) && ($this->getAttribute(($context["params"] ?? null), "isReadPostPage", array()) != true))) {
                    // line 208
                    echo "\t\t\t\t";
                    ob_start();
                    // line 209
                    if (twig_in_filter($this->getAttribute(($context["activity"] ?? null), "type", array()), array(0 => "post", 1 => "group_post", 2 => "shared_post", 3 => "shared_group_post"))) {
                        // line 210
                        echo "<a href=\"";
                        echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Activity_Twig')->getActivityUrl($this->getAttribute(($context["activity"] ?? null), "id", array())), "html", null, true);
                        echo "\" class=\"item menu-link-action\">";
                        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Read this post")), "html", null, true);
                        echo "</a>";
                    }
                    // line 212
                    if (twig_in_filter($this->getAttribute(($context["activity"] ?? null), "type", array()), array(0 => "group_post", 1 => "group_user_post", 2 => "group_created"))) {
                        // line 213
                        if (!twig_in_filter($this->getAttribute(($context["activity"] ?? null), "type", array()), array(0 => "group_created"))) {
                            // line 214
                            if (($this->env->getExtension('Membership_Users_Twig')->isCurrentUser($this->getAttribute(($context["activity"] ?? null), "author", array())) || call_user_func_array($this->env->getFunction('currentUserCan')->getCallable(), array("edit-activity")))) {
                                // line 215
                                echo "<div class=\"item edit-action\">";
                                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Edit")), "html", null, true);
                                echo "</div>";
                            }
                            // line 217
                            if (($this->env->getExtension('Membership_Groups_Twig')->canEditGroup($this->getAttribute(($context["activity"] ?? null), "group", array())) || call_user_func_array($this->env->getFunction('currentUserCan')->getCallable(), array("edit-activity")))) {
                                // line 218
                                echo "<div class=\"item group-delete-action\">";
                                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Delete")), "html", null, true);
                                echo "</div>";
                            }
                        }
                    } else {
                        // line 222
                        if (($this->env->getExtension('Membership_Users_Twig')->isCurrentUser($this->getAttribute(($context["activity"] ?? null), "author", array())) || call_user_func_array($this->env->getFunction('currentUserCan')->getCallable(), array("edit-activity")))) {
                            // line 223
                            if (!twig_in_filter($this->getAttribute(($context["activity"] ?? null), "type", array()), array(0 => "user_registered", 1 => "follow", 2 => "friendship"))) {
                                // line 224
                                echo "<div class=\"item edit-action\">";
                                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Edit")), "html", null, true);
                                echo "</div>
\t\t\t\t\t\t\t\t<div class=\"item delete-action\">";
                                // line 225
                                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Delete")), "html", null, true);
                                echo "</div>";
                            }
                        }
                    }
                    // line 229
                    if ( !$this->env->getExtension('Membership_Users_Twig')->isCurrentUser($this->getAttribute(($context["activity"] ?? null), "author", array()))) {
                        // line 230
                        echo "<div class=\"item report-action\">";
                        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Report")), "html", null, true);
                        echo "</div>";
                    }
                    $context["menuHtml"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
                    // line 235
                    echo "\t\t\t\t";
                    if (twig_length_filter($this->env, ($context["menuHtml"] ?? null))) {
                        // line 236
                        echo "\t\t\t\t\t<div class=\"mp-activity-menu ui top right pointing dropdown item\">
\t\t\t\t\t\t<i class=\"ellipsis horizontal icon\"></i>
\t\t\t\t\t\t<div class=\"menu\">
\t\t\t\t\t\t\t";
                        // line 239
                        echo ($context["menuHtml"] ?? null);
                        echo "
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t";
                    }
                    // line 243
                    echo "\t\t\t";
                }
                // line 244
                echo "
\t\t\t";
                // line 245
                if ((( !($context["userLoggedIn"] ?? null) && (($context["activityType"] ?? null) != "sharedActivity")) && (($context["activityType"] ?? null) != "friendPost"))) {
                    // line 246
                    echo "\t\t\t\t<div class=\"ui segment\">
\t\t\t\t\t";
                    // line 247
                    echo sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Please <a href=\"%s\">sign up</a> or <a href=\"%s\">sign in</a> to like or write comments on this post.")), call_user_func_array($this->env->getFunction('getRouteUrl')->getCallable(), array("registration")), call_user_func_array($this->env->getFunction('getRouteUrl')->getCallable(), array("login")));
                    // line 249
                    echo "
\t\t\t\t</div>
\t\t\t";
                }
                // line 252
                echo "
\t\t\t";
                // line 253
                if ((((($context["activityType"] ?? null) != "sharedActivity") && (($context["activityType"] ?? null) != "friendPost")) && ($this->getAttribute(($context["relatedActivity"] ?? null), "type", array()) != "favorite"))) {
                    // line 254
                    echo "\t\t\t\t<div class=\"ui segment mp-activity-actions\">

\t\t\t\t\t<a class=\"like-action ";
                    // line 256
                    if ($this->getAttribute($this->getAttribute(($context["activity"] ?? null), "likes", array()), "likedByCurrentUser", array())) {
                        echo "mp-liked-activity";
                    }
                    echo "\">
\t\t\t\t\t\t<i class=\"like icon\"></i> ";
                    // line 257
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Like")), "html", null, true);
                    echo " <span>";
                    if ($this->getAttribute(($context["activity"] ?? null), "likes", array())) {
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "likes", array()), "count", array()), "html", null, true);
                    }
                    echo "</span>
\t\t\t\t\t</a>

                    ";
                    // line 260
                    if (call_user_func_array($this->env->getFunction('isPostComment')->getCallable(), array($this->getAttribute(($context["activity"] ?? null), "group", array())))) {
                        // line 261
                        echo "                        ";
                        if (((is_string($__internal_17cabc45efc237ba967db84030c9d3ea26f2ccbc3105a01a852ad24db18b8fa1 = $this->getAttribute(($context["activity"] ?? null), "type", array())) && is_string($__internal_0ca8740a25d37918dc025d3561cd9896be95b84f25cf646372b9747e4adbc9ce = "group") && ('' === $__internal_0ca8740a25d37918dc025d3561cd9896be95b84f25cf646372b9747e4adbc9ce || 0 === strpos($__internal_17cabc45efc237ba967db84030c9d3ea26f2ccbc3105a01a852ad24db18b8fa1, $__internal_0ca8740a25d37918dc025d3561cd9896be95b84f25cf646372b9747e4adbc9ce))) || call_user_func_array($this->env->getFunction('currentUserHasPermission')->getCallable(), array("view-comments", $this->getAttribute(($context["activity"] ?? null), "author", array()))))) {
                            // line 262
                            echo "                            <a class=\"comment-action\"><i class=\"comment icon\"></i> ";
                            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Comments")), "html", null, true);
                            echo " <span>";
                            if ($this->getAttribute(($context["activity"] ?? null), "comments", array())) {
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "comments", array()), "count", array()), "html", null, true);
                            }
                            echo "</span></a>
                        ";
                        }
                        // line 264
                        echo "                    ";
                    }
                    // line 265
                    echo "
\t\t\t\t\t<a class=\"share-action ";
                    // line 266
                    if ($this->getAttribute($this->getAttribute(($context["activity"] ?? null), "shares", array()), "sharedByCurrentUser", array())) {
                        echo "mp-shared-activity";
                    }
                    echo "\">
\t\t\t\t\t\t<i class=\"share icon\"></i> ";
                    // line 267
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Share")), "html", null, true);
                    echo " <span>";
                    if ($this->getAttribute(($context["activity"] ?? null), "shares", array())) {
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "shares", array()), "count", array()), "html", null, true);
                    }
                    echo "</span>
\t\t\t\t\t</a>

\t\t\t\t\t";
                    // line 270
                    if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "activity", array()), "type", array()), "favorite", array()) == "true")) {
                        // line 271
                        echo "\t\t\t\t\t\t<a class=\"favorite-action
\t\t\t\t\t\t\t\t";
                        // line 272
                        if (($this->getAttribute($this->getAttribute(($context["activity"] ?? null), "favorite", array()), "currentUserInFavorite", array()) != 0)) {
                            echo "mp-favorited-activity";
                        }
                        // line 273
                        echo "\t\t\t\t\t\t\t\t";
                        if ($this->env->getExtension('Membership_Users_Twig')->isCurrentUser($this->getAttribute(($context["activity"] ?? null), "author", array()))) {
                            echo "mbsCurrentUserActivity";
                        }
                        // line 274
                        echo "\t\t\t\t\t\t\t\">
\t\t\t\t\t\t\t<i class=\"star icon\"></i>
\t\t\t\t\t\t\t";
                        // line 276
                        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Favorite")), "html", null, true);
                        echo "
\t\t\t\t\t\t\t<span>";
                        // line 277
                        if ($this->getAttribute(($context["activity"] ?? null), "favorite", array())) {
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "favorite", array()), "count", array()), "html", null, true);
                        }
                        echo "</span>
\t\t\t\t\t\t</a>
\t\t\t\t\t";
                    }
                    // line 280
                    echo "
\t\t\t\t\t<div>
\t\t\t\t\t\t<div class=\"ui flowing popup small inverted mp-like-popup\">
\t\t\t\t\t\t\t<div class=\"popup-count\">
\t\t\t\t\t\t\t\t<small>
\t\t\t\t\t\t\t\t\t";
                    // line 285
                    echo sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("%s people liked this")), (("<span>" . $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "likes", array()), "count", array())) . "</span>"));
                    echo "
\t\t\t\t\t\t\t\t</small>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"ui basic vertical segment popup-loader\">
\t\t\t\t\t\t\t\t<div class=\"ui active centered inline mini loader\"></div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"ui mini horizontal divided list popup-users\" style=\"display: none\"></div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"sc-membership ui small modal long mp-like-modal\">
\t\t\t\t\t\t\t<i class=\"close icon\"></i>
\t\t\t\t\t\t\t<div class=\"header\">
\t\t\t\t\t\t\t   ";
                    // line 297
                    echo sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("%s people liked this")), (("<span>" . $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "likes", array()), "count", array())) . "</span>"));
                    echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"content\">
\t\t\t\t\t\t\t\t<div class=\"ui grid centered modal-users\"></div>
\t\t\t\t\t\t\t\t<div class=\"ui basic vertical segment modal-loader\">
\t\t\t\t\t\t\t\t\t<div class=\"ui active centered inline loader\"></div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"ui flowing popup small inverted mp-share-popup\">
\t\t\t\t\t\t\t<div class=\"popup-count\">
\t\t\t\t\t\t\t\t<small>
\t\t\t\t\t\t\t\t\t";
                    // line 310
                    echo sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("%s people shared this")), (("<span>" . $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "shares", array()), "count", array())) . "</span>"));
                    echo "
\t\t\t\t\t\t\t\t</small>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"ui basic vertical segment popup-loader\">
\t\t\t\t\t\t\t\t<div class=\"ui active centered inline mini loader\"></div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"ui mini horizontal divided list popup-users\" style=\"display: none\"></div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"sc-membership ui small modal long mp-share-modal\">
\t\t\t\t\t\t\t<i class=\"close icon\"></i>
\t\t\t\t\t\t\t<div class=\"header\">
\t\t\t\t\t\t\t\t";
                    // line 322
                    echo sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("%s people shared this")), (("<span>" . $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "shares", array()), "count", array())) . "</span>"));
                    echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"content\">
\t\t\t\t\t\t\t\t<div class=\"ui grid centered modal-users\"></div>
\t\t\t\t\t\t\t\t<div class=\"ui basic vertical segment modal-loader\">
\t\t\t\t\t\t\t\t\t<div class=\"ui active centered inline loader\"></div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t";
                    // line 332
                    if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "activity", array()), "type", array()), "favorite", array()) == "true")) {
                        // line 333
                        echo "\t\t\t\t\t\t\t<div class=\"ui flowing popup small inverted mp-favorite-popup\">
\t\t\t\t\t\t\t\t<div class=\"popup-count\">
\t\t\t\t\t\t\t\t\t<small>
\t\t\t\t\t\t\t\t\t\t";
                        // line 336
                        echo sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("%s people added this to favorite")), (("<span>" . $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "favorite", array()), "count", array())) . "</span>"));
                        echo "
\t\t\t\t\t\t\t\t\t</small>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"ui basic vertical segment popup-loader\">
\t\t\t\t\t\t\t\t\t<div class=\"ui active centered inline mini loader\"></div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"ui mini horizontal divided list popup-users\" style=\"display: none\"></div>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t<div class=\"sc-membership ui small modal long mp-favorite-modal\">
\t\t\t\t\t\t\t\t<i class=\"close icon\"></i>
\t\t\t\t\t\t\t\t<div class=\"header\">
\t\t\t\t\t\t\t\t\t";
                        // line 348
                        echo sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("%s people added this to favorite")), (("<span>" . $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "favorite", array()), "count", array())) . "</span>"));
                        echo "
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"content\">
\t\t\t\t\t\t\t\t\t<div class=\"ui grid centered modal-users\"></div>
\t\t\t\t\t\t\t\t\t<div class=\"ui basic vertical segment modal-loader\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ui active centered inline loader\"></div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t";
                    }
                    // line 358
                    echo "\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t";
                }
                // line 361
                echo "\t\t\t";
                if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "base", array()), "plugins", array()), "socialShare", array()), "enabled", array()) == 1) && twig_length_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "base", array()), "plugins", array()), "socialShare", array()), "ids", array())))) {
                    // line 362
                    echo "\t\t\t\t<div class=\"ui segment mbsSocShareContainer\">
\t\t\t\t\t";
                    // line 363
                    echo $this->env->getExtension('Membership_Activity_Twig')->getSocShareProject(array("projectId" => $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(                    // line 364
($context["settings"] ?? null), "base", array()), "plugins", array()), "socialShare", array()), "ids", array()), 0, array(), "array"), "url" => $this->env->getExtension('Membership_Activity_Twig')->getActivityUrl($this->getAttribute(                    // line 365
($context["activity"] ?? null), "id", array())), "type" => "pa", "id" => $this->getAttribute(                    // line 367
($context["activity"] ?? null), "id", array())));
                    // line 368
                    echo "
\t\t\t\t</div>
\t\t\t";
                }
                // line 371
                echo "\t\t";
            }
            // line 372
            echo "
\t\t";
            // line 373
            if ((((($context["activityType"] ?? null) != "sharedActivity") && (($context["activityType"] ?? null) != "friendPost")) && ($context["userLoggedIn"] ?? null))) {
                // line 374
                echo "\t\t\t";
                if (((is_string($__internal_2f2b4533dda1a1a461c09cc10c6f1af99891c572119d9d627bb8246893787082 = $this->getAttribute(($context["activity"] ?? null), "type", array())) && is_string($__internal_6f3fcd1a845ea5cc95f5d884c436e3fd21044872467f9ba395a6237505992023 = "group") && ('' === $__internal_6f3fcd1a845ea5cc95f5d884c436e3fd21044872467f9ba395a6237505992023 || 0 === strpos($__internal_2f2b4533dda1a1a461c09cc10c6f1af99891c572119d9d627bb8246893787082, $__internal_6f3fcd1a845ea5cc95f5d884c436e3fd21044872467f9ba395a6237505992023))) || call_user_func_array($this->env->getFunction('currentUserHasPermission')->getCallable(), array("view-comments", $this->getAttribute(($context["activity"] ?? null), "author", array()))))) {
                    // line 375
                    echo "\t\t\t\t<div class=\"ui secondary segment mp-activity-comments\" ";
                    if ( !$this->getAttribute(($context["activity"] ?? null), "comments", array())) {
                        echo "style=\"display: none\"";
                    }
                    echo ">
\t\t\t\t\t<div class=\"ui equal width grid mp-previous-comments\" ";
                    // line 376
                    if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "comments", array()), "comments", array())) == $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "comments", array()), "count", array()))) {
                        echo "style=\"display: none\"";
                    }
                    echo ">
\t\t\t\t\t\t<div class=\"left floated column\">
\t\t\t\t\t\t\t<div class=\"mp-more-comments\">";
                    // line 378
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("View previous comments")), "html", null, true);
                    echo " <div class=\"ui active mini inline loader\" style=\"display: none\"></div></div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"right floated right aligned column mp-comments-count\">
\t\t\t\t\t\t\t<div class=\"ui floated right\">
\t\t\t\t\t\t\t\t<span class=\"showed-comments\">";
                    // line 382
                    echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "comments", array()), "comments", array())), "html", null, true);
                    echo "</span> ";
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("of")), "html", null, true);
                    echo " <span class=\"total-comments\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "comments", array()), "count", array()), "html", null, true);
                    echo "</span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t\t<div class=\"ui threaded comments\" ";
                    // line 387
                    if ( !$this->getAttribute(($context["activity"] ?? null), "comments", array())) {
                        echo "style=\"display: none\"";
                    }
                    echo ">
\t\t\t\t\t\t";
                    // line 388
                    $this->loadTemplate("@activity/partials/activity-comments.twig", "@activity/partials/activities.twig", 388)->display(array_merge($context, array("comments" => $this->getAttribute($this->getAttribute(($context["activity"] ?? null), "comments", array()), "comments", array()), "relatedActivity" => $this->getAttribute(($context["relatedActivity"] ?? null), "relatedActivity", array()))));
                    // line 389
                    echo "\t\t\t\t\t</div>

\t\t\t\t\t";
                    // line 391
                    if (($this->getAttribute($this->getAttribute(($context["relatedActivity"] ?? null), "relatedActivity", array()), "status", array()) != "deleted")) {
                        // line 392
                        echo "\t\t\t\t\t\t";
                        if (((is_string($__internal_1cb2275e65dc55a2dd9dc90117e3c6da84eb8fe7df185307cf1bff11b502513d = $this->getAttribute(($context["activity"] ?? null), "type", array())) && is_string($__internal_892c7e271f34e0da77af5b5794f7a1af077709daec880af4b7acbe1acfba1a0c = "group") && ('' === $__internal_892c7e271f34e0da77af5b5794f7a1af077709daec880af4b7acbe1acfba1a0c || 0 === strpos($__internal_1cb2275e65dc55a2dd9dc90117e3c6da84eb8fe7df185307cf1bff11b502513d, $__internal_892c7e271f34e0da77af5b5794f7a1af077709daec880af4b7acbe1acfba1a0c))) || call_user_func_array($this->env->getFunction('currentUserHasPermission')->getCallable(), array("post-comments", $this->getAttribute(($context["activity"] ?? null), "author", array()))))) {
                            // line 393
                            echo "\t\t\t\t\t\t\t";
                            $this->loadTemplate("@activity/partials/activity-comment-form.twig", "@activity/partials/activities.twig", 393)->display(array_merge($context, array("context" => ($context["activityContext"] ?? null))));
                            // line 394
                            echo "\t\t\t\t\t\t";
                        }
                        // line 395
                        echo "\t\t\t\t\t";
                    }
                    // line 396
                    echo "\t\t\t\t</div>
\t\t\t";
                }
                // line 398
                echo "\t\t";
            }
            // line 399
            echo "    </div>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "@activity/partials/activities.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  922 => 399,  919 => 398,  915 => 396,  912 => 395,  909 => 394,  906 => 393,  903 => 392,  901 => 391,  897 => 389,  895 => 388,  889 => 387,  877 => 382,  870 => 378,  863 => 376,  856 => 375,  853 => 374,  851 => 373,  848 => 372,  845 => 371,  840 => 368,  838 => 367,  837 => 365,  836 => 364,  835 => 363,  832 => 362,  829 => 361,  824 => 358,  811 => 348,  796 => 336,  791 => 333,  789 => 332,  776 => 322,  761 => 310,  745 => 297,  730 => 285,  723 => 280,  715 => 277,  711 => 276,  707 => 274,  702 => 273,  698 => 272,  695 => 271,  693 => 270,  683 => 267,  677 => 266,  674 => 265,  671 => 264,  661 => 262,  658 => 261,  656 => 260,  646 => 257,  640 => 256,  636 => 254,  634 => 253,  631 => 252,  626 => 249,  624 => 247,  621 => 246,  619 => 245,  616 => 244,  613 => 243,  606 => 239,  601 => 236,  598 => 235,  592 => 230,  590 => 229,  584 => 225,  579 => 224,  577 => 223,  575 => 222,  568 => 218,  566 => 217,  561 => 215,  559 => 214,  557 => 213,  555 => 212,  548 => 210,  546 => 209,  543 => 208,  541 => 207,  538 => 206,  536 => 205,  531 => 202,  528 => 201,  522 => 198,  519 => 197,  517 => 196,  514 => 195,  508 => 192,  505 => 191,  503 => 190,  498 => 188,  495 => 187,  491 => 185,  482 => 182,  472 => 180,  468 => 179,  463 => 178,  460 => 177,  456 => 175,  441 => 173,  435 => 170,  432 => 169,  430 => 168,  426 => 167,  421 => 166,  404 => 165,  399 => 164,  397 => 163,  394 => 162,  391 => 161,  388 => 160,  386 => 159,  383 => 158,  377 => 156,  374 => 155,  368 => 153,  366 => 152,  359 => 151,  356 => 150,  353 => 149,  351 => 148,  344 => 144,  341 => 143,  338 => 142,  334 => 140,  332 => 138,  330 => 136,  327 => 135,  325 => 134,  322 => 133,  319 => 132,  315 => 130,  313 => 127,  312 => 126,  310 => 124,  306 => 122,  304 => 119,  303 => 118,  301 => 116,  298 => 115,  296 => 114,  291 => 111,  287 => 109,  285 => 106,  284 => 105,  282 => 103,  280 => 102,  277 => 101,  270 => 99,  263 => 98,  261 => 97,  258 => 96,  250 => 94,  248 => 93,  245 => 92,  238 => 90,  231 => 89,  229 => 88,  226 => 87,  222 => 85,  220 => 83,  218 => 82,  216 => 81,  213 => 80,  205 => 78,  203 => 77,  198 => 75,  193 => 72,  189 => 70,  183 => 68,  177 => 66,  175 => 65,  170 => 64,  166 => 62,  160 => 60,  154 => 58,  152 => 57,  147 => 56,  145 => 55,  140 => 54,  138 => 53,  129 => 49,  126 => 48,  122 => 46,  118 => 44,  116 => 42,  115 => 41,  114 => 40,  112 => 38,  110 => 37,  107 => 36,  103 => 34,  101 => 31,  100 => 30,  99 => 29,  97 => 27,  94 => 26,  90 => 24,  88 => 21,  87 => 20,  86 => 19,  84 => 17,  82 => 16,  79 => 15,  77 => 14,  72 => 13,  69 => 12,  52 => 11,  47 => 10,  37 => 7,  31 => 5,  28 => 4,  24 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@activity/partials/activities.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Activity\\views\\partials\\activities.twig");
    }
}
