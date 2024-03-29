<?php
#zigg:title       = `Blog`
#zigg:page-title  = `Blog`
#zigg:slug        = `blog`
#zigg:parent      = ``
#zigg:cover-image = `assets/images/og/_cover-blog{$size}.png`
#zigg:date        = ``
#zigg:description = `Read the things I've written about web development, web design, digital architecture and workplace tips.`
#zigg:priority    = `0.7`
?>

<section class="page-section">
  <a name="about" class="section-link"></a>
  <div class="wrap">
    <h1 class="page-title">Things I've written.</h1>
    <h2>From development tricks to workplace tips.</h2>
  </div>

  <?php

  $index = 0;

  foreach ($Ziggurat->list('blog', true) as $post) {
    $props = $post['properties'];

    $prettyDate = date('F jS, Y', strtotime($props['date']));

    $coverImage = $props['cover-image'];
    $coverImageWebp = $props['cover-image-webp'];

    $coverImageString = [];
    $coverImageStringWebp = [];

    foreach($coverImageWebp as $imageWebp) {
      array_push($coverImageStringWebp, "{$imageWebp['url']} {$imageWebp['size']}w");
    }

    foreach($coverImage as $image) {
      array_push($coverImageString, "{$image['url']} {$image['size']}w");
    }

    $coverImageStringWebp = implode(',', $coverImageStringWebp);
    $coverImageString = implode(',', $coverImageString);

    $coverAlt = isset($props['cover-alt']) ? $props['cover-alt'] : '';

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
      <a href="{$post['slug_path']}">
        <picture class="lazy">
          <source data-srcset="{$coverImageStringWebp}" type="image/webp">
          <source data-srcset="{$coverImageString}" type="image/png">
          <img data-src="{$coverImage['medium']['url']}" alt="{$coverAlt}">
        </picture>
      </a>
    </div>
    <div class="content-row__text">
      <h2><a href="{$post['slug_path']}">{$props['title']}</a></h2>
HTML;
?>
      <div class="blog-meta">
        <time class="blog-meta__publish-date" datetime="<?= $props['date'] ?> 12:00"><img src="inline:assets/images/_icon-calendar.svg" alt="Calendar icon"><?= $prettyDate ?></time>
        <span class="blog-meta__avg-time"><img src="inline:assets/images/_icon-time.svg" alt="Time icon"><?= round($post['properties']['avg_time']) ?> min</span>
      </div>
<?php echo <<<HTML
      <p>{$props['description']}</p>
      <p><a href="{$post['slug_path']}" class="readmore">Read more</a></p>
    </div>
  </div>
</div>
HTML;

    $index++;
  }

  ?>
</section>

<?= file_get_contents('template/cta.php'); ?>
