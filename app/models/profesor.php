<?php

namespace Model;

use Model\model;

use Model\usuario;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;

use Exception;

class profesor extends model
{


  public $fillable = [
    'codigo',
    'persona_id',
  ];

  private string $codigo;
  private string $persona_id;

  public function all()
  {
    try {
      $estudiantes = $this->select('detalles_profesores');
      return $estudiantes ? $estudiantes : null;
    } catch (Exception $th) {
      return $th;
    }
  }

  /**
   * Retorna los datos del profesor
   *
   * @param [type] $codigo
   * @return array es vacio si no consigue el profesor
   */
  public function find($codigo): array
  {
    $profesor = $this->selectOne("detalles_profesores", [['codigo', '=', "'$codigo'"]]);
    return !$profesor ? [] : $profesor;
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
   // return var_dump($profesor);
    return !$profesor ? [] : $profesor;
  }


  function findByCodigo(string $cedula)
  {
      $profesor = $this->select('detalles_profesores', [['cedula', '=',  "'$cedula'"]]);;
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
    function updateProfesor($nombre, $apellido, $email, $direccion, $telefono, $cedula)
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
        'db'        => 'codigo',
        'dt'        => 4
      ),

    );
    return $this->getSSP('detalles_profesores', 'cedula', $columns);
  }
}
