@extends('layoutdashboard.main')
@section('container')
<div class="row">
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Data {{ $title }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('ujian.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="kd_ujian" class="form-control @error('kd_ujian') is-invalid @enderror"
                        id="kd_ujian" value="{{ $kd_ujian }}">
                    <input type="hidden" name="user_id" class="form-control @error('user_id') is-invalid @enderror"
                        id="user_id" value="{{ auth()->user()->id }}">
                    <div class="form-group">
                        <label for="nama_ujian">Nama {{ $title }}</label>
                        <input type="text" name="nama_ujian"
                            class="form-control @error('nama_ujian') is-invalid @enderror" id="nama_ujian"
                            required="required" value="{{ old('nama_ujian') }}">
                        @error('nama_ujian')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="slug" class="form-control @error('slug') is-invalid @enderror"
                            id="slug" readonly>
                        @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="modul">Modul</label>
                        <select class="custom-select" id="modul" name="modul">
                            @foreach ($modul as $m)
                            @if(old('modul') == $m->nama_modul )
                            <option value="{{ $m->nama_modul }}" selected>{{ $m->nama_modul }}</option>
                            @else
                            <option value="{{ $m->nama_modul }}">{{ $m->nama_modul }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('modul')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="grupsoal">Grup Soal</label>
                        <select class="custom-select" id="grupsoal" name="grupsoal">
                            @foreach ($grup_soal as $grup)
                            @if(old('grupsoal') == $grup->slug )
                            <option value="{{ $grup->slug }}" selected>{{ $grup->slug }}</option>
                            @else
                            <option value="{{ $grup->slug }}">{{ $grup->slug }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('grupsoal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select class="custom-select" id="kelas" name="kelas">
                            @foreach ($kelas as $k)
                            @if(old('kelas') == $k->slug )
                            <option value="{{ $k->slug }}" selected>{{ $k->nama_kelas }} {{ $k->tahun_ajaran }}</option>
                            @else
                            <option value="{{ $k->slug }}">{{ $k->nama_kelas }} {{ $k->tahun_ajaran }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('grup_soal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <input type="hidden" name="acak_soal" class="form-control @error('acak_soal') is-invalid @enderror"
                        id="acak_soal" value="Y">
                    <div class="form-group mb-2">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" name="tanggal"
                                    class="form-control  @error('tanggal') is-invalid @enderror" id="tanggal"
                                    required="required" value="{{ old('tanggal') }}">
                                @error('grup_soal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="waktu_mulai">Waktu Mulai</label>
                                <input type="time" name="waktu_mulai"
                                    class="form-control  @error('waktu_mulai') is-invalid @enderror" id="waktu_mulai"
                                    required="required" value="{{ old('waktu_mulai') }}">
                                @error('waktu_mulai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="waktu_selesai">Waktu Selesai</label>
                                <input type="time" name="waktu_selesai"
                                    class="form-control  @error('waktu_selesai') is-invalid @enderror"
                                    id="waktu_selesai" required="required" value="{{ old('waktu_selesai') }}">
                                @error('waktu_selesai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer mb-3 mt-0">
                        <a class="ml-1 btn btn-danger float-right" href="/ujian">Batal</a>
                        <button class="btn btn-primary float-right" type="submit">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const nama_ujian = document.querySelector('#nama_ujian');
    const slug = document.querySelector('#slug');

    nama_ujian.addEventListener('change', function () {
        fetch('/ujian/create/checkSlug?nama_ujian=' + nama_ujian.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });
</script>
@endsection