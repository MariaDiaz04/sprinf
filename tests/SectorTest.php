<?php


use PHPUnit\Framework\TestCase;
use Model\sector;

final class SectorTest extends TestCase
{
  protected static int $idIndicadorPrueba;


  public function testCreacion(): void
  {

    $sector = new sector();
    $sector->setData([
      'parroquia_id' => '10',
      'nombre' => 'Eje 5',
    ]);

    $resultado = $sector->save();

    self::$idIndicadorPrueba = $sector->id;
    $this->assertEquals(true, $resultado);
  }

  function testActualizacion(): void
  {
    $sector = new sector();
    $sector->setData([
      'id' => self::$idIndicadorPrueba,
      'parroquia_id' => '10',
      'nombre' => 'Eje 5 Actualizado',
    ]);

    $resultado = $sector->actualizar();

    $this->assertEquals(true, $resultado);

    $sectorInfo = $sector->find($sector->id);

    $this->assertNotEmpty($sectorInfo);
    $this->assertEquals('Eje 5 Actualizado', $sectorInfo['nombre']);
  }

  function testBorrado(): void
  {
    $sector = new sector();
    $sector->setData([
      'id' => self::$idIndicadorPrueba
    ]);

    $resultado = $sector->remove();
    $this->assertEquals(true, $resultado);
  }

  public static  function tearDownAfterClass(): void
  {
    parent::tearDownAfterClass();
  }
}
