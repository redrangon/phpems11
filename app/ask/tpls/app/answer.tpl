{x2;include:header}
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pages">
            {x2;include:nav}
			<div class="content">
				<div class="content-box padding">
					<h2 class="title">
						{x2;$ask['asktitle']}
						<a href="index.php?ask-app" class="badge pull-right"> 返回 </a>
					</h2>
					<ul class="list-unstyled list-img" id="content">
						<li class="border morepadding">
							<div class="intro">
								<div class="desc">
									{x2;realhtml:$ask['askcontent']}
								</div>
							</div>
						</li>
						{x2;if:$ask['askisshow'] || $ask['askuserid'] == $_user['userid']}
						<li class="border morepadding">
							<div class="intro">
								<div class="desc">
									{x2;if:$ask['askstatus']}{x2;realhtml:$answer['asrcontent']}{x2;else}本问题尚未回答，请耐心等待。{x2;endif}
								</div>
							</div>
						</li>
						{x2;else}
						<li class="border morepadding">
							<div class="intro">
								<div class="desc">
									本提问未经提问者允许，不能查看！
								</div>
							</div>
						</li>
						{x2;endif}
						<li class="border morepadding">
							<div class="intro">
								<div class="desc">
									<div class="toolbar text-right">{x2;date:$ask['asktime'],'Y-m-d'}</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
            {x2;include:footer}
		</div>
	</div>
</div>
</body>
</html>