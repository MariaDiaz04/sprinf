<?php

namespace Traits;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

use Exception;
use stdClass;

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
    if (!$private_key || empty($private_key)) {
      throw new Exception('No se pudo extraer la llave privada');
    }

    $resultKeyExport = openssl_pkey_export($private_key, $privKey);
    if (!$resultKeyExport) throw new Exception('Error exporting key');

    $result = openssl_private_decrypt(base64_decode($encryptedData), $decrypted, $privKey);
    if (!$result) {
      throw new Exception('Error en desencriptado');
    }
    return $decrypted;
  }

  function obtenerTokenJWT(): stdClass|bool
  {
    try {
      $headers  = apache_request_headers();

      $key = 'CLAVE_DE_APLICACION';
      if (!isset($headers['Authorization']) && !isset($headers['authorization'])) {
        throw new Exception('Peticion no autenticada');
      }

      $jwt = (!isset($headers['Authorization'])) ? explode(" ", $headers['authorization'])[1] : explode(" ", $headers['Authorization'])[1];
      $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

      return $decoded;
    } catch (Exception $th) {
      http_response_code(401);
      echo json_encode(
        [
          'error' => $th->getMessage(),
          'status' => 'error'
        ]
      );
      return false;
    }
  }

  /**
   * LIMPIAR DATOS
   */
  public function limpiaCadena($cadena)
  {
    $cadena = trim($cadena); //Elimina espacios al inicio y al final de la cadena
    $cadena = stripcslashes($cadena); //Elimina Barras Invertidas de la cadena
    $cadena = str_replace('<script>', '', $cadena);
    $cadena = str_replace('</script>', '', $cadena);
    $cadena = str_replace('<script src', '', $cadena);
    $cadena = str_replace('<script type', '', $cadena);
    $cadena = str_replace('SELECT * FROM', '', $cadena);
    $cadena = str_replace('DELETE FROM', '', $cadena);
    $cadena = str_replace('INSERT INTO', '', $cadena);
    $cadena = str_replace('--', '', $cadena);
    $cadena = str_replace('^', '', $cadena);
    $cadena = str_replace('(', '', $cadena);
    $cadena = str_replace(')', '', $cadena);
    $cadena = str_replace('[', '', $cadena);
    $cadena = str_replace(']', '', $cadena);
    $cadena = str_replace('{', '', $cadena);
    $cadena = str_replace('}', '', $cadena);
    $cadena = str_replace('==', '', $cadena);

    return $cadena;
  }
}
