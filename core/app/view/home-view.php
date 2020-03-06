<link href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.uikit.min.css" rel="stylesheet" type="text/css" />
<?php




  $dateB = new DateTime(date('Y-m-d'));
  $dateA = $dateB->sub(DateInterval::createFromDateString('30 days'));
  $sd= strtotime(date_format($dateA,"Y-m-d"));
  $ed = strtotime(date("Y-m-d"));
  $ntot = 0;
  $nsells = 0;
for($i=$sd;$i<=$ed;$i+=(60*60*24)){
  $operations = SellData::getGroupByDateOp(date("Y-m-d",$i),date("Y-m-d",$i),2);
  $res = SellData::getGroupByDateOp(date("Y-m-d",$i),date("Y-m-d",$i),1);
  $spends = SpendData::getGroupByDateOp(date("Y-m-d",$i),date("Y-m-d",$i));
//  echo $operations[0]->t;
  $sr = $res[0]->tot!=null?$res[0]->tot:0;
  $sl = $operations[0]->t!=null?$operations[0]->t:0;
  $sp = $spends[0]->t!=null?$spends[0]->t:0;
  $ntot+=($sl-($sp+$sr));
  $nsells += $operations[0]->c;
}
?>
  <section class="content-header">
    <h1>ASJ INVENTARIO</h1>
    <h4>Almacen principal: <?php echo StockData::getPrincipal()->name;  ?></h4>
  </section>

    <section class="content">
<div class="row">
  <div class="col-md-12" style='text-align: center;'>

<?php if(Core::$user->kind==1){?>  
  <a href="./?view=newproduct" class="btn btn-lg btn-primary" style="margin-left: 20px;margin-bottom: 10px;">Nuevo Producto</a>
  <a href="./?view=inventary&stock=<?php echo StockData::getPrincipal()->id; ?>" class="btn btn-lg btn-info" style="margin-left: 20px;margin-bottom: 10px;">Inventario Principal</a>
  <a href="./?view=reports" class="btn btn-lg btn-success" style="margin-left: 20px;margin-bottom: 10px;">Crear un Reporte</a>
  <a href="./?view=settings" class="btn btn-lg btn-warning" style="margin-left: 20px;margin-bottom: 10px;">Configuracion</a>
  
  <?php }?>

  <?php if(Core::$user->kind==2){?>  
  
  
    <a href="./?view=inventary&stock=<?php echo StockData::getPrincipal()->id; ?>" class="btn btn-lg btn-info" style="margin-left: 20px;margin-bottom: 10px;">Inventario Principal</a>
    <a href="./?view=byreceive" class="btn btn-lg btn-primary" style="margin-left: 20px;margin-bottom: 10px;">Productos/Equipos a Recibir</a>
    <a href="./?view=bydeliver" class="btn btn-lg btn-success" style="margin-left: 20px;margin-bottom: 10px;">Productos/Equipos a Entregar</a>
  <a href="./?view=selectstock" class="btn btn-lg btn-warning" style="margin-left: 20px;margin-bottom: 10px;">Traspasar</a>
  
  <?php }?>

  <?php if(Core::$user->kind==3){?>  
  
  
  <a href="./?view=products" class="btn btn-lg btn-info" style="margin-left: 20px;margin-bottom: 10px;">Inventario</a>
  <a href="./?view=newproduct" class="btn btn-lg btn-primary" style="margin-left: 20px;margin-bottom: 10px;">Nuevo Producto</a>
  <a href="./?view=re" class="btn btn-lg btn-success" style="margin-left: 20px;margin-bottom: 10px;">Reabastecer</a>
<a href="./?view=asing" class="btn btn-lg btn-warning" style="margin-left: 20px;margin-bottom: 10px;">Asignar</a>

<?php }?>

  
  
  </div>
  </div>

<br>
<div class="row">
              <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3 style="color: white;"><?php echo count(ProductData::getAll()); ?></h3>
                  <p>Equipo/Productos</p>
                </div>
                <div class="icon">
                <ion-icon name="filing"></ion-icon>
                </div>
                
                <a href="<?php if(Core::$user->kind==1){ echo "./?view=products";}?>" class="small-box-footer">Mas Informacion <i class="fa fa-arrow-circle-right"></i></a>
               
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3 style="color: white;"><?php echo count(PersonData::getColaborators());?><sup style="font-size: 20px"></sup></h3>
                  <p>Colaboradores</p>
                </div>
                <div class="icon">
                <ion-icon name="people"></ion-icon> 
                </div>
                
                <a href="<?php if(Core::$user->kind==1){ echo "./?view=clients";}?>"  class="small-box-footer">Mas Informacion <i class="fa fa-arrow-circle-right"></i></a>
                
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
            <div class="clearfix visible-sm-block"></div>
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3 style="color: white;"><?php echo count(UserData::getAll());?></h3>
                  <p>Usuarios Registrados</p>
                </div>
                <div class="icon">
                <ion-icon name="finger-print"></ion-icon>
                </div>
              
                <a href="<?php if(Core::$user->kind==1){ echo "./?view=users";}?>" class="small-box-footer">Mas Informacion <i class="fa fa-arrow-circle-right"></i></a>
                
              </div>
            </div><!-- ./col -->
        
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3 style="color: white;"><?php  
                        $operations = OperationData::getAll();
                         echo count($operations);
                        ?>
                  </h3>
                  <p>Operaciones Realizadas</p>
                </div>
                <div class="icon">
                <ion-icon name="repeat"></ion-icon>
                </div>
                <a href="#" class="small-box-footer">Mas Informacion <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">

        <?php

              $operations = OperationData::getHistory();
                if(count($operations)>0){
            ?>
        <div class="box">
  <div class="box-header">
    <h3 class="box-title">Historial</h3>

  </div><!-- /.box-header -->
  <div class="box-body no-padding">
<div class="box-body">
<table class="table table-bordered datatable table-hover">
	<thead>
    <th>N°</th>
    <th>Fecha</th>
    <th>Equipo</th>
    <th>Operacion Realizada</th>
    <th>Realizado por</th>
    <th >Codigo Equipo</th>
		
	</thead>
  <?php 
  $n=1;
  foreach($operations as $operation):?>
	<tr>
    <td><?php echo $n; ?></td>
  <td><?php echo $operation->created_at; ?></td>
                      <td><?php echo $operation->name; ?></td>
                      <td><span class="badge badge-success"><?php echo $operation->description_operation; ?></span></td>
                      <td><?php echo $operation->user_operation; ?></td>
                        
                      <td>
                        <div  data-height="20"><?php echo $operation->barcode; ?></div>
                      </td>
  </tr>
  
  <?php 
$n++;
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
<br><br><br><br><br>

          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->







</section>
