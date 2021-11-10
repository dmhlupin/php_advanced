<?php

require_once '../vendor/autoload.php';

$loader = new \Twig\Loader\FileSystemLoader('../templates');

$twig = new \Twig\Environment($loader);

echo $twig->render('index.twig', ['name' => 'Dmitry']);