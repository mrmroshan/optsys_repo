<?php include 'html_head.php';?>  
<style>
<!--
.grid{ height:400px;}
-->
</style>
<div class="container">

<!-- Modal -->
<div class="modal fade" id="del_conf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Record</h4>
      </div>
      <div class="modal-body">
        Are you sure? Do you want to delete this record?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>
        <button type="button" class="btn btn-primary">Yes</button>
      </div>
    </div>
  </div>
</div>



	<div class="row ">	
	<h1>Frame Stock</h1>
	
	<div id="alerts" ></div>
	<div class="col-sm-12 col-md-12 " >
		<div style="overflow: auto;">
			<div id="gridbox" class="grid" ></div>
		</div>
	</div><!-- end of col -->
      
    </div><!-- end of row -->

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
//<div  style="width:400px; height:270px; background-color:white;"></div>


function edit_record(id){
	
	$('#del_conf').modal({
		'backdrop':false
	});

}
function delete_record(id){
	var conf = confirm('Are you sure? Do you want to delete this record?');
	if(conf){
		
        $.ajax({
            url: "<?php echo site_url('frames/delete');?>/"+id,
            type: "get",               
            success: function(data, status){
                if (data.result.faultString != null)
                {
                    
                }
            }
        });//end of ajax
        
		show_alert('warning','record has been deleted');
	}
}

function show_alert(type,text){

	var alert_class = null;
	var alert_text = null;
	
	if(type == 'success'){
		alert_class = 'alert-success';
		alert_text = '<strong>Success!</strong> ' + text; 
	}else if(type == 'error'){
		alert_class = 'alert-danger';
		alert_text = '<strong>Error!</strong> ' + text;
	}else if(type == 'warning'){
		alert_class = 'alert-warning';
		alert_text = '<strong>Warning!</strong> ' + text;
	}
	
	var html = '<div class="alert '+ alert_class +' alert-dismissible" role="alert">'+
  	'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
  	alert_text +
	'</div>';

	$('#alerts').html(html);	
}

</script>

<?php include('html_footer_include.php')?>