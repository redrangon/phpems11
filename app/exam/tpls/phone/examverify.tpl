{x2;if:!$userhash}
{x2;include:header}
<body>
<div class="pages">
    {x2;endif}
	<div class="page-tabs">
		<div class="page-header">
			<div class="col-1" onclick="javascript:history.back();"><span class="fa fa-chevron-left"></span></div>
			<div class="col-8">正式考试</div>
			<div class="col-1"><a href="index.php?exam-phone-exam-history" class="ajax"><span class="fa fa-list"></span></a></div>
		</div>
		<div class="page-content header">
			<div class="list-box bg">
				<ol>
					<li>
						<span class="rows"><span class="intro">
						考场开启时间{x2;if:$data['currentbasic']['basicexam']['opentime']['start'] && $data['currentbasic']['basicexam']['opentime']['end']}
                        	{x2;date:$data['currentbasic']['basicexam']['opentime']['start'],'Y-m-d H:i'} - {x2;date:$data['currentbasic']['basicexam']['opentime']['end'],'Y-m-d H:i'}{x2;else}不限{x2;endif}&nbsp;&nbsp;
							限考次数 {x2;if:$data['currentbasic']['basicexam']['examnumber']}{x2;$data['currentbasic']['basicexam']['examnumber']}{x2;else}不限{x2;endif}
						</span></span>
					</li>
					<li><span class="rows"><span class="intro">点击考试名称或开始考试按钮进入答题界面，考试开始计时。</span></span></li>
					<li><span class="rows"><span class="intro">在考试过程中，您可以通过左下方的考试时间来掌握自己的做题时间。</span></span></li>
					<li><span class="rows"><span class="intro">系统自动记录考试的考试记录，学员考试结束后可在本页点击右上方进入“答题记录”进行查看。</span></span></li>
				</ol>
			</div>
			<div class="list-box bg top">
				<ol>
                    {x2;if:$intime}
                    {x2;if:$sessionvars}
					<li class="unstyled">
						<div class="rows info">
							<h5 class="title">意外续考</h5>
							<div class="intro">
								系统检测到您曾经在{x2;date:$sessionvars['examsessionstarttime'],'Y-m-d H:i:s'}开启了一场未完成的考试，试卷名称为《{x2;$sessionvars['examsession']}》，点击继续考试可以进行续考。
							</div>
							<div class="intro">
								<div class="col-3x"> 总分 {x2;$sessionvars['examsessionsetting']['examsetting']['score']} 分</div>
								<div class="col-3x"> 及格分 {x2;$sessionvars['examsessionsetting']['examsetting']['passscore']} 分</div>
								<div class="col-3x"> 限时 {x2;$sessionvars['examsessionsetting']['examsetting']['examtime']} 分钟</div>
							</div>
						</div>
					</li>
					<li class="unstyled">
						<div class="rows">
							<div class="col-5 text-center">
								<a class="btn primary ajax" action-before="clearStorage" href="index.php?exam-phone-recover&sessionid={x2;$sessionvars['examsessionid']}&token={x2;$token}">继续考试</a>
							</div>
							<div class="col-5 text-center">
								<a href="index.php?exam-phone-recover-clearexamsession&sessionid={x2;$sessionvars['examsessionid']}&token={x2;$token}" message="放弃考试会删除此次考试会话并不能恢复，确认要放弃吗？" class="btn confirm">放弃考试</a>
							</div>
						</div>
					</li>

					{x2;else}

                    {x2;if:$data['currentbasic']['basicexam']['selectrule']}
					<li class="unstyled">
						<div class="rows">
                            {x2;if:$data['currentbasic']['basicexam']['examnumber'] > 0 && $number['all'] >= $data['currentbasic']['basicexam']['examnumber']}
							<div class="text-center intro"><a class="btn" href="javascript:;">您的考试次数已经用完</a></div>
                            {x2;else}
							<div class="text-center intro"><a class="btn primary openvideo">开始考试</a></div>
                            {x2;endif}
						</div>
					</li>
                    {x2;else}
					{x2;tree:$exams['data'],exam,eid}
					<li class="unstyled">
						<a data-examid="{x2;v:exam['examid']}" class="openvideo">
							<div class="rows info">
								<h5 class="title">{x2;v:exam['exam']}</h5>
								<div class="intro">
									<div class="col-3x"> 总分 {x2;v:exam['examsetting']['score']} 分</div>
									<div class="col-3x"> 及格分 {x2;v:exam['examsetting']['passscore']} 分</div>
									<div class="col-3x"> 限时 {x2;v:exam['examsetting']['examtime']} 分钟</div>
								</div>
							</div>
						</a>
					</li>
                    {x2;endtree}
                    {x2;endif}
					{x2;endif}
					{x2;else}
					<li class="unstyled">
						<div class="rows text-center">
							<a class="btn danger">未在考试时间内，请等待管理员开启考试！</a>
						</div>
					</li>
					{x2;endif}
				</ol>
			</div>
		</div>
	</div>
	{x2;if:$isios}
	<div class="page-tabs">
		<div class="page-header">
			<div class="col-1" onclick="javascript:history.back();"><span class="fa fa-chevron-left"></span></div>
			<div class="col-8">正式考试</div>
			<div class="col-1"><a href="index.php?exam-phone-exam-history" class="ajax"><span class="fa fa-list"></span></a></div>
		</div>
		<div class="page-content header">
			<div class="list-box bg">
				<form action="index.php?exam-phone-exam-selectquestions" method="post" id="verifyform">
					<ul>
						<li class="text-center unstyled">
							
							<img src="" style="width:2.4rem;height:auto;min-height:1rem;" id="faceimg"/>
							<input name="photo" id="photo" type="hidden" value=""/>
							<input name="submit" type="hidden" value="1"/>
							<input name="examid" type="hidden" value="" id="videoexamid"/>
							
						</li>
						<li class="text-center unstyled">
							<button class="btn primary block" data-name="ps" type="button" id="tack">重新拍摄</button>
						</li>
						<li class="text-center unstyled">
							<button class="btn block" data-name="qx" id="cancelvideo" type="button">取消</button>
						</li>
					</ul>
				</form>
				<input type="file" id="faceimage" accept="image/*" capture="camera" style="display:none;" data-name="cam">
			</div>
		</div>
	</div>
	<script>
		$(function(){
			var faceimage  = $('#faceimage');
			var faceimg  = $('#faceimg');
			var img = new Image();
			var opencamera = function(){
				faceimage.trigger('click');
			}
			faceimage.on('change',function(){
				if(typeof FileReader == 'undefined')
				{
					alert('不支持本机型');
					return;
				}
				var reader = new FileReader();
				reader.readAsDataURL(faceimage[0].files[0]);
				reader.onload = function(){
					clearStorage();					
					img.src = this.result;					
				}
				img.onload = function(){
					var width = 240;
					var height = parseInt(width * this.height / this.width);
					var canvas = document.createElement('canvas');
					var context = canvas.getContext('2d');
					canvas.width = width;
					canvas.height = height;
					// 清除画布
					context.clearRect(0, 0, width, height);
					// 图片压缩
					context.drawImage(img, 0, 0, width, height);
					var result = canvas.toDataURL("image/png");
					$('#photo').val(result);
					faceimg.attr('src',result);
					pep.mask.show('loading');
					$('#verifyform').submit();
				}				
			});
			$('#tack').on('click', function(){
				opencamera();
			})
			$('.openvideo').on('click',function(){
				var _this = $(this);
				$('.page-tabs').toggle();
				$('#videoexamid').val(_this.data('examid'));
				opencamera();
			});
			$('#cancelvideo').on('click',function(){
				$('.page-tabs').toggle();
			});
		});
	</script>
	{x2;else}
	<div class="page-tabs">
		<div class="page-header">
			<div class="col-1" onclick="javascript:history.back();"><span class="fa fa-chevron-left"></span></div>
			<div class="col-8">正式考试</div>
			<div class="col-1"><a href="index.php?exam-phone-exam-history" class="ajax"><span class="fa fa-list"></span></a></div>
		</div>
		<div class="page-content header">
			<div class="list-box bg">
				<form action="index.php?exam-phone-exam-selectquestions" method="post" id="verifyform">
					<ul>
						<li class="text-center unstyled">
							
							<video class="img" id="video" width="300" height="240"></video>
							<canvas id="canvas" width="300" height="240" style="display: none;"></canvas>
							<input name="photo" id="photo"  type="hidden" value=""/>
							<input name="submit" type="hidden" value="1"/>
							<input name="examid" type="hidden" value="" id="videoexamid"/>
							
						</li>
						<li class="text-center unstyled">
							<button class="btn primary block" type="button" id="tack">拍摄并验证</button>
						</li>
						<li class="text-center unstyled">
							<button class="btn block" id="cancelvideo" type="button">取消</button>
						</li>
					</ul>
				</form>
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
				pep.mask.show('loading');
				clearStorage();
				canvas.getContext('2d').drawImage(video, 0, 0,300,240);
				$('#photo').val(canvas.toDataURL("image/png"));
				cams = null;
				$('#verifyform').submit();
			})
			$('.openvideo').on('click',function(){
				var _this = $(this);
				$('.page-tabs').toggle();
				$('#videoexamid').val(_this.data('examid'));
				video.play();
			});
			$('#cancelvideo').on('click',function(){
				video.pause();
				$('.page-tabs').toggle();
			});
		});
	</script>
	{x2;endif}
    {x2;if:!$userhash}
</div>
</body>
</html>
{x2;endif}