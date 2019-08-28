<?php
#zigg:ignore
#zigg:slug        = `checkout`
#zigg:parent      = `products/stork`
#zigg:priority    = `0`

header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

$mollieData = json_decode(file_get_contents('../mollie-data.json'), true);

$response = [
  'success' => false,
  'message' => ''
];

function request($method, $requestUri, $payload = null, $bearer, &$response)
{
  if (isset($payload)) {
    $payload = http_build_query($payload);
  }

  $opts = [
    'http' => [
      'method' => $method,
      'header' => 'Authorization: Bearer ' . $bearer . PHP_EOL
        . 'Content-type: application/x-www-form-urlencoded' . PHP_EOL,
      'content' => $payload
    ]
  ];

  $context = stream_context_create($opts);
  $returnedData = file_get_contents($requestUri, false, $context);

  if (empty($returnedData)) {
    throw new RuntimeException('Empty response received for path: "' . $requestUri . '"');
  }

  $data = json_decode((string) $returnedData, true);

  if (JSON_ERROR_NONE !== json_last_error()) {
    throw new RuntimeException('Unable to parse response body into JSON: '
    . json_last_error()
    . PHP_EOL
    . 'Returned data: '
    . $returnedData
    . PHP_EOL);
  }

  $response['success'] = true;

  return $data === null ? [] : $data;
}

$bearer = $mollieData['key'];

$currentPaymentOrderId = bin2hex(openssl_random_pseudo_bytes(16));

// Set up payload
$payload = $mollieData['products']['stork']['payment'];
$payload['redirectUrl'] .= $currentPaymentOrderId;
$payload['metadata']['order_id'] = $currentPaymentOrderId;

$data = request('POST', 'https://api.mollie.com/v2/payments', $payload, $bearer, $response);

$currentPaymentId = $data['id'];

$response['data'] = $data;

// Save id and status in DB
require 'update-payment.php';

echo json_encode($response);

exit;
