<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tool extends CI_Controller {

	public function resize($size)
	{
		$users = R::find('profile');

		foreach ($users as $u)
		{
			if (!empty($u->photo))
			{
				$config['image_library'] = 'gd2';
				$config['source_image'] = './upload/' . $u->photo;
				$config['new_image'] = './upload/thumb_' . $u->photo;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = $size;
				$config['height'] = $size;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
			}

		}

		$this->load->view('header');
		$this->load->view('message', array('message' => '更改大小成功。'));
		$this->load->view('footer');
	}
}