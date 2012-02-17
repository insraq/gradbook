<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function create()
	{
		$this->load->helper('form');

		$this->load->view('header', array('title' => '创建用户'));
		$this->load->view('user/create');
		$this->load->view('footer');
	}

	public function validate()
	{
		
		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
		$this->form_validation->set_message('required', '<b>%s</b> 是必填项。');
		$this->form_validation->set_message('exact_length', '<b>%s</b> 必须是 <b>%s</b> 位数字，即08后面的位数。');
		$this->form_validation->set_message('integer', '<b>%s</b> 必须是数字。');
		$this->form_validation->set_message('email', '<b>%s</b> 必须是正确的电邮地址。');

		$this->form_validation->set_rules('user', '学生证号', 'required|exact_length[6]|ingeter');
		$this->form_validation->set_rules('password', '密码', 'required');
		$this->form_validation->set_rules('email', '电邮', 'required|valid_email');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('header');
			$this->load->view('user/create');
			$this->load->view('footer');
		}
		else
		{
			$exist = R::findOne('user', 'student_id = ?', array('08' . $this->input->post('user')));
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
				$user->student_id = '08' . $this->input->post('user');
				$user->password = sha1($this->input->post('password'));
				$user->email = $this->input->post('email');
				$user->college = $this->input->post('college');
				$user->verified = $this->input->post('verifed');
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
}