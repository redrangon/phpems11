{x2;if:!$userhash}
{x2;include:header}
<body>
<div class="pages">
    {x2;endif}
	<div class="page-tabs">
		<div class="page-header">
			<div class="col-1" onclick="javascript:history.back();"><span class="fa fa-chevron-left"></span></div>
			<div class="col-8">{x2;substring:$ask['asktitle'],36}</div>
			<div class="col-1"></div>
		</div>
		<div class="page-content header">
			<div class="list-box bg">
				<ol>
					<li class="unstyled">
						<h4 class="title text-center">{x2;$ask['asktitle']}</h4>
					</li>
					<li class="unstyled">
						<div class="rows">
							{x2;realhtml:$ask['askcontent']}
						</div>
					</li>
					{x2;if:$ask['askisshow'] || $ask['askuserid'] == $_user['userid']}
					<li class="unstyled">
						<div class="rows">
							{x2;if:$ask['askstatus']}{x2;realhtml:$answer['asrcontent']}{x2;else}本问题尚未回答，请耐心等待。{x2;endif}
						</div>
					</li>
					{x2;else}
					<li class="unstyled">
						<div class="rows">
							本提问未经提问者允许，不能查看！
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