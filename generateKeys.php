$parametros=array(
"config"=›"C: /xampp/php/extras/openss1/openss1.cnf"
"private key bits"->2048,
"default md"=› "sha256)

$res= openssl_pkey_new($parametros)

// asi la llve privada de la primera declaracion
openssl_pkey_export($res, $privkey, null, $paremtros );

// asi la llve publica de la primera declaracion
$pubkey=openssl_pkey_get_details($res);

file_put_contents('private.key',$privKey); 
file_put_contents('public.key',$pubkey['key']);