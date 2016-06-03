<?php

/* log.html */
class __TwigTemplate_fe207fe0595475286847e8ed683d9c8b60ec74fbe587a9013849ed27bdc36128 extends Twig_Template
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
        echo "<h1>Просмотр лога : </h1>
<a href=\"\\\">На главную</a>
<br>

";
        // line 5
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["items"]) ? $context["items"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 6
            echo "<p>";
            echo twig_escape_filter($this->env, $context["item"], "html", null, true);
            echo "</p>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "log.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  29 => 6,  25 => 5,  19 => 1,);
    }
}
/* <h1>Просмотр лога : </h1>*/
/* <a href="\">На главную</a>*/
/* <br>*/
/* */
/* {% for item in items %}*/
/* <p>{{ item }}</p>*/
/* {% endfor %}*/
/* */
