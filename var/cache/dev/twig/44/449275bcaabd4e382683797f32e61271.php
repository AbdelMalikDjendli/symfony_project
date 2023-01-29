<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* security/login.html.twig */
class __TwigTemplate_bb3262a21e5ff7ad468afb778d2b3aa7 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/login.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/login.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "security/login.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        echo "Se connecter";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 5
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        echo "
    <section class=\"container bg-light rounded my-3\">
        <form method=\"post\">
            ";
        // line 9
        if ((isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 9, $this->source); })())) {
            // line 10
            echo "                <div class=\"alert alert-danger\">";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(twig_get_attribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 10, $this->source); })()), "messageKey", [], "any", false, false, false, 10), twig_get_attribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 10, $this->source); })()), "messageData", [], "any", false, false, false, 10), "security"), "html", null, true);
            echo "</div>
            ";
        }
        // line 12
        echo "
            ";
        // line 13
        if (twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 13, $this->source); })()), "user", [], "any", false, false, false, 13)) {
            // line 14
            echo "                <div class=\"mb-3\">
                    Vous êtes connectés en tant que ";
            // line 15
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 15, $this->source); })()), "user", [], "any", false, false, false, 15), "userIdentifier", [], "any", false, false, false, 15), "html", null, true);
            echo ", <a href=\"";
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
            echo "\">Deconnexion</a>
                </div>
            ";
        }
        // line 18
        echo "            <div class=\"row text-center my-3\">
                <div class=\"col-12\">
                    <h2 class=\" mb-3 font-weight-normal text-success\">Connexion</h2>
                </div>
            </div>
            <div class=\"row my-3\">

                <div class=\"col-4 text-end\">
                    <img src=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/envelope.svg"), "html", null, true);
        echo "\" alt=\"Bootstrap\" width=\"20\" height=\"20\">
                    <label for=\"inputEmail\" >E-mail</label>
                </div>
                <div class=\"col-4\">
                    <input type=\"email\" value=\"";
        // line 30
        echo twig_escape_filter($this->env, (isset($context["last_username"]) || array_key_exists("last_username", $context) ? $context["last_username"] : (function () { throw new RuntimeError('Variable "last_username" does not exist.', 30, $this->source); })()), "html", null, true);
        echo "\" name=\"email\" id=\"inputEmail\" class=\"form-control\" autocomplete=\"email\" required autofocus>
                </div>
            </div>
            <div class=\"row my-3\">
                <div class=\"col-4 text-end\">
                    <img src=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/key.svg"), "html", null, true);
        echo "\" alt=\"Bootstrap\" width=\"20\" height=\"20\">
                    <label for=\"inputPassword\">Mot de passe</label>
                </div>
                <div class=\"col-4\">
                    <input type=\"password\" name=\"password\" id=\"inputPassword\" class=\"form-control\" autocomplete=\"current-password\" required>
                </div>
                <input type=\"hidden\" name=\"_csrf_token\"
                       value=\"";
        // line 42
        echo twig_escape_filter($this->env, $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("authenticate"), "html", null, true);
        echo "\"
                >
            </div>
            <div class=\"row text-center my-2\">
                <div class=\"col-12\">
                    <button class=\"btn btn-lg btn-success my-3\" type=\"submit\">
                        Se connecter
                    </button>
                </div>
            </div>
        </form>
        <div class=\"row text-center\" >
            <div class=\"col-12\">
                <a href=\"";
        // line 55
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
        echo "\" class=\"link-secondary\">S'inscrire</a>
            </div>
        </div>
    </section>

        <!--

    <section class=\"container text-center\">
        <div class = 'row'>


                <form method=\"post\">

                    ";
        // line 68
        if ((isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 68, $this->source); })())) {
            // line 69
            echo "                        <div class=\"alert alert-danger\">";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(twig_get_attribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 69, $this->source); })()), "messageKey", [], "any", false, false, false, 69), twig_get_attribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 69, $this->source); })()), "messageData", [], "any", false, false, false, 69), "security"), "html", null, true);
            echo "</div>
                    ";
        }
        // line 71
        echo "
                    ";
        // line 72
        if (twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 72, $this->source); })()), "user", [], "any", false, false, false, 72)) {
            // line 73
            echo "                        <div class=\"mb-3\">
                            You are logged in as ";
            // line 74
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 74, $this->source); })()), "user", [], "any", false, false, false, 74), "userIdentifier", [], "any", false, false, false, 74), "html", null, true);
            echo ", <a href=\"";
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
            echo "\">Logout</a>
                        </div>
                    ";
        }
        // line 77
        echo "                    <div>
                        <h1 class=\"h3 mb-3 font-weight-normal\">Connexion</h1>

                    </div>
                    <ul class=\"list-inline \">
                        <div>
                            <li class=\"list-inline-item\">
                                <label for=\"inputEmail\">Email</label>
                            </li>
                        </div>
                        <div>
                            <li class=\"list-inline-item\">
                                <input type=\"email\" value=\"";
        // line 89
        echo twig_escape_filter($this->env, (isset($context["last_username"]) || array_key_exists("last_username", $context) ? $context["last_username"] : (function () { throw new RuntimeError('Variable "last_username" does not exist.', 89, $this->source); })()), "html", null, true);
        echo "\" name=\"email\" id=\"inputEmail\" class=\"form-control\" autocomplete=\"email\" required autofocus>
                            </li>
                        </div>

                    </ul>

                   <ul class=\"list-inline \">
                       <li class=\"list-inline-item\">
                           <label for=\"inputPassword\">Mot de passe</label>
                       </li>
                       <li class=\"list-inline-item\">
                           <input type=\"password\" name=\"password\" id=\"inputPassword\" class=\"form-control\" autocomplete=\"current-password\" required>
                       </li>
                   </ul>


                    <input type=\"hidden\" name=\"_csrf_token\"
                           value=\"";
        // line 106
        echo twig_escape_filter($this->env, $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("authenticate"), "html", null, true);
        echo "\"
                    >

                    ";
        // line 119
        echo "
                    <button class=\"btn btn-lg btn-primary my-3\" type=\"submit\">
                        Se connecter
                    </button>

                </form>


        </div>
    </section>
    -!>

