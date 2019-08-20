<?php

namespace MMousawy;

class License
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

  function generate($payload, $expires)
  {
    $result = openssl_pkey_new($this->config);

    // Extract the private key
    openssl_pkey_export($result, $privateKey);

    // Extract the public key
    $key = openssl_pkey_get_details($result)['key'];

    $fullPayload = json_encode([
      'payload' => $payload,
      'expires' => $expires
    ]);

    // Encrypt using the public key
    openssl_public_encrypt($fullPayload, $encrypted, $key);

    $publicKey = bin2hex($encrypted);

    $this->privateKey = $privateKey;
    $this->publicKey = $publicKey;

    return [
      'private' => $privateKey,
      'public' => $publicKey
    ];
  }

  function validate($payload)
  {
    if ($this->privateKey === null) {
      return false;
    }

    set_error_handler(function() { /* ignore errors */ });
    // Decrypt the data using the private key
    openssl_private_decrypt(hex2bin($this->publicKey), $decrypted, $this->privateKey);

    restore_error_handler();

    $this->valid = $payload === $decrypted ;
  }
}
