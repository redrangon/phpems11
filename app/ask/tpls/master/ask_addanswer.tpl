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
						添加答案
					</h4>
					<form action="index.php?ask-master-ask-addanswer" method="post" class="form-horizontal">
						<div class="form-group">
							<div class="col-sm-12">
								<textarea id="contenttext" rows="7" cols="4" class="jckeditor" name="args[asrcontent]"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<button class="btn btn-primary" type="submit">提交</button>
								<input type="hidden" name="submit" value="1">
								<input type="hidden" name="args[asraskid]" value="{x2;$ask['askid']}">
							</div>
						</div>
					</form>
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