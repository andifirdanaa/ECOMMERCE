@extends('layouts.app', ['title' => __('Coupon')])

@section('content')
    @include('users.partials.header', ['title' => __('Coupons')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Edit Coupons') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('coupons.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post"  action="{{route('coupons.update', $coupon->id)}}" autocomplete="off" name="edit_coupon" id="edit_coupon">
                          @csrf
                           @method('put')
                            

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('id_product') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Coupon Code') }}</label>
                                    <input type="text" name="coupon_code" id="coupon_code" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Coupon code') }}" value="{{ old('coupon_code', $coupon->coupon_code) }}"  minlength="5" maxlength="15" required>

                                    @if ($errors->has('coupon_code'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('coupon_code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                 <div class="form-group{{ $errors->has('amount') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Amount') }}</label>
                                    <input type="number" name="amount" id="amount" class="form-control form-control-alternative{{ $errors->has('kode') ? ' is-invalid' : '' }}" placeholder="{{ __('Coupon code') }}" value="{{ old('amount', $coupon->amount) }}" min ="1" required autofocus>

                                    @if ($errors->has('coupon_code'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('coupon_code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('amount_type') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Amount Type') }}</label>
                                    <div>
                                         <select class="selection-2" name="amount_type" id="amount_type" style="width:220px;">
                                            <option @if($coupon->amount_type=="Percentage") selected @endif value="Percentage">Percentage</option>
                                             <option @if($coupon->amount_type=="Fixed") selected @endif value="Fixed">Fixed</option>
                                        </select>
                                    </div>
                                    @if ($errors->has('amount_type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('kode') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('expiry_date') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Expiry Date') }}</label>
                                    <input type="text" name="expiry_date" id="expiry_date" class="form-control form-control-alternative{{ $errors->has('kode') ? ' is-invalid' : '' }}" value="{{ old('expiry_date', $coupon->expiry_date) }}" autocomplete = "off"  required autofocus>

                                    @if ($errors->has('expiry_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('expiry_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                 <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Enable') }}</label>
                                  <div class="controls">
                                      <input type="checkbox" name="status" id="status" value="1" @if($coupon->status=="1") checked @endif>
                                    </div>
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

 