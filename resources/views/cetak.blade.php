<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta names="viewport" contents="width=device-width, initial-scale-1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        table.static {
            position: relative;
            /* Left: 3%; */
            border: 1px solid #543535;
        }
    </style>
    <title class="mt-5">CETAK DATA HASIL UJIAN</title>
</head>

<body>
    <div class="form-group mt-5 d-flex justify-content-center">
        <p align="center">
            <b>Laporan Hasil Ujian Mahasiswa kelas {{ $ujian->kelas }}</b><br>
            <b>Modul {{ $ujian->modul }}</b>
        </p>
        <table class="static" align="center" rules="all" border="1px" style="width: 95%">
            <tr>
                <th>No.</th>
                <th>Npm</th>
                <th>Nama Mahasiswa</th>
                <th>Nilai</th>
            </tr>
            @foreach ($hasil as $has)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>{{ $has->user->npm }}</td>
                <td>{{ $has->user->nama }}</td>
                <td align="center">{{ $has->nilai }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</body>
<script type="text/javascript">
    window.print();
</script>

</html>