<?php
#zigg:ignore
#zigg:slug        = `update-payment`
#zigg:parent      = `stork`

$db = new SQLite3('../murtada_nl.db');

$mollieData = json_decode(file_get_contents('../mollie-data.json'), true);

$update = false;

if (!isset($currentPaymentId)) {
  if (isset($_POST['id'])) {
    $currentPaymentId = $_POST['id'];

    $update = true;

    $bearer = $mollieData['key'];

    // Get order ID
    $query = <<<SQL
SELECT
  id,
  order_id,
  status
FROM
  `payments`
WHERE
  id = :id
LIMIT 1
SQL;

    $st = $db->prepare($query);
    $st->bindValue(':id', $currentPaymentId);

    $results = $st->execute();

    $row = $results->fetchArray();

    $currentPaymentOrderId = $row[1];
  }
}

if (!isset($currentPaymentId) || !isset($currentPaymentOrderId)) {
  echo 'No ID provided';
  exit;
}

function requestPayment($method, $requestUri, $payload = null, $bearer)
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

  return $data === null ? [] : $data;
}

$data = requestPayment('GET', 'https://api.mollie.com/v2/payments/' . $currentPaymentId, null, $bearer);

// Save id and status in DB
if (!$update) {
  $query = <<<SQL
INSERT INTO
  payments
  (
    id,
    order_id,
    status,
    name,
    email
  )
VALUES
  (
    :id,
    :order_id,
    :status,
    :name,
    :email
  );
}
SQL;

  $st = $db->prepare($query);
  $st->bindValue(':id', $data['id']);
  $st->bindValue(':status', $data['status']);
  $st->bindValue(':order_id', $currentPaymentOrderId);
  $st->bindValue(':name', $_POST['name']);
  $st->bindValue(':email', $_POST['email']);

} else {

  error_log('>>> NOW UPDATING: ' . $currentPaymentId);

  $query = <<<SQL
UPDATE
  payments
SET
  status = :status
WHERE
  id = :id
SQL;

  $st = $db->prepare($query);
  $st->bindValue(':status', $data['status']);
  $st->bindValue(':id', $data['id']);
}

$st->execute();
