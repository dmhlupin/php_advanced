<?php

namespace app\engine;

use app\interfaces\IRenderer;

class Render implements IRenderer
{
    public function renderTemplate($template, $params=[])
    {
        ob_start();
        extract($params);
        $templatePath = VIEWS_DIR . $template . ".php";
        if(file_exists($templatePath)) {
            include $templatePath;
        } else {
            Die('Нет такого шаблона');
        }
        
        return ob_get_clean();
    }
}