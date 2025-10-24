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
		<div class="page-content header">
			<div id="videoPlayer" data-id="{x2;$content['courseid']}" style="width: 100%;"></div>
			<div class="list-box bg" id="videos-list" style="overflow-y: scroll">
				<ol>
					<li class="unstyled">
						<h4 class="title">课件简介</h4>
					</li>
					<li class="unstyled">
						{x2;realhtml:$content['coursedescribe']}
					</li>
				</ol>
			</div>
		</div>
		<div class="page-content header hide">
			<div class="list-box bg">
				<ul id="coursemenu">
					{x2;include:coursemenu}
				</ul>
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
		$('#pdf-menu').on('click',function(){
			$('.page-content').toggleClass('hide');
			$('#coursemenu').parents('.page-content:first').animate({scrollTop:$(".courseactive:first").offset().top},1000);
		});
		clearInterval(pep.recordVideo);
		$('#videoPlayer').html('');
		var options = {
			source:'{x2;$content['course_files']}',
			poster:'{x2;$course['csthumb']}',
			controls:true,
			loop:false,
			volume:1,
			width:window.screen.width + 'px',
			height:window.screen.width * 0.56 + 'px',
			language:'zh-CN',
			disablePictureInPicture:true,
			children:{
				"mediaLoader":true,
				"posterImage":true,
				"titleBar":true,
				"textTrackDisplay":true,
				"loadingSpinner":true,
				"bigPlayButton":true,
				"liveTracker":true,
				"controlBar":{
					progressControl:true
				},
				"errorDisplay":true,
				"textTrackSettings":true,
				"resizeManager":true
			}
		};
		var source = document.createElement('source');
		source.setAttribute('src',options.source);
		var video = document.createElement('video');
		video.setAttribute('class', "video-js vjs-default-skin");
		video.setAttribute('webkit-playsinline', 'true');
		video.setAttribute('playsinline', 'true');
		video.appendChild(source);
		document.getElementById('videoPlayer').appendChild(video);
		var player = videojs(video,options);
		{x2;if:$logs[$content['courseid']]['logprogress']}
		player.currentTime({x2;$logs[$content['courseid']]['logprogress']});
		{x2;endif}
		{x2;if:$course['csprogress']}
		var ctime = 0;
		var stime = 0;
		player.on('timeupdate',function(){
			var time = parseInt(player.currentTime());
			ctime = time;
			if(stime == 0)
			{
				stime = ctime;
			}
			else
			{
				if(ctime - stime > 1 || ctime - stime < -1)
				{
					player.currentTime(stime);
					return ;
				}
				else
				{
					stime = ctime;
				}
			}
		})
		{x2;endif}
		pep.recordVideo = setInterval(function(){
			$.get('index.php?course-phone-course-recordtime&courseid={x2;$content['courseid']}&time='+player.currentTime()+'&userhash='+Math.random());
		},20000);
		player.on('ended',function(){
			$.get('index.php?course-phone-course-endstatus&courseid={x2;$content['courseid']}&'+Math.random(),function(){
				window.location.reload();
			});
		})
        pep.allowpre = true;
	});
	</script>
    {x2;if:!$userhash}
</div>
</body>
</html>
{x2;endif}