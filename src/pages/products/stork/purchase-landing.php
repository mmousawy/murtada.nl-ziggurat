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

require_once './lib/PHPMailer/SMTP.php';
require_once './lib/PHPMailer/Exception.php';
require_once './lib/PHPMailer/PHPMailer.php';
require_once './lib/License.php';

$smtpData = json_decode(file_get_contents('../smtp-data.json'), true);

$db = new SQLite3('../murtada_nl.db');

// Get order id
$query = <<<SQL
SELECT
  id,
  order_id,
  email,
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

function getDirContents($path) {
  $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));

  $files = array();
  foreach ($rii as $file)
    if (!$file->isDir())
      $files[] = $file->getPathname();

  return $files;
}

if ($row['status'] !== 'paid') {
  header('Location: https://murtada.nl/products/stork#purchase');
} else if ($row['status'] === 'paid') {
  // Generate license for product
  $license = new MMousawy\License();

  $keys = $license->generate($row['email'], date('Y-m-d', strtotime('+1 year')));

  // Setup download
  $zip = new ZipArchive;
  $files = getDirContents('../product-files/stork');

  $fileId = 'stork_' . base64_encode(uniqid('', true));

  $downloadsFolder = $_SERVER['DOCUMENT_ROOT'] . '/../product-downloads/';

  if (!is_dir($downloadsFolder)) {
    mkdir($downloadsFolder);
  }

  $attachmentFileName = $downloadsFolder . $fileId . '.zip';

  if ($zip->open($attachmentFileName, ZipArchive::CREATE) === TRUE) {
    foreach($files as $file) {
      $zip->addFile($file, str_replace('../product-files/', '', $file));
    }

    $zip->addFromString('stork/stork.php', str_replace('%__PRIVATE_LICENSE__%', $keys['private'], file_get_contents('../product-files/stork/stork.php')));

    $zip->close();
  }

  $bodyText = <<<TXT
Hello,

Thanks for purchasing a copy of Stork! Your license key is:

{$keys['public']}

Download Stork here:
https://murtada.nl/products/stork/download?id={$fileId}

Installing Stork:
Upload the Stork zip file to your plugins folder, or add the plugin through WordPress admin (Plugins > Add New > Upload Plugin).

Entering the license details:
Once Stork is activated in WordPress, enter the license key in the Stork settings page (Settings > Stork settings).

Regards,
The Stork team
TXT;

  // Send email
  $mail = new PHPMailer\PHPMailer\PHPMailer();
  $mail->IsSMTP();
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = 'ssl';

  $mail->Host = $smtpData['host'];
  $mail->Port = $smtpData['port'];
  $mail->Username = $smtpData['username'];
  $mail->Password = $smtpData['password'];

  $mail->SetFrom('no-reply@murtada.nl', 'Stork');
  $mail->Subject = 'Your Stork license';
  $mail->Body = $bodyText;
  $mail->AddAddress($row['email']);

  // Sadly, we cannot attach file due to mail client restrictions with JS files in zip files
  // $mail->addAttachment($attachmentFileName, 'stork.zip');

  if (!$mail->Send()) {
    die($mail->ErrorInfo);
  }
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
