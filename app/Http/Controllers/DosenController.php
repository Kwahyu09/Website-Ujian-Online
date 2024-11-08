<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Prodi;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DosenController extends Controller
{
    //menampilkan halaman index dosen
    public function index()
    {
        return view('fakultas.dosen.index', [
            "title" => "Dosen",
            "post" => Dosen::with('prodi')->latest()->filter(request(['search']))->paginate(10)
        ]);
    }

    //menampilkan halaman tambah data dosen
    public function create()
    {
        $prodi = Prodi::all(); 
        return view('fakultas.dosen.create', [
            "title" => "Dosen",
            "prodi" => $prodi
        ]);
    }

    //menambahkan data dosen ke database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'prodi_id' => 'required',
            'nip' => 'required|min:16|max:18|unique:App\Models\Dosen',
            'nama_dos' => 'required|min:3|max:60',
            'slug' => 'required|unique:App\Models\Dosen',
            'jabatan' => 'max:50',
            'gol_regu' => 'max:50',
            'jenis_kel' => 'required|min:4|max:9',
            'email' => 'required|email|max:60|min:6|unique:App\Models\Dosen'
        ]);
        
        Dosen::create($validatedData);
        return redirect('/dosen')->with('success', 'Data Berhasil Ditambahkan!');
    }

    //menampilkan halaman edit dosen
    public function edit(Dosen $dosen)
    {
        $prodi = Prodi::all(); 
        return view('fakultas.dosen.edit', [
            "title" => "Dosen",
            "post" => $dosen,
        ]);
    }

    //mengubah data dosen di database
    public function update(Request $request, Dosen $dosen)
    {
        $rules = [
            'prodi_id' => 'required',
            'nama_dos' => 'required|min:3|max:255',
            'jabatan' => 'max:255',
            'gol_regu' => 'max:255',
            'jenis_kel' => 'required|min:4|max:9'
        ];

        if($request->nip != $dosen->nip){
            $rules['nip'] = 'required|min:16|max:18|unique:App\Models\Dosen';
        }
        if($request->slug != $dosen->slug){
            $rules['slug'] = 'required|unique:App\Models\Dosen';
        }
        if($request->email != $dosen->email){
            $rules['email'] = 'required|email|max:60|min:6|unique:App\Models\Dosen';
        }

        $validatedData = $request->validate($rules);
        Dosen::where('id', $dosen->id)
            ->update($validatedData);
        return redirect('/dosen')->with('success', 'Data Berhasil DiUbah!');
    }

    //menghapus data dosen di database
    public function destroy(Dosen $dosen)
    {
        Dosen::destroy($dosen->id);
        return redirect('/dosen')->with('success', 'Data Berhasil DiHapus!');
    }

    //cekslug
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Dosen::class, 'slug', $request->nama_dos);
        return response()->json(['slug' => $slug ]);
    }
}