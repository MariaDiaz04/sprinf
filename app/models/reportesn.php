<?php

namespace Model;

use Model\model;

class reportesn extends model
{

    public $fillable = [
        'nombre',
        'estatus',
    ];



    public function all()
    {
        try {
            $reportesn = $this->select('reportesn');
            return $reportesn ? $reportesn : null;
        } catch (\PDOException $th) {
            return $th;
        }
    }

    public function reportesn_all()
    {
        try {
            $reportesnall = $this->querys('SELECT * FROM `reportesn` ORDER BY reportesn.id DESC');
            return $reportesnall;
        } catch (\PDOException $th) {
            return $th;
        }
    }



    //=========================FIND==========================
    public function find($idreportesn)
    {
        try {
            $reportesn = $this->select('reportesn', [['idreportesn', '=', $idreportesn]]);
            if ($reportesn) {
                foreach ($reportesn[0] as $key => $value) {
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
