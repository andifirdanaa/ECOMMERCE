@extends('layouts.app', ['title' => __('Shipping')])

@section('content')
    @include('users.partials.header', ['title' => __('Shipping')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Edit Shipping Charge') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('shipping.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post"  action="{{route('shipping.update', $shipping->id)}}" autocomplete="off" name="edit_shipping" id="edit_shipping">
                          @csrf
                           @method('put')
                            

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('id_product') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name" >{{ __('City') }}</label>
                                     <input readonly="" name="city" id="city" class="form-control form-control-alternative{{ $errors->has('city') ? ' is-invalid' : '' }}"  value="{{ old('city', $shipping->city) }}" min ="4" required autofocus>
                                </div>
                                 <div class="form-group{{ $errors->has('amount') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Shipping Charge') }}</label>
                                    <input type="number" name="shipping_charges" id="shipping_charges" class="form-control form-control-alternative{{ $errors->has('shipping_charges') ? ' is-invalid' : '' }}" placeholder="{{ __('Coupon code') }}" value="{{ old('shipping_charges', $shipping->shipping_charges) }}" min ="4" required autofocus>

                                    @if ($errors->has('shipping_charges'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('shipping_charges') }}</strong>
                                        </span>
                                    @endif
                                </div>
                               
                               
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4" value="Add Coupon">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection

 