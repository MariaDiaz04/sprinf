<?php


use PHPUnit\Framework\TestCase;
use Model\proyecto;

final class ProyectoTest extends TestCase
{
  protected static int $idProyecto;

  public function testInsertTransaction(): void
  {
    $proyecto = new Proyecto();
    $comunidadAutonoma = 1;
    $data = [
      'cerrado' => 0,
      'nombre' => 'Gestion de Proyectos PNFI',
      'fase_id' => 'TR2_1',
      'comunidad' => 'UPTAEB',
      'direccion' => 'Av. La Salle',
      'resumen' => 'Proyecto sociotecnologico',
      'consejo_comunal_id' => ($comunidadAutonoma == 1) ? null : 1,
      'motor_productivo' => 'Productivo',
      'parroquia_id' => 1,
      'tutor_in' => 'p-135482354',
      'tutor_ex' => 'Jose',
      'observaciones' => 'asdasd',
      'tlf_tex' => 3232323,
      'integrantes' => ['e-63578', 'e-77765', 'e-80516'],
    ];
    $proyecto->setProyectData($data);

    $resultado = $proyecto->insertTransaction();
    $this->assertEquals(true, $resultado);

    self::$idProyecto = $proyecto->id;
  }

  function testFind(): void
  {
    $proyecto = new Proyecto();
    $infoProyecto = $proyecto->find(self::$idProyecto);
    $this->assertNotEmpty($infoProyecto);
    $this->assertEquals('Gestion de Proyectos PNFI', $infoProyecto['nombre']);
    $this->assertEquals(null, $infoProyecto['consejo_comunal_id']);
  }

  function testActualizar(): void
  {
    $proyecto = new Proyecto();
    $comunidadAutonoma = 0;
    $data = [
      'id' => self::$idProyecto,
      'cerrado' => 0,
      'nombre' => 'Actualizacion Gestion de Proyectos PNFI',
      'fase_id' => 'TR2_1',
      'comunidad' => 'UPTAEB',
      'direccion' => 'Av. La Salle',
      'resumen' => 'Proyecto sociotecnologico',
      'consejo_comunal_id' => ($comunidadAutonoma == 1) ? null : 1,
      'motor_productivo' => 'Productivo',
      'parroquia_id' => 1,
      'tutor_in' => 'p-135482354',
      'tutor_ex' => 'Jose',
      'observaciones' => 'asdasd',
      'tlf_tex' => 3232323,
      'integrantes' => ['e-63578', 'e-77765', 'e-80516'],
    ];

    $proyecto->setProyectData($data);

    $resultado = $proyecto->actualizar();

    $this->assertEquals(true, $resultado);

    $proyectoActualizado = $proyecto->find(self::$idProyecto);

    $this->assertNotEmpty($proyectoActualizado);
    $this->assertEquals('Actualizacion Gestion de Proyectos PNFI', $proyectoActualizado['nombre']); // verifica nombre actualizado
    $this->assertEquals(1, $proyectoActualizado['consejo_comunal_id']); // verifica consejo comunal actualizado
  }

  function testActualizarIntegrantes(): void
  {
    $proyecto = new Proyecto();
    $proyectoPrueba = $proyecto->find(self::$idProyecto);
    $this->assertNotEmpty($proyectoPrueba);
    $integrantes = $proyecto->obtenerIntegrantes(self::$idProyecto);
    $this->assertNotEmpty($integrantes);
    $idIntegrantes = array_column($integrantes, 'id');

    $this->assertContains('e-80516', $idIntegrantes);

    $idIntegrantes = array_diff($idIntegrantes, ["e-80516"]);

    $data = [
      'id' => self::$idProyecto,
      'integrantes' => $idIntegrantes,
    ];
    $proyecto->setProyectData($data);
    $resultado = $proyecto->actualizarIntegrantes();

    $this->assertEquals(true, $resultado);

    $integrantesActualizados = $proyecto->obtenerIntegrantes(self::$idProyecto);
    $this->assertNotEmpty($integrantesActualizados);
    $integrantesActualizados = array_column($integrantesActualizados, 'id');
    // verificar que no contenga integrante eliminado de grupo de proyecto
    $this->assertNotContains('e-80516', $integrantesActualizados);
  }

  public function testFindByStudent(): void
  {
    $proyecto = new Proyecto();
    $proyectoPrueba = $proyecto->findByStudent('e-63578');
    $this->assertNotEmpty($proyectoPrueba);
  }

  function testRemover(): void
  {
    $proyecto = new Proyecto();
    $resultado = $proyecto->remover(self::$idProyecto);
    $this->assertEquals(true, $resultado);
  }


  public static  function tearDownAfterClass(): void
  {
    parent::tearDownAfterClass();
  }
}
