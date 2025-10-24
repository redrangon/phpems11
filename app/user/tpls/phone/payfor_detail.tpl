{x2;if:!$userhash}
{x2;include:header}
<body>
<div class="pages">
    {x2;endif}
	<div class="page-tabs">
		<div class="page-header">
			<div class="col-1" onclick="javascript:history.back();"><span class="fa fa-chevron-left"></span></div>
			<div class="col-8">订单详情</div>
			<div class="col-1"><span class="fa fa-menu"></span></div>
		</div>
		<div class="page-content header">
			<div class="list-box bg nopadding">
				<ol>
					<li class="unstyled">
						<h4 class="bigtitle">订单号：{x2;$order['ordersn']}</h4>
					</li>
					{x2;if:$order['orderapp'] == 'item'}
					<li class="unstyled">
						<div class="rows info">
							{x2;$order['orderuserinfo']['receiver']} {x2;$order['orderuserinfo']['phone']}
							<div class="more">
								{x2;$order['orderuserinfo']['province']} {x2;$order['orderuserinfo']['city']} {x2;$order['orderuserinfo']['area']} {x2;$order['orderuserinfo']['addressinfo']}
							</div>
						</div>
					</li>
					{x2;tree:$order['orderitems'],cart,iid}
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
					{x2;if:v:cart['goodsinkind'] && $order['orderdescribe'][v:cart['itemid']]}
					{x2;tree:$order['orderdescribe'][v:cart['itemid']],code,coid}
					<li class="unstyled">虚拟券码：{x2;v:code}</li>
					{x2;endtree}
					{x2;endif}
					{x2;endtree}
					<li class="unstyled">
						<h5 class="text-right text-danger">￥{x2;$order['orderprice']} 元</h5>
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
								<td>{x2;$order['orderprice']}</td>
								<td>{x2;eval:echo $order['orderprice']*10}</td>
								<td>{x2;date:$order['ordercreatetime'],'Y-m-d'}</td>
							</tr>
							<tr>
								<td colspan="3"><p class="text-right">应付款：￥{x2;$order['orderprice']}</p></td>
							</tr>
						</table>
					</li>
					{x2;endif}
					{x2;if:$order['orderbill']}
					<li class="unstyled">
						<div class="rows text-center">
							<a class="btn block primary" target="_blank" href="{x2;$order['orderbill']}">下载发票</a>
						</div>
					</li>
					{x2;endif}
					{x2;if:$order['orderstatus'] == 1}
					{x2;if:WXPAY}
					{x2;if:$result['return_code'] != 'FAIL'}
					<li class="unstyled">
						<div class="rows text-center">
                            <a class="btn success block" href="{x2;$result['mweb_url']}">微信支付</a>
						</div>
					</li>
					{x2;endif}
					{x2;endif}
					{x2;if:ALIPAY}
					<li class="unstyled">
						<div class="rows text-center">
							<a class="btn primary block" href="{x2;$payforurl}">支付宝支付</a>
						</div>
					</li>
					{x2;endif}
					{x2;else}
					{x2;if:$order['orderstatus'] == 3}
					<li class="unstyled">
						<div class="rows text-center">
							<a class="btn danger block confirm" message="确定要收货吗？" href="index.php?user-phone-payfor-finish&ordersn={x2;$order['ordersn']}">确认收货</a>
						</div>
					</li>
					{x2;else}
					<li class="unstyled">
						<div class="rows text-center">
							<a class="btn block">{x2;$orderstatus[$order['orderstatus']]}</a>
						</div>
					</li>
					{x2;endif}
					{x2;endif}
				</ol>
			</div>
		</div>
	</div>
    {x2;if:!$userhash}
</div>
</body>
</html>
{x2;endif}