";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "security/login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  248 => 119,  242 => 106,  222 => 89,  208 => 77,  200 => 74,  197 => 73,  195 => 72,  192 => 71,  186 => 69,  184 => 68,  168 => 55,  152 => 42,  142 => 35,  134 => 30,  127 => 26,  117 => 18,  109 => 15,  106 => 14,  104 => 13,  101 => 12,  95 => 10,  93 => 9,  88 => 6,  78 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Se connecter{% endblock %}

{% block body %}

    <section class=\"container bg-light rounded my-3\">
        <form method=\"post\">
            {% if error %}
                <div class=\"alert alert-danger\">{{ error.messageKey|trans(error.messageData, 'security') }}</div>
            {% endif %}

            {% if app.user %}
                <div class=\"mb-3\">
                    Vous êtes connectés en tant que {{ app.user.userIdentifier }}, <a href=\"{{ path('app_logout') }}\">Deconnexion</a>
                </div>
            {% endif %}
            <div class=\"row text-center my-3\">
                <div class=\"col-12\">
                    <h2 class=\" mb-3 font-weight-normal text-success\">Connexion</h2>
                </div>
            </div>
            <div class=\"row my-3\">

                <div class=\"col-4 text-end\">
                    <img src=\"{{ asset(\"images/envelope.svg\") }}\" alt=\"Bootstrap\" width=\"20\" height=\"20\">
                    <label for=\"inputEmail\" >E-mail</label>
                </div>
                <div class=\"col-4\">
                    <input type=\"email\" value=\"{{ last_username }}\" name=\"email\" id=\"inputEmail\" class=\"form-control\" autocomplete=\"email\" required autofocus>
                </div>
            </div>
            <div class=\"row my-3\">
                <div class=\"col-4 text-end\">
                    <img src=\"{{ asset(\"images/key.svg\") }}\" alt=\"Bootstrap\" width=\"20\" height=\"20\">
                    <label for=\"inputPassword\">Mot de passe</label>
                </div>
                <div class=\"col-4\">
                    <input type=\"password\" name=\"password\" id=\"inputPassword\" class=\"form-control\" autocomplete=\"current-password\" required>
                </div>
                <input type=\"hidden\" name=\"_csrf_token\"
                       value=\"{{ csrf_token('authenticate') }}\"
                >
            </div>
            <div class=\"row text-center my-2\">
                <div class=\"col-12\">
                    <button class=\"btn btn-lg btn-success my-3\" type=\"submit\">
                        Se connecter
                    </button>
                </div>
            </div>
        </form>
        <div class=\"row text-center\" >
            <div class=\"col-12\">
                <a href=\"{{ path('app_register') }}\" class=\"link-secondary\">S'inscrire</a>
            </div>
        </div>
    </section>

        <!--

    <section class=\"container text-center\">
        <div class = 'row'>


                <form method=\"post\">

                    {% if error %}
                        <div class=\"alert alert-danger\">{{ error.messageKey|trans(error.messageData, 'security') }}</div>
                    {% endif %}

                    {% if app.user %}
                        <div class=\"mb-3\">
                            You are logged in as {{ app.user.userIdentifier }}, <a href=\"{{ path('app_logout') }}\">Logout</a>
                        </div>
                    {% endif %}
                    <div>
                        <h1 class=\"h3 mb-3 font-weight-normal\">Connexion</h1>

                    </div>
                    <ul class=\"list-inline \">
                        <div>
                            <li class=\"list-inline-item\">
                                <label for=\"inputEmail\">Email</label>
                            </li>
                        </div>
                        <div>
                            <li class=\"list-inline-item\">
                                <input type=\"email\" value=\"{{ last_username }}\" name=\"email\" id=\"inputEmail\" class=\"form-control\" autocomplete=\"email\" required autofocus>
                            </li>
                        </div>

                    </ul>

                   <ul class=\"list-inline \">
                       <li class=\"list-inline-item\">
                           <label for=\"inputPassword\">Mot de passe</label>
                       </li>
                       <li class=\"list-inline-item\">
                           <input type=\"password\" name=\"password\" id=\"inputPassword\" class=\"form-control\" autocomplete=\"current-password\" required>
                       </li>
                   </ul>


                    <input type=\"hidden\" name=\"_csrf_token\"
                           value=\"{{ csrf_token('authenticate') }}\"
                    >

                    {#
Uncomment this section and add a remember_me option below your firewall to activate remember me functionality.
See https://symfony.com/doc/current/security/remember_me.html

<div class=\"checkbox mb-3\">
    <label>
        <input type=\"checkbox\" name=\"_remember_me\"> Remember me
    </label>
</div>
#}

                    <button class=\"btn btn-lg btn-primary my-3\" type=\"submit\">
                        Se connecter
                    </button>

                </form>


        </div>
    </section>
    -!>

{% endblock %}", "security/login.html.twig", "C:\\laragon\\www\\symfony_project\\templates\\security\\login.html.twig");
    }
}
