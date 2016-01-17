<?php include 'html_head.php';?>  
<?php include 'navigation.php';?>
<div class="container">
<form action="" method="post" class="form-horizontal">

	<div class="row">	

	
	<div class="col-sm-12 col-md-6 col-md-offset-2">
	
	<h1>Edit Patient Details</h1>	
	
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
	    <label for="title" class="col-md-6 control-label">Title</label>
	    <div class="col-md-6">	    
	    <?php 
	    $other = ' class="form-control " id="sup_id" onchange="check_val(this)"';
	    $titles = array('Mr.' => 'Mr.','Mrs.' => 'Mrs.','Miss'=>'Miss','Rev'=>'Rev');
	    echo form_dropdown('title', $titles,$fields['title'],$other);
		?>
		</div>
	  </div>
		  
		  
	
	<div class="form-group">
	    <label for="full_name" class="col-md-6 control-label">Full Name</label>
	    <div class="col-md-6">
	    <input type="text" class="form-control " id="full_name" name="full_name" placeholder="Full Name" value="<?php echo $fields['full_name']?>">
	    </div>
	  </div>
	

	<div class="form-group">
		    <label for="nic_no" class="col-md-6 control-label">NIC No</label>
		    <div class="col-md-6">
		    <input type="text" class="form-control " id="nic_no" name="nic_no" placeholder="NIC No" value="<?php echo $fields['nic_no']?>">
		    </div>
	 </div> 
	
	  <div class="form-group">
	    <label for="email" class="col-md-6 control-label">Email Id</label>
	    <div class="col-md-6">
	    <input type="text" class="form-control " id="email" name="email" placeholder="Email" value="<?php echo $fields['email']?>">
	    </div>
	  </div> 

	 <div class="form-group">
	    <label for="address" class="col-md-6 control-label">Address</label>
	    <div class="col-md-6">
	    <textarea class="form-control " id="address" name="address" ><?php echo $fields['address']?></textarea>
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="home_tp_no" class="col-md-6 control-label">Land Line No</label>
	    <div class="col-md-6">
	    <input type="text" class="form-control " id="home_tp_no" name="home_tp_no" placeholder="Land Line No" value="<?php echo $fields['home_tp_no']?>">
	    </div>
	  </div> 
	  

	  <div class="form-group">
	    <label for="mobile_no" class="col-md-6 control-label">Mobile No</label>
	    <div class="col-md-6">
	    <input type="text" class="form-control " id="mobile_no" name="mobile_no" placeholder="Mobile No" value="<?php echo $fields['mobile_no']?>">
	    </div>
	  </div> 
	  

	  <div class="form-group">
	    <label for="profession" class="col-md-6 control-label">Profession</label>
	    <div class="col-md-6">
	    <input type="text" class="form-control " id="profession" name="profession" placeholder="Profession" value="<?php echo $fields['profession']?>">
	    </div>

	  </div> 
	   <div class="form-group">
	    <label for="dob" class="col-md-6 control-label">Date of Birth</label>
	    <div class="col-md-6">
	    <input type="text" class="form-control " id="dob" name="dob" placeholder="Click to select date" value="<?php echo $fields['dob']?>" readonly >
	    </div>
	  </div> 
	
	 <div class="form-group">
	    <label for="health_issues" class="col-md-6 control-label">Other Information</label>
	    <div class="col-md-6">
	    <textarea class="form-control " id="health_issues" name="health_issues" ><?php echo $fields['health_issues']?></textarea>
	    </div>
	  </div>
	  
	    
	  <div class="form-group">
	     <label for="" class="col-md-6 control-label"></label>
	    <div class="col-md-6">
	     <button type="submit"  name ="btnSave" class="btn btn-primary btn-md btn-large">Update</button>	     
	     <a class="btn btn-primary btn-md btn-large" href="<?php echo site_url('patients/index')?>" role="button">Cancel</a>
	     </div>
	    </div>	
	  	  	  
	</div><!--  end of col -->
	
	</div>	<!-- .row -->
	</form>
</div><!-- /.container --> 

<script>

function check_val(sel){
	
}
var myCalendar;
myCalendar = new dhtmlXCalendarObject(["dob"]);
myCalendar.setInsensitiveRange("<?php echo date('Y-m-d')?>",null);

</script>


<?php include('html_footer_include.php')?>
