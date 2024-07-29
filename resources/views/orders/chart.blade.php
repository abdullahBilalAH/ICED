@extends('layouts.app')

@section('title', 'Order Chart')

@section('content')
<div>
    <canvas id="myChart" width="800" height="400"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Pass data from Laravel to JavaScript
    const labels = @json($labels);
    const data = @json($data);

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
    };
</script>
@endsection
