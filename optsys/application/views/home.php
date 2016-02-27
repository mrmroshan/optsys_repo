<?php include 'html_head.php';?>  
<?php include 'navigation.php';?>
<div class="container">

      <div >
        <h1>Dashboard</h1>        
      </div>
    
    <div class="row">    
    <div class="col-sm-12 col-md-6">
	
		<div class="panel panel-default">
	  	<div class="panel-heading">
	  	<h3 class="panel-title pull-left">Prescriptions</h3>
	  	<a class="btn btn-primary btn-md btn-large pull-right" href="<?php echo site_url('prescriptions/add')?>" role="button">Add New</a>
	  	<div class="clearfix"></div>
	  	</div>
	  	<div class="panel-body">
	  	<h2><?php echo $no_of_presc?></h2>
	  	</div><!-- end of panel body -->
	  	</div><!-- end of panel -->
	  	
		<div class="panel panel-default">
	  	<div class="panel-heading">
	  	<h3 class="panel-title pull-left">Patients</h3>
	  	<a class="btn btn-primary btn-md btn-large pull-right" href="<?php echo site_url('patients/add')?>" role="button">Add New</a>
	  	<div class="clearfix"></div>
	  	</div>
	  	<div class="panel-body">
	  	<h2><?php echo $no_of_patients?></h2>
	  	</div><!-- end of panel body -->
	  	</div><!-- end of panel -->
	  	

	  	<div class="panel panel-default">
	  	<div class="panel-heading">
	  	<h3 class="panel-title pull-left">Frames</h3>
	  	<a class="btn btn-primary btn-md btn-large pull-right" href="<?php echo site_url('frames/add')?>" role="button">Add New</a>
	  	<div class="clearfix"></div>
	  	</div>
	  	<div class="panel-body">
	  	<h2><?php echo $no_of_frames?></h2>
	  	</div><!-- end of panel body -->
	  	</div><!-- end of panel -->
	  	
	  	
	</div><!-- end of col -->
	
	
	<div class="col-sm-12 col-md-6">
	
		<div class="panel panel-default">
	  	<div class="panel-heading">
	  	<h3 class="panel-title pull-left">Lenses</h3>
	  	<a class="btn btn-primary btn-md btn-large pull-right" href="<?php echo site_url('lenses/add')?>" role="button">Add New</a>
	  	<div class="clearfix"></div>
	  	</div>
	  	<div class="panel-body">
	  	<h2><?php echo $no_of_lenses?></h2>
	  	</div><!-- end of panel body -->
	  	</div><!-- end of panel -->
	  	
		<div class="panel panel-default">
	  	<div class="panel-heading">
	  	<h3 class="panel-title pull-left">Lens Categories</h3>
	  	<a class="btn btn-primary btn-md btn-large pull-right" href="<?php echo site_url('categories/add')?>" role="button">Add New</a>
	  	<div class="clearfix"></div>
	  	</div>
	  	<div class="panel-body">
	  	<h2><?php echo $no_of_categories?></h2>
	  	</div><!-- end of panel body -->
	  	</div><!-- end of panel -->
	  	

	  	<div class="panel panel-default">
	  	<div class="panel-heading">
	  	<h3 class="panel-title pull-left">Suppliers</h3>
	  	<a class="btn btn-primary btn-md btn-large pull-right" href="<?php echo site_url('suppliers/add')?>" role="button">Add New</a>
	  	<div class="clearfix"></div>
	  	</div>
	  	<div class="panel-body">
	  	<h2><?php echo $no_of_suppliers?></h2>
	  	</div><!-- end of panel body -->
	  	</div><!-- end of panel -->	
	  	
	</div><!-- end of col -->
	
  	</div><!-- end of row -->      
</div><!-- /.container -->  
<?php include('html_footer_include.php')?>