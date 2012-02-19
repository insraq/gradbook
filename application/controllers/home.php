<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$user = $this->session->userdata('user_id');
		if ($user)
		{
			$this->load->helper('astro');
			$users = R::find('profile');
			$this->load->view('header');
			$this->load->view('home/home', array(
				'users' => $users,
				'user' => $user,
				'gender' => array('M' => '男', 'F' => '女')
			));
			$this->load->view('footer');
		}
		else
		{
			redirect('user/login');
		}
	}
}