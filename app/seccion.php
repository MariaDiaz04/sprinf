<?php 
namespace App;
use App\model;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;

use Exception;

class seccion extends model
{

    public $fillable = [
        'nombre',
        'estatus',
    ];

    public function all()
    {
        try {
            $seccion = $this->select('seccion');
            return $seccion ? $seccion : null;
        } catch (Exception $th) {
            return $th;
        }
    }

    public function create ($seccion) {
        foreach ($seccion as $key => $value) {
            $this->fillable[$key] = $value;

        }
        return $this; 

   }

   public function save() {

    try {

        $nombre = $this->query('seccion.nombre FROM seccion WHERE seccion.nombre = "'.$this->fillable['nombre'].'"');

        if (!$nombre) {

            $this->set('seccion', [
                'nombre'=>'"'.$this->fillable['nombre'].'"',
                'estatus'=>1,
            ]);
            return $this;
            
        }else{
            return null;
        }

        
    } catch (PDOException $th) {
        return $th;
    }

}

// funcion para traer estatus 1 
public function allstatus() {
    
    $allstatus = $this->query(
        'SELECT
            seccion.idseccion AS idseccion,
            seccion.nombre AS nombre,
            seccion.estatus AS estatus
        FROM
            
            `seccion`
        WHERE
             nombre NOT in
            (
             select nombre from seccion
                where estatus = 0
                                        )'
    );
    return $allstatus;
}

//=========================FIND==========================
public function find($idseccion){
try {
    $seccion = $this->select('seccion',[['idseccion','=', $idseccion]]);
if($seccion){
    foreach ($seccion[0] as $key => $value) {
        $this->fillable[$key] = $value;
    }
        return $this;
    }else{
        return null;
    }
} catch (PDOException $th) {
    return $th;
}
}
//=========================/FIND==========================


// ======================== / UPDATE=========================


public function actualizar($seccion) {

$this->update('seccion', $seccion, [['idseccion', '=', $this->fillable['idseccion'] ]]);
return $this;

}

public function eliminar()
{

    try {

        $this->delete('seccion', [['idseccion', '=',  $this->fillable['idseccion']]]);
        
        return $this;
        
    } catch (PDOException $th) {
        return $th;
    }
}


    public function seccionactivas() {
    
    $seccion_activas = $this->query(
        'SELECT
            
            seccion.estatus
        FROM
            
            `seccion`
            WHERE seccion.estatus=1
       '
    );
    return $seccion_activas;
}


public function seccionInactivas() {
    
    $seccion_inactivas = $this->query(
        'SELECT
            
            seccion.estatus
        FROM
            
            `seccion`
            WHERE seccion.estatus=0
       '
    );
    return $seccion_inactivas;
}

}
?>