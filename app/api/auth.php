<?php

namespace API;

use App\usuario;
use App\controllers\controller;
use App\Traits\Utility;

use Firebase\JWT\JWT;

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
      $correo = trim($credenciales->request->get('correo'));
      $contrasena = $credenciales->request->get('contrasena');

      $infoUsuario = $this->usuarios->findByEmail($correo);

      if (!$infoUsuario || !password_verify($contrasena, $infoUsuario['contrasena'])) {
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

        echo json_encode($jwt);
      }
    } catch (\Exception $th) {
      http_response_code(500);
      echo json_encode($th->getMessage());
    }
  }
}
