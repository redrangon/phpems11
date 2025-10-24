{x2;if:!$userhash}
{x2;include:header}
<body>
<div class="pages">
    {x2;endif}
	<div class="page-tabs">
		<div class="page-header">
			<div class="col-1" onclick="javascript:history.back();"><span class="fa fa-chevron-left"></span></div>
			<div class="col-8">试题搜索</div>
			<div class="col-1"></div>
		</div>
		<div class="page-content header{x2;if:$basics['pages']} footer{x2;endif}">
			<form class="list-box bg top" action="index.php?exam-phone-questions-questions" data-target="pagination" method="post">
				<div class="form-group">
					<div class="col-7" >
						<input type="search" msg="请输入关键字" value="{x2;$search['keyword']}" class="form-control block" name="search[keyword]" placeholder="请输入关键字">
					</div>
					<div class="col-3 tip">
						<button class="primary">提交</button>
					</div>
				</div>
			</form>
			<div class="list-box bg top">
				<ol>
                    {x2;tree:$questions['data'],question,qid}
					<li class="unstyled">
						<a title="查看试题" class="ajax" href="index.php?exam-phone-questions-detail&questionid={x2;v:question['questionid']}">{x2;substring:strip_tags(html_entity_decode(v:question['question'])),135}</a>
					</li>
                    {x2;endtree}
				</ol>
			</div>
		</div>
        {x2;if:$questions['pages']}
		<div class="page-footer">
			<ul class="pagination">{x2;$questions['pages']}</ul>
		</div>
        {x2;endif}
	</div>
    {x2;if:!$userhash}
</div>
</body>
</html>
{x2;endif}