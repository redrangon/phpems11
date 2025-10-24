{x2;if:!$userhash}
{x2;include:header}
<body>
<div class="pages">
    {x2;endif}
	<div class="page-tabs">
		<div class="page-header">
			<div class="col-1" onclick="javascript:history.back();"><span class="fa fa-chevron-left"></span></div>
			<div class="col-8">试题详情</div>
			<div class="col-1"><span class="fa fa-menu"></span></div>
		</div>
		<div class="page-content header footer">
			<form class="list-box bg top">
				<ol>
					{x2;if:$parent}
					<li class="unstyled">
						<div class="rows">
							<p>{x2;realhtml:$parent['qrquestion']}</p>
						</div>
					</li>
					{x2;endif}
					<li class="unstyled">
						<div class="rows">
							<p>{x2;realhtml:$question['question']}</p>
						</div>
					</li>
					{x2;if:!$questype[$questiont['questiontype']]['questsort'] && $questype[$questiont['questiontype']]['questchoice'] != 5}
					<li class="unstyled">
						<div class="rows">
							<p>{x2;realhtml:$question['questionselect']}</p>
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
								{x2;realhtml:$question['questionanswer']}
							</div>
							{x2;else}
							<div class="col-4x intro">
								<span class="badge">正确答案</span>
							</div>
							<div class="col-4l intro">
								<b id="rightanswer_{x2;$question['questionid']}">{x2;$question['questionanswer']}</b>
							</div>
							{x2;endif}
						</div>
					</li>
					<li class="unstyled rightanswer">
						<div class="rows">
							{x2;if:strlen($question['questiondescribe']) >= 10}
							<div class="intro">
								<span class="badge">试题解析</span>
							</div>
							<div class="intro">
								{x2;realhtml:$question['questiondescribe']}
							</div>
							{x2;else}
							<div class="col-4x">
								<span class="badge">试题解析</span>
							</div>
							<div class="col-4l intro">
								{x2;realhtml:$question['questiondescribe']}
							</div>
							{x2;endif}
						</div>
					</li>
					<li class="unstyled"></li>
				</ol>
			</form>
		</div>
	</div>
    {x2;if:!$userhash}
</div>
</body>
</html>
{x2;endif}
