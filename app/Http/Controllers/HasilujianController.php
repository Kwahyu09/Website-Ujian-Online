<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use App\Models\Evaluasi;
use App\Models\HasilUjian;
use Illuminate\Http\Request;

class HasilujianController extends Controller
{
    //menampilkan halaman hasil ujian memilih ujian index
    public function index()
    {
        $ujian = Ujian::latest()->get();

        if(auth()->user()->role == "Ketua"){
            $ujian = Ujian::where('user_id', auth()->user()->id)->latest()->filter(request(['search','ujian']))->paginate(1000);
        }
        return view('hasilujian_admin', [
            "title" => "Hasil Ujian",
            "ujian" => $ujian
        ]);
    }

    // menampilkan hasil ujian detai dimana terlihat nama dan nilai mahasiswa
    public function hasil(Request $request)
    {
        $id_ujian = $request->ujian_id;
        $hasil_ujian = HasilUjian::with('user')->where('ujian_id',$id_ujian)->get();
        $ujian = Ujian::find($id_ujian);

        return view('hasilujian', [
            "title" => "Hasil Ujian",
            "hasil" => $hasil_ujian,
            "ujian" => $ujian
        ]);
    }

    //cetak
    public function cetak(Request $request)
    {
        // Logika pencetakan
        $id_ujian = $request->ujian_id;
        $hasil_ujian = HasilUjian::with('user')->where('ujian_id',$id_ujian)->get();
        $ujian = Ujian::find($id_ujian);

        return view('cetak', [
            "hasil" => $hasil_ujian,
            "ujian" => $ujian
        ]);
    }

    // menampilkan hasil ujian untuk mahasiswa
    public function hasil_ujianmhs(){
        return view('hasil_ujian',  [
            "title" => "Ujian Mahasiswa",
            "total" => session('hasilmahasiswa')
        ]);
    }

    // method untuk menghitung hasil ujian
    public function selesai_ujian(Request $request)
    {
        $validatedData = $request->validate([
            'ujian_id' => 'required',
            'user_id' => 'required'
        ]);

        $totalbobot = $request['totalbobot'];
        $nilaimhs = Evaluasi::where('ujian_id', $request->ujian_id)
                        ->where('user_id', $request->user_id)
                       ->sum('skor');
        $nilai = ($nilaimhs / $totalbobot) * 100;
        // menggunakan format dibelakang koma diambil 2 angka setelah koma
        $nilaiFormatted = number_format($nilai, 2);

        // hapus nilai koma jika bilangan bulat
        $validatedData['nilai'] = rtrim(rtrim($nilaiFormatted, '0'), '.'); 

        HasilUjian::create($validatedData);
        // Setel sesi 'ujian_selesai' menjadi true
        session()->put('ujian_selesai', true);

        return redirect()->route('hasil-ujianmhs')->with('hasilmahasiswa', $validatedData['nilai'])->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }
}
