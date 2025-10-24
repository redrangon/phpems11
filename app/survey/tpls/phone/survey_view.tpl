{x2;if:!$userhash}
{x2;include:header}
<body>
<div class="pages">
    {x2;endif}
	<div class="page-tabs" id="pagination">
		<div class="page-header">
			<div class="col-1" onclick="javascript:history.back();"><span class="fa fa-chevron-left"></span></div>
			<div class="col-8">调查问卷</div>
			<div class="col-1"><span class="fa fa-menu hide"></span></div>
		</div>
		<div class="page-content header" data-refresh="yes">
			<div class="list-box bg">
				<ol>
					{x2;if:$survey}
					<li class="unstyled">
						<div class="rows">
							<h3 class="title text-center">提交成功</h3>
							<p class="text-center more">您好！ 您的问卷已经提交成功，感谢您的参与。</p>
						</div>
					</li>
					{x2;else}
					<li class="unstyled">
						<div class="rows">
							<h3 class="title text-center text-danger">提交失败</h3>
							<p class="text-center text-danger more">您好！ 您的问卷提交失败，请稍后重试。</p>
						</div>
					</li>
					{x2;endif}
					<li class="unstyled">
						<div class="rows">
							<div class="col-3x text-center">&nbsp;</div>
							<div class="col-3x text-center">
								<a class="btn primary ajax" href="index.php?survey-phone">返回首页</a>
							</div>
							<div class="col-3x text-center">
								&nbsp;
							</div>
						</div>
					</li>
				</ol>
			</div>
		</div>
	</div>
    {x2;if:!$userhash}
</div>
</body>
</html>
{x2;endif}
