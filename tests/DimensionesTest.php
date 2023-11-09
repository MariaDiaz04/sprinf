<?php


use PHPUnit\Framework\TestCase;
use Model\Dimension;

final class DimensionesTest extends TestCase
{
  protected static Dimension $dimensiones;
  protected static int $idDimensionPrueba;

  public static  function setUpBeforeClass(): void
  {
    parent::setUpBeforeClass();

    // $dimensiones = new Dimension();

    // $dimensiones->setData($data);
  }

  public function testInsertTransaction(): void
  {

    $dimensiones = new Dimension();
    $dimensiones->setData([
      'unidad_id' => 'ASESOR3078303_1',
      'nombre' => 'Dimension Prueba',
      'grupal' => 1,
      'indicadores' => [[
        'nombre' => 'sdas',
        'ponderacion' => 2
      ]]
    ]);
    $resultado = $dimensiones->insertTransaction();
    self::$idDimensionPrueba = $dimensiones->id;
    $this->assertEquals(true, $resultado);
  }

  function testActualizar(): void
  {
    $dimensiones = new Dimension();
    $data = [
      'id' => self::$idDimensionPrueba,
      'unidad_id' => 'ASESOR3078303_1',
      'nombre' => 'Actualización Dimension Prueba',
      'grupal' => 1,
    ];

    $dimensiones->setData($data);

    $resultado = $dimensiones->actualizar();

    $this->assertEquals(true, $resultado);

    $dimensiones = $dimensiones->find($dimensiones->id);

    $this->assertNotEmpty($dimensiones);
    $this->assertEquals('Actualización Dimension Prueba', $dimensiones['nombre']); // verifica nombre actualizado
  }

  function testRemover(): void
  {
    $dimensiones = new Dimension();
    $dimensiones->setData(['id' => self::$idDimensionPrueba]);
    $resultado = $dimensiones->remover();
    $this->assertEquals(true, $resultado);
  }

  public static  function tearDownAfterClass(): void
  {
    parent::tearDownAfterClass();
  }
}
