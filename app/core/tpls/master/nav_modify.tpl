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
				<div class="box itembox" style="margin-bottom:0px;border-bottom:1px solid #CCCCCC;">
					<div class="col-xs-12">
						<ol class="breadcrumb">
							<li><a href="index.php?core-master">全局</a></li>
							<li><a href="index.php?core-master-navs">导航管理</a></li>
							<li class="active">修改导航</li>
						</ol>
					</div>
				</div>
				<div class="box itembox" style="padding-top:10px;margin-bottom:0px;">
					<h4 class="title" style="padding:10px;">
						修改导航
						<a class="btn btn-primary pull-right" href="index.php?core-master-navs">导航管理</a>
					</h4>
					<form action="index.php?{x2;$_app}-master-navs-modify" method="post" class="form-horizontal">
						<fieldset>
							<div class="form-group">
							</div>
							<div class="form-group">
								<label for="modulename" class="control-label col-sm-2">导航名称</label>
								<div class="col-sm-4">
									<input class="form-control" type="text" id="input1" name="args[navtitle]" value="{x2;$nav['navtitle']}" needle="needle" msg="您必须输入导航名称">
									<span class="help-block">请输入导航名称</span>
								</div>
							</div>
							<div class="form-group">
								<label for="moduledescribe" class="control-label col-sm-2">导航地址</label>
								<div class="col-sm-4">
									<input class="form-control" type="text" name="args[navurl]" value="{x2;$nav['navurl']}">
								</div>
							</div>
							<div class="form-group">
								<label for="catdes" class="control-label col-sm-2"></label>
								<div class="col-sm-10">
									<button class="btn btn-primary" type="submit">提交</button>
						            <input type="hidden" name="navid" value="{x2;$nav['navid']}">
						            <input type="hidden" name="modifynav" value="1">
									{x2;tree:$search,arg,aid}
									<input type="hidden" name="search[{x2;v:key}]" value="{x2;v:arg}"/>
									{x2;endtree}
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
{x2;include:footer}
</body>
</html>