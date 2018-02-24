<?php

/* @auth/registration.twig */
class __TwigTemplate_62cb158cb47517186ccf863db3d4db6dfadaaedecf91b519f275e3afd6723b63 extends Twig_Template
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
        echo "<div class=\"sc-membership\">
\t<div class=\"ui centered grid\">
\t\t<div class=\"column left aligned\">
\t\t\t<div class=\"ui message success\" style=\"display: none\"></div>
\t\t\t<form method=\"post\" data-validation-rules=\"";
        // line 5
        echo twig_escape_filter($this->env, twig_jsonencode_filter(($context["validationRules"] ?? null)), "html", null, true);
        echo "\" class=\"ui large form left membership-registration-form\">
\t\t\t\t
\t\t\t\t";
        // line 7
        $context["sections"] = array();
        // line 8
        echo "
\t\t\t\t";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "auth.view.registrationFormBefore"), "method"), "html", null, true);
        echo "
\t\t\t\t";
        // line 10
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "registrationFormBefore"), "method"), "html", null, true);
        echo "
\t\t\t\t
\t\t\t\t";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["fields"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
            // line 13
            echo "\t\t\t\t\t";
            if (($this->getAttribute($context["field"], "enabled", array()) && $this->getAttribute($context["field"], "registration", array()))) {
                // line 14
                echo "\t\t\t\t\t\t";
                if (!twig_in_filter($this->getAttribute($context["field"], "section", array()), ($context["sections"] ?? null))) {
                    // line 15
                    echo "\t\t\t\t\t\t\t<h3>";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "section", array()), "html", null, true);
                    echo "</h3>
\t\t\t\t\t\t\t";
                    // line 16
                    $context["sections"] = twig_array_merge(($context["sections"] ?? null), array(0 => $this->getAttribute($context["field"], "section", array())));
                    // line 17
                    echo "\t\t\t\t\t\t";
                }
                // line 18
                echo "
\t\t\t\t\t\t<div class=\"field\" data-name=\"";
                // line 19
                echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "name", array()), "html", null, true);
                echo "\">
\t\t\t\t\t\t\t<glabel>";
                // line 20
                echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "label", array()), "html", null, true);
                echo " ";
                if ((($this->getAttribute($context["field"], "required", array()) && $this->getAttribute($context["field"], "asterisk", array(), "any", true, true)) && ($this->getAttribute($context["field"], "asterisk", array()) == true))) {
                    echo "<span class=\"gg-required-field\" style=\"color: ";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array(), "array"), "general", array(), "array"), "asterisk-color", array(), "array"), "html", null, true);
                    echo ";\">*</span>";
                }
                echo " </glabel>
\t\t\t\t\t\t\t
\t\t\t\t\t\t\t";
                // line 22
                if (($this->getAttribute($context["field"], "type", array()) == "text")) {
                    // line 23
                    echo "\t\t\t\t\t\t\t\t<input type=\"text\" name=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "name", array()), "html", null, true);
                    echo "\">
\t\t\t\t\t\t\t";
                } elseif (($this->getAttribute(                // line 24
$context["field"], "type", array()) == "email")) {
                    // line 25
                    echo "\t\t\t\t\t\t\t\t<input type=\"email\" name=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "name", array()), "html", null, true);
                    echo "\">
\t\t\t\t\t\t\t";
                } elseif (($this->getAttribute(                // line 26
$context["field"], "type", array()) == "password")) {
                    // line 27
                    echo "\t\t\t\t\t\t\t\t<input type=\"password\" name=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "name", array()), "html", null, true);
                    echo "\">
\t\t\t\t\t\t\t";
                } elseif (($this->getAttribute(                // line 28
$context["field"], "type", array()) == "numeric")) {
                    // line 29
                    echo "\t\t\t\t\t\t\t\t<input type=\"number\" name=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "name", array()), "html", null, true);
                    echo "\">
\t\t\t\t\t\t\t";
                } elseif (($this->getAttribute(                // line 30
$context["field"], "type", array()) == "date")) {
                    // line 31
                    echo "\t\t\t\t\t\t\t\t<input
\t\t\t\t\t\t\t\t\t\tclass=\"date-field\"
\t\t\t\t\t\t\t\t\t\tdata-format=\"";
                    // line 33
                    echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "format", array(), "array"), "html", null, true);
                    echo "\"
