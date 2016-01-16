<?php include 'html_head.php';?>  
<?php include 'navigation.php';?>
<div class="container">
<form action="" method="post" class="form-horizontal">

	<div class="row">	
	<div class="col-sm-12 col-md-6 col-md-offset-2">
	
	<h1>Edit Category</h1>	
	
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
	    <label for="category" class="col-md-6 control-label">Category Name</label>
	    <div class="col-md-6">
	    <input type="text" class="form-control " id="category" name="category" placeholder="Category" value="<?php echo $fields['category']?>">
	    </div>
	  </div>

	  
	 <div class="form-group">
	    <label for="details" class="col-md-6 control-label">Details</label>
	    <div class="col-md-6">
	    <textarea class="form-control " id="details" name="details" ><?php echo $fields['details']?></textarea>
	    </div>
	  </div>
	  
	  <div class="form-group">
	     <label for="details" class="col-md-6 control-label"></label>
	    <div class="col-md-6">
	     <button type="submit"  name ="btnSave" class="btn btn-primary btn-md btn-large">Update</button>	     
	     <a class="btn btn-primary btn-md btn-large" href="<?php echo site_url('categories/index')?>" role="button">Cancel</a>
	     </div>
	  </div>	
	  	  	  
	</div><!--  end of col -->
	
	</div>	<!-- .row -->
	</form>
</div><!-- /.container --> 
<script>

function check_val(sel){	
}

</script>

<?php include('html_footer_include.php')?>