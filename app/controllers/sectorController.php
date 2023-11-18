<?php
namespace Controllers;


use Symfony\Component\HttpFoundation\Request;

use Exception;
use Model\conexion;
use Model\sector;
use Model\parroquia;

final class sectorController extends controller
{
   protected static int $idIndicadorPrueba;
    private $sector;
    public $PARROQUIA;

    function __construct()
    {
 
        $this->sector = new sector();
        $this->PARROQUIA = new PARROQUIA();
       
    }


    public function index()
    {
  
          $sector = $this->sector->all();
          $parroquia = $this->PARROQUIA->all();
          // var_dump($parroquia);
          // exit();

          return $this->view('sector/gestionar', [
            'sector' => $sector,
            'parroquias' => $parroquia
            
        ]);
    }


    public function create($request)
    {

        $sector = $this->sector->Selectcod();
        $parroquia = $this->PARROQUIA->all();
        return $this->view('sector/gestionar', ['sector' => $sector]);
    }


  public function storea(): void
  {

    $sector = new sector();
    $sector->setData([
  
    'parroquia_id' => '10',
     'nombre' => 'Eje 5',
    ]);

    $resultado = $sector->save();


    
  }

  
    public function store(Request $request): void
    {
        try {
        
            // Obtener datos del formulario utilizando el objeto Request
            $parroquia_id = $request->get('parroquia_id');
            $nombre = $request->get('nombre');
            
            
            // Crear una nueva instancia del modelo y establecer los datos
            $sector = new sector();
            $sector->setData([
                'parroquia_id' => $parroquia_id,
                'nombre' => $nombre,
            ]);
    
            // Ejecutar transacción de insert
            $resultado = $sector->save();

    
            http_response_code(200);
            echo json_encode($resultado);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }






  

  function update(): void
  {
    $sector = new sector();
    $sector->setData([
      
      'parroquia_id' => '10',
      'nombre' => 'Eje 5 Actualizado',
    ]);

    $resultado = $sector->actualizar();

    $sectorInfo = $sector->find($sector->id);

  }

  function edit($request): void
    {
        try {
            $data = [];
            $id = $request->get('id');


            $sector = $this->sector->find($id);

            $data['sector'] = $sector;

            http_response_code(200);
            echo json_encode($data);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }

  function deletea(): void
  {
    $sector = new sector();
    $sector->setData([
      
    ]);

    $resultado = $sector->remove();
   
  }

  public function delete($request)
    {

        try {
            $id = $request->get('id');

            
            // realizar eliminacion
            $result = $this->sector->deleteTransaction($id);
            
            if (!$result) throw new Exception('Error inesperado al borrar el sector.');
            http_response_code(200);
            echo json_encode($id);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }



  function ssp(Request $query): void
  {
      try {
          http_response_code(200);
          echo json_encode($this->sector->generarSSP());
      } catch (Exception $e) {
          http_response_code(500);
          echo json_encode($e->getMessage());
      }
  }

  public function E501()
  {

      return $this->page('errors/501');
  }

}
