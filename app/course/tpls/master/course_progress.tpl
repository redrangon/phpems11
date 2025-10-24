{x2;if:!$userhash}
{x2;include:header}
<body>
{x2;include:nav}
<div class="container-fluid">
	<div class="row-fluid">
		<div class="main">
			<div class="col-xs-2 leftmenu">
				{x2;include:menu}
			</div>
			<div id="datacontent">
{x2;endif}
				<div class="box itembox" style="margin-bottom:0px;border-bottom:1px solid #CCCCCC;">
					<div class="col-xs-12">
						<ol class="breadcrumb">
							<li><a href="index.php?{x2;$_app}-master">{x2;$apps[$_app]['appname']}</a></li>
							<li><a href="index.php?course-master-course">课程管理</a></li>
							<li><a href="index.php?course-master-course-members&courseid={x2;$course['csid']}">{x2;$course['cstitle']}</a></li>
							<li class="active">学习进度</li>
						</ol>
					</div>
				</div>
				<div class="box itembox" style="padding-top:10px;margin-bottom:0px;">
					<h4 class="title" style="padding:10px;">
						{x2;$course['cstitle']}
					</h4>
					<table class="table table-hover table-bordered">
						<thead>
						<tr class="info">
							<th width="80">ID</th>
							<th>课件名</th>
							<th width="160">开始学习时间</th>
							<th width="160">最后学习时间点</th>
							<th width="80">是否学完</th>
							<th width="160">学完时间</th>
						</tr>
						</thead>
						<tbody>
						{x2;tree:$contents['data'],content,cid}
						<tr>
							<td>{x2;v:content['courseid']}</td>
							<td>{x2;v:content['coursetitle']}</td>
							<td>{x2;if:$logs[v:content['courseid']]['logtime']}{x2;date:$logs[v:content['courseid']]['logtime'],'Y-m-d H:i:s'}{x2;endif}</td>
							<td>{x2;$logs[v:content['courseid']]['logprogress']}</td>
							<td>{x2;if:$logs[v:content['courseid']]['logstatus']}已学完{x2;else}未学完{x2;endif}</td>
							<td>{x2;if:$logs[v:content['courseid']]['logendtime']}{x2;date:$logs[v:content['courseid']]['logendtime'],'Y-m-d H:i:s'}{x2;endif}</td>
						</tr>
						{x2;endtree}
						</tbody>
					</table>
				</div>
			</div>
{x2;if:!$userhash}
		</div>
	</div>
</div>
{x2;include:footer}
</body>
</html>
{x2;endif}