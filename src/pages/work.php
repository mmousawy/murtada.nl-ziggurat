<?php
#zigg:title       = `Work`
#zigg:page-title  = `Work`
#zigg:slug        = `work`
#zigg:parent      = ``
#zigg:cover-image = `assets/images/_cover-work{$size}.png`
#zigg:date        = ``
#zigg:description = `Portfolio of featured projects I've worked on. Download my CV and more.`
#zigg:priority    = `0.6`
?>

<section class="page-section">
  <a name="about" class="section-link"></a>
  <div class="wrap">
    <h1 class="page-title">Projects I've worked on.</h1>
  </div>

  <?php

  $index = 0;

  foreach ($Ziggurat->list('work', true) as $project) {
    $props = $project['properties'];

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
      <a href="{$project['slug_path']}">
        <picture class="lazy">
          <source data-srcset="assets/images/work/{$props['slug']}-512px.jpg 512w, assets/images/work/{$props['slug']}-1024px.jpg 1024w" type="image/jpeg">
          <img data-src="assets/images/work/{$props['slug']}-1024px.jpg" alt="{$props['cover-alt']}">
        </picture>
      </a>
    </div>
    <div class="content-row__text">
      <h2><a href="{$project['slug_path']}">{$props['title']}</a></h2>
      <p>{$props['description']}</p>
      <p><a href="{$project['slug_path']}" class="readmore">View the {$props['title']} case</a></p>
    </div>
  </div>
</div>
HTML;

    $index++;
  }

  ?>
</section>
<?= file_get_contents('template/cta.php'); ?>
