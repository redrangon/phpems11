{x2;include:header}
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="pages">
            {x2;include:nav}
			<div class="content">
				<div class="col-xs-3" style="width: 20%">
					<div class="content-box padding">
                        {x2;include:menu}
					</div>
				</div>
				<div class="col-xs-9 nopadding" style="width: 80%">
					<div class="content-box padding">
						<h2 class="title">
							订单号：{x2;$order['ordersn']}
						</h2>
						<ul class="list-unstyled list-img">
							{x2;if:$order['orderapp'] == 'item'}
							<li class="border padding">
								{x2;$order['orderuserinfo']['province']} {x2;$order['orderuserinfo']['city']} {x2;$order['orderuserinfo']['area']} {x2;$order['orderuserinfo']['addressinfo']}
							</li>
							<li class="border padding">
								{x2;$order['orderuserinfo']['receiver']} {x2;$order['orderuserinfo']['phone']}
							</li>
							<li class="border padding">
								<div class="desc">
									<table class="table table-bordered">
										<tr class="info">
											<td>商品名</td>
											<td>数量</td>
											<td>价格</td>
										</tr>
										{x2;tree:$order['orderitems'],item,iid}
										<tr>
											<td>
												{x2;v:item['goodstitle']}
												{x2;tree:$mfields[v:item['goodsmoduleid']],field,fid}
												{x2;if:v:field['fieldsystem']}
												{x2;v:field['fieldtitle']}:{x2;v:item[v:field['field']]}&nbsp;
												{x2;endif}
												{x2;endtree}
												{x2;if:v:item['goodsinkind'] && $order['orderdescribe'][v:item['itemid']]}
												{x2;tree:$order['orderdescribe'][v:item['itemid']],code,coid}
												<br /><span style="font-size:1rem;">虚拟券码：{x2;v:code}</span>
												{x2;endtree}
												{x2;endif}
											</td>
											<td>{x2;v:item['number']}</td>
											<td>{x2;eval: echo v:item['itemprice']*v:item['number']} 元</td>
										</tr>
										{x2;endtree}
										<tr>
											<td colspan="3"><p class="text-right">￥{x2;$order['orderprice']} 元</p></td>
										</tr>
									</table>
									<p class="text-right">
										{x2;if:$order['orderbill']}
										<a class="btn btn-primary" href="{x2;$order['orderbill']}">下载发票</a>
										{x2;endif}
										{x2;if:$order['orderstatus'] == 1}
										{x2;if:PAYJSASWX == 'YES'}
										<a class="btn btn-info" href="index.php?user-app-payfor-payjs&ordersn={x2;$order['ordersn']}" target="_blank">微信支付</a>
										{x2;else}
										<a class="btn btn-success" href="index.php?user-app-payfor-wxpay&ordersn={x2;$order['ordersn']}" target="_blank">微信支付</a>
										{x2;endif}
										<a class="btn btn-primary ajax" href="index.php?user-app-payfor-alipay&ordersn={x2;$order['ordersn']}">支付宝支付</a>
										{x2;else}
										{x2;if:$order['orderstatus'] == 3}
										<a class="btn btn-danger confirm" msg="确定要收货吗？" href="index.php?user-app-payfor-finish&ordersn={x2;$order['ordersn']}">确认收货</a>
										{x2;else}
										<a class="btn btn-default">{x2;$orderstatus[$order['orderstatus']]}</a>
										{x2;endif}
										{x2;endif}
									</p>
								</div>
							</li>
							{x2;else}
							<li class="border padding">
								<div class="desc">
									<table class="table table-bordered">
										<tr class="info">
											<td>充值金额</td>
											<td>可兑换积分</td>
											<td>下单时间</td>
										</tr>
										<tr>
											<td>{x2;$order['orderprice']}</td>
											<td>{x2;eval:echo $order['orderprice']*10}</td>
											<td>{x2;date:$order['ordercreatetime'],'Y-m-d'}</td>
										</tr>
										<tr>
											<td colspan="3"><p class="text-right">应付款：￥{x2;$order['orderprice']} 元</p></td>
										</tr>
									</table>
									<p class="text-right">
                                        {x2;if:$order['orderbill']}
										<a class="btn btn-primary" href="{x2;$order['orderbill']}">下载发票</a>
										{x2;endif}
										{x2;if:$order['orderstatus'] == 1}
										{x2;if:WXPAY}
										{x2;if:PAYJSASWX == 'YES'}
										<a class="btn btn-info" href="index.php?user-app-payfor-payjs&ordersn={x2;$order['ordersn']}" target="_blank">微信支付</a>
										{x2;else}
										<a class="btn btn-success" href="index.php?user-app-payfor-wxpay&ordersn={x2;$order['ordersn']}" target="_blank">微信支付</a>
										{x2;endif}
										{x2;endif}
										{x2;if:ALIPAY}
										<a class="btn btn-primary ajax" href="index.php?user-app-payfor-alipay&ordersn={x2;$order['ordersn']}">支付宝支付</a>
										{x2;endif}
                                        {x2;else}
										<a class="btn">{x2;$orderstatus[$order['orderstatus']]}</a>
                                        {x2;endif}
									</p>
								</div>
							</li>
							{x2;endif}
						</ul>
					</div>
				</div>
			</div>
            {x2;include:footer}
		</div>
	</div>
</div>
</body>
</html>