<?php

try {

  $config = array(
    "digest_alg" => 'sha512',
    "private_key_bits" => 4096,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
  );

  // Create the private and public key
  $key = openssl_pkey_new($config);

  if ($msg  = openssl_error_string()) {
    echo $msg . "<br />\n";
  }

  if (!$key) throw new Exception('Key was not generated');
  // Extract the private key from $key to $privKey
  openssl_pkey_export($key, $privKey);

  // Extract the public key from $key to $pubKey
  $pubKey = openssl_pkey_get_details($key);
  $pubKey = $pubKey["key"];



  $data = 'plaintext data goes here';

  // Encrypt the data to $encrypted using the public key
  openssl_public_encrypt($data, $encrypted, $pubKey);

  // Decrypt the data using the private key and store the results in $decrypted
  openssl_private_decrypt($encrypted, $decrypted, $privKey);

  file_put_contents("public_key.pem", $pubKey);
  file_put_contents("private_key.pem", $privKey);

  echo $decrypted;
} catch (Exception $e) {
  echo $e->getMessage();
}
