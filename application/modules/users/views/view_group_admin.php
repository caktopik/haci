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
              <a class="btn btn-app" href="<?php echo site_url('admin/users/edit/'.$dt_users['id']); ?>">
                <i class="fa fa-rotate-left"></i> Undo
              </a>
            </div>
            <div class="col-sm-6">
              <a class="btn btn-app pull-right bg-maroon" href="<?php echo site_url('admin/users/update/'.$dt_users['id']); ?>">
                <i class="fa fa-download"></i> Save
              </a>            
              <a class="btn btn-app pull-right bg-maroon" href="<?php echo site_url('admin/users/delete/'.$dt_users['id']); ?>">
                <i class="fa fa-download"></i> Delete
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
              <div class="form-group hidden">
                <div class="col-sm-1">
                  
                </div>
                <label class="col-sm-2 control-label">Id</label>
                <div class="col-sm-8">
                  <input name="id" class="form-control" id="input-id" placeholder="Username" type="text" value="<?php echo $dt_users['id']; ?>">
                </div>
                <div class="col-sm-1">
                  
                </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <div class="col-sm-1">
                  
                </div>
                <label class="col-sm-2 control-label">Username</label>
                <div class="col-sm-8">
                  <input name="username" class="form-control" id="input-username" placeholder="Username" type="text" value="<?php echo $dt_users['username']; ?>">
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
                  <input name="email" class="form-control" id="input-email" placeholder="Email" type="email" value="<?php echo $dt_users['email']; ?>">
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
                  <input name="password" class="form-control" id="input-password" placeholder="Password" type="password">
                </div>
                <div class="col-sm-1">
                  
                </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <div class="col-sm-1">
                  
                </div>
                <label class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-8">
                  <input name="first_name" class="form-control" id="input-first-name" placeholder="First Name" type="text" value="<?php echo $dt_users['first_name']; ?>">
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
                  <input name="last_name" class="form-control" id="input-last-name" placeholder="Last Name" type="text" value="<?php echo $dt_users['last_name']; ?>">
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
                  <input name="company" class="form-control" id="input-company" placeholder="Company Name" type="text" value="<?php echo $dt_users['company']; ?>">
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
                  <input name="phone" class="form-control" id="input-phone" placeholder="Phone" type="text" value="<?php echo $dt_users['phone']; ?>">
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
      <!-- /.col-sm-12 -->

    </div>
    <!-- /.row -->
  
    <!--------------------------
      | Your Page Content Here |
      -------------------------->
    
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->