<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$user = $this->session->userdata('user_id');
		if ($user)
		{
			redirect('user/profile/' . $user);
		}
		else
		{
			redirect('user/login');
		}
	}
}