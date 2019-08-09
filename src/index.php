<?php

require '../../../lib/Ziggurat.php';
require './lib/SimplePhpGa/SimplePhpGa.php';

$options = [
  'base_dir' => '.',
  'pages_dir' => './pages',
  'template' => './template',
  // 'enable_cache' => true,
  // 'minify_html' => true
];

$Ziggurat = new \MMousawy\Ziggurat($options);

$Ziggurat->index();

$Ziggurat->resolve($_SERVER['REQUEST_URI']);

// Send GA hit
// $simplePhpGa = new MMousawy\SimplePhpGa();

// $result = $simplePhpGa->send([
//   'tid' => 'UA-16469031-3',
//   // Hit type (required; default: 'pageview'; http://goo.gl/a8d4RP#t)
//   't' => 'pageview',
//   // Document path (required; http://goo.gl/a8d4RP#dp)
//   'dp' => $Ziggurat->resolvedPage['slug-path']
// ]);

echo $Ziggurat->render();
