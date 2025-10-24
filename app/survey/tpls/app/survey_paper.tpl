{x2;include:header}
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pages">
			{x2;include:nav}
			<div class="content">
				<div class="col-xs-12">
					<div class="content-box padding">
						<form class="reporttable" action="index.php?survey-app-survey-paper&svyid={x2;$survey['svyid']}">
							<div class="text-center">
								<h2 class="bigtitle">{x2;$survey['svytitle']}</h2>
								<p>
									截止时间: {x2;date:$survey['svyendtime'],'Y-m-d'}，本调查问卷<span class="text-danger">{x2;if:$survey['svytype']}采取记名形式，每人仅限参与一次{x2;else}不记录个人信息，参与次数不限{x2;endif}</span>。
								</p>
								{x2;if:$rs && $survey['svytype']}
								<p class="alert alert-danger">您已经参与过本次调查，每人仅参与一次！</p>
								{x2;endif}
							</div>
							{x2;tree:$nodes,node,nid}
							<hr />
							<div class="reportform">
								<h4>{x2;v:node['synetitle']}</h4>
								{x2;tree:$questions[v:node['syneid']],question,qid}
								<ul class="list-unstyled list-img">
									<li class="morepadding">
										第 {x2;v:qid} 题 【 {x2;$questypes[v:question['syqnquestiontype']]['questype']}】
									</li>
									<li class="border morepadding">
										<div class="desc">
											{x2;realhtml:v:question['syqnquestion']}
										</div>
									</li>
									{x2;if:$questypes[v:question['syqnquestiontype']]['questsort']}
									<li class="border morepadding">
										{x2;eval: $data = v:question}
										{x2;include:plugin_editor}
									</li>
									{x2;else}
									{x2;if:$questypes[v:question['syqnquestiontype']]['questchoice'] != 5}
									<li class="border morepadding">
										<div class="desc">
											<p>{x2;realhtml:v:question['syqnquestionselect']}</p>
										</div>
									</li>
									{x2;endif}
									<li class="border morepadding">
										<div class="nopadding desc">
											{x2;if:$questypes[v:question['syqnquestiontype']]['questchoice'] == 1 || $questypes[v:question['syqnquestiontype']]['questchoice'] == 4}
											{x2;tree:$selectors,so,sid}
											{x2;if:v:key == v:question['syqnquestionselectnumber']}
											{x2;eval: break;}
											{x2;endif}
											<label class="inline"><input type="radio" name="question[{x2;v:question['syqnid']}]" rel="{x2;v:question['syqnid']}" value="{x2;v:so}"/><span class="selector">{x2;v:so}</span> </label>
											{x2;endtree}
											{x2;elseif:$questypes[v:question['syqnquestiontype']]['questchoice'] == 5}
											<input type="text" name="question[{x2;v:question['syqnid']}]" class="form-control" placeholder="点击此处填写答案" value="" rel="{x2;v:question['syqnid']}" style="max-width: 420px;"/>
											{x2;else}
											{x2;tree:$selectors,so,sid}
											{x2;if:v:key >= v:question['syqnquestionselectnumber']}
											{x2;eval: break;}
											{x2;endif}
											<label class="inline"><input type="checkbox" name="question[{x2;v:question['syqnid']}][{x2;v:key}]" rel="{x2;v:question['syqnid']}" value="{x2;v:so}"/><span class="selector">{x2;v:so}</span> </label>
											{x2;endtree}
											{x2;endif}
										</div>
									</li>
									{x2;endif}
								</ul>
								{x2;endtree}
							</div>
							{x2;endtree}
							<hr />
							<div class="reportform text-center">
								<div class="form-group">
									<button type="submit" class="btn btn-primary">提交问卷</button>
									<input type="hidden" name="submitpaper" value="1">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			{x2;include:footer}
		</div>
	</div>
</div>
</body>
</html>