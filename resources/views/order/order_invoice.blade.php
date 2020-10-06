<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Invoice</h2><h3 class="pull-right">Order #{{$orderDetails->id}}</h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
    					{{$userDetails->name}}<br>
    					{{$userDetails->address}}<br>
    					{{$userDetails->city}},{{$userDetails->state}},{{$userDetails->pincode}}<br>
    					{{$userDetails->mobile}}
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Shipped To:</strong><br>
    					{{$orderDetails->name}}<br>
    					{{$orderDetails->address}}<br>
    					{{$orderDetails->city}},{{$orderDetails->state}},{{$orderDetails->pincode}}<br>
    					{{$orderDetails->mobile}}
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    					{{$orderDetails->payment_method}}<br>
    					
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					{{ date('j F Y', strtotime($orderDetails->created_at))}}<br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td style="width: 20%"><strong>Product Code</strong></td>
                                    <td style="width: 20%"class="text-center"><strong>Color</strong></td>
        							<td style="width: 20%"class="text-center"><strong>Price</strong></td>
        							<td style="width: 15%"class="text-left"><strong>Quantity</strong></td>
        							<td style="width:20%"class="text-right"><strong>Totals</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
                                <?php $Subtotal = 0; ?>
                                 @foreach($orderDetails->orders as $pro)
    							<tr>
    								<td>{{$pro->product_code}}</td>
                                    <td class="text-center">{{$pro->product_color}}</td>
    								<td class="text-center">{{$pro->product_price}}</td>
    								<td class="text-left">{{$pro->product_qty}}</td>
    								<td class="text-right">Rp. {{$pro->product_price*$pro->product_qty}}</td>
    							</tr>
                                <?php $Subtotal = $Subtotal + ($pro->product_price * $pro->product_qty); ?>
                                @endforeach
                                <tr>
                                    
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                    <td class="thick-line text-right">Rp. {{$Subtotal}}</td>
                                </tr>
                                <tr>
                                    
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Shipping (+)</strong></td>
                                    <td class="no-line text-right">Rp. {{$orderDetails->shipping_charges}}</td>
                                </tr>
                                 <tr>
                                    
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Coupon Discount (-)</strong></td>
                                    <td class="no-line text-right">
                                         @if(!empty(Session::get('CouponAmount')))
                                            Rp. {{Session::get('CouponAmount')}}
                                         @else
                                             Rp. 0
                                        @endif
                                       </td>
                                </tr>
                                <tr>
                                    
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Total</strong></td>
                                    <td class="no-line text-right">Rp. {{$orderDetails->grand_total}}</td>
                                </tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>