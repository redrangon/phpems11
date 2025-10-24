{x2;tree:$ids,id,iid}
{x2;if:v:id == 'start'}
<ul class="list-unstyled list-txt hide" style="border-top:none;">
    {x2;elseif:v:id == 'end'}
</ul>
</li>
{x2;elseif:$modules[$lessons[v:id]['coursemoduleid']]['modulecode'] == 'dirs'}
<li class="border">
    <a class="coursedir">{x2;$lessons[v:id]['coursetitle']}</a>
    {x2;else}
<li class="border" style="line-height: 30px;">
    <a href="index.php?course-app-course&csid={x2;$course['csid']}&contentid={x2;v:id}"{x2;if:v:id == $content['courseid']} class="courseactive"{x2;endif}>
        {x2;$lessons[v:id]['coursetitle']}<br>
        <span style="font-size:12px;color: #999999;margin-left:22px;">{x2;if:$logs[$lessons[v:id]['courseid']] && $logs[$lessons[v:id]['courseid']]['logstatus'] == 1}已学完{x2;elseif:$logs[$lessons[v:id]['courseid']] && $logs[$lessons[v:id]['courseid']]['logstatus'] == 0}上次学到{x2;eval: echo intval($logs[$lessons[v:id]['courseid']]['logprogress'] / 60)}分{x2;eval: echo $logs[$lessons[v:id]['courseid']]['logprogress'] % 60}秒{x2;else}未学习{x2;endif}</span>
    </a>
    <div style="clear: both;"></div>
</li>
{x2;endif}
{x2;endtree}