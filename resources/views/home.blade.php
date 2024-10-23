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
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Print</button>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                            <span data-feather="calendar"></span>
                            This week
                        </button>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-4">
                        <div class="card bg-primary text-white h-100">
                            <div class="card-body">
                                <h5 class="card-title">Total Sales</h5>
                                <p class="card-text display-6">$15,350</p>
                            </div>
                            <div class="card-footer d-flex">
                                View Details
                                <span class="ms-auto">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card bg-warning text-white h-100">
                            <div class="card-body">
                                <h5 class="card-title">Low Stock Items</h5>
                                <p class="card-text display-6">23</p>
                            </div>
                            <div class="card-footer d-flex">
                                View Details
                                <span class="ms-auto">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card bg-success text-white h-100">
                            <div class="card-body">
                                <h5 class="card-title">Total Products</h5>
                                <p class="card-text display-6">1,257</p>
                            </div>
                            <div class="card-footer d-flex">
                                View Details
                                <span class="ms-auto">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card bg-danger text-white h-100">
                            <div class="card-body">
                                <h5 class="card-title">Expired Products</h5>
                                <p class="card-text display-6">15</p>
                            </div>
                            <div class="card-footer d-flex">
                                View Details
                                <span class="ms-auto">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Sales -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Recent Sales
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Invoice #</th>
                                        <th>Customer</th>
                                        <th>Products</th>
                                        <th>Total</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>INV-001</td>
                                        <td>John Doe</td>
                                        <td>Paracetamol, Amoxicillin</td>
                                        <td>$45.50</td>
                                        <td>2023-05-20</td>
                                        <td><span class="badge bg-success">Completed</span></td>
                                    </tr>
                                    <tr>
                                        <td>INV-002</td>
                                        <td>Jane Smith</td>
                                        <td>Ibuprofen, Vitamin C</td>
                                        <td>$28.75</td>
                                        <td>2023-05-20</td>
                                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>INV-003</td>
                                        <td>Bob Johnson</td>
                                        <td>Aspirin, Bandages</td>
                                        <td>$15.20</td>
                                        <td>2023-05-19</td>
                                        <td><span class="badge bg-success">Completed</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Low Stock Products -->
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-exclamation-triangle me-1"></i>
                                Low Stock Products
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Current Stock</th>
                                                <th>Reorder Level</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Paracetamol 500mg</td>
                                                <td>50</td>
                                                <td>100</td>
                                            </tr>
                                            <tr>
                                                <td>Amoxicillin 250mg</td>
                                                <td>25</td>
                                                <td>75</td>
                                            </tr>
                                            <tr>
                                                <td>Ibuprofen 400mg</td>
                                                <td>30</td>
                                                <td>80</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer small text-muted">
                                <a href="#" class="btn btn-primary btn-sm">View All Low Stock Products</a>
                            </div>
                        </div>
                    </div>

                    <!-- Expiring Products -->
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-calendar-times me-1"></i>
                                Expiring Products (Next 30 Days)
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Expiry Date</th>
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Vitamin C 1000mg</td>
                                                <td>2023-06-15</td>
                                                <td>200</td>
                                            </tr>
                                            <tr>
                                                <td>Aspirin 300mg</td>
                                                <td>2023-06-20</td>
                                                <td>150</td>
                                            </tr>
                                            <tr>
                                                <td>Cetirizine 10mg</td>
                                                <td>2023-06-25</td>
                                                <td>100</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer small text-muted">
                                <a href="#" class="btn btn-primary btn-sm">View All Expiring Products</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="row mb-4">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-bolt me-1"></i>
                                Quick Actions
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <a href="#" class="btn btn-primary btn-block">
                                            <i class="fas fa-cart-plus me-2"></i>New Sale
                                        </a>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <a href="#" class="btn btn-success btn-block">
                                            <i class="fas fa-pills me-2"></i>Add Product
                                        </a>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <a href="#" class="btn btn-info btn-block">
                                            <i class="fas fa-truck me-2"></i>New Supply
                                        </a>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <a href="#" class="btn btn-warning btn-block">
                                            <i class="fas fa-file-invoice me-2"></i>Generate Report
                                        </a>
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('/js/script.js') }}"></script>
</body>
<script>

</script>

</html>