<?php

/* @base/partials/search-dropdown-user.twig */
class __TwigTemplate_9aeb36c48bbcbe20054c6379fe8424da4afb6ab5f1a10d2bdf46bb435345467f extends Twig_Template
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
        ob_start();
        // line 2
        echo "\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["users"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 3
            echo "\t\t<div class=\"item\" data-value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "id", array()), "html", null, true);
            echo "\">
\t\t\t<img class=\"ui avatar image\" src=\"";
            // line 4
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->userAvatar($context["user"], "small"), "html", null, true);
            echo "\">
\t\t\t<div class=\"content\">
\t\t\t\t<a class=\"header\">";
            // line 6
            echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "displayName", array()), "html", null, true);
            echo "</a>
\t\t\t</div>
\t\t\t<a data-tag class=\"ui image small label mp-user-label\" style=\"display: none\" data-value=\"";
            // line 8
            echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "id", array()), "html", null, true);
            echo "\">
\t\t\t\t<img src=\"";
            // line 9
            echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->userAvatar($context["user"], "small"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "displayName", array()), "html", null, true);
            echo "
\t\t\t\t<i class=\"delete icon\"></i>
\t\t\t</a>
\t\t</div>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "@base/partials/search-dropdown-user.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  45 => 9,  41 => 8,  36 => 6,  31 => 4,  26 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@base/partials/search-dropdown-user.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Base\\views\\partials\\search-dropdown-user.twig");
    }
}
