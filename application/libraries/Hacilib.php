<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Haci Library Class
* 
* @package         CodeIgniter
* @subpackage      Libraries
* @author			Taufik Arief Widodo
*/

class Hacilib
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

    public function _get_default_site()
    {

    }
    public function _set_default_site()
    {

    }

    public function _get_admin_theme()
    {
        return $this->_admin_theme;
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

    public function _get_title_site_name()
    {
        return $this->_get_setting('title_site_name');
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
        return $this->_set_setting($value, 'title_site_name');
    }

    /**
     * Get Title Admin Name
     * 
	 * @access	public
	 * @return	mixed
	 */
    public function _get_title_admin_name()
    {
        return $this->_get_setting('title_admin_name');
    }

    public function _set_title_admin_name($value)
    {
        return $this->_set_setting($value, 'title_admin_name');
    }

    /**
     * Get Setting Name
     * 
     * @access private
     * @param string
     * @return mixed
     */
    private function _load_setting($setting_name = NULL)
    {
        $this->_ci->load->database();
        if (is_null($setting_name))
        {
            $sql = "SELECT * FROM app_setting";
        }
        else
        {
            $sql = "SELECT * FROM app_setting WHERE setting_name = '". $setting_name ."'";
        }
        
        $query = $this->_ci->db->query($sql);
        $settings = $query->result_array();
        if(!empty($settings))
        {
            foreach ($settings as $setting)
            {
                $this->_setting['setting_id'] = $setting['setting_id']; 
                $this->_setting['setting_name'] = $setting['setting_name'];
                $this->_setting['setting_value'] = $setting['setting_value'];
                $this->_setting['created_at'] = $setting['created_at'];
                $this->_setting['updated_at'] = $setting['updated_at'];
                $this->_setting['error'] = "0";
            }        
        }
        else
        {
            $this->_setting['error'] = "1";
        } 
        return $this->_setting;
    }

    private function _set_setting($value, $setting_name)
    {

    }

    public function _register_setting()
    {

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

}