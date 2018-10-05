<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo $page_title ?>
        <small><?php echo $page_description ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
      <li class="active">Here</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- DataTables start here -->
      <div class="col-xs-12">
        JS FOOTER
        <br/>
        <?php 
          if(!empty($template_data['js']['admin']['footer']))
          {
            echo print_r($template_data['js']['admin']['footer']); 
          }
        ?>
        <br/>
        CSS
        <br/>
        <?php
          if(!empty($template_data['css']['admin']))
          { 
            echo print_r($template_data['css']['admin']); 
          }
        ?>
      </div>
    </div>
      <!--------------------------
        | Your Page Content Here |
        -------------------------->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->