        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Productos
          </h1>
          <ol class="breadcrumb">
            <li><a href="./"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Productos</li>
            
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

<div class="row">
	<div class="col-md-12" >
<div class="btn-group  pull-right">
	<a href="index.php?view=newproduct" class="btn btn-default">Agregar Producto</a>
<div class="btn-group pull-right">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-download"></i> Descargar <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="report/products-word.php">Word 2007 (.docx)</a></li>
    <li><a href="report/products-xlsx.php">Excel (.xlsx)</a></li>
<li><a onclick="thePDF()" id="makepdf" class="">PDF (.pdf)</a>

  </ul>
</div>
</div>
<div class="clearfix"></div>
<br>

<?php

$products = ProductData::getAllActive();
if(count($products)>0){
?>
<div id="box" class="box" style="display:none">
  <div class="box-header">
    <h3 class="box-title">Productos</h3>

  </div><!-- /.box-header -->
  <div class="box-body " >
<div class="box-body" >
<table id="example"  class="uk-table uk-table-hover uk-table-striped">
  
	<thead >
  <th style="padding-right: 50px;">N°</th>
    <th style="padding-right: 50px;">Codigo</th>
    <th style="padding-right: 100px;">Equipo/Producto</th>
    <th style="padding-right: 250px;">Descripcion</th>
    <th style="padding-right: 100px;">Marca</th>
    <th style="padding-right: 100px;">Modelo</th>
    <th style="padding-right: 100px;">S/N</th>
    <th style="padding-right: 100px;">Precio</th>
    <th style="padding-right: 100px;">Categoria</th>
    <th style="padding-right: 100px;">Unidad/Proyecto</th>
    <th style="padding-right: 100px;">Fondos</th>
    <th style="padding-right: 100px;">Responsable</th>
    <th style="padding-right: 100px;">Asignado</th>
		<th>Acciones</th>
	</thead>
  
  <?php
   $x=1;
   foreach($products as $product):
   ?>
	<tr>
  <td><?php echo $x; ?></td>
    <td style="font-weight: bolder;cursor:pointer"><a onclick="Abrirmodal(<?php echo $product->id; ?>);"><?php echo $product->barcode; ?></a></td>
    <td><?php echo $product->name; ?></td>
    <td><?php echo $product->description ?></td>
    <td><?php echo $product->brand ?></td>
    <td><?php echo $product->model ?></td>
    <td><?php echo $product->serial ?></td>
    <td>L. <?php echo number_format($product->price_in,2,'.',','); ?></td>
    <td>
     <?php if($product->category_id!=null){
                  echo $product->getCategory()->name;
              }else{ 
                  echo "<center>----</center>"; 
              };?>
    </td>  
    <td>
    <?php if($product->unit_id!=null){
      echo $product->getUnit()->name_unit;
      }else{ 
      echo "<center>----</center>"; 
      };?>
    </td>
		<td><?php  echo $product->funding;?></td>
    <td><?php echo $product->user_responsable; ?></td>
    <td><?php echo $product->asing; ?></td>
		<td style="width:90px;">
		<a href="index.php?view=editproduct&id=<?php echo $product->id; ?>" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
		<a href="index.php?view=delproduct&id=<?php echo $product->id; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
		</td>
	</tr>
  <?php 
    $x+=1;
endforeach;?>
  
</table>
</div>
  </div><!-- /.box-body -->
</div><!-- /.box -->


	<?php
}else{
	?>
	<div class="alert alert-info">
		<h2>No hay productos</h2>
		<p>No se han agregado productos a la base de datos, puedes agregar uno dando click en el boton <b>"Agregar Producto"</b>.</p>
	</div>
	<?php
}

?>
<br><br><br><br><br><br><br><br><br><br>
	</div>
</div>


