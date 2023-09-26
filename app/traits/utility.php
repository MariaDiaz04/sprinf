<?php

namespace App\Traits;

use Exception;

/**
 * Trait General para funciones Helpers
 */
trait Utility
{

  /**
   * Creación de llaves RSA
   * Se utiliza el algorimo sha512
   * y se define una creacion de llaves de 4096
   *
   * @return boolean
   */
  function generarLlaves(): void
  {
    $path_to_public = $_ENV['PATH_TO_PUBLIC_KEY'];
    $path_to_private = $_ENV['PATH_TO_PRIVATE_KEY'];

    $config = array(
      "digest_alg" => 'sha512',
      "private_key_bits" => 4096,
      "private_key_type" => OPENSSL_KEYTYPE_RSA,
    );

    // Crear llaves
    $key = openssl_pkey_new($config);
    if (!$key) throw new Exception('Key was not generated');

    // obtener llave privada
    openssl_pkey_export($key, $llavePrivada);

    // obtener llave publica
    $llavePublica = openssl_pkey_get_details($key);
    $llavePublica = $llavePublica["key"];

    // almacenar llaves en directorio seguro especificado
    file_put_contents($path_to_public, $llavePublica);
    file_put_contents($path_to_private, $llavePrivada);
  }

  /**
   * ENCRIPTADO
   *
   * @param [type] $data
   * @return string base64 encoded hash
   */
  public function encriptar($data): string
  {
    $path_to_public = $_ENV['PATH_TO_PUBLIC_KEY'];

    if (!file_exists($path_to_public)) {
      $this->generarLlaves();
    }

    $public_key = openssl_pkey_get_public(file_get_contents($path_to_public));
    $keyData = openssl_pkey_get_details($public_key);
    $pubKey = $keyData['key'];
    openssl_public_encrypt($data, $encrypted, $pubKey);

    return base64_encode($encrypted);
  }

  /**
   * Desencriptado de información
   * espera que el hash esté en formato base65
   *
   * @param [type] $encryptedData
   * @return string|null retorna null en caso de haber un error de desencriptado
   */
  function desencriptar($encryptedData): string | null
  {
    $path_to_private = $_ENV['PATH_TO_PRIVATE_KEY'];
    $private_key = openssl_pkey_get_private(file_get_contents($path_to_private));
    openssl_pkey_export($private_key, $privKey);
    openssl_private_decrypt(base64_decode($encryptedData), $decrypted, $privKey);
    return $decrypted;
  }
}
