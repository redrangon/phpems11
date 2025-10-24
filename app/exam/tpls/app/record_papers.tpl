{x2;include:header}
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pages">
            {x2;include:examnav}
			<div class="content">
				<div class="col-xs-3" style="width: 20%">
					<div class="content-box padding">
                        {x2;include:menu}
					</div>
				</div>
				<div class="col-xs-9 nopadding" style="width: 80%">
					<div class="content-box padding">
						<ul class="nav nav-tabs">
							<li><a href="index.php?exam-app-record">试题列表</a></li>
							<li class="active"><a href="index.php?exam-app-record-papers">组卷练习</a></li>
						</ul>
					</div>
					<div class="content-box padding">
						<div class="alert alert-danger">
							<p>由于错题组卷耗费大量资源，因此程序使用缓存错题进行出卷，因此组卷练习中，您可能会看不到今天新加入的试题，每天晚上刷新错题数据缓存。</p>
						</div>
						<form action="index.php?exam-app-record-selectquestions" method="post" action-before="clearStorage">
							<fieldset class="logbox">
								<div class="form-group underline">
									<label class="block">
										<div class="col-xs-4 tip">
											试卷名称
										</div>
										<div class="col-xs-8 form-inline">
											<input placeholder="填写试卷名称" type="text" name="args[title]" class="form-control" needle="needle" msg="请输入试卷名称"/>
										</div>
									</label>
								</div>
								<div class="form-group underline">
									<label class="block">
										<div class="col-xs-4 tip">
											做题时间
										</div>
										<div class="col-xs-8 form-inline">
											<input type="text" name="args[time]" class="form-control text-center" datatype="number" min="1" needle="needle" msg="请输入做题时间" size="2" value='60'/> 分钟
										</div>
									</label>
								</div>
								{x2;tree:$questype,quest,qid}
								{x2;if:v:quest['number']}
								<div class="form-group underline">
									<label class="block">
										<div class="col-xs-4 tip">
											{x2;v:quest['questype']}
										</div>
										<div class="col-xs-8 form-inline">
											共 {x2;v:quest['number']} 题，选 <input id="question_{x2;v:quest['questid']}" type="text" class="form-control text-center" name="args[number][{x2;v:quest['questid']}]" msg="{x2;v:quest['questype']}题量设置错误" maxvalue="{x2;v:quest['number']}" value="0" size="1"/> 题
										</div>
									</label>
								</div>
								{x2;endif}
								{x2;endtree}
								<div class="form-group  text-center">
									<button type="submit" class="btn btn-primary">开始测试</button>
									<input type="hidden" name="setExecriseConfig" value="1" />
								</div>
							</fieldset>
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