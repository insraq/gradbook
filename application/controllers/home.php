<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$user = $this->login->require_login();

		$this->load->helper('astro');
		$users = R::find('profile');
		$this->load->view('header');
		$this->load->view('home/home', array(
			'users' => $users,
			'profile' => R::findOne('profile', 'user_id = ?', array($user->id)),
			'gender' => array('M' => '男', 'F' => '女')
		));
		$this->load->view('footer');
	}

	public function filter($item, $value)
	{
		$user = $this->login->require_login();

		$this->load->helper('astro');
		$users = R::find('profile', "`{$item}` = ?", array(urldecode($value)));
		$this->load->view('header');
		$this->load->view('home/filter', array(
			'users' => $users,
			'profile' => R::findOne('profile', 'user_id = ?', array($user->id)),
			'gender' => array('M' => '男', 'F' => '女'),
			'title' => urldecode($value)
		));
		$this->load->view('footer');
	}
}