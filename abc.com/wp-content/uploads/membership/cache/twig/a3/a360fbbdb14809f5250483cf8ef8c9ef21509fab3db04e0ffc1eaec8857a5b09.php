<?php

/* @users/about.twig */
class __TwigTemplate_af8c653324f399675af42921bb77dd204d8ef93686d21bf50c0276a7b13a2e19 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@users/profile.twig", "@users/about.twig", 1);
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
        echo "\t<div class=\"ui basic vertical segment\" id=\"mp-about\">
\t\t<div class=\"ui grid\">
\t\t\t<div class=\"sixteen wide mobile six wide tablet five wide computer column\">
\t\t\t\t<div class=\"ui stackable secondary vertical fluid pointing menu about-tabs\">
\t\t\t\t\t";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["sections"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["section"]) {
            // line 9
            echo "\t\t\t\t\t\t<a class=\"item ";
            if ($this->getAttribute($context["loop"], "first", array())) {
                echo "active";
            }
            echo "\" data-tab=\"";
            echo twig_escape_filter($this->env, $context["section"], "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $context["section"], "html", null, true);
            echo "</a>
\t\t\t\t\t";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['section'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 11
        echo "                    ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "profileAboutMenu"), "method"), "html", null, true);
        echo "
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"sixteen wide mobile ten wide tablet eleven wide computer column\">
\t\t\t\t";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["sections"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["section"]) {
            // line 16
            echo "\t\t\t\t\t<div class=\"ui tab ";
            if ($this->getAttribute($context["loop"], "first", array())) {
                echo "active";
            }
            echo "\" data-tab=\"";
            echo twig_escape_filter($this->env, $context["section"], "html", null, true);
            echo "\">
\t\t\t\t\t\t";
            // line 17
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["fields"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
                // line 18
                echo "
\t\t\t\t\t\t\t";
                // line 19
                if (($this->getAttribute($context["field"], "section", array()) == $context["section"])) {
                    // line 20
                    echo "\t\t\t\t\t\t\t\t<div class=\"ui vertical segment\">
\t\t\t\t\t\t\t\t\t<div class=\"ui form mp-field\" data-field-name=\"";
                    // line 21
                    echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "name", array()), "html", null, true);
                    echo "\" data-field-type=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "type", array()), "html", null, true);
                    echo "\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ui relaxed grid\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"sixteen wide mobile six wide tablet five wide computer column\">
\t\t\t\t\t\t\t\t\t\t\t\t<label>";
                    // line 24
                    echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "label", array()), "html", null, true);
                    echo "</label>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"sixteen wide mobile ten wide tablet eleven wide computer column\">
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"mp-field-data\">
\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    // line 28
                    if (($this->env->getExtension('Membership_Users_Twig')->isCurrentUser(($context["requestedUser"] ?? null)) && ($this->getAttribute($context["field"], "name", array()) != "user_login"))) {
                        // line 29
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<button class=\"ui button mini primary field-edit-action\"><i class=\"write icon\"></i>";
                        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Edit")), "html", null, true);
                        echo "</button>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    }
                    // line 31
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<p>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    // line 32
                    if ( !twig_test_empty($this->getAttribute($context["field"], "data", array()))) {
                        // line 33
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        if ($this->getAttribute($context["field"], "options", array())) {
                            // line 34
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            $context["data"] = array();
                            // line 35
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            $context['_parent'] = $context;
                            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["field"], "options", array()));
                            foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                                // line 36
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                if (twig_in_filter($this->getAttribute($context["option"], "id", array()), $this->getAttribute($context["field"], "data", array()))) {
                                    // line 37
                                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                    $context["data"] = twig_array_merge(($context["data"] ?? null), array(0 => $this->getAttribute($context["option"], "name", array())));
                                    // line 38
                                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                }
                                // line 39
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 40
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            echo twig_escape_filter($this->env, twig_join_filter(($context["data"] ?? null), " • "), "html", null, true);
                            echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } else {
                            // line 42
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "data", array()), "html", null, true);
                            echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 44
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    } else {
                        // line 45
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        if ($this->getAttribute($context["field"], "options", array())) {
                            // line 46
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            $context["data"] = array();
                            // line 47
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            $context['_parent'] = $context;
                            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["field"], "options", array()));
                            foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                                // line 48
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                if ($this->getAttribute($context["option"], "checked", array())) {
                                    // line 49
                                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                    $context["data"] = twig_array_merge(($context["data"] ?? null), array(0 => $this->getAttribute($context["option"], "name", array())));
                                    // line 50
                                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                }
                                // line 51
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 52
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            echo twig_escape_filter($this->env, twig_join_filter(($context["data"] ?? null), " • "), "html", null, true);
                            echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 54
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    }
                    // line 55
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</p>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t";
                    // line 57
                    if ($this->env->getExtension('Membership_Users_Twig')->isCurrentUser(($context["requestedUser"] ?? null))) {
                        // line 58
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"mp-field-edit\" style=\"display: none\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 59
                        if (($this->getAttribute($context["field"], "type", array()) == "text")) {
                            // line 60
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" value=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "data", array()), "html", null, true);
                            echo "\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } elseif (($this->getAttribute(                        // line 61
$context["field"], "type", array()) == "email")) {
                            // line 62
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"email\" value=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "data", array()), "html", null, true);
                            echo "\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } elseif (($this->getAttribute(                        // line 63
$context["field"], "type", array()) == "password")) {
                            // line 64
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"password\" value=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "data", array()), "html", null, true);
                            echo "\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } elseif (($this->getAttribute(                        // line 65
$context["field"], "type", array()) == "numeric")) {
                            // line 66
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"number\" value=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "data", array()), "html", null, true);
                            echo "\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } elseif (($this->getAttribute(                        // line 67
$context["field"], "type", array()) == "date")) {
                            // line 68
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\ttype=\"text\"
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tclass=\"date-field\"
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tvalue=\"";
                            // line 71
                            echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "data", array()), "html", null, true);
                            echo "\"
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tdata-format=\"";
                            // line 72
                            echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "format", array()), "html", null, true);
                            echo "\"
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"hidden\" value=\"";
                            // line 74
                            echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "timestamp", array()), "html", null, true);
                            echo "\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } elseif (($this->getAttribute(                        // line 75
