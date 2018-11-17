<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Public_Controller 
{
    // private $data = array();
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
            redirect('admin/dashboard', 'refresh');
        }
        else
        {
            $data['page_title'] = 'Login';
            $data['page_description'] = 'Login';

            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$data['email'] = array('name' => 'email',
                'id' => 'email',
                'class' => 'form-control',
                'placeholder' => 'Email',
				'type' => 'email',
				'value' => $this->form_validation->set_value('email'),
			);
			$data['password'] = array('name' => 'password',
                'id' => 'password',
                'class' => 'form-control',
				'type' => 'password',
				'placeholder' => 'Password',
			);
            $this->load->view('login', $data, FALSE);        
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
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$remember = (bool)$this->input->post('remember');

			if ($this->ion_auth->login($email, $password, $remember))
			{
				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->build_user_session();
				redirect('admin/dashboard', 'refresh');
			}
			else
			{
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			// the user is not logging in so display the login page
            // set the flash data error message if there is one
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $data['email'] = array('name' => 'email',
                'id' => 'email',
                'class' => 'form-control',
                'placeholder' => 'Email',
				'type' => 'email',
				'value' => $this->form_validation->set_value('email'),
			);
			$data['password'] = array('name' => 'password',
                'id' => 'password',
                'class' => 'form-control',
				'type' => 'password',
				'placeholder' => 'Passowrd',
			);
			$this->load->view('login', $data, FALSE);   
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
			$data['type'] = $this->config->item('identity', 'ion_auth');
			// setup the input
			$data['email'] = array('name' => 'email',
                'id' => 'email',
                'class' => 'form-control',
                'placeholder' => 'Email',
				'type' => 'email',
				'value' => $this->form_validation->set_value('email'),
			);

    		$data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
	
			// set any errors and display the form
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->load->view('auth' . DIRECTORY_SEPARATOR . 'forgot_password', $data);
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
	
	/**
	 * Reset password - final step for forgotten password
	 *
	 * @param string|null $code The reset code
	 */
	public function reset_password($code = NULL) // on progress
	{
		if (!$code)
		{
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			// if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() === FALSE)
			{
				// display the form

				// set the flash data error message if there is one
				$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$data['new_password'] = array(
					'name' => 'new',
					'id' => 'new',
					'class' => 'form-control',
					'type' => 'password',
					'pattern' => '^.{' . $data['min_password_length'] . '}.*$',
				);
				$data['new_password_confirm'] = array(
					'name' => 'new_confirm',
					'id' => 'new_confirm',
					'class' => 'form-control',
					'type' => 'password',
					'pattern' => '^.{' . $data['min_password_length'] . '}.*$',
				);
				$data['user_id'] = array(
					'name' => 'user_id',
					'id' => 'user_id',
					'class' => 'form-control',
					'type' => 'hidden',
					'value' => $user->id,
				);
				$data['csrf'] = $this->_get_csrf_nonce();
				$data['code'] = $code;

				// render
				$this->load->view('auth' . DIRECTORY_SEPARATOR . 'reset_password', $data);
			}
			else
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
				{

					// something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);

					show_error($this->lang->line('error_csrf'));

				}
				else
				{
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change)
					{
						// if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect("auth/login", 'refresh');
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('auth/reset_password/' . $code, 'refresh');
					}
				}
			}
		}
		else
		{
			// if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("authx/forgot_password", 'refresh');
		}
	}

	/**
	 * Activate the user
	 *
	 * @param int         $id   The user ID
	 * @param string|bool $code The activation code
	 */
	public function activate($id, $code = FALSE) // on progress
	{
		if ($code !== FALSE)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			// redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth", 'refresh');
		}
		else
		{
			// redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("authx/forgot_password", 'refresh');
		}
	}

	private function build_user_session()
	{
		$this->session->set_userdata($this->ion_auth->user()->row_array());
	}

	/**
	 * @return array A CSRF key-value pair
	 */
	public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
    }
    
    /**
	 * @return bool Whether the posted CSRF token matches
	 */
	public function _valid_csrf_nonce(){
		$csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
		if ($csrfkey && $csrfkey === $this->session->flashdata('csrfvalue')){
			return TRUE;
		}
			return FALSE;
	}
}
