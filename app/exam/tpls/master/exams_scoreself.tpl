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
							<li><a href="index.php?exam-master-exams">试卷管理</a></li>
							<li class="active">手工组卷设分</li>
						</ol>
					</div>
				</div>
				<div class="box itembox" style="padding-top:10px;margin-bottom:0px;">
					<h4 class="title" style="padding:10px;">
						{x2;$exam['exam']}
						<a class="btn btn-primary pull-right" href="index.php?{x2;$_app}-master-exams&page={x2;$page}{x2;$u}">试卷管理</a>
					</h4>
			        <form action="index.php?exam-master-exams-score" method="post" class="form-horizontal">
						{x2;eval: v:oid = 0}
						{x2;tree:$questypes,quest,qid}
						{x2;eval: v:oid++}
						{x2;if:$exam['examquestions']['questions'][v:quest['questid']] || $exam['examquestions']['questionrows'][v:quest['questid']]}
						<h4>{x2;$ols[v:oid]}、{x2;v:quest['questype']}</h4>
						{x2;eval: v:tid = 0}
						{x2;tree:$exam['examquestions']['questions'][v:quest['questid']],question,qnid}
						{x2;eval: v:tid++}
						{x2;if:!$exam['examsetting']['scores'][v:question['questionid']]}
						{x2;eval: $exam['examsetting']['scores'][v:question['questionid']] = $exam['examsetting']['questype'][v:quest['questid']]['score']}
						{x2;endif}
						<table class="table table-hover table-bordered">
							<tr class="info">
								<td style="width:120px;" id="question_{x2;v:question['questionid']}">第{x2;v:tid}题</td>
								<td></td>
							</tr>
							<tr>
								<td>标题：</td>
								<td>{x2;eval: echo strip_tags(html_entity_decode(v:question['question']))}</td>
							</tr>
							<tr>
								<td colspan="2" class="form-inline">
									【分值】<input style="height: 36px;line-height: 36px;font-size: 18px;" size="8" class="form-control" type="text" needle="needle" msg="您必须给出一个分值" name="score[{x2;v:question['questionid']}]" value="{x2;$exam['examsetting']['scores'][v:question['questionid']]}">
								</td>
							</tr>
						</table>
						{x2;endtree}
						{x2;tree:$exam['examquestions']['questionrows'][v:quest['questid']],rowsquestion,qrid}
						{x2;eval: v:tid++}
						<table class="table table-hover table-bordered">
							<tr>
								<td>
									<table class="table">
										<tr class="info">
											<td>第{x2;v:tid}题</td>
										</tr>
										<tr>
											<td>{x2;realhtml:v:rowsquestion['qrquestion']}</td>
										</tr>
									</table>
									{x2;tree:v:rowsquestion['data'],question,cqid}
									{x2;if:!$exam['examsetting']['scores'][v:question['questionid']]}
									{x2;eval: $exam['examsetting']['scores'][v:question['questionid']] = $exam['examsetting']['questype'][v:quest['questid']]['score']}
									{x2;endif}
									<table class="table" width="96%">
										<tr class="info">
											<td style="width:120px;" id="question_{x2;v:question['questionid']}">第{x2;v:cqid}小题</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>标题：</td>
											<td>{x2;eval: echo strip_tags(html_entity_decode(v:question['question']))}</td>
										</tr>
										<tr>
											<td colspan="2" class="form-inline">
												【分值】
												<input style="height: 36px;line-height: 36px;font-size: 18px;" size="8" needle="needle" class="form-control" msg="您必须设置分值" type="text" name="score[{x2;v:question['questionid']}]" value="{x2;$exam['examsetting']['scores'][v:question['questionid']]}">
											</td>
										</tr>
									</table>
									{x2;endtree}
								</td>
							</tr>
						</table>
						{x2;endtree}
						{x2;endif}
						{x2;endtree}
						<div class="form-group">
							<label class="control-label col-sm-2"></label>
							<div class="col-sm-9">
								<button class="btn btn-primary" type="submit">提交</button>
								<input type="hidden" name="scoreself" value="1"/>
								<input name="examid" type="hidden" value="{x2;$exam['examid']}">
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