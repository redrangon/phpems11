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
                            我的提问
							<a href="index.php?ask-app-ask" class="badge pull-right">我要提问</a>
						</h2>
						<ul class="list-unstyled list-img">
							<li class="border morepadding">
								<table class="table table-bordered table-hover">
									<tr class="info">
										<td>问题标题</td>
										<td width="160" class="text-center">提问时间</td>
										<td width="90" class="text-center">状态</td>
									</tr>
									{x2;tree:$asks['data'],ask,aid}
									<tr>
										<td><a href="index.php?ask-app-index-answer&askid={x2;v:ask['askid']}">{x2;v:ask['asktitle']}</a></td>
										<td>{x2;date:v:ask['asktime'],'Y-m-d H:i:s'}</td>
										<td class="text-center">{x2;$status[v:ask['askstatus']]}</td>
									</tr>
									{x2;endtree}
								</table>
							</li>
							{x2;if:$asks['pages']}
							<li class="border morepadding">
								<ul class="pagination pull-right">
									{x2;$asks['pages']}
								</ul>
							</li>
							{x2;endif}
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