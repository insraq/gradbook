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
				// View
				$this->load->view('header');
				$this->load->view('user/success');
				$this->load->view('footer');
			}
		}
	}
}