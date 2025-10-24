{x2;include:header}
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pages">
			{x2;include:nav}
			<div class="content">
				<div class="col-xs-9">
					<div class="content-box padding">
						<div class="col-xs-5">
							<img src="{x2;$enbat['enbthumb']}" width="100%" height="255">
						</div>
						<div class="col-xs-7" style="position: relative;height: 255px;">
							<h4 class="shorttitle" style="padding:10px 0;">{x2;$enbat['enbname']}</h4>
							<p>报名时间：{x2;date:$enbat['enbstarttime'],'Y-m-d H:i'} 至 {x2;date:$enbat['enbendtime'],'Y-m-d H:i'}</p>
							{x2;if:$enroll}
							<p>
								{x2;if:$enroll['enrollverify'] == 2}
								<span class="text-success">报名信息已通过审核</span>
								{x2;elseif:$enroll['enrollverify'] == 1}
								<span class="text-warning">报名信息审核中</span>
								{x2;else}
								<span class="text-danger">报名信息未通过审核，请编辑后重新提交</span>
								{x2;endif}
							</p>
							{x2;endif}
							<div style="position: absolute;bottom:5px;">
								<p>
									{x2;if:$enroll}
									{x2;if:$enroll['enrollverify'] >= 1}
									<a class="btn btn-primary" href="index.php?enroll-app-enroll-detail&enrollid={x2;$enroll['enrollid']}">查看报名信息</a>
									{x2;else}
									<a class="btn btn-primary" href="index.php?enroll-app-enroll-modify&enrollid={x2;$enroll['enrollid']}">编辑报名信息</a>
									{x2;endif}
									{x2;else}
									{x2;if:TIME >= $enbat['enbstarttime'] && TIME <= $enbat['enbendtime']}
									<a class="btn btn-primary" href="index.php?enroll-app-enroll-add&enbid={x2;$enbat['enbid']}">立即报名</a>
									{x2;else}
									<span class="alert alert-danger">未到报名时间或报名已结束</span>
									{x2;endif}
									{x2;endif}
								</p>
							</div>
						</div>
					</div>
					<div class="content-box padding">
						<h2 class="title">报名须知</h2>
						<ul class="list-unstyled list-img">
							<li class="border morepadding">
								{x2;realhtml:$enbat['enbintro']}
							</li>
						</ul>
					</div>
				</div>
				<div class="col-xs-3">
					<div class="content-box padding">
						<h2 class="title">最新报名</h2>
						<ul class="list-unstyled list-img">
							{x2;tree:$enbats['data'],enroll,eid}
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