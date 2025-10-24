<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{x2;v:sessionvars['examsession']}</title>
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
{x2;tree:$sessionvars,sessionvars,sid}
<h2 class="title">{x2;v:sessionvars['examsession']}</h2>
<p style="text-align: center">姓名：{x2;$users[v:sessionvars['userid']]['usertruename']} 得分：{x2;v:sessionvars['examsessionscore']} 年级：{x2;$users[v:sessionvars['userid']]['usertruename']}</p>
{x2;eval: v:oid = 0}
{x2;tree:v:sessionvars['examsessionsetting']['examsetting']['questypelite'],lite,qid}
{x2;if:v:lite}
{x2;eval: v:quest = v:key}
{x2;if:v:sessionvars['examsessionquestion']['questions'][v:quest] || v:sessionvars['examsessionquestion']['questionrows'][v:quest]}
{x2;eval: v:oid++}
<div class="smalltitle">
    {x2;$ols[v:oid]}、{x2;$questype[v:quest]['questype']}{x2;v:sessionvars['examsessionsetting']['examsetting']['questype'][v:quest]['describe']}
</div>
{x2;eval: v:tid = 0}
{x2;tree:v:sessionvars['examsessionquestion']['questions'][v:quest],question,qnid}
{x2;eval: v:tid++}
<div>
    <p>
        第{x2;v:tid}题 得分：{x2;v:sessionvars['examsessionscorelist'][v:question['questionid']]}分
    </p>
    <div>
        {x2;realhtml:v:question['question']}
    </div>
    {x2;if:!$questype[v:quest]['questsort']}
    {x2;if:v:question['questionselect'] && $questype[v:quest]['questchoice'] != 5}
    <div>
        {x2;realhtml:v:question['questionselect']}
    </div>
    {x2;endif}
    {x2;endif}
    <div>
        <div>
            考生答案：{x2;if:is_array(v:sessionvars['examsessionuseranswer'][v:question['questionid']])}{x2;eval: echo implode('',v:sessionvars['examsessionuseranswer'][v:question['questionid']])}{x2;else}{x2;realhtml:v:sessionvars['examsessionuseranswer'][v:question['questionid']]}{x2;endif}
        </div>
        <div>
            正确答案：{x2;realhtml:v:question['questionanswer']}
        </div>
    </div>
</div>
{x2;endtree}
{x2;tree:v:sessionvars['examsessionquestion']['questionrows'][v:quest],questionrow,qrid}
{x2;eval: v:tid++}
<div>
    <p>第{x2;v:tid}题</h4>
    <div>
        {x2;realhtml:v:questionrow['qrquestion']}
    </div>
    {x2;tree:v:questionrow['data'],data,did}
    {x2;eval: v:qcid++}
    <div style="background:#FFFFFF;border-right:1px solid #CCCCCC;border-top:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC;">
        <p>
            第{x2;v:did}题 得分：{x2;v:sessionvars['examsessionscorelist'][v:data['questionid']]}分
        </p>
        <div>
            {x2;realhtml:v:data['question']}
        </div>
        {x2;if:!$questype[v:quest]['questsort']}
        {x2;if:v:data['questionselect'] && $questype[v:quest]['questchoice'] != 5}
        <div>
            {x2;realhtml:v:data['questionselect']}
        </div>
        {x2;endif}
        {x2;endif}
        <div>
            <div>
                考生答案：{x2;if:is_array(v:sessionvars['examsessionuseranswer'][v:data['questionid']])}{x2;eval: echo implode('',v:sessionvars['examsessionuseranswer'][v:data['questionid']])}{x2;else}{x2;realhtml:v:sessionvars['examsessionuseranswer'][v:data['questionid']]}{x2;endif}
            </div>
            <div>
                正确答案：{x2;realhtml:v:data['questionanswer']}
            </div>
        </div>
    </div>
    {x2;endtree}
</div>
{x2;endtree}
{x2;endif}
{x2;endif}
{x2;endtree}
{x2;endtree}
</body>
</html>