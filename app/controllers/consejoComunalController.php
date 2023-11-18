<?php

namespace Controllers;



use Exception;
use Model\consejoComunal;
use Model\sector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class consejoComunalController extends controller
{   
    protected static int $idConsejoComunalDePrueba;
    
    private $consejoComunal;
    public $SECTOR;
    

    function __construct()
    {
 
        $this->consejoComunal = new consejoComunal();
        $this->SECTOR = new SECTOR();
    }

    public function index()
    {

        $consejoComunal = $this->consejoComunal->all();
        $sector = $this->SECTOR->all();
        

        return $this->view('consejoComunal/gestionar', [
            'consejoComunal' => $consejoComunal,
             'sectores' => $sector
        ]);
    }


    public function create($request)
    {
        $consejoComunal = $this->consejoComunal->Selectcod();
        $sector = $this->SECTOR->all();
        return $this->view('consejoComunal/gestionar', ['consejoComunal' => $consejoComunal, 'sector' => $sector]);
    }

    public function storea(): void
  {

    $consejoComunal = new consejoComunal();
    $consejoComunal->setData([
      'nombre' => 'Consejo Comunal de prueba',
      'nombre_vocero' => 'Vocero de Prueba',
      'sector_id' => 1,
      'telefono' => '254658',
    ]);

    $resultado = $consejoComunal->save();

    self::$idConsejoComunalDePrueba = $consejoComunal->id;
   
  }

  public function store(Request $request): void
  {
      try {
      
          // Obtener datos del formulario utilizando el objeto Request
          $nombre = $request->get('nombre');
          $nombre_vocero = $request->get('nombre'); $nombre_vocero = $request->get('nombre');
          $telefono = $request->get('telefono');
          $sector_id = $request->get('sector_id');
          
          
          
          // Crear una nueva instancia del modelo y establecer los datos
          $consejoComunal = new consejoComunal();
          $consejoComunal->setData([
              'nombre' => $nombre,
              'nombre_vocero' => $nombre_vocero,
              'telefono' => $telefono,
              'sector_id' => $sector_id,
              
          ]);
  
          // Ejecutar transacción de insert
          $resultado = $consejoComunal->save();

  
          http_response_code(200);
          echo json_encode($resultado);
      } catch (Exception $e) {
          http_response_code(500);
          echo json_encode($e->getMessage());
      }
  }

  function update($request): void
  {
    try {
      $data = [];
      $id = $request->get('id');
      $nombre = $request->get('nombre');
      $nombre_vocero = $request->get('nombre_vocero');
      $sector_id = $request->get('sector_id');
      $telefono = $request->get('telefono');

      $consejoComunal = $this->consejoComunal->find($id);
      
      $this->consejoComunal->setData([
        'id' => $id,
        'nombre' => $nombre,
        'nombre_vocero' => $nombre_vocero,
        'sector_id' => $sector_id,
        'telefono' => $telefono,
      ]);
  
      $resultado = $this->consejoComunal->actualizar();

      if (!$resultado) throw new Exception('Error al actualizar Consejo Comunal');

      http_response_code(200);
      echo json_encode(true);
  } catch (Exception $e) {
      http_response_code(500);
      echo json_encode($e->getMessage());
  }

  }

  function edit($request): void
    {
      try {
        $data = [];
        $id = $request->get('id');


       $consejoComunal = $this->consejoComunal->find($id);

        $data['consejoComunal'] =$consejoComunal;

        http_response_code(200);
        echo json_encode($data);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode($e->getMessage());
    }
    }

    public function delete($request)
    {

        try {
            $id = $request->get('id');

            
            // realizar eliminacion
            $result = $this->consejoComunal->deleteTransaction($id);
            
            if (!$result) throw new Exception('Error inesperado al borrar el sector.');
            http_response_code(200);
            echo json_encode($id);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }

  function testActualizacion(): void
  {
    $sector = new consejoComunal();
    $sector->setData([
      'id' => self::$idConsejoComunalDePrueba,
      'nombre' => 'Consejo Comunal de prueba',
      'nombre_vocero' => 'Vocero de Prueba',
      'sector_id' => 1,
      'telefono' => 254658,
    ]);

    $resultado = $sector->actualizar();

    $sectorInfo = $sector->find($sector->id);

  
  }

  function testBorrado(): void
  {
    $sector = new consejoComunal();
    $resultado = $sector->remove(self::$idConsejoComunalDePrueba);
   
  }

  function ssp(Request $query): void
  {
      try {
          http_response_code(200);
          echo json_encode($this->consejoComunal->generarSSP());
      } catch (Exception $e) {
          http_response_code(500);
          echo json_encode($e->getMessage());
      }
  }


}
