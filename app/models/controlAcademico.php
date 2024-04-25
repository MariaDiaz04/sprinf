<?php

namespace Model;

use Model\model;

use Model\usuario;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;

use Exception;

class controlAcademico extends model
{


  public $fillable = [
    'cedula',
  ];

  private string $cedula;

  public function all()
  {
    try {
      $controlAcademico = $this->select('detalles_control_academico');
      return $controlAcademico ? $controlAcademico : null;
    } catch (Exception $th) {
      return $th;
    }
  }

  /**
   * Retorna los datos del controlAcademico
   *
   * @param [type] $cedula
   * @return array es vacio si no consigue el controlAcademico
   */
  public function find($cedula): array
  {
    $controlAcademico = $this->selectOne("detalles_control_academico", [['cedula', '=', "'$cedula'"]]);
    return !$controlAcademico ? [] : $controlAcademico;
  }

  /**
   * Obtener los detalles de una inscripcion
   * por su código de estudiante
   *
   * @param string $cedula
   * @param string $email
   * @return array - es un array vacio en caso de que no consiga alguna coincidencia
   */
  public function findData(string $tabla,string $campo, string $dato)
  {
    $profesor = $this->select($tabla, [[$campo, '=',  "'$dato'"]]);
    return !$profesor ? [] : $profesor;
  }


  function findByCodigo(string $cedula)
  {
      $profesor = $this->select('detalles_control_academico', [['cedula', '=',  "'$cedula'"]]);;
      if (!!$profesor) {
          foreach ($profesor[0] as $key => $value) {
              $this->fillable[$key] = $value;
          }
          return $this;
      } else {
          return [];
      }
  }


   /**
     * Actualizar información del estudiante
     *
     * @param string $nombre
     * @param string $apellido
     * @param string $email
     * @param string $direccion
     * @param string $telefono
     * @param integer $cedula
     * @return array
     */
    function updateControlAcademico($nombre, $apellido, $email, $direccion, $telefono, $cedula)
    {

        $estudiante = $this->querys('UPDATE usuario, persona SET persona.nombre =  "' . $nombre . '", persona.apellido = "' . $apellido . '" , persona.direccion = "' . $direccion . '", persona.telefono = "' . $telefono . '", usuario.email = "' . $email . '" WHERE persona.usuario_id = usuario.id AND persona.cedula = "' . $cedula . '"');
        return !$estudiante ? [] : $estudiante;
    }
  /**
   * Generar código de profesor
   * (esta funcion se debe ejecutar antes de crear un profesor)
   *
   * @return void
   */
  function setProfesorId(): void
  {
    $this->codigo = 'p-' . $this->persona_id;
  }

  public function setProfesor(array $data)
  {
    foreach ($data as $prof => $value) {

      if (property_exists($this, $prof) && in_array($prof, $this->fillable)) {
        $this->{$prof} = $value;
      }
    }
  }

  public function save($id = null)
  {
    $data = [];

    foreach ($this->fillable as $key => $value) {
      if (isset($this->{$value})) {
        if (is_string($this->{$value})) {
          $data[$value] = '"' . $this->{$value} . '"';
        } else {
          $data[$value] =  $this->{$value};
        }
      }
    }

    if ($id) {
      $this->update('profesor', $data, [['codigo', '=', $id]]);
    } else {
      $this->set('profesor', $data);
      return $this->codigo;
    }
  }

  
    /**
     * Transaccion para el borrado de usuarios
     *
     * @return String
     */
    function deleteTransaction($usuario_id): bool
    {
        try {
            parent::beginTransaction();
            $this->delete('persona', [['usuario_id', '=',  $usuario_id ]]);
            $this->delete('usuario', [['id', '=',  $usuario_id ]]);
            parent::commit();
            return true;
        } catch (Exception $e) {
            parent::rollBack();
            return false;
        }
    }

  /**
   * generarSSP
   * 
   * Generar SSP proveniente de la función de data table
   *
   * @return array
   */
  public function generarSSP(): array
  {
    $columns = array(
      array(
        'db'        => 'cedula',
        'dt'        => 0
      ),
      array(
        'db'        => 'nombre',
        'dt'        => 1
      ),
      array(
        'db'        => 'apellido',
        'dt'        => 2
      ),
      array(
        'db'        => 'email',
        'dt'        => 3
      ),
      array(
        'db'        => 'direccion',
        'dt'        => 4
      ),

    );
    return $this->getSSP('detalles_control_academico', 'cedula', $columns);
  }
}
