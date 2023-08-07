<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>PPDB SMK</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            body {
                background-image: url('https://www.smksriwijayakrpc.sch.id/upload/picture/62924340Slide2.JPG');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
        </style>
    </head>
    <body>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header bg-info">
                                        <h1 class="text-center"><i class="fa-solid fa-users"></i></h1>
                                        <h5 class="text-center font-weight-light">Penerimaan Peserta Didik Baru (PPDB)<br>SMK Sriwijaya - Tahun {{ date('Y') }}</h5>
                                    </div>
                                    <div class="card-body">

                                        @include('components.alerts')

                                        <form action="{{ route('daftar') }}" method="post">
                                            @csrf
                                            <div class="row g-3 mb-2">
                                                <div class="col">
                                                  <input type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Lengkap" value="{{ old('nama') }}" name="nama" aria-label="First name">
                                                </div>
                                            </div>
                                            <div class="row g-3 mb-2">
                                                <div class="col">
                                                  <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}" name="tempat_lahir" aria-label="Tempat Lahir">
                                                </div>
                                                <div class="col">
                                                  <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" placeholder="Tanggal Lahir" value="{{ old('tanggal_lahir') }}" name="tanggal_lahir" aria-label="Tanggal Lahir">
                                                </div>
                                                <div class="col">
                                                  <select id="jenis_kelamin" name="jenis_kelamin" class="form-select  @error('jenis_kelamin') is-invalid @enderror">
                                                    <option value="">Jenis Kelamin</option>
                                                    <option {{ (old('jenis_kelamin') == 'Laki - laki') ? 'selected' : '' }} value="Laki - laki">Laki - laki</option>
                                                    <option {{ (old('jenis_kelamin') == 'Perempuan') ? 'selected' : '' }} value="Perempuan">Perempuan</option>
                                                  </select>
                                                </div>
                                            </div>
                                            <div class="row g-3 mb-2">
                                                <div class="col">
                                                    <input type="text" class="form-control @error('agama') is-invalid @enderror" placeholder="Agama" value="{{ old('agama') }}" name="agama" aria-label="Agama">
                                                  </div>
                                                <div class="col">
                                                    <label class="visually-hidden" for="whatsapp">Whatsapp</label>
                                                    <div class="input-group">
                                                        <div class="input-group-text">+62</div>
                                                        <input type="number" class="form-control @error('whatsapp') is-invalid @enderror" id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}" placeholder="Whatsapp">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3 mb-2">
                                                <div class="col">
                                                  <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror" placeholder="Nama Ayah" value="{{ old('nama_ayah') }}" name="nama_ayah" aria-label="Nama Ayah">
                                                </div>
                                                <div class="col">
                                                  <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror" placeholder="Nama Ibu" value="{{ old('nama_ibu') }}" name="nama_ibu" aria-label="Nama Ibu">
                                                </div>
                                            </div>
                                            <div class="row g-3 mb-2">
                                                <div class="col">
                                                  <textarea name="alamat" id="alamat" placeholder="Alamat Lengkap" cols="30" rows="3" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row g-3 mb-2">
                                                <div class="col">
                                                    <input type="text" class="form-control @error('asal_sekolah') is-invalid @enderror" placeholder="Asal Sekolah" value="{{ old('asal_sekolah') }}" name="asal_sekolah" aria-label="Asal Sekolah">
                                                  </div>
                                                <div class="col">
                                                    <select id="jurusan" name="jurusan" class="form-select @error('jurusan') is-invalid @enderror">
                                                        <option value="">Jurusan Yang Diminati</option>
                                                        <option {{ (old('jurusan') == 'Akuntansi & Keuangan Lembaga (AKL)') ? 'selected' : '' }} value="Akuntansi & Keuangan Lembaga (AKL)">Akuntansi & Keuangan Lembaga (AKL)</option>
                                                        <option {{ (old('jurusan') == 'Desain Komunikasi Visual (DKV)') ? 'selected' : '' }} value="Desain Komunikasi Visual (DKV)">Desain Komunikasi Visual (DKV)</option>
                                                        <option {{ (old('jurusan') == 'Teknik Kendaraan Ringan Otomotif (TKRO)') ? 'selected' : '' }} value="Teknik Kendaraan Ringan Otomotif (TKRO)">Teknik Kendaraan Ringan Otomotif (TKRO)</option>
                                                      </select>
                                                </div>
                                            </div>
                                            <div class="row g3 mb-2 px-3">
                                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Daftar</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center pb-3">
                                        <div class="small"><a href="{{ route('login') }}" target="_blank">Masuk Admin</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
