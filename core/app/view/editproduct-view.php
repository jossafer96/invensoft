<section class="content">
<?php
$product = ProductData::getById($_GET["id"]);

$categories = CategoryData::getAll();
$stocks = StockData::getAll();
$states = StateData::getAll();
$units = unitsData::getAll();
if($product!=null):
?>
<div class="row">
	<div class="col-md-12">
	<h1><?php echo $product->name ?> <small>Editar Producto</small></h1>
  <?php if(isset($_COOKIE["prdupd"])):?>
    <p class="alert alert-info">La informacion del producto se ha actualizado exitosamente.</p>
  <?php setcookie("prdupd","",time()-18600); endif; ?>
	<br>
<div class="box box-primary">
  <table class="table">
  <tr>
  <td>
		<form class="form-horizontal" method="post" id="addproduct" enctype="multipart/form-data" action="index.php?view=updateproduct" role="form">
    <div class="row">
<div class="form-group col-lg-6">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-10">
      <input type="text" name="name" value="<?php echo $product->name;?>" required class="form-control" id="name" placeholder="Nombre del Producto">
    </div>
  </div>
  
  <div class="form-group col-lg-6">
    <label for="inputEmail1" class="col-lg-2 control-label">Codigo de Barras*</label>
    <div class="col-md-4">
      <input type="text" value="<?php echo $product->barcode;?>" style='font-size:30px;font-weight:bolder;text-align: center;background-color: #ecf0f5;' name="barcode" id="product_code" class="form-control" id="barcode" placeholder="Codigo de Barras del Producto">
    </div>
  </div>
  
  <div class="form-group col-lg-6" >
    <label for="inputEmail1" class="col-lg-2 control-label">Categoria</label>
    <div class="col-md-10">
    <select name="category_id" id="category_id" class="form-control" onchange="codenext(this.value);pagoOnChange(this.value);">
    <option value="">-- NINGUNA --</option>
    <?php foreach($categories as $category):
      if ($product->category_id==$category->id) {?>
      <script type="text/javascript">pagoOnChange(<?php echo $category->id;?>);</script>
      <option value="<?php echo $category->id;?>" selected><?php echo $category->name;?></option>
     
    <?php }else{ ?>
       <option value="<?php echo $category->id;?>"><?php echo $category->name;?></option>
      <?php } endforeach;?>
      </select>    </div>
  </div>
  <div class="form-group col-lg-6" >
    <label for="inputEmail1" class="col-lg-2 control-label">SubCategoria</label>
    <div class="col-md-10">
    <select name="subcategory_id" id="subcategory_id" class="form-control" onchange="codeFinal(this.value)">
    <option value="">-- NINGUNA --</option>
    <?php 
    $subcategories = CategoryData::getAllSub($product->category_id);
    foreach($subcategories as $subcategory):
      if ($product->category_id_sub==$subcategory->id) {?>
      <option value="<?php echo $subcategory->id;?>" selected><?php echo $subcategory->name;?></option>
    <?php }else{ ?>
       <option value="<?php echo $subcategory->id;?>"><?php echo $subcategory->name;?></option>
      <?php } endforeach;?>
      </select>    </div>
  </div>
  

  
  <div id="ndescription" class="form-group col-lg-12">
    <label for="inputEmail1" class="col-lg-1 control-label">Descripcion</label>
    <div class="col-md-10">
      <textarea rows="8" value="" name="description" class="form-control" id="description" placeholder="Descripcion del Producto"><?php echo $product->description;?></textarea>
    </div>
  </div>

  <div id="ndetails"  style="display:none;margin:0;padding:0;" class=" col-lg-12">

  <div class="form-group col-lg-6">
    <label for="inputEmail1" class="col-lg-2 control-label">Marca*</label>
    <div class="col-md-10">
      <input type="text" value="<?php echo $product->brand;?>" name="brand"  class="form-control" id="brand" placeholder="Marca">
    </div>
  </div>

  <div class="form-group col-lg-6">
    <label for="inputEmail1" class="col-lg-2 control-label">Modelo*</label>
    <div class="col-md-10">
      <input type="text" value="<?php echo $product->model;?>" name="model"  class="form-control" id="model" placeholder="Modelo">
    </div>
  </div>

  <div class="form-group col-lg-6">
    <label for="inputEmail1" class="col-lg-2 control-label">S/N*</label>
    <div class="col-md-10">
      <input type="text" value="<?php echo $product->serial;?>" name="serial"  class="form-control" id="serial" placeholder="Numero de serie">
    </div>
  </div>

  <div  class="form-group col-lg-6">
    <label for="inputEmail1" class="col-lg-2 control-label">Descripcion</label>
    <div class="col-md-10">
      <textarea rows="3"  name="description_1" class="form-control" id="description_1" placeholder="Descripcion del Producto"><?php echo $product->description;?></textarea>
    </div>
  </div>

  </div>

  <div class="form-group col-lg-6">
    <label for="inputEmail1" class="col-lg-2 control-label">Precio*</label>
    <div class="col-md-10">
      <input type="text" value="<?php echo $product->price_in;?>" name="price_in" required class="form-control" id="price_in" placeholder="Precio de compra">
    </div>
  </div>
  <div class="form-group col-lg-6" >
    <label for="inputEmail1" class="col-lg-2 control-label">Estado*</label>
    <div class="col-md-10">
    <select name="state" class="form-control">
    <option value="">-- SELECCIONE UNO --</option>
    <?php foreach($states as $state):
    if ($product->state==$state->id) {?>
      <option value="<?php echo $state->id;?>" selected><?php echo $state->name_state;?></option>
    <?php }else{ ?>
      <option value="<?php echo $state->id;?>"><?php echo $state->name_state;?></option>
    <?php } endforeach;?>
      </select>    
      </div>
  </div>
  <div class="form-group col-lg-6">
    <label for="inputEmail1" class="col-lg-2 control-label">Fondos*</label>
    <div class="col-md-10">
      <input type="text" name="funding" value="<?php echo $product->funding;?>" required class="form-control" id="fund" placeholder="Fondos utilizados">
    </div>
  </div>
  <div class="form-group col-lg-6" >
    <label for="inputEmail1" class="col-lg-2 control-label">Almacen</label>
    <div class="col-md-10">
    <select name="stock" class="form-control">
    <option value="">-- SELECCIONE UNO --</option>
    <?php foreach($stocks as $stock):
     if ($product->stock==$stock->id) {?>
      <option value="<?php echo $stock->id;?>" selected><?php echo $stock->name;?></option>
    <?php }else{ ?>
      <option value="<?php echo $stock->id;?>"><?php echo $stock->name;?></option>
    <?php } endforeach;?>
      </select>    
    </div>
  </div>
  <div class="form-group col-lg-6" >
    <label for="inputEmail1" class="col-lg-3 control-label">Unidad/Programa</label>
    <div class="col-md-9">
    <select name="unit" class="form-control">
    <option value="">-- SELECCIONE UNO --</option>
    <?php foreach($units as $unit):
     if ($product->unit_id==$unit->unit_id) {?>
      <option value="<?php echo $unit->unit_id;?>" selected><?php echo $unit->name_unit;?></option>
    <?php }else{ ?>
      <option value="<?php echo $unit->unit_id;?>"><?php echo $unit->name_unit;?></option>
    <?php } endforeach;?>
      </select>    
      </div>
  </div>
  <div class="form-group col-lg-6">
    <label for="inputEmail1" class="col-lg-2 control-label">Responsable</label>
    <div class="col-md-10">
      <input type="text" name="asing" value="<?php echo $product->user_responsable;?>" required class="form-control" id="asing" placeholder="Persona asignada">
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

  <div class="form-group">
    <div class="col-lg-offset-3 col-lg-8">
    <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
      <button type="submit" class="btn btn-success">Actualizar Producto</button>
    </div>
  </div>
  </div> <!--row -->


