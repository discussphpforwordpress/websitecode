<?php

/* @membership/backend/index.twig */
class __TwigTemplate_807f471164034e7151c8ccb7a278947709a42c32d222c6b77a7f2e025972f5b7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@base/layouts/backend.twig", "@membership/backend/index.twig", 1);
        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'mainHeader' => array($this, 'block_mainHeader'),
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
        $context["options"] = $this->loadTemplate("@base/macros/options.twig", "@membership/backend/index.twig", 2);
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_head($context, array $blocks = array())
    {
        // line 5
        echo "\t<div class=\"sc-tabs\">
\t\t<a href=\"#\" class=\"tab active\" data-target=\"main\">
\t\t\t<i class=\"fa fa-cog\"></i>";
        // line 7
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Main")), "html", null, true);
        echo "
\t\t</a>
\t\t<a href=\"#\" class=\"tab\" data-target=\"pages\">
\t\t\t<i class=\"fa fa-file-text-o\"></i>";
        // line 10
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Pages")), "html", null, true);
        echo "
\t\t</a>
\t\t<a href=\"#\" class=\"tab\" data-target=\"security\">
\t\t\t<i class=\"fa fa-lock\"></i>";
        // line 13
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Security")), "html", null, true);
        echo "
\t\t</a>
\t\t<a href=\"#\" class=\"tab\" data-target=\"uploads\">
\t\t\t<i class=\"fa fa-upload\"></i>";
        // line 16
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Uploads")), "html", null, true);
        echo "
\t\t</a>
\t\t<a href=\"#\" class=\"tab\" data-target=\"seo\">
\t\t\t<i class=\"fa fa-search\"></i>";
        // line 19
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("SEO")), "html", null, true);
        echo "
\t\t</a>
\t\t<a href=\"#\" class=\"tab\" data-target=\"import\">
\t\t\t<i class=\"fa fa-download\"></i>";
        // line 22
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Import Data")), "html", null, true);
        echo "
\t\t</a>
\t\t<a href=\"#\" class=\"tab\" data-target=\"groups\">
\t\t\t<i class=\"fa fa-object-group\"></i> ";
        // line 25
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Groups")), "html", null, true);
        echo "
\t\t</a>
\t\t<a href=\"#\" class=\"tab\" data-target=\"reports\">
\t\t\t<i class=\"fa fa-flag\"></i>";
        // line 28
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Reports")), "html", null, true);
        echo "
\t\t</a>
        ";
        // line 30
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "backendSettingsMainContentTab"), "method"), "html", null, true);
        echo "

\t\t<button data-save-settings class=\"save-settings sc-button icon-button primary\">
\t\t\t<i class=\"fa fa-save\"></i>
\t\t\t<span>";
        // line 34
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Save Settings")), "html", null, true);
        echo "</span>
\t\t</button>
\t</div>
";
    }

    // line 39
    public function block_mainHeader($context, array $blocks = array())
    {
        // line 40
        echo "\t<div class=\"sc-header\">
\t\t<h2>";
        // line 41
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Main")), "html", null, true);
        echo "</h2>
\t</div>
";
    }

    // line 45
    public function block_main($context, array $blocks = array())
    {
        // line 46
        echo "
\t<div class=\"sc-tab-content active\" data-tab=\"main\">
\t\t<div class=\"mp-options\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-md-12\">

\t\t\t\t\t";
        // line 52
        echo $context["options"]->getemailRowWithButton(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Admin Email")),         // line 54
$context["options"]->getbutton(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Send Test Email")), "admin-email-button", "tooltip"), "main[admin-email]", $this->getAttribute($this->getAttribute(        // line 60
($context["settings"] ?? null), "main", array()), "admin-email", array(), "array"), "admin-email", null, null, array("mbsThinCol" => 1));
        // line 63
        echo "

\t\t\t\t\t";
        // line 65
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Messages")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "main[messages]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 71
($context["settings"] ?? null), "main", array()), "messages", array()) == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "main[messages]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 77
($context["settings"] ?? null), "main", array()), "messages", array()) == "false"))), "messages", null, null, array("mbsThinCol" => 1));
        // line 81
        echo "

\t\t\t\t\t";
        // line 83
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Groups")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "main[groups]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 89
($context["settings"] ?? null), "main", array()), "groups", array()) == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "main[groups]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 95
($context["settings"] ?? null), "main", array()), "groups", array()) == "false"))), "groups", null, null, array("mbsThinCol" => 1));
        // line 99
        echo "

\t\t\t\t\t";
        // line 101
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Friends")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "main[friends]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 107
($context["settings"] ?? null), "main", array()), "friends", array()) == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "main[friends]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 113
($context["settings"] ?? null), "main", array()), "friends", array()) == "false"))), "friends", null, null, array("mbsThinCol" => 1));
        // line 117
        echo "

\t\t\t\t\t";
        // line 119
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Activity")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "main[activity]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 125
($context["settings"] ?? null), "main", array()), "activity", array()) == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "main[activity]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 131
($context["settings"] ?? null), "main", array()), "activity", array()) == "false"))), "activity", null, null, array("mbsThinCol" => 1));
        // line 135
        echo "

\t\t\t\t\t";
        // line 137
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Followers")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "main[followers]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 143
($context["settings"] ?? null), "main", array()), "followers", array()) == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "main[followers]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 149
($context["settings"] ?? null), "main", array()), "followers", array()) == "false"))), "followers", null, null, array("mbsThinCol" => 1));
        // line 153
        echo "

\t\t\t\t\t ";
        // line 155
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Favorites")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "main[favorites]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 161
($context["settings"] ?? null), "main", array()), "favorites", array()) == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "main[favorites]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 167
($context["settings"] ?? null), "main", array()), "favorites", array()) == "false"))), "favorites", null, null, array("mbsThinCol" => 1));
        // line 171
        echo "

                    ";
        // line 173
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Posts")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "main[posts]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 179
($context["settings"] ?? null), "main", array()), "posts", array()) == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "main[posts]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 185
($context["settings"] ?? null), "main", array()), "posts", array()) == "false"))), "posts", null, null, array("mbsThinCol" => 1));
        // line 189
        echo "

                    ";
        // line 191
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Comments")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "main[comments]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 197
($context["settings"] ?? null), "main", array()), "comments", array()) == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "main[comments]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 203
($context["settings"] ?? null), "main", array()), "comments", array()) == "false"))), "comments", null, null, array("mbsThinCol" => 1));
        // line 207
        echo "

                    ";
        // line 209
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "adminMainSettingsOptions"), "method"), "html", null, true);
        echo "

