{x2;include:header}
<style>
	.btn-default{
		background: #e5e5e5;
	}
	.btn-default.btn-primary{
		background: #286090;
	}
	.btn.btn-default2,.btn.btn-default.btn-default2{
		background: #FFFFFF;
		border-color: #ccc;
		color:#333333;
	}
	::-webkit-scrollbar { width: 7px; height: 7px; background-color: transparent; }
	::-webkit-scrollbar-track { background-color: #F5F5F5; }
	::-webkit-scrollbar-thumb { border-radius: 5px; background-color: hsla(220, 4%, 58%, 0.3); }
</style>
<body style="background: #408aa7;">
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pages">
			<div class="header" style="background: #408aa7;color:#FFFFFF;border-bottom: 0px;">
				<div class="nav" style="width: 100%;">
					<div class="col-xs-9">
						<ul class="list-unstyled list-inline text-center">
							<li>
								<h2 class="logo">{x2;$sessionvars['examsession']}</h2>
							</li>
						</ul>
					</div>
					<div class="col-xs-3">
						<ul class="list-unstyled list-inline">
							<li class="pull-right" style="padding-top: 20px;">
								<a class="btn btn-lg btn-default" style="color: #eea236"><span id="timer_h">00</span>：<span id="timer_m">00</span>：<span id="timer_s">00</span></a>
								<a href="javascript:;" onclick="javascript:$('#submodal').modal();" class="btn btn-lg btn-warning">
									<span class="glyphicon glyphicon-print"></span> 确定交卷
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="content" style="width: 100%;">
				<div style="width: 350px;padding:0px 15px;float: left;">
					<div class="content-box" style="background: #284263;color:#FFFFFF;height:calc(100vh - 130px);padding:10px;">
						<div class="text-center">
							<img src="{x2;$_user['userphoto']}" height="150"/>
						</div>
						<div style="margin: 5px 10px;border: 2px solid #586d8a;border-radius: 4px;background: #384967;padding:10px;">
							<p>姓名：张三</p>
							<p>性别：男</p>
							<p>证件类型：身份证</p>
							<p>证件号码：<br />101123456789023145</p>
							<p>准考证号：202423456</p>
							<p>考试科目：特种作业理论考试理论考场</p>
							<p>考试类型：初次取证</p>
							<p>考场：理论考场</p>
							<p>机位号：001</p>
							<p>考试状态：初考</p>
						</div>
						<div style="margin: 5px 10px;">
							<img src="files/public/img/paper.jpg" width="100%"/>
							<p style="margin-top: 5px">
								温馨提示：考试过程中，务必保证摄像头对准考生面部，确保考生人像完成呈现在取景框内且无遮挡，系统不定时对考生人像进行核验，核验失败将影响考试进程，请悉知。
							</p>
						</div>
					</div>
				</div>
				<div style="width: 350px;float: right;padding:0px 15px;">
					<div class="content-box" id="questionindex" style="height:calc(100vh - 130px);padding:15px;overflow-y: auto;">
						<div>
							<span style="font-size: 24px;display: inline-block;">字体大小:</span>
							<a class="btn btn-default fsizebtn" size="18">大</a>
							<a class="btn btn-default btn-default2 fsizebtn" size="16">中</a>
							<a class="btn btn-default fsizebtn" size="14">小</a>
						</div>
						<hr />
						<div>
							<h4 class="text-center">答题情况</h4>
							<p class="text-center">
								总题：<span class="allquestionnumber">50</span>&nbsp;&nbsp;
								已答：<span class="yesdonumber">50</span>&nbsp;&nbsp;
								剩余：<span class="nodonumber">50</span>
							</p>
							<p class="text-center">
								<span style="display: inline-block;width: 200px;margin: auto">
									<span class="col-xs-4 text-center"><a class="btn btn-default">&nbsp;&nbsp;</a><br />未答</span>
									<span class="col-xs-4 text-center"><a class="btn btn-default btn-default2">&nbsp;&nbsp;</a><br />在答</span>
									<span class="col-xs-4 text-center"><a class="btn btn-primary">&nbsp;&nbsp;</a><br />已答</span>
								</span>
							</p>
							<div style="clear: both"></div>
						</div>
						{x2;eval: v:oid = 0}
						{x2;eval: v:qmid = 0}
						{x2;tree:$sessionvars['examsessionsetting']['examsetting']['questypelite'],lite,qid}
						{x2;if:v:lite}
						{x2;eval: v:quest = v:key}
						{x2;if:$sessionvars['examsessionquestion']['questions'][v:quest] || $sessionvars['examsessionquestion']['questionrows'][v:quest]}
						{x2;if:$data['currentbasic']['basicexam']['changesequence']}
						{x2;eval: shuffle($sessionvars['examsessionquestion']['questions'][v:quest]);}
						{x2;eval: shuffle($sessionvars['examsessionquestion']['questionrows'][v:quest]);}
						{x2;endif}
						{x2;eval: v:oid++}
						<h3 class="title">
							{x2;$questype[v:quest]['questype']}
						</h3>
						<ul class="list-unstyled list-img">
							<li id="qt_{x2;v:quest}">
								{x2;eval: v:tid = 0}
								{x2;tree:$sessionvars['examsessionquestion']['questions'][v:quest],question,qnid}
								{x2;eval: v:tid++}
								{x2;eval: v:qmid++}
								<a id="sign_{x2;v:question['questionid']}" data-questionid="{x2;v:question['questionid']}" href="javascript:;" class="btn btn-default qindex{x2;if:$sessionvars['examsessionsign'][v:question['questionid']]} btn-danger{x2;endif}">{x2;v:tid}</a>
								{x2;endtree}
								{x2;tree:$sessionvars['examsessionquestion']['questionrows'][v:quest],questionrow,qrid}
								{x2;tree:v:questionrow['data'],question,did}
								{x2;eval: v:tid++}
								{x2;eval: v:qmid++}
								<a id="sign_{x2;v:question['questionid']}" data-questionid="{x2;v:question['questionid']}" href="javascript:;" class="btn btn-default qindex{x2;if:$sessionvars['examsessionsign'][v:question['questionid']]} btn-danger{x2;endif}">{x2;v:tid}</a>
								{x2;endtree}
								{x2;endtree}
							</li>
						</ul>
						{x2;endif}
						{x2;endif}
						{x2;endtree}
					</div>
				</div>
				<form id="paper" action="index.php?exam-app-exampaper-score">
					{x2;eval: v:oid = 0}
					{x2;eval: v:qcid = 0}
					{x2;tree:$sessionvars['examsessionsetting']['examsetting']['questypelite'],lite,qid}
					{x2;if:v:lite}
					{x2;eval: v:quest = v:key}
					{x2;if:$sessionvars['examsessionquestion']['questions'][v:quest] || $sessionvars['examsessionquestion']['questionrows'][v:quest]}
					{x2;eval: v:oid++}
					{x2;eval: v:tid = 0}
					{x2;tree:$sessionvars['examsessionquestion']['questions'][v:quest],question,qnid}
					{x2;eval: v:tid++}
					{x2;eval: v:qcid++}
					<div class="content-box padding" data-questionid="{x2;v:question['questionid']}">
						<h2 class="title">
							{x2;$questype[v:quest]['questype']}{x2;$sessionvars['examsessionsetting']['examsetting']['questype'][v:quest]['describe']}
							<input id="time_{x2;v:question['questionid']}" type="hidden" name="time[{x2;v:question['questionid']}]"/>
						</h2>
						<ul class="list-unstyled list-img questionul" style="height:calc(100vh - 271px)">
							<li class="morepadding text-center">
								<h2>第 {x2;v:tid} 题</h2>
							</li>
							<li class="border morepadding">
								<div class="desc">
									<p>{x2;realhtml:v:question['question']}</p>
								</div>
							</li>
							{x2;if:$questype[v:quest]['questsort']}
							<li class="border morepadding">
								{x2;eval: $data = v:question}
								{x2;include:plugin_editor}
							</li>
							{x2;else}
							{x2;if:$questype[v:quest]['questchoice'] != 5}
							<li class="border morepadding">
								<div class="desc">
									<p>{x2;realhtml:v:question['questionselect']}</p>
								</div>
							</li>
							{x2;endif}
							<li class="border morepadding">
								<div class="nopadding desc">
									{x2;if:$questype[v:quest]['questchoice'] == 1 || $questype[v:quest]['questchoice'] == 4}
									{x2;tree:$selectorder,so,sid}
									{x2;if:v:key == v:question['questionselectnumber']}
									{x2;eval: break;}
									{x2;endif}
									<label class="inline"><input type="radio" name="question[{x2;v:question['questionid']}]" rel="{x2;v:question['questionid']}" value="{x2;v:so}" {x2;if:v:so == $sessionvars['examsessionuseranswer'][v:question['questionid']]}checked{x2;endif}/><span class="selector">{x2;v:so}</span> </label>
									{x2;endtree}
									{x2;elseif:$questype[v:quest]['questchoice'] == 5}
									<input type="text" name="question[{x2;v:question['questionid']}]" placeholder="点击此处填写答案" value="{x2;$sessionvars['examsessionuseranswer'][v:question['questionid']]}" rel="{x2;v:question['questionid']}"/>
									{x2;else}
									{x2;tree:$selectorder,so,sid}
									{x2;if:v:key >= v:question['questionselectnumber']}
									{x2;eval: break;}
									{x2;endif}
									<label class="inline"><input type="checkbox" name="question[{x2;v:question['questionid']}][{x2;v:key}]" rel="{x2;v:question['questionid']}" value="{x2;v:so}" {x2;if:in_array(v:so,$sessionvars['examsessionuseranswer'][v:question['questionid']])}checked{x2;endif}/><span class="selector">{x2;v:so}</span> </label>
									{x2;endtree}
									{x2;endif}
								</div>
							</li>
							{x2;endif}
						</ul>
						<div class="text-center">
							<a class="jump prev btn btn-primary">上一题</a>
							<a class="jump next btn btn-primary">下一题</a>
						</div>
					</div>
					{x2;endtree}
					{x2;tree:$sessionvars['examsessionquestion']['questionrows'][v:quest],questionrow,qnid}
					{x2;tree:v:questionrow['data'],question,did}
					{x2;eval: v:tid++}
					{x2;eval: v:qcid++}
					<div class="content-box padding" data-questionid="{x2;v:question['questionid']}">
						<h2 class="title">
							{x2;$questype[v:quest]['questype']}{x2;$sessionvars['examsessionsetting']['examsetting']['questype'][v:quest]['describe']}
							<input id="time_{x2;v:question['questionid']}" type="hidden" name="time[{x2;v:question['questionid']}]"/>
						</h2>
						<ul class="list-unstyled list-img questionul" style="height:calc(100vh - 271px)">
							<li class="morepadding text-center">
								<h2>第 {x2;v:tid} 题</h2>
							</li>
							<li class="border morepadding">
								<div class="desc">
									<p>{x2;realhtml:v:questionrow['qrquestion']}</p>
								</div>
							</li>
							<li class="border morepadding">
								<div class="desc">
									<p>{x2;realhtml:v:question['question']}</p>
								</div>
							</li>
							{x2;if:$questype[v:question['questiontype']]['questsort']}
							<li class="border morepadding">
								{x2;eval: $data = v:question}
								{x2;include:plugin_editor}
							</li>
							{x2;else}
							{x2;if:$questype[v:question['questiontype']]['questchoice'] != 5}
							<li class="border morepadding">
								<div class="desc">
									<p>{x2;realhtml:v:question['questionselect']}</p>
								</div>
							</li>
							{x2;endif}
							<li class="border morepadding">
								<div class="nopadding desc">
									{x2;if:$questype[v:question['questiontype']]['questchoice'] == 1 || $questype[v:question['questiontype']]['questchoice'] == 4}
									{x2;tree:$selectorder,so,sid}
									{x2;if:v:key == v:question['questionselectnumber']}
									{x2;eval: break;}
									{x2;endif}
									<label class="inline"><input type="radio" name="question[{x2;v:question['questionid']}]" rel="{x2;v:question['questionid']}" value="{x2;v:so}" {x2;if:v:so == $sessionvars['examsessionuseranswer'][v:question['questionid']]}checked{x2;endif}/><span class="selector">{x2;v:so}</span> </label>
									{x2;endtree}
									{x2;elseif:$questype[v:question['questiontype']]['questchoice'] == 5}
									<input type="text" name="question[{x2;v:question['questionid']}]" placeholder="点击此处填写答案" value="{x2;$sessionvars['examsessionuseranswer'][v:question['questionid']]}" rel="{x2;v:question['questionid']}"/>
									{x2;else}
									{x2;tree:$selectorder,so,sid}
									{x2;if:v:key >= v:question['questionselectnumber']}
									{x2;eval: break;}
									{x2;endif}
									<label class="inline"><input type="checkbox" name="question[{x2;v:question['questionid']}][{x2;v:key}]" rel="{x2;v:question['questionid']}" value="{x2;v:so}" {x2;if:in_array(v:so,$sessionvars['examsessionuseranswer'][v:question['questionid']])}checked{x2;endif}/><span class="selector">{x2;v:so}</span> </label>
									{x2;endtree}
									{x2;endif}
								</div>
							</li>
							{x2;endif}
						</ul>
						<div class="text-center">
							<a class="jump prev btn btn-primary">上一题</a>
							<a class="jump next btn btn-primary">下一题</a>
						</div>
					</div>
					{x2;endtree}
					{x2;endtree}
					{x2;endif}
					{x2;endif}
					{x2;endtree}
					<input type="hidden" name="insertscore" value="1"/>
					<input type="hidden" name="token" value="{x2;$token}"/>
					<input type="hidden" name="sessionid" value="{x2;$sessionvars['examsessionid']}"/>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="submodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">交卷</h4>
			</div>
			<div class="modal-body">
				<p>共有试题 <span class="allquestionnumber">50</span> 题，已做 <span class="yesdonumber">0</span> 题。您确认要交卷吗？</p>
			</div>
			<div class="modal-footer">
				<button type="button" onclick="javascript:submitPaper();" class="btn btn-primary">确定交卷</button>
				<button aria-hidden="true" class="btn" type="button" data-dismiss="modal">再检查一下</button>
			</div>
		</div>
	</div>
</div>
{x2;include:paper_footer}
<script>
	$(function(){
		$.get('index.php?exam-app-index-ajax-lefttime&sessionid={x2;$sessionvars['examsessionid']}&rand'+Math.random(),function(data){
			var setting = {
				time:{x2;eval: echo intval($sessionvars['examsessiontime'])},
				hbox:$("#timer_h"),
				mbox:$("#timer_m"),
				sbox:$("#timer_s"),
				finish:function(){
					submitPaper();
				}
			}
			setting.lefttime = parseInt(data);
			clock = new countdown(setting);
		});
		setInterval(saveanswer,120000);
		$('#paper .content-box').hide().eq(0).show().find('.btn.jump.prev').remove();
		$('#paper .content-box:last').find('.btn.jump.next').remove();
		$('#questionindex .qindex').eq(0).addClass('btn-default2');
		function goprev()
		{
			var _this = $(this);
			var index = _this.parents('.content-box').index();
			if(index >= 1)
			{
				$('#paper .content-box').hide().eq(index - 1).show();
				$('#questionindex .qindex').removeClass('btn-default2');
				$('#questionindex .qindex').eq(index - 1).addClass('btn-default2');
			}
		}
		function gonext()
		{
			var _this = $(this);
			var index = _this.parents('.content-box').index();
			if(index < $('#paper .content-box').length - 1)
			{
				$('#paper .content-box').hide().eq(index + 1).show();
				$('#questionindex .qindex').removeClass('btn-default2');
				$('#questionindex .qindex').eq(index + 1).addClass('btn-default2');
			}
		}
		$('.btn.jump.prev').on('click',goprev);
		$('.btn.jump.next').on('click',gonext);
		$('#questionindex .qindex').on('click',function(){
			var id = $(this).attr('data-questionid');
			$('#paper .content-box').hide();
			$("#paper .content-box[data-questionid="+id+"]").show();
			$('#questionindex .qindex').removeClass('btn-default2');
			$(this).addClass('btn-default2');
		});
		$('.fsizebtn').on('click',function(){
			$('.fsizebtn').removeClass('btn-default2');
			$(this).addClass('btn-default2');
			$('.questionul li').css("fontSize",$(this).attr('size')+'px');
			$('.questionul li p').css("fontSize",$(this).attr('size')+'px');
		});
		$(document).keyup(function(e){
			var key =  e.which;
			var box = $('#paper .content-box:visible');
			if(key == 37){
				box.find('.jump.badge.prev:first').trigger('click');
			}
			else if(key == 39){
				box.find('.jump.badge.next:first').trigger('click');
			}
		});
		$('.footer').css('position','fixed').css('bottom','0px').css('width','100%');
	});
</script>
</body>
</html>