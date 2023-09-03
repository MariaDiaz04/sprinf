<?php

namespace App;

use App\model;
use App\malla;
use Utils\Sanitizer;

use Exception;

class materias extends model
{

    public $fillable = [
        'codigo',
        'nombre',
        'trayecto',
        'htasist',
        'htind',
        'ucredito',
        'hrs_acad',
        'eje',
    ];

    private $codigo;
    private $nombre;
    private $trayecto;
    private $htasist;
    private $htind;
    private $ucredito;
    private $hrs_acad;
    private $eje;
    private $malla = [];

    public function all()
    {
        try {
            $materias = $this->select("detalles_materias");
            return $materias ? $materias : null;
        } catch (Exception $th) {
            return $th;
        }
    }

    public function create($materias)
    {
        foreach ($materias as $key => $value) {
            $this->fillable[$key] = $value;
        }
        return $this;
    }

    // funcion para traer estatus 1 
    public function allstatus()
    {

        $allstatus = $this->query(
            'SELECT
            materias.idmaterias AS idmaterias,
            materias.nombre AS nombre,
            materias.estatus AS estatus
        FROM
            
            `materias`
        WHERE
             nombre NOT in
            (
             select nombre from materias
                where estatus = 0
                                        )'
        );
        return $allstatus;
    }

    //=========================FIND==========================
    public function find($idmaterias)
    {
        try {
            $materias = $this->select('materias', [['idmaterias', '=', $idmaterias]]);
            if ($materias) {
                foreach ($materias[0] as $key => $value) {
                    $this->fillable[$key] = $value;
                }
                return $this;
            } else {
                return null;
            }
        } catch (Exception $th) {
            return $th;
        }
    }
    //=========================/FIND==========================


    // ======================== / UPDATE=========================


    public function actualizar($materias)
    {

        $this->update('materias', $materias, [['idmaterias', '=', $this->fillable['idmaterias']]]);
        return $this;
    }

    public function eliminar()
    {

        try {

            $this->delete('materias', [['idmaterias', '=',  $this->fillable['idmaterias']]]);

            return $this;
        } catch (Exception $th) {
            return $th;
        }
    }


    public function materiasactivas()
    {

        $materias_activas = $this->query(
            'SELECT
            
            materias.estatus
        FROM
            
            `materias`
            WHERE materias.estatus=1
       '
        );
        return $materias_activas;
    }


    public function materiasInactivas()
    {

        $materias_inactivas = $this->query(
            'SELECT
            
            materias.estatus
        FROM
            
            `materias`
            WHERE materias.estatus=0
       '
        );
        return $materias_inactivas;
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


    /**
     * recorre las fases en las que está presente la materia
     *
     * @param array $data
     * @return void
     */
    function setMalla(array $data): void
    {
        foreach ($data as $values) {
            $malla = new malla();

            $malla->setData($values);

            $this->malla[] = $malla;
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
     * Transaccion para inserción de materias
     *
     * @return String - código de materia creada
     */
    function insertTransaction(): String
    {
        try {

            parent::beginTransaction();
            // almacenar materia
            $codigo = $this->save();

            parent::commit();
            return $codigo;
        } catch (Exception $e) {
            parent::rollBack();
            return '';
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
        if ($codigo) {
            $this->update('materias', $data, [['codigo', '=', $codigo]]);
            return $codigo;
        } else {
            $this->set('materias', $data);


            foreach ($this->malla as $malla) {
                $this->set('malla_curricular', $malla->getQuery());
            }

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
                'db'        => 'codigo',
                'dt'        => 0
            ),
            array(
                'db'        => 'nombre',
                'dt'        => 1
            ),
            array(
                'db'        => 'nombre_trayecto',
                'dt'        => 2
            ),
            array(
                'db'        => 'nombre_fase',
                'dt'        => 3
            ),
            array(
                'db'        => 'dimensiones_proyecto',
                'dt'        => 4
            ),
        );
        return $this->getSSP('detalles_materias', 'codigo', $columns);
    }
}
