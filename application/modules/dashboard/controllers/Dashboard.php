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
        // $this->_render_view_admin('dashboard', $data);
        echo 'This message';
        // $this->template->_render_admin('admin/adminlte/admin_header', $data, FALSE)
        //             ->_render_admin('admin/adminlte/admin_sidebar', $data, FALSE)
        //             ->_render_admin('dashboard', $data, FALSE)
        //             ->_render_admin('admin/adminlte/admin_footer', $data, FALSE);
        // $this->template->_render_admin('dashboard', $data, FALSE);
        $this->template->_render_simple($data);
    }

    
}
