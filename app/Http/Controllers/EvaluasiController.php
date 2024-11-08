<?php

namespace App\Http\Controllers;

use App\Models\Evaluasi;
use App\Models\Grup_soal;
use App\Models\Ujian;
use App\Models\Soal;
use Illuminate\Http\Request;


class EvaluasiController extends Controller
{
    //menampilkan menu evaluasi index
    public function index()
    {
        $ujian = Ujian::latest()->get();

        if(auth()->user()->role == "Ketua"){
            $ujian = Ujian::where('user_id', auth()->user()->id)->latest()->filter(request(['search','ujian']))->paginate(1000);
        }
        return view('evaluasiujian', [
            "title" => "Evaluasi Ujian",
            "post" => $ujian
        ]);
    }

    // menampilkan menu evaluasi persoal
    public function soalEvaluasi(Request $request)
    {
        $id_ujian = $request->id_ujian;
        $ujian = Ujian::find($id_ujian);
        
        $slug = $ujian->grupsoal;
        $grup = Grup_soal::where('slug', $slug)->get();
        $id_grup = $grup[0]['id'];
        $soal = Soal::latest()->where('grup_soal_id',$id_grup)->paginate(500);
        return view('evaluasi', [
            "title" => "Evaluasi",
            "soal" => $soal,
            "ujian" => $ujian
        ]);
    }

    // menambahkan data evaluasi ketika mahasiswa menambahkan jawaban ujiannya
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'soal_id' => 'required',
            'ujian_id' => 'required',
            'user_id' => 'required',
            'jawaban' => 'required'
        ]);
        $soal = Soal::find($request->soal_id);
        if($request->jawaban == $soal->jawaban){
            $validatedData['skor'] = $request->skor;
        }else{
            $validatedData['skor'] = 0;
        }
        if(session('ujian_selesai')){
            return back()->with('success', 'Jawaban Gagal Diubah!');
        }
        evaluasi::create($validatedData);
        $pageNext = $request->page + 1;
        if($request->page == $request->pt){
            return redirect('/masuk-ujian'.'/'.$request->slug.'#soal-'.$request->pt);
        }else{
            return redirect('/masuk-ujian'.'/'.$request->slug.'#soal-'.$pageNext);
        }
    }

    // menampilkan data evaluasi detai berserta grafik jawaban persoal
    public function show(Request $request)
    {
        $id_ujian = $request->ujian_id;
        $id_soal = $request->soal_id;

        $soal = Soal::find($id_soal);
        $eval = Evaluasi::with('user')->where('ujian_id',$id_ujian)->where('soal_id',$id_soal)->get();
        
        $opsi_a = Evaluasi::where('ujian_id',$id_ujian)->where('soal_id',$id_soal)->where('jawaban',$soal->opsi_a)->count();
        $opsi_b = Evaluasi::where('ujian_id',$id_ujian)->where('soal_id',$id_soal)->where('jawaban',$soal->opsi_b)->count();
        $opsi_c = Evaluasi::where('ujian_id',$id_ujian)->where('soal_id',$id_soal)->where('jawaban',$soal->opsi_c)->count();
        $opsi_d = Evaluasi::where('ujian_id',$id_ujian)->where('soal_id',$id_soal)->where('jawaban',$soal->opsi_d)->count();
        $opsi_e = Evaluasi::where('ujian_id',$id_ujian)->where('soal_id',$id_soal)->where('jawaban',$soal->opsi_e)->count();
      
        return view('evaluasiSoal', [
            "title" => "Evaluasi Ujian",
            "soal" => $eval,
            "opsia" => $opsi_a,
            "opsib" => $opsi_b,
            "opsic" => $opsi_c,
            "opsid" => $opsi_d,
            "opsie" => $opsi_e,
            "datasoal" => $soal
        ]);
    }

    // mengubah data evaluasi ketika mahasiswa mengubah jawaban ujiannya
    public function update(Request $request, $id)
    {
        $rules = [
            'soal_id' => 'required',
            'ujian_id' => 'required',
            'user_id' => 'required',
            'jawaban' => 'required'
        ];
        
        $validatedData = $request->validate($rules);

        $soal = Soal::find($request->soal_id);
        if($request->jawaban == $soal->jawaban){
            $validatedData['skor'] = $request->skor;
        }else{
            $validatedData['skor'] = 0;
        }
        if(session('ujian_selesai')){
            return back()->with('success', 'Jawaban Gagal Diubah!');
        }
        evaluasi::where('id', $id)->update($validatedData);
        $pageNext = $request->page + 1;
        if($request->page == $request->pt){
            return redirect('/masuk-ujian'.'/'.$request->slug.'#soal-'.$request->pt);
        }else{
            return redirect('/masuk-ujian'.'/'.$request->slug.'#soal-'.$pageNext);
        }
    }
}