$context["field"], "type", array()) == "scroll")) {
                            // line 76
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<select class=\"ui fluid multiple search selection dropdown\" multiple>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            // line 77
                            $context['_parent'] = $context;
                            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["field"], "options", array()));
                            foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                                // line 78
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                $context["checked"] = false;
                                // line 79
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                if (($this->getAttribute($context["field"], "data", array()) &&  !twig_test_empty($this->getAttribute($context["field"], "data", array())))) {
                                    // line 80
                                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                    if (twig_in_filter($this->getAttribute($context["option"], "id", array()), $this->getAttribute($context["field"], "data", array()))) {
                                        // line 81
                                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                        $context["checked"] = true;
                                        // line 82
                                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                    }
                                    // line 83
                                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                } else {
                                    // line 84
                                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tno data
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                    // line 85
                                    if ($this->getAttribute($context["option"], "checked", array())) {
                                        // line 86
                                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                        $context["checked"] = true;
                                        // line 87
                                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                    }
                                    // line 88
                                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                }
                                // line 89
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "id", array()), "html", null, true);
                                echo "\" ";
                                if (($context["checked"] ?? null)) {
                                    echo "selected";
                                }
                                echo ">";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "name", array()), "html", null, true);
                                echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 91
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } elseif (($this->getAttribute(                        // line 92
$context["field"], "type", array()) == "drop")) {
                            // line 93
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<select class=\"ui fluid search single dropdown\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            // line 94
                            $context['_parent'] = $context;
                            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["field"], "options", array()));
                            foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                                // line 95
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                $context["checked"] = false;
                                // line 96
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                if (($this->getAttribute($context["field"], "data", array()) &&  !twig_test_empty($this->getAttribute($context["field"], "data", array())))) {
                                    // line 97
                                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                    if (($this->getAttribute($context["option"], "id", array()) == $this->getAttribute($context["field"], "data", array()))) {
                                        // line 98
                                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                        $context["checked"] = true;
                                        // line 99
                                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                    }
                                    // line 100
                                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                } else {
                                    // line 101
                                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                    if ($this->getAttribute($context["option"], "checked", array())) {
                                        // line 102
                                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                        $context["checked"] = true;
                                        // line 103
                                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                    }
                                    // line 104
                                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                }
                                // line 105
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "id", array()), "html", null, true);
                                echo "\" ";
                                if (($context["checked"] ?? null)) {
                                    echo "selected";
                                }
                                echo ">";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "name", array()), "html", null, true);
                                echo "</option>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 107
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } elseif (($this->getAttribute(                        // line 108
$context["field"], "type", array()) == "radio")) {
                            // line 109
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"inline fields\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            // line 110
                            $context['_parent'] = $context;
                            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["field"], "options", array()));
                            foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                                // line 111
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"field\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"ui radio checkbox\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                // line 113
                                $context["checked"] = false;
                                // line 114
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                if (($this->getAttribute($context["field"], "data", array()) &&  !twig_test_empty($this->getAttribute($context["field"], "data", array())))) {
                                    // line 115
                                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                    if (twig_in_filter($this->getAttribute($context["option"], "id", array()), $this->getAttribute($context["field"], "data", array()))) {
                                        // line 116
                                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                        $context["checked"] = true;
                                        // line 117
                                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                    }
                                    // line 118
                                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                } else {
                                    // line 119
                                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                    if ($this->getAttribute($context["option"], "checked", array())) {
                                        // line 120
                                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                        $context["checked"] = true;
                                        // line 121
                                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                    }
                                    // line 122
                                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                }
                                // line 123
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"";
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
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label for=\"";
                                // line 124
                                echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "name", array()), "html", null, true);
                                echo "-";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "id", array()), "html", null, true);
                                echo "\">";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "name", array()), "html", null, true);
                                echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 128
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } elseif (($this->getAttribute(                        // line 129
$context["field"], "type", array()) == "checkbox")) {
                            // line 130
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"inline fields\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            // line 131
                            $context['_parent'] = $context;
                            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["field"], "options", array()));
                            foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                                // line 132
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"field\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"ui checkbox\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                // line 134
                                $context["checked"] = false;
                                // line 135
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                if (($this->getAttribute($context["field"], "data", array()) &&  !twig_test_empty($this->getAttribute($context["field"], "data", array())))) {
                                    // line 136
                                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                    if (twig_in_filter($this->getAttribute($context["option"], "id", array()), $this->getAttribute($context["field"], "data", array()))) {
                                        // line 137
                                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                        $context["checked"] = true;
                                        // line 138
                                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                    }
                                    // line 139
                                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                } else {
                                    // line 140
                                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                    if ($this->getAttribute($context["option"], "checked", array())) {
                                        // line 141
                                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                        $context["checked"] = true;
                                        // line 142
                                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                    }
                                    // line 143
                                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                                }
                                // line 144
                                echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"";
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
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label for=\"";
                                // line 145
                                echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "name", array()), "html", null, true);
                                echo "-";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "id", array()), "html", null, true);
                                echo "\">";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "name", array()), "html", null, true);
                                echo "</label>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 149
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 151
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"ui vertical segment edit-action-buttons\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<button class=\"ui primary mini button save-action\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<i class=\"icon save\"></i> ";
                        // line 153
                        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Save")), "html", null, true);
                        echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<button class=\"ui mini button cancel-action\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<i class=\"icon cancel\"></i> ";
                        // line 156
                        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Cancel")), "html", null, true);
                        echo "
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t";
                    }
                    // line 161
                    echo "\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
                }
                // line 166
                echo "\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 167
            echo "\t\t\t\t\t</div>
