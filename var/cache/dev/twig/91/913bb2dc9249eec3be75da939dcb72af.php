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

/* registration/register.html.twig */
class __TwigTemplate_34664e1e02ff8d4200391c7662d5eda2 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "registration/register.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "registration/register.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "registration/register.html.twig", 1);
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

        echo "S'inscrire";
        
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
<section class=\"container my-3 bg-light rounded\">
    <div class = 'row'>
        <div class='col'>

            <h2 class=\"mb-3 font-weight-normal text-success text-center my-3\">Inscription</h2>

            ";
        // line 13
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 13, $this->source); })()), 'form_start');
        echo "

           <fieldset>
               <legend class=\"text-center\">
                   <img src=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/person.svg"), "html", null, true);
        echo "\" alt=\"person\" width=\"22\" height=\"22\">
                   Mon identité
               </legend>
               <div class=\"my-3\">";
        // line 20
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 20, $this->source); })()), "lastName", [], "any", false, false, false, 20), 'row', ["label" => "Nom"]);
        // line 22
        echo "
               </div>
               <div class=\"my-3\">
                   ";
        // line 25
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 25, $this->source); })()), "firstName", [], "any", false, false, false, 25), 'row', ["label" => "Prénom"]);
        // line 27
        echo "
               </div>
           </fieldset>
            <fieldset >
                <legend class=\"text-center\">
                    <img src=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/info-circle.svg"), "html", null, true);
        echo "\" alt=\"info\" width=\"22\" height=\"22\">
                    Mes coordonnées
                </legend>
                <div class=\"my-3\">
                    ";
        // line 36
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 36, $this->source); })()), "ville", [], "any", false, false, false, 36), 'row', ["label" => "Ville"]);
        // line 38
        echo "
                </div>
                <div class=\"my-3\">
                    ";
        // line 41
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 41, $this->source); })()), "codePostal", [], "any", false, false, false, 41), 'row', ["label" => "Code postal"]);
        // line 43
        echo "
                </div>
                <div class=\"my-3\">
                    ";
        // line 46
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 46, $this->source); })()), "numTel", [], "any", false, false, false, 46), 'row', ["label" => "Numéro de téléphone"]);
        // line 48
        echo "
                </div>
            </fieldset>
            <fieldset >
                <legend class=\"text-center\">
                    <img src=\"";
        // line 53
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/box-arrow-in-right.svg"), "html", null, true);
        echo "\" alt=\"id\" width=\"22\" height=\"22\">
                    Mes identifiants
                </legend>
                <div class=\"my-3\">
                    ";
        // line 57
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 57, $this->source); })()), "email", [], "any", false, false, false, 57), 'row', ["label" => "E-mail"]);
        // line 59
        echo "
                </div>
                <div class=\"my-3\">
                    ";
        // line 62
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 62, $this->source); })()), "plainPassword", [], "any", false, false, false, 62), 'row', ["label" => "Mot de passe"]);
        // line 64
        echo "
                </div>
                <div class=\"my-3\">
                    ";
        // line 67
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 67, $this->source); })()), "pseudo", [], "any", false, false, false, 67), 'row', ["label" => "Nom d'utilisateur"]);
        // line 69
        echo "
                </div>
            </fieldset>

            <div class=\"text-center\"><button type=\"submit\" class=\"btn btn-lg btn-success my-3\">S'inscrire</button></div>

            ";
        // line 75
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 75, $this->source); })()), 'form_end');
        echo "

        </div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "registration/register.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  187 => 75,  179 => 69,  177 => 67,  172 => 64,  170 => 62,  165 => 59,  163 => 57,  156 => 53,  149 => 48,  147 => 46,  142 => 43,  140 => 41,  135 => 38,  133 => 36,  126 => 32,  119 => 27,  117 => 25,  112 => 22,  110 => 20,  104 => 17,  97 => 13,  88 => 6,  78 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}S'inscrire{% endblock %}

{% block body %}

<section class=\"container my-3 bg-light rounded\">
    <div class = 'row'>
        <div class='col'>

            <h2 class=\"mb-3 font-weight-normal text-success text-center my-3\">Inscription</h2>

            {{ form_start(registrationForm) }}

           <fieldset>
               <legend class=\"text-center\">
                   <img src=\"{{ asset(\"images/person.svg\") }}\" alt=\"person\" width=\"22\" height=\"22\">
                   Mon identité
               </legend>
               <div class=\"my-3\">{{ form_row(registrationForm.lastName, {
                       label: 'Nom'
                   }) }}
               </div>
               <div class=\"my-3\">
                   {{ form_row(registrationForm.firstName, {
                       label: 'Prénom'
                   }) }}
               </div>
           </fieldset>
            <fieldset >
                <legend class=\"text-center\">
                    <img src=\"{{ asset(\"images/info-circle.svg\") }}\" alt=\"info\" width=\"22\" height=\"22\">
                    Mes coordonnées
                </legend>
                <div class=\"my-3\">
                    {{ form_row(registrationForm.ville, {
                        label: 'Ville'
                    }) }}
                </div>
                <div class=\"my-3\">
                    {{ form_row(registrationForm.codePostal, {
                        label: 'Code postal'
                    }) }}
                </div>
                <div class=\"my-3\">
                    {{ form_row(registrationForm.numTel, {
                        label: 'Numéro de téléphone'
                    }) }}
                </div>
            </fieldset>
            <fieldset >
                <legend class=\"text-center\">
                    <img src=\"{{ asset(\"images/box-arrow-in-right.svg\") }}\" alt=\"id\" width=\"22\" height=\"22\">
                    Mes identifiants
                </legend>
                <div class=\"my-3\">
                    {{ form_row(registrationForm.email, {
                        label:'E-mail'
                    }) }}
                </div>
                <div class=\"my-3\">
                    {{ form_row(registrationForm.plainPassword, {
                        label: 'Mot de passe'
                    }) }}
                </div>
                <div class=\"my-3\">
                    {{ form_row(registrationForm.pseudo, {
                        label: 'Nom d\\'utilisateur'
                    }) }}
                </div>
            </fieldset>

            <div class=\"text-center\"><button type=\"submit\" class=\"btn btn-lg btn-success my-3\">S'inscrire</button></div>

            {{ form_end(registrationForm) }}

        </div>
{% endblock %}", "registration/register.html.twig", "/Users/imane/PhpstormProjects/symfony_project/templates/registration/register.html.twig");
    }
}
