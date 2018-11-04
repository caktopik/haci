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
              <a class="btn btn-app" href="<?php echo site_url('admin/users/groups'); ?>">
                <i class="fa fa-arrow-left"></i> Back
              </a>
              <a class="btn btn-app" href="<?php echo site_url('admin/users/groups/view/'.$dt_groups['id']); ?>">
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
                  <input name="id" class="form-control" id="input-id" placeholder="Id" type="text" value="<?php echo $dt_groups['id']; ?>">
                </div>
                <div class="col-sm-1">
                  
                </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <div class="col-sm-1">
                  
                </div>
                <label class="col-sm-2 control-label">Group name</label>
                <div class="col-sm-8">
                  <input name="group_name" class="form-control" id="input-group-name" placeholder="Group Name" type="text" value="<?php echo $dt_groups['name']; ?>">
                </div>
                <div class="col-sm-1">
                  
                </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <div class="col-sm-1">
                  
                </div>
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-8">
                  <input name="description" class="form-control" id="input-description" placeholder="Description" type="text" value="<?php echo $dt_groups['description']; ?>">
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