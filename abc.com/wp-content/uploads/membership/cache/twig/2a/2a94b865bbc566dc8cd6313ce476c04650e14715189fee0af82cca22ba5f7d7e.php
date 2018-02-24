<?php

/* @design/backend/index.twig */
class __TwigTemplate_7da93033abbf0d8d99b005e680aa5944aafeb42a63441a06000ee268bbc210a6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@base/layouts/backend.twig", "@design/backend/index.twig", 1);
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
        $context["options"] = $this->loadTemplate("@base/macros/options.twig", "@design/backend/index.twig", 2);
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_head($context, array $blocks = array())
    {
        // line 5
        echo "\t<div class=\"sc-tabs\">
\t\t<a href=\"#\" class=\"tab active\" data-target=\"general\">
\t\t\t<i class=\"fa fa-desktop\"></i>";
        // line 7
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("General")), "html", null, true);
        echo "
\t\t</a>
\t\t<a href=\"#\" class=\"tab\" data-target=\"menu\">
\t\t\t<i class=\"fa fa-bars\"></i>";
        // line 10
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Menu")), "html", null, true);
        echo "
\t\t</a>
\t\t<a href=\"#\" class=\"tab\" data-target=\"profile\">
\t\t\t<i class=\"fa fa-user\"></i>";
        // line 13
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("User Profile")), "html", null, true);
        echo "
\t\t</a>
\t\t<a href=\"#\" class=\"tab\" data-target=\"activity\">
\t\t\t<i class=\"fa fa-newspaper-o\"></i>";
        // line 16
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Activity")), "html", null, true);
        echo "
\t\t</a>
\t\t<a href=\"#\" class=\"tab\" data-target=\"auth\">
\t\t\t<i class=\"fa fa-user-plus\"></i>";
        // line 19
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Registration and Login")), "html", null, true);
        echo "
\t\t</a>
\t\t<a href=\"#\" class=\"tab\" data-target=\"members\">
\t\t\t<i class=\"fa fa-users\"></i>";
        // line 22
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Members Directory")), "html", null, true);
        echo "
\t\t</a>
\t\t<a href=\"#\" class=\"tab\" data-target=\"fonts\">
\t\t\t<i class=\"fa fa-font\"></i>";
        // line 25
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Fonts")), "html", null, true);
        echo "
\t\t</a>
\t\t<a href=\"#\" class=\"tab active\" data-target=\"groups\">
\t\t\t<i class=\"fa fa-object-group\"></i>";
        // line 28
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Groups")), "html", null, true);
        echo "
\t\t</a>
\t\t<button data-save-settings class=\"save-settings sc-button icon-button primary\">
\t\t\t<i class=\"fa fa-save\"></i>
\t\t\t<span>";
        // line 32
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Save Settings")), "html", null, true);
        echo "</span>
\t\t</button>
\t</div>
";
    }

    // line 37
    public function block_mainHeader($context, array $blocks = array())
    {
        // line 38
        echo "\t<div class=\"sc-header\">
\t\t<h2>";
        // line 39
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Design")), "html", null, true);
        echo "</h2>
\t</div>
";
    }

    // line 43
    public function block_main($context, array $blocks = array())
    {
        // line 44
        echo "
\t<div class=\"sc-tab-content active\" data-tab=\"general\">
\t\t<div class=\"mp-options\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-md-12\">
\t\t\t\t\t
\t\t\t\t\t<h3>";
        // line 50
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Main")), "html", null, true);
        echo "</h3>


\t\t\t\t\t";
        // line 53
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Profile Image Style")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Rounded Corners")), "name" => "general[avatar-style]", "value" => "round", "checked" => ($this->getAttribute($this->getAttribute(        // line 58
($context["settings"] ?? null), "general", array()), "avatar-style", array(), "array") == "round")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Circle")), "name" => "general[avatar-style]", "value" => "circle", "checked" => ($this->getAttribute($this->getAttribute(        // line 64
($context["settings"] ?? null), "general", array()), "avatar-style", array(), "array") == "circle")), 2 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Square")), "name" => "general[avatar-style]", "value" => "square", "checked" => ($this->getAttribute($this->getAttribute(        // line 70
($context["settings"] ?? null), "general", array()), "avatar-style", array(), "array") == "square"))), "avatar-style", null, null, array("mbsThinCol" => 1));
        // line 74
        echo "

\t\t\t\t\t";
        // line 76
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Use Default Theme Colors")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "general[default-theme-colors]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 81
($context["settings"] ?? null), "general", array()), "default-theme-colors", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "general[default-theme-colors]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 87
($context["settings"] ?? null), "general", array()), "default-theme-colors", array(), "array") == "false"))), "default-theme-colors", null, null, array("mbsThinCol" => 1));
        // line 91
        echo "

\t\t\t\t\t<h3>";
        // line 93
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Buttons")), "html", null, true);
        echo "</h3>

\t\t\t\t\t";
        // line 95
        echo $context["options"]->getcolorRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Primary Button Color")), "general[primary-button-color]", $this->getAttribute($this->getAttribute(        // line 97
($context["settings"] ?? null), "general", array()), "primary-button-color", array(), "array"), "primary-button-color", null, null, array("mbsThinCol" => 1));
        // line 100
        echo "

\t\t\t\t\t";
        // line 102
        echo $context["options"]->getcolorRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Primary Button Hover Color")), "general[primary-button-hover-color]", $this->getAttribute($this->getAttribute(        // line 104
($context["settings"] ?? null), "general", array()), "primary-button-hover-color", array(), "array"), "primary-button-hover-color", null, null, array("mbsThinCol" => 1));
        // line 107
        echo "
\t\t\t\t\t
\t\t\t\t\t";
        // line 109
        echo $context["options"]->getcolorRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Secondary Button Color")), "general[secondary-button-color]", $this->getAttribute($this->getAttribute(        // line 111
($context["settings"] ?? null), "general", array()), "secondary-button-color", array(), "array"), "secondary-button-color", null, null, array("mbsThinCol" => 1));
        // line 114
        echo "

\t\t\t\t\t";
        // line 116
        echo $context["options"]->getcolorRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Secondary Button Hover Color")), "general[secondary-button-hover-color]", $this->getAttribute($this->getAttribute(        // line 118
($context["settings"] ?? null), "general", array()), "secondary-button-hover-color", array(), "array"), "secondary-button-hover-color", null, null, array("mbsThinCol" => 1));
        // line 121
        echo "

\t\t\t\t\t";
        // line 123
        echo $context["options"]->getcolorRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Smile Button Background Color")), "general[smile-button-bg-color]", (($this->getAttribute($this->getAttribute(        // line 125
($context["settings"] ?? null), "general", array(), "any", false, true), "smile-button-bg-color", array(), "array", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "general", array(), "any", false, true), "smile-button-bg-color", array(), "array"), "#fff")) : ("#fff")), "smile-button-bg-color", null, null, array("mbsThinCol" => 1));
        // line 128
        echo "

\t\t\t\t\t";
        // line 130
        echo $context["options"]->getcolorRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Smile Button Hover Background Color")), "general[smile-button-hover-bg-color]", (($this->getAttribute($this->getAttribute(        // line 132
($context["settings"] ?? null), "general", array(), "any", false, true), "smile-button-hover-bg-color", array(), "array", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "general", array(), "any", false, true), "smile-button-hover-bg-color", array(), "array"), "#fff")) : ("#fff")), "smile-button-hover-bg-color", null, null, array("mbsThinCol" => 1));
        // line 135
        echo "

\t\t\t\t\t";
        // line 137
        echo $context["options"]->getsettingRowWithInput(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Smile button icon size")), null, "mbsSmileButtonSettRow", null, (        // line 142
$context["options"]->getinput("number", "general[smiles-button-icon-size-text-font-size-number]", (($this->getAttribute($this->getAttribute(        // line 145
($context["settings"] ?? null), "general", array(), "array", false, true), "smiles-button-icon-size-text-font-size-number", array(), "array", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "general", array(), "array", false, true), "smiles-button-icon-size-text-font-size-number", array(), "array"), 20)) : (20)), array("id" => "smiles-button-icon-size-text-font-size-number", "class" => "mbs-number-units-width", "pattern" => "[0-9]")) .         // line 147
$context["options"]->getselectInput2(array(0 => array("value" => "px", "title" => "px")), (($this->getAttribute($this->getAttribute(        // line 149
($context["settings"] ?? null), "general", array(), "array", false, true), "smiles-button-icon-size-text-font-unit-select", array(), "array", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "general", array(), "array", false, true), "smiles-button-icon-size-text-font-unit-select", array(), "array"), "px")) : ("px")), array("id" => "smiles-button-icon-size-text-font-unit-select", "class" => "mbs-selector-unit-width sc-input", "name" => "general[smiles-button-icon-size-text-font-unit-select]"))), null, array("mbsThinCol" => 1));
        // line 157
        echo "

\t\t\t\t\t<!-- \t\t\t\t\t
\t\t\t\t\t";
        // line 160
        echo $context["options"]->getcolorRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Primary Color")), "general[primary-color]", $this->getAttribute($this->getAttribute(        // line 162
($context["settings"] ?? null), "general", array()), "primary-color", array(), "array"), "primary-color", null, null, array("mbsThinCol" => 1));
        // line 165
        echo "

\t\t\t\t\t";
        // line 167
        echo $context["options"]->getcolorRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Secondary Color")), "general[secondary-color]", $this->getAttribute($this->getAttribute(        // line 169
($context["settings"] ?? null), "general", array()), "secondary-color", array(), "array"), "secondary-color", null, null, array("mbsThinCol" => 1));
        // line 172
        echo " -->

\t\t\t\t\t<h3>";
        // line 174
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Inputs")), "html", null, true);
        echo "</h3>

\t\t\t\t\t";
        // line 176
        echo $context["options"]->getcolorRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Input Border Color")), "general[input-border-color]", $this->getAttribute($this->getAttribute(        // line 178
($context["settings"] ?? null), "general", array()), "input-border-color", array(), "array"), "input-border-color", null, null, array("mbsThinCol" => 1));
        // line 181
        echo "

\t\t\t\t\t";
        // line 183
        echo $context["options"]->getcolorRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Input Border Focus Color")), "general[input-border-focus-color]", $this->getAttribute($this->getAttribute(        // line 185
($context["settings"] ?? null), "general", array()), "input-border-focus-color", array(), "array"), "input-border-focus-color", null, null, array("mbsThinCol" => 1));
        // line 188
        echo "

\t\t\t\t\t";
        // line 190
        echo $context["options"]->getcolorRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Input Background Color")), "general[input-background-color]", $this->getAttribute($this->getAttribute(        // line 192
($context["settings"] ?? null), "general", array()), "input-background-color", array(), "array"), "input-background-color", null, null, array("mbsThinCol" => 1));
        // line 195
        echo "

\t\t\t\t\t";
        // line 197
        echo $context["options"]->getcolorRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Input Background Focus Color")), "general[input-background-focus-color]", $this->getAttribute($this->getAttribute(        // line 199
($context["settings"] ?? null), "general", array()), "input-background-focus-color", array(), "array"), "input-background-focus-color", null, null, array("mbsThinCol" => 1));
        // line 202
        echo "

\t\t\t\t\t";
        // line 204
        echo $context["options"]->getcolorRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Input Placeholder Color")), "general[input-placeholder-color]", $this->getAttribute($this->getAttribute(        // line 206
($context["settings"] ?? null), "general", array()), "input-placeholder-color", array(), "array"), "input-placeholder-color", null, null, array("mbsThinCol" => 1));
        // line 209
        echo "

\t\t\t\t\t<!-- ";
        // line 211
        echo $context["options"]->getcolorRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Help Icon Background Color")), "general[help-icon-background-color]", $this->getAttribute($this->getAttribute(        // line 213
($context["settings"] ?? null), "general", array()), "help-icon-background-color", array(), "array"), "help-icon-background-color", null, null, array("mbsThinCol" => 1));
        // line 216
        echo "
\t\t\t\t\t
\t\t\t\t\t";
        // line 218
        echo $context["options"]->getcolorRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Help Icon Color")), "general[help-icon-text-color]", $this->getAttribute($this->getAttribute(        // line 220
($context["settings"] ?? null), "general", array()), "help-icon-text-color", array(), "array"), "help-icon-text-color", null, null, array("mbsThinCol" => 1));
        // line 223
        echo "

