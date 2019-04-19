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

  foreach ($Ziggurat->list('work', true) as $project) {
    $props = $project['properties'];

    echo
<<<HTML
<div class="content-row">
  <div class="wrap">
    <div class="picture-wrapper {$props['cover-class']}">
      <picture class="lazy">
        <source data-srcset="assets/images/work/{$props['slug']}-512px.jpg 512w, assets/images/work/{$props['slug']}-1024px.jpg 1024w" type="image/jpeg">
        <img data-src="assets/images/work/{$props['slug']}-1024px.jpg" alt="{$props['cover-alt']}">
      </picture>
    </div>
    <div class="content-row__text">
      <h3>{$props['title']}</h3>
      <p>{$props['summary']}</p>
      <p><a href="#">Read more about {$props['title']}</a>.</p>
    </div>
  </div>
</div>
HTML;

  }

  ?>
</section>

<section id="contact" class="page-section page-section--contact">
  <div class="wrap">
    <h2>Did I spark your interest?</h2>
    <h3>Let's work together! Drop me a line at:</h3>
    <div class="content-row__transparent content-row__transparent--centered">
      <a href="" class="button button--contact">
        info
      </a>
      <a href="" class="copy-to-clipboard copy-to-clipboard--right copy-to-clipboard--email tooltip-right">
        <img src="assets/images/_copy-to-clipboard.svg">
        Copy
      </a>
    </div>
  </div>
</section>
