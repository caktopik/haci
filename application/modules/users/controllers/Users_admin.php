<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_admin extends Admin_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->library(array('template', 'form_validation'));
        // $this->load->library('database');
        $this->load->helper('adminlte_helper');

        // load ion auth
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
        if(!$this->ion_auth->logged_in())
        {
             redirect('auth', 'refresh');
        }
    }

    public function index()
	{   
        $this->load->library('datatables');
        $data['page_title'] = 'Users';
        $data['page_description'] = 'Users List';
        $data['message'] = $this->session->flashdata('message');
        $data['dt_users'] = $this->users_model->_datatable_index();
        $this->template->_set_css('admin','dataTables.bootstrap.min.css','adminlte/bower_components/datatables.net-bs/css')
                    ->_set_js('admin','footer','jquery.dataTables.min.js','adminlte/bower_components/datatables.net/js')
                    ->_set_js('admin','footer','dataTables.bootstrap.min.js','adminlte/bower_components/datatables.net-bs/js')
                    // ->_set_js('admin','footer','serverside.dataTables.js','adminlte/script')
                    ->_set_js('admin','footer','htmldom.dataTables.js','adminlte/script')
                    ->_set_js('admin','footer','dataTables.buttons.min.js','https://cdn.datatables.net/buttons/1.5.2/js', TRUE)
                    ->_set_js('admin','footer','buttons.flash.min.js','https://cdn.datatables.net/buttons/1.5.2/js', TRUE)
                    ->_set_js('admin','footer','jszip.min.js','https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3', TRUE)
                    ->_set_js('admin','fopdfmake.min.js','https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36', TRUE)
                    ->_set_js('admin','footer','vfs_fonts.js','https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36', TRUE)
                    ->_set_js('admin','footer','buttons.html5.min.js','https://cdn.datatables.net/buttons/1.5.2/js', TRUE)
                    ->_set_js('admin','footer','buttons.print.min.js','https://cdn.datatables.net/buttons/1.5.2/js', TRUE)
                    ->_render_admin('index_user_admin', $data);
    }

    public function add()
    {
        $data['page_title'] = 'Add User';
        $data['page_description'] = 'Form Add User';
        $data['message'] = $this->session->flashdata('message');
        $this->template->_render_admin('add_user_admin', $data);
    }

    public function view($id)
    {
        $data['page_title'] = 'Edit User';
        $data['page_description'] = 'Form Edit User';
        $data['dt_users'] = $this->users_model->_read($id);
        $this->template->_render_admin('view_user_admin', $data);
    }

    public function edit($id)
    {
        $this->load->helper(array('form'));
        $data['page_title'] = 'Edit User';
        $data['page_description'] = 'Form Edit User';
        $data['dt_users'] = $this->users_model->_read($id);
        $this->template->_render_admin('edit_user_admin', $data);
    }

    public function delete($id)
    {
        if($this->users_model->_delete($id))
        {
            $this->session->set_flashdata('message', 'Delete user success!');
        }
        else
        {
            $this->session->set_flashdata('message', 'Something error!');
        }
        redirect('admin/users', 'refresh');
    }

    public function save()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        if(empty($id))
        {
            $this->form_validation->set_rules('password', 'Password', 'required');
        }
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('company', 'Company', 'required');
        $this->form_validation->set_rules('phone', 'Phone');

        $data = array();
        // $data['id'] = $id;
        $data['username'] = $this->input->post('username');
        $data['email'] = $this->input->post('email');
        if((!empty($id) && !empty($this->input->post('password'))) || empty($id))
        {
            $data['password'] = $this->input->post('password');
        }

        $data['first_name'] = $this->input->post('first_name');
        $data['last_name'] = $this->input->post('last_name');
        $data['phone'] = $this->input->post('phone');
        $data['message'] = $this->session->flashdata('message');
        if ($this->form_validation->run() === TRUE)
        {
            // display if form is OK
            // if id not null
            if(!empty($id))
            {
                // run update data and display with updated data
                $this->users_model->_update($id, $data, $table = 'users');
                redirect('admin/users/edit/'.$id, 'refresh');
            }
            // if id NULL
            else
            {
                if($this->ion_auth->register($data['email'], $data['password'], $data['email']))
                {
                    // $this->users_model->_create($data, $table = 'users');
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    redirect('admin/users', 'refresh');    
                }
                else
                {
                    // unsuccessful register
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    redirect('admin/users/add', 'refresh');
                }
            }
        }
        else
        {
            $this->session->set_flashdata('message', validation_errors());
            redirect('admin/users/add', 'refresh');
            // validation_errors() ? validation_errors() : $this->session->flashdata('message');
            // echo 'must fill and return to with id or without id';
            // error message
        } 
    }

    // public function json_users()
    // {
    //     $this->load->library('datatables');
    //     return print_r($this->datatables->select('username, email, last_login')
    //                         ->from('users')
    //                         ->generate());
    //     // echo var_dump($this->datatables->_get_table('users'));
    // }
}
