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
    <li class="header">MAIN NAVIGATION<?php echo $template_data['uri_segment'][0].'/'.$template_data['uri_segment'][1]; ?></li>
    <!-- Optionally, you can add icons to the links -->
    <?php 
      foreach($template_data['nav_menu'] as $nav)
      {
        if(empty($nav['nav_child']))
        {
          echo '<li><a href="'.$nav['nav_menu_link'].'"><i class="'.$nav['nav_menu_icon'].'"></i> <span>'.$nav['nav_menu_name'].'</span></a></li>';
        }
        else
        {
          echo '<li class="treeview"><a href="'.$nav['nav_menu_link'].'"><i class="'.$nav['nav_menu_icon'].'"></i> <span>'.$nav['nav_menu_name'].'</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>';
          echo '<ul class="treeview-menu">';
          foreach($nav['nav_child'] as $nc1)
          {
            if(empty($nc1['nav_child']))
            {
              echo '<li><a href="'.$nc1['nav_menu_link'].'"><i class="'.$nc1['nav_menu_icon'].'"></i> <span>'.$nc1['nav_menu_name'].'</span></a></li>';
            }
            else
            {
              echo '<li class="treeview"><a href="'.$nc1['nav_menu_link'].'"><i class="'.$nc1['nav_menu_icon'].'"></i> <span>'.$nc1['nav_menu_name'].'</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>';
              echo '<ul class="treeview-menu">';
              foreach($nc1['nav_child'] as $nc2)
              {
                if(empty($nc2['nav_child']))
                {
                  echo '<li><a href="'.$nc2['nav_menu_link'].'"><i class="'.$nc2['nav_menu_icon'].'"></i> <span>'.$nc2['nav_menu_name'].'</span></a></li>';
                }
                else
                {
                  echo '<li class="treeview"><a href="'.$nc2['nav_menu_link'].'"><i class="'.$nc2['nav_menu_icon'].'"></i> <span>'.$nc2['nav_menu_name'].'</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>';
                  echo '<ul class="treeview-menu">';
                  foreach($nc2['nav_child'] as $nc3)
                  {
                    echo '<li><a href="'.$nc3['nav_menu_link'].'"><i class="'.$nc3['nav_menu_icon'].'"></i> <span>'.$nc3['nav_menu_name'].'</span></a></li>';
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
    <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
    <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
    <li class="treeview">
      <a href="#"><i class="fa fa-link"></i> <span>Router Fetch</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>
      <ul class="treeview-menu">
      <li><a href="#"><?php echo 'MO: '.$template_data['module'];  ?></a></li>
        <li><a href="#"><?php echo 'C: '.$template_data['controller'];  ?></a></li>
        <li><a href="#"><?php echo 'M: '.$template_data['method']; ?></a></li>
      </ul>
    </li>
    <li class="treeview">
      <a href="#"><i class="fa fa-link"></i> <span>Uri Segment</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>
      <ul class="treeview-menu">
      <li><a href="#"><?php echo '1: '.$template_data['uri_1'];  ?></a></li>
        <li><a href="#"><?php echo '2: '.$template_data['uri_2'];  ?></a></li>
        <li><a href="#"><?php echo '3: '.$template_data['uri 3']; ?></a></li>
      </ul>
    </li>
  </ul>
  <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>