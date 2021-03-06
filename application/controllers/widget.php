<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widget extends CI_Controller {

	// private $user;

	public function __construct()
	{
	    parent::__construct();
	    // $this->user = $this->login->require_login();
	}

	public function lyrics()
	{
		// $user = $this->user;

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
		
		imagettftext($im, 12, 0, 380, 280, $text, $font, 'GRAD.CUHK.ME | 毕业纪念册');
		
		$time = time();
		imagepng($im, "./upload/lyrics/{$time}.png");
		imagedestroy($im);

		$this->load->view('header');
		$this->load->view('widget/lyrics', array('lyrics' => $line, 'file' => $time));
		$this->load->view('footer');
	}

	public function one()
	{
		// $user = $this->user;
		$this->load->view('header');
		$this->load->view('widget/one');
		$this->load->view('footer');
	}

	public function one_sentence()
	{
		// $user = $this->user;

		$im = imagecreatetruecolor(600, 300);
		$bg = imagecolorallocate($im, 255, 144, 0);
		imagefill($im, 0, 0, $bg);

		$text = imagecolorallocate($im, 255, 255, 255);
		$font = 'asset/font/wqy.ttc';
		$size = 30;
		$gap = 50;
		$length = 13;

		$sentence = $this->input->post('sentence');

		$lines = mb_strlen($sentence) / $length;

		for ($i = 0; $i < $lines; $i++)
		{
			imagettftext($im, $size, 0, 20, 50 + $i * $gap, $text, $font, mb_substr($sentence, $i * $length, $length));	
		}

		$time = time();

		imagettftext($im, 12, 0, 200, 280, $text, $font, 'GRAD.CUHK.ME | 毕业纪念册 - 一句话证明你读过中大');
		imagepng($im, "./upload/one_sentence/{$time}.png");
		imagedestroy($im);

		$user_id = $this->session->userdata('user_id');
		if (!empty($user_id))
		{
			$s = R::dispense('sentence');
			$s->text = $sentence;
			$s->user = R::load('user', $user_id);
			$s->created_at = time();
			R::store($s);	
		}
		
		$this->load->view('header');
		$this->load->view('widget/one_sentence', array('one_sentence' => $sentence, 'file' => $time));
		$this->load->view('footer');
	}

	public function regret()
	{
		// $user = $this->user;
		$this->load->view('header');
		$this->load->view('widget/regret');
		$this->load->view('footer');
	}

	public function regret_result()
	{
		// $user = $this->user;

		$im = imagecreatetruecolor(600, 300);
		$bg = imagecolorallocate($im, 0, 160, 200);
		imagefill($im, 0, 0, $bg);

		$text = imagecolorallocate($im, 255, 255, 255);
		$font = 'asset/font/wqy.ttc';
		$size = 30;
		$gap = 50;
		$length = 13;

		$sentence = $this->input->post('sentence');

		$lines = mb_strlen($sentence) / $length;

		for ($i = 0; $i < $lines; $i++)
		{
			imagettftext($im, $size, 0, 20, 50 + $i * $gap, $text, $font, mb_substr($sentence, $i * $length, $length));	
		}

		$time = time();

		imagettftext($im, 12, 0, 240, 280, $text, $font, 'GRAD.CUHK.ME | 毕业纪念册 - 大学遗憾的事情');
		imagepng($im, "./upload/one_sentence/{$time}.png");
		imagedestroy($im);

		$user_id = $this->session->userdata('user_id');
		if (!empty($user_id))
		{
			$s = R::dispense('regret');
			$s->text = $sentence;
			$s->user = R::load('user', $user_id);
			$s->created_at = time();
			R::store($s);	
		}
		
		$this->load->view('header');
		$this->load->view('widget/regret_result', array('one_sentence' => $sentence, 'file' => $time));
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
			'奇就奇在/接受了各自有路走/却没人像你/让我眼泪背着流',
			'我走在/每天必须面对的分岔路/我怀念/过去单纯美好的小幸福',
			'如今这里荒草丛生/没有了鲜花/好在曾经拥有/你们的春秋和冬夏',
			'爱/熄灭了灯/心/围一座城',
			'我们那么甜那么美那么相信/那么疯那么热烈的曾经/为何我们还是要奔向/各自的幸福和遗憾中老去',
			'伤心的都忘记了/只记得这首笑忘歌/那一年天空很高风很清澈/从头到脚趾都快乐',
			'在无声之中你拉起了我的手/我怎么感觉整个黑夜在震动/耳朵里我听到了心跳的节奏/星星在闪烁你会怎么说',
			'总要有一首我的歌/大声唱过再看天地辽阔/活着其实很好/再吃一颗苹果',
			'有时候只愿意/听你唱完一首歌/在所有人事已非的景色里/我最喜欢你',
			'我们要飞到那遥远地方/看一看这世界并非那么凄凉/我们要飞到那遥远地方望一望/这世界还是一片的光亮',
			'我不是一定要你回来/只是当独自走入人海/除了你之外的依赖/还有谁能教我勇敢',
			'闭上眼看 十六岁的夕阳/美得像我们一样/边走边唱 天真浪漫勇敢/以为能走到远方',
			'我没有说谎/我何必说谎/爱一个人/没爱到难道就会怎么样',
			'只在乎你偶尔的沉默/耳朵听见有暗潮汹涌/有没有什么心事要对我说/我已等候那么久',
			'快乐时你不用分心想起我/难过时请一定记得联络我/让我分享你的苦带走你的忧愁/我觉得这样也算拥有',
			'或许只有你懂得我/所以你没逃脱/一边在泪流一边紧抱我/小声地说多么爱我',
			'如果不能够永远走在一起/也至少给我们/怀念的勇气拥抱的权利/好让你明白我心动的痕迹',
			'有你的城市下雨也美丽/从黎明后的太阳 到深夜里的月光/别想了别想了/我不会喜欢你',
			'不忧愁的脸是我的少年/不仓惶的眼等岁月改变/最熟悉你我的街已是人去夕阳斜/人和人互相在街边道再见',
			'你走后/依旧的街总有青春依旧的歌/总有人/不断重演我们的事',
			'你说每当你回头看夕阳红/每当你又听到晚钟/从前的点点滴滴会涌起/在你来不及难过的心里',
			'我从没想过放弃/你说还要坚持下去/生命里不能忘记风雨过后的美丽/是那些清醒疼痛欢喜的回忆',
			'我爱上让我奋不顾身的一个人/我以为这就是我所追求的世界/然而横冲直撞被误解被骗/是否成人的世界背后总有残缺',
			'我走在每天必须面对的分岔路/我怀念过去单纯美好小幸福/爱总是让人哭让人觉得不满足/天空很大却看不清楚好孤独',
			'谁能体谅我的雨天/所以情愿回你身边/此刻脚步会慢一些/如此坚决你却越来越远',
			'我只想坚持每一步该走的方向/就算一路上偶而会沮丧/生活是自己选择的衣裳/幸福我要的幸福渐渐清楚',
			'可当初的我是那么快乐/虽然只有一把破木吉他/在街上在桥下在田野中/唱着那无人问津的歌谣',
			'那是我们/都不回去的从前/当你站在/那个夏天的海岸线',
			'想到达明天/现在就要启程/你能让我看见黑夜过去/天开始明亮的过程',
			'你是我的眼/带我领略四季的变换/你是我的眼/带我穿越拥挤的人潮',
			'却说不出你爱我的原因/却说不出你欣赏我哪一种表情/却说不出什么场合我曾让分心/说不出旅行的意义',
			'爱情不停站/想开往地老天荒/需要多勇敢/荡气回肠是为了最美的平凡',
			'我想是缘份哪里出差错/情歌才唱着不松口/我想是天份不够难掌握/唱不好的你爱我',
			'穿梭一段又另一段感情中/爱为何总填不满又掏不空/很快就风起云涌/人类的心是个无底洞',
			'想念变成一条线/在时间里面漫延/长得可以/把世界切成了两个面',
			'思念是一种很玄的东西/如影随形/无声又无息出没在心底/转眼吞没我在寂寞里',
			'我不唱声嘶力竭的情歌/不表示没有心碎的时刻/我不曾摊开伤口任宰割/愈合就无人晓得我内心挫折',
			'难离难舍/想抱紧些/茫茫人生/好像荒野',
			'爱是折磨人的东西/却又舍不得这样放弃/不停揣测/你的心里可有我姓名',
			'我遇见谁会有怎样的对白/我等的人他在多远的未来/我听见风来自地铁和人海/我排着队 拿着爱的号码牌',
			'有没有那么一首歌/会让你轻轻跟著和/牵动我们共同过去/记忆它不会沉没',
			'多少人曾爱慕你年轻时的容颜/可知谁愿承受岁月无情的变迁/多少人曾在你生命中来了又还/可知一生有你我都陪在你身边',
			'还记得年少时的梦吗/像朵永远不凋零的花/陪我经过那风吹雨打/看世事无常看沧桑变化',
			'任时光匆匆流去我只在乎你/心甘情愿感染你的气息/人生几何能够得到知己/失去生命的力量也不可惜',
			'嘿我要走了/昨天的对白已不再重要/我已见过最美的一幕/只是在此刻都要结束',
			'青春是挽不回的水/转眼消失在指间/用力的浪费/再用力的后悔',
			'就算是整个世界把我抛弃/而至少快乐伤心我自己决定/我知道潮落之后一定有潮起/有什么了不起',
			'来年陌生的/是昨日最亲的某某/总好于那日我没有/没有遇过某某',
			'你献出了十寸时和分/可有换到十寸金/卖了任性日拼夜拼/忘掉了为什么高兴',
			'留住温度 速度 温柔和愤怒/凝住今日怎样好/捉紧生命浓度 坦白流露 感情和态度/留下浮光 掠影飞舞',
			'我唱得不够动人你别皱眉/我愿意和你约定至死/我只想嬉戏唱游到下世纪/请你别嫌我将这煽情奉献给你',
			'而我已经分不清/你是友情/还是错过的爱情',
			'白杨木影子被拉长/像我对你的思念走不完/原来我从未习惯/你已不在我身旁',
			'天灰灰会不会让我忘了你是谁/夜越黑梦违背难追难回味/我的世界将被摧毁/也许事与愿违',
			'怎么了 你累了/说好的 幸福呢/我懂了 不说了/爱淡了 梦远了',
			'我要一步一步往上爬/在最高点乘着叶片往前飞/任风吹干流过的泪和汗/总有一天我有属于我的天',
			'故事的小黄花/从出生那天就飘着/童年的荡秋千/随记忆一直晃到现在',
			'我怕我没有机会/跟你说一声再见/因为也许就再也见不到你',
			'不管未来会怎么样/至少我们现在很开心/不管结局会怎么样/至少想念的人是你',
			'汲汲营营/忘记身边的人需要爱和关心/借口总是拉远了距离/不知不觉无声无息',
			'我是一个没勇气的人/带着小小年纪的天真/想你一定是不敢转身/脸上微笑 心舍不得',
			'我把爱铺成蓝天/让不安的你一抬头就看得见/我把心烧成火焰/让怕黑的你拥着温暖入眠',
			'等不到天黑/烟火不会太完美/回忆烧成灰/还是等不到结尾',
			'如果全世界我也可以放弃/至少还有你值得我去珍惜/而你在这里/就是生命的奇迹',
			'如果没有你 没有过去/我不会有伤心/但是有如果/还是要爱你',
			'你知道就算大雨让这座城市颠倒/我会给你怀抱/受不了看见你背影来到/写下我度秒如年难捱的离骚',
			'因为爱情不会轻易悲伤/所以一切都是幸福的模样/因为爱情简单的生长/依然随时可以为你疯狂',
			'原谅我这一生不羁放纵爱自由/也会怕有一天会跌堕/背弃了理想谁人都可以/哪会怕有一天只你共我',
			'如果不是你我不会相信/朋友比情人还死心塌地/就算我忙恋爱把你冷冻结冰/你也不会恨我只是骂我几句',
			'外面的世界很精彩/外面的世界很无奈/当你觉得外面的世界很精彩/我会在这里衷心地祝福你',
			'爱真的需要勇气/来面对流言蜚语/只要你一个眼神肯定/我的爱就有意义',
			'情人节就要来了/剩自己一个/其实爱对了人/情人节每天都过',
			'命运好幽默/让爱的人都沉默/一整个宇宙/换一颗红豆',
			'曾以为你是全世界/但那天已经好遥远/绕一圈/我才发现我有更远地平线',
			'每当情绪像海/你只抱我/从不催我讲出来/我就明白你是我的依赖',
			'幸福没有那么容易/才会特别让人着迷/什么都不懂的年纪/曾经最掏心所以最开心',
			'想你时你在天边/想你时你在眼前/想你时你在脑海/想你时你在心田',
			'你是心中的日月/落在这里/旅程的前后多余/只为遇到你',
			'生活像一把无情刻刀/改变了我们模样/未曾绽放就要枯萎吗/我有过梦想',
			'情人总分分合合/可是我们却越爱越深/认识你/让我的幸福如此悦耳',
			'你是我心内的一首歌/心间开启花一朵/你是我生命的一首歌/想念汇成一条河',
			'我就是我/是颜色不一样的烟火/天空开阔/要做最坚强的泡沫',
			'不用闪躲/为我喜欢的生活而活/不用粉墨/就站在光明的角落',
			'妹妹你坐船头/哥哥我岸上走/恩恩爱爱/纤绳荡悠悠',
			'让我们红尘做伴活得潇潇洒洒/策马奔腾共享人世繁华/对酒当歌唱出心中喜悦/轰轰烈烈把握青春年华',
			'头发甩甩大步地走开/不怜悯心底小小悲哀/挥手拜拜祝你们愉快/我会一个人活得精采',
			'如果你愿意一层一层一层地剥开我的心/你会鼻酸/你会流泪/只要你能听到我看到我的全心全意',
			'小小的人儿啊风生水起啊/天天就要穷开心啊/逍遥的魂儿啊假不正经吧/嘻嘻哈哈我们穷开心',
			'可是我有时候/宁愿选择留恋不放手/等到风景都看透/也许你会陪我看细水长流',
			'不是所有感情都会有始有终/孤独尽头不一定惶恐/可生命总免不了/最初的一阵痛',
			'有一个人/曾让我知道/寄生于世上/原是那么好',
			'一个人的时候不是不想你/一个人的时候只是怕想你/一个人的时候如果下起了雨/也会学你把伞丢到一边',
			'只怕我自己会爱上你/不敢让自己靠的太近/怕我没什么能够给你/爱你也需要很大的勇气',
			'乌溜溜的黑眼珠和你的笑脸/怎么也难忘记你容颜的转变/轻飘飘的旧时光就这么溜走/转头回去看看时已匆匆数年',
			'鲜花曾告诉我你怎样走过/大地知道你心中的每一个角落/甜蜜的梦啊谁都不会错过/终于迎来今天这欢聚时刻',
			'一见你就有好心情/不用暖身就会开心/因为眼睛耳朵都有了默契/你知道我有多么了解你',
			'前方的路虽然太凄迷/请在笑容里为我祝福/虽然迎着风虽然下着雨/我在风雨之中念着你',
			'若有缘/有缘就能期待明天/你和我/重逢在灿烂的季节'
		);
	}

	private function _get_love()
	{
		return array(
			'月上柳梢头，人约黄昏后。',
			'衣带渐宽终不悔，为伊消得人憔悴。',
			'死生契阔，与子成说。执子之手，与子偕老。',
			'有美人兮，见之不忘，一日不见兮，思之如狂。',
			'曾经沧海难为水，除却巫山不是云。',
			'还君明珠双泪垂，恨不相逢未嫁时。',
			'相见争如不见，有情何似无情。',
			'落红不是无情物，化作春泥更护花。',
			'此情可待成追忆，只是当时已惘然。',
			'相思一夜情多少，地角天涯未是长。',
			'身无彩凤双飞翼，心有灵犀一点通。',
			'在天愿作比翼鸟，在地愿为连理枝。',
			'他生莫作有情痴，人间无地著相思',
			'人生自是有情痴，此恨不关风与月。',
			'落花人独立，微雨燕双飞。',
			'一场寂寞凭谁诉。算前言，总轻负。',
			'鱼沈雁杳天涯路，始信人间别离苦。',
			'天涯地角有穷时，只有相思无尽处。',
			'滴不尽相思血泪抛红豆，开不完春柳春花满画楼。',
			'泪眼问花花不语，乱红飞过秋千去。',
			'多情只有春庭月，犹为离人照落花。',
			'夜月一帘幽梦，春风十里柔情。',
			'唯将终夜长开眼，报答平生未展眉。',
			'欲寄彩笺兼尺素，山长水阔知何处。',
			'离恨却如春草，更行更远还生。',
		);
	}
}