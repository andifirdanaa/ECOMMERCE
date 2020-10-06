@extends('layouts.app', ['title' => __('Category')])

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
                                <h3 class="mb-0">{{ __('Category') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{route('category.create')}}" class="btn btn-sm btn-primary">{{ __('Add Category') }}</a>
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
                                    <th scope="col">{{ __('Id Category') }}</th>
                                    <th scope="col">{{ __('Name Category') }}</th>
                                    <th scope="col">{{__('URL')}}</th>
                                    <th scope="col">{{__('Description')}}</th>
                                    <th scope="col">{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach($category as $row)
                                    <tr>
                                        <td>{{$row->id_category}}</td>
                                        <td>{{$row->name_category}}</td>
                                        <td>{{$row->url}}</td>
                                        <td>{{$row->description}}</td>                                       
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <form action="{{route('category.destroy', $row->id)}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        
                                                        <a class="dropdown-item" href="{{route('category.edit',$row->id)}}">{{ __('Edit') }}</a>
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
                           {!! $category->render() !!}
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