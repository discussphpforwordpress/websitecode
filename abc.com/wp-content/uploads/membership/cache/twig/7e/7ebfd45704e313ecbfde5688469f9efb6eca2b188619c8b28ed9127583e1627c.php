<?php

/* @socialshare/backend/mainContentSettings.twig */
class __TwigTemplate_c5740f4504aa94a0a9a0d523c0708ca8729aed0f30d60997ef77cdcc14d8046f extends Twig_Template
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
        $context["options"] = $this->loadTemplate("@base/macros/options.twig", "@socialshare/backend/mainContentSettings.twig", 1);
        // line 2
        echo "
";
        // line 3
        $context["pluginsSs"] = $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "base", array()), "plugins", array()), "socialShare", array());
        // line 4
        ob_start();
        // line 5
        echo "\t";
        if (($this->getAttribute(($context["socialShareInfo"] ?? null), "isPuliginActive", array()) != true)) {
            echo " disabled=\"disabled\" ";
        }
        // line 6
        echo "\t";
        if ((($this->getAttribute(($context["socialShareInfo"] ?? null), "isPuliginActive", array()) == true) && ($this->getAttribute(($context["pluginsSs"] ?? null), "enabled", array()) == 1))) {
            echo " checked=\"checked\" ";
        }
        $context["inputSocialShareAttr"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 8
        echo "
";
        // line 9
        if (twig_length_filter($this->env, twig_trim_filter(($context["inputSocialShareAttr"] ?? null)))) {
            // line 10
            echo "\t";
            $context["socialShareRowAttributes"] = array("input" => twig_trim_filter(            // line 11
($context["inputSocialShareAttr"] ?? null)));
        }
        // line 14
        echo "
";
        // line 15
        echo $context["options"]->getenablePluginRow("Social Share", "plugins[socialShare]", "social-share-enable",         // line 19
($context["socialShareRowAttributes"] ?? null), "Settings");
        // line 21
        echo "

";
        // line 23
        if (($this->getAttribute(($context["socialShareInfo"] ?? null), "isPuliginActive", array()) == true)) {
            // line 24
            echo "\t<div id=\"toogle-social-share-enable\" style=\"display: none;\">
\t\t<div class=\"row\">
\t\t\t<div class=\"col-md-12\">
\t\t\t\t";
            // line 27
            if (twig_length_filter($this->env, $this->getAttribute(($context["socialShareInfo"] ?? null), "projectList", array()))) {
                // line 28
                echo "\t\t\t\t\t<table class=\"sc-table mbs-plugins-preset-list\">
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<th class=\"mbs-gg-header\"></th>
\t\t\t\t\t\t\t<th>";
                // line 31
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("SocialShare Name")), "html", null, true);
                echo "</th>
\t\t\t\t\t\t</tr>
\t\t\t\t\t\t";
                // line 33
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["socialShareInfo"] ?? null), "projectList", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["val1"]) {
                    // line 34
                    echo "\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t<label class=\"sc-radio\">
\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"mbs-can-setting-checked mbs-type-social-share\" id=\"mbs-socialShare-";
                    // line 37
                    echo twig_escape_filter($this->env, $this->getAttribute($context["val1"], "id", array()), "html", null, true);
                    echo "\" name=\"plugins[socialShare][ids][]\" value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["val1"], "id", array()), "html", null, true);
                    echo "\" ";
                    if (twig_in_filter($this->getAttribute($context["val1"], "id", array()), $this->getAttribute(($context["pluginsSs"] ?? null), "ids", array()))) {
                        echo " checked=\"checked\" ";
                    }
                    echo ">
\t\t\t\t\t\t\t\t\t\t<div class=\"sc-radio-state\"></div>
\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t<td> <label for=\"mbs-socialShare-";
                    // line 41
                    echo twig_escape_filter($this->env, $this->getAttribute($context["val1"], "id", array()), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["val1"], "title", array()), "html", null, true);
                    echo "</label></td>
\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['val1'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 44
                echo "\t\t\t\t\t</table>
\t\t\t\t";
            } else {
                // line 46
                echo "\t\t\t\t\t<div class=\"mbs-plug-msg-info\">";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("You have no SocialShare projects for now. Create new SocialShare project or Enable Membership feature for SocialShare which you want to use as project!.")), "html", null, true);
                echo "</div>
\t\t\t\t";
            }
            // line 48
            echo "\t\t\t</div>
\t\t</div>

\t</div>
";
        } else {
            // line 53
            echo "\t<div class=\"mbs-plug-not-install\">
\t\t";
            // line 54
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("You need to install Social Share Buttons by Supsystic to use this feature. ")), "html", null, true);
            echo "
\t\t<a target=\"_blank\" href=\"";
            // line 55
            echo twig_escape_filter($this->env, $this->getAttribute(($context["socialShareInfo"] ?? null), "installUrl", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Install")), "html", null, true);
            echo "</a>
\t\t";
            // line 56
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array(" plugin from your admin area, or visit it's official page on Wordpress.org ")), "html", null, true);
            echo "
\t\t<a target=\"_blank\" href=\"";
            // line 57
            echo twig_escape_filter($this->env, $this->getAttribute(($context["socialShareInfo"] ?? null), "installWpUrl", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("here")), "html", null, true);
            echo "</a>
\t</div>
";
        }
    }

    public function getTemplateName()
    {
        return "@socialshare/backend/mainContentSettings.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  145 => 57,  141 => 56,  135 => 55,  131 => 54,  128 => 53,  121 => 48,  115 => 46,  111 => 44,  100 => 41,  87 => 37,  82 => 34,  78 => 33,  73 => 31,  68 => 28,  66 => 27,  61 => 24,  59 => 23,  55 => 21,  53 => 19,  52 => 15,  49 => 14,  46 => 11,  44 => 10,  42 => 9,  39 => 8,  33 => 6,  28 => 5,  26 => 4,  24 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@socialshare/backend/mainContentSettings.twig", "F:\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Socialshare\\views\\backend\\mainContentSettings.twig");
    }
}
