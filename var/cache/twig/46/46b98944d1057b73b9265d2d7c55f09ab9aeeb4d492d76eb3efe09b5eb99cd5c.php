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

/* layout/default.html.twig */
class __TwigTemplate_e91973ba1f490f30c9ec6f637dfb9dc0d4c4ba2d490d1128eb803564c3f04fee extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'meta' => [$this, 'block_meta'],
            'breadcrumbs' => [$this, 'block_breadcrumbs'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
    <meta charset=\"utf-8\" />
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\" />
    <title>";
        // line 6
        $this->displayBlock('title', $context, $blocks);
        echo " - App</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />
    ";
        // line 8
        $this->displayBlock('meta', $context, $blocks);
        // line 9
        echo "    <link href=\"https://use.fontawesome.com/releases/v5.0.6/css/all.css\" rel=\"stylesheet\" />
    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css\" />
    <style>
        body { padding-top: 70px; }
        h1 { margin-top: 0 }
        .app { display: flex; min-height: 100vh; flex-direction: column; }
        .app-content { flex: 1; }
        .app-footer { padding-bottom: 1em; }
    </style>
</head>
<body class=\"app\">
<header class=\"app-header\">
    <nav class=\"navbar navbar-expand-sm navbar-dark bg-dark fixed-top\">
        <div class=\"container\">
            <a class=\"navbar-brand\" href=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->extensions['Framework\Template\Twig\Extension\RouteExtension']->generatePath("home"), "html", null, true);
        echo "\">
                Application
            </a>
            <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarContent\" aria-controls=\"navbarContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                <span class=\"navbar-toggler-icon\"></span>
            </button>

            <div class=\"collapse navbar-collapse\" id=\"navbarContent\">
                <ul class=\"navbar-nav ml-auto\">
                    <li><a class=\"nav-link\" href=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->extensions['Framework\Template\Twig\Extension\RouteExtension']->generatePath("task"), "html", null, true);
        echo "\"><i class=\"fa fa-book\"></i> Tasks</a></li>

                </ul>
            </div>
        </div>
    </nav>
</header>

<div class=\"app-content\">
    <main class=\"container\">
        ";
        // line 42
        $this->displayBlock('breadcrumbs', $context, $blocks);
        // line 43
        echo "        ";
        $this->displayBlock('content', $context, $blocks);
        // line 44
        echo "    </main>
</div>

<footer class=\"app-footer\">
    <div class=\"container\">
        <div class=\"border-top pt-3\">
            <p>&copy; ";
        // line 50
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_date_converter($this->env), "Y"), "html", null, true);
        echo " - My App</p>
        </div>
    </div>
</footer>

<script src=\"https://code.jquery.com/jquery-3.3.1.min.js\"></script>
<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js\"></script>
</body>
</html>";
    }

    // line 6
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 8
    public function block_meta($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 42
    public function block_breadcrumbs($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 43
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function getTemplateName()
    {
        return "layout/default.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  140 => 43,  134 => 42,  128 => 8,  122 => 6,  109 => 50,  101 => 44,  98 => 43,  96 => 42,  83 => 32,  71 => 23,  55 => 9,  53 => 8,  48 => 6,  41 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "layout/default.html.twig", "D:\\OSPanel\\domains\\framework\\templates\\layout\\default.html.twig");
    }
}
