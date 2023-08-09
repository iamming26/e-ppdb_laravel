@extends('admin.layouts')

@section('content')
<h1 class="mt-4">Data Siswa</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"><a href="{{ route('admin.siswa') }}">Siswa</a></li>
</ol>
<div class="mb-4">

    @include('components.alerts')

    <div class="row">
        <div class="col-6">
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalImport"><i class="fa-solid fa-file-import"></i> Import</button>
                <a href="{{ route('admin.siswa.export') }}" class="btn btn-sm btn-success"><i class="fa-solid fa-file-export"></i> Export</a>
                <a href="{{ route('admin.siswa.pdf') }}" target="_blank" class="btn btn-sm btn-danger"><i class="fa-solid fa-file-pdf"></i> PDF</a>
            </div>
        </div>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        List Siswa Pendaftar
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Tanggal lahir</th>
                    <th>Jurusan</th>
                    <th>Whatsapp</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @if ($siswa)
                @foreach ($siswa as $row => $outer)
                    @foreach ($outer as $inner)
                    <tr>
                        <td>{{ $inner->nama }}</td>
                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $inner->tanggal_lahir)->format('d M Y'); }}</td>
                        <td>{{ $row }}</td>
                        <td><a href="https://wa.me/62{{ $inner->whatsapp }}" target="_blank">0{{ $inner->whatsapp }}</a></td>
                        <td>{{ $inner->alamat }}</td>
                        <td>
                            @if ($inner->status == 0)
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.siswa.diterima', ['id'=>$inner->id]) }}" class="btn btn-sm btn-success">Terima</a>
                                    <a href="{{ route('admin.siswa.ditolak', ['id'=>$inner->id]) }}" class="btn btn-sm btn-danger">Tolak</a>
                                </div>

                            @elseif ($inner->status == 1)
                            <p class="text-center">&#9745; diterima</p>
                            @elseif ($inner->status == 2)
                            <p class="text-center">&#10005; ditolak</p>
                            @endif

                        </td>
                        <td>
                            <form action="{{ route('admin.siswa.hapus', ['id'=>$inner->id]) }}" method="post">
                                @method('delete')
                                @csrf
                                <a href="{{ route('admin.siswa.lihat', ['id'=>$inner->id]) }}" title="lihat" class="btn btn-sm btn-warning"><i class="fa-regular fa-eye"></i></a>
                                <button type="submit" title="hapus" onclick="confirm('Apakah anda yakin akan menghapus data dengan nama: {{$inner->nama}}')" class="btn btn-sm btn-danger"><i class="fa-regular fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>  
                    @endforeach
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('modal')
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
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
@endsection

@section('footer')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endsection