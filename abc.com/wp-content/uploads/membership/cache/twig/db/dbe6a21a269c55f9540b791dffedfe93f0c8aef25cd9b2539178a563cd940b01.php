<?php

/* @users/partials/comments.twig */
class __TwigTemplate_9b30b7c7712caa3a4766eca3f980e06116c615d8baab465cbcaabd71e903a384 extends Twig_Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["comments"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["comment"]) {
            // line 2
            echo "\t<div class=\"item mp-comment\" data-comment-id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["comment"], "id", array()), "html", null, true);
            echo "\">
\t\t<div class=\"content\">
\t\t\t<a class=\"header\" href=\"";
            // line 4
            echo twig_escape_filter($this->env, $this->getAttribute($context["comment"], "post_link", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["comment"], "title", array()), "html", null, true);
            echo "</a>
\t\t\t<div class=\"meta\">
\t\t\t\t<small class=\"date\">";
            // line 6
            echo twig_escape_filter($this->env, $this->getAttribute($context["comment"], "date", array()), "html", null, true);
            echo "</small>
\t\t\t</div>
\t\t\t<div class=\"description\">
\t\t\t\t<p>";
            // line 9
            echo twig_escape_filter($this->env, $this->getAttribute($context["comment"], "content", array()), "html", null, true);
            echo "</p>
\t\t\t</div>
\t\t</div>
\t</div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['comment'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "@users/partials/comments.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 9,  36 => 6,  29 => 4,  23 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@users/partials/comments.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Users\\views\\partials\\comments.twig");
    }
}
