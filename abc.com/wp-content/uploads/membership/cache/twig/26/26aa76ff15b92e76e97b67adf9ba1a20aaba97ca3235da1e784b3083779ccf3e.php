<?php

/* @gallery/partials/backend.main.content.setting.twig */
class __TwigTemplate_a5999bf7462896e638d703dcd569198f01d57a0555690f22a2cdfed3a5aa617d extends Twig_Template
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
        $context["options"] = $this->loadTemplate("@base/macros/options.twig", "@gallery/partials/backend.main.content.setting.twig", 1);
        // line 2
        echo "
";
        // line 3
        ob_start();
        // line 4
        echo "    ";
        if (($this->getAttribute($this->getAttribute(($context["pluginsInfo"] ?? null), "gallery", array()), "isPuliginActive", array()) != "true")) {
            echo " disabled=\"disabled\" ";
        }
        // line 5
        echo "    ";
        if ((($this->getAttribute($this->getAttribute(($context["pluginsInfo"] ?? null), "gallery", array()), "isPuliginActive", array()) == "true") && ($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "plugins", array()), "photoGallery", array()), "enabled", array()) == 1))) {
            echo " checked=\"checked\" ";
        }
        $context["inputAttr"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 7
        if (twig_length_filter($this->env, twig_trim_filter(($context["inputAttr"] ?? null)))) {
            // line 8
            echo "    ";
            $context["galleryRowAttributes"] = array("input" => twig_trim_filter(            // line 9
($context["inputAttr"] ?? null)));
        }
        // line 12
        echo "
<div class=\"sc-tab-content\" data-tab=\"plugins\">
    <div class=\"mp-options\">
        ";
        // line 15
        echo $context["options"]->getenablePluginRow("Photo Gallery", "plugins[photoGallery]", "photo-gallery-enable",         // line 19
($context["galleryRowAttributes"] ?? null), "Settings");
        // line 21
        echo "
        ";
        // line 22
        if (($this->getAttribute($this->getAttribute(($context["pluginsInfo"] ?? null), "gallery", array()), "isPuliginActive", array()) == "true")) {
            // line 23
            echo "            <div id=\"toogle-photo-gallery-enable\" style=\"display: none;\">
                <div class=\"row\">
                    <div class=\"col-md-12\">
                        ";
            // line 26
            if (twig_length_filter($this->env, $this->getAttribute($this->getAttribute(($context["pluginsInfo"] ?? null), "gallery", array()), "presets", array()))) {
                // line 27
                echo "                            <table class=\"sc-table mbs-plugins-preset-list\">
                                <tr>
                                    <th class=\"mbs-gg-header\">
                                        <label class=\"sc-checkbox\">
                                            <input type=\"checkbox\" class=\"mbs-setting-select-all\" data-type=\"gallery\">
                                            <div class=\"sc-checkbox-state\"></div>
                                        </label>
                                    </th>
                                    <th>";
                // line 35
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Gallery Name")), "html", null, true);
                echo "</th>
                                </tr>
                                ";
                // line 37
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute(($context["pluginsInfo"] ?? null), "gallery", array()), "presets", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["val1"]) {
                    // line 38
                    echo "                                    <tr>
                                        <td>
                                            <label class=\"sc-checkbox\">
                                                <input type=\"checkbox\" class=\"mbs-can-setting-checked mbs-type-gallery\" id=\"mbs-gallery-";
                    // line 41
                    echo twig_escape_filter($this->env, $this->getAttribute($context["val1"], "id", array()), "html", null, true);
                    echo "\" name=\"plugins[photoGallery][ids][]\" value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["val1"], "id", array()), "html", null, true);
                    echo "\" ";
                    if (twig_in_filter($this->getAttribute($context["val1"], "id", array()), $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "plugins", array()), "photoGallery", array()), "ids", array()))) {
                        echo " checked=\"checked\" ";
                    }
                    echo ">
                                                <div class=\"sc-checkbox-state\"></div>
                                            </label>
                                        </td>
                                        <td>";
                    // line 45
                    echo twig_escape_filter($this->env, $this->getAttribute($context["val1"], "title", array()), "html", null, true);
                    echo "</td>
                                    </tr>
                                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['val1'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 48
                echo "                            </table>
                        ";
            } else {
                // line 50
                echo "                            <div class=\"mbs-plug-msg-info\">";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("You have no Galleries for now. Create your Gallery or Enable Membership feature for galleries which you want to use as presets!.")), "html", null, true);
                echo "</div>
                        ";
            }
            // line 52
            echo "                    </div>
                </div>
            </div>
        ";
        } else {
            // line 56
            echo "            <div class=\"mbs-plug-not-install\">
                ";
            // line 57
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("You need to install Photo Gallery by Supsystic to use this feature. ")), "html", null, true);
            echo "
                <a target=\"_blank\" href=\"";
            // line 58
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["pluginsInfo"] ?? null), "gallery", array()), "installUrl", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Install")), "html", null, true);
            echo "</a>
                ";
            // line 59
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array(" plugin from your admin area, or visit it's official page on Wordpress.org ")), "html", null, true);
            echo "
                <a target=\"_blank\" href=\"";
            // line 60
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["pluginsInfo"] ?? null), "gallery", array()), "installWpUrl", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("here")), "html", null, true);
            echo "</a>

            </div>
        ";
        }
        // line 64
        echo "
        ";
        // line 65
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "backendMainContentSettingsSliderOpt"), "method"), "html", null, true);
        echo "
        ";
        // line 66
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "backendMainContentSettingsGoogleMapsEasyOpt"), "method"), "html", null, true);
        echo "
\t\t";
        // line 67
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["environment"] ?? null), "dispatcher", array()), "dispatch", array(0 => "backendMainContentSettingsSocialShareOpt"), "method"), "html", null, true);
        echo "
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "@gallery/partials/backend.main.content.setting.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  163 => 67,  159 => 66,  155 => 65,  152 => 64,  143 => 60,  139 => 59,  133 => 58,  129 => 57,  126 => 56,  120 => 52,  114 => 50,  110 => 48,  101 => 45,  88 => 41,  83 => 38,  79 => 37,  74 => 35,  64 => 27,  62 => 26,  57 => 23,  55 => 22,  52 => 21,  50 => 19,  49 => 15,  44 => 12,  41 => 9,  39 => 8,  37 => 7,  31 => 5,  26 => 4,  24 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@gallery/partials/backend.main.content.setting.twig", "F:\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Gallery\\views\\partials\\backend.main.content.setting.twig");
    }
}
