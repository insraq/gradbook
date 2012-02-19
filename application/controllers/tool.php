<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tool extends CI_Controller {

	public function resize($size)
	{
		$profile = R::find('profile');
		$message = '';

		foreach ($profile as $p)
		{
			if (!empty($p->photo))
			{
				$config = array();
				$config['image_library'] = 'gd2';
				$config['source_image'] = './upload/' . $p->photo;
				$config['new_image'] = './upload/thumb_' . $p->photo;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = $size;
				$config['height'] = $size;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$message .= $p->photo . ', ';
			}

		}

		$this->load->view('header');
		$this->load->view('message', array('message' => $message . '更改大小成功。'));
		$this->load->view('footer');
	}
}