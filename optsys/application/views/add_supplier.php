<?php include 'html_head.php';?>  
<?php include 'navigation.php';?>
<div class="container">
<form action="" method="post" class="form-horizontal">

	<div class="row">	
	<div class="col-sm-12 col-md-6 col-md-offset-3">	
	<br>
	<div class="panel panel-default">
  	<div class="panel-heading">Add New Supplier</div>
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
	    <label for="company_name" class="col-md-3 control-label">Company Name</label>
	    <div class="col-md-9">
	    <input type="text" class="form-control " id="company_name" name="company_name" placeholder="Company Name" value="<?php echo $fields['company_name']?>">
	    </div>
	  </div>

	  <div class="form-group">
		<label for="contact_person" class="col-md-3 control-label">Contact Person</label>
		<div class="col-md-9">
		<input type="text" class="form-control " id="contact_person" name="contact_person" placeholder="Contact Person" value="<?php echo $fields['contact_person']?>">
		</div>
	 </div> 
	
	  <div class="form-group">
	    <label for="phone_no" class="col-md-3 control-label">Phone No</label>
	    <div class="col-md-9">
	    <input type="text" class="form-control " id="phone_no" name="phone_no" placeholder="000-0000000" value="<?php echo $fields['phone_no']?>">
	    </div>
	  </div> 
	  
     <div class="form-group">
	    <label for="mobile_no" class="col-md-3 control-label">Mobile No</label>
	    <div class="col-md-9">
	    <input type="text" class="form-control " id="mobile_no" name="mobile_no" placeholder="000-0000000" value="<?php echo $fields['mobile_no']?>">
	    </div>
	  </div> 
	  
	 <div class="form-group">
	    <label for="address" class="col-md-3 control-label">Address</label>
	    <div class="col-md-9">
	    <textarea class="form-control " id="address" name="address" ><?php echo $fields['address']?></textarea>
	    </div>
	  </div>
	  
	  <div class="form-group">
	     <label for="details" class="col-md-3 control-label"></label>
	    <div class="col-md-9">
	     <button type="submit"  name ="btnSave" class="btn btn-primary btn-md btn-large">Save</button>	     
	     <a class="btn btn-primary btn-md btn-large" href="<?php echo site_url('suppliers/index')?>" role="button">Cancel</a>
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