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
							<li class="active">问答管理</li>
						</ol>
					</div>
				</div>
				<div class="box itembox" style="padding-top:10px;margin-bottom:0px;overflow:visible">
					<h4 class="title" style="padding:10px;">
						未答问题管理
						<a class="btn btn-primary pull-right" href="index.php?ask-master-ask-ask">已答问题管理</a>
					</h4>
					<table class="table table-hover table-bordered">
						<thead>
							<tr class="info">
								<th width="60">ID</th>
						        <th>提问标题</th>
						        <th width="180">提问时间</th>
						        <th width="120">提问人ID</th>
								<th width="120">操作</th>
			                </tr>
			            </thead>
			            <tbody>
							{x2;tree:$asks['data'],ask,aid}
							<tr>
								<td>{x2;v:ask['askid']}</td>
								<td>{x2;v:ask['asktitle']}</td>
								<td>{x2;date:v:ask['asktime'],'Y-m-d'}</td>
								<td>
									{x2;v:ask['askuserid']}
								</td>
								<td>
									<div class="btn-group">
										<a class="btn" href="index.php?{x2;$_app}-master-ask-answers&askid={x2;v:ask['askid']}&page={x2;$page}" title="回答"><em class="glyphicon glyphicon-edit"></em></a>
										<a class="btn confirm" href="index.php?{x2;$_app}-master-ask-del&askid={x2;v:ask['askid']}&page={x2;$page}" title="删除"><em class="glyphicon glyphicon-remove"></em></a>
									</div>
								</td>
							</tr>
							{x2;endtree}
			        	</tbody>
			        </table>
					{x2;if:$asks['pages']}
					<ul class="pagination pagination-right">
						{x2;$asks['pages']}
					</ul>
					{x2;endif}
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