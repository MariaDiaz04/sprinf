<?php
namespace App;
use App\model;

    class permisos extends model
    {

        public $fillable = [
            'consultar',
            'actualizar',
            'crear',
            'eliminar',
            'rol_id',
            'modulo_id',
        ];


        // ======================== ALL=========================
        public function all() {
            try {
                $permisos = $this->querys('SELECT permisos.idpermisos, permisos.consultar, permisos.actualizar, permisos.crear, permisos.eliminar, permisos.rol_id, permisos.modulo_id, roles.nombre, modulo.nombre AS nombmodulo FROM permisos INNER JOIN roles ON permisos.rol_id = roles.id INNER JOIN modulo ON permisos.modulo_id = modulo.modulo_id ');
                return $permisos ? $permisos : null;
            } catch (\PDOException $th) {
                return $th;
            } 
        }


        // ======================== CREATE=========================
        public function create($permisos) {
            foreach ($permisos as $key => $value) {
                $this->fillable[$key] = $value;
            }
            return $this;   
        }


        // ======================== SAVE=========================
        public function save() {
            try {
              $this->set('permisos', [
                    'consultar'=>'"'.$this->fillable['consultar'].'"',
                    'actualizar'=>'"'.$this->fillable['actualizar'].'"',
                    'crear'=>'"'.$this->fillable['crear'].'"',
                    'eliminar'=>'"'.$this->fillable['eliminar'].'"',
                    'rol_id'=>'"'.$this->fillable['rol_id'].'"',
                    'modulo_id'=>'"'.$this->fillable['modulo_id'].'"',
                ]);
                //return var_dump($oas);
                return $this;
            } catch (\PDOException $th) {
                return $th;
            }
        }

        //========================= FIND==========================
        public function find($idpermisos){
            try {
                $permisos = $this->select('permisos',[['idpermisos','=', $idpermisos]]);
            if($permisos){
                foreach ($permisos[0] as $key => $value) {
                    $this->fillable[$key] = $value;
                }
                    return $this;
                }else{
                    return null;
                }
            } catch (\PDOException $th) {
                return $th;
            }
        }

        // ======================== UPDATE=========================
        public function actualizar($permisos) {
            $this->update('permisos', $permisos, [['idpermisos', '=', $this->fillable['idpermisos'] ]]);
            return $this;

        }

        // ======================== DELETE=========================
        public function eliminar()
        {
            try {
                $this->delete('permisos', [['idpermisos', '=',  $this->fillable['idpermisos']]]); 
                return $this; 
            } catch (\PDOException $th) {
                return $th;
            }
        }


        // ======================== CONSULT=========================
        public function consult($idmodulo,$idusuario)
        {
            try {
                $permisos_usuario=$this->querys('SELECT * FROM permisos WHERE permisos.idmodulo = '.$idmodulo.' AND permisos.idusuario = '.$idusuario.''); 
                if($permisos_usuario){
                    foreach ($permisos_usuario[0] as $key => $value) {
                        $this->fillable[$key] = $value;
                    }
                        return $this;
                    }else{
                        return null;
                    }
            } catch (\PDOException $th) {
                return $th;
            }
        }



    }//===================================/ CLASS==============================================   

?>