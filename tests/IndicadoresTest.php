<?php


use PHPUnit\Framework\TestCase;
use Model\indicadores;

final class IndicadoresTest extends TestCase
{
  protected static int $idIndicadorPrueba;


  public function testCreacion(): void
  {

    $indicadores = new indicadores();
    $indicadores->setData([
      'dimension_id' => '10',
      'nombre' => 'Indicador de prueba',
      'ponderacion' => 1
    ]);

    $resultado = $indicadores->save();

    self::$idIndicadorPrueba = $indicadores->id;
    $this->assertEquals(true, $resultado);
  }

  function testActualizacion(): void
  {
    $indicadores = new indicadores();
    $indicadores->setData([
      'id' => self::$idIndicadorPrueba,
      'dimension_id' => '10',
      'nombre' => 'Indicador de prueba Actualizado',
      'ponderacion' => 1
    ]);

    $resultado = $indicadores->actualizar();

    $this->assertEquals(true, $resultado);

    $indicadores = $indicadores->find($indicadores->id);

    $this->assertNotEmpty($indicadores);
    $this->assertEquals('Indicador de prueba Actualizado', $indicadores['nombre']);
  }

  function testBorrado(): void
  {
    $indicadores = new indicadores();
    $indicadores->setData([
      'id' => self::$idIndicadorPrueba
    ]);

    $resultado = $indicadores->remove();
    $this->assertEquals(true, $resultado);
  }

  public static  function tearDownAfterClass(): void
  {
    parent::tearDownAfterClass();
  }
}
