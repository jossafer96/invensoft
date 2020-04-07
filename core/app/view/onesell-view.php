<section class="content">
<div class="btn-group pull-right">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-download"></i> Descargar <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
<li><a style="cursor: pointer" onclick="thePDF()" id="makepdf" class=""> Descargar PDF (.pdf)</a></li>
  </ul>
</div>
<h1>Resumen de Venta</h1>
<?php if(isset($_GET["id"]) && $_GET["id"]!=""):?>
<?php
$sell = SellData::getById($_GET["id"]);
$operations = OperationData::getAllProductsBySellId($_GET["id"]);
$total = 0;
?>
<?php
if(isset($_COOKIE["selled"])){
  foreach ($operations as $operation) {
//    print_r($operation);
    $qx = OperationData::getQByStock($operation->product_id,StockData::getPrincipal()->id);
    // print "qx=$qx";
      $p = $operation->getProduct();
    if($qx==0){
      echo "<p class='alert alert-danger'>El producto <b style='text-transform:uppercase;'> $p->name</b> no tiene existencias en inventario.</p>";      
    }else if($qx<=$p->inventary_min/2){
      echo "<p class='alert alert-danger'>El producto <b style='text-transform:uppercase;'> $p->name</b> tiene muy pocas existencias en inventario.</p>";
    }else if($qx<=$p->inventary_min){
      echo "<p class='alert alert-warning'>El producto <b style='text-transform:uppercase;'> $p->name</b> tiene pocas existencias en inventario.</p>";
    }
  }
  setcookie("selled","",time()-18600);
}

?>
<div class="box box-primary">
<table class="table table-bordered">
<?php if($sell->person_id!=""):
$client = $sell->getPerson();
?>
<tr>
  <td style="width:150px;">Cliente</td>
  <td><?php echo $client->name." ".$client->lastname;?></td>
</tr>

<?php endif; ?>
<?php if($sell->user_id!=""):
$user = $sell->getUser();
?>
<tr>
  <td>Atendido por</td>
  <td><?php echo $user->name." ".$user->lastname;?></td>
</tr>
<?php endif; ?>
</table>
</div>
<br>
<div class="box box-primary">
<table class="table table-bordered table-hover">
  <thead>
    <th>Codigo</th>
    <th>Cantidad</th>
    <th>Nombre del Producto</th>
    <th>Precio Unitario</th>
    <th>Total</th>

  </thead>
<?php
  foreach($operations as $operation){
    $product  = $operation->getProduct();
?>
<tr>
  <td><?php echo $product->barcode ;?></td>
  <td><?php echo $operation->q ;?></td>
  <td><?php echo $product->name ;?></td>
  <td>L. <?php echo number_format($operation->price_in,2,".",",") ;?></td>
  <td><b>L. <?php echo number_format($operation->q*$operation->price_in,2,".",",");$total+=$operation->q*$operation->price_in;?></b></td>
</tr>
<?php
  }
  ?>
</table>
</div>
<br><br>
<div class="row">
<div class="col-md-4">
<div class="box box-primary">
<table class="table table-bordered">

  <tr>
    <td><h4>Subtotal:</h4></td>
    <td><h4>L. <?php echo number_format($total,2,'.',','); ?></h4></td>
  </tr>
  <tr>
    <td><h4>Descuento:</h4></td>
    <td><h4>L. <?php echo number_format($sell->discount,2,'.',','); ?></h4></td>
  </tr>
  <tr><b>
    <td><h4>Total:</h4></td>
    <td><h4><b>L. <?php echo number_format($total -  $sell->discount,2,'.',','); ?></b></h4></td>
  </tr>
</table>
</div>


</div>
</div>






