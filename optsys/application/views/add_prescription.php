<?php include 'html_head.php';?>  
<?php include 'navigation.php';?>
<div class="container">
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
	    <label for="revisit_due_date" class="col-md-6 control-label">Re Visit Date</label>
	    <div class="col-md-6">
	    <input type="text" class="form-control " id="revisit_due_date" name="revisit_due_date" placeholder="Click to select date" value="<?php echo $fields['revisit_due_date']?>" readonly >
	    </div>
	  </div> 
	

     <div class="form-group">
	    <label for="btnSave" class="col-md-6 control-label">Prescribe Lens or Frames</label>
	    <div class="col-md-6">
	    <button type="submit"  name ="btnSave" class="btn btn-primary btn-md btn-large">Save</button>	     
	    <a class="btn btn-primary btn-md btn-large" href="<?php echo site_url('lenses/index')?>" role="button">Cancel</a>
	    </div>
    </div>	
	  
	  
	  
 
	 <div class="form-group">
	    <label for="details" class="col-md-6 control-label">Prescription Details</label>
	    <div class="col-md-6">
	    <textarea class="form-control " id="details" name="details" ><?php echo $fields['details']?></textarea>
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

var myCalendar;
myCalendar = new dhtmlXCalendarObject(["visited_date"]);
myCalendar2 = new dhtmlXCalendarObject(["revisit_due_date"]);
myCalendar.setInsensitiveRange("<?php echo date('Y-m-d')?>",null);
myCalendar2.setSensitiveRange("<?php echo date('Y-m-d')?>",null);

</script>

</script>

<?php include('html_footer_include.php')?>