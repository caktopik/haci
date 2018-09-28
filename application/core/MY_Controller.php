<?php
defined('BASEPATH') OR exit('No direct script access allowed');

define('HACIVERSION','v1.0.0');

class MY_Controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
}

require_once(APPPATH.'core/Admin_Controller.php');
require_once(APPPATH.'core/Public_Controller.php');