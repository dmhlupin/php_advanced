<?php

namespace app\engine;

use app\interfaces\IRenderer;

class TwigRender implements IRenderer
{
    protected $loader;
    protected $twig;
    public function __construct()
    {
        $this->loader = new \Twig\Loader\FileSystemLoader('../templates');
        $this->twig = new \Twig\Environment($this->loader);
    }
    public function renderTemplate($template, $params = [])
    {
        return $this->twig->render($template . '.twig', $params);
    }
}