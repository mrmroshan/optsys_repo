<?php include 'html_head.php';?>  

<div class="container">
	<div class="row">
	<div class="col-sm-12 col-md-2"></div>
	<div class="col-sm-12 col-md-8">
	<h1>Add Frame</h1>
	
	<form action="" method="post" class="form-horizontal">
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
	    <label for="frame_serial_no" class="col-md-3 control-label">Frame Serial No</label>
	    <div class="col-md-4">
	    <input type="text" class="form-control " id="frame_serial_no" name="frame_serial_no" placeholder="Serial No" value="<?php echo $fields['frame_serial_no']?>">
	    </div>
	  </div>	
	
	  <!-- <div class="form-group ">
	    <label for="frame_material">Frame Material</label>	    
	    <?php 
	    $other = ' class="form-control" id="frame_material" ';
	    $options = array('4'  => 'Staff','3'=> 'Manager');
		echo form_dropdown('frame_material', $options,$fields['frame_material'],$other);
		?>
	  </div>-->
	  
	 <!-- <div class="form-group">
	    <label for="frame_type">Frame Type</label>	    
	    <?php 
	    $other = ' class="form-control " id="frame_type"';
	    $options = array('4'  => 'Staff','3'=> 'Manager');
		echo form_dropdown('frame_type', $options,$fields['frame_type'],$other);
		?>
	  </div>-->
	
	 <!-- <div class="form-group">
	    <label for="frame_brand">Frame Brand</label>	    
	    <?php	    
	    $other = ' class="form-control " id="sup_id"';
	    for($i=0;$i<count($suplist);$i++){
	    	$brands[$suplist[$i]['brand_id']] = $suplist[$i]['brand_name'];
	    }
		echo form_dropdown('frame_brand', $brands,$fields['frame_brand'],$other);
		?>
	  </div>-->
	  
	 <div class="form-group">
	    <label for="sup_id" class="col-md-3 control-label">Frame Supplier</label>
	    <div class="col-md-4">	    
	    <?php 
	    $other = ' class="form-control " id="sup_id"';
	    for($i=0;$i<count($suplist);$i++){
	    	$sups[$suplist[$i]['sup_id']] = $suplist[$i]['company_name'];  
	    }
		
	    echo form_dropdown('sup_id', $sups,$fields['sup_id'],$other);
		?>
		</div>
	  </div>
	  
	  <div class="form-group">
	    <label for="frame_type" class="col-md-3 control-label">Frame Type</label>
	    <div class="col-md-4">	    
	    <input type="text" class="form-control " id="frame_type" name="frame_type" placeholder="Frame Type" value="<?php echo $fields['frame_type']?>" >
	  	</div>
	  </div>

	  <div class="form-group">
	    <label for="frame_material" class="col-md-3 control-label">Frame Material</label>
	    <div class="col-md-4">	    
	    <input type="text" class="form-control " id="frame_material" name="frame_material" placeholder="Frame Material" value="<?php echo $fields['frame_material']?>" >
	  	</div>
	  </div>
	  
	  
	  <div class="form-group">
	    <label for="frame_brand" class="col-md-3 control-label">Frame Brand</label>
	    <div class="col-md-4">	    
	    <input type="text" class="form-control " id="frame_brand" name="frame_brand" placeholder="Frame Brand" value="<?php echo $fields['frame_brand']?>" >
	  	</div>
	  </div>
	  
	  <div class="form-group">
	    <label for="frame_color" class="col-md-3 control-label">Color</label>
	    <div class="col-md-4">	    
	    <input type="text" class="form-control " id="frame_color" name="frame_color" placeholder="Color" value="<?php echo $fields['frame_color']?>" >
	  	</div>
	  </div>
	  	  
	  <div class="form-group">
	    <label for="frame_size" class="col-md-3 control-label">Frame Size</label>
	    <div class="col-md-2">
	    <input type="text" class="form-control " id="frame_size" name="frame_size" placeholder="Frame Size" value="<?php echo $fields['frame_size']?>">
	  	</div>
	  </div>
	  
	  <div class="form-group">
	    <label for="price" class="col-md-3 control-label">Price</label>
	    <div class="col-md-2">
	    <input type="text" class="form-control " id="price" name="price" placeholder="Price" value="<?php echo $fields['price']?>">
	  	</div>
	  </div>
	  
	  <div class="form-group">
	    <label for="cost" class="col-md-3 control-label">Cost</label>
	    <div class="col-md-2">
	    <input type="text" class="form-control " id="cost" name="cost" placeholder="Crice" value="<?php echo $fields['cost']?>">
	  	</div>
	  </div>
	  
	  <div class="form-group">
	    <label for="qty" class="col-md-3 control-label">No of qty in hand</label>
	    <div class="col-md-2">
	    <input type="text" class="form-control " id="qty" name="qty" placeholder="No of qty in hand" value="<?php echo $fields['qty']?>">
	  	</div>
	  </div>
	  
	  <div class="form-group">
	    <label for="re_order_qty" class="col-md-3 control-label">Re order qty</label>
	    <div class="col-md-2">
	    <input type="text" class="form-control " id="re_order_qty" name="re_order_qty" placeholder="Re Order Qty" value="<?php echo $fields['re_order_qty']?>">
	    </div>
	  </div>
	  
	  
	  <div class="form-group">
	    <label for="details" class="col-md-3 control-label">Description</label>
	    <div class="col-md-6">
	    <textarea class="form-control " id="details" name="details" ><?php echo $fields['details']?></textarea>
	    </div>
	  </div>
	  
	  <div class="form-group">
	  <button type="submit"  name ="btnSave" class="btn btn-primary btn-md btn-block">Submit</button>
	  </div>
	</form>
	
	</div><!-- .col-sm-12 col-md-6 -->
	<div class="col-sm-12 col-md-2"></div>
	</div>	<!-- .row -->
</div><!-- /.container -->  
<?php include('html_footer_include.php')?>