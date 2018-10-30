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
              <a class="btn btn-app bg-olive" href="<?php echo site_url('admin/users/add/groups'); ?>">
                <i class="fa fa-user-plus"></i> Add / Create
              </a>
            </div>
            <div class="col-sm-6">
            <!--
              <a class="btn btn-app pull-right bg-maroon" href="#">
                <i class="fa fa-download"></i> Excel
              </a>
              <a class="btn btn-app pull-right bg-maroon" href="#">
                <i class="fa fa-download"></i> CSV
              </a>
              <a class="btn btn-app pull-right bg-maroon" href="#">
                <i class="fa fa-download"></i> PDF
              </a>
            -->  
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <!-- DataTables start here -->
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Table: Groups</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div id="usersTable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
              <div class="row">
                <div class="col-sm-12">
                  <table id="usersTable" class="table table-bordered table-striped dataTable">
                    <thead>
                      <tr>
                        <th>Group Name</th>
                        <th>Description</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    foreach ($dt_users as $dt)
                    {
                      echo '<tr>' .PHP_EOL;
                        echo '<td>'.$dt['group_name'].'</td>' .PHP_EOL;
                        echo '<td>'.$dt['description'].'</td>' .PHP_EOL;
                      echo '</tr>' .PHP_EOL;
                    }
                     ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Group Name</th>
                        <th>Description</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
      <!--------------------------
        | Your Page Content Here |
        -------------------------->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->