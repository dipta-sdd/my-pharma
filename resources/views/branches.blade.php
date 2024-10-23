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
                <h2>All Branches</h2>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-hover mybg border">
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
                                <th></th>
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
                                <td>{{ $branch->created_at }}</td>
                                <td>{{ $branch->updated_at }}</td>

                                <td> <a href="/branches/edit/{{$branch->id }}"><i class="fa-solid fa-pencil"
                                            aria-hidden="true"></i></a>
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
</body>

</html>