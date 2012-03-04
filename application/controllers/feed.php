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
		redirect('feed/page');
	}

	public function page($id = 20)
	{
		$this->load->library('pagination');

		$config['base_url'] = site_url('feed/page');
		$config['total_rows'] = count(R::find('comment'));
		$config['per_page'] = 20;
		$config['full_tag_open'] = '<div class="pagination"><ul>';
		$config['full_tag_close'] = '</ul></div>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_open'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_link'] = '首页';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_link'] = '尾页';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['prev_link'] = '&larr;';
		$config['next_link'] = '&rarr;';
		$this->pagination->initialize($config);

		$user = $this->user;
		$this->load->view('header');
		$this->load->view('feed/page', array(
			'user' => $user,
			'profile' => R::findOne('profile', 'user_id = ?', array($user->id)),
			'gender' => array('M' => '男', 'F' => '女'),
			'comment' => R::find('comment', '1 ORDER BY last_update DESC LIMIT ?, 20', array((int) $id))
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