<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Public_Controller 
{
    private $data = array();
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template');
        $this->load->helper(array('adminlte_helper', 'form'));

        // load ion auth
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library(array('ion_auth', 'form_validation'));
    }

    public function index()
	{   
        if($this->ion_auth->logged_in())
        {
            redirect('dashboard', 'refresh');
        }
        else
        {
            $this->data['page_title'] = 'Login';
            $this->data['page_description'] = 'Login';

            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['email'] = array('name' => 'email',
                'id' => 'email',
                'class' => 'form-control',
                'placeholder' => 'Email',
				'type' => 'email',
				'value' => $this->form_validation->set_value('email'),
			);
			$this->data['password'] = array('name' => 'password',
                'id' => 'password',
                'class' => 'form-control',
				'type' => 'password',
			);
            $this->load->view('login', $this->data, FALSE);        
        }
    }

    public function login()
    {
        // validate form input
		$this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() === TRUE)
		{
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool)$this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('email'), $this->input->post('password'), $remember))
			{
				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('dashboard', 'refresh');
			}
			else
			{
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            
            // redirect('auth/login', 'refresh');
			$this->load->view('login', $this->data, TRUE);   
		}
    }
    
    public function logout()
    {
		// log the user out
		$logout = $this->ion_auth->logout();

		// redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('auth', 'refresh');
    } 
    
    public function forgot_password()
    {

    }
}
