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

</style>
<section class="content">






<div class="row">
	<div class="col-md-12">
	<h1>Venta</h1>
	<p><b>Buscar producto por nombre o por codigo:</b></p>
		<form id="searchp">
		<div class="row">
			<div class="col-md-3">
				<input type="hidden" name="view" value="sell">
				<input type="text" id="product_name" name="product_name" class="form-control" placeholder="Nombre del Producto">
			</div>

			<div class="col-md-3">
				<input type="hidden" name="view" value="sell">
				<input type="text" id="product_code" name="product_code" class="form-control" placeholder="Codigo">
			</div>


			<div class="col-md-1">
			<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Buscar</button>
			</div>
      <!--<div class="col-md-1">
      <button type="button" id="readqr" class="btn btn-default"><i class="fa fa-qrcode"></i> Buscar por QR</button>
      </div>-->

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
		$.get("./?action=searchproduct",$("#searchp").serialize()+"&go=name",function(data){
			$("#show_search_results").html(data);
		});
		$("#product_name").val("");
    }
    else if(code!=""){
    $.get("./?action=searchproduct",$("#searchp").serialize()+"&go=code",function(data){
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
<h2>Lista de venta</h2>
<div class="box box-primary">
<table class="table table-bordered table-hover">
<thead>
	<th style="width:30px;">Codigo</th>
	<th style="width:30px;">Cantidad</th>
	<th>Descripcion</th>
	<th>Producto</th>
	<th style="width:150px;">Precio Unitario</th>
	<th style="width:250px;">Precio Total de Compra</th>
	<th ></th>
</thead>
<?php foreach($_SESSION["cart"] as $p):
$product = ProductData::getById($p["product_id"]);
?>
<tr >
	<td><?php echo $product->barcode; ?></td>
	<td ><?php echo $p["q"]; ?></td>
	<td><?php echo $product->description; ?></td>
	<td><?php echo $product->name; ?></td>
	<td><b>L. <?php echo number_format($product->price_in,2,".",","); ?></b></td>
	<td><b>L. <?php  $pt = $product->price_in*$p["q"]; $total +=$pt; echo number_format($pt,2,".",","); ?></b></td>
	<td style="width:30px;"><a href="index.php?view=clearcart&product_id=<?php echo $product->id; ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Cancelar</a></td>
</tr>

<?php endforeach; ?>
</table>
</div>
<form method="post" class="form-horizontal" id="processsell" action="index.php?view=processsell">
<h2>Resumen</h2>
<div class="row">
<div class="col-md-2">
    <label class="control-label">Almacen</label>
    <div class="col-lg-12">
    <h4 class=""><?php 
    echo StockData::getPrincipal()->name;
    ?></h4>
    </div>
  </div>

<div class="col-md-4">
    <label class="control-label">Cliente</label>
    <div class="col-lg-12">
    <?php 
$clients = PersonData::getColaborators();
    ?>
    <select name="client_id" id="client_id" class="form-control" require>
    <option value="">-- NINGUNO --</option>
    <?php foreach($clients as $client):?>
    	<option value="<?php echo $client->id;?>"><?php echo $client->name." ".$client->lastname;?></option>
    <?php endforeach;?>
    	</select>
    </div>
  </div>


  </div>
<div class="row">

<div class="col-md-6">
    <label class="control-label">Pago</label>
    <div class="col-lg-12">
    <?php 
$clients = PData::getAll();
    ?>
    <select name="p_id" id="p_id" class="form-control" require>
    <?php foreach($clients as $client):?>
    	<option value="<?php echo $client->id;?>"><?php echo $client->name;?></option>
    <?php endforeach;?>
    	</select>
    </div>
  </div>
<div class="col-md-6">
    <label class="control-label">Entrega</label>

    <div class="col-lg-12">
    <?php 
$clients = DData::getAll();
    ?>
    <select name="d_id" class="form-control" require>
    <?php foreach($clients as $client):?>
    	<option value="<?php echo $client->id;?>"><?php echo $client->name;?></option>
    <?php endforeach;?>
    	</select>
    </div>
  </div>

</div>


      
      <div class="clearfix"></div>
<br>
  <div class="row">
<div class="col-md-6 ">
<div class="box box-primary">
<table class="table table-bordered">
<tr>
	<td><p>Subtotal</p></td>
	<td>
      <div class="input-group">
      <span class="input-group-addon"><b>L.</b></span>
      <input type="text" readonly class="form-control" style="font-weight: bolder;font-size: 25px; " id="subtotal" name="subtotal" value="<?php echo number_format($total*(1 - ($iva_val/100) ),2,'.',','); ?>">
      </div>  
</td>
</tr>
<tr>
	<td><p><?php echo $iva_name." (".$iva_val."%) ";?></p></td>
	<td>
      <div class="input-group">
      <span class="input-group-addon"><b>L.</b></span>
      <input type="text" readonly class="form-control" style="font-weight: bolder;font-size: 25px; " id="isv" name="isv" value="<?php echo number_format($total*($iva_val/100),2,'.',','); ?>">
      </div>  
  </td>
</tr>
<tr>
	<td><p>Descuentos</p></td>
	<td><div class="input-group">
      <span class="input-group-addon"><b>L.</b></span>
      <input type="text" readonly class="form-control" style="font-weight: bolder;font-size: 25px; " id="disc" name="disc" >
      </div>
  </td>
</tr>
<tr>
	<td><p>Total</p></td>
	<td><div class="input-group">
      <span class="input-group-addon"><b>L.</b></span>
      <input type="hidden"  id="total1" name="total1" value="<?php echo number_format($total); ?>">
      <input type="text" readonly class="form-control" style="font-weight: bolder;font-size: 25px; " id="total" name="total" value="<?php echo number_format($total); ?>">
      </div>
  </td>
</tr>

</table>

</div>
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
<div class="col-md-6 ">
  <div class="box box-primary">
  <table class="table table-bordered">
<tr>
	<td><p>Descuento</p></td>
	<td>
                    <div class="input-group ">
                    <span class="input-group-addon"><b>L.</b></span>
                    <input type="text" style="font-weight: bolder;font-size: 25px; " class="form-control" id="discount" name="discount" >
                    <span class="input-group-btn">
                      <button class="btn btn-info btn-flat" type="button" id="recalc">Recalcular</button>
                    </span>
                  </div> 
</td>
</tr>
<tr>
	<td><p>Efectivo</p></td>
	<td>
      <div class="input-group">
      <span class="input-group-addon"><b>L.</b></span>
      <input type="text"  class="form-control" style="font-weight: bolder;font-size: 25px; " id="money" name="money" require >
      </div>  
  </td>
</tr>


</table>

  </div>
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <div class="checkbox">
        <label>
		<a href="index.php?view=clearcart" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Cancelar</a>
        <button class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i>  Finalizar Venta</button>
        </label>
      </div>
    </div>
  </div>
</div>
</div>

<?php endif; ?>

</div>

<script>
/*$("#money").keyup(function(){
  var value = $("#money").val();
  var isv = <?php echo $iva_val?>*value*0.01;
  $("#subtotal").val(value-isv);
  $("#isv").val(isv);
  $("#total").val(value);
});*/

$("#recalc").click(function(){
  var value = <?php echo $total?>-$("#discount").val();
  $("#total").val(value);
  var isv = <?php echo $iva_val?>*value*0.01;
  $("#isv").val(isv);
  $("#subtotal").val(value-isv);
  $("#disc").val(-$("#discount").val());
  
  
});


  


	$("#processsell").submit(function(e){
		discount = $("#discount").val();
    p = $("#p_id").val();
    client = $("#client_id").val();
		money = $("#money").val();
    if(money!=""){
      if(p!=4){
        if(money<(<?php echo $total;?>-discount)){
          alert("Efectivo insificiente!");
          e.preventDefault();
        }else{
          if(discount==""){ discount=0;}
          go = confirm("Cambio: $"+(money-(<?php echo $total;?>-discount ) ) );
          if(go){}
            else{e.preventDefault();}
        }
      }else if(p==4){ // usaremos credito
        if(client!=""){
          // procedemos
          cli=null;
          <?php 
          foreach(PersonData::getColaborators() as $cli){
            echo " cli[$cli->id]=$cli->is_active_access ;";
          }
          ?>

          if(cli[client]==1){
            // si el cliente tiene credito entonces procedemos a hacer la venta a credito :D

          }else{
            // el cliente no tiene credito
            alert("El cliente seleccionado no cuenta con credito!");
            e.preventDefault();

          }
        }else{
          // 
          alert("Debe seleccionar un cliente!");
          e.preventDefault();
        }

      }
  }else{
    alert("Campo de pago vacio")
    e.preventDefault();
  }
	});
</script>
</section>