{x2;if:!$userhash}
{x2;include:header}
<body>
<div class="pages">
	{x2;endif}
	<div class="page-tabs">
		<div class="page-header">
			<div class="col-10">问答模块</div>
		</div>
		<div class="page-content header{x2;if:$asks['pages']} footer{x2;endif}">
			<div class="list-box bg top">
				<ol>
					{x2;tree:$asks['data'],ask,aid}
					<li class="unstyled">
						<div class="rows">
							<a class="ajax" href="index.php?ask-phone-index-answer&askid={x2;v:ask['askid']}">
								<div class="intro">
									{x2;v:ask['asktitle']}
								</div>
							</a>
						</div>
					</li>
                    {x2;endtree}
				</ol>
			</div>
		</div>
		{x2;if:$asks['pages']}
		<div class="page-footer">
			<ul class="pagination">{x2;$asks['pages']}</ul>
		</div>
		{x2;endif}
	</div>
	{x2;if:!$userhash}
</div>
</body>
</html>
{x2;endif}