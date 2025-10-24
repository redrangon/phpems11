{x2;include:header}
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pages">
			{x2;include:nav}
			<div class="content">
				<div class="col-xs-12">
					<div class="content-box padding">
						<div class="reporttable">
							{x2;if:$survey}
							<div class="reportform text-center" style="padding: 15px;">
								<p><h2>提交成功</h2></p>
								<p style="font-size: 18px;padding:15px;">您好！ 您的问卷已经提交成功，感谢您的参与</p>
							</div>
							{x2;else}
							<div class="reportform text-center" style="padding: 15px;">
								<p><h2 class="text-danger">提交失败</h2></p>
								<p style="font-size: 18px;padding:15px;">您好！ 您的问卷提交失败，请稍后重试</p>
							</div>
							{x2;endif}
							<div class="reportform text-center">
								<ul class="list-unstyled list-inline">
									<li><a class="btn btn-danger" href="index.php">返回首页</a></li>
									<li><a class="btn btn-primary" href="index.php?survey-app-survey">继续参与</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			{x2;include:footer}
		</div>
	</div>
</div>
</body>
</html>