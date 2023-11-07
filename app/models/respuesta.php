<?php

namespace Model;

use Model\model;

class respuesta extends model
{

    public $fillable = [
        'respuesta',
        'pregunta_id',
        'usuario_id',
    ];


    // ======================== ALL=========================
    public function all()
    {
        try {
            $respuestas = $this->select('respuestas');
            return $respuestas ? $respuestas : null;
        } catch (\PDOException $th) {
            return $th;
        }
    }


    // ======================== CREATE=========================
    public function create($respuesta)
    {
        foreach ($respuesta as $key => $value) {
            $this->fillable[$key] = $value;
        }
        return $this;
    }


    public function save()
    {
        try {
                $this->set('respuestas', [
                    'respuesta' => '"' . $this->fillable['respuesta'] . '"',
                    'pregunta_id' => '"' . $this->fillable['pregunta_id'] . '"',
                    'usuario_id' => '"' . $this->fillable['usuario_id'] . '"',
                ]);
                return $this;
        } catch (\PDOException $th) {
            return $th;
        }
    }

    //========================= FIND==========================
    public function find($respuesta_id)
    {
        try {
            $respuesta = $this->select('respuestas', [['id', '=', $respuesta_id]]);
            if ($respuesta) {
                foreach ($respuesta[0] as $key => $value) {
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

    // ======================== UPDATE=========================
    public function actualizar($respuesta)
    {

        $this->update('respuestas', $respuesta, [['id', '=', $this->fillable['respuesta_id']]]);
        return $this;
    }

    // ======================== DELETE=========================
    public function eliminar()
    {
        try {
            $this->delete('respuestas', [['id', '=',  $this->fillable['idrespuesta']]]);
            return $this;
        } catch (\PDOException $th) {
            return $th;
        }
    }
}//===================================/ CLASS==============================================   
