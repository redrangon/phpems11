{x2;include:header}
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pages">
            {x2;include:nav}
			<div class="content">
				<div class="col-xs-12 nopadding">
					<div class="content-box padding">
						<h2 class="title">
                            提问
							<a class="btn btn-primary pull-right" href="javascript:history.back();">返回</a>
						</h2>
						<ul class="list-unstyled list-img">
							<li class="border">
								<div class="intro">
									<div class="desc">
										<form action="index.php?ask-app-ask" method="post">
											<p class="alert alert-warning">请注意，每个提问将扣除20个积分，请认真提问，文明用语！</p>
											<div class="form-group">
												<input placeholder="请在此输入提问标题" class="form-control" type="text" id="dhtitle" name="args[asktitle]" needle="needle" msg="您必须输入修改原因" value="">
											</div>
											<div class="form-group">
												<textarea etype="simple" rows="7" cols="4" attr-height="560" class="jckeditor" name="args[askcontent]"></textarea>
											</div>
											<div class="form-group text-center">
												<button class="btn btn-primary" type="submit"> 提 问 </button>
												<input type="hidden" name="submit" value="1">
											</div>
										</form>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
            {x2;include:footer}
		</div>
	</div>
</div>
</body>
</html>