\t\t\t\t\t";
        // line 225
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Show an asterisk for required fields")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "general[css_visibility_asterisk]", "value" => "visible", "checked" => ($this->getAttribute($this->getAttribute(        // line 230
($context["settings"] ?? null), "general", array()), "css_visibility_asterisk", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "general[css_visibility_asterisk]", "value" => "hidden", "checked" => ($this->getAttribute($this->getAttribute(        // line 236
($context["settings"] ?? null), "general", array()), "css_visibility_asterisk", array(), "array") == "false"))), "show-asterisk", null, null, array("mbsThinCol" => 1));
        // line 240
        echo "

\t\t\t\t\t";
        // line 242
        echo $context["options"]->getcolorRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Required Asterisk Color")), "general[css_color_asterisk]", $this->getAttribute($this->getAttribute(        // line 244
($context["settings"] ?? null), "general", array()), "css_color_asterisk", array(), "array"), "asterisk-color", ((($this->getAttribute($this->getAttribute(        // line 246
($context["settings"] ?? null), "general", array()), "show-asterisk", array(), "array") == "")) ? ("style=\"display:none;\"") : ("")));
        // line 247
        echo " -->


\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
\t
\t<div class=\"sc-tab-content\" data-tab=\"menu\">
\t\t<div class=\"mp-options\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-md-12\">
\t\t\t\t\t
\t\t\t\t
\t\t\t\t\t";
        // line 261
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Add logout link to menu")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "menu[add-logout-link]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 266
($context["settings"] ?? null), "menu", array()), "add-logout-link", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "menu[add-logout-link]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 272
($context["settings"] ?? null), "menu", array()), "add-logout-link", array(), "array") == "false"))), "add-logout-link", null, null, array("mbsThinCol" => 1));
        // line 276
        echo "

\t\t\t\t\t<div class=\"row logoutMenuListRow mbs-hidden\">
\t\t\t\t\t\t<div class=\"col-md-12\">
\t\t\t\t\t\t\t<div class=\"loutMenuListWrapper\">
\t\t\t\t\t\t\t\t";
        // line 281
        echo $context["options"]->getselectInput2(        // line 282
($context["wpMenuList"] ?? null), $this->getAttribute($this->getAttribute(        // line 283
($context["settings"] ?? null), "menu", array()), "logout-menu-list", array(), "array"), array("class" => "chosen-select", "multiple" => "multiple", "id" => "mbs-design-logout-menu-list", "name" => "menu[logout-menu-list][]", "data-placeholder" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Choose menus to add logout item..."))), 0);
        // line 292
        echo "
\t\t\t\t\t\t\t\t";
        // line 293
        echo $context["options"]->gethiddenInput("menu[use-logout-list]", 1, null);
        echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t\t";
        // line 298
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Remove login and registration links from menu when user is logged in")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "menu[remove-login-registration]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 303
($context["settings"] ?? null), "menu", array()), "remove-login-registration", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "menu[remove-login-registration]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 309
($context["settings"] ?? null), "menu", array()), "remove-login-registration", array(), "array") == "false"))), "remove-login-registration", null, null, array("mbsThinCol" => 1));
        // line 313
        echo "

\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
\t
\t<div class=\"sc-tab-content\" data-tab=\"activity\">
\t\t<div class=\"mp-options\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-md-12\">
\t\t\t\t\t
\t\t\t\t\t<h3>";
        // line 325
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Activity filter")), "html", null, true);
        echo "</h3>
\t\t\t\t\t
\t\t\t\t\t";
        // line 327
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Show Activity Filter")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "activity[show-filter]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 332
($context["settings"] ?? null), "activity", array()), "show-filter", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "activity[show-filter]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 338
($context["settings"] ?? null), "activity", array()), "show-filter", array(), "array") == "false"))), "activity.show-filter", null, null, array("mbsThinCol" => 1));
        // line 342
        echo "

\t\t\t\t\t";
        // line 344
        echo $context["options"]->getselectRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Default Activity Filter")), array(0 => array("title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Subscriptions")), "value" => "subscriptions", "selected" => ($this->getAttribute($this->getAttribute(        // line 348
($context["settings"] ?? null), "activity", array()), "default-filter", array(), "array") == "subscriptions")), 1 => array("title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Popular")), "value" => "popular", "selected" => ($this->getAttribute($this->getAttribute(        // line 353
($context["settings"] ?? null), "activity", array()), "default-filter", array(), "array") == "popular")), 2 => array("title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Site wide")), "value" => "site-wide", "selected" => ($this->getAttribute($this->getAttribute(        // line 358
($context["settings"] ?? null), "activity", array()), "default-filter", array(), "array") == "site-wide"))), "activity[default-filter]", null, null, array("mbsThinCol" => 1));
        // line 362
        echo "
\t\t\t\t\t
\t\t\t\t\t<h3>";
        // line 364
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Activity types")), "html", null, true);
        echo "</h3>
\t\t\t\t\t
\t\t\t\t\t";
        // line 366
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Posts")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "activity[type][posts]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute($this->getAttribute(        // line 371
($context["settings"] ?? null), "activity", array()), "type", array(), "array"), "posts", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "activity[type][posts]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute($this->getAttribute(        // line 377
($context["settings"] ?? null), "activity", array()), "type", array(), "array"), "posts", array(), "array") == "false"))), "activity.type.posts", null, null, array("mbsThinCol" => 1));
        // line 381
        echo "
\t\t\t\t\t
\t\t\t\t\t";
        // line 383
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Photos")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "activity[type][photos]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute($this->getAttribute(        // line 388
($context["settings"] ?? null), "activity", array()), "type", array(), "array"), "photos", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "activity[type][photos]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute($this->getAttribute(        // line 394
($context["settings"] ?? null), "activity", array()), "type", array(), "array"), "photos", array(), "array") == "false"))), "activity.type.photos", null, null, array("mbsThinCol" => 1));
        // line 398
        echo "
\t\t\t\t\t
\t\t\t\t\t";
        // line 400
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Shares")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "activity[type][shares]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute($this->getAttribute(        // line 405
($context["settings"] ?? null), "activity", array()), "type", array(), "array"), "shares", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "activity[type][shares]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute($this->getAttribute(        // line 411
($context["settings"] ?? null), "activity", array()), "type", array(), "array"), "shares", array(), "array") == "false"))), "activity.type.shares", null, null, array("mbsThinCol" => 1));
        // line 415
        echo "

\t\t\t\t\t";
        // line 417
        $context["shareFriendPostOnCheckItem"] = array("name" => "activity[type][friendPostOn]", "value" => 1);
        // line 421
        echo "\t\t\t\t\t";
        if (($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "activity", array()), "type", array(), "array"), "friendPostOn", array(), "array") == 1)) {
            // line 422
            echo "\t\t\t\t\t\t";
            $context["shareFriendPostOnCheckItem"] = twig_array_merge(($context["shareFriendPostOnCheckItem"] ?? null), array("checked" => "checked"));
            // line 423
            echo "\t\t\t\t\t";
        }
        // line 424
        echo "\t\t\t\t\t";
        echo $context["options"]->getcheckboxSettingRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Share to Friends Activity")), array(0 =>         // line 425
($context["shareFriendPostOnCheckItem"] ?? null)), "activityTypesFriendPostOn", null, null, null, array("mbsThinCol" => 1));
        // line 431
        echo "

\t\t\t\t\t";
        // line 433
        $context["shareFrontendPostOnCheckItem"] = array("name" => "activity[type][friendPostOnShowInFrontend]", "value" => 1);
        // line 437
        echo "\t\t\t\t\t";
        if (($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "activity", array()), "type", array(), "array"), "friendPostOnShowInFrontend", array(), "array") == 1)) {
            // line 438
            echo "\t\t\t\t\t\t";
            $context["shareFrontendPostOnCheckItem"] = twig_array_merge(($context["shareFrontendPostOnCheckItem"] ?? null), array("checked" => "checked"));
            // line 439
            echo "\t\t\t\t\t";
        }
        // line 440
        echo "\t\t\t\t\t";
        echo $context["options"]->getcheckboxSettingRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Add this option to frontend")), array(0 =>         // line 441
($context["shareFrontendPostOnCheckItem"] ?? null)), "activityTypesFriendPostInFrontendOn", null, null, null, array("mbsThinCol" => 1));
        // line 447
        echo "
\t\t\t\t\t
\t\t\t\t\t";
        // line 449
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Likes")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "activity[type][likes]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute($this->getAttribute(        // line 454
($context["settings"] ?? null), "activity", array()), "type", array(), "array"), "likes", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "activity[type][likes]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute($this->getAttribute(        // line 460
($context["settings"] ?? null), "activity", array()), "type", array(), "array"), "likes", array(), "array") == "false"))), "activity.type.likes", null, null, array("mbsThinCol" => 1));
        // line 464
        echo "

\t\t\t\t\t";
        // line 466
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Favorite")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "activity[type][favorite]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute($this->getAttribute(        // line 471
($context["settings"] ?? null), "activity", array()), "type", array(), "array"), "favorite", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "activity[type][favorite]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute($this->getAttribute(        // line 477
($context["settings"] ?? null), "activity", array()), "type", array(), "array"), "favorite", array(), "array") == "false"))), "activity.type.favorite", null, null, array("mbsThinCol" => 1));
        // line 481
        echo "
\t\t\t\t\t
\t\t\t\t\t";
        // line 483
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Comments")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "activity[type][comments]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute($this->getAttribute(        // line 488
($context["settings"] ?? null), "activity", array()), "type", array(), "array"), "comments", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "activity[type][comments]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute($this->getAttribute(        // line 494
($context["settings"] ?? null), "activity", array()), "type", array(), "array"), "comments", array(), "array") == "false"))), "activity.type.comments", null, null, array("mbsThinCol" => 1));
        // line 498
        echo "
\t\t\t\t\t
\t\t\t\t\t";
        // line 500
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Groups")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "activity[type][groups]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute($this->getAttribute(        // line 505
($context["settings"] ?? null), "activity", array()), "type", array(), "array"), "groups", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "activity[type][groups]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute($this->getAttribute(        // line 511
($context["settings"] ?? null), "activity", array()), "type", array(), "array"), "groups", array(), "array") == "false"))), "activity.type.groups", null, null, array("mbsThinCol" => 1));
        // line 515
        echo "
\t\t\t\t\t
\t\t\t\t\t";
        // line 517
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Social")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "activity[type][social]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute($this->getAttribute(        // line 522
($context["settings"] ?? null), "activity", array()), "type", array(), "array"), "social", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "activity[type][social]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute($this->getAttribute(        // line 528
($context["settings"] ?? null), "activity", array()), "type", array(), "array"), "social", array(), "array") == "false"))), "activity.type.social", null, null, array("mbsThinCol" => 1));
        // line 532
        echo "
\t\t\t\t\t
\t\t\t\t\t";
        // line 534
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Forum")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "activity[type][forum]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute($this->getAttribute(        // line 539
($context["settings"] ?? null), "activity", array()), "type", array(), "array"), "forum", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "activity[type][forum]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute($this->getAttribute(        // line 545
($context["settings"] ?? null), "activity", array()), "type", array(), "array"), "forum", array(), "array") == "false"))), "activity.type.forum", null, null, array("mbsThinCol" => 1));
        // line 549
        echo "
\t\t\t\t\t
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
\t
\t<div class=\"sc-tab-content\" data-tab=\"profile\">
\t\t<div class=\"mp-options\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-md-12\">

\t\t\t\t\t";
        // line 561
        echo $context["options"]->getinputRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Profile Container Max Width")), "profile[container-max-width]", $this->getAttribute($this->getAttribute(        // line 563
($context["settings"] ?? null), "profile", array()), "container-max-width", array(), "array"), "container-max-width", null, null, array("mbsThinCol" => 1));
        // line 566
        echo "

\t\t\t\t\t";
        // line 568
        echo $context["options"]->getcolorRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Profile Header Background Color")), "profile[header-background-color]", $this->getAttribute($this->getAttribute(        // line 570
($context["settings"] ?? null), "profile", array()), "header-background-color", array(), "array"), "header-background-color", null, null, array("mbsThinCol" => 1));
        // line 573
        echo "


