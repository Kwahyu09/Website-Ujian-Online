@extends('layoutdashboard.main')
@section('container')
<div class="card">
    <div class="card-body">
        <h5 class="mb-2">Data
            {{ $title }} Berdasarkan soal {{ $ujian->nama_ujian }}</h5>
        @if ($soal->count())
        <div class="row mt-3">
            <div class="col-12">
                <div class="flash-data" data-flashdata="{{ session('success') }}">
                </div>
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped" id="sortable-table">
                                <thead>
                                    <tr style="background-color: lightslategray;">
                                        <th style="width: 50px">No</th>
                                        <th>Pertanyaan</th>
                                        <th>Jawaban</th>
                                        <th>Bobot</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($soal as $s)
                                    <tr>
                                        <td style="width: 50px">
                                            {{ ($soal->currentPage() - 1)  * $soal->links()->paginator->perPage() + $loop->iteration }}
                                        </td>
                                        <td>{!! $s->pertanyaan !!}</td>
                                        @if (preg_match('/^gambar-soal\//', $s->jawaban))
                                        <td>
                                            <img class="mb-2 mt-2" style="border: 1px solid black;"
                                                src="{{ asset('storage/' . $s->jawaban) }}" alt="Gambar" width="300px">
                                        </td>
                                        @else
                                        <td>
                                            <label class="form-check-label">{!! $s->jawaban !!}</label>
                                        </td>
                                        @endif
                                        <td>{{ $s->bobot }}</td>
                                        <td style="width: 150px">
                                            <form method="POST" action="/evaluasi/show">
                                                @csrf
                                                <input type="hidden" name="ujian_id" id="ujian_id"
                                                    value="{{ $ujian->id }}">
                                                <input type="hidden" name="soal_id" id="soal_id" value="{{ $s->id }}">
                                                <button class="btn btn-info btn-action mr-1" data-toggle="tooltip"
                                                    title="Lihat Evaluasi" type="submit">
                                                    <i class="bi bi-info-square"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
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
        <div class="d-flex justify-content-end">
            {{ $soal->links() }}
        </div>
    </div>
</div>
@endsection