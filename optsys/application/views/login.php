<?php include 'html_head.php';?>  
<?php //include 'navigation.php';?>

 <div class="container">
 	<div class="row">
 	<div class="col-md-4 col-md-offset-4">
 	
 	<h2 class="form-signin-heading">Delani Vision Center</h2>
 	<h3 class="form-signin-heading">Login</h3> 	
 	  <form class="form-signin" action="" method="post">
 		
 		<?php if(!empty($msg)){?>
		  	<div class="alert alert-warning alert-dismissible" role="alert">
  			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  			<strong>Error!</strong> <?php echo $msg?>
			</div>		  	
		<?php  }?>
 	
        <label for="username" class="sr-only">Email address</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Log In</button>
      </form>
      </div>
	</div>
    </div> <!-- /container -->
    <?php include('html_footer_include.php')?>