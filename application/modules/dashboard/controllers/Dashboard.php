<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Hacicore {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
	{
        //$this->load->library('hacilib');
		//echo 'hellow wol';
        //echo print_r($this->hacilib->list_controller());
        //echo print_r($this->hacilib->list_controller()['controller']);
        //Hacicore::get_controller();
        //Hacicore::correct_route();
        //echo HACI_VERSION;
        //$this->hacicore->get_controller();
        $this->load->library('hacilib');
        echo $this->hacilib->_get_title_admin_name();

        echo '=========================';
        echo $this->_get_tes();
        $this->_set_tes('Dashboard');
        echo $this->_get_tes();
	}
}
