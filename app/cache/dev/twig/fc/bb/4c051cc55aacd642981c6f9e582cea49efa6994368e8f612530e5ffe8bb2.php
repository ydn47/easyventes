<?php

/* base.html.twig */
class __TwigTemplate_fcbb4c051cc55aacd642981c6f9e582cea49efa6994368e8f612530e5ffe8bb2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'nav' => array($this, 'block_nav'),
            'body' => array($this, 'block_body'),
            'aside' => array($this, 'block_aside'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>

        ";
        // line 7
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "a7f3a00_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_a7f3a00_0") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/compiled/main_bootstrap.min_1.css");
            // line 12
            echo "        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" />
        ";
            // asset "a7f3a00_1"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_a7f3a00_1") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/compiled/main_bootstrap-theme.min_2.css");
            echo "        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" />
        ";
            // asset "a7f3a00_2"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_a7f3a00_2") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/compiled/main_jquery-ui.min_3.css");
            echo "        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" />
        ";
        } else {
            // asset "a7f3a00"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_a7f3a00") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/compiled/main.css");
            echo "        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" />
        ";
        }
        unset($context["asset_url"]);
        // line 14
        echo "

        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    </head>
    <body>
        ";
        // line 19
        $this->displayBlock('nav', $context, $blocks);
        // line 22
        echo "        <div class=\"container\">

            <div class=\"row\">
                <div class='col-md-12'>";
        // line 25
        $this->displayBlock('body', $context, $blocks);
        echo "</div>
                <div class='col-md-4'>";
        // line 26
        $this->displayBlock('aside', $context, $blocks);
        echo "</div>
            </div>
        </div>
        ";
        // line 29
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "0c03110_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_0c03110_0") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/compiled/main_jquery-1.11.2_1.js");
            // line 34
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
        <script type=\"text/javascript\">
            \$('.datepicker').datepicker({
            dateFormat: 'dd/mm/yy'});
        </script>
        ";
            // asset "0c03110_1"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_0c03110_1") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/compiled/main_bootstrap_2.js");
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
        <script type=\"text/javascript\">
            \$('.datepicker').datepicker({
            dateFormat: 'dd/mm/yy'});
        </script>
        ";
            // asset "0c03110_2"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_0c03110_2") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/compiled/main_jquery-ui.min_3.js");
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
        <script type=\"text/javascript\">
            \$('.datepicker').datepicker({
            dateFormat: 'dd/mm/yy'});
        </script>
        ";
        } else {
            // asset "0c03110"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_0c03110") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/compiled/main.js");
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
        <script type=\"text/javascript\">
            \$('.datepicker').datepicker({
            dateFormat: 'dd/mm/yy'});
        </script>
        ";
        }
        unset($context["asset_url"]);
        // line 40
        echo "    </body>
</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "Welcome!";
    }

    // line 19
    public function block_nav($context, array $blocks = array())
    {
        // line 20
        echo "            ";
        $this->env->loadTemplate(":include:navbar.html.twig")->display($context);
        // line 21
        echo "        ";
    }

    // line 25
    public function block_body($context, array $blocks = array())
    {
    }

    // line 26
    public function block_aside($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  164 => 26,  159 => 25,  155 => 21,  152 => 20,  149 => 19,  143 => 5,  137 => 40,  95 => 34,  91 => 29,  85 => 26,  81 => 25,  76 => 22,  74 => 19,  68 => 16,  64 => 14,  38 => 12,  34 => 7,  29 => 5,  23 => 1,);
    }
}
