<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed extends CI_Controller {

	public function index()
	{
		$user = $this->login->require_login();
		// $this->load->helper('astro');
		$this->load->view('header');
		$this->load->view('feed/index', array(
			'user' => $user,
			'profile' => R::findOne('profile', 'user_id = ?', array($user->id)),
			'gender' => array('M' => '男', 'F' => '女'),
			'comment' => R::find('comment', '1 ORDER BY id DESC')
		));
		$this->load->view('footer');
	}
}