\t\t\t\t";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['section'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 169
        echo "                ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "profileAboutTabs"), "method"), "html", null, true);
        echo "
\t\t\t</div>
\t\t</div>
\t</div>
";
    }

    public function getTemplateName()
    {
        return "@users/about.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  593 => 169,  578 => 167,  572 => 166,  565 => 161,  557 => 156,  551 => 153,  547 => 151,  543 => 149,  529 => 145,  516 => 144,  513 => 143,  510 => 142,  507 => 141,  504 => 140,  501 => 139,  498 => 138,  495 => 137,  492 => 136,  489 => 135,  487 => 134,  483 => 132,  479 => 131,  476 => 130,  474 => 129,  471 => 128,  457 => 124,  442 => 123,  439 => 122,  436 => 121,  433 => 120,  430 => 119,  427 => 118,  424 => 117,  421 => 116,  418 => 115,  415 => 114,  413 => 113,  409 => 111,  405 => 110,  402 => 109,  400 => 108,  397 => 107,  382 => 105,  379 => 104,  376 => 103,  373 => 102,  370 => 101,  367 => 100,  364 => 99,  361 => 98,  358 => 97,  355 => 96,  352 => 95,  348 => 94,  345 => 93,  343 => 92,  340 => 91,  325 => 89,  322 => 88,  319 => 87,  316 => 86,  314 => 85,  311 => 84,  308 => 83,  305 => 82,  302 => 81,  299 => 80,  296 => 79,  293 => 78,  289 => 77,  286 => 76,  284 => 75,  280 => 74,  275 => 72,  271 => 71,  266 => 68,  264 => 67,  259 => 66,  257 => 65,  252 => 64,  250 => 63,  245 => 62,  243 => 61,  238 => 60,  236 => 59,  233 => 58,  231 => 57,  227 => 55,  224 => 54,  218 => 52,  212 => 51,  209 => 50,  206 => 49,  203 => 48,  198 => 47,  195 => 46,  192 => 45,  189 => 44,  183 => 42,  177 => 40,  171 => 39,  168 => 38,  165 => 37,  162 => 36,  157 => 35,  154 => 34,  151 => 33,  149 => 32,  146 => 31,  140 => 29,  138 => 28,  131 => 24,  123 => 21,  120 => 20,  118 => 19,  115 => 18,  111 => 17,  102 => 16,  85 => 15,  77 => 11,  54 => 9,  37 => 8,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@users/about.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Users\\views\\about.twig");
    }
}
