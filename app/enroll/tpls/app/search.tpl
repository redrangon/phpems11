{x2;include:header}
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pages">
            {x2;include:nav}
			<div class="content">
				<div class="content-box">
					<h2 class="bigtitle">报名搜索<span class="pull-right intro text-info">共搜索到 <span class="text-danger">{x2;$enbats['number']}</span> 个符合 <span class="text-danger">{x2;$search['keyword']}</span> 的报名信息</span></h2>
					<ul class="list-unstyled list-box">
						{x2;tree:$enbats['data'],enroll,bid}
						<li class="col-xs-3 course-box">
							<a href="index.php?enroll-app-enroll&enbid={x2;v:enroll['enbid']}">
								<div class="img">
									<img src="{x2;if:v:enroll['enbthumb']}{x2;v:enroll['enbthumb']}{x2;else}files/public/img/paper.jpg{x2;endif}" />
								</div>
								<h5 class="box-title">{x2;v:enroll['enbname']}</h5>
								<div class="intro">
									<p>报名费用：<span class="h4 text-danger">{x2;if:v:enroll['enbprice'] > 0.01}{x2;v:enroll['enbprice']}{x2;else}免费{x2;endif}</span></p>
									<p>报名时间：{x2;date:v:enroll['enbstarttime'],'Y-m-d H:i'} 至 {x2;date:v:enroll['enbendtime'],'Y-m-d H:i'}</p>
								</div>
							</a>
						</li>
						{x2;endtree}
						{x2;if:$enbats['pages']}
						<li class="border morepadding">
							<ul class="pagination pull-right">
								{x2;$enbats['pages']}
							</ul>
						</li>
						{x2;endif}
					</ul>
				</div>
			</div>
			{x2;include:footer}
		</div>
	</div>
</div>
</body>
</html>