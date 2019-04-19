<?php
#zigg:title       = ``
#zigg:page-title  = ``
#zigg:slug        = `index`
#zigg:parent      = ``
#zigg:cover-image = ``
#zigg:date        = ``
#zigg:summary     = ``
?>

<section class="landing-content">
  <div class="wrap">
    <p class="landing-content__title">A fusion of<br>creativity &amp; technology.</p>
    <p class="landing-content__text">I love blending modern design with my technical insight to make beautiful software.</p>
  </div>
  <div class="scroll-icon-holder">
    <img src="assets/images/_icon-touch.svg" class="scroll-icon scroll-icon--mobile" alt="Swipe to see more">
    <img src="assets/images/_icon-desktop.svg" class="scroll-icon scroll-icon--desktop" alt="Scroll to see more">
  </div>
</section>


<section class="page-section page-section--home-about">
  <a name="about" class="section-link"></a>
  <div class="wrap">
    <h2>Hi, I'm Murtada al Mousawy, a full-stack web developer based in the Netherlands.</h2>
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

  foreach ($Ziggurat->list('work', true, 2) as $project) {
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
      <p><a href="{$project['slug-path']}">Read more about {$props['title']}</a>.</p>
    </div>
  </div>
</div>
HTML;

  }

  ?>
  <div class="content-row content-row--end">
    <div class="wrap">
      <div class="content-row__transparent content-row__transparent--centered">
        <a href="work" class="button button--link button--more">
          See more of my work
          <img src="assets/images/_arrow-right.svg">
        </a>
      </div>
    </div>
  </div>
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
