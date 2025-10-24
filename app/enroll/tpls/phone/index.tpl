{x2;if:!$userhash}
{x2;include:header}
<body>
<div class="pages">
	{x2;endif}
	<div class="page-tabs">
		<div class="page-header">
			<div class="col-1" onclick="javascript:history.back();"><span class="fa fa-chevron-left"></span></div>
			<div class="col-8">报名</div>
			<div class="col-1">
				<span class="fa"></span>
			</div>
		</div>
		<div class="page-content header{x2;if:$enbats['pages']} footer{x2;endif}">
			<div class="list-box bg">
				<ol>
					{x2;tree:$enbats['data'],enroll,eid}
					<li class="unstyled">
						<div class="col-4x">
							<div class="rows illus">
								<a href="index.php?enroll-phone-enroll&enbid={x2;v:enroll['enbid']}" class="ajax">
									<img src="{x2;v:enroll['enbthumb']}">
								</a>
							</div>
						</div>
						<div class="col-4l">
							<a href="index.php?enroll-phone-enroll&enbid={x2;v:enroll['enbid']}" class="ajax">
								<div class="rows info">
									<h5 class="title">{x2;v:enroll['enbname']}</h5>
									<p class="intro"><i class="fa fa-clock-four intro"></i> {x2;date:v:enroll['enbstarttime'],'Y-m-d'} ~ {x2;date:v:enroll['enbendtime'],'Y-m-d'}</p>
								</div>
							</a>
						</div>
					</li>
					{x2;endtree}
				</ol>
			</div>
		</div>
		{x2;if:$enbats['pages']}
		<div class="page-footer">
			<ul class="pagination">{x2;$enbats['pages']}</ul>
		</div>
		{x2;endif}
	</div>
    {x2;if:!$userhash}
</div>
</body>
</html>
{x2;endif}