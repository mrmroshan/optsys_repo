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

<div class="col-sm-12">
<h1>Add New Prescription</h1>	
<div id="msg_div"></div>

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
	
</div>

<div class="row">

<form action="" method="post" class="form-horizontal" onsubmit="return validate()">
	
	<div class="col-sm-12 col-md-6">
	
	<div class="panel panel-default">
  		<div class="panel-heading">    	
    	<h3 class="panel-title pull-left">Patient Details</h3> 		 
        <a href="<?php echo site_url('/patients/add/pres_form')?>" class="btn btn-primary btn-md btn-large pull-right" >Add New</a>
        <div class="clearfix"></div>
  		</div>
  		<div class="panel-body">	
  		  		

	  		<div class="form-group">
			<label for="details" class="col-md-3 control-label">Patient Name</label>
			<div class="col-md-9">
	  		<select class="selectpicker form-control" name="p_id" id="p_id" data-live-search="true" onchange="get_patient_details(this)">   
	    	<?php 
	    	echo '<option value="" selected="selected">Please select</option>';
	    	for($i=0;$i<count($patlist);$i++){
	    		if( $fields['p_id'] == $patlist[$i]['p_id']){
	    			echo '<option value="'.$patlist[$i]['p_id'].'" selected="selected">'.$patlist[$i]['title'].$patlist[$i]['full_name'].'</option>';
	    		}else{
	    			echo '<option value="'.$patlist[$i]['p_id'].'" >'.$patlist[$i]['title'].$patlist[$i]['full_name'].'</option>';
	    		}	
	    	}
	    	?>    
		  	</select>
		  	</div>
			</div>
			
			<div class="form-group">
    		<label class="col-md-3 control-label">DOB</label>
    		<div class="col-sm-9">
      		<p class="form-control-static" id="dob">
      		<?php 
      		for($i=0;$i<count($patlist);$i++){
      			if( $fields['p_id'] == $patlist[$i]['p_id']){
      				echo $patlist[$i]['dob'];
      			}
      		}
      		?>
      		</p>
    		</div>
  			</div>
			
			<div class="form-group">
    		<label class="col-md-3 control-label">Address</label>
    		<div class="col-sm-9">
      		<p class="form-control-static" id="p_address">      		 
      		<?php
      		for($i=0;$i<count($patlist);$i++){
      			if( $fields['p_id'] == $patlist[$i]['p_id']){
      				echo $patlist[$i]['address'];
      			}
      		}
      		?>
      		
      		</p>
    		</div>
  			</div>
			
			
			  		
  		</div><!-- panel body -->
	</div><!-- panel -->
	
	
	<?php //var_dump($orders)?>
	<div class="panel panel-default">
  		<div class="panel-heading">Lens/Frame details</div>
  		<div class="panel-body">
				
		 <div class="form-group">
		    <label for="left_lens" class="col-md-3 control-label">Lens for Left Eye</label>	    
		    <div class="col-md-9">
		    <input readonly type="text" class="form-control" id="left_lens" name="left_lens" placeholder="" value="<?php echo $left_eye_lens_strings?>">
		    From:<input type="text" readonly class="form-control" id="left_lens_from" name="left_lens_from" value="<?php echo (isset($left_lens_from))?$left_lens_from:null?>">
		    Price:<input type="tex" class="form-control" id="left_lens_price" name="left_lens_price" value="<?php echo (isset($left_lens_price))?$left_lens_price:null?>" onblur="cal_total()">
		    <input type="hidden" id="prev_left_lens_id" name="prev_left_lens_id" value="<?php echo $prev_left_lens_id;?>">
		    <input type="hidden" id="left_lens_sup_id" name="left_lens_sup_id" value="<?php echo (isset($left_lens_sup_id))?$left_lens_sup_id:null;?>">	    
		    <input type="hidden" id="left_lens_order_det" name="left_lens_order_det" value="<?php echo (isset($left_lens_order_det))?$left_lens_order_det:null;?>">
		    <a class="btn btn-primary btn-md btn-large-inline" href="#" role="button" onclick="show_lens('l_lens')">Select for Left Eye</a>	    
		    </div>    
		  </div>
		
		 <div class="form-group">
		    <label for="right_lens" class="col-md-3 control-label">Lens for Right Eye</label>	    
		    <div class="col-md-9">
		    <input readonly type="text" class="form-control " id="right_lens" name="right_lens" placeholder="" value="<?php echo $right_eye_lens_strings?>">
		    From:<input type="text" readonly class="form-control" id="right_lens_from" name="right_lens_from" value="<?php echo (isset($right_lens_from))?$right_lens_from:null?>">	    
		    Price:<input type="text" class="form-control" id="right_lens_price" name="right_lens_price" value="<?php echo (isset($right_lens_price))?$right_lens_price:null?>" onblur="cal_total()">
		    <input type="hidden" id="prev_right_lens_id" name="prev_right_lens_id" value="<?php echo $prev_right_lens_id;?>">
		    <input type="hidden" id="right_lens_sup_id" name="right_lens_sup_id" value="<?php echo (isset($right_lens_sup_id))?$right_lens_sup_id:null;?>">
		    <input type="hidden" id="right_lens_order_det" name="right_lens_order_det" value="<?php echo (isset($right_lens_order_det))?$right_lens_order_det:null;?>">
		    <a class="btn btn-primary btn-md btn-large-inline" href="#" role="button" onclick="show_lens('r_lens')">Select for Right Eye</a>	    
		    </div>    
		  </div>
		  	  
	
		  <div class="form-group">
		    <label for="frame" class="col-md-3 control-label">Frame</label>
		    <div class="col-md-9">	    
		    <input readonly type="text" class="form-control " id="frame" name="frame" placeholder="" value="<?php echo (isset($frame_strings))?$frame_strings:$fields['frame']?>">
		    From:<input type="text" readonly class="form-control " id="frame_from" name="frame_from" value="<?php echo (isset($frame_from))?$frame_from:null?>">
		    Price:<input type="text"  class="form-control " id="frame_price" name="frame_price" value="<?php echo (isset($frame_price))?$frame_price:null?>" onblur="cal_total()">
		    <input type="hidden" id="prev_frame_id" name="prev_frame_id" value="<?php echo $prev_frame_id;?>">
		    <input type="hidden" id="frame_sup_id" name="frame_sup_id" value="<?php echo (isset($frame_sup_id))?$frame_sup_id:null;?>">
		    <input type="hidden" id="frame_order_det" name="frame_order_det" value="<?php echo (isset($frame_order_det))?$frame_order_det:null;?>">	    
		    <a class="btn btn-primary btn-md btn-large-inline" href="#" role="button" onclick="show_frames()">Select Frame</a>	    
		    </div>
		  </div>
	  		
		
		
		</div><!-- panel body -->
	</div><!-- panel -->
	  
	   
  
	
	</div><!-- end of col-sm-12-->  
	
	<div class="col-sm-12 col-md-6">	  
	
	  
	  	<div class="panel panel-default">
  		<div class="panel-heading">Transaction details</div>
  		<div class="panel-body">
  		
  			<div class="form-group">
	    	<label for="visited_date" class="col-md-3 control-label">Date</label>
	    	<div class="col-md-9">
	    	<input type="text" class="form-control " id="visited_date" name="visited_date" placeholder="Click to select date" value="<?php echo (empty($fields['visited_date']))?date("Y-m-d"):$fields['visited_date'];?>" readonly >
	    	</div>
	  		</div> 
  		
  		
			<div class="form-group">
		    <label for="total" class="col-md-3 control-label">Total</label>
		    <div class="col-md-9">
		    <input type="text" class="form-control " id="total" name="total" placeholder="" value="<?php echo (isset($total))?$total:'0.00'?>">
		    </div>
	 		</div>	  
	  
	  
	  
  			<div class="form-group">
		    <label for="amount_paid" class="col-md-3 control-label">Paid Amount</label>
		    <div class="col-md-9">
		    <input type="text" class="form-control " id="amount_paid" name="amount_paid" placeholder="Paid Amount" value="<?php echo $fields['amount_paid']?>">
		    </div>
	 		</div> 
	 	  
	
	 		<div class="form-group">
	    	<label for="paid_by" class="col-md-3 control-label">Paid As</label>
		    <div class="col-md-9">	    
		    <?php 
		    $other = ' class="form-control " id="paid_by" onchange=""';
		    $titles = array('Cash' => 'Cash','Check' => 'Check');
		    echo form_dropdown('paid_by', $titles,$fields['paid_by'],$other);
			?>
			</div>
		  	</div>
	
		  	<div class="form-group">
		    <label for="details" class="col-md-3 control-label">Additional Details</label>
		    <div class="col-md-9">
		    <textarea class="form-control " id="details" name="details" ><?php echo $fields['details']?></textarea>
		    </div>
		  	</div>
		  	
		  	<div class="form-group">
	     	<label for="details" class="col-md-3 control-label"></label>
	    	<div class="col-md-9">
	     	<button type="submit"  name ="btnSave" class="btn btn-primary btn-md btn-large">Update</button>		     
	     	<a class="btn btn-primary btn-md btn-large" href="<?php echo site_url('prescriptions/index')?>" role="button">Cancel</a>
	     	</div>
	    	</div>
		  	
  		
		</div><!-- panel body -->
		</div><!-- panel -->
	  	  	  
	</div><!--  end of col -->
	
	</div>	<!-- .row -->
	</form>
