<?php

$db = new SQLite3('../murtada_nl.db');

$schema = <<<SQL
CREATE TABLE IF NOT EXISTS payments (
  id text PRIMARY KEY NOT NULL,
  order_id text NOT NULL,
  name text NOT NULL,
  email text NOT NULL,
  status text NOT NULL
);

CREATE TABLE IF NOT EXISTS newsletter (
  id integer PRIMARY KEY AUTOINCREMENT,
  email text NOT NULL
);
SQL;

$db->query($schema);

require '../../../lib/Ziggurat.php';

$options = [
  'pages_dir' => './pages',
  'template' => './template',
  '404' => '404',
  'error' => 'error',
  // 'enable_cache' => true,
  // 'minify_html' => true
];

$Ziggurat = new \MMousawy\Ziggurat($options);

$Ziggurat->index();

$Ziggurat->resolve($_SERVER['REQUEST_URI']);

echo $Ziggurat->render($Ziggurat->resolvedPage);
