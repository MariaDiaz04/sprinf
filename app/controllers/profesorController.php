<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\Request;

use Model\profesor;
use Model\usuario;
use Model\persona;
use Traits\utility;


use Exception;
use PharIo\Manifest\Email;
use PhpParser\Node\Expr\Isset_;
use PHPUnit\Framework\MockObject\DuplicateMethodException;

class profesorController extends controller
{

  use Utility;


  private $profesor;
  private $usuario;
  private $persona;

  function __construct()
  {
    $this->tokenExist();
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
      //var_dump($contrasena);
      // encriptar contraseña de usuario
      $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);

      // creacion de persona

      $cedula = $nuevoprofesor->request->get('cedula');
      $nombre = $nuevoprofesor->request->get('nombre');
      $apellido = $nuevoprofesor->request->get('apellido');
      $direccion = $nuevoprofesor->request->get('direccion');
      $telefono = $nuevoprofesor->request->get('telefono');

      // verificar que no cuente con incripciones ya creadas
      $this->checkData($cedula, $email, 'guardar');

      $this->usuario->setUsuario([
        'rol_id' => 2, // profesores
        'email' => $email,
        'contrasena' => $contrasena
      ]);

      $idUsuario = $this->usuario->save();
      $usuario_id = $idUsuario;
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

  /**
   * Obtiene la informacion necesaria para crear
   * formulario de update retornado en formato JSON
   *
   * @param [type] $request
   * @return void
   */
  function edit($request): void
  {
    try {
      // verificar datos de usuario
      $idUsuario = $_SESSION['usuario_id'];
      $usuario = $this->usuario->find($idUsuario);
      if ($usuario['rol_id'] != 1) {
        throw new Exception('No cuenta con los permisos necesarios');
      }
      $data = [];
      $codigo = $request->get('codigo');
      $profesor = $this->profesor->find($codigo);
      $telefono = $this->desencriptar($profesor['telefono']);
      $direccion = $this->desencriptar($profesor['direccion']);
      $data['profesor'] = $profesor;
      $data['profesor']['telefono'] = $telefono;
      $data['profesor']['direccion'] = $direccion;
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
      // // // encriptar datos de contacto
      $telefono = $this->encriptar($telefono);
      $direccion = $this->encriptar($direccion);
      if (!$profesor = $this->profesor->findByCodigo($cedula)) {
        return $this->page('errors/404');
      };

      // asignar valores de seccion
      $profesor->updateProfesor($nombre, $apellido, $email, $direccion, $telefono, $cedula);
      if (empty($cedula)) throw new Exception('Error inesperado al actualizar el profesor.');
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

      $profesor = $this->profesor->findByCodigo($cedula);
      $codigo = $profesor->fillable['codigo'];
      $usuario_id = $profesor->fillable['usuario_id'];

      // verificar que no cuente con incripciones ya creadas
      $this->checkDataDelete($codigo, 'eliminar');
      // realizar eliminacion
      $result = $this->profesor->deleteTransaction($codigo, $usuario_id);
      return var_dump($result);
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
      echo json_encode($this->profesor->generarSSP());
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode($e->getMessage());
    }
  }

  function checkData(string $cedula, string $email, string $action)
  {
    // verificar que no cuente con insripciones
    if (isset($cedula)) {
      $profesores = $this->profesor->findData('detalles_profesores', 'cedula', $cedula);
      if (count($profesores) > 0) {
        foreach ($profesores as $profesor) {
          if (intval($profesor) > 0) throw new Exception('No se puede ' . $action . ' datos del profesor por que el numero de cedula ' . $cedula . ' ya esta registrado');
        }
        return true;
      }
    }
    if (isset($email)) {
      $profesores = $this->profesor->findData('detalles_usuarios', 'email', $email);
      if (count($profesores) > 0) {
        foreach ($profesores as $profesor) {
          if (intval($profesor) > 0) throw new Exception('No se puede ' . $action . ' datos del profesor por que el email ' . $email . ' ya esta registrado');
        }
        return true;
      }
    }
    if (isset($codigo)) {
      $profesores = $this->profesor->findData('detalles_proyecto', 'codigo', $codigo);
      if (count($profesores) > 0) {
        foreach ($profesores as $profesor) {
          if (intval($profesor) > 0) throw new Exception('No se puede ' . $action . ' el profesor por que ya esta asignado a un proyecto');
        }
        return true;
      } else {
        $profesores = $this->profesor->findData('inscripcion', 'codigo', $codigo);
        if (count($profesores) > 0) {
          foreach ($profesores as $profesor) {
            if (intval($profesor) > 0) throw new Exception('No se puede ' . $action . '  el profesor por que ya esta asignado a una materia');
          }
          return true;
        }
      }
      return true;
    }
  }

  function checkDataDelete(string $codigo, string $action): bool
  {
    if (isset($codigo)) {
      $profesores = $this->profesor->findData('detalles_proyecto', 'tutor_in', $codigo);
      if (count($profesores) > 0) {
        foreach ($profesores as $profesor) {
          if (intval($profesor) > 0) throw new Exception('No se puede ' . $action . ' el profesor por que ya esta asignado a un proyecto');
        }
        return true;
      } else {
        $profesores = $this->profesor->findData('inscripcion', 'profesor_id', $codigo);
        if (count($profesores) > 0) {
          foreach ($profesores as $profesor) {
            if (intval($profesor) > 0) throw new Exception('No se puede ' . $action . '  el profesor por que ya esta asignado a una materia');
          }
          return true;
        }
      }
      return true;
    }
  }
  public function E501()
  {

    return $this->page('errors/501');
  }
}
