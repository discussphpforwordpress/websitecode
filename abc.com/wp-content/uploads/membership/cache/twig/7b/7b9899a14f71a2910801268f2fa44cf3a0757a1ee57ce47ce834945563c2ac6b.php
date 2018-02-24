<?php

/* @base/layouts/backend.twig */
class __TwigTemplate_0fb50c9f4c3f22d9fb6c914722bb6a91b678451df58729976cbfb0e967834121 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'mainHeader' => array($this, 'block_mainHeader'),
            'main' => array($this, 'block_main'),
            'mainFooter' => array($this, 'block_mainFooter'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"sc\">
\t<div class=\"sc-head\">
\t\t";
        // line 3
        $this->displayBlock('head', $context, $blocks);
        // line 4
        echo "\t</div>
\t<div class=\"sc-container\">
\t\t<div class=\"menu-sidebar\">
\t\t\t";
        // line 7
        $context["adminAreaMenus"] = $this->getAttribute(($context["environment"] ?? null), "getAdminAreaMenus", array(), "method");
        // line 8
        echo "\t\t\t";
        if (($context["adminAreaMenus"] ?? null)) {
            // line 9
            echo "\t\t\t\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["adminAreaMenus"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["menu"]) {
                // line 10
                echo "\t\t\t\t\t";
                $context["active"] = (($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "module", array()) == $this->getAttribute($context["menu"], "module", array())) || ($this->getAttribute($context["menu"], "is_main", array()) && (null === $this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "module", array()))));
                // line 11
                echo "\t\t\t\t\t";
                if ((($this->getAttribute($context["menu"], "action", array()) && ($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "action", array()) != $this->getAttribute($context["menu"], "action", array()))) || ($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "action", array()) && ($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "action", array()) != $this->getAttribute($context["menu"], "action", array()))))) {
                    // line 12
                    echo "\t\t\t\t\t\t";
                    $context["active"] = false;
                    // line 13
                    echo "\t\t\t\t\t";
                }
                // line 14
                echo "\t\t\t\t\t";
                $context["menuUrl"] = (($this->getAttribute($context["menu"], "action", array())) ? ($this->getAttribute(($context["environment"] ?? null), "generateUrl", array(0 => $this->getAttribute($context["menu"], "module", array()), 1 => $this->getAttribute($context["menu"], "action", array())), "method")) : ($this->getAttribute(($context["environment"] ?? null), "generateUrl", array(0 => $this->getAttribute($context["menu"], "module", array())), "method")));
                // line 15
                echo "\t\t\t\t\t<div class=\"menu-sidebar-item
\t\t\t\t\t\t";
                // line 16
                if (($context["active"] ?? null)) {
                    // line 17
                    echo "\t\t\t\t\t\t\tactive
\t\t\t\t\t\t";
                }
                // line 19
                echo "\t\t\t\t\t\">
\t\t\t\t\t\t<a href=\"";
                // line 20
                echo twig_escape_filter($this->env, ($context["menuUrl"] ?? null), "html", null, true);
                echo "\">
\t\t\t\t\t\t\t";
                // line 21
                if ($this->getAttribute($context["menu"], "fa_icon", array())) {
                    // line 22
                    echo "\t\t\t\t\t\t\t\t";
                    if (twig_test_iterable($this->getAttribute($context["menu"], "fa_icon", array()))) {
                        // line 23
                        echo "\t\t\t\t\t\t\t\t\t<span class=\"fa-stack\">
\t\t\t\t\t\t\t\t\t\t";
                        // line 24
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["menu"], "fa_icon", array()));
                        foreach ($context['_seq'] as $context["_key"] => $context["fa_icon"]) {
                            // line 25
                            echo "\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa ";
                            echo twig_escape_filter($this->env, $context["fa_icon"], "html", null, true);
                            echo "\"></i>
\t\t\t\t\t\t\t\t\t\t";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['fa_icon'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 27
                        echo "\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t";
                    } else {
                        // line 29
                        echo "\t\t\t\t\t\t\t\t\t<i class=\"fa ";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["menu"], "fa_icon", array()), "html", null, true);
                        echo "\"></i>
