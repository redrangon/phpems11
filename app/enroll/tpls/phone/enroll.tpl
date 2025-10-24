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
			<img src="{x2;$enbat['enbthumb']}" width="100%">
			<div class="list-box bg">
				<ol>
					<li class="unstyled">
						<h4 class="title">{x2;$enbat['enbname']}</h4>
						<p>报名时间：{x2;date:$enbat['enbstarttime'],'Y-m-d'} ~ {x2;date:$enbat['enbendtime'],'Y-m-d'}</p>
					</li>
					<li class="unstyled">
						<div>
							{x2;realhtml:$enbat['enbintro']}
						</div>
					</li>
				</ol>
			</div>
		</div>
		<div class="page-footer">
			{x2;if:$enroll}
				{x2;if:$enroll['enrollverify'] == 2}
				<a class="subpaperbtn block primary ajax" href="index.php?enroll-phone-enroll-detail&enrollid={x2;$enroll['enrollid']}" style="padding-left: 0.25rem;padding-right: 0.25rem;">报名已通过，点击查看报名信息</a>
				{x2;elseif:$enroll['enrollverify'] == 1}
				<a class="subpaperbtn block primary ajax" href="index.php?enroll-phone-enroll-detail&enrollid={x2;$enroll['enrollid']}" style="padding-left: 0.25rem;padding-right: 0.25rem;">审核中，点击查看报名信息</a>
				{x2;else}
				<a class="subpaperbtn block primary ajax" href="index.php?enroll-phone-enroll-modify&enrollid={x2;$enroll['enrollid']}" style="padding-left: 0.25rem;padding-right: 0.25rem;">未通过，点击编辑报名信息</a>
				{x2;endif}
			{x2;else}
				{x2;if:TIME >= $enbat['enbstarttime'] && TIME <= $enbat['enbendtime']}
				<a class="subpaperbtn block primary ajax" href="index.php?enroll-phone-enroll-add&enbid={x2;$enbat['enbid']}" style="padding-left: 0.25rem;padding-right: 0.25rem;">立即报名</a>
				{x2;else}
				未到报名时间或报名已结束
				{x2;endif}
			{x2;endif}
		</div>
	</div>
    {x2;if:!$userhash}
</div>
</body>
</html>
{x2;endif}