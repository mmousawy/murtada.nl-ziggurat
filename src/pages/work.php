<?php
#zigg:title       = `Work`
#zigg:page-title  = `Work`
#zigg:slug        = `work`
#zigg:parent      = ``
#zigg:cover-image = ``
#zigg:date        = ``
#zigg:summary     = ``
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
      <picture class="lazy">
        <source data-srcset="assets/images/work/{$props['slug']}-512px.jpg 512w, assets/images/work/{$props['slug']}-1024px.jpg 1024w" type="image/jpeg">
        <img data-src="assets/images/work/{$props['slug']}-1024px.jpg" alt="{$props['cover-alt']}">
      </picture>
    </div>
    <div class="content-row__text">
      <h2>{$props['title']}</h2>
      <p>{$props['summary']}</p>
      <p><a href="{$project['slug-path']}">Read more about {$props['title']}</a>.</p>
    </div>
  </div>
</div>
HTML;

    $index++;
  }

  ?>
</section>

<?= file_get_contents('template/cta.php'); ?>