\t\t\t\t\t";
        // line 576
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Show Display Name In Profile Header")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "profile[show-display-name]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 581
($context["settings"] ?? null), "profile", array()), "show-display-name", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "profile[show-display-name]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 587
($context["settings"] ?? null), "profile", array()), "show-display-name", array(), "array") == "false"))), "show-display-name", null, null, array("mbsThinCol" => 1));
        // line 591
        echo "


\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
\t
\t<div class=\"sc-tab-content\" data-tab=\"auth\">
\t\t<div class=\"mp-options\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-md-12\">

\t\t\t\t\t<h3>";
        // line 604
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Registration")), "html", null, true);
        echo "</h3>


\t\t\t\t\t";
        // line 607
        echo $context["options"]->getinputRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Registration Primary Button Text")), "auth[registration-primary-button-text]", $this->getAttribute($this->getAttribute(        // line 609
($context["settings"] ?? null), "auth", array()), "registration-primary-button-text", array(), "array"), "registration-primary-button-text", null, null, array("mbsThinCol" => 1));
        // line 612
        echo "

                    ";
        // line 614
        echo $context["options"]->getcolorRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Asterisk color")), "general[asterisk-color]", (($this->getAttribute($this->getAttribute(        // line 616
($context["settings"] ?? null), "general", array(), "any", false, true), "asterisk-color", array(), "array", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "general", array(), "any", false, true), "asterisk-color", array(), "array"), "rgb(255, 0, 0)")) : ("rgb(255, 0, 0)")), "asterisk-color", null, null, array("mbsThinCol" => 1));
        // line 619
        echo "
\t\t\t\t\t
\t\t\t\t\t<h3>";
        // line 621
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Login")), "html", null, true);
        echo "</h3>
\t\t\t\t\t
\t\t\t\t\t";
        // line 623
        echo $context["options"]->getinputRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Login Primary Button Text")), "auth[login-primary-button-text]", $this->getAttribute($this->getAttribute(        // line 625
($context["settings"] ?? null), "auth", array()), "login-primary-button-text", array(), "array"), "login-primary-button-text", null, null, array("mbsThinCol" => 1));
        // line 628
        echo "

\t\t\t\t\t";
        // line 630
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Login Secondary Button")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "auth[login-secondary-button]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 635
($context["settings"] ?? null), "auth", array()), "login-secondary-button", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "auth[login-secondary-button]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 641
($context["settings"] ?? null), "auth", array()), "login-secondary-button", array(), "array") == "false"))), "login-secondary-button", null, null, array("mbsThinCol" => 1));
        // line 645
        echo "

\t\t\t\t\t";
        // line 647
        echo $context["options"]->getinputRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Login Secondary Button Text")), "auth[login-secondary-button-text]", $this->getAttribute($this->getAttribute(        // line 649
($context["settings"] ?? null), "auth", array()), "login-secondary-button-text", array(), "array"), "login-secondary-button-text", null, null, array("mbsThinCol" => 1));
        // line 652
        echo "

\t\t\t\t\t";
        // line 654
        echo $context["options"]->getinputRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Login Secondary Button URL")), "auth[login-secondary-button-url]", $this->getAttribute($this->getAttribute(        // line 656
($context["settings"] ?? null), "auth", array()), "login-secondary-button-url", array(), "array"), "login-secondary-button-url", null, null, array("mbsThinCol" => 1));
        // line 659
        echo "

\t\t\t\t\t";
        // line 661
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Show Remember Me")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "auth[login-show-remember-me]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 666
($context["settings"] ?? null), "auth", array()), "login-show-remember-me", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "auth[login-show-remember-me]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 672
($context["settings"] ?? null), "auth", array()), "login-show-remember-me", array(), "array") == "false"))), "login-show-remember-me", null, null, array("mbsThinCol" => 1));
        // line 676
        echo "
\t\t\t\t\t
\t\t\t\t\t
\t\t\t\t\t";
        // line 679
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Google ReCaptcha")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "auth[login-google-recaptcha-enable]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 684
($context["settings"] ?? null), "auth", array()), "login-google-recaptcha-enable", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "auth[login-google-recaptcha-enable]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 690
($context["settings"] ?? null), "auth", array()), "login-google-recaptcha-enable", array(), "array") == "false"))), "login-google-recaptcha-enable", null, null, array("mbsThinCol" => 1));
        // line 694
        echo "

\t\t\t\t\t";
        // line 696
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Login after success Registration")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "auth[login-after-register-enable]", "value" => 1, "checked" => (($this->getAttribute($this->getAttribute(        // line 701
($context["settings"] ?? null), "auth", array()), "login-after-register-enable", array(), "array") == 1) ||  !$this->getAttribute($this->getAttribute(($context["settings"] ?? null), "auth", array(), "any", false, true), "login-after-register-enable", array(), "array", true, true))), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "auth[login-after-register-enable]", "value" => 0, "checked" => ($this->getAttribute($this->getAttribute(        // line 707
($context["settings"] ?? null), "auth", array(), "any", false, true), "login-after-register-enable", array(), "array", true, true) && ($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "auth", array()), "login-after-register-enable", array(), "array") == 0)))), "login-after-register-enable", null, null, array("mbsThinCol" => 1));
        // line 711
        echo "
\t\t\t\t\t
\t\t\t\t\t<div class=\"login-google-recaptcha-settings\" style=\"display: none\">

\t\t\t\t\t";
        // line 715
        echo $context["options"]->getinputRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Google ReCaptcha Site Key")), "auth[login-google-recaptcha-site-key]", $this->getAttribute($this->getAttribute(        // line 717
($context["settings"] ?? null), "auth", array()), "login-google-recaptcha-site-key", array(), "array"), "login-google-recaptcha-site-key", null, null, array("mbsThinCol" => 1));
        // line 720
        echo "
\t\t\t\t\t
\t\t\t\t\t
\t\t\t\t\t";
        // line 723
        echo $context["options"]->getinputRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Google ReCaptcha Secret Key")), "auth[login-google-recaptcha-secret-key]", $this->getAttribute($this->getAttribute(        // line 725
($context["settings"] ?? null), "auth", array()), "login-google-recaptcha-secret-key", array(), "array"), "login-google-recaptcha-secret-key", null, null, array("mbsThinCol" => 1));
        // line 728
        echo "
\t\t\t\t\t
\t\t\t\t\t";
        // line 730
        echo $context["options"]->getselectRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Google ReCaptcha Theme")), array(0 => array("title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Light")), "value" => "light", "checked" => ($this->getAttribute($this->getAttribute(        // line 734
($context["settings"] ?? null), "auth", array()), "login-google-recaptcha-theme", array(), "array") == "light")), 1 => array("title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Dark")), "value" => "dark", "selected" => ($this->getAttribute($this->getAttribute(        // line 739
($context["settings"] ?? null), "auth", array()), "login-google-recaptcha-theme", array(), "array") == "dark"))), "auth[login-google-recaptcha-theme]", "google-re-captcha-theme", null, array("mbsThinCol" => 1));
        // line 744
        echo "
\t\t\t\t\t
\t\t\t\t\t";
        // line 746
        echo $context["options"]->getselectRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Google ReCaptcha Type")), array(0 => array("title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Image")), "value" => "image", "selected" => ($this->getAttribute($this->getAttribute(        // line 750
($context["settings"] ?? null), "auth", array()), "login-google-recaptcha-type", array(), "array") == "image")), 1 => array("title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Audio")), "value" => "audio", "selected" => ($this->getAttribute($this->getAttribute(        // line 755
($context["settings"] ?? null), "auth", array()), "login-google-recaptcha-type", array(), "array") == "audio"))), "auth[login-google-recaptcha-type]", "google-re-captcha-type", null, array("mbsThinCol" => 1));
        // line 760
        echo "
\t\t\t\t\t
\t\t\t\t\t
\t\t\t\t\t";
        // line 763
        echo $context["options"]->getselectRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Google ReCaptcha Size")), array(0 => array("title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Normal")), "value" => "normal", "selected" => ($this->getAttribute($this->getAttribute(        // line 767
($context["settings"] ?? null), "auth", array()), "login-google-recaptcha-size", array(), "array") == "normal")), 1 => array("title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Compact")), "value" => "compact", "selected" => ($this->getAttribute($this->getAttribute(        // line 772
($context["settings"] ?? null), "auth", array()), "login-google-recaptcha-size", array(), "array") == "compact"))), "auth[login-google-recaptcha-size]", "google-re-captcha-size", null, array("mbsThinCol" => 1));
        // line 777
        echo "
\t\t\t\t\t
\t\t\t\t\t</div>
\t\t\t\t\t
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>

\t<div class=\"sc-tab-content\" data-tab=\"members\">
\t\t<div class=\"mp-options\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-md-12\">

\t\t\t\t\t<h3>";
        // line 791
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("General Options")), "html", null, true);
        echo "</h3>

\t\t\t\t\t";
        // line 793
        $context["_roles"] = array(0 => array("title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("All")), "value" => "all", "selected" => twig_in_filter("all", $this->getAttribute($this->getAttribute(        // line 796
($context["settings"] ?? null), "members", array()), "roles-to-display", array(), "array"))));
        // line 798
        echo "\t
\t\t\t\t\t";
        // line 799
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["roles"] ?? null));
        foreach ($context['_seq'] as $context["value"] => $context["role"]) {
            // line 800
            echo "\t\t\t\t\t\t";
            $context["_roles"] = twig_array_merge(($context["_roles"] ?? null), array(0 => array("title" => $this->getAttribute(            // line 801
$context["role"], "name", array()), "value" => $this->getAttribute(            // line 802
$context["role"], "id", array()), "selected" => twig_in_filter($this->getAttribute(            // line 803
$context["role"], "id", array()), $this->getAttribute($this->getAttribute(($context["settings"] ?? null), "members", array()), "roles-to-display", array(), "array")))));
            // line 805
            echo "\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['value'], $context['role'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 806
        echo "
\t\t\t\t\t";
        // line 807
        echo $context["options"]->getmultipleSelectRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("User Roles to Display")),         // line 808
($context["_roles"] ?? null), "members[roles-to-display]", "roles-to-display", null, null, null, null, null, array("mbsThinCol" => 1));
        // line 812
        echo "

\t\t\t\t\t<!-- Only show members who have uploaded a profile photo -->
\t\t\t\t\t";
        // line 815
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Show Only Members With Photo")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "members[show-only-with-avatar]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 820
($context["settings"] ?? null), "members", array()), "show-only-with-avatar", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "members[show-only-with-avatar]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 826
($context["settings"] ?? null), "members", array()), "show-only-with-avatar", array(), "array") == "false"))), "show-only-with-avatar", null, null, array("mbsThinCol" => 1));
        // line 830
        echo "

\t\t\t\t\t<!-- Only show members who have uploaded a cover photo -->
\t\t\t\t\t";
        // line 833
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Show Only Members With Cover")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "members[show-only-with-cover]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 838
($context["settings"] ?? null), "members", array()), "show-only-with-cover", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "members[show-only-with-cover]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 844
($context["settings"] ?? null), "members", array()), "show-only-with-cover", array(), "array") == "false"))), "show-only-with-cover", null, null, array("mbsThinCol" => 1));
        // line 848
        echo "

\t\t\t\t\t<!-- Show load more button on members page -->
\t\t\t\t\t";
        // line 851
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Show Load More Button")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "members[show-load-more-button]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 856
($context["settings"] ?? null), "members", array()), "show-load-more-button", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "members[show-load-more-button]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 862
($context["settings"] ?? null), "members", array()), "show-load-more-button", array(), "array") == "false"))), "show-load-more-button", null, null, array("mbsThinCol" => 1));
        // line 866
        echo "

\t\t\t\t\t<!-- Show pages on members page -->
\t\t\t\t\t";
        // line 869
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Show Pages")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "members[show-pages]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 874
($context["settings"] ?? null), "members", array()), "show-pages", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "members[show-pages]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 880
($context["settings"] ?? null), "members", array()), "show-pages", array(), "array") == "false"))), "show-pages", null, null, array("mbsThinCol" => 1));
        // line 884
        echo "

\t\t\t\t\t<!-- Show tabs (friend, followers) for login user on members page -->
\t\t\t\t\t";
        // line 887
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Show tabs")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "members[show-tabs]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 892
($context["settings"] ?? null), "members", array()), "show-tabs", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "members[show-tabs]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 898
($context["settings"] ?? null), "members", array()), "show-tabs", array(), "array") == "false"))), "show-tabs", null, null, array("mbsThinCol" => 1));
        // line 902
        echo "

