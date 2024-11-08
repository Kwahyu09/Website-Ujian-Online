@extends('layoutdashboard.main') @section('container')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row align-items-center my-2">
                    <div class="col">
                        <h3>Pilih Evaluasi Berdasarkan Ujian</h3>
                        <br>
                        <h5>Silahkan Pilih Ujian :
                        </h5>
                        <br>
                        <form action="{{ route('evaluasi_soal') }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <select class="custom-select" id="id_ujian" name="id_ujian">
                                    <option selected="selected">Pilih...</option>
                                    @foreach ($post as $pos)
                                    <option value="{{ $pos->id }}">{{ $pos->nama_ujian }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="col-auto mr-5">
                        <br>
                        <br>
                        <br>
                        <br>
                        <button type="submit" class="btn btn-info mr-5">
                            <span class="bi bi-arrow-up-right-circle fe-12 mr-2"></span>Lihat</button>
                        </form>
                    </div>
                </div>
                <!-- end section -->
            </div>
            <!-- .col-12 -->
        </div>
        <!-- .row -->
    </div>
</div>
@endsection