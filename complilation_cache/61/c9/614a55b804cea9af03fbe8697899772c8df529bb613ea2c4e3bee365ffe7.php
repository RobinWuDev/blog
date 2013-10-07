<?php

/* index.twig */
class __TwigTemplate_61c9614a55b804cea9af03fbe8697899772c8df529bb613ea2c4e3bee365ffe7 extends Twig_Template
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
        echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
<title>Insert title here</title>
</head>
<body>
Hello ";
        // line 9
        echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
        echo "! 
";
        // line 10
        $context["foo"] = "foo";
        echo " 
";
        // line 11
        echo twig_escape_filter($this->env, (isset($context["foo"]) ? $context["foo"] : null), "html", null, true);
        echo "

</body>
</html>";
    }

    public function getTemplateName()
    {
        return "index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  36 => 11,  32 => 10,  28 => 9,  19 => 2,);
    }
}
