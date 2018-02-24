<?php

/* @users/macros/admin-fields.twig */
class __TwigTemplate_7dc571b4e563cce054c6d7a284b17dc13ff443fed629b7f60fde8ea8d80583a3 extends Twig_Template
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
        // line 7
        echo "
";
        // line 14
        echo "
";
        // line 45
        echo "
";
        // line 61
        echo "
";
        // line 65
        echo "
";
        // line 74
        echo "
";
        // line 83
        echo "
";
        // line 92
        echo "
";
        // line 101
        echo "
";
        // line 110
        echo "
";
        // line 126
        echo "
";
        // line 142
        echo "
";
        // line 156
        echo "
";
    }

    // line 1
    public function getcreateField($__field__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $__field__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 2
            echo "\t";
            $context["fields"] = $this;
            // line 3
            echo "\t";
            if ($this->getAttribute(($context["field"] ?? null), "enabled", array())) {
                // line 4
                echo "\t\t";
                echo $context["fields"]->gettemplate(($context["field"] ?? null), $this->getAttribute(($context["fields"] ?? null), $this->getAttribute(($context["field"] ?? null), "type", array()), array(0 => ($context["field"] ?? null))));
                echo "
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

    // line 8
    public function getoutputField($__field__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $__field__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 9
            echo "\t";
            $context["fields"] = $this;
            // line 10
            echo "\t";
            if ($this->getAttribute(($context["field"] ?? null), "enabled", array())) {
                // line 11
                echo "\t\t";
                echo $context["fields"]->gettemplateView(($context["field"] ?? null), $this->getAttribute(($context["field"] ?? null), "data", array()));
                echo "
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

    // line 15
    public function gettemplateView($__field__ = null, $__data__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $__field__,
            "data" => $__data__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 16
            echo "<tr>
\t<td><label><b>";
            // line 17
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "label", array()), "html", null, true);
            echo "</b></label></td>
\t<td>
\t\t";
            // line 19
            if ((($context["data"] ?? null) &&  !twig_test_empty(($context["data"] ?? null)))) {
                // line 20
                echo "\t\t\t";
                if ($this->getAttribute(($context["field"] ?? null), "options", array())) {
                    // line 21
                    echo "\t\t\t\t";
                    $context["data"] = array();
                    // line 22
                    echo "\t\t\t\t";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["field"] ?? null), "options", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                        // line 23
                        echo "\t\t\t\t\t";
                        if (twig_in_filter($this->getAttribute($context["option"], "id", array()), $this->getAttribute(($context["field"] ?? null), "data", array()))) {
                            // line 24
                            echo "\t\t\t\t\t\t";
                            $context["data"] = twig_array_merge(($context["data"] ?? null), array(0 => $this->getAttribute($context["option"], "name", array())));
                            // line 25
                            echo "\t\t\t\t\t";
                        }
                        // line 26
                        echo "\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 27
                    echo "\t\t\t\t";
                    echo twig_escape_filter($this->env, twig_join_filter(($context["data"] ?? null), " "), "html", null, true);
                    echo "
\t\t\t";
                } else {
                    // line 29
                    echo "\t\t\t\t";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "data", array()), "html", null, true);
                    echo "
\t\t\t";
                }
                // line 31
                echo "\t\t";
            } else {
                // line 32
                echo "\t\t\t";
                if ($this->getAttribute(($context["field"] ?? null), "options", array())) {
                    // line 33
                    echo "\t\t\t\t";
                    $context["data"] = array();
                    // line 34
                    echo "\t\t\t\t";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["field"] ?? null), "options", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                        // line 35
                        echo "\t\t\t\t\t";
                        if ($this->getAttribute($context["option"], "checked", array())) {
                            // line 36
                            echo "\t\t\t\t\t\t";
                            $context["data"] = twig_array_merge(($context["data"] ?? null), array(0 => $this->getAttribute($context["option"], "name", array())));
                            // line 37
                            echo "\t\t\t\t\t";
                        }
                        // line 38
                        echo "\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 39
                    echo "\t\t\t\t";
                    echo twig_escape_filter($this->env, twig_join_filter(($context["data"] ?? null), " "), "html", null, true);
                    echo "
\t\t\t";
                }
                // line 41
                echo "\t\t";
            }
            // line 42
            echo "\t</td>
