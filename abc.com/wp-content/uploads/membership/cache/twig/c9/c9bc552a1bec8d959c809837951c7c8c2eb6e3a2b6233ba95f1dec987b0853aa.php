<?php

/* @activity/partials/activity-post-form.twig */
class __TwigTemplate_19c1bafc3d35cc249ab1f1f45d399b8d6190844868ff8e7883f73d6ac525ecce extends Twig_Template
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
        echo "<div class=\"ui segments mp-activity-post-form\" style=\"display:none;\">
    <div class=\"ui segment\">
        <div class=\"ui divided items\">
            <div class=\"item\">
                ";
        // line 5
        if (((($context["context"] ?? null) == "group") && $this->env->getExtension('Membership_Groups_Twig')->canEditGroup(($context["requestedGroup"] ?? null)))) {
            // line 6
            echo "                    <img class=\"mp-activity-post-avatar activity-author-group\" src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Groups_Twig')->groupsLogo(($context["requestedGroup"] ?? null), "medium"), "html", null, true);
            echo "\" alt=\"\">
\t                <img class=\"mp-activity-post-avatar activity-author-user\" src=\"";
            // line 7
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->userAvatar(($context["currentUser"] ?? null), "medium"), "html", null, true);
            echo "\" style=\"display: none\" alt=\"\">
                ";
        } else {
            // line 9
            echo "                    <img class=\"mp-activity-post-avatar activity-author-user\" src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->userAvatar(($context["currentUser"] ?? null), "medium"), "html", null, true);
            echo "\" alt=\"\">
                ";
        }
        // line 11
        echo "                <div class=\"middle aligned content\">
                    <form class=\"ui reply form\">
                        <div class=\"field\">
\t\t\t\t\t\t\t<textarea class=\"mp-form-textarea\" rows=\"2\" placeholder=\"";
        // line 14
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("What's new?")), "html", null, true);
        echo "\"></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

\t<div class=\"ui segment mp-attachment-images\" style=\"display:none;\"></div>

\t";
        // line 24
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "activity.form.photoGalleryContainer"), "method"), "html", null, true);
        echo "
\t";
        // line 25
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "activity.form.sliderContainer"), "method"), "html", null, true);
        echo "
\t";
        // line 26
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "activity.form.googleMapsContainer"), "method"), "html", null, true);
        echo "

    <div class=\"ui segment mp-attachment-link\" style=\"display:none;\">
        <div class=\"ui active centered inline loader\" style=\"display:none;\"></div>
    </div>
\t
    <div class=\"ui secondary basic segment clearing post-form-buttons\">

\t    <div class=\"post-activity-buttons\">
\t\t\t<button class=\"ui icon button secondary mini mbsActivityAttachmentBtn\" data-action=\"mbs-add-attachment\"><i class=\"icon attach\"></i></button>
\t\t    <button class=\"ui icon button primary mini right floated\" data-action=\"post-activity\">
\t\t\t    <span><i class=\"send icon\"></i>";
        // line 37
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Post")), "html", null, true);
        echo "</span>
\t\t    </button>
\t\t\t";
        // line 39
        if ((twig_length_filter($this->env, ($context["smilesList"] ?? null)) > 0)) {
            // line 40
            echo "\t\t\t\t<div class=\"mbs-smile-btn-wrapper\">
\t\t\t\t\t<button class=\"ui button mini\" data-action=\"add-smile-to-text\">:D</button>
\t\t\t\t\t<div class=\"mp-smiles-window mbs-displ-hidden\">
\t\t\t\t\t\t<div class=\"mbs-smiles-wrapper\">
\t\t\t\t\t\t\t";
            // line 44
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["smilesList"] ?? null));
            foreach ($context['_seq'] as $context["scIndex"] => $context["smileCode"]) {
                // line 45
                echo "\t\t\t\t\t\t\t\t<div class=\"mbs-sw-one-smile\" data-id=\"";
                echo twig_escape_filter($this->env, $context["scIndex"], "html", null, true);
                echo "\" data-code=\"";
                echo twig_escape_filter($this->env, $context["smileCode"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["smileCode"], "html", null, true);
                echo "</div>
\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['scIndex'], $context['smileCode'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 47
            echo "\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t";
        }
        // line 51
        echo "
            ";
        // line 52
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "activity.form.actions"), "method"), "html", null, true);
        echo "
\t\t
\t\t    ";
        // line 54
        if (((($context["context"] ?? null) == "group") && $this->env->getExtension('Membership_Groups_Twig')->canEditGroup(($context["requestedGroup"] ?? null)))) {
            // line 55
            echo "\t\t\t    <div class=\"ui pointing left top dropdown mp-activity-author right floated\">
\t\t\t\t    <div class=\"text\">
\t\t\t\t\t    <img class=\"ui mini image activity-author-group\" src=\"";
            // line 57
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Groups_Twig')->groupsLogo(($context["requestedGroup"] ?? null), "small"), "html", null, true);
            echo "\" >
\t\t\t\t\t    <img class=\"ui mini image activity-author-user\" src=\"";
            // line 58
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->userAvatar(($context["currentUser"] ?? null), "small"), "html", null, true);
            echo "\" style=\"display: none\">
