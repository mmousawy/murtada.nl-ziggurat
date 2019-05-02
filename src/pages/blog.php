<?php
#zigg:title       = `Blog`
#zigg:page-title  = `Blog`
#zigg:slug        = `blog`
#zigg:parent      = ``
#zigg:cover-image = ``
#zigg:date        = ``
#zigg:summary     = ``
?>

<section class="page-section">
  <a name="about" class="section-link"></a>
  <div class="wrap">
    <h1 class="page-title">Things I've written.</h1>
  </div>

  <?php

  $index = 0;

  foreach ($Ziggurat->list('blog', true) as $blog) {
    $props = $blog['properties'];

    $prettyDate = date('F jS, Y', strtotime($props['date']));
    $coverImage = isset($props['cover-image']) ? $props['cover-image'] : '';
    $coverAlt = isset($props['cover-alt']) ? $props['cover-alt'] : '';

    $class = ($index === 0)
              ? 'picture-wrapper--large'
              : 'picture-wrapper--small';

    $class .= ($index % 2 === 0)
              ? ' align-left align-left--outside'
              : ' align-right align-right--outside';

    echo
<<<HTML
<div class="content-row">
  <div class="wrap">
    <div class="picture-wrapper {$class}">
      <a href="{$blog['slug-path']}">
        <picture class="lazy">
          <source data-srcset="assets/images/blog/{$coverImage}-512px.jpg 512w, assets/images/blog/{$coverImage}-1024px.jpg 1024w" type="image/jpeg">
          <img data-src="assets/images/blog/{$coverImage}-1024px.jpg" alt="{$coverAlt}">
        </picture>
      </a>
    </div>
    <div class="content-row__text">
      <h2><a href="{$blog['slug-path']}">{$props['title']}</a></h2>
      <time datetime="{$props['date']} 12:00">{$prettyDate}</time>
      <p>{$props['summary']}</p>
      <p><a href="{$blog['slug-path']}">Read more</a>.</p>
    </div>
  </div>
</div>
HTML;

    $index++;
  }

  ?>
</section>

<?= file_get_contents('template/cta.php'); ?>
