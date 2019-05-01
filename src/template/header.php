<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Personal website and portfolio of Murtada al Mousawy, full-stack web developer based in the Netherlands.">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?= !empty($Ziggurat->resolvedPage['properties']['page-title']) ? $Ziggurat->resolvedPage['properties']['page-title'] . ' | ' : '' ?>Murtada webdesign bureau</title>
  <base href="/">
  <link rel="shortcut icon" href="favicons/favicon.ico">
  <link rel="apple-touch-icon" sizes="180x180" href="favicons/apple-touch-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicons/favicon-16x16.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicons/favicon-32x32.png">
  <link rel="manifest" href="favicons/manifest.json">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="theme-color" content="#7586e3">
  <meta name="application-name" content="Murtada.nl website">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <meta name="apple-mobile-web-app-title" content="Murtada.nl website">
  <link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" href="favicons/apple-touch-startup-image-640x1096.png">
  <link rel="icon" type="image/png" sizes="228x228" href="favicons/coast-228x228.png">
  <meta name="msapplication-TileColor" content="#7586e3">
  <meta name="msapplication-TileImage" content="favicons/mstile-144x144.png">
  <meta name="msapplication-config" content="favicons/browserconfig.xml">
  <link rel="yandex-tableau-widget" href="favicons/yandex-browser-manifest.json">
  <link rel="stylesheet" href="style.css">
  <link rel="preload" href="assets/fonts/sailec-regular.woff2" as="font" crossorigin="anonymous">
  <link rel="preload" href="assets/fonts/sailec-medium.woff2" as="font" crossorigin="anonymous">
</head>
<body>
  <header class="page-header">
    <div class="wrap">
      <a href="/" class="page-branding">
        <div class="page-branding__logomark">
          <img src="assets/images/_logo.svg">
        </div>
        <div class="page-branding__logotype">murtada.</div>
      </a>
      <label tabindex="-1" class="page-nav-label">
        <input type="checkbox" class="page-nav-label__button">
        <span></span>
        <span></span>
        <span></span>
      </label>
      <nav class="page-nav">
        <div class="page-nav__background"></div>
        <ul>
          <li><a href="about" class="page-nav__item<?= (in_array('about', $Ziggurat->resolvedPage['ancestors']) ? ' page-nav__item--active' : '') ?>">About</a></li>
          <li><a href="work" class="page-nav__item<?= (in_array('work', $Ziggurat->resolvedPage['ancestors']) ? ' page-nav__item--active' : '') ?>">Work</a></li>
          <!-- <li><a href="blog" class="page-nav__item<?= (in_array('blog', $Ziggurat->resolvedPage['ancestors']) ? ' page-nav__item--active' : '') ?>">Blog</a></li> -->
          <li><a href="<?= $Ziggurat->resolvedPage['slug-path'] ?>#contact" class="page-nav__item page-nav__item--mobile page-nav__item--hire-me">Hire me</a></li>
        </ul>
      </nav>
      <a href="<?= $Ziggurat->resolvedPage['slug-path'] ?>#contact" class="button button--hire-me">Hire me</a>
    </div>
  </header>
  <main class="page-content">