\t\t\t\t\t";
        // line 211
        echo $context["options"]->getradioRowWithInput(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Redirect after registration to")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Profile")), "name" => "main[after-registration-action]", "value" => "redirect-to-profile", "checked" => ($this->getAttribute($this->getAttribute(        // line 217
($context["settings"] ?? null), "main", array()), "after-registration-action", array(), "array") == "redirect-to-profile")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("URL")), "name" => "main[after-registration-action]", "value" => "redirect-to-url", "checked" => ($this->getAttribute($this->getAttribute(        // line 223
($context["settings"] ?? null), "main", array()), "after-registration-action", array(), "array") == "redirect-to-url"))), "after-registration-action", "",         // line 227
$context["options"]->gettextInput("main[after-registration-redirect-url]", $this->getAttribute($this->getAttribute(        // line 229
($context["settings"] ?? null), "main", array()), "after-registration-redirect-url", array(), "array")), null, array("mbsThinCol" => 1));
        // line 232
        echo "

\t\t\t\t\t";
        // line 234
        echo $context["options"]->getradioRowWithInput(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Redirect after login to")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Profile")), "name" => "main[after-login-action]", "value" => "redirect-to-profile", "checked" => ($this->getAttribute($this->getAttribute(        // line 240
($context["settings"] ?? null), "main", array()), "after-login-action", array(), "array") == "redirect-to-profile")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("URL")), "name" => "main[after-login-action]", "value" => "redirect-to-url", "checked" => ($this->getAttribute($this->getAttribute(        // line 246
($context["settings"] ?? null), "main", array()), "after-login-action", array(), "array") == "redirect-to-url"))), "after-login-action", "",         // line 250
$context["options"]->gettextInput("main[after-login-action-redirect-url]", $this->getAttribute($this->getAttribute(        // line 252
($context["settings"] ?? null), "main", array()), "after-login-action-redirect-url", array(), "array")), null, array("mbsThinCol" => 1));
        // line 255
        echo "

\t\t\t\t\t";
        // line 257
        echo $context["options"]->getradioRowWithInput(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Redirect after logout to")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Main")), "name" => "main[after-logout-action]", "value" => "redirect-to-main", "checked" => ($this->getAttribute($this->getAttribute(        // line 263
($context["settings"] ?? null), "main", array()), "after-logout-action", array(), "array") == "redirect-to-main")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("URL")), "name" => "main[after-logout-action]", "value" => "redirect-to-url", "checked" => ($this->getAttribute($this->getAttribute(        // line 269
($context["settings"] ?? null), "main", array()), "after-logout-action", array(), "array") == "redirect-to-url"))), "after-logout-action", "",         // line 273
$context["options"]->gettextInput("main[after-logout-action-redirect-url]", $this->getAttribute($this->getAttribute(        // line 275
($context["settings"] ?? null), "main", array()), "after-logout-action-redirect-url", array(), "array")), null, array("mbsThinCol" => 1));
        // line 278
        echo "

\t\t\t\t\t";
        // line 280
        echo $context["options"]->getradioRowWithInput(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Redirect after account is deleted to")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Main")), "name" => "main[after-delete-account-action]", "value" => "redirect-to-main", "checked" => ($this->getAttribute($this->getAttribute(        // line 286
($context["settings"] ?? null), "main", array()), "after-delete-account-action", array(), "array") == "redirect-to-main")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("URL")), "name" => "main[after-delete-account-action]", "value" => "redirect-to-url", "checked" => ($this->getAttribute($this->getAttribute(        // line 292
($context["settings"] ?? null), "main", array()), "after-delete-account-action", array(), "array") == "redirect-to-url"))), "after-delete-account-action", "",         // line 296
$context["options"]->gettextInput("main[after-delete-account-action-redirect-url]", $this->getAttribute($this->getAttribute(        // line 298
($context["settings"] ?? null), "main", array()), "after-delete-account-action-redirect-url", array(), "array")), null, array("mbsThinCol" => 1));
        // line 301
        echo "

\t\t\t\t\t";
        // line 303
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Badges")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "main[badges]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 309
($context["settings"] ?? null), "main", array()), "badges", array()) == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "main[badges]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 315
($context["settings"] ?? null), "main", array()), "badges", array()) == "false"))), "badges", null, null, array("mbsThinCol" => 1));
        // line 319
        echo "

\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
    <div class=\"sc-tab-content\" data-tab=\"pages\">
        <div class=\"mp-action-panel\">
            <button class=\"create-pages sc-button icon-button primary\">
                <i class=\"fa fa-plus\"></i>
                <span>";
        // line 329
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Create all unassigned pages")), "html", null, true);
        echo "</span>
            </button>
            <button class=\"save-pages sc-button icon-button primary\">
                <i class=\"fa fa-save\"></i>
                <span>";
        // line 333
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Save Pages")), "html", null, true);
        echo "</span>
            </button>
        </div>
        <div class=\"mp-options\">
            <div class=\"row\">
                <div class=\"col-md-12\">
                    ";
        // line 339
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["pages"] ?? null));
        foreach ($context['_seq'] as $context["slug"] => $context["page"]) {
            // line 340
            echo "\t\t\t\t\t\t";
            if (($context["slug"] == "contact_form")) {
                // line 341
                echo "\t\t\t\t\t\t\t";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "backendSettingsMainPagesTab", 1 => array(0 => $this->getAttribute(($context["settings"] ?? null), "pages", array()))), "method"), "html", null, true);
                echo "
