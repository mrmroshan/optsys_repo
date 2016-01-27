<?php include 'html_head.php';?>  
<style>
body{padding:0px;}
.grid{ height:300px;}
</style>
<div class="container">


	<div class="row">	
	<div class="col-sm-12">
	<h1>Lens for Right Eye</h1>
	
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
mygrid.setHeader    ("Action ,Lens Id,Categor,Color,Power,Price,Qty  ,Supplier,Details,Bill No,Added Date");
mygrid.setColSorting("int    ,str    ,str    ,str  ,price,int  ,str  ,str     ,str    ,str    ,center");
mygrid.setInitWidths("80     ,50     ,200    ,100  ,80   ,80  ,40   ,100     ,200    ,80     ,80");
mygrid.setColAlign("center   ,right  ,left   ,left ,right,right,right,right   ,left  ,left   ,left");
mygrid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
mygrid.attachHeader("#rspan,#text_filter,#text_filter,#rspan,#rspan,#rspan,#rspan,#select_filter,#rspan,#text_filter,#rspan");
mygrid.init();
mygrid.load("<?php echo site_url("/lenses/produce_grid_feed/1000/0/for-prescribe")?>");


function add_to_cart(lens_id){
	
	//first get lens data
	url='<?php echo site_url("/prescriptions/get_lens_by_id")?>/'+lens_id;
    $.ajax({
        url: url, 
        success: function(result){
        	//$("#div1").html(result);
        	$('#right_lens', window.parent.document).val(result);
        	$('#right_lens_from', window.parent.document).val("stock");
    	},
    	error: function(xhr){
    	        alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
    	}
    });	

    window.parent.close_model(); 
}
</script>

