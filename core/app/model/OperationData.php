<?php
class OperationData {
	public static $tablename = "operation";

	public function OperationData(){
		$this->id = "";
		$this->name = "";
		$this->product_id = "";
		$this->q = "";
		$this->price_in = "";
		$this->price_out = "NULL";
		$this->cut_id = "";
		$this->operation_type_id = "";
		$this->total = "";
		$this->user_operation = "";
		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (price_in,price_out,stock_id,product_id,q,operation_type_id,sell_id,created_at,description_operation,user_operation) ";
		$sql .= "value ($this->price_in,$this->price_out,$this->stock_id,$this->product_id,$this->q,$this->operation_type_id,$this->sell_id,$this->created_at,\"$this->description_operation\",$this->user)";
		//echo "<script type='text/javascript'>alert('$sql');</script>";
		return Executor::doit($sql);
		//print_r($sql);
		
	}

	public function add_cotization(){
		$sql = "insert into ".self::$tablename." (price_in,price_out,is_draft,stock_id,product_id,q,operation_type_id,sell_id,created_at) ";
		$sql .= "value ($this->price_in,$this->price_out,1,	$this->stock_id,\"$this->product_id\",\"$this->q\",$this->operation_type_id,$this->sell_id,$this->created_at)";
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

// partiendo de que ya tenemos creado un objecto OperationData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set product_id=\"$this->product_id\",q=\"$this->q\" where id=$this->id";
		Executor::doit($sql);
	}

	public function set_draft($d){
		$sql = "update ".self::$tablename." set is_draft=\"$d\" where id=$this->id";
		Executor::doit($sql);
	}


	public function update_q(){

		$sql = "update ".self::$tablename." set q=\"$this->q\" where id=$this->id";
		Executor::doit($sql);
	}

