<form action="index.php?exam-master-basic-resetstatus" method="post" class="form-horizontal">
	<div class="form-group">
		<label class="control-label col-sm-3">考生用户名：</label>
		<div class="col-sm-9" style="margin-top:7px;">{x2;$history['ehusername']}</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">考试名称：</label>
		<div class="col-sm-9" style="margin-top:7px;">{x2;$history['ehexam']}</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">试卷成绩：</label>
		<div class="col-sm-8" style="margin-top:7px;">{x2;$history['ehscore']}</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">考试时间：</label>
		<div class="col-sm-9" style="margin-top:7px;">{x2;date:$history['ehstarttime'],'Y-m-d H:i'}</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">评卷教师：</label>
		<div class="col-sm-8" style="margin-top:7px;">{x2;$history['ehteacher']}</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">评卷时间：</label>
		<div class="col-sm-8" style="margin-top:7px;">{x2;date:$history['ehdecidetime'],'Y-m-d H:i'}</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">重评原因：</label>
		<div class="col-sm-8" style="margin-top:7px;">
			<textarea class="form-control" rows="5" name="resetinfo"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3"></label>
		<div class="col-sm-8" style="margin-top:7px;">
			<button type="submit" class="btn btn-primary">提交</button>
			<input type="hidden" name="ehid" value="{x2;$history['ehid']}">
		</div>
	</div>
</form>