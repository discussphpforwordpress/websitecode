<?php

/* @roles/backend/index.twig */
class __TwigTemplate_78d46f51b8f10a9cf207122161fcd3ae275ce496f807c84cdfa6745f80a065bd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@base/layouts/backend.twig", "@roles/backend/index.twig", 1);
        $this->blocks = array(
            'mainHeader' => array($this, 'block_mainHeader'),
            'head' => array($this, 'block_head'),
            'main' => array($this, 'block_main'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@base/layouts/backend.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $context["options"] = $this->loadTemplate("@base/macros/options.twig", "@roles/backend/index.twig", 2);
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_mainHeader($context, array $blocks = array())
    {
        // line 5
        echo "\t<div class=\"sc-header\">
\t\t<h2>";
        // line 6
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Roles")), "html", null, true);
        echo "</h2>
\t</div>
";
    }

    // line 10
    public function block_head($context, array $blocks = array())
    {
        // line 11
        echo "\t<div class=\"sc-tabs\">
\t\t<a href=\"#\" class=\"tab active\" data-target=\"roles\">
\t\t\t<i class=\"fa fa-desktop\"></i>";
        // line 13
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("General")), "html", null, true);
        echo "
\t\t</a>
\t\t<a href=\"#\" class=\"tab active\" data-target=\"groups\">
\t\t\t<i class=\"fa fa-group\"></i>";
        // line 16
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Group invites")), "html", null, true);
        echo "
\t\t</a>
\t\t<button data-save-settings class=\"save-settings sc-button icon-button primary\">
\t\t\t<i class=\"fa fa-save\"></i>
\t\t\t<span>";
        // line 20
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Save Settings")), "html", null, true);
        echo "</span>
\t\t</button>
\t</div>
";
    }

    // line 25
    public function block_main($context, array $blocks = array())
    {
        // line 26
        echo "\t";
        $context["_roles"] = array(0 => array("title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("All")), "value" => "all"));
        // line 30
        echo "\t
\t";
        // line 31
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["roles"] ?? null));
        foreach ($context['_seq'] as $context["value"] => $context["role"]) {
            // line 32
            echo "\t\t";
            if (($this->getAttribute($context["role"], "type", array()) != "__guest__")) {
                // line 33
                echo "\t\t\t";
                $context["_roles"] = twig_array_merge(($context["_roles"] ?? null), array(0 => array("title" => $this->getAttribute(                // line 34
$context["role"], "name", array()), "value" => $this->getAttribute(                // line 35
$context["role"], "id", array()))));
                // line 37
                echo "\t\t";
            }
            // line 38
            echo "\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['value'], $context['role'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 39
        echo "\t
\t<div class=\"sc-tabs-container\">
\t\t<div class=\"sc-tab-content active\" data-tab=\"roles\">
\t\t\t<button class=\"sc-button primary add-new-role\">";
        // line 42
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Add new role")), "html", null, true);
        echo "</button>
\t\t\t<div class=\"roles-table-wrap\">
\t\t\t\t<table class=\"sc-table roles\">
\t\t\t\t\t<tr>
\t\t\t\t\t\t<th style=\"width: 320px;\">";
        // line 46
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Role Name")), "html", null, true);
        echo "</th>
\t\t\t\t\t\t";
        // line 47
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["roles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
            // line 48
            echo "\t\t\t\t\t\t\t<th data-id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["role"], "id", array()), "html", null, true);
            echo "\">
\t\t\t\t\t\t\t\t<div>
\t\t\t\t\t\t\t\t\t<input style=\"max-width: calc(100% - 30px);\" type=\"text\" class=\"sc-input\" name=\"name\" value=\"";
            // line 50
            echo twig_escape_filter($this->env, $this->getAttribute($context["role"], "name", array()), "html", null, true);
            echo "\">
\t\t\t\t\t\t\t\t\t";
            // line 51
            if (($this->getAttribute($context["role"], "type", array()) != "__guest__")) {
                // line 52
                echo "\t\t\t\t\t\t\t\t\t\t<div style=\"margin: 0 10px; display: inline; cursor: pointer\" class=\"remove-role\">
\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-trash\"></i>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t";
            }
            // line 56
            echo "\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</th>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 59
        echo "\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td><b>";
        // line 61
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Administrative permissions")), "html", null, true);
        echo "</b></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
        // line 64
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Access to admin dashboard")), "html", null, true);
        echo "</td>
\t\t\t\t\t\t";
        // line 65
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["roles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
            // line 66
            echo "\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" value=\"true\" name=\"can-access-wp-admin\"
\t\t\t\t\t\t\t\t\t\t\t";
            // line 69
            if (($this->getAttribute($this->getAttribute($context["role"], "permissions", array()), "can-access-wp-admin", array(), "array") == "true")) {
                // line 70
                echo "\t\t\t\t\t\t\t\t\t\t\t\tchecked=\"checked\"
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 72
            echo "\t\t\t\t\t\t\t\t\t\t\t";
            if (($this->getAttribute($context["role"], "type", array()) == "__guest__")) {
                // line 73
                echo "\t\t\t\t\t\t\t\t\t\t\t\tdisabled=\"true\"
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 75
            echo "\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 80
        echo "\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
        // line 82
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("See dashboard bar")), "html", null, true);
        echo "</td>
\t\t\t\t\t\t";
        // line 83
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["roles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
            // line 84
            echo "\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" value=\"true\" name=\"can-see-admin-bar\"
\t\t\t\t\t\t\t\t\t\t\t";
            // line 87
            if (($this->getAttribute($this->getAttribute($context["role"], "permissions", array()), "can-see-admin-bar", array(), "array") == "true")) {
                // line 88
                echo "\t\t\t\t\t\t\t\t\t\t\t\tchecked=\"checked\"
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 90
            echo "\t\t\t\t\t\t\t\t\t\t\t";
            if (($this->getAttribute($context["role"], "type", array()) == "__guest__")) {
                // line 91
                echo "\t\t\t\t\t\t\t\t\t\t\t\tdisabled=\"true\"
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 93
            echo "\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 98
        echo "\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td><b>";
        // line 100
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Activities")), "html", null, true);
        echo "</b></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
        // line 103
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Edit or delete other users activity")), "html", null, true);
        echo "</td>
\t\t\t\t\t\t";
        // line 104
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["roles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
            // line 105
            echo "\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" value=\"true\" name=\"edit-activity\"
\t\t\t\t\t\t\t\t\t\t\t";
            // line 108
            if (($this->getAttribute($this->getAttribute($context["role"], "permissions", array()), "edit-activity", array(), "array") == "true")) {
                // line 109
                echo "\t\t\t\t\t\t\t\t\t\t\t\tchecked=\"checked\"
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 111
            echo "\t\t\t\t\t\t\t\t\t\t\t";
            if (twig_in_filter($this->getAttribute($context["role"], "type", array()), array(0 => "__guest__", 1 => "administrator"))) {
                // line 112
                echo "\t\t\t\t\t\t\t\t\t\t\t\tdisabled=\"true\"
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 114
            echo "\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 119
        echo "\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td><b>";
        // line 121
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Profile")), "html", null, true);
        echo "</b></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
        // line 124
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Delete their account")), "html", null, true);
        echo "</td>
\t\t\t\t\t\t";
        // line 125
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["roles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
            // line 126
            echo "\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" value=\"true\" name=\"can-delete-their-account\"
\t\t\t\t\t\t\t\t\t\t\t";
            // line 129
            if (($this->getAttribute($this->getAttribute($context["role"], "permissions", array()), "can-delete-their-account", array(), "array") == "true")) {
                // line 130
                echo "\t\t\t\t\t\t\t\t\t\t\t\tchecked=\"checked\"
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 132
            echo "\t\t\t\t\t\t\t\t\t\t\t";
            if (($this->getAttribute($context["role"], "type", array()) == "__guest__")) {
                // line 133
                echo "\t\t\t\t\t\t\t\t\t\t\t\tdisabled=\"true\"
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 135
            echo "\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 140
        echo "\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
        // line 142
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Access to user profiles with specific roles")), "html", null, true);
        echo "</td>
\t\t\t\t\t\t";
        // line 143
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["roles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
            // line 144
            echo "\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<select class=\"sc-input\" name=\"access-to-specific-roles-page\" multiple=\"\"
\t\t\t\t\t\t\t\t        data-value=\"";
            // line 146
            echo twig_escape_filter($this->env, twig_jsonencode_filter(($context["_roles"] ?? null)), "html", null, true);
            echo "\">
\t\t\t\t\t\t\t\t\t";
            // line 147
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["_roles"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                // line 148
                echo "\t\t\t\t\t\t\t\t\t\t<option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "value", array()), "html", null, true);
                echo "\"
\t\t\t\t\t\t\t\t\t\t\t\t";
                // line 149
                if (twig_in_filter($this->getAttribute($context["option"], "value", array()), $this->getAttribute($this->getAttribute($context["role"], "permissions", array()), "access-to-specific-roles-page", array(), "array"))) {
                    // line 150
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\tselected
\t\t\t\t\t\t\t\t\t\t\t\t";
                }
                // line 152
                echo "\t\t\t\t\t\t\t\t\t\t>";
                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "title", array()), "html", null, true);
                echo "</option>
\t\t\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 154
            echo "\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 157
        echo "\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
        // line 159
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Allow to change privacy settings")), "html", null, true);
        echo "</td>
\t\t\t\t\t\t";
        // line 160
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["roles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
            // line 161
            echo "\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" value=\"true\" name=\"change-privacy-settings\"
\t\t\t\t\t\t\t\t\t\t\t";
            // line 164
            if (($this->getAttribute($this->getAttribute($context["role"], "permissions", array()), "change-privacy-settings", array(), "array") == "true")) {
                // line 165
                echo "\t\t\t\t\t\t\t\t\t\t\t\tchecked=\"checked\"
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 167
            echo "\t\t\t\t\t\t\t\t\t\t\t";
            if (($this->getAttribute($context["role"], "type", array()) == "__guest__")) {
                // line 168
                echo "\t\t\t\t\t\t\t\t\t\t\t\tdisabled=\"true\"
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 170
            echo "\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 175
        echo "\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
        // line 177
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Apply WordPress role")), "html", null, true);
        echo "</td>
\t\t\t\t\t\t";
        // line 178
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["roles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
            // line 179
            echo "\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t";
            // line 180
            echo $context["options"]->getselectInput2(            // line 181
($context["wpRoles"] ?? null), (($this->getAttribute($this->getAttribute(            // line 182
$context["role"], "settings", array(), "any", false, true), "wp-role", array(), "array", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($context["role"], "settings", array(), "any", false, true), "wp-role", array(), "array"), ($context["wpDefaultRole"] ?? null))) : (($context["wpDefaultRole"] ?? null))), array("name" => "wp-role", "data-role-id" => $this->getAttribute(            // line 185
$context["role"], "id", array())));
            // line 187
            echo "
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 190
        echo "\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td><b>";
        // line 192
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Groups")), "html", null, true);
        echo "</b></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
        // line 195
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Create groups")), "html", null, true);
        echo "</td>
\t\t\t\t\t\t";
        // line 196
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["roles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
            // line 197
            echo "\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" value=\"true\" name=\"can-create-groups\"
\t\t\t\t\t\t\t\t\t\t\t";
            // line 200
            if (($this->getAttribute($this->getAttribute($context["role"], "permissions", array()), "can-create-groups", array(), "array") == "true")) {
                // line 201
                echo "\t\t\t\t\t\t\t\t\t\t\t\tchecked=\"checked\"
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 203
            echo "\t\t\t\t\t\t\t\t\t\t\t";
            if (($this->getAttribute($context["role"], "type", array()) == "__guest__")) {
                // line 204
                echo "\t\t\t\t\t\t\t\t\t\t\t\tdisabled=\"true\"
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 206
            echo "\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 211
        echo "\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
        // line 213
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Join groups")), "html", null, true);
        echo "</td>
\t\t\t\t\t\t";
        // line 214
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["roles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
            // line 215
            echo "\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" value=\"true\" name=\"join-groups\"
\t\t\t\t\t\t\t\t\t\t\t";
            // line 218
            if (($this->getAttribute($this->getAttribute($context["role"], "permissions", array()), "join-groups", array(), "array") == "true")) {
                // line 219
                echo "\t\t\t\t\t\t\t\t\t\t\t\tchecked=\"checked\"
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 221
            echo "\t\t\t\t\t\t\t\t\t\t\t";
            if (($this->getAttribute($context["role"], "type", array()) == "__guest__")) {
                // line 222
                echo "\t\t\t\t\t\t\t\t\t\t\t\tdisabled=\"true\"
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 224
            echo "\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 229
        echo "\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
        // line 231
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Read groups")), "html", null, true);
        echo "</td>
\t\t\t\t\t\t";
        // line 232
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["roles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
            // line 233
            echo "\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" value=\"true\" name=\"read-groups\"
\t\t\t\t\t\t\t\t\t\t\t";
            // line 236
            if (($this->getAttribute($this->getAttribute($context["role"], "permissions", array()), "read-groups", array(), "array") == "true")) {
                // line 237
                echo "\t\t\t\t\t\t\t\t\t\t\t\tchecked=\"checked\"
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 239
            echo "\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 244
        echo "\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
        // line 246
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Block groups")), "html", null, true);
        echo "</td>
\t\t\t\t\t\t";
        // line 247
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["roles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
            // line 248
            echo "\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" value=\"true\" name=\"can-block-groups\"
\t\t\t\t\t\t\t\t\t\t\t";
            // line 251
            if (($this->getAttribute($this->getAttribute($context["role"], "permissions", array()), "can-block-groups", array(), "array") == "true")) {
                // line 252
                echo "\t\t\t\t\t\t\t\t\t\t\t\tchecked=\"checked\"
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 254
            echo "\t\t\t\t\t\t\t\t\t\t\t";
            if (($this->getAttribute($context["role"], "type", array()) == "__guest__")) {
                // line 255
                echo "\t\t\t\t\t\t\t\t\t\t\t\tdisabled=\"true\"
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 257
            echo "\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 262
        echo "\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td><b>";
        // line 264
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Messages")), "html", null, true);
        echo "</b></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
        // line 267
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Send and receive messages")), "html", null, true);
        echo "</td>
\t\t\t\t\t\t";
        // line 268
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["roles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
            // line 269
            echo "\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" value=\"true\" name=\"send-and-receive-messages\"
\t\t\t\t\t\t\t\t\t\t\t";
            // line 272
            if (($this->getAttribute($this->getAttribute($context["role"], "permissions", array()), "send-and-receive-messages", array(), "array") == "true")) {
                // line 273
                echo "\t\t\t\t\t\t\t\t\t\t\t\tchecked=\"checked\"
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 275
            echo "\t\t\t\t\t\t\t\t\t\t\t";
            if (($this->getAttribute($context["role"], "type", array()) == "__guest__")) {
                // line 276
                echo "\t\t\t\t\t\t\t\t\t\t\t\tdisabled=\"true\"
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 278
            echo "\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 283
        echo "\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td><b>";
        // line 285
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Access to specific pages")), "html", null, true);
        echo "</b></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
        // line 288
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Members page")), "html", null, true);
        echo "</td>
\t\t\t\t\t\t";
        // line 289
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["roles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
            // line 290
            echo "\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" value=\"true\" name=\"access-to-members-page\"
\t\t\t\t\t\t\t\t\t\t\t";
            // line 293
            if (($this->getAttribute($this->getAttribute($context["role"], "permissions", array()), "access-to-members-page", array(), "array") == "true")) {
                // line 294
                echo "\t\t\t\t\t\t\t\t\t\t\t\tchecked=\"checked\"
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 296
            echo "\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 301
        echo "\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
        // line 303
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Global activity page")), "html", null, true);
        echo "</td>
\t\t\t\t\t\t";
        // line 304
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["roles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
            // line 305
            echo "\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" value=\"true\" name=\"access-to-global-activity-page\"
\t\t\t\t\t\t\t\t\t\t\t";
            // line 308
            if (($this->getAttribute($this->getAttribute($context["role"], "permissions", array()), "access-to-global-activity-page", array(), "array") == "true")) {
                // line 309
                echo "\t\t\t\t\t\t\t\t\t\t\t\tchecked=\"checked\"
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 311
            echo "\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 316
        echo "\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
        // line 318
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Users profile activity page")), "html", null, true);
        echo "</td>
\t\t\t\t\t\t";
        // line 319
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["roles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
            // line 320
            echo "\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" value=\"true\" name=\"access-to-profile-activity-page\"
\t\t\t\t\t\t\t\t\t\t\t";
            // line 323
            if (($this->getAttribute($this->getAttribute($context["role"], "permissions", array()), "access-to-profile-activity-page", array(), "array") == "true")) {
                // line 324
                echo "\t\t\t\t\t\t\t\t\t\t\t\tchecked=\"checked\"
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 326
            echo "\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 331
        echo "\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td><b>";
        // line 333
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Social")), "html", null, true);
        echo "</b></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
        // line 336
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Add remove friends")), "html", null, true);
        echo "</td>
\t\t\t\t\t\t";
        // line 337
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["roles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
            // line 338
            echo "\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" value=\"true\" name=\"add-friends\"
\t\t\t\t\t\t\t\t\t\t\t";
            // line 341
            if (($this->getAttribute($this->getAttribute($context["role"], "permissions", array()), "add-friends", array(), "array") == "true")) {
                // line 342
                echo "\t\t\t\t\t\t\t\t\t\t\t\tchecked=\"checked\"
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 344
            echo "\t\t\t\t\t\t\t\t\t\t\t";
            if (($this->getAttribute($context["role"], "type", array()) == "__guest__")) {
                // line 345
                echo "\t\t\t\t\t\t\t\t\t\t\t\tdisabled=\"true\"
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 347
            echo "\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 352
        echo "\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
        // line 354
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Follow unfollow users")), "html", null, true);
        echo "</td>
\t\t\t\t\t\t";
        // line 355
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["roles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
            // line 356
            echo "\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" value=\"true\" name=\"follow\"
\t\t\t\t\t\t\t\t\t\t\t";
            // line 359
            if (($this->getAttribute($this->getAttribute($context["role"], "permissions", array()), "follow", array(), "array") == "true")) {
                // line 360
                echo "\t\t\t\t\t\t\t\t\t\t\t\tchecked=\"checked\"
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 362
            echo "\t\t\t\t\t\t\t\t\t\t\t";
            if (($this->getAttribute($context["role"], "type", array()) == "__guest__")) {
                // line 363
                echo "\t\t\t\t\t\t\t\t\t\t\t\tdisabled=\"true\"
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 365
            echo "\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 370
        echo "\t\t\t\t\t</tr>
\t\t\t\t</table>
\t\t\t</div>
\t\t\t
\t\t\t<div class=\"new-role-template\" style=\"display:none;\">
\t\t\t\t<div class=\"mp-option\">
\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t<div class=\"col-md-5\">
\t\t\t\t\t\t\t";
        // line 378
        echo $context["options"]->getlabel(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Role name")));
        echo "
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"col-md-7\">
\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t<input class=\"sc-input\" name=\"name\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t
\t\t\t<div class=\"remove-role-template\" style=\"display:none;\">
\t\t\t\t<div>";
        // line 390
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Are you sure you want to delete this role?")), "html", null, true);
        echo "</div>
\t\t\t</div>
\t\t</div>

\t\t<div class=\"sc-tab-content\" data-tab=\"groups\">
\t\t\t";
        // line 395
        if (($this->getAttribute($this->getAttribute(($context["baseSettings"] ?? null), "main", array(), "array"), "groups", array(), "array") == "true")) {
            // line 396
            echo "\t\t\t\t<div class=\"mp-options\">
\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t<div class=\"col-md-12\">

\t\t\t\t\t\t\t<div class=\"mp-option\" id=\"inviting-type\">
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-label inviting-type-label\">
\t\t\t\t\t\t\t\t\t\t\t<span title=\"";
            // line 404
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Who can invite")), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Who can invite")), "html", null, true);
            echo "</span>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-md-8\">
\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-controls\">
\t\t\t\t\t\t\t\t\t\t\t";
            // line 409
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["_types"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["radio"]) {
                // line 410
                echo "\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"sc-radio\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<input
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\ttype=\"radio\"
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tname=\"groups[";
                // line 413
                echo twig_escape_filter($this->env, $this->getAttribute($context["radio"], "name", array()), "html", null, true);
                echo "]\"
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tvalue=\"";
                // line 414
                echo twig_escape_filter($this->env, $this->getAttribute($context["radio"], "value", array()), "html", null, true);
                echo "\"
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                // line 415
                if ($this->getAttribute($context["radio"], "checked", array())) {
                    // line 416
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tchecked
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                }
                // line 418
                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
                // line 419
                echo twig_escape_filter($this->env, $this->getAttribute($context["radio"], "label", array()), "html", null, true);
                echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"sc-radio-state\"></div>
\t\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['radio'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 423
            echo "\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-select inviting-type-roles\">
\t\t\t\t\t\t\t\t\t\t\t<select class=\"sc-input\" name=\"groups[inviting-type-roles][]\" multiple>
\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 426
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["_roles"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                // line 427
                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "value", array()), "html", null, true);
                echo "\"
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                // line 428
                if ($this->getAttribute($context["option"], "selected", array())) {
                    // line 429
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tselected
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                }
                // line 431
                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                if ($this->getAttribute($context["option"], "disabled", array())) {
                    // line 432
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tdisabled
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                }
                // line 434
                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t>";
                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "title", array()), "html", null, true);
                echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 436
            echo "\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t<div class=\"mp-option\" id=\"roles-to-invite\">
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-label\">
\t\t\t\t\t\t\t\t\t\t\t<span title=\"";
            // line 446
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Who can be invited")), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Who can be invited")), "html", null, true);
            echo "</span>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-md-3\">
\t\t\t\t\t\t\t\t\t\t<select class=\"sc-input\" name=\"groups[roles-to-invite]\">
\t\t\t\t\t\t\t\t\t\t\t<option value=\"everyone\"
\t\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 452
            if (($this->getAttribute(($context["groupsSettings"] ?? null), "roles-to-invite", array(), "array") == "everyone")) {
                // line 453
                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\tselected
\t\t\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 455
            echo "\t\t\t\t\t\t\t\t\t\t\t>";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Everyone")), "html", null, true);
            echo "</option>
\t\t\t\t\t\t\t\t\t\t\t";
            // line 456
            if (($this->getAttribute($this->getAttribute(($context["baseSettings"] ?? null), "main", array(), "array"), "friends", array(), "array") == "true")) {
                // line 457
                echo "\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"friends-only\"
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                // line 458
                if (($this->getAttribute(($context["groupsSettings"] ?? null), "roles-to-invite", array(), "array") == "friends-only")) {
                    // line 459
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tselected
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                }
                // line 461
                echo "\t\t\t\t\t\t\t\t\t\t\t\t>";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Friends only")), "html", null, true);
                echo "</option>
\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 463
            echo "\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t";
        } else {
            // line 471
            echo "\t\t\t\t<div>
\t\t\t\t\t<span>";
            // line 472
            echo sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Groups option is Turn Off, you can turn it On on the Main settings tab or click <a href=\"%s\">here</a>.")), ($context["mainSettingsLink"] ?? null));
            echo "</span>
\t\t\t\t</div>
\t\t\t";
        }
        // line 475
        echo "\t\t</div>
\t</div>

\t
";
    }

    public function getTemplateName()
    {
        return "@roles/backend/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1041 => 475,  1035 => 472,  1032 => 471,  1022 => 463,  1016 => 461,  1012 => 459,  1010 => 458,  1007 => 457,  1005 => 456,  1000 => 455,  996 => 453,  994 => 452,  983 => 446,  971 => 436,  962 => 434,  958 => 432,  955 => 431,  951 => 429,  949 => 428,  944 => 427,  940 => 426,  935 => 423,  925 => 419,  922 => 418,  918 => 416,  916 => 415,  912 => 414,  908 => 413,  903 => 410,  899 => 409,  889 => 404,  879 => 396,  877 => 395,  869 => 390,  854 => 378,  844 => 370,  834 => 365,  830 => 363,  827 => 362,  823 => 360,  821 => 359,  816 => 356,  812 => 355,  808 => 354,  804 => 352,  794 => 347,  790 => 345,  787 => 344,  783 => 342,  781 => 341,  776 => 338,  772 => 337,  768 => 336,  762 => 333,  758 => 331,  748 => 326,  744 => 324,  742 => 323,  737 => 320,  733 => 319,  729 => 318,  725 => 316,  715 => 311,  711 => 309,  709 => 308,  704 => 305,  700 => 304,  696 => 303,  692 => 301,  682 => 296,  678 => 294,  676 => 293,  671 => 290,  667 => 289,  663 => 288,  657 => 285,  653 => 283,  643 => 278,  639 => 276,  636 => 275,  632 => 273,  630 => 272,  625 => 269,  621 => 268,  617 => 267,  611 => 264,  607 => 262,  597 => 257,  593 => 255,  590 => 254,  586 => 252,  584 => 251,  579 => 248,  575 => 247,  571 => 246,  567 => 244,  557 => 239,  553 => 237,  551 => 236,  546 => 233,  542 => 232,  538 => 231,  534 => 229,  524 => 224,  520 => 222,  517 => 221,  513 => 219,  511 => 218,  506 => 215,  502 => 214,  498 => 213,  494 => 211,  484 => 206,  480 => 204,  477 => 203,  473 => 201,  471 => 200,  466 => 197,  462 => 196,  458 => 195,  452 => 192,  448 => 190,  440 => 187,  438 => 185,  437 => 182,  436 => 181,  435 => 180,  432 => 179,  428 => 178,  424 => 177,  420 => 175,  410 => 170,  406 => 168,  403 => 167,  399 => 165,  397 => 164,  392 => 161,  388 => 160,  384 => 159,  380 => 157,  372 => 154,  363 => 152,  359 => 150,  357 => 149,  352 => 148,  348 => 147,  344 => 146,  340 => 144,  336 => 143,  332 => 142,  328 => 140,  318 => 135,  314 => 133,  311 => 132,  307 => 130,  305 => 129,  300 => 126,  296 => 125,  292 => 124,  286 => 121,  282 => 119,  272 => 114,  268 => 112,  265 => 111,  261 => 109,  259 => 108,  254 => 105,  250 => 104,  246 => 103,  240 => 100,  236 => 98,  226 => 93,  222 => 91,  219 => 90,  215 => 88,  213 => 87,  208 => 84,  204 => 83,  200 => 82,  196 => 80,  186 => 75,  182 => 73,  179 => 72,  175 => 70,  173 => 69,  168 => 66,  164 => 65,  160 => 64,  154 => 61,  150 => 59,  142 => 56,  136 => 52,  134 => 51,  130 => 50,  124 => 48,  120 => 47,  116 => 46,  109 => 42,  104 => 39,  98 => 38,  95 => 37,  93 => 35,  92 => 34,  90 => 33,  87 => 32,  83 => 31,  80 => 30,  77 => 26,  74 => 25,  66 => 20,  59 => 16,  53 => 13,  49 => 11,  46 => 10,  39 => 6,  36 => 5,  33 => 4,  29 => 1,  27 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@roles/backend/index.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Roles\\views\\backend\\index.twig");
    }
}
