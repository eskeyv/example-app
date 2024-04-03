<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@eskeyv</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-black">List Data</h3>
                <hr>
                <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#addProductModal">
                <i class="fas fa-user-plus"></i>    Add
                </button>

                <table class="table table-bordered">
                    <thead class="bg-light text-dark">
                        <tr>
                            <th><i class="fas fa-user"></i> Name</th>
                            <th><i class="fas fa-envelope"></i> Email</th>
                            <th><i class="fas fa-address-card"></i> Address</th>
                            <th><i class="fas fa-cog"></i> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                         <tr>
                            <td> {{$product->name}} </td>
                            <td> {{$product->email}} </td>
                            <td> {{$product->address}} </td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-toggle="modal"
                                    data-target="#editProductModal{{ $product->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form method="POST" action="{{ route('deleteProduct') }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="productId" value="{{ $product->id }}">
                                    <button class="btn btn-danger btn-sm" type="submit">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                         @endforeach
                    </tbody>
                </table> 
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('addProduct') }}" method="POST" >
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel"><i class="fas fa-user-plus"></i> Add Product </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name"><i class="fas fa-user"></i> Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="address"><i class="fas fa-address-card"></i> Address</label>
                            <input type="text" name="address" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach($products as $product)
    <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1" role="dialog"
        aria-labelledby="editProductModalLabel{{ $product->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('editProduct') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProductModalLabel{{ $product->id }}"><i class="fas fa-edit"></i> Edit Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="form-group">
                            <label for="name"><i class="fas fa-user"></i> Name</label>
                            <input type="text" name="name" value="{{ $product->name }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" name="email" value="{{ $product->email }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="address"><i class="fas fa-address-card"></i> Address</label>
                            <input type="text" name="address" value="{{ $product->address }}" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach