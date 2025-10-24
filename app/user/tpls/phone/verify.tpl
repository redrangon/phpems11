{x2;if:!$userhash}
{x2;include:header}
<body>
<div class="pages">
    {x2;endif}
	<div class="page-tabs">
		<div class="page-header">
			<div class="col-1" onclick="javascript:history.back();"><span class="fa fa-chevron-left"></span></div>
			<div class="col-8">实名认证</div>
			<div class="col-1"><span class="fa fa-menu"></span></div>
		</div>
		<div class="page-content header">
			<div class="list-box bg">
				<ol>
					<li class="unstyled">
						<div class="rows info">
							{x2;if:$user['userstatus'] == 1}
							<div class="text-warning">您已提交实名认证，请耐心等待审核。</div>
							{x2;elseif:$user['userstatus'] == 2}
							<div class="text-danger">您的实名认证没有通过审核，请重新提交。</div>
							{x2;elseif:$user['userstatus'] == 3}
							<div class="text-success">您已通过实名认证。</div>
							{x2;else}
							<div class="text-warning">您还没有提交实名认证，请填写以下资料提交认证。</div>
							{x2;endif}
						</div>
					</li>
				</ol>
			</div>
			{x2;if:!$user['userstatus'] || $user['userstatus'] == 2}
			<form action="index.php?user-app-verify" method="post" class="form-horizontal">
				<div class="form-group underline">
					<div class="col-3 tip">
						真实姓名：
					</div>
					<div class="col-7">
						<input type="text" class="form-control" name="args[usertruename]" value="{x2;$user['usertruename']}" needle="needle" msg="请输入真实姓名" placeholder="请输入真实姓名">
					</div>
				</div>
				<div class="form-group underline">
					<div class="col-10 tip">
						个人照片：
					</div>
					<div class="col-10">
						<script type="text/template" id="pe-template-userphoto">
							<div class="qq-uploader-selector" qq-drop-area-text="可将图片拖拽至此处上传" style="clear:both;max-width:200px;">
								<div class="qq-upload-button-selector" style="clear:both;">
									<ul class="qq-upload-list-selector list-unstyled" aria-live="polite" aria-relevant="additions removals" style="clear:both;">
										<li class="text-center">
											<div class="thumbnail">
												<img class="qq-thumbnail-selector" alt="点击上传新图片">
												<input type="hidden" class="qq-edit-filename-selector" name="args[userphoto]" tabindex="0">
											</div>
										</li>
									</ul>
									<ul class="qq-upload-list-selector list-unstyled" aria-live="polite" aria-relevant="additions removals" style="clear:both;">
										<li class="text-center">
											<div class="thumbnail">
												<img class="qq-thumbnail-selector" src="{x2;if:$user['userphoto']}{x2;$user['userphoto']}{x2;else}files/public/img/noimage.gif{x2;endif}" alt="点击上传新图片">
												<input type="hidden" class="qq-edit-filename-selector" name="args[userphoto]" tabindex="0" value="{x2;if:$user['userphoto']}{x2;$user['userphoto']}{x2;else}files/public/img/noimage.gif{x2;endif}">
											</div>
										</li>
									</ul>
								</div>
							</div>
						</script>
						<div class="fineuploader" attr-type="thumb" attr-template="pe-template-userphoto"></div>
						<p class="help-block">建议图片尺寸：360*480像素（点击已上传图片可重新上传）</p>
					</div>
				</div>
				<div class="form-group">
					<button class="primary block" type="submit">提交认证</button>
					<input type="hidden" name="verify" value="1"/>
				</div>
			</form>
			{x2;elseif:$user['userstatus'] == 1 || $user['userstatus'] == 3}
			<form action="index.php?user-app-verify" method="post" class="form-horizontal">
				<div class="form-group underline">
					<div class="col-3 tip">
						真实姓名：
					</div>
					<div class="col-7">
						{x2;$user['usertruename']}
					</div>
				</div>
				<div class="form-group underline">
					<div class="col-10 tip">
						个人照片：
					</div>
					<div class="col-10">
						<img class="thumbnail" src="{x2;$user['userphoto']}" style="max-width: 100%">
					</div>
				</div>
			</form>
			{x2;endif}
		</div>
	</div>
    {x2;if:!$userhash}
</div>
</body>
</html>
{x2;endif}