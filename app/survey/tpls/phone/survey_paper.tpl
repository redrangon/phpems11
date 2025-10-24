{x2;if:!$userhash}
{x2;include:header}
<body>
<div class="pages">
	{x2;endif}
	<div class="page-tabs">
		<div class="page-header">
			<div class="col-1" onclick="javascript:history.back();"><span class="fa fa-chevron-left"></span></div>
			<div class="col-8">{x2;$survey['svytitle']}</div>
			<div class="col-1"><span class="fa fa-menu hide"></span></div>
		</div>
		<div class="page-content header footer" data-nocache="yes" style="height: 100%;overflow: hidden">
			<form method="post" action="index.php?survey-app-survey-paper&svyid={x2;$survey['svyid']}" class="list-box bg" style="height: 100%;" id="exampaper">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						{x2;tree:$nodes,node,nid}
						{x2;tree:$questions[v:node['syneid']],question,qid}
						<div class="swiper-slide" style="overflow-y: scroll">
							<ol>
								<li class="unstyled">
									<h4 class="title">
										{x2;v:node['synetitle']}
									</h4>
								</li>
								<li class="unstyled">
									第 {x2;v:qid} 题 【 {x2;$questypes[v:question['syqnquestiontype']]['questype']}】
								</li>
								<li class="unstyled">
									<div class="rows">
										<p>{x2;realhtml:v:question['syqnquestion']}</p>
									</div>
								</li>
								{x2;if:!$questypes[v:question['syqnquestiontype']]['questsort'] && $questypes[v:question['syqnquestiontype']]['questchoice'] != 5}
								<li class="unstyled">
									<div class="rows">
										<p>{x2;realhtml:v:question['syqnquestionselect']}</p>
									</div>
								</li>
								{x2;endif}
								{x2;if:$questypes[v:question['syqnquestiontype']]['questsort']}
								<li class="unstyled">
									{x2;eval: $data = v:question}
									{x2;include:plugin_editor}
								</li>
								{x2;else}
								<li class="unstyled">
									<div class="rows">
										{x2;if:$questypes[v:question['syqnquestiontype']]['questchoice'] == 1 || $questypes[v:question['syqnquestiontype']]['questchoice'] == 4}
										{x2;tree:$selectors,so,sid}
										{x2;if:v:key == v:question['syqnquestionselectnumber']}
										{x2;eval: break;}
										{x2;endif}
										<label class="inline"><input type="radio" name="question[{x2;v:question['syqnid']}]" rel="{x2;v:question['syqnid']}" value="{x2;v:so}" {x2;if:v:so == $sessionvars['examsessionuseranswer'][v:question['syqnid']]}checked{x2;endif}/><span class="selector">{x2;v:so}</span> </label>
										{x2;endtree}
										{x2;elseif:$questypes[v:question['syqnquestiontype']]['questchoice'] == 5}
										<input type="text" name="question[{x2;v:question['syqnid']}]" placeholder="点击此处填写答案" value="{x2;$sessionvars['examsessionuseranswer'][v:question['syqnquestiontype']['questionid']]}" rel="{x2;v:question['syqnid']}"/>
										{x2;else}
										{x2;tree:$selectors,so,sid}
										{x2;if:v:key >= v:question['syqnquestionselectnumber']}
										{x2;eval: break;}
										{x2;endif}
										<label class="inline"><input type="checkbox" name="question[{x2;v:question['syqnid']}][{x2;v:key}]" rel="{x2;v:question['syqnid']}" value="{x2;v:so}" {x2;if:is_array($sessionvars['examsessionuseranswer'][v:question['syqnid']]) && in_array(v:so,$sessionvars['examsessionuseranswer'][v:question['syqnid']])}checked{x2;endif}/><span class="selector">{x2;v:so}</span> </label>
										{x2;endtree}
										{x2;endif}
									</div>
								</li>
								{x2;endif}
							</ol>
						</div>
						{x2;endtree}
						{x2;endtree}
					</div>
				</div>
				<input type="hidden" name="submitpaper" value="1">
			</form>
		</div>
		<div class="page-footer">
			<div class="col-10">
				<ol class="pagination">
					<li class="col-10 text-center">
						<button class="subpaperbtn block" id="nextquestion">下一题</button>
						<button class="subpaperbtn block hide" id="submitpaper">交卷</button>
					</li>
				</ol>
			</div>
		</div>
	</div>
	<script>
		$(function(){
			var mySwiper = new Swiper ('.swiper-container',{
				on: {
					slideChangeTransitionEnd: function(){
						if(mySwiper.isEnd)
						{
							$('#submitpaper').removeClass('hide');
							$('#nextquestion').addClass('hide');
						}
						else
						{
							$('#nextquestion').removeClass('hide');
							$('#submitpaper').addClass('hide');
						}
					}
				}
			});
			$('#nextquestion').on('click',function(){
				mySwiper.slideNext();
			});
			$('#submitpaper').on('click',function(){
				pep.mask.show('confirm',{message:'确定要交卷吗？'},function(){
					$('#exampaper').submit();
				});
			});
		});
	</script>
	{x2;if:!$userhash}
</div>
</body>
</html>
{x2;endif}