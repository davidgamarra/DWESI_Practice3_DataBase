<?php

class ManageUsuario {
	
	private $db = null;
	private $table = "usuario";
	
	function __construct(DataBase $db) {
		$this->db = $db;
	}
	
	function get($login) {
		$params = array();
		$params["login"] = $login;
		$this->db->select($this->table, "*", "login=:login", $params);
		$row = $this->db->getRow();
		$usuario = new Usuario();
		$usuario->set($row);
		return $usuario;
	}
	
	function set(Usuario $usuario) {
		$conditions = array();
		$conditions["login"] = $usuario->getLogin();
		return $this->db->update($this->table, $usuario->getArray(), $conditions);
	}
	
	function insert(Usuario $usuario) {
		return $this->db->insert($this->table, $usuario->getArray(), false);
	}
	
	function getList($page = 1, $order="", $nrpp=Constant::NRPP) {
		$reg = ($page-1)*$nrpp;
		$this->db->select($this->table, "*", "1=1", array(), $order, "$reg, $nrpp");
		$r = array();
		while($row = $this->db->getRow()) {
			$usuario = new Usuario();
			$usuario->set($row);
			$r[] = $usuario;
		}
		return $r;
	}
	
	function count($condition = "1=1", $params = array()){
		return $this->db->count($this->table, $condition, $params);
	}
	
}