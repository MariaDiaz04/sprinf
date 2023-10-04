<?php

namespace Model;

use Model\model;

use Traits\Utility;

use Exception;

class persona extends model
{

  use Utility;

  public $fillable = [
    'cedula',
    'usuario_id',
    'nombre',
    'apellido',
    'direccion',
    'telefono',
    'estatus'
  ];

  private string $cedula;
  private int $usuario_id;
  private string $nombre;
  private string $direccion;
  private string $apellido;
  private string $telefono;
  private int $estatus;

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
   * Función para encriptar telefono
   *
   * @return void
   */
  function encriptarTelefono(): void
  {
    $this->telefono = $this->encriptar($this->telefono);
  }

  public function setPersona(array $data)
  {

    foreach ($data as $prof => $value) {

      if (property_exists($this, $prof) && in_array($prof, $this->fillable)) {
        $this->{$prof} = $value;
      }
    }
    // return $data;
  }



  public function save()
  {
    $query = $this->prepare("INSERT INTO persona(cedula, usuario_id, nombre, apellido, direccion, telefono, estatus) "
      . "VALUES (:cedula, :usuario_id, :nombre, :apellido, :direccion, :telefono, 1)");
    $query->bindParam(":cedula", $this->cedula);
    $query->bindParam(":usuario_id", $this->usuario_id);
    $query->bindParam(":direccion", $this->direccion);
    $query->bindParam(":nombre", $this->nombre);
    $query->bindParam(":apellido", $this->apellido);
    $query->bindParam(":telefono", $this->telefono);
    $query->execute();

    return $this->cedula;
  }
}
