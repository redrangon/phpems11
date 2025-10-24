{x2;include:header}
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pages">
            {x2;include:nav}
			<div class="content">
				<div class="col-xs-9">
					<div class="content-box padding">
						<h2 class="title">
							课程搜索
						</h2>
						<ul class="list-unstyled list-box">
							{x2;tree:$contents['data'],content,cid}
							<li class="col-xs-4 box">
								<a href="index.php?course-app-course&csid={x2;v:content['csid']}">
									<div class="img">
										<img src="{x2;if:v:content['csthumb']}{x2;v:content['csthumb']}{x2;else}app/core/styles/img/item.jpg{x2;endif}" />
									</div>
									<h5 class="box-title">{x2;v:content['cstitle']}</h5>
									<div class="intro">
										<p>{x2;substring:v:content['csdescribe'],78}</p>
									</div>
								</a>
							</li>
							{x2;if:v:cid < count(v:contents['data']) && v:cid % 3 == 0}
						</ul>
						<ul class="list-box list-unstyled">
							{x2;endif}
							{x2;endtree}
						</ul>
						{x2;if:$contents['pages']}
						<li class="border morepadding">
							<ul class="pagination pull-right">
								{x2;$contents['pages']}
							</ul>
						</li>
						{x2;endif}
					</div>
				</div>
				<div class="col-xs-3 nopadding">
					<div class="content-box padding">
						<form action="index.php" method="get" class="dxform">
							<input class="form-control pull-left" type="text" name="search[keyword]" placeholder="课程关键词" style="width: 75%;height: 40px;" value="{x2;$search['keyword']}" />
							<button class="btn btn-primary pull-left" type="submit" style="width:25%;">搜索</button>
							<input type="hidden" name="route" value="course-app-index-search">
						</form>
					</div>
					<div class="content-box padding">
						<h2 class="title">最新课程</h2>
						<ul class="list-unstyled list-img">
                            {x2;tree:$news,content,cid}
							<li class="border padding">
								<a href="index.php?course-app-course&csid={x2;v:content['csid']}">
									<div class="intro">
										<div class="col-xs-5 img noleftpadding">
											<img src="{x2;if:v:content['csthumb']}{x2;v:content['csthumb']}{x2;else}app/core/styles/img/item.jpg{x2;endif}" />
										</div>
										<div class="desc">
											<p>{x2;v:content['cstitle']}</p>
										</div>
									</div>
								</a>
							</li>
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