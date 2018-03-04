<?php

/* @users/backend/index.twig */
class __TwigTemplate_132f2ae054f57d0dd9d6280c150fbacf2e3aed8d8a033cb8ead09afc3c62b4e7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@base/layouts/backend.twig", "@users/backend/index.twig", 1);
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
        $context["options"] = $this->loadTemplate("@base/macros/options.twig", "@users/backend/index.twig", 2);
        // line 3
        $context["tooltips"] = $this->loadTemplate("@base/macros/tooltips-templates.twig", "@users/backend/index.twig", 3);
        // line 4
        $context["pagination"] = $this->loadTemplate("@base/macros/pagination.twig", "@users/backend/index.twig", 4);
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 25
    public function block_head($context, array $blocks = array())
    {
        // line 26
        echo "\t<div class=\"sc-tabs\">
\t\t<a href=\"#\" class=\"tab active\" data-target=\"main\">
\t\t\t<i class=\"fa fa-user\"></i>";
        // line 28
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Main")), "html", null, true);
        echo "
\t\t</a>
\t\t<a href=\"#\" class=\"tab\" data-target=\"fields\">
\t\t\t<i class=\"fa fa-list-alt\"></i>";
        // line 31
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("User Fields")), "html", null, true);
        echo "
\t\t</a>
\t\t";
        // line 34
        echo "\t\t\t";
        // line 35
        echo "\t\t\t";
        // line 36
        echo "\t\t";
        // line 37
        echo "\t</div>
";
    }

    // line 40
    public function block_main($context, array $blocks = array())
    {
        // line 41
        echo "
    <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 42
        echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Base_Twig')->getAssetsPath("base", "lib/cropper/cropper.min.css"), "html", null, true);
        echo "\">
    <script async type=\"text/javascript\" src=\"";
        // line 43
        echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Base_Twig')->getAssetsPath("base", "lib/cropper/cropper.min.js"), "html", null, true);
        echo "\"></script>

\t";
        // line 45
        $context["f"] = $this;
        // line 46
        echo "\t<div class=\"sc-tabs-container\">
\t\t<div class=\"sc-tab-content mbsProfileTabMenu active\" data-tab=\"main\">
\t\t\t
\t\t\t<div class=\"sc-header\">
\t\t\t\t<h2>";
        // line 50
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Profile")), "html", null, true);
        echo "</h2>
\t\t\t\t<button data-save-settings class=\"save-settings sc-button icon-button primary\">
\t\t\t\t\t<i class=\"fa fa-save\"></i>
\t\t\t\t\t<span>";
        // line 53
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Save Settings")), "html", null, true);
        echo "</span>
\t\t\t\t</button>
\t\t\t</div>
\t\t\t
\t\t\t<div class=\"mp-options\">
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-md-12\">
\t\t\t\t\t
\t\t\t\t\t";
        // line 61
        $context["_roles"] = array();
        // line 62
        echo "\t
\t\t\t\t\t";
        // line 63
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["roles"] ?? null));
        foreach ($context['_seq'] as $context["value"] => $context["role"]) {
            // line 64
            echo "\t\t\t\t\t\t";
            $context["_roles"] = twig_array_merge(($context["_roles"] ?? null), array(0 => array("title" => $this->getAttribute(            // line 65
$context["role"], "name", array()), "value" => $this->getAttribute(            // line 66
$context["role"], "id", array()), "selected" => ($this->getAttribute(            // line 67
($context["settings"] ?? null), "default-role", array(), "array") == $this->getAttribute($context["role"], "id", array())))));
            // line 69
            echo "\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['value'], $context['role'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 70
        echo "
\t\t\t\t\t";
        // line 71
        echo $context["options"]->getselectRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Default User role")),         // line 72
($context["_roles"] ?? null), "default-role", "default-role", null, array("mbsThinCol" => 1));
        // line 77
        echo "

\t\t\t\t\t";
        // line 79
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Use Profile Avatar")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "use-avatar", "value" => "yes", "checked" => ($this->getAttribute(        // line 84
($context["settings"] ?? null), "use-avatar", array(), "array") == "yes")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "use-avatar", "value" => "no", "checked" => ($this->getAttribute(        // line 90
($context["settings"] ?? null), "use-avatar", array(), "array") == "no"))), "use-avatar", null, null, array("mbsThinCol" => 1));
        // line 94
        echo "

\t\t\t\t\t";
        // line 96
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Use Profile Gravatar")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "use-gravatar", "value" => "yes", "checked" => ($this->getAttribute(        // line 101
($context["settings"] ?? null), "use-gravatar", array(), "array") == "yes")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "use-gravatar", "value" => "no", "checked" => ($this->getAttribute(        // line 107
($context["settings"] ?? null), "use-gravatar", array(), "array") == "no"))), "use-gravatar", null, null, array("mbsThinCol" => 1));
        // line 111
        echo "

\t\t\t\t\t<div class=\"mp-option\" id=\"avatar-size\">
\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t\t\t\t\t\t";
        // line 116
        echo $context["options"]->getlabel(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Profile Avatar Size")));
        echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-8\">
\t\t\t\t\t\t\t\t<div class=\"mp-option-sizes-input\">
\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
        // line 121
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["settings"] ?? null), "avatar-size", array(), "array"), "width", array()), "html", null, true);
        echo "\" name=\"avatar-size[width]\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<span>x</span>
