<?php

/* @users/groups.twig */
class __TwigTemplate_b4c7d2167aa2d066c3ae6e4891b52c43c3b64b6e72ad3620c737594601f1a749 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@users/profile.twig", "@users/groups.twig", 1);
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
        echo "\t<div class=\"ui basic vertical segment\">
\t\t<div class=\"groups-tab-items\" ";
        // line 5
        if ( !(($context["groupInvites"] ?? null) && $this->env->getExtension('Membership_Users_Twig')->isCurrentUser(($context["requestedUser"] ?? null)))) {
            echo "style=\"display:none\"";
        }
        echo ">
\t\t\t<div class=\"ui pointing secondary menu\" id=\"friends-tabs\">
\t\t\t\t<a class=\"item active\" data-tab=\"joined\">Groups <div class=\"ui mini label\">";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute(($context["groupCounts"] ?? null), "joined", array()), "html", null, true);
        echo "</div></a>
\t\t\t\t<a class=\"item\" data-tab=\"invited\">Invites <div class=\"ui mini red label\">";
        // line 8
        echo twig_escape_filter($this->env, $this->getAttribute(($context["groupCounts"] ?? null), "invited", array()), "html", null, true);
        echo "</div></a>
\t\t\t</div>
\t\t\t<div class=\"ui basic segment very padded friends-list-loader\" style=\"display:none;\">
\t\t\t\t<div class=\"ui active loader\"></div>
\t\t\t</div>
\t\t</div>
\t\t
\t\t<div class=\"groups-tabs\">
\t\t\t<div class=\"ui tab basic vertical segment active\" data-tab=\"joined\">
\t\t\t\t<div class=\"ui basic vertical segment form group-search-input\">
\t\t\t\t\t<select name=\"category\" class=\"mbsGroupsSearchCategory\">
\t\t\t\t\t\t<option value=\"0\">";
        // line 19
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("All categories")), "html", null, true);
        echo "</option>
\t\t\t\t\t\t";
        // line 20
        if (twig_length_filter($this->env, ($context["groupCategoryList"] ?? null))) {
            // line 21
            echo "\t\t\t\t\t\t\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["groupCategoryList"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["oneGcItem"]) {
                // line 22
                echo "\t\t\t\t\t\t\t\t<option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["oneGcItem"], "id", array(), "array"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["oneGcItem"], "name", array(), "array"), "html", null, true);
                echo "</option>
\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['oneGcItem'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 24
            echo "\t\t\t\t\t\t";
        }
        // line 25
        echo "\t\t\t\t\t</select>
\t\t\t\t\t<div class=\"ui fluid icon input mbsGroupsSearchName\">
\t\t\t\t\t\t<input type=\"text\" placeholder=\"";
        // line 27
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Find group...")), "html", null, true);
        echo "\">
\t\t\t\t\t\t<i class=\"search icon\"></i>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"ui two cards stackable groups-list\">
\t\t\t\t\t";
        // line 32
        $this->loadTemplate("@groups/partials/groups-list.twig", "@users/groups.twig", 32)->display(array("groups" => ($context["groups"] ?? null)));
        // line 33
        echo "\t\t\t\t</div>
\t\t\t\t<div class=\"ui basic vertical segment\">
\t\t\t\t\t<div class=\"ui message no-groups\" ";
        // line 35
        if (($context["groups"] ?? null)) {
            echo "style=\"display:none\"";
        }
        echo ">
\t\t\t\t\t\t<p>";
        // line 36
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No groups to show.")), "html", null, true);
        echo "</p>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"ui basic segment very padded list-loader\" style=\"display:none;\">
\t\t\t\t\t<div class=\"ui active loader\"></div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t
\t\t\t";
        // line 44
        if ((($context["groupInvites"] ?? null) && $this->env->getExtension('Membership_Users_Twig')->isCurrentUser(($context["requestedUser"] ?? null)))) {
            // line 45
            echo "\t\t\t\t<div class=\"ui tab basic vertical segment\" data-tab=\"invited\">
\t\t\t\t\t<div class=\"ui basic vertical segment form group-search-input\">
\t\t\t\t\t\t<select name=\"category\" class=\"mbsGroupsSearchCategory\">
\t\t\t\t\t\t\t<option value=\"0\">";
            // line 48
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("All categories")), "html", null, true);
            echo "</option>
