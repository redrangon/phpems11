{x2;if:!$userhash}
{x2;include:header}
<body>
<div class="pages">
	{x2;endif}
	<div class="page-tabs">
		<div class="page-header">
			<div class="col-1" onclick="javascript:history.back();"><span class="fa fa-chevron-left"></span></div>
			<div class="col-8">{x2;$ce['cetitle']}</div>
			<div class="col-1"></div>
		</div>
		<div class="page-content header">
			<div class="list-box bg">
				<ol>
					<li class="unstyled">
						<img src="index.php?certificate-phone-certificate-img&ceqid={x2;$ceq['ceqid']}" width="100%"/>
					</li>
				</ol>
			</div>
		</div>
	</div>
	{x2;if:!$userhash}
</div>
</body>
</html>
{x2;endif}