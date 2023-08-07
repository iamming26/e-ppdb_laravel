<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>PPDB - SMK Sriwijaya</title>
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script>
            window.onload = function() {
                document.getElementById('download')
                .addEventListener('click', ()=>{
                    const cetak = this.document.getElementById('cetak');
                    console.log(cetak);
                    console.log(window);
                    var opt = {
                        margin:       1,
                        filename:     'data-siswa.pdf',
                        image:        { type: 'jpeg', quality: 0.98 },
                        html2canvas:  { },
                        jsPDF:        { unit: 'cm', format: 'a4', orientation: 'landscape' }
                    };
                    html2pdf().from(cetak).set(opt).save();
                })
            }

        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="my-4 py-4">Perview</h5>
                    <button class="btn btn-sm btn-danger mb-1" id="download"><i class="fa-solid fa-file-pdf"></i> Cetak</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class=" p-2" id="cetak">
                        <h5 class="mb-3 text-center">Data Siswa Baru SMK Sriwijaya Karangpucung</h5>
                        <table class="mytable table table-sm">
                            <thead class="bg-warning">
                              <tr class="text-center vertical-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Tgl lahir</th>
                                <th scope="col">Jurusan</th>
                                <th scope="col">Whatsapp</th>
                                <th scope="col">Tgl daftar</th>
                                <th scope="col">Status</th>
                              </tr>
                            </thead>
                            <tbody>
                                
                                @if ($siswa)
                                @foreach ($siswa as $row => $outer)
                                    @foreach ($outer as $inner)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $inner->nama }}</td>
                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $inner->tanggal_lahir)->format('d M Y'); }}</td>
                                        <td>{{ $row }}</td>
                                        <td>0{{ $inner->whatsapp }}</td>
                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $inner->created_at)->locale('id_ID')->isoFormat('DD MMM YYYY'); }}</td>
                                        <td class="text-center">
                                            @if ($inner->status == 0)
                                                <strong class="text-center text-primary"><i class="fa-regular fa-clock"></i> proses</strong>
                                            @endif

                                            @if ($inner->status == 1)
                                                <strong class="text-center text-success"><i class="fa-solid fa-check-double"></i> diterima</strong>
                                            @endif
                                            
                                            @if ($inner->status == 2)
                                                <strong class="text-center text-danger"><i class="fa-solid fa-xmark"></i> ditolak</strong>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="7" class="text-center"><hr></td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        @yield('footer')
    </body>
</html>