\t\t\t\t\t\t\t\t";
                    }
                    // line 31
                    echo "\t\t\t\t\t\t\t";
                }
                // line 32
                echo "\t\t\t\t\t\t\t<div class=\"menu-sidebar-item-title\">
\t\t\t\t\t\t\t\t";
                // line 33
                echo twig_escape_filter($this->env, $this->getAttribute($context["menu"], "title", array()), "html", null, true);
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
                // line 35
                if ($this->getAttribute($context["menu"], "is_promo", array())) {
                    // line 36
                    echo "\t\t\t\t\t\t\t<small>Pro</small>
\t\t\t\t\t\t\t";
                }
                // line 38
                echo "\t\t\t\t\t\t</a>
\t\t\t\t\t</div>
\t\t\t\t\t";
                // line 40
                if ((($context["active"] ?? null) && twig_test_empty($this->getAttribute($context["menu"], "is_main", array())))) {
                    // line 41
                    echo "\t\t\t\t\t\t<script type=\"text/javascript\">
\t\t\t\t\t\t\t/*Make sub menu in WP menu be selected for our modules menus too*/
\t\t\t\t\t\t\tjQuery(document).ready(function(){
\t\t\t\t\t\t\t\tvar activeTab = {
\t\t\t\t\t\t\t\t\tmod: '";
                    // line 45
                    echo twig_escape_filter($this->env, $this->getAttribute($context["menu"], "module", array()), "html", null, true);
                    echo "'
\t\t\t\t\t\t\t\t,\taction: '";
                    // line 46
                    echo twig_escape_filter($this->env, $this->getAttribute($context["menu"], "action", array()), "html", null, true);
                    echo "' 
\t\t\t\t\t\t\t\t};
\t\t\t\t\t\t\t\tif(jQuery('#toplevel_page_supsystic-membership').hasClass('wp-has-current-submenu')) {
\t\t\t\t\t\t\t\t\tvar \$subMenus = jQuery('#toplevel_page_supsystic-membership').find('.wp-submenu li');
\t\t\t\t\t\t\t\t\t\$subMenus.removeClass('current').each(function(){
\t\t\t\t\t\t\t\t\t\tvar checkUrl = '&module='+ activeTab.mod+ (activeTab.action ? '&action='+ activeTab.action : '');
\t\t\t\t\t\t\t\t\t\tif(jQuery(this).find('a[href\$=\"'+ checkUrl+ '\"]').size()) {
\t\t\t\t\t\t\t\t\t\t\tjQuery(this).addClass('current');
\t\t\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t\t\t});
\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t});
\t\t\t\t\t\t</script>
\t\t\t\t\t";
                }
                // line 60
                echo "\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['menu'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 61
            echo "\t\t\t";
        } else {
            // line 62
            echo "\t\t\t<!--Leave this code just for a while - to make sure current users will not take additional problems-->
\t\t\t<div class=\"menu-sidebar-item
\t\t\t\t";
            // line 64
            if ((($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "module", array()) == "membership") || (null === $this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "module", array())))) {
                // line 65
                echo "\t\t\t\t\tactive
\t\t\t\t";
            }
            // line 67
            echo "\t\t\t\">
\t\t\t\t<a href=\"";
            // line 68
            echo twig_escape_filter($this->env, $this->getAttribute(($context["environment"] ?? null), "generateUrl", array(0 => "membership"), "method"), "html", null, true);
            echo "\">
\t\t\t\t\t<i class=\"fa fa-cogs\"></i>
\t\t\t\t\t<div class=\"menu-sidebar-item-title\">
\t\t\t\t\t\t";
            // line 71
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Main")), "html", null, true);
            echo "
\t\t\t\t\t</div>
\t\t\t\t</a>
\t\t\t</div>
\t\t\t<div class=\"menu-sidebar-item
\t\t\t\t";
            // line 76
            if (($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "module", array()) == "users")) {
                // line 77
                echo "\t\t\t\t\tactive
\t\t\t\t";
            }
            // line 79
            echo "\t\t\t\">
