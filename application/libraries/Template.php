<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Template Library Class
* 
* @package          CodeIgniter
* @subpackage       Libraries
* @author           Taufik Arief Widodo
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
    
    // module, method, controller
    protected $_controller = "";
    protected $_method = "";
    protected $_module = "";

    // get uri segment
    protected $_uri_segment = array();

    public function __construct()
    {
       $this->_ci = &get_instance();
       $_config = $this->_ci->config->load('myconfig');
       $_config = $this->_ci->config->item('myconfig');
       $this->_initialize($_config);

       if (method_exists( $this->_ci->router, 'fetch_module' ))
       {
           $this->_module 	= $this->_ci->router->fetch_module();
       }
       $this->_controller	= $this->_ci->router->fetch_class();
       $this->_method 		= $this->_ci->router->fetch_method();
       
    }

    public function _initialize($_config)
    {
        // $this->_load_setting();
        foreach($_config as $key => $value)
        {
            $this->{'_'.$key} = $value;
        }

        for($i = 0; $i<$this->_uri_total_segments(); $i++)
        {
            $this->_uri_segment[$i] = $this->_ci->uri->segment($i+1);
        }

        // call load_setting to get configuration from database, if not set on database, data will put from myconfig
        // still going develop for this

        $this->_template_data['title_admin_name'] = '';
        $this->_template_data['title_public_name'] = ''; // $this->_data['title_public_name']
    }

    protected function _uri_total_segments()
    {
        return $this->_ci->uri->total_segments();
    }

    public function _active_link()
    {
        $uri = "";
        for($i=1; $i< $this->_uri_total_segments(); $i++)
        {
            $uri .= $this->_ci->uri->segment($i+1);
            if($i == $this->_uri_total_segments()-1)continue;
            $uri .= '/';
        }
        return $uri;
    }

    /**
     * Adding new CSS file in header template
     * 
     * @param string $cat
     * @param string $name
     * @param string $path
     * @return mixed
     */
    public function _set_css($cat, $name, $path)
    {   
        if ($cat == 'admin' or $cat == 'public')
        {
            $value = base_url() .$this->_assets_folder.'/'.$cat.'/'.$path.'/'.$name;
            $this->_template_data['css'][$cat][$name] = $value;
            return $this;    
        }
    }

    public function _get_css()
    {
        return $this->_template_data['css'];
    }

    /**
     * Adding new javascript file in footer or header template
     * 
     * @param string $cat
     * @param string $location
     * @param string $name
     * @param string $path
     * @param bool $external
     * @return mixed
     */
    public function _set_js($cat, $location, $name, $path, $external = FALSE)
    {
        if (!$external)
        {
            $value = base_url() .$this->_assets_folder.'/'.$cat.'/'.$path.'/'.$name;
            if ($cat == 'admin' or $cat == 'public' or $location == 'header' or $location == 'footer')
            {
                $this->_template_data['js'][$cat][$location][$name] = $value;
                return $this;
            }
        }
        else
        {
            $value = $path.'/'.$name;
            if ($cat == 'admin' or $cat == 'public' or $location == 'header' or $location == 'footer')
            {
                $this->_template_data['js'][$cat][$location][$name] = $value;
                return $this;
            }
        }
    }

    public function _get_js()
    {
        return $this->_template_data['js'];
    }

    public function _nav_menu($location_nav, $level = 0)
    {
        $this->_ci->load->database();
        
        $this->_ci->db->distinct();
        $this->_ci->db->select('*');
        $this->_ci->db->order_by('nav_menu_sort', 'ASC');
        $nav_menus = $this->_ci->db->get_where('app_nav_menu', 'nav_menu_parent_id = '.$level.' AND nav_menu_location = "'.$location_nav.'"')->result_array();
        
        foreach($nav_menus as $i => $nav)
        {
            if ($nav_menus[$i]['nav_menu_link'] === $this->_active_link())
            {
                $nav_menus[$i]['active_link'] = 'active';
            }
            else
            {
                $nav_menus[$i]['active_link'] = '';
            }
            $nav_menus[$i]['nav_child'] = $this->_nav_menu($location_nav, $nav['nav_menu_id']); 
        }
        return $nav_menus;
    }

    /**
     * Looking for parent hierarchy array
     * 
     * @param array $array
     * @param string $search
     * @param bool $parent_key
     * @return array 
     */
    protected function _array_finder($array, $search, $parent_key = false)
    {
        foreach ($array as $local_key => $value) {
            $key = ($parent_key === false) ? $local_key : $parent_key;

            if (is_array($value) and ($subsearch = $this->_array_finder($value, $search, $key)) !== false) {
                return $subsearch;
            } elseif ($value == $search) {
                return $key;
            }
        }
        return false;
    }

    /**
     * Build navigation with active link
     * 
     * @param string $location_nav
     * @return array 
     */
    public function _get_nav_menu($location_nav)
    {
        $result_nav_menus = $this->_nav_menu($location_nav);
        $keyparent = $this->_array_finder($result_nav_menus, 'active');
        if($result_nav_menus[$keyparent]['nav_menu_module'] === $this->_module)
        {
            $result_nav_menus[$keyparent]['active_link'] = 'active';
        }
        else
        {
            $keymodule = $this->_array_finder($result_nav_menus, $this->_module);
            $result_nav_menus[$keymodule]['active_link'] = 'active';
        }
        return $result_nav_menus;
    }

    /**
     * Build breadcrumb
     * 
     * @param string $location admin | public
     * @return mixed
     */
    public function _breadcrumb()
    {}
    
    /**
     * Build view admin
     * 
     * @param string $view
     * @param array $data
     * @param bool $return
     * @return mixed
     */
    public function _render_admin($view, $data = array(), $return = FALSE)
    {
        $this->_data = $data;
        foreach($this->_template_data as $_tdkey => $_tdvalue)
        {
            $this->_data['template_data'][$_tdkey] = $_tdvalue;
            // return $this;
        }
        $this->_data['session_data'] = $this->_ci->session->userdata();
        $this->_data['template_data']['active_link'] = $this->_active_link();
        $this->_data['template_data']['nav_menu'] = $this->_get_nav_menu('sidebar_admin_menu');
        $this->_data['template_data']['total_segments'] = $this->_uri_total_segments();
        $this->_data['template_data']['uri_segment'] = $this->_uri_segment;
        $this->_data['template_data']['module'] = $this->_module;
        $this->_data['template_data']['controller'] = $this->_controller;
        $this->_data['template_data']['method'] = $this->_method;
        $this->_data['template_data']['admin_header'] = $this->_ci->load->view($this->_layout_path['layout_admin'].'/'.$this->_admin_theme.'/admin_header', $this->_data, TRUE);
        $this->_data['template_data']['admin_sidebar'] = $this->_ci->load->view($this->_layout_path['layout_admin'].'/'.$this->_admin_theme.'/admin_sidebar', $this->_data, TRUE);
        $this->_data['template_data']['admin_content'] = $this->_ci->load->view($view, $this->_data, TRUE);
        $this->_data['template_data']['admin_footer'] = $this->_ci->load->view($this->_layout_path['layout_admin'].'/'.$this->_admin_theme.'/admin_footer', $this->_data, TRUE);
        return $this->_ci->load->view($this->_layout_path['layout_admin'].'/'.$this->_template_layout['template_admin'], $this->_data, $return);
    }

    public function _render_public($view, $data = array(), $return = FALSE)
    {

    }   
}