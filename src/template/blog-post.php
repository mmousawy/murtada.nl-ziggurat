<?php

$prettyDate = date('F jS, Y', strtotime($Ziggurat->resolvedPage['date']));

$coverImage = isset($Ziggurat->resolvedPage['cover-image']) ? $Ziggurat->resolvedPage['cover-image'] : '';

if (strpos($coverImage, '{$size}')) {
  $coverImage = explode('{$size}', $coverImage);
}

$coverImageFile = imagecreatefrompng("assets/images/blog/_usability-testing-512px.png");
$coverColor = imagecolorat($coverImageFile, 1, 1);
$rgb = imagecolorsforindex($coverImageFile, $coverColor);

$coverAlt = isset($Ziggurat->resolvedPage['cover-alt']) ? $Ziggurat->resolvedPage['cover-alt'] : '';

?>
<?= <<<HTML
<div class="blog-header" style="background-color: rgb(${rgb['red']}, ${rgb['green']}, ${rgb['blue']})">
  <div class="picture-wrapper">
  <picture class="lazy">
    <source data-srcset="assets/images/blog/{$coverImage[0]}-512px{$coverImage[1]} 512w, assets/images/blog/{$coverImage[0]}-1024px{$coverImage[1]} 1024w, assets/images/blog/{$coverImage[0]}-1920px{$coverImage[1]} 1920w" type="image/jpeg">
    <img data-src="assets/images/blog/{$coverImage[0]}-1024px{$coverImage[1]}" alt="{$coverAlt}">
  </picture>
  </div>
</div>
HTML;
?>
<section class="page-section">
<div class="wrap wrap--blog">
<h1 class="page-title page-title--align-left"><?= $Ziggurat->resolvedPage['page-title']; ?></h1>
<time datetime="{$props['date']} 12:00"><?= $prettyDate; ?></time>
</div>
<div class="wrap wrap--blog">
<?= $Ziggurat->resolvedPage['content']; ?>
</div>
</section>

<?= file_get_contents('template/cta.php'); ?>