\t\t\t\t\t\t\t\t\t\tdata-field-name=\"";
                    // line 34
                    echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "name", array()), "html", null, true);
                    echo "\"
\t\t\t\t\t\t\t\t\t\ttype=\"text\"
\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t<input name=\"";
                    // line 37
                    echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "name", array()), "html", null, true);
                    echo "\" type=\"hidden\">
\t\t\t\t\t\t\t";
                } elseif (($this->getAttribute(                // line 38
$context["field"], "type", array()) == "scroll")) {
                    // line 39
                    echo "\t\t\t\t\t\t\t\t<select multiple class=\"ui fluid multiple search selection dropdown\" name=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "name", array()), "html", null, true);
                    echo "[]\">
\t\t\t\t\t\t\t\t\t";
                    // line 40
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["field"], "options", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                        // line 41
                        echo "\t\t\t\t\t\t\t\t\t\t";
                        $context["checked"] = false;
                        // line 42
                        echo "\t\t\t\t\t\t\t\t\t\t";
                        if (($this->getAttribute($context["field"], "data", array()) &&  !twig_test_empty($this->getAttribute($context["field"], "data", array())))) {
                            // line 43
                            echo "\t\t\t\t\t\t\t\t\t\t\t";
                            if (twig_in_filter($this->getAttribute($context["option"], "id", array()), $this->getAttribute($context["field"], "data", array()))) {
                                // line 44
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t";
                                $context["checked"] = true;
                                // line 45
                                echo "\t\t\t\t\t\t\t\t\t\t\t";
                            }
                            // line 46
                            echo "\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 47
                            echo "\t\t\t\t\t\t\t\t\t\t\tno data
\t\t\t\t\t\t\t\t\t\t\t";
                            // line 48
                            if ($this->getAttribute($context["option"], "checked", array())) {
                                // line 49
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t";
                                $context["checked"] = true;
                                // line 50
                                echo "\t\t\t\t\t\t\t\t\t\t\t";
                            }
                            // line 51
                            echo "\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 52
                        echo "\t\t\t\t\t\t\t\t\t\t<option value=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "id", array()), "html", null, true);
                        echo "\" ";
                        if (($context["checked"] ?? null)) {
                            echo "selected";
                        }
                        echo ">";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "name", array()), "html", null, true);
                        echo "</option>
\t\t\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 54
                    echo "\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t";
                } elseif (($this->getAttribute(                // line 55
$context["field"], "type", array()) == "drop")) {
                    // line 56
                    echo "\t\t\t\t\t\t\t\t<select class=\"ui fluid search single dropdown\" name=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "name", array()), "html", null, true);
                    echo "\">
\t\t\t\t\t\t\t\t\t";
                    // line 57
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["field"], "options", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                        // line 58
                        echo "\t\t\t\t\t\t\t\t\t\t";
                        $context["checked"] = false;
                        // line 59
                        echo "\t\t\t\t\t\t\t\t\t\t";
                        if (($this->getAttribute($context["field"], "data", array()) &&  !twig_test_empty($this->getAttribute($context["field"], "data", array())))) {
                            // line 60
                            echo "\t\t\t\t\t\t\t\t\t\t\t";
                            if (($this->getAttribute($context["option"], "id", array()) == $this->getAttribute($context["field"], "data", array()))) {
                                // line 61
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t";
                                $context["checked"] = true;
                                // line 62
                                echo "\t\t\t\t\t\t\t\t\t\t\t";
                            }
                            // line 63
                            echo "\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 64
                            echo "\t\t\t\t\t\t\t\t\t\t\t";
                            if ($this->getAttribute($context["option"], "checked", array())) {
                                // line 65
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t";
                                $context["checked"] = true;
                                // line 66
                                echo "\t\t\t\t\t\t\t\t\t\t\t";
                            }
                            // line 67
                            echo "\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 68
                        echo "\t\t\t\t\t\t\t\t\t\t<option value=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "id", array()), "html", null, true);
                        echo "\" ";
                        if (($context["checked"] ?? null)) {
                            echo "selected";
                        }
                        echo ">";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "name", array()), "html", null, true);
                        echo "</option>
