@extends('layouts.app', ['title' => __('Coupon')])

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
                                <h3 class="mb-0">{{ __('Coupons') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{route('coupons.create')}}" class="btn btn-sm btn-primary">{{ __('Add Coupon') }}</a>
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
                                    <th scope="col">{{ __('No') }}</th>
                                    <th scope="col">{{ __('Coupon Code') }}</th>
                                    <th scope="col">{{__('Amount')}}</th>
                                    <th scope="col">{{__('Amount Type')}}</th>
                                    <th scope="col">{{__('Expiry Date')}}</th>
                                    <th scope="col">{{__('Created Date')}}</th>
                                    <th scope="col">{{__('Status')}}</th>
                                    <th scope="col">{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                           @foreach($coupon as $coupons)
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td>{{ $coupons->coupon_code }}</td>   
                                        <td>{{ $coupons->amount }}
                                             @if($coupons->amount_type == "Percentage") % @else Rupiah @endif
                                        </td>  
                                        <td>{{ $coupons->amount_type }}</td> 
                                        <td>{{ $coupons->expiry_date }}</td>
                                        <td>{{ $coupons->created_at }}</td>
                                        <td>
                                        @if($coupons->status=="1") Active @else Inactive @endif
                                        </td>                       
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <form action="{{ route('coupons.destroy', $coupons->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        
                                                        <a class="dropdown-item" href="{{route('coupons.edit', $coupons->id)}}">{{ __('Edit') }}</a>
                                                        <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                            {{ __('Delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                           @endforeach
                            </tbody>
                        </table>
                           {!! $coupon->render() !!}
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