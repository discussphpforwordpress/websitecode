<?php

/* @users/backend/users-list.twig */
class __TwigTemplate_09dadd6984203b440db241bbfdb0b3aef8b75aefd872a6c73df5ffd2eab96ebd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@base/layouts/backend.twig", "@users/backend/users-list.twig", 1);
        $this->blocks = array(
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
        $context["options"] = $this->loadTemplate("@base/macros/options.twig", "@users/backend/users-list.twig", 2);
        // line 3
        $context["tooltips"] = $this->loadTemplate("@base/macros/tooltips-templates.twig", "@users/backend/users-list.twig", 3);
        // line 4
        $context["pagination"] = $this->loadTemplate("@base/macros/pagination.twig", "@users/backend/users-list.twig", 4);
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 7
    public function block_head($context, array $blocks = array())
    {
        // line 8
        echo "
";
    }

    // line 11
    public function block_main($context, array $blocks = array())
    {
        // line 12
        echo "
\t";
        // line 13
        $context["f"] = $this;
        // line 14
        echo "\t<div class=\"sc-tabs-container\">
\t\t<div class=\"sc-tab-content active\" data-tab=\"users\">
\t\t\t<h2 class=\"sc-header\">";
        // line 16
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Users")), "html", null, true);
        echo "</h2>
\t\t\t<div class=\"mp-option\">
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t\t<input class=\"sc-input search-users-input\" type=\"text\" placeholder=\"";
        // line 20
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Search...")), "html", null, true);
        echo "\" value=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "search", array()), "html", null, true);
        echo "\">
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t\t<button class=\"sc-button primary search-button\">
\t\t\t\t\t\t\t<span>";
        // line 24
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Search")), "html", null, true);
        echo "</span>
\t\t\t\t\t\t</button>
\t\t\t\t\t\t<a href=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Base_Twig')->callFunction("admin_url", "user-new.php"), "html", null, true);
        echo "\" target=\"_blank\">
\t\t\t\t\t\t\t<button class=\"sc-button primary\">
\t\t\t\t\t\t\t\t<span>";
        // line 28
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Create user")), "html", null, true);
        echo "</span>
\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t</a>
\t\t\t\t\t\t<a href=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Base_Twig')->dashboardUrl("users", "importFromCsv"), "html", null, true);
        echo "#users\" target=\"_blank\">
\t\t\t\t\t\t\t<button class=\"sc-button primary\">
\t\t\t\t\t\t\t\t<span>";
        // line 33
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Import from csv")), "html", null, true);
        echo "</span>
\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t</a>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-md-2\">
\t\t\t\t\t<select class=\"bulk-actions\">
\t\t\t\t\t\t<option value=\"\">";
        // line 43
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Bulk Actions")), "html", null, true);
        echo "</option>
\t\t\t\t\t\t<option value=\"change-status\">";
        // line 44
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Change User Status")), "html", null, true);
        echo "</option>
\t\t\t\t\t\t<option value=\"change-role\">";
        // line 45
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Change User Role")), "html", null, true);
        echo "</option>
\t\t\t\t\t</select>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-md-2\">
\t\t\t\t\t<select class=\"bulk-actions-list roles-list\" style=\"display: none\">
\t\t\t\t\t\t";
        // line 50
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["roles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
            if (($this->getAttribute($context["role"], "type", array()) != "__guest__")) {
                // line 51
                echo "\t\t\t\t\t\t\t<option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["role"], "id", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["role"], "name", array()), "html", null, true);
                echo "</option>
\t\t\t\t\t\t";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 53
        echo "\t\t\t\t\t</select>
\t\t\t\t\t<select class=\"bulk-actions-list status-list\" style=\"display: none\">
\t\t\t\t\t\t";
        // line 55
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["userStatusesList"] ?? null));
        foreach ($context['_seq'] as $context["status"] => $context["statusTitle"]) {
            // line 56
            echo "\t\t\t\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, $context["status"], "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $context["statusTitle"], "html", null, true);
            echo "</option>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['status'], $context['statusTitle'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 58
        echo "\t\t\t\t\t</select>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-md-2\">
\t\t\t\t\t<button class=\"sc-button primary bulk-actions-apply-button\" style=\"display: none\">
\t\t\t\t\t\t<span>";
        // line 62
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Apply")), "html", null, true);
        echo "</span>
\t\t\t\t\t</button>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t
\t\t\t";
        // line 67
        if (($context["users"] ?? null)) {
            // line 68
            echo "\t\t\t\t";
            $context["requestQuery"] = $this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "all", array());
            // line 69
            echo "\t\t\t\t
\t\t\t\t<div class=\"users-table-wrap\">
\t\t\t\t\t<table class=\"sc-table users-table\">
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<th>
\t\t\t\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" class=\"select-all\">
\t\t\t\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</th>
\t\t\t\t\t\t\t<th>";
            // line 79
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Username")), "html", null, true);
            echo "</th>
\t\t\t\t\t\t\t<th>";
            // line 80
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Name")), "html", null, true);
            echo "</th>
\t\t\t\t\t\t\t<th>";
            // line 81
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Email")), "html", null, true);
            echo "</th>
\t\t\t\t\t\t\t<th>
\t\t\t\t\t\t\t\t";
            // line 83
            if (($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "sort", array()) == "user_registered")) {
                // line 84
                echo "\t\t\t\t\t\t\t\t\t";
                if (($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "order", array()) == "asc")) {
                    // line 85
                    echo "\t\t\t\t\t\t\t\t\t\t";
                    $context["icon"] = "<i class=\"fa fa-sort-asc\" aria-hidden=\"true\"></i>";
                    // line 86
                    echo "\t\t\t\t\t\t\t\t\t\t";
                    $context["requestQuery"] = twig_array_merge(($context["requestQuery"] ?? null), array("sort" => "user_registered", "order" => "desc"));
                    // line 87
                    echo "\t\t\t\t\t\t\t\t\t";
                } else {
                    // line 88
                    echo "\t\t\t\t\t\t\t\t\t\t";
                    $context["icon"] = "<i class=\"fa fa-sort-desc\" aria-hidden=\"true\"></i>";
                    // line 89
                    echo "\t\t\t\t\t\t\t\t\t\t";
                    $context["requestQuery"] = twig_array_merge(($context["requestQuery"] ?? null), array("sort" => "user_registered", "order" => "asc"));
                    // line 90
                    echo "\t\t\t\t\t\t\t\t\t";
                }
                // line 91
                echo "\t\t\t\t\t\t\t\t";
            } else {
                // line 92
                echo "\t\t\t\t\t\t\t\t\t";
                $context["requestQuery"] = twig_array_merge(($context["requestQuery"] ?? null), array("sort" => "user_registered", "order" => "asc"));
                // line 93
                echo "\t\t\t\t\t\t\t\t\t";
                if ($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "sort", array())) {
                    // line 94
                    echo "\t\t\t\t\t\t\t\t\t\t";
                    $context["icon"] = "<i class=\"fa fa-sort\" aria-hidden=\"true\"></i>";
                    // line 95
                    echo "\t\t\t\t\t\t\t\t\t";
                } else {
                    // line 96
                    echo "\t\t\t\t\t\t\t\t\t\t";
                    $context["icon"] = "<i class=\"fa fa-sort-desc\" aria-hidden=\"true\"></i>";
                    // line 97
                    echo "\t\t\t\t\t\t\t\t\t";
                }
                // line 98
                echo "\t\t\t\t\t\t\t\t";
            }
            // line 99
            echo "\t\t\t\t\t\t\t\t<a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Base_Twig')->dashboardUrl("roles", null, ($context["requestQuery"] ?? null)), "html", null, true);
            echo "#users\">
