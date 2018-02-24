<?php

/* @activity/partials/activities-container.twig */
class __TwigTemplate_e09bdb9ccac9f4372430f7e4e8b84048da36817f7a3b43ec90f48410eada95c4 extends Twig_Template
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
        echo "<div class=\"ui segment vertical basic mp-activity-container\" data-activity-context=\"";
        echo twig_escape_filter($this->env, ($context["context"] ?? null), "html", null, true);
        echo "\" data-single=\"";
        if (array_key_exists("singleView", $context)) {
            echo "1";
        } else {
            echo "0";
        }
        echo "\">

\t";
        // line 3
        if ((($context["userLoggedIn"] ?? null) &&  !($context["disablePostForm"] ?? null))) {
            // line 4
            echo "\t\t";
            $this->loadTemplate("@activity/partials/activity-post-form.twig", "@activity/partials/activities-container.twig", 4)->display($context);
            // line 5
            echo "\t";
        }
        // line 6
        echo "\t
\t<div class=\"mp-activity-list \">
\t\t";
        // line 8
        $this->loadTemplate("@activity/partials/activities.twig", "@activity/partials/activities-container.twig", 8)->display(array_merge($context, array("activities" => ($context["activities"] ?? null), "settings" => ($context["settings"] ?? null))));
        // line 9
        echo "\t</div>
\t
\t<div class=\"ui message no-activities\" ";
        // line 11
        if (($context["activities"] ?? null)) {
            echo "style=\"display: none\"";
        }
        echo ">";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("There's no any activity yet")), "html", null, true);
        echo "</div>

\t<div class=\"ui basic segment activity-loader\" style=\"display: none\">
\t\t<div class=\"ui active loader\"></div>
\t</div>
\t
\t";
        // line 17
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "activity.view.actachmentTemplate"), "method"), "html", null, true);
        echo "

</div>

";
        // line 21
        $this->loadTemplate("@activity/partials/activity-gallery-modal.twig", "@activity/partials/activities-container.twig", 21)->display($context);
        // line 22
        $this->loadTemplate("@activity/partials/activity-report-modal.twig", "@activity/partials/activities-container.twig", 22)->display($context);
        // line 23
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "activity.view.galleryModal"), "method"), "html", null, true);
        echo "
";
        // line 24
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "activity.view.sliderModal"), "method"), "html", null, true);
        echo "
";
        // line 25
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "activity.view.googleMapsModal"), "method"), "html", null, true);
    }

    public function getTemplateName()
    {
        return "@activity/partials/activities-container.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 25,  77 => 24,  73 => 23,  71 => 22,  69 => 21,  62 => 17,  49 => 11,  45 => 9,  43 => 8,  39 => 6,  36 => 5,  33 => 4,  31 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@activity/partials/activities-container.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Activity\\views\\partials\\activities-container.twig");
    }
}
