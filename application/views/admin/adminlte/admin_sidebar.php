<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

  <!-- Sidebar user panel (optional) -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="<?php echo base_url(); ?>assets/admin/adminlte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>Alexander Pierce</p>
      <!-- Status -->
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>

  <!-- search form (Optional) -->
  <form action="#" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Search...">
      <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
    </div>
  </form>
  <!-- /.search form -->

  <!-- Sidebar Menu -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <!-- Optionally, you can add icons to the links -->
    <?php 
      foreach($template_data['nav_menu'] as $nav)
      {
        if(empty($nav['nav_child']))
        {
          echo '<li class="'.$nav['active_link'].'"><a href="'.(($nav['nav_menu_link'] == '#') ? '#' : site_url('admin/'.$nav['nav_menu_link'])).'"><i class="'.$nav['nav_menu_icon'].'"></i> <span>'.$nav['nav_menu_name'].'</span></a></li>' .PHP_EOL;
        }
        else
        {
          echo '<li class="treeview '.$nav['active_link'].'"><a href="'.(($nav['nav_menu_link'] == '#') ? '#' : site_url('admin/'.$nav['nav_menu_link'])).'"><i class="'.$nav['nav_menu_icon'].'"></i> <span>'.$nav['nav_menu_name'].'</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>' .PHP_EOL;
          echo '<ul class="treeview-menu">'.PHP_EOL;
          foreach($nav['nav_child'] as $nc1)
          {
            if(empty($nc1['nav_child']))
            {
              echo '<li class="'.$nc1['active_link'].'"><a href="'.(($nc1['nav_menu_link'] == '#') ? '#' : site_url('admin/'.$nc1['nav_menu_link'])).'"><i class="'.$nc1['nav_menu_icon'].'"></i> <span>'.$nc1['nav_menu_name'].'</span></a></li>'.PHP_EOL;
            }
            else
            {
              echo '<li class="treeview '.$nc1['active_link'].'"><a href="'.(($nc1['nav_menu_link'] == '#') ? '#' : site_url('admin/'.$nc1['nav_menu_link'])).'"><i class="'.$nc1['nav_menu_icon'].'"></i> <span>'.$nc1['nav_menu_name'].'</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>'.PHP_EOL;
              echo '<ul class="treeview-menu">'.PHP_EOL;
              foreach($nc1['nav_child'] as $nc2)
              {
                if(empty($nc2['nav_child']))
                {
                  echo '<li class="'.$nc2['active_link'].'"><a href="'.(($nc2['nav_menu_link'] == '#') ? '#' : site_url('admin/'.$nc2['nav_menu_link'])).'"><i class="'.$nc2['nav_menu_icon'].'"></i> <span>'.$nc2['nav_menu_name'].'</span></a></li>'.PHP_EOL;
                }
                else
                {
                  echo '<li class="treeview '.$nc2['active_link'].'"><a href="'.(($nc2['nav_menu_link'] == '#') ? '#' : site_url('admin/'.$nc2['nav_menu_link'])).'"><i class="'.$nc2['nav_menu_icon'].'"></i> <span>'.$nc2['nav_menu_name'].'</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>'.PHP_EOL;
                  echo '<ul class="treeview-menu">'.PHP_EOL;
                  foreach($nc2['nav_child'] as $nc3)
                  {
                    echo '<li class="'.$nc3['active_link'].'"><a href="'.(($nc3['nav_menu_link'] == '#') ? '#' : site_url('admin/'.$nc3['nav_menu_link'])).'"><i class="'.$nc3['nav_menu_icon'].'"></i> <span>'.$nc3['nav_menu_name'].'</span></a></li>'.PHP_EOL;
                  }
                  echo '</ul>';
                  echo '</li>';                            
                }
              }   
              echo '</ul>';
              echo '</li>';             
            }       
          } 
          echo '</ul>';
          echo '</li>';
        }
      } 
    ?>
    
  </ul>
  <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>