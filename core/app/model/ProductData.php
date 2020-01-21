<?php
class ProductData {
	public static $tablename = "product";

	public function ProductData(){
		$this->name = "";
		$this->barcode = "";
		$this->description = "";
		$this->inventary_min = "";
		$this->inventary_in = "";
		$this->price_in = "";
		$this->state = "";
		$this->funding = "";
		$this->date_expire = "";
		$this->date_warranty = "";
		$this->user_id = "";
		$this->category_id = "";
		$this->created_at = "NOW()";
		
	}

	public function getCategory(){ return CategoryData::getById($this->category_id);}

	public function add(){
		$sql = "insert into ".self::$tablename." (name, barcode, description, inventary_min, inventary_in, price_in, state, funding, stock, date_expire, date_warranty, user_id, category_id, created_at)";
		$sql .= "value (\"$this->name\",\"$this->barcode\",\"$this->description\",\"$this->inventary_min\",\"$this->inventary_in\",\"$this->price_in\",$this->state,\"$this->funding\",\"$this->stock\",$this->date_expire,$this->date_warranty,$this->user_id,$this->category_id,NOW())";
		return Executor::doit($sql);
	}
	public function add_with_image(){
		$sql = "insert into ".self::$tablename." (name, image, barcode, description, inventary_min, inventary_in, price_in, state, funding, stock, date_expire, date_warranty, user_id, category_id, created_at)";
		$sql .= "value (\"$this->name\",$this->image,\"$this->barcode\",\"$this->description\",\"$this->inventary_min\",\"$this->inventary_in\",\"$this->price_in\",$this->state,\"$this->funding\",\"$this->stock\",$this->date_expire,$this->date_warranty,$this->user_id,$this->category_id,NOW())";
		return Executor::doit($sql);
	}


	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto ProductData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set barcode=\"$this->barcode\",name=\"$this->name\",price_in=\"$this->price_in\",price_out=\"$this->price_out\",unit=\"$this->unit\",presentation=\"$this->presentation\",category_id=$this->category_id,inventary_min=\"$this->inventary_min\",description=\"$this->description\",is_active=\"$this->is_active\" where id=$this->id";
		Executor::doit($sql);
	}

	public function del_category(){
		$sql = "update ".self::$tablename." set category_id=NULL where id=$this->id";
		Executor::doit($sql);
	}


	public function update_image(){
		$sql = "update ".self::$tablename." set image=\"$this->image\" where id=$this->id";
		Executor::doit($sql);
	}

	public function update_user_responsable(){
		$sql = "update ".self::$tablename." set asing=\"$this->user_responsable\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from " .self::$tablename." INNER JOIN units ON product.unit=units.unit_id where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ProductData());

	}



	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}

	public static function getAllByCategoryId($id){
		$sql = "select * from ".self::$tablename." where category_id=$id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}

	public static function getAllByPage($start_from,$limit){
		$sql = "select * from ".self::$tablename." where id>=$start_from limit $limit";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}


	public static function getLike($p){
		$sql = "select * from ".self::$tablename." INNER JOIN units ON product.unit=units.unit_id  where barcode like '%$p%' or name like '%$p%' or id like '%$p%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}



	public static function getAllByUserId($user_id){
		$sql = "select * from ".self::$tablename." where user_id=$user_id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}

}

?>