<?php

/* 404.twig */
class __TwigTemplate_22cda23597746551a0d18dd59033a06b1e506ceefc0edfb91dc438ab82cdac24 extends Twig_Template
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
        echo "<div class=\"wrap\">
\t<h1>The page you requested is not found</h1>
\t<div>Method <strong>";
        // line 3
        echo twig_escape_filter($this->env, ($context["action"] ?? null), "html", null, true);
        echo "</strong> does not exists in controller <strong>";
        echo twig_escape_filter($this->env, ($context["controller"] ?? null), "html", null, true);
        echo "</strong></div>
</div>";
    }

    public function getTemplateName()
    {
        return "404.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "404.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\app\\templates\\404.twig");
    }
}
