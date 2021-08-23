<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DAMCO : CRUD CODEING ASSESSMENT</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="taggableInput.css">
    <link rel="stylesheet" href="style.css">
    <script src="taggableInput.js"></script>
    <script src="script.js"></script>
</head>

<body>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="product-tab" data-toggle="tab" href="#product" role="tab"
                aria-controls="product" aria-selected="true">Product</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="category-tab" data-toggle="tab" href="#category" role="tab" aria-controls="category"
                aria-selected="false">category</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">

        <div class="container-xl tab-pane fade show active" id="product" role="tabpanel" aria-labelledby="product-tab">
            <div class="table-responsive">
                
                @if(!$errors->all)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $message) {
                        {{ $message }}
                        @endforeach
                    </div>
                @endif

                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h2>Manage <b>Prooducts</b></h2>
                            </div>
                            <div class="col-sm-6">
                                <a href="#addProductModal" class="btn btn-success" data-toggle="modal"><i
                                        class="material-icons">&#xE147;</i> <span>Add New Prooduct</span></a>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)

                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->categories->implode('name', ', ') }}</td>
                                    <td>{{ $product->sku }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->updated_at->format('H:i A, d-m-Y') }}</td>
                                    <td>
                                        <a href="#editProductModal-{{ $product->id }}" class="edit" data-toggle="modal"><i
                                                class="material-icons" data-toggle="tooltip"
                                                title="Edit">&#xE254;</i></a>
                                        <a href="#deleteProductModal-{{ $product->id }}" class="delete" data-toggle="modal"><i
                                                class="material-icons" data-toggle="tooltip"
                                                title="Delete">&#xE872;</i></a>
                                        <!-- Delete Product -->
                                        <div id="deleteProductModal-{{ $product->id }}" class="modal fade">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('product-destroy', $product->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete Product</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete these Records?</p>
                                                            <p class="text-warning"><small>This action cannot be
                                                                    undone.</small>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="button" class="btn btn-default"
                                                                data-dismiss="modal" value="CANCEL">
                                                            <input type="submit" class="btn btn-danger" value="DELETE">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Edit Product -->
                                        <div id="editProductModal-{{ $product->id }}" class="modal fade">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    
                                                    <form action="{{ route('product-update', $product->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Product</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">&times;</button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Name</label>
                                                                <input type="text" class="form-control" name="name"
                                                                    value="{{ $product->name }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>SKU</label>
                                                                <input class="form-control" name="sku" value="{{ $product->sku }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Price</label>
                                                                <input type="text" name="price" class="form-control"
                                                                   value="{{ $product->price }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="button" class="btn btn-default"
                                                                data-dismiss="modal" value="CANCEL">
                                                            <input type="submit" class="btn btn-info" value="SAVE">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="clearfix">
                        <div class="hint-text">Showing <b>{{ $products->count() }}</b> entries</div>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>



            <!-- Add Product -->
            <div id="addProductModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('product-store') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">Add Product</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <input id="form-tags-1" type="text" class="form-control" name="categories" required>
                                </div>
                                <div class="form-group">
                                    <label>SKU</label>
                                    <input class="form-control" name="sku" required>
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" name="price" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="CANCEL">
                                <input type="submit" class="btn btn-success" value="SAVE">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <div class="container-xl tab-pane fade" id="category" role="tabpanel" aria-labelledby="category-tab">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h2>Manage <b>Categories</b></h2>
                            </div>
                            <div class="col-sm-6">
                                <a href="#addCategoryModal" class="btn btn-success" data-toggle="modal"><i
                                        class="material-icons">&#xE147;</i> <span>Add New Category</span></a>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover table-nowrap">
                        <thead>
                            <tr>
                                <th width="30%">Name</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category as $categoryItem)

                                <tr>
                                    <td>{{ $categoryItem->name }}</td>
                                    <td>{{ $categoryItem->updated_at->format('H:i A, d-m-Y') }}</td>
                                    <td>
                                        <a href="#editCategoryModal-{{ $categoryItem->id }}" class="edit" data-toggle="modal"><i
                                                class="material-icons" data-toggle="tooltip"
                                                title="Edit">&#xE254;</i></a>
                                        <a href="#deleteCategoryModal-{{ $categoryItem->id }}" class="delete" data-toggle="modal"><i
                                                class="material-icons" data-toggle="tooltip"
                                                title="Delete">&#xE872;</i></a>
                                        <!-- Delete Category -->
                                        <div id="deleteCategoryModal-{{ $categoryItem->id }}" class="modal fade">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('category-destroy', $categoryItem->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete Category</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete these Records?</p>
                                                            <p class="text-warning"><small>This action cannot be
                                                                    undone.</small>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="button" class="btn btn-default"
                                                                data-dismiss="modal" value="CANCEL">
                                                            <input type="submit" class="btn btn-danger" value="REMOVE">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Edit Category -->
                                        <div id="editCategoryModal-{{ $categoryItem->id }}" class="modal fade">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{ route('category-update', $categoryItem->id) }}">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Category</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">&times;</button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Name</label>
                                                                <input type="text" class="form-control" name="name"
                                                                    value="{{ $categoryItem->name }}" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Product</label>
                                                                <select class="form-control" name="product_id" id="product_id">
                                                                    <option>Select product</option>
                                                                    @foreach ($products as $product)
                                                                        <option value="{{ $product->id }}" {{ $product->id == $categoryItem->product_id ? "selected = 'selected'" : ""}}>{{ $product->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="button" class="btn btn-default"
                                                                data-dismiss="modal" value="CANCEL">
                                                            <input type="submit" class="btn btn-info" value="UPDATE">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="clearfix">
                        <div class="hint-text">Showing <b>{{ $category->count() }}</b> entries</div>
                        {{ $category->links() }}
                    </div>
                </div>
            </div>


            <!-- Add Category -->
            <div id="addCategoryModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('category-store') }}">
                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">Add Category</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Product</label>
                                    <select class="form-control" name="product_id" id="product_id">
                                        <option>Select product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="CANCEL">
                                <input type="submit" class="btn btn-success" value="SAVE">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

        <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
</body>

</html>
