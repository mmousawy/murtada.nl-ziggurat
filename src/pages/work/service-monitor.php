<?php
#zigg:title       = `Service Monitor`
#zigg:page-title  = `Service Monitor`
#zigg:slug        = `service-monitor`
#zigg:parent      = `work`
#zigg:cover-image = `work/service-monitor{$size}.jpg`
#zigg:cover-class = ``
#zigg:cover-alt   = `Hand holding a phone with the Service Monitor app visible on screen.`
#zigg:date        = `2018-08-01`
#zigg:description = `Staying on top of the availability of your websites is a must. Using third-party software would be an okay option, but we wanted full control. That's why we built an application that monitors the uptime and latency of our websites and web applications.`
#zigg:priority    = `0.5`

$props = $currentPage['properties'];
?>

<section class="page-section">
  <div class="wrap">
    <h1 class="page-title">Service Monitor</h1>
  </div>

  <div class="content-row">
    <div class="wrap wrap--vertical">
      <p class="highlight-text">Get critical availability insights and early alerts for web products.</p>
      <div class="picture-wrapper picture-wrapper--highlight">
        <picture class="lazy">
          <source data-srcset="assets/images/work/<?= $props['slug']; ?>-hero-512px.jpg 512w, assets/images/work/<?= $props['slug']; ?>-hero-1024px.jpg 1024w" type="image/jpeg">
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
            <source data-srcset="assets/images/work/psydata/_psydata-diagram-512px.png 512w, assets/images/work/psydata/_psydata-diagram-1024px.png 1024w" type="image/png">
            <img data-src="assets/images/work/psydata/_psydata-diagram-1024px.png" alt="Use case diagram for the PsyData project" data-action="zoom">
          </picture>
          <figcaption class="picture-wrapper__caption">Use case diagram for PsyData illustrating the main actors, their associations and their interactions.</figcaption>
        </figure>
        <p>We separated the limiting data-structures of one-to-one data models like "users-to-projects", "files-to-projects" and so on. By doing that, we essentially made it easier for groups of people to work together whenever they need to, by allowing data managers to include in, or exclude people from projects and groups. This also opened a new door to subscription models and trial-accounts for monetisation.</p>
        <figure class="picture-wrapper">
          <picture class="lazy">
            <source data-srcset="assets/images/work/psydata/psydata-flow-512px.jpg 512w, assets/images/work/psydata/psydata-flow-1024px.jpg 1024w" type="image/jpeg">
            <img data-src="assets/images/work/psydata/psydata-flow-1024px.jpg" alt="User flow diagram of: login, register, create project, add data, request data, respond to request" data-action="zoom">
          </picture>
          <figcaption class="picture-wrapper__caption">User flow diagram of: login, register, create project, add data, request data, respond to request.</figcaption>
        </figure>
        <p>The UI redesign was built form the ground up with a natural direction of reading in mind. Everything has to flow from top to bottom, with the most relevant information at the top. We also separated interactions and forms by layering those elements on top of the current page. This made it less jarring and very clear whenever a user is prompted for input.</p>
        <figure class="picture-wrapper">
          <picture class="lazy">
            <source data-srcset="assets/images/work/psydata/_psydata-search-512px.png 512w, assets/images/work/psydata/_psydata-search-1024px.png 1024w" type="image/png">
            <img data-src="assets/images/work/psydata/_psydata-search-1024px.png" alt="Screenshot of the filter feature in the PsyData app" data-action="zoom">
          </picture>
          <figcaption class="picture-wrapper__caption">Screenshot of the "filter through column" feature in PsyData.</figcaption>
        </figure>
        <p>Users of PsyData also had some other requests, besides the redesign of the data management and request flow. They requested a clearer sense of human interaction by having more direct communication with each other through the application. In the previous version, all communication was conducted through e-mail, outside the application itself. With the new version, we aimed for more context and hierarchy in communication by implementing direct messaging (chatting) and allowing users to leave notes whenever they request, respond to requests or modify data.</p>
      </div>
    </div>
  </div>

  <div class="content-row">
    <div class="wrap">
      <div class="content-row__text content-row__text--top content-row__text--title">
        <h3>Results</h3>
      </div>
      <div class="content-row__text">
        <p>With the redesign, we've achieved what we initially set out to do: make it easier for data managers and researchers to find their way through the application. Creating a new project, adding users and uploading their first data set to the repository is four clicks, and two screens away.</p>
        <p>Designing for the users' intuitions drew a clear path for us to make design decisions: the users lead the way!</p>
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
          <source srcset="assets/images/work/service-monitor/_service-monitor-1-512px.png 512w, assets/images/work/service-monitor/_service-monitor-1-1024px.png 1024w, assets/images/work/service-monitor/_service-monitor-1-1920px.png 1920w" type="image/png">
          <img src="assets/images/work/service-monitor/_service-monitor-1-1024px.png" alt="Service Monitor screenshot">
        </picture>
      </div>
    </div>
  </div>
</section>

<?= file_get_contents('template/cta.php'); ?>
<script src="script/lib/zoom.min.js" defer></script><script src="script/lib/flickity.min.js"></script>
