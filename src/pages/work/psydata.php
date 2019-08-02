<?php
#zigg:title       = `PsyData`
#zigg:page-title  = `PsyData`
#zigg:slug        = `psydata`
#zigg:parent      = `work`
#zigg:cover-image = `work/psydata{$size}.jpg`
#zigg:cover-class = ``
#zigg:cover-alt   = `Man sitting at desk looking at screen with the PsyData app open in the browser.`
#zigg:date        = `2019-02-01`
#zigg:description = `Automation in the mental health research field has been an ongoing process at GGZ inGeest. With PsyData I was placing the needs of the users first and developed an innovative data storage and management platform for data managers and researchers.`
#zigg:priority    = `0.5`

$props = $Ziggurat->resolvedPage['properties'];
?>

<section class="page-section">
  <div class="wrap">
    <h1 class="page-title">PsyData</h1>
  </div>

  <div class="content-row">
    <div class="wrap wrap--vertical">
      <p class="highlight-text">Making data management more fun and engaging by applying modern flows with micro interactions and allowing users to connect with each other.</p>
      <div class="picture-wrapper picture-wrapper--highlight">
        <picture class="lazy">
          <source data-srcset="assets/images/work/<?= $props['slug']; ?>-512px.jpg 512w, assets/images/work/<?= $props['slug']; ?>-1024px.jpg 1024w" type="image/jpeg">
          <img data-src="assets/images/work/<?= $props['slug']; ?>-1024px.jpg" alt="<?= $props['cover-alt']; ?>">
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
        <p>PsyData was bursting at the seems: the software didn't have room to meet new demands and feature requests from the users. On top of that, the outdated codebase was becoming unmaintainable.</p>
        <p>The software was based on existing workflows of data managers at GGZ inGeest: data that gets published by the research projects is stored and organised through a system that is supposed to make it easier to browse through. Subsequently, other researchers can request and receive the data after a curatorial process.</p>
        <p>Data managers are administrators of projects, where they can organise, publish and accept data and requests. Researchers are users who mostly request the data, after which there will be a process where data managers verify the request and the researcher's use case through previously submitted analysis plans.</p>
      </div>
    </div>
  </div>

  <div class="content-row">
    <div class="wrap">
      <div class="content-row__text content-row__text--top content-row__text--title">
        <h3>Approach</h3>
      </div>
      <div class="content-row__text">
        <p>Utilising HTML5, CSS3, Node and the WebSocket API I wanted to redesign the platform from the ground up.</p>
        <p>By creating an inventory of the current use cases with the help of the previous developer and the old code base, we designed new flows for data managers and researchers. We focused on making their lives easier by reducing clicks in the interface, creating visual and mental hierarchies of on-screen information and implementing new rules in the system.</p>
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
          <source srcset="assets/images/work/psydata/_psydata_1-512px.png 512w, assets/images/work/psydata/_psydata_1-1024px.png 1024w, assets/images/work/psydata/_psydata_1-1920px.png 1920w" type="image/png">
          <img src="assets/images/work/psydata/_psydata_1-1024px.png" alt="PsyData screenshot">
        </picture>

        <picture class="gallery__picture">
          <source srcset="assets/images/work/psydata/_psydata_2-512px.png 512w, assets/images/work/psydata/_psydata_2-1024px.png 1024w, assets/images/work/psydata/_psydata_2-1920px.png 1920w" type="image/png">
          <img src="assets/images/work/psydata/_psydata_2-1024px.png" alt="PsyData screenshot">
        </picture>

        <picture class="gallery__picture">
          <source srcset="assets/images/work/psydata/_psydata_3-512px.png 512w, assets/images/work/psydata/_psydata_3-1024px.png 1024w, assets/images/work/psydata/_psydata_3-1920px.png 1920w" type="image/png">
          <img src="assets/images/work/psydata/_psydata_3-1024px.png" alt="PsyData screenshot">
        </picture>

        <picture class="gallery__picture">
          <source srcset="assets/images/work/psydata/_psydata_4-512px.png 512w, assets/images/work/psydata/_psydata_4-1024px.png 1024w, assets/images/work/psydata/_psydata_4-1920px.png 1920w" type="image/png">
          <img src="assets/images/work/psydata/_psydata_4-1024px.png" alt="PsyData screenshot">
        </picture>

        <picture class="gallery__picture">
          <source srcset="assets/images/work/psydata/_psydata_5-512px.png 512w, assets/images/work/psydata/_psydata_5-1024px.png 1024w, assets/images/work/psydata/_psydata_5-1920px.png 1920w" type="image/png">
          <img src="assets/images/work/psydata/_psydata_5-1024px.png" alt="PsyData screenshot">
        </picture>
      </div>
    </div>
  </div>
</section>

<?= file_get_contents('template/cta.php'); ?>
