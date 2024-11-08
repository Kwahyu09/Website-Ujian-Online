@extends('layoutdashboard.main')
@section('container')
<div class="row">
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Akun {{ $title }}</h4>
            </div>
            <form action="/{{ $title }}/store" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <input type="hidden" name="role" id="role" value="{{ $role }}">
                        <label for="inputAddress">Nama</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                            id="nama" required value="{{ old('nama') }}">
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Username</label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                            id="username" required value="{{ old('username') }}">
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @if($title == "staff")
                    <div class="form-group">
                        <label for="inputAddress2">NIK</label>
                        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" id="nik"
                            required value="{{ old('nik') }}">
                        @error('nik')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @elseif($title == "ketua")
                    <div class="form-group">
                        <label for="inputAddress2">NIP</label>
                        <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" id="nip"
                            required value="{{ old('nip') }}">
                        @error('nip')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email</label>
                            <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror"
                                id="email" required value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Password</label>
                            <input type="password" name="password"
                                class="form-control  @error('password') is-invalid @enderror" id="password" required>
                            <input class="mt-1" type="checkbox" onclick="myFunction()">Tampilkan Password
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer mb-3 mt-0">
                        <a class="ml-1 btn btn-danger float-right" href="/{{ $title }}">Batal</a>
                        <button class="btn btn-primary float-right" type="submit">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
@endsection