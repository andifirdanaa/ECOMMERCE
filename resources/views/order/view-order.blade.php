@extends('layouts.app', ['title' => __('Product')])

@section('content')
     <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
            
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Orders Table') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="" class="btn btn-sm btn-primary">{{ __('View') }}</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Order ID') }}</th>
                                     <th scope="col">{{ __('Order Date') }}</th>
                                    <th scope="col">{{ __('Customer Name') }}</th>
                                    <th scope="col">{{__('Customer Email')}}</th>
                                    <th scope="col">{{__('Ordered Product')}}</th>
                                    <th scope="col">{{__('Order Amount')}}</th>
                                    <th scope="col">{{__('Order Status')}}</th>
                                    <th scope="col">{{ __('Payment Method') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->user_email }}</td>
                                        <td>
                                        @foreach($order->orders as $pro)
							                {{$pro->product_code}}
							                ({{$pro->product_qty}})
							             <br>
							             @endforeach
                                        </td>
                                        <td>{{ $order->grand_total }} </td>
                                        <td>{{ $order->order_status }}</td>  
                                        <td>{{ $order->payment_method }}</td>                                      
                                        <td class="text-right">
                                             
                                            <div class="fr">
                                  
                                              <a target="_blank" href="{{url('view-order/'.$order->id)}}" class="btn btn-primary btn-mini" >View Order Details</a>
                                              @if($order->order_status == "Shipped" || $order->order_status == "Delivered" || $order->order_status == "Paid")
                                               <a target="_blank" href="{{url('view-order-invoice/'.$order->id)}}" class="btn btn-primary btn-mini" >View Order Invoice</a>
                                               <a target="_blank" href="{{url('view-order-pdf/'.$order->id)}}" class="btn btn-primary btn-mini" >View Order PDF</a>
                                               @endif
                                          </div>
                                        </td>
                                        </td>
                                    </tr>
                           @endforeach
                            </tbody>
                        </table>
                        {!! $orde->render() !!}
                    </div>
                    {{-- <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                          
                        </nav>
                    </div> --}}
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>

@endsection
