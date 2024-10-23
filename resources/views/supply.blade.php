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

            <main class="col-md-9 ms-sm-auto col-lg-10 p-2 px-md-4 ">
                <div class="supply-details text-capitalize">
                    <h2>Supply Details</h2>
                    <hr>
                    <table class="">
                        <tr>
                            <th>Supply ID</th>
                            <td class="px-2"> : </td>
                            <td> {{ $supply->id }}</td>
                        </tr>
                        <tr>
                            <th>Supplier</th>
                            <td class="px-2"> : </td>
                            <td> {{ $supply->supplier->name ?? 'Normal Entry' }}</td>
                        </tr>
                        <tr>
                            <th>Branch</th>
                            <td class="px-2"> : </td>
                            <td> {{ $supply->branch->name }}</td>
                        </tr>
                        <tr>
                            <th>Created By</th>
                            <td class="px-2"> : </td>
                            <td> {{ $supply->creator->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>Total Price</th>
                            <td class="px-2"> : </td>
                            <td> $ {{ $supply->total_price }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td class="px-2"> : </td>
                            <td> {{ $supply->status }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td class="px-2"> : </td>
                            <td> {{ $supply->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td class="px-2"> : </td>
                            <td> {{ $supply->updated_at }}</td>
                        </tr>
                    </table>
                </div>
                <hr>
                <form action="/add-product-to-supply/{{ $supply->id }}" method="post" class="row" id="product_add">
                    @csrf
                    <input type="hidden" id="supply_id" name="supply_id" value="{{ $supply->id }}">
                    <div class="col-lg-6 mb-2">
                        <label for="product_id" class="form-label">Product : </label>
                        <input type="text" id="product_id" name="product_id" class="form-control"
                            supply="{{ $supply->id }}" value="" placeholder="Product">
                    </div>
                    <div class="col-lg-3 col-6 mb-2">
                        <label for="strength_id" class=" form-label">Strength : </label>
                        <select id="strength_id" name="strength_id" class="form-control" placeholder="Strength">
                            <option value="">Select Strength</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-6 mb-2">
                        <label for="supplied_quantity" class="form-label ">Supplied Quantity : </label>
                        <input type="number" id="supplied_quantity" name="supplied_quantity" class="form-control"
                            value="" min="1" placeholder="Supplied Quantity">
                    </div>
                    <div class="col-lg-3 col-6 mb-2">
                        <label for="buying_price" class="form-label">Buying Price : </label>
                        <input type="number" id="buying_price" name="buying_price" class="form-control" value=""
                            placeholder="Buying Price">
                    </div>
                    <div class="col-lg-3 col-6 mb-2">
                        <label for="selling_price" class="form-label">Selling Price : </label>
                        <input type="number" id="selling_price" name="selling_price" class="form-control" value=""
                            placeholder="Selling Price">
                    </div>
                    <div class="col-lg-3 col-6 mb-2">
                        <label for="expiration_date" class="form-label">Expiration Date : </label>
                        <input type="date" id="expiration_date" name="expiration_date" class="form-control"
                            value="{{ date('Y-m-t') }}" placeholder="Expiration Date">
                    </div>

                    <div class="col-lg-3 col-6 mb-2 d-flex align-items-end justify-content-end">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
                <div class="table-responsive">

                    <table class="ttable table-striped table-hover mybg border">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Product Name</th>
                                <th>Strength</th>
                                <th>Supplied Quantity</th>
                                <th>Buying Price</th>
                                <th>Selling Price</th>
                                <th>Expiration Date</th>
                            </tr>
                        </thead>
                        <tbody id="product_list">
                            @foreach ($products as $key => $product)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->strength }}</td>
                                <td>{{ $product->supplied_quantity }}</td>
                                <td>{{ $product->buying_price }}</td>
                                <td>{{ $product->selling_price }}</td>
                                <td>{{ $product->expiration_date }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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