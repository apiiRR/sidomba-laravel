@extends('layouts.master')

@push('tambahan')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <!-- Content Row -->
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-{{ $randomColors[0] }} shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-{{  $randomColors[0] }} text-uppercase mb-1">
                Total Domba
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                {{ number_format($totalSheep) }} Ekor
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-plus fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-{{ $randomColors[1] }} shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-{{  $randomColors[1] }} text-uppercase mb-1">
                Total Domba Breeding
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                {{ number_format($breedingSheep) }} Ekor
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-plus fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-{{ $randomColors[2] }} shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-{{  $randomColors[2] }} text-uppercase mb-1">
                Total Domba Fattening
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                {{ number_format($fatteningSheep) }} Ekor
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-plus fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Row -->
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-{{ $randomColors[3] }} shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-{{  $randomColors[3] }} text-uppercase mb-1">
                Total Kematian Domba
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                {{ number_format($deathCount) }} Ekor
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-skull-crossbones fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-{{ $randomColors[4] }} shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-{{  $randomColors[4] }} text-uppercase mb-1">
                Total Domba Sakit
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                {{ number_format($sickSheep) }} Ekor
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-viruses fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-{{ $randomColors[5] }} shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-{{  $randomColors[5] }} text-uppercase mb-1">
                Rata Rata Pertumbuhan Berat
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                {{ number_format($averageWeight) }} Kg
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-weight fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Row -->
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-{{ $randomColors[6] }} shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-{{  $randomColors[6] }} text-uppercase mb-1">
                Total Pakan Hari Ini
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                {{ number_format($totalFeedToday) }} Kg
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-carrot fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4" hidden>
      <div class="card border-left-{{ $randomColors[7] }} shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-{{  $randomColors[7] }} text-uppercase mb-1">
                Total Domba Sakit
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-plus fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4" hidden>
      <div class="card border-left-{{ $randomColors[8] }} shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-{{  $randomColors[8] }} text-uppercase mb-1">
                Rata Rata Pertumbuhan Berat
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-plus fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Pertumbuhan Populasi</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-area">
            <canvas id="myAreaChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header">Dropdown Header:</div>
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-pie pt-4 pb-2">
            <canvas id="myPieChart"></canvas>
          </div>
          <div class="mt-4 text-center small">
            <span class="mr-2">
              <i class="fas fa-circle text-primary"></i> Direct
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-success"></i> Social
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-info"></i> Referral
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Hidden input buat passing data ke javascript -->
  <input type="hidden" id="labels" value='@json($labelsPopulationGrowth)'>
  <input type="hidden" id="data" value='@json($dataPopulationGrowth)'>
  <!-- /.container-fluid -->
  @endsection

  @push('javascript')

  <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>


  <!-- Page level plugins -->
  <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

  <!-- Page level custom scripts -->
  {{-- <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script> --}}
  <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
    // Ambil data dari hidden input
    let labels = JSON.parse(document.getElementById('labels').value);
    let data = JSON.parse(document.getElementById('data').value);

    var ctx = document.getElementById("myAreaChart").getContext('2d');
    var myAreaChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: "Pertumbuhan Populasi",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: data
            }]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10, right: 25, top: 25, bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: { unit: 'month' },
                    gridLines: { display: false, drawBorder: false },
                    ticks: { maxTicksLimit: 12 }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    gridLines: { color: "rgb(234, 236, 244)", zeroLineColor: "rgb(234, 236, 244)", drawBorder: false, borderDash: [2], zeroLineBorderDash: [2] }
                }]
            },
            legend: { display: false }
        }
    });
  });
  </script>

  @endpush