</tr>
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

    // line 46
    public function gettemplate($__field__ = null, $__input__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $__field__,
            "input" => $__input__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 47
            echo "
<tr>
\t<th>
\t\t<label for=\"membership[";
            // line 50
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "name", array()), "html", null, true);
            echo "]\">";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "label", array()), "html", null, true);
            if ($this->getAttribute(($context["field"] ?? null), "required", array())) {
                echo "<span class=\"description\">(";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("required")), "html", null, true);
                echo ")</span>";
            }
            echo "</label>
\t</th>
\t<td>
\t\t";
            // line 53
            echo twig_escape_filter($this->env, ($context["input"] ?? null), "html", null, true);
            echo "
\t\t";
            // line 54
            if ($this->getAttribute(($context["field"] ?? null), "description", array())) {
                // line 55
                echo "\t\t\t<p class=\"description\">";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "description", array()), "html", null, true);
                echo "</p>
\t\t";
            }
            // line 57
            echo "\t</td>
</tr>

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

    // line 62
    public function getsection($__field__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $__field__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 63
            echo "\t<h2>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "label", array()), "html", null, true);
            echo "</h2>
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

    // line 66
    public function gettext($__field__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $__field__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 67
            echo "\t<input 
\t\ttype=\"text\" 
\t\tname=\"membership[";
            // line 69
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "name", array()), "html", null, true);
            echo "]\"
\t\tdata-validation-rules=\"";
            // line 70
            echo twig_escape_filter($this->env, twig_jsonencode_filter($this->getAttribute(($context["field"] ?? null), "validation-rules", array(), "array")), "html", null, true);
            echo "\"
\t\tvalue=\"";
            // line 71
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "data", array()), "html", null, true);
            echo "\" 
\t>
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

    // line 75
    public function getemail($__field__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $__field__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 76
            echo "\t<input
\t\ttype=\"email\"
\t\tname=\"membership[";
            // line 78
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "name", array()), "html", null, true);
            echo "]\"
\t\tdata-validation-rules=\"";
            // line 79
            echo twig_escape_filter($this->env, twig_jsonencode_filter($this->getAttribute(($context["field"] ?? null), "validation-rules", array(), "array")), "html", null, true);
            echo "\"
\t\tvalue=\"";
            // line 80
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "data", array()), "html", null, true);
            echo "\" 
\t>
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

    // line 84
    public function getpassword($__field__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $__field__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 85
            echo "\t<input
\t\ttype=\"password\"
\t\tname=\"membership[";
            // line 87
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "name", array()), "html", null, true);
            echo "]\"
\t\tdata-validation-rules=\"";
            // line 88
            echo twig_escape_filter($this->env, twig_jsonencode_filter($this->getAttribute(($context["field"] ?? null), "validation-rules", array(), "array")), "html", null, true);
            echo "\"
\t\tvalue=\"";
            // line 89
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "data", array()), "html", null, true);
            echo "\" 
\t>
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
    public function getnumeric($__field__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $__field__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 94
            echo "\t<input
\t\ttype=\"number\"
\t\tname=\"membership[";
            // line 96
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "name", array()), "html", null, true);
            echo "]\"
\t\tdata-validation-rules=\"";
            // line 97
            echo twig_escape_filter($this->env, twig_jsonencode_filter($this->getAttribute(($context["field"] ?? null), "validation-rules", array(), "array")), "html", null, true);
            echo "\"
\t\tvalue=\"";
            // line 98
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "data", array()), "html", null, true);
            echo "\" 
