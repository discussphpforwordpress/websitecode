<?php

/* @design/styles.twig */
class __TwigTemplate_dabc43de7e757b5a94bc16866fbca9bacd89a598aa14b43da2d7230a5d199a5c extends Twig_Template
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
        echo "<style id=\"membership-custom-styles\">
\t
\t";
        // line 3
        if (($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "general", array()), "default-theme-colors", array(), "array") == "false")) {
            // line 4
            echo "\t
\t
\t\t.sc-membership .ui.primary.button,
\t\t.ui.modals .ui.primary.button {
\t\t\tbackground: ";
            // line 8
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "general", array()), "primary-button-color", array(), "array"), "html", null, true);
            echo "!important;
\t\t\t";
            // line 10
            echo "\t\t\t";
            if ($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array(), "any", false, true), "general", array(), "any", false, true), "primary-button-text-color", array(), "array", true, true)) {
                // line 11
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "general", array()), "primary-button-text-color", array(), "array"), "html", null, true);
                echo "!important;
\t\t\t";
            }
            // line 13
            echo "\t\t}
\t

\t\t.sc-membership .ui.primary.button:active,
\t\t.sc-membership .ui.primary.buttons .button:active,
\t\t.ui.modals .ui.primary.button:active,
\t\t.ui.modals .ui.primary.buttons .button:active,
\t\t.sc-membership .ui.primary.button:hover,
\t\t.sc-membership .ui.primary.buttons .button:hover,
\t\t.ui.modals .ui.primary.button:hover,
\t\t.ui.modals .ui.primary.buttons .button:hover {
\t\t\t";
            // line 24
            if ($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "general", array()), "primary-button-hover-color", array(), "array")) {
                // line 25
                echo "\t\t\t\tbackground: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "general", array()), "primary-button-hover-color", array(), "array"), "html", null, true);
                echo "!important;
\t\t\t";
            }
            // line 27
            echo "\t\t}


\t\t.sc-membership .ui.secondary.button,
\t\t.ui.modals .mbs-add-attachment,
\t\t.ui.modals .ui.secondary.button {
\t\t\tbackground: ";
            // line 33
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "general", array()), "secondary-button-color", array(), "array"), "html", null, true);
            echo "!important;
\t\t\t";
            // line 35
            echo "\t\t\t";
            if ($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array(), "any", false, true), "general", array(), "any", false, true), "secondary-button-text-color", array(), "array", true, true)) {
                // line 36
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "general", array()), "secondary-button-text-color", array(), "array"), "html", null, true);
                echo "!important;
\t\t\t";
            }
            // line 38
            echo "\t\t}

\t\t";
            // line 40
            if ($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array(), "any", false, true), "general", array(), "any", false, true), "secondary-button-text-color", array(), "array", true, true)) {
                // line 41
                echo "\t\t\t.ui.modals .mbs-add-attachment .icon.attach {
\t\t\t\tcolor: ";
                // line 42
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "general", array()), "secondary-button-text-color", array(), "array"), "html", null, true);
                echo "!important;
\t\t\t}
\t\t";
            }
            // line 45
            echo "
\t\t.sc-membership .ui.secondary.button:hover,
\t\t.sc-membership .ui.secondary.buttons .button:hover,
\t\t.ui.modals .ui.secondary.button:hover,
\t\t.ui.modals .ui.secondary.buttons .button:hover {
\t\t\tbackground: ";
            // line 50
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "general", array()), "secondary-button-hover-color", array(), "array"), "html", null, true);
            echo "!important;
\t\t}
\t\t";
            // line 53
            echo "\t\t.post-activity-buttons .button[data-action=\"add-smile-to-text\"] {
\t\t\tbackground-color: ";
            // line 54
            echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array(), "any", false, true), "general", array(), "any", false, true), "smile-button-bg-color", array(), "array", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array(), "any", false, true), "general", array(), "any", false, true), "smile-button-bg-color", array(), "array"), "#fff")) : ("#fff")), "html", null, true);
            echo " !important;
\t\t}
\t\t.post-activity-buttons .button[data-action=\"add-smile-to-text\"]:hover {
\t\t\tbackground-color: ";
            // line 57
            echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array(), "any", false, true), "general", array(), "any", false, true), "smile-button-hover-bg-color", array(), "array", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array(), "any", false, true), "general", array(), "any", false, true), "smile-button-hover-bg-color", array(), "array"), "#ddd")) : ("#ddd")), "html", null, true);
            echo " !important;
\t\t}
\t\t";
            // line 60
            echo "\t\t";
            $context["smileBtnIconSize"] = (($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array(), "any", false, true), "general", array(), "any", false, true), "smiles-button-icon-size-text-font-size-number", array(), "array", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array(), "any", false, true), "general", array(), "any", false, true), "smiles-button-icon-size-text-font-size-number", array(), "array"), 20)) : (20));
            // line 61
            echo "\t\t";
            $context["smileBtnIconSizeUnits"] = (($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array(), "any", false, true), "general", array(), "any", false, true), "smiles-button-icon-size-text-font-unit-select", array(), "array", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array(), "any", false, true), "general", array(), "any", false, true), "smiles-button-icon-size-text-font-unit-select", array(), "array"), "px")) : ("px"));
            // line 62
            echo "\t\t";
            $context["smileBtnIconWidthAndHeightSize"] = (((($context["smileBtnIconSizeUnits"] ?? null) == "em")) ? ((($context["smileBtnIconSize"] ?? null) + 1)) : ((($context["smileBtnIconSize"] ?? null) + 16)));
            // line 63
            echo "\t\t";
            // line 69
            echo "\t\t";
            $context["smileWrapperIconSizeWidth"] = (((($context["smileBtnIconSizeUnits"] ?? null) == "em")) ? ((($context["smileBtnIconSize"] ?? null) * 6)) : (((((6 * ($context["smileBtnIconSize"] ?? null)) + (6 * 5)) + (6 * 8)) + (6 * 8))));
            // line 70
            echo "\t\t.post-activity-buttons .button[data-action=\"add-smile-to-text\"] {
\t\t\tfont-size: ";
            // line 71
            echo twig_escape_filter($this->env, ($context["smileBtnIconSize"] ?? null), "html", null, true);
            echo twig_escape_filter($this->env, ($context["smileBtnIconSizeUnits"] ?? null), "html", null, true);
            echo "!important;
