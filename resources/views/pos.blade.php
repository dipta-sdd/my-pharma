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
</head>

<body>
    @include('header')


    <div class="container-fluid">
        <div class="row">

            @include('sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Point of Sale</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-outline-secondary me-2">
                            <i class="fas fa-print"></i> Print Last Receipt
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-history"></i> View Sales History
                        </button>
                    </div>
                </div>

                <div class="row">
                    <!-- Product Search and Cart -->
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Create New Order</h5>
                            </div>
                            <div class="card-body">
                                <!-- Product Search -->
                                <div class="mb-3">
                                    <label for="productSearch" class="form-label">Search Product</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="productSearch" placeholder="Enter product name or scan barcode">
                                        <button class="btn btn-outline-secondary" type="button">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Product List -->
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="cartItems">
                                            <tr>
                                                <td>Paracetamol 500mg</td>
                                                <td>$5.99</td>
                                                <td>
                                                    <div class="input-group input-group-sm" style="width: 100px;">
                                                        <button class="btn btn-outline-secondary" type="button">-</button>
                                                        <input type="text" class="form-control text-center" value="2">
                                                        <button class="btn btn-outline-secondary" type="button">+</button>
                                                    </div>
                                                </td>
                                                <td>$11.98</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Amoxicillin 250mg</td>
                                                <td>$8.50</td>
                                                <td>
                                                    <div class="input-group input-group-sm" style="width: 100px;">
                                                        <button class="btn btn-outline-secondary" type="button">-</button>
                                                        <input type="text" class="form-control text-center" value="1">
                                                        <button class="btn btn-outline-secondary" type="button">+</button>
                                                    </div>
                                                </td>
                                                <td>$8.50</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Order Summary</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="customerName" class="form-label">Customer Name</label>
                                    <input type="text" class="form-control" id="customerName">
                                </div>
                                <div class="mb-3">
                                    <label for="customerPhone" class="form-label">Customer Phone</label>
                                    <input type="tel" class="form-control" id="customerPhone">
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal:</span>
                                    <span>$20.48</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Tax (10%):</span>
                                    <span>$2.05</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Discount:</span>
                                    <div class="input-group input-group-sm" style="width: 100px;">
                                        <input type="text" class="form-control" value="0">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between mb-2">
                                    <strong>Total:</strong>
                                    <strong>$22.53</strong>
                                </div>
                                <div class="mb-3">
                                    <label for="paymentMethod" class="form-label">Payment Method</label>
                                    <select class="form-select" id="paymentMethod">
                                        <option value="cash">Cash</option>
                                        <option value="card">Credit/Debit Card</option>
                                        <option value="mobile">Mobile Payment</option>
                                    </select>
                                </div>
                                <button class="btn btn-primary w-100 mb-2">
                                    <i class="fas fa-shopping-cart me-2"></i>Complete Sale
                                </button>
                                <button class="btn btn-outline-secondary w-100">
                                    <i class="fas fa-times me-2"></i>Cancel Order
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Product Selection -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Quick Product Selection</h5>
                            </div>
                            <div class="card-body">
                                <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-4">
                                    <div class="col">
                                        <button class="btn btn-outline-primary w-100">Paracetamol</button>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-outline-primary w-100">Ibuprofen</button>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-outline-primary w-100">Aspirin</button>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-outline-primary w-100">Amoxicillin</button>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-outline-primary w-100">Cetirizine</button>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-outline-primary w-100">Omeprazole</button>
                                    </div>
                                </div>
                            </div>
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
</body>

</html>