\t\t\t\t\t\t\t\t\t<span>";
            // line 100
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Registered")), "html", null, true);
            echo "</span> ";
            echo ($context["icon"] ?? null);
            echo "
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t
\t\t\t\t\t\t\t</th>
\t\t\t\t\t\t\t<th>
\t\t\t\t\t\t\t\t";
            // line 105
            if (($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "sort", array()) == "role")) {
                // line 106
                echo "\t\t\t\t\t\t\t\t\t";
                if (($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "order", array()) == "asc")) {
                    // line 107
                    echo "\t\t\t\t\t\t\t\t\t\t";
                    $context["icon"] = "<i class=\"fa fa-sort-asc\" aria-hidden=\"true\"></i>";
                    // line 108
                    echo "\t\t\t\t\t\t\t\t\t\t";
                    $context["requestQuery"] = twig_array_merge(($context["requestQuery"] ?? null), array("sort" => "role", "order" => "desc"));
                    // line 109
                    echo "\t\t\t\t\t\t\t\t\t";
                } else {
                    // line 110
                    echo "\t\t\t\t\t\t\t\t\t\t";
                    $context["icon"] = "<i class=\"fa fa-sort-desc\" aria-hidden=\"true\"></i>";
                    // line 111
                    echo "\t\t\t\t\t\t\t\t\t\t";
                    $context["requestQuery"] = twig_array_merge(($context["requestQuery"] ?? null), array("sort" => "role", "order" => "asc"));
                    // line 112
                    echo "\t\t\t\t\t\t\t\t\t";
                }
                // line 113
                echo "\t\t\t\t\t\t\t\t";
            } else {
                // line 114
                echo "\t\t\t\t\t\t\t\t\t";
                $context["requestQuery"] = twig_array_merge(($context["requestQuery"] ?? null), array("sort" => "role", "order" => "desc"));
                // line 115
                echo "\t\t\t\t\t\t\t\t\t";
                $context["icon"] = "<i class=\"fa fa-sort\" aria-hidden=\"true\"></i>";
                // line 116
                echo "\t\t\t\t\t\t\t\t";
            }
            // line 117
            echo "\t\t\t\t\t\t\t\t<a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Base_Twig')->dashboardUrl("roles", null, ($context["requestQuery"] ?? null)), "html", null, true);
            echo "#users\">
