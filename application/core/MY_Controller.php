<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $mycore =& get_instance();
    }

    public function _render_view_admin($content, $data)
    {
        $this->load->view('admin/adminlte/admin_header', $data);
        $this->load->view('admin/adminlte/admin_sidebar', $data);
        $this->load->view($content, $data);
        $this->load->view('admin/adminlte/admin_footer', $data);
    }

    public function _render_view_public($content, $data)
    {
        $this->load->view('public/madedesign/public_header', $data);
        $this->load->view('public/madedesign/public_sidebar', $data);
        $this->load->view($content, $data);
        $this->load->view('public/madedesign/public_footer', $data);
    }

    // require_once(APPPATH.'controllers/'.$RTR->directory.$class.'.php');

	// 	if ( ! class_exists($class, FALSE) OR $method[0] === '_' OR method_exists('CI_Controller', $method))
	// 	{
	// 		$e404 = TRUE;
	// 	}
	// 	elseif (method_exists($class, '_remap'))
	// 	{
	// 		$params = array($method, array_slice($URI->rsegments, 2));
	// 		$method = '_remap';
	// 	}
	// 	elseif ( ! method_exists($class, $method))
	// 	{
	// 		$e404 = TRUE;
	// 	}
}

require_once(APPPATH.'core/Admin_Controller.php');
require_once(APPPATH.'core/Public_Controller.php');