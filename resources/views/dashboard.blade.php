@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

{{-- Include Chart.js di section plugins --}}
@section('plugins.Chartjs', true)

@section('content')
<div class="row row-cols-1 row-cols-md-4">
    <div class="col">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalSiswa }}</h3>
                <p>Total Siswa</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-graduate"></i>
            </div>
        </div>
    </div>

    <div class="col ">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalJurusan }}</h3>
                <p>Total Jurusan</p>
            </div>
            <div class="icon">
                <i class="fas fa-layer-group"></i>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $totalAgama }}</h3>
                <p>Total Agama</p>
            </div>
            <div class="icon">
                <i class="fas fa-praying-hands"></i>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $totalUser }}</h3>
                <p>Total User</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
</div>

<p class="text-lg">Statistik Siswa</p>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><strong>Bar Chart</strong></div>
            <div class="card-body">
                <canvas id="barChart" style="height: 250px;"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><strong>Line Chart</strong></div>
            <div class="card-body">
                <canvas id="lineChart" style="height: 250px;"></canvas>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    $(document).ready(function () {
        const labels = @json($siswaPerTahun->pluck('tahun'));
        const dataLaki = @json($siswaPerTahun->pluck('laki_laki'));
        const dataPerempuan = @json($siswaPerTahun->pluck('perempuan'));

        function renderChart(canvasId, type) {
            const ctx = document.getElementById(canvasId).getContext('2d');

            new Chart(ctx, {
                type: type,
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Laki-laki',
                            data: dataLaki,
                            backgroundColor: type === 'bar' ? 'rgba(0, 123, 255, 0.5)' : 'transparent',
                            borderColor: 'rgba(0, 123, 255, 1)',
                            fill: true,
                            tension: 0.4,
                        },
                        {
                            label: 'Perempuan',
                            data: dataPerempuan,
                            backgroundColor: type === 'bar' ? 'rgba(220, 53, 69, 0.5)' : 'transparent',
                            borderColor: 'rgba(220, 53, 69, 1)',
                            fill: true,
                            tension: 0.4,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (value) {
                                    return Number.isInteger(value) ? value : null;
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    }
                }
            });
        }

        renderChart('barChart', 'bar');
        renderChart('lineChart', 'line');
    });
</script>


@stop