<?php
#zigg:title       = `BIONIC`
#zigg:page-title  = `BIONIC`
#zigg:slug        = `bionic`
#zigg:parent      = `work`
#zigg:cover-image = `assets/images/work/bionic{$size}.jpg`
#zigg:cover-image-webp = `assets/images/work/bionic{$size}.webp`
#zigg:cover-class = ``
#zigg:cover-alt   = `Male hand holding a phone with the BIONIC documentation visible on the screen.`
#zigg:date        = `2017-08-01`
#zigg:description = `Creating surveys can be a difficult task, especially if existing tools are too archaic. For BBMRI I've developed a custom survey building application, complete with an innovative survey creation syntax, data export and statistics.`
#zigg:priority    = `0.5`

$props = $currentPage['properties'];
?>

<section class="page-section">
  <div class="wrap wrap--work">
    <h1 class="page-title">BIONIC</h1>
  </div>

  <div class="content-row">
    <div class="wrap wrap--vertical">
      <p class="highlight-text">Create complex surveys, obtain results and export data, all in one spot.</p>
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
        <p>BIObanks Netherlands Internet Collaboration (BIONIC) is an observational cohort study that aims to provide a platform to harmonize rapid phenotypic measures in Dutch biobank cohorts, and to link these phenotypic measures to existing biobank data.</p>
        <p>A big part of the project is based on a digital questionnaire where focused questions are presented and gathered from the target audience.</p>
        <p>My task was to develop a web application with which it is possible to design and build a fully functional questionnaire. After distribution, respondents can respond the answers through an interactive and dynamic interface and submit their responses through the platform.</p>
        <p>The platform allows datamanagers and research assistants of cohorts to maintain an extensive system to build and distribute questionnaires with the following features:</p>
        <ul>
          <li>Setting up new questionnaires and creating respondents accounts for administering the questionnaires</li>
          <li>Setting up different cohort groups and data management accounts for the separation of collected data		</li>
          <li>Give statistical overviews and insight and export of collected data</li>
        </ul>
      </div>
    </div>
  </div>

  <div class="content-row">
    <div class="wrap">
      <div class="content-row__text content-row__text--top content-row__text--title">
        <h3>Approach</h3>
      </div>
      <div class="content-row__text">
        <p>This project needed a large and performant encrypted database where I chose to work with MariaDB and encrypt every response with a key. Since we had over 250.000 responses with a JSON structured response, every response was also gzipped to limit database size.</p>
        <p>The survey creation, distribution and gathering interface was built from scratch in vanilla JavaScript and LESS. But a future iteration made me drop LESS for SCSS, because of its extensive featureset.</p>

        <figure class="picture-wrapper picture-wrapper--has-shadow">
          <div class="picture-column">
            <picture class="lazy">
              <source data-srcset="assets/images/work/bionic/bionic-interaction-elements-1024px.webp 1024w, assets/images/work/bionic/bionic-interaction-elements-1920px.webp 1920w" type="image/webp">
              <source data-srcset="assets/images/work/bionic/bionic-interaction-elements-1024px.png 1024w, assets/images/work/bionic/bionic-interaction-elements-1920px.png 1920w" type="image/png">
              <img data-src="assets/images/work/bionic/bionic-interaction-elements-1920px.png" data-action="zoom" alt="Overview of custom interaction elements for BIONIC">
            </picture>
          </div>
          <figcaption class="picture-wrapper__caption">Since a varied target audience would be filling out the survey, design of the custom interaction elements were made with respondents of all age groups in mind.</figcaption>
        </figure>

        <p>Since the response data was really large, the database was queried in chunks at intervals so the system would still be responsive. When the whole dataset is retrieved, users are able to filter and export the data in multiple formats including CSV, XSL and SPSS.
        <p>Researches needed to create surveys from scratch, where answers could affect future questions (routing) and complex conditions could change the structure of the survey. So I came up with a custom solution: a custom survey structure syntax.</p>

        <figure class="picture-wrapper picture-wrapper--outside">
          <div class="picture-column">
            <picture class="lazy">
              <source data-srcset="assets/images/work/bionic/bionic-dtd-hierarchy-1024px.webp 1024w, assets/images/work/bionic/bionic-dtd-hierarchy-1920px.webp 1920w" type="image/webp">
              <source data-srcset="assets/images/work/bionic/bionic-dtd-hierarchy-1024px.png 1024w, assets/images/work/bionic/bionic-dtd-hierarchy-1920px.png 1920w" type="image/png">
              <img data-src="assets/images/work/bionic/bionic-dtd-hierarchy-1920px.png" data-action="zoom" alt="The custom BIONIC survey syntax structure hierarchy and code sample">
            </picture>
          </div>
          <figcaption class="picture-wrapper__caption">The custom BIONIC survey syntax structure hierarchy and code sample.</figcaption>
        </figure>

        <p>The custom code syntax is based on XML and uses a document type definition (DTD) to declare the markup of the document. Opting for a custom code syntax instead of a conventional drag & drop interface came from two problems document structure and interactions are all in plain-text and can be easily edited, refactored and duplicated.</p>

        <figure class="picture-wrapper picture-wrapper--outside picture-wrapper--left">
          <div class="picture-column">
            <picture class="lazy">
              <source data-srcset="assets/images/work/bionic/bionic-code-to-survey-1024px.webp 1024w, assets/images/work/bionic/bionic-code-to-survey-1920px.webp 1920w" type="image/webp">
              <source data-srcset="assets/images/work/bionic/bionic-code-to-survey-1024px.png 1024w, assets/images/work/bionic/bionic-code-to-survey-1920px.png 1920w" type="image/png">
              <img data-src="assets/images/work/bionic/bionic-code-to-survey-1920px.png" data-action="zoom" alt="On the left you can see code written in the BIONIC syntax, and on the right the result: a fully functional survey presented on a phone">
            </picture>
          </div>
          <figcaption class="picture-wrapper__caption">From code to survey. On the left you can see the code that generates the survey on the right, fully functional with custom conditions that evaluate when certain answers are given.</figcaption>
        </figure>
      </div>
    </div>
  </div>

  <div class="content-row">
    <div class="wrap">
      <div class="content-row__text content-row__text--top content-row__text--title">
        <h3>Results</h3>
      </div>
      <div class="content-row__text">
        <p>Projects with multiple challenges create opportunities for professional growth and require out-of-the-box thinking.</p>
        <p>The web app was successfully deployed and multiple surveys has been filled out by over 176.000 respondents.</p>
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
          <source srcset="assets/images/work/bionic/screenshot-1-512px.webp 512w, assets/images/work/bionic/screenshot-1-1024px.webp 1024w, assets/images/work/bionic/screenshot-1-1920px.webp 1920w" type="image/webp">
          <source srcset="assets/images/work/bionic/screenshot-1-512px.png 512w, assets/images/work/bionic/screenshot-1-1024px.png 1024w, assets/images/work/bionic/screenshot-1-1920px.png 1920w" type="image/png">
          <img src="assets/images/work/bionic/screenshot-1-1024px.png" alt="Bionic screenshot">
        </picture>
        <picture class="gallery__picture">
          <source srcset="assets/images/work/bionic/screenshot-2-512px.webp 512w, assets/images/work/bionic/screenshot-2-1024px.webp 1024w, assets/images/work/bionic/screenshot-2-1920px.webp 1920w" type="image/webp">
          <source srcset="assets/images/work/bionic/screenshot-2-512px.png 512w, assets/images/work/bionic/screenshot-2-1024px.png 1024w, assets/images/work/bionic/screenshot-2-1920px.png 1920w" type="image/png">
          <img src="assets/images/work/bionic/screenshot-2-1024px.png" alt="Bionic screenshot">
        </picture>
        <picture class="gallery__picture">
          <source srcset="assets/images/work/bionic/screenshot-3-512px.webp 512w, assets/images/work/bionic/screenshot-3-1024px.webp 1024w, assets/images/work/bionic/screenshot-3-1920px.webp 1920w" type="image/webp">
          <source srcset="assets/images/work/bionic/screenshot-3-512px.png 512w, assets/images/work/bionic/screenshot-3-1024px.png 1024w, assets/images/work/bionic/screenshot-3-1920px.png 1920w" type="image/png">
          <img src="assets/images/work/bionic/screenshot-3-1024px.png" alt="Bionic screenshot">
        </picture>
        <picture class="gallery__picture">
          <source srcset="assets/images/work/bionic/screenshot-4-512px.webp 512w, assets/images/work/bionic/screenshot-4-1024px.webp 1024w, assets/images/work/bionic/screenshot-4-1920px.webp 1920w" type="image/webp">
          <source srcset="assets/images/work/bionic/screenshot-4-512px.png 512w, assets/images/work/bionic/screenshot-4-1024px.png 1024w, assets/images/work/bionic/screenshot-4-1920px.png 1920w" type="image/png">
          <img src="assets/images/work/bionic/screenshot-4-1024px.png" alt="Bionic screenshot">
        </picture>
      </div>
    </div>
  </div>
</section>

<?= file_get_contents('template/cta.php'); ?>
<script src="script/lib/zoom.min.js" defer></script><script src="script/lib/flickity.min.js"></script>