\t\t}
\t\t.mbs-smiles-wrapper {
\t\t\twidth: ";
            // line 74
            echo twig_escape_filter($this->env, ($context["smileWrapperIconSizeWidth"] ?? null), "html", null, true);
            echo "px;
\t\t}
\t\t.mbs-sw-one-smile {
\t\t\twidth: ";
            // line 77
            echo twig_escape_filter($this->env, ($context["smileBtnIconWidthAndHeightSize"] ?? null), "html", null, true);
            echo twig_escape_filter($this->env, ($context["smileBtnIconSizeUnits"] ?? null), "html", null, true);
            echo "!important;
\t\t\theight: ";
            // line 78
            echo twig_escape_filter($this->env, ($context["smileBtnIconWidthAndHeightSize"] ?? null), "html", null, true);
            echo twig_escape_filter($this->env, ($context["smileBtnIconSizeUnits"] ?? null), "html", null, true);
            echo "!important;
\t\t\tfont-size: ";
            // line 79
            echo twig_escape_filter($this->env, ($context["smileBtnIconSize"] ?? null), "html", null, true);
            echo twig_escape_filter($this->env, ($context["smileBtnIconSizeUnits"] ?? null), "html", null, true);
            echo "!important;
\t\t\tline-height: ";
            // line 80
            echo twig_escape_filter($this->env, ($context["smileBtnIconSize"] ?? null), "html", null, true);
            echo twig_escape_filter($this->env, ($context["smileBtnIconSizeUnits"] ?? null), "html", null, true);
            echo "!important;
\t\t}

\t\t.ui.form input, .ui.form textarea {
\t\t\tborder-color: ";
            // line 84
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "general", array()), "input-border-color", array(), "array"), "html", null, true);
            echo "!important;
\t\t\tbackground-color: ";
            // line 85
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "general", array()), "input-background-color", array(), "array"), "html", null, true);
            echo "!important;
\t\t\t";
            // line 87
            echo "\t\t\t";
            if ($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array(), "any", false, true), "general", array(), "any", false, true), "input-text-color", array(), "array", true, true)) {
                // line 88
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "general", array()), "input-text-color", array(), "array"), "html", null, true);
                echo "!important;
\t\t\t";
            }
            // line 90
            echo "\t\t}

\t\t.ui.form input:focus, .ui.form textarea:focus {
\t\t\tborder-color: ";
            // line 93
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "general", array()), "input-border-focus-color", array(), "array"), "html", null, true);
            echo "!important;
\t\t\tbackground-color: ";
            // line 94
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "general", array()), "input-background-focus-color", array(), "array"), "html", null, true);
            echo "!important;
\t\t}

\t\t.ui.form input::-webkit-input-placeholder { color: ";
            // line 97
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "general", array()), "input-placeholder-color", array(), "array"), "html", null, true);
            echo "!important; }
\t\t.ui.form textarea::-webkit-input-placeholder { color: ";
            // line 98
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "general", array()), "input-placeholder-color", array(), "array"), "html", null, true);
            echo "!important; }
\t\t.ui.form input:-moz-placeholder { color: ";
            // line 99
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "general", array()), "input-placeholder-color", array(), "array"), "html", null, true);
            echo "!important;}
\t\t.ui.form textarea:-moz-placeholder { color: ";
            // line 100
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "general", array()), "input-placeholder-color", array(), "array"), "html", null, true);
            echo "!important;}
\t\t.ui.form input::-moz-placeholder {color: ";
            // line 101
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "general", array()), "input-placeholder-color", array(), "array"), "html", null, true);
            echo "!important;}
\t\t.ui.form textarea::-moz-placeholder {color: ";
            // line 102
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "general", array()), "input-placeholder-color", array(), "array"), "html", null, true);
            echo "!important;}
\t\t.ui.form input:-ms-input-placeholder {color: ";
            // line 103
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "general", array()), "input-placeholder-color", array(), "array"), "html", null, true);
            echo "!important;}
\t\t.ui.form textarea:-ms-input-placeholder {color: ";
            // line 104
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "general", array()), "input-placeholder-color", array(), "array"), "html", null, true);
            echo "!important;}

\t\t";
            // line 107
            echo "\t\t";
            if ($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array(), "any", false, true), "general", array(), "any", false, true), "label-text-color", array(), "array", true, true)) {
                // line 108
                echo "\t\t\t.ui.form label {
\t\t\t\tcolor: ";
                // line 109
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "general", array()), "label-text-color", array(), "array"), "html", null, true);
                echo "!important;
\t\t\t}
\t\t";
            }
            // line 112
            echo "\t";
        }
        // line 113
        echo "
\t#mp-profile .ui.container {
\t\twidth: ";
        // line 115
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "profile", array()), "container-max-width", array(), "array"), "html", null, true);
        echo "!important;
\t}

\t.mp-profile-header {
\t\tbackground-color: ";
        // line 119
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "profile", array()), "header-background-color", array(), "array"), "html", null, true);
        echo "!important;
\t\t";
        // line 120
        if (($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "profile", array()), "avatar-style", array(), "array") != null)) {
            // line 121
            echo "\t\t\tbackground-color: ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "profile", array()), "avatar-style", array(), "array"), "html", null, true);
            echo "!important;
\t\t";
        }
        // line 123
        echo "\t}

\t";
        // line 125
        if (($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "general", array()), "avatar-style", array(), "array") == "round")) {
            // line 126
            echo "\t\t.sc-membership .mp-avatar,
\t\t.sc-membership .mp-avatar img,
\t\t.sc-membership .mp-avatar .mp-update-avatar-overlay,
\t\t.sc-membership .mp-user-card .mp-user-avatar,
\t\t.sc-membership .mp-user-card .mp-user-avatar img,
\t\t.sc-membership .mp-group-card .mp-group-logo,
\t\t.sc-membership .mp-group-card .mp-group-logo img,
\t\t#conversations .conversation-image,
\t\t#conversations .mp-message-avatar,
\t\t#conversations .mp-message-avatar img,
\t\t.sc-membership .mp-activity-container .mp-activity-header-image,
\t\t.sc-membership .mp-activity-container .mp-activity-header-image img,
\t\t.sc-membership .mp-activity-post-form .mp-activity-post-avatar,
\t\t.sc-membership .mp-activity-post-form .mp-activity-post-avatar img,
\t\t.sc-membership .mp-logo,
\t\t.sc-membership .mp-logo img,
\t\t.sc-membership .mp-logo .mp-update-logo-overlay,
\t\t.sc-membership .mp-activity-container .activity-author-group,
\t\t.sc-membership .mp-activity-container .activity-author-user,
\t\t.sc-membership .mp-activity-container .comment-container .avatar,
\t\t.sc-membership .mp-activity-container .comment-container .avatar img,
\t\t.sc-membership .mp-activity-container .mp-comment-form-author,
\t\t.sc-membership .mp-activity-container .mp-comment-form-author img,
\t\t.sc-membership .mp-activity-container .menu img.avatar
\t\t{
\t\t\tborder-radius: 5px;
\t\t}
\t";
        }
        // line 154
        echo "
