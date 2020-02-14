<?php
class unitsData {
	public static $tablename = "units";

	public function unitsData(){
		$this->name_unit = "";
		$this->description = "";
		
    }
    
    public function add(){
		$sql = "insert into units (name_unit,description) ";
		$sql .= "value (\"$this->name_unit\",\"$this->description\")";
		Executor::doit($sql);
		//print_r($sql);
	}

	public static function delByunit_id($unit_id){
		$sql = "delete from ".self::$tablename." where unit_id=$unit_id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where unit_id=$this->unit_id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto CategoryData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name_unit=\"$this->name_unit\",description=\"$this->description\" where unit_id=$this->unit_id";
		Executor::doit($sql);
	}


	public static function getById($unit_id){
		$sql = "select * from ".self::$tablename." where unit_id=$unit_id";
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