\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
        // line 125
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["settings"] ?? null), "avatar-size", array(), "array"), "height", array()), "html", null, true);
        echo "\" name=\"avatar-size[height]\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t\t<div class=\"mp-option\" id=\"avatar-large-size\">
\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t\t\t\t\t\t";
        // line 135
        echo $context["options"]->getlabel(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Avatar Thumbnail Large Size")));
        echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-8\">
\t\t\t\t\t\t\t\t<div class=\"mp-option-sizes-input\">
\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
        // line 140
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["settings"] ?? null), "avatar-large-size", array(), "array"), "width", array()), "html", null, true);
        echo "\" name=\"avatar-large-size[width]\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<span>x</span>
\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
        // line 144
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["settings"] ?? null), "avatar-large-size", array(), "array"), "height", array()), "html", null, true);
        echo "\" name=\"avatar-large-size[height]\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t\t<div class=\"mp-option\" id=\"avatar-medium-size\">
\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t\t\t\t\t\t";
        // line 154
        echo $context["options"]->getlabel(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Avatar Thumbnail Medium Size")));
        echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-8\">
\t\t\t\t\t\t\t\t<div class=\"mp-option-sizes-input\">
\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
        // line 159
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["settings"] ?? null), "avatar-medium-size", array(), "array"), "width", array()), "html", null, true);
        echo "\" name=\"avatar-medium-size[width]\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<span>x</span>
\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
        // line 163
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["settings"] ?? null), "avatar-medium-size", array(), "array"), "height", array()), "html", null, true);
        echo "\" name=\"avatar-medium-size[height]\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t\t<div class=\"mp-option\" id=\"avatar-small-size\">
\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t\t\t\t\t\t";
        // line 173
        echo $context["options"]->getlabel(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Avatar Thumbnail Small Size")));
        echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-8\">
\t\t\t\t\t\t\t\t<div class=\"mp-option-sizes-input\">
\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
        // line 178
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["settings"] ?? null), "avatar-small-size", array(), "array"), "width", array()), "html", null, true);
        echo "\" name=\"avatar-small-size[width]\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<span>x</span>
\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
        // line 182
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["settings"] ?? null), "avatar-small-size", array(), "array"), "height", array()), "html", null, true);
        echo "\" name=\"avatar-small-size[height]\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t\t

                    ";
        // line 190
        $context["defaultAvatar"] = $this->env->getExtension('Membership_Base_Twig')->getAssetsPath("users", "images/user.jpg", false);
        // line 191
        echo "
\t\t\t\t\t<div class=\"mp-option\" id=\"default-avatar\">
\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t\t\t\t\t\t";
        // line 195
        echo $context["options"]->getlabel(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Default Avatar Image")));
        echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-8\">
\t\t\t\t\t\t\t\t<div class=\"mp-default-image\">
\t\t\t\t\t\t\t\t\t<img style=\"max-width:50px;max-height: 50px;\"
\t\t\t\t\t\t\t\t\t\tsrc=\"";
        // line 200
        echo twig_escape_filter($this->env, $this->getAttribute(($context["settings"] ?? null), "default-avatar", array(), "array"), "html", null, true);
        echo "\"
\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t<button class=\"mp-option-button sc-button primary mp-change\">";
        // line 202
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Change")), "html", null, true);
        echo "</button>
\t\t\t\t\t\t\t\t\t<button class=\"mp-option-button sc-button primary mp-set-to-default\"
\t\t\t\t\t\t\t\t\t\t";
        // line 204
        if (((($context["defaultAvatar"] ?? null) == $this->getAttribute(($context["settings"] ?? null), "default-avatar", array(), "array")) || (($context["defaultAvatar"] ?? null) == $this->getAttribute(($context["settings"] ?? null), "default-avatar-source", array(), "array")))) {
            // line 205
            echo "\t\t\t\t\t\t\t\t\t\t\tstyle=\"display: none\" 
\t\t\t\t\t\t\t\t\t\t";
        }
        // line 207
        echo "\t\t\t\t\t\t\t\t\t>";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Set to default")), "html", null, true);
        echo "</button>
\t\t\t\t\t\t\t\t\t<input
\t\t\t\t\t\t\t\t\t\ttype=\"hidden\"
\t\t\t\t\t\t\t\t\t\tname=\"default-avatar\"
\t\t\t\t\t\t\t\t\t\tvalue=\"";
        // line 211
        echo twig_escape_filter($this->env, $this->getAttribute(($context["settings"] ?? null), "default-avatar", array(), "array"), "html", null, true);
        echo "\"
\t\t\t\t\t\t\t\t\t>
                                    <input
                                            type=\"hidden\"
                                            name=\"default-avatar-large\"
                                            value=\"";
        // line 216
        echo twig_escape_filter($this->env, $this->getAttribute(($context["settings"] ?? null), "default-avatar-large", array(), "array"), "html", null, true);
        echo "\"
                                    >
                                    <input
                                            type=\"hidden\"
                                            name=\"default-avatar-medium\"
                                            value=\"";
        // line 221
        echo twig_escape_filter($this->env, $this->getAttribute(($context["settings"] ?? null), "default-avatar-medium", array(), "array"), "html", null, true);
        echo "\"
                                    >
                                    <input
                                            type=\"hidden\"
                                            name=\"default-avatar-small\"
                                            value=\"";
        // line 226
        echo twig_escape_filter($this->env, $this->getAttribute(($context["settings"] ?? null), "default-avatar-small", array(), "array"), "html", null, true);
        echo "\"
                                    >
                                    <input
                                            type=\"hidden\"
                                            name=\"default-avatar-source\"
                                            data-default-width-input-name=\"avatar-size[width]\"
                                            data-default-height-input-name=\"avatar-size[height]\"
                                            data-default-crop-input-name=\"default-avatar-crop-data\"
                                            data-default-image=\"";
        // line 234
        echo twig_escape_filter($this->env, ($context["defaultAvatar"] ?? null), "html", null, true);
        echo "\"
                                            value=\"";
        // line 235
        echo twig_escape_filter($this->env, $this->getAttribute(($context["settings"] ?? null), "default-avatar-source", array(), "array"), "html", null, true);
        echo "\"
                                    >
                                    <input
                                            type=\"hidden\"
                                            name=\"default-avatar-crop-data\"
                                            value=\"";
        // line 240
        echo twig_escape_filter($this->env, $this->getAttribute(($context["settings"] ?? null), "default-avatar-crop-data", array(), "array"), "html", null, true);
        echo "\"
                                    >
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>


\t\t\t\t\t";
        // line 248
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Use Profile Cover")), array(0 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Yes")), "name" => "use-cover", "value" => "yes", "checked" => ($this->getAttribute(        // line 253
($context["settings"] ?? null), "use-cover", array(), "array") == "yes")), 1 => array("label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No")), "name" => "use-cover", "value" => "no", "checked" => ($this->getAttribute(        // line 259
($context["settings"] ?? null), "use-cover", array(), "array") == "no"))), "use-cover", null, null, array("mbsThinCol" => 1));
        // line 263
        echo "

