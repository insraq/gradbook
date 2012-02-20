<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends CI_Controller {

	public function update($id) {
		$user = $this->login->require_login();
		if ($user->id == $id)
		{
			$this->load->view('header');
			$this->load->view('message', array('message' => '你不可以给自己留言。', 'type' => 'alert-error'));
			$this->load->view('footer');
		}
		elseif ($this->input->post('word') AND $this->input->post('public'))
		{
			// $exist = R::findOne('comment', 'from = ? AND to = ?', array($user->id, $id));
			// if (isset($exist->id))
			// {
			// 	$comment = $exist;
			// 	$comment->import($this->input->post(), 'word, private, public, love');
			// 	$comment->accept = $this->input->post('accept') ? 1 : 0;
			// }
			// else
			// {
				$comment = R::dispense('comment');
				$comment->import($this->input->post(), 'word, private, public, love');
				$comment->accept = $this->input->post('accept') ? 1 : 0;
				$comment->from = $user->id;
				$comment->to = $id;
			// }
			R::store($comment);
			$this->load->view('header');
			$this->load->view('message', array('message' => '成功更新资料。', 'type' => 'alert-success'));
			$this->load->view('footer');
		}
		else
		{
			$this->load->view('header');
			$this->load->view('message', array('message' => '“一个词形容他”和“公开的话”是必填项。', 'type' => 'alert-error'));
			$this->load->view('footer');
		}
	}
}