<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginModel extends CI_Model
{
	public function login($username, $password)
	{
		$WebHRMS = $this->load->database('WebHRMS', TRUE);
		$query1 = $WebHRMS->query("SELECT  *
      FROM           dbo.View_GiftBallLogin
      WHERE        (username = '$username') AND (giftBallPassword = '$password')");

		if ($query1->num_rows() > 0) {
			$result = $query1->row();
			$session_data = [
				'user_id' => $result->empid,
				'gradeName' => $result->gradeName,
				'Username' => $result->name,
				'CardNo' => $result->CardNo,
				'deptid' => $result->deptid,
				'desigid' => $result->desigid,
				'HeadStatus' =>$result->selfservice_manager_permissions,
				'subHead' => $result->subRequests



			];
			$this->session->set_flashdata('info', 'Welcome to Forward Sports 100% Namazi System.');
			$this->session->set_userdata($session_data);
			redirect('Classes');
		} else {
			$this->session->set_flashdata(
				'danger',
				'Your CardNo  OR Password is In Correct.'
			);
			redirect('LoginController');
		}
	}
	public function login2($data)
	{
		// print_r($data);
		// print_r("<br>");
		// print_r($data['id']);
		$session_data = [
			'NamazUserId' => $data['id'],
			// 'gradeName' => $data['gradeName'],
			'Username' => $data['picture']['name'],
			'CardNo' => $data['picture']['CardNo'],

			'deptid' => $data['companyInfo']['Department']['id'],
			'deptName' => $data['companyInfo']['Department']['name'],
			
			'sectionid' => $data['companyInfo']['Section']['id'],
			'sectionName' => $data['companyInfo']['Department']['name'],
			'HeadStatus' => $data['selfservice_manager_permissions'],
			'subHead' => $data['subRequests']


		];
		$this->session->set_flashdata('info', 'Welcome ' .$data['picture']['name']. ' to Forward Sports 100% Namazi System.');
		$this->session->set_userdata($session_data);
		return true;
	}
}
