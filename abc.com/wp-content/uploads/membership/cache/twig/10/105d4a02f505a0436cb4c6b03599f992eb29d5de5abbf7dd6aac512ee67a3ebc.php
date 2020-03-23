<?php

/* @activity/partials/activity-comments.twig */
class __TwigTemplate_852710fee6c61ea399cf07c524eeb50e9ddd80514fca6bba23402f82ad075e51 extends Twig_Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["comments"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["comment"]) {
            // line 2
            echo "\t<div class=\"comment\" data-comment-id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["comment"], "id", array()), "html", null, true);
            echo "\">
\t\t<div class=\"comment-container\">
\t\t\t<a class=\"avatar\">
\t\t\t\t";
            // line 5
            if (twig_in_filter($this->getAttribute($context["comment"], "type", array()), array(0 => "activity_group_comment", 1 => "activity_group_comment_reply"))) {
                // line 6
                echo "\t\t\t\t\t<img src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Groups_Twig')->groupsLogo($this->getAttribute($context["comment"], "author", array()), "small"), "html", null, true);
                echo " \">
\t\t\t\t";
            } else {
                // line 8
                echo "\t\t\t\t\t<img src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->userAvatar($this->getAttribute($context["comment"], "author", array()), "small"), "html", null, true);
                echo " \">
\t\t\t\t";
            }
            // line 10
            echo "\t\t\t</a>
\t\t\t<div class=\"content mp-comment-content\">
\t\t\t\t";
            // line 12
            if (twig_in_filter($this->getAttribute($context["comment"], "type", array()), array(0 => "activity_group_comment", 1 => "activity_group_comment_reply"))) {
                // line 13
                echo "\t\t\t\t\t<a href=\"";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('groupUrl')->getCallable(), array($this->getAttribute($context["comment"], "author", array()))), "html", null, true);
                echo "\" class=\"author\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["comment"], "author", array()), "name", array()), "html", null, true);
                echo "</a>
\t\t\t\t";
            } else {
                // line 15
                echo "\t\t\t\t\t<a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->profileUrl($this->getAttribute($context["comment"], "author", array())), "html", null, true);
                echo "\" class=\"author\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["comment"], "author", array()), "displayName", array()), "html", null, true);
                echo "</a>
\t\t\t\t";
            }
            // line 17
            echo "\t\t\t\t
\t\t\t\t<div class=\"metadata\">
\t\t\t\t\t<span class=\"date\">";
            // line 19
            echo twig_escape_filter($this->env, $this->getAttribute($context["comment"], "updated_at", array()), "html", null, true);
            echo "</span>
\t\t\t\t</div>
\t\t\t\t<div class=\"text\" data-comment-data=\"";
            // line 21
            echo twig_escape_filter($this->env, $this->getAttribute($context["comment"], "data", array()));
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["comment"], "data", array()), "html", null, true);
            echo "</div>
\t\t\t\t
\t\t\t\t";
            // line 23
            if ($this->getAttribute($context["comment"], "link", array())) {
                // line 24
                echo "\t\t\t\t\t";
                $this->loadTemplate("@activity/partials/activity-attachment-link.twig", "@activity/partials/activity-comments.twig", 24)->display(array_merge($context, array("link" => $this->getAttribute($context["comment"], "link", array()))));
                // line 25
                echo "\t\t\t\t";
            }
            // line 26
            echo "\t\t\t\t
\t\t\t\t";
            // line 27
            if ($this->getAttribute($context["comment"], "images", array())) {
                // line 28
                echo "\t\t\t\t\t<div class=\"mp-activity-gallery\" data-gallery-id=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["comment"], "id", array()), "html", null, true);
                echo "\" style=\"display: none\">
\t\t\t\t\t\t";
                // line 29
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_slice($this->env, $this->getAttribute($this->getAttribute($context["comment"], "images", array()), "thumbnails", array()), 0, 3, true));
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
                    // line 30
                    echo "\t\t\t\t\t\t\t<div class=\"mp-activity-gallery-image\" data-image-id=\"";
                    echo twig_escape_filter($this->env, $context["id"], "html", null, true);
                    echo "\">
\t\t\t\t\t\t\t\t<img src=\"";
                    // line 31
                    echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Activity_Twig')->activityImage($context["thumbnails"], "large"), "html", null, true);
                    echo "\">
