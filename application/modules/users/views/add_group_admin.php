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
    <?php if(!empty($message))
    {
    ?> 
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-ban"></i> Alert!</h4> 
      <?php echo $message; ?>
    </div>
    <?php } ?>
    <!-- /.alert -->
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Tools</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
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
        <?php echo form_open('admin/users/add'); ?>
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
                <label class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-8">
                  <!-- <input name="first_name" class="form-control" id="input-first-name" placeholder="First Name" type="text"> -->
                  <?php echo form_input($form['first_name']);?>
                </div>
                <div class="col-sm-1">
                  
                </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <div class="col-sm-1">
                  
                </div>
                <label class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-8">
                  <?php echo form_input($form['last_name']);?>
                </div>
                <div class="col-sm-1">
                  
                </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <div class="col-sm-1">
                  
                </div>
                <label class="col-sm-2 control-label">Company</label>
                <div class="col-sm-8">
                  <?php echo form_input($form['company']);?>
                </div>
                <div class="col-sm-1">
                  
                </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <div class="col-sm-1">
                  
                </div>
                <label class="col-sm-2 control-label">Phone</label>
                <div class="col-sm-8">
                  <?php echo form_input($form['phone']);?>
                </div>
                <div class="col-sm-1">
                  
                </div>
              </div>
              <!-- /.form-group -->
              <?php
                if($form['identity_column']!=='email') 
                {
              ?>
              <div class="form-group">
                <div class="col-sm-1">
                  
                </div>
                <label class="col-sm-2 control-label">Identity</label>
                <div class="col-sm-8">
                  <?php echo form_error('identity'); ?>
                  <?php echo form_input($identity); ?>
                </div>
                <div class="col-sm-1">
                  
                </div>
              </div>
              <!-- /.form-group -->
              <?php
                }
              ?>
              <div class="form-group">
                <div class="col-sm-1">
                  
                </div>
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-8">
                  <?php echo form_input($form['email']);?>
                </div>
                <div class="col-sm-1">
                  
                </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <div class="col-sm-1">
                  
                </div>
                <label class="col-sm-2 control-label">Password</label>
                <div class="col-sm-8">
                  <?php echo form_input($form['password']);?>
                </div>
                <div class="col-sm-1">
                  
                </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <div class="col-sm-1">
                  
                </div>
                <label class="col-sm-2 control-label">Password Confirm</label>
                <div class="col-sm-8">
                  <?php echo form_input($form['password_confirm']);?>
                </div>
                <div class="col-sm-1">
                  
                </div>
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.form-horizontal -->
  
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8">
              <button type="submit" class="btn btn-info">Save</button>
            </div>
            
            <div class="col-sm-1">
            </div> 
           </div>
        </div>
        <!-- /.box -->
        <?php echo form_close(); ?>
      </div>
      <!-- /.col-sm-12 -->

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
  echo $template_data['directory'];
  ?>
    <!--------------------------
      | Your Page Content Here |
      -------------------------->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->