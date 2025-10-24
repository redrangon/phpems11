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
							<li class="active">添加试题</li>
						</ol>
					</div>
				</div>
				<div class="box itembox" style="padding-top:10px;margin-bottom:0px;">
					<h4 class="title" style="padding:10px;">
						添加试题
						<a class="btn btn-primary pull-right" href="index.php?{x2;$_app}-master-survey-paper&svyid={x2;$survey['svyid']}">返回试卷</a>
					</h4>
					<form action="index.php?survey-master-survey-addquestion" method="post" class="form-horizontal">
						<fieldset>
							<div class="form-group">
								<label class="control-label col-sm-2">题型：</label>
								<div class="col-sm-3">
									<select needle="needle" msg="您必须为要添加的试题选择一种题型" name="args[syqnquestiontype]" class="form-control" onchange="javascript:setAnswerHtml($(this).find('option:selected').attr('rel'),'answerbox');">
										{x2;tree:$questypes,questype,qid}
										<option rel="{x2;if:v:questype['questsort']}0{x2;else}{x2;v:questype['questchoice']}{x2;endif}" value="{x2;v:questype['questid']}"{x2;if:v:questype['questid'] == $question['syqnquestiontype']} selected{x2;endif}>{x2;v:questype['questype']}</option>
										{x2;endtree}
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2">题干：</label>
								<div class="col-sm-10">
									<textarea class="ckeditor" name="args[syqnquestion]" id="question">{x2;$question['syqnquestion']}</textarea>
									<span class="help-block">需要填空处请以()表示。</span>
								</div>
							</div>
							<div class="form-group" id="selecttext">
								<label class="control-label col-sm-2">备选项：</label>
								<div class="col-sm-10">
									<textarea class="ckeditor" name="args[syqnquestionselect]" id="syqnquestionselect">{x2;$question['syqnquestionselect']}</textarea>
									<span class="help-block">无选择项的请不要填写，如填空题、问答题等主观题。</span>
								</div>
							</div>
							<div class="form-group" id="selectnumber">
								<label class="control-label col-sm-2">备选项数量：</label>
								<div class="col-sm-5">
									<select class="form-control" name="args[syqnquestionselectnumber]">
										<option value="0">0</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4" selected>4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										<option value="13">13</option>
										<option value="14">14</option>
										<option value="15">15</option>
										<option value="16">16</option>
										<option value="17">17</option>
										<option value="18">18</option>
										<option value="19">19</option>
										<option value="20">20</option>
										<option value="21">21</option>
										<option value="22">22</option>
										<option value="23">23</option>
										<option value="24">24</option>
										<option value="25">25</option>
										<option value="26">26</option>
									</select>
									<span class="help-block">无选择项的请不要填写，如填空题、问答题等主观题。</span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2"></label>
								<div class="col-sm-9">
									<button class="btn btn-primary" type="submit">提交</button>
									<input type="hidden" name="page" value="{x2;$page}"/>
									<input type="hidden" name="addquestion" value="1"/>
									<input type="hidden" name="svyid" value="{x2;$node['synesvyid']}"/>
									<input type="hidden" name="syneid" value="{x2;$node['syneid']}"/>
									{x2;tree:$search,arg,aid}
									<input type="hidden" name="search[{x2;v:key}]" value="{x2;v:arg}"/>
									{x2;endtree}
								</div>
							</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
{x2;include:footer}
</body>
</html>