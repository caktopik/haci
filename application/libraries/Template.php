<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Template Library Class
* 
* @package          CodeIgniter
* @subpackage       Libraries
* @author	        Taufik Arief Widodo
*/

define ('ASSETSADMIN', '');
define ('ASSETSSITE', '');

class Template
{
    private $_ci; // for calling $this->load, $this->db, etc 
    private $_config;
    private $_data = array();
    private $_setting = array();
    
    public function __construct()
    {
       $this->_ci = &get_instance();
       $_config = $this->_ci->config->load('haciconfig');
       $_config = $this->_ci->config->item('hcconfig');
       $this->initialize($_config);
    }

    public function initialize($_config)
    {
        foreach($_config as $key => $value)
        {
            $this->{'_'.$key} = $value;
        }
    }

    public function _render_admin()
    {}
        
    public function _render_site()
    {}   

}