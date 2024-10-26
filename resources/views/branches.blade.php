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
                    <h1 class="h2">Branches</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.print()">
                                Print
                            </button>
                        </div>
                        <a type="button" class="btn btn-sm btn-primary" data-bs-toggle="collapse"
                            href="#add_branch_collapse" role="button" aria-expanded="false"
                            aria-controls="add_branch_collapse" id="" add_branch_collapse_btn>
                            <i class="fas fa-plus"></i> Add Branch
                        </a>
                    </div>
                </div>
                <form action="/branches/create" method="post" class=" collapse  {{ $errors->any() ? 'errors' : '' }}"
                    id="add_branch_collapse" data-bs-parent="#add_branch_collapse_btn">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Add Branch</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label">Name : <span
                                                    class="small text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control name @error('name') is-invalid @enderror" id="name"
                                                name="name" value="{{ old('name') }}" required>
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="contact_info" class="form-label"> Mobile : <span
                                                    class="small text-danger">*</span>
                                            </label>
                                            <input type="number"
                                                class="form-control contact_info @error('contact_info') is-invalid @enderror"
                                                id="contact_info" name="contact_info" value="{{ old('contact_info') }}"
                                                required>
                                            @error('contact_info')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address : <span
                                                class="small text-danger">*</span>
                                        </label>
                                        <textarea class="form-control address @error('address') is-invalid @enderror"
                                            id="address" name="address"> {{ old('address') }}</textarea>
                                        @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>


                                    <div class="text-end">
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="collapse"
                                            data-bs-target="#add_branch_collapse" aria-expanded="false"
                                            aria-controls="add_branch_collapse">
                                            <i class="fas fa-times"></i> Close
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Add New Branch
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>




                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Branch List</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Contact Info</th>
                                        <th>Created By</th>
                                        <th>Updated By</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($branches as $branch)
                                    <tr class=" text-capitalize">
                                        <td>{{ $branch->id }}</td>
                                        <td>{{ $branch->name }}</td>
                                        <td>{{ $branch->address }}</td>
                                        <td>{{ $branch->contact_info }}</td>
                                        <td>{{ $branch->createdBy }}</td>
                                        <td>{{ $branch->updatedBy }}</td>
                                        <td>{{ $branch->created_at->format('M d, Y H:i')  }}</td>
                                        <td>{{ $branch->updated_at->format('M d, Y H:i')  }}</td>

                                        <!-- <td> <a><i class="fa-solid fa-pencil" aria-hidden="true"></i></a> </td> -->
                                        <td class="text-end">
                                            <a class="btn btn-sm btn-outline-primary me-1 btn-edit" title="Edit"
                                                data-id="{{ $branch->id }}" data-name="{{ $branch->name }}"
                                                data-address="{{ $branch->address }}"
                                                data-contact_info="{{ $branch->contact_info }}" href="#">
                                                <i class="fas fa-edit"></i>
                                            </a>
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
    <script>
    $(document).ready(function() {
        $('.collapse.errors').collapse('show');

        $('.btn-edit').on('click', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let address = $(this).data('address');
            let contact_info = $(this).data('contact_info');
            $("#add_branch_collapse").addClass('edit');
            $('#add_branch_collapse .card-title').text('Edit Branch');
            $('#add_branch_collapse .btn-primary').html('<i class="fas fa-save"></i>  Update Branch');
            $("#add_branch_collapse").attr('data-id', id);
            $('#add_branch_collapse .form-control.name').val(name);
            $('#add_branch_collapse .form-control.address').val(address);
            $('#add_branch_collapse .form-control.contact_info').val(contact_info);
            $('#add_branch_collapse').collapse('show');

        });
        $(document).on('click', '#add_branch_collapse.edit .btn-primary', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "/api/branches/edit/" + $("#add_branch_collapse").data('id'),

                data: {
                    name: $('#add_branch_collapse .form-control.name').val(),
                    address: $('#add_branch_collapse .form-control.address').val(),
                    contact_info: $('#add_branch_collapse .form-control.contact_info').val()
                },
                xhrFields: {
                    withCredentials: true,
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function(data) {
                    location.reload();

                },
                error: function(data) {
                    e = data.responseJSON.errors;
                    $('#add_branch_collapse .form-control').each(function() {

                        $(this).removeClass('is-invalid');
                        $(this).next('.invalid-feedback').remove();
                        if (e[$(this).attr('name')]) {
                            $(this).addClass('is-invalid');
                            $(this).after(`
                                <div class="invalid-feedback">
                                    ${e[$(this).attr('name')]}
                                </div>
                            `);
                        }
                    });
                }
            });

        });

        const myCollapsible = document.getElementById('add_branch_collapse')
        myCollapsible.addEventListener('hidden.bs.collapse', event => {
            $("#add_branch_collapse").removeClass('edit');
            $('#add_branch_collapse .card-title').html(' <i class="fas fa-plus"></i>  Add New Branch');
            $('#add_branch_collapse .btn-primary').text('Add Branch');
            $('#add_branch_collapse .form-control').each(function() {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
                $(this).val('');
            });
        })

    });
    </script>
</body>

</html>