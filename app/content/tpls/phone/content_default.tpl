{x2;if:!$userhash}
{x2;include:header}
<body>
<div class="pages">
    {x2;endif}
	<div class="page-tabs">
		<div class="page-header">
			<div class="col-1" onclick="javascript:history.back();"><span class="fa fa-chevron-left"></span></div>
			<div class="col-8">{x2;$cat['catname']}</div>
			<div class="col-1"><span class="fa fa-menu"></span></div>
		</div>
		<div class="page-content header">
			<div class="list-box bg">
				<ol>
					<li class="unstyled">
						<h4 class="title text-center">{x2;$content['contenttitle']}</h4>
					</li>
					<li class="unstyled">
						<div class="rows">
							发布人：{x2;$content['contentusername']} &nbsp; 阅读量：{x2;$content['contentview']}
						</div>
					</li>
                    {x2;if:!$status && $content['contentcoin']}
					<li class="unstyled">
						<div class="rows">
                            {x2;realhtml:$content['contentdescribe']}
						</div>
					</li>
					<li class="unstyled text-center">
						<a msg="确定要购买本章收费内容吗？" href="index.php?content-phone-content-buy&contentid={x2;$content['contentid']}" class="btn btn-primary confirm">{x2;$content['contentcoin']} 积分购买收费内容</a>
					</li>
                    {x2;else}
					<li class="unstyled">
						<div class="rows">
                            {x2;realhtml:$content['contenttext']}
						</div>
					</li>
                    {x2;endif}
                </ol>
			</div>
		</div>
	</div>
	<script>
		$(function(){
			$.get("index.php?content-phone-content-setview&contentid={x2;$content['contentid']}&"+Math.random());
		});
	</script>
    {x2;if:!$userhash}
</div>
</body>
</html>
{x2;endif}