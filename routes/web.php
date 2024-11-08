<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\AktorController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\GrupsoalController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\HasilujianController;
use App\Http\Controllers\DashboardHomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/profile/{user:username}/edit', [AktorController::class, 'edit'])->middleware(['auth'])->name('profile');
Route::put('/Admin/{user:username}', [AktorController::class,'profile'])->middleware(['auth', 'role:Admin'])->name('updateAdmin');

Route::get('/', [DashboardHomeController::class, 'index'])->middleware(['auth'])->name('home');

Route::get('/staff', [AktorController::class, 'index_staff'])->middleware(['auth' , 'role:Admin'])->name('Staff');
Route::get('/staff/create', [AktorController::class, 'create_staff'])->middleware(['auth', 'role:Admin'])->name('CreateStaff');
Route::post('/staff/store', [AktorController::class, 'store_staff'])->middleware(['auth', 'role:Admin'])->name('StoreStaff');
Route::get('/staff/{user:username}/delete', [AktorController::class, 'destroy_staff'])->middleware(['auth', 'role:Admin'])->name('destroyStaff');
Route::put('/Staf/{user:username}', [AktorController::class,'profile'])->middleware(['auth'])->name('ProfileStaf');
Route::get('/staff/{user:username}/edit', [AktorController::class, 'edit_staf'])->middleware(['auth', 'role:Admin'])->name('editStaff');
Route::put('/Staf/{user:username}/update', [AktorController::class,'update_staf'])->middleware(['auth', 'role:Admin'])->name('updateStaf');

Route::get('/ketua', [AktorController::class, 'index_ketua'])->middleware(['auth', 'role:Admin|Staf'])->name('Ketua');
Route::get('/ketua/create', [AktorController::class, 'create_ketua'])->middleware(['auth', 'role:Admin|Staf'])->name('CreateKetua');
Route::post('/ketua/store', [AktorController::class, 'store_ketua'])->middleware(['auth', 'role:Admin|Staf'])->name('StoreKetua');
Route::get('/ketua/{user:username}/delete', [AktorController::class, 'destroy_ketua'])->middleware(['auth', 'role:Admin|Staf'])->name('destroyKetua');
Route::put('/Ketua/{user:username}', [AktorController::class,'profile'])->middleware(['auth'])->name('ProfileKetua');
Route::put('/Ketua/{user:username}/update', [AktorController::class,'update_ketua'])->middleware(['auth'])->name('updateKetua');
Route::get('/ketua/{user:username}/edit', [AktorController::class, 'edit_ketua'])->middleware(['auth', 'role:Admin|Staf'])->name('editKetua');
Route::get('/ujian-mahasiswa', [MahasiswaController::class,'ujian_index'])->middleware(['auth', 'role:Mahasiswa'])->name('mahasiswa-index');

Route::get('/masuk-ujian/{ujian:slug}', [MahasiswaController::class,'ujian_masuk'])->middleware(['auth', 'role:Mahasiswa'])->name('ujian-mahasiswa-index');

Route::get('/kelas', [KelasController::class,'index'])->middleware(['auth', 'role:Admin|Staf'])->name('Kelas');
Route::get('/kelas/create', [KelasController::class,'create'])->middleware(['auth', 'role:Admin|Staf'])->name('createKelas');
Route::post('/kelas/store', [KelasController::class,'store'])->middleware(['auth', 'role:Admin|Staf'])->name('storeKelas');
Route::get('/kelas/{kelas:slug}/delete', [KelasController::class, 'destroy'])->middleware(['auth', 'role:Admin|Staf'])->name('destroyKetua');
Route::get('/kelas/{kelas:slug}/edit', [KelasController::class, 'edit'])->middleware(['auth', 'role:Admin|Staf'])->name('editKelas');
Route::get('/kelas/{kelas:slug}',[KelasController::class, 'show'])->middleware(['auth', 'role:Admin|Staf'])->name('ShowMahasiswa');
Route::put('/kelas/{kelas:slug}/update', [KelasController::class,'update'])->middleware(['auth', 'role:Admin|Staf'])->name('UpdateKelas');
Route::get('/kelas/create/checkSlug',[KelasController::class, 'checkslug'])->middleware(['auth']);
Route::post('/ujian-data', [MahasiswaController::class,'ujian_data'])->middleware(['auth', 'role:Mahasiswa'])->name('ujian-data');