<!-- PRIMER MODAL -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" >
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Detalles</h3>
        </div>
        <div class="modal-body">
        <div class="panel box box-success">
        <div class="box-body ">
        <div class="form-group col-lg-6" style="font-size: 15px;">
          <label for="inputEmail1" style="font-weight: 100; font-style: italic;" class="col-lg-2">Nombre:</label>
          <div class="col-md-8" style="float: right">
            <label id="name_modal" class="control-label" style="font-size: 25px;"></label>
          </div>
        </div>
        <div class="form-group col-lg-6" style="font-size: 15px;">
          <label for="inputEmail1" style="font-weight: 100; font-style: italic;" class="col-lg-2">Codigo:</label>
          <div class="col-md-8" style="float: right">
            <label id="barcode_modal" class="control-label" style="font-size: 25px;"></label>
          </div>
        </div>
        <div class="form-group col-lg-6" style="font-size: 15px;">
          <label for="inputEmail1" style="font-weight: 100; font-style: italic;" class="col-lg-2">Marca:</label>
          <div class="col-md-8" style="float: right">
            <label id="brand_modal" class="control-label" style="font-size: 25px;"></label>
          </div>
        </div>
        <div class="form-group col-lg-6" style="font-size: 15px;">
          <label for="inputEmail1" style="font-weight: 100; font-style: italic;" class="col-lg-2">Serial:</label>
          <div class="col-md-8" style="float: right">
            <label id="serial_modal" class="control-label" style="font-size: 25px;"></label>
          </div>
        </div>
        <div class="form-group col-lg-6" style="font-size: 15px;">
          <label for="inputEmail1" style="font-weight: 100; font-style: italic;" class="col-lg-2">Modelo:</label>
          <div class="col-md-8" style="float: right">
            <label id="model_modal" class="control-label" style="font-size: 25px;"></label>
          </div>
        </div>
        <div class="form-group col-lg-6" style="font-size: 15px;">
          <label for="inputEmail1" style="font-weight: 100; font-style: italic;" class="col-lg-2">Precio:</label>
          <div class="col-md-8" style="float: right">
            <label id="pricein_modal" class="control-label" style="font-size: 25px;"></label>
          </div>
        </div>
        <div class="form-group col-lg-6" style="font-size: 15px;">
          <label for="inputEmail1" style="font-weight: 100; font-style: italic;" class="col-lg-2">Descripcion:</label>
          <div class="col-md-8" style="float: right">
            <label id="descripcion_modal" class="control-label" style="font-size: 25px;"></label>
          </div>
        </div>
        <div class="form-group col-lg-6" style="font-size: 15px;">
          <label for="inputEmail1" style="font-weight: 100; font-style: italic;" class="col-lg-2">Ingreso(Fecha):</label>
          <div class="col-md-8" style="float: right">
            <label id="datein_modal" class="control-label" style="font-size: 25px;"></label>
          </div>
        </div>
        <div class="form-group col-lg-6" style="font-size: 15px;">
          <label for="inputEmail1" style="font-weight: 100; font-style: italic;" class="col-lg-2">Garantia(Fecha):</label>
          <div class="col-md-8" style="float: right">
            <label id="warranty_modal" class="control-label" style="font-size: 25px;"></label>
          </div>
        </div>
        <div class="form-group col-lg-6" style="font-size: 15px;">
          <label for="inputEmail1" style="font-weight: 100; font-style: italic;" class="col-lg-2">Vencimiento(Fecha):</label>
          <div class="col-md-8" style="float: right">
            <label id="expire_modal" class="control-label" style="font-size: 25px;"></label>
          </div>
        </div>           
        </div>
        
        </div>
        


  
  <!-- START ACCORDION & CAROUSEL-->
  <h2 class="page-header">Anexos</h2>
          <div class="row">
            <div class="col-md-12">
              <div class="box box-solid">
                
                <div class="box-body">
                  <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            Historial de Operaciones
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in">
                      <div class="box-body no-padding">
                    			<table class="table table-bordered table-hover">
                    			<thead>
                    			<th>N°</th>
                    			<th>Cantidad</th>
                          <th>Tipo</th>
                          <th>Usuario</th>
                    			<th>Fecha</th>
                    			<th>Acciones</th>
                    			</thead>
                    			<tbody id="tableHistory">
                    			</tbody>
                    			</table>
                      </div><!-- /.box-body -->
                      </div>
                    </div>
                    <div class="panel box box-danger">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            Cuentas Vinculadas
                          </a>
                        </h4>
                      </div>
                      <div id="collapseTwo" class="panel-collapse collapse">
                      <div class="box-body no-padding">
                    			<table class="table table-bordered table-hover">
                    			<thead>
                    			<th>N°</th>
                    			<th>Tipo de cuenta</th>
                          <th>Descripcion</th>
                          <th>Contraseña</th>
                    			</thead>
                    			<tbody id="tablePassword">
                    			</tbody>
                    			</table>
                      </div><!-- /.box-body -->
                      </div>
                    </div>
                    <div class="panel box box-warning">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            Asignaciones
                          </a>
                        </h4>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse">
                        <div class="box-body">
                          Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</section><!-- /.content -->



<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
    $('#box').show();
} );


