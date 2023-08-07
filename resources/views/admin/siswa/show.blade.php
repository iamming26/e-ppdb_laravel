@extends('admin.layouts')

@section('content')
<h1 class="mt-4">Data Siswa</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('admin.siswa') }}">Siswa</a></li>
    <li class="breadcrumb-item active">Lihat</li>
</ol>
<div class="mb-4">

    @include('components.alerts')

</div>
<div class="card mb-4">
    <div class="card-header bg-info fs-5 border border-info">
        <i class="fa-solid fa-id-card"></i>
        Detail Data Siswa
    </div>
    <div class="card-body border border-info">
        <div class="container rounded bg-white">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3"><img class="rounded-circle mt-5" width="150px" src="https://w7.pngwing.com/pngs/831/88/png-transparent-user-profile-computer-icons-user-interface-mystique-miscellaneous-user-interface-design-smile-thumbnail.png"><span class="font-weight-bold">{{ $siswa->nama }}</span><span class="text-black-50">0{{ $siswa->whatsapp }}</span><span> </span></div>
                </div>
                <div class="col-md-9 border-right">
                    <div class="p-1">
                        <div class="row mt-3">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Nama</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control form-control-sm" id="colFormLabelSm" value="{{ $siswa->nama }}" disabled>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Tempat lahir</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control form-control-sm" id="colFormLabelSm" value="{{ $siswa->tempat_lahir }}" disabled>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Tanggal lahir</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control form-control-sm" id="colFormLabelSm" value="{{ $siswa->tanggal_lahir }}" disabled>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Jenis kelamin</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control form-control-sm" id="colFormLabelSm" value="{{ $siswa->jenis_kelamin }}" disabled>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Agama</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control form-control-sm" id="colFormLabelSm" value="{{ $siswa->agama }}" disabled>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Whatsapp</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control form-control-sm" id="colFormLabelSm" value="0{{ $siswa->whatsapp }}" disabled>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Nama Ayah</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control form-control-sm" id="colFormLabelSm" value="{{ $siswa->nama_ayah }}" disabled>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Nama Ibu</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control form-control-sm" id="colFormLabelSm" value="{{ $siswa->nama_ibu }}" disabled>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Alamat</label>
                            <div class="col-sm-10">
                                <textarea id="" cols="30" rows="3" class="form-control form-control-sm" disabled>{{ $siswa->alamat }}</textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Asal sekolah</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control form-control-sm" id="colFormLabelSm" value="{{ $siswa->asal_sekolah }}" disabled>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Jurusan</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control form-control-sm" id="colFormLabelSm" value="{{ $siswa->jurusan }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection