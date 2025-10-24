{x2;include:header}
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pages fixtop">
			{x2;include:examnav}
			<div class="content">
				<div class="col-xs-12">
					<div class="content-box padding">
						<h2 class="title">
							正式考试
							<a href="index.php?exam-app-exam-history" class="badge pull-right">考试记录</a>
						</h2>
						<ul class="list-unstyled list-img">
							<li class="border padding">
								<div class="intro">
									<ul class="list-unstyled list-img">
										<li><p>本考场开启时间 {x2;if:$data['currentbasic']['basicexam']['opentime']['start'] && $data['currentbasic']['basicexam']['opentime']['end']}{x2;date:$data['currentbasic']['basicexam']['opentime']['start'],'Y-m-d H:i:s'} - {x2;date:$data['currentbasic']['basicexam']['opentime']['end'],'Y-m-d H:i:s'}{x2;else}不限{x2;endif} ； 考试次数 {x2;if:$data['currentbasic']['basicexam']['examnumber']}{x2;$data['currentbasic']['basicexam']['examnumber']}{x2;else}不限{x2;endif} ； 抽卷规则 {x2;if:$data['currentbasic']['basicexam']['selectrule']}系统随机抽卷{x2;else}用户手选试卷{x2;endif}。</p>
										</li>
										<li><b>1、</b>点击考试名称按钮进入答题界面，考试开始计时。</li>
										<li><b>2、</b>在随机考试过程中，您可以通过顶部的考试时间来掌握自己的做题时间。</li>
										<li><b>3、</b>提交试卷后，可以通过“查看答案和解析”功能进行总结学习。</li>
										<li><b>4、</b>系统自动记录模拟考试的考试记录，学员考试结束后可以进入“答题记录”功能进行查看。</li>
									</ul>
								</div>
							</li>
							{x2;if:$intime}
							{x2;if:$sessionvars}
							<li class="border padding">
								<h4 class="shorttitle">意外续考</h4>
								<div class="intro">
									<div class="desc">
										<p>系统检测到您曾经在{x2;date:$sessionvars['examsessionstarttime'],'Y-m-d H:i:s'}开启了一场未完成的考试，试卷名称为《{x2;$sessionvars['examsession']}》，点击继续考试可以进行续考。</p>
										<p class="toolbar">
											<a class="badge">总分：{x2;$sessionvars['examsessionsetting']['examsetting']['score']} 分</a>
											<a class="badge">及格分：{x2;$sessionvars['examsessionsetting']['examsetting']['passscore']} 分</a>
											<a class="badge">时间：{x2;$sessionvars['examsessionsetting']['examsetting']['examtime']} 分钟</a>
										</p>
										<div class="toolbar">
											<div class="pull-right more">
												<a href="index.php?exam-app-recover&sessionid={x2;$sessionvars['examsessionid']}&token={x2;$token}" class="btn btn-primary ajax">继续考试</a>&nbsp;&nbsp;
												<a href="index.php?exam-app-recover-clearexamsession&sessionid={x2;$sessionvars['examsessionid']}&token={x2;$token}" class="btn btn-danger confirm" msg="放弃考试会删除此次考试会话并不能恢复，确认要放弃吗？">放弃考试</a>
											</div>
										</div>
									</div>
								</div>
							</li>
							{x2;else}
							{x2;if:$data['currentbasic']['basicexam']['selectrule']}
							<li class="border padding">
								<div class="intro">
									{x2;if:$data['currentbasic']['basicexam']['examnumber'] > 0 && $number['all'] >= $data['currentbasic']['basicexam']['examnumber']}
									<div class="text-center"><a class="btn" href="javascript:;">您的考试次数已经用完</a></div>
									{x2;else}
									{x2;if:$data['currentbasic']['basicexam']['faceverify']}
									<div class="text-center"><a class="ajax btn btn-primary openvideo" data-examid="{x2;v:exam['examid']}">开始考试</a></div>
									{x2;else}
									<div class="text-center"><a action-before="clearStorage" href="index.php?exam-app-exam-selectquestions&examid={x2;v:exam['examid']}" class="ajax btn btn-info">开始考试</a></div>
									{x2;endif}
									{x2;endif}
								</div>
							</li>
							{x2;else}
							{x2;tree:$exams['data'],exam,eid}
							<li class="border padding">
								<h4 class="shorttitle">{x2;v:exam['exam']}</h4>
								<div class="intro">
									<div class="desc">
										<p class="toolbar">
											<a class="badge">总分：{x2;v:exam['examsetting']['score']} 分</a>
											<a class="badge">及格分：{x2;v:exam['examsetting']['passscore']} 分</a>
											<a class="badge">时间：{x2;v:exam['examsetting']['examtime']} 分钟</a>
										</p>
										<p class="toolbar">
											{x2;if:$data['currentbasic']['basicexam']['examnumber'] > 0 && $number['child'][v:exam['examid']] >= $data['currentbasic']['basicexam']['examnumber']}
											<a class="btn btn-primary pull-right more" href="javascript:;">您的考试次数已经用完</a>
											{x2;else}
											{x2;if:$data['currentbasic']['basicexam']['faceverify']}
											<a data-examid="{x2;v:exam['examid']}" class="btn btn-info pull-right more openvideo">开始考试</a>
											{x2;else}
											<a action-before="clearStorage" href="index.php?exam-app-exam-selectquestions&examid={x2;v:exam['examid']}" class="ajax btn btn-info pull-right more">开始考试</a>
											{x2;endif}
											{x2;endif}
										</p>
									</div>
								</div>
							</li>
							{x2;endtree}
							{x2;endif}
							{x2;endif}
							{x2;else}
							<li class="border padding">
								<div class="alert alert-success text-center">
									目前不在考试时间范围内，请等待考试开始！
								</div>
							</li>
							{x2;endif}
						</ul>
					</div>
				</div>
			</div>
			{x2;include:footer}
		</div>
	</div>
</div>
<div id="modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" class="close" type="button" data-dismiss="modal">×</button>
				<h4 id="myModalLabel">
					考生验证
				</h4>
			</div>
			<div class="modal-body text-center" id="modal-body">
				<form action="index.php?exam-app-exam-selectquestions" method="post" id="verifyform">
					<video class="img" id="video" width="360" height="270"></video>
					<canvas id="canvas" width="360" height="270" style="display: none;"></canvas>
					<input name="photo" id="photo"  type="hidden" value=""/>
					<input name="submit" type="hidden" value="1"/>
					<input name="examid" type="hidden" value="" id="videoexamid"/>
				</form>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" id="tack">拍摄并验证</button>
				<button aria-hidden="true" class="btn btn-default" data-dismiss="modal" id="cancelvideo">取消</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(function(){
		var video = document.getElementById('video'),
				canvas = document.getElementById('canvas'),
				snap = document.getElementById('tack'),
				vendorUrl = window.URL || window.webkitURL;

		//媒体对象
		function getUserMedia(obj,success,error){
			if(navigator.getUserMedia){
				getUserMedia = function(obj,success,error){
					navigator.getUserMedia(obj,function(stream){
						success(stream);
					},error);
				}
			}else if(navigator.webkitGetUserMedia){
				getUserMedia=function(obj,success,error){
					navigator.webkitGetUserMedia(obj,function(stream){
						var _URL=window.URL || window.webkitURL;
						success(_URL.createObjectURL(stream));
					},error);
				}
			}else if(navigator.mozGetUserMedia){
				getUserMedia = function(obj,success,error){
					navigator.mozGetUserMedia(obj,function(stream){
						success(window.URL.createObjectURL(stream));
					},error);
				}
			}else{
				return false;
			}
			return getUserMedia(obj,success,error);
		}
		var cams = getUserMedia({
			video: {facingModel:'user'}, //使用摄像头对象
			audio: false  //不适用音频
		}, function(stream){
			console.log(stream.getTracks());
			if ("srcObject" in video) {
				video.srcObject = stream
			} else {
				video.src = window.URL && window.URL.createObjectURL(stream) || stream
			}
			//video.play();
		}, function(error) {
			console.log(error);
		});
		snap.addEventListener('click', function(){
			$('#modal').modal('hide');
			$.zoombox.show('ajaxOK',{message:'正在验证！如果长时间无响应，请关闭重新验证！'});
			clearStorage();
			canvas.getContext('2d').drawImage(video, 0, 0, 360, 270);
			$('#photo').val(canvas.toDataURL("image/png"));
			$('#verifyform').submit();
		})
		$('.openvideo').on('click',function(){
			var _this = $(this);
			$('#modal').modal();
			$('#videoexamid').val(_this.data('examid'));
			video.play();
		});
		$('#cancelvideo').on('click',function(){
			video.pause();
		});
	});
</script>
</body>
</html>