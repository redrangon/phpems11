{x2;if:!$userhash}
{x2;include:header}
<body>
<div class="pages">
	{x2;endif}
	<div class="page-tabs">
		<div class="page-header">
			<div class="col-1" onclick="javascript:history.back();"><span class="fa fa-chevron-left"></span></div>
			<div class="col-8">{x2;$data['currentbasic']['basic']}</div>
			<div class="col-1"><span class="fa fa-menu hide"></span></div>
		</div>
		<div class="page-content header">
			<div class="list-box bg">
				<ol>
					<li class="unstyled">
						<div class="col-2">
							<div class="rows illus">
								<img src="files/public/img/zidong.png">
							</div>
						</div>
						<div class="col-8">
							<a href="index.php?exam-phone-record-records" class="ajax">
								<div class="rows info">
									<h5 class="title">逐题练习</h5>
									<p class="intro">刷题练习</p>
								</div>
							</a>
						</div>
					</li>
					<li class="unstyled">
						<div class="col-2">
							<div class="rows illus">
								<img src="files/public/img/mokao.png">
							</div>
						</div>
						<div class="col-8">
							<a href="index.php?exam-phone-record-papers" class="ajax">
								<div class="rows info">
									<h5 class="title">组卷练习</h5>
									<p class="intro">自由组卷 随机检测</p>
								</div>
							</a>
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