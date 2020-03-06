<link href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.uikit.min.css" rel="stylesheet" type="text/css" />
<section class="content">
<div class="row">
	<div class="col-md-12">
		<h1>Lista de Usuarios</h1>
	<a href="index.php?view=newuser&kind=1" class="btn btn-default"><i class='glyphicon glyphicon-user'></i> Nuevo Administrador</a>
	<a href="index.php?view=newuser&kind=2" class="btn btn-default"><i class='glyphicon glyphicon-user'></i> Nuevo Almacenista</a>
	<a href="index.php?view=newuser&kind=3" class="btn btn-default"><i class='glyphicon glyphicon-user'></i> Nuevo Oficial B/S</a>
<br><br>
		<?php

		$users = UserData::getAll();
		if(count($users)>0){
			// si hay usuarios
			?>
			<div style="padding: 20px;" class="box box-primary">
			<table class="table table-bordered datatable table-hover">
			<thead>
			<th>Nombre completo</th>
			<th>Nombre de usuario</th>
			<th>Email</th>
			<th>Almacen</th>
			<th>Activo</th>
			<th>Tipo</th>
			<th>Acciones</th>
			</thead>
			<?php
			foreach($users as $user){
				?>
				<tr>
				<td><?php echo $user->name." ".$user->lastname; ?></td>
				<td><?php echo $user->username; ?></td>
				<td><?php echo $user->email; ?></td>
				<td><?php if($user->stock_id!=null){ echo $user->getStock()->name; } ?></td>
				<td>
					<?php if($user->status==1):?>
						<i class="glyphicon glyphicon-ok"></i>
					<?php endif; ?>
				</td>
				<td>
				<?php
switch ($user->kind) {
	case '1': echo "Administrador"; break;
	case '2': echo "Almacenista"; break;
	case '3': echo "Oficial B/S"; break;
	case '4': echo "Contador"; break;
	default:
		# code...
		break;
}
				?>
				</td>
				<td style="width:30px;"><a href="index.php?view=edituser&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a></td>
				</tr>
				<?php

			}
 echo "</table></div>";


		}else{
			// no hay usuarios
		}


		?>


	</div>
</div>
</section>