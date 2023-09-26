<?php

namespace App\Traits;


/**
 * Trait General para funciones Helpers
 */
trait Utility
{
  /**
   * ENCRIPTADO
   */
  public function encriptar($data): string
  {
    $path_to_public = $_ENV['PATH_TO_PUBLIC_KEY'];

    $public_key = openssl_pkey_get_public(file_get_contents($path_to_public));
    $keyData = openssl_pkey_get_details($public_key);
    $pubKey = $keyData['key'];
    openssl_public_encrypt($data, $encrypted, $pubKey);

    return $encrypted;
  }

  function Desencriptar($encryptedData): string
  {
    $path_to_private = $_ENV['PATH_TO_PRIVATE_KEY'];
    $private_key = openssl_pkey_get_private(file_get_contents($path_to_private));
    openssl_pkey_export($private_key, $privKey);
    openssl_private_decrypt($encryptedData, $decrypted, $privKey);
    return $decrypted;
  }
}
