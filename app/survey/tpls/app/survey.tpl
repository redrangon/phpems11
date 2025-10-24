{x2;include:header}
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pages">
			{x2;include:nav}
			<div class="content">
				<div class="col-xs-12">
					<div class="content-box padding">
						<h2 class="title">
							调查问卷
						</h2>
						<ul class="list-box list-unstyled padding">
							{x2;tree:$surveies['data'],survey,sid}
							<li class="col-xs-3 box" style="width: 20%">
								<a href="index.php?survey-app-survey-paper&svyid={x2;v:survey['svyid']}">
									<div class="img">
										<img src="{x2;if:v:survey['svythumb']}{x2;v:survey['svythumb']}{x2;else}app/core/styles/img/item.jpg{x2;endif}" />
									</div>
									<h5 class="box-title">{x2;v:survey['svytitle']}</h5>
									<div class="intro">
										<p>截止时间：{x2;date:v:survey['svyendtime'],'Y-m-d'}</p>
									</div>
								</a>
							</li>
							{x2;if:v:sid % 5 == 0}
						</ul>
						<ul class="list-box list-unstyled">
							{x2;endif}
							{x2;endtree}
						</ul>
						{x2;if:$surveies['pages']}
						<ul class="pagination pull-right">
							{x2;$surveies['pages']}
						</ul>
						{x2;endif}
					</div>
				</div>
			</div>
			{x2;include:footer}
		</div>
	</div>
</div>
</body>
</html>