\t\t\t\t    </div>
\t\t\t\t    <i class=\"dropdown icon\"></i>
\t\t\t\t    <div class=\"menu\">
\t\t\t\t\t    <div class=\"header\">Post as</div>
\t\t\t\t\t    <div class=\"divider\"></div>
\t\t\t\t\t    <div class=\"item\" data-value=\"user\">
\t\t\t\t\t\t    <img class=\"ui avatar image\" src=\"";
            // line 65
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->userAvatar(($context["currentUser"] ?? null), "small"), "html", null, true);
            echo "\">
\t\t\t\t\t\t    ";
            // line 66
            echo twig_escape_filter($this->env, $this->getAttribute(($context["currentUser"] ?? null), "displayName", array()), "html", null, true);
            echo "
\t\t\t\t\t    </div>
\t\t\t\t\t    <div class=\"item\" data-value=\"group\">
\t\t\t\t\t\t    <img class=\"ui avatar image\" src=\"";
            // line 69
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Groups_Twig')->groupsLogo(($context["requestedGroup"] ?? null), "small"), "html", null, true);
            echo "\">
\t\t\t\t\t\t    ";
            // line 70
            echo twig_escape_filter($this->env, $this->getAttribute(($context["requestedGroup"] ?? null), "name", array()), "html", null, true);
            echo "
\t\t\t\t\t    </div>
\t\t\t\t    </div>
\t\t\t    </div>
\t\t    ";
        }
        // line 75
        echo "\t    </div>
\t
\t    <div class=\"edit-activity-buttons\" style=\"display:none;\">
\t\t    <div class=\"post-activity-buttons edit-activity-buttons\" style=\"display: inline-block;\">
\t\t\t    <button class=\"ui icon button secondary mini mbsActivityAttachmentBtn\" data-action=\"mbs-add-attachment\"><i class=\"icon attach\"></i></button>
\t\t\t    ";
        // line 80
        if ((twig_length_filter($this->env, ($context["smilesList"] ?? null)) > 0)) {
            // line 81
            echo "\t\t\t\t    <div class=\"mbs-smile-btn-wrapper\">
\t\t\t\t\t    <button class=\"ui button mini\" data-action=\"add-smile-to-text\">:D</button>
\t\t\t\t\t    <div class=\"mp-smiles-window mbs-displ-hidden\">
\t\t\t\t\t\t    <div class=\"mbs-smiles-wrapper\">
\t\t\t\t\t\t\t    ";
            // line 85
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["smilesList"] ?? null));
            foreach ($context['_seq'] as $context["scIndex"] => $context["smileCode"]) {
                // line 86
                echo "\t\t\t\t\t\t\t\t    <div class=\"mbs-sw-one-smile\" data-id=\"";
                echo twig_escape_filter($this->env, $context["scIndex"], "html", null, true);
                echo "\" data-code=\"";
                echo twig_escape_filter($this->env, $context["smileCode"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["smileCode"], "html", null, true);
                echo "</div>
\t\t\t\t\t\t\t    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['scIndex'], $context['smileCode'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 88
            echo "\t\t\t\t\t\t    </div>
\t\t\t\t\t    </div>
\t\t\t\t    </div>
\t\t\t    ";
        }
        // line 92
        echo "\t\t    </div>
\t\t    <button class=\"ui floating icon button mini right floated primary\" data-action=\"save\">";
        // line 93
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Save")), "html", null, true);
        echo "</button>
\t\t    <button class=\"ui floating icon button mini right floated secondary\" data-action=\"cancel\">";
        // line 94
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Cancel")), "html", null, true);
        echo "</button>
\t\t</div>
\t    
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "@activity/partials/activity-post-form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  214 => 94,  210 => 93,  207 => 92,  201 => 88,  188 => 86,  184 => 85,  178 => 81,  176 => 80,  169 => 75,  161 => 70,  157 => 69,  151 => 66,  147 => 65,  137 => 58,  133 => 57,  129 => 55,  127 => 54,  122 => 52,  119 => 51,  113 => 47,  100 => 45,  96 => 44,  90 => 40,  88 => 39,  83 => 37,  69 => 26,  65 => 25,  61 => 24,  48 => 14,  43 => 11,  37 => 9,  32 => 7,  27 => 6,  25 => 5,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@activity/partials/activity-post-form.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Activity\\views\\partials\\activity-post-form.twig");
    }
}
