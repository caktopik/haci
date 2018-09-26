<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Template Library Class
* 
* @package          CodeIgniter
* @subpackage       Libraries
* @author	        Taufik Arief Widodo
*/

class Template
{
    protected $_ci; // for calling $this->load, $this->db, etc 
    protected $_config;
    protected $_data = array();
    protected $_setting = array();
    protected $_template_data = array();
    protected $_assets_path = array();
    protected $_layout_path = array();
    protected $_assets_folder = NULL;

    public function __construct()
    {
       $this->_ci = &get_instance();
       $_config = $this->_ci->config->load('myconfig');
       $_config = $this->_ci->config->item('myconfig');
       $this->_initialize($_config);
    }

    public function _initialize($_config)
    {
        // $this->_load_setting();
        foreach($_config as $key => $value)
        {
            $this->{'_'.$key} = $value;
        }
        $this->_template_data['title_admin_name'] = '';
        $this->_template_data['title_public_name'] = ''; // $this->_data['title_public_name']
    }

    public function _set_css($cat, $name, $path)
    {
        // admin-> http://server/assets/$cat/$path/$name.css
        // public-> http://server/assets/$cat/$path/$name.css
        
        $value = base_url() .'/'.$this->_assets_folder.'/'.$cat.'/'.$path.'/'.$name;
        
        if ($cat == 'admin' or $cat == 'public')
        {
            $this->_template_data['css'][$cat][$name] = $value;
            return $this;    
        }
        return $this;
    }

    public function _get_css()
    {
        return $this->_template_data['css'];
    }

    public function _set_js($cat, $location, $name, $path)
    {
        $value = base_url() .'/'.$this->_assets_folder.'/'.$cat.'/'.$path.'/'.$name;
        if ($cat == 'admin' or $cat == 'public' or $location == 'header' or $location == 'footer')
        {
            $this->_template_data['js'][$cat][$location][$name] = $value;
            return $this;
        }
        return $this;
    }

    public function _get_js()
    {
        return $this->_template_data['js'];
    }

    public function _set_nav()
    {

    }

    public function _get_nav()
    {

    }
    
    public function _render_admin($view, $data = array(), $return = FALSE)
    {
        $this->_data = $data;
        foreach($this->_template_data as $_tdkey => $_tdvalue)
        {
            $this->_data['template_data'][$_tdkey] = $_tdvalue;
            return $this;
        }
        return $this->_ci->load->view($view, $this->_data, $return);
    }

    public function _render_public($view, $data = array(), $return = FALSE)
    {

    }   

    public function _render_simple($data)
    {
        $this->_data = $data;
        return $this->_ci->load->view('dashboard', $this->_data);
    }

}