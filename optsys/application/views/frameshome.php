<?php include 'html_head.php';?>
<?php include 'navigation.php';?>  
<style>
<!--
.grid{ height:400px;}
.edit_form{ height:50%;;width:80%;}
-->
</style>
<div class="container">

<!-- Modal -->
<div class="modal fade" id="del_conf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        <h2 class="modal-title" id="myModalLabel">Edit Record</h2>
      </div>
      <div class="modal-body ">
      	
      		<div class="embed-responsive embed-responsive-16by9">        		
        		<iframe id="edit_form" class="embed-responsive-item" src=""  frameborder="0" allowtransparency="true"></iframe> 
        	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="refresh_grid()" >Close</button>
        
      </div>
    </div>
  </div>
</div>



	<div class="row ">	
	<dir class="col-sm-12 col-md-8">
	<h1>Frame Stock</h1>
	</dir>
	<dir class="col-sm-12 col-md-4 text-right">	
	<a class="btn btn-primary" href="<?php echo site_url('/frames/add')?>" role="button">Add New</a>
	</dir>
	
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
mygrid.setHeader("Action,Frame Id,Size,Frame Serial No,Material,Type,Supplier,Price,Qty,Added Date");
mygrid.setColSorting("str,int,int,str,str,str,str,int,int");
mygrid.setInitWidths("100,70,100,100,100,100,200,100,80,80,80");
mygrid.setColAlign("center,right,right,right,right,right,right,right,right,right,right");
mygrid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
mygrid.attachHeader("#rspan,#text_filter,#text_filter,#text_filter,#rspan,#rspan,#select_filter,#rspan,#rspan,#rspan");
mygrid.init();

mygrid.load("<?php echo site_url("/frames/produce_grid_feed/1000/0")?>");
//<div  style="width:400px; height:270px; background-color:white;"></div>


function edit_record(id){
	
	$('#edit_form').attr('src','<?php echo site_url("/frames/edit")?>/'+id);
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
                	if(data == 1){               
                	 	show_alert('success','Record deleted sucessfully');
                		mygrid.clearAndLoad("<?php echo site_url("/frames/produce_grid_feed/1000/0")?>");           
                    }else{
                     	show_alert('error','Record could not delet');
                    }
            }
        });//end of ajax
        
		
	}
}

function refresh_grid(){
	mygrid.clearAndLoad("<?php echo site_url("/frames/produce_grid_feed/1000/0")?>");	
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