\t\t\t\t\t";
        // line 904
        echo $context["options"]->getselectRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Default Sort Users By")), array(0 => array("title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("New Users First")), "value" => "new-users-first", "selected" => ($this->getAttribute($this->getAttribute(        // line 908
($context["settings"] ?? null), "members", array()), "sort-users-by", array(), "array") == "new-users-first")), 1 => array("title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Old Users First")), "value" => "old-users-first", "selected" => ($this->getAttribute($this->getAttribute(        // line 913
($context["settings"] ?? null), "members", array()), "sort-users-by", array(), "array") == "old-users-first")), 2 => array("title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("First Name")), "value" => "first-name", "selected" => ($this->getAttribute($this->getAttribute(        // line 918
($context["settings"] ?? null), "members", array()), "sort-users-by", array(), "array") == "first-name")), 3 => array("title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Last Name")), "value" => "last-name", "selected" => ($this->getAttribute($this->getAttribute(        // line 923
($context["settings"] ?? null), "members", array()), "sort-users-by", array(), "array") == "last-name")), 4 => array("title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Random")), "value" => "random", "selected" => ($this->getAttribute($this->getAttribute(        // line 928
($context["settings"] ?? null), "members", array()), "sort-users-by", array(), "array") == "random"))), "members[sort-users-by]", "sort-users-by", null, array("mbsThinCol" => 1));
        // line 933
        echo "


\t\t\t\t\t<h3>User Card</h3>

                    ";
        // line 938
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Show Friends and Followers")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "members[show-friends-and-followers]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 943
($context["settings"] ?? null), "members", array()), "show-friends-and-followers", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "members[show-friends-and-followers]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 949
($context["settings"] ?? null), "members", array()), "show-friends-and-followers", array(), "array") == "false"))), "show-display-name", null, null, array("mbsThinCol" => 1));
        // line 953
        echo "

                    <!--
\t\t\t\t\t";
        // line 956
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Enable Profile Photo")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "members[enable-profile-photo]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 961
($context["settings"] ?? null), "members", array()), "enable-profile-photo", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "members[enable-profile-photo]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 967
($context["settings"] ?? null), "members", array()), "enable-profile-photo", array(), "array") == "false"))), "enable-profile-cards", null, null, array("mbsThinCol" => 1));
        // line 971
        echo "

\t\t\t\t\t";
        // line 973
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Enable Cover Photo")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "members[enable-cover-photo]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 978
($context["settings"] ?? null), "members", array()), "enable-cover-photo", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "members[enable-cover-photo]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 984
($context["settings"] ?? null), "members", array()), "enable-cover-photo", array(), "array") == "false"))), "enable-cover-photo", null, null, array("mbsThinCol" => 1));
        // line 988
        echo "

\t\t\t\t\t";
        // line 990
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Show Display Name")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "members[show-display-name]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 995
($context["settings"] ?? null), "members", array()), "show-display-name", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "members[show-display-name]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 1001
($context["settings"] ?? null), "members", array()), "show-display-name", array(), "array") == "false"))), "show-display-name", null, null, array("mbsThinCol" => 1));
        // line 1005
        echo "

\t\t\t\t\t";
        // line 1007
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Show tagline below profile name")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "members[show-tagline]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 1012
($context["settings"] ?? null), "members", array()), "show-tagline", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "members[show-tagline]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 1018
($context["settings"] ?? null), "members", array()), "show-tagline", array(), "array") == "false"))), "show-tagline", null, null, array("mbsThinCol" => 1));
        // line 1022
        echo "

\t\t\t\t\t";
        // line 1024
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Show extra user information below tagline?")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "members[show-extra-user-information]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 1029
($context["settings"] ?? null), "members", array()), "show-extra-user-information", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "members[show-extra-user-information]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 1035
($context["settings"] ?? null), "members", array()), "show-extra-user-information", array(), "array") == "false"))), "show-extra-user-information", null, null, array("mbsThinCol" => 1));
        // line 1039
        echo "
 -->
<!-- \t\t\t\t\t<h3>Search Option</h3>

\t\t\t\t\t";
        // line 1043
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Enable Search feature")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "members[enable-search-options]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 1048
($context["settings"] ?? null), "members", array()), "enable-search-options", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "members[enable-search-options]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 1054
($context["settings"] ?? null), "members", array()), "enable-search-options", array(), "array") == "false"))), "enable-search-options", null, null, array("mbsThinCol" => 1));
        // line 1058
        echo "

\t\t\t\t\t";
        // line 1060
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Show results only after search")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "members[show-search-result-after-search]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 1065
($context["settings"] ?? null), "members", array()), "show-search-result-after-search", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "members[show-search-result-after-search]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 1071
($context["settings"] ?? null), "members", array()), "show-search-result-after-search", array(), "array") == "false"))), "show-search-result-after-search", null, null, array("mbsThinCol" => 1));
        // line 1075
        echo "

\t\t\t\t\t";
        // line 1077
        echo $context["options"]->getselectRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("User Roles that can use search")), array(0 => array("title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("All")), "value" => "none", "selected" => ($this->getAttribute($this->getAttribute(        // line 1081
($context["settings"] ?? null), "members", array()), "user-role-that-can-use-search", array(), "array") == "none"), "disabled" => true)), "members[user-role-that-can-use-search]", "user-role-that-can-use-search", null, array("mbsThinCol" => 1));
        // line 1087
        echo "

\t\t\t\t\t";
        // line 1089
        echo $context["options"]->getselectRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Choose field(s) to enable in search")), array(0 => array("title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("All")), "value" => "none", "selected" => ($this->getAttribute($this->getAttribute(        // line 1093
($context["settings"] ?? null), "members", array()), "user-role-that-can-use-search", array(), "array") == "none"), "disabled" => true)), "members[user-role-that-can-use-search]", "user-role-that-can-use-search", null, array("mbsThinCol" => 1));
        // line 1099
        echo "

\t\t\t\t\t";
        // line 1101
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Show results only after search")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "members[show-search-result-after-search]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 1106
($context["settings"] ?? null), "members", array()), "show-search-result-after-search", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "members[show-search-result-after-search]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 1112
($context["settings"] ?? null), "members", array()), "show-search-result-after-search", array(), "array") == "false"))), "show-search-result-after-search", null, null, array("mbsThinCol" => 1));
        // line 1116
        echo "


\t\t\t\t\t";
        // line 1119
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Results Text")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "members[search-results-text]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 1124
($context["settings"] ?? null), "members", array()), "search-results-text", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "members[search-results-text]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 1130
($context["settings"] ?? null), "members", array()), "search-results-text", array(), "array") == "false"))), "search-results-text", null, null, array("mbsThinCol" => 1));
        // line 1134
        echo "

\t\t\t\t\t";
        // line 1136
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Single Result Text")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "members[single-search-results-text]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 1141
($context["settings"] ?? null), "members", array()), "single-search-results-text", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "members[single-search-results-text]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 1147
($context["settings"] ?? null), "members", array()), "single-search-results-text", array(), "array") == "false"))), "single-search-results-text", null, null, array("mbsThinCol" => 1));
        // line 1151
        echo "

\t\t\t\t\t";
        // line 1153
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Custom text if no users were found")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "members[custeom-text-if-no-users-found]", "value" => "true", "checked" => ($this->getAttribute($this->getAttribute(        // line 1158
($context["settings"] ?? null), "members", array()), "custeom-text-if-no-users-found", array(), "array") == "true")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "members[custeom-text-if-no-users-found]", "value" => "false", "checked" => ($this->getAttribute($this->getAttribute(        // line 1164
($context["settings"] ?? null), "members", array()), "custeom-text-if-no-users-found", array(), "array") == "false"))), "custeom-text-if-no-users-found", null, null, array("mbsThinCol" => 1));
        // line 1168
        echo "
\t\t\t\t\t -->
<!-- \t\t\t\t\t<h3>Result and Pagination</h3>

\t\t\t\t\t";
        // line 1172
        echo $context["options"]->getinputRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Number of profiles per page")), "auth[search-profiles-per-page]", $this->getAttribute($this->getAttribute(        // line 1174
($context["settings"] ?? null), "auth", array()), "search-profiles-per-page", array(), "array"), "search-profiles-per-page", null, null, array("mbsThinCol" => 1));
        // line 1177
        echo "

\t\t\t\t\t";
        // line 1179
        echo $context["options"]->getinputRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Number of profiles per page (for Mobiles & Tablets)")), "auth[search-profiles-per-page-mobile]", $this->getAttribute($this->getAttribute(        // line 1181
($context["settings"] ?? null), "auth", array()), "search-profiles-per-page-mobile", array(), "array"), "search-profiles-per-page-mobile", null, null, array("mbsThinCol" => 1));
        // line 1184
        echo "

\t\t\t\t\t";
        // line 1186
        echo $context["options"]->getinputRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Maximum number of profiles")), "auth[maximum-profiles-number]", $this->getAttribute($this->getAttribute(        // line 1188
($context["settings"] ?? null), "auth", array()), "maximum-profiles-number", array(), "array"), "maximum-profiles-number", null, null, array("mbsThinCol" => 1));
        // line 1191
        echo " -->

\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>

\t<div class=\"sc-tab-content\" data-tab=\"fonts\">
\t\t";
        // line 1199
        $context["fontsSizeUnits"] = array(0 => array("value" => "px", "title" => "px"), 1 => array("value" => "em", "title" => "em"));
        // line 1209
        echo "
\t\t<div class=\"mp-options\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-md-12\">

\t\t\t\t\t<h3>";
        // line 1214
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("General")), "html", null, true);
        echo "</h3>
\t\t\t\t\t";
        // line 1216
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Primary Buttons text font size:", 1 => "primary-buttons", 2 => "fonts", 3 => "general", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1217
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Primary Buttons text font family:", 1 => "primary-buttons", 2 => "fonts", 3 => "general", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1218
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Primary Buttons text color:", 1 => "primary-buttons", 2 => "fonts", 3 => "general", 4 => ($context["settings"] ?? null), 5 => (($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "general", array(), "any", false, true), "primary-button-text-color", array(), "array", true, true)) ? ($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "general", array()), "primary-button-text-color", array(), "array")) : (null))), "method");
        echo "
\t\t\t\t\t";
        // line 1220
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Secondary Buttons text font size:", 1 => "secondary-buttons", 2 => "fonts", 3 => "general", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1221
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Secondary Buttons text font family:", 1 => "secondary-buttons", 2 => "fonts", 3 => "general", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1222
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Secondary Buttons text color:", 1 => "secondary-buttons", 2 => "fonts", 3 => "general", 4 => ($context["settings"] ?? null), 5 => (($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "general", array(), "any", false, true), "secondary-button-text-color", array(), "array", true, true)) ? ($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "general", array()), "secondary-button-text-color", array(), "array")) : (null))), "method");
        echo "
\t\t\t\t\t";
        // line 1224
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Page Header text font size:", 1 => "page-header", 2 => "fonts", 3 => "general", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null), 6 => 40), "method");
        echo "
\t\t\t\t\t";
        // line 1225
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Page Header text font family:", 1 => "page-header", 2 => "fonts", 3 => "general", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1226
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Page Header text color:", 1 => "page-header", 2 => "fonts", 3 => "general", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1228
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Input text font size:", 1 => "text-input", 2 => "fonts", 3 => "general", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null), 6 => 40), "method");
        echo "
\t\t\t\t\t";
        // line 1229
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Input text font family:", 1 => "text-input", 2 => "fonts", 3 => "general", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1230
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Input text color:", 1 => "text-input", 2 => "fonts", 3 => "general", 4 => ($context["settings"] ?? null), 5 => (($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "general", array(), "any", false, true), "input-text-color", array(), "array", true, true)) ? ($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "general", array()), "input-text-color", array(), "array")) : (null))), "method");
        echo "
\t\t\t\t\t";
        // line 1232
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Labels text font size:", 1 => "labels", 2 => "fonts", 3 => "general", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1233
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Labels text font family:", 1 => "labels", 2 => "fonts", 3 => "general", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1234
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Labels text color:", 1 => "labels", 2 => "fonts", 3 => "general", 4 => ($context["settings"] ?? null), 5 => (($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "general", array(), "any", false, true), "label-text-color", array(), "array", true, true)) ? ($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "general", array()), "label-text-color", array(), "array")) : (null))), "method");
        echo "
