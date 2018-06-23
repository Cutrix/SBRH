<?php defined('BASEPATH') or exit('Not direct access allowed');

class MyAuth extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('ion_auth', 'form_validation', 'email'));
		$this->load->helper(array('assets', 'form', 'odit', 'email'));
	}

	//-------------------------------------------------------------------------------------------------------

	public function index() {
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('MyAuth/login', 'refresh');
		} else if (!$this->ion_auth->is_admin())// remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		} else {
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors())?validation_errors():$this->session->flashdata('message');

			//list the users
			$this->data['users'] = $this->ion_auth->users()->result();
			foreach ($this->data['users'] as $k => $user) {
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}
			$this->_render_page('templ/header', $this->data);
			$this->load->view('templ/nav_admin', $this->data);
			$this->load->view('MyAuth/admin');
		}
	}

	//-------------------------------------------------------------------------------------------------------

	public function login() {
		$this->load->view('templ/header');
		$this->load->view('templ/nav');

		$this->form_validation->set_rules('login', '"Le login"', 'required');
		$this->form_validation->set_rules('pwd', '"le mot de passe"', 'required');

		if ($this->form_validation->run() === TRUE) {
			if ($this->ion_auth->login($this->input->post('login'), $this->input->post('pwd'))) {
				redirect('MyAuth', 'refresh');
			} else {
				$data['error_login'] = true;
			}
		}

		if (isset($data)) {
			$this->load->view('MyAuth/connexion', $data);
		} else {
			$this->load->view('MyAuth/connexion');
		}

		$this->load->view('templ/footer');
	}

	//-------------------------------------------------------------------------------------------------------

	public function logout() {
		$this->ion_auth->logout();
	}

	public function _render_page($view, $data = NULL, $returnhtml = FALSE) {

		$this->viewdata = (empty($data))?$this->data:$data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		// This will return html on 3rd argument being true
		if ($returnhtml) {
			return $view_html;
		}
	}

	//-------------------------------------------------------------------------------------------------------

	public function createUser() {
		//Va te loguer petit
		if (!$this->ion_auth->logged_in()) {
			redirect('MyAuth/login', 'refresh');
		}
		$this->form_validation->set_rules('identity', '"identity"', 'required');
		$this->form_validation->set_rules('pwd', '"pwd"', 'required');
		$this->form_validation->set_rules('email', '"email"', 'required');
		$this->form_validation->set_rules('nom', '"nom"', 'required');
		$this->form_validation->set_rules('prenom', '"prenom"', 'required');
		$this->load->view('templ/header');

		//$this->load->view('templ/nav_admin');
		$data['users'] = $this->ion_auth->groups()->result();

		if ($this->form_validation->run() === TRUE) {
			$group_id[] = $this->input->post('groups');

			$add_data = ['first_name' => $this->input->post('nom', true), 'last_name' => strtoupper($this->input->post('prenom', true))];

			if ($this->ion_auth->register($this->input->post('identity', true), $this->input->post('pwd', true), $this->input->post('email', true), $add_data, $group_id)) {
				$this->config->load('ion_auth');
				$this->email->set_mailtype('html');
				$this->email->from($this->config->item('admin_email'), 'admin');
				$this->email->to($this->input->post('email'));
				$data = ['login' => $this->input->post('identity'), 'pwd' => $this->input->post('pwd'), 'email' => $this->input->post('email')];
				$this->email->subject('Vos identifiants');
				$this->email->message($this->load->view('auth/email/new_user.tpl.php', $data, true));

				if ($this->email->send()) {
					var_dump('ok');
				}
				echo "<script>alert('utilisateur bien enregistree')</script>";
				echo $this->email->print_debugger();
			}

		}

		$this->load->view('MyAuth/new_user', $data);

	}

	//-------------------------------------------------------------------------------------------------------

	public function createUserAjax() {
		if ($this->input->post('email_aj') !== NULL) {
			if ($this->ion_auth->email_check($this->input->post('email_aj'))) {
				echo "ok";
			}
		}
	}

	//-------------------------------------------------------------------------------------------------------

	public function listUsers() {
		$this->load->view('templ/header');
		$data['users'] = $this->ion_auth->users()->result();
		$this->load->view('MyAuth/list_user', $data);
		$this->load->view('templ/nav_admin');
	}
}
