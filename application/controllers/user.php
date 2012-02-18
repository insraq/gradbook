<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function create()
	{
		$user_id = $this->session->userdata('user_id');
		if (!empty($user_id))
		{
			redirect('user/profile/' . $this->session->userdata('user_id'));
		}

		$this->load->helper('form');

		$this->load->view('header', array('title' => '创建用户'));
		$this->load->view('user/create');
		$this->load->view('footer');
	}

	public function validate()
	{
		$user_id = $this->session->userdata('user_id');
		if (!empty($user_id))
		{
			redirect('user/profile/' . $this->session->userdata('user_id'));
		}
		
		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
		$this->form_validation->set_message('required', '<b>%s</b> 是必填项。');
		$this->form_validation->set_message('exact_length', '<b>%s</b> 必须是 <b>%s</b> 位数字，即08后面的位数。');
		$this->form_validation->set_message('integer', '<b>%s</b> 必须是数字。');
		$this->form_validation->set_message('email', '<b>%s</b> 必须是正确的电邮地址。');

		$this->form_validation->set_rules('user', '学生证号', 'required|exact_length[6]|ingeter');
		$this->form_validation->set_rules('password', '密码', 'required');
		$this->form_validation->set_rules('email', '电邮', 'required|valid_email');
		$this->form_validation->set_rules('name', '姓名', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('header');
			$this->load->view('user/create');
			$this->load->view('footer');
		}
		else
		{
			$exist = R::findOne('user', 'student_id = ?', array($this->input->post('year') . $this->input->post('user')));
			if (isset($exist->id))
			{
				// Send email again
				$this->_send_validation_email($exist->id);
				// View
				$this->load->view('header', array('title' => '用户已存在'));
				$this->load->view('user/exist');
				$this->load->view('footer');
			}
			else
			{
				// Model
				$user = R::dispense('user');
				$user->student_id = $this->input->post('year') . $this->input->post('user');
				$user->password = sha1($this->input->post('password'));
				$user->email = $this->input->post('email');
				$user->name = $this->input->post('name');
				$user->college = $this->input->post('college');
				$user->validate = 0;
				$id =  R::store($user);
				// Send Email
				$this->_send_validation_email($id);
				// View
				$this->load->view('header');
				$this->load->view('user/success');
				$this->load->view('footer');
			}
		}
	}

	public function activate($id, $code)
	{
		$v = R::findOne('validation', 'user_id = ?', array($id));
		if (isset($v->id))
		{
			if ($v->code == $code)
			{
				// Model
				R::trash($v);
				$user = R::load('user', $v->user_id);
				$user->validate = 1;
				R::store($user);
				// Session
				$this->session->set_userdata(array('user_id' => $user->id));
				// View
				redirect('user/profile/' . $user->id);
			}
			else
			{
				$this->load->view('header', array('title' => '验证失败'));
				$this->load->view('message', array('type' => 'alert-error', 'message' => '验证信息已经失效。'));
				$this->load->view('footer');
			}
		}
		else
		{
			$this->load->view('header', array('title' => '验证错误'));
			$this->load->view('message', array('type' => 'alert-error', 'message' => '验证信息不存在。'));
			$this->load->view('footer');
		}
	}

	public function profile($id)
	{
		$user_id = $this->session->userdata('user_id');
		$user = R::load('user', $id);
		if ($user->id == $user_id)
		{
			$this->load->helper('form');
			$this->load->view('header', array('title' => '完善个人资料'));
			$this->load->view('user/profile', array(
				'user' => $user, 
				'province' => $this->_get_province(),
				'faculty' => $this->_get_faculty(),
				'ocamp_big' => $this->_get_ocamp_big(),
				'ocamp_small' => $this->_get_ocamp_small()
			));
			$this->load->view('footer');
		}
		else
		{
			$this->load->view('header', array('title' => '未登录'));
			$this->load->view('message', array('type' => 'alert-error', 'message' => '尚未登陆。'));
			$this->load->view('footer');
		}

	}

	public function login()
	{
		$user_id = $this->session->userdata('user_id');
		if ($user_id)
		{
			redirect('user/profile/' . $user->id);
		}
		else
		{
			
			$this->load->helper('form');
			$this->load->view('header', array('title' => '请登录'));
			$this->load->view('user/login');
			$this->load->view('footer');
		}

	}

	public function check()
	{
		$user_id = $this->session->userdata('user_id');
		if ($user_id)
		{
			redirect('user/profile/' . $user->id);
		}
		else
		{
			
			$sid = $this->input->post('user');
			$password = sha1($this->input->post('password'));
			$user = R::findOne('user', 'student_id = ? AND password = ?', array($sid, $password));
			if (isset($user->id))
			{
				// Session
				$this->session->set_userdata(array('user_id' => $user->id));
				redirect('user/profile/' . $user->id);
			}
			else
			{
				$this->load->helper('form');
				$this->load->view('header', array('title' => '请登录'));
				$this->load->view('user/login', array('warning' => '登录失败，请检查学生证号和密码。'));
				$this->load->view('footer');
			}
		}

	}

	private function _get_validation($id)
	{
		$user = R::load('user', $id);
		$exist = R::findOne('validation', 'user_id = ?', array($user->id));
		if (isset($exist->id))
		{
			return $exist->code;
		}
		else
		{
			$this->load->helper('string');
			$v = R::dispense('validation');
			$v->user = $user;
			$v->code = random_string('alnum', 16);
			R::store($v);
			return $v->code;
		}
		
	}

	private function _send_validation_email($id)
	{
		$this->load->library('email');

		$user = R::load('user', $id);

		$this->email->from('no-reply@cuhk.me', '毕业纪念册');
		$this->email->reply_to('sun@ruoyu.me', 'SUN Ruoyu');

		$email = 's' . substr($user->student_id, 0, -1) . '@mailserv.cuhk.edu.hk';
		$this->email->to($email);

		$this->email->subject('请完成毕业纪念册的身份验证');

		$code = $this->_get_validation($user->id);
		$url = site_url("user/activate/{$user->id}/{$code}");
		$this->email->message('恭喜你，你的帐户已经建立，请点击下面的链接完成身份验证：' . $url);

		$this->email->send();
	}

	private function _get_province()
	{
		return array(
			'北京市', '天津市', '重庆市', '上海市',
			'河北省', '山西省', '辽宁省', '吉林省', '黑龙江省', '江苏省',
			'浙江省',  '安徽省', '福建省', '江西省', '山东省', '河南省',
			'湖北省', '湖南省', '广东省', '海南省', '四川省', '贵州省',
			'云南省', '陕西省', '甘肃省', '青海省', '台湾省', '内蒙古',
			'广西', '宁夏', '新疆', '西藏', '香港', '澳门'
		);
	}
	
	private function _get_faculty()
	{
		return array(
			'文学院', '工商管理学院', '教育学院', '工程学院', '法律学院', '医学院', '理学院', '社会科学院'
		);
	}

	private function _get_department()
	{
		return array(
			'工商管理学士',
			'专业会计学',
			'酒店及旅游管理学',
			'计量金融学',
			'保险、财务与精算学',
			'计量金融学及风险管理科学跨学科',
			'风险管理科学',
			'数学',
			'统计学',
			'工商管理学士与工程学院跨学科',
			'计算机科学',
			'系统工程与工程管理学',
			'电子工程学',
			'信息工程学',
			'计算机工程学',
			'数学与信息工程学',
			'生物医学工程',
			'生物',
			'物理',
			'建筑学',
			'经济学',
			'地理与资源管理学',
			'政治与行政学',
			'新闻与传播学',
			'心理学',
			'社会工作学',
			'社会学',
			'法学士',
			'工商管理学士—法律博士',
			'环球商业学',
			'环球经济与金融跨学科',
			'国际贸易及中国企业',
			'生物化学',
			'细胞及分子生物学',
			'化学',
			'中医学',
			'环境科学',
			'食品及营养科学',
			'分子生物技术学',
			'机械与自动化工程学',
			'医学科学增插学年学士学位课程',
			'内外全科医学',
			'护理学',
			'药剂学',
			'公共卫生学',
			'人类学',
			'中国语言及文学',
			'文化研究',
			'英文',
			'艺术',
			'历史',
			'日本研究',
			'语言学',
			'音乐',
			'哲学',
			'宗教研究',
			'神学',
			'翻译',
			'通识教育',
			'体育运动科学',
			'中国语文教育',
			'英国语文研究与英国语文教育'
		);
	}

	private function _get_ocamp_big()
	{
		return array(
			'八达通',
			'天一阁',
			'山字军',
			'畅天涯',
			'天龙殿',
			'辞源堂'
		);
	}
	
	private function _get_ocamp_small()
	{
		return array(
			'东涌',
			'西贡',
			'南昌',
			'北角',
			'中环',

			'翊海',
			'凌渊',
			'逐浪',
			'浣泉',
			'云川',

			'断背',
			'八宝',
			'人猿泰',
			'花果',
			'一桶姜',

			'东旭',
			'西疆',
			'南海',
			'北雪',
			'中山',

			'一阳',
			'无双',
			'北冥',
			'独尊',
			'六脉',

			'辞源',
			'辞海',
			'新华',
			'牛津',
			'朗文'
		);
	}
}