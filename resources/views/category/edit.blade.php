@extends('layouts.app', ['title' => __('Category')])

@section('content')
    @include('users.partials.header', ['title' => __('Add Database Category')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Category') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('category.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('category.update', $category->id)}}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('id_product') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Id Category') }}</label>
                                    <input type="text" name="id_category" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Id Category') }}" value="{{ old('id_category', $category->id_category) }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                 <div class="form-group{{ $errors->has('name_category') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name Category') }}</label>
                                    <input type="text" name="name_category" id="input-kode" class="form-control form-control-alternative{{ $errors->has('kode') ? ' is-invalid' : '' }}" placeholder="{{ __('Name Category') }}" value="{{ old('name_category', $category->name_category) }}" required autofocus>

                                    @if ($errors->has('name_category'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('kode') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('url') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('URL') }}</label>
                                    <input type="text" name="url" id="input-kode" class="form-control form-control-alternative{{ $errors->has('kode') ? ' is-invalid' : '' }}" placeholder="{{ __('Enter URL') }}" value="{{ old('url', $category->url) }}" required autofocus>

                                    @if ($errors->has('url'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('kode') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Description') }}</label>
                                    <textarea type="text" name="description" id="input-kode" class="form-control form-control-alternative{{ $errors->has('kode') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}" value="{{ old('description', $category->description) }}" required autofocus></textarea>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('kode') }}</strong>
                                        </span>
                                    @endif
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