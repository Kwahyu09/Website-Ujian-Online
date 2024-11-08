@extends('layoutdashboard.main') @section('container')
<div class="card">
    <div class="card-body">
        <h5 class="mb-2">Data
            {{ $title }}</h5>
        <div class="d-flex justify-content-start">
            <a href="/dosen/create" class="btn btn-primary">Tambah Data
                <i class="bi bi-plus-circle"></i>
            </a>
        </div>
        @if ($post->count())
        <div class="d-flex justify-content-end mb-2">
            <div class="col-md-4">
                <form action="/dosen">
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
                                    <tr style="background-color: lightslategray;">
                                        <th style="width: 50px">No</th>
                                        <th style="width: 80px">NIP Dosen</th>
                                        <th>Nama Dosen</th>
                                        <th>Jabatan</th>
                                        <th>Gol/Reg</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Prodi</th>
                                        <th>Email</th>
                                        <th style="width: 150px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($post as $pos)
                                    <tr>
                                        <td style="width: 50px">
                                            {{ ($post->currentPage() - 1)  * $post->links()->paginator->perPage() + $loop->iteration }}
                                        </td>
                                        <td style="width: 80px">{{ $pos->nip }}</td>
                                        <td>{{ $pos->nama_dos }}</td>
                                        @if($pos->jabatan == 0)
                                        <td>Tidak Ada</td>
                                        @else
                                        <td>{{ $pos->jabatan }}</td>
                                        @endif
                                        @if( $pos->gol_regu == 0 )
                                        <td>Tidak Ada</td>
                                        @else
                                        <td>{{ $pos->gol_regu }}</td>
                                        @endif
                                        <td>{{ $pos->jenis_kel }}</td>
                                        <td>{{ $pos->prodi->nama_prodi }}</td>
                                        <td>{{ $pos->email }}</td>
                                        <td style="width: 150px">
                                            <a href="/dosen/{{ $pos->slug }}/edit"
                                                class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                title="Ubah">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="/dosen/{{ $pos->slug }}/delete"
                                                class="btn btn-danger btn-action mr-1 tombol-hapus"
                                                data-toggle="tooltip" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </a>
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
            {{ $post->links() }}
        </div>
    </div>
</div>
@endsection