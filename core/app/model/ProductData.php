<?php
class ProductData {
	public static $tablename = "product";

	public function ProductData(){
		$this->name = "";
		$this->barcode = "";
		$this->category_id = "";
		$this->category_id_sub = "";
		$this->description = "";
		$this->price_in = "";
		$this->state = "";
		$this->funding = "";
		$this->stock = "";
		$this->unit_id = "";
		$this->asing = "";
		$this->date_expire = "";
		$this->date_warranty = "";
		$this->inventary_min = "";
		$this->inventary_in = "";
		$this->user_id = "";
		$this->created_at = "NOW()";
		$this->brand = "";
		$this->model = "";
		$this->serial = "";
		$this->name_unit = "";
		$this->description_unit = "";
		$this->is_unique = "";
		
	}

	public function getCategory(){ return CategoryData::getById($this->category_id);}
	public function getUnit(){ return unitsData::getById($this->unit_id);}

	public function add(){
		$sql = "insert into ".self::$tablename." (name, barcode, description, inventary_min, inventary_in, price_in, state, funding, stock, date_expire, date_warranty, user_id, category_id, user_responsable, asing,category_id_sub, created_at, brand, model, serial, unit_id,is_unique)";
		$sql .= "value (\"$this->name\",\"$this->barcode\",\"$this->description\",\"$this->inventary_min\",\"$this->inventary_in\",\"$this->price_in\",$this->state,\"$this->funding\",\"$this->stock\",\"$this->date_expire\",\"$this->date_warranty\",$this->user_id,$this->category_id,\"$this->user_responsable\",\"$this->asing\",$this->subcategory_id,NOW(),\"$this->brand\",\"$this->model\",\"$this->serial\",$this->unit_id,$this->is_unique)";
		return Executor::doit($sql);
		//return $sql;
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
		//Executor::doit($sql);
		return $sql;
	}

// partiendo de que ya tenemos creado un objecto ProductData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",barcode=\"$this->barcode\",category_id=$this->category_id,category_id_sub=$this->category_id_sub,description=\"$this->description\",price_in=$this->price_in,state=$this->state,funding=\"$this->funding\",stock=$this->stock,is_active=$this->is_active,unit_id=$this->unit_id,asing=\"$this->asing\",date_expire=\"$this->date_expire\",date_warranty=\"$this->date_warranty\",inventary_min=$this->inventary_min,inventary_in=$this->inventary_in,user_responsable=\"$this->user_responsable\",brand=\"$this->brand\",model=\"$this->model\",serial=\"$this->serial\" where id=$this->id";
		Executor::doit($sql);
		//return $sql;
		
	}

	public function del_category(){
		$sql = "update ".self::$tablename." set category_id=NULL where id=$this->id";
		Executor::doit($sql);
	}

	public function disable(){
		$sql = "update ".self::$tablename." set is_active=0 where id=$this->id";
		Executor::doit($sql);
	}

	public function del_subcategory(){
		$sql = "update ".self::$tablename." set category_id_sub=NULL where id=$this->id";
		Executor::doit($sql);
	}

	public function del_unit(){
		$sql = "update ".self::$tablename." set unit_id=NULL where id=$this->id";
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
		$sql = "select * from " .self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ProductData());

	}



	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}

	public static function getAllActive(){
		$sql = "select * from ".self::$tablename." where is_active=1 ORDER BY id DESC";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}

	public static function getAllNoUnique(){
		$sql = "select * from ".self::$tablename." where is_unique=0 ORDER BY id DESC";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}

	public static function getAllByCategoryId($id){
		$sql = "select * from ".self::$tablename." where category_id=$id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}

	public static function getAllByUnitId($id){
		$sql = "select * from ".self::$tablename." where unit_id=$id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}

	public static function getAllBySubCategoryId($id,$id2){
		$sql = "select * from ".self::$tablename." where category_id_sub=".$id." and category_id=".$id2;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}

	public static function getAllByPage($start_from,$limit){
		$sql = "select * from ".self::$tablename." where id>=$start_from limit $limit";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}


	public static function getLike($p){
		$sql = "select * from ".self::$tablename." INNER JOIN units ON product.unit_id=units.unit_id  where barcode like '%$p%' or name like '%$p%' or id like '%$p%'";
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