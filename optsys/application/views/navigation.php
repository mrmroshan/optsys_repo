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
            <li <?php echo ($controller =='')?'class="active"':null;?>><a href="<?php echo base_url()?>">Home</a></li>
            <li> <a href="#about">prescriptions</a> </li>
            <li><a href="#about">Patients</a></li>
            <li <?php echo ($controller =='frames')?' class="active" ':null;?> >
            <a href="<?php echo base_url('index.php/frames/index');?>">Frames</span></a>
            </li>
            <li <?php echo ($controller =='lenses')?'class="active"':null;?>>
            <a href="<?php echo site_url('lenses/index')?>" >Lenses</a>
            </li>
            <li <?php echo ($controller =='suppliers')?'class="active"':null;?>>
            <a href="<?php echo site_url('suppliers/index')?>" >Suppliers</a>
            </li>
            <li <?php echo ($controller =='categories')?'class="active"':null;?>>
            <a href="<?php echo site_url('categories/index')?>" >Categories</a>
            </li>
            <li><a href="#contact">Reports</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>   