	<div id="back-to-top" class="btn"><i class="icon-arrow-up"></i>返回顶部</div>
	</div>
	<script type="text/javascript">
	$(function() {
		$(window).scroll(function() {
			if($(this).scrollTop() != 0) {
				$('#back-to-top').fadeIn();	
			} else {
				$('#back-to-top').fadeOut();
			}
		});
	 
		$('#back-to-top').click(function() {
			$('body,html').animate({scrollTop:0},500);
		});	
	});
	</script>
</body>
</html>