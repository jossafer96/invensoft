<!DOCTYPE html>
<html>

  <head>
  <meta lang="es">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>ASJ | INVENTARIO</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="plugins/dist/img/icono2.ico" />	
    <!-- Bootstrap 3.3.4 -->
    <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Jquery -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Theme style -->
    <link href="plugins/dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- Calendar style -->
    <link href="plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css" media='print' />
    
    <link href="plugins/dist/css/skins/skin-blue.css" rel="stylesheet" type="text/css" />
    <!-- Tables style -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
        
  <script src="plugins/morris/raphael-min.js"></script>
  <script src="plugins/morris/morris.js"></script>
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <link rel="stylesheet" href="plugins/morris/example.css">
  <script src="plugins/jspdf/jspdf.min.js"></script>
  <script src="plugins/jspdf/jspdf.plugin.autotable.js"></script>

          <?php if(isset($_GET["view"]) && $_GET["view"]=="sell"):?>
  <script type="text/javascript" src="plugins/jsqrcode/llqrcode.js"></script>
  <script type="text/javascript" src="plugins/jsqrcode/webqr.js"></script>
          <?php endif;?>

  </head>

  <body  class="<?php if(isset($_SESSION["user_id"]) || isset($_SESSION["client_id"])):?>  skin-blue sidebar-mini <?php else:?>login-page<?php endif; ?>" >
    
    <div class="wrapper">
      <!-- Main Header -->
      <?php if(isset($_SESSION["user_id"]) || isset($_SESSION["client_id"])):?>
      <header class="main-header">
        <!-- Logo -->
        <a href="./" class="logo" style="text-decoration:none;">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b style="font-weight: 700;">I</b>A</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg" ><b style="font-weight: 700;">INVENTARIO</b>ASJ</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a style="text-decoration:none;" href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

          <?php
          if(isset($_SESSION["user_id"])):
          $msgs = MessageData::getUnreadedByUserId($_SESSION["user_id"]);
          ?>
            <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success"><?php echo count($msgs);?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Tienes <?php echo count($msgs);?> mensajes nuevos</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                <?php foreach($msgs as $i):?>
                  <li><!-- start message -->
                    <a href="./?view=messages&opt=open&code=<?php echo $i->code;?>">
                      <h4>
                    <?php if($i->user_from!=$_SESSION["user_id"]):?>
                    <?php $u = $i->getFrom(); echo $u->name." ".$u->lastname;?>
                    <?php elseif($i->user_to!=$_SESSION["user_id"]):?>
                    <?php $u = $i->getTo(); echo $u->name." ".$u->lastname;?>
                  <?php endif; ?>
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>

                      </h4>
                      <p><?php echo $i->message; ?></p>
                    </a>
                  </li>
                <?php endforeach; ?>

                </ul>
              </li>
              <li class="footer"><a href="./?view=messages&opt=all">Todos los mensajes</a></li>
            </ul>
          </li>
        <?php endif;?>
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class=""><?php if(isset($_SESSION["user_id"]) ){ echo UserData::getById($_SESSION["user_id"])->name;
                  if(Core::$user->kind==1){ echo "(Administrador)"; }
                  else if(Core::$user->kind==2){ echo " (Almacenista)"; }
                  else if(Core::$user->kind==3){ echo " (Oficial B/S)"; }
                  else if(Core::$user->kind==4){ echo " (Contador)"; }
                  }else if (isset($_SESSION["client_id"])){ echo PersonData::getById($_SESSION["client_id"])->name." (Cliente)" ;}?> <b class="caret"></b> </span>

                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->

                  <!-- Menu Footer-->
                  <li class="user-footer">
                  <div class="pull-left">
                      <a href="./index.php?view=edituser&id=<?php echo $_SESSION["user_id"]?>" class="btn btn-default ">Editar Perfil</a>
                    </div>
                    <div class="pull-right">
                      <a href="./logout.php" class="btn btn-default ">Salir</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!--
            <div class="user-panel">
            <div class="pull-left image">
              <img src="1.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>Alexander Pierce</p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          -->
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">ADMINISTRACION DEL SISTEMA</li>
            <?php if(isset($_SESSION["user_id"])):?>
                <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="home")){ echo "active"; }?>"><a href="./index.php?view=home"><i class='fa fa-dashboard'></i> <span>Dashboard</span></a></li>
                <?php if(Core::$user->kind!=4):?>
                        <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="alerts")){ echo "active"; }?>">
                        <a href="./index.php?view=alerts">
                        <i class='fa fa-bell-o'></i> 
                        <span>Alertas</span>
                            
                            <?php
                            $found=0;
                            $products = ProductData::getAllNoUnique();
                            foreach($products as $product){
                              $q= OperationData::getQByStock($product->id,StockData::getPrincipal()->id);
                              if( $q==0 ||  $q<=$product->inventary_min){
                                $found+=1;
                              }
                            }
                            if ($found!=0) {
                              echo '<small class="label pull-right bg-red">';
                              echo $found;
                              echo '</small>';
                            }
                               
                           ?>
                            
                        </a>
                        </li>      
                  <?php endif; ?>
           
            <!--<li><a href="./?view=cotizations"><i class='fa fa-square-o'></i> <span>Cotizaciones</span></a></li>-->
            <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="calendar")){ echo "active"; }?>">
              <a href="./?view=calendar">
                <i class="fa fa-calendar"></i> <span>Calendario</span>
                <small class="label pull-right bg-green">new</small>
              </a>
            </li>
            <?php if(Core::$user->kind!=2):?>
            <li class="treeview <?php if(isset($_GET["view"]) && ($_GET["view"]=="sell"||$_GET["view"]=="sells"||$_GET["view"]=="sellscredit"||$_GET["view"]=="bydeliver" ||$_GET["view"]=="bycob")){ echo "active"; }?>"   >
              <a href="#"><i class='fa fa-shopping-cart'></i> <span>Ventas</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="sell")){ echo "active"; }?>"><a href="./?view=sell">Vender</a></li>
                <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="sells")){ echo "active"; }?>"><a href="./?view=sells">Ver Ventas</a></li>
              <!--  <?php if(Core::$user->kind==1):?>
                <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="sellscredit")){ echo "active"; }?>"><a href="./?view=sellscredit">Ventas credito</a></li>
                <?php endif; ?>-->
                <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="bydeliver")){ echo "active"; }?>"><a href="./?view=bydeliver">Por Entregar</a></li>
                <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="bycob")){ echo "active"; }?>"><a href="./?view=bycob">Por Cobrar</a></li>
              </ul>
            </li>
            <?php endif; ?>

          
          <?php if(Core::$user->kind!=2 && Core::$user->kind!=4 ):?>
          <li class="treeview <?php if(isset($_GET["view"]) && ($_GET["view"]=="re"||$_GET["view"]=="res"||$_GET["view"]=="byreceive"||$_GET["view"]=="topay")){ echo "active"; }?>">
            <a href="#"><i class='fa fa-clock-o'></i> <span>Compras</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="re")){ echo "active"; }?>"><a href="./?view=re">Nueva </a></li>
              <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="res")){ echo "active"; }?>"><a href="./?view=res">Compras</a></li>
              <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="byreceive")){ echo "active"; }?>"><a href="./?view=byreceive">Por Recibir</a></li>
              <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="topay")){ echo "active"; }?>"><a href="./?view=topay">por Pagar</a></li>
            </ul>
          </li>
          <?php endif; ?>
            <?php if(Core::$user->kind!=4):?>
              <li class="treeview <?php if(isset($_GET["view"]) && ($_GET["view"]=="products"||$_GET["view"]=="categories"||$_GET["view"]=="subcategories"||$_GET["view"]=="programs"||$_GET["view"]=="password"||$_GET["view"]=="clients"||$_GET["view"]=="providers")){ echo "active"; }?>">
              <a href="#"><i class='fa fa-database'></i> <span>Catalogos</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="products")){ echo "active"; }?>"><a href="./?view=products">Productos</a></li>
                <?php if(Core::$user->kind==1):?>
                <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="categories")){ echo "active"; }?>"><a href="./?view=categories">Categorias</a></li>
                <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="subcategories")){ echo "active"; }?>"><a href="./?view=subcategories">SubCategorias</a></li>
                <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="programs")){ echo "active"; }?>"><a href="./?view=programs">Unidad/Programa</a></li>
                <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="password")){ echo "active"; }?>"><a href="./?view=password">Cuentas/Contraseñas</a></li>
                <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="clients")){ echo "active"; }?>"><a href="./?view=clients">Colaborador/Empleado</a></li>
                <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="providers")){ echo "active"; }?>"><a href="./?view=providers">Proveedores</a></li>
                <?php endif; ?>
                <?php if(Core::$user->kind==3):?>
                  <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="password")){ echo "active"; }?>"><a href="./?view=password">Cuentas/Contraseñas</a></li>
                <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="providers")){ echo "active"; }?>"><a href="./?view=providers">Proveedores</a></li>
                <?php endif; ?>
              </ul>
            </li>
            <?php endif; ?>
            <?php if(Core::$user->kind!=2&&Core::$user->kind!=3):?>
            <li class="treeview <?php if(isset($_GET["view"]) && ($_GET["view"]=="balance"||$_GET["view"]=="spends"||$_GET["view"]=="smallbox"||$_GET["view"]=="box")){ echo "active"; }?>">
              <a href="#"><i class='fa fa-briefcase'></i> <span>Finanzas</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <!--<li><a href="./?view=credit">Credito</a></li>-->
                <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="balance")){ echo "active"; }?>"><a href="./?view=balance">Balance</a></li>
                <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="spends")){ echo "active"; }?>"><a href="./?view=spends">Gastos</a></li>
                <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="smallbox")){ echo "active"; }?>"><a href="./?view=smallbox&opt=all">Caja Chica</a></li>
                <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="box")){ echo "active"; }?>"><a href="./?view=box">Caja</a></li>
              </ul>
            </li>
            <?php endif; ?>
            <?php if(Core::$user->kind!=4):?>
            <li class="treeview <?php if(isset($_GET["view"]) && ($_GET["view"]=="inventary"||$_GET["view"]=="stocks"||$_GET["view"]=="asing"||$_GET["view"]=="selectstock")){ echo "active"; }?>">
              <a href="#"><i class='fa fa-area-chart'></i> <span>Inventario</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="inventary")){ echo "active"; }?>"><a href="./?view=inventary&stock=<?php echo StockData::getPrincipal()->id;?>">Inventario Principal</a></li>
                <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="asing")){ echo "active"; }?>"><a href="./?view=asing">Asignar Equipo</a></li>
                <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="selectstock")){ echo "active"; }?>"><a href="./?view=selectstock">Traspasar</a></li>
            <?php if(Core::$user->kind==1):?>
                <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="stocks")){ echo "active"; }?>"><a href="./?view=stocks">Inventarios</a></li>
                
                
              <?php endif; ?>
              </ul>
            </li>
            <?php endif; ?>
            <li class="treeview <?php if(isset($_GET["view"]) && ($_GET["view"]=="contacts"||$_GET["view"]=="messages")){ echo "active"; }?>">
              <a href="#"><i class='fa fa-wrench'></i> <span>Herramientas</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="contacts")){ echo "active"; }?>"><a href="./?view=contacts">Contactos</a></li>
                <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="messages")){ echo "active"; }?>"><a href="./?view=messages&opt=all">Mensajes</a></li>
              </ul>
            </li>
            <?php if(Core::$user->kind==1):?>
                        <li class="treeview <?php if(isset($_GET["view"]) && ($_GET["view"]=="reports"||$_GET["view"]=="sellreports"||$_GET["view"]=="resreport"||$_GET["view"]=="paymentreport"||$_GET["view"]=="popularproductsreport")){ echo "active"; }?>">
              <a href="#"><i class='fa fa-file-text-o'></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li  class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="reports")){ echo "active"; }?>"><a href="./?view=reports">Inventario</a></li>
                <li  class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="sellreports")){ echo "active"; }?>"><a href="./?view=sellreports">Ventas</a></li>
                <li  class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="resreport")){ echo "active"; }?>"><a href="./?view=resreport">Compras</a></li>
                <li  class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="paymentreport")){ echo "active"; }?>"><a href="./?view=paymentreport">Reporte de pagos</a></li>
                <li  class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="popularproductsreport")){ echo "active"; }?>"><a href="./?view=popularproductsreport">Productos Populares</a></li>
              </ul>
            </li>
            

            <li class="treeview  <?php if(isset($_GET["view"]) && ($_GET["view"]=="users"||$_GET["view"]=="settings"||$_GET["view"]=="import")){ echo "active"; }?>">
              <a href="#"><i class='fa fa-cog'></i> <span>Administracion</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="users")){ echo "active"; }?>"><a href="./?view=users">Usuarios</a></li>
                <li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="settings")){ echo "active"; }?>"><a href="./?view=settings">Configuracion</a></li>
                <!--<li class="<?php if(isset($_GET["view"]) && ($_GET["view"]=="import")){ echo "active"; }?>"><a href="./?view=import">Importar Datos</a></li>-->


              </ul>
            </li>
          <?php endif; ?>
          
            <?php elseif(isset($_SESSION["client_id"])):?>
            <li><a href="./index.php?view=clienthome"><i class='fa fa-dashboard'></i> <span>Dashboard</span></a></li>
            <li><a href="./?view=cotizations"><i class='fa fa-square-o'></i> <span>Cotizaciones</span></a></li>
            <li class="treeview <?php if(isset($_GET["view"]) && ($_GET["view"]=="sells"||$_GET["view"]=="bydeliver" ||$_GET["view"]=="bycob")){ echo "active"; }?>"   >
              <a href="#"><i class='fa fa-shopping-cart'></i> <span>Mis Compras</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="./?view=sells">Todas</a></li>
                <li><a href="./?view=bydeliver">Por Recibir</a></li>
                <li><a href="./?view=bycob">Por Pagar</a></li>
              </ul>
            </li>
          <?php endif;?>

          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
    <?php endif;?>

      <!-- Content Wrapper. Contains page content -->
      <?php if(isset($_SESSION["user_id"]) || isset($_SESSION["client_id"])):?>
        
      <div  class="content-wrapper">
      <div  id="loader" class="overlay">

<div class="spinner">



</div>



</div>
    
        <?php View::load("index");?>
      </div><!-- /.content-wrapper -->

        <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong><a  >Asociacion para una Sociedad mas Justa</a></strong>
      </footer>
      <?php else:?>
        <?php if(isset($_GET["view"]) && $_GET["view"]=="clientaccess"):?>
<div class="login-box">
      <div class="login-logo">
        <a href="./"><b>INVENTARIO</b>ASJ</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
      <center><h4>Cliente</h4></center>
        <form action="./?action=processloginclient" method="post">
          <div class="form-group has-feedback">
            <input type="text" name="username" required class="form-control" placeholder="Usuario"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" required class="form-control" placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">

            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat"><span class="glyphicon glyphicon-send"></span> Acceder al sistema</button>
              <a href="./" class="btn btn-default btn-block btn-flat"><i class="fa fa-arrow-left"></i> Regresar</a>
            </div><!-- /.col -->
          </div>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
        <?php else:?>

          <div class="container">
          <div class="row">
          <div class='col-lg-6' style="margin-top: 14rem; text-align: center;">
          <img src="plugins/dist/img/icon.png" alt="">
          <div class="login-logo ">
            <a href="./"><b>INVENTARIO</b>ASJ <sup></sup></a>
          </div><!-- /.login-logo -->
          </div>
          <div class="col-lg-6" style="margin-top: 14rem">
      
      <div class="login-box-body">
      <div class="login-logo ">
            <a href="./"><b>INICIA</b>SESION <sup></sup></a>
          </div><!-- /.login-title -->
      <center><h4>Usuario</h4></center>
        <form action="./?action=processlogin" method="post">
          <div class="form-group has-feedback <?php if(isset($_COOKIE["prdupd1"])): echo 'has-error'; setcookie("prdupd1","",time()-18600); endif; ?>">
            <input type="text" name="username" required class="form-control " placeholder="Usuario"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback <?php if(isset($_COOKIE["prdupd1"])): echo 'has-error'; setcookie("prdupd1","",time()-18600); endif; ?>">
            <input type="password" name="password" required class="form-control" placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">

            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat"><span class="glyphicon glyphicon-send"></span> Acceder al sistema</button>
              <br>
              <?php if(isset($_COOKIE["prdupd1"])):?>
                <p class="alert alert-danger">Usuario o Contraseña incorrecta.</p>
              <?php setcookie("prdupd1","",time()-18600); endif; ?>
              <!--<a href="./?view=clientaccess" class="btn btn-default btn-block btn-flat"><i class="fa fa-arrow-right"></i> Acceso como cliente  </a>-->
            </div><!-- /.col -->
          </div>
        </form>
      </div><!-- /.login-box-body -->
      </div><!-- /.container -->
      </div><!-- /.row-->
    </div><!-- /.container-->
      <?php endif;?>
      <?php endif;?>


    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
  
  
    <!-- Bootstrap 3.3.2 JS -->
    <script src="plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="plugins/dist/js/app.js" type="text/javascript"></script>
    
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.js"></script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $(".datatable").DataTable({
          "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "No se encontraron resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }
        });
        $("#loader").hide();
      });
    </script>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
          Both of these plugins are recommended to enhance the
          user experience. Slimscroll is required when using the
          fixed layout. -->
          <!-- fullCalendar 2.2.5 -->
          
    <!-- Bootstrap 3.3.2 JS -->
   
    <!-- jQuery UI 1.11.1 -->
    <script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
    
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.uikit.min.js" type="text/javascript"></script>
    <!-- Page specific script -->
    <script type="text/javascript">
      $(function () {

        /* initialize the external events
         -----------------------------------------------------------------*/
        function ini_events(ele) {
          ele.each(function () {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
              title: $.trim($(this).text()) // use the element's text as the event title
            };

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);

            // make the event draggable using jQuery UI
            $(this).draggable({
              zIndex: 1070,
              revert: true, // will cause the event to go back to its
              revertDuration: 0  //  original position after the drag
            });

          });
        }
        ini_events($('#external-events div.external-event'));

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date();
        var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();
        $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
          },
          buttonText: {
            today: 'today',
            month: 'month',
            week: 'week',
            day: 'day'
          },
          //Random default events
          events: [
            {
              title: 'All Day Event',
              start: new Date(y, m, 1),
              backgroundColor: "#f56954", //red
              borderColor: "#f56954" //red
            },
            {
              title: 'Long Event',
              start: new Date(y, m, d - 5),
              end: new Date(y, m, d - 2),
              backgroundColor: "#f39c12", //yellow
              borderColor: "#f39c12" //yellow
            },
            {
              title: 'Meeting',
              start: new Date(y, m, d, 10, 30),
              allDay: false,
              backgroundColor: "#0073b7", //Blue
              borderColor: "#0073b7" //Blue
            },
            {
              title: 'Lunch',
              start: new Date(y, m, d, 12, 0),
              end: new Date(y, m, d, 14, 0),
              allDay: false,
              backgroundColor: "#00c0ef", //Info (aqua)
              borderColor: "#00c0ef" //Info (aqua)
            },
            {
              title: 'Birthday Party',
              start: new Date(y, m, d + 1, 19, 0),
              end: new Date(y, m, d + 1, 22, 30),
              allDay: false,
              backgroundColor: "#00a65a", //Success (green)
              borderColor: "#00a65a" //Success (green)
            },
            {
              title: 'Click for Google',
              start: new Date(y, m, 28),
              end: new Date(y, m, 29),
              url: 'http://google.com/',
              backgroundColor: "#3c8dbc", //Primary (light-blue)
              borderColor: "#3c8dbc" //Primary (light-blue)
            }
          ],
          editable: true,
          droppable: true, // this allows things to be dropped onto the calendar !!!
          drop: function (date, allDay) { // this function is called when something is dropped

            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data('eventObject');

            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);

            // assign it the date that was reported
            copiedEventObject.start = date;
            copiedEventObject.allDay = allDay;
            copiedEventObject.backgroundColor = $(this).css("background-color");
            copiedEventObject.borderColor = $(this).css("border-color");

            // render the event on the calendar
            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
              // if so, remove the element from the "Draggable Events" list
              $(this).remove();
            }

          }
        });

        /* ADDING EVENTS */
        var currColor = "#3c8dbc"; //Red by default
        //Color chooser button
        var colorChooser = $("#color-chooser-btn");
        $("#color-chooser > li > a").click(function (e) {
          e.preventDefault();
          //Save color
          currColor = $(this).css("color");
          //Add color effect to button
          $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
        });
        $("#add-new-event").click(function (e) {
          e.preventDefault();
          //Get value and make sure it is not null
          var val = $("#new-event").val();
          if (val.length == 0) {
            return;
          }

          //Create events
          var event = $("<div />");
          event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
          event.html(val);
          $('#external-events').prepend(event);

          //Add draggable funtionality
          ini_events(event);

          //Remove event from text input
          $("#new-event").val("");
        });
      });
    </script>
  </body>
</html>
