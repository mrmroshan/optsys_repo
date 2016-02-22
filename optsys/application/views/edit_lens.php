<?php include 'html_head.php';?>  
<?php include 'navigation.php';?>
<div class="container">
<form action="" method="post" class="form-horizontal">

	<div class="row">	
	<div class="col-sm-12 col-md-6 col-md-offset-3">
	<br>
	<div class="panel panel-default">
  	<div class="panel-heading">Edit Lens Details</div>
  	<div class="panel-body">	
	
		  <?php 
		  $msg = validation_errors();
		  if(!empty($msg)){
		  	?>
		  	<div class="alert alert-warning alert-dismissible" role="alert">
  			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  			<strong>Warning!</strong> <?php echo $msg?>
			</div>		  	
		  	<?php 
		  }
		  $genMsg = $gen_message['text'];
		  $genMsgType = $gen_message['type'];
		  
		  if($genMsgType == 'success'){?>
		  	<div class="alert alert-success alert-dismissible" role="alert">
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  	<strong>Success!</strong> <?php echo $genMsg?>
		  	</div>
		  <?php 						  	
		  }else if($genMsgType == 'error'){?>
		    <div class="alert alert-danger alert-dismissible" role="alert">
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  	<strong>Error!</strong> <?php echo $genMsg?>
		  	</div>	
		  <?php 
		  }		  
		  ?>
	
	
	<div class="form-group">
	    <label for="bill_no" class="col-md-3 control-label">Bill No</label>
	    <div class="col-md-9">
	    <input type="text" class="form-control " id="bill_no" name="bill_no" placeholder="Bill_no" value="<?php echo $fields['bill_no']?>">
	    </div>
	  </div>
	
	
	 <div class="form-group">
	    <label for="sup_id" class="col-md-3 control-label">Lens Supplier</label>
	    <div class="col-md-9">	    
	    <?php 
	    $other = ' class="form-control " id="sup_id" onchange="check_val(this)"';
	    for($i=0;$i<count($suplist);$i++){
	    	$sups[$suplist[$i]['sup_id']] = $suplist[$i]['company_name'];  
	    }
	    //$sups['new'] = 'Add New';
	    echo form_dropdown('sup_id', $sups,$fields['sup_id'],$other);
		?>
		</div>
	  </div>
	
	
	<div class="form-group">
	    <label for="cat_id" class="col-md-3 control-label">Lens Category</label>
	    <div class="col-md-9">	    
	    <?php 
	    $other = ' class="form-control " id="cat_id"';
	    for($i=0;$i<count($catlist);$i++){
	    	$cats[$catlist[$i]['cat_id']] = $catlist[$i]['category'];  
	    }
		
	    echo form_dropdown('cat_id', $cats,$fields['cat_id'],$other);
		?>
		</div>
	  </div>
	

	  <div class="form-group">
		    <label for="lens_power" class="col-md-3 control-label">Lens Power</label>
		    <div class="col-md-9">
		    <input type="text" class="form-control " id="lens_power" name="lens_power" placeholder="Power" value="<?php echo $fields['lens_power']?>">
		    </div>
	 </div> 
	 	  
	
	  <div class="form-group">
	    <label for="lens_color" class="col-md-3 control-label">Lens Color</label>
	    <div class="col-md-9">
	    <input type="text" class="form-control " id="lens_color" name="lens_color" placeholder="Color" value="<?php echo $fields['lens_color']?>">
	    </div>
	  </div> 
	  
	 <div class="form-group">
	    <label for="qty" class="col-md-3 control-label">Qty</label>
	    <div class="col-md-9">
	    <input type="text" class="form-control " id="qty" name="qty" placeholder="Qty" value="<?php echo $fields['qty']?>">
	 </div>

	</div> 
	  <div class="form-group">
	  <label for="re_order_qty" class="col-md-3 control-label">Re Order Qty</label>
	  <div class="col-md-9">
	  <input type="text" class="form-control " id="re_order_qty" name="re_order_qty" placeholder="Re order qty" value="<?php echo $fields['re_order_qty']?>">
	  </div>
	</div> 
	  
	  <div class="form-group">
	    <label for="price" class="col-md-3 control-label">Price</label>
	    <div class="col-md-9">	    
	    <input type="text" class="form-control " id="price" name="price" placeholder="Price" value="<?php echo number_format($fields['price'],2,'.','');?>" >
	  	</div>
	  </div>
	  
	  <div class="form-group">
	    <label for="cost" class="col-md-3 control-label">Cost</label>
	    <div class="col-md-9">	    
	    <input type="text" class="form-control " id="cost" name="cost" placeholder="Cost" value="<?php echo number_format($fields['cost'],2,'.','');?>" >
	  	</div>
	  </div>
	  
	 <div class="form-group">
	    <label for="details" class="col-md-3 control-label">Description</label>
	    <div class="col-md-9">
	    <textarea class="form-control " id="details" name="details" ><?php echo $fields['details']?></textarea>
	    </div>
	  </div>
	  
     <div class="form-group">
	    <label for="details" class="col-md-3 control-label"></label>
	    <div class="col-md-9">
	    <button type="submit"  name ="btnSave" class="btn btn-primary btn-md btn-large">Update</button>	     
	    <a class="btn btn-primary btn-md btn-large" href="<?php echo site_url('lenses/index')?>" role="button">Cancel</a>
	    </div>
	 </div>	
	
	</div><!-- panel body -->
	</div><!-- panel -->
	 
	</div><!--  end of col -->	
	</div>	<!-- .row -->
	</form>
</div><!-- /.container --> 
<script>

function check_val(sel){
	var sel_id = sel.id;
	var sel_val = sel.value;

	if(sel_id == 'sup_id'){
		//alert(sel_val);
	}
	
}

</script>

<?php include('html_footer_include.php')?>