\t\t\t\t\t\t\t";
            // line 49
            if (twig_length_filter($this->env, ($context["groupCategoryList"] ?? null))) {
                // line 50
                echo "\t\t\t\t\t\t\t\t";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["groupCategoryList"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["oneGcItem"]) {
                    // line 51
                    echo "\t\t\t\t\t\t\t\t\t<option value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["oneGcItem"], "id", array(), "array"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["oneGcItem"], "name", array(), "array"), "html", null, true);
                    echo "</option>
\t\t\t\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['oneGcItem'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 53
                echo "\t\t\t\t\t\t\t";
            }
            // line 54
            echo "\t\t\t\t\t\t</select>
\t\t\t\t\t\t<div class=\"ui fluid icon input mbsGroupsSearchName\">
\t\t\t\t\t\t\t<input type=\"text\" placeholder=\"";
            // line 56
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Find group...")), "html", null, true);
            echo "\">
\t\t\t\t\t\t\t<i class=\"search icon\"></i>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"ui two cards stackable groups-list\">
\t\t\t\t\t\t";
            // line 61
            $this->loadTemplate("@users/groups.twig", "@users/groups.twig", 61, "179510678")->display(array_merge($context, array("groups" => ($context["groupInvites"] ?? null))));
            // line 73
            echo "\t\t\t\t\t</div>
\t\t\t\t\t
\t\t\t\t\t<div class=\"ui message no-groups\" ";
            // line 75
            if (($context["groupInvites"] ?? null)) {
                echo "style=\"display:none\"";
            }
            echo ">
\t\t\t\t\t\t<p>";
            // line 76
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No invites to show.")), "html", null, true);
            echo "</p>
\t\t\t\t\t</div>
\t\t\t\t\t
\t\t\t\t\t<div class=\"ui basic segment very padded list-loader\" style=\"display:none;\">
\t\t\t\t\t\t<div class=\"ui active loader\"></div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t";
        }
        // line 84
        echo "\t\t</div>
\t</div>
";
    }

    public function getTemplateName()
    {
        return "@users/groups.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  186 => 84,  175 => 76,  169 => 75,  165 => 73,  163 => 61,  155 => 56,  151 => 54,  148 => 53,  137 => 51,  132 => 50,  130 => 49,  126 => 48,  121 => 45,  119 => 44,  108 => 36,  102 => 35,  98 => 33,  96 => 32,  88 => 27,  84 => 25,  81 => 24,  70 => 22,  65 => 21,  63 => 20,  59 => 19,  45 => 8,  41 => 7,  34 => 5,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@users/groups.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Users\\views\\groups.twig");
    }
}


/* @users/groups.twig */
class __TwigTemplate_b4c7d2167aa2d066c3ae6e4891b52c43c3b64b6e72ad3620c737594601f1a749_179510678 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 61
        $this->parent = $this->loadTemplate("@groups/partials/groups-list.twig", "@users/groups.twig", 61);
        $this->blocks = array(
            'actionButtons' => array($this, 'block_actionButtons'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@groups/partials/groups-list.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 62
    public function block_actionButtons($context, array $blocks = array())
    {
        // line 63
        echo "\t\t\t\t\t\t\t\t";
        if ( !$this->env->getExtension('Membership_Groups_Twig')->isMemberOfGroup(($context["group"] ?? null))) {
            // line 64
            echo "\t\t\t\t\t\t\t\t\t<button class=\"ui mini primary button\" data-action=\"accept-invitation\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Accept")), "html", null, true);
            echo "</button>
\t\t\t\t\t\t\t\t\t<button class=\"ui mini primary button\" data-action=\"decline-invitation\">";
            // line 65
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Decline")), "html", null, true);
            echo "</button>
\t\t\t\t\t\t\t\t";
        } else {
            // line 67
            echo "\t\t\t\t\t\t\t\t\t";
            if ($this->env->getExtension('Membership_Groups_Twig')->canLeaveGroup(($context["group"] ?? null))) {
                // line 68
                echo "\t\t\t\t\t\t\t\t\t\t<button class=\"ui mini primary button\" data-action=\"decline-invitation\">";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Leave group")), "html", null, true);
                echo "</button>
\t\t\t\t\t\t\t\t\t";
            }
            // line 70
            echo "\t\t\t\t\t\t\t\t";
        }
        // line 71
        echo "\t\t\t\t\t\t\t";
    }

    public function getTemplateName()
    {
        return "@users/groups.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  274 => 71,  271 => 70,  265 => 68,  262 => 67,  257 => 65,  252 => 64,  249 => 63,  246 => 62,  229 => 61,  186 => 84,  175 => 76,  169 => 75,  165 => 73,  163 => 61,  155 => 56,  151 => 54,  148 => 53,  137 => 51,  132 => 50,  130 => 49,  126 => 48,  121 => 45,  119 => 44,  108 => 36,  102 => 35,  98 => 33,  96 => 32,  88 => 27,  84 => 25,  81 => 24,  70 => 22,  65 => 21,  63 => 20,  59 => 19,  45 => 8,  41 => 7,  34 => 5,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@users/groups.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Users\\views\\groups.twig");
    }
}