\t\t\t\t\t";
        // line 1236
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Small labels text font size:", 1 => "small-labels", 2 => "fonts", 3 => "general", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1237
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Small labels text font family:", 1 => "small-labels", 2 => "fonts", 3 => "general", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1238
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Small labels text color:", 1 => "small-labels", 2 => "fonts", 3 => "general", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1240
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Links text font size:", 1 => "links", 2 => "fonts", 3 => "general", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1241
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Links text font family:", 1 => "links", 2 => "fonts", 3 => "general", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1242
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Links text color:", 1 => "links", 2 => "fonts", 3 => "general", 4 => ($context["settings"] ?? null)), "method");
        echo "

\t\t\t\t\t<h3>";
        // line 1244
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Profile")), "html", null, true);
        echo "</h3>
\t\t\t\t\t";
        // line 1246
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "User name text font size:", 1 => "user-name", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1247
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "User name text font family:", 1 => "user-name", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1248
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "User name text color:", 1 => "user-name", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1250
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Counters text font size:", 1 => "counters", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1251
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Counters text font family:", 1 => "counters", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1252
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Counters text color:", 1 => "counters", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1254
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Counters label text font size:", 1 => "counters-label", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1255
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Counters label text font family:", 1 => "counters-label", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1256
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Counters label text color:", 1 => "counters-label", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1258
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Tab text font size:", 1 => "tab", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1259
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Tab text font family:", 1 => "tab", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1260
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Tab text color:", 1 => "tab", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1262
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Tab menu hover text font size:", 1 => "tab-menu-hover", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1263
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Tab menu hover text font family:", 1 => "tab-menu-hover", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1264
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Tab menu hover text color:", 1 => "tab-menu-hover", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1266
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Message text font size:", 1 => "message", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1267
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Message text font family:", 1 => "message", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1268
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Message text color:", 1 => "message", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => (($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "general", array(), "any", false, true), "input-text-color", array(), "array", true, true)) ? ($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "general", array()), "input-text-color", array(), "array")) : (null))), "method");
        echo "
\t\t\t\t\t";
        // line 1270
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Post buttons text font size:", 1 => "post-buttons", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1271
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Post buttons text color:", 1 => "post-buttons", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => (($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "general", array(), "any", false, true), "secondary-button-text-color", array(), "array", true, true)) ? ($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "general", array()), "secondary-button-text-color", array(), "array")) : (null))), "method");
        echo "
\t\t\t\t\t";
        // line 1273
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Post buttons hover text font size:", 1 => "post-buttons-hover", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1274
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Post buttons hover text color:", 1 => "post-buttons-hover", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1276
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Post user name text font size:", 1 => "post-user-name", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1277
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Post user name text font family:", 1 => "post-user-name", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1278
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Post user name text color:", 1 => "post-user-name", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1280
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Post text font size:", 1 => "post-text", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1281
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Post text font family:", 1 => "post-text", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1282
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Post text color:", 1 => "post-text", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1284
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Post other text font size:", 1 => "post-other-text", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1285
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Post other text font family:", 1 => "post-other-text", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1286
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Post other text color:", 1 => "post-other-text", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1288
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Post comment text font size:", 1 => "post-comment-text", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1289
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Post comment text font family:", 1 => "post-comment-text", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1290
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Post comment text color:", 1 => "post-comment-text", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1292
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Post date text font size:", 1 => "post-date", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1293
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Post date text font family:", 1 => "post-date", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1294
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Post date text color:", 1 => "post-date", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1296
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Post icons text font size:", 1 => "post-icons", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1297
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Post icons text font family:", 1 => "post-icons", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1298
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Post icons text color:", 1 => "post-icons", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1300
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Post icons hover text font size:", 1 => "post-icons-hover", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1301
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Post icons hover text font family:", 1 => "post-icons-hover", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1302
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Post icons hover text color:", 1 => "post-icons-hover", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1304
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Deleted Post entry text font size:", 1 => "deleted-post-entry", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1305
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Deleted Post entry text font family:", 1 => "deleted-post-entry", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1306
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Deleted Post entry text color:", 1 => "deleted-post-entry", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1308
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Menu text font size:", 1 => "menu", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1309
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Menu text font family:", 1 => "menu", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1310
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Menu text color:", 1 => "menu", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1312
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Menu hover text font size:", 1 => "menu-hover", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1313
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Menu hover text font family:", 1 => "menu-hover", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1314
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Menu hover text color:", 1 => "menu-hover", 2 => "fonts", 3 => "profile", 4 => ($context["settings"] ?? null)), "method");
        echo "

\t\t\t\t\t<h3>";
        // line 1316
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Members")), "html", null, true);
        echo "</h3>
\t\t\t\t\t";
        // line 1318
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "User name text font size:", 1 => "user-name", 2 => "fonts", 3 => "members", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1319
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "User name text font family:", 1 => "user-name", 2 => "fonts", 3 => "members", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1320
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "User name text color:", 1 => "user-name", 2 => "fonts", 3 => "members", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1322
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "User name hover text font size:", 1 => "user-name-hover", 2 => "fonts", 3 => "members", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1323
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "User name hover text font family:", 1 => "user-name-hover", 2 => "fonts", 3 => "members", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1324
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "User name hover text color:", 1 => "user-name-hover", 2 => "fonts", 3 => "members", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1326
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Counters text font size:", 1 => "counters", 2 => "fonts", 3 => "members", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1327
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Counters text font family:", 1 => "counters", 2 => "fonts", 3 => "members", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1328
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Counters text color:", 1 => "counters", 2 => "fonts", 3 => "members", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1330
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Counters label text font size:", 1 => "counters-label", 2 => "fonts", 3 => "members", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1331
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Counters label text font family:", 1 => "counters-label", 2 => "fonts", 3 => "members", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1332
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Counters label text color:", 1 => "counters-label", 2 => "fonts", 3 => "members", 4 => ($context["settings"] ?? null)), "method");
        echo "

\t\t\t\t\t<h3>";
        // line 1334
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Groups")), "html", null, true);
        echo "</h3>
\t\t\t\t\t";
        // line 1336
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Tab text font size:", 1 => "tab", 2 => "fonts", 3 => "groups", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1337
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Tab text font family:", 1 => "tab", 2 => "fonts", 3 => "groups", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1338
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Tab text color:", 1 => "tab", 2 => "fonts", 3 => "groups", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1340
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "User name text font size:", 1 => "user-name", 2 => "fonts", 3 => "groups", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1341
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "User name text font family:", 1 => "user-name", 2 => "fonts", 3 => "groups", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1342
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "User name text color:", 1 => "user-name", 2 => "fonts", 3 => "groups", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1344
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "User name hover text font size:", 1 => "user-name-hover", 2 => "fonts", 3 => "groups", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1345
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "User name hover text font family:", 1 => "user-name-hover", 2 => "fonts", 3 => "groups", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1346
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "User name hover text color:", 1 => "user-name-hover", 2 => "fonts", 3 => "groups", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1348
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Group type text font size:", 1 => "group-type", 2 => "fonts", 3 => "groups", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1349
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Group type text font family:", 1 => "group-type", 2 => "fonts", 3 => "groups", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1350
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Group type text color:", 1 => "group-type", 2 => "fonts", 3 => "groups", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1352
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Follower count text font size:", 1 => "follower-count", 2 => "fonts", 3 => "groups", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1353
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Follower count text font family:", 1 => "follower-count", 2 => "fonts", 3 => "groups", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1354
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Follower count text color:", 1 => "follower-count", 2 => "fonts", 3 => "groups", 4 => ($context["settings"] ?? null)), "method");
        echo "

\t\t\t\t\t<h3>";
        // line 1356
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Activity")), "html", null, true);
        echo "</h3>
\t\t\t\t\t";
        // line 1358
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Filter button text font size:", 1 => "filter-button", 2 => "fonts", 3 => "activity", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1359
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Filter button text font family:", 1 => "filter-button", 2 => "fonts", 3 => "activity", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1360
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Filter button text color:", 1 => "filter-button", 2 => "fonts", 3 => "activity", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1362
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Filter button hover text font size:", 1 => "filter-button-hover", 2 => "fonts", 3 => "activity", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1363
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Filter button hover text font family:", 1 => "filter-button-hover", 2 => "fonts", 3 => "activity", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1364
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Filter button hover text color:", 1 => "filter-button-hover", 2 => "fonts", 3 => "activity", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1366
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Filter button menu text font size:", 1 => "filter-button-menu", 2 => "fonts", 3 => "activity", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1367
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Filter button menu text font family:", 1 => "filter-button-menu", 2 => "fonts", 3 => "activity", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1368
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Filter button menu text color:", 1 => "filter-button-menu", 2 => "fonts", 3 => "activity", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1370
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Filter button menu hover text font size:", 1 => "filter-button-menu-hover", 2 => "fonts", 3 => "activity", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1371
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Filter button menu hover text font family:", 1 => "filter-button-menu-hover", 2 => "fonts", 3 => "activity", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1372
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Filter button menu hover text color:", 1 => "filter-button-menu-hover", 2 => "fonts", 3 => "activity", 4 => ($context["settings"] ?? null)), "method");
        echo "

\t\t\t\t\t";
        // line 1375
        echo "\t\t\t\t\t";
        // line 1376
        echo "
\t\t\t\t\t<h3>";
        // line 1377
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Search")), "html", null, true);
        echo "</h3>
\t\t\t\t\t";
        // line 1379
        echo "\t\t\t\t\t";
        echo $this->getAttribute($this, "getCheckBoxFontSizeSelector", array(0 => "Nothing is found text font size:", 1 => "nothing-found", 2 => "fonts", 3 => "search", 4 => ($context["settings"] ?? null), 5 => ($context["fontsSizeUnits"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1380
        echo $this->getAttribute($this, "getCheckBoxFontFamilySelector", array(0 => "Nothing is found text font family:", 1 => "nothing-found", 2 => "fonts", 3 => "search", 4 => ($context["settings"] ?? null), 5 => ($context["fontsList"] ?? null)), "method");
        echo "
\t\t\t\t\t";
        // line 1381
        echo $this->getAttribute($this, "getCheckBoxFontColorSelector", array(0 => "Nothing is found text color:", 1 => "nothing-found", 2 => "fonts", 3 => "search", 4 => ($context["settings"] ?? null)), "method");
        echo "
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>

\t<div class=\"sc-tab-content mbsGroupTabMenu\" data-tab=\"groups\">
\t\t";
        // line 1388
        if (($this->getAttribute($this->getAttribute(($context["baseSettings"] ?? null), "main", array(), "array"), "groups", array(), "array") == "true")) {
            // line 1389
            echo "\t\t\t<link rel=\"stylesheet\" type=\"text/css\" href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Base_Twig')->getAssetsPath("base", "lib/cropper/cropper.min.css"), "html", null, true);
            echo "\">
\t\t\t<script async type=\"text/javascript\" src=\"";
            // line 1390
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Base_Twig')->getAssetsPath("base", "lib/cropper/cropper.min.js"), "html", null, true);
            echo "\"></script>
\t\t\t<div class=\"mp-options\">
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-md-12\">

\t\t\t\t\t\t<div class=\"mp-option\" id=\"logo-size\">
\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t\t\t\t\t\t\t";
            // line 1398
            echo $context["options"]->getlabel(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Group Logo Size")));
            echo "
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"col-md-8\">
\t\t\t\t\t\t\t\t\t<div class=\"mp-option-sizes-input\">
\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
            // line 1403
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["groupsSettings"] ?? null), "logo-size", array(), "array"), "width", array()), "html", null, true);
            echo "\" name=\"groups[logo-size][width]\">
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<span>x</span>
\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
            // line 1407
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["groupsSettings"] ?? null), "logo-size", array(), "array"), "height", array()), "html", null, true);
            echo "\" name=\"groups[logo-size][height]\">
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"mp-option\" id=\"logo-large-size\">
\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t\t\t\t\t\t\t";
            // line 1417
            echo $context["options"]->getlabel(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Logo Thumbnail Large Size")));
            echo "
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"col-md-8\">
\t\t\t\t\t\t\t\t\t<div class=\"mp-option-sizes-input\">
\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
            // line 1422
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["groupsSettings"] ?? null), "logo-large-size", array(), "array"), "width", array()), "html", null, true);
            echo "\" name=\"groups[logo-large-size][width]\">
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<span>x</span>
\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
            // line 1426
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["groupsSettings"] ?? null), "logo-large-size", array(), "array"), "height", array()), "html", null, true);
            echo "\" name=\"groups[logo-large-size][height]\">
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"mp-option\" id=\"logo-medium-size\">
\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t\t\t\t\t\t\t";
            // line 1436
            echo $context["options"]->getlabel(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Logo Thumbnail Medium Size")));
            echo "
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"col-md-8\">
\t\t\t\t\t\t\t\t\t<div class=\"mp-option-sizes-input\">
\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
            // line 1441
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["groupsSettings"] ?? null), "logo-medium-size", array(), "array"), "width", array()), "html", null, true);
            echo "\" name=\"groups[logo-medium-size][width]\">
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<span>x</span>
\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
            // line 1445
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["groupsSettings"] ?? null), "logo-medium-size", array(), "array"), "height", array()), "html", null, true);
            echo "\" name=\"groups[logo-medium-size][height]\">
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"mp-option\" id=\"logo-small-size\">
\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t\t\t\t\t\t\t";
            // line 1455
            echo $context["options"]->getlabel(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Logo Thumbnail Small Size")));
            echo "
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"col-md-8\">
\t\t\t\t\t\t\t\t\t<div class=\"mp-option-sizes-input\">
\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
            // line 1460
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["groupsSettings"] ?? null), "logo-small-size", array(), "array"), "width", array()), "html", null, true);
            echo "\" name=\"groups[logo-small-size][width]\">
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<span>x</span>
\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
            // line 1464
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["groupsSettings"] ?? null), "logo-small-size", array(), "array"), "height", array()), "html", null, true);
            echo "\" name=\"groups[logo-small-size][height]\">
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t";
            // line 1471
            $context["defaultLogo"] = $this->env->getExtension('Membership_Base_Twig')->getAssetsPath("groups", "images/group.jpg", false);
            // line 1472
            echo "
