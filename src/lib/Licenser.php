<?php

namespace MMousawy;

class Licenser
{
  function __construct($privateKey = null, $publicKey = null)
  {
    $this->config = array(
      'digest_alg' => 'sha512',
      'private_key_bits' => 1024,
      'private_key_type' => \OPENSSL_KEYTYPE_RSA,
    );

    $this->privateKey = $privateKey;
    $this->publicKey = $publicKey;
    $this->valid = false;
  }

  function generateKeys()
  {
    $result = openssl_pkey_new($this->config);

    // Extract the private key
    openssl_pkey_export($result, $privateKey);

    // Extract the public key
    $publicKey = openssl_pkey_get_details($result)['key'];

    $this->privateKey = $privateKey;
    $this->publicKey = $publicKey;

    return [
      'private' => $this->privateKey,
      'public' => $this->publicKey
    ];
  }

  function getKeys()
  {
    return [
      'private' => $this->privateKey,
      'public' => $this->publicKey
    ];
  }

  function encrypt($payload, $expires)
  {
    $fullPayload = json_encode([
      'payload' => $payload,
      'expires' => $expires
    ]);

    // Encrypt using the public key
    openssl_private_encrypt($fullPayload, $encrypted, $this->privateKey);

    $encrypted = bin2hex($encrypted);

    return $encrypted;
  }

  function validate($email, $encryptedPayload)
  {
    if ($this->publicKey === null) {
      return false;
    }

    if (isset($encryptedPayload)) {
      $encryptedPayload = hex2bin(trim(preg_replace('/\s\s+/', '', $encryptedPayload)));
    } else {
      return false;
    }

    if (!$encryptedPayload) {
      return false;
    }

    set_error_handler(function() { /* ignore errors */ });
    // Decrypt the data using the private key
    openssl_public_decrypt($encryptedPayload, $decrypted, $this->publicKey);

    $data = json_decode($decrypted, true);

    restore_error_handler();

    $this->valid = $email === $data['payload'];
    $this->expired = date('Y-m-d') > \DateTime::createFromFormat('Y-m-d', $data['expires']);

    return $this->valid;
  }
}
