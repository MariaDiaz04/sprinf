<?php


use PHPUnit\Framework\TestCase;
use Model\proyecto;

final class ProyectoFallosTest extends TestCase
{

  public function testInsertSinIntegrantes(): void
  {
    $proyecto = new Proyecto();
    $data = [
      'id' => 900,
      'nombre' => 'Proyecto de Prueba',
      'comunidad' => 'UPTAEB',
      'fase_id' => 'TR2_1',
      'estatus' => 1,
      'direccion' => 'Av. La Salle',
      'resumen' => 'Proyecto sociotecnologico',
      'municipio' => 'Iribarren',
      'parroquia' => 'Ana Soto',
      'motor_productivo' => 'Tecnologia',
      'tutor_in' => 'Sonia',
      'tutor_ex' => 'Jose',
    ];
    $proyecto->setProyectData($data);
    $resultado = $proyecto->insertTransaction();
    $this->assertEquals(false, $resultado);
    $this->assertEquals('No se puede generar un proyecto sin integrantes', $proyecto->error['message']);
  }

  function testInsertConEstudiantesErroneos()
  {
    $proyecto = new Proyecto();
    $data = [
      'id' => 900,
      'nombre' => 'Proyecto de Prueba',
      'comunidad' => 'UPTAEB',
      'fase_id' => 'TR2_1',
      'estatus' => 1,
      'direccion' => 'Av. La Salle',
      'resumen' => 'Proyecto sociotecnologico',
      'municipio' => 'Iribarren',
      'parroquia' => 'Ana Soto',
      'motor_productivo' => 'Tecnologia',
      'tutor_in' => 'Sonia',
      'tutor_ex' => 'Jose',
      'integrantes' => ['e-asd', 'e-asd', 'e-aass']
    ];
    $proyecto->setProyectData($data);
    $resultado = $proyecto->insertTransaction();
    $this->assertEquals(false, $resultado);
    $this->assertEquals('23000', $proyecto->error['code']); // // error de integridad de base de datos
  }

  function testInformacionErronea()
  {
    $proyecto = new Proyecto();
    $data = [
      'id' => 900,
      'nombre' => 'Proyecto de Prueba',
      'comunidad' => 'UPTAEB',
      'fase_id' => 'FASE_INVENTADA', // fase erronea
      'estatus' => 1,
      'direccion' => 'Av. La Salle',
      'resumen' => 'Proyecto sociotecnologico',
      'municipio' => 'Iribarren',
      'parroquia' => 'Ana Soto',
      'motor_productivo' => 'Tecnologia',
      'tutor_in' => 'Sonia',
      'tutor_ex' => 'Jose',
      'integrantes' => ['e-63578', 'e-77765', 'e-80516']
    ];
    $proyecto->setProyectData($data);
    $resultado = $proyecto->insertTransaction();
    $this->assertEquals(false, $resultado);
    $this->assertEquals('23000', $proyecto->error['code']); // error de integridad de base de datos
  }

  function testProyectoYaCreado()
  {
    $proyecto = new Proyecto();
    $data = [
      'id' => 900,
      'nombre' => 'Proyecto de Prueba',
      'comunidad' => 'UPTAEB',
      'fase_id' => 'TR2_1',
      'estatus' => 1,
      'direccion' => 'Av. La Salle',
      'resumen' => 'Proyecto sociotecnologico',
      'municipio' => 'Iribarren',
      'parroquia' => 'Ana Soto',
      'motor_productivo' => 'Tecnologia',
      'tutor_in' => 'Sonia',
      'tutor_ex' => 'Jose',
      'integrantes' => ['e-63578', 'e-77765', 'e-80516']
    ];
    $proyecto->setProyectData($data);
    $resultado = $proyecto->insertTransaction();
    $this->assertEquals(true, $resultado);

    $dataDuplicada = [
      'id' => 900,
      'nombre' => 'Proyecto de Prueba',
      'comunidad' => 'UPTAEB',
      'fase_id' => 'TR2_1',
      'estatus' => 1,
      'direccion' => 'Av. La Salle',
      'resumen' => 'Proyecto sociotecnologico',
      'municipio' => 'Iribarren',
      'parroquia' => 'Ana Soto',
      'motor_productivo' => 'Tecnologia',
      'tutor_in' => 'Sonia',
      'tutor_ex' => 'Jose',
      'integrantes' => ['e-63578', 'e-77765', 'e-80516']
    ];

    $proyecto->setProyectData($dataDuplicada);
    $resultado = $proyecto->insertTransaction();
    $this->assertEquals(false, $resultado);
    $this->assertEquals('23000', $proyecto->error['code']); // error de integridad de base de datos
  }

  public static  function tearDownAfterClass(): void
  {
    $proyecto = new Proyecto();
    $proyecto->remover(900);
    parent::tearDownAfterClass();
  }
}
