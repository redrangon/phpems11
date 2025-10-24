{x2;include:header}
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pages">
            {x2;include:nav}
			<div class="content">
				<div class="col-xs-9">
					<div class="content-box padding">
						<h2 class="title">
							报名
						</h2>
						<ul class="list-unstyled list-box">
							{x2;tree:$enbats['data'],enroll,bid}
							<li class="col-xs-4 box">
								<a href="index.php?enroll-app-enroll&enbid={x2;v:enroll['enbid']}">
									<div class="img">
										<img src="{x2;if:v:enroll['enbthumb']}{x2;v:enroll['enbthumb']}{x2;else}files/public/img/paper.jpg{x2;endif}" />
									</div>
									<h5 class="box-title">{x2;v:enroll['enbname']}</h5>
									<div class="intro">
										<p>报名时间：{x2;date:v:enroll['enbstarttime'],'Y-m-d'} 至 {x2;date:v:enroll['enbendtime'],'Y-m-d'}</p>
									</div>
								</a>
							</li>
							{x2;if:v:bid < count($enbats['data']) && v:bid % 3 == 0}
						</ul>
						<ul class="list-box list-unstyled">
							{x2;endif}
							{x2;endtree}
						</ul>
						{x2;if:$enbats['pages']}
						<ul class="pagination pull-right">
							{x2;$enbats['pages']}
						</ul>
						{x2;endif}
					</div>
				</div>
				<div class="col-xs-3 nopadding">
					<div class="content-box padding">
						<h2 class="title">我的报名</h2>
						<ul class="list-unstyled list-img">
							{x2;tree:$myenrolls['data'],enroll,eid}
							<li class="border padding">
								<a href="index.php?enroll-app-enroll&enbid={x2;v:enroll['enbid']}">
									<div class="intro">
										<div class="col-xs-5 img noleftpadding">
											<img src="{x2;if:v:enroll['enbthumb']}{x2;v:enroll['enbthumb']}{x2;else}files/public/img/paper.jpg{x2;endif}" />
										</div>
										<div class="desc">
											<p>{x2;v:enroll['enbname']}</p>
										</div>
									</div>
								</a>
							</li>
							{x2;endtree}
						</ul>
					</div>
				</div>
			</div>

			{x2;include:footer}
		</div>
	</div>
</div>
</body>
</html>