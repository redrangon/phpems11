{x2;if:!$userhash}
{x2;include:header}
<body>
{x2;include:nav}
<div class="container-fluid">
	<div class="row-fluid">
		<div class="main">
			<div class="col-xs-2 leftmenu">
				{x2;include:menu}
			</div>
			<div id="datacontent">
{x2;endif}
				<div class="box itembox" style="margin-bottom:0px;border-bottom:1px solid #CCCCCC;">
					<div class="col-xs-12">
						<ol class="breadcrumb">
							<li><a href="index.php?{x2;$_app}-master">{x2;$apps[$_app]['appname']}</a></li>
							<li><a href="index.php?{x2;$_app}-master-basic">考场管理</a></li>
							<li class="active">用户分析</li>
						</ol>
					</div>
				</div>
				<div class="box itembox" style="padding-top:10px;margin-bottom:0px;">
					<h4 class="title" style="padding:10px;">
						近20次考试成绩分析（平均分：{x2;$avg} 分）
					</h4>
					<div style="padding:10px;">
						<div style="height:360px;width:100%;" id="historylist"></div>
					</div>
				</div>
				<div class="box itembox" style="padding-top:10px;margin-bottom:0px;">
					<h4 class="title" style="padding:10px;">
						近20次考试题型掌握率分析
					</h4>
					<table class="table table-hover table-bordered">
						<tr class="info">
							<th>题型</th>
							<th>总题数</th>
							<th>答对题数</th>
							<th>总分</th>
							<th>得分</th>
						</tr>
						{x2;tree:$number,num,nid}
						{x2;if:v:num}
						<tr>
							<td>{x2;$questypes[v:key]['questype']}</td>
							<td>{x2;v:num}</td>
							<td>{x2;$right[v:key]}</td>
							<td>{x2;eval: echo number_format(v:num*$sessionvars['examsessionsetting']['examsetting']['questype'][v:key]['score'],1)}</td>
							<td>{x2;eval: echo number_format($score[v:key],1)}</td>
						</tr>
						{x2;endif}
						{x2;endtree}
					</table>
				</div>
				<div class="box itembox" style="padding-top:10px;margin-bottom:0px;">
					<h4 class="title" style="padding:10px;">
						近20次考试知识点掌握率分析
					</h4>
					<table class="table table-hover table-bordered">
						<tr class="info">
							<th>知识点</th>
							<th>总题数</th>
							<th>答对题数</th>
							<th>正确率</th>
						</tr>
						{x2;tree:$stats,stat,sid}
						{x2;if:v:stat}
						<tr>
							<td>{x2;v:stat['knows']}</td>
							<td>{x2;eval: echo intval(v:stat['number'])}</td>
							<td>{x2;eval: echo intval(v:stat['right'])}</td>
							<td>{x2;eval: echo number_format(100 * v:stat['right']/v:stat['number'],2)}%</td>
						</tr>
						{x2;endif}
						{x2;endtree}
					</table>
				</div>
			</div>
{x2;if:!$userhash}
		</div>
	</div>
</div>
{x2;include:footer}
<script>
	$(function(){
		var option = {
			xAxis: {
				type: 'category',
				data: {x2;eval: echo json_encode($charts['time'])}
			},
			yAxis: {
				type: 'value'
			},
			series: [{
				data: {x2;eval: echo json_encode($charts['score'])},
				type: 'line'
			}]
		};
		echarts.init($("#historylist")[0]).setOption(option);
	});
</script>
</body>
</html>
{x2;endif}