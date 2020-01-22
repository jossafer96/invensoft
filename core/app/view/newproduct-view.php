<section class="content">
    <?php 
$categories = CategoryData::getAll();

$responsable = PersonData::getAll();
$stocks = StockData::getAll();
$states = StateData::getAll();
    ?>
<div class="row">
	<div class="col-md-12">
	<h1>Nuevo Equipo/Producto</h1>
	<br>
  <div class="box box-primary">
  <table class="table">
  <tr>
  <td>
		<form class="form-horizontal" method="post" enctype="multipart/form-data" id="addproduct" action="index.php?view=addproduct" role="form">
<div class="row">
<div class="form-group col-lg-6">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-10">
      <input type="text" name="name" required class="form-control" id="name" placeholder="Nombre del Producto">
    </div>
  </div>
  
  <div class="form-group col-lg-6">
    <label for="inputEmail1" class="col-lg-2 control-label">Codigo*</label>
    <div class="col-md-4">
      <input readonly type="text" style='font-size:30px;font-weight:bolder;text-align: center;background-color: #ecf0f5;' name="barcode" id="product_code" class="form-control" id="barcode" placeholder="Codigo de Barras del Producto">
    </div>
    <i>Elegir primero la categoria y subcategoria para poder generar codigo automaticamente</i>
  </div>
  
  <div class="form-group col-lg-6" >
    <label for="inputEmail1" class="col-lg-2 control-label">Categoria</label>
    <div class="col-md-10">
    <select  name="category_id" id="category_id" class="form-control" onchange="codenext(this.value)">
    <option value="">-- NINGUNA --</option>
    <?php foreach($categories as $category):?>
     
      <option value="<?php echo $category->id;?>"><?php echo $category->name;?></option>
    <?php endforeach;?>
      </select>    </div>
  </div>
  <div class="form-group col-lg-6" >
    <label for="inputEmail1" class="col-lg-2 control-label">SubCategoria</label>
    <div class="col-md-10">
    <select  name="subcategory_id" id="subcategory_id" class="form-control" onchange="codeFinal(this.value)">
    <option value="">-- NINGUNA --</option>
   
      </select>    </div>
  </div>
  

  
  <div class="form-group col-lg-12">
    <label for="inputEmail1" class="col-lg-1 control-label">Descripcion</label>
    <div class="col-md-10">
      <textarea rows="8" name="description" class="form-control" id="description" placeholder="Descripcion del Producto"></textarea>
    </div>
  </div>
  <div class="form-group col-lg-6">
    <label for="inputEmail1" class="col-lg-2 control-label">Precio*</label>
    <div class="col-md-10">
      <input type="text" name="price_in" required class="form-control" id="price_in" placeholder="Precio de compra">
    </div>
  </div>
  <div class="form-group col-lg-6" >
    <label for="inputEmail1" class="col-lg-2 control-label">Estado*</label>
    <div class="col-md-10">
    <select name="state" class="form-control">
    <option value="">-- SELECCIONE UNO --</option>
    <?php foreach($states as $state):?>
      <option value="<?php echo $state->id;?>"><?php echo $state->name_state;?></option>
    <?php endforeach;?>
      </select>    
      </div>
  </div>
  <div class="form-group col-lg-6">
    <label for="inputEmail1" class="col-lg-2 control-label">Fondos*</label>
    <div class="col-md-10">
      <input type="text" name="funding" required class="form-control" id="funding" placeholder="Fondos utilizados">
    </div>
  </div>
  <div class="form-group col-lg-6" >
    <label for="inputEmail1" class="col-lg-2 control-label">Almacen</label>
    <div class="col-md-10">
    <select name="category_id" class="form-control">
    <option value="">-- SELECCIONE UNO --</option>
    <?php foreach($stocks as $stock):?>
      <option value="<?php echo $stock->id;?>"><?php echo $stock->name;?></option>
    <?php endforeach;?>
      </select>    
    </div>
  </div>
  <div class="form-group col-lg-6">
    <label for="inputEmail1" class="col-lg-2 control-label">Unidad</label>
    <div class="col-md-10">
      <input type="text" name="unit" required class="form-control" id="unit" placeholder="Unidad o Programa al que esta asignado">
    </div>
  </div>
  <div class="form-group col-lg-6">
    <label for="inputEmail1" class="col-lg-2 control-label">Responsable</label>
    <div class="col-md-10">
      <input type="text" name="asing" required class="form-control" id="asing" placeholder="Persona asignada">
    </div>
  </div>
  <div class="form-group col-lg-6">
    <label for="inputEmail1" class=" col-lg-2 control-label">Fecha Vencimiento/Caducidad</label>
    <div class=" col-lg-8" style="float:right;background-color:#ecf0f5;    padding: 10px;">
    <input class='' type="radio" value="2" name="habilitarDeshabilitar_date_venc" onchange="habilitar(this.value);" checked> NO tiene fecha de Vencimiento/Caducidad <br>
		<input class='form' type="radio" value="1" name="habilitarDeshabilitar_date_venc" onchange="habilitar(this.value);" > SI tiene fecha de Vencimiento/Caducidad 
	<div>
  <label  class=" col-lg-8 control-label">Fecha de vencimiento</label>
    <input type="date" name="date_expire" id="date_expire" class='form-control'>
    
	</div>
    </div>
  </div>
  <div class="form-group col-lg-6">
    <label for="inputEmail1" class=" col-lg-2 control-label">Garantia</label>
    <div class=" col-lg-8" style="float:right;background-color:#ecf0f5;    padding: 10px;">
    <input class='' type="radio" value="2" name="habilitarDeshabilitar_date_warr" onchange="habilitar(this.value);" checked> NO tiene Garantia<br>
		<input class='form' type="radio" value="1" name="habilitarDeshabilitar_date_warr" onchange="habilitar(this.value);" > SI tiene Garantia 
	<div>
  <label  class=" col-lg-10 control-label">Fecha de finalizacion de Garantia</label>
    <input type="date" name="date_warranty" id="date_warranty" class='form-control'>
    
	</div>
    </div>
  </div>
 

  <div class="form-group col-lg-6">
    <label for="inputEmail1" class=" col-lg-4 control-label">Minima en Inventario</label>
    <div class=" col-lg-8" style="float:right;background-color:#ecf0f5;padding: 10px;">
    <input class='' type="radio" value="2" name="habilitarDeshabilitar_min_inv" onchange="habilitar(this.value);" checked> Es producto unico<br>
    <input class='form' type="radio" value="1" name="habilitarDeshabilitar_min_inv" onchange="habilitar(this.value);" > No es Unico 
	<div>
    <input type="text" name="inventary_min" id="inventary_min" class='form-control' placeholder="Minimo de Equipo/Producto antes mostrar alerta">
    
	</div>
    </div>
  </div>

  <div class="form-group col-lg-6">
    <label for="inputEmail1" class="col-lg-2 control-label">Inventario inicial:</label>
    <div class="col-md-10">
      <input type="text" name="inventary_in" class="form-control" id="inventary_in" placeholder="Numero de Equipo/Producto Inicial">
    </div>
  </div>

  <div class="form-group col-lg-12">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary">Agregar Producto</button>
    </div>
  </div>
  </div> <!--row -->