\t\t\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 70
                    echo "\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t";
                } elseif (($this->getAttribute(                // line 71
$context["field"], "type", array()) == "radio")) {
                    // line 72
                    echo "\t\t\t\t\t\t\t\t<div class=\"inline fields\">
\t\t\t\t\t\t\t\t\t";
                    // line 73
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["field"], "options", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                        // line 74
                        echo "\t\t\t\t\t\t\t\t\t\t<div class=\"field\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"ui radio checkbox\">
\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 76
                        $context["checked"] = false;
                        // line 77
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t";
                        if (($this->getAttribute($context["field"], "data", array()) &&  !twig_test_empty($this->getAttribute($context["field"], "data", array())))) {
                            // line 78
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            if (twig_in_filter($this->getAttribute($context["option"], "id", array()), $this->getAttribute($context["field"], "data", array()))) {
                                // line 79
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                $context["checked"] = true;
                                // line 80
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            }
                            // line 81
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 82
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            if ($this->getAttribute($context["option"], "checked", array())) {
                                // line 83
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                $context["checked"] = true;
                                // line 84
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            }
                            // line 85
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 86
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "name", array()), "html", null, true);
                        echo "\" id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "name", array()), "html", null, true);
                        echo "-";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "id", array()), "html", null, true);
                        echo "\" value=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "id", array()), "html", null, true);
                        echo "\" ";
                        if (($context["checked"] ?? null)) {
                            echo "checked";
                        }
                        echo " class=\"hidden\">
\t\t\t\t\t\t\t\t\t\t\t\t<label for=\"";
                        // line 87
                        echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "name", array()), "html", null, true);
                        echo "-";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "id", array()), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "name", array()), "html", null, true);
                        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 91
                    echo "\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
                } elseif (($this->getAttribute(                // line 92
$context["field"], "type", array()) == "checkbox")) {
                    // line 93
                    echo "\t\t\t\t\t\t\t\t<div class=\"inline fields\">
\t\t\t\t\t\t\t\t\t";
                    // line 94
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["field"], "options", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                        // line 95
                        echo "\t\t\t\t\t\t\t\t\t\t<div class=\"field\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"ui checkbox\">
\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 97
                        $context["checked"] = false;
                        // line 98
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t";
                        if (($this->getAttribute($context["field"], "data", array()) &&  !twig_test_empty($this->getAttribute($context["field"], "data", array())))) {
                            // line 99
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            if (twig_in_filter($this->getAttribute($context["option"], "id", array()), $this->getAttribute($context["field"], "data", array()))) {
                                // line 100
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                $context["checked"] = true;
                                // line 101
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            }
                            // line 102
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 103
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            if ($this->getAttribute($context["option"], "checked", array())) {
                                // line 104
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                $context["checked"] = true;
                                // line 105
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            }
                            // line 106
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 107
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "name", array()), "html", null, true);
                        echo "[]\" id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "name", array()), "html", null, true);
                        echo "-";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "id", array()), "html", null, true);
                        echo "\" value=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "id", array()), "html", null, true);
                        echo "\" ";
                        if (($context["checked"] ?? null)) {
                            echo "checked";
                        }
                        echo " class=\"hidden\">
\t\t\t\t\t\t\t\t\t\t\t\t<label for=\"";
                        // line 108
                        echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "name", array()), "html", null, true);
                        echo "-";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "id", array()), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "name", array()), "html", null, true);
                        echo "</label>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 112
                    echo "\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
                } elseif (($this->getAttribute(                // line 113
$context["field"], "type", array()) == "g-recaptcha-response")) {
                    // line 114
                    echo "\t\t\t\t\t\t\t\t<div class=\"g-recaptcha\"
\t\t\t\t\t\t\t\t     data-sitekey=\"";
                    // line 115
                    echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "google-re-captcha-site-key", array(), "array"), "html", null, true);
                    echo "\"
\t\t\t\t\t\t\t\t     data-theme=\"";
                    // line 116
                    echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "google-re-captcha-theme", array(), "array"), "html", null, true);
                    echo "\"
\t\t\t\t\t\t\t\t     data-type=\"";
                    // line 117
                    echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "google-re-captcha-type", array(), "array"), "html", null, true);
                    echo "\"
\t\t\t\t\t\t\t\t     data-size=\"";
                    // line 118
                    echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "google-re-captcha-size", array(), "array"), "html", null, true);
                    echo "\"
