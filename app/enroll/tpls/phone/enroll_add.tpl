{x2;if:!$userhash}
{x2;include:header}
<body>
<div class="pages">
	{x2;endif}
	<div class="page-tabs">
		<div class="page-header">
			<div class="col-1" onclick="javascript:history.back();"><span class="fa fa-chevron-left"></span></div>
			<div class="col-8">报名信息</div>
			<div class="col-1">
				<span class="fa fa-menu"></span>
			</div>
		</div>
		<div class="page-content header footer">
			<div class="list-box bg">
				<ol>
					<li class="unstyled text-center">
						<h3>填写报名信息</h3>
					</li>
				</ol>
				<form action="index.php?enroll-app-enroll-add" method="post" class="form-horizontal nopadding" id="subform">
					{x2;tree:$forms,form,fid}
					<div class="form-group">
						<div class="col-3">{x2;v:form['title']}</div>
						<div class="col-7">{x2;v:form['html']}</div>
					</div>
					{x2;endtree}
					<div class="form-group">
						<div class="col-10">手写签名</div>
					</div>
					<div class="form-group">
						<div class="col-10">
							<div style="clear: both;">
								<canvas id="myCanvas" width="750" height="300" style="width:100%;clear:both;color:#ff6000;background-color: #fcfcfc;border:1px solid #EEEEEE;"></canvas>
								<div class="control-ops control">
									<button type="button" class="btn btn-primary block" onclick="javascript:clearArea();return false;">重新签名</button>
								</div>
							</div>
							<input type="hidden" name="args[enrollsign]" id="signature" value="" needle="needle" msg="请手绘签名"/>
						</div>
					</div>
					<div class="form-group">

						<input type="hidden" name="submit" value="1"/>
						<input type="hidden" name="page" value="{x2;$page}"/>
						<input type="hidden" name="enbid" value="{x2;$enbat['enbid']}"/>
						{x2;tree:$search,arg,aid}
						<input type="hidden" name="search[{x2;v:key}]" value="{x2;v:arg}"/>
						{x2;endtree}
					</div>
				</form>
			</div>
		</div>
		<div class="page-footer">
			<button class="subpaperbtn primary block" type="button" onclick="javascript:saveImageInfo();$('#subform').submit();">提交</button>
		</div>
	</div>
	<script>
		var image='';
		var mousePressed = false;
		var lastX, lastY;
		var c = document.getElementById("myCanvas");
		var ctx = c.getContext("2d");
		function saveImageInfo(){
			image = c.toDataURL("image/png"); //得到生成后的签名base64位  url 地址
			$('#signature').val(image);
		}
		function InitThis() {
			c.addEventListener('touchstart', function (event) {
				if (event.targetTouches.length == 1) {
					event.preventDefault();// 阻止浏览器默认事件，重要
					var touch = event.targetTouches[0];
					mousePressed = true;
					var l = $(this).parent().offset().left;
					var t = $(this).parent().offset().top;
					Draw(touch.pageX - l, touch.pageY - t, false);
				}

			},false);

			c.addEventListener('touchmove', function (event) {
				if (event.targetTouches.length == 1) {
					event.preventDefault();// 阻止浏览器默认事件，重要
					var touch = event.targetTouches[0];
					if (mousePressed) {
						var l = $(this).parent().offset().left;
						var t = $(this).parent().offset().top;
						Draw(touch.pageX - l, touch.pageY - t, true);
					}
				}
			},false);

			c.addEventListener('touchend', function (event) {
				if (event.targetTouches.length == 1) {
					event.preventDefault();// 阻止浏览器默认事件，防止手写的时候拖动屏幕，重要
					mousePressed = false;
				}
			},false);
		}
		function Draw(x, y, isDown) {
			if (isDown) {
				ctx.beginPath();
				ctx.strokeStyle ='#000000'; //颜色
				ctx.lineWidth = 3;   //线宽
				ctx.lineJoin = "round";
				ctx.moveTo(lastX, lastY);
				ctx.lineTo(x, y);
				ctx.closePath();
				ctx.stroke();
			}
			lastX = x; lastY = y;
			console.log({x:lastX,y:lastY});
		}
		function clearArea() {
			// Use the identity matrix while clearing the canvas
			ctx.setTransform(1, 0, 0, 1, 0, 0);
			ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
		}
		InitThis();
	</script>
	{x2;if:!$userhash}
</div>
</body>
</html>
{x2;endif}