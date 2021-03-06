<?php
// $symbol = ConfigurationData::getByPreffix("currency")->val;
$iva_name = ConfigurationData::getByPreffix("imp-name")->val;
$iva_val = ConfigurationData::getByPreffix("imp-val")->val;
?>
<style>
  
#v{
    width:320px;
    height:240px;
}
#qr-canvas{
    display:none;
}
#qrfile{
    width:320px;
    height:240px;
}
#mp1{
    text-align:center;
    font-size:35px;
}
#imghelp{
    position:relative;
    left:0px;
    top:-160px;
    z-index:100;
    font:18px arial,sans-serif;
    background:#f0f0f0;
  margin-left:35px;
  margin-right:35px;
  padding-top:10px;
  padding-bottom:10px;
  border-radius:20px;
}


label {
  display: block;
  margin-bottom: 5px;
}

.ui-autocomplete-input-has-clear {
  padding-right: 24px;
}

.ui-autocomplete-input-has-clear::-ms-clear {
  display: none;
}

.ui-autocomplete-clear {
  display: inline-block;
  width: 16px;
  height: 16px;
  text-align: center;
  cursor: pointer;
}
.ui-autocomplete {
    max-height: 100px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }

</style>


<section class="content">






<div class="row">
	<div class="col-md-12">
	<h1>Asignar Equipo</h1>
	<p><b>Buscar producto por nombre o por codigo:</b></p>
		<form id="searchp">
		<div class="row">
			<div class="col-md-3">
				<input type="hidden" name="view" value="sell">
				<input type="text" id="product_name" name="product_name" class="form-control" placeholder="Nombre del Producto">
			</div>

			<div class="col-md-3">
				<input type="hidden" name="view" value="sell">
				<input type="text" id="product_code" name="product_code" class="form-control" placeholder="Codigo de Barra">
			</div>


			<div class="col-md-1">
			<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Buscar</button>
			</div>
      <div class="col-md-1">
      <button type="button" id="readqr" class="btn btn-default"><i class="fa fa-qrcode"></i> Buscar por QR</button>
      </div>

		</div>
		</form>


<div style="display:none;" id="qrreader">
<div id="mainbody">
<a class="selector" id="webcamimg" onclick="setwebcam()" align="left">Camara</a>
<a class="selector" id="qrimg" src="cam.png" onclick="setimg()" align="right">Imagen</a>
<div id="outdiv">
</div>
<div id="result">-- Scaning --</div>
<canvas id="qr-canvas" width="800" height="600"></canvas>


<button onclick="captureToCanvas()">Capture</button><br>
</div>
</div>

<script>
  $(document).ready(function(){
      $("#readqr").click(function(){
        qrreader = document.getElementById("qrreader");
        if(qrreader.style.display=="none"){
          qrreader.style.display="block";
          load();
        }else if(qrreader.style.display=="block"){
          qrreader.style.display="none";
          var MediaStream = window.MediaStream;

          if (typeof MediaStream === 'undefined' && typeof webkitMediaStream !== 'undefined') {
              MediaStream = webkitMediaStream;
          }

          /*global MediaStream:true */
          if (typeof MediaStream !== 'undefined' && !('stop' in MediaStream.prototype)) {
              MediaStream.prototype.stop = function() {
                  this.getAudioTracks().forEach(function(track) {
                      track.stop();
                  });

                  this.getVideoTracks().forEach(function(track) {
                      track.stop();
                  });
              };
          }

        }

      });
  });
</script>

<div id="show_search_results"></div>

<script>
//jQuery.noConflict();

$(document).ready(function(){
	$("#searchp").on("submit",function(e){
		e.preventDefault();

    code = $("#product_code").val();
    name = $("#product_name").val();
		if(name!=""){
		$.get("./?action=searchproduct3",$("#searchp").serialize()+"&go=name",function(data){
			$("#show_search_results").html(data);
		});
		$("#product_name").val("");
    }
    else if(code!=""){
    $.get("./?action=searchproduct3",$("#searchp").serialize()+"&go=code",function(data){
      $("#show_search_results").html(data);
    });
    $("#product_code").val("");
    }

	});
	});

$(document).ready(function(){
    $("#product_code").keydown(function(e){
        if(e.which==17 || e.which==74){
            e.preventDefault();
        }else{
            console.log(e.which);
        }
    })
});
</script>

