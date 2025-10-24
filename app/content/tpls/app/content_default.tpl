{x2;include:header}
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pages">
            {x2;include:nav}
			<div class="content">
				<div class="col-xs-9">
					<div class="content-box">
						<ol class="breadcrumb">
							<li><a href="index.php?content">首页</a></li>
							{x2;tree:$catbread,cb,cbid}
							<li><a href="index.php?content-app-category&catid={x2;v:cb['catid']}">{x2;v:cb['catname']}</a> </li>
							{x2;endtree}
							<li><a href="index.php?content-app-category&catid={x2;$cat['catid']}">{x2;$cat['catname']}</a> </li>
							<li class="active">{x2;$content['contenttitle']}</li>
						</ol>
					</div>
					<div class="content-box padding">
						<h2 class="title">
                            {x2;$cat['catname']}
							<a href="index.php?content-app-category&catid={x2;$cat['catid']}" class="badge pull-right"> 返回 </a>
						</h2>
						<ul class="list-unstyled list-img">
                            <li class="border padding">
								<h4 class="shorttitle text-center">{x2;$content['contenttitle']}</h4>
								<div class="intro">
									<div class="desc">
										<div class="text-center">
											<ul class="list-inline list-unstyled">
												<li class="toolbar">发布人：{x2;$content['contentusername']}</li>
												<li class="toolbar">阅读量：{x2;$content['contentview']}</li>
											</ul>
										</div>
									</div>
								</div>
							</li>
                            {x2;if:!$status && $content['contentcoin']}
                            <li class="border morepadding">
								<div class="intro">
									<div class="desc" id="content">
                                        {x2;realhtml:$content['contentdescribe']}
									</div>
								</div>
							</li>
							<li class="border morepadding text-center">
								<a msg="确定要购买本章收费内容吗？" href="index.php?content-app-content-buy&contentid={x2;$content['contentid']}" class="btn btn-primary confirm">{x2;$content['contentcoin']} 积分购买收费内容</a>
							</li>
                            {x2;else}
							<li class="border morepadding">
								<div class="intro">
									<div class="desc" id="content">
                            			{x2;realhtml:$content['contenttext']}
									</div>
								</div>
							</li>
                            {x2;endif}
							<li class="border morepadding">
								<div class="intro">
									<div class="desc">
										<div class="toolbar text-right">{x2;date:$content['contentinputtime'],'Y-m-d'}</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-xs-3 nopadding">
					<div class="content-box padding">
						<h2 class="title">新闻推荐</h2>
						<ul class="list-unstyled list-txt">
                            {x2;tree:$topnews['data'],content,cid}
							<li class="striped">
								<a href="index.php?content-app-content&contentid={x2;v:content['pccontentid']}"> {x2;v:content['pctitle']}</a>
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
<script>
	$(function(){
		$.get("index.php?content-app-content-setview&contentid={x2;$content['contentid']}&"+Math.random());
	});
</script>
</body>
</html>