<?php

/* @contactform/partials/backend.main.page.contact.form.twig */
class __TwigTemplate_cf282bc5019e5cfd2db9e1318fe817bcffd3363c6c599f3f1d998329784ca89a extends Twig_Template
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
        echo "<div class=\"mp-option mp-page-option mp-page-contact-form\" data-page-slug=\"contact_form\">
\t";
        // line 2
        if (($context["contactFormPresets"] ?? null)) {
            // line 3
            echo "\t<div class=\"row\">
\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t<div class=\"mp-option-label\">
\t\t\t\t<span title=\"";
            // line 6
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Contact Us")), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Contact Us")), "html", null, true);
            echo "</span>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-md-8\">
\t\t\t<div class=\"mp-option-input-with-button\">
\t\t\t\t<div class=\"mp-option-button mp-opt-contact-form-btn\" ";
            // line 11
            if ($this->getAttribute(($context["pagesInfo"] ?? null), "contact_form", array())) {
                echo "style=\"display: none\"";
            }
            echo ">
\t\t\t\t\t<button class=\"sc-button icon-button create-page-button primary\" data-page-slug=\"contact_form\" id=\"contactFormCreatePageBtn\">
\t\t\t\t\t\t<i class=\"fa fa-plus\"></i>
\t\t\t\t\t\t<span>";
            // line 14
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Create page")), "html", null, true);
            echo "</span>
\t\t\t\t\t</button>
\t\t\t\t</div>
\t\t\t\t<div class=\"mp-option-select\">
\t\t\t\t\t";
            // line 18
            echo $this->env->getExtension('Membership_Base_Twig')->callFunction("wp_dropdown_pages", array("name" => "pages[contact_form]", "selected" => $this->getAttribute(($context["pagesInfo"] ?? null), "contact_form", array()), "class" => "sc-input wp-pages-list", "echo" => false, "show_option_none" => "Select Page", "option_none_value" => "__none"));
            echo "
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
\t";
            // line 24
            echo "\t<div class=\"row\" id=\"contact-form-preset-row\">
\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t<div class=\"mp-option-label\" style=\"text-align: right; width: 300px; margin-top: 10px;\">
\t\t\t\t<div class=\"mpp-tooltip tooltip\">
\t\t\t\t\t<i class=\"fa fa-question sc-tooltip\"></i>
\t\t\t\t\t<div class=\"tooltip_content\">
\t\t\t\t\t\t<div>";
            // line 30
            echo call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Select contact form that will be displayed on Contact Us page."));
            echo "</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-md-8\">
\t\t\t<div class=\"mp-option-input-with-button\" style=\"padding-top: 5px;\">
\t\t\t\t<div class=\"mp-option-select\">
\t\t\t\t\t<select id=\"contactFormPresetSel\" style=\"width: 165px;\" name=\"pages[contact_form_preset]\">
\t\t\t\t\t\t<option value=\"\">";
            // line 39
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Select value")), "html", null, true);
            echo "</option>
\t\t\t\t\t\t";
            // line 40
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["contactFormPresets"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["val1"]) {
                // line 41
                echo "\t\t\t\t\t\t\t<option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["val1"], "id", array()), "html", null, true);
                echo "\" ";
                if (($this->getAttribute(($context["pagesInfo"] ?? null), "contact_form_preset", array()) == $this->getAttribute($context["val1"], "id", array()))) {
                    echo "selected=\"selected\"";
                }
                echo ">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["val1"], "label", array()), "html", null, true);
                echo "</option>
\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['val1'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 43
            echo "\t\t\t\t\t</select>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
\t";
        } elseif ((        // line 48
($context["isPluginActive"] ?? null) == true)) {
            // line 49
            echo "\t<div class=\"row\">
\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t<div class=\"mp-option-label\">
\t\t\t\t<span title=\"";
            // line 52
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Contact Us")), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Contact Us")), "html", null, true);
            echo "</span>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-md-8\">
\t\t\t<div style=\"margin: 7px 0;\">
\t\t\t\t";
            // line 57
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("You have no Contact Form for now. Create your Contact Form or Enable Membership feature for contact form which you want to use for Contact Us page.")), "html", null, true);
            echo "
\t\t\t</div>
\t\t</div>
\t</div>
\t";
        } else {
            // line 62
            echo "\t<div class=\"row\">
\t\t<div class=\"col-md-4 mbsThinCol\">
\t\t\t<div class=\"mp-option-label\">
\t\t\t\t<span title=\"";
            // line 65
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Contact Us")), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Contact Us")), "html", null, true);
            echo "</span>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-md-8\">
\t\t\t<div style=\"margin: 7px 0;\">
\t\t\t\t";
            // line 70
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("You need to install Contact Form by Supsystic to use this feature. ")), "html", null, true);
            echo "
\t\t\t\t<a target=\"_blank\" href=\"";
            // line 71
            echo twig_escape_filter($this->env, ($context["pluginInstallUrl"] ?? null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Install")), "html", null, true);
            echo "</a>
\t\t\t\t";
            // line 72
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array(" plugin from your admin area, or visit it's official page on Wordpress.org ")), "html", null, true);
            echo "
\t\t\t\t<a target=\"_blank\" href=\"";
            // line 73
            echo twig_escape_filter($this->env, ($context["wpPluginInstallUrl"] ?? null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("here")), "html", null, true);
            echo "</a>
\t\t\t</div>
\t\t</div>
\t</div>
\t";
        }
        // line 78
        echo "</div>


";
    }

    public function getTemplateName()
    {
        return "@contactform/partials/backend.main.page.contact.form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  176 => 78,  166 => 73,  162 => 72,  156 => 71,  152 => 70,  142 => 65,  137 => 62,  129 => 57,  119 => 52,  114 => 49,  112 => 48,  105 => 43,  90 => 41,  86 => 40,  82 => 39,  70 => 30,  62 => 24,  54 => 18,  47 => 14,  39 => 11,  29 => 6,  24 => 3,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@contactform/partials/backend.main.page.contact.form.twig", "F:\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\ContactForm\\views\\partials\\backend.main.page.contact.form.twig");
    }
}
