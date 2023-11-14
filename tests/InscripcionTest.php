<?php


use PHPUnit\Framework\TestCase;
use Model\inscripcion;

final class InscripcionTest extends TestCase
{
  protected static int $idInscripcion;


  public function testCreacion(): void
  {

    $inscripcion = new inscripcion();
    $inscripcion->setData([
      'profesor_id' => 'p-23154875',
      'seccion_id' => 'IN4301',
      'unidad_curricular_id' => 'PIACA078303_1',
      'estudiante_id' => 'e-14496'
    ]);

    $resultado = $inscripcion->save();

    self::$idInscripcion = $inscripcion->id;
    $this->assertEquals(true, $resultado);
  }

  function testFind(): void
  {
    $inscripcion = new inscripcion();
    $infoInscripcion = $inscripcion->find(self::$idInscripcion);
    $this->assertNotEmpty($infoInscripcion);
  }
  function testFindByStudent(): void
  {
    $inscripcion = new inscripcion();
    $infoInscripcion = $inscripcion->findByStudent('e-14496');
    $this->assertNotEmpty($infoInscripcion);
  }

  function testUsuarioCursaMateria(): void
  {
    $inscripcion = new inscripcion();
    $inscripcionInfo = $inscripcion->usuarioCursaMateria('e-14496', 'PIACA078303_1');
    $this->assertNotEmpty($inscripcionInfo);
  }

  function testEvaluar(): void
  {
    $inscripcion = new inscripcion();
    $resultado = $inscripcion->evaluar(self::$idInscripcion, 3.5);
    $this->assertEquals(true, $resultado);
  }

  function testBorrado(): void
  {
    $inscripcion = new inscripcion();
    $resultado = $inscripcion->remove(self::$idInscripcion);
    $this->assertEquals(true, $resultado);
  }
}
