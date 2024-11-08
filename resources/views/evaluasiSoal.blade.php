@extends('layoutdashboard.main')
@section('container')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <h5 class="mb-2">Data Evaluasi Soal</h5>
                <label>{!! $datasoal->pertanyaan !!}</label><br>
                @if($datasoal->gambar)
                <img class="mb-2" style="border: 1px solid black;" src="{{ asset('storage/' . $datasoal->gambar) }}"
                    alt="Gambar" width="300px">
                @endif
                <form action="">
                    <input type="hidden" class="label-input" value="{!! $datasoal->opsi_a !!}">
                    <input type="hidden" class="label-input" value="{!! $datasoal->opsi_b !!}">
                    <input type="hidden" class="label-input" value="{!! $datasoal->opsi_c !!}">
                    <input type="hidden" class="label-input" value="{!! $datasoal->opsi_d !!}">
                    <input type="hidden" class="label-input" value="{!! $datasoal->opsi_e !!}">
                    <input type="hidden" class="data-input" value="{{ $opsia }}">
                    <input type="hidden" class="data-input" value="{{ $opsib }}">
                    <input type="hidden" class="data-input" value="{{ $opsic }}">
                    <input type="hidden" class="data-input" value="{{ $opsid }}">
                    <input type="hidden" class="data-input" value="{{ $opsie }}">
                </form>
                @if (preg_match('/^gambar-soal\//', $datasoal->jawaban))
                Jawaban :<img class="mb-2" style="border: 1px solid black;"
                    src="{{ asset('storage/' . $datasoal->jawaban) }}" alt="Gambar" width="300px">
                @else
                <h6 class="d-inline-flex">Jawaban : {!! $datasoal->jawaban !!}</h6>
                @endif
            </div>
        </div>
        <div>
            <canvas id="chartContainer" width="400" height="400"></canvas>
        </div>
        <div>
            @if (preg_match('/^gambar-soal\//', $datasoal->opsi_a))
            <img class="mb-2 ml-3" style="border: 1px solid black;" src="{{ asset('storage/' . $datasoal->opsi_a) }}"
                alt="Gambar" width="220px">
            @endif
            @if (preg_match('/^gambar-soal\//', $datasoal->opsi_b))
            <img class="mb-2 ml-1" style="border: 1px solid black;" src="{{ asset('storage/' . $datasoal->opsi_b) }}"
                alt="Gambar" width="220px">
            @endif
            @if (preg_match('/^gambar-soal\//', $datasoal->opsi_c))
            <img class="mb-2 ml-1" style="border: 1px solid black;" src="{{ asset('storage/' . $datasoal->opsi_c) }}"
                alt="Gambar" width="220px">
            @endif
            @if (preg_match('/^gambar-soal\//', $datasoal->opsi_d))
            <img class="mb-2 ml-1" style="border: 1px solid black;" src="{{ asset('storage/' . $datasoal->opsi_d) }}"
                alt="Gambar" width="220px">
            @endif
            @if (preg_match('/^gambar-soal\//', $datasoal->opsi_e))
            <img class="mb-2 ml-1" style="border: 1px solid black;" src="{{ asset('storage/' . $datasoal->opsi_e) }}"
                alt="Gambar" width="220px">
            @endif
        </div>
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
                                        <th>Npm Mahasiswa</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Jawaban</th>
                                        <th>Skor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($soal as $s)
                                    <tr>
                                        <td style="width: 50px">{{ $loop->iteration }}</td>
                                        <td>{{ $s->user->npm }}</td>
                                        <td>{{ $s->user->nama }}</td>
                                        <td>
                                            @if (preg_match('/^gambar-soal\//', $datasoal->jawaban))
                                            <img class="mb-2 mt-2" src="{{ asset('storage/' . $s->jawaban) }}"
                                                alt="Gambar Soal" width="250px">
                                            @else
                                            {!! $s->jawaban !!}
                                            @endif
                                        </td>
                                        <td>{{ $s->skor }}</td>
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
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById("chartContainer").getContext("2d");

        // Mengambil elemen input type hidden untuk data dan label
        var dataInputs = document.getElementsByClassName("data-input");
        var labelInputs = document.getElementsByClassName("label-input");

        // Mendapatkan data dan label dari input type hidden
        var data = [];
        var labels = [];

        for (var i = 0; i < dataInputs.length; i++) {
            data.push(dataInputs[i].value);
            var labelValue = labelInputs[i].getAttribute("value");

            // Cek apakah label diawali dengan 'gambar-soal/'
            if (labelValue.startsWith('gambar-soal/')) {
                // Jika diawali dengan 'gambar-soal/', tambahkan teks kosong ke array labels
                labels.push('');

                // Tambahkan elemen gambar di luar grafik
                var imgElement = document.createElement('img');
                imgElement.src = "{{ asset('storage') }}" + "/" + labelValue;
                imgElement.alt = "Gambar Soal";
                imgElement.width = "300px";

                // Ganti 'chartContainer' dengan id dari elemen di halaman web tempat Anda ingin menambahkan gambar
                var chartContainer = document.getElementById('chartContainer');
                chartContainer.parentNode.insertBefore(imgElement, chartContainer.nextSibling);
            } else {
                // Membersihkan tag HTML dari teks label sebelum menambahkannya ke dalam array labels
                var cleanLabel = labelValue.replace(/(<([^>]+)>)/gi, ""); // Membersihkan tag HTML
                // Jika tidak diawali dengan 'gambar-soal/', tambahkan teks biasa ke array labels
                labels.push(cleanLabel);
            }
        }

        // Membuat objek diagram batang
        var barChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: "rgba(0, 123, 255, 0.5)",
                    borderColor: "rgba(0, 123, 255, 1)",
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });

</script>
@endsection
