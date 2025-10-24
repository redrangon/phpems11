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
							<li class="active">商品管理</li>
						</ol>
					</div>
				</div>
				<div class="box itembox" style="padding-top:10px;margin-bottom:0px;overflow:visible">
					<h4 class="title" style="padding:10px;">
						商品管理
					</h4>
					<form action="index.php?weixin-master-item" method="post" class="form-inline">
						<table class="table">
					        <tr>
								<td style="border-top: 0px;">
									商品编号：
								</td>
								<td style="border-top: 0px;">
									<input name="search[itemcode]" class="form-control" size="15" type="text" value="{x2;$search['itemcode']}"/>
								</td>
								<td style="border-top: 0px;">
									关键字：
								</td>
								<td style="border-top: 0px;">
									<input class="form-control" name="search[keyword]" size="15" type="text" value="{x2;$search['keyword']}"/>
								</td>
								<td style="border-top: 0px;">
									<button class="btn btn-primary" type="submit">提交</button>
								</td>
					        </tr>
						</table>
						<div class="input">
							<input type="hidden" value="1" name="search[argsmodel]" />
						</div>
					</form>
					<table class="table table-hover table-bordered">
						<thead>
						<tr class="info">
							<th width="60">ID</th>
							<th>商品名称</th>
							<th width="120">对应ID</th>
							<th width="120">商品编号</th>
							<th width="120">图片数</th>
						</tr>
						</thead>
						<tbody>
						{x2;tree:$items['data'],item,iid}
						<tr>
							<td>{x2;v:item['itemid']}</td>
							<td>
								{x2;v:item['itemtitle']}
							</td>
							<td>
								{x2;v:item['itemtargetid']}
							</td>
							<td>
								{x2;v:item['itemcode']}
							</td>
							<td>
								{x2;if:v:item['itemimages']}{x2;eval: echo count(v:item['itemimages'])}{x2;else}0{x2;endif}
							</td>
						</tr>
						{x2;endtree}
						</tbody>
					</table>
					<ul class="pagination pull-right">
						{x2;$items['pages']}
					</ul>
				</div>
			</div>
{x2;if:!$userhash}
		</div>
	</div>
</div>
<script src="index.php?content-master-contents-catsmenu&catid={x2;$catid}"></script>
<script>
    $('#catsmenu').treeview({
        levels: {x2;$catlevel},
        expandIcon: 'glyphicon glyphicon-chevron-right',
        collapseIcon: 'glyphicon glyphicon-chevron-down',
        selectedColor: "#FFFFFF",
        selectedBackColor: "transparent",
        enableLinks: true,
        data: treeData
    });
</script>
{x2;include:footer}
</body>
</html>
{x2;endif}