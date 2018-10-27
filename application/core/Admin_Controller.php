<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends MY_Controller
{
    private $CI;
    public function __construct()
    {
        parent::__construct();
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
        // $this->initialize();
        $this->load->helper('url');
        // redirect('admin/'.uri_string());
    }
}