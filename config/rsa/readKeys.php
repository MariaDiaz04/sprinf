<?php


$path_to_public = getenv('PATH_TO_PUBLIC_KEY');
$path_to_private = getenv('PATH_TO_PRIVATE_KEY');

var_dump($path_to_private);
// Obtener información de las llaves
$public_key = openssl_pkey_get_public(file_get_contents($path_to_public));
$private_key = openssl_pkey_get_private(file_get_contents($path_to_private));


// Obtener llaves
$keyData = openssl_pkey_get_details($public_key);
openssl_pkey_export($private_key, $privKey);

// usar llaves
$pubKey = $keyData['key'];

$data = '04245293870';

// Encrypt the data to $encrypted using the public key
openssl_public_encrypt($data, $encrypted, $pubKey);


echo $encrypted;

// Decrypt the data using the private key and store the results in $decrypted
openssl_private_decrypt($encrypted, $decrypted, $privKey);

echo $decrypted;
