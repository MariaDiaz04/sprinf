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
            'idusuario',
            'idmodulo',
        ];


        // ======================== ALL=========================
        public function all() {
            try {
                $permisos = $this->query('SELECT permisos.idpermisos, permisos.consultar, permisos.actualizar, permisos.crear, permisos.eliminar, permisos.idusuario, permisos.idmodulo, usuarios.email, modulo.nombre AS nombmodulo, persona.nombre, persona.apellido FROM permisos INNER JOIN usuarios ON permisos.idusuario = usuarios.id INNER JOIN modulo ON permisos.idmodulo = modulo.idmodulo INNER JOIN persona ON usuarios.id = persona.usuarios_id');
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
                    'idusuario'=>'"'.$this->fillable['idusuario'].'"',
                    'idmodulo'=>'"'.$this->fillable['idmodulo'].'"',
                ]);
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
                $permisos_usuario=$this->query('SELECT * FROM permisos WHERE permisos.idmodulo = '.$idmodulo.' AND permisos.idusuario = '.$idusuario.''); 
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