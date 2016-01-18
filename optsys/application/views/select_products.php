<?php include 'html_head.php';?>  
<style>
body{padding:0px;}
.grid{ height:400px;}
</style>
<div class="container">


	<div class="row">	
	<div class="col-sm-12">
	
	<div style="overflow: auto;">
			<div id="gridbox" class="grid" ></div>
	</div>	  	  	  
	</div><!--  end of col -->	
	</div>	<!-- .row -->

</div><!-- /.container --> 
<script>

mygrid = new dhtmlXGridObject('gridbox');
mygrid.setImagePath("<?php echo base_url('dhtmlx/dhtmlxGrid/codebase/imgs')?>");
mygrid.setSkin("dhx_skyblue");
mygrid.setHeader("Frame Id,Frame Serial No,Material,Type,Supplier,Price,Qty,Added Date,Action");
mygrid.setColSorting("int,str,str,str,str,int,int,str");
mygrid.setInitWidths("70,100,100,100,200,100,80,80,80,250");
mygrid.setColAlign("right,right,right,right,right,right,right,right,right,center");
mygrid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
mygrid.attachHeader("#text_filter,#text_filter,#rspan,#rspan,#select_filter,#rspan,#rspan,#rspan,#rspan");
mygrid.init();

mygrid.load("<?php echo site_url("/frames/produce_grid_feed/1000/0")?>");
</script>