\t\t\t\t\t\t";
            } else {
                // line 343
                echo "\t\t\t\t\t\t\t<div class=\"mp-option mp-page-option\" data-page-slug=\"";
                echo twig_escape_filter($this->env, $context["slug"], "html", null, true);
                echo "\">
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-label\">
\t\t\t\t\t\t\t\t\t\t\t<span title=\"";
                // line 347
                echo twig_escape_filter($this->env, $this->getAttribute($context["page"], "title", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["page"], "title", array()), "html", null, true);
                echo "</span>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-md-8\">
\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input-with-button\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-button\" ";
                // line 352
                if ($this->getAttribute($context["page"], "id", array())) {
                    echo "style=\"display: none\"";
                }
                echo ">
\t\t\t\t\t\t\t\t\t\t\t\t<button class=\"sc-button icon-button create-page-button primary\" data-page-slug=\"";
                // line 353
                echo twig_escape_filter($this->env, $context["slug"], "html", null, true);
                echo "\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-plus\"></i>
\t\t\t\t\t\t\t\t\t\t\t\t\t<span>";
                // line 355
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Create page")), "html", null, true);
                echo "</span>
\t\t\t\t\t\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-select\">
\t\t\t\t\t\t\t\t\t\t\t\t";
                // line 359
                echo $this->env->getExtension('Membership_Base_Twig')->callFunction("wp_dropdown_pages", array("name" => (("pages[" . $context["slug"]) . "]"), "selected" => $this->getAttribute($context["page"], "id", array()), "class" => "sc-input wp-pages-list", "echo" => false, "show_option_none" => "Select Page", "option_none_value" => "__none"));
                echo "
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t";
            }
            // line 366
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['slug'], $context['page'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 367
        echo "
                </div>
            </div>
        </div>

    </div>
\t<div class=\"sc-tab-content\" data-tab=\"security\">
\t\t<div class=\"mp-options\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-md-12\">

\t\t\t\t\t";
        // line 378
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Global Site Access")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Site Accessible to Everyone")), "name" => "security[global-site-access]", "value" => "everyone", "checked" => ($this->getAttribute($this->getAttribute(        // line 383
($context["settings"] ?? null), "security", array()), "global-site-access", array(), "array") == "everyone")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Site Accessible to Logged In Users")), "name" => "security[global-site-access]", "value" => "logged-in-users", "checked" => ($this->getAttribute($this->getAttribute(        // line 389
($context["settings"] ?? null), "security", array()), "global-site-access", array(), "array") == "logged-in-users"))), "global-site-access", null, null, array("mbsThinCol" => 1));
        // line 393
        echo "

                    ";
        // line 395
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Protect all Pages")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "security[protect-all-pages]", "value" => "yes", "checked" => ($this->getAttribute($this->getAttribute(        // line 400
($context["settings"] ?? null), "security", array()), "protect-all-pages", array(), "array") == "yes")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "security[protect-all-pages]", "value" => "no", "checked" => ($this->getAttribute($this->getAttribute(        // line 406
($context["settings"] ?? null), "security", array()), "protect-all-pages", array(), "array") == "no"))), "protect-all-pages", null, null, array("mbsThinCol" => 1));
        // line 410
        echo "

\t\t\t\t\t";
        // line 412
        echo $context["options"]->getrow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Redirect from backend login screen to membership login page")),         // line 413
$context["options"]->getradioInput(array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "security[backend-login-screen-redirect]", "value" => "yes", "checked" => ($this->getAttribute($this->getAttribute(        // line 417
($context["settings"] ?? null), "security", array()), "backend-login-screen-redirect", array(), "array") == "yes")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "security[backend-login-screen-redirect]", "value" => "no", "checked" => ($this->getAttribute($this->getAttribute(        // line 423
($context["settings"] ?? null), "security", array()), "backend-login-screen-redirect", array(), "array") == "no")))), "backend-login-screen-redirect", null, null, array("mbsThinCol" => 1));
        // line 427
        echo "

\t\t\t\t\t";
        // line 429
        echo $context["options"]->gettextareaRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Blocked IP Addresses")), "security[blocked-ip]", (($this->getAttribute($this->getAttribute(        // line 431
($context["settings"] ?? null), "security", array(), "any", false, true), "blocked-ip", array(), "array", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "security", array(), "any", false, true), "blocked-ip", array(), "array"), $this->getAttribute(($context["templates"] ?? null), "get", array(0 => "blocked-ip"), "method"))) : ($this->getAttribute(($context["templates"] ?? null), "get", array(0 => "blocked-ip"), "method"))), "blocked-ip", null, null, 6, null, array("mbsThinCol" => 1));
        // line 434
        echo "

\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
\t<div class=\"sc-tab-content\" data-tab=\"uploads\">
\t\t<div class=\"mp-options\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-md-12\">
\t\t\t\t\t<div class=\"mp-option\" id=\"max-image-size\">
\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t\t\t\t\t\t";
        // line 447
        echo $context["options"]->getlabel(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Maximum Image Size")));
        echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-8\">
\t\t\t\t\t\t\t\t<div class=\"mp-option-sizes-input\">
\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
        // line 452
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "uploads", array()), "max-image-size", array(), "array"), "width", array()), "html", null, true);
        echo "\" name=\"uploads[max-image-size][width]\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<span>x</span>
\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
        // line 456
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "uploads", array()), "max-image-size", array(), "array"), "height", array()), "html", null, true);
        echo "\" name=\"uploads[max-image-size][height]\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t<input type=\"hidden\"
\t\t\t\t\t\t\t   class=\"sc-input\"
\t\t\t\t\t\t\t   name=\"uploads[max-file-size]\"
\t\t\t\t\t\t\t   value=\"";
        // line 467
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["settings"] ?? null), "uploads", array()), "max-file-size", array(), "array"), "html", null, true);
        echo "\"
\t\t\t\t\t\t\t   max=\"";
        // line 468
        echo twig_escape_filter($this->env, ($context["maxFileUpload"] ?? null), "html", null, true);
        echo "\"
\t\t\t\t\t\t>
\t\t\t\t\t</div>

\t\t\t\t\t";
        // line 472
        echo $context["options"]->getinputRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Maximum File Size (Mb)")), "uploads[max-file-size-mb]", ($this->getAttribute($this->getAttribute(        // line 475
($context["settings"] ?? null), "uploads", array()), "max-file-size", array(), "array") / (1024 * 1024)), "max-file-size-mb", "", (("max=\"" . (        // line 478
($context["maxFileUpload"] ?? null) / (1024 * 1024))) . "\""), array("mbsThinCol" => 1));
        // line 480
        echo "
