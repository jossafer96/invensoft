<?php
class AsingsData {
	public static $tablename = "asings";

	public function AsingsData(){
		
		$this->description = "";
		$this->product_id = "";
		$this->user_id = "";
		$this->is_active = "";
		$this->created_at = "";
		$this->finish_at = "";
		
    }
    
    public function add(){
		$sql = "insert into  ".self::$tablename." (description, product_id, user_id, is_active, created_at, finish_at) ";
		$sql .= "value (\"$this->description\",$this->product_id,$this->user_id,$this->is_active,$this->created_at,$this->finish_at)";
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
		$sql = "update ".self::$tablename." set description=\"$this->description\",product_id=$this->product_id,user_id=$this->user_id,is_active=$this->is_active,finish_at=$this->finish_at where id=$this->id";
		Executor::doit($sql);
		//print_r($sql);
	}


	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new unitsData());
	}

	public static function getAllById($product_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new unitsData());
	}

	public static function getUlt($product_id){
		$sql = "select * from ".self::$tablename." where id = (SELECT MAX(id) FROM ".self::$tablename. ") and product_id=$product_id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new unitsData());
		//print_r($sql);
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