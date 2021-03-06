<link href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.uikit.min.css" rel="stylesheet" type="text/css" />
		<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Categorias
          </h1>

        </section>

        <!-- Main content -->
        <section class="content">

<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
	<a href="index.php?view=newcategory" class="btn btn-default"><i class='fa fa-th-list'></i> Nueva Categoria</a>
</div>
<div class="clearfix"></div>
<br>
		<?php

		$users = CategoryData::getAll();
		if(count($users)>0){
			// si hay usuarios
			?>
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Categorias</h3>

  </div><!-- /.box-header -->
  <div class="box-body">

			<table class="table table-bordered datatable table-hover">
			<thead>
			<th>Ver</th>
			<th>Nombre</th>
			<th>Abreviacion</th>
			<th>Acciones</th>
			</thead>
			<?php
			foreach($users as $user){
				?>
				<tr>
				<td style="width:30px;"><a href="index.php?view=productbycategory&id=<?php echo $user->id;?>" class="btn btn-default btn-xs"><i class="fa fa-th-list"></i> Productos</a> 
				</td>
				<td><?php echo $user->name ?></td>
				<td><?php echo $user->abreviation ?></td>
				<td style="width:130px;"><a href="index.php?view=editcategory&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a> <a href="index.php?view=delcategory&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a></td>
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