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
        echo $this->hacilib->_get_title_admin_name();
        $this->hacilib->_set_title_admin_name('auoo');
        echo $this->hacilib->_get_title_admin_name();

        echo '=========================';
        echo $this->_get_tes();
        $this->_set_tes('Bismillah');
        echo $this->_get_tes();
	}
}
