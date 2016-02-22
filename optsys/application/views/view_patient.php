<?php include 'html_head.php';?>  
<?php include 'navigation.php';?>
<div class="container">

	<div class="row">	
	<br>
	<div class="panel panel-default">
  	<div class="panel-heading">
  	<h3 class="panel-title pull-left">Patient Details</h3>
  	<a class="btn btn-primary btn-md btn-large pull-right" href="<?php echo site_url('patients/index')?>" role="button">Back</a>
  	<div class="clearfix"></div>
  	</div>
  	<div class="panel-body">	
		  
	<div class="col-sm-12 col-md-6">
	
	<div class="form-group">
	    <label for="full_name" class="col-md-3 control-label">Full Name</label>
	    <div class="col-md-9">
	    <p class="form-control-static" id="">
	    <?php echo $fields['title'].$fields['full_name']?>
	    </p>
	    </div>
	  </div>
	

	<div class="form-group">
		    <label for="nic_no" class="col-md-3 control-label">NIC No</label>
		    <div class="col-md-9">		    
		    <p class="form-control-static" id="">
	    	<?php echo $fields['nic_no'];?>
	    	</p>		    
		    </div>
	 </div>
	
	  <div class="form-group">
	    <label for="email" class="col-md-3 control-label">Email Id</label>
	    <div class="col-md-9">
	    <p class="form-control-static" id=""><?php echo $fields['email']?></p>
	    </div>
	  </div> 

	 <div class="form-group">
	    <label for="address" class="col-md-3 control-label">Address</label>
	    <div class="col-md-9">
	    <p class="form-control-static" id=""><?php echo $fields['address']?></p>
	    </div>
	  </div>
	
	  <div class="form-group">
	    <label for="home_tp_no" class="col-md-3 control-label">Land Line No</label>
	    <div class="col-md-9">
	    <p class="form-control-static" id=""><?php echo $fields['home_tp_no']?></p>
	    </div>
	  </div> 
	
	  
	</div><!-- end of col-sm-12 col-md-6 -->
	
	<div class="col-sm-12 col-md-6">
	
	  

	  <div class="form-group">
	    <label for="mobile_no" class="col-md-3 control-label">Mobile No</label>
	    <div class="col-md-9">
	    <p class="form-control-static" id=""><?php echo $fields['mobile_no']?></p>
	    </div>
	  </div> 
	  

	  <div class="form-group">
	    <label for="profession" class="col-md-3 control-label">Profession</label>
	    <div class="col-md-9">
	    <p class="form-control-static" id=""><?php echo $fields['profession']?></p>
	    </div>

	  </div> 
	   <div class="form-group">
	    <label for="dob" class="col-md-3 control-label">Date of Birth</label>
	    <div class="col-md-9">
	    <p class="form-control-static" id=""><?php echo $fields['dob']?></p>
	    </div>
	  </div> 
	
	 <div class="form-group">
	    <label for="health_issues" class="col-md-3 control-label">Other Information</label>
	    <div class="col-md-9">
	    <p class="form-control-static" id=""><?php echo $fields['health_issues']?></p>
	    </div>
	  </div>

	</div><!-- panel body -->
	</div><!-- panel -->
	    
	</div><!--  end of col -->	
	
	
	</div>	<!-- .row -->
	
	<div class="row">
	<br>
	<div class="panel panel-default">
  	<div class="panel-heading">
  	<h3 class="panel-title">Prescription History</h3> 	
  	</div>
  	<div class="panel-body">
	
	<table class="table table-bordered table-striped">
  	<tr>
  	<th>Pres Id</th>
  	<th>Date Visited</th>
  	<th>Lens/Frame Details</th>
  	<th>Total Due</th>
  	<th>Total Paid</th>
  	</tr>
  	<?php foreach($preses as $pres){?>
  	<tr>
  		<td><?php echo $pres['pre_id']?></td>
  		<td><?php echo $pres['pre_id']?></td>
  		<td><?php echo $pres['pre_id']?></td>
  		<td><?php echo $pres['pre_id']?></td>
  		<td><?php echo $pres['pre_id']?></td>
  	</tr>
  	<?php }?>
  	
	</table>
	<?php var_dump($preses)?>
	</div><!-- panel body -->
	</div><!-- panel -->
	
	
</div><!-- /.container --> 

<script>

function check_val(sel){
	
}
var myCalendar;
myCalendar = new dhtmlXCalendarObject(["dob"]);
myCalendar.setInsensitiveRange("<?php echo date('Y-m-d')?>",null);

</script>


<?php include('html_footer_include.php')?>
