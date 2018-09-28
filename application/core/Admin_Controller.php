<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
        // $this->initialize();
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
    }
}