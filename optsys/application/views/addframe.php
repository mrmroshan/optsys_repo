<?php include 'html_head.php';?>  

<div class="container">
	<div class="row">
	<div class="col-sm-12 col-md-2"></div>
	<div class="col-sm-12 col-md-8">
	<h1>Add Frame</h1>
	<form>
	  <div class="form-group">
	    <label for="exampleInputEmail1">Email address</label>
	    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPassword1">Password</label>
	    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputFile">File input</label>
	    <input type="file" id="exampleInputFile">
	    <p class="help-block">Example block-level help text here.</p>
	  </div>
	  <div class="checkbox">
	    <label>
	      <input type="checkbox"> Check me out
	    </label>
	  </div>
	  <button type="submit" class="btn btn-default">Submit</button>
	</form>
	</div><!-- .col-sm-12 col-md-6 -->
	<div class="col-sm-12 col-md-2"></div>
	</div>	<!-- .row -->
</div><!-- /.container -->  
<?php include('html_footer_include.php')?>