\t\t\t\t\t<div class=\"mp-option\" id=\"cover-size\">
\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t\t\t\t\t\t";
        // line 268
        echo $context["options"]->getlabel(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Profile Cover Size")));
        echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-8\">
\t\t\t\t\t\t\t\t<div class=\"mp-option-sizes-input\">
\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
        // line 273
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["settings"] ?? null), "cover-size", array(), "array"), "width", array()), "html", null, true);
        echo "\" name=\"cover-size[width]\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<span>x</span>
\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
        // line 277
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["settings"] ?? null), "cover-size", array(), "array"), "height", array()), "html", null, true);
        echo "\" name=\"cover-size[height]\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t\t<div class=\"mp-option\" id=\"cover-small-size\">
\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t\t\t\t\t\t";
        // line 287
        echo $context["options"]->getlabel(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Cover Thumbnail Medium Size")));
        echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-8\">
\t\t\t\t\t\t\t\t<div class=\"mp-option-sizes-input\">
\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
        // line 292
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["settings"] ?? null), "cover-medium-size", array(), "array"), "width", array()), "html", null, true);
        echo "\" name=\"cover-medium-size[width]\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<span>x</span>
\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
        // line 296
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["settings"] ?? null), "cover-medium-size", array(), "array"), "height", array()), "html", null, true);
        echo "\" name=\"cover-medium-size[height]\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t\t<div class=\"mp-option\" id=\"cover-small-size\">
\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t\t\t\t\t\t";
        // line 306
        echo $context["options"]->getlabel(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Cover Thumbnail Small Size")));
        echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-8\">
\t\t\t\t\t\t\t\t<div class=\"mp-option-sizes-input\">
\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
        // line 311
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["settings"] ?? null), "cover-small-size", array(), "array"), "width", array()), "html", null, true);
        echo "\" name=\"cover-small-size[width]\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<span>x</span>
\t\t\t\t\t\t\t\t\t<div class=\"mp-option-input\">
\t\t\t\t\t\t\t\t\t\t<input class=\"sc-input\" value=\"";
        // line 315
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["settings"] ?? null), "cover-small-size", array(), "array"), "height", array()), "html", null, true);
        echo "\" name=\"cover-small-size[height]\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

                    ";
        // line 322
        $context["defaultCover"] = $this->env->getExtension('Membership_Base_Twig')->getAssetsPath("users", "images/user-cover.jpg", false);
        // line 323
        echo "