\t\t\t\t\t\t<div class=\"mp-option\" id=\"default-logo\">
\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t\t\t\t\t\t\t";
            // line 1476
            echo $context["options"]->getlabel(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Default Logo Image")));
            echo "
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"col-md-8\">
\t\t\t\t\t\t\t\t\t<div class=\"mp-default-image\">
\t\t\t\t\t\t\t\t\t\t<img style=\"max-width:50px;max-height: 50px;\"
\t\t\t\t\t\t\t\t\t\t\t src=\"";
            // line 1481
            echo twig_escape_filter($this->env, $this->getAttribute(($context["groupsSettings"] ?? null), "default-logo", array(), "array"), "html", null, true);
            echo "\"
\t\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t\t<button class=\"mp-option-button sc-button primary mp-change\">Change</button>
\t\t\t\t\t\t\t\t\t\t<button class=\"mp-option-button sc-button primary mp-set-to-default\"
\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 1485
            if (((($context["defaultLogo"] ?? null) == $this->getAttribute(($context["groupsSettings"] ?? null), "default-logo", array(), "array")) || (($context["defaultLogo"] ?? null) == $this->getAttribute(($context["setting"] ?? null), "default-logo-source", array(), "array")))) {
                // line 1486
                echo "\t\t\t\t\t\t\t\t\t\t\t\t\tstyle=\"display: none\"
\t\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 1488
            echo "\t\t\t\t\t\t\t\t\t\t>Set to default</button>
\t\t\t\t\t\t\t\t\t\t<input
\t\t\t\t\t\t\t\t\t\t\t\ttype=\"hidden\"
\t\t\t\t\t\t\t\t\t\t\t\tname=\"groups[default-logo]\"
\t\t\t\t\t\t\t\t\t\t\t\tvalue=\"";
            // line 1492
            echo twig_escape_filter($this->env, $this->getAttribute(($context["groupsSettings"] ?? null), "default-logo", array(), "array"), "html", null, true);
            echo "\"
\t\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t\t<input
\t\t\t\t\t\t\t\t\t\t\t\ttype=\"hidden\"
\t\t\t\t\t\t\t\t\t\t\t\tname=\"groups[default-logo-large]\"
\t\t\t\t\t\t\t\t\t\t\t\tvalue=\"";
            // line 1497
            echo twig_escape_filter($this->env, $this->getAttribute(($context["groupsSettings"] ?? null), "default-logo-large", array(), "array"), "html", null, true);
            echo "\"
\t\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t\t<input
\t\t\t\t\t\t\t\t\t\t\t\ttype=\"hidden\"
\t\t\t\t\t\t\t\t\t\t\t\tname=\"groups[default-logo-medium]\"
\t\t\t\t\t\t\t\t\t\t\t\tvalue=\"";
            // line 1502
            echo twig_escape_filter($this->env, $this->getAttribute(($context["groupsSettings"] ?? null), "default-logo-medium", array(), "array"), "html", null, true);
            echo "\"
\t\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t\t<input
\t\t\t\t\t\t\t\t\t\t\t\ttype=\"hidden\"
\t\t\t\t\t\t\t\t\t\t\t\tname=\"groups[default-logo-small]\"
\t\t\t\t\t\t\t\t\t\t\t\tvalue=\"";
            // line 1507
            echo twig_escape_filter($this->env, $this->getAttribute(($context["groupsSettings"] ?? null), "default-logo-small", array(), "array"), "html", null, true);
            echo "\"
\t\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t\t<input
\t\t\t\t\t\t\t\t\t\t\t\ttype=\"hidden\"
\t\t\t\t\t\t\t\t\t\t\t\tname=\"groups[default-logo-source]\"
\t\t\t\t\t\t\t\t\t\t\t\tdata-default-width-input-name=\"groups[logo-size][width]\"
\t\t\t\t\t\t\t\t\t\t\t\tdata-default-height-input-name=\"groups[logo-size][height]\"
\t\t\t\t\t\t\t\t\t\t\t\tdata-default-crop-input-name=\"groups[default-logo-crop-data]\"
\t\t\t\t\t\t\t\t\t\t\t\tdata-default-image=\"";
            // line 1515
            echo twig_escape_filter($this->env, ($context["defaultLogo"] ?? null), "html", null, true);
            echo "\"
\t\t\t\t\t\t\t\t\t\t\t\tvalue=\"";
            // line 1516
            echo twig_escape_filter($this->env, $this->getAttribute(($context["groupsSettings"] ?? null), "default-logo-source", array(), "array"), "html", null, true);
            echo "\"
\t\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t\t<input
\t\t\t\t\t\t\t\t\t\t\t\ttype=\"hidden\"
\t\t\t\t\t\t\t\t\t\t\t\tname=\"groups[default-logo-crop-data]\"
\t\t\t\t\t\t\t\t\t\t\t\tvalue=\"";
            // line 1521
            echo twig_escape_filter($this->env, $this->getAttribute(($context["groupsSettings"] ?? null), "default-logo-crop-data", array(), "array"), "html", null, true);
            echo "\"
\t\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"mp-option\" id=\"cover-size\">
\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t\t\t\t\t\t\t";
            // line 1531
            echo $context["options"]->getlabel(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Group Cover Size")));
            echo "
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"col-md-8\">
\t\t\t\t\t\t\t\t\t<div class=\"mp-option-sizes-input\">
\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
            // line 1536
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["groupsSettings"] ?? null), "cover-size", array(), "array"), "width", array()), "html", null, true);
            echo "\" name=\"groups[cover-size][width]\">
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<span>x</span>
\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
            // line 1540
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["groupsSettings"] ?? null), "cover-size", array(), "array"), "height", array()), "html", null, true);
            echo "\" name=\"groups[cover-size][height]\">
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"mp-option\" id=\"cover-medium-size\">
\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t\t\t\t\t\t\t";
            // line 1550
            echo $context["options"]->getlabel(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Cover Thumbnail Medium Size")));
            echo "
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"col-md-8\">
\t\t\t\t\t\t\t\t\t<div class=\"mp-option-sizes-input\">
\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
            // line 1555
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["groupsSettings"] ?? null), "cover-medium-size", array(), "array"), "width", array()), "html", null, true);
            echo "\" name=\"groups[cover-medium-size][width]\">
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<span>x</span>
\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
            // line 1559
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["groupsSettings"] ?? null), "cover-medium-size", array(), "array"), "height", array()), "html", null, true);
            echo "\" name=\"groups[cover-medium-size][height]\">
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"mp-option\" id=\"cover-small-size\">
\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t\t\t\t\t\t\t";
            // line 1569
            echo $context["options"]->getlabel(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Cover Thumbnail Small Size")));
            echo "
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"col-md-8\">
\t\t\t\t\t\t\t\t\t<div class=\"mp-option-sizes-input\">
\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
            // line 1574
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["groupsSettings"] ?? null), "cover-small-size", array(), "array"), "width", array()), "html", null, true);
            echo "\" name=\"groups[cover-small-size][width]\">
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<span>x</span>
\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
            // line 1578
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["groupsSettings"] ?? null), "cover-small-size", array(), "array"), "height", array()), "html", null, true);
            echo "\" name=\"groups[cover-small-size][height]\">
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t";
            // line 1585
            $context["defaultCover"] = $this->env->getExtension('Membership_Base_Twig')->getAssetsPath("groups", "images/group-cover.jpg", false);
            // line 1586
            echo "
\t\t\t\t\t\t<div class=\"mp-option\" id=\"default-cover\">
\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t\t\t\t\t\t\t";
            // line 1590
            echo $context["options"]->getlabel(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Default Cover Image")));
            echo "
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"col-md-8\">
\t\t\t\t\t\t\t\t\t<div class=\"mp-default-image\">
\t\t\t\t\t\t\t\t\t\t<img style=\"max-width:50px;max-height: 50px;\"
\t\t\t\t\t\t\t\t\t\t\t src=\"";
            // line 1595
            echo twig_escape_filter($this->env, $this->getAttribute(($context["groupsSettings"] ?? null), "default-cover", array(), "array"), "html", null, true);
            echo "\"
\t\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t\t<button class=\"mp-option-button sc-button primary mp-change\">Change</button>
\t\t\t\t\t\t\t\t\t\t<button class=\"mp-option-button sc-button primary mp-set-to-default\"
\t\t\t\t\t\t\t\t\t\t\t\t";
            // line 1599
            if (((($context["defaultCover"] ?? null) == $this->getAttribute(($context["groupsSettings"] ?? null), "default-cover", array(), "array")) || (($context["defaultCover"] ?? null) == $this->getAttribute(($context["groupsSettings"] ?? null), "default-cover-source", array(), "array")))) {
                // line 1600
                echo "\t\t\t\t\t\t\t\t\t\t\t\t\tstyle=\"display: none\"
\t\t\t\t\t\t\t\t\t\t\t\t";
            }
            // line 1602
            echo "\t\t\t\t\t\t\t\t\t\t>Set to default</button>
\t\t\t\t\t\t\t\t\t\t<input
\t\t\t\t\t\t\t\t\t\t\t\ttype=\"hidden\"
\t\t\t\t\t\t\t\t\t\t\t\tname=\"groups[default-cover]\"
\t\t\t\t\t\t\t\t\t\t\t\tvalue=\"";
            // line 1606
            echo twig_escape_filter($this->env, $this->getAttribute(($context["groupsSettings"] ?? null), "default-cover", array(), "array"), "html", null, true);
            echo "\"
\t\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t\t<input
\t\t\t\t\t\t\t\t\t\t\t\ttype=\"hidden\"
\t\t\t\t\t\t\t\t\t\t\t\tname=\"groups[default-cover-medium]\"
\t\t\t\t\t\t\t\t\t\t\t\tvalue=\"";
            // line 1611
            echo twig_escape_filter($this->env, $this->getAttribute(($context["groupsSettings"] ?? null), "default-cover-medium", array(), "array"), "html", null, true);
            echo "\"
\t\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t\t<input
\t\t\t\t\t\t\t\t\t\t\t\ttype=\"hidden\"
\t\t\t\t\t\t\t\t\t\t\t\tname=\"groups[default-cover-small]\"
\t\t\t\t\t\t\t\t\t\t\t\tvalue=\"";
            // line 1616
            echo twig_escape_filter($this->env, $this->getAttribute(($context["groupsSettings"] ?? null), "default-cover-small", array(), "array"), "html", null, true);
            echo "\"
\t\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t\t<input
\t\t\t\t\t\t\t\t\t\t\t\ttype=\"hidden\"
\t\t\t\t\t\t\t\t\t\t\t\tname=\"groups[default-cover-source]\"
\t\t\t\t\t\t\t\t\t\t\t\tdata-default-image=\"";
            // line 1621
            echo twig_escape_filter($this->env, ($context["defaultCover"] ?? null), "html", null, true);
            echo "\"
\t\t\t\t\t\t\t\t\t\t\t\tdata-default-width-input-name=\"cover-size[width]\"
\t\t\t\t\t\t\t\t\t\t\t\tdata-default-height-input-name=\"cover-size[height]\"
\t\t\t\t\t\t\t\t\t\t\t\tdata-default-crop-input-name=\"default-cover-crop-data\"
\t\t\t\t\t\t\t\t\t\t\t\tvalue=\"";
            // line 1625
            echo twig_escape_filter($this->env, $this->getAttribute(($context["groupsSettings"] ?? null), "default-cover-source", array(), "array"), "html", null, true);
            echo "\"
\t\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t\t<input
\t\t\t\t\t\t\t\t\t\t\t\ttype=\"hidden\"
\t\t\t\t\t\t\t\t\t\t\t\tname=\"groups[default-cover-crop-data]\"
\t\t\t\t\t\t\t\t\t\t\t\tvalue=\"";
            // line 1630
            echo twig_escape_filter($this->env, $this->getAttribute(($context["groupsSettings"] ?? null), "default-cover-crop-data", array(), "array"), "html", null, true);
            echo "\"
\t\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t";
            // line 1637
            $context["permalinks"] = array(0 => array("value" => "groupalias", "title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Group alias")), "selected" => ($this->getAttribute(            // line 1641
($context["groupsSettings"] ?? null), "permalink-base", array(), "array") == "groupalias")), 1 => array("value" => "id", "title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Group ID")), "selected" => ($this->getAttribute(            // line 1646
($context["groupsSettings"] ?? null), "permalink-base", array(), "array") == "id")));
            // line 1649
            echo "
