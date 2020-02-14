<?php
class PasswordData {
	public static $tablename = "password";

	public function PasswordData(){
		$this->id= "";
		$this->id_type= "";
		$this->description="";
		$this->password="";
		$this->product_id = "";
		
    }
    
    public function add(){
		$sql = "insert into ".self::$tablename." (id_type,description,password,product_id) ";
		$sql .= "value ($this->id_type,\"$this->description\",\"$this->password\",$this->product_id)";
		Executor::doit($sql);
		//print_r($sql);
	}

	public static function delByunit_id($unit_id){
		$sql = "delete from ".self::$tablename." where unit_id=$unit_id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto CategoryData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set id_type=$this->id_type,description=\"$this->description\",password=\"$this->password\",product_id=$this->product_id where id=$this->id";
		Executor::doit($sql);
	}


	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PasswordData());
	}

	public static function getByProductId($product_id){
		$sql = "SELECT PASSWORD.id, password.description, password.password, password.product_id, account_type.name as name_type FROM PASSWORD INNER JOIN account_type ON password.id_type=account_type.id WHERE password.product_id=$product_id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PasswordData());
	}



	public static function getAll(){
		$sql = "SELECT PASSWORD.id, password.description, password.password , password.product_id, account_type.name as type, product.id as id_product, product.barcode as barcode FROM PASSWORD INNER JOIN account_type ON password.id_type=account_type.id INNER JOIN product on password.product_id=product.id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PasswordData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PasswordData());
	}
}
?>