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

		$db = $this->_get_lyrics();
		$key = array_rand($db);
		$line = $db[$key];

		$output = explode('/', $line);

		$i = 0;
		foreach ($output as $o)
		{
			imagettftext($im, $size, 0, 20, 50 + $i * $gap, $text, $font, $o);
			$i++;
		}
		
		imagettftext($im, 12, 0, 300, 280, $text, $font, $user->name . ' @ GRAD.CUHK.ME | 毕业纪念册');
		
		imagepng($im, './upload/lyrics/' . $user->id . '.png');
		imagedestroy($im);

		$this->load->view('header');
		$this->load->view('widget/lyrics', array('user' => $user, 'lyrics' => $line));
		$this->load->view('footer');
	}

	private function _get_lyrics()
	{
		return array(
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
			'那年夏天我和你躲在/这一大片宁静的海/直到后来我们都还在/对整个世界充满期待',
			'蓝色的思念/突然演变成了阳光的夏天/空气中的温暖/不会很遥远',
			'得到，你的爱情/还要再得到你任性/一切，原是注定/因我跟你都任性',
			'悲哀是真的/泪是假的/本来没因果/一百年后没有你也没有我',
			'每个人都是单行道上的跳蚤/每个人皈依自己的宗教/每个人都在单行道上寻找/没有人相信其实不用找',
			'我们是朋友/还可以问候/只是那种温柔/再也找不到拥抱的理由',
			'理想徘徊十字路口/不知道往哪边走/信心一路上低着头/数着脚下的石头',
			'我不是/你们想的如此完美/我承认/有时也会分不清真伪',
			'边走边爱/人山人海/拿着车票微笑着等待/而我从不站在关了灯的月台',
			'小孩在问她/为什么流泪/身边的男人/早已渐渐入睡',
			'奇就奇在/接受了各自有路走，却没人像你/让我眼泪背着流',
			'我走在/每天必须面对的分岔路/我怀念/过去单纯美好的小幸福',
			'如今这里荒草丛生/没有了鲜花，好在曾经拥有/你们的春秋和冬夏',
			'爱/熄灭了灯/心/围一座城',
		);
	}
}