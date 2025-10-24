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
							<li><a href="index.php?{x2;$_app}-master-ask">问答管理</a></li>
							<li class="active">回答管理</li>
						</ol>
					</div>
				</div>
				<div class="box itembox" style="padding-top:10px;margin-bottom:0px;overflow:visible">
					<h4 class="title" style="padding:10px;">
						问题内容
						<a class="btn btn-primary pull-right" href="index.php?ask-master-ask-addanswer&askid={x2;$ask['askid']}">添加回答</a>
					</h4>
					<div style="padding-top:10px;">
						{x2;realhtml:$ask['asktitle']}
					</div>
					<div style="padding-top:10px;">
						{x2;realhtml:$ask['askcontent']}
					</div>
				</div>
				<div class="box itembox" style="padding-top:10px;margin-bottom:0px;overflow:visible">
					<h4 class="title" style="padding:10px;">
						回答管理
					</h4>
					<table class="table table-hover table-bordered">
						<thead>
							<tr class="info">
								<th width="36" class="hide"><input type="checkbox" class="checkall" target="delids"/></th>
								<th width="60">ID</th>
						        <th>回答内容</th>
						        <th width="180">回答时间</th>
						        <th width="120">操作</th>
			                </tr>
			            </thead>
			            <tbody>
			            	{x2;tree:$answers['data'],answer,aid}
			            	<tr>
								<td class="hide"><input type="checkbox" name="delids[{x2;v:answer['asrid']}]" value="1"></td>
								<td>{x2;v:answer['asrid']}</td>
						        <td>{x2;eval: echo strip_tags(html_entity_decode(v:answer['asrcontent']))}</td>
						        <td>{x2;date:v:answer['asrtime'],'Y-m-d'}</td>
						        <td>
						        	<div class="btn-group">
										<a class="btn" href="index.php?{x2;$_app}-master-ask-modifyanswer&asrid={x2;v:answer['asrid']}&page={x2;$page}" title="修改"><em class="glyphicon glyphicon-edit"></em></a>
										<a class="btn confirm" href="index.php?{x2;$_app}-master-ask-delanswer&asrid={x2;v:answer['asrid']}&page={x2;$page}" title="删除"><em class="glyphicon glyphicon-remove"></em></a>
									</div>
								</td>
			                </tr>
			                {x2;endtree}
			        	</tbody>
			        </table>
					{x2;if:$answers['pages']}
					<ul class="pagination pagination-right">
						{x2;$answers['pages']}
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