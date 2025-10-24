{x2;include:header}
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pages">
            {x2;include:nav}
			<div class="content">
				<div class="col-xs-9">
					<div class="content-box padding">
						<h2 class="title">我的证书</h2>
						<form action="index.php?certificate-app-certificate-apply" method="post">
							<ul class="list-unstyled list-img">
								<li class="border morepadding">
									<h4 class="shorttitle text-center">{x2;$ce['cetitle']}</h4>
								</li>
								<li class="border morepadding">
									<div class="intro">
										<div class="desc">
											{x2;if:$ceq['ceqstatus'] == 2}
											<img src="index.php?certificate-app-certificate-img&ceqid={x2;$ceq['ceqid']}" width="100%"/>
											{x2;else}
											<p class="alert alert-danger">证件尚未发出</p>
											{x2;endif}
										</div>
									</div>
								</li>
							</ul>
						</form>
					</div>
				</div>
				<div class="col-xs-3 nopadding">
					<div class="content-box padding">
						<h2 class="title">最新证书</h2>
						<ul class="list-unstyled list-img">
                            {x2;tree:$news['data'],certificate,cid}
							<li class="border padding">
								<a href="index.php?certificate-app-certificate-apply&ceid={x2;v:certificate['ceid']}">
									<div class="intro">
										<div class="col-xs-5 img noleftpadding">
											<img src="{x2;if:v:certificate['cethumb']}{x2;v:certificate['cethumb']}{x2;else}app/core/styles/img/item.jpg{x2;endif}" />
										</div>
										<div class="desc">
											<p>{x2;v:certificate['cetitle']}</p>
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