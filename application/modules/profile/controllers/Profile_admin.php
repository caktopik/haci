<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_admin extends Admin_Controller 
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
        $data = array();
        $data['page_title'] = 'User Profile';
        $data['page_description'] = '';
        
        $this->template->_render_admin('profile_index', $data);   
    }

    public function edit()
    {

    }

    public function image_upload()
    {
        
    }
}