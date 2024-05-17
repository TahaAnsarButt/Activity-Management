<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('LoginModel', 'L');
	}
	public function index()
	{
		
		$this->load->view('Login/login_view');
	}

	public function authenticate()
	{
		
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$data = $this->L->login($username, $password);

	}

	public function authenticate2()
	{

		$data = $this->input->post('data');

		$data2 = $this->L->login2($data);
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data2));
	}


	public function logout()
	{
		$this->session->sess_destroy();
		redirect('LoginController');
	}

}
