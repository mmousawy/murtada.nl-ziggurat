<?php

$props = $currentPage['properties'];
$date = $props['date'];

$prettyDate = date('F jS, Y', strtotime($props['date']));

$coverImage = $props['cover-image'];
$coverImageWebp = $props['cover-image-webp'];

$coverImageString = [];
$coverImageStringWebp = [];

$rgb = [255, 255, 255];

if ($coverImage) {
  $imageUrl = $coverImage['small']['url'];

  if (file_exists($imageUrl)) {
    if (function_exists('imagecreatefrompng')) {
      $coverImageFile = imagecreatefrompng($imageUrl);
      $coverColor = imagecolorat($coverImageFile, 1, 1);
      $rgb = imagecolorsforindex($coverImageFile, $coverColor);
    } else if (class_exists('Imagick')) {
      $coverImageFile = new Imagick($imageUrl);
      $coverColor = $coverImageFile->getImagePixelColor(1, 1);
      $rgb = $coverColor->getColor();
    }

    $rgb = array_values($rgb);
  }

  foreach($coverImageWebp as $imageWebp) {
    array_push($coverImageStringWebp, "{$imageWebp['url']} {$imageWebp['size']}w");
  }

  foreach($coverImage as $image) {
    array_push($coverImageString, "{$image['url']} {$image['size']}w");
  }
}

$coverImageStringWebp = implode(',', $coverImageStringWebp);
$coverImageString = implode(',', $coverImageString);

$coverAlt = isset($props['cover-alt']) ? $props['cover-alt'] : '';

?>
<?= <<<HTML
<div class="blog-header" style="background-color: rgb(${rgb[0]}, ${rgb[1]}, ${rgb[2]})">
  <div class="picture-wrapper">
    <picture class="lazy">
      <source data-srcset="{$coverImageStringWebp}" type="image/webp">
      <source data-srcset="{$coverImageString}" type="image/png">
      <img data-src="{$coverImage['medium']['url']}" alt="{$coverAlt}">
    </picture>
  </div>
</div>
HTML;
?>
<section class="page-section">
<div class="wrap wrap--blog">
<h1 class="page-title page-title--align-left"><?= $props['page-title']; ?></h1>
<div class="blog-meta">
  <time class="blog-meta__publish-date" datetime="<?= $date ?> 12:00"><img src="inline:assets/images/_icon-calendar.svg" alt="Calendar icon"><?= $prettyDate ?></time>
  <span class="blog-meta__avg-time"><img src="inline:assets/images/_icon-time.svg" alt="Time icon"><?= round($currentPage['properties']['avg_time']) ?> min reading time</span>
</div>
</div>
<div class="wrap wrap--blog">
<?= $currentPage['content']; ?>
</div>
</section>

<?= file_get_contents('template/cta.php'); ?>

<script src="script/lib/zoom.min.js" defer></script>
