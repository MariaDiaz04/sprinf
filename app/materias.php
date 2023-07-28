<?php 
namespace App;
use App\model;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;

use Exception;

class materias extends model
{

    public $fillable = [
        'nombre',
        'trayecto_id',
        'tipo',
    ];

    public function all()
    {
        try {
            $materias = $this->select('materias');
            return $materias ? $materias : null;
        } catch (Exception $th) {
            return $th;
        }
    }

    public function create ($materias) {
        foreach ($materias as $key => $value) {
            $this->fillable[$key] = $value;

        }
        return $this; 

   }

   public function save() {

    try {

        $nombre = $this->query('materias.nombre FROM materias WHERE materias.nombre = "'.$this->fillable['nombre'].'"');

        if (!$nombre) {

            $this->set('materias', [
                'nombre'=>'"'.$this->fillable['nombre'].'"',
                'trayecto_id'=>'"'.$this->fillable['trayecto_id'].'"',
                'tipo'=>'"'.$this->fillable['tipo'].'"',
           
            ]);
            return $this;
            
        }else{
            return null;
        }

        
    } catch (PDOException $th) {
        return $th;
    }

}

public function Selectcod(){
        
    $codigo = $this->query(  
        'SELECT
                trayecto.id AS id,
                trayecto.nombre AS nombre
            FROM
                
                `trayecto`;'
    );
    return $codigo;

    }




//=========================FIND==========================
public function find($id){
try {
    $materias = $this->select('materias',[['id','=', $id]]);
if($materias){
    foreach ($materias[0] as $key => $value) {
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


public function actualizar($materias) {

$this->update('materias', $materias, [['idmaterias', '=', $this->fillable['id'] ]]);
return $this;

}

public function eliminar()
{

    try {

        $this->delete('materias', [['id', '=',  $this->fillable['id']]]);
        
        return $this;
        
    } catch (PDOException $th) {
        return $th;
    }
}


}
?>