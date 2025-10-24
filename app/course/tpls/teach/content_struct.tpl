<ul>
	{x2;tree:$ids,id,iid}
		{x2;if:v:id == 'start'}
		<ul>
		{x2;elseif:v:id == 'end'}
		</ul>
		</li>
		{x2;elseif:$modules[$lessons[v:id]['coursemoduleid']]['modulecode'] == 'dirs'}
		<li>{x2;$lessons[v:id]['coursetitle']} [ {x2;$modules[$lessons[v:id]['coursemoduleid']]['modulename']}]
		{x2;else}
		<li>{x2;$lessons[v:id]['coursetitle']} [ {x2;$modules[$lessons[v:id]['coursemoduleid']]['modulename']}   ID：{x2;v:id}]</li>
		{x2;endif}
	{x2;endtree}
</ul>