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
    <link href="{{ asset('/css/select_search.css') }}" rel="stylesheet">


</head>

<body>
    @include('header')


    <div class="container-fluid">
        <div class="row">

            @include('sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Supplies</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-outline-secondary me-2">
                            <i class="fas fa-print"></i> Print
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-download"></i> Export
                        </button>
                    </div>
                </div>

                <div class="card mb-4 p-none">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Create New Supply</h5>
                    </div>
                    <div class="card-body">
                        <form action="/create-supply" method="post" class="row g-3 needs-validation">
                            @csrf
                            <div class="col-md-5">
                                <label for="branch_id" class="form-label">Branch</label>
                                <select id="branch_id" class="form-control" name="branch_id" @if (auth()->user()->role
                                    ==
                                    'user') disabled @endif required>
                                    <option value="">Select Branch</option>
                                    @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}"
                                        {{ auth()->user()->branch_id == $branch->id ? 'selected' : '' }}>
                                        {{ $branch->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label for="supplier_id" class="form-label">Supplier</label>
                                <select id="supplier_id" class="form-control" name="supplier_id">
                                    <option value="null" selected>Normal Entry</option>
                                    @foreach ($suppliers as $id => $supplier)
                                    <option value="{{ $id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">Create New Supply</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Supply List</h5>
                    </div>
                    <div class="card-body">
                        <form id="filter-form" class="row g-3 mb-4 p-none">
                            <div class="col-md-3">
                                <label for="filter-supplier" class="form-label">Supplier</label>
                                <input type="text" id="filter-supplier" name="filter-supplier" class="form-control"
                                    placeholder="Filter by supplier">
                            </div>
                            <div class="col-md-3">
                                <label for="filter-branch" class="form-label">Branch</label>
                                <input type="text" id="filter-branch" name="filter-branch" class="form-control"
                                    placeholder="Filter by branch">
                            </div>
                            <div class="col-md-3">
                                <label for="filter-status" class="form-label">Status</label>
                                <select id="filter-status" name="filter-status" class="form-control">
                                    <option value="">All Statuses</option>
                                    <option value="pending">Pending</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="sort-by" class="form-label">Sort By</label>
                                <select id="sort-by" name="sort-by" class="form-control">
                                    <option value="created_at">Created At</option>
                                    <option value="updated_at">Last Update</option>
                                    <option value="total_price">Amount</option>
                                    <option value="supplier">Supplier</option>
                                    <option value="branch">Branch</option>
                                </select>
                            </div>
                        </form>
                        <hr class="p-none">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Supplier</th>
                                        <th>SL No</th>
                                        <th>Branch</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                        <th>Created At</th>
                                        <th>Last Update</th>
                                        <th>Created By</th>
                                    </tr>
                                </thead>
                                <tbody class="supply-table">
                                    @foreach ($supplies as $index => $supply)
                                    <tr supply_id="{{ $supply->id }}" class="cursor-pointer">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $supply->supplier->name ?? 'Normal Entry' }}</td>
                                        <td>{{ $supply->id }}</td>
                                        <td class="text-capitalize">{{ $supply->branch->name }}</td>
                                        <td class="text-capitalize">
                                            <span
                                                class="badge bg-{{ $supply->status === 'completed' ? 'success' : ($supply->status === 'pending' ? 'warning' : 'danger') }}">
                                                {{ $supply->status }}
                                            </span>
                                        </td>
                                        <td>${{ number_format($supply->total_price, 2) }}</td>
                                        <td>{{ $supply->created_at->format('M d, Y H:i') }}</td>
                                        <td>{{ $supply->updated_at->format('M d, Y H:i') }}</td>
                                        <td class="text-capitalize">{{ $supply->creator->name }}</td>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
        integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

</body>
<script>
$(document).ready(function() {
    $('#supplier_id').selectize({
        sortField: 'text'
    });
    $('.supply-table tr').click(function(e) {
        e.preventDefault();
        var supply_id = $(this).attr('supply_id');
        window.location.href = "/supply?id=" + supply_id;
    });
});
</script>

</html>