\t\t\t\t\t\t\t\t     data-callback=\"MembershipRecaptchaResponseCallback\"
\t\t\t\t\t\t\t\t></div>
\t\t\t\t\t\t\t";
                }
                // line 122
                echo "\t\t\t\t\t\t
\t\t\t\t\t\t\t";
                // line 123
                if ($this->getAttribute($context["field"], "description", array())) {
                    // line 124
                    echo "\t\t\t\t\t\t\t\t<p><small><em>";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "description", array()), "html", null, true);
                    echo "</em></small></p>
\t\t\t\t\t\t\t";
                }
                // line 126
                echo "\t\t\t\t\t\t</div>
\t\t\t\t\t\t
\t\t\t\t\t\t
\t\t\t\t\t";
            }
            // line 130
            echo "\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 131
        echo "
\t\t\t\t";
        // line 132
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "auth.view.registrationFormAfter"), "method"), "html", null, true);
        echo "
\t\t\t\t";
        // line 133
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "registrationFormAfter"), "method"), "html", null, true);
        echo "
\t\t\t\t
\t\t\t\t<div class=\"ui error message\" style=\"display: none\">
\t\t\t\t\t<i class=\"close icon\"></i>
\t\t\t\t\t<div class=\"header\">
\t\t\t\t\t\t";
        // line 138
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("There were some errors with your data")), "html", null, true);
        echo "
\t\t\t\t\t</div>
\t\t\t\t\t<ul class=\"list\"></ul>
\t\t\t\t</div>
\t\t\t\t
\t\t\t\t<div class=\"mp-action-buttons\">
\t\t\t\t\t<button class=\"registration-submit ui button mini primary\" type=\"submit\" value=\"\">";
        // line 144
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "design", array()), "auth", array()), "registration-primary-button-text", array(), "array"), "html", null, true);
        echo "</button>
\t\t\t\t</div>

\t\t\t\t<input type=\"hidden\" id=\"_wpnonce\" name=\"_wpnonce\" value=\"";
        // line 147
        echo twig_escape_filter($this->env, ($context["nonce"] ?? null), "html", null, true);
        echo "\" />
\t\t\t</form>
\t\t</div>
\t</div>
</div>";
    }

    public function getTemplateName()
    {
        return "@auth/registration.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  475 => 147,  469 => 144,  460 => 138,  452 => 133,  448 => 132,  445 => 131,  439 => 130,  433 => 126,  427 => 124,  425 => 123,  422 => 122,  415 => 118,  411 => 117,  407 => 116,  403 => 115,  400 => 114,  398 => 113,  395 => 112,  381 => 108,  366 => 107,  363 => 106,  360 => 105,  357 => 104,  354 => 103,  351 => 102,  348 => 101,  345 => 100,  342 => 99,  339 => 98,  337 => 97,  333 => 95,  329 => 94,  326 => 93,  324 => 92,  321 => 91,  307 => 87,  292 => 86,  289 => 85,  286 => 84,  283 => 83,  280 => 82,  277 => 81,  274 => 80,  271 => 79,  268 => 78,  265 => 77,  263 => 76,  259 => 74,  255 => 73,  252 => 72,  250 => 71,  247 => 70,  232 => 68,  229 => 67,  226 => 66,  223 => 65,  220 => 64,  217 => 63,  214 => 62,  211 => 61,  208 => 60,  205 => 59,  202 => 58,  198 => 57,  193 => 56,  191 => 55,  188 => 54,  173 => 52,  170 => 51,  167 => 50,  164 => 49,  162 => 48,  159 => 47,  156 => 46,  153 => 45,  150 => 44,  147 => 43,  144 => 42,  141 => 41,  137 => 40,  132 => 39,  130 => 38,  126 => 37,  120 => 34,  116 => 33,  112 => 31,  110 => 30,  105 => 29,  103 => 28,  98 => 27,  96 => 26,  91 => 25,  89 => 24,  84 => 23,  82 => 22,  71 => 20,  67 => 19,  64 => 18,  61 => 17,  59 => 16,  54 => 15,  51 => 14,  48 => 13,  44 => 12,  39 => 10,  35 => 9,  32 => 8,  30 => 7,  25 => 5,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@auth/registration.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Auth\\views\\registration.twig");
    }
}