\t\t\t\t\t<div class=\"col-md-4 mbsThinCol\" style=\"width: 315px!important;\">
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-md-8\">
\t\t\t\t\t\t<div class=\"mp-option-input-description\">
\t\t\t\t\t\t\t<div class=\"description\">
\t\t\t\t\t\t\t\t<span>";
        // line 486
        echo twig_escape_filter($this->env, sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Maximum available file upload size is %d Mb")), (($context["maxFileUpload"] ?? null) / (1024 * 1024))), "html", null, true);
        echo "</span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t\t";
        // line 491
        echo $context["options"]->getinputRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Image Quality")), "uploads[image-quality]", $this->getAttribute($this->getAttribute(        // line 493
($context["settings"] ?? null), "uploads", array()), "image-quality", array(), "array"), "image-quality", null, null, array("mbsThinCol" => 1));
        // line 496
        echo "

\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
\t<div class=\"sc-tab-content\" data-tab=\"seo\">
\t\t<div class=\"mp-options\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-md-12\">

\t\t\t\t\t";
        // line 507
        echo $context["options"]->getinputRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("User Profile Title")), "seo[profile-title]", $this->getAttribute($this->getAttribute(        // line 509
($context["settings"] ?? null), "seo", array()), "profile-title", array(), "array"), "profile-title", null, null, array("mbsThinCol" => 1));
        // line 512
        echo "

\t\t\t\t\t";
        // line 514
        echo $context["options"]->gettextareaRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("User Profile Dynamic Meta Description")), "seo[profile-description]", (($this->getAttribute($this->getAttribute(        // line 516
($context["settings"] ?? null), "seo", array(), "any", false, true), "profile-description", array(), "array", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "seo", array(), "any", false, true), "profile-description", array(), "array"), $this->getAttribute(($context["templates"] ?? null), "get", array(0 => "profile-description"), "method"))) : ($this->getAttribute(($context["templates"] ?? null), "get", array(0 => "profile-description"), "method"))), "profile-description", null, null, 6, null, array("mbsThinCol" => 1));
        // line 519
        echo "

\t\t\t\t\t";
        // line 521
        echo $context["options"]->getinputRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Group Title")), "seo[group-title]", $this->getAttribute($this->getAttribute(        // line 523
($context["settings"] ?? null), "seo", array()), "group-title", array(), "array"), "group-title", null, null, array("mbsThinCol" => 1));
        // line 526
        echo "

\t\t\t\t\t";
        // line 528
        echo $context["options"]->gettextareaRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Group Dynamic Meta Description")), "seo[group-description]", (($this->getAttribute($this->getAttribute(        // line 530
($context["settings"] ?? null), "seo", array(), "any", false, true), "group-description", array(), "array", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "seo", array(), "any", false, true), "group-description", array(), "array"), $this->getAttribute(($context["templates"] ?? null), "get", array(0 => "group-description"), "method"))) : ($this->getAttribute(($context["templates"] ?? null), "get", array(0 => "group-description"), "method"))), "group-description", null, null, 6, null, array("mbsThinCol" => 1));
        // line 533
        echo "

\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
\t<div class=\"sc-tab-content\" data-tab=\"import\">
\t\t<div class=\"mp-options\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-md-12\">
\t\t\t\t\t<h3>";
        // line 543
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Activity link image preview for Amazon")), "html", null, true);
        echo "</h3>
\t\t\t\t\t";
        // line 544
        echo $context["options"]->getselectInput2(array(0 => array("value" => 0, "title" => "Default"), 1 => array("value" => 1, "title" => "Extended1")), $this->getAttribute($this->getAttribute(        // line 549
($context["settings"] ?? null), "import", array(), "array"), "amazon-link-img-preview", array(), "array"), array("name" => "import[amazon-link-img-preview]", "class" => "sc-input mbs-act-link-img-preview"), 0);
        // line 555
        echo "
\t
\t\t\t\t\t";
        // line 557
        if (($context["isBuddyPressExists"] ?? null)) {
            // line 558
            echo "\t\t\t\t\t\t<h3 class=\"header\">BuddyPress</h3>
\t\t\t\t\t\t<div class=\"mp-option\">
\t\t\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"bp-fields\" value=\"true\" checked=\"checked\">
\t\t\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t<label for=\"bp-fields\">";
            // line 564
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Import User Fields")), "html", null, true);
            echo "</label>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"mp-option\">
\t\t\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"bp-groups\" value=\"true\" checked=\"checked\">
\t\t\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t<label for=\"bp-groups\">";
            // line 571
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Import Groups")), "html", null, true);
            echo "</label>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"mp-option\">
\t\t\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"bp-friends\" value=\"true\" checked=\"checked\">
\t\t\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t<label for=\"bp-friends\">";
            // line 578
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Import Friends")), "html", null, true);
            echo "</label>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"mp-option\">
\t\t\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"bp-activity\" value=\"true\" checked=\"checked\">
\t\t\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t<label for=\"bp-activity\">";
            // line 585
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Import Activity")), "html", null, true);
            echo "</label>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t
\t\t\t\t\t\t<div style=\"margin: 2em 0\">
\t\t\t\t\t\t\t<button class=\"import-buddy-press-data sc-button icon-button primary\">
\t\t\t\t\t\t\t\t<i class=\"fa fa-plus-circle\"></i>
\t\t\t\t\t\t\t\t<span>";
            // line 591
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Import Buddy Press Data")), "html", null, true);
            echo "</span>
\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t</div>
\t\t\t\t\t";
        }
        // line 595
        echo "\t\t\t\t\t
\t\t\t\t\t";
        // line 596
        if (($context["isUltimateMemberExists"] ?? null)) {
            // line 597
            echo "\t\t\t\t\t\t<h3 class=\"header\">Ultimate Member</h3>
\t\t\t\t\t\t<div class=\"mp-option\">
\t\t\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"um-fields\" value=\"true\" checked=\"checked\">
\t\t\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t<label for=\"bp-fields\">";
            // line 603
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Import User Fields")), "html", null, true);
            echo "</label>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t
\t\t\t\t\t\t<div style=\"margin: 2em 0\">
\t\t\t\t\t\t\t<button class=\"import-ultimate-member-data sc-button icon-button primary\">
\t\t\t\t\t\t\t\t<i class=\"fa fa-plus-circle\"></i>
\t\t\t\t\t\t\t\t<span>";
            // line 609
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Import Ultimate Member Data")), "html", null, true);
            echo "</span>
\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t</div>
\t\t\t\t\t";
        }
        // line 613
        echo "\t\t\t\t\t