\t\t\t\t\t\t";
            // line 1650
            echo $context["options"]->getselectRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Group Permalink Base")),             // line 1652
($context["permalinks"] ?? null), "groups[permalink-base]", "permalink-base", null, array("mbsThinCol" => 1));
            // line 1656
            echo "

\t\t\t\t\t\t";
            // line 1658
            $context["_roles"] = array();
            // line 1659
            echo "
\t\t\t\t\t\t";
            // line 1660
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["roles"] ?? null));
            foreach ($context['_seq'] as $context["value"] => $context["role"]) {
                // line 1661
                echo "\t\t\t\t\t\t\t";
                $context["_roles"] = twig_array_merge(($context["_roles"] ?? null), array(0 => array("title" => $this->getAttribute(                // line 1662
$context["role"], "name", array()), "value" =>                 // line 1663
$context["value"], "selected" => ($this->getAttribute(                // line 1664
($context["groupsSettings"] ?? null), "roles-to-invite", array(), "array") == $context["value"]))));
                // line 1666
                echo "\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['value'], $context['role'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 1667
            echo "
\t\t\t\t\t\t";
            // line 1668
            $context["_types"] = array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("All")), "name" => "groups[inviting-type]", "value" => "all", "checked" => ($this->getAttribute(            // line 1672
($context["groupsSettings"] ?? null), "inviting-type", array(), "array") == "all")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Specific roles")), "name" => "groups[inviting-type]", "value" => "specific_roles", "checked" => ($this->getAttribute(            // line 1678
($context["groupsSettings"] ?? null), "inviting-type", array(), "array") == "specific_roles")));
            // line 1680
            echo "\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t";
        } else {
            // line 1684
            echo "\t\t\t<div>
\t\t\t\t<span>";
            // line 1685
            echo sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Groups option is Turn Off, you can turn it On on the Main settings tab or click <a href=\"%s\">here</a>.")), ($context["mainSettingsLink"] ?? null));
            echo "</span>
\t\t\t</div>
\t\t";
        }
        // line 1688
        echo "\t</div>



