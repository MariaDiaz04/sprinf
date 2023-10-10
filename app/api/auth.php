<?php

namespace API;

use Model\usuario;
use Controllers\controller;
use Traits\Utility;

use Firebase\JWT\JWT;
use PHPUnit\Util\Json;
use Symfony\Component\HttpFoundation\Request;

class auth extends controller
{

  use Utility;

  public $usuarios;

  function __construct()
  {
    $this->usuarios = new usuario();
  }

  function login(Request $credenciales): void
  {
    try {
      $data = $credenciales->toArray();
      // $correo = trim($data['data']);

      $data = json_decode($this->desencriptar($data['data']));
      $infoUsuario = $this->usuarios->findByEmail($data->correo);

      if (!$infoUsuario || !password_verify($data->contrasena, $infoUsuario['contrasena'])) {
        http_response_code(400);
        echo json_encode('Bad Request');
      } else {

        $ahora = strtotime("now");

        $key = 'CLAVE_DE_APLICACION';
        $payload = [
          'exp' => $ahora + 3600,
          'data' => [
            'id' => $infoUsuario['id'],
            'rol' => $infoUsuario['rol_id']
          ]
        ];

        $jwt = JWT::encode($payload, $key, 'HS256');


        $encryptedToken = $this->encriptar($jwt);

        echo json_encode(['request_token' => $encryptedToken]);
      }
    } catch (\Exception $th) {
      http_response_code(500);
      echo json_encode($th->getMessage());
    }
  }
}
