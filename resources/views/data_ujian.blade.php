@extends('layoutdashboard.main')
@section('container')
<div class="row">
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h3 class="mb-3">Data Ujian</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nama">Nama :
                            {{ Auth::user()->nama }}</label>
                        <br>
                        <label>NPM :
                            {{ Auth::user()->npm }}
                        </label>
                        <label for="nama_ujian">Nama Ujian :
                            {{ $post->nama_ujian }}</label>
                        <br>
                        <label for="nama_ujian">Kelas :
                            {{ $post->kelas }}</label>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nama_ujian">Tanggal :
                            {{ $post->tanggal }}</label>
                        <br>
                        <label for="nama_ujian">Waktu Mulai :
                            {{ $post->waktu_mulai }}</label>
                        <br>
                        <label for="nama_ujian">Waktu Selesai :
                            {{ $post->waktu_selesai }}</label>
                    </div>
                    <h6>Petunjuk Ujian :</h6>
                    1. Dalam pengerjaan ujian dilakukan dengan memilih salah satu jawaban yang benar
                    <br>
                    2. Lalu mengklik tombol Tambah Jawaban (menyimpan jawaban) dan lanjut ke soal berikutnya<br>
                    3. Ketika Mengubah Jawaban Harus Mengklik tombol Ubah Jawaban<br>
                    4. Apabila telah selesai maka dapat mengklik tombol Selesai Ujian<br>
                    5. Segera Selesaikan Semua pertanyaan, jika waktu sudah selesai otomatis sistem
                    ujian akan berakhir<br>
                </div>
                <a href="/masuk-ujian/{{ $post->slug }}" class="btn btn-primary float-right" type="submit">Mulai
                    Ujian</a>
            </div>
            <!-- end section -->
        </div>
        <!-- .col-12 -->
    </div>
    <!-- .row -->
</div>
@endsection