\t>
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

    // line 102
    public function getdate($__field__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $__field__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 103
            echo "\t<input
\t\ttype=\"text\"
\t\tname=\"membership[";
            // line 105
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "name", array()), "html", null, true);
            echo "]\"
\t\tdata-validation-rules=\"";
            // line 106
            echo twig_escape_filter($this->env, twig_jsonencode_filter($this->getAttribute(($context["field"] ?? null), "validation-rules", array(), "array")), "html", null, true);
            echo "\"
\t\tvalue=\"";
            // line 107
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "data", array()), "html", null, true);
            echo "\" 
\t>
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

    // line 111
    public function getradio($__field__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $__field__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 112
            echo "\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["field"] ?? null), "options", array()));
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
            foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                // line 113
                echo "\t\t<input
\t\t\ttype=\"radio\"
\t\t\tname=\"membership[";
                // line 115
                echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "name", array()), "html", null, true);
                echo "][]\"
\t\t\tid=\"membership[";
                // line 116
                echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "name", array()), "html", null, true);
                echo "]-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                echo "\"
\t\t\tvalue=\"";
                // line 117
                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "id", array()), "html", null, true);
                echo "\"
\t\t\tdata-validation-rules=\"";
                // line 118
                echo twig_escape_filter($this->env, twig_jsonencode_filter($this->getAttribute(($context["field"] ?? null), "validation-rules", array(), "array")), "html", null, true);
                echo "\"
\t\t\t";
                // line 119
                if (twig_in_filter($this->getAttribute($context["option"], "id", array()), $this->getAttribute(($context["field"] ?? null), "data", array()))) {
                    // line 120
                    echo "\t\t\t\tchecked=\"true\"
\t\t\t";
                }
                // line 122
                echo "\t\t>
\t\t<label for=\"membership[";
                // line 123
                echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "name", array()), "html", null, true);
                echo "]-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "name", array()), "html", null, true);
                echo "</label>
\t";
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
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

    // line 127
    public function getcheckbox($__field__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $__field__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 128
            echo "\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["field"] ?? null), "options", array()));
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
            foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                // line 129
                echo "\t\t<input
\t\t\ttype=\"checkbox\"
\t\t\tname=\"membership[";
                // line 131
                echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "name", array()), "html", null, true);
                echo "][]\"
\t\t\tid=\"membership[";
                // line 132
                echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "name", array()), "html", null, true);
                echo "]-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                echo "\"
\t\t\tvalue=\"";
                // line 133
                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "id", array()), "html", null, true);
                echo "\"
\t\t\tdata-validation-rules=\"";
                // line 134
                echo twig_escape_filter($this->env, twig_jsonencode_filter($this->getAttribute(($context["field"] ?? null), "validation-rules", array(), "array")), "html", null, true);
                echo "\"
\t\t\t";
                // line 135
                if (twig_in_filter($this->getAttribute($context["option"], "id", array()), $this->getAttribute(($context["field"] ?? null), "data", array()))) {
                    // line 136
                    echo "\t\t\t\tchecked=\"true\"
\t\t\t";
                }
                // line 138
                echo "\t\t>
\t\t<label for=\"membership[";
                // line 139
                echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "name", array()), "html", null, true);
                echo "]-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "name", array()), "html", null, true);
                echo "</label>
\t";
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
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

    // line 143
    public function getdrop($__field__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $__field__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 144
            echo "\t<select name=\"membership[";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "name", array()), "html", null, true);
            echo "]\">
\t\t";
            // line 145
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["field"] ?? null), "options", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                // line 146
                echo "\t\t\t<option
\t\t\t\tvalue=\"";
                // line 147
                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "id", array()), "html", null, true);
                echo "\"
\t\t\t\tdata-validation-rules=\"";
                // line 148
                echo twig_escape_filter($this->env, twig_jsonencode_filter($this->getAttribute(($context["field"] ?? null), "validation-rules", array(), "array")), "html", null, true);
                echo "\"
