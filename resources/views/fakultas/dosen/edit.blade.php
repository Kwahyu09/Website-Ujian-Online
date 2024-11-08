@extends('layoutdashboard.main')
@section('container')
<div class="row">
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Ubah Data {{ $title }}</h4>
            </div>
            <form action="/dosen/{{ $post->slug }}" method="post">
                @method('put')
                @csrf
                <input type="hidden" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug"
                    value="{{ old('slug', $post->slug) }}">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" id="nip"
                            required value="{{ old('nip', $post->nip) }}">
                        @error('nip')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama_dos">Nama</label>
                        <input type="text" name="nama_dos" class="form-control @error('nama_dos') is-invalid @enderror"
                            id="nama_dos" required value="{{ old('nama_dos', $post->nama_dos) }}">
                        @error('nama_dos')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <select class="custom-select @error('jabatan') is-invalid @enderror" id="jabatan"
                                    name="jabatan" required>
                                    @if(old('jabatan', $post->jabatan) == "Asisten Ahli")
                                    <option value="Asisten Ahli" selected>Asisten Ahli</option>
                                    <option value="Lektor">Lektor</option>
                                    <option value="Lektor Kepala">Lektor Kepala</option>
                                    <option value="Guru Besar/Profesor">Guru Besar/Profesor</option>
                                    <option value="">Tidak Ada</option>
                                    @elseif(old('jabatan', $post->jabatan) == "Lektor")
                                    <option value="Asisten Ahli">Asisten Ahli</option>
                                    <option value="Lektor" selected>Lektor</option>
                                    <option value="Lektor Kepala">Lektor Kepala</option>
                                    <option value="Guru Besar/Profesor">Guru Besar/Profesor</option>
                                    <option value="">Tidak Ada</option>
                                    @elseif(old('jabatan', $post->jabatan) == "Lektor Kepala")
                                    <option value="Asisten Ahli">Asisten Ahli</option>
                                    <option value="Lektor">Lektor</option>
                                    <option value="Lektor Kepala" selected>Lektor Kepala</option>
                                    <option value="Guru Besar/Profesor">Guru Besar/Profesor</option>
                                    <option value="">Tidak Ada</option>
                                    @elseif(old('jabatan', $post->jabatan) == "Guru Besar/Profesor")
                                    <option value="Asisten Ahli">Asisten Ahli</option>
                                    <option value="Lektor">Lektor</option>
                                    <option value="Lektor Kepala">Lektor Kepala</option>
                                    <option value="Guru Besar/Profesor" selected>Guru Besar/Profesor</option>
                                    <option value="">Tidak Ada</option>
                                    @else
                                    <option value="Asisten Ahli">Asisten Ahli</option>
                                    <option value="Lektor">Lektor</option>
                                    <option value="Lektor Kepala">Lektor Kepala</option>
                                    <option value="Guru Besar/Profesor">Guru Besar/Profesor</option>
                                    <option value="">Tidak Ada</option>
                                    @endif
                                </select>
                                @error('jabatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="gol_regu">Golongan Regu</label>
                                <select class="custom-select @error('gol_regu') is-invalid @enderror" id="gol_regu"
                                    name="gol_regu" required>
                                    @if(old('gol_regu', $post->gol_regu) == "III/a")
                                    <option value="III/a" selected>III/a</option>
                                    <option value="III/b">III/b</option>
                                    <option value="III/c">III/c</option>
                                    <option value="III/d">III/d</option>
                                    <option value="IV/a">IV/a</option>
                                    <option value="IV/b">IV/b</option>
                                    <option value="IV/c">IV/c</option>
                                    <option value="IV/d">IV/d</option>
                                    <option value="IV/e">IV/e</option>
                                    <option value="">Tidak Ada</option>
                                    @elseif(old('gol_regu', $post->gol_regu) == "III/b")
                                    <option value="III/a">III/a</option>
                                    <option value="III/b" selected>III/b</option>
                                    <option value="III/c">III/c</option>
                                    <option value="III/d">III/d</option>
                                    <option value="IV/a">IV/a</option>
                                    <option value="IV/b">IV/b</option>
                                    <option value="IV/c">IV/c</option>
                                    <option value="IV/d">IV/d</option>
                                    <option value="IV/e">IV/e</option>
                                    <option value="">Tidak Ada</option>
                                    @elseif(old('gol_regu', $post->gol_regu) == "III/c")
                                    <option value="III/a">III/a</option>
                                    <option value="III/b">III/b</option>
                                    <option value="III/c" selected>III/c</option>
                                    <option value="III/d">III/d</option>
                                    <option value="IV/a">IV/a</option>
                                    <option value="IV/b">IV/b</option>
                                    <option value="IV/c">IV/c</option>
                                    <option value="IV/d">IV/d</option>
                                    <option value="IV/e">IV/e</option>
                                    <option value="">Tidak Ada</option>
                                    @elseif(old('gol_regu', $post->gol_regu) == "III/d")
                                    <option value="III/a">III/a</option>
                                    <option value="III/b">III/b</option>
                                    <option value="III/c">III/c</option>
                                    <option value="III/d" selected>III/d</option>
                                    <option value="IV/a">IV/a</option>
                                    <option value="IV/b">IV/b</option>
                                    <option value="IV/c">IV/c</option>
                                    <option value="IV/d">IV/d</option>
                                    <option value="IV/e">IV/e</option>
                                    <option value="">Tidak Ada</option>
                                    @elseif(old('gol_regu', $post->gol_regu) == "IV/a")
                                    <option value="III/a">III/a</option>
                                    <option value="III/b">III/b</option>
                                    <option value="III/c">III/c</option>
                                    <option value="III/d">III/d</option>
                                    <option value="IV/a" selected>IV/a</option>
                                    <option value="IV/b">IV/b</option>
                                    <option value="IV/c">IV/c</option>
                                    <option value="IV/d">IV/d</option>
                                    <option value="IV/e">IV/e</option>
                                    <option value="">Tidak Ada</option>
                                    @elseif(old('gol_regu', $post->gol_regu) == "IV/b")
                                    <option value="III/a">III/a</option>
                                    <option value="III/b">III/b</option>
                                    <option value="III/c">III/c</option>
                                    <option value="III/d">III/d</option>
                                    <option value="IV/a">IV/a</option>
                                    <option value="IV/b" selected>IV/b</option>
                                    <option value="IV/c">IV/c</option>
                                    <option value="IV/d">IV/d</option>
                                    <option value="IV/e">IV/e</option>
                                    <option value="">Tidak Ada</option>
                                    @elseif(old('gol_regu', $post->gol_regu) == "IV/c")
                                    <option value="III/a">III/a</option>
                                    <option value="III/b">III/b</option>
                                    <option value="III/c">III/c</option>
                                    <option value="III/d">III/d</option>
                                    <option value="IV/a">IV/a</option>
                                    <option value="IV/b">IV/b</option>
                                    <option value="IV/c" selected>IV/c</option>
                                    <option value="IV/d">IV/d</option>
                                    <option value="IV/e">IV/e</option>
                                    <option value="">Tidak Ada</option>
                                    @elseif(old('gol_regu', $post->gol_regu) == "IV/d")
                                    <option value="III/a">III/a</option>
                                    <option value="III/b">III/b</option>
                                    <option value="III/c">III/c</option>
                                    <option value="III/d">III/d</option>
                                    <option value="IV/a">IV/a</option>
                                    <option value="IV/b">IV/b</option>
                                    <option value="IV/c">IV/c</option>
                                    <option value="IV/d" selected>IV/d</option>
                                    <option value="IV/e">IV/e</option>
                                    <option value="">Tidak Ada</option>
                                    @elseif(old('gol_regu', $post->gol_regu) == "IV/e")
                                    <option value="III/a">III/a</option>
                                    <option value="III/b">III/b</option>
                                    <option value="III/c">III/c</option>
                                    <option value="III/d">III/d</option>
                                    <option value="IV/a">IV/a</option>
                                    <option value="IV/b">IV/b</option>
                                    <option value="IV/c">IV/c</option>
                                    <option value="IV/d">IV/d</option>
                                    <option value="IV/e" selected>IV/e</option>
                                    <option value="">Tidak Ada</option>
                                    @else
                                    <option value="III/a">III/a</option>
                                    <option value="III/b">III/b</option>
                                    <option value="III/c">III/c</option>
                                    <option value="III/d">III/d</option>
                                    <option value="IV/a">IV/a</option>
                                    <option value="IV/b">IV/b</option>
                                    <option value="IV/c">IV/c</option>
                                    <option value="IV/d">IV/d</option>
                                    <option value="IV/e">IV/e</option>
                                    <option value="">Tidak Ada</option>
                                    @endif
                                </select>
                                @error('jabatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Kelamin : </label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kel" id="jenis_kel"
                                value="Laki-Laki" <?php if($post->jenis_kel =='Laki-Laki') echo 'checked'?>>
                            <label class="form-check-label" for="jenis_kel">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kel" id="jenis_kel"
                                value="Perempuan" <?php if($post->jenis_kel =='Perempuan') echo 'checked'?>>
                            <label class="form-check-label" for="jenis_kel">Perempuan</label>
                        </div>
                        @error('jenis_kel')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="prodi_id">Prodi</label>
                            <select class="custom-select @error('prodi_id') is-invalid @enderror" id="prodi_id"
                                name="prodi_id" required>
                                @if(old('prodi_id', $post->prodi_id) == "1")
                                    <option value="1"selected>Kedokteran</option>
                                    <option value="2">Pendidikan Profesi Dokter</option>
                                    @else
                                    <option value="1">Kedokteran</option>
                                    <option value="2"selected>Pendidikan Profesi Dokter</option>
                                @endif
                            </select>
                            @error('prodi_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email</label>
                            <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror"
                                id="email" required value="{{ old('email', $post->email) }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer mb-3 mt-0">
                        <a class="ml-1 btn btn-danger float-right" href="/dosen">Batal</a>
                        <button class="btn btn-primary float-right" type="submit">Ubah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection