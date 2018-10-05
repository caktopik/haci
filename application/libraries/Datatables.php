<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Datatables Library Class
* 
* @package          CodeIgniter
* @subpackage       Libraries
* @author		    Taufik Arief Widodo
*/

class Datatables
{
    private $_ci; // get_instances to load database etc
    private $_table;

    public function __construct ()
    {
        $this->_ci =& get_instance();
    }

    public function _render_dataTable($output = 'html', $charset = 'UTF-8')
    {
        $output = strtolower($output);
        if($output == 'json')
        {
            return $this->_render_dT_json();
        }
        elseif($output == 'html')
        {
            return $this->_render_dT_html();
        }
    }

    private function _render_dT_json()
    {}
    
    private function _render_dT_html()
    {
        $this->_get_num_rows();
    }

    public function _get_num_rows()
    {}
    
    public function _query($query = '')
    {
        return $this->_ci->db->query($query);
    }

    public function _get_table($table = '', $limit = NULL, $offset = NULL)
    {
        return $this->_ci->db->get($table, $limit, $offset);
    }
}