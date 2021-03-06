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
						    <label for="p_order_details" class="col-md-6 control-label">Frame Info</label>
						    <div class="col-md-6">
						    <select class="selectpicker form-control" name="frame_info" id="frame_info" data-live-search="true" onchange="">
						    <!-- <option value="" selected="selected">Please select</option>-->
						    <?php
						    //7::66::Memory Metal::Half-Eye Frames::66::66.66
						    for($i=0;$i<count($frames_list);$i++){						    	
								 echo '<option value="'.
									$frames_list[$i]['frame_id'].'" >'.
									$frames_list[$i]['frame_id'].'::'.
						    		$frames_list[$i]['frame_size'].'::'.
						    		$frames_list[$i]['frame_material'].'::'.
						    		$frames_list[$i]['frame_type'].'::'.
						    		$frames_list[$i]['frame_brand'].'::'.
						    		$frames_list[$i]['price'].
						    	'</option>';
						    }
						    ?>
						    </select>
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
mygrid.setHeader("Action,Frame Id,Size,Frame Serial No,Material,Type,Price,Qty,Supplier,Added Date");
mygrid.setColSorting("str,int,int,str,str,int,int,str,int");
mygrid.setInitWidths("70,70,100,100,100,100,80,50,200,100");
mygrid.setColAlign("center,right,right,right,right,right,right,right,left,right");
mygrid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
mygrid.attachHeader("#rspan,#text_filter,#text_filter,#text_filter,#rspan,#rspan,#rspan,#rspan,#select_filter,#rspan");
mygrid.init();
mygrid.load("<?php echo site_url("/frames/produce_grid_feed/1000/0/for-prescribe")?>");


function add_to_cart(frame_id){
	
	//first get frame data
	url='<?php echo site_url("/prescriptions/get_frame_by_id")?>/'+frame_id;
    $.ajax({
        url: url, 
        success: function(result){
        	//$("#div1").html(result);
        	$('#frame', window.parent.document).val(result);
        	$('#frame_from', window.parent.document).val("stock");        	
        	
        	var data = result.split('::');
        	var price = data[data.length - 1];//last element is price
        	$('#frame_price', window.parent.document).val(price);
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
	//var frame_info = $('#frame_info').val();
	var frame_info = $("#frame_info option:selected").text();
	if(frame_info.length != 0){
		$('#frame_from', window.parent.document).val("order");
		$('#frame_sup_id', window.parent.document).val(sup_id);
		$('#frame', window.parent.document).val(frame_info);		
		$('#frame_order_det', window.parent.document).val(p_order_det);

		var data = frame_info.split('::');
    	var price = parseFloat(data[data.length - 1]);//last element is price
    	$('#frame_price', window.parent.document).val(price);
    	parent.cal_total();
		
		window.parent.close_model();
	}else{
		alert('Please enter frame information to order');
	} 
}

function cancel(){
	window.parent.close_model();
}

</script>

