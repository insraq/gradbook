<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widget extends CI_Controller {

	public function lyrics()
	{
		$user = $this->login->require_login();

		$im = imagecreatetruecolor(600, 300);
		$bg = imagecolorallocate($im, 0, 153, 255);
		imagefill($im, 0, 0, $bg);

		$text = imagecolorallocate($im, 255, 255, 255);
		$font = 'asset/font/wqy.ttc';
		$size = 30;
		$gap = 50;

		$line = $this->_get_lyrics();		

		$output = explode('/', $line);

		$i = 0;
		foreach ($output as $o)
		{
			imagettftext($im, $size, 0, 20, 50 + $i * $gap, $text, $font, $o);
			$i++;
		}

		
		imagettftext($im, 12, 0, 300, 280, $text, $font, $user->name . ' @ GRAD.CUHK.ME | 毕业纪念册');
		
		header('Content-type: image/png');
		imagepng($im);
		imagedestroy($im);
	}

	private function _get_lyrics()
	{
		$db = array(
			'少了我的手臂当枕头/你习不习惯/你的望远镜/望不到我北半球的孤单',
			'让心跳停了/时间就会暂停/想告诉你/我只会跟你到这里',
			'忘掉爱过的他/当初的喜帖金箔印着那位他/裱起婚纱照那道墙/及一切美丽旧年华',
			'我以为我能装做不听不看/不过情人节/一切就会默默停在/你陪着我那一年',
			'天之涯，地之角/知交半零落/一壶浊酒尽余欢/今宵别梦寒',
			'谁娶了多愁善感的你/谁看了你的日记/谁把你的长发盘起/谁给你做的嫁衣',
			'那些年错过的大雨/那些年错过的爱情/好想拥抱你/拥抱错过的勇气',
			'我没有说谎/我何必说谎/你懂我的/我对你从来就不会假装',
			'当你孤单你会想起谁/你想不想找个人来陪/你的快乐伤悲/只有我能体会',
			'把一个人的温暖/转移到另一个的胸膛/让上次犯的错/反省出梦想',
			'爱情不是你想卖/想买就能卖/让我挣开让我明白/放手你的爱',
			'那年夏天我和你躲在/这一大片宁静的海/直到后来我们都还在/对整个世界充满期待'
		);

		$key = array_rand($db);
		return $db[$key];
	}
}