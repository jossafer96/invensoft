<?php


class upload {

    public function Upload(){
        $this->ruta = "";
		
    }
    
    public function File($archivo,$codigo){
        
		$ruta = 'C:/xampp/htdocs/invensoft/storage/files/'.$codigo.'_'.$archivo['name'];
        move_uploaded_file($archivo['tmp_name'],$ruta);
        return $ruta;
        /*
		$SQLStatement = $this->DBConexion->prepare("INSERT INTO imagenphp (urlPhoto) VALUES (:url)");
		$SQLStatement->bindParam(":url",$ruta);
		$SQLStatement->execute();
		*/
		
	}
}

?>