\t\t\t\t<a href=\"";
            // line 80
            echo twig_escape_filter($this->env, $this->getAttribute(($context["environment"] ?? null), "generateUrl", array(0 => "users"), "method"), "html", null, true);
            echo "\">
\t\t\t\t\t<span class=\"fa-stack\">
\t\t\t\t\t\t<i class=\"fa fa-user\"></i>
\t\t\t\t\t\t<i class=\"fa fa-file fa-file-stacked\"></i>
\t\t\t\t\t</span>
\t\t\t\t\t<div class=\"menu-sidebar-item-title\">
\t\t\t\t\t\t";
            // line 86
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Profile")), "html", null, true);
            echo "
\t\t\t\t\t</div>
\t\t\t\t</a>
\t\t\t</div>
\t\t\t<div class=\"menu-sidebar-item
\t\t\t\t";
            // line 91
            if (($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "module", array()) == "roles")) {
                // line 92
                echo "\t\t\t\t\tactive
\t\t\t\t";
            }
            // line 94
            echo "\t\t\t\">
\t\t\t\t<a href=\"";
            // line 95
            echo twig_escape_filter($this->env, $this->getAttribute(($context["environment"] ?? null), "generateUrl", array(0 => "roles"), "method"), "html", null, true);
            echo "\">
\t\t\t\t\t<span class=\"fa-stack\">
\t\t\t\t\t\t<i class=\"fa fa-user\"></i>
\t\t\t\t\t\t<i class=\"fa fa-check-square-o fa-file-stacked\"></i>
\t\t\t\t\t</span>
\t\t\t\t\t<div class=\"menu-sidebar-item-title\">
\t\t\t\t\t\t";
            // line 101
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Roles")), "html", null, true);
            echo "
\t\t\t\t\t</div>
\t\t\t\t</a>
\t\t\t</div>
\t\t\t<div class=\"menu-sidebar-item
\t\t\t\t";
            // line 106
            if (($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "module", array()) == "groups")) {
                // line 107
                echo "\t\t\t\t\tactive
\t\t\t\t";
            }
            // line 109
            echo "\t\t\t\">
\t\t\t\t<a href=\"";
            // line 110
            echo twig_escape_filter($this->env, $this->getAttribute(($context["environment"] ?? null), "generateUrl", array(0 => "groups"), "method"), "html", null, true);
            echo "\">
\t\t\t\t\t<i class=\"fa fa-group\"></i>
\t\t\t\t\t<div class=\"menu-sidebar-item-title\">
\t\t\t\t\t\t";
            // line 113
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Groups")), "html", null, true);
            echo "
\t\t\t\t\t</div>
\t\t\t\t</a>
\t\t\t</div>
\t\t\t<div class=\"
\t\t\t\tmenu-sidebar-item
\t\t\t\t";
            // line 119
            if (($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "module", array()) == "messages")) {
                // line 120
                echo "\t\t\t\t\tactive
\t\t\t\t";
            }
            // line 122
            echo "\t\t\t\">
\t\t\t\t<a href=\"";
            // line 123
            echo twig_escape_filter($this->env, $this->getAttribute(($context["environment"] ?? null), "generateUrl", array(0 => "messages"), "method"), "html", null, true);
            echo "\">
\t\t\t\t\t<i class=\"fa fa-envelope\"></i>
\t\t\t\t\t<div class=\"menu-sidebar-item-title\">
\t\t\t\t\t\t";
            // line 126
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Mails")), "html", null, true);
            echo "
\t\t\t\t\t</div>
\t\t\t\t</a>
\t\t\t</div>
\t\t\t<div class=\"
\t\t\t\tmenu-sidebar-item
\t\t\t\t";
            // line 132
            if (($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "module", array()) == "design")) {
                // line 133
                echo "\t\t\t\t\tactive
\t\t\t\t";
            }
            // line 135
            echo "\t\t\t\">
