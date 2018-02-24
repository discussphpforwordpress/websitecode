<?php

/* @base/macros/options.twig */
class __TwigTemplate_4d24d3090059abbdcc6f909c97ebd73da72ee999cd80fc20d844791d34f338a7 extends Twig_Template
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
        // line 37
        echo "
";
        // line 92
        echo "
";
        // line 116
        echo "
";
        // line 159
        echo "
";
        // line 180
        echo "
";
        // line 186
        echo "
";
        // line 191
        echo "
";
        // line 196
        echo "
";
        // line 201
        echo "
";
        // line 206
        echo "
";
        // line 211
        echo "
";
        // line 222
        echo "
";
        // line 233
        echo "
";
        // line 240
        echo "
";
        // line 245
        echo "
";
        // line 250
        echo "
";
        // line 255
        echo "
";
        // line 260
        echo "
";
        // line 265
        echo "
";
        // line 270
        echo "
";
        // line 275
        echo "
";
        // line 280
        echo "
";
        // line 285
        echo "
";
        // line 290
        echo "
";
        // line 310
        echo "
";
        // line 329
        echo "
";
        // line 335
        echo "
";
        // line 339
        echo "
";
        // line 345
        echo "
";
        // line 351
        echo "
";
        // line 357
        echo "
";
        // line 363
        echo "
";
        // line 380
        echo "
";
        // line 396
        echo "
";
        // line 431
        echo "
";
        // line 453
        echo "
";
        // line 461
        echo "
";
        // line 469
        echo "
";
        // line 477
        echo "
";
        // line 490
        echo "
";
        // line 497
        echo "
";
        // line 526
        echo "
