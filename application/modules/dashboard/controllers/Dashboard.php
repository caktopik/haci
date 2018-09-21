<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Hacicore {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
	{
        $data['page_title'] = 'Dashboard';
        $this->_render_view_admin('dashboard', $data);
	}
}
