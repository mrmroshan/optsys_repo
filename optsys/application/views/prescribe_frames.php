<?php include 'html_head.php';?>  
<style>
body{padding:0px;}
.grid{ height:200px;}
</style>
<div class="container">


	<div class="row">	
	<div class="col-sm-12">
	<h1>Frams</h1>
	
		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active"><a href="#stock" aria-controls="stock" role="tab" data-toggle="tab">From Stock</a></li>
		    <li role="presentation"><a href="#order" aria-controls="order" role="tab" data-toggle="tab">Place New Order</a></li>    
		  </ul>
		
		  <!-- Tab panes -->		  
		  <div class="tab-content">
		    <div role="tabpanel" class="tab-pane active" id="stock">
		    	<div style="overflow: auto;">
					<div id="gridbox" class="grid" ></div>
				</div>	    
		    </div><!-- tab1 -->
		    <div role="tabpanel" class="tab-pane" id="order">
		    tab 2
		    </div><!-- tab 2 -->    
		    
		  </div><!--  tab-contents -->	
	</div><!--  end of col -->	
	</div>	<!-- .row -->
<div id="div1"></div>
</div><!-- /.container -->
 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url('/js/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('/js/bootstrap-datepicker.js');?>"></script><!-- http://www.eyecon.ro/bootstrap-datepicker -->
    <script src="<?php echo base_url('/js/bootstrap-select.min.js');?>"></script>   

<script>

$('#myTabs a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
})


mygrid = new dhtmlXGridObject('gridbox');
mygrid.setImagePath("<?php echo base_url('dhtmlx/dhtmlxGrid/codebase/imgs')?>");
mygrid.setSkin("dhx_skyblue");
mygrid.setHeader("Action,Frame Id,Size,Frame Serial No,Material,Type,Supplier,Price,Qty,Added Date");
mygrid.setColSorting("str,int,int,str,str,str,str,int,int");
mygrid.setInitWidths("100,70,100,100,100,100,200,100,80,80,80");
mygrid.setColAlign("center,right,right,right,right,right,right,right,right,right,right");
mygrid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
mygrid.attachHeader("#rspan,#text_filter,#text_filter,#text_filter,#rspan,#rspan,#select_filter,#rspan,#rspan,#rspan");
mygrid.init();
mygrid.load("<?php echo site_url("/frames/produce_grid_feed/1000/0/for-prescribe")?>");


function add_to_cart(frame_id){
	//var str = $('#details', window.parent.document).val();
	//$('#details', window.parent.document).val(str+frame_id
	
	//first get frame data
	url='<?php echo site_url("/prescriptions/get_frame_by_id")?>/'+frame_id;
    $.ajax({
        url: url, 
        success: function(result){
        	//$("#div1").html(result);
        	$('#frame', window.parent.document).val(result);
        	$('#frame_from', window.parent.document).val("stock");
    	},
    	error: function(xhr){
    	        alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
    	}
    });	

    window.parent.close_model(); 
}
</script>