\t\t\t\t\t\t\t\t";
                    // line 32
                    if ((($this->getAttribute($context["loop"], "index0", array()) == 2) && ($this->getAttribute($this->getAttribute($context["comment"], "images", array()), "total", array()) > 3))) {
                        // line 33
                        echo "\t\t\t\t\t\t\t\t\t<div class=\"mp-activity-gallery-image-overlay\">
\t\t\t\t\t\t\t\t\t\t<div>+";
                        // line 34
                        echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($context["comment"], "images", array()), "total", array()) - 3), "html", null, true);
                        echo "</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
                    }
                    // line 37
                    echo "\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t";
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
                // line 39
                echo "\t\t\t\t\t</div>
\t\t\t\t";
            }
            // line 41
            echo "
\t\t\t\t";
            // line 42
            if ($this->getAttribute($context["comment"], "attachmentFiles", array())) {
                // line 43
                echo "\t\t\t\t\t<div class=\"mbsActivAttachFilesWr\" data-activity-id=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["comment"], "id", array()), "html", null, true);
                echo "\">
\t\t\t\t\t\t";
                // line 44
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["comment"], "attachmentFiles", array()));
                foreach ($context['_seq'] as $context["oneAttachId"] => $context["oneAttach"]) {
                    // line 45
                    echo "\t\t\t\t\t\t\t<a class=\"mbsOneAttachItem\" title=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["oneAttach"], "file_info", array(), "array"), "name", array(), "array"), "html", null, true);
                    echo "\" href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["oneAttach"], "file_info", array(), "array"), "url", array(), "array"), "html", null, true);
                    echo "\" target=\"_blank\" data-id=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["oneAttach"], "attachment_all_id", array(), "array"), "html", null, true);
                    echo "\">
\t\t\t\t\t\t\t\t<i class=\"icon attach mbsOneAttachIcon\"></i>
\t\t\t\t\t\t\t\t<span class=\"mbsOneAttachCaption\">";
                    // line 47
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["oneAttach"], "file_info", array(), "array"), "name", array(), "array"), "html", null, true);
                    echo "</span>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['oneAttachId'], $context['oneAttach'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 50
                echo "\t\t\t\t\t</div>
\t\t\t\t";
            }
            // line 52
            echo "
\t\t\t\t";
            // line 53
            if (call_user_func_array($this->env->getFunction('isPostComment')->getCallable(), array($this->getAttribute(($context["activity"] ?? null), "group", array())))) {
                // line 54
                echo "\t\t\t\t\t<div class=\"actions\">
                        ";
                // line 55
                if (($this->getAttribute(($context["relatedActivity"] ?? null), "status", array()) != "deleted")) {
                    // line 56
                    echo "                            ";
                    if (((is_string($__internal_16cc6183da93a42f279a4cfb3f2092437d306be02ecc607659528a9651a721ec = $this->getAttribute(($context["activity"] ?? null), "type", array())) && is_string($__internal_6375ddd2133bda5b0efa77b02dd5a27b9aa239376a288cc14f4d46a17ed2c607 = "group") && ('' === $__internal_6375ddd2133bda5b0efa77b02dd5a27b9aa239376a288cc14f4d46a17ed2c607 || 0 === strpos($__internal_16cc6183da93a42f279a4cfb3f2092437d306be02ecc607659528a9651a721ec, $__internal_6375ddd2133bda5b0efa77b02dd5a27b9aa239376a288cc14f4d46a17ed2c607))) || call_user_func_array($this->env->getFunction('currentUserHasPermission')->getCallable(), array("post-comments", $this->getAttribute(($context["activity"] ?? null), "author", array()))))) {
                        // line 57
                        echo "\t\t\t\t\t\t\t\t<a class=\"reply reply-action\">";
                        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Reply")), "html", null, true);
                        echo "</a>
                            ";
                    }
                    // line 59
                    echo "\t\t\t\t\t\t\t";
                    if (($this->env->getExtension('Membership_Users_Twig')->isCurrentUser($this->getAttribute($context["comment"], "author", array())) || call_user_func_array($this->env->getFunction('currentUserCan')->getCallable(), array("edit-activity")))) {
                        // line 60
                        echo "\t\t\t\t\t\t\t\t<a class=\"edit-action\">";
                        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Edit")), "html", null, true);
                        echo "</a>
\t\t\t\t\t\t\t\t<a class=\"remove-action\">";
                        // line 61
                        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Remove")), "html", null, true);
                        echo "</a>
                            ";
                    }
                    // line 63
                    echo "                        ";
                }
                // line 64
                echo "\t\t\t\t\t\t<div class=\"mp-load-replies\">
\t\t\t\t\t\t\t<a class=\"load-replies\" ";
                // line 65
                if ( !$this->getAttribute($context["comment"], "replies", array())) {
                    echo "style=\"display:none;\"";
                }
                echo "><i class=\"vertically flipped share icon\"></i><span>";
                echo twig_escape_filter($this->env, $this->getAttribute($context["comment"], "replies", array()), "html", null, true);
                echo "</span> ";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Replies")), "html", null, true);
                echo "</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t";
            }
            // line 69
            echo "\t\t\t
