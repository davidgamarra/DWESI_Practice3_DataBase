<?php

class Mensaje {
	
	private $id;
	private $login;
	private $texto;
	private $fecha;

	function __construct($id = null, $login = null, $texto = null, $fecha = null) {
		$this->id = $id;
		$this->login = $login;
		$this->texto = $texto;
		$this->fecha = $fecha;
	}
	
	function setId($id) { $this->id = $id; }
	function getId() { return $this->id; }
	function setLogin($login) { $this->login = $login; }
	function getLogin() { return $this->login; }
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