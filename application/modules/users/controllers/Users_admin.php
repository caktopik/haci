<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_admin extends Admin_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template');
        $this->load->helper('adminlte_helper');

        // load ion auth
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
        if(!$this->ion_auth->logged_in())
        {
             redirect('auth', 'refresh');
        }
    }

    public function index()
	{   
        $this->load->library('datatables');
        $data['page_title'] = 'Users';
        $data['page_description'] = 'Users List';
        // $data['datatable_users'] = json_encode($this->datatables->select('username, email, last_login')
        //                                             ->from('users')
        //                                             ->generate());
        $this->template->_set_css('admin','dataTables.bootstrap.min.css','adminlte/bower_components/datatables.net-bs/css')
                    ->_set_js('admin','footer','jquery.dataTables.min.js','adminlte/bower_components/datatables.net/js')
                    ->_set_js('admin','footer','dataTables.bootstrap.min.js','adminlte/bower_components/datatables.net-bs/js')
                    ->_set_js('admin','footer','ajax.dataTables.js','adminlte/script')
                    ->_render_admin('users_admin', $data);

                    // echo print_r($this->template->_get_nav_menu('sidebar_admin_menu'));
    }

    public function json_users()
    {
        $this->load->library('datatables');
        return print_r($this->datatables->select('username, email, last_login')
                            ->from('users')
                            ->generate());
        // echo var_dump($this->datatables->_get_table('users'));
    }
}
