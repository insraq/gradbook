<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login {

	private $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
	}

	public function require_login()
	{
		$user_id = $this->CI->session->userdata('user_id');
		if (!$user_id)
		{
			redirect('user/login');
			exit();
		}
		else
		{
			return R::load('user', $user_id);
		}
	}

	public function require_admin()
	{
		$user_id = $this->CI->session->userdata('user_id');
		if (!empty($user_id) AND $user_id == 1)
		{
			return R::load('user', $user_id);
		}
		else
		{
			redirect('user/login');
			exit();
		}
	}
}