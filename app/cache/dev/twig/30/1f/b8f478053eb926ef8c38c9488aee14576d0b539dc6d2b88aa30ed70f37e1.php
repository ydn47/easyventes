<?php

/* FOSUserBundle:Group:show_content.html.twig */
class __TwigTemplate_301fb8f478053eb926ef8c38c9488aee14576d0b539dc6d2b88aa30ed70f37e1 extends Twig_Template
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
        // line 2
        echo "
<div class=\"fos_user_group_show\">
    <p>";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("group.show.name", array(), "FOSUserBundle"), "html", null, true);
        echo ": ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["group"]) ? $context["group"] : $this->getContext($context, "group")), "getName", array(), "method"), "html", null, true);
        echo "</p>
</div>
";
    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Group:show_content.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  23 => 4,  19 => 2,);
    }
}
