{x2;if:!$userhash}
{x2;include:header}
<body>
<div class="pages">
	{x2;endif}
	<div class="page-tabs">
		<div class="page-header">
			<div class="col-1" onclick="javascript:history.back();"><span class="fa fa-chevron-left"></span></div>
			<div class="col-8">个人中心</div>
			<div class="col-1"></div>
		</div>
		<div class="page-content header footer">
			<div class="list-box bg">
				<ol>
					{x2;if:$_user['userid']}
					<li class="unstyled">
						<div class="col-4">
							<div class="rows illus">
								<img src="{x2;if:$_user['userphoto']}{x2;$_user['userphoto']}{x2;else}files/public/img/paper.jpg{x2;endif}"/>
							</div>
						</div>
						<div class="col-6">
							<div class="rows info">
								<h5 class="title">{x2;$_user['username']}</h5>
								<p class="intro">手机号：{x2;$_user['userphone']}</p>
								<p class="intro">积分：{x2;$_user['usercoin']}</p>
							</div>
						</div>
					</li>
					{x2;else}
					<li class="unstyled">
						<div class="rows text-center">
							<a class="ajax btn primary bigpadding" href="index.php?user-phone-login"> 登录注册 </a>
						</div>
					</li>
					{x2;endif}
				</ol>
			</div>
			<div class="list-box bg top">
				<ol>
					<li class="unstyled">
						<a href="index.php?user-phone-verify" class="ajax">
							<div class="rows info">
								实名认证
								<span class="pull-right"><em class="fa fa-chevron-right iconmenu"></em></span>
							</div>
						</a>
					</li>
					<li class="unstyled">
						<a href="index.php?user-phone-course" class="ajax">
							<div class="rows info">
								我的课程
								<span class="pull-right"><em class="fa fa-chevron-right iconmenu"></em></span>
							</div>
						</a>
					</li>
					<li class="unstyled">
						<a href="index.php?user-phone-exam" class="ajax">
							<div class="rows info">
								我的考场
								<span class="pull-right"><em class="fa fa-chevron-right iconmenu"></em></span>
							</div>
						</a>
					</li>
					<li class="unstyled">
						<a href="index.php?user-phone-payfor" class="ajax">
							<div class="rows info">
								积分充值
								<span class="pull-right"><em class="fa fa-chevron-right iconmenu"></em></span>
							</div>
						</a>
					</li>
					<li class="unstyled">
						<a href="index.php?user-phone-payfor-orders" class="ajax">
							<div class="rows info">
								我的订单
								<span class="pull-right"><em class="fa fa-chevron-right iconmenu"></em></span>
							</div>
						</a>
					</li>
					{x2;if:$_user['usergroupid'] == 1}
					<li class="unstyled">
						<a href="index.php?user-phone-payfor-gomorder" class="ajax">
							<div class="rows info">
								管理订单
								<span class="pull-right"><em class="fa fa-chevron-right iconmenu"></em></span>
							</div>
						</a>
					</li>
					{x2;endif}
					<li class="unstyled">
						<a href="index.php?user-phone-privatement-modifypass" class="ajax">
							<div class="rows info">
								修改密码
								<span class="pull-right"><em class="fa fa-chevron-right iconmenu"></em></span>
							</div>
						</a>
					</li>
					{x2;if:$_user['useropenid'] && USEWX && v:this->ev->isWeixin()}
					<li class="unstyled">
						<a href="index.php?user-phone-privatement-unbind" class="ajax">
							<div class="rows info">
								解除微信绑定并退出
								<span class="pull-right"><em class="fa fa-chevron-right iconmenu"></em></span>
							</div>
						</a>
					</li>
					{x2;endif}
					{x2;if:$_user['userid']}
					<li class="unstyled">
						<div class="rows text-center">
							<a class="ajax btn primary" href="index.php?user-phone-logout"> 安全退出 </a>
						</div>
					</li>
					{x2;endif}
				</ol>
			</div>
		</div>
	</div>
	{x2;if:!$userhash}
</div>
</body>
</html>
{x2;endif}