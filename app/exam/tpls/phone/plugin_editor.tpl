							{x2;if:$questype[$data['questiontype']]['questchoice'] == 102}
							<script type="text/template" id="pe-template-course_{x2;$data['questionid']}">
								<div class="qq-uploader-selector" qq-drop-area-text="You can drag and drop pictures here to upload">
									<ul class="qq-upload-list-selector col-5" aria-live="polite" aria-relevant="additions removals">
										<li class="text-center unstyled">
											<a class="btn primary" href="{x2;realhtml:$sessionvars['examsessionuseranswer'][$data['questionid']]}">已上传</a>
											<input size="60" class="form-control qq-edit-filename-selector hide" rel="{x2;$data['questionid']}" type="text" name="question[{x2;$data['questionid']}]" tabindex="0" value="{x2;realhtml:$sessionvars['examsessionuseranswer'][$data['questionid']]}">
										</li>
									</ul>
									<ul class="qq-upload-list-selector col-5" aria-live="polite" aria-relevant="additions removals">
										<li class="text-center unstyled">
											{x2;if:$sessionvars['examsessionuseranswer'][$data['questionid']]}
											<a class="btn primary" href="{x2;realhtml:$sessionvars['examsessionuseranswer'][$data['questionid']]}">已上传</a>
											{x2;else}
											<a class="btn default" href="javascript:;">未上传</a>
											{x2;endif}
											<input size="60" class="form-control qq-edit-filename-selector hide" rel="{x2;$data['questionid']}" type="text" name="question[{x2;$data['questionid']}]" tabindex="0" value="{x2;realhtml:$sessionvars['examsessionuseranswer'][$data['questionid']]}">
										</li>
									</ul>
									<ul class="col-5">
										<li class="qq-upload-button-selector text-center unstyled">
											<button class="btn primary">选择上传<span class="process"></span></button>
										</li>
									</ul>
								</div>
							</script>
							<div class="fineuploader" attr-list="true" attr-template="pe-template-course_{x2;$data['questionid']}" attr-ftype="rar,zip" attr-ftype="rar,zip" attr-type="exam" rel="{x2;$data['questionid']}"></div>
							{x2;else}
							<textarea rows="4" class="jckeditor" etype="simple" id="editor{x2;$data['questionid']}" name="question[{x2;$data['questionid']}]" rel="{x2;$data['questionid']}">{x2;realhtml:$sessionvars['examsessionuseranswer'][$data['questionid']]}</textarea>
							{x2;endif}