";
    }

    // line 1694
    public function getgetCheckBoxFontSizeSelector($__buttonName__ = null, $__itemCode__ = null, $__settProp1__ = null, $__settProp2__ = null, $__settings__ = null, $__fontsSizeUnits__ = null, $__defaultFontSize__ = null, $__defaultUnit__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "buttonName" => $__buttonName__,
            "itemCode" => $__itemCode__,
            "settProp1" => $__settProp1__,
            "settProp2" => $__settProp2__,
            "settings" => $__settings__,
            "fontsSizeUnits" => $__fontsSizeUnits__,
            "defaultFontSize" => $__defaultFontSize__,
            "defaultUnit" => $__defaultUnit__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 1695
            echo "\t";
            $context["options"] = $this->loadTemplate("@base/macros/options.twig", "@design/backend/index.twig", 1695);
            // line 1696
            echo "
\t";
            // line 1697
            echo $context["options"]->getcheckboxSettingRowWithInput(call_user_func_array($this->env->getFunction('translate')->getCallable(), array(            // line 1698
($context["buttonName"] ?? null))), array(0 => array("name" => (((((            // line 1700
($context["settProp1"] ?? null) . "[") . ($context["settProp2"] ?? null)) . "][") . ($context["itemCode"] ?? null)) . "-text-font-size-check]"), "value" => 1, "checked" => ((($this->getAttribute($this->getAttribute($this->getAttribute(            // line 1702
($context["settings"] ?? null), ($context["settProp1"] ?? null), array(), "array"), ($context["settProp2"] ?? null), array(), "array"), (($context["itemCode"] ?? null) . "-text-font-size-check"), array(), "array") == 1)) ? (1) : (null)), "attributes" => (("id=\"" .             // line 1703
($context["itemCode"] ?? null)) . "-text-font-size-check\" class=\"mbs-checkbox-for-enable\""))), (            // line 1705
$context["options"]->getinput("number", (((((            // line 1707
($context["settProp1"] ?? null) . "[") . ($context["settProp2"] ?? null)) . "][") . ($context["itemCode"] ?? null)) . "-text-font-size-number]"), _twig_default_filter((($this->getAttribute($this->getAttribute($this->getAttribute(            // line 1708
($context["settings"] ?? null), ($context["settProp1"] ?? null), array(), "array", false, true), ($context["settProp2"] ?? null), array(), "array", false, true), (($context["itemCode"] ?? null) . "-text-font-size-number"), array(), "array", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), ($context["settProp1"] ?? null), array(), "array", false, true), ($context["settProp2"] ?? null), array(), "array", false, true), (($context["itemCode"] ?? null) . "-text-font-size-number"), array(), "array"), ($context["defaultFontSize"] ?? null))) : (($context["defaultFontSize"] ?? null))), 16), array("id" => (            // line 1709
($context["itemCode"] ?? null) . "-text-font-size-number"), "class" => "mbs-number-units-width", "pattern" => "[0-9]")) .             // line 1710
$context["options"]->getselectInput2(            // line 1711
($context["fontsSizeUnits"] ?? null), _twig_default_filter((($this->getAttribute($this->getAttribute($this->getAttribute(            // line 1712
($context["settings"] ?? null), ($context["settProp1"] ?? null), array(), "array", false, true), ($context["settProp2"] ?? null), array(), "array", false, true), (($context["itemCode"] ?? null) . "-text-font-unit-select"), array(), "array", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), ($context["settProp1"] ?? null), array(), "array", false, true), ($context["settProp2"] ?? null), array(), "array", false, true), (($context["itemCode"] ?? null) . "-text-font-unit-select"), array(), "array"), ($context["defaultUnit"] ?? null))) : (($context["defaultUnit"] ?? null))), "px"), array("id" => (            // line 1714
($context["itemCode"] ?? null) . "-text-font-unit-select"), "class" => "mbs-selector-unit-width sc-input", "name" => (((((            // line 1716
($context["settProp1"] ?? null) . "[") . ($context["settProp2"] ?? null)) . "][") . ($context["itemCode"] ?? null)) . "-text-font-unit-select]")))), null, null, null, array("mbsThinCol" => 1));
            // line 1720
            echo "
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

    // line 1723
    public function getgetCheckBoxFontFamilySelector($__buttonName__ = null, $__itemCode__ = null, $__settProp1__ = null, $__settProp2__ = null, $__settings__ = null, $__fontsList__ = null, $__defaultFontName__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "buttonName" => $__buttonName__,
            "itemCode" => $__itemCode__,
            "settProp1" => $__settProp1__,
            "settProp2" => $__settProp2__,
            "settings" => $__settings__,
            "fontsList" => $__fontsList__,
            "defaultFontName" => $__defaultFontName__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 1724
            echo "\t";
            $context["options"] = $this->loadTemplate("@base/macros/options.twig", "@design/backend/index.twig", 1724);
            // line 1725
            echo "\t";
            echo $context["options"]->getcheckboxSettingRowWithInput(call_user_func_array($this->env->getFunction('translate')->getCallable(), array(            // line 1726
($context["buttonName"] ?? null))), array(0 => array("name" => (((((            // line 1728
($context["settProp1"] ?? null) . "[") . ($context["settProp2"] ?? null)) . "][") . ($context["itemCode"] ?? null)) . "-text-font-family-check]"), "value" => 1, "checked" => ((($this->getAttribute($this->getAttribute($this->getAttribute(            // line 1730
($context["settings"] ?? null), ($context["settProp1"] ?? null), array(), "array"), ($context["settProp2"] ?? null), array(), "array"), (($context["itemCode"] ?? null) . "-text-font-family-check"), array(), "array") == 1)) ? (1) : (null)), "attributes" => (("id=\"" .             // line 1731
($context["itemCode"] ?? null)) . "-text-font-family-check\" class=\"mbs-checkbox-for-enable\""))),             // line 1733
$context["options"]->getselectInput2(            // line 1734
($context["fontsList"] ?? null), _twig_default_filter((($this->getAttribute($this->getAttribute($this->getAttribute(            // line 1735
($context["settings"] ?? null), ($context["settProp1"] ?? null), array(), "array", false, true), ($context["settProp2"] ?? null), array(), "array", false, true), (($context["itemCode"] ?? null) . "-text-font-family-select"), array(), "array", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), ($context["settProp1"] ?? null), array(), "array", false, true), ($context["settProp2"] ?? null), array(), "array", false, true), (($context["itemCode"] ?? null) . "-text-font-family-select"), array(), "array"), ($context["defaultFontName"] ?? null))) : (($context["defaultFontName"] ?? null))), "initial"), array("id" => (            // line 1737
($context["itemCode"] ?? null) . "-text-font-family-select"), "class" => "mbs-cwib-selector-width sc-input", "name" => (((((            // line 1739
($context["settProp1"] ?? null) . "[") . ($context["settProp2"] ?? null)) . "][") . ($context["itemCode"] ?? null)) . "-text-font-family-select]")), 1), null, null, null, array("mbsThinCol" => 1));
            // line 1744
            echo "
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

    // line 1747
    public function getgetCheckBoxFontColorSelector($__buttonName__ = null, $__itemCode__ = null, $__settProp1__ = null, $__settProp2__ = null, $__settings__ = null, $__defaultColor__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "buttonName" => $__buttonName__,
            "itemCode" => $__itemCode__,
            "settProp1" => $__settProp1__,
            "settProp2" => $__settProp2__,
            "settings" => $__settings__,
            "defaultColor" => $__defaultColor__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 1748
            echo "\t";
            $context["options"] = $this->loadTemplate("@base/macros/options.twig", "@design/backend/index.twig", 1748);
            // line 1749
            echo "\t";
            echo $context["options"]->getcheckboxSettingRowWithInput(call_user_func_array($this->env->getFunction('translate')->getCallable(), array(            // line 1750
($context["buttonName"] ?? null))), array(0 => array("name" => (((((            // line 1752
($context["settProp1"] ?? null) . "[") . ($context["settProp2"] ?? null)) . "][") . ($context["itemCode"] ?? null)) . "-text-color-check]"), "value" => 1, "checked" => (((($this->getAttribute($this->getAttribute($this->getAttribute(            // line 1754
($context["settings"] ?? null), ($context["settProp1"] ?? null), array(), "array"), ($context["settProp2"] ?? null), array(), "array"), (($context["itemCode"] ?? null) . "-text-color-check"), array(), "array") == 1) || (($context["defaultColor"] ?? null) != null))) ? (1) : (null)), "attributes" => (("id=\"" .             // line 1755
($context["itemCode"] ?? null)) . "-text-color-check\" class=\"mbs-checkbox-for-enable\""))),             // line 1757
$context["options"]->getcolorInput2(array("id" => (            // line 1758
($context["itemCode"] ?? null) . "-text-color-input"), "class" => "mbs-cwib-selector-width sc-input", "name" => (((((            // line 1760
($context["settProp1"] ?? null) . "[") . ($context["settProp2"] ?? null)) . "][") . ($context["itemCode"] ?? null)) . "-text-color-input]"), "value" => _twig_default_filter((($this->getAttribute($this->getAttribute($this->getAttribute(            // line 1761
($context["settings"] ?? null), ($context["settProp1"] ?? null), array(), "array", false, true), ($context["settProp2"] ?? null), array(), "array", false, true), (($context["itemCode"] ?? null) . "-text-color-input"), array(), "array", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), ($context["settProp1"] ?? null), array(), "array", false, true), ($context["settProp2"] ?? null), array(), "array", false, true), (($context["itemCode"] ?? null) . "-text-color-input"), array(), "array"), ($context["defaultColor"] ?? null))) : (($context["defaultColor"] ?? null))), "rgba(0, 0, 0, 1)"))), null, null, null, array("mbsThinCol" => 1));
            // line 1764
            echo "
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
        return "@design/backend/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  2031 => 1764,  2029 => 1761,  2028 => 1760,  2027 => 1758,  2026 => 1757,  2025 => 1755,  2024 => 1754,  2023 => 1752,  2022 => 1750,  2020 => 1749,  2017 => 1748,  2000 => 1747,  1984 => 1744,  1982 => 1739,  1981 => 1737,  1980 => 1735,  1979 => 1734,  1978 => 1733,  1977 => 1731,  1976 => 1730,  1975 => 1728,  1974 => 1726,  1972 => 1725,  1969 => 1724,  1951 => 1723,  1935 => 1720,  1933 => 1716,  1932 => 1714,  1931 => 1712,  1930 => 1711,  1929 => 1710,  1928 => 1709,  1927 => 1708,  1926 => 1707,  1925 => 1705,  1924 => 1703,  1923 => 1702,  1922 => 1700,  1921 => 1698,  1920 => 1697,  1917 => 1696,  1914 => 1695,  1895 => 1694,  1887 => 1688,  1881 => 1685,  1878 => 1684,  1872 => 1680,  1870 => 1678,  1869 => 1672,  1868 => 1668,  1865 => 1667,  1859 => 1666,  1857 => 1664,  1856 => 1663,  1855 => 1662,  1853 => 1661,  1849 => 1660,  1846 => 1659,  1844 => 1658,  1840 => 1656,  1838 => 1652,  1837 => 1650,  1834 => 1649,  1832 => 1646,  1831 => 1641,  1830 => 1637,  1820 => 1630,  1812 => 1625,  1805 => 1621,  1797 => 1616,  1789 => 1611,  1781 => 1606,  1775 => 1602,  1771 => 1600,  1769 => 1599,  1762 => 1595,  1754 => 1590,  1748 => 1586,  1746 => 1585,  1736 => 1578,  1729 => 1574,  1721 => 1569,  1708 => 1559,  1701 => 1555,  1693 => 1550,  1680 => 1540,  1673 => 1536,  1665 => 1531,  1652 => 1521,  1644 => 1516,  1640 => 1515,  1629 => 1507,  1621 => 1502,  1613 => 1497,  1605 => 1492,  1599 => 1488,  1595 => 1486,  1593 => 1485,  1586 => 1481,  1578 => 1476,  1572 => 1472,  1570 => 1471,  1560 => 1464,  1553 => 1460,  1545 => 1455,  1532 => 1445,  1525 => 1441,  1517 => 1436,  1504 => 1426,  1497 => 1422,  1489 => 1417,  1476 => 1407,  1469 => 1403,  1461 => 1398,  1450 => 1390,  1445 => 1389,  1443 => 1388,  1433 => 1381,  1429 => 1380,  1424 => 1379,  1420 => 1377,  1417 => 1376,  1415 => 1375,  1410 => 1372,  1406 => 1371,  1401 => 1370,  1397 => 1368,  1393 => 1367,  1388 => 1366,  1384 => 1364,  1380 => 1363,  1375 => 1362,  1371 => 1360,  1367 => 1359,  1362 => 1358,  1358 => 1356,  1353 => 1354,  1349 => 1353,  1344 => 1352,  1340 => 1350,  1336 => 1349,  1331 => 1348,  1327 => 1346,  1323 => 1345,  1318 => 1344,  1314 => 1342,  1310 => 1341,  1305 => 1340,  1301 => 1338,  1297 => 1337,  1292 => 1336,  1288 => 1334,  1283 => 1332,  1279 => 1331,  1274 => 1330,  1270 => 1328,  1266 => 1327,  1261 => 1326,  1257 => 1324,  1253 => 1323,  1248 => 1322,  1244 => 1320,  1240 => 1319,  1235 => 1318,  1231 => 1316,  1226 => 1314,  1222 => 1313,  1217 => 1312,  1213 => 1310,  1209 => 1309,  1204 => 1308,  1200 => 1306,  1196 => 1305,  1191 => 1304,  1187 => 1302,  1183 => 1301,  1178 => 1300,  1174 => 1298,  1170 => 1297,  1165 => 1296,  1161 => 1294,  1157 => 1293,  1152 => 1292,  1148 => 1290,  1144 => 1289,  1139 => 1288,  1135 => 1286,  1131 => 1285,  1126 => 1284,  1122 => 1282,  1118 => 1281,  1113 => 1280,  1109 => 1278,  1105 => 1277,  1100 => 1276,  1096 => 1274,  1091 => 1273,  1087 => 1271,  1082 => 1270,  1078 => 1268,  1074 => 1267,  1069 => 1266,  1065 => 1264,  1061 => 1263,  1056 => 1262,  1052 => 1260,  1048 => 1259,  1043 => 1258,  1039 => 1256,  1035 => 1255,  1030 => 1254,  1026 => 1252,  1022 => 1251,  1017 => 1250,  1013 => 1248,  1009 => 1247,  1004 => 1246,  1000 => 1244,  995 => 1242,  991 => 1241,  986 => 1240,  982 => 1238,  978 => 1237,  973 => 1236,  969 => 1234,  965 => 1233,  960 => 1232,  956 => 1230,  952 => 1229,  947 => 1228,  943 => 1226,  939 => 1225,  934 => 1224,  930 => 1222,  926 => 1221,  921 => 1220,  917 => 1218,  913 => 1217,  908 => 1216,  904 => 1214,  897 => 1209,  895 => 1199,  885 => 1191,  883 => 1188,  882 => 1186,  878 => 1184,  876 => 1181,  875 => 1179,  871 => 1177,  869 => 1174,  868 => 1172,  862 => 1168,  860 => 1164,  859 => 1158,  858 => 1153,  854 => 1151,  852 => 1147,  851 => 1141,  850 => 1136,  846 => 1134,  844 => 1130,  843 => 1124,  842 => 1119,  837 => 1116,  835 => 1112,  834 => 1106,  833 => 1101,  829 => 1099,  827 => 1093,  826 => 1089,  822 => 1087,  820 => 1081,  819 => 1077,  815 => 1075,  813 => 1071,  812 => 1065,  811 => 1060,  807 => 1058,  805 => 1054,  804 => 1048,  803 => 1043,  797 => 1039,  795 => 1035,  794 => 1029,  793 => 1024,  789 => 1022,  787 => 1018,  786 => 1012,  785 => 1007,  781 => 1005,  779 => 1001,  778 => 995,  777 => 990,  773 => 988,  771 => 984,  770 => 978,  769 => 973,  765 => 971,  763 => 967,  762 => 961,  761 => 956,  756 => 953,  754 => 949,  753 => 943,  752 => 938,  745 => 933,  743 => 928,  742 => 923,  741 => 918,  740 => 913,  739 => 908,  738 => 904,  734 => 902,  732 => 898,  731 => 892,  730 => 887,  725 => 884,  723 => 880,  722 => 874,  721 => 869,  716 => 866,  714 => 862,  713 => 856,  712 => 851,  707 => 848,  705 => 844,  704 => 838,  703 => 833,  698 => 830,  696 => 826,  695 => 820,  694 => 815,  689 => 812,  687 => 808,  686 => 807,  683 => 806,  677 => 805,  675 => 803,  674 => 802,  673 => 801,  671 => 800,  667 => 799,  664 => 798,  662 => 796,  661 => 793,  656 => 791,  640 => 777,  638 => 772,  637 => 767,  636 => 763,  631 => 760,  629 => 755,  628 => 750,  627 => 746,  623 => 744,  621 => 739,  620 => 734,  619 => 730,  615 => 728,  613 => 725,  612 => 723,  607 => 720,  605 => 717,  604 => 715,  598 => 711,  596 => 707,  595 => 701,  594 => 696,  590 => 694,  588 => 690,  587 => 684,  586 => 679,  581 => 676,  579 => 672,  578 => 666,  577 => 661,  573 => 659,  571 => 656,  570 => 654,  566 => 652,  564 => 649,  563 => 647,  559 => 645,  557 => 641,  556 => 635,  555 => 630,  551 => 628,  549 => 625,  548 => 623,  543 => 621,  539 => 619,  537 => 616,  536 => 614,  532 => 612,  530 => 609,  529 => 607,  523 => 604,  508 => 591,  506 => 587,  505 => 581,  504 => 576,  499 => 573,  497 => 570,  496 => 568,  492 => 566,  490 => 563,  489 => 561,  475 => 549,  473 => 545,  472 => 539,  471 => 534,  467 => 532,  465 => 528,  464 => 522,  463 => 517,  459 => 515,  457 => 511,  456 => 505,  455 => 500,  451 => 498,  449 => 494,  448 => 488,  447 => 483,  443 => 481,  441 => 477,  440 => 471,  439 => 466,  435 => 464,  433 => 460,  432 => 454,  431 => 449,  427 => 447,  425 => 441,  423 => 440,  420 => 439,  417 => 438,  414 => 437,  412 => 433,  408 => 431,  406 => 425,  404 => 424,  401 => 423,  398 => 422,  395 => 421,  393 => 417,  389 => 415,  387 => 411,  386 => 405,  385 => 400,  381 => 398,  379 => 394,  378 => 388,  377 => 383,  373 => 381,  371 => 377,  370 => 371,  369 => 366,  364 => 364,  360 => 362,  358 => 358,  357 => 353,  356 => 348,  355 => 344,  351 => 342,  349 => 338,  348 => 332,  347 => 327,  342 => 325,  328 => 313,  326 => 309,  325 => 303,  324 => 298,  316 => 293,  313 => 292,  311 => 283,  310 => 282,  309 => 281,  302 => 276,  300 => 272,  299 => 266,  298 => 261,  282 => 247,  280 => 246,  279 => 244,  278 => 242,  274 => 240,  272 => 236,  271 => 230,  270 => 225,  266 => 223,  264 => 220,  263 => 218,  259 => 216,  257 => 213,  256 => 211,  252 => 209,  250 => 206,  249 => 204,  245 => 202,  243 => 199,  242 => 197,  238 => 195,  236 => 192,  235 => 190,  231 => 188,  229 => 185,  228 => 183,  224 => 181,  222 => 178,  221 => 176,  216 => 174,  212 => 172,  210 => 169,  209 => 167,  205 => 165,  203 => 162,  202 => 160,  197 => 157,  195 => 149,  194 => 147,  193 => 145,  192 => 142,  191 => 137,  187 => 135,  185 => 132,  184 => 130,  180 => 128,  178 => 125,  177 => 123,  173 => 121,  171 => 118,  170 => 116,  166 => 114,  164 => 111,  163 => 109,  159 => 107,  157 => 104,  156 => 102,  152 => 100,  150 => 97,  149 => 95,  144 => 93,  140 => 91,  138 => 87,  137 => 81,  136 => 76,  132 => 74,  130 => 70,  129 => 64,  128 => 58,  127 => 53,  121 => 50,  113 => 44,  110 => 43,  103 => 39,  100 => 38,  97 => 37,  89 => 32,  82 => 28,  76 => 25,  70 => 22,  64 => 19,  58 => 16,  52 => 13,  46 => 10,  40 => 7,  36 => 5,  33 => 4,  29 => 1,  27 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@design/backend/index.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Design\\views\\backend\\index.twig");
    }
}
