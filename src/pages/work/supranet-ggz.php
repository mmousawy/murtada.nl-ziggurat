<?php
#zigg:title       = `SUPRANET GGZ`
#zigg:page-title  = `Supranet GGZ`
#zigg:slug        = `supranet-ggz`
#zigg:parent      = `work`
#zigg:cover-image = `assets/images/work/supranet-ggz{$size}.jpg`
#zigg:cover-image-webp = `assets/images/work/supranet-ggz{$size}.webp`
#zigg:cover-class = ``
#zigg:cover-alt   = `SUPRANET GGZ logo with a backdrop of a blurred network of connected lines joined by circles and people.`
#zigg:date        = `2018-02-01`
#zigg:description = `SUPRANET GGZ is a network for and by mental health professionals that strives for fewer suicides due to better care.</p><p>As an initiative of multiple mental health care organisations, the website was built from scratch for a clear and organised repository for the innovative way of suicide prevention.`
#zigg:priority    = `0.5`

$props = $currentPage['properties'];
?>

<section class="page-section">
  <div class="wrap">
    <h1 class="page-title">SUPRANET GGZ</h1>
  </div>

  <div class="content-row">
    <div class="wrap wrap--vertical">
      <p class="highlight-text">A digital homebase for an innovative suicide prevention collective.</p>
      <div class="picture-wrapper picture-wrapper--highlight">
        <picture class="lazy">
          <source data-srcset="assets/images/work/<?= $props['slug']; ?>-hero-512px.webp 512w, assets/images/work/<?= $props['slug']; ?>-hero-1024px.webp 1024w, assets/images/work/<?= $props['slug']; ?>-hero-1920px.webp 1920w" type="image/webp">
          <source data-srcset="assets/images/work/<?= $props['slug']; ?>-hero-512px.jpg 512w, assets/images/work/<?= $props['slug']; ?>-hero-1024px.jpg 1024w, assets/images/work/<?= $props['slug']; ?>-hero-1920px.jpg 1920w" type="image/jpeg">
          <img data-src="assets/images/work/<?= $props['slug']; ?>-hero-1024px.jpg" alt="<?= $props['cover-alt']; ?>">
        </picture>
      </div>
    </div>
  </div>

  <div class="content-row">
    <div class="wrap">
      <div class="content-row__text content-row__text--top content-row__text--title">
        <h3>Background</h3>
      </div>
      <div class="content-row__text">
        <p>SupranetGGZ is an initiative of multiple suicide prevention organizations, aimed at significantly lowering the suicide rate by delivering better mental health care.</p>
        <p>The care of potential suicide victims is very inconsistent amongst different healthcare institutions. Since healthcare organizations are competitors on the market, they have a sense to guard their "business practices". This results in slow adaptation of successful or new care methodologies and the measurable lower success rate for some healthcare institutions.</p>
        <p>SupranetGGZ aims to create a constructive environment where health care organizations are motivated to communicate openly and open channels for the sharing of emerging methods for the care of suicide victims.</p>
        <p>We took up the task to design and build their website with two separate sections: public pages and a members section. The public pages mainly serve for informing the general public and potential members. And the members area is used for sharing data between multiple organizations through their own profile page and through subscription channels in the system.</p>
      </div>
    </div>
  </div>

  <div class="content-row">
    <div class="gallery">
      <div class="gallery__overlay">
        <div class="gradient gradient--left"></div>
        <div class="gradient gradient--right"></div>
      </div>
      <div class="gallery__pane">
        <picture class="gallery__picture">
          <source srcset="assets/images/work/supranet/supranet-ggz-desktop-512px.webp 512w, assets/images/work/supranet/supranet-ggz-desktop-1024px.webp 1024w, assets/images/work/supranet/supranet-ggz-desktop-1920px.webp 1920w" type="image/webp">
          <source srcset="assets/images/work/supranet/supranet-ggz-desktop-512px.png 512w, assets/images/work/supranet/supranet-ggz-desktop-1024px.png 1024w, assets/images/work/supranet/supranet-ggz-desktop-1920px.png 1920w" type="image/png">
          <img src="assets/images/work/supranet/supranet-ggz-desktop-1024px.png" alt="SupranetGGZ screenshot">
        </picture>
      </div>
    </div>
  </div>
</section>

<?= file_get_contents('template/cta.php'); ?>
<script src="script/lib/zoom.min.js" defer></script><script src="script/lib/flickity.min.js"></script>
