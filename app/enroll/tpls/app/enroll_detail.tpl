{x2;include:header}
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pages">
            {x2;include:nav}
			<div class="content">
				<div class="col-xs-12">
					<div class="content-box padding">
						<h2 class="title">
							{x2;$enbat['enbname']}
							<span class="pull-right">
								{x2;if:$enroll['enrollverify'] == 1}
								<span class="text-warning">报名信息审核中</span>
								{x2;else}
								{x2;if:!$enroll['enrollverify']}<a href="index.php?enroll-app-enroll-modify&enrollid={x2;$enroll['enrollid']}" class="badge"> 编辑 </a>{x2;endif}
								<a href="javascript:;" class="badge printer" data-area="printarea"> 打印 </a>
								{x2;endif}
							</span>
						</h2>
						<ul class="list-unstyled list-img">
							<li class="border morepadding" id="printarea" style="list-style: none">
								<h3 class="text-center" style="font-size: 32px;">{x2;$enbat['enbname']}</h3>
								<h3 class="text-center" style="font-size: 32px;">报名信息</h3>
								<p class="text-right">填表时间：{x2;date:$enroll['enrolltime'],'Y年m月d日'}</p>
								<table class="table table-bordered" style="margin:auto;margin-bottom: 0px;width:100%;">
									<tr>
										<th width="140" class="text-center">报名项目</td>
										<td class="text-center">{x2;$enbat['enbname']}</td>
									</tr>
									{x2;tree:$forms,form,fid}
									<tr>
										<th width="140" class="text-center">{x2;v:form['title']}</th>
										<td class="text-center">{x2;v:form['value']}</td>
									</tr>
									{x2;endtree}
									<tr>
										<th width="140" class="text-center">签名</td>
										<td class="text-center"><img src="{x2;$enroll['enrollsign']}" width="400"></td>
									</tr>
								</table>
							</li>
						</ul>
					</div>
				</div>
			</div>
            {x2;include:footer}
		</div>
	</div>
</div>
<script src="files/public/js/jquery-migrate.min.js"></script>
<script src="files/public/js/jquery.jqprint.js"></script>
<script>
$(function(){
	$('.printer').on('click',function(){
		var id = $(this).data('area');
		$('#'+id).jqprint();
	});
});
</script>
</body>
</html>