<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Haci Library Class
 * 
 * @package         CodeIgniter
 * @subpackage      Libraries
 * @author			Taufik Arief Widodo
 */

// define ('ASSETS', )

class Hacilib
{
    private $_ci; // for calling $this->load, $this->db, etc 
    private $_config;
    private $_data = array();
    private $_setting = array();
    private $_admin_theme = 'adminlte'; // must load via db
    private $_site_theme = NULL ; // must load via db
    private $_title_admin_name = 'Haci App2'; // must load via db
    private $_title_site_name = 'Haci App2'; // must load via db
    private $_default_site = 'admin'; // admin or site // must load via db

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

    public function _set_admin_theme($value)
    {
        // check folder
        if(is_dir())
        {

        }
        else
        {
            $this->_admin_theme = $value;
        }
    }

    public function _get_admin_theme()
    {
        return $this->_admin_theme;
    }

    /**
     * Set Title Site Name
     * 
	 * @access	public
	 * @param	string
	 * @return	mixed
	 */
    public function _set_title_site_name($value)
    {
        $this->_title_site_name = $value;
        return $this->_title_site_name;
    }

    public function _get_title_site_name()
    {
        return $this->_title_site_name;
    }

    /**
     * Set Title Admin Name
     * 
	 * @access	public
	 * @param	string
	 * @return	mixed
	 */
    public function _set_title_admin_name($value)
    {
        $this->_title_admin_name = $value;
        // return $this->_title_admin_name;
    }

    public function _get_title_admin_name()
    {
        return $this->_title_admin_name;
    }

    public function get_path_asset($cat_asset, $name_asset)
    {
        $this->load->helper('uri');
        $uri_asset = base_url() ."assets/".$cat_asset."/".$name_asset."/";
        if(is_dir($uri_asset))
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }


    public function list_controller()
    {
        $_list_controller = array();
        $this->_ci->load->database();
        $sql = "SELECT * FROM app_route";
        $query = $this->_ci->db->query($sql);
        $_list_controller = $query->result_array();
        return $_list_controller; 
    }
}