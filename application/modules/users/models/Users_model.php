<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model
{
    public function _create($data = array(), $table = 'users')
    {
        $this->db->insert($table, $data);
    }
    
    public function _read($id, $table = 'users')
    {
        return $this->db->get_where($table, array('id' => $id))->row_array();
    }
    
    public function _update($id, $data = array(), $table = 'users')
    {
        if(!empty($id) and !empty($data))
        {
            $this->db->where('id', $id);
            $this->db->update($table, $data);    
        }  
    }

    public function _delete($id, $table = 'users')
    {
        $this->db->where('id', $id);
        $this->db->delete($table);
    }

    public function _datatable_index()
    {
        return $this->db->get('users')->result_array();
    }
}