\t\t\t\t\t";
        // line 614
        if (( !($context["isBuddyPressExists"] ?? null) &&  !($context["isUltimateMemberExists"] ?? null))) {
            // line 615
            echo "\t\t\t\t\t\t";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No supported plugins found. Currently we support:")), "html", null, true);
            echo " BuddyPress, Ultimate Member.
\t\t\t\t\t";
        }
        // line 617
        echo "
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
\t<div class=\"sc-tab-content\" data-tab=\"groups\">
\t\t<div class=\"mp-options\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-md-12\">
\t\t\t\t\t<h3>";
        // line 626
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Group Category List")), "html", null, true);
        echo "</h3>
\t\t\t\t\t<div class=\"mbsGroupCategoryWrapper\">
\t\t\t\t\t\t<label id=\"mbsGroupCategoryNameLabel\" for=\"mbsGroupCategoryName\">";
        // line 628
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Group category name:")), "html", null, true);
        echo "</label>
\t\t\t\t\t\t<input type=\"text\" value=\"\" id=\"mbsGroupCategoryName\" class=\"sc-input\"/>
\t\t\t\t\t\t<button id=\"mbsSaveNewGroupCategory\" class=\"sc-button icon-button primary\" data-add=\"";
        // line 630
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Add new")), "html", null, true);
        echo "\" data-update=\"";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Update")), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Add new")), "html", null, true);
        echo "</button>
\t\t\t\t\t\t<button id=\"mbsCancelNewGroupCategory\" class=\"sc-button icon-button primary\">";
        // line 631
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Cancel")), "html", null, true);
        echo "</button>
\t\t\t\t\t</div>
\t\t\t\t\t<table id=\"mbsGroupCategoryTbl\">
\t\t\t\t\t\t<body>
\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t<th>Id</th>
\t\t\t\t\t\t\t\t<th>Name</th>
\t\t\t\t\t\t\t\t<th></th>
\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t";
        // line 640
        if (twig_length_filter($this->env, ($context["groupCategoryList"] ?? null))) {
            // line 641
            echo "\t\t\t\t\t\t\t\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["groupCategoryList"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["oneGcItem"]) {
                // line 642
                echo "\t\t\t\t\t\t\t\t\t<tr id=\"mbsGcTblRow-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["oneGcItem"], "id", array(), "array"), "html", null, true);
                echo "\" data-id=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["oneGcItem"], "id", array(), "array"), "html", null, true);
                echo "\">
\t\t\t\t\t\t\t\t\t\t<td>";
                // line 643
                echo twig_escape_filter($this->env, $this->getAttribute($context["oneGcItem"], "id", array(), "array"), "html", null, true);
                echo "</td>
\t\t\t\t\t\t\t\t\t\t<td>";
                // line 644
                echo twig_escape_filter($this->env, $this->getAttribute($context["oneGcItem"], "name", array(), "array"), "html", null, true);
                echo "</td>
\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t<a href=\"#\" class=\"mbsGroupCategoryEdit\">";
                // line 646
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Edit")), "html", null, true);
                echo "</a>
\t\t\t\t\t\t\t\t\t\t\t<a href=\"#\" class=\"mbsGroupCategoryRemove\">";
                // line 647
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Remove")), "html", null, true);
                echo "</a>
\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['oneGcItem'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 651
            echo "\t\t\t\t\t\t\t";
        }
        // line 652
        echo "\t\t\t\t\t\t</body>
\t\t\t\t\t</table>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-md-12\">
\t\t\t\t\t<div class=\"mp-option\" id=\"admin-email\">
\t\t\t\t\t\t<h4>";
        // line 659
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Joined Groups tab")), "html", null, true);
        echo "</h4>
\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t\t\t\t\t\t<div class=\"mp-option-label\">
\t\t\t\t\t\t\t\t\t<span>";
        // line 663
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Sort Groups by")), "html", null, true);
        echo "</span>
\t\t\t\t\t\t\t\t\t<div class=\"mp-option-helper tooltip\">
\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-question sc-tooltip\"></i>
\t\t\t\t\t\t\t\t\t\t<div class=\"tooltip_content\">
\t\t\t\t\t\t\t\t\t\t\t<div>";
        // line 667
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Sorts in Descending order")), "html", null, true);
        echo "</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-8\">
\t\t\t\t\t\t\t\t";
        // line 674
        echo $context["options"]->getselectInput2(array(0 => array("value" => 0, "title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Id"))), 1 => array("value" => 1, "title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Recent Post")))), $this->getAttribute($this->getAttribute(        // line 679
($context["settings"] ?? null), "groups", array()), "joined-sort-order", array(), "array"), array("name" => "groups[joined-sort-order]", "class" => "sc-input", "style" => "width: 160px;"));
        // line 681
        echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<input type=\"hidden\" id=\"mbsMsgGroupCategoryRemove\" value=\"";
        // line 688
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Are you sure you want to delete this category?")), "html", null, true);
        echo "\"/>
\t\t<input type=\"hidden\" id=\"mbsMsgErrorOcured-1\" value=\"";
        // line 689
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Error Occurred!")), "html", null, true);
        echo "\"/>
\t\t<input type=\"hidden\" id=\"mbsMsgSavedSuccessfully\" value=\"";
        // line 690
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Record saved...")), "html", null, true);
        echo "\"/>
\t\t<input type=\"hidden\" id=\"mbsMsgUpdatedSuccessfully\" value=\"";
        // line 691
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Record updated...")), "html", null, true);
        echo "\"/>
\t\t<input type=\"hidden\" id=\"mbsMsgRemoveSuccessfully\" value=\"";
        // line 692
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Record removed...")), "html", null, true);
        echo "\"/>
\t\t<input type=\"hidden\" id=\"mbsTxtEdit\" value=\"";
        // line 693
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Edit")), "html", null, true);
        echo "\"/>
\t\t<input type=\"hidden\" id=\"mbsTxtRemove\" value=\"";
        // line 694
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Remove")), "html", null, true);
        echo "\"/>
\t</div>

\t<div class=\"sc-tab-content\" data-tab=\"reports\">
\t\t<div class=\"mp-options\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-md-12\">
\t\t\t\t\t<form class=\"mp-option\" id=\"search\" action=\"";
        // line 701
        echo twig_escape_filter($this->env, (($context["reportsUrl"] ?? null) . "#reports"), "html", null, true);
        echo "\" method=\"get\">
