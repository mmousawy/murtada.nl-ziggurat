<?php
#zigg:title       = ``
#zigg:page-title  = ``
#zigg:slug        = `index`
#zigg:class       = `page-home`
#zigg:parent      = ``
#zigg:cover-image = `assets/images/_cover-index{$size}.png`
#zigg:date        = ``
#zigg:description = `I'm a freelance full-stack web developer in Rotterdam. I specialize in creating custom websites, apps and digital products with a focus on UX and interactivity`
#zigg:priority    = `1.0`
?>

<section class="landing-content">
  <div class="wrap">
    <p class="landing-content__title">A fusion of<br>creativity & technology.</p>
    <p class="landing-content__text">I love mixing modern design with my technical insight to build beautiful web-based software.</p>
  </div>
  <div class="scroll-icon-holder">
    <img src="assets/images/_icon-touch.svg" class="scroll-icon scroll-icon--mobile" alt="Swipe to see more">
    <img src="assets/images/_icon-desktop.svg" class="scroll-icon scroll-icon--desktop" alt="Scroll to see more">
  </div>
</section>


<section class="page-section page-section--home-about">
  <a name="about" class="section-link"></a>
  <div class="wrap">
    <h1>Hi! I'm Murtada al Mousawy, a full-stack web developer working in the Rotterdam & Den Haag area.</h1>
  </div>
  <div class="content-row">
    <div class="wrap">
      <div class="picture-wrapper align-left align-left--outside align-left--small">
        <picture class="lazy">
          <source data-srcset="assets/images/photo-cc-512px.jpg 512w, assets/images/photo-cc-1024px.jpg 1024w" type="image/jpeg">
          <img data-src="assets/images/photo-cc-1024px.jpg" alt="Murtada sitting on a couch with his laptop.">
        </picture>
      </div>
      <div class="content-row__text">
        <p>I specialize in translating digital challenges into well thought-out software. I design and develop custom websites, apps and digital platforms, with a focus on UX and interactivity. <a href="about">Read more about me</a>.</p>
        <p>
          <a href="/cv" class="button button--link">Download my CV</a>
        </p>
      </div>
    </div>
  </div>
</section>


<section class="page-section page-section--inverted">
  <a name="work" class="section-link"></a>
  <div class="wrap">
    <h2>Projects I've worked on</h2>
  </div>
  <?php

  $index = 0;

  foreach ($Ziggurat->list('work', true, 2) as $project) {
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
      <p><a href="{$project['slug_path']}" class="readmore readmore--inverted">View the {$props['title']} case</a></p>
    </div>
  </div>
</div>
HTML;

    $index++;
  }

  ?>
  <div class="content-row content-row--end">
    <div class="wrap">
      <div class="content-row__transparent content-row__transparent--centered">
        <a href="work" class="button button--link button--more">
          See more of my work
          <img src="assets/images/_arrow-right.svg" alt="Arrow icon">
        </a>
      </div>
    </div>
  </div>
</section>

<?= file_get_contents('template/cta.php'); ?>
