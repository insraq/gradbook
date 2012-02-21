<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tool extends CI_Controller {

	public function resize($id, $size)
	{
		$profile = R::findOne('profile', 'user_id = ?', array($id));

		if (!empty($profile->photo))
		{
			$config = array();
			$config['image_library'] = 'gd2';
			$config['source_image'] = './upload/' . $profile->photo;
			$config['new_image'] = './upload/thumb_' . $profile->photo;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = $size;
			$config['height'] = $size;
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
		}


		$this->load->view('header');
		$this->load->view('message', array('message' => $profile->photo . ' 更改大小成功。'));
		$this->load->view('footer');
	}

	public function college()
	{
		$profile = R::find('profile');
		foreach ($profile as $p)
		{
			$p->college = $p->user->college;
			R::store($p);
		}
		$this->load->view('header');
		$this->load->view('message', array('message' => '数据库升级成功。'));
		$this->load->view('footer');
	}

	public function profile()
	{
		$users = R::find('user', 'validate = 1');
		foreach ($users as $user)
		{
			$profile = R::findOne('profile', 'user_id = ?', array($user->id));
			if (!isset($profile->id))
			{
				$profile = R::dispense('profile');
				$profile->user = $user;
				$profile->college = $user->college;
				R::store($profile);
			}
		}
		$this->load->view('header');
		$this->load->view('message', array('message' => '数据库升级成功。'));
		$this->load->view('footer');
	}
}