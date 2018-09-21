<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coba extends Hacicore {

    public function __construct()
    {
        
        parent::__construct();
    }

    public function index()
	{
        $hacilib = $this->load->library('hacilib');
        $list_setting = $this->hacilib->_get_setting();
        
        echo print_r($list_setting);

	}
}
