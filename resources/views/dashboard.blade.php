@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

{{-- Include Chart.js di section plugins --}}
@section('plugins.Chartjs', true)

@section('content')
<div class="row">
    <div class="col-lg-4 col-6">
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
    
    <div class="col-lg-4 col-6">
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

    <div class="col-lg-4 col-6">
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
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
           <div class="card-header d-flex justify-content-between align-items-center">
    <h3 class="card-title mb-0">Jumlah Siswa per Tahun (Laki-laki vs Perempuan)</h3>
    <div>
        <select id="chartTypeSelector" class="form-control form-control-sm">
            <option value="bar" selected>Bar</option>
            <option value="line">Line</option>
            <option value="pie">Pie</option>
        </select>
    </div>
</div>

            <div class="card-body">
                <div class="chart">
                    <canvas id="siswaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
$(document).ready(function() {
    if (typeof Chart !== 'undefined') {
        const ctx = document.getElementById('siswaChart').getContext('2d');

        const labels = @json($siswaPerTahun->pluck('tahun'));
        const dataLaki = @json($siswaPerTahun->pluck('laki_laki'));
        const dataPerempuan = @json($siswaPerTahun->pluck('perempuan'));

        let currentChart;

        function renderChart(type) {
            if (currentChart) {
                currentChart.destroy();
            }

            const isPie = type === 'pie';

            const config = {
                type: type,
                data: isPie ? {
                    labels: ['Laki-laki', 'Perempuan'],
                    datasets: [{
                        label: 'Jumlah Total',
                        data: [
                            dataLaki.reduce((a, b) => a + b, 0),
                            dataPerempuan.reduce((a, b) => a + b, 0)
                        ],
                        backgroundColor: ['#007bff', '#dc3545'],
                        borderWidth: 1
                    }]
                } : {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Laki-laki',
                            backgroundColor: '#007bff',
                            borderColor: '#007bff',
                            data: dataLaki,
                            fill: false
                        },
                        {
                            label: 'Perempuan',
                            backgroundColor: '#dc3545',
                            borderColor: '#dc3545',
                            data: dataPerempuan,
                            fill: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: isPie ? {} : {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
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
            };

            currentChart = new Chart(ctx, config);
        }

        // Inisialisasi chart pertama kali
        renderChart('bar');

        // Ubah chart ketika dropdown berubah
        $('#chartTypeSelector').on('change', function () {
            const selectedType = $(this).val();
            renderChart(selectedType);
        });

    } else {
        console.error('Chart.js not loaded');
        $('#siswaChart').parent().html('<p class="text-center text-muted">Chart.js tidak dapat dimuat</p>');
    }
});
</script>

@stop