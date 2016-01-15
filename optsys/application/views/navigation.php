<?php $controller = $this->uri->segment(1);?>
  <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url();?>">Dilani Vision Center</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li <?php echo ($controller =='')?'class="active"':null;?>><a href="#">Home</a></li>
            <li> <a href="#about">prescriptions</a> </li>
            <li><a href="#about">Patients</a></li>
            <li <?php echo ($controller =='frames')?' class="active" ':null;?>>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Frames<span class="caret"></span></a>
            
	          <ul class="dropdown-menu">
	            <li><a href="<?php echo base_url('index.php/frames/index');?>">List All Frames</a></li>
	            <li><a href="<?php echo base_url('index.php/frames/add');?>">Add New Frame</a></li>	            
	          </ul>
            </li>
            <li><a href="#about">Lenses</a></li>
            <li><a href="#contact">Reports</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>   