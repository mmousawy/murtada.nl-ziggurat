<?php
#zigg:title       = `Products`
#zigg:page-title  = `Products`
#zigg:slug        = `products`
#zigg:parent      = ``
#zigg:cover-image = `assets/images/_cover-products{$size}.png`
#zigg:date        = ``
#zigg:description = `List of products by Murtada webdesign bureau.`
#zigg:priority    = `0.6`
#zigg:cta-text    = `About me`
#zigg:cta-url     = `about`
?>

<section class="page-section page-section--products">
  <div class="wrap">
    <h1 class="page-title">Products I've made.</h1>
    <h2>Hand-written software, created with love&nbsp;&amp;&nbsp;dedication.</h2>
  </div>
  <div class="products">
  <?php

  $index = 0;

  foreach ($Ziggurat->list('products', true) as $project) {
    $props = $project['properties'];

    $class = ($index === 0)
              ? 'picture-wrapper--large'
              : 'picture-wrapper--small';

    $class .= ($index % 2 === 0)
              ? ' align-left align-left--outside'
              : ' align-right align-right--outside';

    echo
<<<HTML
  <a href="{$project['slug_path']}" class="product">
    <div class="product__content">
      <h2>{$props['title']}</h2>
      <p>{$props['description']}</p>
    </div>
    <picture>
      <img src="{$props['logo']}" alt="{$props['cover-alt']}">
    </picture>
  </a>
HTML;

    $index++;
  }

  ?>
  <a class="product product--disabled">
    <div class="product__content">
      <h2>Coming soon</h2>
      <p>More software is being worked on right now!</p>
    </div>
    <picture>
      <img src="assets/images/products/coming-soon.svg" alt="Coming soon rocket icon">
    </picture>
  </a>
</div>
</section>
