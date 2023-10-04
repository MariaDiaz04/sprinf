<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\Request;

use Model\estudiante;
use Model\usuario;
use Model\persona;
use Traits\Utility;
use Exception;
use Utils\DateValidator;
use Utils\Sanitizer;

use PHPUnit\Framework\MockObject\DuplicateMethodException;

class estudianteController extends controller
{

  use Utility;

  private $estudiante;
  private $usuario;
  private $persona;

  function __construct()
  {
    $this->estudiante = new estudiante();
    $this->usuario = new usuario();
    $this->persona = new persona();
  }

  public function index()
  {

    $estudiantes = $this->estudiante->all();

    return $this->view('estudiantes/gestionar', [
      'estudiante' => $estudiantes,
    ]);
  }

  public function store(Request $newestudiante)
  {
    try {
      // DateValidator::checkPeriodDates($newestudiante->get('fecha_inicio'), $newestudiante->get('fecha_cierre'));

      // creación de usuario
      $email = $newestudiante->request->get('email');
      $contrasena = $newestudiante->request->get('contrasena');
      var_dump($contrasena);

      // encriptar contraseña de usuario
      $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);

      $this->usuario->setUsuario([
        'rol_id' => 4, // estudiantes
        'email' => $email,
        'contrasena' => $contrasena
      ]);

      $idUsuario = $this->usuario->save();

      // creacion de persona

      $cedula = $newestudiante->request->get('cedula');
      $usuario_id = $idUsuario;
      $nombre = $newestudiante->request->get('nombre');
      $apellido = $newestudiante->request->get('apellido');
      $direccion = $newestudiante->request->get('direccion');
      $telefono = $newestudiante->request->get('telefono');


      $this->persona->setPersona([
        'cedula' => $cedula,
        'usuario_id' => $usuario_id,
        'nombre' => $nombre,
        'apellido' => $apellido,
        'direccion' => $direccion,
        'telefono' => $telefono,
      ]);

      $idPersona = $this->persona->save();

      $this->estudiante->setestudiante(['persona_id' => $idPersona]);
      $this->estudiante->setestudianteId();
      $idestudiante = $this->estudiante->save();


      http_response_code(200);
      echo json_encode($idestudiante);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode($e->getMessage());
    }
  }

  function showDetails(Request $estudiante): void
  {
    try {
      // verificar datos de usuario
      $idUsuario = $_SESSION['usuario_id'];
      $usuario = $this->usuario->find($idUsuario);
      if ($usuario['rol_id'] != 1) {
        throw new Exception('No cuenta con los permisos necesarios');
      }

      $codigoestudiante = $estudiante->request->get('codigo');

      $estudiante = $this->estudiante->find($codigoestudiante);
      $telefono = $this->desencriptar($estudiante['telefono']);
      $direccion = $this->desencriptar($estudiante['direccion']);

      http_response_code(200);
      echo json_encode([
        'telefono' => $telefono,
        'direccion' => $direccion
      ]);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode($e->getMessage());
    }
  }

  function ssp(Request $query): void
  {
    try {
      http_response_code(200);
      echo json_encode($this->estudiante->generarSSP());
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