";
    }

    // line 1
    public function getrow($__label__ = null, $__input__ = null, $__id__ = null, $__attributes__ = null, $__withoutHelper__ = null, $__params__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "input" => $__input__,
            "id" => $__id__,
            "attributes" => $__attributes__,
            "withoutHelper" => $__withoutHelper__,
            "params" => $__params__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 2
            echo "\t";
            $context["tooltips"] = $this->loadTemplate("@base/macros/tooltips-templates.twig", "@base/macros/options.twig", 2);
            // line 3
            echo "\t";
            $context["options"] = $this;
            // line 4
            echo "\t<div class=\"mp-option\" ";
            if (($context["id"] ?? null)) {
                echo "id=\"";
                echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
                echo "\"";
            }
            echo ($context["attributes"] ?? null);
            echo ">
\t\t<div class=\"row\">
\t\t\t";
            // line 6
            ob_start();
            // line 7
            echo "\t\t\t\t";
            if ( !($context["withoutHelper"] ?? null)) {
                // line 8
                echo "\t\t\t\t<div class=\"mp-option-helper tooltip\">
\t\t\t\t\t<i class=\"fa fa-question sc-tooltip\"></i>
\t\t\t\t\t<div class=\"tooltip_content\">
\t\t\t\t\t\t<div>";
                // line 11
                if (($context["id"] ?? null)) {
                    echo call_user_func_array($this->env->getFunction('translate')->getCallable(), array($context["tooltips"]->getget(($context["id"] ?? null))));
                }
                echo "</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t";
            }
            // line 15
            echo "\t\t\t";
            $context["toolTipHtml"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 16
            echo "
\t\t\t";
            // line 17
            if ((($context["params"] ?? null) && $this->getAttribute(($context["params"] ?? null), "mbsThinCol", array()))) {
                // line 18
                echo "\t\t\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t\t\t<div class=\"mp-option-label\">
\t\t\t\t\t\t<span title=\"";
                // line 20
                echo twig_escape_filter($this->env, ($context["label"] ?? null), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, ($context["label"] ?? null), "html", null, true);
                echo "</span>
\t\t\t\t\t\t";
                // line 21
                echo twig_escape_filter($this->env, ($context["toolTipHtml"] ?? null), "html", null, true);
                echo "
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t";
            } else {
                // line 25
                echo "\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t";
                // line 26
                echo $context["options"]->getlabel(($context["label"] ?? null));
                echo "
\t\t\t\t\t";
                // line 27
                echo twig_escape_filter($this->env, ($context["toolTipHtml"] ?? null), "html", null, true);
                echo "
\t\t\t\t</div>
\t\t\t";
            }
            // line 30
            echo "
\t\t\t<div class=\"col-md-8\">
\t\t\t\t";
            // line 32
            echo ($context["input"] ?? null);
            echo "
\t\t\t</div>
\t\t</div>
\t</div>
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

    // line 38
    public function getsettingRow($__label__ = null, $__input__ = null, $__id__ = null, $__attributes__ = null, $__buttons__ = null, $__withoutHelper__ = null, $__params__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "input" => $__input__,
            "id" => $__id__,
            "attributes" => $__attributes__,
            "buttons" => $__buttons__,
            "withoutHelper" => $__withoutHelper__,
            "params" => $__params__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 39
            echo "\t";
            $context["tooltips"] = $this->loadTemplate("@base/macros/tooltips-templates.twig", "@base/macros/options.twig", 39);
            // line 40
            echo "    ";
            $context["options"] = $this;
            // line 41
            echo "    <div class=\"mp-option mp-option-setting\" ";
            if (($context["id"] ?? null)) {
                echo "id=\"";
                echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
                echo "\"";
            }
            echo ($context["attributes"] ?? null);
            echo ">
        <div class=\"row\">
\t\t\t";
            // line 43
            ob_start();
            // line 44
            echo "\t\t\t\t";
            if ( !($context["withoutHelper"] ?? null)) {
                // line 45
                echo "\t\t\t\t\t<div class=\"mp-option-helper tooltip\">
\t\t\t\t\t\t<i class=\"fa fa-question sc-tooltip\"></i>
\t\t\t\t\t\t<div class=\"tooltip_content\">
\t\t\t\t\t\t\t<div>";
                // line 48
                if (($context["id"] ?? null)) {
                    echo call_user_func_array($this->env->getFunction('translate')->getCallable(), array($context["tooltips"]->getget(($context["id"] ?? null))));
                }
                echo "</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t";
            }
            // line 52
            echo "\t\t\t";
            $context["toolTipHtml"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 53
            echo "\t\t\t";
            if ((($context["params"] ?? null) && $this->getAttribute(($context["params"] ?? null), "mbsThinCol", array()))) {
                // line 54
                echo "\t\t\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t\t\t<div class=\"mp-option-label\">
\t\t\t\t\t\t<span title=\"";
                // line 56
                echo twig_escape_filter($this->env, ($context["label"] ?? null), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, ($context["label"] ?? null), "html", null, true);
                echo "</span>
\t\t\t\t\t\t";
                // line 57
                echo twig_escape_filter($this->env, ($context["toolTipHtml"] ?? null), "html", null, true);
                echo "
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t";
            } else {
                // line 61
                echo "\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t";
                // line 62
                echo $context["options"]->getlabel(($context["label"] ?? null));
                echo "
\t\t\t\t\t";
                // line 63
                echo twig_escape_filter($this->env, ($context["toolTipHtml"] ?? null), "html", null, true);
                echo "
\t\t\t\t</div>
\t\t\t";
            }
            // line 66
            echo "            <div class=\"col-md-8\">
                ";
            // line 67
            echo ($context["input"] ?? null);
            echo "
                ";
            // line 68
            if (($context["buttons"] ?? null)) {
                // line 69
                echo "                ";
                if ($this->getAttribute(($context["buttons"] ?? null), "edit", array())) {
                    // line 70
                    echo "                <button class=\"mp-option-setting-edit-button sc-button primary\">
                    <i class=\"fa fa-lg fa-edit\"></i>
                    ";
                    // line 72
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["buttons"] ?? null), "edit", array()), "label", array()), "html", null, true);
                    echo "
                </button>
                ";
                }
                // line 75
                echo "                ";
                if ($this->getAttribute(($context["buttons"] ?? null), "send", array())) {
                    // line 76
                    echo "                <button class=\"mp-option-setting-send-button sc-button primary\">
                    <i class=\"fa fa-lg fa-send\"></i>
                    ";
                    // line 78
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["buttons"] ?? null), "send", array()), "label", array()), "html", null, true);
                    echo "
                </button>
                ";
                }
                // line 81
                echo "                ";
                if ($this->getAttribute(($context["buttons"] ?? null), "reset", array())) {
                    // line 82
                    echo "                <button class=\"mp-option-setting-reset-button sc-button primary\">
                    <i class=\"fa fa-lg fa-asterisk\"></i>
                    ";
                    // line 84
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["buttons"] ?? null), "reset", array()), "label", array()), "html", null, true);
                    echo "
                </button>
                ";
                }
                // line 87
                echo "                ";
            }
            // line 88
            echo "            </div>
        </div>
    </div>
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

    // line 93
    public function getsettingRowWithSelect($__label__ = null, $__input__ = null, $__id__ = null, $__attributes__ = null, $__select__ = null, $__withoutHelper__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "input" => $__input__,
            "id" => $__id__,
            "attributes" => $__attributes__,
            "select" => $__select__,
            "withoutHelper" => $__withoutHelper__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 94
            echo "    ";
            $context["tooltips"] = $this->loadTemplate("@base/macros/tooltips-templates.twig", "@base/macros/options.twig", 94);
            // line 95
            echo "    ";
            $context["options"] = $this;
            // line 96
            echo "\t<div class=\"mp-option mp-option-setting\" ";
            if (($context["id"] ?? null)) {
                echo "id=\"";
                echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
                echo "\"";
            }
            echo ($context["attributes"] ?? null);
            echo ">
\t\t<div class=\"row\">
\t\t\t<div class=\"col-md-4\">
                ";
            // line 99
            echo $context["options"]->getlabel(($context["label"] ?? null));
            echo "
    \t\t\t";
            // line 100
            if ( !($context["withoutHelper"] ?? null)) {
                // line 101
                echo "\t\t\t\t<div class=\"mp-option-helper tooltip\">
\t\t\t\t\t<i class=\"fa fa-question sc-tooltip\"></i>
\t\t\t\t\t<div class=\"tooltip_content\">
\t\t\t\t\t\t<div>";
                // line 104
                if (($context["id"] ?? null)) {
                    echo call_user_func_array($this->env->getFunction('translate')->getCallable(), array($context["tooltips"]->getget(($context["id"] ?? null))));
                }
                echo "</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
                ";
            }
            // line 108
            echo "\t\t\t</div>
\t\t\t<div class=\"col-md-8\">
                ";
            // line 110
            echo ($context["input"] ?? null);
            echo "
\t\t\t\t";
            // line 111
            echo $context["options"]->getselectInput($this->getAttribute(($context["select"] ?? null), "options", array()), $this->getAttribute(($context["select"] ?? null), "name", array()));
            echo "
\t\t\t</div>
\t\t</div>
\t</div>
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

    // line 117
    public function getsettingRowWithInput($__label__ = null, $__input1__ = null, $__id__ = null, $__attributes__ = null, $__input2__ = null, $__withHelper__ = null, $__params__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "input1" => $__input1__,
            "id" => $__id__,
            "attributes" => $__attributes__,
            "input2" => $__input2__,
            "withHelper" => $__withHelper__,
            "params" => $__params__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 118
            echo "\t";
            $context["tooltips"] = $this->loadTemplate("@base/macros/tooltips-templates.twig", "@base/macros/options.twig", 118);
            // line 119
            echo "\t";
            $context["options"] = $this;
            // line 120
            echo "\t<div class=\"mp-option mp-option-setting\" ";
            if (($context["id"] ?? null)) {
                echo "id=\"";
                echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
                echo "\"";
            }
            echo ($context["attributes"] ?? null);
            echo ">
\t\t<div class=\"row\">
\t\t\t";
            // line 122
            ob_start();
            // line 123
            echo "\t\t\t\t";
            if ((($context["withHelper"] ?? null) == 1)) {
                // line 124
                echo "\t\t\t\t\t<div class=\"mp-option-helper tooltip\">
\t\t\t\t\t\t<i class=\"fa fa-question sc-tooltip\"></i>
\t\t\t\t\t\t<div class=\"tooltip_content\">
\t\t\t\t\t\t\t<div>";
                // line 127
                if (($context["id"] ?? null)) {
                    echo call_user_func_array($this->env->getFunction('translate')->getCallable(), array($context["tooltips"]->getget(($context["id"] ?? null))));
                }
                echo "</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t";
            }
            // line 131
            echo "\t\t\t";
            $context["toolTipHtml"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 132
            echo "\t\t\t";
            if ((($context["params"] ?? null) && $this->getAttribute(($context["params"] ?? null), "mbsThinCol", array()))) {
                // line 133
                echo "\t\t\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t\t\t<div class=\"mp-option-label\">
\t\t\t\t\t\t<span title=\"";
                // line 135
                echo twig_escape_filter($this->env, ($context["label"] ?? null), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, ($context["label"] ?? null), "html", null, true);
                echo "</span>
\t\t\t\t\t\t";
                // line 136
                echo twig_escape_filter($this->env, ($context["toolTipHtml"] ?? null), "html", null, true);
                echo "
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t";
            } else {
                // line 140
                echo "\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t";
                // line 141
                echo $context["options"]->getlabel(($context["label"] ?? null));
                echo "
\t\t\t\t\t";
                // line 142
                echo twig_escape_filter($this->env, ($context["toolTipHtml"] ?? null), "html", null, true);
                echo "
\t\t\t\t</div>
\t\t\t";
            }
            // line 145
            echo "
\t\t\t<div class=\"col-md-8\">
\t\t\t\t<div class=\"mbs-check-with-input-block\">
\t\t\t\t\t<div class=\"mbs-cwib-check-block\">
\t\t\t\t\t\t";
            // line 149
            echo ($context["input1"] ?? null);
            echo "
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"mbs-cwib-input-block\">
\t\t\t\t\t\t";
            // line 152
            echo ($context["input2"] ?? null);
            echo "
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
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

    // line 160
    public function getsettingRowWpEditor($__label__ = null, $__input__ = null, $__id__ = null, $__attributes__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "input" => $__input__,
            "id" => $__id__,
            "attributes" => $__attributes__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 161
            echo "    ";
            $context["tooltips"] = $this->loadTemplate("@base/macros/tooltips-templates.twig", "@base/macros/options.twig", 161);
            // line 162
            echo "    ";
            $context["options"] = $this;
            // line 163
            echo "\t<div class=\"mp-option mp-option-setting\" ";
            if (($context["id"] ?? null)) {
                echo "id=\"";
                echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
                echo "\"";
            }
            echo ($context["attributes"] ?? null);
            echo ">
\t\t<div class=\"row\">
\t\t\t<div class=\"col-md-4 offset-md-8\">
                ";
            // line 166
            echo $context["options"]->getlabel(($context["label"] ?? null));
            echo "
\t\t\t\t<div class=\"mp-option-helper tooltip\">
\t\t\t\t\t<i class=\"fa fa-question sc-tooltip\"></i>
\t\t\t\t\t<div class=\"tooltip_content\">
\t\t\t\t\t\t<div>";
            // line 170
            if (($context["id"] ?? null)) {
                echo call_user_func_array($this->env->getFunction('translate')->getCallable(), array($context["tooltips"]->getget(($context["id"] ?? null))));
            }
            echo "</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"col-md-12\">
                ";
            // line 175
            echo ($context["input"] ?? null);
            echo "
\t\t\t</div>
\t\t</div>
\t</div>
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

    // line 181
    public function getlabel($__label__ = null, $__helper__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "helper" => $__helper__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 182
            echo "\t<div class=\"mp-option-label\">
\t\t<span title=\"";
            // line 183
            echo twig_escape_filter($this->env, ($context["label"] ?? null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, ($context["label"] ?? null), "html", null, true);
            echo "</span>
\t</div>
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

    // line 187
    public function getradioRow($__label__ = null, $__radios__ = null, $__id__ = null, $__attributes__ = null, $__withoutHelper__ = null, $__params__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "radios" => $__radios__,
            "id" => $__id__,
            "attributes" => $__attributes__,
            "withoutHelper" => $__withoutHelper__,
            "params" => $__params__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 188
            echo "\t";
            $context["options"] = $this;
            // line 189
            echo "\t";
            echo $context["options"]->getrow(($context["label"] ?? null), $context["options"]->getradioInput(($context["radios"] ?? null)), ($context["id"] ?? null), ($context["attributes"] ?? null), ($context["withoutHelper"] ?? null), ($context["params"] ?? null));
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

    // line 192
    public function getradioRowWithInput($__label__ = null, $__radios__ = null, $__id__ = null, $__attributes__ = null, $__input__ = null, $__withoutHelper__ = null, $__params__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "radios" => $__radios__,
            "id" => $__id__,
            "attributes" => $__attributes__,
            "input" => $__input__,
            "withoutHelper" => $__withoutHelper__,
            "params" => $__params__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 193
            echo "\t";
            $context["options"] = $this;
            // line 194
            echo "\t";
            echo $context["options"]->getrow(($context["label"] ?? null), $context["options"]->getradioWithInput(($context["radios"] ?? null), ($context["input"] ?? null)), ($context["id"] ?? null), ($context["attributes"] ?? null), ($context["withoutHelper"] ?? null), ($context["params"] ?? null));
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

    // line 197
    public function getselectRow($__label__ = null, $__options__ = null, $__name__ = null, $__id__ = null, $__withoutHelper__ = null, $__params__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "options" => $__options__,
            "name" => $__name__,
            "id" => $__id__,
            "withoutHelper" => $__withoutHelper__,
            "params" => $__params__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 198
            echo "\t";
            $context["_options"] = $this;
            // line 199
            echo "\t";
            echo $context["_options"]->getrow(($context["label"] ?? null), $context["_options"]->getselectInput(($context["options"] ?? null), ($context["name"] ?? null)), ($context["id"] ?? null), null, ($context["withoutHelper"] ?? null), ($context["params"] ?? null));
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

    // line 202
    public function getmultipleSelectRow($__label__ = null, $__options__ = null, $__name__ = null, $__id__ = null, $__attributes__ = null, $__selectAttributes__ = null, $__description__ = null, $__withoutHelper__ = null, $__addClasses__ = null, $__params__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "options" => $__options__,
            "name" => $__name__,
            "id" => $__id__,
            "attributes" => $__attributes__,
            "selectAttributes" => $__selectAttributes__,
            "description" => $__description__,
            "withoutHelper" => $__withoutHelper__,
            "addClasses" => $__addClasses__,
            "params" => $__params__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 203
            echo "\t";
            $context["_options"] = $this;
            // line 204
            echo "\t";
            echo $context["_options"]->getrow(($context["label"] ?? null), $context["_options"]->getmultipleSelectInput(($context["options"] ?? null), ($context["name"] ?? null), ($context["selectAttributes"] ?? null), ($context["description"] ?? null), ($context["addClasses"] ?? null)), ($context["id"] ?? null), ($context["attributes"] ?? null), ($context["withoutHelper"] ?? null), ($context["params"] ?? null));
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

    // line 207
    public function getwpEditorRow($__label__ = null, $__name__ = null, $__value__ = null, $__id__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "name" => $__name__,
            "value" => $__value__,
            "id" => $__id__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 208
            echo "\t";
            $context["_options"] = $this;
            // line 209
            echo "\t";
            echo $context["_options"]->getsettingRowWpEditor(($context["label"] ?? null), $context["_options"]->getwpEditor(($context["name"] ?? null), ($context["value"] ?? null)), ($context["id"] ?? null));
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

    // line 212
    public function getsubmitRow($__label__ = null, $__name__ = null, $__id__ = null, $__attributes__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "name" => $__name__,
            "id" => $__id__,
            "attributes" => $__attributes__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 213
            echo "\t";
            $context["options"] = $this;
            // line 214
            echo "    <div class=\"mp-option mp-option-setting\" ";
            if (($context["id"] ?? null)) {
                echo "id=\"";
                echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
                echo "\"";
            }
            echo ($context["attributes"] ?? null);
            echo ">
        <div class=\"row\">
            <div class=\"col-md-12\">
                ";
            // line 217
            echo $context["options"]->getsubmit(($context["name"] ?? null), ($context["label"] ?? null), ($context["id"] ?? null));
            echo "
            </div>
        </div>
    </div>
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

    // line 223
    public function getsaveButtonRow($__label__ = null, $__id__ = null, $__attributes__ = null, $__addBtnClasses__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "id" => $__id__,
            "attributes" => $__attributes__,
            "addBtnClasses" => $__addBtnClasses__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 224
            echo "\t";
            $context["options"] = $this;
            // line 225
            echo "    <div class=\"mp-option mp-option-setting\" ";
            if (($context["id"] ?? null)) {
                echo "id=\"";
                echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
                echo "\"";
            }
            echo ($context["attributes"] ?? null);
            echo ">
        <div class=\"row\">
            <div class=\"col-md-12\">
\t\t\t\t";
            // line 228
            echo $context["options"]->getsaveButton(($context["label"] ?? null), ($context["addBtnClasses"] ?? null));
            echo "
            </div>
        </div>
    </div>
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

    // line 234
    public function getsaveButton($__label__ = null, $__addBtnClasses__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "addBtnClasses" => $__addBtnClasses__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 235
            echo "\t<button data-save-settings class=\"save-settings sc-button icon-button primary ";
            if (($context["addBtnClasses"] ?? null)) {
                echo twig_escape_filter($this->env, ($context["addBtnClasses"] ?? null), "html", null, true);
            }
            echo "\">
\t\t<i class=\"fa fa-save\"></i>
\t\t<span>";
            // line 237
            echo twig_escape_filter($this->env, ($context["label"] ?? null), "html", null, true);
            echo "</span>
\t</button>
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

    // line 241
    public function getinputRow($__label__ = null, $__name__ = null, $__value__ = null, $__id__ = null, $__attributes__ = null, $__inputAttributes__ = null, $__params__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "name" => $__name__,
            "value" => $__value__,
            "id" => $__id__,
            "attributes" => $__attributes__,
            "inputAttributes" => $__inputAttributes__,
            "params" => $__params__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 242
            echo "\t";
            $context["options"] = $this;
            // line 243
            echo "\t";
            echo $context["options"]->getrow(($context["label"] ?? null), $context["options"]->gettextInput(($context["name"] ?? null), ($context["value"] ?? null), ($context["inputAttributes"] ?? null)), ($context["id"] ?? null), ($context["attributes"] ?? null), ($context["withoutHelper"] ?? null), ($context["params"] ?? null));
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

    // line 246
    public function getemailRow($__label__ = null, $__name__ = null, $__value__ = null, $__id__ = null, $__attributes__ = null, $__withoutHelper__ = null, $__params__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "name" => $__name__,
            "value" => $__value__,
            "id" => $__id__,
            "attributes" => $__attributes__,
            "withoutHelper" => $__withoutHelper__,
            "params" => $__params__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 247
            echo "\t";
            $context["options"] = $this;
            // line 248
            echo "\t";
            echo $context["options"]->getrow(($context["label"] ?? null), $context["options"]->getemailInput(($context["name"] ?? null), ($context["value"] ?? null)), ($context["id"] ?? null), ($context["attributes"] ?? null), ($context["withoutHelper"] ?? null), ($context["params"] ?? null));
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

    // line 251
    public function gettextareaRow($__label__ = null, $__name__ = null, $__value__ = null, $__id__ = null, $__attributes__ = null, $__cols__ = null, $__rows__ = null, $__withoutHelper__ = null, $__params__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "name" => $__name__,
            "value" => $__value__,
            "id" => $__id__,
            "attributes" => $__attributes__,
            "cols" => $__cols__,
            "rows" => $__rows__,
            "withoutHelper" => $__withoutHelper__,
            "params" => $__params__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 252
            echo "\t";
            $context["options"] = $this;
            // line 253
            echo "\t";
            echo $context["options"]->getrow(($context["label"] ?? null), $context["options"]->gettextareaInput(($context["name"] ?? null), ($context["value"] ?? null), ($context["cols"] ?? null), ($context["rows"] ?? null)), ($context["id"] ?? null), ($context["attributes"] ?? null), ($context["withoutHelper"] ?? null), ($context["params"] ?? null));
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

    // line 256
    public function getcolorRow($__label__ = null, $__name__ = null, $__value__ = null, $__id__ = null, $__attributes__ = null, $__withoutHelper__ = null, $__params__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "name" => $__name__,
            "value" => $__value__,
            "id" => $__id__,
            "attributes" => $__attributes__,
            "withoutHelper" => $__withoutHelper__,
            "params" => $__params__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 257
            echo "\t";
            $context["options"] = $this;
            // line 258
            echo "\t";
            echo $context["options"]->getrow(($context["label"] ?? null), $context["options"]->getcolorInput(($context["name"] ?? null), ($context["value"] ?? null)), ($context["id"] ?? null), ($context["attributes"] ?? null), ($context["withoutHelper"] ?? null), ($context["params"] ?? null));
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

    // line 261
    public function getinputRowWithButton($__label__ = null, $__buttonLabel__ = null, $__name__ = null, $__value__ = null, $__id__ = null, $__attributes__ = null, $__withoutHelper__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "buttonLabel" => $__buttonLabel__,
            "name" => $__name__,
            "value" => $__value__,
            "id" => $__id__,
            "attributes" => $__attributes__,
            "withoutHelper" => $__withoutHelper__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 262
            echo "\t";
            $context["options"] = $this;
            // line 263
            echo "\t";
            echo $context["options"]->getrow(($context["label"] ?? null), $context["options"]->getinputWithButton(($context["buttonLabel"] ?? null), ($context["name"] ?? null), ($context["value"] ?? null)), ($context["id"] ?? null), ($context["attributes"] ?? null), ($context["withoutHelper"] ?? null));
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

    // line 266
    public function getemailRowWithButton($__label__ = null, $__button__ = null, $__name__ = null, $__value__ = null, $__id__ = null, $__attributes__ = null, $__withoutHelper__ = null, $__params__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "button" => $__button__,
            "name" => $__name__,
            "value" => $__value__,
            "id" => $__id__,
            "attributes" => $__attributes__,
            "withoutHelper" => $__withoutHelper__,
            "params" => $__params__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 267
            echo "\t";
            $context["options"] = $this;
            // line 268
            echo "\t";
            echo $context["options"]->getrow(($context["label"] ?? null), $context["options"]->getemailWithButton(($context["button"] ?? null), ($context["name"] ?? null), ($context["value"] ?? null)), ($context["id"] ?? null), ($context["attributes"] ?? null), ($context["withoutHelper"] ?? null), ($context["params"] ?? null));
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

    // line 271
    public function getcheckboxRow($__label__ = null, $__checkboxes__ = null, $__id__ = null, $__attributes__ = null, $__withoutHelper__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "checkboxes" => $__checkboxes__,
            "id" => $__id__,
            "attributes" => $__attributes__,
            "withoutHelper" => $__withoutHelper__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 272
            echo "    ";
            $context["options"] = $this;
            // line 273
            echo "    ";
            echo $context["options"]->getrow(($context["label"] ?? null), $context["options"]->getcheckboxInput(($context["checkboxes"] ?? null)), ($context["id"] ?? null), ($context["attributes"] ?? null), ($context["withoutHelper"] ?? null));
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

    // line 276
    public function getcheckboxSettingRow($__label__ = null, $__checkboxes__ = null, $__id__ = null, $__attributes__ = null, $__buttons__ = null, $__withoutHelper__ = null, $__params__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "checkboxes" => $__checkboxes__,
            "id" => $__id__,
            "attributes" => $__attributes__,
            "buttons" => $__buttons__,
            "withoutHelper" => $__withoutHelper__,
            "params" => $__params__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 277
            echo "    ";
            $context["options"] = $this;
            // line 278
            echo "    ";
            echo $context["options"]->getsettingRow(($context["label"] ?? null), $context["options"]->getcheckboxInput(($context["checkboxes"] ?? null)), ($context["id"] ?? null), ($context["attributes"] ?? null), ($context["buttons"] ?? null), ($context["withoutHelper"] ?? null), ($context["params"] ?? null));
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

    // line 281
    public function getcheckboxSettingRowWithSelect($__label__ = null, $__checkboxes__ = null, $__id__ = null, $__attributes__ = null, $__select__ = null, $__withoutHelper__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "checkboxes" => $__checkboxes__,
            "id" => $__id__,
            "attributes" => $__attributes__,
            "select" => $__select__,
            "withoutHelper" => $__withoutHelper__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 282
            echo "    ";
            $context["options"] = $this;
            // line 283
            echo "    ";
            echo $context["options"]->getsettingRowWithSelect(($context["label"] ?? null), $context["options"]->getcheckboxInput(($context["checkboxes"] ?? null)), ($context["id"] ?? null), ($context["attributes"] ?? null), ($context["select"] ?? null), ($context["withoutHelper"] ?? null));
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

    // line 286
    public function getcheckboxSettingRowWithInput($__label__ = null, $__checkboxes__ = null, $__input2__ = null, $__id__ = null, $__attributes__ = null, $__withHelper__ = null, $__params__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "checkboxes" => $__checkboxes__,
            "input2" => $__input2__,
            "id" => $__id__,
            "attributes" => $__attributes__,
            "withHelper" => $__withHelper__,
            "params" => $__params__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 287
            echo "\t";
            $context["options"] = $this;
            // line 288
            echo "\t";
            echo $context["options"]->getsettingRowWithInput(($context["label"] ?? null), $context["options"]->getcheckboxInput(($context["checkboxes"] ?? null)), ($context["id"] ?? null), ($context["attributes"] ?? null), ($context["input2"] ?? null), ($context["withHelper"] ?? null), ($context["params"] ?? null));
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

    // line 291
    public function getcheckboxInput($__checkboxes__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "checkboxes" => $__checkboxes__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 292
            echo "\t<div class=\"mp-option-checkbox\">
\t\t";
            // line 293
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["checkboxes"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                // line 294
                echo "\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t<input
\t\t\t\t\t\ttype=\"checkbox\"
\t\t\t\t\t\tname=\"";
                // line 297
                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "name", array()), "html", null, true);
                echo "\"
\t\t\t\t\t\tvalue=\"";
                // line 298
                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "value", array()), "html", null, true);
                echo "\"
\t\t\t\t\t\t";
                // line 299
                if ($this->getAttribute($context["option"], "checked", array())) {
                    // line 300
                    echo "\t\t\t\t\t\t\tchecked=\"true\"
\t\t\t\t\t\t";
                }
                // line 302
                echo "\t\t\t\t\t\t";
                echo $this->getAttribute($context["option"], "attributes", array());
                echo "
\t\t\t\t>
\t\t\t\t";
                // line 304
                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "label", array()), "html", null, true);
                echo "
\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t</label>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 308
            echo "\t</div>
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

    // line 311
    public function getradioInput($__radios__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "radios" => $__radios__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 312
            echo "\t<div class=\"mp-option-controls\">
\t\t";
            // line 313
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["radios"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["radio"]) {
                // line 314
                echo "\t\t\t<label class=\"sc-radio\">
\t\t\t\t<input 
\t\t\t\t\ttype=\"radio\"
\t\t\t\t\tname=\"";
                // line 317
                echo twig_escape_filter($this->env, $this->getAttribute($context["radio"], "name", array()), "html", null, true);
                echo "\"
\t\t\t\t\tvalue=\"";
                // line 318
                echo twig_escape_filter($this->env, $this->getAttribute($context["radio"], "value", array()), "html", null, true);
                echo "\"
\t\t\t\t\t";
                // line 319
                if ($this->getAttribute($context["radio"], "checked", array())) {
                    // line 320
                    echo "\t\t\t\t\tchecked
\t\t\t\t\t";
                }
                // line 322
                echo "\t\t\t\t>
\t\t\t\t";
                // line 323
                echo twig_escape_filter($this->env, $this->getAttribute($context["radio"], "label", array()), "html", null, true);
                echo "
\t\t\t\t<div class=\"sc-radio-state\"></div>
\t\t\t</label>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['radio'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 327
            echo "\t</div>
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

    // line 330
    public function gettextInput($__name__ = null, $__value__ = null, $__attributes__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "name" => $__name__,
            "value" => $__value__,
            "attributes" => $__attributes__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 331
            echo "\t<div class=\"mp-option-input\">
\t\t<input class=\"sc-input\" name=\"";
            // line 332
            echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
            echo "\" value=\"";
            echo twig_escape_filter($this->env, ($context["value"] ?? null), "html", null, true);
            echo "\"";
            echo ($context["attributes"] ?? null);
            echo ">
\t</div>
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

    // line 336
    public function gethiddenInput($__name__ = null, $__value__ = null, $__attributes__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "name" => $__name__,
            "value" => $__value__,
            "attributes" => $__attributes__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 337
            echo "\t<input type=\"hidden\" name=\"";
            echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
            echo "\" value=\"";
            echo twig_escape_filter($this->env, ($context["value"] ?? null), "html", null, true);
            echo "\"";
            echo ($context["attributes"] ?? null);
            echo ">
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

    // line 340
    public function getwpEditor($__name__ = null, $__value__ = null, $__attributes__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "name" => $__name__,
            "value" => $__value__,
            "attributes" => $__attributes__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 341
            echo "\t";
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Base_Twig')->callFunction("wp_editor", ($context["value"] ?? null), ($context["name"] ?? null), array("drag_drop_upload" => 1)), "html", null, true);
            // line 343
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

    // line 346
    public function getemailInput($__name__ = null, $__value__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "name" => $__name__,
            "value" => $__value__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 347
            echo "\t<div class=\"mp-option-input\">
\t\t<input class=\"sc-input\" name=\"";
            // line 348
            echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
            echo "\" type=\"email\" value=\"";
            echo twig_escape_filter($this->env, ($context["value"] ?? null), "html", null, true);
            echo "\">
\t</div>
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

    // line 352
    public function gettextareaInput($__name__ = null, $__value__ = null, $__cols__ = 35, $__rows__ = 5, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "name" => $__name__,
            "value" => $__value__,
            "cols" => $__cols__,
            "rows" => $__rows__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 353
            echo "\t<div class=\"mp-option-input\">
\t\t<textarea class=\"sc-input\" name=\"";
            // line 354
            echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
            echo "\" cols=\"";
            echo twig_escape_filter($this->env, ($context["cols"] ?? null), "html", null, true);
            echo "\" rows=\"";
            echo twig_escape_filter($this->env, ($context["rows"] ?? null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, ($context["value"] ?? null), "html", null, true);
            echo "</textarea>
\t</div>
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

    // line 358
    public function getcolorInput($__name__ = null, $__value__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "name" => $__name__,
            "value" => $__value__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 359
            echo "\t<div class=\"mp-option-color-input\">
\t\t<input class=\"sc-input\" name=\"";
            // line 360
            echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
            echo "\" value=\"";
            echo twig_escape_filter($this->env, ($context["value"] ?? null), "html", null, true);
            echo "\">
\t</div>
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

    // line 364
    public function getselectInput($__options__ = null, $__name__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "options" => $__options__,
            "name" => $__name__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 365
            echo "\t<div class=\"mp-option-select\">
\t\t<select class=\"sc-input\" name=\"";
            // line 366
            echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
            echo "\">
\t\t\t";
            // line 367
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["options"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                // line 368
                echo "\t\t\t\t<option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "value", array()), "html", null, true);
                echo "\" 
\t\t\t\t\t";
                // line 369
                if ($this->getAttribute($context["option"], "selected", array())) {
                    // line 370
                    echo "\t\t\t\t\t\tselected
\t\t\t\t\t";
                }
                // line 371
                echo "\t
\t\t\t\t\t";
                // line 372
                if ($this->getAttribute($context["option"], "disabled", array())) {
                    // line 373
                    echo "\t\t\t\t\t\tdisabled
\t\t\t\t\t";
                }
                // line 375
                echo "\t\t\t\t>";
                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "title", array()), "html", null, true);
                echo "</option>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 377
            echo "\t\t</select>
\t</div>
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

    // line 381
    public function getcolorInput2($__attributes__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "attributes" => $__attributes__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 382
            echo "\t<div class=\"mp-option-color-input\">
\t\t<input
\t\t\t";
            // line 384
            if (array_key_exists("attributes", $context)) {
                // line 385
                echo "\t\t\t\t";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["attributes"] ?? null));
                foreach ($context['_seq'] as $context["attribute"] => $context["val"]) {
                    // line 386
                    echo "\t\t\t\t\t";
                    if (twig_test_iterable($context["val"])) {
                        // line 387
                        echo "\t\t\t\t\t\t";
                        echo twig_escape_filter($this->env, $context["attribute"], "html", null, true);
                        echo "=\"";
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($context["val"]);
                        foreach ($context['_seq'] as $context["attr"] => $context["param"]) {
                            echo twig_escape_filter($this->env, $context["attr"], "html", null, true);
                            echo ":";
                            echo twig_escape_filter($this->env, $context["param"], "html", null, true);
                            echo ";";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['attr'], $context['param'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        echo "\"
\t\t\t\t\t";
                    } else {
                        // line 389
                        echo "\t\t\t\t\t\t";
                        echo twig_escape_filter($this->env, $context["attribute"], "html", null, true);
                        echo "=\"";
                        echo twig_escape_filter($this->env, $context["val"], "html", null, true);
                        echo "\"
\t\t\t\t\t";
                    }
                    // line 391
                    echo "\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['attribute'], $context['val'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 392
                echo "\t\t\t";
            }
            // line 393
            echo "\t\t/>
\t</div>
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

    // line 397
    public function getselectInput2($__optionsList__ = null, $__selectedOption__ = null, $__attributes__ = null, $__useWrapper__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "optionsList" => $__optionsList__,
            "selectedOption" => $__selectedOption__,
            "attributes" => $__attributes__,
            "useWrapper" => $__useWrapper__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 398
            echo "\t";
            if ((($context["useWrapper"] ?? null) != 0)) {
                // line 399
                echo "\t\t<div class=\"mp-option-select\">
\t";
            }
            // line 401
            echo "\t<select
\t\t";
            // line 402
            if (array_key_exists("attributes", $context)) {
                // line 403
                echo "\t\t\t";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["attributes"] ?? null));
                foreach ($context['_seq'] as $context["attribute"] => $context["val"]) {
                    // line 404
                    echo "\t\t\t\t";
                    if (twig_test_iterable($context["val"])) {
                        // line 405
                        echo "\t\t\t\t\t";
                        echo twig_escape_filter($this->env, $context["attribute"], "html", null, true);
                        echo "=\"";
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($context["val"]);
                        foreach ($context['_seq'] as $context["attr"] => $context["param"]) {
                            echo twig_escape_filter($this->env, $context["attr"], "html", null, true);
                            echo ":";
                            echo twig_escape_filter($this->env, $context["param"], "html", null, true);
                            echo ";";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['attr'], $context['param'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        echo "\"
\t\t\t\t";
                    } else {
                        // line 407
                        echo "\t\t\t\t\t";
                        echo twig_escape_filter($this->env, $context["attribute"], "html", null, true);
                        echo "=\"";
                        echo twig_escape_filter($this->env, $context["val"], "html", null, true);
                        echo "\"
\t\t\t\t";
                    }
                    // line 409
                    echo "\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['attribute'], $context['val'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 410
                echo "\t\t";
            }
            // line 411
            echo "\t\">
\t\t";
            // line 412
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["optionsList"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                // line 413
                echo "\t\t\t<option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "value", array()), "html", null, true);
                echo "\"
\t\t\t\t\t";
                // line 414
                if (twig_test_iterable(($context["selectedOption"] ?? null))) {
                    // line 415
                    echo "\t\t\t\t\t\t";
                    if (twig_in_filter($this->getAttribute($context["option"], "value", array()), ($context["selectedOption"] ?? null))) {
                        // line 416
                        echo "\t\t\t\t\t\t\tselected=\"selected\"
\t\t\t\t\t\t";
                    }
                    // line 418
                    echo "\t\t\t\t\t";
                } elseif (($this->getAttribute($context["option"], "value", array()) == ($context["selectedOption"] ?? null))) {
                    // line 419
                    echo "\t\t\t\t\t\tselected=\"selected\"
\t\t\t\t\t";
                }
                // line 421
                echo "\t\t\t\t\t";
                if ($this->getAttribute($context["option"], "disabled", array())) {
                    // line 422
                    echo "\t\t\t\t\t\tdisabled=\"disabled\"
\t\t\t\t\t";
                }
                // line 424
                echo "\t\t\t>";
                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "title", array()), "html", null, true);
                echo "</option>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 426
            echo "\t</select>
\t";
            // line 427
            if ((($context["useWrapper"] ?? null) != 0)) {
                // line 428
                echo "\t\t</div>
\t";
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 432
    public function getmultipleSelectInput($__options__ = null, $__name__ = null, $__attributes__ = null, $__description__ = null, $__addClasses__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "options" => $__options__,
            "name" => $__name__,
            "attributes" => $__attributes__,
            "description" => $__description__,
            "addClasses" => $__addClasses__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 433
            echo "\t<div class=\"mp-option-select\">
\t\t<select class=\"sc-input ";
            // line 434
            if ( !twig_test_empty(($context["addClasses"] ?? null))) {
                echo twig_escape_filter($this->env, ($context["addClasses"] ?? null), "html", null, true);
            }
            echo "\" name=\"";
            echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
            echo "[]\" ";
            echo ($context["attributes"] ?? null);
            echo " multiple>
\t\t\t";
            // line 435
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["options"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                // line 436
                echo "\t\t\t\t<option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "value", array()), "html", null, true);
                echo "\" 
\t\t\t\t\t";
                // line 437
                if ($this->getAttribute($context["option"], "selected", array())) {
                    // line 438
                    echo "\t\t\t\t\t\tselected
\t\t\t\t\t";
                }
                // line 439
                echo "\t
\t\t\t\t\t";
                // line 440
                if ($this->getAttribute($context["option"], "disabled", array())) {
                    // line 441
                    echo "\t\t\t\t\t\tdisabled
\t\t\t\t\t";
                }
                // line 443
                echo "\t\t\t\t>";
                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "title", array()), "html", null, true);
                echo "</option>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 445
            echo "\t\t</select>
\t\t";
            // line 446
            if ( !twig_test_empty(($context["description"] ?? null))) {
                // line 447
                echo "\t\t\t<div class=\"mp-option-select-description\" id=\"";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["description"] ?? null), "id", array()), "html", null, true);
                echo "\">
\t\t\t\t<span>";
                // line 448
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array($this->getAttribute(($context["description"] ?? null), "title", array()))), "html", null, true);
                echo "</span>
\t\t\t</div>
\t\t";
            }
            // line 451
            echo "\t</div>
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

    // line 454
    public function getinputWithButton($__buttonLabel__ = null, $__inputName__ = null, $__inputValue__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "buttonLabel" => $__buttonLabel__,
            "inputName" => $__inputName__,
            "inputValue" => $__inputValue__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 455
            echo "\t";
            $context["options"] = $this;
            // line 456
            echo "\t<div class=\"mp-option-input-with-button\">
\t\t<button class=\"mp-option-button sc-button primary\">";
            // line 457
            echo twig_escape_filter($this->env, ($context["buttonLabel"] ?? null), "html", null, true);
            echo "</button>
\t\t";
            // line 458
            echo $context["options"]->gettextInput(($context["inputName"] ?? null), ($context["inputValue"] ?? null));
            echo "
\t</div>
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

    // line 462
    public function getemailWithButton($__button__ = null, $__inputName__ = null, $__inputValue__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "button" => $__button__,
            "inputName" => $__inputName__,
            "inputValue" => $__inputValue__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 463
            echo "\t";
            $context["options"] = $this;
            // line 464
            echo "\t<div class=\"mp-option-input-with-button\">
\t\t";
            // line 465
            echo twig_escape_filter($this->env, ($context["button"] ?? null), "html", null, true);
            echo "
\t\t";
            // line 466
            echo $context["options"]->getemailInput(($context["inputName"] ?? null), ($context["inputValue"] ?? null));
            echo "
\t</div>
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

    // line 470
    public function getradioWithInput($__radios__ = null, $__input__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "radios" => $__radios__,
            "input" => $__input__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 471
            echo "\t";
            $context["options"] = $this;
            // line 472
            echo "\t<div class=\"mp-option-input-with-input\">
\t\t";
            // line 473
            echo $context["options"]->getradioInput(($context["radios"] ?? null));
            echo "
\t\t";
            // line 474
            echo twig_escape_filter($this->env, ($context["input"] ?? null), "html", null, true);
            echo "
\t</div>
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

    // line 478
    public function getbutton($__label__ = null, $__id__ = null, $__class__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "id" => $__id__,
            "class" => $__class__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 479
            echo "\t";
            $context["tooltips"] = $this->loadTemplate("@base/macros/tooltips-templates.twig", "@base/macros/options.twig", 479);
            // line 480
            echo "    <div class=\"tooltip\">
        <button
                class=\"mp-option-button sc-button primary";
            // line 482
            if (($context["class"] ?? null)) {
                echo " ";
                echo twig_escape_filter($this->env, ($context["class"] ?? null), "html", null, true);
            }
            echo "\"
                ";
            // line 483
            if (($context["id"] ?? null)) {
                echo "id=\"";
                echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
                echo "\" title=\"\"";
            }
            // line 484
            echo "        >";
            echo twig_escape_filter($this->env, ($context["label"] ?? null), "html", null, true);
            echo "</button>
        <div class=\"tooltip_content\">
            <div>";
            // line 486
            if (($context["id"] ?? null)) {
                echo call_user_func_array($this->env->getFunction('translate')->getCallable(), array($context["tooltips"]->getget(($context["id"] ?? null))));
            }
            echo "</div>
        </div>
    </div>
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

    // line 491
    public function getsubmit($__name__ = null, $__label__ = null, $__id__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "name" => $__name__,
            "label" => $__label__,
            "id" => $__id__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 492
            echo "\t<input type=\"submit\" name=\"";
            echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
            echo "\" value=\"";
            echo twig_escape_filter($this->env, ($context["label"] ?? null), "html", null, true);
            echo "\"
\t\t\tclass=\"mp-option-button sc-button primary\"
\t\t\t";
            // line 494
            if (($context["id"] ?? null)) {
                echo "id=\"";
                echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
                echo "\"";
            }
            // line 495
            echo "\t/>
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

    // line 498
    public function getenablePluginRow($__label__ = null, $__inputName__ = null, $__id__ = null, $__attributes__ = null, $__buttonName__ = null, $__withoutHelper__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "label" => $__label__,
            "inputName" => $__inputName__,
            "id" => $__id__,
            "attributes" => $__attributes__,
            "buttonName" => $__buttonName__,
            "withoutHelper" => $__withoutHelper__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 499
            echo "\t";
            $context["tooltips"] = $this->loadTemplate("@base/macros/tooltips-templates.twig", "@base/macros/options.twig", 499);
            // line 500
            echo "\t";
            $context["options"] = $this;
            // line 501
            echo "
\t<div class=\"row\" ";
            // line 502
            if (($context["id"] ?? null)) {
                echo "id=\"";
                echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
                echo "\"";
            }
            echo ">
\t\t<div class=\"col-xs-4 mpp-mrgn-top-8 mbsThinCol\">
\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t<input type=\"checkbox\" name=\"";
            // line 505
            echo twig_escape_filter($this->env, ($context["inputName"] ?? null), "html", null, true);
            echo "[enabled]\" value=\"1\" ";
            echo twig_escape_filter($this->env, (($this->getAttribute(($context["attributes"] ?? null), "input", array(), "any", true, true)) ? ($this->getAttribute(($context["attributes"] ?? null), "input", array())) : (null)), "html", null, true);
            echo ">
\t\t\t\t";
            // line 506
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array(($context["label"] ?? null))), "html", null, true);
            echo "
\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t</label>
\t\t\t";
            // line 509
            if ( !($context["withoutHelper"] ?? null)) {
                // line 510
                echo "\t\t\t\t<div class=\"mpp-tooltip tooltip\">
\t\t\t\t\t<i class=\"fa fa-question sc-tooltip\"></i>
\t\t\t\t\t<div class=\"tooltip_content\">
\t\t\t\t\t\t<div>";
                // line 513
                if (($context["id"] ?? null)) {
                    echo call_user_func_array($this->env->getFunction('translate')->getCallable(), array($context["tooltips"]->getget(($context["id"] ?? null))));
                }
                echo "</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t";
            }
            // line 517
            echo "\t\t</div>
\t\t<div class=\"col-xs-8\">
\t\t\t<button class=\"mpp-button sc-button primary\" ";
            // line 519
            if (($context["id"] ?? null)) {
                echo "id=\"button-";
                echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
                echo "\" data-toogle=\"toogle-";
                echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
                echo "\"";
            }
            echo ">
\t\t\t\t<i class=\"fa fa-angle-down\"></i>
\t\t\t\t<span>";
            // line 521
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array(($context["buttonName"] ?? null))), "html", null, true);
            echo "</span>
\t\t\t</button>
\t\t</div>
\t</div>
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

    // line 527
    public function getinput($__type__ = "text", $__name__ = null, $__value__ = null, $__attributes__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "type" => $__type__,
            "name" => $__name__,
            "value" => $__value__,
            "attributes" => $__attributes__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 528
            echo "\t<input type=\"";
            echo twig_escape_filter($this->env, ($context["type"] ?? null), "html", null, true);
            echo "\" name=\"";
            echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
            echo "\" value=\"";
            echo twig_escape_filter($this->env, ($context["value"] ?? null), "html", null, true);
            echo "\"
\t\t";
            // line 529
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["attributes"] ?? null));
            foreach ($context['_seq'] as $context["attribute"] => $context["val"]) {
                // line 530
                echo "\t\t\t";
                if (twig_test_iterable($context["val"])) {
                    // line 531
                    echo "\t\t\t\t";
                    echo twig_escape_filter($this->env, $context["attribute"], "html", null, true);
                    echo "=\"";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($context["val"]);
                    foreach ($context['_seq'] as $context["attr"] => $context["param"]) {
                        echo twig_escape_filter($this->env, $context["attr"], "html", null, true);
                        echo ":";
                        echo twig_escape_filter($this->env, $context["param"], "html", null, true);
                        echo ";";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['attr'], $context['param'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    echo "\"
\t\t\t";
                } else {
                    // line 533
                    echo "\t\t\t\t";
                    echo twig_escape_filter($this->env, $context["attribute"], "html", null, true);
                    echo "=\"";
                    echo twig_escape_filter($this->env, $context["val"], "html", null, true);
                    echo "\"
\t\t\t";
                }
                // line 535
                echo "\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['attribute'], $context['val'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 536
            echo "\t/>
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
        return "@base/macros/options.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  2585 => 536,  2579 => 535,  2571 => 533,  2553 => 531,  2550 => 530,  2546 => 529,  2537 => 528,  2522 => 527,  2502 => 521,  2491 => 519,  2487 => 517,  2478 => 513,  2473 => 510,  2471 => 509,  2465 => 506,  2459 => 505,  2449 => 502,  2446 => 501,  2443 => 500,  2440 => 499,  2423 => 498,  2407 => 495,  2401 => 494,  2393 => 492,  2379 => 491,  2358 => 486,  2352 => 484,  2346 => 483,  2339 => 482,  2335 => 480,  2332 => 479,  2318 => 478,  2300 => 474,  2296 => 473,  2293 => 472,  2290 => 471,  2277 => 470,  2259 => 466,  2255 => 465,  2252 => 464,  2249 => 463,  2235 => 462,  2217 => 458,  2213 => 457,  2210 => 456,  2207 => 455,  2193 => 454,  2177 => 451,  2171 => 448,  2166 => 447,  2164 => 446,  2161 => 445,  2152 => 443,  2148 => 441,  2146 => 440,  2143 => 439,  2139 => 438,  2137 => 437,  2132 => 436,  2128 => 435,  2118 => 434,  2115 => 433,  2099 => 432,  2082 => 428,  2080 => 427,  2077 => 426,  2068 => 424,  2064 => 422,  2061 => 421,  2057 => 419,  2054 => 418,  2050 => 416,  2047 => 415,  2045 => 414,  2040 => 413,  2036 => 412,  2033 => 411,  2030 => 410,  2024 => 409,  2016 => 407,  1998 => 405,  1995 => 404,  1990 => 403,  1988 => 402,  1985 => 401,  1981 => 399,  1978 => 398,  1963 => 397,  1946 => 393,  1943 => 392,  1937 => 391,  1929 => 389,  1911 => 387,  1908 => 386,  1903 => 385,  1901 => 384,  1897 => 382,  1885 => 381,  1868 => 377,  1859 => 375,  1855 => 373,  1853 => 372,  1850 => 371,  1846 => 370,  1844 => 369,  1839 => 368,  1835 => 367,  1831 => 366,  1828 => 365,  1815 => 364,  1795 => 360,  1792 => 359,  1779 => 358,  1755 => 354,  1752 => 353,  1737 => 352,  1717 => 348,  1714 => 347,  1701 => 346,  1685 => 343,  1682 => 341,  1668 => 340,  1646 => 337,  1632 => 336,  1610 => 332,  1607 => 331,  1593 => 330,  1577 => 327,  1567 => 323,  1564 => 322,  1560 => 320,  1558 => 319,  1554 => 318,  1550 => 317,  1545 => 314,  1541 => 313,  1538 => 312,  1526 => 311,  1510 => 308,  1500 => 304,  1494 => 302,  1490 => 300,  1488 => 299,  1484 => 298,  1480 => 297,  1475 => 294,  1471 => 293,  1468 => 292,  1456 => 291,  1438 => 288,  1435 => 287,  1417 => 286,  1399 => 283,  1396 => 282,  1379 => 281,  1361 => 278,  1358 => 277,  1340 => 276,  1322 => 273,  1319 => 272,  1303 => 271,  1285 => 268,  1282 => 267,  1263 => 266,  1245 => 263,  1242 => 262,  1224 => 261,  1206 => 258,  1203 => 257,  1185 => 256,  1167 => 253,  1164 => 252,  1144 => 251,  1126 => 248,  1123 => 247,  1105 => 246,  1087 => 243,  1084 => 242,  1066 => 241,  1048 => 237,  1040 => 235,  1027 => 234,  1007 => 228,  995 => 225,  992 => 224,  977 => 223,  957 => 217,  945 => 214,  942 => 213,  927 => 212,  909 => 209,  906 => 208,  891 => 207,  873 => 204,  870 => 203,  849 => 202,  831 => 199,  828 => 198,  811 => 197,  793 => 194,  790 => 193,  772 => 192,  754 => 189,  751 => 188,  734 => 187,  714 => 183,  711 => 182,  698 => 181,  678 => 175,  668 => 170,  661 => 166,  649 => 163,  646 => 162,  643 => 161,  628 => 160,  606 => 152,  600 => 149,  594 => 145,  588 => 142,  584 => 141,  581 => 140,  574 => 136,  568 => 135,  564 => 133,  561 => 132,  558 => 131,  549 => 127,  544 => 124,  541 => 123,  539 => 122,  528 => 120,  525 => 119,  522 => 118,  504 => 117,  484 => 111,  480 => 110,  476 => 108,  467 => 104,  462 => 101,  460 => 100,  456 => 99,  444 => 96,  441 => 95,  438 => 94,  421 => 93,  403 => 88,  400 => 87,  394 => 84,  390 => 82,  387 => 81,  381 => 78,  377 => 76,  374 => 75,  368 => 72,  364 => 70,  361 => 69,  359 => 68,  355 => 67,  352 => 66,  346 => 63,  342 => 62,  339 => 61,  332 => 57,  326 => 56,  322 => 54,  319 => 53,  316 => 52,  307 => 48,  302 => 45,  299 => 44,  297 => 43,  286 => 41,  283 => 40,  280 => 39,  262 => 38,  242 => 32,  238 => 30,  232 => 27,  228 => 26,  225 => 25,  218 => 21,  212 => 20,  208 => 18,  206 => 17,  203 => 16,  200 => 15,  191 => 11,  186 => 8,  183 => 7,  181 => 6,  170 => 4,  167 => 3,  164 => 2,  147 => 1,  142 => 526,  139 => 497,  136 => 490,  133 => 477,  130 => 469,  127 => 461,  124 => 453,  121 => 431,  118 => 396,  115 => 380,  112 => 363,  109 => 357,  106 => 351,  103 => 345,  100 => 339,  97 => 335,  94 => 329,  91 => 310,  88 => 290,  85 => 285,  82 => 280,  79 => 275,  76 => 270,  73 => 265,  70 => 260,  67 => 255,  64 => 250,  61 => 245,  58 => 240,  55 => 233,  52 => 222,  49 => 211,  46 => 206,  43 => 201,  40 => 196,  37 => 191,  34 => 186,  31 => 180,  28 => 159,  25 => 116,  22 => 92,  19 => 37,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@base/macros/options.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Base\\views\\macros\\options.twig");
    }
}