\t";
        // line 155
        if (($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "general", array()), "avatar-style", array(), "array") == "circle")) {
            // line 156
            echo "\t\t.sc-membership .mp-avatar,
\t\t.sc-membership .mp-avatar img,
\t\t.sc-membership .mp-avatar .mp-update-avatar-overlay,
\t\t.sc-membership .mp-user-card .mp-user-avatar,
\t\t.sc-membership .mp-user-card .mp-user-avatar img,
\t\t.sc-membership .mp-group-card .mp-group-logo,
\t\t.sc-membership .mp-group-card .mp-group-logo img,
\t\t#conversations .conversation-image,
\t\t#conversations .mp-message-avatar,
\t\t#conversations .mp-message-avatar img,
\t\t.sc-membership .mp-activity-container .mp-activity-header-image,
\t\t.sc-membership .mp-activity-container .mp-activity-header-image img,
\t\t.sc-membership .mp-activity-post-form .mp-activity-post-avatar,
\t\t.sc-membership .mp-activity-post-form .mp-activity-post-avatar img,
\t\t.sc-membership .mp-logo,
\t\t.sc-membership .mp-logo img,
\t\t.sc-membership .mp-logo .mp-update-logo-overlay,
\t\t.sc-membership .mp-activity-container .activity-author-group,
\t\t.sc-membership .mp-activity-container .activity-author-user,
\t\t.sc-membership .mp-activity-container .comment-container .avatar,
\t\t.sc-membership .mp-activity-container .comment-container .avatar img,
\t\t.sc-membership .mp-activity-container .mp-comment-form-author,
\t\t.sc-membership .mp-activity-container .mp-comment-form-author img,
\t\t.sc-membership .mp-activity-container .menu img.avatar
\t\t{
\t\t\tborder-radius: 50%;
\t\t}

\t";
        }
        // line 184
        echo "\t

\t";
        // line 186
        if (($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "general", array()), "avatar-style", array(), "array") == "square")) {
            // line 187
            echo "\t\t.sc-membership .mp-avatar,
\t\t.sc-membership .mp-avatar img,
\t\t.sc-membership .mp-avatar .mp-update-avatar-overlay,
\t\t.sc-membership .mp-user-card .mp-user-avatar,
\t\t.sc-membership .mp-user-card .mp-user-avatar img,
\t\t.sc-membership .mp-group-card .mp-group-logo,
\t\t.sc-membership .mp-group-card .mp-group-logo img,
\t\t#conversations .conversation-image,
\t\t#conversations .mp-message-avatar,
\t\t#conversations .mp-message-avatar img,
\t\t.sc-membership .mp-activity-container .mp-activity-header-image,
\t\t.sc-membership .mp-activity-container .mp-activity-header-image img,
\t\t.sc-membership .mp-activity-post-form .mp-activity-post-avatar,
\t\t.sc-membership .mp-activity-post-form .mp-activity-post-avatar img,
\t\t.sc-membership .mp-logo,
\t\t.sc-membership .mp-logo img,
\t\t.sc-membership .mp-logo .mp-update-logo-overlay,
\t\t.sc-membership .mp-activity-container .activity-author-group,
\t\t.sc-membership .mp-activity-container .activity-author-user,
\t\t.sc-membership .mp-activity-container .comment-container .avatar,
\t\t.sc-membership .mp-activity-container .comment-container .avatar img,
\t\t.sc-membership .mp-activity-container .mp-comment-form-author,
\t\t.sc-membership .mp-activity-container .mp-comment-form-author img,
\t\t.sc-membership .mp-activity-container .menu img.avatar
\t\t{
\t\t\tborder-radius: 0;
\t\t}
\t";
        }
        // line 215
        echo "
\t";
        // line 216
        if (($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "profile", array()), "show-display-name", array(), "array") == "false")) {
            // line 217
            echo "\t\t.sc-membership .mp-cover-container .mp-user-display-name {
\t\t\tdisplay: none;
\t\t}
\t";
        }
        // line 221
        echo "
\t";
        // line 222
        if (($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "auth", array()), "login-secondary-button", array(), "array") == "false")) {
            // line 223
            echo "\t\t.sc-membership .ui.button.mp-login-secondary-button {
\t\t\tdisplay: none;
\t\t}
\t";
        }
        // line 227
        echo "
    ";
        // line 228
        if (($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "members", array()), "show-friends-and-followers", array(), "array") != "true")) {
            // line 229
            echo "        .mp-social-stats {
            display: none!important;
        }
    ";
        }
        // line 233
        echo "\t";
        // line 234
        echo "\t";
        // line 235
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "primary-buttons-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "primary-buttons-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "primary-buttons-text-color-check", array(), "array") == 1))) {
            // line 236
            echo "\t\t.ui.modals .ui.button.primary,
\t\t.sc-membership .ui.button.primary {
\t\t\t";
            // line 238
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "primary-buttons-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 239
($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "primary-buttons-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 240
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "primary-buttons-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "primary-buttons-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 242
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "primary-buttons-text-font-family-check", array(), "array") == 1)) {
                // line 243
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "primary-buttons-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 245
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "primary-buttons-text-color-check", array(), "array") == 1)) {
                // line 246
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "primary-buttons-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 248
            echo "\t\t}
\t";
        }
        // line 250
        echo "\t";
        // line 251
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "secondary-buttons-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "secondary-buttons-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "secondary-buttons-text-color-check", array(), "array") == 1))) {
            // line 252
            echo "\t\t.ui.modals .ui.secondary.button,
\t\t.sc-membership .ui.button.secondary:not(.icon) {
\t\t\t";
            // line 254
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "secondary-buttons-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 255
($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "secondary-buttons-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 256
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "secondary-buttons-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "secondary-buttons-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 258
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "secondary-buttons-text-font-family-check", array(), "array") == 1)) {
                // line 259
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "secondary-buttons-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 261
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "secondary-buttons-text-color-check", array(), "array") == 1)) {
                // line 262
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "secondary-buttons-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 264
            echo "\t\t}
\t";
        }
        // line 266
        echo "\t";
        // line 267
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "page-header-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "page-header-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "page-header-text-color-check", array(), "array") == 1))) {
            // line 268
            echo "\t\t.entry-header .entry-title {
\t\t\t";
            // line 269
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "page-header-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 270
($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "page-header-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 271
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "page-header-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "page-header-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 273
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "page-header-text-font-family-check", array(), "array") == 1)) {
                // line 274
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "page-header-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 276
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "page-header-text-color-check", array(), "array") == 1)) {
                // line 277
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "page-header-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 279
            echo "\t\t}
\t";
        }
        // line 281
        echo "\t";
        // line 282
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "text-input-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "text-input-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "text-input-text-color-check", array(), "array") == 1))) {
            // line 283
            echo "\t\t.sc-membership input[type=\"text\"],
\t\t/*.sc-membership input[type=\"password\"],*/
\t\t/*.sc-membership input[type=\"email\"],*/
\t\t.sc-membership .ui.form input[type=\"text\"],
\t\t.sc-membership .ui.form input[type=\"text\"]:focus,
\t\t.sc-membership .ui.form input[type=\"password\"],
\t\t.sc-membership .ui.form input[type=\"email\"] {
\t\t\t";
            // line 290
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "text-input-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 291
($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "text-input-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 292
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "text-input-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "text-input-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 294
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "text-input-text-font-family-check", array(), "array") == 1)) {
                // line 295
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "text-input-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 297
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "text-input-text-color-check", array(), "array") == 1)) {
                // line 298
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "text-input-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 300
            echo "\t\t}
\t";
        }
        // line 302
        echo "\t";
        // line 303
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "labels-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "labels-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "labels-text-color-check", array(), "array") == 1))) {
            // line 304
            echo "\t\t.sc-membership .ui.form label {
\t\t\t";
            // line 305
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "labels-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 306
($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "labels-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 307
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "labels-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "labels-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 309
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "labels-text-font-family-check", array(), "array") == 1)) {
                // line 310
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "labels-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 312
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "labels-text-color-check", array(), "array") == 1)) {
                // line 313
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "labels-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 315
            echo "\t\t}
\t";
        }
        // line 317
        echo "\t";
        // line 318
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "small-labels-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "small-labels-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "small-labels-text-color-check", array(), "array") == 1))) {
            // line 319
            echo "\t\t.sc-membership .ui.form label small {
\t\t\t";
            // line 320
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "small-labels-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 321
($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "small-labels-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 322
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "small-labels-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "small-labels-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 324
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "small-labels-text-font-family-check", array(), "array") == 1)) {
                // line 325
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "small-labels-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 327
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "small-labels-text-color-check", array(), "array") == 1)) {
                // line 328
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "small-labels-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 330
            echo "\t\t}
\t";
        }
        // line 332
        echo "\t";
        // line 333
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "links-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "links-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "links-text-color-check", array(), "array") == 1))) {
            // line 334
            echo "\t\t.sc-membership .ui.form a {
\t\t\t";
            // line 335
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "links-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 336
($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "links-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 337
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "links-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "links-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 339
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "links-text-font-family-check", array(), "array") == 1)) {
                // line 340
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "links-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 342
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "links-text-color-check", array(), "array") == 1)) {
                // line 343
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "general", array()), "links-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 345
            echo "\t\t}
