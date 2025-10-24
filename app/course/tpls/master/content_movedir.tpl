<ul style="line-height:3">
	<li>根目录 <a href="index.php?course-master-contents-movedir&source={x2;$source}&targetdir=base" class="ajax btn btn-primary pull-right" style="margin-top: 5px;">转入</a>
	{x2;tree:$ids,id,iid}
		{x2;if:v:id == 'start'}
		<ul>
		{x2;elseif:v:id == 'end'}
		</ul>
		</li>
		{x2;elseif:$modules[$lessons[v:id]['coursemoduleid']]['modulecode'] == 'dirs'}
		<li>
			{x2;$lessons[v:id]['coursetitle']}
			{x2;if:$source != v:id}
			<a href="index.php?course-master-contents-movedir&source={x2;$source}&targetdir={x2;v:id}" class="btn btn-primary ajax pull-right" style="margin-top: 5px;">
				转入
			</a>
			{x2;endif}
		{x2;endif}
	{x2;endtree}
</ul>