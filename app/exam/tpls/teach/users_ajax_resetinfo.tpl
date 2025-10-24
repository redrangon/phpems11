<table class="table table-striped table-bordered table-hover">
	<thead>
	<tr class="text-center info">
		<td width="120">操作人</td>
		<td width="200">操作时间</td>
		<td width="100">操作类型</td>
		<td>操作说明</td>
	</tr>
	</thead>
	<tbody>
	{x2;tree:$logs,log,lid}
	<tr>
		<td class="text-center">{x2;v:log['username']}</td>
		<td class="text-center">{x2;date:v:log['ehltime'],'Y-m-d H:i:s'}</td>
		<td>{x2;if:v:log['ehltype'] == 1}评卷{x2;elseif:v:log['ehltype'] == 2}重新评卷{x2;elseif:v:log['ehltype'] == 3}补考{x2;endif}</td>
		<td>{x2;v:log['ehlinfo']}</td>
	</tr>
	{x2;endtree}
	</tbody>
</table>