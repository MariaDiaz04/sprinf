<?php

namespace App\controllers;

use Symfony\Component\HttpFoundation\Request;

use App\profesor;
use App\usuario;
use App\persona;
use App\Traits\Utility;


use Exception;
use PHPUnit\Framework\MockObject\DuplicateMethodException;

class profesorController extends controller
{

  use Utility;


  private $profesor;
  private $usuario;
  private $persona;

  function __construct()
  {
    $this->profesor = new profesor();
    $this->usuario = new usuario();
    $this->persona = new persona();
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
      // DateValidator::checkPeriodDates($nuevoprofesor->get('fecha_inicio'), $nuevoprofesor->get('fecha_cierre'));

      // creación de usuario
      $email = $nuevoprofesor->request->get('email');
      $contrasena = $nuevoprofesor->request->get('contrasena');
      
      // encriptar contraseña de usuario
       $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);

      $this->usuario->setUsuario([
        'rol_id' => 2, // profesores
        'email' => $email,
        'contrasena' => $contrasena
      ]);

      

      $idUsuario = $this->usuario->save();

      // creacion de persona

      $cedula = $nuevoprofesor->request->get('cedula');
      $usuario_id = $idUsuario;
      $nombre = $nuevoprofesor->request->get('nombre');
      $apellido = $nuevoprofesor->request->get('apellido');
      $direccion = $nuevoprofesor->request->get('direccion');
      $telefono = $nuevoprofesor->request->get('telefono');

                  // // // encriptar datos de contacto
                  $telefono = $this->encriptar($telefono);
                  $direccion = $this->encriptar($direccion); 
      

      $this->persona->setPersona([
        'cedula' => $cedula,
        'usuario_id' => $usuario_id,
        'nombre' => $nombre,
        'apellido' => $apellido,
        'direccion' => $direccion,
        'telefono' => $telefono,
      ]);
      

      


      $idPersona = $this->persona->save();

      $this->profesor->setProfesor(['persona_id' => $idPersona]);
      $this->profesor->setProfesorId();
      $codigoProfesor = $this->profesor->save();


      http_response_code(200);
      echo json_encode($codigoProfesor);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode($e->getMessage());
    }
  }

  function showDetails(Request $profesor): void
  {
    try {
      // verificar datos de usuario
      $idUsuario = $_SESSION['usuario_id'];
      $usuario = $this->usuario->find($idUsuario);
      if ($usuario['rol_id'] != 1) {
        throw new Exception('No cuenta con los permisos necesarios');
      }

      $codigoProfesor = $profesor->request->get('codigo');

      $profesor = $this->profesor->find($codigoProfesor);
      $telefono = $this->desencriptar($profesor['telefono']);
      $direccion = $this->desencriptar($profesor['direccion']);

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
