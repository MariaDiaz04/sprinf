<?php

namespace Model;

use Model\model;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;
use Utils\Sanitizer;

use Exception;

class seccion extends model
{

    public $fillable = [
        'codigo',
        'trayecto_id',
        'observacion',


    ];
    private  $codigo;
    private  $trayecto_id;
    private string $observacion;

    public function all()
    {
        try {
            $seccion = $this->querys("SELECT seccion.*, trayecto.nombre as trayecto FROM seccion INNER JOIN trayecto ON trayecto.codigo = seccion.trayecto_id ");
            return $seccion ? $seccion : null;
        } catch (Exception $th) {
            return $th;
        }
    }

    public function create($seccion)
    {
        foreach ($seccion as $key => $value) {
            $this->fillable[$key] = $value;
        }
        return $this;
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
        foreach ($data as $secc => $value) {

            if (property_exists($this, $secc) && in_array($secc, $this->fillable)) {
                $this->{$secc} = $value;
            }
        }
    }

    /**
     * Transaccion para inserción de materias
     *
     * @return String - código de materia creada
     */
    function insertTransaction(): String
    {
        try {

            parent::beginTransaction();
            // almacenar seccion
            $codigo = $this->save();

            parent::commit();
            return $codigo;
        } catch (Exception $e) {
            parent::rollBack();
            return null;
        }
    }

    /**
     * save
     * 
     * Se encarga de tomar los valores que fueron asignados al modelo
     * previamente y realizar la consulta SQL
     *
     * @param [type] $id
     * @return string Código de materia
     */

    public function save($codigo = null): string
    {
        $data = [];

        foreach ($this->fillable as $key => $value) {
            if (isset($this->{$value})) {
                if (is_string($this->{$value})) {
                    $data[$value] = '"' . Sanitizer::sanitize($this->{$value}) . '"';
                } else {
                    $data[$value] =  $this->{$value};
                }
            }
        }

        $this->set('seccion', $data);
        return $this->codigo;
    }





    public function Selectcod()
    {

        $codigo = $this->query(
            'SELECT
                trayecto.id AS id,
                trayecto.nombre AS nombre
            FROM
                
                `trayecto`;'
        );
        return $codigo;
    }
    // funcion para traer estatus 1 
    // public function allstatus() {

    //     $allstatus = $this->query(
    //         'SELECT

    //             seccion.*
    //         FROM

    //             `seccion`
    //         WHERE
    //              nombre NOT in
    //             (
    //              select nombre from seccion
    //                 where estatus = 0
    //                                         )'
    //     );
    //     return $allstatus;
    // }

    /**
     * Obtener los detalles de una seccion
     * por su código de seccion
     *
     * @param string $codigo
     * @return array - es un array vacio en caso de que no consiga alguna coincidencia
     */
    public function find(string $codigo)
    {
        $materias = $this->selectOne('detalles_seccion', [['codigo', '=', '"' . $codigo . '"']]);
        return !$materias ? [] : $materias;
    }
    //=========================/FIND==========================


    // ======================== / UPDATE=========================

    /* 
public function actualizar($seccion) {

$this->update('seccion', $seccion, [['id', '=', $this->fillable['id'] ]]);
return $this;

}

public function eliminar()
{

    try {

        $this->delete('seccion', [['id', '=',  $this->fillable['id']]]);
        
        return $this;
        
    } catch (PDOException $th) {
        return $th;
    }
}


    public function seccionactivas() {
    
    $seccion_activas = $this->query(
        'SELECT
            
            seccion.estatus
        FROM
            
            `seccion`
            WHERE seccion.estatus=1
       '
    );
    return $seccion_activas;
}


public function seccionInactivas() {
    
    $seccion_inactivas = $this->query(
        'SELECT
            
            seccion.estatus
        FROM
            
            `seccion`
            WHERE seccion.estatus=0
       '
    );
    return $seccion_inactivas;
} */

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
                'db'        => 'codigo',
                'dt'        => 0
            ),
            array(
                'db'        => 'trayecto',
                'dt'        => 1
            ),
            array(
                'db'        => 'observacion',
                'dt'        => 2
            )
        );
        return $this->getSSP('detalles_seccion', 'codigo', $columns);
    }
}
