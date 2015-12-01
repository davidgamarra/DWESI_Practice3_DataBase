<?php

class Comentario {
	
	private $id;
	private $login;
	private $id_mensaje;
	private $texto;
	private $fecha;
	
	function __construct($id = null, $login = null, $id_mensaje = null, $texto = null, $fecha = null) {
		$this->id = $id;
		$this->login = $login;
		$this->id_mensaje = $id_mensaje;
		$this->texto = $texto;
		$this->fecha = $fecha;
	}

	function setId($id) { $this->id = $id; }
	function getId() { return $this->id; }
	function setLogin($login) { $this->login = $login; }
	function getLogin() { return $this->login; }
	function setId_mensaje($id_mensaje) { $this->id_mensaje = $id_mensaje; }
	function getId_mensaje() { return $this->id_mensaje; }
	function setTexto($texto) { $this->texto = $texto; }
	function getTexto() { return $this->texto; }
	function setFecha($fecha) { $this->fecha = $fecha; }
	function getFecha() { 
		$d = DateTime::createFromFormat("Y-m-d H:i:s", $this->fecha);
		return $d->format("d/m/Y - H:i");
	}

	function getJson() {
		$r = '{';
		foreach($this as $key => $value) {
			$r .= '"' . $key . '":"' . $value . '",';
		}
		$r = substr($r, 0, -1);
		$r .= '}';
		return $r;
	}

	function set($values, $index=0) {
		$i = 0;
		foreach($this as $key => $value) {
			$this->$key = $values[$i+$index];
			$i++;
		}
	}
	
	function getArray($values=true) {
		$r = array();
		foreach($this as $key => $value) {
			if($values){
				$r[$key] = $value;
			} else {
				$r[$key] = null;
			}
		}
		return $r;
	}
	
	function read(){
		foreach($this as $key => $value) {
			$this->$key = Request::req($key);
		}
	}
	
}