\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t<div class=\"col-md-2\">
\t\t\t\t\t\t\t\t";
        // line 704
        echo $context["options"]->getlabel(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Search")));
        echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t\t\t\t<div class=\"report-filter search\">
\t\t\t\t\t\t\t\t\t<input name=\"page\" type=\"hidden\" value=\"supsystic-membership\"/>
\t\t\t\t\t\t\t\t\t<input name=\"module\" type=\"hidden\" value=\"membership\"/>
\t\t\t\t\t\t\t\t\t<input name=\"order_by\" type=\"hidden\" value=\"";
        // line 710
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "get", array(0 => "order_by"), "method"), "html", null, true);
        echo "\"/>
\t\t\t\t\t\t\t\t\t<input name=\"order\" type=\"hidden\" value=\"";
        // line 711
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "get", array(0 => "order"), "method"), "html", null, true);
        echo "\"/>
\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" name=\"report_comment\" type=\"text\" value=\"";
        // line 712
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "get", array(0 => "report_comment"), "method"), "html", null, true);
        echo "\" id=\"mbsReportFindField\" />
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-2\">
\t\t\t\t\t\t\t\t<input type=\"submit\" class=\"sc-button primary\" value=\"";
        // line 716
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Search")), "html", null, true);
        echo "\"/>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</form>

\t\t\t\t\t";
        // line 721
        $context["reqTurnedOrder"] = ((($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "get", array(0 => "order"), "method") == "asc")) ? ("desc") : ("asc"));
        // line 722
        echo "\t\t\t\t\t";
        $context["reqOrderName"] = $this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "get", array(0 => "order_by"), "method");
        // line 723
        echo "\t\t\t\t\t";
        $context["report_comment"] = $this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "get", array(0 => "report_comment"), "method");
        // line 724
        echo "\t\t\t\t\t<table class=\"sc-table reports\" data-translate=\"";
        echo twig_escape_filter($this->env, twig_jsonencode_filter(array("Read" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Read")), "Unread" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Unread")), "Mark as read and close" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Mark as read and close")), "Mark as unread and close" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Mark as unread and close")), "Close" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Close")), "User is not found" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("User is not found")), "Activity is not found" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Activity is not found")))));
        // line 732
        echo "\">
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<th><a href=\"";
        // line 734
        echo twig_escape_filter($this->env, (((((($context["reportsUrl"] ?? null) . "&order_by=id&order=") . ($context["reqTurnedOrder"] ?? null)) . "&report_comment=") . ($context["report_comment"] ?? null)) . "#reports"), "html", null, true);
        echo "\" class=\"";
        if ((($context["reqOrderName"] ?? null) == "id")) {
            if (($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "get", array(0 => "order"), "method") == "desc")) {
                echo "mbsDescOrder";
            } else {
                echo "mbsAscOrder";
            }
        }
        echo "\">#</a></th>
\t\t\t\t\t\t\t<th><a href=\"";
        // line 735
        echo twig_escape_filter($this->env, (((((($context["reportsUrl"] ?? null) . "&order_by=content_type&order=") . ($context["reqTurnedOrder"] ?? null)) . "&report_comment=") . ($context["report_comment"] ?? null)) . "#reports"), "html", null, true);
        echo "\" class=\"";
        if ((($context["reqOrderName"] ?? null) == "content_type")) {
            if (($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "get", array(0 => "order"), "method") == "desc")) {
                echo "mbsDescOrder";
            } else {
                echo "mbsAscOrder";
            }
        }
        echo "\">";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Report type")), "html", null, true);
        echo "</a></th>
\t\t\t\t\t\t\t<th><a href=\"";
        // line 736
        echo twig_escape_filter($this->env, (((((($context["reportsUrl"] ?? null) . "&order_by=reporter_id&order=") . ($context["reqTurnedOrder"] ?? null)) . "&report_comment=") . ($context["report_comment"] ?? null)) . "#reports"), "html", null, true);
        echo "\" class=\"";
        if ((($context["reqOrderName"] ?? null) == "reporter_id")) {
            if (($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "get", array(0 => "order"), "method") == "desc")) {
                echo "mbsDescOrder";
            } else {
                echo "mbsAscOrder";
            }
        }
        echo "\">";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Reporter")), "html", null, true);
        echo "</a></th>
\t\t\t\t\t\t\t";
        // line 738
        echo "\t\t\t\t\t\t\t<th><a href=\"";
        echo twig_escape_filter($this->env, (((((($context["reportsUrl"] ?? null) . "&order_by=reported_id&order=") . ($context["reqTurnedOrder"] ?? null)) . "&report_comment=") . ($context["report_comment"] ?? null)) . "#reports"), "html", null, true);
        echo "\" class=\"";
        if ((($context["reqOrderName"] ?? null) == "reported_id")) {
            if (($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "get", array(0 => "order"), "method") == "desc")) {
                echo "mbsDescOrder";
            } else {
                echo "mbsAscOrder";
            }
        }
        echo "\">";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Reported")), "html", null, true);
        echo "</a></th>
\t\t\t\t\t\t\t<th>";
        // line 739
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Report Comment")), "html", null, true);
        echo "</th>
\t\t\t\t\t\t\t<th><a href=\"";
        // line 740
        echo twig_escape_filter($this->env, (((((($context["reportsUrl"] ?? null) . "&order_by=date&order=") . ($context["reqTurnedOrder"] ?? null)) . "&report_comment=") . ($context["report_comment"] ?? null)) . "#reports"), "html", null, true);
        echo "\" class=\"";
        if ((($context["reqOrderName"] ?? null) == "date")) {
            if (($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "get", array(0 => "order"), "method") == "desc")) {
                echo "mbsDescOrder";
            } else {
                echo "mbsAscOrder";
            }
        }
        echo "\">";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Report Date")), "html", null, true);
        echo "</a></th>
\t\t\t\t\t\t\t<th><a href=\"";
        // line 741
        echo twig_escape_filter($this->env, (((((($context["reportsUrl"] ?? null) . "&order_by=status&order=") . ($context["reqTurnedOrder"] ?? null)) . "&report_comment=") . ($context["report_comment"] ?? null)) . "#reports"), "html", null, true);
        echo "\" class=\"";
        if ((($context["reqOrderName"] ?? null) == "status")) {
            if (($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "get", array(0 => "order"), "method") == "desc")) {
                echo "mbsDescOrder";
            } else {
                echo "mbsAscOrder";
            }
        }
        echo "\">";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Report Status")), "html", null, true);
        echo "</a></th>
