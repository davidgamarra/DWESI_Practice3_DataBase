<?php 

class ManageMensaje {
	
	private $db = null;
	private $table = "mensaje";
	
	function __construct(DataBase $db) {
		$this->db = $db;
	}
	
	function get($id) {
		$params = array();
		$params["id"] = $id;
		$this->db->select($this->table, "*", "id=:id", $params);
		$row = $this->db->getRow();
		$mensaje = new Mensaje();
		$mensaje->set($row);
		return $mensaje;
	}
	
	function delete($id) {
		$params = array();
		$params["id"] = $id;
		return $this->db->delete($this->table, $params);
	}
	
	function erase(Mensaje $mensaje) {
		return $this->delete($mensaje->getId());
	}
	
	function set(Mensaje $mensaje) {
		$conditions = array();
		$conditions["id"] = $mensaje->getId();
		return $this->db->update($this->table, $mensaje->getArray(), $conditions);
	}
	
	function insert(Mensaje $mensaje) {
		return $this->db->insert($this->table, $mensaje->getArray());
	}
	
	function getList($page = 1, $order="fecha", $nrpp=Constant::NRPP,$condition = "1=1", $params = array()) {
		$reg = ($page-1)*$nrpp;
		$this->db->select($this->table, "*", $condition, $params, $order, "$reg, $nrpp");
		$r = array();
		while($row = $this->db->getRow()) {
			$mensaje = new Mensaje();
			$mensaje->set($row);
			$r[] = $mensaje;
		}
		return $r;
	}
	
	function count($condition = "1=1", $params = array()){
		return $this->db->count($this->table, $condition, $params);
	}
	
}