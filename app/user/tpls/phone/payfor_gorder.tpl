{x2;if:!$userhash}
{x2;include:header}
<body>
<div class="pages">
    {x2;endif}
	<div class="page-tabs">
		<div class="page-header">
			<div class="col-1" onclick="javascript:history.back();"><span class="fa fa-chevron-left"></span></div>
			<div class="col-8">查看订单</div>
			<div class="col-1"><span class="fa fa-menu"></span></div>
		</div>
		<div class="page-content header footer">
			<form class="list-box bg top" action="index.php?user-phone-payfor-morder" method="post">
				<div class="form-group">
					<div class="col-7" >
						<input type="search" needle="needle" msg="请输入订单号" class="form-control block" name="ordersn" placeholder="请输入订单号">
					</div>
					<div class="col-3 tip">
						<button class="primary">提交</button>
					</div>
				</div>
			</form>
			{x2;tree:$orders['data'],order,oid}
			<a href="index.php?user-phone-payfor-morder&ordersn={x2;v:order['ordersn']}" class="ajax">
				<div class="list-box bg top">
					<ol>
						<li class="unstyled">
							<h4 class="bigtitle">
								{x2;v:order['ordersn']}
								<span class="pull-right" style="font-weight: normal;font-size: 0.14rem;">
									{x2;$orderstatus[v:order['orderstatus']]}
								</span>
							</h4>
						</li>
						{x2;if:v:order['orderapp'] == 'item'}
						{x2;tree:v:order['orderitems'],cart,iid}
						<li class="unstyled">
							<div class="col-4x">
								<div class="rows illus">
									<img src="{x2;if:v:cart['itemthumb']}{x2;v:cart['itemthumb']}{x2;else}files/public/img/paper.jpg{x2;endif}">
								</div>
							</div>
							<div class="col-5">
								<div class="rows info">
									<p class="intro">
										{x2;substring:v:cart['goodstitle'],48}
										<br />
										<span>
											{x2;tree:$mfields[v:cart['goodsmoduleid']],field,fid}
											{x2;if:v:field['fieldsystem']}
											{x2;v:field['fieldtitle']}:{x2;v:cart[v:field['field']]}&nbsp;
											{x2;endif}
											{x2;endtree}
											</span>
									</p>

								</div>
							</div>
							<div class="col-4x">
								<h5 class="title text-danger text-right">￥{x2;v:cart['itemprice']}</h5>
								<p class="text-right"> * {x2;v:cart['number']}</p>
							</div>
						</li>
						{x2;endtree}
						<li class="unstyled">
							<h5 class="text-right text-danger">￥ {x2;v:order['orderprice']} 元</h5>
						</li>
						{x2;else}
						<li class="unstyled">
							<table class="table table-bordered">
								<thead>
								<td>充值金额</td>
								<td>可兑换积分</td>
								<td>下单时间</td>
								</thead>
								<tr>
									<td>{x2;v:order['orderprice']}</td>
									<td>{x2;eval:echo v:order['orderprice']*10}</td>
									<td>{x2;date:v:order['ordercreatetime'],'Y-m-d'}</td>
								</tr>
								<tr>
									<td colspan="3"><p class="text-right">应付款：￥{x2;v:order['orderprice']}</p></td>
								</tr>
							</table>
						</li>
						{x2;endif}
					</ol>
				</div>
			</a>
			{x2;endtree}
		</div>
		{x2;if:$orders['pages']}
		<div class="page-footer">
			<ul class="pagination">{x2;$orders['pages']}</ul>
		</div>
		{x2;endif}
	</div>
    {x2;if:!$userhash}
</div>
</body>
</html>
{x2;endif}