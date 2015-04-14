<?php

/* :include:navbar.html.twig */
class __TwigTemplate_afc9e40d2ef504010d712bf87e785b3dce6ffb93d32ea941669f5ebe9bb72244 extends Twig_Template
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
        echo "<nav class=\"navbar navbar-default\">
    <div class=\"container-fluid\">

        <div class=\"navbar-header\">
            <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\">
                <span class=\"sr-only\">Cart</span>
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
            </button>
            <a class=\"navbar-brand\" href=\"#\">Cart</a>
        </div>

        <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
            <ul class=\"nav navbar-nav\">
                <li class=\"dropdown\">
                    <a href=\"\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\">Catégories</a>
                    <ul class=\"dropdown-menu\" role=\"menu\">
                        <li><a href=\"";
        // line 19
        echo $this->env->getExtension('routing')->getPath("ipf_cart_category_list");
        echo "\">Liste</a></li>
                        <li><a href=\"";
        // line 20
        echo $this->env->getExtension('routing')->getPath("ipf_cart_category_add");
        echo "\">Ajouter</a></li>
                    </ul>
                <li class=\"dropdown\">
                    <a href=\"\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\">Produits</a>
                    <ul class=\"dropdown-menu\" role=\"menu\">
                        <li><a href=\"";
        // line 25
        echo $this->env->getExtension('routing')->getPath("ipf_cart_product_list");
        echo "\">Liste</a></li>
                        <li><a href=\"";
        // line 26
        echo $this->env->getExtension('routing')->getPath("ipf_cart_product_add");
        echo "\">Ajouter</a></li>
                    </ul>
                </li>
                <li class=\"dropdown\">
                    <a href=\"\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\">Commandes</a>
                    <ul class=\"dropdown-menu\" role=\"menu\">
                        <li><a href=\"";
        // line 32
        echo $this->env->getExtension('routing')->getPath("ipf_cart_command_list");
        echo "\">Liste</a></li>
                    </ul>
                </li>
                <li class=\"dropdown\">
                    <a href=\"\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\">Panier</a>
                    <ul class=\"dropdown-menu\" role=\"menu\">
                        <li><a href=\"";
        // line 38
        echo $this->env->getExtension('routing')->getPath("ipf_cart_mycart_list");
        echo "\">Liste</a></li>
                        <li><a href=\"";
        // line 39
        echo $this->env->getExtension('routing')->getPath("ipf_cart_mycart");
        echo "\">Cart</a></li>
                    </ul>
                </li>
            </ul>
            <ul class=\"nav navbar-nav navbar-right\">
                <li>
                    ";
        // line 45
        if ($this->env->getExtension('security')->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
            // line 46
            echo "                        <a>";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("layout.logged_in_as", array("%username%" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "username", array())), "FOSUserBundle"), "html", null, true);
            echo "</a>
                    ";
        } else {
            // line 48
            echo "                        <a class=\"alert-danger\" href=\"";
            echo $this->env->getExtension('routing')->getPath("fos_user_registration_register");
            echo "\">S'inscrire</a>
                    ";
        }
        // line 50
        echo "                </li>
                <li>    
                    ";
        // line 52
        if ($this->env->getExtension('security')->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
            // line 53
            echo "                        <a class=\"alert-info\" href=\"";
            echo $this->env->getExtension('routing')->getPath("fos_user_security_logout");
            echo "\">
                            ";
            // line 54
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("layout.logout", array(), "FOSUserBundle"), "html", null, true);
            echo "
                        </a>
                    ";
        } else {
            // line 57
            echo "                        <a class=\"alert-info\" href=\"";
            echo $this->env->getExtension('routing')->getPath("fos_user_security_login");
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("layout.login", array(), "FOSUserBundle"), "html", null, true);
            echo "</a>
                    ";
        }
        // line 59
        echo "                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>";
    }

    public function getTemplateName()
    {
        return ":include:navbar.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  125 => 59,  117 => 57,  111 => 54,  106 => 53,  104 => 52,  100 => 50,  94 => 48,  88 => 46,  86 => 45,  77 => 39,  73 => 38,  64 => 32,  55 => 26,  51 => 25,  43 => 20,  39 => 19,  19 => 1,);
    }
}
