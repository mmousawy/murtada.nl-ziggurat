<?php

$prettyDate = date('F jS, Y', strtotime($Ziggurat->resolvedPage['date']));

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
