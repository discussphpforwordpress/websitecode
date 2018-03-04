<?php

/* @base/macros/pagination.twig */
class __TwigTemplate_91e1f7cc1cbee33241bf0b8d5f63fff6e7ee38ddf0823630c0b551f9a6c9d19c extends Twig_Template
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
    }

    // line 1
    public function getcreate($__settings__ = null, $__queryParams__ = array(), ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "settings" => $__settings__,
            "queryParams" => $__queryParams__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 2
            echo "\t
\t";
            // line 3
            $context["page"] = (($this->getAttribute(($context["settings"] ?? null), "page", array())) ? (twig_number_format_filter($this->env, $this->getAttribute(($context["settings"] ?? null), "page", array()))) : (1));
            // line 4
            echo "\t";
            $context["totalPages"] = (($this->getAttribute(($context["settings"] ?? null), "totalPages", array())) ? (twig_number_format_filter($this->env, $this->getAttribute(($context["settings"] ?? null), "totalPages", array()))) : (1));
            // line 5
            echo "\t";
            $context["paginationElements"] = (($this->getAttribute(($context["settings"] ?? null), "paginationElements", array())) ? ($this->getAttribute(($context["settings"] ?? null), "paginationElements", array())) : (2));
            // line 6
            echo "\t";
            $context["hash"] = (($this->getAttribute(($context["settings"] ?? null), "hash", array())) ? (("#" . $this->getAttribute(($context["settings"] ?? null), "hash", array()))) : (""));
            // line 7
            echo "\t
\t";
            // line 8
            if ((($context["totalPages"] ?? null) != 1)) {
                // line 9
                echo "\t\t";
                $context["minRangePage"] = max((($context["page"] ?? null) - ($context["paginationElements"] ?? null)), 1);
                // line 10
                echo "\t\t";
                $context["maxRangePage"] = min((($context["page"] ?? null) + ($context["paginationElements"] ?? null)), ($context["totalPages"] ?? null));
                // line 11
                echo "\t\t";
                $context["minRangePage"] = min(($context["minRangePage"] ?? null), ($context["totalPages"] ?? null));
                // line 12
                echo "
\t\t<div class=\"sc-pagination\">
\t\t\t";
                // line 14
                if (((($context["page"] ?? null) > 1) && (($context["totalPages"] ?? null) > 1))) {
                    // line 15
                    echo "\t\t\t\t<a href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Base_Twig')->dashboardUrl($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "module", array()), $this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "action", array()), twig_array_merge(array("p" => 1), ($context["queryParams"] ?? null))), "html", null, true);
                    echo twig_escape_filter($this->env, ($context["hash"] ?? null), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("First")), "html", null, true);
                    echo "</a>
\t\t\t\t<a href=\"";
                    // line 16
                    echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Base_Twig')->dashboardUrl($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "module", array()), $this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "action", array()), twig_array_merge(array("p" => (($context["page"] ?? null) - 1)), ($context["queryParams"] ?? null))), "html", null, true);
                    echo twig_escape_filter($this->env, ($context["hash"] ?? null), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Previous")), "html", null, true);
                    echo "</a>
\t\t\t";
                }
                // line 18
                echo "\t\t\t";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(range(($context["minRangePage"] ?? null), ($context["maxRangePage"] ?? null)));
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
                foreach ($context['_seq'] as $context["_key"] => $context["rangePage"]) {
                    // line 19
                    echo "\t\t\t\t";
                    if ((((($context["page"] ?? null) == $context["rangePage"]) || ((($context["page"] ?? null) == ($context["minRangePage"] ?? null)) && $this->getAttribute($context["loop"], "first", array()))) || ((($context["page"] ?? null) == ($context["maxRangePage"] ?? null)) && $this->getAttribute($context["loop"], "last", array())))) {
                        // line 20
                        echo "\t\t\t\t\t<span class=\"current\"><b>";
                        echo twig_escape_filter($this->env, $context["rangePage"], "html", null, true);
                        echo "</b></span>
\t\t\t\t";
                    } else {
                        // line 22
                        echo "\t\t\t\t\t<a href=\"";
                        echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Base_Twig')->dashboardUrl($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "module", array()), $this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "action", array()), twig_array_merge(array("p" => $context["rangePage"]), ($context["queryParams"] ?? null))), "html", null, true);
                        echo twig_escape_filter($this->env, ($context["hash"] ?? null), "html", null, true);
                        echo "\" >";
                        echo twig_escape_filter($this->env, $context["rangePage"], "html", null, true);
                        echo "</a>
\t\t\t\t";
                    }
                    // line 24
                    echo "\t\t\t";
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
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rangePage'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 25
                echo "\t\t\t";
                if ((($context["page"] ?? null) < ($context["totalPages"] ?? null))) {
                    // line 26
                    echo "\t\t\t\t<a href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Base_Twig')->dashboardUrl($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "module", array()), $this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "action", array()), twig_array_merge(array("p" => (($context["page"] ?? null) + 1)), ($context["queryParams"] ?? null))), "html", null, true);
                    echo twig_escape_filter($this->env, ($context["hash"] ?? null), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Next")), "html", null, true);
                    echo "</a>
\t\t\t\t<a href=\"";
                    // line 27
                    echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Base_Twig')->dashboardUrl($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "module", array()), $this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "action", array()), twig_array_merge(array("p" => ($context["totalPages"] ?? null)), ($context["queryParams"] ?? null))), "html", null, true);
                    echo twig_escape_filter($this->env, ($context["hash"] ?? null), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Last")), "html", null, true);
                    echo "</a>
\t\t\t";
                }
                // line 29
                echo "\t\t</div>
\t";
            }
            // line 31
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
        return "@base/macros/pagination.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  157 => 31,  153 => 29,  145 => 27,  137 => 26,  134 => 25,  120 => 24,  111 => 22,  105 => 20,  102 => 19,  84 => 18,  76 => 16,  68 => 15,  66 => 14,  62 => 12,  59 => 11,  56 => 10,  53 => 9,  51 => 8,  48 => 7,  45 => 6,  42 => 5,  39 => 4,  37 => 3,  34 => 2,  21 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@base/macros/pagination.twig", "F:\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Base\\views\\macros\\pagination.twig");
    }
}
