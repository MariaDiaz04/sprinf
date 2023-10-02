<?php

namespace API;

use App\usuario;
use App\controllers\controller;

use Symfony\Component\HttpFoundation\Request;

class auth extends controller
{

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
        http_response_code(401);
        echo json_encode('Unauthorized');
      } else {

        $data = [
          'correo' => $correo,
          'contrasena' => $contrasena
        ];
        echo json_encode($data);
      }
    } catch (\Exception $th) {
      http_response_code(500);
      echo json_encode($th->getMessage());
    }
  }
}
