<?php

namespace Model;

use Model\model;

class rol extends model
{

    public $fillable = [
        'nombre',
    ];

    public function all()
    {
        try {
            $roles = $this->select('roles');
            return $roles ? $roles : null;
        } catch (\PDOException $th) {
            return $th;
        }
    }

    public function find($id)
    {
        try {
            $roles = $this->select('roles', [['id', '=', $id]]);
            if ($roles) {
                foreach ($roles[0] as $key => $value) {
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
}