\t\t\t\t<a href=\"";
            // line 136
            echo twig_escape_filter($this->env, $this->getAttribute(($context["environment"] ?? null), "generateUrl", array(0 => "design"), "method"), "html", null, true);
            echo "\">
\t\t\t\t\t<i class=\"fa fa-picture-o\"></i>
\t\t\t\t\t<div class=\"menu-sidebar-item-title\">
\t\t\t\t\t\t";
            // line 139
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Design")), "html", null, true);
            echo "
\t\t\t\t\t</div>
\t\t\t\t</a>
\t\t\t</div>
\t\t\t<div class=\"
\t\t\t\tmenu-sidebar-item
\t\t\t\t";
            // line 145
            if (($this->getAttribute($this->getAttribute(($context["request"] ?? null), "query", array()), "module", array()) == "reports")) {
                // line 146
                echo "\t\t\t\t\tactive
\t\t\t\t";
            }
            // line 148
            echo "\t\t\t\">
\t\t\t\t<a href=\"";
            // line 149
            echo twig_escape_filter($this->env, $this->getAttribute(($context["environment"] ?? null), "generateUrl", array(0 => "reports"), "method"), "html", null, true);
            echo "\">
\t\t\t\t\t<i class=\"fa fa-bars\"></i>
\t\t\t\t\t<div class=\"menu-sidebar-item-title\">
\t\t\t\t\t\t";
            // line 152
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('translate')->getCallable(), array("Reports")), "html", null, true);
            echo "
\t\t\t\t\t</div>
\t\t\t\t</a>
\t\t\t</div>
\t\t\t";
        }
        // line 157
        echo "\t\t</div>
\t\t<div class=\"main-container\">
\t\t\t";
        // line 159
        $this->displayBlock('mainHeader', $context, $blocks);
        // line 161
        echo "\t\t\t";
        $this->displayBlock('main', $context, $blocks);
        // line 163
        echo "\t\t\t";
        $this->displayBlock('mainFooter', $context, $blocks);
        // line 165
        echo "\t\t</div>
\t</div>
</div>";
    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
    }

    // line 159
    public function block_mainHeader($context, array $blocks = array())
    {
        // line 160
        echo "\t\t\t";
    }

    // line 161
    public function block_main($context, array $blocks = array())
    {
        // line 162
        echo "\t\t\t";
    }

    // line 163
    public function block_mainFooter($context, array $blocks = array())
    {
        // line 164
        echo "\t\t\t";
    }

    public function getTemplateName()
    {
        return "@base/layouts/backend.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  379 => 164,  376 => 163,  372 => 162,  369 => 161,  365 => 160,  362 => 159,  357 => 3,  351 => 165,  348 => 163,  345 => 161,  343 => 159,  339 => 157,  331 => 152,  325 => 149,  322 => 148,  318 => 146,  316 => 145,  307 => 139,  301 => 136,  298 => 135,  294 => 133,  292 => 132,  283 => 126,  277 => 123,  274 => 122,  270 => 120,  268 => 119,  259 => 113,  253 => 110,  250 => 109,  246 => 107,  244 => 106,  236 => 101,  227 => 95,  224 => 94,  220 => 92,  218 => 91,  210 => 86,  201 => 80,  198 => 79,  194 => 77,  192 => 76,  184 => 71,  178 => 68,  175 => 67,  171 => 65,  169 => 64,  165 => 62,  162 => 61,  156 => 60,  139 => 46,  135 => 45,  129 => 41,  127 => 40,  123 => 38,  119 => 36,  117 => 35,  112 => 33,  109 => 32,  106 => 31,  100 => 29,  96 => 27,  87 => 25,  83 => 24,  80 => 23,  77 => 22,  75 => 21,  71 => 20,  68 => 19,  64 => 17,  62 => 16,  59 => 15,  56 => 14,  53 => 13,  50 => 12,  47 => 11,  44 => 10,  39 => 9,  36 => 8,  34 => 7,  29 => 4,  27 => 3,  23 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@base/layouts/backend.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Base\\views\\layouts\\backend.twig");
    }
}
