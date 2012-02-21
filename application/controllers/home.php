<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$user = $this->login->require_login();

		$this->load->helper('astro');
		$users = R::find('profile', 'faculty IS NOT NULL');
		$this->load->view('header');
		$this->load->view('home/home', array(
			'users' => $users,
			'profile' => R::findOne('profile', 'user_id = ?', array($user->id)),
			'gender' => array('M' => '男', 'F' => '女'),
			'comment' => R::find('comment', 'to_user = ?', array($user->id))
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

	public function ocamp()
	{
		$user = $this->login->require_login();
		
		$group = array(
			'八达通' => array('东涌', '西贡', '南昌', '北角', '中环'),
			'天一阁' => array('翊海', '凌渊', '逐浪', '浣泉', '云川'),
			'山字军' => array('断背', '八宝', '人猿泰', '花果', '一桶姜'),
			'畅天涯' => array('东旭', '西疆', '南海', '北雪', '中山'),
			'天龙殿' => array('一阳', '无双', '北冥', '独尊', '六脉'),
			'辞源堂' => array('辞源', '辞海', '新华', '牛津', '朗文')
		);

		$this->load->view('header');
		$this->load->view('home/ocamp', array(
			'profile' => R::findOne('profile', 'user_id = ?', array($user->id)),
			'group' => $group
		));

		$this->load->view('footer');
	}

	public function view($id)
	{
		$this->load->helper('astro');
		$this->load->helper('form');
		$this->load->helper('date');
		$user = $this->login->require_login();
		$profile = R::findOne('profile', 'user_id = ?', array($id));
		$comment = R::find('comment', 'to_user = ?', array($id));
		$data = array(
			'profile' => $profile,
			'gender' => array('M' => '男', 'F' => '女'),
			'user' => $user,
			'my' => R::findOne('comment', 'from_user = ? AND to_user = ?', array($user->id, $id)),
			'comment' => $comment
		);
		$this->load->view('header');
		$this->load->view('home/view', $data);
		$this->load->view('footer');
	}

	public function me()
	{
		$user = $this->login->require_login();
		redirect('home/view/' . $user->id);
	}
}