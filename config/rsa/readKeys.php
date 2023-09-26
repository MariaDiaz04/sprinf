<?php


$path_to_public = 'F:\xampp\htdocs\sprinf\public_key.pem';
$path_to_private = 'F:\xampp\htdocs\sprinf\private_key.pem';

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


$basencrypted = base64_encode($encrypted);
var_dump($basencrypted);

// Decrypt the data using the private key and store the results in $decrypted
openssl_private_decrypt(base64_decode($basencrypted), $decrypted, $privKey);

echo $decrypted;