\t\t\t\t\t<div class=\"mp-option\" id=\"default-cover\">
\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t\t\t\t\t\t";
        // line 327
        echo $context["options"]->getlabel(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Default Cover Image")));
        echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-8\">
\t\t\t\t\t\t\t\t<div class=\"mp-default-image\" data-modal=\"#cover-modal\" data-width=\"\" data-height=\"\">
\t\t\t\t\t\t\t\t\t<img style=\"max-width:50px;max-height: 50px;\"
\t\t\t\t\t\t\t\t\t\tsrc=\"";
        // line 332
        echo twig_escape_filter($this->env, $this->getAttribute(($context["settings"] ?? null), "default-cover", array(), "array"), "html", null, true);
        echo "\"
\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t<button class=\"mp-option-button sc-button primary mp-change\">";
        // line 334
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Change")), "html", null, true);
        echo "</button>
\t\t\t\t\t\t\t\t\t<button class=\"mp-option-button sc-button primary mp-set-to-default\"
\t\t\t\t\t\t\t\t\t\t";
        // line 336
        if (((($context["defaultCover"] ?? null) == $this->getAttribute(($context["settings"] ?? null), "default-cover", array(), "array")) || (($context["defaultCover"] ?? null) == $this->getAttribute(($context["settings"] ?? null), "default-cover-source", array(), "array")))) {
            // line 337
            echo "\t\t\t\t\t\t\t\t\t\t\tstyle=\"display: none\" 
\t\t\t\t\t\t\t\t\t\t";
        }
        // line 339
        echo "\t\t\t\t\t\t\t\t\t>";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Set to default")), "html", null, true);
        echo "</button>
\t\t\t\t\t\t\t\t\t<input
\t\t\t\t\t\t\t\t\t\ttype=\"hidden\"
\t\t\t\t\t\t\t\t\t\tname=\"default-cover\"
\t\t\t\t\t\t\t\t\t\tvalue=\"";
        // line 343
        echo twig_escape_filter($this->env, $this->getAttribute(($context["settings"] ?? null), "default-cover", array(), "array"), "html", null, true);
        echo "\"
\t\t\t\t\t\t\t\t\t>
                                    <input
                                            type=\"hidden\"
                                            name=\"default-cover-medium\"
                                            value=\"";
        // line 348
        echo twig_escape_filter($this->env, $this->getAttribute(($context["settings"] ?? null), "default-cover-medium", array(), "array"), "html", null, true);
        echo "\"
                                    >
                                    <input
                                            type=\"hidden\"
                                            name=\"default-cover-small\"
                                            value=\"";
        // line 353
        echo twig_escape_filter($this->env, $this->getAttribute(($context["settings"] ?? null), "default-cover-small", array(), "array"), "html", null, true);
        echo "\"
                                    >
                                    <input
                                            type=\"hidden\"
                                            name=\"default-cover-source\"
                                            data-default-image=\"";
        // line 358
        echo twig_escape_filter($this->env, ($context["defaultCover"] ?? null), "html", null, true);
        echo "\"
                                            data-default-width-input-name=\"cover-size[width]\"
                                            data-default-height-input-name=\"cover-size[height]\"
                                            data-default-crop-input-name=\"default-cover-crop-data\"
                                            value=\"";
        // line 362
        echo twig_escape_filter($this->env, $this->getAttribute(($context["settings"] ?? null), "default-cover-source", array(), "array"), "html", null, true);
        echo "\"
                                    >
                                    <input
                                            type=\"hidden\"
                                            name=\"default-cover-crop-data\"
                                            value=\"";
        // line 367
        echo twig_escape_filter($this->env, $this->getAttribute(($context["settings"] ?? null), "default-cover-crop-data", array(), "array"), "html", null, true);
        echo "\"
                                    >
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>


\t\t\t\t\t";
        // line 375
        $context["permalinks"] = array(0 => array("value" => "username", "title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Username")), "selected" => ($this->getAttribute(        // line 379
($context["settings"] ?? null), "permalink-base", array(), "array") == "username")), 1 => array("value" => "id", "title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("User ID")), "selected" => ($this->getAttribute(        // line 384
($context["settings"] ?? null), "permalink-base", array(), "array") == "id")));
        // line 387
        echo "
\t\t\t\t\t";
        // line 388
        echo $context["options"]->getselectRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Profile Permalink Base")),         // line 389
($context["permalinks"] ?? null), "permalink-base", "permalink-base", null, array("mbsThinCol" => 1));
        // line 394
        echo "


\t\t\t\t\t";
        // line 397
        $context["displayNames"] = array(0 => array("value" => "username", "title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Username")), "selected" => ($this->getAttribute(        // line 401
($context["settings"] ?? null), "display-name", array(), "array") == "username")), 1 => array("value" => "firstname-lastname", "title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("First Name Last Name")), "selected" => ($this->getAttribute(        // line 406
($context["settings"] ?? null), "display-name", array(), "array") == "firstname-lastname")), 2 => array("value" => "lastname-firstname", "title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Last Name First Name")), "selected" => ($this->getAttribute(        // line 411
($context["settings"] ?? null), "display-name", array(), "array") == "lastname-firstname")), 3 => array("value" => "nickname", "title" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Nickname ")), "selected" => ($this->getAttribute(        // line 416
($context["settings"] ?? null), "display-name", array(), "array") == "nickname")));
        // line 419
        echo "
\t\t\t\t\t";
        // line 420
        echo $context["options"]->getselectRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("User Display Name")),         // line 421
($context["displayNames"] ?? null), "display-name", "display-name", null, array("mbsThinCol" => 1));
        // line 426
        echo "

