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

    /**
     * Obtener los detalles de una materia
     * por su código de materia
     *
     * @param string $codigo
     * @return array - es un array vacio en caso de que no consiga alguna coincidencia
     */
    public function find(string $codigo)
    {
        $materias = $this->selectOne('detalles_materias', [['codigo_materia', '=', '"' . $codigo . '"']]);
        return !$materias ? [] : $materias;
    }

    /**
     * Obtener los detalles de una materia
     * por su código de unidad curricular (Malla [fase1/fase2])
     *
     * @param string $codigo
     * @return array
     */
    function findByUnidadCurricularId(string $codigo): array
    {
        $materias = $this->selectOne('detalles_materias', [['codigo', '=', '"' . $codigo . '"']]);
        return !$materias ? [] : $materias;
    }

    /**
     * Obtener los detalles completos de una materia
     * por su código de materia
     *
     * @param string $codigo
     * @return array
     */
    function findMalla(string $codigo): array
    {
        $materias = $this->select('detalles_materias', [['materia_id', '=', '"' . $codigo . '"']]);
        return !$materias ? [] : $materias;
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
     * Transaccion para la actualizacion de materias
     *
     * @return String
     */
    function updateTransaction(): String
    {
        try {
            parent::beginTransaction();
            // actualizar tabla materia
            $codigo = $this->save($this->codigo);
            parent::commit();
            return $codigo;
        } catch (Exception $e) {
            print($e);
            parent::rollBack();
            return '';
        }
    }

    /**
     * Transaccion para el borrado de materias
     *
     * @return String
     */
    function deleteTransaction(string $codigo): bool
    {
        try {
            parent::beginTransaction();
            // actualizar tabla materia
            // borramos su antigua malla
            $this->delete('malla_curricular', [['materia_id', '=', '"' . $codigo . '"']]);
            $this->delete('materias', [['codigo', '=', '"' . $codigo . '"']]);

            parent::commit();
            return true;
        } catch (Exception $e) {
            parent::rollBack();
            return false;
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

            // eliminamos el valor de codigo de la información a actualizar ya que es un campo que
            // no se debe de actualizar
            unset($data['codigo']);

            // borramos su antigua malla
            $this->delete('malla_curricular', [['materia_id', '=', '"' . $codigo . '"']]);

            // actualizamos la materia con la nueva informacion
            $this->update('materias', $data, [['codigo', '=', '"' . $codigo . '"']]);

            // creamos su nueva malla
            foreach ($this->malla as $malla) {
                $this->set('malla_curricular', $malla->getQuery());
            }

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
                'db'        => 'nombre_trayecto',
                'dt'        => 0
            ),
            array(
                'db'        => 'codigo_materia',
                'dt'        => 1
            ),
            array(
                'db'        => 'nombre_materia',
                'dt'        => 2
            ),
            array(
                'db'        => 'count_malla',
                'dt'        => 3
            ),
            array(
                'db'        => 'nombre_fase',
                'dt'        => 4
            ),

            array(
                'db'        => 'cursable',
                'dt'        => 5
            ),
            array(
                'db'        => 'dimensiones',
                'dt'        => 6
            ),

        );
        return $this->getSSP('detalles_materias', 'codigo_materia', $columns);
    }
}
