{x2;if:!$userhash}
{x2;include:header}
<body>
<div class="pages">
    {x2;endif}
	<div class="page-tabs">
		<div class="page-header">
			<div class="col-1" onclick="javascript:history.back();"><span class="fa fa-chevron-left"></span></div>
			<div class="col-8">考试记录</div>
			<div class="col-1"></div>
		</div>
		<div class="page-content header{x2;if:$exams['pages']} footer{x2;endif}">
			<div class="list-box bg">
				<ol>
					<li class="unstyled">
						<div class="col-2">
							<div class="rows illus">
								<i class="fa-solid fa-signature examicon"></i>
							</div>
						</div>
						<div class="col-8">
							<a href="index.php?exam-phone-history-history" class="ajax">
								<div class="rows info">
									<h5 class="title">强化训练</h5>
									<p class="intro">考试记录 阅卷详情</p>
								</div>
							</a>
						</div>
					</li>
					<li class="unstyled">
						<div class="col-2">
							<div class="rows illus">
								<i class="fa-solid fa-envelope-open-text examicon"></i>
							</div>
						</div>
						<div class="col-8">
							<a href="index.php?exam-phone-history-history&ehtype=1" class="ajax">
								<div class="rows info">
									<h5 class="title">模拟考试</h5>
									<p class="intro">考试记录 阅卷详情</p>
								</div>
							</a>
						</div>
					</li>
					<li class="unstyled">
						<div class="col-2">
							<div class="rows illus">
								<i class="fa-solid fa-chalkboard examicon"></i>
							</div>
						</div>
						<div class="col-8">
							<a href="index.php?exam-phone-history-history&ehtype=2" class="ajax">
								<div class="rows info">
									<h5 class="title">正式考试</h5>
									<p class="intro">考试记录 阅卷详情</p>
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