	public function update_type(){
		$sql = "update ".self::$tablename." set operation_type_id=\"$this->operation_type_id\" where id=$this->id";
		Executor::doit($sql);
	}


	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new OperationData());
	}



	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());

	}

	public static function getHistory(){
		$sql = "SELECT operation.id, product.name, operation.description_operation, CAST(operation.created_at AS VARCHAR(11)) as created_at,product.barcode, CONCAT(user.name,user.lastname) as user_operation FROM operation INNER JOIN operation_type ON operation.operation_type_id=operation_type.id INNER JOIN product ON operation.product_id=product.id INNER JOIN user ON operation.user_operation=user.id ORDER BY operation.id DESC";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());

	}



	public static function getAllByDateOfficial($stock,$start,$end){
 $sql = "select * from ".self::$tablename." where (date(created_at) >= \"$start\" and date(created_at) <= \"$end\") and stock_id=$stock order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}


public static function getPPByDateOfficial($start,$end){
 $sql = "select *,sum(q) as total from ".self::$tablename." where (date(created_at) >= \"$start\" and date(created_at) <= \"$end\") and operation_type_id=2 group by product_id order by total desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}

	public static function getAllByDateOfficialBP($stock,$product, $start,$end){
 $sql = "select * from ".self::$tablename." where (date(created_at) >= \"$start\" and date(created_at) <= \"$end\") and product_id=$product and stock_id=$stock order by created_at desc";
		if($start == $end){
		 $sql = "select * from ".self::$tablename." where date(created_at) = \"$start\" order by created_at desc";
		}
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}

	public function getProduct(){ return ProductData::getById($this->product_id);}
	public function getOperationtype(){ return OperationTypeData::getById($this->operation_type_id);}



	public static function getQ($product_id){
		$q=0;
		$operations = self::getAllByProductId($product_id);
		$input_id = OperationTypeData::getByName("Entrada")->id;
		$new_id = OperationTypeData::getByName("Nuevo producto")->id;
		$output_id = OperationTypeData::getByName("Salida")->id;
		foreach($operations as $operation){
				if($operation->operation_type_id==$input_id){ 
					$q+=$operation->q; 
				}else if($operation->operation_type_id==$new_id){  
					$q+=$operation->q;
				}
				else if($operation->operation_type_id==$output_id){  
					$q+=(-$operation->q); 
				}
		}
		// print_r($data);
		return $q;
	}



	public static function getQByStock($product_id,$stock_id){
		$q=0;
		$operations = self::getAllByProductIdAndStock($product_id,$stock_id);
		$input_id = OperationTypeData::getByName("Entrada")->id;
		$new_id = OperationTypeData::getByName("Nuevo Producto")->id;
		$output_id = OperationTypeData::getByName("salida")->id;
		foreach($operations as $operation){
				if($operation->operation_type_id==$input_id){ 
					$q+=$operation->q; 
				}else if($operation->operation_type_id==$new_id){  
					$q+=$operation->q;
				}
				else if($operation->operation_type_id==$output_id){
					  $q+=(-$operation->q); 
					}
		}
		// print_r($data);
		return $q;
	}

	public static function getRByStock($product_id,$stock_id){
		$q=0;
		$operations = self::getAllByProductIdAndStock($product_id,$stock_id);
		$input_id = OperationTypeData::getByName("entrada-pendiente")->id;
		foreach($operations as $operation){
				if($operation->operation_type_id==$input_id){ $q+=$operation->q; }
		}
		// print_r($data);
		return $q;
	}

	public static function getDByStock($product_id,$stock_id){
		$q=0;
		$operations = self::getAllByProductIdAndStock($product_id,$stock_id);
		$input_id = OperationTypeData::getByName("salida-pendiente")->id;
		foreach($operations as $operation){
				if($operation->operation_type_id==$input_id){ $q+=$operation->q; }
		}
		// print_r($data);
		return $q;
	}

	public static function getAllByProductIdCutId($product_id,$cut_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and cut_id=$cut_id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}

	public static function getAllByProductId($product_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id  order by created_at asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}

	public static function getAllByProductIdAndStock($product_id,$stock_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and stock_id=$stock_id and is_draft=0 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}

	public static function getAllByProductIdCutIdOficial($product_id,$cut_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and cut_id=$cut_id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}


	public static function getAllProductsBySellId($sell_id){
		$sql = "select * from ".self::$tablename." where sell_id=$sell_id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}


	public static function getAllByProductIdCutIdYesF($product_id,$cut_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and cut_id=$cut_id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
		
	}

////////////////////////////////////////////////////////////////////
	public static function getOutputQ($product_id,$cut_id){
		$q=0;
		$operations = self::getOutputByProductIdCutId($product_id,$cut_id);
		$input_id = OperationTypeData::getByName("entrada")->id;
		$output_id = OperationTypeData::getByName("salida")->id;
		foreach($operations as $operation){
			if($operation->operation_type_id==$input_id){ $q+=$operation->q; }
			else if($operation->operation_type_id==$output_id){  $q+=(-$operation->q); }
		}
		// print_r($data);
		return $q;
	}

	public static function getOutputQYesF($product_id){
		$q=0;
		$operations = self::getOutputByProductId($product_id);
		$input_id = OperationTypeData::getByName("entrada")->id;
		$output_id = OperationTypeData::getByName("salida")->id;
		foreach($operations as $operation){
			if($operation->operation_type_id==$input_id){ $q+=$operation->q; }
			else if($operation->operation_type_id==$output_id){  $q+=(-$operation->q); }
		}
		// print_r($data);
		return $q;
	}

	public static function getInputQByStock($product_id,$stock_id){
		$q=0;
		$operations = self::getInputByProductIdAndStock($product_id,$stock_id);
		$input_id = OperationTypeData::getByName("entrada")->id;
		foreach($operations as $operation){
			if($operation->operation_type_id==$input_id){ $q+=$operation->q; }
		}
		// print_r($data);
		return $q;
	}



	public static function getOutputByProductIdCutId($product_id,$cut_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and cut_id=$cut_id and operation_type_id=2 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}


	public static function getOutputByProductId($product_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and operation_type_id=2 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}

////////////////////////////////////////////////////////////////////
	public static function getInputQ($product_id,$cut_id){
		$q=0;
		//return Model::many($query[0],new OperationData());
		$operations = self::getInputByProductId($product_id);
		$input_id = OperationTypeData::getByName("entrada")->id;
		$output_id = OperationTypeData::getByName("salida")->id;
		foreach($operations as $operation){
			if($operation->operation_type_id==$input_id){ $q+=$operation->q; }
			else if($operation->operation_type_id==$output_id){  $q+=(-$operation->q); }
		}
		// print_r($data);
		return $q;
	}


	public static function getInputByProductIdCutId($product_id,$cut_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and cut_id=$cut_id and operation_type_id=1 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}

	public static function getInputByProductId($product_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and operation_type_id=1 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}

	public static function getInputByProductIdAndStock($product_id,$stock_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and operation_type_id=1 and stock_id=$stock_id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}

	public static function getInputByProductIdCutIdYesF($product_id,$cut_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and cut_id=$cut_id and operation_type_id=1 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}

////////////////////////////////////////////////////////////////////////////
public static function getInfPDF($product_id){
	$sql = "SELECT operation.id as operation_id, operation.created_at as date_operation, operation.product_id 
	as product_id, product.name as name, product.barcode as barcode, product.asing as asing, 
	product.user_responsable as user_responsable, user.name as user_operation FROM operation INNER JOIN 
	product ON operation.product_id=product.id INNER JOIN user ON operation.user_operation=user.id where 
	operation.id= (SELECT MAX(operation.id) FROM operation where operation.product_id=".$product_id.")";
	$query = Executor::doit($sql);
	return Model::many($query[0],new OperationData());
}

}

?>