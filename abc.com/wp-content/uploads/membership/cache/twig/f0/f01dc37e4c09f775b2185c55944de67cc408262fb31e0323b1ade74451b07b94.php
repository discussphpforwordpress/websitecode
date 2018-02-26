<?php

/* @messages/partials/conversations-list.twig */
class __TwigTemplate_25d4aa6aaf20f55b94a008a427e33622753b6dec9b3f1ac16a538dfa02188633 extends Twig_Template
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
        ob_start();
        // line 2
        echo "\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["conversations"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["conversation"]) {
            // line 3
            echo "\t\t<div class=\"item\" data-id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["conversation"], "id", array()), "html", null, true);
            echo "\">
\t\t\t<div class=\"content-info\">
\t\t\t\t<div class=\"right last-message-date\">";
            // line 5
            echo twig_escape_filter($this->env, $this->getAttribute($context["conversation"], "lastMessageCreatedAt", array()), "html", null, true);
            echo "</div>
\t\t\t\t<div class=\"right ui red mini circular label unread-messages-count\"
\t\t\t\t\t\t";
            // line 7
            if ( !$this->getAttribute($context["conversation"], "unreadMessages", array())) {
                // line 8
                echo "\t\t\t\t\t\t\tstyle=\"display:none\"
\t\t\t\t\t\t";
            }
            // line 10
            echo "\t\t\t\t>";
            echo twig_escape_filter($this->env, $this->getAttribute($context["conversation"], "unreadMessages", array()), "html", null, true);
            echo "</div>
\t\t\t</div>
\t\t\t
\t\t\t";
            // line 13
            $context["usersLength"] = twig_length_filter($this->env, $this->getAttribute($context["conversation"], "users", array()));
            // line 14
            echo "\t\t\t<div class=\"conversation-image
\t\t\t\t\t";
            // line 15
            if ((($context["usersLength"] ?? null) == 1)) {
                // line 16
                echo "\t\t\t\t        one
\t\t\t        ";
            } elseif ((            // line 17
($context["usersLength"] ?? null) == 2)) {
                // line 18
                echo "\t\t\t            ";
                if ( !((($context["usersLength"] ?? null) == 2) && ($this->getAttribute(($context["user"] ?? null), "id", array()) == $this->getAttribute(($context["currentUser"] ?? null), "id", array())))) {
                    // line 19
                    echo "\t\t\t\t            one
\t\t\t\t        ";
                } else {
                    // line 21
                    echo "\t\t\t\t            two
\t\t\t\t        ";
                }
                // line 23
                echo "\t\t\t        ";
            } elseif ((($context["usersLength"] ?? null) > 2)) {
                // line 24
                echo "\t\t\t\t        many
\t\t\t        ";
            }
            // line 26
            echo "\t\t\t\t\">
\t\t\t\t";
            // line 27
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["conversation"], "users", array()));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
                // line 28
                echo "\t\t\t\t\t";
                if ( !((($context["usersLength"] ?? null) == 2) && ($this->getAttribute($context["user"], "id", array()) == $this->getAttribute(($context["currentUser"] ?? null), "id", array())))) {
                    // line 29
                    echo "\t\t\t\t\t\t<div>
\t\t\t\t\t\t\t<img src=\"";
                    // line 30
                    echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->userAvatar($context["user"], "medium"), "html", null, true);
                    echo "\" alt=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "displayName", array()), "html", null, true);
                    echo "\">
\t\t\t\t\t\t</div>
\t\t\t\t\t";
                }
                // line 33
                echo "\t\t\t\t\t";
                if ((((($context["usersLength"] ?? null) == 2) && ($this->getAttribute($context["user"], "id", array()) == $this->getAttribute(($context["currentUser"] ?? null), "id", array()))) && $this->getAttribute($context["loop"], "last", array()))) {
                    // line 34
                    echo "\t\t\t\t\t\t<div>
\t\t\t\t\t\t\t<img src=\"";
                    // line 35
                    echo twig_escape_filter($this->env, $this->env->getExtension('Membership_Users_Twig')->userAvatar($context["user"], "medium"), "html", null, true);
                    echo "\" alt=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "displayName", array()), "html", null, true);
                    echo "\">
\t\t\t\t\t\t</div>
\t\t\t\t\t";
                }
                // line 38
                echo "\t\t\t\t";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 39
            echo "\t\t\t</div>
\t\t\t

\t\t\t<div class=\"content-data\">
\t\t\t\t<div class=\"mp-coversation-users\">
\t\t\t\t\t";
            // line 44
            if ((($context["usersLength"] ?? null) <= 2)) {
                // line 45
                echo "\t\t\t\t\t\t";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["conversation"], "users", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
                    // line 46
                    echo "\t\t\t\t\t\t\t";
                    if ( !$this->env->getExtension('Membership_Users_Twig')->isCurrentUser($context["user"])) {
                        // line 47
                        echo "\t\t\t\t\t\t\t\t";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "displayName", array()), "html", null, true);
                        echo "
\t\t\t\t\t\t\t";
                    }
                    // line 49
                    echo "\t\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 50
                echo "\t\t\t\t\t";
            } else {
                // line 51
                echo "\t\t\t\t\t\t";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["conversation"], "users", array()));
                $context['loop'] = array(
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                );
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
                    // line 52
                    echo "\t\t\t\t\t\t\t";
                    ob_start();
                    // line 53
                    echo "\t\t\t\t\t\t\t\t";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "firstName", array()), "html", null, true);
                    echo "
\t\t\t\t\t\t\t";
                    echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                    // line 54
                    if ( !$this->getAttribute($context["loop"], "last", array())) {
                        echo ",";
                    }
                    // line 55
                    echo "\t\t\t\t\t\t";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 56
                echo "\t\t\t\t\t";
            }
            // line 57
            echo "\t\t\t\t</div>
\t\t\t\t<div class=\"last-message\">";
            // line 58
            echo twig_escape_filter($this->env, $this->getAttribute($context["conversation"], "lastMessage", array()), "html", null, true);
            echo "</div>
\t\t\t</div>

\t\t</div>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['conversation'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "@messages/partials/conversations-list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  225 => 58,  222 => 57,  219 => 56,  205 => 55,  201 => 54,  195 => 53,  192 => 52,  174 => 51,  171 => 50,  165 => 49,  159 => 47,  156 => 46,  151 => 45,  149 => 44,  142 => 39,  128 => 38,  120 => 35,  117 => 34,  114 => 33,  106 => 30,  103 => 29,  100 => 28,  83 => 27,  80 => 26,  76 => 24,  73 => 23,  69 => 21,  65 => 19,  62 => 18,  60 => 17,  57 => 16,  55 => 15,  52 => 14,  50 => 13,  43 => 10,  39 => 8,  37 => 7,  32 => 5,  26 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@messages/partials/conversations-list.twig", "C:\\WorkShop\\Mine\\wwwroot\\abc.com\\wp-content\\plugins\\membership-by-supsystic\\src\\Membership\\Messages\\views\\partials\\conversations-list.twig");
    }
}
