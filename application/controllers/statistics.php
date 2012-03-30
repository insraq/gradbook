<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statistics extends CI_Controller {

	private $user;

	public function __construct()
	{
	    parent::__construct();
	    $this->user = $this->login->require_login();
	}

	public function index()
	{
		$url = array();
		$title_general = '香港中文大学2012毕业纪念册风云统计之';
		// 统计性别
		$gender = array('M', 'F');
		$gender_name = array('M' => '男', 'F' => '女');
		$data = array();
		foreach ($gender as $g)
		{
			$v = count(R::find('profile', 'gender = ?', array($g)));
			$k = "{$gender_name[$g]} ({$v})";
			$data[$k] = $v;
		}
		$url[] = $this->_get_chart($title_general . '「性别」', $data);

		// 统计书院
		$college = array('崇基书院', '新亚书院', '联合书院', '逸夫书院');
		$data = array();
		foreach ($college as $c)
		{
			$v = count(R::find('profile', 'college = ?', array($c)));
			$k = "{$c} ({$v})";
			$data[$k] = $v;
		}
		$url[] = $this->_get_chart($title_general . '「书院」', $data);

		// 统计学院
		$faculty = array(
			'文学院', '工商管理学院', '教育学院', '工程学院', '法律学院', '医学院', '理学院', '社会科学院'
		);
		$data = array();
		foreach ($faculty as $f)
		{
			$v = count(R::find('profile', 'faculty = ?', array($f)));
			$k = "{$f} ({$v})";
			$data[$k] = $v;
		}
		$url[] = $this->_get_chart($title_general . '「学院」', $data);

		// 统计星座
		$this->load->helper('astro');
		$data = array();
		$astro = R::find('profile', 'year IS NOT NULL AND month IS NOT NULL AND day IS NOT NULL');
		foreach ($astro as $a)
		{
			$name = get_astro($a->month, $a->day);
			$name = $name['name'];
			if (isset($data[$name]))
				$data[$name]++;
			else
				$data[$name] = 1;
		}
		$new_data = array();
		foreach ($data as $k => $v)
		{
			$new_k = "{$k} ({$v})";
			$new_data[$new_k] = $v;
		}
		$url[] = $this->_get_chart($title_general . '「星座统计」', $new_data);

		// 统计毕业去向
		$aim = array('留港工作', '出国工作', '内地工作', '香港读书', '出国读书', '内地读书', '其他');
		$data = array();
		foreach ($aim as $a)
		{
			$v = count(R::find('profile', 'aim = ?', array($a)));
			$k = "{$a} ({$v})";
			$data[$k] = $v;
		}
		$url[] = $this->_get_chart($title_general . '「毕业去向」', $data);

		// 统计情感
		$relationship = array('单身', '恋爱中', '说不准', '不想说');
		$data = array();
		foreach ($relationship as $r)
		{
			$v = count(R::find('profile', 'relationship = ?', array($r)));
			$k = "{$r} ({$v})";
			$data[$k] = $v;
		}
		$url[] = $this->_get_chart($title_general . '「情感」', $data);

		$this->load->view('header');
		$this->load->view('statistics/index', array('url' => $url));
		$this->load->view('footer');
	}

	private function _get_chart($title, $data)
	{
		$number = "";
		$label = "";
		foreach ($data as $k => $v)
		{
			$number .= $v . ',';
			$label .= $k . '|';
		}
		$number = urlencode(rtrim($number, ','));
		$label = urlencode(rtrim($label, '|'));
		$title = urlencode($title);
		return "http://chart.apis.google.com/chart?chs=600x400&chco=0099cc&cht=p&chd=t:{$number}&chl={$label}&chds=a&chtt={$title}";
	}

}