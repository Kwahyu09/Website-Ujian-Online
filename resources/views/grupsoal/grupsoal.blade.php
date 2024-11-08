@extends('layoutdashboard.main')
@section('container')
<h5 class="mt-4 mb-5">Data
    {{ $title }}
    Berdasarkan Modul</h5>
@if ($post->count())
<div class="container">
    <div class="row">
        @foreach ($post as $pos)
        <div class="col-md-3">
            <a style="text-decoration:none" href="/grupsoal/{{ $pos->slug }}">
                <div class="card shadow mb-4">
                    <div class="card-body text-center text-dark">
                        <div class="card-text my-2">
                            <h6>Modul</h6>
                            <br>
                            <h5>{{ $pos->nama_modul }}</h5>
                            <br>
                        </div>
                    </div>
                    <!-- ./card-text -->
                    <div class="card-footer">
                        <div class="row align-items-center justify-content-between text-dark">
                            <div class="col-auto">
                                <h6>Semester :
                                    {{ $pos->semester }}
                                    , Sks :
                                    {{ $pos->sks }}</h6>
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