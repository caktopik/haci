<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_admin extends Admin_Controller 
{
    // this class using for administrator not user/public on admin
    // can access by admin
    public function __construct()
    {
        parent::__construct();
	
        $this->load->model(array('users_model', 'groups_model'));
        $this->load->library(array('template', 'form_validation'));
        // $this->load->library('database');
        $this->load->helper(array('adminlte_helper','language','url', 'form'));

        // load ion auth
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
        $this->lang->load('auth');
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        // users can access by admin
        if(!$this->ion_auth->logged_in() or !$this->ion_auth->is_admin())
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

    public function add($view = "")
    {
        if ($view == "groups")
        {
            $this->form_validation->set_rules('group_name', 'Group Name', 'trim|required|alpha_dash');

            if ($this->form_validation->run() === TRUE)
            {
                $new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
                if ($new_group_id)
                {
                    // check to see if we are creating the group
                    // redirect them back to the admin page
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    redirect('admin'. DIRECTORY_SEPARATOR .'users'. DIRECTORY_SEPARATOR .'groups', 'refresh');
                }
            }
            else
            {
                // display the create group form
                // set the flash data error message if there is one
                $data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

                $data['form']['group_name'] = array(
                    'name'  => 'group_name',
                    'id'    => 'group_name',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('group_name'),
                );
                $data['form']['description'] = array(
                    'name'  => 'description',
                    'id'    => 'description',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('description'),
                );

                $data['page_title'] = 'Add Group';
                $data['page_description'] = 'Form Add Group';
                
                $this->template->_render_admin('add_group_admin', $data);
            }    
        }
        else
        { 
            $tables = $this->config->item('tables', 'ion_auth');
            $identity_column = $this->config->item('identity', 'ion_auth');
            $data['form']['identity_column'] = $identity_column;

            // validate form input
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
            if ($identity_column !== 'email')
            {
                $this->form_validation->set_rules('identity', 'Identity', 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            }
            else
            {
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
            }
            $this->form_validation->set_rules('phone', 'Phone', 'trim');
            $this->form_validation->set_rules('company', 'Company', 'trim');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
            $this->form_validation->set_rules('password_confirm', 'Password Confirm', 'required');

            if ($this->form_validation->run() === TRUE)
            {
                $email = strtolower($this->input->post('email'));
                $identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
                $password = $this->input->post('password');

                $additional_data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'company' => $this->input->post('company'),
                    'phone' => $this->input->post('phone'),
                );
            }
            if ($this->form_validation->run() === TRUE && $this->ion_auth->register($identity, $password, $email, $additional_data))
            {
                // check to see if we are creating the user
                // redirect them back to the admin page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('admin'. DIRECTORY_SEPARATOR .'users', 'refresh');
            }
            else
            {
                // display the create user form
                // set the flash data error message if there is one
                $data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

                $data['form']['first_name'] = array(
                    'name' => 'first_name',
                    'id' => 'input-first-name',
                    'class' => 'form-control',
                    'type' => 'text',
                    'placeholder' => 'First Name',
                    'value' => $this->form_validation->set_value('first_name'),
                );
                $data['form']['last_name'] = array(
                    'name' => 'last_name',
                    'id' => 'input-last-name',
                    'class' => 'form-control',
                    'type' => 'text',
                    'placeholder' => 'Last Name',
                    'value' => $this->form_validation->set_value('last_name'),
                );
                $data['form']['identity'] = array(
                    'name' => 'identity',
                    'id' => 'input-identity',
                    'class' => 'form-control',
                    'type' => 'text',
                    'placeholder' => 'Identity',
                    'value' => $this->form_validation->set_value('identity'),
                );
                $data['form']['email'] = array(
                    'name' => 'email',
                    'id' => 'input-email',
                    'class' => 'form-control',
                    'type' => 'text',
                    'placeholder' => 'Email',
                    'value' => $this->form_validation->set_value('email'),
                );
                $data['form']['company'] = array(
                    'name' => 'company',
                    'id' => 'input-company',
                    'class' => 'form-control',
                    'type' => 'text',
                    'placeholder' => 'Company',
                    'value' => $this->form_validation->set_value('company'),
                );
                $data['form']['phone'] = array(
                    'name' => 'phone',
                    'id' => 'input-phone',
                    'class' => 'form-control',
                    'type' => 'text',
                    'placeholder' => 'Phone',
                    'value' => $this->form_validation->set_value('phone'),
                );
                $data['form']['password'] = array(
                    'name' => 'password',
                    'id' => 'input-password',
                    'class' => 'form-control',
                    'type' => 'password',
                    'placeholder' => 'Password',
                    'value' => $this->form_validation->set_value('password'),
                );
                $data['form']['password_confirm'] = array(
                    'name' => 'password_confirm',
                    'id' => 'input-password-confirm',
                    'class' => 'form-control',
                    'type' => 'password',
                    'placeholder' => 'Password Confirm',
                    'value' => $this->form_validation->set_value('password_confirm'),
                );

                $data['page_title'] = 'Add User';
                $data['page_description'] = 'Form Add User';
                
                $this->template->_render_admin('add_user_admin', $data);
            }
        }    
    }

    public function view($view = "", $id)
    {
        if($view == "groups")
        {
            $data['page_title'] = 'Edit Group';
            $data['page_description'] = 'Form Edit Group';
            // $data['dt_users'] = $this->users_model->_read_group($id);
            $data['dt_users'] = $this->users_model->_read($id);
            $this->template->_render_admin('view_group_admin', $data);
        }
        else
        {
            $data['page_title'] = 'Edit User';
            $data['page_description'] = 'Form Edit User';
            $data['dt_users'] = $this->users_model->_read($id);
            $this->template->_render_admin('view_user_admin', $data);
        }
    }

    public function edit($id)
    {
		if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)))
		{
			redirect('auth', 'refresh');
		}

		$user = $this->ion_auth->user($id)->row();
		$groups = $this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		// validate form input
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
		$this->form_validation->set_rules('company', 'Company', 'trim|required');

        $identity_column = $this->config->item('identity', 'ion_auth');
        $data['form']['identity_column'] = $identity_column;
        
		if (isset($_POST) && !empty($_POST))
		{
			// do we have a valid request?
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error('This form post did not pass our security checks.'); // $this->lang->line('error_csrf')
			}

			// update the password if it was posted
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', 'Password Confirm', 'required');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$dataform = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'company' => $this->input->post('company'),
					'phone' => $this->input->post('phone'),
				);

				// update the password if it was posted
				if ($this->input->post('password'))
				{
					$dataform['password'] = $this->input->post('password');
				}

				// Only allow updating groups if user is admin

                // Update the groups user belongs to
                $groupData = $this->input->post('groups');

                if (isset($groupData) && !empty($groupData))
                {
                    $this->ion_auth->remove_from_group('', $id);
                    foreach ($groupData as $grp)
                    {
                        $this->ion_auth->add_to_group($grp, $id);
                    }
                }

				// check to see if we are updating the user
				if ($this->ion_auth->update($user->id, $dataform))
				{
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('message', $this->ion_auth->messages());
                    redirect ('admin/users/edit/'.$id,'refresh');
                    // $this->redirectUser();
				}
				else
				{
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('message', $this->ion_auth->errors());
                    redirect ('admin/users/edit/'.$id,'refresh');
                    // $this->redirectUser();
				}

			}
		}
        
		// display the edit user form
		$data['form']['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$data['form']['user'] = $user;
		$data['form']['groups'] = $groups;
		$data['form']['currentGroups'] = $currentGroups;

        $data['form']['id'] = array(
            'name' => 'id',
            'id' => 'input-id',
            'class' => 'form-control',
            'type' => 'text',
            'placeholder' => 'Id',
            'value' => $this->form_validation->set_value('id', $user->id),
        );
        $data['form']['first_name'] = array(
            'name' => 'first_name',
            'id' => 'input-first-name',
            'class' => 'form-control',
            'type' => 'text',
            'placeholder' => 'First Name',
            'value' => $this->form_validation->set_value('first_name', $user->first_name),
        );
        $data['form']['last_name'] = array(
            'name' => 'last_name',
            'id' => 'input-last-name',
            'class' => 'form-control',
            'type' => 'text',
            'placeholder' => 'Last Name',
            'value' => $this->form_validation->set_value('last_name', $user->last_name),
        );
        $data['form']['identity'] = array(
            'name' => 'identity',
            'id' => 'input-identity',
            'class' => 'form-control',
            'type' => 'text',
            'placeholder' => 'Identity',
            'value' => $this->form_validation->set_value('identity', $user->{$identity_column}),
        );
        $data['form']['email'] = array(
            'name' => 'email',
            'id' => 'input-email',
            'class' => 'form-control',
            'type' => 'text',
            'placeholder' => 'Email',
            'value' => $this->form_validation->set_value('email', $user->email),
        );
        $data['form']['company'] = array(
            'name' => 'company',
            'id' => 'input-company',
            'class' => 'form-control',
            'type' => 'text',
            'placeholder' => 'Company',
            'value' => $this->form_validation->set_value('company', $user->company),
        );
        $data['form']['phone'] = array(
            'name' => 'phone',
            'id' => 'input-phone',
            'class' => 'form-control',
            'type' => 'text',
            'placeholder' => 'Phone',
            'value' => $this->form_validation->set_value('phone', $user->phone),
        );
        $data['form']['password'] = array(
            'name' => 'password',
            'id' => 'input-password',
            'class' => 'form-control',
            'type' => 'password',
            'placeholder' => 'Password',
        );
        $data['form']['password_confirm'] = array(
            'name' => 'password_confirm',
            'id' => 'input-password-confirm',
            'class' => 'form-control',
            'type' => 'password',
            'placeholder' => 'Password Confirm',
        );

		// $this->_render_page('authx' . DIRECTORY_SEPARATOR . 'edit_user', $this->data);
        
        $data['page_title'] = 'Edit User';
        $data['page_description'] = 'Form Edit User';
        // $data['dt_users'] = $this->users_model->_read($id);
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
        redirect('admin'. DIRECTORY_SEPARATOR .'users', 'refresh');
    }

    public function groups()
    {
        $this->load->library('datatables');
        $data['page_title'] = 'Groups';
        $data['page_description'] = 'Groups List';
        $data['message'] = $this->session->flashdata('message');
        $data['dt_groups'] = $this->groups_model->_datatable_index();
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
                    ->_render_admin('index_group_admin', $data);
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

    // public function json_users()
    // {
    //     $this->load->library('datatables');
    //     return print_r($this->datatables->select('username, email, last_login')
    //                         ->from('users')
    //                         ->generate());
    //     // echo var_dump($this->datatables->_get_table('users'));
    // }
}
