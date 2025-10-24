{x2;if:!$userhash}
{x2;include:header}
<body>
<div class="pages">
    {x2;endif}
	<div class="page-tabs">
		<div class="page-header">
			<div class="col-1" onclick="javascript:history.back();"><span class="fa fa-chevron-left"></span></div>
			<div class="col-8">组卷练习</div>
			<div class="col-1"><span class="fa fa-menu hide"></span></div>
		</div>
		<div class="page-content header">
			<div class="list-box bg">
				<form action="index.php?exam-phone-record-selectquestions" method="post" class="rows" action-before="clearStorage">
					<ol>
						<li class="unstyled">
							<div class="form-group">
								<label class="col-3">试卷名称：</label>
								<div class="col-7">
									<input type="text" needle="needle" msg="请填写试卷名称" name="args[title]" class="block"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-3">时间(分钟)：</label>
								<div class="col-7">
									<input type="text" needle="needle" msg="做题时间" name="args[time]" class="block" value='60'/>
								</div>
							</div>
							{x2;tree:$questype,quest,qid}
							{x2;if:v:quest['number']}
							<div class="form-group">
								{x2;v:quest['questype']}（共{x2;v:quest['number']}题），选 <input id="question_{x2;v:quest['questid']}" size="5" type="text" name="args[number][{x2;v:quest['questid']}]" rel="{x2;v:quest['number']}" value="0"/> 题
							</div>
							{x2;endif}
							{x2;endtree}
						</li>
						<li class="unstyled">
							<div class="form-group">
								<input type="hidden" name="setExecriseConfig" value="1" />
								<p class="text-center">
									<button type="submit" class="btn primary">开始测试</button>
								</p>
							</div>
						</li>
					</ol>
				</form>
			</div>
		</div>
	</div>
    {x2;if:!$userhash}
</div>
</body>
</html>
{x2;endif}