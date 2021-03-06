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
                                <h3 class="mb-0">{{ __('Product') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{route('product.create')}}" class="btn btn-sm btn-primary">{{ __('Add Product') }}</a>
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
                                    <th scope="col">{{ __('Id Product') }}</th>
                                     <th scope="col">{{ __('Category') }}</th>
                                    <th scope="col">{{ __('Name Product') }}</th>
                                    <th scope="col">{{__('Product Color')}}</th>
                                    <th scope="col">{{__('Product Description')}}</th>
                                    <th scope="col">{{__('Image')}}</th>
                                    <th scope="col">{{__('Product Prize')}}</th>
                                    <th scope="col">{{ __('Creation Date') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($product as $row)
                                    <tr>
                                        <td>{{$row->id_product}}</td>
                                        <td>{{$row->category->name_category}}</td>
                                        <td>{{$row->name_product}}</td>
                                        <td>{{$row->product_color}}</td>
                                        <td>{{$row->product_description}}</td>
                                        <td>
                                              @if(!empty($row->image))
                                            <img src="{{asset('images/'.$row->image)}}" alt="no photo" width="100px">
                                            @endif
                                        </td>
                                        <td>{{$row->product_prize}}</td>                                        
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <form action="{{ route('product.destroy', $row->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')

                                                        <a class="dropdown-item" href="{{url('/admin/add-attributes/'.$row->id)}}">{{ __('Attribute') }}</a>
                                                        <a class="dropdown-item" href="{{route('product.edit', $row->id)}}">{{ __('Edit') }}</a>
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
                           {!! $product->render() !!}
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