<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'My POS') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/jquery-ui.css') }}" rel="stylesheet">



</head>

<body>
    @include('header')


    <div class="container-fluid">
        <div class="row">

            @include('sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Supply Details</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-outline-secondary me-2">
                            <i class="fas fa-print"></i> Print
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-download"></i> Export
                        </button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Supply Information</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm">
                                    <tr>
                                        <th>Supply ID</th>
                                        <td>{{ $supply->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Supplier</th>
                                        <td>{{ $supply->supplier->name ?? 'Normal Entry' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Branch</th>
                                        <td>{{ $supply->branch->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created By</th>
                                        <td>{{ $supply->creator->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Price</th>
                                        <td>${{ number_format($supply->total_price, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td><span
                                                class="badge bg-{{ $supply->status === 'completed' ? 'success' : 'warning' }}">{{ ucfirst($supply->status) }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Created At</th>
                                        <td>{{ $supply->created_at->format('M d, Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated At</th>
                                        <td>{{ $supply->updated_at->format('M d, Y H:i') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Add Product to Supply</h5>
                            </div>
                            <div class="card-body">
                                <form action="/add-product-to-supply/{{ $supply->id }}" method="post" id="product_add">
                                    @csrf
                                    <input type="hidden" id="supply_id" name="supply_id" value="{{ $supply->id }}">
                                    <div class="mb-3">
                                        <label for="product_id" class="form-label">Product</label>
                                        <input type="text" id="product_id" name="product_id" class="form-control"
                                            supply="{{ $supply->id }}" placeholder="Search for a product" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="strength_id" class="form-label">Strength</label>
                                            <select id="strength_id" name="strength_id" class="form-control" required>
                                                <option value="">Select Strength</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="supplied_quantity" class="form-label">Supplied Quantity</label>
                                            <input type="number" id="supplied_quantity" name="supplied_quantity"
                                                class="form-control" min="1" placeholder="Quantity" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="buying_price" class="form-label">Buying Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" id="buying_price" name="buying_price"
                                                    class="form-control" step="0.01" placeholder="0.00" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="selling_price" class="form-label">Selling Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" id="selling_price" name="selling_price"
                                                    class="form-control" step="0.01" placeholder="0.00" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="expiration_date" class="form-label">Expiration Date</label>
                                        <input type="date" id="expiration_date" name="expiration_date"
                                            class="form-control" value="{{ date('Y-m-t') }}" required>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Add Product
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Supply Products</h5>
                    </div>
                    <div class="card-body">
                        <form id="filter-form" class="mb-4">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label for="filter-product" class="form-label">Product Name</label>
                                    <input type="text" id="filter-product" name="filter-product" class="form-control"
                                        placeholder="Filter by product name">
                                </div>
                                <div class="col-md-3">
                                    <label for="filter-strength" class="form-label">Strength</label>
                                    <input type="text" id="filter-strength" name="filter-strength" class="form-control"
                                        placeholder="Filter by strength">
                                </div>
                                <div class="col-md-3">
                                    <label for="sort-by" class="form-label">Sort By</label>
                                    <select id="sort-by" name="sort-by" class="form-control">
                                        <option value="name">Product Name</option>
                                        <option value="strength">Strength</option>
                                        <option value="quantity">Quantity</option>
                                        <option value="buying_price">Buying Price</option>
                                        <option value="selling_price">Selling Price</option>
                                        <option value="expiration_date">Expiration Date</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="sort-order" class="form-label">Sort Order</label>
                                    <select id="sort-order" name="sort-order" class="form-control">
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-hover" id="products-table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Product Name</th>
                                        <th>Strength</th>
                                        <th>Quantity</th>
                                        <th>Buying Price</th>
                                        <th>Selling Price</th>
                                        <th>Expiration Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="product_list">
                                    @foreach ($products as $key => $product)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->strength }}</td>
                                        <td>{{ $product->supplied_quantity }}</td>
                                        <td>${{ number_format($product->buying_price, 2) }}</td>
                                        <td>${{ number_format($product->selling_price, 2) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($product->expiration_date)->format('M d, Y') }}
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>


        </div>
    </div>
    <script src="{{ asset('/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('/js/popper.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/script.js') }}"></script>
    <script src="{{ asset('/js/jquery-ui.js') }}"></script>

</body>
<script>
    $(document).ready(function() {

        let url = "/api/supply/available-products/" + $('#product_id').attr('supply');

        $("#product_id").autocomplete({
            source: url,
            select: function(event, ui) {
                // console.log(ui.item);
                $('#product_id').attr('data-val', ui.item.id);
                $.ajax({
                    type: "get",
                    url: "/api/product/strength/" + ui.item.id,
                    success: function(prod) {
                        $.map(prod.product_strengths, function(strength, indexOrKey) {
                            $('#strength_id').append(`
                                <option value="${strength.id}">${strength.strength  }</option>
                            `);
                        });
                        $('#strength_id').focus();
                    }
                });
            }
        });

        $('#strength_id').change(function() {
            if ($('#strength_id').val()) {
                $('#supplied_quantity').focus();
                $(this).removeClass('is-invalid');
            } else
                $(this).addClass('is-invalid');
        });

        $('#supplied_quantity').keypress(function(e) {
            if (e.which == 13) {
                e.preventDefault();
                $('#buying_price').focus();
            }
        });

        $('#buying_price').keypress(function(e) {
            if (e.which == 13) {
                e.preventDefault();
                $('#selling_price').focus();
            }
        });

        $('#selling_price').keypress(function(e) {
            if (e.which == 13) {
                e.preventDefault();
                $('#expiration_date').focus();
            }
        });

        $('#expiration_date').keypress(function(e) {
            if (e.which == 13) {
                e.preventDefault();
                $('button[type=submit]').focus();
            }
        });
        // on product_add submit
        $('#product_add').submit(function(e) {
            e.preventDefault();
            let supply_id = $('#supply_id').val();
            let product_id = $('#product_id').attr('data-val');
            let strength_id = $('#strength_id').val();
            let supplied_quantity = $('#supplied_quantity').val();
            let buying_price = $('#buying_price').val();
            let selling_price = $('#selling_price').val();
            let expiration_date = $('#expiration_date').val();
            $.ajax({
                type: "post",
                url: "/api/supply/batch/add",
                data: {
                    supply_id: supply_id,
                    product_id: product_id,
                    strength_id: strength_id,
                    supplied_quantity: supplied_quantity,
                    buying_price: buying_price,
                    selling_price: selling_price,
                    expiration_date: expiration_date
                },
                xhrFields: {
                    withCredentials: true,
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function(product) {
                    $('#product_list').append(`
                        <tr>
                            <td>${product.id}</td>
                            <td>${product.name}</td>
                            <td>${product.strength}</td>
                            <td>${product.supplied_quantity}</td>
                            <td>${product.buying_price}</td>
                            <td>${product.selling_price}</td>
                            <td>${product.expiration_date}</td>
                        </tr>
                    `);

                },
                error: function(xhr) {
                    if (xhr.responseJSON) {
                        labelErrors('#product_add .form-control', xhr.responseJSON.errors);
                    }
                }
            });
        });





    });
</script>

</html>