</div><!-- /.container --> 
<script>

function validate(){

	var frame = $('#frame').val();
	var left_lens = $('#left_lens').val();
	var right_lens = $('#right_lens').val();

	if(frame == ''  && left_lens == '' && right_lens == ''){
		$('#msg_div').html(
			  	'<div class="alert alert-warning alert-dismissible" role="alert">'+
	  			'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
	  			'<strong>Warning!</strong>Please select a frame or lens(es) for the prescription'+
				'</div>'		  	
		
				);
		return false;
	}else{	
		return true;
	}
	
	
}

function get_patient_details(sel){
	var p_id =sel.value;
	url='<?php echo site_url("/prescriptions/get_patient_by_id")?>/'+p_id;
    $.ajax({
        url: url, 
        success: function(result){
           
        	var data = result.split('::');
        	var dob = data[5];//dob
        	var address = data[3];//address
        	var nic_no = data[4];//address
        	var contact_no = data[1] +' / '+ data[2]; //contact nos
        	
        	$('#p_address').html(address);        		
        	$('#dob').html(dob);  
        	
    	},
    	error: function(xhr){
    	        alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
    	}
    });	
}
		
function check_val(sel){}

function cal_total(){
	
	var debug = true;
	var frame_price = $('#frame_price').val();
	var left_lens_price = $('#left_lens_price').val();
	var right_lens_price = $('#right_lens_price').val();
	if(debug) console.log(frame_price,left_lens_price,right_lens_price);
	tot = parseFloat(left_lens_price) + parseFloat(right_lens_price) + parseFloat(frame_price);
	if(debug) console.log(tot);
	$('#total').val(tot);
}

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

<?php include('html_footer_include.php')?>