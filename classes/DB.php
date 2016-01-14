<?php

/*
*	this is the only database connection.
*/

class DB{
	public $pdo;

	public function __construct(){
		try{
			$data = array(
			"videos" => "",
			"root"   => "",
			"pass"   => ""
			);

			$this->pdo = new PDO('mysql:host=localhost;dbname=' . $data['videos'], '' . $data['root'], '' . $data['pass']);
			$this->pdo->exec("set names utf8");
		}catch(PDOException $e){
			exit("database connection error. $e");
		}

	}
}
