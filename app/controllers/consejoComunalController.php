<?php

namespace Controllers;



use Exception;
use Model\consejoComunal;
use Model\sector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Utils\Validation;

class consejoComunalController extends controller
{   
    protected static int $idConsejoComunalDePrueba;
    
    private $consejoComunal;
    public $SECTOR;
    public $VALIDACION;

    function __construct()
    {
 
        $this->consejoComunal = new consejoComunal();
        $this->SECTOR = new SECTOR();
        $this->VALIDACION = new Validation();
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

  public function store(Request $request)
  {
      try {
          // Obtener datos del formulario utilizando el objeto Request
          $nombre = $request->get('nombre');
          $nombre_vocero = $request->get('nombre_vocero'); 
          $telefono = $request->get('telefono');
          $sector_id = $request->get('sector_id');
          
          $campos = [
            ['nombre', $nombre, 'string', 5, 50, 'required'],
            ['nombre_vocero', $nombre_vocero, 'string', 3, 50, 'required'],
            ['telefono', $telefono, 'int', 11, 11, 'required'],
            ['sector_id', $sector_id, 'int', 1, 4, 'required']
          ];

          foreach ($campos as $campo) {
            $validacion = $this->VALIDACION->validate(...$campo);
            if ($validacion == true) {
                http_response_code(400);
                echo json_encode($validacion);
                return 0;
            }
        }

          
        $sector = $this->SECTOR->find($sector_id);
        if($sector == null){
            //Se establecen los valores a mostrar en caso de no encontrar la parroquia
            $error = ([
                'error' => '404',
                'detalle' => 'No existe el Sector indicado',
            ]);
            //Error de 404 cuando no encuentra un dato
            http_response_code(404);
            echo json_encode($error);
        }
        else{
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
        }
        
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode($e->getMessage());
    }
}



  function update($request)
  {
    try {
      $data = [];
      $id = $request->get('id');
      $nombre = $request->get('nombre');
      $nombre_vocero = $request->get('nombre_vocero');
      $sector_id = $request->get('sector_id');
      $telefono = $request->get('telefono');

      $campos = [
        ['id', $id, 'int', 1, 5, 'required'],
        ['nombre', $nombre, 'string', 5, 50, 'required'],
        ['nombre_vocero', $nombre_vocero, 'string', 3, 50, 'required'],
        ['telefono', $telefono, 'int', 11, 11, 'required'],
        ['sector_id', $sector_id, 'int', 1, 4, 'required']
      ];

      foreach ($campos as $campo) {
        $validacion = $this->VALIDACION->validate(...$campo);
        if ($validacion == true) {
          http_response_code(400);
          echo json_encode($validacion);
          return 0;
        }
      }

      $consejoComunal = $this->consejoComunal->find($id);
      if($consejoComunal == null){
        //Se establecen los valores a mostrar en caso de no encontrar la parroquia
        $error = ([
            'error' => '404',
            'detalle' => 'No existe el consejo comunal indicado',
        ]);
        //Error de 404 cuando no encuentra un dato
        http_response_code(404);
        echo json_encode($error);
      }
      else{
        $sector = $this->SECTOR->find($id);
        if($sector == null){
          //Se establecen los valores a mostrar en caso de no encontrar el sector
          $error = ([
              'error' => '404',
              'detalle' => 'No existe el id del sector indicado',
          ]);
          //Error de 404 cuando no encuentra un dato
          http_response_code(404);
          echo json_encode($error);
        }
        else{
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
        }
      }

      if (!$resultado) throw new Exception('Error al actualizar Consejo Comunal');

      http_response_code(200);
      echo json_encode(true);
  } catch (Exception $e) {
      http_response_code(500);
      echo json_encode($e->getMessage());
  }

  }

  function edit($request)
    {
      try {
        $data = [];
        $id = $request->get('id');
        $campos = [
          ['id', $id, 'int', 1, 4, 'required']
        ];

        foreach ($campos as $campo) {
          $validacion = $this->VALIDACION->validate(...$campo);
          if ($validacion == true) {
              http_response_code(400);
              echo json_encode($validacion);
              return 0;
          }
      }
      $consejoComunal = $this->consejoComunal->find($id);
      
      if($consejoComunal == null){
        //Se establecen los valores a mostrar en caso de no encontrar el consejoComunal
        $error = ([
            'error' => '404',
            'detalle' => 'No existe el id del consejoComunal indicado',
        ]);
        //Error de 404 cuando no encuentra un dato
        http_response_code(404);
        echo json_encode($error);
      }
      else{ 
        $data['consejoComunal'] = $consejoComunal;
        http_response_code(200);
        echo json_encode($data);
      }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode($e->getMessage());
    }
  }

    public function delete($request)
    {

        try {
            $id = $request->get('id');

          $campos = [
              ['id', $id, 'int', 1, 4, 'required']
          ];

        foreach ($campos as $campo) {
            $validacion = $this->VALIDACION->validate(...$campo);
            if ($validacion == true) {
                http_response_code(400);
                echo json_encode($validacion);
                return 0;
            }
        }

        $consejoComunal = $this->consejoComunal->find($id);

        if($consejoComunal == null){
              //Se establecen los valores a mostrar en caso de no encontrar el sector
              $error = ([
                  'error' => '404',
                  'detalle' => 'No existe el id del Consejo Comunal indicado',
              ]);
              //Error de 404 cuando no encuentra un dato
              http_response_code(404);
              echo json_encode($error);
        }
        else{
          // realizar eliminacion
          $result = $this->consejoComunal->deleteTransaction($id);
                      
          if (!$result) throw new Exception('Error inesperado al borrar el Consejo Comunal.');
          http_response_code(200);
          echo json_encode($id);
        } 
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
