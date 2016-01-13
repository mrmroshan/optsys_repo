<?php include 'html_head.php';?>  
<style>
<!--
.grid{ height:400px;}
-->
</style>
<div class="container">
	<div class="row">
	<h1>Frame List</h1>
      <div id="gridbox" class="col-sm-12 col-md-12 grid" >
      </div><!-- end of col -->
    </div><!-- end of row -->

</div><!-- /.container -->
  
<script>
mygrid = new dhtmlXGridObject('gridbox');
mygrid.setImagePath("<?php echo base_url('dhtmlx/dhtmlxGrid/codebase/imgs')?>");
mygrid.setSkin("dhx_skyblue");
mygrid.setHeader("Frame Id,Frame Serial No,Material,Type,Supplier,Price,Qty");
mygrid.setInitWidths("70,100,100,100,200,100,80,80");
mygrid.setColAlign("right,right,right,right,right,right,right,right");
mygrid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro");
mygrid.attachHeader("#text_filter,#text_filter,#rspan,#rspan,#select_filter,#rspan,#rspan");
mygrid.init();

mygrid.load("<?php echo site_url("/frames/produce_grid_feed/1000/0")?>");
//<div  style="width:400px; height:270px; background-color:white;"></div>
</script>

<?php include('html_footer_include.php')?>