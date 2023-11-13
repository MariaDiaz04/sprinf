<?php


use PHPUnit\Framework\TestCase;
use Model\consejoComunal;

final class ConsejoComunalTest extends TestCase
{
  protected static int $idConsejoComunalDePrueba;


  public function testCreacion(): void
  {

    $sector = new consejoComunal();
    $sector->setData([
      'nombre' => 'Consejo Comunal de prueba',
      'nombre_vocero' => 'Vocero de Prueba',
      'sector_id' => 1,
      'telefono' => 254658,
    ]);

    $resultado = $sector->save();

    self::$idConsejoComunalDePrueba = $sector->id;
    $this->assertEquals(true, $resultado);
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

    $this->assertEquals(true, $resultado);

    $sectorInfo = $sector->find($sector->id);

    $this->assertNotEmpty($sectorInfo);
    $this->assertEquals('Consejo Comunal de prueba', $sectorInfo['consejo_comunal_nombre']);
  }

  function testBorrado(): void
  {
    $sector = new consejoComunal();
    $resultado = $sector->remove(self::$idConsejoComunalDePrueba);
    $this->assertEquals(true, $resultado);
  }

  public static  function tearDownAfterClass(): void
  {
    parent::tearDownAfterClass();
  }
}
