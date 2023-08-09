@extends('admin.layouts')

@section('content')
<h1 class="mt-4">Dashboard</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Statistik Pendaftaran Tahun {{ date('Y') }}</li>
</ol>

@include('components.alerts')

<div class="mb-4">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-end">
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalImport"><i class="fa-solid fa-file-import"></i> Import Data Siswa</button>
                <a href="{{ route('admin.siswa.export') }}" class="btn btn-success"><i class="fa-solid fa-file-export"></i> Export Data Siswa</a>
                <a href="{{ route('admin.siswa.pdf') }}" target="_blank" class="btn btn-danger"><i class="fa-solid fa-file-pdf"></i> Cetak Data Siswa</a>
                <button class="btn btn-primary" id="download"><i class="fa-solid fa-file-pdf"></i> Cetak Statistik</button>
            </div>
        </div>
    </div>
</div>

<div id="cetak">

  <div class="row">
    <div class="col-md-12 mb-3">
      <strong>Total Pendaftar: {{ DB::table('siswa')->whereYear('created_at', \Carbon\Carbon::now()->format('Y'))->count() }}</strong> |
      <strong>Perlu Validasi: {{ DB::table('siswa')->whereYear('created_at', \Carbon\Carbon::now()->format('Y'))->where('status', 0)->count() }}</strong> |
      <strong>Diterima: {{ DB::table('siswa')->whereYear('created_at', \Carbon\Carbon::now()->format('Y'))->where('status', 1)->count() }}</strong> |
      <strong>Ditolak: {{ DB::table('siswa')->whereYear('created_at', \Carbon\Carbon::now()->format('Y'))->where('status', 2)->count() }}</strong>
  </div>
    </div>

  <div class="row">
      <div class="col-md-6">
          <div class="card mb-4">
              <div class="card-header">
                  <i class="fas fa-chart-area me-1"></i>
                  Line Chart
              </div>
              <div class="card-body"><canvas id="myLineChart" width="100%" height="40"></canvas></div>
          </div>
      </div>
      <div class="col-md-6">
          <div class="card mb-4">
              <div class="card-header">
                  <i class="fas fa-chart-bar me-1"></i>
                  Bar Chart
              </div>
              <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
          </div>
      </div>
  </div>

  <div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-area me-1"></i>
                Persentase
            </div>
            <div class="card-body"><canvas id="myPercentageChart" width="100%" height="40"></canvas></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-bar me-1"></i>
                RPM Chart
            </div>
            <div class="card-body"><canvas id="myRpmChart" width="100%" height="40"></canvas></div>
        </div>
    </div>
  </div>

</div>

<div class="modal fade" id="modalImport" tabindex="-1" aria-labelledby="modalImportLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalImportLabel">Import File</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.siswa.import') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <input class="form-control" type="file" name="file" id="formFile" required>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Proses</button>
            </div>
        </form>
      </div>
    </div>
</div>
@endsection

@section('header')
<script>
    // cetak statistik
    window.onload = function() {
        document.getElementById('download')
        .addEventListener('click', ()=>{
            const cetak = this.document.getElementById('cetak');
            console.log(cetak);
            console.log(window);
            var opt = {
                margin:       1,
                filename:     'statistik-pendaftaran.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  {  },
                jsPDF:        { orientation: 'l', unit: 'cm', format: 'a4',}
            };

            html2pdf().from(cetak).set(opt).save();
        })
    }
</script>
@endsection

@section('footer')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<script src="https://unpkg.com/chart.js-plugin-labels-dv/dist/chartjs-plugin-labels.min.js"></script>

{{-- line --}}
<script>
    var ctx = document.getElementById("myLineChart");
    var cDataPerbulanDiterima = JSON.parse('<?php echo $perbulanditerima; ?>');
    var cDataPerbulanDitolak = JSON.parse('<?php echo $perbulanditolak; ?>');

    var myLineChart = new Chart(ctx, {
      type: 'line',
      data: {
      labels: cDataPerbulanDiterima.label,
      datasets: [{
        label: "Diterima",
        lineTension: 0.3,
        backgroundColor: "rgba(2,117,216,0.2)",
        borderColor: "rgba(2,117,216,1)",
        pointRadius: 5,
        pointBackgroundColor: "rgba(2,117,216,1)",
        pointBorderColor: "rgba(255,255,255,0.8)",
        pointHoverRadius: 5,
        pointHoverBackgroundColor: "rgba(2,117,216,1)",
        pointHitRadius: 50,
        pointBorderWidth: 2,
        data: cDataPerbulanDiterima.data,
      },{
        label: "Ditolak",
        lineTension: 0.3,
        backgroundColor: "rgba(250, 128, 114,0.2)",
        borderColor: "rgba(250, 128, 114,1)",
        pointRadius: 5,
        pointBackgroundColor: "rgba(250, 128, 114,1)",
        pointBorderColor: "rgba(255,255,255,0.8)",
        pointHoverRadius: 5,
        pointHoverBackgroundColor: "rgba(250, 128, 114,1)",
        pointHitRadius: 50,
        pointBorderWidth: 2,
        data: cDataPerbulanDitolak.data,
      }],
    },
    options: {
      scales: {
        xAxes: [{
          time: {
            unit: 'date'
          },
          gridLines: {
            display: false
          },
          ticks: {
            maxTicksLimit: 12
          }
        }],
        yAxes: [{
          ticks: {
            min: 0,
            max: 30,
            maxTicksLimit: 3
          },
          gridLines: {
            color: "rgba(0, 0, 0, .125)",
          }
        }],
      },
      legend: {
        display: false
      }
    }
  });
