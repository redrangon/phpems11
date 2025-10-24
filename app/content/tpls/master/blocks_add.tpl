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
							<li><a href="index.php?{x2;$_app}-master-blocks&page={x2;$page}">标签管理</a></li>
							<li class="active">添加标签</li>
						</ol>
					</div>
				</div>
				<div class="box itembox" style="padding-top:10px;margin-bottom:0px;overflow:visible">
					<h4 class="title" style="padding:10px;">
						添加标签
						<a class="btn btn-primary pull-right" href="index.php?{x2;$_app}-master-blocks&page={x2;$page}">标签管理</a>
					</h4>
					<div id="tabs-925713" class="tabbable">
						<div class="tab-content">
							<form action="index.php?content-master-blocks-add" method="post" class="form-horizontal" style="margin-top:20px;">
								<div class="form-group">
									<label for="block" class="control-label col-sm-2">名称：</label>
									<div class="col-sm-9">
										<input class="form-control" id="block" type="text" name="args[block]" needle="needle" msg="您必须输入标签名称" max="40" value="{x2;$block['block']}">
									</div>
								</div>
								<div class="form-group">
									<label for="blockposition" class="control-label col-sm-2">位置：</label>
									<div class="col-sm-9">
										<input class="form-control" id="blockposition" type="text" name="args[blockposition]" needle="needle" msg="您必须输入内容所在位置" max="40" value="{x2;$block['blockposition']}">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2">内容：</label>
									<div class="col-sm-9">
										<textarea class="ckeditor" class="ckeditor" name="args[blockcontent][content]" rows="7" cols="4">{x2;$block['blockcontent']['content']}</textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2"></label>
									<div class="col-sm-9">
										<button class="btn btn-primary" type="submit">提交</button>
										<input type="hidden" name="args[blocktype]" value="1">
										<input type="hidden" name="addblock" value="1">
										<input type="hidden" name="page" value="{x2;$apge}">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
{x2;if:!$userhash}
		</div>
	</div>
</div>
{x2;include:code}
{x2;include:footer}
</body>
</html>
{x2;endif}