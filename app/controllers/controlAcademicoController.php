<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\Request;

use Model\controlAcademico;
use Model\usuario;
use Model\persona;
use Traits\Utility;
use Model\bitacoraAcciones;


use Exception;
use PharIo\Manifest\Email;
use PhpParser\Node\Expr\Isset_;
use PHPUnit\Framework\MockObject\DuplicateMethodException;

class controlAcademicoController extends controller
{

  use Utility;


  private $controlAcademico;
  private $usuario;
  private $persona;
  public $ACCIONES;


  function __construct()
  {
    $this->tokenExist();
    $this->controlAcademico = new controlAcademico();
    $this->usuario = new usuario();
    $this->persona = new persona();
    $this->ACCIONES = new bitacoraAcciones();

  }

  public function index()
  {

    $controlAcademico = $this->controlAcademico->all();
    $this->ACCIONES->lastSave($this->modulo_controlAcademico,$this->accion_consultar);

    return $this->view('controlAcademico/gestionar', [
      'controlAcademico' => $controlAcademico,
    ]);
  }

  public function store(Request $nuevoControlAcademico)
  {

    try {
      // DateValidator::checkPeriodDates($nuevoControlAcademico->get('fecha_inicio'), $nuevoControlAcademico->get('fecha_cierre'));

      // creación de usuario
      $email = $nuevoControlAcademico->request->get('email');
      $contrasena = $nuevoControlAcademico->request->get('contrasena');
      // encriptar contraseña de usuario
      $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);

      // creacion de persona

      $cedula = $nuevoControlAcademico->request->get('cedula');
      $nombre = $nuevoControlAcademico->request->get('nombre');
      $apellido = $nuevoControlAcademico->request->get('apellido');
      $direccion = $nuevoControlAcademico->request->get('direccion');
      $telefono = $nuevoControlAcademico->request->get('telefono');

      // verificar que no cuente con incripciones ya creadas
      $this->checkData($cedula, $email, 'guardar');

      $this->usuario->setUsuario([
        'rol_id' => 6, // controlAcademicoes
        'email' => $email,
        'contrasena' => $contrasena
      ]);

      $idUsuario = $this->usuario->save();
      $usuario_id = $idUsuario;
      // // // encriptar datos de contacto
  /*     $telefono = $this->encriptar($telefono);
      $direccion = $this->encriptar($direccion); */


      $this->persona->setPersona([
        'cedula' => $cedula,
        'usuario_id' => $usuario_id,
        'nombre' => $nombre,
        'apellido' => $apellido,
        'direccion' => $direccion,
        'telefono' => $telefono,
      ]);

      $idPersona = $this->persona->save();


      $this->ACCIONES->lastSave($this->modulo_controlAcademico,$this->accion_insertar);

      http_response_code(200);
      echo json_encode($idPersona);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode($e->getMessage());
    }
  }

  function showDetails(Request $controlAcademico): void
  {
    try {
      // verificar datos de usuario
      $idUsuario = $_SESSION['usuario_id'];
      $usuario = $this->usuario->find($idUsuario);
      if ($usuario['rol_id'] != 1) {
        throw new Exception('No cuenta con los permisos necesarios');
      }

      $cedula = $controlAcademico->request->get('cedula');
    
      $controlAcademico = $this->controlAcademico->find($cedula);
   
    /*   $telefono = $this->desencriptar($controlAcademico['telefono']);
      $direccion = $this->desencriptar($controlAcademico['direccion']); */
      $this->ACCIONES->lastSave($this->modulo_controlAcademico,$this->accion_consultar);

      http_response_code(200);
      echo json_encode([
        'telefono' => $controlAcademico['telefono'],
        'direccion' => $controlAcademico['direccion']
      ]);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode($e->getMessage());
    }
  }

  /**
   * Obtiene la informacion necesaria para crear
   * formulario de update retornado en formato JSON
   *
   * @param [type] $request
   * @return void
   */
  function edit(Request $request): void
  {
    try {
      // verificar datos de usuario
      $idUsuario = $_SESSION['usuario_id'];
      $usuario = $this->usuario->find($idUsuario);
      if ($usuario['rol_id'] != 1) {
        throw new Exception('No cuenta con los permisos necesarios');
      }
      $data = [];
      $cedula = $request->get('cedula');
      $controlAcademico = $this->controlAcademico->find($cedula);
     /*  $telefono = $this->desencriptar($controlAcademico['telefono']);
      $direccion = $this->desencriptar($controlAcademico['direccion']); */
      $data['controlAcademico'] = $controlAcademico;
      http_response_code(200);
      echo json_encode($data);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode($e->getMessage());
    }
  }

  public function update($request)
  {
    try {

      $cedula = $request->get('cedula');
      $nombre = $request->get('nombre');
      $apellido = $request->get('apellido');
      $email = $request->get('email');
      $direccion = $request->get('direccion');
      $telefono = $request->get('telefono');
   
      if (!$controlAcademico = $this->controlAcademico->findByCodigo($cedula)) {
        return $this->page('errors/404');
      };

      // asignar valores de seccion
      $controlAcademico->updateControlAcademico($nombre, $apellido, $email, $direccion, $telefono, $cedula);
      $this->ACCIONES->lastSave($this->modulo_controlAcademico,$this->accion_actualizar);

      if (empty($cedula)) throw new Exception('Error inesperado al actualizar el controlAcademico.');
      http_response_code(200);
      echo json_encode($cedula);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode($e->getMessage());
    }
  }


  public function delete($request)
  {

    try {
      $cedula = $request->get('cedula');

      $controlAcademico = $this->controlAcademico->findByCodigo($cedula);
      $usuario_id = $controlAcademico->fillable['usuario_id'];


      // realizar eliminacion
      $result = $this->controlAcademico->deleteTransaction($usuario_id);
      $this->ACCIONES->lastSave($this->modulo_controlAcademico,$this->accion_eliminar);
     
      if (!$result) throw new Exception('Error inesperado al borrar el estudiante.');
      http_response_code(200);
      echo json_encode($cedula);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode($e->getMessage());
    }
  }

  function ssp(Request $query): void
  {
    try {
      http_response_code(200);
      echo json_encode($this->controlAcademico->generarSSP());
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode($e->getMessage());
    }
  }

  function checkData(string $cedula, string $email, string $action)
  {
    // verificar que no cuente con insripciones
    if (isset($cedula)) {
      $controlAcademicos = $this->controlAcademico->findData('detalles_control_academico', 'cedula', $cedula);
      if (count($controlAcademicos) > 0) {
        foreach ($controlAcademicos as $controlAcademico) {
          if (intval($controlAcademico) > 0) throw new Exception('No se puede ' . $action . ' datos del control academico  por que el numero de cedula ' . $cedula . ' ya esta registrado');
        }
        return true;
      }
    }
    if (isset($email)) {
      $controlAcademicos = $this->controlAcademico->findData('detalles_control_academico', 'email', $email);
      if (count($controlAcademicos) > 0) {
        foreach ($controlAcademicos as $controlAcademico) {
          if (intval($controlAcademico) > 0) throw new Exception('No se puede ' . $action . ' datos del control academico por que el email ' . $email . ' ya esta registrado');
        }
        return true;
      }
    }
  }

 /*  function checkDataDelete(string $codigo, string $action): bool
  {
    if (isset($codigo)) {
      $controlAcademicoes = $this->controlAcademico->findData('detalles_proyecto', 'tutor_in', $codigo);
      if (count($controlAcademicoes) > 0) {
        foreach ($controlAcademicoes as $controlAcademico) {
          if (intval($controlAcademico) > 0) throw new Exception('No se puede ' . $action . ' el controlAcademico por que ya esta asignado a un proyecto');
        }
        return true;
      } else {
        $controlAcademicoes = $this->controlAcademico->findData('inscripcion', 'controlAcademico_id', $codigo);
        if (count($controlAcademicoes) > 0) {
          foreach ($controlAcademicoes as $controlAcademico) {
            if (intval($controlAcademico) > 0) throw new Exception('No se puede ' . $action . '  el controlAcademico por que ya esta asignado a una materia');
          }
          return true;
        }
      }
      return true;
    }
  } */
  public function E501()
  {

    return $this->page('errors/501');
  }
}
