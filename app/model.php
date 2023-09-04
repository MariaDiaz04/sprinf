<?php

namespace App;

use App\conexion;
use BadMethodCallException;
use Exception;
use Utils\SSP;

class model extends conexion
{

	public $by;

	// =====================  S E L E C T  ==================================
	// =====================  METODO PARA CONSULTAR  ==================================
	public function select(String $table, array $wheres = null, $fields = null)
	{
		$fields ? $sql = 'SELECT ' . $fields . ' FROM `' . $table . '` ' : $sql = 'SELECT * FROM `' . $table . '` ';
		if (isset($wheres)) {
			$sql = $sql . ' WHERE ';
			foreach ($wheres as $where) {
				$sql = $sql . ' `' . $where['0'] . '` ' . $where['1'] . ' ' . $where['2'] . ' ' . ' AND ';
			}
			$sql = substr($sql, 0, -5);
			$sql = $sql . ';';
		} else {
			$sql = $sql . ';';
		}
		$req = \PDO::query($sql);
		$v = array();
		while ($item = $req->fetch(\PDO::FETCH_ASSOC)) {
			$v[] = $item;
		}
		return $v;
	} //finaliza select

	public function selectOne(String $table, array $wheres = null, $fields = null)
	{
		$fields ? $sql = 'SELECT ' . $fields . ' FROM `' . $table . '` ' : $sql = 'SELECT * FROM `' . $table . '` ';
		if (isset($wheres)) {
			$sql = $sql . ' WHERE ';
			foreach ($wheres as $where) {
				$sql = $sql . ' `' . $where['0'] . '` ' . $where['1'] . ' ' . $where['2'] . ' ' . ' AND ';
			}
			$sql = substr($sql, 0, -5);
			$sql = $sql . ';';
		} else {
			$sql = $sql . ';';
		}
		$req = \PDO::query($sql);
		return $req->fetch(\PDO::FETCH_ASSOC);
	}

	// =====================  U P D A T E  ==================================
	// =====================  METODO PARA ACTUALIZAR ==================================

	public function update(String $table, array $changes, array $wheres)
	{
		$sql = 'UPDATE `' . $table . '` SET ';
		foreach ($changes as $key => $value) {
			$sql = $sql . ' `' . $key . '`=' . $value . ',';
		}
		$sql = substr($sql, 0, -1);
		if (isset($wheres)) {
			$sql = $sql . ' WHERE ';
			foreach ($wheres as $where) {
				$sql = $sql . ' `' . $where['0'] . '` ' . $where['1'] . ' ' . $where['2'] . ' ' . ' AND ';
			}
			$sql = substr($sql, 0, -5);
			$sql = $sql . ';';
		} else {
			$sql = $sql . ';';
		}

		// echo $sql;
		return \PDO::query($sql);
	} //finaliza update

	// =====================  S E T  ==================================
	// =====================  METODO PARA INSERTAR ==================================

	public function set(String $table, array $data)
	{
		$sql = 'INSERT INTO `' . $table . '` (';
		foreach ($data as $key => $value) {
			$sql = ' ' . $sql . '`' . $key . '`, ';
		}
		$sql = substr($sql, 0, -2);
		$sql = $sql . ') VALUES ( ';
		foreach ($data as $key => $value) {
			$sql = $sql . ' ' . $value . ', ';
		}
		$sql = substr($sql, 0, -2);
		$sql = $sql . ');';
		// echo $sql;
		return \PDO::query($sql);
	} //finaliza set

	// =====================  D E L E T E  ==================================
	// =====================  METODO PARA ELIMINAR ==================================

	public function delete(String $table, array $wheres = null)
	{
		$sql = 'DELETE FROM `' . $table . '` WHERE ';
		if (isset($wheres)) {
			foreach ($wheres as $where) {
				$sql = $sql . ' `' . $where['0'] . '` ' .
					$where['1'] . ' ' .
					$where['2'] . ' ' .
					' AND ';
			}

			$sql = substr($sql, 0, -6);
			$sql = $sql . ';';
		} else {
			$sql = $sql . '1;';
		}

		return \PDO::query($sql);
	} //finaliza delete

	// =====================  METODO PARA CONSULTAR  2==================================
	// =====================  Q U E R Y  ==================================
	public function querys(String $sql = null)
	{
		if (isset($sql)) {
			$req = \PDO::query($sql);
			$v = array();
			while ($item = $req->fetch(\PDO::FETCH_ASSOC)) {
				$v[] = $item;
			}
		}
		return $v;
	}
	//finaliza select 


	public function setted()
	{
		return $this->querys('SELECT @@identity AS id;')[0]['id'];
	} //finaliza setted


	// =====================  DATATABLE SELECT  ==================================


	/**
	 * getSSP
	 * 
	 * Función para inicializar clase de Server Side Processing
	 * tomando en cuenta la conexión a nuestra BD
	 *
	 * @param string $table
	 * @param string $primaryKey
	 * @param array $columns
	 * @return array
	 */
	public function getSSP(string $table, string $primaryKey, array $columns): array
	{
		$sql_details = array(
			'user' => $this->user,
			'pass' => $this->pass,
			'db'   => $this->db,
			'host' => $this->host
			// ,'charset' => 'utf8' // Depending on your PHP and MySQL config, you may need this
		);
		return SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns);
	}
}
