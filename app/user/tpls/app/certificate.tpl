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
                            我的证书
						</h2>
						<ul class="list-box list-unstyled list-img">
							{x2;tree:$certificates['data'],certificate,cid}
							<li class="border morepadding">
								<h4 class="shorttitle">{x2;v:certificate['cetitle']}</h4>
								<div class="intro">
									<div class="col-xs-3 img">
										<a href="index.php?certificate-app-certificate-detail&ceqid={x2;v:certificate['ceqid']}"><img src="{x2;v:certificate['cethumb']}" /></a>
									</div>
									<div class="desc">
										<p>{x2;v:certificate['cedescribe']}</p>
										<p class="toolbar">
											申请时间：{x2;date:v:certificate['ceqtime'],'Y-m-d H:i:s'}
											<a class="btn btn-info pull-right more">{x2;$status[v:certificate['ceqstatus']]}</a>
										</p>
									</div>
								</div>
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