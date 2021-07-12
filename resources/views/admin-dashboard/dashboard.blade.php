@extends('admin-dashboard.layout.master')

@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
<div class="row">
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
          <div class="float-left">
            <i class="mdi mdi-cube text-danger icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Total Revenue</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{ number_format($total, 2, '.', ',') }}$</h3>
            </div>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0 text-left text-md-center text-xl-left">
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
          <div class="float-left">
            <i class="mdi mdi-receipt text-warning icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Orders</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{ number_format($orders, 0, '.', ',')}}</h3>
            </div>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0 text-left text-md-center text-xl-left">
          <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> Product-wise sales </p>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
          <div class="float-left">
            <i class="mdi mdi-poll-box text-success icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Sales</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{ number_format($sales, 0, '.', ',')}}</h3>
            </div>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0 text-left text-md-center text-xl-left">
          <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Total Sales </p>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
          <div class="float-left">
            <i class="mdi mdi-account-box-multiple text-info icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Clients</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{ number_format($clients, 0, '.', ',')}}</h3>
            </div>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0 text-left text-md-center text-xl-left">
          <i class="mdi mdi-reload mr-1" aria-hidden="true"></i> Our Clients </p>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
          <h2 class="card-title mb-0">Product Analysis</h2>
          <div class="wrapper d-flex">
            <div class="d-flex align-items-center">
              <span class="dot-indicator bg-primary"></span>
              <p class="mb-0 ml-2 text-muted">Sales</p>
            </div>
          </div>
        </div>
        <div class="chart-container">
          <canvas id="dashboard-area-chart" height="100"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('plugin-scripts')
  {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
  {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
@endpush

@push('custom-scripts')
  {{--{!! Html::script('/assets/js/dashboard.js') !!}--}}
  <script>
      if ($("#dashboard-area-chart").length) {
          var lineChartCanvas = $("#dashboard-area-chart")
              .get(0)
              .getContext("2d");
          var data = {
              labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
              datasets: [
                  {
                      label: "Product",
                      data: [{{$monday}}, {{$tuesday}}, {{$wednesday}}, {{$thursday}}, {{$friday}}, {{$saturday}},{{$sunday}}],
                      backgroundColor: "#2196f3",
                      borderColor: "#0c83e2",
                      borderWidth: 1,
                      fill: true
                  },
              ]
          };
          var options = {
              responsive: true,
              maintainAspectRatio: true,
              scales: {
                  yAxes: [
                      {
                          gridLines: {
                              color: "#F2F6F9"
                          },
                          ticks: {
                              beginAtZero: true,
                              min: 0,
                              max: Math.max.apply(this, data.datasets[0].data) + 100,
                              stepSize: 100
                          }
                      }
                  ],
                  xAxes: [
                      {
                          gridLines: {
                              color: "#F2F6F9"
                          },
                          ticks: {
                              beginAtZero: true
                          }
                      }
                  ]
              },
              legend: {
                  display: false
              },
              elements: {
                  point: {
                      radius: 2
                  }
              },
              layout: {
                  padding: {
                      left: 0,
                      right: 0,
                      top: 0,
                      bottom: 0
                  }
              },
              stepsize: 1
          };
          var lineChart = new Chart(lineChartCanvas, {
              type: "line",
              data: data,
              options: options
          });
      }
  </script>
@endpush