\t";
        }
        // line 347
        echo "\t";
        // line 348
        echo "\t";
        // line 349
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "user-name-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "user-name-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "user-name-text-color-check", array(), "array") == 1))) {
            // line 350
            echo "\t\t.sc-membership .mp-user-display-name {
\t\t\t";
            // line 351
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "user-name-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 352
($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "user-name-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 353
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "user-name-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "user-name-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 355
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "user-name-text-font-family-check", array(), "array") == 1)) {
                // line 356
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "user-name-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 358
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "user-name-text-color-check", array(), "array") == 1)) {
                // line 359
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "user-name-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 361
            echo "\t\t}
\t";
        }
        // line 363
        echo "\t";
        // line 364
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "counters-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "counters-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "counters-text-color-check", array(), "array") == 1))) {
            // line 365
            echo "\t\t.sc-membership .mp-profile-social-stats a.statistic div.value {
\t\t\t";
            // line 366
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "counters-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 367
($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "counters-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 368
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "counters-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "counters-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 370
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "counters-text-font-family-check", array(), "array") == 1)) {
                // line 371
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "counters-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 373
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "counters-text-color-check", array(), "array") == 1)) {
                // line 374
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "counters-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 376
            echo "\t\t}
\t";
        }
        // line 378
        echo "\t";
        // line 379
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "counters-label-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "counters-label-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "counters-label-text-color-check", array(), "array") == 1))) {
            // line 380
            echo "\t\t.sc-membership .mp-profile-social-stats a.statistic div.label {
\t\t\t";
            // line 381
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "counters-label-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 382
($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "counters-label-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 383
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "counters-label-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "counters-label-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 385
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "counters-label-text-font-family-check", array(), "array") == 1)) {
                // line 386
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "counters-label-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 388
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "counters-label-text-color-check", array(), "array") == 1)) {
                // line 389
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "counters-label-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 391
            echo "\t\t}
\t";
        }
        // line 393
        echo "\t";
        // line 394
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "tab-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "tab-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "tab-text-color-check", array(), "array") == 1))) {
            // line 395
            echo "\t\t.sc-membership .profile-nav-menu a.item,
\t\t.sc-membership .profile-nav-menu .ui.dropdown .menu a.item {
\t\t\t";
            // line 397
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "tab-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 398
($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "tab-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 399
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "tab-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "tab-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 401
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "tab-text-font-family-check", array(), "array") == 1)) {
                // line 402
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "tab-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 404
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "tab-text-color-check", array(), "array") == 1)) {
                // line 405
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "tab-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 407
            echo "\t\t}
\t";
        }
        // line 409
        echo "\t";
        // line 410
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "tab-menu-hover-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "tab-menu-hover-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "tab-menu-hover-text-color-check", array(), "array") == 1))) {
            // line 411
            echo "\t\t.sc-membership .profile-nav-menu a.item:hover,
\t\t.sc-membership .profile-nav-menu .ui.dropdown .menu a.item:hover {
\t\t\t";
            // line 413
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "tab-menu-hover-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 414
($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "tab-menu-hover-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 415
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "tab-menu-hover-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "tab-menu-hover-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 417
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "tab-menu-hover-text-font-family-check", array(), "array") == 1)) {
                // line 418
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "tab-menu-hover-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 420
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "tab-menu-hover-text-color-check", array(), "array") == 1)) {
                // line 421
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "tab-menu-hover-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 423
            echo "\t\t}
\t";
        }
        // line 425
        echo "\t";
        // line 426
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "message-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "message-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "message-text-color-check", array(), "array") == 1))) {
            // line 427
            echo "\t\t.sc-membership .mp-activity-container .mp-form-textarea {
\t\t\t";
            // line 428
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "message-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 429
($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "message-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 430
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "message-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "message-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 432
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "message-text-font-family-check", array(), "array") == 1)) {
                // line 433
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "message-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 435
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "message-text-color-check", array(), "array") == 1)) {
                // line 436
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "message-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 438
            echo "\t\t}
\t";
        }
        // line 440
        echo "\t";
        // line 441
        echo "\t";
        if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-buttons-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-buttons-text-color-check", array(), "array") == 1))) {
            // line 442
            echo "\t\t.ui.modals .ui.secondary.button.icon,
\t\t.sc-membership .ui.button.secondary.icon {
\t\t";
            // line 444
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-buttons-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 445
($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-buttons-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 446
                echo "\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-buttons-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-buttons-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t";
            }
            // line 448
            echo "\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-buttons-text-color-check", array(), "array") == 1)) {
                // line 449
                echo "\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-buttons-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t";
            }
            // line 451
            echo "\t\t}
