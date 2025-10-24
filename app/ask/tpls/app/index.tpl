{x2;include:header}
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pages">
            {x2;include:nav}
			<div class="content">
				<div class="col-xs-12 nopadding">
					<div class="content-box padding">
						<h2 class="title">
                            问答模块
							<a class="btn btn-primary pull-right" href="index.php?ask-app-ask">提问</a>
						</h2>
						<ul class="list-unstyled list-txt">
							{x2;tree:$asks['data'],ask,aid}
							<li class="striped">
								<a href="index.php?ask-app-index-answer&askid={x2;v:ask['askid']}">
									{x2;v:ask['asktitle']}
									<span class="pull-right">{x2;date:v:ask['asktime'],'Y-m-d H:i:s'}</span>
								</a>
							</li>
							{x2;endtree}
						</ul>
						{x2;if:$asks['pages']}
						<ul class="list-unstyled list-img">
                            <li class="border morepadding">
								<ul class="pagination pull-right">
                                    {x2;$asks['pages']}
								</ul>
							</li>
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