Route::resource('/dosen', DosenController::class)->middleware(['auth', 'role:Admin|Staf']);
Route::get('/dosen/{dosen:slug}/delete', [DosenController::class, 'destroy'])->middleware(['auth', 'role:Admin|Staf'])->name('destroyDosen');
Route::put('/dosen/{dosen:slug}', [DosenController::class,'update'])->middleware(['auth', 'role:Admin|Staf'])->name('updateDosen');
Route::get('/dosen/create/checkSlug',[DosenController::class, 'checkslug'])->middleware(['auth']);

Route::get('/mahasiswa/{user:username}/delete', [MahasiswaController::class, 'destroy'])->middleware(['auth', 'role:Admin|Staf'])->name('MahasiswaHapus');
Route::post('/mahasiswa/store', [MahasiswaController::class,'store'])->middleware(['auth', 'role:Admin|Staf'])->name('Mahasiswa-tambah');
Route::get('/mahasiswa/create/{kelas:slug}', [MahasiswaController::class, 'create'])->middleware(['auth', 'role:Admin|Staf'])->name('CreateKetua');
Route::get('/mahasiswa/import/{kelas:slug}', [MahasiswaController::class, 'createImport'])->middleware(['auth', 'role:Admin|Staf'])->name('CreateKetua');
Route::post('/mahasiswa/import_excel', [MahasiswaController::class, 'ImportExel'])->middleware(['auth', 'role:Admin|Staf'])->name('CreateKetua');
Route::put('/Mahasiswa/{user:username}', [AktorController::class,'profile'])->middleware(['auth'])->name('ProfileMahasiswa');
Route::get('/mahasiswa/{user:username}/edit', [MahasiswaController::class, 'edit'])->middleware(['auth', 'role:Admin|Staf'])->name('editMahasiswa');
Route::put('/Mahasiswa/{user:username}/update', [MahasiswaController::class,'update'])->middleware(['auth'])->name('UpdateMahasiswa');

Route::get('/kelasmahasiswa', [KelasController::class, 'kelas_mahasiswa'])->middleware(['auth', 'role:Admin|Staf'])->name('kelasmahasiswa');
Route::resource('/modul', ModulController::class)->middleware(['auth', 'role:Admin|Staf']);
Route::get('/modul/{modul:slug}/delete', [ModulController::class, 'destroy'])->middleware(['auth', 'role:Admin|Staf'])->name('destroyModul');
Route::put('/modul/{modul:slug}', [ModulController::class,'update'])->middleware(['auth', 'role:Admin|Staf'])->name('updatemodul');
Route::get('/modul/create/checkSlug',[ModulController::class, 'checkslug'])->middleware(['auth']);

Route::get('/grupsoal', [GrupsoalController::class, 'index'])->middleware(['auth','role:Admin|Ketua'])->name('GrupSoalModul');
Route::get('/grupsoal/{grup_soal:slug}/delete', [GrupsoalController::class, 'destroy'])->middleware(['auth','role:Admin|Ketua'])->name('destroyGrupsoal');
Route::get('/grupsoal/{modul:slug}', [GrupsoalController::class, 'index_grup'])->middleware(['auth','role:Admin|Ketua'])->name('indexgrupsoal');
Route::get('/grupsoal/{grup_soal:slug}/edit', [GrupsoalController::class, 'edit'])->middleware(['auth','role:Admin|Ketua'])->name('GrupSoalEdit');
Route::put('/grupsoal/{grup_soal:slug}/update', [GrupsoalController::class, 'update'])->middleware(['auth','role:Admin|Ketua'])->name('GrupSoalCreate');
Route::get('/grupsoal/create/{modul:slug}', [GrupsoalController::class, 'create'])->middleware(['auth','role:Admin|Ketua'])->name('GrupSoalcreate');
Route::post('/grupsoal/store', [GrupsoalController::class, 'store'])->middleware(['auth','role:Admin|Ketua'])->name('GrupSoalstore');
Route::get('/grupsoal/create/{modul:slug}/checkSlug', [GrupsoalController::class, 'checkslug'])->middleware(['auth']);