\t";
        }
        // line 453
        echo "\t";
        // line 454
        echo "\t";
        if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-buttons-hover-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-buttons-hover-text-color-check", array(), "array") == 1))) {
            // line 455
            echo "\t\t.sc-membership .post-form-buttons .icon.button:hover {
\t\t\t";
            // line 456
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-buttons-hover-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 457
($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-buttons-hover-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 458
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-buttons-hover-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-buttons-hover-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 460
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-buttons-hover-text-color-check", array(), "array") == 1)) {
                // line 461
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-buttons-hover-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 463
            echo "\t\t}
\t";
        }
        // line 465
        echo "\t";
        // line 466
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-user-name-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-user-name-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-user-name-text-color-check", array(), "array") == 1))) {
            // line 467
            echo "\t\t.sc-membership .mp-activity .ui.basic a,
\t\t.sc-membership .mp-activity-comments .mp-comment-content a.author,
\t\t.sc-membership .mp-activity-header-title a {
\t\t\t";
            // line 470
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-user-name-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 471
($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-user-name-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 472
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-user-name-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-user-name-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 474
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-user-name-text-font-family-check", array(), "array") == 1)) {
                // line 475
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-user-name-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 477
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-user-name-text-color-check", array(), "array") == 1)) {
                // line 478
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-user-name-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 480
            echo "\t\t}
\t";
        }
        // line 482
        echo "\t";
        // line 483
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-text-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-text-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-text-text-color-check", array(), "array") == 1))) {
            // line 484
            echo "\t\t.sc-membership .mp-activity-content {
\t\t\t";
            // line 485
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-text-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 486
($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-text-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 487
                echo "\t\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-text-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-text-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t\t";
            }
            // line 489
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-text-text-font-family-check", array(), "array") == 1)) {
                // line 490
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-text-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 492
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-text-text-color-check", array(), "array") == 1)) {
                // line 493
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-text-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 495
            echo "\t\t}
\t";
        }
        // line 497
        echo "\t";
        // line 498
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-other-text-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-other-text-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-other-text-text-color-check", array(), "array") == 1))) {
            // line 499
            echo "\t\t.sc-membership .mp-activity .ui.basic,
\t\t.sc-membership .mp-activity-header-title {
\t\t\t";
            // line 501
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-other-text-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 502
($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-other-text-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 503
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-other-text-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-other-text-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 505
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-other-text-text-font-family-check", array(), "array") == 1)) {
                // line 506
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-other-text-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 508
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-other-text-text-color-check", array(), "array") == 1)) {
                // line 509
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-other-text-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 511
            echo "\t\t}
\t";
        }
        // line 513
        echo "

\t";
        // line 516
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-comment-text-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-comment-text-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-comment-text-text-color-check", array(), "array") == 1))) {
            // line 517
            echo "\t\t.sc-membership .mp-activity-comments .mp-comment-content .text {
\t\t\t";
            // line 518
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-comment-text-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 519
($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-comment-text-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 520
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-comment-text-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-comment-text-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 522
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-comment-text-text-font-family-check", array(), "array") == 1)) {
                // line 523
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-comment-text-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 525
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-comment-text-text-color-check", array(), "array") == 1)) {
                // line 526
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-comment-text-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 528
            echo "\t\t}
\t";
        }
        // line 530
        echo "\t";
        // line 531
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-date-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-date-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-date-text-color-check", array(), "array") == 1))) {
            // line 532
            echo "\t\t.sc-membership .mp-activity-comments .date,
\t\t.sc-membership .mp-activity-header-title .date {
\t\t\t";
            // line 534
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-date-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 535
($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-date-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 536
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-date-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-date-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 538
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-date-text-font-family-check", array(), "array") == 1)) {
                // line 539
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-date-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 541
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-date-text-color-check", array(), "array") == 1)) {
                // line 542
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-date-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 544
            echo "\t\t}
\t";
        }
        // line 546
        echo "\t";
        // line 547
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-icons-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-icons-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-icons-text-color-check", array(), "array") == 1))) {
            // line 548
            echo "\t\t.sc-membership .mp-activity-actions a {
\t\t\t";
            // line 549
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-icons-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 550
($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-icons-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 551
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-icons-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-icons-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 553
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-icons-text-font-family-check", array(), "array") == 1)) {
                // line 554
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-icons-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 556
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-icons-text-color-check", array(), "array") == 1)) {
                // line 557
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-icons-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 559
            echo "\t\t}
\t";
        }
        // line 561
        echo "\t";
        // line 562
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-icons-hover-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-icons-hover-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-icons-hover-text-color-check", array(), "array") == 1))) {
            // line 563
            echo "\t\t.sc-membership .mp-activity-actions a:hover {
\t\t\t";
            // line 564
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-icons-hover-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 565
($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-icons-hover-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 566
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-icons-hover-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-icons-hover-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 568
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-icons-hover-text-font-family-check", array(), "array") == 1)) {
                // line 569
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-icons-hover-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 571
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-icons-hover-text-color-check", array(), "array") == 1)) {
                // line 572
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "post-icons-hover-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 574
            echo "\t\t}
\t";
        }
        // line 576
        echo "\t";
        // line 577
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "deleted-post-entry-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "deleted-post-entry-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "deleted-post-entry-text-color-check", array(), "array") == 1))) {
            // line 578
            echo "\t\t.sc-membership .mp-activity .mp-activity-content.mp-activity-removed {
\t\t\t";
            // line 579
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "deleted-post-entry-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 580
($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "deleted-post-entry-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 581
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "deleted-post-entry-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "deleted-post-entry-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 583
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "deleted-post-entry-text-font-family-check", array(), "array") == 1)) {
                // line 584
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "deleted-post-entry-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 586
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "deleted-post-entry-text-color-check", array(), "array") == 1)) {
                // line 587
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "deleted-post-entry-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 589
            echo "\t\t}
\t";
        }
        // line 591
        echo "\t";
        // line 592
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "menu-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "menu-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "menu-text-color-check", array(), "array") == 1))) {
            // line 593
            echo "\t\t.sc-membership .mp-activity-menu .item {
\t\t\t";
            // line 594
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "menu-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 595
($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "menu-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 596
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "menu-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "menu-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 598
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "menu-text-font-family-check", array(), "array") == 1)) {
                // line 599
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "menu-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 601
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "menu-text-color-check", array(), "array") == 1)) {
                // line 602
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "menu-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 604
            echo "\t\t}
\t";
        }
        // line 606
        echo "\t";
        // line 607
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "menu-hover-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "menu-hover-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "menu-hover-text-color-check", array(), "array") == 1))) {
            // line 608
            echo "\t\t.sc-membership .mp-activity-menu .item:hover {
\t\t\t";
            // line 609
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "menu-hover-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 610
($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "menu-hover-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 611
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "menu-hover-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "menu-hover-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 613
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "menu-hover-text-font-family-check", array(), "array") == 1)) {
                // line 614
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "menu-hover-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 616
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "menu-hover-text-color-check", array(), "array") == 1)) {
                // line 617
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "profile", array()), "menu-hover-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 619
            echo "\t\t}
