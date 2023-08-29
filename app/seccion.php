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
        'trayecto_id',
        
    ];

    public function all()
    {
        try {
          $seccion = $this->querys("SELECT seccion.*, trayecto.nombre as trayecto FROM seccion INNER JOIN trayecto ON trayecto.id = seccion.trayecto_id ");
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

    {

        try {

                $this->set('seccion', [
                    'nombre' => '"' . $this->fillable['nombre'] . '"',
                    'trayecto_id' => '"' . $this->fillable['trayecto_id'] . '"',
                    
                ]);
                return $this;
            
        } catch (Exception $th) {
            return $th;
        }
    }
}
// funcion para traer estatus 1 
// public function allstatus() {
    
//     $allstatus = $this->query(
//         'SELECT
            
//             seccion.*
//         FROM
            
//             `seccion`
//         WHERE
//              nombre NOT in
//             (
//              select nombre from seccion
//                 where estatus = 0
//                                         )'
//     );
//     return $allstatus;
// }

//=========================FIND==========================
public function find($id){
try {
    $seccion = $this->select('seccion',[['id','=', $id]]);
if($seccion){
    foreach ($seccion[0] as $key => $value) {
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
//=========================/FIND==========================


// ======================== / UPDATE=========================


public function actualizar($seccion) {

$this->update('seccion', $seccion, [['id', '=', $this->fillable['id'] ]]);
return $this;

}

public function eliminar()
{


    try {

        $this->delete('seccion', [['id', '=',  $this->fillable['id']]]);
        
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




}
?>