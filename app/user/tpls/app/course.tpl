{x2;include:header}
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pages">
            {x2;include:nav}
			<div class="content">
				<div class="col-xs-3" style="width: 20%">
					<div class="content-box padding">
                        {x2;include:menu}
					</div>
				</div>
				<div class="col-xs-9 nopadding" style="width: 80%">
					<div class="content-box padding">
						<h2 class="title">
                            我的课程
						</h2>
						<ul class="list-box list-unstyled">
							{x2;tree:$contents['data'],content,cid}
							<li class="col-xs-4 box">
								<a href="index.php?course-app-course&csid={x2;v:content['csid']}">
									<div class="img">
										<img src="{x2;if:v:content['csthumb']}{x2;v:content['csthumb']}{x2;else}app/core/styles/img/item.jpg{x2;endif}" />
									</div>
									<h5 class="box-title">{x2;v:content['cstitle']}</h5>
									<div class="intro">
										<p>{x2;v:content['csdescribe']}</p>
									</div>
								</a>
							</li>
							{x2;if:v:cid < count($contents['data']) && v:cid % 3 == 0}
						</ul>
						<ul class="list-box list-unstyled">
							{x2;endif}
							{x2;endtree}
						</ul>
					</div>
				</div>
			</div>
            {x2;include:footer}
		</div>
	</div>
</div>
</body>
</html>