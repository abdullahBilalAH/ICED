@extends('layouts.app')

@section('title', 'Order Chart')

@section('content')
<div class="container">
    <h1>Order Charts</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="chart-container">
                <canvas id="myChart" width="400" height="300"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="chart-container">
                <canvas id="myDoughnutChart" width="400" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Pass data from Laravel to JavaScript
    const labels = @json($labels);
    const data = @json($data);
    const doughnutLabels = @json($doughnutLabels);
    const doughnutData = @json($doughnutData);

    const chartData = {
        labels: labels,
        datasets: [{
            label: 'Number of Orders',
            data: data,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    };
    const config = {
        type: 'line',
        data: chartData,
    };

    window.onload = function() {
        const ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, config);

        // Doughnut chart configuration
        const doughnutDataConfig = {
            labels: doughnutLabels,
            datasets: [{
                label: 'Items Quantity',
                data: doughnutData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        };
        const doughnutConfig = {
            type: 'doughnut',
            data: doughnutDataConfig,
        };

        const ctxDoughnut = document.getElementById('myDoughnutChart').getContext('2d');
        new Chart(ctxDoughnut, doughnutConfig);
    };
</script>

<style>
    .chart-container {
        padding: 15px;
    }
    canvas {
        max-width: 100%;
        height: auto !important;
    }
</style>
@endsection
