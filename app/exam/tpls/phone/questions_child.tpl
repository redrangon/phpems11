{x2;if:!$userhash}
{x2;include:header}
<body>
<div class="pages">
    {x2;endif}
	<div class="page-tabs">
		<div class="page-header">
			<div class="col-1" onclick="javascript:history.back();"><span class="fa fa-chevron-left"></span></div>
			<div class="col-8">题帽题列表</div>
			<div class="col-1"></div>
		</div>
		<div class="page-content header">
			<div class="list-box bg">
				<ol>
					<li class="unstyled">
						<div class="rows">
							<p>{x2;realhtml:$question['qrquestion']}</p>
						</div>
					</li>
				</ol>
			</div>
			{x2;tree:$question['data'],question,qid}
			<div class="list-box bg top">
				<ol>
					<li class="unstyled">
						<div class="rows">
							<p>{x2;realhtml:v:question['question']}</p>
						</div>
					</li>
					{x2;if:!$questype[v:questiont['questiontype']]['questsort'] && $questype[v:questiont['questiontype']]['questchoice'] != 5}
					<li class="unstyled">
						<div class="rows">
							<p>{x2;realhtml:v:question['questionselect']}</p>
						</div>
					</li>
					{x2;endif}
					<li class="unstyled rightanswer">
						<div class="rows">
							{x2;if:$questype['questsort']}
							<div class="intro">
								<span class="badge">正确答案</span>
							</div>
							<div class="intro">
								{x2;realhtml:v:question['questionanswer']}
							</div>
							{x2;else}
							<div class="col-4x intro">
								<span class="badge">正确答案</span>
							</div>
							<div class="col-4l intro">
								<b id="rightanswer_{x2;v:question['questionid']}">{x2;v:question['questionanswer']}</b>
							</div>
							{x2;endif}
						</div>
					</li>
					<li class="unstyled rightanswer">
						<div class="rows">
							{x2;if:strlen(v:question['questiondescribe']) >= 10}
							<div class="intro">
								<span class="badge">试题解析</span>
							</div>
							<div class="intro">
								{x2;realhtml:v:question['questiondescribe']}
							</div>
							{x2;else}
							<div class="col-4x">
								<span class="badge">试题解析</span>
							</div>
							<div class="col-4l intro">
								{x2;realhtml:v:question['questiondescribe']}
							</div>
							{x2;endif}
						</div>
					</li>
				</ol>
			</div>
			{x2;endtree}
		</div>
	</div>
    {x2;if:!$userhash}
</div>
</body>
</html>
{x2;endif}