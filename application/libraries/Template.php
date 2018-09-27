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
    // protected $_config;
    protected $_data = array();
    protected $_setting = array();
    protected $_template_data = array();

    // variable on myconfig
    protected $_admin_theme = NULL;
    protected $_public_theme = NULL;
    protected $_assets_folder = NULL;
    protected $_assets_path = array();
    protected $_layout_path = array();
    protected $_template_layout = array();

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

        // call load_setting to get configuration from database, if not set on database, data will put from myconfig
        // still going develop for this

        $this->_template_data['title_admin_name'] = '';
        $this->_template_data['title_public_name'] = ''; // $this->_data['title_public_name']
    }

    public function _set_css($cat, $name, $path)
    {
        // admin-> http://server/assets/$cat/$path/$name.css
        // public-> http://server/assets/$cat/$path/$name.css
        
        if ($cat == 'admin' or $cat == 'public')
        {
            $value = base_url() .'/'.$this->_assets_folder.'/'.$cat.'/'.$path.'/'.$name;
            $this->_template_data['css'][$cat][$name] = $value;
            return $this;    
        }
        // return $this;
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
        // return $this;
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
            // return $this;
        }

        $this->_data['template_data']['admin_header'] = $this->_ci->load->view($this->_layout_path['layout_admin'].'/'.$this->_admin_theme.'/admin_header', $this->_data, TRUE);
        $this->_data['template_data']['admin_sidebar'] = $this->_ci->load->view($this->_layout_path['layout_admin'].'/'.$this->_admin_theme.'/admin_sidebar', $this->_data, TRUE);
        $this->_data['template_data']['admin_content'] = $this->_ci->load->view($view, $this->_data, TRUE);
        $this->_data['template_data']['admin_footer'] = $this->_ci->load->view($this->_layout_path['layout_admin'].'/'.$this->_admin_theme.'/admin_footer', $this->_data, TRUE);
        return $this->_ci->load->view('admin/admin_layout', $this->_data, $return);
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