\t\t\t
\t\t\t\t\t";
        // line 429
        echo $context["options"]->getradioRow(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Registration Confirmation")), array(0 => array("value" => "auto", "label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Auto")), "name" => "registration-confirmation", "checked" => ($this->getAttribute(        // line 434
($context["settings"] ?? null), "registration-confirmation", array(), "array") == "auto")), 1 => array("value" => "email-confirmation", "label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Email confirmation")), "name" => "registration-confirmation", "checked" => ($this->getAttribute(        // line 440
($context["settings"] ?? null), "registration-confirmation", array(), "array") == "email-confirmation")), 2 => array("value" => "admin-confirmation", "label" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Administrator confirmation")), "name" => "registration-confirmation", "checked" => ($this->getAttribute(        // line 446
($context["settings"] ?? null), "registration-confirmation", array(), "array") == "admin-confirmation"))), "registration-confirmation", null, null, array("mbsThinCol" => 1));
        // line 450
        echo "

\t\t\t\t\t\t
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t
\t\t<div class=\"sc-tab-content\" data-tab=\"fields\">
\t\t\t<div class=\"mp-fields\">
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-md-12\">
\t\t\t\t\t\t<div class=\"action-panel\">
\t\t\t\t\t\t\t<button data-save-settings class=\"save-fields sc-button icon-button primary\">
\t\t\t\t\t\t\t\t<i class=\"fa fa-save\"></i>
\t\t\t\t\t\t\t\t<span>";
        // line 465
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Save Fields")), "html", null, true);
        echo "</span>
\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t<button class=\"add-new-section sc-button icon-button primary\">
\t\t\t\t\t\t\t\t<i class=\"fa fa-plus-circle\"></i>
\t\t\t\t\t\t\t\t<span>";
        // line 469
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Add Section")), "html", null, true);
        echo "</span>
\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t<button class=\"add-new-field sc-button icon-button primary\">
\t\t\t\t\t\t\t\t<i class=\"fa fa-plus-circle\"></i>
\t\t\t\t\t\t\t\t<span>";
        // line 473
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Add Field")), "html", null, true);
        echo "</span>
\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"mp-fields-container\"></div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>

\t<div class=\"mp-fields-template sc-hidden\">
\t\t<table>
\t\t\t<tr class=\"mp-field\">
\t\t\t\t<td class=\"mp-field-drag-handler\">
\t\t\t\t\t<i class=\"fa fa-arrows-v\"></i>
\t\t\t\t</td>
\t\t\t\t<td class=\"mp-field-label\">
\t\t\t\t\t<input type=\"text\" class=\"mp-field-label-input\" name=\"label\">
\t\t\t\t</td>
\t\t\t\t<td class=\"mp-field-type\">
\t\t\t\t\t<select class=\"sc-input mp-field-types-select\" name=\"type\">
\t\t\t\t\t\t";
        // line 494
        echo $context["f"]->getfieldsList();
        echo "
\t\t\t\t\t</select>
\t\t\t\t</td>
\t\t\t\t<td class=\"mp-field-registration\">
\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t<input type=\"checkbox\" name=\"registration\" value=\"true\">
\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t</label>
\t\t\t\t</td>
\t\t\t\t<td class=\"mp-field-required\">
\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t<input type=\"checkbox\" name=\"required\" value=\"true\">
\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t</label>
\t\t\t\t</td>
\t\t\t\t<td class=\"mp-field-enabled\">
\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t<input type=\"checkbox\" name=\"enabled\" value=\"true\">
\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t</label>
\t\t\t\t</td>
\t\t\t\t<td class=\"mp-field-action\">
\t\t\t\t\t<button class=\"sc-button mp-field-edit-button\">
\t\t\t\t\t\t<i class=\"fa fa-lg fa-edit\"></i>
\t\t\t\t\t\t";
        // line 518
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Edit")), "html", null, true);
        echo "
\t\t\t\t\t</button>
\t\t\t\t\t<button class=\"sc-button mp-field-remove-button\">\t
\t\t\t\t\t\t<i class=\"fa fa-lg fa-trash-o\"></i>
\t\t\t\t\t\t";
        // line 522
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Remove")), "html", null, true);
        echo "
\t\t\t\t\t</button>
\t\t\t\t</td>
\t\t\t</tr>
\t\t</table>
\t</div>

\t<div class=\"mp-section-template sc-hidden\">
\t\t<div class=\"mp-section\">
\t\t\t<div class=\"mp-section-title-bar\">
\t\t\t\t<div class=\"mp-section-drag-handler\">
\t\t\t\t\t<i class=\"fa fa-arrows-v\"></i>
\t\t\t\t</div>
\t\t\t\t<div class=\"mp-section-title\">
\t\t\t\t\t<input type=\"text\" class=\"mp-section-title-input\">
\t\t\t\t</div>
\t\t\t\t<div class=\"mp-section-remove\">
\t\t\t\t\t<i class=\"fa fa-times\"></i>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"mp-section-container\">
\t\t\t\t<table class=\"mp-section-fields-table\">
\t\t\t\t\t<thead>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<th></th>
\t\t\t\t\t\t\t<th>Field Label</th>
\t\t\t\t\t\t\t<th>Type</th>
\t\t\t\t\t\t\t<th>Registration</th>
\t\t\t\t\t\t\t<th>Required</th>
\t\t\t\t\t\t\t<th>Enabled</th>
\t\t\t\t\t\t\t<th></th>
\t\t\t\t\t\t</tr>
\t\t\t\t\t</thead>
\t\t\t\t\t<tbody class=\"fields-list\">
\t\t\t\t\t\t<tr class=\"fields-list-placeholder\"></tr>
\t\t\t\t\t</tbody>
\t\t\t\t</table>
\t\t\t</div>
\t\t</div>
\t</div>

