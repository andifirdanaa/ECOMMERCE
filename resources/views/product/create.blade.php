@extends('layouts.app', ['title' => __('Product')])

@section('content')
    @include('users.partials.header', ['title' => __('Add Database Product')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Product') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('product.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('product.store')}}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('post')

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('id_product') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Id Product') }}</label>
                                    <input type="text" name="id_product" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Id Product') }}" value="{{ old('id_product') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                 
                                 
                                    <div class="form-group{{ $errors->has('category_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Category') }}</label>
                                        <select class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}" name="category_id" id="input-role_id">
                                            <option value="" disabled selected>Select your option</option>
                                            @foreach($category as $row)
                                            <option value="{{$row->id}}">{{$row->name_category}}</option>
                                           @endforeach
                                        </select>
                                        @if ($errors->has('status'))
                                        <span id="status-error" class="error text-danger" for="input-status">{{ $errors->first('status') }}</span>
                                      @endif
                                    </div>
                           
                                 <div class="form-group{{ $errors->has('name_product') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name Product') }}</label>
                                    <input type="text" name="name_product" id="input-kode" class="form-control form-control-alternative{{ $errors->has('kode') ? ' is-invalid' : '' }}" placeholder="{{ __('Name Product') }}" value="{{ old('name_product') }}" required autofocus>

                                    @if ($errors->has('name_product'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('kode') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('product_color') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Product Color') }}</label>
                                    <input type="text" name="product_color" id="input-kode" class="form-control form-control-alternative{{ $errors->has('kode') ? ' is-invalid' : '' }}" placeholder="{{ __('Product Color') }}" value="{{ old('product_color') }}" required autofocus>

                                    @if ($errors->has('product_color'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('kode') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('product_description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Product Description') }}</label>
                                    <textarea type="text" name="product_description" id="input-kode" class="form-control form-control-alternative{{ $errors->has('kode') ? ' is-invalid' : '' }}" placeholder="{{ __('Product Description') }}" value="{{ old('product_description') }}" required autofocus></textarea>

                                    @if ($errors->has('product_description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('kode') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                 <div class="form-group">
                                <label for="image">Upload Image : </label>
                                <input type="file" name="image" class="form-control">
                                </div>
                                 <div class="form-group{{ $errors->has('product_prize') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Product Prize') }}</label>
                                    <input type="text" name="product_prize" id="input-kode" class="form-control form-control-alternative{{ $errors->has('kode') ? ' is-invalid' : '' }}" placeholder="{{ __('Product Prize') }}" value="{{ old('product_prize') }}" required autofocus>

                                    @if ($errors->has('product_prize'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('kode') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                 <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Featured Item') }}</label>
                                  <div class="controls">
                                      <input type="checkbox" name="feature_item" id="feature_item" value="1">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
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