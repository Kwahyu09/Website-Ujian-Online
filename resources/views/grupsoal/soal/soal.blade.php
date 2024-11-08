@extends('layoutdashboard.main') @section('container')
<div class="card">
    <div class="card-body">
        <h5 class="mb-2">Data
            {{ $title }}
            Berdasarkan
            {{ $grup }} {{ $modul->nama_modul }}</h5>
        <div class="d-flex justify-content-start mb-3 mt-3">
            <a href="/soal/create/{{ $slug }}" class="btn btn-primary mr-1">Tambah<i class="bi bi-plus-circle"></i>
            </a>
            <a href="/soal/tambahgambar/{{ $slug }}" class="btn btn-info mr-1">
                Tambah Jawaban Gambar<i class="bi bi-plus-circle"></i>
            </a>
            <a href="/soal/import/{{ $slug }}" class="btn btn-success">
                Import<i class="bi bi-file-earmark-arrow-down"></i>
            </a>
        </div>
        @if ($post->count())
        <div class="d-flex justify-content-end mb-2">
            <div class="mr-5"><b>Total Bobot : {{ $total }}</b></div>
            <div class="col-md-4">
                <form action="{{ url()->full() }}">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari.." name="search"
                            value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="flash-data" data-flashdata="{{ session('success') }}">
                </div>
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped" id="sortable-table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th>Pertanyaan</th>
                                        <th>Gambar</th>
                                        <th>Opsi A</th>
                                        <th>Opsi B</th>
                                        <th>Opsi C</th>
                                        <th>Opsi D</th>
                                        <th>Opsi E</th>
                                        <th>Jawaban</th>
                                        <th>Bobot</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tr>
                                    @foreach ($post as $pos)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{!! $pos->pertanyaan !!}</td>
                                    @if($pos->gambar)
                                    <td><img src="{{ asset('storage/' . $pos->gambar) }}" alt="Gambar" width="100px">
                                    </td>
                                    @else
                                    <td>
                                        <p style="font-style: italic">Tidak Ada</p>
                                    </td>
                                    @endif
                                    <td>
                                        @if (preg_match('/^gambar-soal\//', $pos->opsi_a))
                                        <img src="{{ asset('storage/' . $pos->opsi_a) }}" alt="Gambar" width="100px">
                                        @else
                                        {!! $pos->opsi_a !!}
                                        @endif
                                    </td>
                                    <td>
                                        @if (preg_match('/^gambar-soal\//', $pos->opsi_b))
                                        <img src="{{ asset('storage/' . $pos->opsi_b) }}" alt="Gambar" width="100px">
                                        @else
                                        {!! $pos->opsi_b !!}
                                        @endif
                                    </td>
                                    <td>
                                        @if (preg_match('/^gambar-soal\//', $pos->opsi_c))
                                        <img src="{{ asset('storage/' . $pos->opsi_c) }}" alt="Gambar" width="100px">
                                        @else
                                        {!! $pos->opsi_c !!}
                                        @endif
                                    </td>
                                    <td>
                                        @if (preg_match('/^gambar-soal\//', $pos->opsi_d))
                                        <img src="{{ asset('storage/' . $pos->opsi_d) }}" alt="Gambar" width="100px">
                                        @else
                                        {!! $pos->opsi_d !!}
                                        @endif
                                    </td>
                                    <td>
                                        @if (preg_match('/^gambar-soal\//', $pos->opsi_e))
                                        <img src="{{ asset('storage/' . $pos->opsi_e) }}" alt="Gambar" width="100px">
                                        @else
                                        {!! $pos->opsi_e !!}
                                        @endif
                                    </td>
                                    <td>
                                        @if (preg_match('/^gambar-soal\//', $pos->jawaban))
                                        <img src="{{ asset('storage/' . $pos->jawaban) }}" alt="Gambar" width="100px">
                                        @else
                                        {!! $pos->jawaban !!}
                                        @endif
                                    </td>
                                    <td>{!! $pos->bobot !!}</td>
                                    <td>
                                        <a href="/soal/{{ $pos->slug }}/edit" class="btn btn-primary btn-action mr-1"
                                            data-toggle="tooltip" title="Ubah">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="/soal/{{ $pos->slug }}/delete"
                                            class="btn btn-danger btn-action mr-1 tombol-hapus" data-toggle="tooltip"
                                            title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <p class="text-center fs-4">Tidak Ada Data
            {{ $title }}</p>
        @endif
        <div class="d-flex justify-content-end"></div>
    </div>
</div>
@endsection