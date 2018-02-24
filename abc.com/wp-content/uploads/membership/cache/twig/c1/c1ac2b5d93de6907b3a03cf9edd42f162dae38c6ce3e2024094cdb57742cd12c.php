<?php

/* @promo/promo.twig */
class __TwigTemplate_090a5c8035b4241e4af77892389ddd862b436d2609105f6ccc2b3f77c1de7e37 extends Twig_Template
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
        echo "
<div class=\"supsystic-item supsystic-panel supsystic-plugin supsystic-plugin-promo\">
    <div class=\"container-fluid\" style=\"background: white; margin: 1.4em; padding: 1em 3em 3em; font-size: 1.3em\">
        <div class=\"row\">
            <div class=\"col-sm-12\">
                <h2 class=\"header\">";
        // line 6
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Welcome to the")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, ($context["plugin_name"] ?? null), "html", null, true);
        echo " v ";
        echo twig_escape_filter($this->env, ($context["plugin_version"] ?? null), "html", null, true);
        echo "</h2>
                <p>";
        // line 7
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Thank you for choosing our plugin! We are happy you like Membership plugin by Supsystic and You will get our best work!")), "html", null, true);
        echo "</p>
                <p>";
        // line 8
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("We are constantly making improvements of the Membership tool usage for your maximum comfort and easiness. And now it is the most appropriate moment to tell you about some options and features of Membership plugin.")), "html", null, true);
        echo "
                </p>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col-sm-12\">
                <div class=\"row\">
                    <div class=\"col-sm-6\">
                        <h3>";
        // line 16
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("A small guide for the first-time user")), "html", null, true);
        echo "</h3>
                         <p>";
        // line 17
        echo sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Indeed, Membership is a very easy-to-use plugin and it consists of various exciting options at the same time. So after you close this page we will demonstrate you the main of them with step-by-step tutorial. For the first time we will help you to tune your Membership, but if you will need our help, please, contact us via our %s.")), (("<a href=\"https://supsystic.com/contact-us/\">" . call_user_func_array($this->env->getFunction('translate')->getCallable(), array("internal support"))) . "</a>"));
        echo "
\t\t\t\t\t\t</p>
\t                    <h3>";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute(($context["environment"] ?? null), "translate", array(0 => "Video Tutorial"), "method"), "html", null, true);
        echo "</h3>
\t                    <div class=\"embed-responsive embed-responsive-16by9\">
\t\t                    <iframe class=\"embed-responsive-item\" allowfullscreen
\t\t                            src=\"https://www.youtube.com/embed/q4zFNEPsv1o\">
\t\t                    </iframe>
\t                    </div>
                    </div>
                    <div class=\"col-sm-6\">
                        <h3>";
        // line 27
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Support part")), "html", null, true);
        echo "</h3>
                        <p>";
        // line 28
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("We love the plugins that we created and feel responsibility for every our product. Constantly we are trying to improve something or update the new features, but sometimes you may have a situation when you need help or have an issue. We can propose you next kinds of help:")), "html", null, true);
        echo " </p>
                        <ul>
                            <li>";
        // line 30
        echo sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Contact us through %s if you have some question, offer or wish.")), (("<a href=\"//supsystic.com/forum/membership-plugin/\" target=\"_blank\">" . call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Supsystic Forum"))) . "</a>"));
        echo " </li>
                            <li>";
        // line 31
        echo sprintf(call_user_func_array($this->env->getFunction('translate')->getCallable(), array("If, unfortunately, you have some problem - we are always ready to help you in our %s.")), (("<a href=\"https://supsystic.com/contact-us/\">" . call_user_func_array($this->env->getFunction('translate')->getCallable(), array("internal support"))) . "</a>"));
        echo " </li>
                        </ul>
                        <p>";
        // line 33
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Feel free to contact us and don't worry, everything will be cool!")), "html", null, true);
        echo "</p>
\t                    <a href=\"";
        // line 34
        echo twig_escape_filter($this->env, ($context["start_url"] ?? null), "html", null, true);
        echo "\" style=\"font-size: 20px\" class=\"button button-primary button-hero lets-start-button\">
\t\t                    ";
        // line 35
        echo twig_escape_filter($this->env, $this->getAttribute(($context["environment"] ?? null), "translate", array(0 => "Let's Start!"), "method"), "html", null, true);
        echo "
\t                    </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "@promo/promo.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  95 => 35,  91 => 34,  87 => 33,  82 => 31,  78 => 30,  73 => 28,  69 => 27,  58 => 19,  53 => 17,  49 => 16,  38 => 8,  34 => 7,  26 => 6,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@promo/promo.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Promo\\views\\promo.twig");
    }
}