</script>

{{-- bar --}}
<script>
    var ctx = document.getElementById('myBarChart');
    var cDataPerbulanDiterima = JSON.parse('<?php echo $perbulanditerima; ?>');
    var cDataPerbulanDitolak = JSON.parse('<?php echo $perbulanditolak; ?>');

    const data = {
      labels: cDataPerbulanDiterima.label,
      datasets: [{
        label: 'Diterima',
        data: cDataPerbulanDiterima.data,
        backgroundColor: "rgba(2, 117, 216, 0.2)",
        borderColor: "rgba(2,117,216,1)",
        borderWidth: 1
      },{
        label: 'Ditolak',
        data: cDataPerbulanDitolak.data,
        backgroundColor: "rgba(250, 128, 114, 0.2)",
        borderColor: "rgba(250, 128, 114, 1)",
        borderWidth: 1
      }]
    };

    // config 
    const config = {
      type: 'bar',
      data,
      options: {
        interaction: {
            mode: 'index'
        },
        scales: {
          xAxes: [{
            time: {
            unit: 'month'
            },
            gridLines: {
            display: false
            },
            ticks: {
            maxTicksLimit: 12
            }
          }],
          yAxes: [{
            ticks: {
            min: 0,
            max: 30,
            maxTicksLimit: 5
            },
            gridLines: {
            color: "rgba(0, 0, 0, .125)",
            }
          }],
        }
      }
    };

    // render init block
    const myChart = new Chart(
      document.getElementById('myBarChart'),
      config
    );
</script>

{{-- pie --}}
<script>
  const cDataPercentage = JSON.parse('<?php echo $totalmendaftar; ?>');

  let diterima = 0;
  cDataPerbulanDiterima.data.forEach(num => {
    diterima += num
  });

  let ditolak = 0;
  cDataPerbulanDitolak.data.forEach(num => {
    ditolak += num
  });

  const datapie = {
    labels: [
      'Diterima',
      'Ditolak',
    ],
    datasets: [{
      label: 'Total',
      data: [diterima, ditolak],
      backgroundColor: [
        'rgb(54, 162, 235)',
        'rgb(255, 99, 132)',
      ],
      hoverOffset: 4,
      rotation: 180
    }]
  };

  const configpie = {
    type: 'pie',
    data: datapie,
    options: {
      scales: {
      },
      plugins: {
        tooltip: {
          enabled: false
        },
        datalabels: {
          formatter: (value, context) => {
            // console.log(value)
            // console.log(context.chart.data.datasets[0].data)
            const datapoints = context.chart.data.datasets[0].data
            function totalSum(total, datapoint) {
              return total + datapoint
            }
            const totalValue = datapoints.reduce(totalSum, 0)
            const percentageValue = (value / totalValue * 100).toFixed(0)
            return percentageValue + '%'
          },
          color: '#fff',
        }
      }
    },
    plugins: [ChartDataLabels]
  };

  const myPercentageChart = new Chart(
    document.getElementById('myPercentageChart'),
    configpie
  );
</script>

{{-- RPM chart --}}
<script>
  const cDataMendaftarAll = JSON.parse('<?php echo $totalmendaftarall; ?>');
  const datarpm = {
    labels: cDataMendaftarAll.label,
    datasets: [{
      label: 'Total',
      data: cDataMendaftarAll.data,
      backgroundColor: [
        'rgb(54, 162, 235)',
        'rgb(255, 99, 132)',
        'rgb(54, 255, 125)',
      ],
      hoverOffset: 4,
      circumference: 180,
      rotation: -90,
    }],
    
  };

  const configrpm = {
    type: 'pie',
    data: datarpm,
    plugins: [ChartDataLabels] 
  };

  const myRpmCHart = new Chart(
    document.getElementById("myRpmChart"),
    configrpm
  )
</script>

{{-- html2pdf --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection