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
								<i class="fa-solid fa-marker examicon"></i>
							</div>
						</div>
						<div class="col-8">
							<a href="index.php?exam-phone-lesson" class="ajax">
								<div class="rows info">
									<h5 class="title">课后练习</h5>
									<p class="intro">逐个章节、知识点刷题练习</p>
								</div>
							</a>
						</div>
					</li>
					<li class="unstyled">
						<div class="col-2">
							<div class="rows illus">
								<i class="fa-solid fa-pen-ruler examicon"></i>
							</div>
						</div>
						<div class="col-8">
							<a href="index.php?exam-phone-exercise" class="ajax">
								<div class="rows info">
									<h5 class="title">强化训练</h5>
									<p class="intro">选择考试范围、题型、数量组卷练习</p>
								</div>
							</a>
						</div>
					</li>
					<li class="unstyled">
						<div class="col-2">
							<div class="rows illus">
								<i class="fa-solid fa-laptop-file examicon"></i>
							</div>
						</div>
						<div class="col-8">
							<a href="index.php?exam-phone-exampaper" class="ajax">
								<div class="rows info">
									<h5 class="title">模拟考试</h5>
									<p class="intro">仿真模拟考试，体验真实考试环境</p>
								</div>
							</a>
						</div>
					</li>
					<li class="unstyled">
						<div class="col-2">
							<div class="rows illus">
								<i class="fa-solid fa-record-vinyl examicon"></i>
							</div>
						</div>
						<div class="col-8">
							<a href="index.php?exam-phone-history" class="ajax">
								<div class="rows info">
									<h5 class="title">考试记录</h5>
									<p class="intro">强化训练、模拟和正式考试记录</p>
								</div>
							</a>
						</div>
					</li>
					<li class="unstyled">
						<div class="col-2">
							<div class="rows illus">
								<i class="fa-solid fa-flag examicon"></i>
							</div>
						</div>
						<div class="col-8">
							<a href="index.php?exam-phone-favor" class="ajax">
								<div class="rows info">
									<h5 class="title">收藏</h5>
									<p class="intro">试题收藏 便捷背题</p>
								</div>
							</a>
						</div>
					</li>
					<li class="unstyled">
						<div class="col-2">
							<div class="rows illus">
								<i class="fa-solid fa-bug examicon"></i>
							</div>
						</div>
						<div class="col-8">
							<a href="index.php?exam-phone-record" class="ajax">
								<div class="rows info">
									<h5 class="title">错题</h5>
									<p class="intro">错题练习 随机检测</p>
								</div>
							</a>
						</div>
					</li>
					<li class="unstyled">
						<div class="col-2">
							<div class="rows illus">
								<i class="fa-solid fa-chart-line examicon"></i>
							</div>
						</div>
						<div class="col-8">
							<a href="index.php?exam-phone-score" class="ajax">
								<div class="rows info">
									<h5 class="title">成绩单</h5>
									<p class="intro">本考场所有学员分数及排名</p>
								</div>
							</a>
						</div>
					</li>
					<li class="unstyled">
						<div class="col-2">
							<div class="rows illus">
								<i class="fa-solid fa-map-location examicon"></i>
							</div>
						</div>
						<div class="col-8">
							<a href="index.php?exam-phone-questions" class="ajax">
								<div class="rows info">
									<h5 class="title">试题搜索</h5>
									<p class="intro">试题搜索</p>
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