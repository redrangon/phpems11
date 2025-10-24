{x2;if:!$userhash}
{x2;include:header}
<body>
<div class="pages">
    {x2;endif}
	<div class="page-tabs">
		<div class="page-header">
			<div class="col-1" onclick="javascript:history.back();"><span class="fa fa-chevron-left"></span></div>
			<div class="col-8">调查问卷</div>
			<div class="col-1"><span class="fa fa-menu"></span></div>
		</div>
		<div class="page-content header{x2;if:$surveies['pages']} footer{x2;endif}">
			<div class="list-box bg">
				<ol>
					{x2;tree:$surveies['data'],survey,sid}
					<li class="unstyled">
						<div class="col-3">
							<div class="rows illus">
								<a href="index.php?survey-phone-survey-paper&svyid={x2;v:survey['svyid']}" class="ajax">
									<img src="{x2;if:v:survey['svythumb']}{x2;v:survey['svythumb']}{x2;else}files/public/img/login.jpg{x2;endif}" />
								</a>
							</div>
						</div>
						<div class="col-7">
							<a href="index.php?survey-phone-survey-paper&svyid={x2;v:survey['svyid']}" class="ajax">
								<div class="rows info">
									<h5 class="title">{x2;v:survey['svytitle']}</h5>
									<p class="intro">截止时间：{x2;date:v:survey['svyendtime'],'Y-m-d'}，本调查问卷<span class="text-danger">{x2;if:v:survey['svytype']}采取记名形式，每人仅限参与一次{x2;else}不记录个人信息，参与次数不限{x2;endif}</span></p>
								</div>
							</a>
						</div>
					</li>
					{x2;endif}
                </ol>
			</div>
		</div>
		{x2;if:$surveies['pages']}
		<div class="page-footer">
			<ul class="pagination">{x2;$surveies['pages']}</ul>
		</div>
		{x2;endif}
	</div>
    {x2;if:!$userhash}
</div>
</body>
</html>
{x2;endif}