</form>

</td>
</tr>
</table>
<label for="">* Obligatorio</label>
</div>
	</div>
</div>

<script>
  $(document).ready(function(){
    $("#product_code").keydown(function(e){
        if(e.which==17 || e.which==74 ){
            e.preventDefault();
        }else{
            console.log(e.which);
        }
    })

    
});

</script>
<script>
  document.getElementById("date_expire").disabled=true;
 function habilitar(value)
		{

			if(value=="1")
			{
				// habilitamos
				document.getElementById("date_expire").disabled=false;
			}else if(value=="2"){
				// deshabilitamos
				document.getElementById("date_expire").disabled=true;
			}
		} 
    document.getElementById("date_warranty").disabled=true;
 function habilitar(value)
		{

			if(value=="1")
			{
				// habilitamos
				document.getElementById("date_warranty").disabled=false;
			}else if(value=="2"){
				// deshabilitamos
				document.getElementById("date_warranty").disabled=true;
			}
		} 
    document.getElementById("inventary_min").disabled=true;
    document.getElementById("inventary_in").disabled=true;
 function habilitar(value)
		{

			if(value=="1")
			{
				// habilitamos
				document.getElementById("inventary_min").disabled=false;
        document.getElementById("inventary_in").disabled=false;
			}else if(value=="2"){
				// deshabilitamos
				document.getElementById("inventary_min").disabled=true;
        document.getElementById("inventary_in").disabled=true;
			}
		} 

    function codeFinal(value2){
     
      var parametros1 = {"Categoria":  $("#category_id").val(),
                        "SubCategoria":  value2
      };
      
        $.ajax({
                data:  parametros1,
                url:   'index.php?action=nextcode',
                type:  'post',
                dataType: 'json',
                success:  function (response) {
                  console.log(response);
                        $("#product_code").val(response[0].abreviation+response[0].code+response[0].codigo);
                        $.ajax({
                data:  parametros1,
                url:   'index.php?action=nextcode',
                type:  'post',
                dataType: 'json',
                success:  function (response) {
                  console.log(response);
                        $("#product_code").val(response[0].abreviation+response[0].code+response[0].codigo);
                        
                },
                error: function(error) {
                  console.log("error en Funcion codeFinal");
                  console.log(error);
    }
        });
                },
                error: function(error) {
                  console.log("error en Funcion codeFinal");
                  console.log(error);
    }
        });
   
     
      
    }
    function codenext(value1){
     
      var parametros = {"Categoria": value1};
        
       $.ajax({
                data:  parametros,
                url:   'index.php?action=getcode',
                type:  'post',
                dataType: 'json',
                success:  function (response) {
                 
                  $("#subcategory_id").html(' <option value="">-- NINGUNA --</option>');
                  for (let index = 0; index < response.length; index++) {
                    console.log(response[index]);
                    $("#subcategory_id").append(' <option value="'+response[index].code+'">'+response[index].name+'</option>');
                  
                    
                  }

                        
                }
        });
   
     
      
    }
</script>
</section>