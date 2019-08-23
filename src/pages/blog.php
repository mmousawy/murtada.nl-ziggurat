<?php
#zigg:title       = `Blog`
#zigg:page-title  = `Blog`
#zigg:slug        = `blog`
#zigg:parent      = ``
#zigg:cover-image = `_cover-blog{$size}.png`
#zigg:date        = ``
#zigg:description = `Read the things I've written: from development tricks to workplace tips.`
#zigg:priority    = `0.7`
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

    $coverImage = $props['cover-image'];

    $coverImageString = [];

    foreach($coverImage as $image) {
      array_push($coverImageString, "{$image['url']} {$image['size']}w");
    }

    $coverImageString = implode(',', $coverImageString);

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
          <source data-srcset="{$coverImageString}" type="image/png">
          <img data-src="{$coverImage['medium']['url']}" alt="{$coverAlt}">
        </picture>
      </a>
    </div>
    <div class="content-row__text">
      <h2><a href="{$blog['slug-path']}">{$props['title']}</a></h2>
      <time datetime="{$props['date']} 12:00">{$prettyDate}</time>
      <p>{$props['description']}</p>
      <p><a href="{$blog['slug-path']}" class="readmore">Read more</a></p>
    </div>
  </div>
</div>
HTML;

    $index++;
  }

  ?>
</section>

<?= file_get_contents('template/cta.php'); ?>
