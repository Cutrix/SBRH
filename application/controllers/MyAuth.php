<?php defined('BASEPATH') or exit('Not direct access allowed');

class MyAuth extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('ion_auth', 'form_validation'));
		$this->load->helper(array('assets'));
	}

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
			$this->_render_page('MyAuth/admin', $this->data);
		}
	}

	public function login() {
		$this->load->view('templ/header');
		//$this->load->view('templ/nav');
		$this->load->view('MyAuth/connexion');

		$this->form_validation->set_rules('login', '"Le login"', 'required');
		$this->form_validation->set_rules('pwd', '"le mot de passe"', 'required');

		if ($this->form_validation->run() === TRUE) {

			if ($this->ion_auth->login($this->input->post('
				login'), $this->input->post('pwd'))) {
				if ($this->ion_auth->is_admin()) {
					redirect('MyAuth', 'refresh');
				}
			} else {
				var_dump($this->ion_auth->login($this->input->post('
				login'), $this->input->post('pwd')));
				exit('je ne peux pasm me connecter');
			}
		}

		$this->load->view('templ/footer');
	}

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

	//-------------------------------------------------------------------------------------

	public function createUser() {
		$this->load->view('templ/nav_admin');
	}

}
