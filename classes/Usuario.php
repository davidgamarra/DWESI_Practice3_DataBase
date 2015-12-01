<?php 

class Usuario {
	
	private $login, $psw, $email, $nombre, $apellidos, $bday;
	
	function __construct($login = null, $psw = null, $email = null, $nombre = null, $apellidos = null, $bday = null){
		$this->login = $login;
		$this->psw = $psw;
		$this->email = $email;
		$this->nombre = $nombre;
		$this->apellidos = $apellidos;
		$this->bday = $bday;
	}
	
	function setLogin($login) { $this->login = $login; }
	function getLogin() { return $this->login; }
	function setPsw($psw) { $this->psw = $psw; }
	function getPsw() { return $this->psw; }
	function setEmail($email) { $this->email = $email; }
	function getEmail() { return $this->email; }
	function setNombre($nombre) { $this->nombre = $nombre; }
	function getNombre() { return $this->nombre; }
	function setApellidos($apellidos) { $this->apellidos = $apellidos; }
	function getApellidos() { return $this->apellidos; }
	function setBday($bday) { $this->bday = $bday; }
	function getFecha() { return $this->bday; }
	function getBday() { 
		$d = DateTime::createFromFormat("Y-m-d", $this->bday);
		return $d->format("d - M - Y");
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