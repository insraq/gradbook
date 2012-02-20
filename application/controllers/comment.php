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
			$exist = R::findOne('comment', 'from_user = ? AND to_user = ?', array($user->id, $id));
			if (isset($exist->id))
			{
				$comment = $exist;
				$comment->import($this->input->post(), 'word, private, public');
				$comment->accept = $this->input->post('accept') ? 1 : 0;
				$comment->last_update = time();
			}
			else
			{
				$comment = R::dispense('comment');
				$comment->import($this->input->post(), 'word, private, public');
				$comment->accept = $this->input->post('accept') ? 1 : 0;
				$comment->from_user = $user->id;
				$comment->to_user = $id;
				$comment->last_update = time();
			}
			// Check max no of private
			if ($this->input->post('love') == 'private')
			{
				$number = count(R::find('comment', 'from_user = ? AND love = private', array($user->id)));
				if ($number >= 5)
				{
					$message = '资料更新成功，但是你最多只能暗恋五个人，所以暗恋失败。';
				}
				else
				{
					$comment->love = $this->input->post('love');
					$message = '资料更新成功。';
				}
			}
			else
			{
				$comment->love = $this->input->post('love');
				$message = '资料更新成功。';
			}
			R::store($comment);
			$this->load->view('header');
			$this->load->view('message', array('message' => $message, 'type' => 'alert-success'));
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