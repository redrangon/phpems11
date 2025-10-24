{x2;if:!$userhash}
{x2;include:header}
<body>
<div class="pages">
    {x2;endif}
	<div class="page-tabs">
		<div class="page-header">
			<div class="col-1" onclick="javascript:history.back();"><span class="fa fa-chevron-left"></span></div>
			<div class="col-8">回应关切</div>
			<div class="col-1"><span class="fa fa-menu"></span></div>
		</div>
		<div class="page-content header{x2;if:$contents['pages']} footer{x2;endif}">
			<div class="list-box bg top">
				<form class="reportform" style="margin-top:30px;" action="index.php?survey-phone-response">
					<ol>
						<li class="form-group unstyled">
							<label class="control-label col-10">所在城市：</label>
							<div class="col-10">
								<select class="form-control block" name="args[syrpecity]" needle="needle" msg="请选择所在城市">
									<option value="">请选择</option>
									{x2;tree:$cities,city,cid}
									<option value="{x2;v:city}">{x2;v:city}</option>
									{x2;endtree}
								</select>
							</div>
						</li>
						<li class="form-group unstyled">
							<label class="control-label col-10">企业名称：</label>
							<div class="col-10">
								<input type="text" class="form-control block" name="args[syrpecompany]" needle="needle" msg="请填写企业名称">
							</div>
						</li>
						<li class="form-group unstyled">
							<label class="control-label col-10">姓名：</label>
							<div class="col-10">
								<input type="text" class="form-control block" name="args[syrpeusername]" needle="needle" msg="请填写姓名">
							</div>
						</li>
						<li class="form-group unstyled">
							<label class="control-label col-10">联系电话：</label>
							<div class="col-10">
								<input type="text" class="form-control block" name="args[syrpephone]" needle="needle" msg="请填写联系电话">
							</div>
						</li>
						<li class="form-group unstyled">
							<label class="control-label col-10">联系邮箱：</label>
							<div class="col-10">
								<input type="text" class="form-control block" name="args[syrpemail]" needle="needle" msg="请填写联系邮箱">
							</div>
						</li>
						<li class="form-group unstyled">
							<label class="control-label col-10">留言标题：</label>
							<div class="col-10">
								<input type="text" class="form-control block" name="args[syrpetitle]" needle="needle" msg="请填写留言标题">
							</div>
						</li>
						<li class="form-group unstyled">
							<label class="control-label col-10">留言内容：</label>
							<div class="col-10">
								<textarea rows="5" class="form-control block jckeditor" etype="simple" name="args[syrpecontent]"></textarea>
							</div>
						</li>
						<li class="form-group unstyled">
							<label class="control-label col-10"></label>
							<div class="col-10">
								<button class="btn primary block">提交</button>
								<input type="hidden" name="addresponse" value="1">
							</div>
						</li>
					</ol>
				</form>
			</div>
		</div>
        {x2;if:$contents['pages']}
		<div class="page-footer">
			<ul class="pagination">{x2;$contents['pages']}</ul>
		</div>
        {x2;endif}
	</div>
    {x2;if:!$userhash}
</div>
</body>
</html>
{x2;endif}