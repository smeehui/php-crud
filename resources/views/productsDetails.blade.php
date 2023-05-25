<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Styles -->

</head>

<body class="antialiased">
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div class="container mt-5">
            <div class="card border-primary mb-1">
                <div class="card-body">
                    <h4 class="card-title">Product details:</h4>
                    <div class="vstack gap-1">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{$product->name}}</h4>
                                <p class="card-text">Product's name:</p>
                            </div>
                        </div>
                       <div class="col-12 d-flex">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">{{$product->price}}$</h4>
                                        <p class="card-text">Product's price:</p>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">{{$product->quantity}}</h4>
                                        <p class="card-text">Product's quantity:</p>
                                    </div>
                                </div>
                            </div>
                       </div>
                       <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{$product->description}}</h4>
                            <p class="card-text">Product's Descrtiption:</p>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="card-footer">
                    {{-- <button type="button" class="btn btn-primary btn-sm btn-edit">Edit</button>
                    <button class="btn btn-sm btn-danger btn-delete">Remove</button> --}}
                    <button class="btn btn-outline-secondary" onclick="history.back()">Back</button>
                </div>
            </div>
            <div>
           
            </div>
        </div>

        {{-- <!-- Modal -->
        <div class="modal fade" id="modelEdit" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close btn btn-sm" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            Add rows here
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close btn btn-sm" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            Add rows here
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#productTable').DataTable();
        $('#exampleModal').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modal = $(this);
            // Use above variables to manipulate the DOM

        });
        $('.btn-edit').on('click', function(event) {
            $("#modelEdit").modal("show");
            console.log(123);
        })
        $('.btn-delete').on('click', function(event) {
            $("#modalDelete").modal("show");
            console.log(123);
        })
    });
</script>

</html>