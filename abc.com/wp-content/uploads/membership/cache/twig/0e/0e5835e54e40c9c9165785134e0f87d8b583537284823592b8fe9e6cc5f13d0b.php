<?php

/* @googlemapseasy/partials/backend.main.content.setting.twig */
class __TwigTemplate_71d5c262b14571bc63f457848861610af3a7eae38ec4c681e1e118669c925727 extends Twig_Template
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
        $context["options"] = $this->loadTemplate("@base/macros/options.twig", "@googlemapseasy/partials/backend.main.content.setting.twig", 1);
        // line 3
        $context["pluginS"] = $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "base", array()), "plugins", array()), "googleMapsEasy", array());
        // line 4
        ob_start();
        // line 5
        echo "\t";
        if (($this->getAttribute(($context["googleMapsInfo"] ?? null), "isPuliginActive", array()) != "true")) {
            echo " disabled=\"disabled\" ";
        }
        // line 6
        echo "\t";
        if ((($this->getAttribute(($context["googleMapsInfo"] ?? null), "isPuliginActive", array()) == "true") && ($this->getAttribute(($context["pluginS"] ?? null), "enabled", array()) == 1))) {
            echo " checked=\"checked\" ";
        }
        $context["inputGoogleMapsAttr"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 8
        echo "
";
        // line 9
        if (twig_length_filter($this->env, twig_trim_filter(($context["inputGoogleMapsAttr"] ?? null)))) {
            // line 10
            echo "\t";
            $context["googleMapsRowAttributes"] = array("input" => twig_trim_filter(            // line 11
($context["inputGoogleMapsAttr"] ?? null)));
        }
        // line 14
        echo "
";
        // line 15
        echo $context["options"]->getenablePluginRow("Google Maps", "plugins[googleMapsEasy]", "GoogleMaps-enable",         // line 19
($context["googleMapsRowAttributes"] ?? null), "Settings");
        // line 21
        echo "

";
        // line 23
        if (($this->getAttribute(($context["googleMapsInfo"] ?? null), "isPuliginActive", array()) == "true")) {
            // line 24
            echo "\t<div id=\"toogle-GoogleMaps-enable\" style=\"display: none;\">
\t\t<div class=\"row\">
\t\t\t<div class=\"col-md-12\">
\t\t\t\t";
            // line 27
            if (twig_length_filter($this->env, $this->getAttribute(($context["googleMapsInfo"] ?? null), "presets", array()))) {
                // line 28
                echo "\t\t\t\t\t<table class=\"sc-table mbs-plugins-preset-list\">
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<th class=\"mbs-gg-header\">
\t\t\t\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" class=\"mbs-setting-select-all\" data-type=\"GoogleMaps\">
\t\t\t\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t</th>
\t\t\t\t\t\t\t<th>";
                // line 36
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("GoogleMaps Name")), "html", null, true);
                echo "</th>
\t\t\t\t\t\t</tr>
\t\t\t\t\t\t";
                // line 38
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["googleMapsInfo"] ?? null), "presets", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["val1"]) {
                    // line 39
                    echo "\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t<label class=\"sc-checkbox\">
\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" class=\"mbs-can-setting-checked mbs-type-GoogleMaps\" id=\"mbs-GoogleMaps-";
                    // line 42
                    echo twig_escape_filter($this->env, $this->getAttribute($context["val1"], "id", array()), "html", null, true);
                    echo "\" name=\"plugins[googleMapsEasy][ids][]\" value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["val1"], "id", array()), "html", null, true);
                    echo "\" ";
                    if (twig_in_filter($this->getAttribute($context["val1"], "id", array()), $this->getAttribute(($context["pluginS"] ?? null), "ids", array()))) {
                        echo " checked=\"checked\" ";
                    }
                    echo "/>
\t\t\t\t\t\t\t\t\t\t<div class=\"sc-checkbox-state\"></div>
\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t<td>";
                    // line 46
                    echo twig_escape_filter($this->env, $this->getAttribute($context["val1"], "title", array()), "html", null, true);
                    echo "</td>
\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['val1'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 49
                echo "\t\t\t\t\t</table>
\t\t\t\t";
            } else {
                // line 51
                echo "\t\t\t\t\t<div class=\"mbs-plug-msg-info\">";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("You have no Google Maps for now. Create your Google Maps  or Enable Membership feature for Google Maps which you want to use as presets.")), "html", null, true);
                echo "</div>
\t\t\t\t";
            }
            // line 53
            echo "\t\t\t</div>
\t\t</div>
\t</div>
";
        } else {
            // line 57
            echo "\t<div class=\"mbs-plug-not-install\">
\t\t";
            // line 58
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("You need to install Google Maps Easy to use this feature. ")), "html", null, true);
            echo "
\t\t<a target=\"_blank\" href=\"";
            // line 59
            echo twig_escape_filter($this->env, $this->getAttribute(($context["googleMapsInfo"] ?? null), "installUrl", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Install")), "html", null, true);
            echo "</a>
\t\t";
            // line 60
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array(" plugin from your admin area, or visit it's official page on Wordpress.org ")), "html", null, true);
            echo "
\t\t<a target=\"_blank\" href=\"";
            // line 61
            echo twig_escape_filter($this->env, $this->getAttribute(($context["googleMapsInfo"] ?? null), "installWpUrl", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("here")), "html", null, true);
            echo "</a>
\t</div>
";
        }
    }

    public function getTemplateName()
    {
        return "@googlemapseasy/partials/backend.main.content.setting.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  144 => 61,  140 => 60,  134 => 59,  130 => 58,  127 => 57,  121 => 53,  115 => 51,  111 => 49,  102 => 46,  89 => 42,  84 => 39,  80 => 38,  75 => 36,  65 => 28,  63 => 27,  58 => 24,  56 => 23,  52 => 21,  50 => 19,  49 => 15,  46 => 14,  43 => 11,  41 => 10,  39 => 9,  36 => 8,  30 => 6,  25 => 5,  23 => 4,  21 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@googlemapseasy/partials/backend.main.content.setting.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Googlemapseasy\\views\\partials\\backend.main.content.setting.twig");
    }
}
