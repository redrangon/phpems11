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
							<li class="active">标签管理</li>
						</ol>
					</div>
				</div>
				<div class="box itembox" style="padding-top:10px;margin-bottom:0px;overflow:visible">
					<h4 class="title" style="padding:10px;">
						标签管理
						<a class="btn btn-primary pull-right" href="index.php?content-master-blocks-add&page={x2;$page}">添加标签</a>
					</h4>
					<table class="table table-hover table-bordered">
						<thead>
							<tr class="info">
			                    <th width="100">ID</th>
						        <th width="240">名称</th>
						        <th>位置及说明</th>
						        <th width="160">操作</th>
			                </tr>
			            </thead>
			            <tbody>
			            	{x2;tree:$blocks['data'],block,kid}
			            	<tr>
			                    <td>{x2;v:block['blockid']}</td>
						        <td>{x2;v:block['block']}</td>
						        <td>{x2;v:block['blockposition']}</td>
						        <td>
						        	<div class="btn-group">
										<a class="btn" href="index.php?{x2;$_app}-master-blocks-modify&blockid={x2;v:block['blockid']}&page={x2;$page}" title="修改">修改</a>
										<a class="btn ajax" href="index.php?{x2;$_app}-master-blocks-del&blockid={x2;v:block['blockid']}&page={x2;$page}" title="删除">删除</a>
									</div>
								</td>
			                </tr>
			                {x2;endtree}
			        	</tbody>
			        </table>
					{x2;if:$blocks['pages']}
					<ul class="pagination pagination-right">
						{x2;$blocks['pages']}
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