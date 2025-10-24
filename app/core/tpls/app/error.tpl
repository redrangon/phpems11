{x2;include:header}
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pages">
            {x2;include:nav}
			<div class="content">
				<div class="col-xs-12">
					<div class="content-box" style="padding:45px;font-size: 14px;">
						<h4 class="text-center {x2;if:$message['statusCode'] == 200}text-success{x2;else}text-danger{x2;endif}" style="padding:25px;">{x2;$message['message']}</h4>
						{x2;if:$message['forwardUrl'] && $message['forwardUrl'] != 'reload'}
						<p class="text-center">
							<a href="{x2;$message['forwardUrl']}">点击转入对应页面</a>
							<script>
								setTimeout(function(){
									window.location.href = '{x2;$message['forwardUrl']}';
								},3000);
							</script>
						</p>
						{x2;else}
						<p class="text-center">
							<a href="javascript:history.back();">返回上页</a>
						</p>
						{x2;endif}
					</div>
				</div>
			</div>
			{x2;include:footer}
		</div>
	</div>
</div>
</body>
</html>