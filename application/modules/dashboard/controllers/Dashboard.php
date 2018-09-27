<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('template');
        $this->load->helper('adminlte_helper');
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

        $data['infobox_one'] = _info_box($infobox);
        
        $this->template->_render_admin('dashboard', $data, FALSE);
        
        
    }

    
}
