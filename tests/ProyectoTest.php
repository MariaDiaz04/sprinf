<?php


use PHPUnit\Framework\TestCase;
use Model\proyecto;

final class ProyectoTest extends TestCase
{
  protected static Proyecto $proyecto;

  public static  function setUpBeforeClass(): void
  {
    parent::setUpBeforeClass();

    self::$proyecto = new Proyecto();

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
    self::$proyecto->setProyectData($data);
  }


  public function testInsertTransaction(): void
  {
    $resultado = self::$proyecto->insertTransaction();
    $this->assertEquals(true, $resultado);
  }

  function testActualizar(): void
  {

    $data = [
      'id' => 900,
      'nombre' => 'Proyecto de Prueba Actualizado', // actualizacion de nombre
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
      'cerrado' => 0,
    ];

    self::$proyecto->setProyectData($data);

    $resultado = self::$proyecto->actualizar();

    $this->assertEquals(true, $resultado);

    $proyecto = self::$proyecto->find(900);

    $this->assertNotEmpty($proyecto);
    $this->assertEquals('Proyecto de Prueba Actualizado', $proyecto['nombre']); // verifica nombre actualizado
  }

  function testActualizarIntegrantes(): void
  {
    $proyecto = self::$proyecto->find(900);
    $this->assertNotEmpty($proyecto);
    $integrantes = self::$proyecto->obtenerIntegrantes(900);
    $this->assertNotEmpty($integrantes);
    $idIntegrantes = array_column($integrantes, 'estudiante_id');


    $this->assertContains('e-80516', $idIntegrantes);

    $idIntegrantes = array_diff($idIntegrantes, ["e-80516"]);

    $data = [
      'id' => 900,
      'integrantes' => $idIntegrantes,
    ];
    self::$proyecto->setProyectData($data);
    $resultado = self::$proyecto->actualizarIntegrantes();

    $this->assertEquals(true, $resultado);

    $integrantesActualizados = self::$proyecto->obtenerIntegrantes(900);
    $this->assertNotEmpty($integrantesActualizados);
    $integrantesActualizados = array_column($integrantesActualizados, 'estudiante_id');
    // verificar que no contenga integrante eliminado de grupo de proyecto
    $this->assertNotContains('e-80516', $integrantesActualizados);
  }

  public function testFindByStudent(): void
  {
    $proyecto = self::$proyecto->findByStudent('e-63578');
    $this->assertNotEmpty($proyecto);
  }

  function testRemover(): void
  {
    $resultado = self::$proyecto->remover(900);
    $this->assertEquals(true, $resultado);
  }


  public static  function tearDownAfterClass(): void
  {
    parent::tearDownAfterClass();
  }
}
