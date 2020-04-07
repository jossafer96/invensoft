<?php
class Database {
	public static $db;
	public static $con;
	function Database(){
		$this->user="root";$this->pass="";$this->host="localhost";$this->ddbb="asjinv";
		//$this->user="omniabox_inv";$this->pass="4sj2020%%INVENTARIO";$this->host="omniabox.org";$this->ddbb="omniabox_asjinv";
	}

	function connect(){
		$con = new mysqli($this->host,$this->user,$this->pass,$this->ddbb);
		return $con;
	}

	public static function getCon(){
		if(self::$con==null && self::$db==null){
			self::$db = new Database();
			self::$con = self::$db->connect();
		}
		return self::$con;
	}

}
?>
