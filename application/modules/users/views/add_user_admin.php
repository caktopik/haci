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
      <div class="col-sm-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Tools</h3>
          </div>     
          <!-- /.box-header -->
          <div class="box-body">
            <div class="col-sm-6">
              <a class="btn btn-app" href="<?php echo site_url('admin/users'); ?>">
                <i class="fa fa-arrow-left"></i> Back
              </a>
              <a class="btn btn-app" href="<?php echo site_url('admin/users/add'); ?>">
                <i class="fa fa-rotate-left"></i> Undo
              </a>
            </div>
            <div class="col-sm-6">
              <a class="btn btn-app pull-right bg-maroon" href="<?php echo site_url('admin/users/save'); ?>">
                <i class="fa fa-download"></i> Save
              </a>            
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Form</h3>
          </div>     
          <!-- /.box-header -->
          <div class="box-body">
            <div class="form-horizontal">
              <div class="form-group">
                <div class="col-sm-1">
                  
                </div>
                <label class="col-sm-2 control-label">Username</label>
                <div class="col-sm-8">
                  <input class="form-control" id="input" placeholder="Username" type="text" >
                </div>
                <div class="col-sm-1">
                  
                </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <div class="col-sm-1">
                  
                </div>
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-8">
                  <input class="form-control" id="inputEmail3" placeholder="Email" type="email" >
                </div>
                <div class="col-sm-1">
                  
                </div>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.form-horizontal -->
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
  <?php
  echo print_r($template_data['uri_segment']);
  echo '<br/>';
  echo $template_data['module'];
  echo '<br/>';
  echo $template_data['controller'];
  echo '<br/>';
  echo $template_data['method'];
  echo '<br/>';
  echo $template_data['active_link'];
  ?>
    <!--------------------------
      | Your Page Content Here |
      -------------------------->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->