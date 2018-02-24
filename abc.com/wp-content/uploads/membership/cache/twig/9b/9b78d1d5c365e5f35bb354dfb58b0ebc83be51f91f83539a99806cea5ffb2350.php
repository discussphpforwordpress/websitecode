<?php

/* @membership/menus/visibility-nav-menu-item-field.twig */
class __TwigTemplate_070e0334e78892c64d1a1d906e659d6e803f640270df683413a2678aed019be1 extends Twig_Template
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
        echo "<div class=\"description description-wide ";
        echo twig_escape_filter($this->env, ($context["class"] ?? null), "html", null, true);
        echo "\" style=\"padding: 20px 0;\">
\t<div class=\"mbs-nav-menu-edit-item-param\">
\t\t<div class=\"mbs-nmei-header1\" style=\"background-color: #3ab3b5; color: #fff; padding: 10px; border-radius: 3px; font-size: 1.2em; font-weight: bold;\">
\t\t\t";
        // line 4
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Membership Menu Settings")), "html", null, true);
        echo "
\t\t</div>
\t\t<div class=\"mbs-mnei-label\" style=\"padding: 5px 0; font-style: italic; font-weight: bold;\">
\t\t\t";
        // line 7
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Who can see this menu link?")), "html", null, true);
        echo "
\t\t</div>
\t\t<div class=\"mbs-mnei-input-list\">
\t\t\t<label for=\"";
        // line 10
        echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo "-0\">
\t\t\t\t<input id=\"";
        // line 11
        echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo "-0\" type=\"radio\" name=\"";
        echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
        echo "\" value=\"0\" ";
        if ((($context["value"] ?? null) == null)) {
            echo "checked=\"checked\"";
        }
        echo "/>
\t\t\t\t";
        // line 12
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Everyone")), "html", null, true);
        echo "
\t\t\t</label>
\t\t\t<label for=\"";
        // line 14
        echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo "-1\">
\t\t\t\t<input id=\"";
        // line 15
        echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo "-1\" type=\"radio\" name=\"";
        echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
        echo "\" value=\"1\" ";
        if ((($context["value"] ?? null) == 1)) {
            echo "checked=\"checked\"";
        }
        echo "/>
\t\t\t\t";
        // line 16
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Logged In Users")), "html", null, true);
        echo "
\t\t\t</label>
\t\t\t<label for=\"";
        // line 18
        echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo "-2\">
\t\t\t\t<input id=\"";
        // line 19
        echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo "-2\" type=\"radio\" name=\"";
        echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
        echo "\" value=\"2\" ";
        if ((($context["value"] ?? null) == 2)) {
            echo "checked=\"checked\"";
        }
        echo "/>
\t\t\t\t";
        // line 20
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Logged Out Users")), "html", null, true);
        echo "
\t\t\t</label>
\t\t</div>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "@membership/menus/visibility-nav-menu-item-field.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  90 => 20,  80 => 19,  76 => 18,  71 => 16,  61 => 15,  57 => 14,  52 => 12,  42 => 11,  38 => 10,  32 => 7,  26 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@membership/menus/visibility-nav-menu-item-field.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Membership\\views\\menus\\visibility-nav-menu-item-field.twig");
    }
}
