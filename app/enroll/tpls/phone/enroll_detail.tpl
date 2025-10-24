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

			</div>
		</div>
		<div class="page-content header {x2;if:!$enroll['enrollverify']}footer{x2;endif}">
			<div class="list-box bg">
				<ol>
					<li class="unstyled text-center">
						{x2;if:$enroll['enrollverify'] == 2}<span class="text-success">报名已通过审核</span>{x2;elseif:$enroll['enrollverify'] == 1}<span class="text-warning">报名信息审核中</span>{x2;else}<span class="text-danger">报名未通过</span>{x2;endif}
					</li>
				</ol>
			</div>
			<div class="list-box bg top">
				<ol>
					<li class="unstyled">
						<div class="col-2">报名项目</div>
						<div class="col-8 intro text-right">{x2;$enbat['enbname']}</div>
					</li>
					{x2;tree:$forms,form,fid}
					<li class="unstyled">
						<div class="col-2">{x2;v:form['title']}</div>
						<div class="col-8 intro text-right">{x2;v:form['value']}</div>
					</li>
					{x2;endtree}
					<li class="unstyled">
						<div class="col-2">签名</div>
						<div class="col-8 intro text-right"><img src="{x2;$enroll['enrollsign']}"></div>
					</li>
				</ol>
			</div>
		</div>
		{x2;if:!$enroll['enrollverify']}
		<div class="page-footer">
			<a class="subpaperbtn block primary ajax" href="index.php?enroll-phone-enroll-modify&enrollid={x2;$enroll['enrollid']}" style="padding-left: 0.25rem;padding-right: 0.25rem;">编辑报名信息</a>
		</div>
		{x2;endif}
	</div>
    {x2;if:!$userhash}
</div>
</body>
</html>
{x2;endif}