\t\t\t\t\t\t\t<th></th>
\t\t\t\t\t\t</tr>

\t\t\t\t\t\t";
        // line 745
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["reports"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["report"]) {
            // line 746
            echo "\t\t\t\t\t\t\t<tr class=\"report\"
\t\t\t\t\t\t\t\tdata-report-id=\"";
            // line 747
            echo twig_escape_filter($this->env, $this->getAttribute($context["report"], "id", array()), "html", null, true);
            echo "\"
\t\t\t\t\t\t\t\tdata-report=\"";
            // line 748
            echo twig_escape_filter($this->env, twig_jsonencode_filter($context["report"]), "html", null, true);
            echo "\"
\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t";
            // line 751
            echo twig_escape_filter($this->env, $this->getAttribute($context["report"], "id", array()), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t<div class=\"content-type\">
\t\t\t\t\t\t\t\t\t\t";
            // line 755
            if (($this->getAttribute($context["report"], "content_type", array()) == "activity")) {
                // line 756
                echo "\t\t\t\t\t\t\t\t\t\t\t";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Activity Report")), "html", null, true);
                echo "
\t\t\t\t\t\t\t\t\t\t";
            } elseif (($this->getAttribute(            // line 757
$context["report"], "content_type", array()) == "user")) {
                // line 758
                echo "\t\t\t\t\t\t\t\t\t\t\t";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("User Report")), "html", null, true);
                echo "
\t\t\t\t\t\t\t\t\t\t";
            }
            // line 760
            echo "\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t<div class=\"reporter\">
\t\t\t\t\t\t\t\t\t\t";
            // line 764
            if ($this->getAttribute($context["report"], "reporter", array())) {
                // line 765
                echo "\t\t\t\t\t\t\t\t\t\t\t<a target=\"_blank\" href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["report"], "reporter", array()), "url", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["report"], "reporter", array()), "displayName", array()), "html", null, true);
                echo "</a>
\t\t\t\t\t\t\t\t\t\t\t<a target=\"_blank\" href=\"";
                // line 766
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["report"], "reporter", array()), "editLink", array()), "html", null, true);
                echo "\"><small>(";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Edit profile")), "html", null, true);
                echo ")</small></a>
\t\t\t\t\t\t\t\t\t\t";
            } else {
                // line 768
                echo "\t\t\t\t\t\t\t\t\t\t\t";
                echo twig_escape_filter($this->env, sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("User with id %d is not found")), $this->getAttribute($context["report"], "reporter_id", array())), "html", null, true);
                echo "
\t\t\t\t\t\t\t\t\t\t";
            }
            // line 770
            echo "\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t";
            // line 773
            echo "\t\t\t\t\t\t\t\t";
            // line 774
            echo "\t\t\t\t\t\t\t\t";
            // line 775
            echo "\t\t\t\t\t\t\t\t";
            // line 776
            echo "\t\t\t\t\t\t\t\t";
            // line 777
            echo "\t\t\t\t\t\t\t\t";
            // line 778
            echo "\t\t\t\t\t\t\t\t";
            // line 779
            echo "\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t<div class=\"reported\">
\t\t\t\t\t\t\t\t\t\t";
            // line 781
            if (($this->getAttribute($context["report"], "content_type", array()) == "activity")) {
                // line 782
                echo "\t\t\t\t\t\t\t\t\t\t\t";
                if ($this->getAttribute($context["report"], "reported", array())) {
                    // line 783
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t<a target=\"_blank\" href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["report"], "reported", array()), "url", array()), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Link")), "html", null, true);
                    echo "</a>
\t\t\t\t\t\t\t\t\t\t\t";
                } else {
                    // line 785
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t";
                    echo twig_escape_filter($this->env, sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Activity with id %d is not found")), $this->getAttribute($context["report"], "reported_id", array())), "html", null, true);
                    echo "
\t\t\t\t\t\t\t\t\t\t\t";
                }
                // line 787
                echo "\t\t\t\t\t\t\t\t\t\t";
            } elseif (($this->getAttribute($context["report"], "content_type", array()) == "user")) {
                // line 788
                echo "\t\t\t\t\t\t\t\t\t\t\t";
                if ($this->getAttribute($context["report"], "reported", array())) {
                    // line 789
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t<a target=\"_blank\" href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->profileUrl($this->getAttribute($context["report"], "reported", array())), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["report"], "reported", array()), "displayName", array()), "html", null, true);
                    echo "</a>
\t\t\t\t\t\t\t\t\t\t\t\t<a target=\"_blank\" href=\"";
                    // line 790
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["report"], "reported", array()), "editLink", array()), "html", null, true);
                    echo "\"><small>(";
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Edit")), "html", null, true);
                    echo ")</small></a>
\t\t\t\t\t\t\t\t\t\t\t";
                } else {
                    // line 792
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t";
                    echo twig_escape_filter($this->env, sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("User with id %d is not found")), $this->getAttribute($context["report"], "reported_id", array())), "html", null, true);
                    echo "
\t\t\t\t\t\t\t\t\t\t\t";
                }
                // line 794
                echo "\t\t\t\t\t\t\t\t\t\t";
            }
            // line 795
            echo "\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t<div class=\"comment\">";
            // line 798
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Base_Twig')->truncate($this->getAttribute($context["report"], "comment", array()), 80), "html", null, true);
            echo "</div>
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t<div class=\"date\">";
            // line 801
            echo twig_escape_filter($this->env, $this->getAttribute($context["report"], "date", array()), "html", null, true);
            echo "</div>
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t<div class=\"status\">
\t\t\t\t\t\t\t\t\t\t";
            // line 805
            if (($this->getAttribute($context["report"], "status", array()) != "new")) {
                // line 806
                echo "\t\t\t\t\t\t\t\t\t\t\t";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Read")), "html", null, true);
                echo "
\t\t\t\t\t\t\t\t\t\t";
            } else {
                // line 808
                echo "\t\t\t\t\t\t\t\t\t\t\t";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Unread")), "html", null, true);
                echo "
\t\t\t\t\t\t\t\t\t\t";
            }
            // line 810
            echo "\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t<div class=\"info\">
