<?php
class SubCategoryData {
	public static $tablename = "category_id_sub";



	public function CategoryData(){
		$this->name = "";
		$this->abreviation = "";
		$this->description = "";
		$this->codigo = "";
		$this->id = "";
		$this->category_id = "";
		$this->subcategory = '';
		$this->name_category = '';
		$this->cantidad = '';
		$this->created_at = "NOW()";
		

	}

	

	public function add(){
		$sql = "insert into ".self::$tablename." (id,name,id_category,description,created_at) ";
		$sql .= "value ($this->id,\"$this->name\",\"$this->category_id\",\"$this->description\",NOW())";
		Executor::doit($sql);
		//return $sql;
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}

	public static function delByIds($id,$id2){
		$sql = "delete from ".self::$tablename." where id=".$id." AND id_category=".$id2;
		Executor::doit($sql);
	}
	
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto CategoryData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set id=$this->codigo,name=\"$this->name\",id_category=\"$this->category_id\",description=\"$this->description\" where id=$this->id AND id_category=$this->id_category";
		Executor::doit($sql);
		//print_r($sql);
	}


	public static function getByIds($id,$id2){
		$sql = "select * from ".self::$tablename." where id=".$id ." AND id_category=".$id2;
		$query = Executor::doit($sql);
		return Model::one($query[0],new SubCategoryData());
		//return $sql;
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SubCategoryData());
	}

	

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new SubCategoryData());
	}

	public static function getAllSub($id){
		$sql = "SELECT * FROM category_id_sub WHERE id_category = ".$id;
		$query = Executor::doit($sql);
		return Model::many($query[0],new SubCategoryData());
	}

	public static function getSubAll(){
		$sql = "SELECT A.id,A.name,B.name AS name_category FROM category_id_sub A INNER JOIN category B ON A.id_category=B.id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SubCategoryData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CategoryData());
	}




}

?>