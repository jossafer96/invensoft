<style>
  .ui-autocomplete {
    max-height: 100px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
</style>
<section class="content">
<?php 
$types = AccountTypeData::getAll();
$products = ProductData::getAll();
?>
<div class="row">
	<div class="col-md-12">
	<h1>Nueva Unidad/Programa</h1>
	<br>
  <div class="box box-primary">
  <table class="table">
  <tr><td>
		<form class="form-horizontal" method="post" id="addcategory" action="index.php?view=addpassword" role="form">
  <div class="form-group">
  <label for="inputEmail1" class="col-lg-2 control-label">Tipo de cuenta*</label>
    <div class="col-md-10">
    <select  name="type_id" id="type_id" class="form-control" style="width: 40%;">
    <option value="">-- NINGUNA --</option>
    <?php foreach($types as $type):?>
      <option value="<?php echo $type->id;?>"><?php echo $type->name;?></option>
    <?php endforeach;?>
      </select>  
      
    </div>
    <br>
    <br>
    <label for="inputEmail1" class="col-lg-2 control-label">Descripcion*</label>
    <div class="col-md-10">
      <input type="text" style="width: 40%;" name="account" required class="form-control" id="account" placeholder="Nombre de la cuenta">
      
    </div>
    <br>
    <br>
    <label for="inputEmail1" class="col-lg-2 control-label">Contraseña*</label>
    <div class="col-md-10">
      
      <input type="password" style="width: 40%;" name="password" required class="form-control" id="password" placeholder="Escribir contraseña">
    </div>
    <br>
    <br>
    <label for="inputEmail1" class="col-lg-2 control-label">Aplicar a*</label>
    <div class="col-md-10 select-search" >
    <div class="ui-widget" style="font-size: 1.8em;">
      <input id="product_name" name="product_name" style="width: 100%;font-size: 0.7em;" />
      <input type="hidden" name="product_id" id="product_id">
    </div> 
      
    </div>
    <br>
    <br>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-success">Agregar Cuenta/Contraseña</button>
    </div>
  </div>
  <strong>* Obligatorio</strong>
</form>
</td>
</tr>
</table>
</div>
	</div>
</div>
</section>
<script>
  $(document).ready(function(){
    <?php
		$products = ProductData::getAllActive();
		?>
function log( message ) {
      $( "#product_id" ).val(message);
     
    }

    var availableProducts = [
  <?php foreach($products as $product):

    echo "{label: '".$product->barcode." - ".$product->name."', id: '".$product->id."'},";

  endforeach; ?>
];
$( "#product_name" ).autocomplete({
  source: availableProducts,
      minLength: 2,
      select: function( event, ui ) {
        log(  ui.item.id );
      }
    });
  });



  </script>
<script>
  var $search = $('[data-select-search]');
    var $select = '#'+$($search).data('selectSearch');
    
    $($search).on('keyup change', function(){
      var search_val = $(this).val().toLowerCase();
      
      if(search_val.length >= 2){
          $($select).children().each(function(){
            if(!$(this).text().toLowerCase().match(search_val)){
              $(this).hide();
            }else{
              $(this).show();
            }
          });
      }else{
        
        $($select).children().each(function(){
          $(this).show();
          $($select).attr('size', $($select).children().length)
        });
        
      }
    });

    $($search).focus(function(){
      $($select).attr('size', $($select).children().length)
      $($select).css('top', $(this).outerHeight());
      $($select).css('z-idnex', '3');
      $(this).css('color', 'inherit');
      
      function reset(){
        $($select).attr('size', 1)
        $($select).css('top', 0);
        $($select).css('z-idnex', '-1');
        $($search).val($('option:selected').text())
        $($search).css('color', 'transparent');
      }
      
      //close the list
      $($select).change(function(){
        reset();
      });
      
      $($search).blur(function(){
        setTimeout(function(){
          if(!$($select).is(":focus")){
            reset();
          }
        }, 50);
      });
      
    });
</script>