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
        $data['page_title'] = 'Users';
        $data['page_description'] = 'Users List';

        $this->template->_set_js('admin','footer','jquery.dataTables.js','bower_components/datatables.net/js')
                    ->_set_js('admin','footer','jquery.dataTables.min.js','bower_components/datatables.net/js')
                    ->_render_admin('users_admin', $data);
    }

    
}
