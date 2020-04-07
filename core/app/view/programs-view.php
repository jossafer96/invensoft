		<!-- Content Header (Page header) -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.uikit.min.css" rel="stylesheet" type="text/css" />
        <section class="content-header">
          <h1>
            Unidades/Programas
          </h1>

        </section>

        <!-- Main content -->
        <section class="content">

<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
	<a href="index.php?view=newprogram" class="btn btn-default"><i class='fa fa-th-list'></i> Nueva Unidad/Programa</a>
</div>
<div class="clearfix"></div>
<br>
		<?php

		$users = unitsData::getAll();
		if(count($users)>0){
			// si hay usuarios
			?>
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Unidades/Programas</h3>

  </div><!-- /.box-header -->
  <div class="box-body">

			<table class="table table-bordered datatable table-hover">
			<thead>
		
			<th style="text-align: center; width: 45px;">Codigo</th>
			<th style="text-align: center; width: 350px;">Nombre</th>
			<th>Descripcion</th>
			<th style="text-align: center;">Acciones</th>
			</thead>
			<?php
			foreach($users as $user){
				?>
				<tr>
				 
				</td>
				<td style="text-align: center;"><?php 
				if ($user->unit_id<10) {
						$codigo="0".$user->unit_id;
					}else{
						$codigo=$user->unit_id;
					} 
					echo $codigo?></td>
				<td style="text-align: center;"><?php echo $user->name_unit ?></td>
				<td><?php echo $user->description ?></td>
				<td style="width:130px; text-align: center;"><a href="index.php?view=editprogram&id=<?php echo $user->unit_id;?>" class="btn btn-warning btn-xs">Editar</a> <a href="index.php?view=delprogram&id=<?php echo $user->unit_id;?>" class="btn btn-danger btn-xs">Eliminar</a></td>
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