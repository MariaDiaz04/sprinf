<?php

namespace Model;

use Model\model;

class permisos extends model
{

    public $fillable = [
        'consultar',
        'actualizar',
        'crear',
        'eliminar',
        'evaluar',
        'rol_id',
        'modulo_id',
    ];


    // ======================== ALL=========================
    public function all()
    {
        try {
            $permisos = $this->querys('SELECT permisos.id, permisos.consultar, permisos.actualizar, permisos.crear, permisos.eliminar, permisos.evaluar, permisos.rol_id, permisos.modulo_id, roles.nombre, modulo.nombre AS nombmodulo FROM permisos INNER JOIN roles ON permisos.rol_id = roles.id INNER JOIN modulo ON permisos.modulo_id = modulo.id ');
            return $permisos ? $permisos : null;
        } catch (\PDOException $th) {
            return $th;
        }
    }


    // ======================== CREATE=========================
    public function create($permisos)
    {
        foreach ($permisos as $key => $value) {
            $this->fillable[$key] = $value;
        }
        return $this;
    }


    // ======================== SAVE=========================
    public function save()
    {
        try {
            $this->set('permisos', [
                'consultar' => '"' . $this->fillable['consultar'] . '"',
                'actualizar' => '"' . $this->fillable['actualizar'] . '"',
                'crear' => '"' . $this->fillable['crear'] . '"',
                'eliminar' => '"' . $this->fillable['eliminar'] . '"',
                'evaluar' => '"' . $this->fillable['evaluar'] . '"',
                'rol_id' => '"' . $this->fillable['rol_id'] . '"',
                'modulo_id' => '"' . $this->fillable['modulo_id'] . '"',
            ]);
            //return var_dump($oas);
            return $this;
        } catch (\PDOException $th) {
            return $th;
        }
    }

    //========================= FIND==========================
    public function find($idpermisos)
    {
        try {
            $permisos = $this->select('permisos', [['id', '=', $idpermisos]]);
            if ($permisos) {
                foreach ($permisos[0] as $key => $value) {
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
    public function actualizar($permisos)
    {
        $this->update('permisos', $permisos, [['id', '=', $this->fillable['id']]]);
        return $this;
    }

    // ======================== DELETE=========================
    public function eliminar()
    {
        try {
            $this->delete('permisos', [['id', '=',  $this->fillable['id']]]);
            return $this;
        } catch (\PDOException $th) {
            return $th;
        }
    }


    // ======================== CONSULT=========================
    public function consult($idmodulo, $rol_id)
    {
        try {
            $permisos_usuario = $this->querys('SELECT * FROM permisos WHERE permisos.modulo_id = ' . $idmodulo . ' AND permisos.rol_id = ' . $rol_id . '');
            if ($permisos_usuario) {
                foreach ($permisos_usuario[0] as $key => $value) {
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

      // ======================== CONSULT=========================
      public function findPermisionbyRol($rol_id)
      {
          try {
              $permisos_rol = $this->querys('SELECT permisos.id, permisos.consultar, permisos.actualizar, permisos.crear, permisos.eliminar, permisos.evaluar, modulo.nombre FROM permisos INNER JOIN modulo ON permisos.modulo_id = modulo.id AND  permisos.rol_id = ' . $rol_id .'');
              return $permisos_rol ? $permisos_rol : null;
          } catch (\PDOException $th) {
              return $th;
          }
      }
}//===================================/ CLASS==============================================   