\t<div class=\"mp-modal add-section-modal sc-hidden\">
\t\t<div class=\"row sc-input-row\">
\t\t\t<div class=\"col-md-4\">
\t\t\t\t<label class=\"sc-label\">";
        // line 566
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Section Name")), "html", null, true);
        echo "</label>
\t\t\t</div>
\t\t\t<div class=\"col-md-8\">
\t\t\t\t<input class=\"sc-input section-name\" type=\"text\">
\t\t\t\t<p class=\"sc-hidden error-msg\"></p>
\t\t\t</div>
\t\t</div>
\t</div>

\t<div class=\"mp-modal edit-field-modal sc-hidden\">
\t\t<div class=\"edit-field-container\">
\t\t\t<div class=\"protected-field-message\">
\t\t\t\t";
        // line 578
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("This is protected field. You cannot modify its type.")), "html", null, true);
        echo "
\t\t\t</div>
\t\t\t
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t<div class=\"sc-input-row\">
\t\t\t\t\t\t<label class=\"sc-label\">";
        // line 584
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Label")), "html", null, true);
        echo "</label>
\t\t\t\t\t\t<input class=\"sc-input field-label\" type=\"text\" name=\"label\">
\t\t\t\t\t\t<p class=\"sc-hidden error-msg\"></p>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"sc-input-row\">
\t\t\t\t\t\t<label class=\"sc-label\">";
        // line 589
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Section")), "html", null, true);
        echo "</label>
\t\t\t\t\t\t<select class=\"sc-input field-section\" name=\"section\"></select>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t<div class=\"sc-input-row\">
\t\t\t\t\t\t<label class=\"sc-label\">";
        // line 595
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Type")), "html", null, true);
        echo "</label>
\t\t\t\t\t\t<select class=\"sc-input field-type\" name=\"type\">
\t\t\t\t\t\t\t";
        // line 597
        echo $context["f"]->getfieldsList();
        echo "
\t\t\t\t\t\t</select>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"sc-input-row\">
\t\t\t\t\t\t<label class=\"sc-label\">";
        // line 601
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Description")), "html", null, true);
        echo "</label>
\t\t\t\t\t\t<input class=\"sc-input field-description\" type=\"text\" name=\"description\">
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>

\t\t\t<div class=\"field-options field-date sc-hidden\">
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t<div class=\"sc-input-row\">
\t\t\t\t\t\t\t<label class=\"sc-label\">";
        // line 611
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Date Format")), "html", null, true);
        echo "</label>
\t\t\t\t\t\t\t<select class=\"sc-input field-date-format\" name=\"date-format\">
\t\t\t\t\t\t\t\t";
        // line 613
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["dateFormats"] ?? null));
        foreach ($context['_seq'] as $context["value"] => $context["data"]) {
            // line 614
            echo "\t\t\t\t\t\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, $context["value"], "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["data"], "text", array()), "html", null, true);
            echo "</option>