<script type="text/javascript">
        function thePDF() {

var columns = [
//    {title: "Reten", dataKey: "reten"},
    {title: "Codigo", dataKey: "code"}, 
    {title: "Cantidad", dataKey: "q"}, 
    {title: "Nombre del Producto", dataKey: "product"}, 
    {title: "Precio unitario", dataKey: "pu"}, 
    {title: "Total", dataKey: "total"}, 
//    ...
];


var columns2 = [
//    {title: "Reten", dataKey: "reten"},
    {title: "DETALLES", dataKey: "clave"}, 
    {title: "", dataKey: "valor"}, 
//    ...
];

var columns3 = [
//    {title: "Reten", dataKey: "reten"},
    {title: "RESUMEN", dataKey: "clave"}, 
    {title: "", dataKey: "valor"}, 
//    ...
];

var rows = [
  <?php foreach($operations as $operation):
  $product  = $operation->getProduct();
  ?>

    {
      "code": "<?php echo $product->barcode; ?>",
      "q": "<?php echo $operation->q; ?>",
      "product": "<?php echo $product->name; ?>",
      "pu": "L. <?php echo number_format($operation->price_in,2,".",","); ?>",
      "total": "L. <?php echo number_format($operation->q*$operation->price_in,2,".",","); ?>",
      },
 <?php endforeach; ?>
];

var rows2 = [
<?php if($sell->person_id!=""):
$person = $sell->getPerson();
?>

    {
      "clave": "Cliente",
      "valor": "<?php echo $person->name." ".$person->lastname; ?>",
      },
      <?php endif; ?>
    {
      "clave": "Atendido por",
      "valor": "<?php echo $user->name." ".$user->lastname; ?>",
      },

];

var rows3 = [
  {
      "clave": "Subtotal",
      "valor": "L. <?php echo number_format($sell->total,2,'.',',');; ?>",
      },
    {
      "clave": "Descuento",
      "valor": "L. <?php echo number_format($sell->discount,2,'.',',');; ?>",
      },
    {
      "clave": "Total",
      "valor": "L. <?php echo number_format($sell->total-$sell->discount,2,'.',',');; ?>",
      },
];


// Only pt supported (not mm or in)
var doc = new jsPDF('p', 'pt');
        doc.setFontSize(26);
        doc.text("NOTA DE VENTA", 40, 65);
        doc.setFontSize(14);
        doc.text("Fecha: <?php echo $sell->created_at; ?>", 40, 80);
//        doc.text("Operador:", 40, 150);
//        doc.text("Header", 40, 30);
  //      doc.text("Header", 40, 30);

doc.autoTable(columns2, rows2, {
    theme: 'grid',
    overflow:'linebreak',
    styles: {
        fillColor: [100, 100, 100]
    },
    columnStyles: {
        id: {fillColor: 255}
    },
    margin: {top: 100},
    afterPageContent: function(data) {
//        doc.text("Header", 40, 30);
    }
});


doc.autoTable(columns, rows, {
    theme: 'grid',
    overflow:'linebreak',
    styles: {
        fillColor: [100, 100, 100]
    },
    columnStyles: {
        id: {fillColor: 255}
    },
    margin: {top: doc.autoTableEndPosY()+15},
    afterPageContent: function(data) {
//        doc.text("Header", 40, 30);
    }
});

doc.autoTable(columns3, rows3, {
    theme: 'grid',
    overflow:'linebreak',
    styles: {
        fillColor: [100, 100, 100]
    },
    columnStyles: {
        id: {fillColor: 255}
    },
    margin: {top: doc.autoTableEndPosY()+15},
    afterPageContent: function(data) {
//        doc.text("Header", 40, 30);
    }
});
//doc.setFontsize
//img = new Image();
//img.src = "liberacion2.jpg";
//doc.addImage(img, 'JPEG', 40, 10, 610, 100, 'monkey'); // Cache the image using the alias 'monkey'
doc.setFontSize(20);
doc.setFontSize(12);
doc.text("Generado por el Sistema de inventario", 40, doc.autoTableEndPosY()+25);
doc.save('sell-<?php echo date("d-m-Y h:i:s",time()); ?>.pdf');
//doc.output("datauri");

        }
    </script>

<script>
  $(document).ready(function(){
  //  $("#makepdf").trigger("click");
  });
</script>




<?php else:?>
  501 Internal Error
<?php endif; ?>
</section>