\t";
        }
        // line 621
        echo "
\t";
        // line 623
        echo "\t";
        // line 624
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-text-color-check", array(), "array") == 1))) {
            // line 625
            echo "\t\t.sc-membership .activity-filter {
\t\t\t";
            // line 626
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 627
($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 628
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 630
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-text-font-family-check", array(), "array") == 1)) {
                // line 631
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 633
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-text-color-check", array(), "array") == 1)) {
                // line 634
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 636
            echo "\t\t}
\t";
        }
        // line 638
        echo "\t";
        // line 639
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-hover-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-hover-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-hover-text-color-check", array(), "array") == 1))) {
            // line 640
            echo "\t\t.sc-membership .activity-filter:hover {
\t\t\t";
            // line 641
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-hover-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 642
($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-hover-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 643
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-hover-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-hover-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 645
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-hover-text-font-family-check", array(), "array") == 1)) {
                // line 646
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-hover-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 648
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-hover-text-color-check", array(), "array") == 1)) {
                // line 649
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-hover-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 651
            echo "\t\t}
\t";
        }
        // line 653
        echo "\t";
        // line 654
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-menu-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-menu-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-menu-text-color-check", array(), "array") == 1))) {
            // line 655
            echo "\t\t.sc-membership .activity-filter .header,
\t\t.sc-membership .activity-filter .activity-filter-item,
\t\t.sc-membership .activity-filter .menu .activity-type-item {
\t\t\t";
            // line 658
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-menu-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 659
($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-menu-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 660
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-menu-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-menu-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 662
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-menu-text-font-family-check", array(), "array") == 1)) {
                // line 663
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-menu-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 665
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-menu-text-color-check", array(), "array") == 1)) {
                // line 666
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-menu-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 668
            echo "\t\t}
\t";
        }
        // line 670
        echo "\t";
        // line 671
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-menu-hover-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-menu-hover-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-menu-hover-text-color-check", array(), "array") == 1))) {
            // line 672
            echo "\t\t.sc-membership .activity-filter .header:hover,
\t\t.sc-membership .activity-filter .activity-filter-item:hover,
\t\t.sc-membership .activity-filter .menu .activity-type-item:hover {
\t\t\t";
            // line 675
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-menu-hover-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 676
($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-menu-hover-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 677
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-menu-hover-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-menu-hover-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 679
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-menu-hover-text-font-family-check", array(), "array") == 1)) {
                // line 680
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-menu-hover-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 682
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-menu-hover-text-color-check", array(), "array") == 1)) {
                // line 683
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "activity", array()), "filter-button-menu-hover-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 685
            echo "\t\t}
\t";
        }
        // line 687
        echo "
\t";
        // line 689
        echo "\t";
        // line 690
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "user-name-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "user-name-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "user-name-text-color-check", array(), "array") == 1))) {
            // line 691
            echo "\t\t.sc-membership .mp-user-card a.header {
\t\t\t";
            // line 692
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "user-name-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 693
($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "user-name-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 694
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "user-name-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "user-name-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 696
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "user-name-text-font-family-check", array(), "array") == 1)) {
                // line 697
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "user-name-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 699
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "user-name-text-color-check", array(), "array") == 1)) {
                // line 700
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "user-name-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 702
            echo "\t\t}
\t";
        }
        // line 704
        echo "\t";
        // line 705
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "user-name-hover-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "user-name-hover-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "user-name-hover-text-color-check", array(), "array") == 1))) {
            // line 706
            echo "\t\t.sc-membership .mp-user-card a.header:hover {
\t\t\t";
            // line 707
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "user-name-hover-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 708
($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "user-name-hover-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 709
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "user-name-hover-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "user-name-hover-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 711
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "user-name-hover-text-font-family-check", array(), "array") == 1)) {
                // line 712
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "user-name-hover-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 714
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "user-name-hover-text-color-check", array(), "array") == 1)) {
                // line 715
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "user-name-hover-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 717
            echo "\t\t}
\t";
        }
        // line 719
        echo "\t";
        // line 720
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "counters-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "counters-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "counters-text-color-check", array(), "array") == 1))) {
            // line 721
            echo "\t\t.sc-membership .mp-user-card .statistic div.value {
\t\t\t";
            // line 722
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "counters-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 723
($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "counters-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 724
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "counters-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "counters-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 726
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "counters-text-font-family-check", array(), "array") == 1)) {
                // line 727
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "counters-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 729
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "counters-text-color-check", array(), "array") == 1)) {
                // line 730
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "counters-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 732
            echo "\t\t}
\t";
        }
        // line 734
        echo "\t";
        // line 735
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "counters-label-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "counters-label-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "counters-label-text-color-check", array(), "array") == 1))) {
            // line 736
            echo "\t\t.sc-membership .mp-user-card .statistic div.label {
\t\t\t";
            // line 737
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "counters-label-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 738
($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "counters-label-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 739
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "counters-label-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "counters-label-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 741
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "counters-label-text-font-family-check", array(), "array") == 1)) {
                // line 742
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "counters-label-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 744
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "counters-label-text-color-check", array(), "array") == 1)) {
                // line 745
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "members", array()), "counters-label-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 747
            echo "\t\t}
