<?php
namespace App;
use App\model;

    class modulo extends model
    {

        public $fillable = [
            'nombre',
        ];


        // ======================== ALL=========================
        public function all() {
            try {
                $modulo = $this->select('modulo');
                return $modulo ? $modulo : null;
            } catch (\PDOException $th) {
                return $th;
            } 
        }


        // ======================== CREATE=========================
        public function create($modulo) {
            foreach ($modulo as $key => $value) {
                $this->fillable[$key] = $value;
            }
            return $this;   
        }


        public function save() {

            try {

                $nombre_modulo = $this->querys('SELECT modulo.nombre FROM modulo WHERE modulo.nombre = "'.$this->fillable['nombre'].'"');

                if (!$nombre_modulo) {

                    $this->set('modulo', [
                        'nombre'=>'"'.$this->fillable['nombre'].'"',
                        
                    ]);
                    return $this;
                    
                }else{
                    return null;
                }

                
            } catch (\PDOException $th) {
                return $th;
            }

        }

        //========================= FIND==========================
        public function find($idmodulo){
            try {
                $modulo = $this->select('modulo',[['idmodulo','=', $idmodulo]]);
            if($modulo){
                foreach ($modulo[0] as $key => $value) {
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
        public function actualizar($modulo) {

            $this->update('modulo', $modulo, [['idmodulo', '=', $this->fillable['idmodulo'] ]]);
            return $this;

        }

        // ======================== DELETE=========================
        public function eliminar()
        {
            try {
                $this->delete('modulo', [['idmodulo', '=',  $this->fillable['idmodulo']]]); 
                return $this; 
            } catch (\PDOException $th) {
                return $th;
            }
        }



    }//===================================/ CLASS==============================================   
