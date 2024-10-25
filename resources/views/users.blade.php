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
                    <h1 class="h2">User Management</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Print</button>
                        </div>
                        <button type="button" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i> Add New User
                        </button>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Users List</h5>
                    </div>
                    <div class="card-body">
                        <form id="filter-form" class="row g-3 mb-4">
                            <div class="col-md-3">
                                <label for="filter-branch" class="form-label">Branch</label>
                                <input type="text" id="filter-branch" name="filter-branch" class="form-control"
                                    placeholder="Filter by branch">
                            </div>
                            <div class="col-md-3">
                                <label for="filter-status" class="form-label">Status</label>
                                <select id="filter-status" name="filter-status" class="form-control">
                                    <option value="">All Statuses</option>
                                    <option value="admin">Admin</option>
                                    <option value="manager">Manager</option>
                                    <option value="branch_manager">Branch Manager</option>
                                    <option value="staff">Staff</option>
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
                            <div class="col-md-3">
                                <label for="sort-order" class="form-label">Sort Order</label>
                                <select id="sort-order" name="sort-order" class="form-control">
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Branch</th>
                                        <th scope="col">Created By</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Updated At</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="userTableBody">
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td class="text-capitalize">{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td class="text-capitalize">
                                            <span
                                                class="badge bg-{{ $user->role === 'admin' ? 'primary' : ($user->role === 'manager' ? 'success' : ($user->role === 'branch_manager' ? 'warning' : 'secondary')) }}">
                                                {{ $user->role == 'branch_manager' ? 'Branch Manager' : $user->role }}
                                            </span>
                                        </td>
                                        <td class="text-capitalize">{{ $user->branch_name }}</td>
                                        <td class="text-capitalize">{{ $user->createdBy }}</td>
                                        <td>{{ $user->created_at->format('M d, Y H:i') }}</td>
                                        <td>{{ $user->updated_at->format('M d, Y H:i') }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-primary btn-sm" target="{{ $user->id }}">
                                                <i class="fas fa-edit"></i>
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
</body>

</html>