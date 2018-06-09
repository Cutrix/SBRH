<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('assets', 'odit', 'url'));
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.htm l
	 */
	public function index() {
		$this->load->view('templ/header');
		$this->load->view('templ/nav');
		$this->load->view('Welcome/acceuil');
		$this->load->view('templ/footer');
	}

	public function trace() {
		$params = array('path' => log_url());
		$this->load->library('logger', $params);
		//warn dossier, auth titre fichier log, ligne ce qui est dedans
		$this->logger->log("warn", "auth", "ip nom prenom login email a  heure date", $this->logger::GRAN_VOID);
	}
}