\t";
        }
        // line 749
        echo "\t";
        // line 750
        echo "\t";
        // line 751
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "tab-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "tab-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "tab-text-color-check", array(), "array") == 1))) {
            // line 752
            echo "\t\t.sc-membership .groups-tab-items a.item {
\t\t\t";
            // line 753
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "tab-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 754
($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "tab-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 755
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "tab-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "tab-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 757
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "tab-text-font-family-check", array(), "array") == 1)) {
                // line 758
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "tab-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 760
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "tab-text-color-check", array(), "array") == 1)) {
                // line 761
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "tab-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 763
            echo "\t\t}
\t";
        }
        // line 765
        echo "\t";
        // line 766
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "user-name-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "user-name-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "user-name-text-color-check", array(), "array") == 1))) {
            // line 767
            echo "\t\t.sc-membership .ui.card.mp-group-card a.header {
\t\t\t";
            // line 768
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "user-name-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 769
($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "user-name-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 770
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "user-name-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "user-name-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 772
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "user-name-text-font-family-check", array(), "array") == 1)) {
                // line 773
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "user-name-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 775
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "user-name-text-color-check", array(), "array") == 1)) {
                // line 776
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "user-name-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 778
            echo "\t\t}
\t";
        }
        // line 780
        echo "\t";
        // line 781
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "user-name-hover-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "user-name-hover-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "user-name-hover-text-color-check", array(), "array") == 1))) {
            // line 782
            echo "\t\t.sc-membership .ui.card.mp-group-card a.header:hover {
\t\t\t";
            // line 783
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "user-name-hover-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 784
($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "user-name-hover-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 785
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "user-name-hover-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "user-name-hover-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 787
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "user-name-hover-text-font-family-check", array(), "array") == 1)) {
                // line 788
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "user-name-hover-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 790
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "user-name-hover-text-color-check", array(), "array") == 1)) {
                // line 791
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "user-name-hover-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 793
            echo "\t\t}
\t";
        }
        // line 795
        echo "\t";
        // line 796
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "group-type-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "group-type-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "group-type-text-color-check", array(), "array") == 1))) {
            // line 797
            echo "\t\t.sc-membership .ui.card.mp-group-card .mbs-group-g-type small {
\t\t\t";
            // line 798
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "group-type-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 799
($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "group-type-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 800
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "group-type-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "group-type-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 802
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "group-type-text-font-family-check", array(), "array") == 1)) {
                // line 803
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "group-type-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 805
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "group-type-text-color-check", array(), "array") == 1)) {
                // line 806
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "group-type-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 808
            echo "\t\t}
\t";
        }
        // line 810
        echo "\t";
        // line 811
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "follower-count-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "follower-count-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "follower-count-text-color-check", array(), "array") == 1))) {
            // line 812
            echo "\t\t.sc-membership .ui.card.mp-group-card .mbs-group-followers small {
\t\t\t";
            // line 813
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "follower-count-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 814
($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "follower-count-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 815
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "follower-count-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "follower-count-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 817
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "follower-count-text-font-family-check", array(), "array") == 1)) {
                // line 818
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "follower-count-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 820
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "follower-count-text-color-check", array(), "array") == 1)) {
                // line 821
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "groups", array()), "follower-count-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 823
            echo "\t\t}
\t";
        }
        // line 825
        echo "
\t";
        // line 827
        echo "\t";
        // line 828
        echo "\t";
        if (((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "search", array()), "nothing-found-text-font-size-check", array(), "array") == 1) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "search", array()), "nothing-found-text-font-family-check", array(), "array") == 1)) || ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "search", array()), "nothing-found-text-color-check", array(), "array") == 1))) {
            // line 829
            echo "\t\t.sc-membership .ui.message {
\t\t\t";
            // line 830
            if ((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "search", array()), "nothing-found-text-font-size-check", array(), "array") == 1) && twig_in_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(            // line 831
($context["settings"] ?? null), "design", array()), "fonts", array()), "search", array()), "nothing-found-text-font-unit-select", array(), "array"), array(0 => "px", 1 => "em")))) {
                // line 832
                echo "\t\t\t\tfont-size: ";
                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "search", array()), "nothing-found-text-font-size-number", array(), "array") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "search", array()), "nothing-found-text-font-unit-select", array(), "array")), "html", null, true);
                echo "  !important;
\t\t\t";
            }
            // line 834
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "search", array()), "nothing-found-text-font-family-check", array(), "array") == 1)) {
                // line 835
                echo "\t\t\t\tfont-family: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "search", array()), "nothing-found-text-font-family-select", array(), "array"), "html", null, true);
                echo "\" !important;
\t\t\t";
            }
            // line 837
            echo "\t\t\t";
            if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "search", array()), "nothing-found-text-color-check", array(), "array") == 1)) {
                // line 838
                echo "\t\t\t\tcolor: ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "fonts", array()), "search", array()), "nothing-found-text-color-input", array(), "array"), "html", null, true);
                echo " !important;
\t\t\t";
            }
            // line 840
            echo "\t\t}
\t";
        }
        // line 842
        echo "</style>
