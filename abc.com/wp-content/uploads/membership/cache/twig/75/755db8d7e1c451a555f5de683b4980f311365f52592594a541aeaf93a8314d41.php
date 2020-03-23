<?php

/* @users/backend/admin-fields-edit.twig */
class __TwigTemplate_9d940590ec4e36dc86edf2417fc710ef898676757b8c54e607c7b351411fff93 extends Twig_Template
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
        $context["fieldsTemplates"] = $this->loadTemplate("@users/macros/admin-fields.twig", "@users/backend/admin-fields-edit.twig", 1);
        // line 2
        echo "
";
        // line 3
        if (($context["fields"] ?? null)) {
            // line 4
            echo "\t<h1>";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Membership profile")), "html", null, true);
            echo "</h1>
";
        }
        // line 6
        echo "
";
        // line 7
        $context["sections"] = array();
        // line 8
        echo "<table class=\"form-table\">
\t<tbody>
\t\t";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["fields"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
            // line 11
            echo "\t\t\t";
            if ($this->getAttribute($context["field"], "enabled", array())) {
                // line 12
                echo "\t\t\t\t";
                if (!twig_in_filter($this->getAttribute($context["field"], "section", array()), ($context["sections"] ?? null))) {
                    // line 13
                    echo "\t\t\t\t\t<h2>";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["field"], "section", array()), "html", null, true);
                    echo "</h2>
\t\t\t\t\t";
                    // line 14
                    $context["sections"] = twig_array_merge(($context["sections"] ?? null), array(0 => $this->getAttribute($context["field"], "section", array())));
                    // line 15
                    echo "\t\t\t\t";
                }
                // line 16
                echo "\t\t\t\t";
                echo $context["fieldsTemplates"]->getcreateField($context["field"]);
                echo "
\t\t\t";
            }
            // line 18
            echo "\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        echo "\t</tbody>
</table>";
    }

    public function getTemplateName()
    {
        return "@users/backend/admin-fields-edit.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 19,  67 => 18,  61 => 16,  58 => 15,  56 => 14,  51 => 13,  48 => 12,  45 => 11,  41 => 10,  37 => 8,  35 => 7,  32 => 6,  26 => 4,  24 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@users/backend/admin-fields-edit.twig", "F:\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Users\\views\\backend\\admin-fields-edit.twig");
    }
}
