@extends('app')

@section('title', 'Products')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="container p-1 mt-2">
                    <h2 class="card-title">Products</h2>

                    <div class="card-body">
                        <div class="text-right mb-2">
                            <button id="newProductBtn" type="button" class="btn btn-success" data-toggle="modal" data-target="#newProductModal">Create new Product</button>
                        </div>
                        <table class="table table-bordered" id="productsTable">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->price}} kr.</td>
                                    <td> <a class="del-product-action" href="javascript:;" data-product-id="{{$product->id}}">Delete</a>  </td>
                                </tr>
                            @empty
                            @endforelse

                            <meta name="csrf-token" content="{{ csrf_token() }}">

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>


    <div id="newProductModal" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="newProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newProductModalLabel">Create Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/products" method="post" id="createProductForm">
                        <div class="form-group">
                            <label for="formInputName">Name</label>
                            <input type="text" name="name" autocomplete="off" value="{{old('name')}}" class="form-control" id="formInputName" autocomplete="off" value="{{old('price')}}">
                        </div>
                        <div class="form-group">
                            <label for="formInputPrice">Price</label>
                            <input type="number" step=".01" name="price" class="form-control" id="formInputPrice">
                        </div>
                    </form>

                    <p style="color: red;" id="inputError">
                        @error('name'){{$message}} @enderror
                        @error('price'){{$message}} @enderror
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id ="closeBtn">Close</button>
                    <button type="button" id="createBtn" class="btn btn-primary">Create</button>
                </div>
            </div>
        </div>
    </div>

@endsection

