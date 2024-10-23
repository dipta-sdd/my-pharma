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

            <main class="col-md-9 ms-sm-auto col-lg-10 p-2 px-md-4 ">
                <h2>Supplys</h2>
                <hr>
                <form action=" /create-supply" method="post" class="row needs-validation">
                    @csrf
                    <div class="col-lg-5 mb-2">
                        <label for="branch_id" class="form-label">Branch : </label>
                        <select id="branch_id" class="form-control" name="branch_id" @if (auth()->user()->role ==
                            'user') disabled @endif required>
                            <option value="">Select Branch</option>
                            @foreach ($branches as $id => $branch)
                            <option value="{{ $branch->id }}"
                                {{ auth()->user()->branch_id == $branch->id ? 'selected' : '' }}>
                                {{ $branch->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-5 mb-2">
                        <label for="supplier_id" class="form-label">Select Supplier : </label>
                        <select id="supplier_id" class="form-control" name="supplier_id">
                            <option value="null" selected>Normal Entry</option>
                            @foreach ($suppliers as $id => $supplier)
                            <option value="{{ $id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 mb-2 d-flex align-items-end justify-content-end">
                        <button type="submit" class="btn btn-primary">Create New Supply</button>
                    </div>

                </form>
                <hr>

                <div class="table-responsive">

                    <table class="table table-striped table-hover mybg border">
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
                                <td class="text-capitalize">{{ $supply->status }}</td>
                                <td class="text-capitalize">{{ $supply->total_price }}</td>
                                <td class="text-capitalize">{{ $supply->created_at }}</td>
                                <td class="text-capitalize">{{ $supply->updated_at }}</td>
                                <td class="text-capitalize">{{ $supply->creator->name }}</td>
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