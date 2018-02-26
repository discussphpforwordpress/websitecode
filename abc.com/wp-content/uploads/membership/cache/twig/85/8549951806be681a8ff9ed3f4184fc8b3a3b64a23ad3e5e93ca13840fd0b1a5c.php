<?php

/* @users/comments.twig */
class __TwigTemplate_ec39959547ed2352df02031bd0ab2d7c55c0efe8380f142f0161a24cc636d49b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@users/profile.twig", "@users/comments.twig", 1);
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
        echo "\t<div id=\"mp-comments\" class=\"ui basic vertical segment\">
\t\t";
        // line 5
        if (($context["comments"] ?? null)) {
            // line 6
            echo "\t\t\t<div class=\"ui divided items\">
\t\t\t\t";
            // line 7
            $this->loadTemplate("@users/partials/comments.twig", "@users/comments.twig", 7)->display(array_merge($context, array("comments" => ($context["comments"] ?? null))));
            // line 8
            echo "\t\t\t</div>
\t\t\t<div class=\"ui basic vertical segment comments-loader\" style=\"display: none\">
\t\t\t\t<div class=\"ui active centered inline loader\"></div>
\t\t\t</div>
\t\t";
        } else {
            // line 13
            echo "\t\t\t<div class=\"ui message\">
\t\t\t\t<p>";
            // line 14
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("No comments to show.")), "html", null, true);
            echo "</p>
\t\t\t</div>
\t\t";
        }
        // line 17
        echo "\t</div>
";
    }

    public function getTemplateName()
    {
        return "@users/comments.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  57 => 17,  51 => 14,  48 => 13,  41 => 8,  39 => 7,  36 => 6,  34 => 5,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@users/comments.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Users\\views\\comments.twig");
    }
}
