{x2;include:header}
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pages">
            {x2;include:nav}
			<div class="content">
				<div class="content-box padding">
					<h2 class="title">
						{x2;$enbat['enbname']}
						<a href="index.php?enroll-app-enroll&enbid={x2;$enbat['enbid']}" class="badge pull-right"> 返回 </a>
					</h2>
					<ul class="list-unstyled list-img">
						<li class="border morepadding">
							<div class="desc">
								<form action="index.php?enroll-app-enroll-add" method="post" class="form-horizontal">
									<fieldset>
										{x2;tree:$forms,form,fid}
										<div class="form-group">
											<div class="col-xs-3 text-right">
												{x2;v:form['title']}：
											</div>
											<div class="col-xs-6">
												{x2;v:form['html']}
											</div>
										</div>
										{x2;endtree}
										<div class="form-group">
											<div class="col-xs-3 text-right">
												签名：
											</div>
											<div class="col-xs-6">
												<div style="clear: both;">
													<canvas id="myCanvas" width="400" height="140" style="clear:both;color:#ff6000;background-color: #ffffff;border:1px solid #F2F2F2;"></canvas>
													<a class="btn btn-success btn-sm" onclick="javascript:clearArea();return false;" style="margin-bottom:30px;">重签</a>
												</div>
												<input type="hidden" name="args[enrollsign]" id="signature" value="" needle="needle" msg="请手绘签名"/>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-3"></label>
											<div class="col-sm-6">
												<button class="btn btn-primary" type="button" onclick="javascript:saveImageInfo();$(this).parents('form:first').submit();">提交</button>
												<input type="hidden" name="submit" value="1"/>
												<input type="hidden" name="page" value="{x2;$page}"/>
												<input type="hidden" name="enbid" value="{x2;$enbat['enbid']}"/>
												{x2;tree:$search,arg,aid}
												<input type="hidden" name="search[{x2;v:key}]" value="{x2;v:arg}"/>
												{x2;endtree}
											</div>
										</div>
									</fieldset>
								</form>
							</div>
						</li>
					</ul>
				</div>
			</div>
            {x2;include:footer}
		</div>
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
//			触摸屏
	c.addEventListener('touchstart', function (event) {
		if (event.targetTouches.length == 1) {
			event.preventDefault();// 阻止浏览器默认事件，重要
			var touch = event.targetTouches[0];
			mousePressed = true;
			Draw(touch.pageX - this.offsetLeft, touch.pageY - this.offsetTop, false);
		}

	},false);

	c.addEventListener('touchmove', function (event) {
		if (event.targetTouches.length == 1) {
			event.preventDefault();// 阻止浏览器默认事件，重要
			var touch = event.targetTouches[0];
			if (mousePressed) {
				Draw(touch.pageX - this.offsetLeft, touch.pageY - this.offsetTop, true);
			}
		}

	},false);

	c.addEventListener('touchend', function (event) {
		if (event.targetTouches.length == 1) {
			event.preventDefault();// 阻止浏览器默认事件，防止手写的时候拖动屏幕，重要
//      			var touch = event.targetTouches[0];
			mousePressed = false;
		}
	},false);
	/*c.addEventListener('touchcancel', function (event) {
		console.log(4)
		mousePressed = false;
	},false);*/



//鼠标
	c.onmousedown = function (event) {
		mousePressed = true;
		var l = $(this).parent().offset().left;
		var t = this.offsetTop + $(this).parent().offset().top;
		Draw(event.pageX - l, event.pageY - t, false);
	};

	c.onmousemove = function (event) {
		if (mousePressed) {
			var l = $(this).parent().offset().left;
			var t = this.offsetTop + $(this).parent().offset().top;
			Draw(event.pageX - l, event.pageY - t, true);
		}
	};

	c.onmouseup = function (event) {
		mousePressed = false;
	};
}

function Draw(x, y, isDown) {
	if (isDown) {
		ctx.beginPath();
		ctx.strokeStyle ='#000000'; //颜色
		ctx.lineWidth = 3;   //线宽
		ctx.lineJoin = "round";
		ctx.textBaseline = 'top';
		ctx.moveTo(lastX, lastY);
		ctx.lineTo(x, y);
		ctx.closePath();
		ctx.stroke();
	}
	lastX = x; lastY = y;
}

function clearArea() {
	ctx.setTransform(1, 0, 0, 1, 0, 0);
	ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
}
InitThis();
</script>
</body>
</html>