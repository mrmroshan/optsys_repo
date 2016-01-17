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
    <link href="<?php echo base_url('/css/bootstrap-select.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('/css/custom_css.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('/css/datepicker.css');?>" rel="stylesheet"><!-- http://www.eyecon.ro/bootstrap-datepicker -->

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

    <!-- For Calendar -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('dhtmlx/dhtmlxCalendar/codebase/dhtmlxcalendar.css')?>"></link>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('dhtmlx/dhtmlxCalendar/codebase/skins/dhtmlxcalendar_dhx_skyblue.css')?>"></link>
	<script src="<?php echo base_url('dhtmlx/dhtmlxCalendar/codebase/dhtmlxcalendar.js')?>"></script>
    
    
    
    </head>
  <body>