</form>
</td>
</tr>
</table>
</div>
	</div>
</div>
<?php endif; ?>
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
                  
                       //$("#product_code").val(response[0].abreviation+response[0].id+response[0].codigo);
                        
                        $.ajax({
                          data:  parametros1,
                          url:   'index.php?action=code',
                          type:  'post',
                          dataType: 'json',
                          success:  function (response1) {
                           
                            if (response1[0].category_id<10) {
                              var codeCategory= '0'+response1[0].category_id;
                            }else{
                              var codeCategory =response1[0].category_id;
                            }
                            if (response1[0].cantidad<10) {
                              var codenext= '0'+response1[0].cantidad;
                            }else{
                              var codenext =response1[0].cantidad;
                            }
                            $("#product_code").val(response[0].abreviation+codeCategory+codenext);
                        
                          },
                          error: function(error) {
                            console.log("error en Funcion codeFinal 2");
                            
                          }
                        });


                },
                error: function(error) {
                  console.log("error en Funcion codeFinal 1");
                  
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
                   
                    $("#subcategory_id").append(' <option value="'+response[index].id+'">'+response[index].name+'</option>');
                  
                    
                  }

                        
                }
        });
   
     
      
    }

    function pagoOnChange(sel) {
      if (sel==1||sel==4||sel==5){
        $("#ndescription").hide("slow");
           $("#ndetails").show("slow");
      

      }else{

        $("#ndetails").hide("slow");
        $("#ndescription").show("slow");
      }
}
var id_cat=$( "#category_id" ).val();
pagoOnChange(id_cat);
</script>
</section>