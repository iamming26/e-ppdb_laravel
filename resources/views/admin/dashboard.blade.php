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
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-chart-area me-1"></i>
            Total Pendaftar
        </div>
        <div class="card-body">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item">Total pendaftar: <strong>{{ DB::table('siswa')->whereYear('created_at', \Carbon\Carbon::now()->format('Y'))->count() }}</strong></li>
                <li class="list-group-item">Perlu Divalidasi: <strong>{{ DB::table('siswa')->whereYear('created_at', \Carbon\Carbon::now()->format('Y'))->where('status', 0)->count() }}</strong></li>
                <li class="list-group-item">Diterima: <strong>{{ DB::table('siswa')->whereYear('created_at', \Carbon\Carbon::now()->format('Y'))->where('status', 1)->count() }}</strong></li>
                <li class="list-group-item">Ditolak: <strong>{{ DB::table('siswa')->whereYear('created_at', \Carbon\Carbon::now()->format('Y'))->where('status', 2)->count() }}</strong></li>
              </ul>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-chart-area me-1"></i>
            Status (Progres/ Ditermia/ Ditolak) Grafik Baris 1 tahun berdasarkan bulan
        </div>
        <div class="card-body"><canvas id="myAreaChart" width="100%" height="30"></canvas></div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-chart-area me-1"></i>
            Diagram Bar
        </div>
        <div class="card-body"><canvas id="myBarChart" width="100%" height="30"></canvas></div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Persentase
                </div>
                <div class="card-body"><canvas id="myPieChart" width="100%" height="30"></canvas></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-pie me-1"></i>
                    RPM
                </div>
                <div class="card-body"><canvas id="rpm" width="75%" height="30"></canvas></div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

{{-- line --}}
<script>
    var ctx = document.getElementById("myAreaChart");
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
        backgroundColor: "rgba(2,107,206,0.2)",
        borderColor: "rgba(2,107,100,1)",
        pointRadius: 5,
        pointBackgroundColor: "rgba(250,128,114,1)",
        pointBorderColor: "rgba(250,128,114,0.8)",
        pointHoverRadius: 5,
        pointHoverBackgroundColor: "rgba(250,128,114,1)",
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
            maxTicksLimit: 7
            }
        }],
        yAxes: [{
            ticks: {
            min: 0,
            max: 20,
            maxTicksLimit: 5
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
    var cDataPerbulanDiterima = JSON.parse('<?php echo $perbulanditerima; ?>');
    var cDataPerbulanDitolak = JSON.parse('<?php echo $perbulanditolak; ?>');

    const data = {
      labels: cDataPerbulanDiterima.label,
      datasets: [{
        label: 'Diterima',
        data: cDataPerbulanDiterima.data,
        backgroundColor: [
          'rgba(255, 26, 104, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 26, 104, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(0, 0, 0, 0.2)'
        ],
        borderColor: [
          'rgba(255, 26, 104, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(255, 26, 104, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(0, 0, 0, 1)'
        ],
        borderWidth: 1
      },{
        label: 'Ditolak',
        data: cDataPerbulanDitolak.data,
        backgroundColor: [
          'rgba(255, 26, 104, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 26, 104, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(0, 0, 0, 0.2)'
        ],
        borderColor: [
          'rgba(255, 26, 104, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(255, 26, 104, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(0, 0, 0, 1)'
        ],
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
          y: {
            beginAtZero: true
          }
        }
      }
    };

    // render init block
    const myChart = new Chart(
      document.getElementById('myBarChart'),
      config
    );

    // Instantly assign Chart.js version
    const chartVersion = document.getElementById('chartVersion');
    chartVersion.innerText = Chart.version;
</script>

{{-- pie --}}
<script>
    var cDataPerbulanDiterima = JSON.parse('<?php echo $perbulanditerima; ?>');
    var cDataPerbulanDitolak = JSON.parse('<?php echo $perbulanditolak; ?>');

    const data = {
      labels: cDataPerbulanDiterima.label,
      datasets: [{
        label: 'Diterima',
        data: cDataPerbulanDiterima.data,
        backgroundColor: [
          'rgba(255, 26, 104, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 26, 104, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(0, 0, 0, 0.2)'
        ],
        borderColor: [
          'rgba(255, 26, 104, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(255, 26, 104, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(0, 0, 0, 1)'
        ],
        borderWidth: 1
      },{
        label: 'Ditolak',
        data: cDataPerbulanDitolak.data,
        backgroundColor: [
          'rgba(255, 26, 104, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 26, 104, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(0, 0, 0, 0.2)'
        ],
        borderColor: [
          'rgba(255, 26, 104, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(255, 26, 104, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(0, 0, 0, 1)'
        ],
        borderWidth: 1
      }]
    };

    // config 
    const config = {
      type: 'pie',
      data,
      options: {
        interaction: {
            mode: 'index'
        },
        scales: {
        }
      }
    };

    // render init block
    const myChart = new Chart(
      document.getElementById('myPieChart'),
      config
    );

    // Instantly assign Chart.js version
    const chartVersion = document.getElementById('chartVersion');
    chartVersion.innerText = Chart.version;
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection