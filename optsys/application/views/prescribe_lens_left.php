<?php include 'html_head.php';?>  
<style>
body{padding:0px;}
.grid{ height:300px;}
</style>
<div class="container">


	<div class="row">	
	<div class="col-sm-12">
	<h1>Lens for Left Eye</h1>
	
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
		    	<div class="row">	
					<div class="col-sm-12">
						<p></p>
						<?php //var_dump($sup_list);?>	
						<div class="form-group">
							<label for="details" class="col-md-6 control-label">Supplier Name</label>
							<div class="col-md-6">
					  		<select class="selectpicker form-control" name="sup_id" id="sup_id" data-live-search="true" onchange="">   
					    	<?php 
					    	for($i=0;$i<count($sup_list);$i++){
					    		echo '<option value="'.$sup_list[$i]['sup_id'].'" >'.$sup_list[$i]['company_name'].'</option>';
					    	}
					    	?>    
					  		</select>
					  		</div>
						</div>
						
						<div class="form-group">
						    <label for="p_order_details" class="col-md-6 control-label">Lens Info</label>
						    <div class="col-md-6">
						    <input type="text" class="form-control " id="left_lens_info" name="left_lens_info" value="">
						    </div>
						  </div>
						
						 <div class="form-group">
						    <label for="p_order_details" class="col-md-6 control-label">Order Details</label>
						    <div class="col-md-6">
						    <textarea class="form-control " id="p_order_details" name="p_order_details" ></textarea>
						    </div>
						  </div>
						  
					     <div class="form-group">
						     <label for="details" class="col-md-6 control-label"></label>
						     <div class="col-md-6">
						     <button type="button"  name ="btnPOSave" class="btn btn-primary btn-md btn-large" onclick="place_order()">Place Order</button>	     
						     <button type="button"  name ="btnPOCancel" class="btn btn-primary btn-md btn-large" onclick="cancel()">Cancel</button>
						     </div>
					    </div>	
						  
						  
					</div><!-- end col -->
				</div><!-- end row -->
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
        	$('#left_lens', window.parent.document).val(result);
        	$('#left_lens_from', window.parent.document).val("stock");

        	var tot = $('#total', window.parent.document).val();
        	var data = result.split('::');
        	var price = data[data.length - 1];//last element is price
        	$('#left_lens_price', window.parent.document).val(price);
			parent.cal_total();	
            
        	
    	},
    	error: function(xhr){
    	        alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
    	}
    });	

    window.parent.close_model(); 
}

function place_order(){

	var sup_id = $('#sup_id').val();
	var p_order_det = $('#p_order_details').val();
	var lens_info = $('#left_lens_info').val(); 
	$('#left_lens_from', window.parent.document).val("order");
	$('#left_lens_sup_id', window.parent.document).val(sup_id);
	$('#left_lens', window.parent.document).val(lens_info);	
	$('#left_lens_order_det', window.parent.document).val(p_order_det);
	window.parent.close_model(); 
}

function cancel(){
	window.parent.close_model();
}


</script>

