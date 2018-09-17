<?php
defined('BASEPATH') OR exit('No direct script access allowed');

define ('HACI_VERSION', '1.0.0');

class Hacicore extends CI_Controller
{
    // $default_homepage = TRUE; // direct to admin
    protected $hccore;
    // public $hclib = $this->load->library('hacilib');
    private $_title_admin_name = 'Haci App';

    public function __construct()
    {
        parent::__construct();
        $hccore =& get_instance();
        $this->load->library('hacilib');
    }

    public function _set_tes($value)
    {
        $this->_title_admin_name = $value;
    }

    public function _get_tes()
    {
        return $this->_title_admin_name;
    }

    public function get_class()
    {
        $c = $hccore->router->class();
        return $c;
    }

    public function get_method()
    {
        $m = $hccore->router->method();
        return $m;
    }

    public function get_directory()
    {
        $d = $hccore->router->directory();
        return $d;
    }

    public function get_approute()
    {
        // $this->load->library('hacilib');
        $controllers = $this->hacilib->list_controller();
        return $controllers;
    }

    public function get_route($i)
    {
        $name_uri = $this->uri->uri_string($this->uri->segment($i));
        return $name_uri;
    }

    public function get_name_controller()
    {
        $approute = $this->get_approute();
        $result = array_column($approute, 'controller');
        return $result;
    }
    
    public function get_slug_controller()
    {
        $approute = $this->get_approute();
        $result = array_column($approute, 'slug');
        return $result;
    }

    public function get_type_controller()
    {
        $approute = $this->get_approute();
        $result = array_column($approute, 'type');
        return $result;
    }

    public function correct_route() // must correcting detail flow uri
    {
        $type_controller = $this->get_type_controller();
        $name_controller = $this->get_name_controller();
        $slug_controller = $this->get_slug_controller();
        $get_route = $this->get_route(1);

        // i think the condition for $get_route must change to array boolean
        if($get_route !='admin' && $get_route !='frontpage' && in_array('admin',$type_controller) && in_array($get_route,$name_controller))
        {
            $i = array_search('admin', $type_controller);
            $j = array_search($get_route, $name_controller);
            redirect($type_controller[$i].'/'.$name_controller[$j]);
            // and view controller
        }
        elseif($get_route !='admin' && $get_route !='frontpage' && in_array('frontpage', $type_controller) && in_array($get_route, $name_controller))
        {
            redirect($type_controller.'/'.$name_controller);
        }

    }
}