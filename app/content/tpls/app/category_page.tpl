{x2;include:header}
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pages">
			{x2;include:nav}
			<div class="content">
				<div class="col-xs-12">
					<div class="content-box">
						<ol class="breadcrumb">
							<li><a href="index.php?item">首页</a></li>
							{x2;tree:$catbread,cb,cbid}
							<li><a href="index.php?item-app-category&catid={x2;v:cb['catid']}">{x2;v:cb['catname']}</a> <span class="divider">/</span></li>
							{x2;endtree}
							<li class="active">{x2;$cat['catname']}</li>
						</ol>
					</div>
					<div class="content-box padding">
						<h2 class="title">
							{x2;$cat['catname']}
						</h2>
						<ul class="list-unstyled list-img">
							<li class="border padding">
								<h4 class="shorttitle text-center">{x2;$cat['catname']}</h4>
							</li>
							<li class="border morepadding">
								<div class="intro">
									<div class="desc" id="content">
										{x2;realhtml:$cat['catdesc']}
									</div>
								</div>
							</li>
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