Route::get('/soal/{soal:slug}/edit', [SoalController::class,'edit'])->middleware(['auth','role:Admin|Ketua'])->name('soal_edit');
Route::put('/soal/{soal:slug}/update', [SoalController::class,'update'])->middleware(['auth','role:Admin|Ketua'])->name('soal_update');
Route::put('/soal/{soal:slug}/updategambar', [SoalController::class,'updategambar'])->middleware(['auth','role:Admin|Ketua'])->name('soal_updategambar');
Route::post('/soal/store', [SoalController::class, 'store'])->middleware(['auth','role:Admin|Ketua'])->name('soal_store');
Route::post('/soal/storegambar', [SoalController::class, 'storegambar'])->middleware(['auth','role:Admin|Ketua'])->name('soal_store');
Route::get('/soal/{soal:slug}/delete', [SoalController::class, 'destroy'])->middleware(['auth','role:Admin|Ketua'])->name('destroySoal');
Route::get('/soal/{grup_soal:slug}', [GrupsoalController::class,'show'])->middleware(['auth','role:Admin|Ketua'])->name('soal_show');
Route::get('/soal/create/{grup_soal:slug}', [SoalController::class,'create'])->middleware(['auth','role:Admin|Ketua'])->name('soal_create');
Route::get('/soal/tambahgambar/{grup_soal:slug}', [SoalController::class,'create_gambar'])->middleware(['auth','role:Admin|Ketua'])->name('soal_create');
Route::post('/soal/import_excel', [SoalController::class, 'ImportExel'])->middleware(['auth', 'role:Admin|Staf'])->name('CreateKetua');
Route::get('/soal/import/{grup_soal:slug}', [SoalController::class,'createImport'])->middleware(['auth','role:Admin|Ketua'])->name('soal_create');
Route::get('/soal/create1/{grup_soal:slug}', [SoalController::class,'create1'])->middleware(['auth','role:Admin|Ketua'])->name('soal_create');
Route::get('/soal/create2/{grup_soal:slug}', [SoalController::class,'create2'])->middleware(['auth','role:Admin|Ketua'])->name('soal_create');

Route::resource('/ujian', UjianController::class)->middleware(['auth','role:Admin|Ketua']);
Route::get('/ujian/{ujian:slug}/delete', [UjianController::class, 'destroy'])->middleware(['auth','role:Admin|Ketua'])->name('destroyUjian');
Route::put('/ujian/{ujian:slug}/update', [UjianController::class, 'update'])->middleware(['auth','role:Admin|Ketua'])->name('UpdateUjian');
Route::get('/ujian/create/checkSlug',[UjianController::class, 'checkslug'])->middleware(['auth']);

Route::resource('/hasilujian', HasilujianController::class)->middleware(['auth','role:Admin|Ketua']);
Route::post('/hasilujian/hasil_ujian', [HasilujianController::class, 'hasil'])->middleware(['auth','role:Admin|Ketua'])->name('hasilujian.hasil_ujian');
Route::get('/evaluasi', [EvaluasiController::class, 'index'])->middleware(['auth','role:Admin|Ketua'])->name('Evaluasis');
Route::post('/evaluasi/soal', [EvaluasiController::class, 'soalEvaluasi'])->middleware(['auth','role:Admin|Ketua'])->name('evaluasi_soal');
Route::post('/evaluasi/show', [EvaluasiController::class, 'show'])->middleware(['auth','role:Admin|Ketua'])->name('showsoal');
Route::post('/cetak', [HasilujianController::class, 'cetak'])->middleware(['auth','role:Admin|Ketua'])->name('cetak');

Route::post('/evaluasi/store', [EvaluasiController::class,'store'])->middleware(['auth', 'role:Mahasiswa'])->name('ujian-mahasiswa-tambah');
Route::put('/evaluasi/update/{id}', [EvaluasiController::class,'update'])->middleware(['auth', 'role:Mahasiswa'])->name('ujian-mahasiswa-update');
Route::get('/selesaiujian', [HasilujianController::class,'selesai_ujian'])->middleware(['auth', 'role:Mahasiswa'])->name('ujian.berakhir');
Route::get('/hasil-ujianmhs', [HasilujianController::class,'hasil_ujianmhs'])->middleware(['auth', 'role:Mahasiswa'])->name('hasil-ujianmhs');
Route::post('/selesaiujian', [HasilujianController::class,'selesai_ujian'])->middleware(['auth', 'role:Mahasiswa'])->name('ujian.berakhirpost');


require __DIR__.'/auth.php';
