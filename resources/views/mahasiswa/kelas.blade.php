@extends('layoutdashboard.main')
@section('container')
<h5 class="mt-4 mb-5">Data Mahasiswa Berdasarkan Kelas</h5>
@if ($post->count())
<div class="container">
    <div class="row">
        @foreach ($post as $pos)
        <div class="col-md-3">
            <a style="text-decoration:none" href="/kelas/{{ $pos->slug }}">
                <div class="card shadow mb-3">
                    <div class="card-body text-center text-dark">
                        <div class="card-text my-2">
                            <h6>Kelas</h6>
                            <br>
                            <h5>{{ $pos->nama_kelas }}</h5>
                            <br>
                        </div>
                    </div>
                    <!-- ./card-text -->
                    <div class="card-footer">
                        <div class="row align-items-center justify-content-between text-dark">
                            <div class="col-auto">
                                <h6>Tahun :
                                    {{ $pos->tahun_ajaran }}
                                    <br>
                                    Jurusan :
                                    {{ $pos->jurusan }}</h6>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-footer -->
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@else
<p class="text-center fs-4">Tidak Ditemukan Data Modul</p>
@endif
<div class="d-flex justify-content-end">
    {{ $post->links() }}
</div>
@endsection