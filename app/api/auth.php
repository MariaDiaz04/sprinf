<?php

namespace API;

use Model\usuario;
use Model\proyecto;
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
        echo json_encode('Credenciales Incorrectas');
      } else {

        $ahora = strtotime("now");

        $key = 'CLAVE_DE_APLICACION';
        $payload = [
          'exp' => $ahora + 6000000,
          'data' => [
            'id' => $infoUsuario['id'],
            'rol' => $infoUsuario['rol_id']
          ]
        ];

        $jwt = JWT::encode($payload, $key, 'HS256');


        $encryptedResponse = $this->encriptar(json_encode([
          'request_token' => $jwt,
          'userData' => [
            'id' => (int)$infoUsuario['id'],
            'email' => $infoUsuario['email'],
            'nombre' => $infoUsuario['nombre'],
            'apellido' => $infoUsuario['apellido'],
            'rol' => (int)$infoUsuario['rol_id'],
          ]
        ]));

        echo json_encode($encryptedResponse);
      }
    } catch (\Exception $th) {
      http_response_code(500);
      echo json_encode($th->getMessage());
    }
  }
}
