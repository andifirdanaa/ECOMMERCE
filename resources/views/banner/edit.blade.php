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
                                <a href="{{ route('banner.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('banner.update', $banner->id)}}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', $banner->name) }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                 <div class="form-group{{ $errors->has('text_style') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Text Style') }}</label>
                                    <input type="text" name="text_style" id="input-kode" class="form-control form-control-alternative{{ $errors->has('kode') ? ' is-invalid' : '' }}" placeholder="{{ __('Text Style') }}" value="{{ old('text_style', $banner->text_style) }}" required autofocus>

                                    @if ($errors->has('text_style'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('kode') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('sort_order') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Sort Order') }}</label>

                                     <select class="form-control {{ $errors->has('role_id') ? 'is-invalid' : '' }}" name="sort_order" id="input-role_id">
                                            <option value="" disabled selected>Select your option</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                        @if ($errors->has('status'))
                                        <span id="status-error" class="error text-danger" for="input-status">{{ $errors->first('status') }}</span>
                                      @endif
                                </div>
                                <div class="form-group{{ $errors->has('content') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Content') }}</label>
                                    <textarea type="text" name="content" id="input-kode" class="form-control form-control-alternative{{ $errors->has('kode') ? ' is-invalid' : '' }}" placeholder="{{ __('Content') }}" value="{{ old('content',$banner->content) }}" required autofocus></textarea>

                                    @if ($errors->has('content'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('kode') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('link') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('link') }}</label>
                                    <input type="text" name="link" id="input-kode" class="form-control form-control-alternative{{ $errors->has('kode') ? ' is-invalid' : '' }}" placeholder="{{ __('Link') }}" value="{{ old('link', $banner->link) }}" required autofocus>

                                    @if ($errors->has('link'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('kode') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                 <div class="form-group">
                                <label for="image">Upload Image : </label>
                                <input type="file" name="image" class="form-control">
                                 <img src="{{asset('banneri/'.$banner->image)}}" alt="" width="100px" height="auto" style = "margin : 10px 0 10px 0 "> &nbsp; &nbsp;
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