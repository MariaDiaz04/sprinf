<?php

namespace Utils;

class Validation
{
    /**
     * Evaluar valores enteros
     *
     * @param   string $name
     * @param   string $value
     * @param   string $type
     * @param   int $size_min
     * @param   int $size_max
     * @param   string $required
     * @return array
     */
    public function validate($name, $value, $type, $size_min, $size_max, $required){
        switch($type){
            case 'int':
                $standard = '/^[0-9]{'.$size_min.','.$size_max.'}$/';
                break;
            case 'string':
                $standard = '/^[A-ZÁÉÍÓÚa-zñáéíóú0-9,.#%$^&*:\s]{'.$size_min.','.$size_max.'}$/';
                break;
        }
        //Para evaluar si la variable es requerida pero se encuentra vacia
        if($required == 'required' && trim($value)==''){
            $error = ([
                'campo' => $name,
                'detalle' => 'Es requerido',
            ]);
            return $error;
        }

        //Evaluar en caso de que no cumpla con los standares de ser entero y con el minimo y maximo de caracteres
        if(!preg_match_all($standard,$value)){
            $error = ([
                'campo' => $name,
                'detalle' => 'Debe ser '.$type.' y la cantidad de caracteres entre '.$size_min.' y '.$size_max.'',
            ]);
            return $error;
        }
    }
    
}
