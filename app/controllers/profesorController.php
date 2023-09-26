<?php

namespace App\controllers;

use Symfony\Component\HttpFoundation\Request;

use App\profesor;
use App\Traits\Utility;
use Exception;
use Utils\DateValidator;
use Utils\Sanitizer;

class profesorController extends controller
{

  private $profesor;

  use Utility;

  function __construct()
  {
    $this->profesor = new profesor();
  }

  public function index()
  {

    $profesores = $this->profesor->all();

    return $this->view('profesor/gestionar', [
      'profesor' => $profesores,
    ]);
  }

  public function store(Request $nuevoprofesor)
  {
    try {
      DateValidator::checkPeriodDates($nuevoprofesor->get('fecha_inicio'), $nuevoprofesor->get('fecha_cierre'));

      // $this->estudiante->setData($profesor->request->all());

      // $id = $this->estudiante->save();
      $this->profesor->setProfesor($nuevoprofesor->request->all());
      $this->profesor->insertTransaction();

      http_response_code(200);
      // echo json_encode($id);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode($e->getMessage());
    }
  }

  function test(): void
  {
    $path_to_public = $_ENV['PATH_TO_PUBLIC_KEY'];
    $path_to_private = $_ENV['PATH_TO_PRIVATE_KEY'];

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
  }
  function ssp(Request $query): void
  {
    try {
      http_response_code(200);
      echo json_encode($this->profesor->generarSSP());
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode($e->getMessage());
    }
  }

  public function E501()
  {

    return $this->page('errors/501');
  }
  
}
