<?php $controller = $this->uri->segment(1);?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Dilani Vision</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url('/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('/css/custom_css.css');?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- For DHTMLX grid -->
    <link href="<?php echo base_url('/dhtmlx/dhtmlxGrid/codebase/dhtmlxgrid.css')?>" type="text/css" rel="STYLESHEET"></link>
    <link href="<?php echo base_url('/dhtmlx/dhtmlxGrid/codebase/dhtmlxgrid_skins.css')?>" type="text/css" rel="STYLESHEET"></link>
    <link href="<?php echo base_url('/dhtmlx/dhtmlxGrid/codebase/skins/dhtmlxgrid_dhx_skyblue.css')?>" type="text/css" rel="STYLESHEET"></link>
    <script type="text/javascript" src="<?php echo base_url('/dhtmlx/dhtmlxGrid/codebase/dhtmlxcommon.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/dhtmlx/dhtmlxGrid/codebase/dhtmlxgrid.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/dhtmlx/dhtmlxGrid/codebase/dhtmlxgridcell.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/dhtmlx/dhtmlxGrid/codebase/ext/dhtmlxgrid_srnd.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/dhtmlx/dhtmlxGrid/codebase/ext/dhtmlxgrid_filter.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/dhtmlx/dhtmlxGrid/codebase/ext/dhtmlxgrid_start.js')?>"></script>
        
    </head>
  <body>
      
  <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url();?>">Dilani Vision Center</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li <?php echo ($controller =='')?'class="active"':null;?>><a href="#">Home</a></li>
            <li> <a href="#about">prescriptions</a> </li>
            <li><a href="#about">Patients</a></li>
            <li <?php echo ($controller =='frames')?' class="active" ':null;?>>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Frames<span class="caret"></span></a>
            
	          <ul class="dropdown-menu">
	            <li><a href="<?php echo base_url('index.php/frames/index');?>">List All Frames</a></li>
	            <li><a href="<?php echo base_url('index.php/frames/add');?>">Add New Frame</a></li>	            
	          </ul>
            </li>
            <li><a href="#about">Lenses</a></li>
            <li><a href="#contact">Reports</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    