<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{x2;$sessionvars['examsessionsetting']['exam']}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body{
            font-size: 10pt;
            color:#000000;
        }
        p{
            line-height: 1.25;
        }
        .title{
            font-size: 14pt;
            font-weight: bold;
            text-align: center;
        }
        .smalltitle{
            font-size: 12pt;
            font-weight: bold;
        }
    </style>
</head>
<body>
<h2 class="title">{x2;$sessionvars['examsessionsetting']['exam']}</h2>
<p style="text-align: center">考试时间：{x2;$sessionvars['examsessionsetting']['examsetting']['examtime']}分钟 总分：{x2;$sessionvars['examsessionsetting']['examsetting']['score']} 及格分：{x2;$sessionvars['examsessionsetting']['examsetting']['passscore']}</p>

{x2;eval: v:oid = 0}
{x2;tree:$sessionvars['examsessionsetting']['examsetting']['questypelite'],lite,qid}
{x2;if:v:lite}
{x2;eval: v:quest = v:key}
{x2;if:$sessionvars['examsessionquestion']['questions'][v:quest] || $sessionvars['examsessionquestion']['questionrows'][v:quest]}
{x2;eval: v:oid++}
<h3>
   {x2;$ols[v:oid]}、{x2;$questype[v:quest]['questype']}{x2;$sessionvars['examsessionsetting']['examsetting']['questype'][v:quest]['describe']}
    (共{x2;$sessionvars['examsessionsetting']['examsetting']['questype'][v:qid]['number']}题，每题{x2;$sessionvars['examsessionsetting']['examsetting']['questype'][v:qid]['score']}分)
</h3>
{x2;eval: v:tid = 0}
{x2;tree:$sessionvars['examsessionquestion']['questions'][v:quest],question,qnid}
{x2;eval: v:tid++}
<div>
    <div>
        {x2;if:strtolower(substr(v:question['question'],0,9)) == "&lt;p&gt;"}
        {x2;eval:echo htmlspecialchars_decode(stripslashes("&lt;p&gt;".v:tid."、".substr(v:question['question'],9)))}
        {x2;else}
        {x2;v:tid}、{x2;realhtml:v:question['question']}
        {x2;endif}
    </div>
    {x2;if:!$questype[v:quest]['questsort']}
    {x2;if:v:question['questionselect'] && $questype[v:quest]['questchoice'] != 5}
    <div>
        {x2;realhtml:v:question['questionselect']}
    </div>
    {x2;endif}
    {x2;endif}
</div>
{x2;endtree}
{x2;tree:$sessionvars['examsessionquestion']['questionrows'][v:quest],questionrow,qrid}
{x2;eval: v:tid++}
<div>
    <div>
        {x2;if:strtolower(substr(v:questionrow['qrquestion'],0,9)) == "&lt;p&gt;"}
        {x2;eval:echo htmlspecialchars_decode(stripslashes("&lt;p&gt;".v:tid."、".substr(v:questionrow['qrquestion'],9)))}
        {x2;else}
        {x2;v:tid}、{x2;realhtml:v:questionrow['qrquestion']}
        {x2;endif}
    </div>
    {x2;tree:v:questionrow['data'],data,did}
    {x2;eval: v:qcid++}
    <div>
        {x2;if:strtolower(substr(v:data['question'],0,9)) == "&lt;p&gt;"}
        {x2;eval:echo htmlspecialchars_decode(stripslashes("&lt;p&gt;".v:did."、".substr(v:data['question'],9)))}
        {x2;else}
        {x2;v:did}、{x2;realhtml:v:data['question']}
        {x2;endif}
    </div>
    {x2;if:!$questype[v:quest]['questsort']}
    {x2;if:v:data['questionselect'] && $questype[v:quest]['questchoice'] != 5}
    <div>
        {x2;realhtml:v:data['questionselect']}
    </div>
    {x2;endif}
    {x2;endif}
    {x2;endtree}
</div>
{x2;endtree}
{x2;endif}
{x2;endif}
{x2;endtree}
</body>
</html>