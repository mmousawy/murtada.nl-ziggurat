<?php
#zigg:title       = `About`
#zigg:page-title  = `About`
#zigg:slug        = `about`
#zigg:parent      = ``
#zigg:cover-image = `_cover-about{$size}.png`
#zigg:date        = ``
#zigg:description = `Read more about me and my personal and professional background.`
#zigg:priority    = `0.5`
?>

<section class="page-section">
  <a name="about" class="section-link"></a>
  <div class="wrap">
    <h1 class="page-title">Murtada al Mousawy, full-stack web developer based in Delft.</h1>
  </div>
  <div class="content-row">
    <div class="wrap">
      <div class="picture-wrapper align-left align-left--outside">
        <picture class="lazy">
          <source srcset="assets/images/photo-cc-512px.jpg 512w, assets/images/photo-cc-1024px.jpg 1024w" type="image/jpeg">
          <img data-src="assets/images/photo-cc-1024px.jpg">
        </picture>
      </div>
      <div class="content-row__text">
        <h2>Why I love my job</h2>
        <p>
          Technology is an inseparable part of daily life. How to (make) use (of) technology has been studied and worked out for many cases.
          Combining design and technology is tricky and there should always be an added value. When a design is implemented correctly, it will be transparent for the user and a reason they'll come back to the same technology again and again.
        </p>
        <p>
          I proudly inspire myself by designers, photographers and artists who have paved the path before me. My secret is that I always try to give my work a little twist!
        </p>
      </div>
    </div>
  </div>

  <div class="content-row">
    <div class="wrap">
      <div class="picture-wrapper align-right align-right--outside">
        <picture class="lazy">
          <source data-srcset="assets/images/photo-laptop-512px.jpg 512w, assets/images/photo-laptop-1024px.jpg 1024w" type="image/jpeg">
          <img data-src="assets/images/photo-laptop-1024px.jpg" alt="">
        </picture>
      </div>
      <div class="content-row__text">
        <h2>How I got here</h2>
        <p>
          The internet landscape went through many changes since I've started experimenting with web technology in 2006. The interactive and visual flexibility to interface designs of Flash formed a basis for my animated and dynamic approach to software development.
        </p>
        <p>
          Along the way, Flash got dropped in favour of HTML5 and in order to make my designs work seamlessly in another technology, I needed a good understanding of the underlying systems.
        </p>
        <p>
          With 3+ years combined company experience and a total of 5+ years (freelance) web experience, I've mastered many fields to fully produce custom websites and web applications.
        </p>
        <p>
          <a href="#" class="button button--link">Download my CV</a>
        </p>
      </div>
    </div>
  </div>

  <div class="content-row">
    <div class="wrap">
      <div class="picture-wrapper align-left align-left--outside">
        <picture class="lazy">
          <source data-srcset="assets/images/photo-wireframe-512px.jpg 512w, assets/images/photo-wireframe-1024px.jpg 1024w" type="image/jpeg">
          <img data-src="assets/images/photo-wireframe-1024px.jpg" alt="">
        </picture>
      </div>
      <div class="content-row__text">
        <h2>My approach</h2>
        <p>
          I try to solve each problem with a human-centered approach. Knowledge and empathy is key in creating products for any end-user. Target audience research, prototyping and testing are skills I use throughout the entire iterative development process.
        </p>
        <p>
          Evaluating each step in the development process is a great way to check if you're still on track and if your requirements will be met. Scrum, Sprints, and Agile are methodologies I'm familiar with and of which I'm a big proponent of.
        </p>
      </div>
    </div>
  </div>
</section>

<?= file_get_contents('template/cta.php'); ?>