<?php if(isset($_SESSION["errors"])):?>
<h2>Errores</h2>
<p></p>
<table class="table table-bordered table-hover">
<tr class="danger">
	<th>Codigo</th>
	<th>Producto</th>
	<th>Mensaje</th>
</tr>
<?php foreach ($_SESSION["errors"]  as $error):
$product = ProductData::getById($error["product_id"]);
?>
<tr class="danger">
	<td><?php echo $product->id; ?></td>
	<td><?php echo $product->name; ?></td>
	<td><b><?php echo $error["message"]; ?></b></td>
</tr>

<?php endforeach; ?>
</table>
<?php
unset($_SESSION["errors"]);
 endif; ?>


<!--- Carrito de compras :) -->
<?php if(isset($_SESSION["cart"])):
$total = 0;
?>
<h2>Lista de asignacion</h2>
<div class="box box-primary">
<table class="table table-bordered table-hover">
<thead>
	<th>Codigo</th>
	<th>Cantidad</th>
	<th>Unidad/Proyecto</th>
	<th>Producto/Equipo</th>
	<th>Asignado a</th>
	<th>Responsable actual</th>
	<th ></th>
</thead>
<?php foreach($_SESSION["cart"] as $p):
$product = ProductData::getById($p["product_id"]);

?>
<tr >
	<td><?php echo $product->barcode; ?></td>
	<td ><?php echo $p["q"]; ?></td>
	<td><?php 
		if ($product->asing!=0) {
			$id_asing=$product->asing;
			$user1 = PersonData::getById($id_asing);
			echo $user1->getUnit()->name_unit;
		  }elseif ($product->asing==0) {
		   echo 'Sin definir';
		  } ?></td>
	<td><?php echo $product->name; ?></td>
  <td><b><?php 
  if ($product->asing!=NULL) {
    $person = personData::getById($product->asing);
  echo $person->name." ".$person->lastname; 
  }else{
    echo 'Disponible';
  } ?></b></td>
	<td> <?php  if (is_numeric($product->user_responsable)) {
        $user2 = PersonData::getById($product->user_responsable);
        echo $user2->name." ".$user2->lastname;
      }else {
    echo $product->user_responsable;}  ?></td>
	<td style="width:30px;"><a href="index.php?view=clearcartasing&product_id=<?php echo $product->id; ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Cancelar</a></td>
</tr>

<?php endforeach; ?>
</table>
</div>
<form method="post" class="form-horizontal" id="processsell" action="index.php?view=processasing">
<h2>Resumen</h2>
<div class="row">
<div class="col-md-3">
    <label class="">Almacen de Ubicacion</label>
    <div class="col-lg-12">
    <h4 class=""><?php 
    echo StockData::getPrincipal()->name;
    ?></h4>
    </div>
  </div>

  <div class="col-md-5">
    <label class="">Asingnado a</label>
    <div class="ui-widget" style="font-size: 1.8em;">
  <input id="responsable_name" name="responsable_name" style="width: 100%" />
  <input type="hidden" name="responsable_id" id="responsable_id">
</div>
  </div>
  <div class='col-md-4'>
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <div class="checkbox">
        <label>
		<a href="index.php?view=clearcartasing" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Cancelar</a>
        <button class="btn btn-primary"> Finalizar asignacion</button>
        </label>
      </div>
    </div>
  </div>
  </div>
  </div>
<div class="row">




</div>


      <input type="hidden" name="total" value="<?php echo $total; ?>" class="form-control" placeholder="Total">
      <div class="clearfix"></div>
<br>
  <div class="row">
<div class="col-md-6 col-md-offset-6">

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <div class="checkbox">
        <label>
          <input name="is_oficial" type="hidden" value="1">
        </label>
      </div>
    </div>
  </div>

</form>

</div>
</div>

<?php endif; ?>

</div>
</section>
<script>
  $(document).ready(function(){
    <?php
		$users = PersonData::getColaborators();
		?>
function log( message ) {
      $( "#responsable_id" ).val(message);
      //alert(message);
    }

    var availableColaborators = [
  <?php foreach($users as $product):

    echo "{label: '".$product->name." ".$product->lastname."', id: '".$product->id."'},";

  endforeach; ?>
];
$( "#responsable_name" ).autocomplete({
  source: availableColaborators,
      minLength: 2,
      select: function( event, ui ) {
        log(  ui.item.id );
      }
    });
  });



  </script>