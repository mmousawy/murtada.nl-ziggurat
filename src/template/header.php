<?php
  $props = $currentPage['properties'];

  $ctaUrl = isset($props['cta-url'])
              ? $props['cta-url']
              : $currentPage['slug_path'] . '#contact';

  $ctaText = isset($props['cta-text'])
              ? $props['cta-text']
              : 'Hire me';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?= !empty($props['description']) ? $props['description'] : ' Murtada al Mousawy, freelance full-stack web developer and web designer Rotterdam & Den Haag area.' ?>">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?= !empty($props['page-title']) ? $props['page-title'] . ' | ' : '' ?>Murtada al Mousawy<?= empty($props['page-title']) ? ' | Freelance Full-stack Developer Rotterdam & Den Haag' : '' ?></title>
  <meta name="geo.region" content="NL-ZH">
  <meta name="geo.placename" content="Rotterdam">
  <meta name="geo.position" content="51.9228958;4.4631727">
  <base href="/">
  <link rel="sitemap" href="/sitemap.xml" />
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
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?= !empty($props['page-title']) ? $props['page-title'] : '' ?>">
  <meta property="og:description" content="<?= !empty($props['description']) ? $props['description'] : 'Personal website and portfolio of Murtada al Mousawy, full-stack web developer based in the Netherlands.' ?>">
  <meta property="og:url" content="https://murtada.nl/<?= $currentPage['slug_path'] === 'index' ? '' : $currentPage['slug_path'] ?>">
  <meta property="og:image" content="https://murtada.nl/<?= isset($props['cover-image']['large']['url']) ? $props['cover-image']['large']['url'] : $Ziggurat->searchPage('index')['properties']['cover-image']['large']['url'] ?>">
  <meta property="og:site_name" content="Murtada webdesign bureau">
  <link rel="stylesheet" href="style.css">
  <link rel="preload" href="assets/fonts/sailec-regular.woff2" as="font" crossorigin="anonymous">
  <link rel="preload" href="assets/fonts/sailec-medium.woff2" as="font" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap" rel="stylesheet">
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-16469031-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-16469031-3');
  </script>
</head>
<body class="<?= isset($props['class']) ? $props['class'] : '' ?>">
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
          <li><a href="about" class="page-nav__item<?= (in_array('about', $currentPage['ancestors']) ? ' page-nav__item--active' : '') ?>">About</a></li>
          <li><a href="work" class="page-nav__item<?= (in_array('work', $currentPage['ancestors']) ? ' page-nav__item--active' : '') ?>">Work</a></li>
          <li><a href="products" class="page-nav__item<?= (in_array('products', $currentPage['ancestors']) ? ' page-nav__item--active' : '') ?>">Products</a></li>
          <li><a href="blog" class="page-nav__item<?= (in_array('blog', $currentPage['ancestors']) ? ' page-nav__item--active' : '') ?>">Blog</a></li>
          <li><a href="<?= $ctaUrl ?>" class="page-nav__item page-nav__item--mobile page-nav__item--hire-me"><?= $ctaText ?></a></li>
        </ul>
      </nav>
      <a href="<?= $ctaUrl ?>" class="button button--hire-me"><?= $ctaText ?></a>
    </div>
  </header>
  <main class="page-content">
