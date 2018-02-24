<?php

/* @slider/partials/backend.main.content.setting.twig */
class __TwigTemplate_bb62c4ad89df5d83d17a0037f74546dea0ac5f3fc984218682c27213c3ad66f5 extends Twig_Template
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
        $context["options"] = $this->loadTemplate("@base/macros/options.twig", "@slider/partials/backend.main.content.setting.twig", 1);
        // line 3
        echo "    ";
        $context["pluginS"] = $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "base", array()), "plugins", array()), "slider", array());
        // line 4
        ob_start();
        // line 5
        echo "    ";
        if (($this->getAttribute(($context["sliderInfo"] ?? null), "isPuliginActive", array()) != "true")) {
            echo " disabled=\"disabled\" ";
        }
        // line 6
        echo "    ";
        if ((($this->getAttribute(($context["sliderInfo"] ?? null), "isPuliginActive", array()) == "true") && ($this->getAttribute(($context["pluginS"] ?? null), "enabled", array()) == 1))) {
            echo " checked=\"checked\" ";
        }
        $context["inputSliderAttr"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 8
        if (twig_length_filter($this->env, twig_trim_filter(($context["inputSliderAttr"] ?? null)))) {
            // line 9
            echo "    ";
            $context["sliderRowAttributes"] = array("input" => twig_trim_filter(            // line 10
($context["inputSliderAttr"] ?? null)));
        }
        // line 13
        echo "

";
        // line 15
        echo $context["options"]->getenablePluginRow("Slider", "plugins[slider]", "slider-enable",         // line 19
($context["sliderRowAttributes"] ?? null), "Settings");
        // line 21
        echo "

";
        // line 23
        if (($this->getAttribute(($context["sliderInfo"] ?? null), "isPuliginActive", array()) == "true")) {
            // line 24
            echo "    <div id=\"toogle-slider-enable\" style=\"display: none;\">
        <div class=\"row\">
            <div class=\"col-md-12\">
                ";
            // line 27
            if (twig_length_filter($this->env, $this->getAttribute(($context["sliderInfo"] ?? null), "presets", array()))) {
                // line 28
                echo "                    <table class=\"sc-table mbs-plugins-preset-list\">
                        <tr>
                            <th class=\"mbs-gg-header\">
                                <label class=\"sc-checkbox\">
                                    <input type=\"checkbox\" class=\"mbs-setting-select-all\" data-type=\"slider\">
                                    <div class=\"sc-checkbox-state\"></div>
                                </label>
                            </th>
                            <th>";
                // line 36
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Slider Name")), "html", null, true);
                echo "</th>
                        </tr>
                        ";
                // line 38
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["sliderInfo"] ?? null), "presets", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["val1"]) {
                    // line 39
                    echo "                            <tr>
                                <td>
                                    <label class=\"sc-checkbox\">
                                        <input type=\"checkbox\" class=\"mbs-can-setting-checked mbs-type-slider\" id=\"mbs-slider-";
                    // line 42
                    echo twig_escape_filter($this->env, $this->getAttribute($context["val1"], "id", array()), "html", null, true);
                    echo "\" name=\"plugins[slider][ids][]\" value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["val1"], "id", array()), "html", null, true);
                    echo "\" ";
                    if (twig_in_filter($this->getAttribute($context["val1"], "id", array()), $this->getAttribute(($context["pluginS"] ?? null), "ids", array()))) {
                        echo " checked=\"checked\" ";
                    }
                    echo "/>
                                        <div class=\"sc-checkbox-state\"></div>
                                    </label>
                                </td>
                                <td>";
                    // line 46
                    echo twig_escape_filter($this->env, $this->getAttribute($context["val1"], "title", array()), "html", null, true);
                    echo "</td>
                            </tr>
                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['val1'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 49
                echo "                    </table>
                ";
            } else {
                // line 51
                echo "                    <div class=\"mbs-plug-msg-info\">";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("You have no Sliders for now. Create your Slider or Enable Membership feature for sliders which you want to use as presets!.")), "html", null, true);
                echo "</div>
                ";
            }
            // line 53
            echo "            </div>
        </div>
    </div>
";
        } else {
            // line 57
            echo "    <div class=\"mbs-plug-not-install\">
        ";
            // line 58
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("You need to install Slider by Supsystic to use this feature. ")), "html", null, true);
            echo "
        <a target=\"_blank\" href=\"";
            // line 59
            echo twig_escape_filter($this->env, $this->getAttribute(($context["sliderInfo"] ?? null), "installUrl", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Install")), "html", null, true);
            echo "</a>
        ";
            // line 60
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array(" plugin from your admin area, or visit it's official page on Wordpress.org ")), "html", null, true);
            echo "
        <a target=\"_blank\" href=\"";
            // line 61
            echo twig_escape_filter($this->env, $this->getAttribute(($context["sliderInfo"] ?? null), "installWpUrl", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("here")), "html", null, true);
            echo "</a>
    </div>
";
        }
    }

    public function getTemplateName()
    {
        return "@slider/partials/backend.main.content.setting.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  143 => 61,  139 => 60,  133 => 59,  129 => 58,  126 => 57,  120 => 53,  114 => 51,  110 => 49,  101 => 46,  88 => 42,  83 => 39,  79 => 38,  74 => 36,  64 => 28,  62 => 27,  57 => 24,  55 => 23,  51 => 21,  49 => 19,  48 => 15,  44 => 13,  41 => 10,  39 => 9,  37 => 8,  31 => 6,  26 => 5,  24 => 4,  21 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@slider/partials/backend.main.content.setting.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Slider\\views\\partials\\backend.main.content.setting.twig");
    }
}
