{x2;include:header}
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pages">
			{x2;include:nav}
			<div class="content">
				<div class="col-xs-3" style="width: 20%">
					<div class="content-box padding">
						{x2;include:menu}
					</div>
				</div>
				<div class="col-xs-9 nopadding" style="width: 80%">
					<div class="content-box padding">
						<h2 class="title">
                            实名认证
						</h2>
						<ul class="list-unstyled list-img">
							<li class="border padding">
								<div class="desc">
									{x2;if:$user['userstatus'] == 1}
									<p class="alert alert-warning">您已提交实名认证，请耐心等待审核。</p>
									{x2;elseif:$user['userstatus'] == 2}
									<p class="alert alert-danger">您的实名认证没有通过审核，请重新提交。</p>
									{x2;elseif:$user['userstatus'] == 3}
									<p class="alert alert-success">您已通过实名认证。</p>
									{x2;else}
									<p class="alert alert-warning">您还没有提交实名认证，请填写以下资料提交认证。</p>
									{x2;endif}
									{x2;if:!$user['userstatus'] || $user['userstatus'] == 2}
									<form action="index.php?user-app-verify" method="post" class="form-horizontal">
										<fieldset>
											<div class="form-group underline">
												<div class="col-xs-2 tip">
													真实姓名：
												</div>
												<div class="col-xs-8">
													<input type="text" class="form-control" name="args[usertruename]" value="{x2;$user['usertruename']}" needle="needle" msg="请输入真实姓名" placeholder="请输入真实姓名">
												</div>
											</div>
											<div class="form-group underline">
												<div class="col-xs-2 tip">
													个人照片：
												</div>
												<div class="col-xs-8">
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
												<label class="control-label col-sm-2"></label>
												<div class="col-sm-10">
													<button class="btn btn-primary" type="submit">提交</button>
													<input type="hidden" name="verify" value="1"/>
												</div>
											</div>
										</fieldset>
									</form>
									{x2;elseif:$user['userstatus'] == 1 || $user['userstatus'] == 3}
									<form action="index.php?user-app-verify" method="post" class="form-horizontal">
										<fieldset>
											<div class="form-group underline">
												<div class="col-xs-2 tip">
													真实姓名：
												</div>
												<div class="col-xs-8">
													{x2;$user['usertruename']}
												</div>
											</div>
											<div class="form-group underline">
												<div class="col-xs-2 tip">
													个人照片：
												</div>
												<div class="col-xs-8">
													<img class="thumbnail" src="{x2;$user['userphoto']}" style="max-width: 200px">
												</div>
											</div>
										</fieldset>
									</form>
									{x2;endif}
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
            {x2;include:footer}
		</div>
	</div>
</div>
</body>
</html>