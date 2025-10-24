							{x2;if:$questype[$data['questiontype']]['questchoice'] == 102}
							<script type="text/template" id="pe-template-course_{x2;$data['syqnid']}">
								<div class="qq-uploader-selector" qq-drop-area-text="You can drag and drop pictures here to upload" style="clear:both;max-width:100%;">
									<ul class="qq-upload-list-selector list-unstyled pull-left" aria-live="polite" aria-relevant="additions removals" style="clear:both;">
										<li class="text-center">
											<a class="btn btn-primary" href="{x2;realhtml:$sessionvars['examsessionuseranswer'][$data['syqnid']]}">已上传</a>
											<input size="60" class="form-control qq-edit-filename-selector hide" rel="{x2;$data['syqnid']}" type="text" name="question[{x2;$data['syqnid']}]" tabindex="0" value="{x2;realhtml:$sessionvars['examsessionuseranswer'][$data['syqnid']]}">
										</li>
									</ul>
									<ul class="qq-upload-list-selector list-unstyled pull-left" aria-live="polite" aria-relevant="additions removals" style="clear:both;">
										<li class="text-center">
											{x2;if:$sessionvars['examsessionuseranswer'][$data['syqnid']]}
											<a class="btn btn-primary" href="{x2;realhtml:$sessionvars['examsessionuseranswer'][$data['syqnid']]}">已上传</a>
											{x2;else}
											<a class="btn btn-default" href="javascript:;">未上传</a>
											{x2;endif}
											<input size="60" class="form-control qq-edit-filename-selector hide" rel="{x2;$data['syqnid']}" type="text" name="question[{x2;$data['syqnid']}]" tabindex="0" value="{x2;realhtml:$sessionvars['examsessionuseranswer'][$data['syqnid']]}">
										</li>
									</ul>
									<div class="qq-upload-button-selector col-xs-3">
										<button class="btn btn-primary">选择上传<span class="process"></span></button>
									</div>
								</div>
							</script>
							<div class="fineuploader" attr-list="true" attr-template="pe-template-course_{x2;$data['syqnid']}" attr-ftype="rar,zip" attr-type="exam" rel="{x2;$data['syqnid']}"></div>
							{x2;else}
							<textarea class="jckeditor" etype="simple" id="editor{x2;$data['syqnid']}" name="question[{x2;$data['syqnid']}]" rel="{x2;$data['syqnid']}">{x2;realhtml:$sessionvars['examsessionuseranswer'][$data['syqnid']]}</textarea>
							{x2;endif}