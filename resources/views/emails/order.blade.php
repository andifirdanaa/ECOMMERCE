<!DOCTYPE html>
<html>
<head>
	<title>Register Email</title>
</head>
<body>
		<table width="700px";>
			<tr><td>&nbsp;</td></tr>
			<tr><td><img src="{{ asset('argon/img/Mark.png') }}"></td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>Hello {{$name}},</a></td></tr>
			<tr><td>&nbsp;</td></tr>
			<td><tr>Thank you for shopping with us. Your order details are as below : -</tr></td>
			<tr><td>&nbsp;</td></tr>
			<tr><td>Order No : {{$order_id}}</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td>
				<table  width="95%" cellpadding="5" cellspacing="5" bgcolor="#e0d9d9">
					<tr bgcolor="#CCCCCC">
						<td>Product Name</td>
						<td>Product Code</td>
						<td>Size</td>
						<td>Color</td>
						<td>Quantity</td>
						<td>Unit Price</td>
					</tr>
					@foreach($productDetails['orders'] as $product)
						<td>{{$product['product_name']}}</td>
						<td>{{$product['product_code']}}</td>
						<td>{{$product['product_size']}}</td>
						<td>{{$product['product_color']}}</td>
						<td>{{$product['product_qty']}}</td>
						<td>Rp. {{$product['product_price']}}</td>
					@endforeach
				
				<tr>
					<td colspan="5" align="right">Shipping Charges</td><td>{{
					$productDetails['shipping_charges'] }}</td>
				</tr>
				<tr>
					<td colspan="5" align="right">Coupon Discount</td><td>Rp. {{
					$productDetails['coupon_amount'] }}</td>
				</tr>
				<tr>
					<td colspan="5" align="right">Grand Total</td><td>Rp. {{
					$productDetails['grand_total'] }}</td>
				</tr>
			</table>
			</td>
		</tr>
			<tr><td>
				<table width="100%">
					<tr>
						<td width="50%">
							<table>
								<tr>
									<td><strong>Bill To :-</strong></td>
								</tr>
								<tr>
									<td>{{$userDetails['name']}}</td>
								</tr>
								<tr>
									<td>{{$userDetails['address']}}</td>
								</tr>
								<tr>
									<td>{{$userDetails['city']}}</td>
								</tr>
								<tr>
									<td>{{$userDetails['province']}}</td>
								</tr>
								<tr>
									<td>{{$userDetails['state']}}</td>
								</tr>
								<tr>
									<td>{{$userDetails['country']}}</td>
								</tr>
								<tr>
									<td>{{$userDetails['pincode']}}</td>
								</tr>
								<tr>
									<td>{{$userDetails['mobile']}}</td>
								</tr>
							</table>
						</td>
						<td width="50%">
							<table>
								<tr>
									<td><strong>Ship To :-</strong>	</td>
								</tr>
								<tr>
									<td>{{$userDetails['name']}}</td>
								</tr>
								<tr>
									<td>{{$userDetails['address']}}</td>
								</tr>
								<tr>
									<td>{{$userDetails['city']}}</td>
								</tr>
								<tr>
									<td>{{$userDetails['province']}}</td>
								</tr>
								<tr>
									<td>{{$userDetails['state']}}</td>
								</tr>
								<tr>
									<td>{{$userDetails['country']}}</td>
								</tr>
								<tr>
									<td>{{$userDetails['pincode']}}</td>
								</tr>
								<tr>
									<td>{{$userDetails['mobile']}}</td>
								</tr>
							</table>
						</td>

					</tr>
				</table>
			</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>For any enquiries, you can contact us at <a href="mailto:info@marketplace.com">Info @Marketplace.com</a></td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>Thanks & Regards,<br> Admin</td></tr>
			<tr><td>Market Place Website</td></tr>
		</table>
</body>
</html>