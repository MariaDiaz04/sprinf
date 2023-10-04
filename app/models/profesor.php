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
