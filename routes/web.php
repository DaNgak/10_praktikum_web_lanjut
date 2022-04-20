<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Models\Mahasiswa;
use App\Models\Mahasiswa_MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

Route::resource('mahasiswa', MahasiswaController::class);

Route::get('/data/search', function () {
    $mahasiswa = DB::table('mahasiswa')->where('nama', 'like', '%' . request('search') . '%')->paginate(3);
    return view('mahasiswa.index', compact('mahasiswa'));        
});

Route::get('/mahasiswa/nilai/{nim}', function ($nim) {
    $daftar = Mahasiswa_MataKuliah::with("matakuliah")->where("mahasiswa_id", $nim)->get();
    $daftar->mahasiswa = Mahasiswa::with('kelas')->where("nim", $nim)->first();
    return view('mahasiswa.nilai', compact('daftar'));        
});

Route::resource('article', ArticleController::class);