\t\t\t</div>
\t\t</div>
\t\t
\t\t<div class=\"comments mp-comment-replies\" style=\"display: none\">
\t\t\t<div class=\"ui equal width grid mp-previous-replies\" style=\"display: none\">
\t\t\t\t<div class=\"left floated column\">
\t\t\t\t\t<div class=\"mp-more-replies\">";
            // line 76
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("View previous replies")), "html", null, true);
            echo " <div class=\"ui active mini inline loader\" style=\"display: none\"></div></div>
\t\t\t\t</div>
\t\t\t\t<div class=\"right floated right aligned column mp-replies-count\">
\t\t\t\t\t<div class=\"ui floated right\">
\t\t\t\t\t\t<span class=\"showed-replies\">0</span> ";
            // line 80
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("of")), "html", null, true);
            echo "
\t\t\t\t\t\t<span class=\"total-replies\">";
            // line 81
            echo twig_escape_filter($this->env, $this->getAttribute($context["comment"], "replies", array()), "html", null, true);
            echo "</span>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t
\t\t\t<div class=\"ui basic segment replies-loader\" style=\"display: none\">
\t\t\t\t<div class=\"ui small active loader\"></div>
\t\t\t</div>
\t\t\t
\t\t\t<div class=\"comment-replies\" style=\"display: none\"></div>
\t\t\t
\t\t\t";
            // line 92
            if (((is_string($__internal_80ad5361cf6ddd338b479c4b964d851a345afa8911db6bb8f4d6a59342d81473 = $this->getAttribute(($context["activity"] ?? null), "type", array())) && is_string($__internal_b9e6f27c29832fd77971453d9c756bb285c9d2b1ff2f5af95213967f5a578768 = "group") && ('' === $__internal_b9e6f27c29832fd77971453d9c756bb285c9d2b1ff2f5af95213967f5a578768 || 0 === strpos($__internal_80ad5361cf6ddd338b479c4b964d851a345afa8911db6bb8f4d6a59342d81473, $__internal_b9e6f27c29832fd77971453d9c756bb285c9d2b1ff2f5af95213967f5a578768))) || call_user_func_array($this->env->getFunction('currentUserHasPermission')->getCallable(), array("post-comments", $this->getAttribute(($context["activity"] ?? null), "author", array()))))) {
                // line 93
                echo "\t\t\t\t<div class=\"mp-reply-form\">
\t\t\t\t\t";
                // line 94
                $this->loadTemplate("@activity/partials/activity-comment-form.twig", "@activity/partials/activity-comments.twig", 94)->display(array_merge($context, array("context" => ($context["activityContext"] ?? null), "placeholder" => "Write a reply...")));
                // line 95
                echo "\t\t\t\t</div>
\t\t\t";
            }
            // line 97
            echo "\t\t</div>
\t</div>
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['comment'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "@activity/partials/activity-comments.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  302 => 97,  298 => 95,  296 => 94,  293 => 93,  291 => 92,  277 => 81,  273 => 80,  266 => 76,  257 => 69,  244 => 65,  241 => 64,  238 => 63,  233 => 61,  228 => 60,  225 => 59,  219 => 57,  216 => 56,  214 => 55,  211 => 54,  209 => 53,  206 => 52,  202 => 50,  193 => 47,  183 => 45,  179 => 44,  174 => 43,  172 => 42,  169 => 41,  165 => 39,  150 => 37,  144 => 34,  141 => 33,  139 => 32,  135 => 31,  130 => 30,  113 => 29,  108 => 28,  106 => 27,  103 => 26,  100 => 25,  97 => 24,  95 => 23,  88 => 21,  83 => 19,  79 => 17,  71 => 15,  63 => 13,  61 => 12,  57 => 10,  51 => 8,  45 => 6,  43 => 5,  36 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@activity/partials/activity-comments.twig", "F:\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Activity\\views\\partials\\activity-comments.twig");
    }
}
