@extends('layouts.app', ['title' => __('Product')])

@section('content')
    @include('users.partials.header', ['title' => __('Add Attribute Product')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Product Attribute') }}</h3>
                                @if(Session::has('flash_message_error'))
                                    <div class="alert alert-error alert-block">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                        </button>
                                    <strong>{{ session('flash_message_error') }}</strong>
                                    </div>
                                    @endif
                                    @if(Session::has('flash_message_success'))
                                    <div class="alert alert-success alert-block">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                        </button>
                                    <strong>{{ session('flash_message_success') }}</strong>
                                    </div>
                                    @endif
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('product.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('/admin/add-attributes/'.$productDetails->id) }}" autocomplete="off" enctype="multipart/form-data" name="add_attribute" id="add_attribute">
                             
                            {{csrf_field()}}
                            
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('id_product') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Id product :') }}</label>
                                  {{$productDetails->id_product}}

                                </div>
                                 
                                 <div class="form-group{{ $errors->has('name_product') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name Product :') }}</label>
                                  {{$productDetails->name_product}}
                                </div>
                                 <div class="form-group{{ $errors->has('product_prize') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Product Color :') }}</label>
                                    {{$productDetails->product_color}}
                                </div>
                                <div class="form-group">
                                <div class="field_wrapper">
                                    <div style="display: flex;">
                                        <input type="text" name="sku[]" id="sku" placeholder="SKU" class="form-control" style="width: 120px; margin-right: 5px;"/>
                                        <input type="text" name="size[]" id="size" placeholder="Size" class="form-control" style="width: 120px;margin-right: 5px;" />
                                        <input type="text" name="price[]" id="price" placeholder="price" class="form-control" style="width: 120px;margin-right: 5px;" />
                                        <input type="text" name="stock[]" id="stock" placeholder="Stock" class="form-control" style="width: 120px;margin-right: 5px;" />
                                        <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                                    </div>
                                </div>
                            </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Add Atribute') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                        <hr class="my-4">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('View Attribute') }}</h3>
                                </div>
                            </div>
                        </div>
                    <div class="card-body">
                    <form method="post" action="{{ url('/admin/edit-attributes/'.$productDetails->id) }}" autocomplete="off" enctype="multipart/form-data" name="add_attribute" id="add_attribute">
                        {{ csrf_field() }}

                        <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                   <th scope="col">Attribute ID</th>
                                  <th scope="col">SKU</th>
                                  <th scope="col">Size</th>
                                  <th scope="col">Price</th>
                                  <th scope="col">Stock</th>
                                  <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($productDetails['attributes'] as $attribute)
                                    <tr>
                                        <td><input type="hidden" name="idAttr[]" value="{{$attribute->id }}"> {{$attribute->id }}</td>
                                        <td>{{ $attribute->sku }}</td>
                                        <td>{{ $attribute->size }}</td>
                                        <td><input type="type" name="price[]" value="{{$attribute->price}}"></td>
                                        <td><input type="type" name="stock[]" value="{{$attribute->stock }}"></td>                                       
                                        <td class="text-right">
                                            <div class="fr">
                                              <input type="submit" value="Update" class="btn btn-primary btn-mini">

                                            <a  rel="{{$attribute->id}}" rel1="delete-attribute"
                                              href="{{url('/admin/delete-attribute/'. $attribute->id)}}" class="btn btn-danger btn-mini deleteRecord" onclick="confirm('{{ __("Are you sure you want to delete this field?") }}') ? this.parentElement.submit() : ''">Delete</a>
                                          </div>
                                        </td>
                                    </tr>
                            @endforeach
                            </tbody>    
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

      
        @include('layouts.footers.auth')
    </div>
@endsection

<!-- add delete dynamically jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
            $(document).ready(function(){
                var maxField = 10; //Input fields increment limitation
                var addButton = $('.add_button'); //Add button selector
                var wrapper = $('.field_wrapper'); //Input field wrapper
                var fieldHTML = '<div style="display:flex;"> <input type="text" name="sku[]" id="sku" placeholder="SKU" class="form-control" style="width: 120px;margin-right: 5px;" /> <input type="text" name="size[]" id="size" placeholder="Size" class="form-control" style="width: 120px;margin-right: 5px;" /> <input type="text" name="price[]" id="price" placeholder="price" class="form-control" style="width: 120px;margin-right: 5px;" /><input type="text" name="stock[]" id="stock" placeholder="Stock" class="form-control" style="width: 120px;margin-right: 5px;" /><a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html 
                var x = 1; //Initial field counter is 1
                
                //Once add button is clicked
                $(addButton).click(function(){
                    //Check maximum number of input fields
                    if(x < maxField){ 
                        x++; //Increment field counter
                        $(wrapper).append(fieldHTML); //Add field html
                    }
                });
                
                //Once remove button is clicked
                $(wrapper).on('click', '.remove_button', function(e){
                    e.preventDefault();
                    $(this).parent('div').remove(); //Remove field html
                    x--; //Decrement field counter
                });
            });
            </script>