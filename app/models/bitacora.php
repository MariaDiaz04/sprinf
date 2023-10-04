<?php

namespace Model;

use Model\model;

class bitacora extends model
{

    public $fillable = [
        'nombre',
        'estatus',
    ];



    public function all()
    {
        try {
            $bitacora = $this->select('bitacora');
            return $bitacora ? $bitacora : null;
        } catch (\PDOException $th) {
            return $th;
        }
    }

    public function bitacora_all()
    {
        try {
            $bitacoraall = $this->querys('SELECT * FROM `bitacora` ORDER BY bitacora.id DESC');
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



}