";
    }

    public function getTemplateName()
    {
        return "@design/styles.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1963 => 842,  1959 => 840,  1953 => 838,  1950 => 837,  1944 => 835,  1941 => 834,  1935 => 832,  1933 => 831,  1932 => 830,  1929 => 829,  1926 => 828,  1924 => 827,  1921 => 825,  1917 => 823,  1911 => 821,  1908 => 820,  1902 => 818,  1899 => 817,  1893 => 815,  1891 => 814,  1890 => 813,  1887 => 812,  1884 => 811,  1882 => 810,  1878 => 808,  1872 => 806,  1869 => 805,  1863 => 803,  1860 => 802,  1854 => 800,  1852 => 799,  1851 => 798,  1848 => 797,  1845 => 796,  1843 => 795,  1839 => 793,  1833 => 791,  1830 => 790,  1824 => 788,  1821 => 787,  1815 => 785,  1813 => 784,  1812 => 783,  1809 => 782,  1806 => 781,  1804 => 780,  1800 => 778,  1794 => 776,  1791 => 775,  1785 => 773,  1782 => 772,  1776 => 770,  1774 => 769,  1773 => 768,  1770 => 767,  1767 => 766,  1765 => 765,  1761 => 763,  1755 => 761,  1752 => 760,  1746 => 758,  1743 => 757,  1737 => 755,  1735 => 754,  1734 => 753,  1731 => 752,  1728 => 751,  1726 => 750,  1724 => 749,  1720 => 747,  1714 => 745,  1711 => 744,  1705 => 742,  1702 => 741,  1696 => 739,  1694 => 738,  1693 => 737,  1690 => 736,  1687 => 735,  1685 => 734,  1681 => 732,  1675 => 730,  1672 => 729,  1666 => 727,  1663 => 726,  1657 => 724,  1655 => 723,  1654 => 722,  1651 => 721,  1648 => 720,  1646 => 719,  1642 => 717,  1636 => 715,  1633 => 714,  1627 => 712,  1624 => 711,  1618 => 709,  1616 => 708,  1615 => 707,  1612 => 706,  1609 => 705,  1607 => 704,  1603 => 702,  1597 => 700,  1594 => 699,  1588 => 697,  1585 => 696,  1579 => 694,  1577 => 693,  1576 => 692,  1573 => 691,  1570 => 690,  1568 => 689,  1565 => 687,  1561 => 685,  1555 => 683,  1552 => 682,  1546 => 680,  1543 => 679,  1537 => 677,  1535 => 676,  1534 => 675,  1529 => 672,  1526 => 671,  1524 => 670,  1520 => 668,  1514 => 666,  1511 => 665,  1505 => 663,  1502 => 662,  1496 => 660,  1494 => 659,  1493 => 658,  1488 => 655,  1485 => 654,  1483 => 653,  1479 => 651,  1473 => 649,  1470 => 648,  1464 => 646,  1461 => 645,  1455 => 643,  1453 => 642,  1452 => 641,  1449 => 640,  1446 => 639,  1444 => 638,  1440 => 636,  1434 => 634,  1431 => 633,  1425 => 631,  1422 => 630,  1416 => 628,  1414 => 627,  1413 => 626,  1410 => 625,  1407 => 624,  1405 => 623,  1402 => 621,  1398 => 619,  1392 => 617,  1389 => 616,  1383 => 614,  1380 => 613,  1374 => 611,  1372 => 610,  1371 => 609,  1368 => 608,  1365 => 607,  1363 => 606,  1359 => 604,  1353 => 602,  1350 => 601,  1344 => 599,  1341 => 598,  1335 => 596,  1333 => 595,  1332 => 594,  1329 => 593,  1326 => 592,  1324 => 591,  1320 => 589,  1314 => 587,  1311 => 586,  1305 => 584,  1302 => 583,  1296 => 581,  1294 => 580,  1293 => 579,  1290 => 578,  1287 => 577,  1285 => 576,  1281 => 574,  1275 => 572,  1272 => 571,  1266 => 569,  1263 => 568,  1257 => 566,  1255 => 565,  1254 => 564,  1251 => 563,  1248 => 562,  1246 => 561,  1242 => 559,  1236 => 557,  1233 => 556,  1227 => 554,  1224 => 553,  1218 => 551,  1216 => 550,  1215 => 549,  1212 => 548,  1209 => 547,  1207 => 546,  1203 => 544,  1197 => 542,  1194 => 541,  1188 => 539,  1185 => 538,  1179 => 536,  1177 => 535,  1176 => 534,  1172 => 532,  1169 => 531,  1167 => 530,  1163 => 528,  1157 => 526,  1154 => 525,  1148 => 523,  1145 => 522,  1139 => 520,  1137 => 519,  1136 => 518,  1133 => 517,  1130 => 516,  1126 => 513,  1122 => 511,  1116 => 509,  1113 => 508,  1107 => 506,  1104 => 505,  1098 => 503,  1096 => 502,  1095 => 501,  1091 => 499,  1088 => 498,  1086 => 497,  1082 => 495,  1076 => 493,  1073 => 492,  1067 => 490,  1064 => 489,  1058 => 487,  1056 => 486,  1055 => 485,  1052 => 484,  1049 => 483,  1047 => 482,  1043 => 480,  1037 => 478,  1034 => 477,  1028 => 475,  1025 => 474,  1019 => 472,  1017 => 471,  1016 => 470,  1011 => 467,  1008 => 466,  1006 => 465,  1002 => 463,  996 => 461,  993 => 460,  987 => 458,  985 => 457,  984 => 456,  981 => 455,  978 => 454,  976 => 453,  972 => 451,  966 => 449,  963 => 448,  957 => 446,  955 => 445,  954 => 444,  950 => 442,  947 => 441,  945 => 440,  941 => 438,  935 => 436,  932 => 435,  926 => 433,  923 => 432,  917 => 430,  915 => 429,  914 => 428,  911 => 427,  908 => 426,  906 => 425,  902 => 423,  896 => 421,  893 => 420,  887 => 418,  884 => 417,  878 => 415,  876 => 414,  875 => 413,  871 => 411,  868 => 410,  866 => 409,  862 => 407,  856 => 405,  853 => 404,  847 => 402,  844 => 401,  838 => 399,  836 => 398,  835 => 397,  831 => 395,  828 => 394,  826 => 393,  822 => 391,  816 => 389,  813 => 388,  807 => 386,  804 => 385,  798 => 383,  796 => 382,  795 => 381,  792 => 380,  789 => 379,  787 => 378,  783 => 376,  777 => 374,  774 => 373,  768 => 371,  765 => 370,  759 => 368,  757 => 367,  756 => 366,  753 => 365,  750 => 364,  748 => 363,  744 => 361,  738 => 359,  735 => 358,  729 => 356,  726 => 355,  720 => 353,  718 => 352,  717 => 351,  714 => 350,  711 => 349,  709 => 348,  707 => 347,  703 => 345,  697 => 343,  694 => 342,  688 => 340,  685 => 339,  679 => 337,  677 => 336,  676 => 335,  673 => 334,  670 => 333,  668 => 332,  664 => 330,  658 => 328,  655 => 327,  649 => 325,  646 => 324,  640 => 322,  638 => 321,  637 => 320,  634 => 319,  631 => 318,  629 => 317,  625 => 315,  619 => 313,  616 => 312,  610 => 310,  607 => 309,  601 => 307,  599 => 306,  598 => 305,  595 => 304,  592 => 303,  590 => 302,  586 => 300,  580 => 298,  577 => 297,  571 => 295,  568 => 294,  562 => 292,  560 => 291,  559 => 290,  550 => 283,  547 => 282,  545 => 281,  541 => 279,  535 => 277,  532 => 276,  526 => 274,  523 => 273,  517 => 271,  515 => 270,  514 => 269,  511 => 268,  508 => 267,  506 => 266,  502 => 264,  496 => 262,  493 => 261,  487 => 259,  484 => 258,  478 => 256,  476 => 255,  475 => 254,  471 => 252,  468 => 251,  466 => 250,  462 => 248,  456 => 246,  453 => 245,  447 => 243,  444 => 242,  438 => 240,  436 => 239,  435 => 238,  431 => 236,  428 => 235,  426 => 234,  424 => 233,  418 => 229,  416 => 228,  413 => 227,  407 => 223,  405 => 222,  402 => 221,  396 => 217,  394 => 216,  391 => 215,  361 => 187,  359 => 186,  355 => 184,  324 => 156,  322 => 155,  319 => 154,  289 => 126,  287 => 125,  283 => 123,  277 => 121,  275 => 120,  271 => 119,  264 => 115,  260 => 113,  257 => 112,  251 => 109,  248 => 108,  245 => 107,  240 => 104,  236 => 103,  232 => 102,  228 => 101,  224 => 100,  220 => 99,  216 => 98,  212 => 97,  206 => 94,  202 => 93,  197 => 90,  191 => 88,  188 => 87,  184 => 85,  180 => 84,  172 => 80,  167 => 79,  162 => 78,  157 => 77,  151 => 74,  144 => 71,  141 => 70,  138 => 69,  136 => 63,  133 => 62,  130 => 61,  127 => 60,  122 => 57,  116 => 54,  113 => 53,  108 => 50,  101 => 45,  95 => 42,  92 => 41,  90 => 40,  86 => 38,  80 => 36,  77 => 35,  73 => 33,  65 => 27,  59 => 25,  57 => 24,  44 => 13,  38 => 11,  35 => 10,  31 => 8,  25 => 4,  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@design/styles.twig", "F:\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Design\\views\\styles.twig");
    }
}
