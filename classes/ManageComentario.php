<?php 

class ManageComentario {
	
	private $db = null;
	private $table = "comentario";
	
	function __construct(DataBase $db) {
		$this->db = $db;
	}
	
	function get($id) {
		$params = array();
		$params["id"] = $id;
		$this->db->select($this->table, "*", "id=:id", $params);
		$row = $this->db->getRow();
		$comentario = new Comentario();
		$comentario->set($row);
		return $comentario;
	}
	
	function delete($id) {
		$params = array();
		$params["id"] = $id;
		return $this->db->delete($this->table, $params);
	}
	
	function erase(Comentario $comentario) {
		return $this->delete($comentario->getId());
	}
	
	function set(Comentario $comentario) {
		$conditions = array();
		$conditions["id"] = $comentario->getId();
		return $this->db->update($this->table, $comentario->getArray(), $conditions);
	}
	
	function insert(Comentario $comentario) {
		return $this->db->insert($this->table, $comentario->getArray());
	}
	
	function getList($id) {
		$params = array();
		$params["id_mensaje"] = $id;
		$this->db->select($this->table, "*", "id_mensaje=:id_mensaje", $params, "fecha");
		$r = array();
		while($row = $this->db->getRow()) {
			$comentario = new Comentario();
			$comentario->set($row);
			$r[] = $comentario;
		}
		return $r;
	}
	
	function count($condition = "1=1", $params = array()){
		return $this->db->count($this->table, $condition, $params);
	}
	
}