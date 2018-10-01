<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_admin extends Admin_Controller 
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
        $data['page_title'] = 'Dashboard';
        $data['page_description'] = 'Control Panel';

        $infobox = array (
            'ib_class' => '',
            'ib_icon' => 'fa-comments-o',
            'ib_content' => array(
                'info_box_text' => 'Comments',
                'info_box_number' => '1.000',
            ),
            'ib_background' => array(
                'location' => 'half',
                'color' => 'bg-aqua',
            ),
        );
        // $data[] = $this->data;

        $data['infobox_one'] = _info_box($infobox);
        
        $this->template->_render_admin('dashboard_admin', $data, FALSE);
        
        
    }

    
}
