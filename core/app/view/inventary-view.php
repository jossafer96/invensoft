<link href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.uikit.min.css" rel="stylesheet" type="text/css" />
<?php
$stock = StockData::getById($_GET["stock"]);
?>
<style>
  .btn-xs {
    padding: 5px 10px !important;
    
}
</style>
<section class="content">
<div class="row">
	<div class="col-md-12">
<!-- Single button -->
<div class="btn-group pull-right">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-download"></i> Descargar <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
 <!--   <li><a href="report/inventary-word.php?stock_id=<?php echo $stock->id; ?>">Word 2007 (.docx)</a></li>
    <li><a href="report/inventary-xlsx.php?stock_id=<?php echo $stock->id; ?>">Excel 2007 (.xlsx)</a></li>-->
<li><a onclick="thePDF()" id="makepdf" class="">Descargar PDF (.pdf)</a>
  </ul>
</div>
		<h1> Inventario <small><?php echo $stock->name; ?></small></h1>



<?php
$products = ProductData::getAll();
if(count($products)>0){
	?>
<div class="clearfix"></div>
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Inventario</h3>

  </div><!-- /.box-header -->
  <div class="box-body">
  <table class="table table-bordered datatable table-hover">
	<thead>
		<th>Codigo</th>
    <th>Nombre</th>
    <th>Comentarios</th>
    <th>Es unico</th>
		<th>Por Recibir</th>
		<th>Disponible</th>
		
		<th>Acciones</th>
	</thead>
	<?php foreach($products as $product):
	$r=OperationData::getRByStock($product->id,$_GET["stock"]);
	$q=OperationData::getQByStock($product->id,$_GET["stock"]);
	$d=OperationData::getDByStock($product->id,$_GET["stock"]);
	?>
  <tr class="<?php if ($product->is_unique!=1) {
    if($q<=$product->inventary_min/2){ 
      echo "danger";
      }else if($q<=$product->inventary_min){ 
        echo "warning";
        }
  }
  ?>">
		<td><b><?php echo $product->barcode; ?></b></td>
    <td><?php echo $product->name; ?></td>
    <td><?php echo $product->comment; ?></td>
    <td style="text-align: center;"><?php if ($product->is_unique==1) {
    echo '<i class="glyphicon glyphicon-ok"></i>';
  }else{
    echo '<i class="glyphicon glyphicon-remove"></i>';
  }?>
  </td>
		<td style="text-align: center;">
			<?php echo $r; ?>
		</td>
		<td style="text-align: center;"><b>
      <?php echo $q; ?>
      </b>
		</td>
		
    <td style="width:300px;text-align: center;">
    <?php if(Core::$user->kind==3||Core::$user->kind==1){?> 
<a href="index.php?view=input&product_id=<?php echo $product->id; ?>" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-circle-arrow-up"></i> Alta</a>
<a href="index.php?view=output&product_id=<?php echo $product->id; ?>" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-circle-arrow-down"></i> Baja</a>
<?php }?>    
<a href="index.php?view=history&product_id=<?php echo $product->id; ?>&stock=<?php echo $_GET["stock"];?>" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-time"></i> Historial</a>
		</td>
	</tr>
	<?php endforeach;?>
</table>
  </div><!-- /.box-body -->
</div><!-- /.box -->



<div class="clearfix"></div>

	<?php
}else{
	?>
	<div class="jumbotron">
		<h2>No hay productos</h2>
		<p>No se han agregado productos a la base de datos, puedes agregar uno dando click en el boton <b>"Agregar Producto"</b>.</p>
	</div>
	<?php
}

?>
<br><br><br><br><br><br><br><br><br><br>
	</div>
</div>
</section>






<script type="text/javascript">
        function thePDF() {
var doc = new jsPDF('p', 'pt');
        doc.setFontSize(26);
        doc.text("<?php echo ConfigurationData::getByPreffix("company_name")->val;?>", 40, 65);
        doc.setFontSize(18);
        doc.text("ESTADO DEL INVENTARIO: <?php echo $stock->name;?>", 40, 80);
        doc.setFontSize(12);
        doc.text("Usuario: <?php echo Core::$user->name." ".Core::$user->lastname; ?>  -  Fecha: <?php echo date("d-m-Y h:i:s");?> ", 40, 90);

var columns = [
//    {title: "Reten", dataKey: "reten"},
    {title: "Codigo", dataKey: "code"}, 
    {title: "Nombre del Producto", dataKey: "product"}, 
    {title: "Por Recibir", dataKey: "pr"}, 
    {title: "Disponible", dataKey: "disponible"}, 
    {title: "Por Enviar", dataKey: "pv"}, 
//    ...
];



var rows = [
  <?php foreach($products as $product):
	$r=OperationData::getRByStock($product->id,$_GET["stock"]);
	$q=OperationData::getQByStock($product->id,$_GET["stock"]);
	$d=OperationData::getDByStock($product->id,$_GET["stock"]);
  ?>
    {
      "code": "<?php echo $product->barcode; ?>",
      "product": "<?php echo $product->name; ?>",
      "pr": "<?php echo $r;?>",
      "disponible": "<?php echo $q;?>",
      "pv": "<?php echo $d; ?>",
      },
 <?php endforeach; ?>
];


doc.autoTable(columns, rows, {
    theme: 'grid',
    overflow:'linebreak',
    styles: {
        fillColor: <?php echo Core::$pdf_table_fillcolor;?>
    },
    columnStyles: {
        id: {fillColor: <?php echo Core::$pdf_table_column_fillcolor;?>}
    },
    margin: {top: 100},
    afterPageContent: function(data) {
//        doc.text("Header", 40, 30);
    }
});

doc.setFontSize(12);
doc.text("<?php echo Core::$pdf_footer;?>", 40, doc.autoTableEndPosY()+25);

<?php 
$con = ConfigurationData::getByPreffix("report_image");
if($con!=null && $con->val!=""):
?>

var img = new Image();
img.src= "storage/configuration/<?php echo $con->val;?>";
img.onload = function(){
doc.addImage(img, 'PNG', 495, 20, 60, 60,'mon');	
doc.save('inventary-<?php echo date("d-m-Y h:i:s",time()); ?>.pdf');
}
<?php else:?>
doc.save('inventary-<?php echo date("d-m-Y h:i:s",time()); ?>.pdf');
<?php endif; ?>


//doc.output("datauri");

        }
    </script>