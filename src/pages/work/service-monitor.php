<?php
#zigg:title       = `Service Monitor`
#zigg:page-title  = `Service Monitor`
#zigg:slug        = `service-monitor`
#zigg:parent      = `work`
#zigg:cover-image = `assets/images/work/service-monitor{$size}.jpg`
#zigg:cover-image-webp = `assets/images/work/service-monitor{$size}.webp`
#zigg:cover-class = ``
#zigg:cover-alt   = `Hand holding a phone with the Service Monitor app visible on screen.`
#zigg:date        = `2018-08-01`
#zigg:description = `Staying on top of the availability of your websites is a must. Using third-party software would be an okay option, but we wanted full control. That's why we built an application that monitors the uptime and latency of our websites and web applications.`
#zigg:priority    = `0.5`

$props = $currentPage['properties'];
?>

<section class="page-section">
  <div class="wrap wrap--work">
    <h1 class="page-title">Service Monitor</h1>
  </div>

  <div class="content-row">
    <div class="wrap wrap--vertical">
      <p class="highlight-text">Get critical availability insights and early alerts for web products.</p>
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
        <h3>Case</h3>
      </div>
      <div class="content-row__text">
        <p>At one point our web team had a lot of digital products they needed to keep an eye on. There was a lot of time and effort spent checking and validating every product's availability. Also, being the first to get notified when a product is unreachable would be a great plus. Getting an email from a frustrated client who lets us know their website is offline is never fun.</p>
        <p>After a fruitful brainstorm session, our team was tasked to finalize the concepts, and then design and develop a multi-purpose testing platform that does the following:</p>
        <ol>
          <li>Create and update assertions for testing.</li>
          <li>Assertions can have an expected result and can be given protocols on which the tests will be performed.</li>
          <li>Hierarchical step-based automatic testing and reporting based on assertion and protocol.</li>
          <li>Web-based accessible interface with an interactive overview of all product with their respective assertions, test results and other relevant info.</li>
        </ol>
      </div>
    </div>
  </div>

  <div class="content-row">
    <div class="wrap">
      <div class="content-row__text content-row__text--top content-row__text--title">
        <h3>Approach</h3>
      </div>
      <div class="content-row__text">
        <p>Sketching, brainstorming and forming lots of ideas are all meant to diverge the scope. To create a big overview of all the options we choose and directions we can go. So that's exactly what we did! We created a couple of lists and sketches forming the fundamental concept for our product. We took our most important needs and matched them to features we had in our lists. In a way, we formed our minimum viable product, our MVP!</p>
        <figure class="picture-wrapper">
          <picture class="lazy">
            <source data-srcset="assets/images/work/service-monitor/service-monitor-sketch-512px.webp 512w, assets/images/work/service-monitor/service-monitor-sketch-1024px.webp 1024w, assets/images/work/service-monitor/service-monitor-sketch-1920px.webp 1920w" type="image/webp">
            <source data-srcset="assets/images/work/service-monitor/service-monitor-sketch-512px.png 512w, assets/images/work/service-monitor/service-monitor-sketch-1024px.png 1024w, assets/images/work/service-monitor/service-monitor-sketch-1920px.png 1920w" type="image/png">
            <img data-src="assets/images/work/service-monitor/service-monitor-sketch-1024px.png" alt="Early sketches for Service Monitor." data-action="zoom">
          </picture>
          <figcaption class="picture-wrapper__caption">Early sketches for Service Monitor.</figcaption>
        </figure>
        <p>My next task was to work out the sketches to a design, ready to be implemented for the prototype.</p>
        <figure class="picture-wrapper">
          <picture class="lazy">
            <source data-srcset="assets/images/work/service-monitor/service-monitor-design-512px.webp 512w, assets/images/work/service-monitor/service-monitor-design-1024px.webp 1024w, assets/images/work/service-monitor/service-monitor-design-1920px.webp 1920w" type="image/webp">
            <source data-srcset="assets/images/work/service-monitor/service-monitor-design-512px.png 512w, assets/images/work/service-monitor/service-monitor-design-1024px.png 1024w, assets/images/work/service-monitor/service-monitor-design-1920px.png 1920w" type="image/png">
            <img data-src="assets/images/work/service-monitor/service-monitor-design-1024px.png" alt="Early sketches for Service Monitor." data-action="zoom">
          </picture>
          <figcaption class="picture-wrapper__caption">Early sketches for Service Monitor.</figcaption>
        </figure>
        <p>Development was performed in iterations, or sprints, where we decided on a weekly basis what features had to be implemented. This approach gave us an overhead view of how all the modules and components (should) work together and motivated us to write classes for each part of the product.</p>
        <p>The front end was written from scratch with modularity in mind, with a few plugins where necessary: <a href="https://atomiks.github.io/tippyjs/" rel="noopener">Tippy.js</a> for tooltips and our own <a href="https://github.com/mmousawy/collapsible" rel="noopener">Collapsible</a> for asynchronous expanding and collapsing of HTML elements.</p>
      </div>
    </div>
  </div>

  <div class="content-row">
    <div class="wrap">
      <div class="content-row__text content-row__text--top content-row__text--title">
        <h3>Results</h3>
      </div>
      <div class="content-row__text">
        <p>Service Monitor was a fun and challenging project, but it was created with love and it shows! Together with <a href="https://joran.rood.me/" rel="noopener">Joran Rood</a> I set out to conceptualize, design and develop an intuitive, simple yet fully-featured service monitor.</p>
        <p>With the configurability of the system, you can extend to test many of your services on the web. And with the web-based user interface it's easy to have an overview of all the operational (or offline) web apps and websites at a glance!</p>
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
          <source srcset="assets/images/work/service-monitor/service-monitor-1-512px.webp 512w, assets/images/work/service-monitor/service-monitor-1-1024px.webp 1024w, assets/images/work/service-monitor/service-monitor-1-1920px.webp 1920w" type="image/webp">
          <source srcset="assets/images/work/service-monitor/service-monitor-1-512px.png 512w, assets/images/work/service-monitor/service-monitor-1-1024px.png 1024w, assets/images/work/service-monitor/service-monitor-1-1920px.png 1920w" type="image/png">
          <img src="assets/images/work/service-monitor/service-monitor-1-1024px.png" alt="Service Monitor screenshot">
        </picture>
        <picture class="gallery__picture">
          <source srcset="assets/images/work/service-monitor/service-monitor-2-512px.webp 512w, assets/images/work/service-monitor/service-monitor-2-1024px.webp 1024w, assets/images/work/service-monitor/service-monitor-2-1920px.webp 1920w" type="image/webp">
          <source srcset="assets/images/work/service-monitor/service-monitor-2-512px.png 512w, assets/images/work/service-monitor/service-monitor-2-1024px.png 1024w, assets/images/work/service-monitor/service-monitor-2-1920px.png 1920w" type="image/png">
          <img src="assets/images/work/service-monitor/service-monitor-2-1024px.png" alt="Service Monitor screenshot">
        </picture>
      </div>
    </div>
  </div>
</section>

<?= file_get_contents('template/cta.php'); ?>
<script src="script/lib/zoom.min.js" defer></script><script src="script/lib/flickity.min.js"></script>
