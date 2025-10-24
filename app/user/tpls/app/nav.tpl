<div class="topbar">
	<div class="topbar-box">
		<div class="col-xs-4">
			<ul class="list-unstyled list-inline">
				<li>
					<a href="" class="menu">
						新乡市落笔千言网络技术有限公司
					</a>
				</li>
			</ul>
		</div>
		<div class="col-xs-8">
			<ul class="list-unstyled list-inline text-right">
				{x2;if:$_user['userid']}
				<li>
                    <span class="menu">欢迎您，{x2;$_user['username']}</span>
				</li>
				<li>|</li>
				<li>
					<a href="index.php?user-app" class="menu">
						个人中心
					</a>
				</li>
				<li>|</li>
				<li>
					<a href="index.php?user-app-logout" class="menu ajax">
						退出
					</a>
				</li>
				{x2;else}
				<li>
					<a href="javascript:;" onclick="javascript:$.loginbox.show();" class="menu">
						登陆
					</a>
				</li>
				<li>|</li>
				<li>
					<a href="index.php?user-app-register" class="menu">
						注册
					</a>
				</li>
				<li>|</li>
				<li>
					<a href="index.php?user-app-register-findpassword" class="menu">
						忘记密码
					</a>
				</li>
				{x2;endif}
				<li>|</li>
				<li>
					<a href="" class="menu">
						联系我们
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="header">
	<div class="nav">
		<div class="col-xs-3">
			<h1 class="logo"><img src="files/public/img/logo.png" style="height:56px;"/></h1>
		</div>
		<div class="col-xs-9">
			<ul class="list-unstyled list-inline text-right">
                {x2;tree:$navs,nav,nid}
				<li>
					<a href="{x2;v:nav['navurl']}" class="menu">
                        {x2;v:nav['navtitle']}
					</a>
				</li>
                {x2;endtree}
			</ul>
		</div>
	</div>
</div>