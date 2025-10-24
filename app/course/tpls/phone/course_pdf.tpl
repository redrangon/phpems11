{x2;if:!$userhash}
{x2;include:header}
<body>
<div class="pages">
    {x2;endif}
	<div class="page-tabs">
		<div class="page-header">
			<div class="col-1" onclick="javascript:history.back();"><span class="fa fa-chevron-left"></span></div>
			<div class="col-8">{x2;$course['cstitle']}</div>
			<div class="col-1" id="pdf-menu">
				<span class="fa fa-list-ol"></span>
			</div>
		</div>
		<div class="page-content header{x2;if:!$logs[$content['courseid']]['logstatus']} footer{x2;endif}">
			<div id="pdfViewer" style="width: 100%;height: 100%;box-sizing: border-box;"></div>
		</div>
		<div class="page-content header hide{x2;if:!$logs[$content['courseid']]['logstatus']} footer{x2;endif}">
			<div class="list-box bg">
				<ul id="coursemenu">
					{x2;include:coursemenu}
				</ul>
			</div>
		</div>
        {x2;if:!$logs[$content['courseid']]['logstatus']}
		<div class="page-footer">
			<ol class="pagination">
				<li>
					<h2 class="text-center timer">
						<span id="pdf-timer_h">00</span>:<span id="pdf-timer_m">00</span>:<span id="pdf-timer_s">00</span>
					</h2>
				</li>
			</ol>
		</div>
        {x2;endif}
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
			var pdf = $('<iframe src="index.php?course-phone-course-pdfview&file={x2;$content['pdf_file']}" style="border:1px solid #999999;width:100%;height:100%" frameborder="0" border="0"></iframe>');
            $('#pdfViewer').append(pdf);
            {x2;if:!$logs[$content['courseid']]['logstatus']}
            var setting = {
                time:5,
                hbox:$("#pdf-timer_h"),
                mbox:$("#pdf-timer_m"),
                sbox:$("#pdf-timer_s"),
                lefttime:0,
                finish:function(){
                    $.get('index.php?course-phone-course-endstatus&courseid={x2;$content['courseid']}&'+Math.random(),function(){
                        $("#pdf-timer_h").parent().html('学习完成!');
                    });
                }
            }
            countdown(setting);
            {x2;endif}
			$('#pdf-menu').on('click',function(){
                $('.page-content').toggleClass('hide');
				$('#coursemenu').parents('.page-content:first').animate({scrollTop:$(".courseactive:first").offset().top},1000);
			});
            $('#videos-list').css('height',$(window).height() - $('.page-footer:first').height() - $('.page-header:first').height());
        })
	</script>
    {x2;if:!$userhash}
</div>
</body>
</html>
{x2;endif}