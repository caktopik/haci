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
              <a class="btn btn-app bg-olive" href="<?php echo site_url('admin/users/add'); ?>">
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
            <h3 class="box-title">Table: Users</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div id="usersTable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
              <div class="row">
                <div class="col-sm-12">
                  <table id="usersTable" class="table table-bordered table-striped dataTable">
                    <thead>
                      <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Company</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Last Login</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    foreach ($dt_users as $dt)
                    {
                      echo '<tr>' .PHP_EOL;
                        echo '<td>'.$dt['first_name'].'</td>' .PHP_EOL;
                        echo '<td>'.$dt['last_name'].'</td>' .PHP_EOL;
                        echo '<td>'.$dt['company'].'</td>' .PHP_EOL;
                        echo '<td>'.$dt['phone'].'</td>' .PHP_EOL;
                        echo '<td>'.$dt['email'].'</td>' .PHP_EOL;
                        echo '<td>'.date("Y-m-d H:i:s",$dt['last_login']).'</td>' .PHP_EOL;
                        echo '<td>'.PHP_EOL.'
                        <a href="'.site_url('admin/users/view/'.$dt['id']).'" data-skin="skin-blue" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>'.PHP_EOL.'
                        <a href="'.site_url('admin/users/edit/'.$dt['id']).'" data-skin="skin-green" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>'.PHP_EOL.'
                        <a href="'.site_url('admin/users/delete/'.$dt['id']).'" data-skin="skin-red" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>'.PHP_EOL.'
                        </td>'.PHP_EOL;
                      echo '</tr>' .PHP_EOL;
                    }
                     ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Company</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Last Login</th>
                        <th>Action</th>    
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
              <!--
              <div class="row">
                <div class="col-sm-5">
                  <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                </div>
                <div class="col-sm-7">
                  <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                    <ul class="pagination">
                      <li class="paginate_button previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a></li>
                      <li class="paginate_button active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a></li>
                      <li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a></li>
                      <li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a></li>
                      <li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0">4</a></li>
                      <li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0">5</a></li>
                      <li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0">6</a></li>
                      <li class="paginate_button next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0">Next</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              -->
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