\t\t\t\t\t\t\t\t\t<span>";
            // line 118
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Membership Role")), "html", null, true);
            echo "</span> ";
            echo ($context["icon"] ?? null);
            echo "
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t</th>
\t\t\t\t\t\t\t<th>
\t\t\t\t\t\t\t\t";
            // line 122
            if (($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "sort", array()) == "status")) {
                // line 123
                echo "\t\t\t\t\t\t\t\t\t";
                if (($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "order", array()) == "asc")) {
                    // line 124
                    echo "\t\t\t\t\t\t\t\t\t\t";
                    $context["icon"] = "<i class=\"fa fa-sort-asc\" aria-hidden=\"true\"></i>";
                    // line 125
                    echo "\t\t\t\t\t\t\t\t\t\t";
                    $context["requestQuery"] = twig_array_merge(($context["requestQuery"] ?? null), array("sort" => "status", "order" => "desc"));
                    // line 126
                    echo "\t\t\t\t\t\t\t\t\t";
                } else {
                    // line 127
                    echo "\t\t\t\t\t\t\t\t\t\t";
                    $context["icon"] = "<i class=\"fa fa-sort-desc\" aria-hidden=\"true\"></i>";
                    // line 128
                    echo "\t\t\t\t\t\t\t\t\t\t";
                    $context["requestQuery"] = twig_array_merge(($context["requestQuery"] ?? null), array("sort" => "status", "order" => "asc"));
                    // line 129
                    echo "\t\t\t\t\t\t\t\t\t";
                }
                // line 130
                echo "\t\t\t\t\t\t\t\t";
            } else {
                // line 131
                echo "\t\t\t\t\t\t\t\t\t";
                $context["requestQuery"] = twig_array_merge(($context["requestQuery"] ?? null), array("sort" => "status", "order" => "desc"));
                // line 132
                echo "\t\t\t\t\t\t\t\t\t";
                $context["icon"] = "<i class=\"fa fa-sort\" aria-hidden=\"true\"></i>";
                // line 133
                echo "\t\t\t\t\t\t\t\t";
            }
            // line 134
            echo "\t\t\t\t\t\t\t\t<a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Base_Twig')->dashboardUrl("roles", null, ($context["requestQuery"] ?? null)), "html", null, true);
            echo "#users\">
\t\t\t\t\t\t\t\t\t<span>";
            // line 135
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Membership Status")), "html", null, true);
            echo "</span> ";
            echo ($context["icon"] ?? null);
            echo "
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t</th>
\t\t\t\t\t\t\t<th>";
            // line 138
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Last seen")), "html", null, true);
            echo "</th>
\t\t\t\t\t\t</tr>
\t\t\t\t\t\t";
            // line 140
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["users"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
                // line 141
                echo "\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"users[]\" value=\"";
                // line 144
                echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "id", array()), "html", null, true);
                echo "\" />
\t\t\t\t\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t<td><img class=\"avatar\" src=\"";
                // line 148
                echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->userAvatar($context["user"], "small"), "html", null, true);
                echo "\">
\t\t\t\t\t\t\t\t\t<a href=\"";
                // line 149
                echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->profileUrl($context["user"]), "html", null, true);
                echo "\" target=\"_blank\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "user_login", array()), "html", null, true);
                echo "</a></td>
\t\t\t\t\t\t\t\t<td>";
                // line 150
                echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "displayName", array()), "html", null, true);
                echo "</td>
\t\t\t\t\t\t\t\t<td>";
                // line 151
                echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "user_email", array()), "html", null, true);
                echo "</td>
\t\t\t\t\t\t\t\t<td class=\"registered\" title=\"";
                // line 152
                echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "user_registered", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "user_registered", array()), "html", null, true);
                echo "</td>
