{x2;include:header}
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pages">
            {x2;include:coursenav}
			<div class="content">
				<div class="col-xs-9">
					<div class="content-box padding">
						<h2 class="title">
							{x2;$content['coursetitle']}
							<span class="badge pull-right"><span id="timer_h">00</span>：<span id="timer_m">00</span>：<span id="timer_s">00</span></span>
						</h2>
						<ul class="list-img list-unstyled">
							<li class="border padding">
								<div class="desc" id="pdfViewer"></div>
							</li>
							<li class="border padding">
								<div class="desc">
                                    {x2;realhtml:$content['coursedescribe']}
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-xs-3 nopadding">
					<div class="content-box padding">
						<h2 class="title">
                            {x2;$course['cstitle']}
						</h2>
						<ul class="list-unstyled list-txt courselist">
							{x2;include:coursemenu}
						</ul>
					</div>
				</div>
			</div>
            {x2;include:footer}
		</div>
	</div>
</div>
<script>
	$(function(){
		$('.coursedir').on('click',function(){
			var c = $('ul:first',$(this).parent()[0]);
			if(c.hasClass('hide'))
			{
				c.removeClass('hide');
				$(this).addClass('open');
			}
			else
			{
				c.addClass('hide');
				$(this).removeClass('open');
			}
		});
		$('.courseactive').parents('ul').each(function(){
			$(this).removeClass('hide');
			$(this).parent().find('>.coursedir').first().addClass('open');
		});
		$('[data-toggle="tooltip"]').tooltip();
        var pdf = $('<iframe src="index.php?course-app-course-pdfview&file={x2;$content['pdf_file']}" style="border:1px solid #999999;" frameborder="0" width="100%" height="720" border="0"></iframe>');
	    $('#pdfViewer').append(pdf);
        var setting = {
            time:5,
            hbox:$("#timer_h"),
            mbox:$("#timer_m"),
            sbox:$("#timer_s"),
            lefttime:0,
            finish:function(){
                $.get('index.php?course-app-course-endstatus&courseid={x2;$content['courseid']}&'+Math.random(),function(){
                    $("#timer_h").parent().html('学习完成!');
                });
            }
        }
        countdown(setting);
	})
</script>
</body>
</html>