\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['value'], $context['data'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 616
        echo "\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>

\t\t\t<div class=\"field-options field-g-recaptcha-response sc-hidden\">
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-md-12\">
\t\t\t\t\t\t<div class=\"sc-input-row\">
\t\t\t\t\t\t\t<table>
\t\t\t\t\t\t\t\t<tr class=\"mp-field-option mp-field-option-google-re-captcha-site-key\">
\t\t\t\t\t\t\t\t\t<td class=\"mp-field-option-setting\">
\t\t\t\t\t\t\t\t\t\t<label class=\"sc-label\">";
        // line 629
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Google ReCaptcha Site Key")), "html", null, true);
        echo "</label>
\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t<td class=\"mp-field-option-setting\">
\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-helper tooltip\">
\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-question sc-tooltip\"></i>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"tooltip_content\">
\t\t\t\t\t\t\t\t\t\t\t\t<div>";
        // line 635
        echo $context["tooltips"]->getget("google-re-captcha-site-key");
        echo "</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t<td class=\"mp-field-option-setting\">
\t\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"mp-field-label-input\" name=\"google-re-captcha-site-key\">
\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t<tr class=\"mp-field-option mp-field-option-google-re-captcha-secret-key\">
\t\t\t\t\t\t\t\t\t<td class=\"mp-field-option-setting\">
\t\t\t\t\t\t\t\t\t\t<label class=\"sc-label\">";
        // line 645
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Google ReCaptcha Secret Key")), "html", null, true);
        echo "</label>
\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t<td class=\"mp-field-option-setting\">
\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-helper tooltip\">
\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-question sc-tooltip\"></i>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"tooltip_content\">
\t\t\t\t\t\t\t\t\t\t\t\t<div>";
        // line 651
        echo call_user_func_array($this->env->getFunction('translate')->getCallable(), array($context["tooltips"]->getget("google-re-captcha-secret-key")));
        echo "</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t<td class=\"mp-field-option-setting\">
\t\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"mp-field-label-input\" name=\"google-re-captcha-secret-key\">
\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t<tr class=\"mp-field-option mp-field-option-google-re-captcha-theme\">
\t\t\t\t\t\t\t\t\t<td class=\"mp-field-option-setting\">
\t\t\t\t\t\t\t\t\t\t<label class=\"sc-label\">";
        // line 661
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Google ReCaptcha Theme")), "html", null, true);
        echo "</label>
\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t<td class=\"mp-field-option-setting\">
\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-helper tooltip\">
\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-question sc-tooltip\"></i>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"tooltip_content\">
\t\t\t\t\t\t\t\t\t\t\t\t<div>";
        // line 667
        echo call_user_func_array($this->env->getFunction('translate')->getCallable(), array($context["tooltips"]->getget("google-re-captcha-theme")));
        echo "</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t<td class=\"mp-field-option-setting\">
\t\t\t\t\t\t\t\t\t\t<select name=\"google-re-captcha-theme\">
\t\t\t\t\t\t\t\t\t\t\t<option value=\"light\">";
        // line 673
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Light")), "html", null, true);
        echo "</option>
\t\t\t\t\t\t\t\t\t\t\t<option value=\"dark\">";
        // line 674
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Dark")), "html", null, true);
        echo "</option>
\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t<tr class=\"mp-field-option mp-field-option-google-re-captcha-type\">
\t\t\t\t\t\t\t\t\t<td class=\"mp-field-option-setting\">
\t\t\t\t\t\t\t\t\t\t<label class=\"sc-label\">";
        // line 680
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Google ReCaptcha Type")), "html", null, true);
        echo "</label>
\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t<td class=\"mp-field-option-setting\">
\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-helper tooltip\">
\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-question sc-tooltip\"></i>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"tooltip_content\">
\t\t\t\t\t\t\t\t\t\t\t\t<div>";
        // line 686
        echo call_user_func_array($this->env->getFunction('translate')->getCallable(), array($context["tooltips"]->getget("google-re-captcha-type")));
        echo "</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t<td class=\"mp-field-option-setting\">
\t\t\t\t\t\t\t\t\t\t<select name=\"google-re-captcha-type\">
\t\t\t\t\t\t\t\t\t\t\t<option value=\"audio\">";
        // line 692
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Audio")), "html", null, true);
        echo "</option>
\t\t\t\t\t\t\t\t\t\t\t<option value=\"image\" selected=\"true\">";
        // line 693
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Image")), "html", null, true);
        echo "</option>
\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t<tr class=\"mp-field-option mp-field-option-google-re-captcha-size\">
\t\t\t\t\t\t\t\t\t<td class=\"mp-field-option-setting\">
\t\t\t\t\t\t\t\t\t\t<label class=\"sc-label\">";
        // line 699
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Google ReCaptcha Size")), "html", null, true);
        echo "</label>
\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t<td class=\"mp-field-option-setting\">
\t\t\t\t\t\t\t\t\t\t<div class=\"mp-option-helper tooltip\">
\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-question sc-tooltip\"></i>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"tooltip_content\">
\t\t\t\t\t\t\t\t\t\t\t\t<div>";
        // line 705
        echo call_user_func_array($this->env->getFunction('translate')->getCallable(), array($context["tooltips"]->getget("google-re-captcha-size")));
        echo "</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t<td class=\"mp-field-option-setting\">
\t\t\t\t\t\t\t\t\t\t<select name=\"google-re-captcha-size\">
\t\t\t\t\t\t\t\t\t\t\t<option value=\"compact\">";
        // line 711
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Compact")), "html", null, true);
        echo "</option>
\t\t\t\t\t\t\t\t\t\t\t<option value=\"normal\" selected=\"true\">";
        // line 712
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Normal")), "html", null, true);
        echo "</option>
\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t</table>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>

\t\t\t<hr>
\t\t\t<div class=\"row field-states\">
\t\t\t\t<div class=\"col-md-3\">
\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t<input type=\"checkbox\" name=\"registration\" value=\"true\">
\t\t\t\t\t\t";
        // line 727
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Registration")), "html", null, true);
        echo "
\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t</label>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-md-3\">
\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t<input type=\"checkbox\" name=\"required\" value=\"true\" id=\"popup-required\">
\t\t\t\t\t\t";
        // line 734
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Required")), "html", null, true);
        echo "
\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t</label>
\t\t\t\t</div>
                <div class=\"col-md-3\">
                    <label class=\"sc-checkbox\">
                        <input type=\"checkbox\" name=\"asterisk\" value=\"true\" id=\"popup-asterisk\">
                        ";
        // line 741
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Asterisk")), "html", null, true);
        echo "
                        <div class=\"sc-checkbox-state\"></div>
                    </label>
                </div>
\t\t\t\t<div class=\"col-md-3\">
\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t<input type=\"checkbox\" name=\"enabled\" value=\"true\" checked>
\t\t\t\t\t\t";
        // line 748
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Enabled")), "html", null, true);
        echo "
\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t</label>
\t\t\t\t</div>
\t\t\t</div>

\t\t\t<div class=\"field-options-container sc-hidden\">
\t\t\t\t<hr>
\t\t\t\t<div class=\"row mbsModalEditAddToDdOpt\">
\t\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t\t<label class=\"sc-label\">";
        // line 758
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Option Name")), "html", null, true);
        echo "</label>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t<div class=\"sc-input-row\">
\t\t\t\t\t\t\t<input class=\"sc-input option-name-input\" type=\"text\" name=\"name\" value=\"\">
\t\t\t\t\t\t\t<p class=\"sc-hidden error-msg\"></p>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-md-2\">
\t\t\t\t\t\t<div class=\"sc-input-row\">
\t\t\t\t\t\t\t<button class=\"sc-button primary add-field-option\">
\t\t\t\t\t\t\t\t<i class=\"fa fa-plus-circle\"></i>
\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div class=\"row sc-input-row\">
\t\t\t\t\t<div class=\"col-md-12\">
\t\t\t\t\t\t<div class=\"field-options-list\"></div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div class=\"option-template sc-hidden\">
\t\t\t\t\t<div class=\"option\">
\t\t\t\t\t\t<div class=\"option-drag-handler\">
\t\t\t\t\t\t\t<i class=\"fa fa-arrows-v\"></i>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"option-name\">
\t\t\t\t\t\t\t<input type=\"text\" name=\"options[]\">
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"checked-state\">
\t\t\t\t\t\t\t<label class=\"sc-checkbox seleceted-options-state\">
\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"selected-options[]\" value=\"true\">
\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"selected-options[]\" value=\"true\">
\t\t\t\t\t\t\t\t";
        // line 793
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Default Selected")), "html", null, true);
        echo "
\t\t\t\t\t\t\t\t<div class=\"sc-checkbox-state seleceted-options-input-state\"></div>
\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"remove-option\">
\t\t\t\t\t\t\t<i class=\"fa fa-trash-o\"></i>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t</div>
\t\t</div>
\t</div>
";
    }

    // line 6
    public function getfieldsList(...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 7
            echo "\t";
            $context["fields"] = array("text" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Text")), "email" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Email")), "password" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Password")), "numeric" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Numeric")), "date" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Date")), "scroll" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Scroll List")), "drop" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Dropdown List")), "radio" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Radio Button")), "checkbox" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Checkbox")), "g-recaptcha-response" => call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Google ReCaptcha")));
            // line 19
            echo "\t";
            // line 20
            echo "\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["fields"] ?? null));
            foreach ($context['_seq'] as $context["value"] => $context["title"]) {
                // line 21
                echo "\t    <option value=\"";
                echo twig_escape_filter($this->env, $context["value"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["title"], "html", null, true);
                echo "</option>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['value'], $context['title'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
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
        return "@users/backend/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1085 => 21,  1080 => 20,  1078 => 19,  1075 => 7,  1064 => 6,  1046 => 793,  1008 => 758,  995 => 748,  985 => 741,  975 => 734,  965 => 727,  947 => 712,  943 => 711,  934 => 705,  925 => 699,  916 => 693,  912 => 692,  903 => 686,  894 => 680,  885 => 674,  881 => 673,  872 => 667,  863 => 661,  850 => 651,  841 => 645,  828 => 635,  819 => 629,  804 => 616,  793 => 614,  789 => 613,  784 => 611,  771 => 601,  764 => 597,  759 => 595,  750 => 589,  742 => 584,  733 => 578,  718 => 566,  671 => 522,  664 => 518,  637 => 494,  613 => 473,  606 => 469,  599 => 465,  582 => 450,  580 => 446,  579 => 440,  578 => 434,  577 => 429,  572 => 426,  570 => 421,  569 => 420,  566 => 419,  564 => 416,  563 => 411,  562 => 406,  561 => 401,  560 => 397,  555 => 394,  553 => 389,  552 => 388,  549 => 387,  547 => 384,  546 => 379,  545 => 375,  534 => 367,  526 => 362,  519 => 358,  511 => 353,  503 => 348,  495 => 343,  487 => 339,  483 => 337,  481 => 336,  476 => 334,  471 => 332,  463 => 327,  457 => 323,  455 => 322,  445 => 315,  438 => 311,  430 => 306,  417 => 296,  410 => 292,  402 => 287,  389 => 277,  382 => 273,  374 => 268,  367 => 263,  365 => 259,  364 => 253,  363 => 248,  352 => 240,  344 => 235,  340 => 234,  329 => 226,  321 => 221,  313 => 216,  305 => 211,  297 => 207,  293 => 205,  291 => 204,  286 => 202,  281 => 200,  273 => 195,  267 => 191,  265 => 190,  254 => 182,  247 => 178,  239 => 173,  226 => 163,  219 => 159,  211 => 154,  198 => 144,  191 => 140,  183 => 135,  170 => 125,  163 => 121,  155 => 116,  148 => 111,  146 => 107,  145 => 101,  144 => 96,  140 => 94,  138 => 90,  137 => 84,  136 => 79,  132 => 77,  130 => 72,  129 => 71,  126 => 70,  120 => 69,  118 => 67,  117 => 66,  116 => 65,  114 => 64,  110 => 63,  107 => 62,  105 => 61,  94 => 53,  88 => 50,  82 => 46,  80 => 45,  75 => 43,  71 => 42,  68 => 41,  65 => 40,  60 => 37,  58 => 36,  56 => 35,  54 => 34,  49 => 31,  43 => 28,  39 => 26,  36 => 25,  32 => 1,  30 => 4,  28 => 3,  26 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@users/backend/index.twig", "F:\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Users\\views\\backend\\index.twig");
    }
}
