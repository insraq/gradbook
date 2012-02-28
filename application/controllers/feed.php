<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed extends CI_Controller {

	private $user;

	public function __construct()
	{
	    parent::__construct();
	    $this->user = $this->login->require_login();
	}

	public function index()
	{
		$user = $this->user;
		// $this->load->helper('astro');
		$this->load->view('header');
		$this->load->view('feed/index', array(
			'user' => $user,
			'profile' => R::findOne('profile', 'user_id = ?', array($user->id)),
			'gender' => array('M' => '男', 'F' => '女'),
			'comment' => R::find('comment', '1 ORDER BY last_update DESC')
		));
		$this->load->view('footer');
	}

	public function love()
	{
		$user = $this->user;
		// $this->load->helper('astro');
		$this->load->view('header');
		$this->load->view('feed/love', array(
			'user' => $user,
			'profile' => R::findOne('profile', 'user_id = ?', array($user->id)),
			'gender' => array('M' => '男', 'F' => '女'),
			'comment' => R::find('comment', 'love = "public" ORDER BY last_update DESC')
		));
		$this->load->view('footer');
	}
}