\t\t\t\t\t\t\t\t\t\t<a href=\"#\" class=\"report-details\">";
            // line 814
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Details")), "html", null, true);
            echo "</a>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['report'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 819
        echo "\t\t\t\t\t</table>

\t\t\t\t\t<div class=\"sc-hidden user-report-details-template\">
\t\t\t\t\t\t";
        // line 822
        $this->loadTemplate("@reports/backend/partials/user-report-details.twig", "@membership/backend/index.twig", 822)->display($context);
        // line 823
        echo "\t\t\t\t\t</div>

\t\t\t\t\t<div class=\"sc-hidden activity-report-details-template\">
\t\t\t\t\t\t";
        // line 826
        $this->loadTemplate("@reports/backend/partials/activity-report-details.twig", "@membership/backend/index.twig", 826)->display($context);
        // line 827
        echo "\t\t\t\t\t</div>

\t\t\t\t\t<div class=\"mp-modal send-message-modal sc-hidden\">
\t\t\t\t\t\t<div class=\"mp-option\" id=\"message\">
\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t<div class=\"col-md-12\">
\t\t\t\t\t\t\t\t\t<input type=\"hidden\" class=\"user-id\" name=\"user-id\" value=\"\">
\t\t\t\t\t\t\t\t\t<div class=\"mp-option-label\">
\t\t\t\t\t\t\t\t\t\t<span>";
        // line 835
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Send message to: ")), "html", null, true);
        echo "</span> <span class=\"message-recipient\"></span>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t<textarea class=\"message-input\" class=\"sc-input\" name=\"\" cols=\"35\" rows=\"10\"></textarea>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"mp-result\">
\t\t\t\t\t\t\t\t\t\t<span id=\"message-result\"></span>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>

    ";
        // line 852
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "backendSettingsMainContentSettings"), "method"), "html", null, true);
        echo "
";
    }

    public function getTemplateName()
    {
        return "@membership/backend/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1146 => 852,  1126 => 835,  1116 => 827,  1114 => 826,  1109 => 823,  1107 => 822,  1102 => 819,  1091 => 814,  1085 => 810,  1079 => 808,  1073 => 806,  1071 => 805,  1064 => 801,  1058 => 798,  1053 => 795,  1050 => 794,  1044 => 792,  1037 => 790,  1030 => 789,  1027 => 788,  1024 => 787,  1018 => 785,  1010 => 783,  1007 => 782,  1005 => 781,  1001 => 779,  999 => 778,  997 => 777,  995 => 776,  993 => 775,  991 => 774,  989 => 773,  985 => 770,  979 => 768,  972 => 766,  965 => 765,  963 => 764,  957 => 760,  951 => 758,  949 => 757,  944 => 756,  942 => 755,  935 => 751,  929 => 748,  925 => 747,  922 => 746,  918 => 745,  901 => 741,  887 => 740,  883 => 739,  868 => 738,  854 => 736,  840 => 735,  828 => 734,  824 => 732,  821 => 724,  818 => 723,  815 => 722,  813 => 721,  805 => 716,  798 => 712,  794 => 711,  790 => 710,  781 => 704,  775 => 701,  765 => 694,  761 => 693,  757 => 692,  753 => 691,  749 => 690,  745 => 689,  741 => 688,  732 => 681,  730 => 679,  729 => 674,  719 => 667,  712 => 663,  705 => 659,  696 => 652,  693 => 651,  683 => 647,  679 => 646,  674 => 644,  670 => 643,  663 => 642,  658 => 641,  656 => 640,  644 => 631,  636 => 630,  631 => 628,  626 => 626,  615 => 617,  609 => 615,  607 => 614,  604 => 613,  597 => 609,  588 => 603,  580 => 597,  578 => 596,  575 => 595,  568 => 591,  559 => 585,  549 => 578,  539 => 571,  529 => 564,  521 => 558,  519 => 557,  515 => 555,  513 => 549,  512 => 544,  508 => 543,  496 => 533,  494 => 530,  493 => 528,  489 => 526,  487 => 523,  486 => 521,  482 => 519,  480 => 516,  479 => 514,  475 => 512,  473 => 509,  472 => 507,  459 => 496,  457 => 493,  456 => 491,  448 => 486,  440 => 480,  438 => 478,  437 => 475,  436 => 472,  429 => 468,  425 => 467,  411 => 456,  404 => 452,  396 => 447,  381 => 434,  379 => 431,  378 => 429,  374 => 427,  372 => 423,  371 => 417,  370 => 413,  369 => 412,  365 => 410,  363 => 406,  362 => 400,  361 => 395,  357 => 393,  355 => 389,  354 => 383,  353 => 378,  340 => 367,  334 => 366,  324 => 359,  317 => 355,  312 => 353,  306 => 352,  296 => 347,  288 => 343,  282 => 341,  279 => 340,  275 => 339,  266 => 333,  259 => 329,  247 => 319,  245 => 315,  244 => 309,  243 => 303,  239 => 301,  237 => 298,  236 => 296,  235 => 292,  234 => 286,  233 => 280,  229 => 278,  227 => 275,  226 => 273,  225 => 269,  224 => 263,  223 => 257,  219 => 255,  217 => 252,  216 => 250,  215 => 246,  214 => 240,  213 => 234,  209 => 232,  207 => 229,  206 => 227,  205 => 223,  204 => 217,  203 => 211,  198 => 209,  194 => 207,  192 => 203,  191 => 197,  190 => 191,  186 => 189,  184 => 185,  183 => 179,  182 => 173,  178 => 171,  176 => 167,  175 => 161,  174 => 155,  170 => 153,  168 => 149,  167 => 143,  166 => 137,  162 => 135,  160 => 131,  159 => 125,  158 => 119,  154 => 117,  152 => 113,  151 => 107,  150 => 101,  146 => 99,  144 => 95,  143 => 89,  142 => 83,  138 => 81,  136 => 77,  135 => 71,  134 => 65,  130 => 63,  128 => 60,  127 => 54,  126 => 52,  118 => 46,  115 => 45,  108 => 41,  105 => 40,  102 => 39,  94 => 34,  87 => 30,  82 => 28,  76 => 25,  70 => 22,  64 => 19,  58 => 16,  52 => 13,  46 => 10,  40 => 7,  36 => 5,  33 => 4,  29 => 1,  27 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@membership/backend/index.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Membership\\views\\backend\\index.twig");
    }
}
