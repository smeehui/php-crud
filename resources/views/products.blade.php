<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css"
        integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Styles -->

</head>

<body class="antialiased">
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div class="container mt-5 position-relative">
            <div class=" bg-secondary rounded rounded-1 text-white d-flex p-2 position-relative">
                <h3 class="flex-1">Product management</h3>
                <button id="btnAdd" class="btn btn-success position-absolute"  style="right: 12px">New product</button>
            </div>
            <table id="productTable" class="table table-striped ">
                <thead class="bg-dark text-white table-hover">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col" class="text-end">Quantity</th>
                        <th scope="col" class="text-end">Price</th>
                        <th scope="col" class="flex-1">Description</th>
                        <th scope="col">Category</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-light">
                    @if (!empty($products))
                        @foreach ($products as $product)
                            <tr>
                                <th scope="row">{{ $product->id }}</th>
                                <td><a href="/products/{{ $product->id }}">{{ $product->name }}</a></td>
                                <td class="text-end">{{ $product->quantity }}</td>
                                <td class="text-end">{{ $product->price }}$</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td class="text-center">
                                    <div class="stack gap-1">
                                        <button data-pid={{ $product->id }} type="button"
                                            class="btn btn-primary btn-sm btn-edit">Edit</button>
                                        <button data-pid={{ $product->id }}
                                            class="btn btn-sm btn-danger btn-delete">Remove</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add new product</h5>
                        <button type="button" class="close btn btn-sm" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="prodCreateForm">

                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
                            <div class="row mb3">
                                <div class="col-6">
                                    <div class="col-12">
                                        <label for="productName" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="productName" name="name"
                                            placeholder="Enter product's name ...">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="col-12">
                                        <label for="productCategory" class="form-label">Category</label>
                                        <select class="form-select" id="productCategory" name="category">
                                            @foreach ($categories as $category)
                                                <option value={{ $category->id }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class=" col-6">
                                    <label for="productPrice" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="productPrice" name="price"
                                        placeholder="Enter product's price ...">
                                </div>
                                <div class="col-6">
                                    <label for="productQuantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="productQuantity" name="quantity"
                                        placeholder="Enter product's quantity ...">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="productDescription" class="form-label">Description</label>
                                    <textarea class="form-control" id="productDescription" name="description" placeholder="Enter description ..."
                                        rows="4"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="btnAddSubmit" type="button" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close btn btn-sm" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="prodEditForm" action="">
                            <input type="hidden" name="_method" value="put" />
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
                            <div class="row mb3">
                                <div class="col-6">
                                    <div class="col-12">
                                        <label for="productNameEdit" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="productNameEdit" name="name"
                                            placeholder="Enter product's name ...">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="col-12">
                                        <label for="productCategoryEdit" class="form-label">Category</label>
                                        <select class="form-select" id="productCategoryEdit" name="category">
                                            @foreach ($categories as $category)
                                                <option value={{ $category->id }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class=" col-6">
                                    <label for="productPriceEdit" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="productPriceEdit" name="price"
                                        placeholder="Enter product's price ...">
                                </div>
                                <div class="col-6">
                                    <label for="productQuantityEdit" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="productQuantityEdit"
                                        name="quantity" placeholder="Enter product's quantity ...">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="productDescriptionEdit" class="form-label">Description</label>
                                    <textarea class="form-control" id="productDescriptionEdit" name="description" placeholder="Enter description ..."
                                        rows="4"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-secondary"
                            data-dismiss="modal">Cancel</button>
                        <button id="btnEditSubmit" type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Are you sure want to continue?</h5>
                        <button type="button" class="close btn btn-sm" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="modalDeleteContent" class="container-fluid">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-secondary"
                            data-dismiss="modal">Cancle</button>
                        <button id="btnDeleteConfirm" type="button" class="btn btn-danger">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {

        $('#exampleModal').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modal = $(this);
            // Use above variables to manipulate the DOM

        });
        $('.btn-edit').on('click', function(event) {
            appendProductDataToForm($(this).data("pid"));
        })
        $('.btn-delete').on('click', function(event) {
            showDeleteConfirm($(this).data("pid"))
        })
        $('#btnAdd').on('click', function(event) {
            $("#modalCreate").modal("show");
        })
        $('#btnAddSubmit').on('click', function(event) {
            $("#prodCreateForm").trigger("submit");
        })
        $('#btnEditSubmit').on('click', function(event) {
            handleEditProduct($(this).data("pid"));
        })
        $('#btnDeleteConfirm').on('click', function(event) {
            handleDeleteProduct($(this).data("pid"));
        })

        function appendProductDataToForm(id) {
            const url = location.origin + "/api/products/" + id;
            console.log(url);
            $.ajax({
                    url: url
                })
                .done(data => {
                    const {
                        id,
                        name,
                        price,
                        quantity,
                        description,
                        category_id
                    } = data;
                    $("#productNameEdit").val(name);
                    $("#productPriceEdit").val(price);
                    $("#productQuantityEdit").val(quantity);
                    $("#productDescriptionEdit").val(description);
                    $("#productCategoryEdit").val(category_id);
                    $("#modalEdit").modal("show");
                    $("#btnEditSubmit").data('pid', id);
                })
                .fail((err) => {
                    console.log(err);
                })
        }

        function handleEditProduct(id) {
            const url = location.origin + "/api/products/" + id;
            $.ajax({
                    url: url,
                    method: "put",
                    data: {
                        name: $("#productNameEdit").val() ?? undefined,
                        price: $("#productPriceEdit").val() ?? undefined,
                        quantity: $("#productQuantityEdit").val() ?? undefined,
                        description: $("#productDescriptionEdit").val() ?? undefined,
                        category: $("#productCategoryEdit").val() ?? undefined,
                    }
                })
                .done(data => {
                    location.reload()
                })
                .fail((err) => {
                    console.log(err);
                })
        }

        function showDeleteConfirm(id) {
            const url = location.origin + "/api/products/" + id;
            $.ajax({
                    url: url
                })
                .done(data => {
                    $("#modalDeleteContent").text("Delete " + data.name)
                    $("#btnDeleteConfirm").data("pid", id);
                    $("#modalDelete").modal("show");
                })
                .fail((err) => {
                    console.log(err);
                })

        }

        function handleDeleteProduct(id) {
            const url = location.origin + "/api/products/" + id;
            $.ajax({
                    url: url,
                    method: "delete",
                })
                .done(data => {
                    location.reload()
                })
                .fail((err) => {
                    console.log(err);
                })
        }
        $('#productTable').DataTable({
            lengthMenu: [5,15,30,60,100]
        });
    });
</script>

</html>
