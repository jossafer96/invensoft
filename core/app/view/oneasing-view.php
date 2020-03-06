<section class="content" >
<?php if(isset($_GET["id"]) && $_GET["id"]!=""):?>
<?php

$operation = ProductData::getById($_GET["id"]);
$accounts = PasswordData::getByProductId($_GET["id"]);
?>
<?php endif; ?>
<div class="btn-group pull-right">
  <button type="button" class="btn btn-default " data-toggle="dropdown"  onclick="location.href='index.php?view=createasing&id=<?php echo $operation->id; ?>'">
    <i class="fa fa-download" ></i> Descargar <span class="caret"></span>
  </button>
 
</div>
<div id="docasing" style="margin: 100px;margin-top: 50px;border: 1px solid;padding: 30px;">
<h3>Resumen de Asignacion</h3>



<div class="box box-primary">
<table class="table table-bordered">
<?php if($operation->id!=""):
$client = $operation;
?>




<tr>
  <td> <b>Asignado a</b> </td>
  <td> <b> Responsable</b></td>
  <td> <b> Unidad</b></td>
  <td> <b> Fecha de Entrega </b></td>
  
 
 
</tr>

<tr>
<td><b><?php $person = personData::getById($client->asing);
		echo $person->name." ".$person->lastname; ?></b></td>
  <td><?php       if (is_numeric($client->user_responsable)) {
        $user2 = PersonData::getById($client->user_responsable);
        echo $user2->name." ".$user2->lastname;
      }else {
    echo $client->user_responsable;}?></td>
  <td>    <?php 
        if ($client->asing!=0) {
          $id_asing=$client->asing;
          $user1 = PersonData::getById($id_asing);
          echo $user1->getUnit()->name_unit;
        }elseif ($client->asing==0) {
         echo 'Sin definir';
        }
    ?></td>
  <td><?php echo  date('d-m-Y H:i:s');?></td>
</tr>
<?php endif; ?>
</table>
</div>
<br>

<h3>Detalles</h3>
<div class="box box-primary">
<table class="table table-bordered table-hover">
  <thead>
    <th>Codigo</th>
    <th>Equipo/Producto</th>
    <th>Responsable</th>
    <th>Detalles</th>
   

  </thead>
<?php
  
    $op  = $operation;
?>
<tr>
  <td><?php echo $op->barcode ;?></td>
  <td><?php echo $op->name ;?></td>
  <td><?php       if (is_numeric($op->user_responsable)) {
        $user2 = PersonData::getById($op->user_responsable);
        echo $user2->name." ".$user2->lastname;
      }else {
    echo $op->user_responsable;}?></td>
  
  <td>
    <b>Marca: </b><?php  echo $op->brand;?><br><br>
    <b>Modelo: </b><?php  echo $op->model;?><br><br>
    <b>S/N: </b><?php  echo $op->serial;?><br><br>
    <b>Descripcion adicional: </b><?php  echo $op->description;?>
  </td>
  
</tr>

</table>
<br>
</div>
<h3>Cuentas/Contraseñas</h3>
<div class="box box-primary">
<table class="table table-bordered table-hover">
  <thead>
    <th>Tipo de cuenta</th>
    <th>Cuenta</th>
    <th>Contraseña</th>
    
   

  </thead>
<?php
  
   
   
    foreach($accounts as $account):
?>
<tr>
  <td><?php echo $account->name_type ;?></td>
  <td><?php echo $account->description ;?></td>
  <td><?php echo $account->password ;?></td>
  
  
</tr>
<?php endforeach;?>
</table>
</div>
</div>
<br><br>


</section>




<script>
    function Imprimir() {
    print();
  }
    function demoFromHTML() {
        var pdf = new jsPDF('p', 'pt', 'letter');
        // source can be HTML-formatted string, or a reference
        // to an actual DOM element from which the text will be scraped.
        source = $('#docasing')[0];

        // we support special element handlers. Register them with jQuery-style 
        // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
        // There is no support for any other type of selectors 
        // (class, of compound) at this time.
        specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector
            '#bypassme': function (element, renderer) {
                // true = "handled elsewhere, bypass text extraction"
                return true
            }
        };
        margins = {
            top: 40,
            bottom: 60,
            left: 40,
            width: 522
        };
        // all coords and widths are in jsPDF instance's declared units
        // 'inches' in this case
        pdf.fromHTML(
            source, // HTML string or DOM elem ref.
            margins.left, // x coord
            margins.top, { // y coord
                'width': margins.width, // max width of content on PDF
                'elementHandlers': specialElementHandlers
            },

            function (dispose) {
                // dispose: object with X, Y of the last line add to the PDF 
                //          this allow the insertion of new lines after html
                pdf.save('Test.pdf');
            }, margins
        );
    }
</script>

<script>
  $(document).ready(function(){
  //  $("#makepdf").trigger("click");
  });
</script>





