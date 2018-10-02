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
        $this->load->library('ion_auth');

        $this->load->library('form_validation');
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
				redirect('admin/dashboard', 'refresh');
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
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); // must enhanced language options
        
        if ($this->form_validation->run() === FALSE)
		{
			$this->data['type'] = $this->config->item('identity', 'ion_auth');
			// setup the input
			$this->data['email'] = array('name' => 'email',
                'id' => 'email',
                'class' => 'form-control',
                'placeholder' => 'Email',
				'type' => 'email',
				'value' => $this->form_validation->set_value('email'),
			);

    		$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
	
			// set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->load->view('auth' . DIRECTORY_SEPARATOR . 'forgot_password', $this->data);
        }
        else
		{
			$identity_column = $this->config->item('identity', 'ion_auth');
			$identity = $this->ion_auth->where($identity_column, $this->input->post('email'))->users()->row();

			if (empty($identity))
			{
    			$this->ion_auth->set_error('forgot_password_email_not_found');

				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}

			// run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				// if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}
		}
        // $this->load->view('forgot_password', $this->data, FALSE);
    }
}
