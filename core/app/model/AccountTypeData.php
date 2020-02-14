<?php
class AccountTypeData {
	public static $tablename = "account_type";

	public function unitsData(){
		$this->name = "";
		
		
    }
    
    public function add(){
		$sql = "insert into ".self::$tablename." (name) ";
		$sql .= "value (\"$this->name\")";
		Executor::doit($sql);
		//print_r($sql);
	}

	public static function delByunit_id($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->unit_id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto CategoryData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\" where unit_id=$this->unit_id";
		Executor::doit($sql);
	}


	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new unitsData());
	}



	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new unitsData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new unitsData());
	}
}
?>