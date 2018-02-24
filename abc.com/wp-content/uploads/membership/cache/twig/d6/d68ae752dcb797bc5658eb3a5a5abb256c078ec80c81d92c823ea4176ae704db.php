<?php

/* @activity/partials/activity-attachment-template.twig */
class __TwigTemplate_8fcf1649541143c4eb6b5ea6d7b9fe66be3c9920b9b6902b102f0893436552e9 extends Twig_Template
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
        echo "<script id=\"mbsImageAttachmentTemplate\" type=\"text/html\">
\t<div class=\"mbs-one-any-attachment\" title=\"\">
\t\t<img class=\"ui image mbs-att-image\" src=\"";
        // line 3
        echo twig_escape_filter($this->env, ($context["attachmentIcon"] ?? null), "html", null, true);
        echo "\">
\t\t<span class=\"mbs-image-caption\"></span>
\t\t<div class=\"mp-attachment-image-overlay\"></div>
\t\t<div class=\"mp-progress-bar\">
\t\t\t<div class=\"ui tiny indicating progress active\">
\t\t\t\t<div class=\"bar\" style=\"width: 1%; transition-duration: 300ms;\"></div>
\t\t\t</div>
\t\t</div>
\t\t<i class=\"close icon\"></i>
\t</div>
</script>";
    }

    public function getTemplateName()
    {
        return "@activity/partials/activity-attachment-template.twig";
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
        return new Twig_Source("", "@activity/partials/activity-attachment-template.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Activity\\views\\partials\\activity-attachment-template.twig");
    }
}
