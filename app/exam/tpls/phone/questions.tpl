{x2;if:!$userhash}
{x2;include:header}
<body>
<div class="pages">
    {x2;endif}
	<div class="page-tabs">
		<div class="page-header">
			<div class="col-1" onclick="javascript:history.back();"><span class="fa fa-chevron-left"></span></div>
			<div class="col-8">试题搜索</div>
			<div class="col-1"></div>
		</div>
		<div class="page-content header">
			<div class="list-box bg top">
				<ol>
					<li class="unstyled">
						<div class="col-2">
							<div class="rows illus">
								<i class="fa-solid fa-signature examicon"></i>
							</div>
						</div>
						<div class="col-8">
							<a href="index.php?exam-phone-questions-questions" class="ajax">
								<div class="rows info">
									<h5 class="title">普通试题</h5>
									<p class="intro">试题搜索 详情</p>
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
							<a href="index.php?exam-phone-questions-questionrows" class="ajax">
								<div class="rows info">
									<h5 class="title">题帽题</h5>
									<p class="intro">题帽题搜索 详情</p>
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