<?php

require '../../../lib/Ziggurat.php';

$options = [
  'base_dir' => '.',
  'pages_dir' => './pages',
  'template' => './template',
  // 'enable_cache' => true,
  'minify_html' => true
];

$Ziggurat = new \MMousawy\Ziggurat($options);

$Ziggurat->index();

$Ziggurat->resolve($_SERVER['REQUEST_URI']);

echo $Ziggurat->render();
