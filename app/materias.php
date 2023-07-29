<?php

namespace App;

use App\model;

use Exception;

class materias extends model
{

    public $fillable = [
        'nombre',
        'trayecto_id',
        'tipo',
    ];

    public function all()
    {
        try {
          $materias = $this->querys("SELECT materias.*, trayecto.nombre as trayecto FROM materias INNER JOIN trayecto ON trayecto.id = materias.trayecto_id ");
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

    public function save()
    {

        try {

                $this->set('materias', [
                    'nombre' => '"' . $this->fillable['nombre'] . '"',
                    'trayecto_id' => '"' . $this->fillable['trayecto_id'] . '"',
                    'tipo' => '"' . $this->fillable['tipo'] . '"',
                    
                ]);
                return $this;
            
        } catch (Exception $th) {
            return $th;
        }
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
}
