<?php
#zigg:title       = `Stork purchased`
#zigg:page-title  = `Stork purchased`
#zigg:slug        = `purchase-landing`
#zigg:parent      = `stork`
#zigg:logo        = `assets/images/products/stork/stork-logo.svg`
#zigg:cover-image = `_cover-stork{$size}.png`
#zigg:cover-alt   = `Stork logo`
#zigg:date        = ``
#zigg:description = `Secure file upload and mana&shy;gement in WordPress, made easy.`
#zigg:priority    = `0.1`
#zigg:class       = `is-inverted`
#zigg:cta-text    = `More products`
#zigg:cta-url     = `products`

$db = new SQLite3('../murtada_nl.db');

// Get order id
$query = <<<SQL
SELECT
  id,
  order_id,
  status
FROM
  `payments`
WHERE
  order_id = :order_id
LIMIT 1
SQL;

$st = $db->prepare($query);
$st->bindValue(':order_id', $_GET['order_id']);

$results = $st->execute();

$row = $results->fetchArray();

if ($row['status'] !== 'paid') {
  header('Location: https://murtada.nl/products/stork#purchase');
}

?>
<section class="page-section page-section--product-purchase">
  <div class="wrap">
    <h1>Thank you for your purchase!</h1>
    <h3 class="feature__title">
      Check your inbox
    </h3>
    <br>
    <p class="feature__content">You'll be receiving instructions about how to install and register your license in an e-mail shortly.</p>
  </div>
</section>

<section id="newsletter-form" class="product-signup">
  <div class="pre-signup">
    <h2>Subscribe to our newsletter</h2>
    <p>Drop your e-mail and you'll be the first to hear when there are updates!</p>
    <form>
      <fieldset>
        <div class="fieldset-flex">
          <input type="email" name="product_signup_email" required>
          <button type="submit" class="signup-button"></button>
        </div>
      </fieldset>
    </form>
    <p class="defaultscript">We will only contact you when there is news about our products or services.</p>
  </div>
  <div class="post-signup" hidden>
    <h2>Thank you for your interest!</h2>
    <p>We'll let you know when there's exciting news about our products. ✨</p>
  </div>
</section>
