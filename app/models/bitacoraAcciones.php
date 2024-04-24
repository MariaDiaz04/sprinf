<?php

namespace Model;

use Model\model;

class bitacoraAcciones extends model
{

    public $fillable = [
        'id',
        'usuario_id',
        'modulo_id',
        'fecha',
        'navegador',
        'accion',
    ];
    public ?int $id;
    public int $usuario_id;
    public int $modulo_id;
    public string $fecha;
    public string $navegador;
    public int $accion;


    public function all()
    {
        try {
            $bitacora = $this->select('bitacora');
            return $bitacora ? $bitacora : null;
        } catch (\PDOException $th) {
            return $th;
        }
    }

    public function bitacoraAcciones_all()
    {
        try {
            $bitacoraall = $this->querys('SELECT bitacora_acciones.id, bitacora_acciones.fecha, bitacora_acciones.navegador, bitacora_acciones.accion,persona.nombre, persona.apellido, persona.cedula, modulo.nombre AS nombmodulo FROM bitacora_acciones INNER JOIN persona ON bitacora_acciones.usuario_id = persona.usuario_id INNER JOIN modulo ON bitacora_acciones.modulo_id = modulo.id ORDER BY bitacora_acciones.id DESC');
            return $bitacoraall;
        } catch (\PDOException $th) {
            return $th;
        }
    }



    //=========================FIND==========================
    public function find($idbitacora)
    {
        try {
            $bitacora = $this->select('bitacora', [['idbitacora', '=', $idbitacora]]);
            if ($bitacora) {
                foreach ($bitacora[0] as $key => $value) {
                    $this->fillable[$key] = $value;
                }
                return $this;
            } else {
                return null;
            }
        } catch (\PDOException $th) {
            return $th;
        }
    }
    //=========================/FIND==========================
    public function create($acciones)
    {
        foreach ($acciones as $key => $value) {
            $this->fillable[$key] = $value;
        }
        return $this;
    }

     // ======================== SAVE=========================
     public function lastSave($modulo_id,$accion)
     {
         try {
             $this->set('bitacora_acciones', [
                 'modulo_id' => '"' . $modulo_id . '"',
                 'usuario_id' => '"' . $_SESSION['usuario_id'] . '"',
                 'fecha' => '"' . Date('Y-m-d h:i:sa') . '"',
                 'navegador' => '"' . $_SERVER['HTTP_USER_AGENT'] . "\n\n" . '"',
                 'accion' => '"' . $accion . '"',
             ]);
             return $this;
         } catch (\PDOException $th) {
             return $th;
         }
     }
    /**
     * setData
     * 
     * Se encarga de asignar los valores en los campos
     * definidos en la variable "fillable", tambien se 
     * encarga de sanitizar cada uno de estos valores
     *
     * @param array $data
     * @return void
     */
    public function setData(array $data)
    {
        foreach ($data as $prop => $value) {
            if (property_exists($this, $prop) && in_array($prop, $this->fillable)) {
                $this->{$prop} = $value;
            }
        }
    }

    /**
     * save
     * 
     * Se encarga de tomar los valores que fueron asignados al modelo
     * previamente y realizar la consulta SQL
     *
     * @return bool - ejecucion exitosa
     */
    public function save(): int
    {
        $query = $this->prepare("INSERT INTO bitacora_acciones(modulo_id, usuario_id, fecha, navegador,accion) VALUES (:modulo_id, :usuario_id, :fecha, :navegador, :accion)");
        $query->bindParam(":modulo_id", $this->modulo_id);
        $query->bindParam(":usuario_id", $this->usuario_id);
        $query->bindParam(":fecha", $this->fecha);
        $query->bindParam(":navegador", $this->navegador);
        $query->bindParam(":accion", $this->accion);

        $query->execute();
        $this->id = $this->lastInsertId();
        return true;
    }
}
