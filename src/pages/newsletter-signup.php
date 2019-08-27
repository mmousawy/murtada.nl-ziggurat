<?php
#zigg:ignore
#zigg:slug   = `newsletter-signup`

header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

$response = [
  'success' => false,
  'message' => ''
];

$_POST = json_decode(file_get_contents('php://input'), true) ?: [];

$emailHeaders = [
  // 'MIME-Version' => '1.0',
  'Content-type' => 'text/plain; charset=utf-8',
  'From'         => 'Murtada webdesign bureau <no-reply@murtada.nl>',
  'Reply-To'     => 'Murtada webdesign bureau <info@murtada.nl>'
];

if (!empty($_POST['email'])) {
  $adminBody = <<<TXT
Hi Murtada,

Someone just signed up for the newsletter with e-mail address:
  {$_POST['email']}

Beep boop,
Murtada.nl bot
TXT;


  $userBody = <<<TXT
Hi there,

Thanks for showing interest in our products!

We'll let you know when there is news and when there are updates.
If you're not interested anymore, reply to this e-mail with a quick "not interested" as the body.

Sincerely,
Murtada webdesign bureau
TXT;

  // To admin
  if (mail(
    'info@murtada.nl',
    'Newsletter signup',
    $adminBody,
    $emailHeaders
  )) {

    // To user
    if (mail(
      $_POST['email'],
      'Confirmation: signup for newsletter',
      $userBody,
      $emailHeaders
    )) {
      $response['success'] = true;
    } else {
      $response['message'] = 'Could not send e-mail to user';
    }
  } else {
    $response['message'] = 'Could not send e-mail to admin';
  }
} else {
  $response['message'] = 'E-mail address was missing';
}

echo json_encode($response);

exit();
