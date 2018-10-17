<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model
{
    public function _create()
    {

    }
    
    public function _read($id)
    {
        return $this->db->get_where('users', array('id' => $id))->row_array();
    }
    
    public function _update($table = 'users', $id, $data = array())
    {
        if($id == "" && empty($data))
        {
            return false;
        }
        else
        {
            $this->db->where('id', $id);
            $this->db->update($table, $data);    
            return true;
        }
    }

    public function _delete()
    {
        
    }

    public function _datatable_index()
    {
        return $this->db->get('users')->result_array();
    }
}