\t\t\t\t";
                // line 149
                if (twig_in_filter($this->getAttribute($context["option"], "id", array()), $this->getAttribute(($context["field"] ?? null), "data", array()))) {
                    // line 150
                    echo "\t\t\t\t\tselected=\"true\"
\t\t\t\t";
                }
                // line 152
                echo "\t\t\t>";
                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "name", array()), "html", null, true);
                echo "</option>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 154
            echo "\t</select>
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

    // line 157
    public function getscroll($__field__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $__field__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 158
            echo "\t<select name=\"membership[";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "name", array()), "html", null, true);
            echo "][]\" multiple=\"true\" style=\"width: 140px\">
\t\t";
            // line 159
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["field"] ?? null), "options", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                // line 160
                echo "\t\t\t<option
\t\t\t\tvalue=\"";
                // line 161
                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "id", array()), "html", null, true);
                echo "\"
\t\t\t\tdata-validation-rules=\"";
                // line 162
                echo twig_escape_filter($this->env, twig_jsonencode_filter($this->getAttribute(($context["field"] ?? null), "validation-rules", array(), "array")), "html", null, true);
                echo "\"
\t\t\t\t";
                // line 163
                if (twig_in_filter($this->getAttribute($context["option"], "id", array()), $this->getAttribute(($context["field"] ?? null), "data", array()))) {
                    // line 164
                    echo "\t\t\t\t\tselected=\"true\"
\t\t\t\t";
                }
                // line 166
                echo "\t\t\t>";
                echo twig_escape_filter($this->env, $this->getAttribute($context["option"], "name", array()), "html", null, true);
                echo "</option>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 168
            echo "\t</select>
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
        return "@users/macros/admin-fields.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  849 => 168,  840 => 166,  836 => 164,  834 => 163,  830 => 162,  826 => 161,  823 => 160,  819 => 159,  814 => 158,  802 => 157,  786 => 154,  777 => 152,  773 => 150,  771 => 149,  767 => 148,  763 => 147,  760 => 146,  756 => 145,  751 => 144,  739 => 143,  706 => 139,  703 => 138,  699 => 136,  697 => 135,  693 => 134,  689 => 133,  683 => 132,  679 => 131,  675 => 129,  657 => 128,  645 => 127,  612 => 123,  609 => 122,  605 => 120,  603 => 119,  599 => 118,  595 => 117,  589 => 116,  585 => 115,  581 => 113,  563 => 112,  551 => 111,  533 => 107,  529 => 106,  525 => 105,  521 => 103,  509 => 102,  491 => 98,  487 => 97,  483 => 96,  479 => 94,  467 => 93,  449 => 89,  445 => 88,  441 => 87,  437 => 85,  425 => 84,  407 => 80,  403 => 79,  399 => 78,  395 => 76,  383 => 75,  365 => 71,  361 => 70,  357 => 69,  353 => 67,  341 => 66,  323 => 63,  311 => 62,  293 => 57,  287 => 55,  285 => 54,  281 => 53,  268 => 50,  263 => 47,  250 => 46,  233 => 42,  230 => 41,  224 => 39,  218 => 38,  215 => 37,  212 => 36,  209 => 35,  204 => 34,  201 => 33,  198 => 32,  195 => 31,  189 => 29,  183 => 27,  177 => 26,  174 => 25,  171 => 24,  168 => 23,  163 => 22,  160 => 21,  157 => 20,  155 => 19,  150 => 17,  147 => 16,  134 => 15,  115 => 11,  112 => 10,  109 => 9,  97 => 8,  78 => 4,  75 => 3,  72 => 2,  60 => 1,  55 => 156,  52 => 142,  49 => 126,  46 => 110,  43 => 101,  40 => 92,  37 => 83,  34 => 74,  31 => 65,  28 => 61,  25 => 45,  22 => 14,  19 => 7,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@users/macros/admin-fields.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Users\\views\\macros\\admin-fields.twig");
    }
}
