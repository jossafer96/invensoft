<link href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.uikit.min.css" rel="stylesheet" type="text/css" />
		<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            SubCategorias
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">

<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
	<a href="index.php?view=newsubcategory" class="btn btn-default"><i class='fa fa-th-list'></i> Nueva SubCategoria</a>
</div>
<div class="clearfix"></div>
<br>
		<?php

		$users = CategoryData::getSubAll();
		if(count($users)>0){
			// si hay usuarios
			?>
<div class="box">
  <div class="box-header">
    <h3 class="box-title">SubCategorias</h3>

  </div><!-- /.box-header -->
  <div class="box-body">

			<table class="table table-bordered datatable table-hover">
			<thead>
			<th>Ver</th>
			<th>Codigo</th>
			<th>Nombre</th>
			<th>Categoria</th>
			<th>Acciones</th>
			</thead>
			<?php
			foreach($users as $user){
				?>
				<tr>
				<td style="width:30px;"><a href="index.php?view=productbysubcategory&id=<?php echo $user->id;?>&id2=<?php echo $user->id_category;?>" class="btn btn-default btn-xs"><i class="fa fa-th-list"></i> Productos</a> 
				</td>
				<td><?php 
					if ($user->id<10) {
						$codigo="0".$user->id;
					}else{
						$codigo=$user->id;
					}
				
				echo $codigo ?></td>
				<td><?php echo $user->name ?></td>
				<td><?php echo $user->name_category ?></td>
				<td style="width:130px;"><a href="index.php?view=editsubcategory&id=<?php echo $user->id;?>&id2=<?php echo $user->id_category;?>" class="btn btn-warning btn-xs">Editar</a> <a href="index.php?view=delsubcategory&id=<?php echo $user->id;?>&id2=<?php echo $user->id_category;?>" class="btn btn-danger btn-xs">Eliminar</a></td>
				</tr>
				<?php

			}

?>
			</table>
  </div><!-- /.box-body -->
</div><!-- /.box -->
			
			<?php


		}else{
			echo "<p class='alert alert-danger'>No hay Categorias</p>";
		}


		?>


	</div>
</div>
        </section><!-- /.content -->