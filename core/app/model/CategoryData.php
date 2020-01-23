<?php
class CategoryData {
	public static $tablename = "category";



	public function CategoryData(){
		$this->name = "";
		$this->abreviation = "";
		$this->codigo = "";
		$this->code = "";
		$this->id_category = "";
		$this->subcategory = '';
		$this->created_at = "NOW()";
		

	}

	public function add(){
		$sql = "insert into category (name,created_at) ";
		$sql .= "value (\"$this->name\",$this->created_at)";
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto CategoryData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\" where id=$this->id";
		Executor::doit($sql);
	}


	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CategoryData());
	}



	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new CategoryData());
	}

	public static function getAllSub($id){
		$sql = "SELECT * FROM subcategory WHERE id_category = ".$id;
		$query = Executor::doit($sql);
		return Model::many($query[0],new CategoryData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CategoryData());
	}

	public  function getNextCode($category,$subcategory){
		
		$sql = "SELECT * FROM subcategory
		INNER JOIN category
		ON subcategory.id_category=category.id
		WHERE subcategory.code=".$subcategory." and category.id=".$category;
		$query = Executor::doit($sql);
		return Model::many($query[0],new CategoryData());
		//return $sql;
	}

	public  function getCode($category,$subcategory){
		
		$sql = "SELECT * FROM subcategory
		INNER JOIN category
		ON subcategory.id_category=category.id
		WHERE subcategory.code=".$subcategory." and category.id=".$category;
		$query = Executor::doit($sql);
		return Model::many($query[0],new CategoryData());
		//return $sql;
	}


}

?>