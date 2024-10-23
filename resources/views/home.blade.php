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
                <div class="row">
                    <div class="col-lg-3 col-6 p-2">
                        <div class="bg-dark border rounded-1 h-100 p-3 dashboard-top">
                            <div class="top d-flex flex-row justify-content-between">
                                <h6>Delevery Fee</h6>
                                <button class="btn btn-outline-primary p-0 border-0 align-self-start"> <i
                                        class="fa-solid fa-pencil" aria-hidden="true"></i></button>
                            </div>
                            <div class="bottom ps-2">
                                <small>Fee : 60</small><br>
                                <small>Offer At: 0</small><br>
                                <small>Offer Fee: 0</small><br>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6 p-2">
                        <div class="bg-dark border rounded-1 h-100 p-3 dashboard-top">
                            <div class="top d-flex flex-row justify-content-between">
                                <h6> </h6>
                            </div>
                            <div class="bottom ps-2">
                                <small></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6 p-2">
                        <div class="bg-dark border rounded-1 h-100 p-3 dashboard-top">
                            <div class="top d-flex flex-row justify-content-between">
                                <h6> </h6>
                            </div>
                            <div class="bottom ps-2">
                                <small></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6 p-2">
                        <div class="bg-dark border rounded-1 h-100 p-3 dashboard-top">
                            <div class="top d-flex flex-row justify-content-between">
                                <h6> </h6>
                            </div>
                            <div class="bottom ps-2">
                                <small></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 p-2">
                        <div class="w-100 border dash-chart">
                            <canvas class="w-100" id="crt1"></canvas>
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
    labels = ['Product A', 'Product B', 'Product C', 'Product D', 'Product E'];
    label = 'Number of Orders';
    data = [10, 20, 30, 40, 50];
    create_chart('crt1', 'line', labels, label, data);

    function create_chart(canvas_id, type, labels, label, data) {
        const ctx = document.getElementById(canvas_id).getContext('2d');
        new Chart(ctx, {
            type: type, // You can change the chart type if you want
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
</script>

</html>