\t\t\t\t\t\t\t\t<td class=\"role\">";
                // line 153
                echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "roleName", array()), "html", null, true);
                echo "</td>
\t\t\t\t\t\t\t\t<td class=\"status\">";
                // line 154
                echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "userStatus", array()), "html", null, true);
                echo "</td>
\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t";
                // line 156
                if ($this->getAttribute($context["user"], "isOnline", array())) {
                    // line 157
                    echo "\t\t\t\t\t\t\t\t\t\t<b class=\"online\">";
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Online")), "html", null, true);
                    echo "</b>
\t\t\t\t\t\t\t\t\t";
                } else {
                    // line 159
                    echo "\t\t\t\t\t\t\t\t\t\t";
                    if ($this->getAttribute($context["user"], "lastSeen", array())) {
                        // line 160
                        echo "\t\t\t\t\t\t\t\t\t\t\t<span class=\"last-seen\" style=\"display: none\">";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "lastSeen", array()), "html", null, true);
                        echo "</span>
\t\t\t\t\t\t\t\t\t\t";
                    }
                    // line 162
                    echo "\t\t\t\t\t\t\t\t\t";
                }
                // line 163
                echo "\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 166
            echo "\t\t\t\t\t
\t\t\t\t\t</table>
\t\t\t\t</div>
\t\t\t";
        } else {
            // line 170
            echo "\t\t\t\t<div class=\"my3 text-center\">
\t\t\t\t\t<h4>";
            // line 171
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Nothing is found")), "html", null, true);
            echo "</h4>
\t\t\t\t</div>
\t\t\t";
        }
        // line 174
        echo "\t\t\t
\t\t\t
\t\t\t";
        // line 176
        if (($context["users"] ?? null)) {
            // line 177
            echo "\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t";
            // line 179
            echo $context["pagination"]->getcreate(array("page" => (($this->getAttribute($this->getAttribute(            // line 181
($context["request"] ?? null), "query", array()), "p", array())) ? ($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "p", array())) : ("1")), "totalPages" =>             // line 182
($context["totalPaginationPages"] ?? null), "hash" => "users"), array("search" => $this->getAttribute($this->getAttribute(            // line 186
($context["request"] ?? null), "query", array()), "search", array())));
            // line 188
            echo "
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-md-6 text-right\">
\t\t\t\t\t\t<span>";
            // line 191
            echo twig_escape_filter($this->env, sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Found %d users")), ($context["totalUsers"] ?? null)), "html", null, true);
            echo "</span>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t";
        }
        // line 195
        echo "\t\t
\t\t
\t\t
\t\t</div>
\t</div>

";
    }

    public function getTemplateName()
    {
        return "@users/backend/users-list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  485 => 195,  478 => 191,  473 => 188,  471 => 186,  470 => 182,  469 => 181,  468 => 179,  464 => 177,  462 => 176,  458 => 174,  452 => 171,  449 => 170,  443 => 166,  435 => 163,  432 => 162,  426 => 160,  423 => 159,  417 => 157,  415 => 156,  410 => 154,  406 => 153,  400 => 152,  396 => 151,  392 => 150,  386 => 149,  382 => 148,  375 => 144,  370 => 141,  366 => 140,  361 => 138,  353 => 135,  348 => 134,  345 => 133,  342 => 132,  339 => 131,  336 => 130,  333 => 129,  330 => 128,  327 => 127,  324 => 126,  321 => 125,  318 => 124,  315 => 123,  313 => 122,  304 => 118,  299 => 117,  296 => 116,  293 => 115,  290 => 114,  287 => 113,  284 => 112,  281 => 111,  278 => 110,  275 => 109,  272 => 108,  269 => 107,  266 => 106,  264 => 105,  254 => 100,  249 => 99,  246 => 98,  243 => 97,  240 => 96,  237 => 95,  234 => 94,  231 => 93,  228 => 92,  225 => 91,  222 => 90,  219 => 89,  216 => 88,  213 => 87,  210 => 86,  207 => 85,  204 => 84,  202 => 83,  197 => 81,  193 => 80,  189 => 79,  177 => 69,  174 => 68,  172 => 67,  164 => 62,  158 => 58,  147 => 56,  143 => 55,  139 => 53,  127 => 51,  122 => 50,  114 => 45,  110 => 44,  106 => 43,  93 => 33,  88 => 31,  82 => 28,  77 => 26,  72 => 24,  63 => 20,  56 => 16,  52 => 14,  50 => 13,  47 => 12,  44 => 11,  39 => 8,  36 => 7,  32 => 1,  30 => 4,  28 => 3,  26 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@users/backend/users-list.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Users\\views\\backend\\users-list.twig");
    }
}
