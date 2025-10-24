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
							<li><a href="index.php?{x2;$_app}-master">{x2;$apps[$_app]['appname']}</a></li>
							<li><a href="index.php?{x2;$_app}-master-survey">问卷调查</a></li>
							<li class="active">修改问卷</li>
						</ol>
					</div>
				</div>
				<div class="box itembox" style="padding-top:10px;margin-bottom:0px;">
					<h4 class="title" style="padding:10px;">
						修改问卷
						<a class="btn btn-primary pull-right" href="index.php?{x2;$_app}-master-survey">问卷列表</a>
					</h4>
					<form action="index.php?{x2;$_app}-master-survey-modifypaper" method="post" class="form-horizontal">
						<fieldset>
							<div class="form-group col-xs-12">
								<p class="alert alert-danger">注意：请不要在有统计数据后切换问卷类型，否则可能导致匿名数据不能显示。</p>
							</div>
							<div class="form-group">
								<label for="modulename" class="control-label col-sm-2">问卷名称</label>
								<div class="col-sm-4">
									<input class="form-control" type="text" id="input1" name="args[svytitle]" value="{x2;$survey['svytitle']}" needle="needle" msg="您必须输入调研名称">
									<span class="help-block">请输入问卷名称</span>
								</div>
							</div>
							<div class="form-group">
								<label for="moduledescribe" class="control-label col-sm-2">问卷图片</label>
								<div class="col-sm-9">
									<script type="text/template" id="pe-template-photo">
										<div class="qq-uploader-selector" style="width:30%" qq-drop-area-text="可将图片拖拽至此处上传" style="clear:both;">
											<div class="qq-upload-button-selector" style="clear:both;">
												<ul class="qq-upload-list-selector list-unstyled" aria-live="polite" aria-relevant="additions removals" style="clear:both;">
													<li class="text-center">
														<div class="thumbnail">
															<img class="qq-thumbnail-selector" alt="点击上传新图片">
															<input type="hidden" class="qq-edit-filename-selector" name="args[svythumb]" tabindex="0">
														</div>
													</li>
												</ul>
												<ul class="qq-upload-list-selector list-unstyled" aria-live="polite" aria-relevant="additions removals" style="clear:both;">
													<li class="text-center">
														<div class="thumbnail">
															<img class="qq-thumbnail-selector" src="{x2;if:$survey['svythumb']}{x2;$survey['svythumb']}{x2;else}app/core/styles/images/noimage.gif{x2;endif}" alt="点击上传新图片">
															<input type="hidden" class="qq-edit-filename-selector" name="args[svythumb]" tabindex="0" value="{x2;if:$survey['svythumb']}{x2;$survey['svythumb']}{x2;else}app/core/styles/images/noimage.gif{x2;endif}">
														</div>
													</li>
												</ul>
											</div>
										</div>
									</script>
									<div class="fineuploader" attr-type="thumb" attr-template="pe-template-photo"></div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">问卷类型：</label>
								<div class="col-sm-10">
									<label class="radio-inline">
										<input name="args[svytype]" type="radio" value="0"{x2;if:!$survey['svytype']} checked{x2;endif}/>匿名（不限次数，不记录用户信息）
									</label>
									<label class="radio-inline">
										<input name="args[svytype]" type="radio" value="1"{x2;if:$survey['svytype']} checked{x2;endif}/>实名（记录用户信息，每个用户仅一次）
									</label>
								</div>
							</div>
							<div class="form-group">
								<label for="contenttitle" class="control-label col-sm-2">开始时间：</label>
								<div class="col-sm-4">
									<input class="form-control datetimepicker" data-minview="0" data-date="{x2;date:TIME,'Y-m-d H:i:s'}" value="{x2;date:$survey['svystime'],'Y-m-d H:i:s'}" data-date-format="yyyy-mm-dd hh:ii:ss" type="text" id="svystime" name="args[svystime]" needle="needle" msg="您必须输入开始时间">
								</div>
							</div>
							<div class="form-group">
								<label for="contenttitle" class="control-label col-sm-2">到期时间：</label>
								<div class="col-sm-4">
									<input class="form-control datetimepicker" data-minview="0" data-date="{x2;date:TIME,'Y-m-d H:i:s'}" value="{x2;date:$survey['svyendtime'],'Y-m-d H:i:s'}" data-date-format="yyyy-mm-dd hh:ii:ss" type="text" id="svyendtime" name="args[svyendtime]" needle="needle" msg="您必须输入到期时间">
								</div>
							</div>
							<div class="form-group">
								<label for="catdes" class="control-label col-sm-2">问卷说明</label>
								<div  class="col-sm-10">
									<textarea class="ckeditor" rows="7" id="svydescribe" name="args[svydescribe]">{x2;$survey['svydescribe']}</textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="catdes" class="control-label col-sm-2"></label>
								<div class="col-sm-10">
									<button class="btn btn-primary" type="submit">提交</button>
						            <input type="hidden" name="page" value="{x2;$page}">
						            <input type="hidden" name="modifypaper" value="1">
						            <input type="hidden" name="svyid" value="{x2;$survey['svyid']}">
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