function Eliminar(id,product) {
  x = confirm("Estas seguro que quieres eliminar esta operacion?");
				if(x==true){
          
                
					window.location = "index.php?view=deleteoperationdetaills&pid="+product+"&opid="+id+";";
				}
}

function GetUserName(id,num) {
  $.ajax({
                          data:  { id: id,mode:3 },
                          url:   'index.php?action=getproduct',
                          type:  'post',
                          dataType: 'json',
                          
                          success:  function (response) {
                            $('#username'+num).empty();
                            $('#username'+num).append(response.name+" "+response.lastname);
                        

                           
                          },
                          error: function(error) {
                            console.log("error en Funcion getHistory");
                            
                          }
                        });
}  

function getHistory(id) {
  $( "#tableHistory" ).empty();
  $.ajax({
                          data:  { id: id,mode:2 },
                          url:   'index.php?action=getproduct',
                          type:  'post',
                          dataType: 'json',
                          
                          success:  function (response) {
                            console.log(response);
                            for (let index = 0; index < response.length; index++) {
                              $( "#tableHistory" ).append(
                              `<tr>
                              <td>`+(index+1)+`</td>
			                        <td>`+response[index].q+`</td>
                              <td>`+response[index].description_operation+`</td>
                              <td id="username`+(index+1)+`">`+GetUserName(response[index].user_operation,(index+1))+`</td>
			                        <td>`+response[index].created_at+`</td>
                              <td style="width:40px;">
                              <a href="#" id="oper-`+response[index].id+`" class="btn tip btn-xs btn-danger" onclick="Eliminar(`+response[index].id+`,`+response[index].product_id+`)">
                                <i class="glyphicon glyphicon-trash"></i>
                              </a> 
                              </td>
                              </tr>`);
                              
                            }
                           
                          },
                          error: function(error) {
                            console.log("error en Funcion getHistory");
                            
                          }
                        });

 

  
}

function getPassword(id) {
  $( "#tablePassword" ).empty();
  $.ajax({
                          data:  { id: id,mode:4 },
                          url:   'index.php?action=getproduct',
                          type:  'post',
                          dataType: 'json',
                          
                          success:  function (response) {
                            console.log(response);
                            for (let index = 0; index < response.length; index++) {
                              $( "#tablePassword" ).append(
                              `<tr>
                              <td>`+(index+1)+`</td>
			                        <td>`+response[index].name_type+`</td>
                              <td>`+response[index].description+`</td>
			                        <td>`+response[index].password+`</td>
                              
                              </tr>`);
                              
                            }
                           
                          },
                          error: function(error) {
                            console.log("error en Funcion getHistory");
                            
                          }
                        });

 

  
}

function Abrirmodal(id) {
  $( "#name_modal" ).empty();
  $( "#barcode_modal" ).empty();
  $( "#brand_modal" ).empty();
  $( "#model_modal" ).empty();
  $( "#serial_modal" ).empty();
  $( "#pricein_modal" ).empty();
  $( "#descripcion_modal" ).empty();
  $( "#datein_modal" ).empty();
  $( "#warranty_modal" ).empty();
  $( "#expire_modal" ).empty();

  $.ajax({
                          data:  { id: id,mode:1 },
                          url:   'index.php?action=getproduct',
                          type:  'post',
                          dataType: 'json',
                          
                          success:  function (response) {
                            //console.log(response);
                            $( "#name_modal" ).append(response.name);
                            $( "#barcode_modal" ).append(response.barcode);
                            $( "#brand_modal" ).append(response.brand);
                            $( "#model_modal" ).append(response.model);
                            $( "#serial_modal" ).append(response.serial);
                            $( "#pricein_modal" ).append('L. '+response.price_in);
                            $( "#descripcion_modal" ).append(response.description);
                            $( "#datein_modal" ).append(response.created_at);
                            if (response.date_warranty!="0000-00-00") {
                              $( "#warranty_modal" ).append(response.date_warranty);
                            }else{
                              $( "#warranty_modal" ).append("No tiene");
                            };
                            if (response.date_expire!="0000-00-00") {
                              $( "#expire_modal" ).append(response.date_expire);
                            }else{
                              $( "#expire_modal" ).append("No tiene");
                            };
                            getHistory(response.id);
                            getPassword(response.id)
                            
                          },
                          error: function(error) {
                            console.log("error en Funcion Abrirmodal");
                            
                          }
                        });

 

 
  $("#myModal").modal();
  
}
</script>

