<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Personal website and portfolio of Murtada al Mousawy, full-stack web developer based in the Netherlands.">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?= !empty($Ziggurat->resolvedPage['properties']['page-title']) ? $Ziggurat->resolvedPage['properties']['page-title'] . ' | ' : '' ?>Murtada webdesign bureau</title>
  <base href="/">
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
