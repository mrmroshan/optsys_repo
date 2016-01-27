<?php include 'html_head.php';?>  
<?php include 'navigation.php';?>
<div class="container">

<!-- Modal -->
<div class="modal fade" id="products_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        <h2 class="modal-title" id="myModalLabel">Products</h2>
      </div>
      <div class="modal-body ">
      	
      		<div class="embed-responsive embed-responsive-16by9">        		
        		<iframe id="products_iframe" class="embed-responsive-item" src=""  frameborder="0" allowtransparency="true"></iframe> 
        	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="" >Close</button>
        
      </div>
    </div>
  </div>
</div>

<form action="" method="post" class="form-horizontal">

<div class="row">	
<h1>Add New Prescription</h1>	
	
	<div class="col-sm-12 col-md-6">
	
	
	
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
	    <label for="visited_date" class="col-md-6 control-label">Date</label>
	    <div class="col-md-6">
	    <input type="text" class="form-control " id="visited_date" name="visited_date" placeholder="Click to select date" value="<?php echo $fields['visited_date']?>" readonly >
	    </div>
	  </div> 
		  	
	
	<div class="form-group">
		<label for="details" class="col-md-6 control-label">Patient Name</label>
		<div class="col-md-6">
  		<select class="selectpicker" data-live-search="true" onchange="">   
    	<?php 
    	for($i=0;$i<count($patlist);$i++){
    		echo '<option value="'.$patlist[$i]['p_id'].'" >'.$patlist[$i]['title'].$patlist[$i]['full_name'].'</option>';
    	}
    	?>    
  	</select>
  	</div>
	</div>
  
	

	 <div class="form-group">
	    <label for="left_lens" class="col-md-6 control-label">Lens for Left Eye</label>	    
	    <div class="col-md-6">
	    <input type="text" class="form-control " id="left_lens" name="left_lens" placeholder="" value="">
	    <input type="hidden" id="left_lens_from" name="left_lens_from" value="">
	    <a class="btn btn-primary btn-md btn-large-inline" href="#" role="button" onclick="show_lens('l_lens')">Select for Left Eye</a>	    
	    </div>    
	  </div>
	
	 <div class="form-group">
	    <label for="right_lens" class="col-md-6 control-label">Lens for Right Eye</label>	    
	    <div class="col-md-6">
	    <input type="text" class="form-control " id="right_lens" name="right_lens" placeholder="" value="">
	    <input type="hidden" id="right_lens_from" name="right_lens_from" value="">
	    <a class="btn btn-primary btn-md btn-large-inline" href="#" role="button" onclick="show_lens('r_lens')">Select for Right Eye</a>	    
	    </div>    
	  </div>
	  	  

	  <div class="form-group">
	    <label for="frame" class="col-md-6 control-label">Frame</label>
	    <div class="col-md-6">	    
	    <input type="text" class="form-control " id="frame" name="frame" placeholder="" value="">
	    <input type="hidden" id="frame_from" name="frame_from" value="">	    
	    <a class="btn btn-primary btn-md btn-large-inline" href="#" role="button" onclick="show_frames()">Select Frame</a>	    
	    </div>
	  </div>
	  
	  
	  <!-- 
	 <div class="form-group">
	    <label for="paid_by" class="col-md-6 control-label">Prescribe Lens</label>
	    <div class="col-md-6">	    
	    <?php 
	    $other = ' class="form-control " id="paid_by" onchange="show_products(this)"';
	    $products = array('Only Frame' => 'Only Frame','Only Lenses' => 'Only Lenses', 'Both Lens and Frame' => 'Both Lenses and Frame');
	    //echo form_dropdown('products', $products,$fields['products'],$other);
		?>
		 <a class="btn btn-primary btn-md btn-large" href="#" role="button" onclick="show_products('lens')">Left</a>
		 <a class="btn btn-primary btn-md btn-large" href="#" role="button" onclick="show_products('lens')">Right</a>     
	     
		</div>
	  </div>
	  -->	  
	  
	  <div class="form-group">
	    <label for="details" class="col-md-6 control-label">Prescription Details</label>
	    <div class="col-md-6">
	    <textarea class="form-control " id="details" name="details" ><?php echo $fields['details']?></textarea>
	    </div>
	  </div>
	
	  
	<div class="form-group">
		    <label for="total" class="col-md-6 control-label">Total</label>
		    <div class="col-md-6">
		    <input type="text" class="form-control " id="total" name="total" placeholder="" value="">
		    </div>
	 </div>	  
	  
	  
	  
  <div class="form-group">
		    <label for="amount_paid" class="col-md-6 control-label">Paid Amount</label>
		    <div class="col-md-6">
		    <input type="text" class="form-control " id="amount_paid" name="amount_paid" placeholder="Paid Amount" value="<?php echo $fields['amount_paid']?>">
		    </div>
	 </div> 
	 	  
	
	 <div class="form-group">
	    <label for="paid_by" class="col-md-6 control-label">Paid As</label>
	    <div class="col-md-6">	    
	    <?php 
	    $other = ' class="form-control " id="paid_by" onchange=""';
	    $titles = array('Cash' => 'Cash','Check' => 'Check');
	    echo form_dropdown('paid_by', $titles,$fields['paid_by'],$other);
		?>
		</div>
	  </div>

	  
  
	
	<!-- </div>end of col-sm-12  
	
	<div class="col-sm-12 col-md-6">-->	  
	
	  
	  
	  
	     <div class="form-group">
	     <label for="details" class="col-md-6 control-label"></label>
	    <div class="col-md-6">
	     <button type="submit"  name ="btnSave" class="btn btn-primary btn-md btn-large">Save</button>	     
	     <a class="btn btn-primary btn-md btn-large" href="<?php echo site_url('lenses/index')?>" role="button">Cancel</a>
	     </div>
	    </div>	
	  	  	  
	</div><!--  end of col -->
	
	</div>	<!-- .row -->
	</form>
</div><!-- /.container --> 
<script>

function check_val(sel){}

function show_frames(){

	url='<?php echo site_url("/prescriptions/select_products/frame")?>';
	$('#products_iframe').attr('src',url);
	$('#products_model').modal({
		'backdrop':false		
	});
}

function show_lens(which_side){
	
	url='<?php echo site_url("/prescriptions/select_products/")?>/'+ which_side;
	$('#products_iframe').attr('src',url);
	$('#products_model').modal({
		'backdrop':false		
	});

}


function close_model(){
	$('#products_model').modal('toggle');
}

function show_products(value){
	
	//'Only Frame' => 'Only Frame','Only Lenses' => 'Only Lenses', 'Both Lens and Frame' => 'Both Lenses and Frame'
	if (value == 'lens'){
		url='<?php echo site_url("/prescriptions/select_products/lens")?>';
	} else if(value=='frame'){
		url='<?php echo site_url("/prescriptions/select_products/frame")?>';
	}
	$('#products_iframe').attr('src',url);
	$('#products_model').modal({
		'backdrop':false		
	});
	
}

var myCalendar;
myCalendar = new dhtmlXCalendarObject(["visited_date"]);
myCalendar2 = new dhtmlXCalendarObject(["revisit_due_date"]);
myCalendar.setInsensitiveRange("<?php echo date('Y-m-d')?>",null);
myCalendar2.setSensitiveRange("<?php echo date('Y-m-d')?>",null);

</script>

</script>

<?php include('html_footer_include.php')?>